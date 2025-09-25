<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Sector;
use App\Models\ResidenceInformation;
use App\Enums\MaritalStatus;
use App\Enums\EmploymentStatus;
use App\Http\Requests\People\StorePeopleRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $stats = [
                'total_people' => People::count(),
                'available_people' => People::where('employment_status', EmploymentStatus::DISPONIBLE)->count(),
                'hired_people' => People::where('employment_status', EmploymentStatus::CONTRATADO)->count(),
            ];
        } catch (\Exception $e) {
            // Si hay error, usar valores por defecto
            $stats = [
                'total_people' => 0,
                'available_people' => 0,
                'hired_people' => 0,
            ];
        }

        // Si es una petición AJAX para DataTable
        if ($request->ajax()) {
            $query = People::query();

            // Aplicar filtros
            if ($request->has('search') && !empty($request->search)) {
                $query->where(function($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('code_unique', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('dni', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->has('status') && !empty($request->status)) {
                $query->where('employment_status', $request->status);
            }

            if ($request->has('verified') && !empty($request->verified)) {
                if ($request->verified === 'with_user') {
                    $query->whereNotNull('user_id');
                } elseif ($request->verified === 'without_user') {
                    $query->whereNull('user_id');
                }
            }

            $people = $query->get();

            $data = $people->map(function($person) {
                $fullName = trim($person->name . ' ' . $person->last_name);
                $verificationStatus = $person->user_id ? 'Parcial' : 'Pendiente';
                $employmentStatus = $person->employment_status?->getLabel() ?? 'Sin Estado';
                
                return [
                    'id' => $person->id,
                    'code_unique' => $person->code_unique,
                    'name' => $fullName,
                    'dni' => $person->dni,
                    'age' => $person->age,
                    'verified' => $verificationStatus,
                    'status' => $employmentStatus,
                    'employment_status' => $person->employment_status?->value ?? 'sin_estado',
                    'created_at' => $person->created_at->format('Y-m-d H:i:s'),
                    'user_id' => $person->user_id,
                    'action' => ''
                ];
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $people->count(),
                'recordsFiltered' => $people->count()
            ]);
        }

        return view('module.people.index', compact('stats'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $maritalStatusOptions = MaritalStatus::getOptions();
        $employmentStatusOptions = EmploymentStatus::getOptions();
        
        return view('module.people.create', compact('maritalStatusOptions', 'employmentStatusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeopleRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $validatedData = $request->validated();

            // Calcular edad si no se proporciona
            if (empty($validatedData['age']) && !empty($validatedData['birth_date'])) {
                $birthDate = new \DateTime($validatedData['birth_date']);
                $today = new \DateTime();
                $age = $today->diff($birthDate)->y;
                $validatedData['age'] = $age;
            }

            // Establecer estado laboral como pendiente por defecto
            $validatedData['employment_status'] = EmploymentStatus::PENDIENTE->value;
            
            // Establecer cargo que aspira por defecto
            $validatedData['position_applied_for'] = 'Por definir';

            // Separar datos de la persona de los datos de residencia
            $personData = collect($validatedData)->except([
                'province_id', 'municipality_id', 'sector_id',
                'residential_complex', 'building', 'apartment',
                'neighborhood', 'street_and_number', 'coordinates', 'arrival_reference'
            ])->toArray();

            $person = People::create($personData);

            // Crear información de residencia si se proporcionan los datos
            if (!empty($validatedData['province_id']) || !empty($validatedData['municipality_id'])) {
                $residenceData = [
                    'person_id' => $person->id,
                    'province_id' => $validatedData['province_id'] ?? null,
                    'municipality_id' => $validatedData['municipality_id'] ?? null,
                    'sector_id' => $validatedData['sector_id'] === 'no_aplica' ? null : $validatedData['sector_id'] ?? null,
                    'residential_complex' => $validatedData['residential_complex'] ?? null,
                    'building' => $validatedData['building'] ?? null,
                    'apartment' => $validatedData['apartment'] ?? null,
                    'neighborhood' => $validatedData['neighborhood'] ?? null,
                    'street_and_number' => $validatedData['street_and_number'] ?? null,
                    'coordinates' => $validatedData['coordinates'] ?? null,
                    'arrival_reference' => $validatedData['arrival_reference'] ?? null,
                    'is_certified' => false,
                ];

                ResidenceInformation::create($residenceData);
            }

            DB::commit();

            return redirect()->route('people.index')
                ->with('success', 'Personal creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Error en PeopleController@store: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear el personal: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $person = People::findOrFail($id);

            $person->load([
                'user',
                'residenceInformation',
                'personalReferences',
                'educationalSkills',
                'workExperiences',
                'aspirations'
            ]);

            return view('module.people.show', compact('person'));
        } catch (\Exception $e) {
            Log::error('Error en PeopleController@show: ' . $e->getMessage());
            return redirect()->route('people.index')
                ->with('error', 'Persona no encontrada');
        }
    }

    /**
     * Update employment status for selected people
     */
    public function updateStatus(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'people_ids' => 'required|array|min:1',
                'people_ids.*' => 'required|integer|exists:people,id',
                'new_status' => 'required|string|in:' . implode(',', array_column(EmploymentStatus::cases(), 'value'))
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $peopleIds = $request->people_ids;
            $newStatus = $request->new_status;
            $statusLabel = EmploymentStatus::getLabelByValue($newStatus);

            $updatedCount = People::whereIn('id', $peopleIds)
                ->update(['employment_status' => $newStatus]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Se actualizó el estado de {$updatedCount} persona(s) a '{$statusLabel}'",
                'updated_count' => $updatedCount
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en PeopleController@updateStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado de las personas'
            ], 500);
        }
    }

    /**
     * Export selected people to Excel
     */
    public function exportExcel(Request $request)
    {
        // TODO: Implementar exportación a Excel
        return response()->json([
            'success' => false,
            'message' => 'Funcionalidad de exportación a Excel pendiente de implementar'
        ]);
    }

    /**
     * Export selected people to PDF
     */
    public function exportPdf(Request $request)
    {
        // TODO: Implementar exportación a PDF
        return response()->json([
            'success' => false,
            'message' => 'Funcionalidad de exportación a PDF pendiente de implementar'
        ]);
    }

    /**
     * Obtener municipios por provincia
     */
    public function getMunicipalities($provinceId): JsonResponse
    {
        try {
            $municipalities = Municipality::where('province_id', $provinceId)
                ->orderBy('name')
                ->get(['id', 'name']);

            return response()->json([
                'success' => true,
                'data' => $municipalities
            ]);
        } catch (\Exception $e) {
            Log::error('Error en PeopleController@getMunicipalities: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los municipios'
            ], 500);
        }
    }

    /**
     * Obtener sectores por municipio
     */
    public function getSectors($municipalityId): JsonResponse
    {
        try {
            $sectors = Sector::where('municipality_id', $municipalityId)
                ->orderBy('name')
                ->get(['id', 'name']);

            // Si no hay sectores, agregar opción "No aplica"
            if ($sectors->isEmpty()) {
                $sectors = collect([
                    (object)['id' => 'no_aplica', 'name' => 'No aplica']
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $sectors
            ]);
        } catch (\Exception $e) {
            Log::error('Error en PeopleController@getSectors: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los sectores'
            ], 500);
        }
    }

}

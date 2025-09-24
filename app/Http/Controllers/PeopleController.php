<?php

namespace App\Http\Controllers;

use App\Models\People;
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
            $validatedData = $request->validated();

            // Calcular edad si no se proporciona
            if (empty($validatedData['age']) && !empty($validatedData['birth_date'])) {
                $birthDate = new \DateTime($validatedData['birth_date']);
                $today = new \DateTime();
                $age = $today->diff($birthDate)->y;
                $validatedData['age'] = $age;
            }

            $person = People::create($validatedData);

            return redirect()->route('people.index')
                ->with('success', 'Personal creado exitosamente.');

        } catch (\Exception $e) {
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
}

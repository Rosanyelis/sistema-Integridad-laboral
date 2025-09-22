<?php

namespace App\Http\Controllers;

use App\Enums\MaritalStatus;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Muestra el formulario de creación
     */
    public function create()
    {
        $maritalStatusOptions = MaritalStatus::getOptions();
        
        return view('people.create', compact('maritalStatusOptions'));
    }

    /**
     * Almacena una nueva persona
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|unique:people,dni',
            'marital_status' => 'required|in:' . implode(',', MaritalStatus::getCases()),
            // ... otros campos
        ]);

        // El enum se convierte automáticamente gracias al cast en el modelo
        $person = Person::create($validated);

        return redirect()->route('people.show', $person)
            ->with('success', 'Persona creada exitosamente');
    }

    /**
     * Muestra una persona específica
     */
    public function show(Person $person)
    {
        // Acceder al label del estado civil
        $maritalStatusLabel = $person->marital_status_label;
        
        return view('people.show', compact('person', 'maritalStatusLabel'));
    }

    /**
     * Filtra personas por estado civil
     */
    public function index(Request $request)
    {
        $query = Person::query();

        if ($request->has('marital_status') && $request->marital_status) {
            $maritalStatus = MaritalStatus::from($request->marital_status);
            $query->byMaritalStatus($maritalStatus);
        }

        $people = $query->paginate(15);
        $maritalStatusOptions = MaritalStatus::getOptions();

        return view('people.index', compact('people', 'maritalStatusOptions'));
    }

    /**
     * Obtiene estadísticas de estado civil
     */
    public function statistics()
    {
        $stats = [];
        
        foreach (MaritalStatus::cases() as $status) {
            $count = Person::where('marital_status', $status->value)->count();
            $stats[] = [
                'status' => $status->getLabel(),
                'value' => $status->value,
                'count' => $count
            ];
        }

        return response()->json($stats);
    }
}

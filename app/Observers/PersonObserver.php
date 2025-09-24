<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\People;
use Illuminate\Support\Facades\Log;

class PersonObserver
{
    /**
     * Handle the Person "creating" event.
     * Se ejecuta antes de crear el registro en la base de datos
     */
    public function creating(People $person): void
    {
        // Solo generar el código si no se ha proporcionado uno
        if (empty($person->code_unique)) {
            $person->code_unique = $this->generateUniqueCode();
        }
    }

    /**
     * Genera un código único en formato: XX-DDMMYYYY
     * Donde XX es el número secuencial del día
     */
    private function generateUniqueCode(): string
    {
        $today = Carbon::now();
        $dateString = $today->format('dmY'); // Formato: DDMMYYYY
        
        // Obtener el último código del día actual
        $lastCode = People::whereDate('created_at', $today->toDateString())
            ->where('code_unique', 'like', '%-' . $dateString)
            ->orderBy('code_unique', 'desc')
            ->value('code_unique');
        
        // Si no hay códigos para hoy, empezar con 01
        if (!$lastCode) {
            $sequenceNumber = 1;
        } else {
            // Extraer el número secuencial del último código
            $parts = explode('-', $lastCode);
            $sequenceNumber = (int) $parts[0] + 1;
        }
        
        // Formatear el número secuencial con ceros a la izquierda (mínimo 2 dígitos)
        $formattedSequence = str_pad($sequenceNumber, 2, '0', STR_PAD_LEFT);
        
        return $formattedSequence . '-' . $dateString;
    }

    /**
     * Handle the Person "created" event.
     * Se ejecuta después de crear el registro en la base de datos
     */
    public function created(People $person): void
    {
        // Log para debugging (opcional)
        \Illuminate\Support\Facades\Log::info("Persona creada con código único: {$person->code_unique}", [
            'person_id' => $person->id,
            'code_unique' => $person->code_unique,
            'created_at' => $person->created_at
        ]);
    }

    /**
     * Handle the Person "updating" event.
     * Se ejecuta antes de actualizar el registro
     */
    public function updating(People $person): void
    {
        // No permitir modificar el code_unique una vez creado
        if ($person->isDirty('code_unique') && $person->getOriginal('code_unique')) {
            $person->code_unique = $person->getOriginal('code_unique');
        }
    }
}

<?php

namespace App\Helpers;

use App\Models\People;
use Carbon\Carbon;

class PersonCodeHelper
{
    /**
     * Genera un código único para una persona
     * Formato: XX-DDMMYYYY
     */
    public static function generateUniqueCode(?Carbon $date = null): string
    {
        $date = $date ?? Carbon::now();
        $dateString = $date->format('dmY'); // Formato: DDMMYYYY
        
        // Obtener el último código del día especificado
        $lastCode = People::whereDate('created_at', $date->toDateString())
            ->where('code_unique', 'like', '%-' . $dateString)
            ->orderBy('code_unique', 'desc')
            ->value('code_unique');
        
        // Si no hay códigos para ese día, empezar con 01
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
     * Obtiene el siguiente número secuencial para un día específico
     */
    public static function getNextSequenceNumber(?Carbon $date = null): int
    {
        $date = $date ?? Carbon::now();
        $dateString = $date->format('dmY');
        
        $lastCode = People::whereDate('created_at', $date->toDateString())
            ->where('code_unique', 'like', '%-' . $dateString)
            ->orderBy('code_unique', 'desc')
            ->value('code_unique');
        
        if (!$lastCode) {
            return 1;
        }
        
        $parts = explode('-', $lastCode);
        return (int) $parts[0] + 1;
    }

    /**
     * Obtiene estadísticas de códigos generados por día
     */
    public static function getDailyStats(?Carbon $date = null): array
    {
        $date = $date ?? Carbon::now();
        $dateString = $date->format('dmY');
        
        $count = Person::whereDate('created_at', $date->toDateString())
            ->where('code_unique', 'like', '%-' . $dateString)
            ->count();
        
        $lastCode = People::whereDate('created_at', $date->toDateString())
            ->where('code_unique', 'like', '%-' . $dateString)
            ->orderBy('code_unique', 'desc')
            ->value('code_unique');
        
        return [
            'date' => $date->format('Y-m-d'),
            'date_string' => $dateString,
            'total_registrations' => $count,
            'last_code' => $lastCode,
            'next_sequence' => $count + 1,
            'next_code' => self::generateUniqueCode($date)
        ];
    }

    /**
     * Valida si un código único tiene el formato correcto
     */
    public static function isValidCodeFormat(string $code): bool
    {
        return preg_match('/^\d{2}-\d{8}$/', $code) === 1;
    }

    /**
     * Extrae la fecha de un código único
     */
    public static function extractDateFromCode(string $code): ?Carbon
    {
        if (!self::isValidCodeFormat($code)) {
            return null;
        }
        
        $parts = explode('-', $code);
        $dateString = $parts[1]; // DDMMYYYY
        
        try {
            return Carbon::createFromFormat('dmY', $dateString);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Extrae el número secuencial de un código único
     */
    public static function extractSequenceFromCode(string $code): ?int
    {
        if (!self::isValidCodeFormat($code)) {
            return null;
        }
        
        $parts = explode('-', $code);
        return (int) $parts[0];
    }
}

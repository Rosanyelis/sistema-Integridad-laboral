<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'occupation',
        'availability',
        'hour_range',
        'hours_per_week',
    ];

    protected $casts = [
        'hours_per_week' => 'integer',
    ];

    /**
     * Relación con People (belongsTo)
     * Una aspiración pertenece a una persona
     */
    public function person()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Scope para filtrar por ocupación
     */
    public function scopeByOccupation($query, string $occupation)
    {
        return $query->where('occupation', 'like', "%{$occupation}%");
    }

    /**
     * Scope para filtrar por disponibilidad
     */
    public function scopeByAvailability($query, string $availability)
    {
        return $query->where('availability', $availability);
    }

    /**
     * Scope para filtrar por rango de horas
     */
    public function scopeByHourRange($query, string $hourRange)
    {
        return $query->where('hour_range', $hourRange);
    }

    /**
     * Scope para filtrar por horas mínimas por semana
     */
    public function scopeByMinimumHoursPerWeek($query, int $hours)
    {
        return $query->where('hours_per_week', '>=', $hours);
    }

    /**
     * Scope para filtrar por horas máximas por semana
     */
    public function scopeByMaximumHoursPerWeek($query, int $hours)
    {
        return $query->where('hours_per_week', '<=', $hours);
    }

    /**
     * Scope para filtrar por rango de horas por semana
     */
    public function scopeByHoursPerWeekRange($query, int $minHours, int $maxHours)
    {
        return $query->whereBetween('hours_per_week', [$minHours, $maxHours]);
    }

    /**
     * Scope para filtrar aspiraciones de tiempo completo
     */
    public function scopeFullTime($query)
    {
        return $query->where('hours_per_week', '>=', 40);
    }

    /**
     * Scope para filtrar aspiraciones de medio tiempo
     */
    public function scopePartTime($query)
    {
        return $query->where('hours_per_week', '<', 40)
                    ->where('hours_per_week', '>', 0);
    }

    /**
     * Obtiene la aspiración formateada
     */
    public function getFormattedAspirationAttribute(): string
    {
        $parts = [];
        
        if ($this->occupation) {
            $parts[] = $this->occupation;
        }
        
        if ($this->availability) {
            $parts[] = "({$this->availability})";
        }
        
        if ($this->hours_per_week) {
            $parts[] = "- {$this->hours_per_week}h/semana";
        }
        
        if ($this->hour_range) {
            $parts[] = "({$this->hour_range})";
        }
        
        return implode(' ', $parts);
    }

    /**
     * Obtiene la aspiración resumida
     */
    public function getShortAspirationAttribute(): string
    {
        $parts = [];
        
        if ($this->occupation) {
            $parts[] = $this->occupation;
        }
        
        if ($this->hours_per_week) {
            $parts[] = "({$this->hours_per_week}h/semana)";
        }
        
        return implode(' ', $parts);
    }

    /**
     * Verifica si es tiempo completo
     */
    public function isFullTime(): bool
    {
        return $this->hours_per_week >= 40;
    }

    /**
     * Verifica si es medio tiempo
     */
    public function isPartTime(): bool
    {
        return $this->hours_per_week > 0 && $this->hours_per_week < 40;
    }

    /**
     * Obtiene el tipo de trabajo basado en las horas
     */
    public function getWorkTypeAttribute(): string
    {
        if (!$this->hours_per_week) {
            return 'No especificado';
        }
        
        if ($this->hours_per_week >= 40) {
            return 'Tiempo Completo';
        } elseif ($this->hours_per_week >= 20) {
            return 'Medio Tiempo';
        } elseif ($this->hours_per_week > 0) {
            return 'Tiempo Parcial';
        } else {
            return 'No especificado';
        }
    }

    /**
     * Obtiene la disponibilidad formateada
     */
    public function getFormattedAvailabilityAttribute(): string
    {
        if (!$this->availability) {
            return 'No especificada';
        }
        
        $availability = $this->availability;
        
        // Formatear disponibilidad común
        $formatted = match(strtolower($availability)) {
            'full_time', 'tiempo_completo' => 'Tiempo Completo',
            'part_time', 'medio_tiempo' => 'Medio Tiempo',
            'flexible', 'flexible' => 'Flexible',
            'weekends', 'fines_semana' => 'Fines de Semana',
            'evenings', 'noches' => 'Noches',
            'mornings', 'mañanas' => 'Mañanas',
            default => ucfirst($availability),
        };
        
        return $formatted;
    }

    /**
     * Obtiene el rango de horas formateado
     */
    public function getFormattedHourRangeAttribute(): string
    {
        if (!$this->hour_range) {
            return 'No especificado';
        }
        
        return $this->hour_range;
    }

    /**
     * Obtiene información completa de la aspiración
     */
    public function getCompleteInfoAttribute(): array
    {
        return [
            'occupation' => $this->occupation,
            'work_type' => $this->work_type,
            'availability' => $this->formatted_availability,
            'hour_range' => $this->formatted_hour_range,
            'hours_per_week' => $this->hours_per_week,
            'is_full_time' => $this->isFullTime(),
            'is_part_time' => $this->isPartTime(),
        ];
    }
}

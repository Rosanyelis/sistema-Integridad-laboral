<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationalSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'career',
        'educational_center',
        'province',
        'year',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    /**
     * Relación con People (belongsTo)
     * Una habilidad educativa pertenece a una persona
     */
    public function person()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Scope para filtrar por carrera
     */
    public function scopeByCareer($query, string $career)
    {
        return $query->where('career', 'like', "%{$career}%");
    }

    /**
     * Scope para filtrar por centro educativo
     */
    public function scopeByEducationalCenter($query, string $center)
    {
        return $query->where('educational_center', 'like', "%{$center}%");
    }

    /**
     * Scope para filtrar por provincia
     */
    public function scopeByProvince($query, string $province)
    {
        return $query->where('province', $province);
    }

    /**
     * Scope para filtrar por año
     */
    public function scopeByYear($query, int $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Scope para filtrar por rango de años
     */
    public function scopeByYearRange($query, int $fromYear, int $toYear)
    {
        return $query->whereBetween('year', [$fromYear, $toYear]);
    }

    /**
     * Scope para filtrar graduaciones recientes (últimos 5 años)
     */
    public function scopeRecentGraduations($query)
    {
        $currentYear = date('Y');
        return $query->where('year', '>=', $currentYear - 5);
    }

    /**
     * Scope para filtrar graduaciones antiguas (más de 10 años)
     */
    public function scopeOldGraduations($query)
    {
        $currentYear = date('Y');
        return $query->where('year', '<', $currentYear - 10);
    }

    /**
     * Obtiene la información educativa formateada
     */
    public function getFormattedEducationAttribute(): string
    {
        $parts = [];
        
        if ($this->career) {
            $parts[] = $this->career;
        }
        
        if ($this->educational_center) {
            $parts[] = "en {$this->educational_center}";
        }
        
        if ($this->year) {
            $parts[] = "({$this->year})";
        }
        
        if ($this->province) {
            $parts[] = "- {$this->province}";
        }
        
        return implode(' ', $parts);
    }

    /**
     * Obtiene la información educativa resumida
     */
    public function getShortEducationAttribute(): string
    {
        $parts = [];
        
        if ($this->career) {
            $parts[] = $this->career;
        }
        
        if ($this->year) {
            $parts[] = "({$this->year})";
        }
        
        return implode(' ', $parts);
    }

    /**
     * Verifica si es una graduación reciente
     */
    public function isRecentGraduation(): bool
    {
        if (!$this->year) {
            return false;
        }
        
        $currentYear = date('Y');
        return ($currentYear - $this->year) <= 5;
    }

    /**
     * Obtiene los años desde la graduación
     */
    public function getYearsSinceGraduationAttribute(): ?int
    {
        if (!$this->year) {
            return null;
        }
        
        return date('Y') - $this->year;
    }

    /**
     * Obtiene el nivel de experiencia basado en los años de graduación
     */
    public function getExperienceLevelAttribute(): string
    {
        $years = $this->years_since_graduation;
        
        if ($years === null) {
            return 'Desconocido';
        }
        
        if ($years <= 2) {
            return 'Principiante';
        } elseif ($years <= 5) {
            return 'Intermedio';
        } elseif ($years <= 10) {
            return 'Avanzado';
        } else {
            return 'Experto';
        }
    }
}

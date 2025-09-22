<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'company_name',
        'position',
        'from_date',
        'to_date',
        'responsibilities',
        'achievements',
        'skills',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    /**
     * Relación con People (belongsTo)
     * Una experiencia laboral pertenece a una persona
     */
    public function person()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Scope para filtrar por empresa
     */
    public function scopeByCompany($query, string $company)
    {
        return $query->where('company_name', 'like', "%{$company}%");
    }

    /**
     * Scope para filtrar por posición
     */
    public function scopeByPosition($query, string $position)
    {
        return $query->where('position', 'like', "%{$position}%");
    }

    /**
     * Scope para filtrar por rango de fechas
     */
    public function scopeByDateRange($query, $fromDate, $toDate)
    {
        return $query->where(function ($q) use ($fromDate, $toDate) {
            $q->whereBetween('from_date', [$fromDate, $toDate])
              ->orWhereBetween('to_date', [$fromDate, $toDate])
              ->orWhere(function ($subQ) use ($fromDate, $toDate) {
                  $subQ->where('from_date', '<=', $fromDate)
                       ->where('to_date', '>=', $toDate);
              });
        });
    }

    /**
     * Scope para filtrar experiencias actuales (sin fecha de fin)
     */
    public function scopeCurrent($query)
    {
        return $query->whereNull('to_date');
    }

    /**
     * Scope para filtrar experiencias pasadas (con fecha de fin)
     */
    public function scopePast($query)
    {
        return $query->whereNotNull('to_date');
    }

    /**
     * Scope para filtrar experiencias recientes (últimos 5 años)
     */
    public function scopeRecent($query)
    {
        $fiveYearsAgo = Carbon::now()->subYears(5);
        return $query->where('from_date', '>=', $fiveYearsAgo);
    }

    /**
     * Scope para filtrar por duración mínima
     */
    public function scopeByMinimumDuration($query, int $months)
    {
        return $query->whereRaw("DATEDIFF(COALESCE(to_date, CURDATE()), from_date) >= ?", [$months * 30]);
    }

    /**
     * Obtiene la duración en meses
     */
    public function getDurationInMonthsAttribute(): int
    {
        $endDate = $this->to_date ?? Carbon::now();
        return $this->from_date->diffInMonths($endDate);
    }

    /**
     * Obtiene la duración formateada
     */
    public function getFormattedDurationAttribute(): string
    {
        $months = $this->duration_in_months;
        
        if ($months < 12) {
            return "{$months} mes" . ($months !== 1 ? 'es' : '');
        }
        
        $years = intval($months / 12);
        $remainingMonths = $months % 12;
        
        $result = "{$years} año" . ($years !== 1 ? 's' : '');
        
        if ($remainingMonths > 0) {
            $result .= " y {$remainingMonths} mes" . ($remainingMonths !== 1 ? 'es' : '');
        }
        
        return $result;
    }

    /**
     * Obtiene la experiencia laboral formateada
     */
    public function getFormattedExperienceAttribute(): string
    {
        $parts = [];
        
        if ($this->position) {
            $parts[] = $this->position;
        }
        
        if ($this->company_name) {
            $parts[] = "en {$this->company_name}";
        }
        
        if ($this->from_date) {
            $fromYear = $this->from_date->format('Y');
            $toYear = $this->to_date ? $this->to_date->format('Y') : 'Actual';
            $parts[] = "({$fromYear} - {$toYear})";
        }
        
        return implode(' ', $parts);
    }

    /**
     * Obtiene la experiencia laboral resumida
     */
    public function getShortExperienceAttribute(): string
    {
        $parts = [];
        
        if ($this->position) {
            $parts[] = $this->position;
        }
        
        if ($this->company_name) {
            $parts[] = "en {$this->company_name}";
        }
        
        return implode(' ', $parts);
    }

    /**
     * Verifica si es una experiencia actual
     */
    public function isCurrent(): bool
    {
        return is_null($this->to_date);
    }

    /**
     * Verifica si es una experiencia reciente
     */
    public function isRecent(): bool
    {
        if (!$this->from_date) {
            return false;
        }
        
        return $this->from_date->isAfter(Carbon::now()->subYears(5));
    }

    /**
     * Obtiene las habilidades como array
     */
    public function getSkillsArrayAttribute(): array
    {
        if (!$this->skills) {
            return [];
        }
        
        // Asumiendo que las habilidades están separadas por comas o saltos de línea
        $skills = preg_split('/[,\n\r]+/', $this->skills);
        return array_filter(array_map('trim', $skills));
    }

    /**
     * Obtiene las responsabilidades como array
     */
    public function getResponsibilitiesArrayAttribute(): array
    {
        if (!$this->responsibilities) {
            return [];
        }
        
        // Asumiendo que las responsabilidades están separadas por saltos de línea
        $responsibilities = preg_split('/[\n\r]+/', $this->responsibilities);
        return array_filter(array_map('trim', $responsibilities));
    }

    /**
     * Obtiene los logros como array
     */
    public function getAchievementsArrayAttribute(): array
    {
        if (!$this->achievements) {
            return [];
        }
        
        // Asumiendo que los logros están separados por saltos de línea
        $achievements = preg_split('/[\n\r]+/', $this->achievements);
        return array_filter(array_map('trim', $achievements));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidenceInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'province_id',
        'municipality_id',
        'sector_id',
        'residential_complex',
        'building',
        'apartment',
        'neighborhood',
        'street_and_number',
        'coordinates',
        'arrival_reference',
        'is_certified',
    ];

    protected $casts = [
        'is_certified' => 'boolean',
    ];

    /**
     * Relación con People (belongsTo)
     * Una información de residencia pertenece a una persona
     */
    public function person()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Relación con Province (belongsTo)
     * Una información de residencia pertenece a una provincia
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Relación con Municipality (belongsTo)
     * Una información de residencia pertenece a un municipio
     */
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    /**
     * Relación con Sector (belongsTo)
     * Una información de residencia pertenece a un sector
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * Scope para filtrar por provincia
     */
    public function scopeByProvince($query, int $provinceId)
    {
        return $query->where('province_id', $provinceId);
    }

    /**
     * Scope para filtrar por municipio
     */
    public function scopeByMunicipality($query, int $municipalityId)
    {
        return $query->where('municipality_id', $municipalityId);
    }

    /**
     * Scope para filtrar por sector
     */
    public function scopeBySector($query, int $sectorId)
    {
        return $query->where('sector_id', $sectorId);
    }

    /**
     * Scope para filtrar información certificada
     */
    public function scopeCertified($query)
    {
        return $query->where('is_certified', true);
    }

    /**
     * Scope para filtrar información no certificada
     */
    public function scopeNotCertified($query)
    {
        return $query->where('is_certified', false);
    }

    /**
     * Obtiene la dirección completa formateada
     */
    public function getFullAddressAttribute(): string
    {
        $addressParts = array_filter([
            $this->street_and_number,
            $this->neighborhood,
            $this->sector?->name,
            $this->municipality?->name,
            $this->province?->name,
        ]);

        return implode(', ', $addressParts);
    }

    /**
     * Obtiene la dirección resumida (solo sector y municipio)
     */
    public function getShortAddressAttribute(): string
    {
        $addressParts = array_filter([
            $this->sector?->name,
            $this->municipality?->name,
        ]);

        return implode(', ', $addressParts);
    }

    /**
     * Verifica si tiene coordenadas
     */
    public function hasCoordinates(): bool
    {
        return !empty($this->coordinates);
    }

    /**
     * Obtiene las coordenadas como array
     */
    public function getCoordinatesArrayAttribute(): ?array
    {
        if (!$this->coordinates) {
            return null;
        }

        // Asumiendo formato "lat,lng" o "lat,lng,alt"
        $coords = explode(',', $this->coordinates);
        
        if (count($coords) >= 2) {
            return [
                'latitude' => (float) trim($coords[0]),
                'longitude' => (float) trim($coords[1]),
                'altitude' => isset($coords[2]) ? (float) trim($coords[2]) : null,
            ];
        }

        return null;
    }
}
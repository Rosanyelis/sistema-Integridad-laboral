<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidenceInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'province',
        'municipality',
        'sector',
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
     * Scope para filtrar por provincia
     */
    public function scopeByProvince($query, string $province)
    {
        return $query->where('province', $province);
    }

    /**
     * Scope para filtrar por municipio
     */
    public function scopeByMunicipality($query, string $municipality)
    {
        return $query->where('municipality', $municipality);
    }

    /**
     * Scope para filtrar por sector
     */
    public function scopeBySector($query, string $sector)
    {
        return $query->where('sector', $sector);
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
            $this->sector,
            $this->municipality,
            $this->province,
        ]);

        return implode(', ', $addressParts);
    }

    /**
     * Obtiene la dirección resumida (solo sector y municipio)
     */
    public function getShortAddressAttribute(): string
    {
        $addressParts = array_filter([
            $this->sector,
            $this->municipality,
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
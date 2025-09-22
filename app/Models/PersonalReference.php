<?php

namespace App\Models;

use App\Enums\Relationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalReference extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'relationship',
        'full_name',
        'cedula',
        'cell_phone',
    ];

    protected $casts = [
        'relationship' => Relationship::class,
    ];

    /**
     * Relación con People (belongsTo)
     * Una referencia personal pertenece a una persona
     */
    public function person()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Obtiene el label de la relación
     */
    public function getRelationshipLabelAttribute(): ?string
    {
        return $this->relationship?->getLabel();
    }

    /**
     * Obtiene el icono de la relación
     */
    public function getRelationshipIconAttribute(): ?string
    {
        return $this->relationship?->getIcon();
    }

    /**
     * Obtiene la descripción de la relación
     */
    public function getRelationshipDescriptionAttribute(): ?string
    {
        return $this->relationship?->getDescription();
    }

    /**
     * Scope para filtrar por tipo de relación
     */
    public function scopeByRelationship($query, Relationship $relationship)
    {
        return $query->where('relationship', $relationship->value);
    }

    /**
     * Scope para filtrar relaciones familiares
     */
    public function scopeFamilyRelationships($query)
    {
        $familyValues = array_column(Relationship::getFamilyRelationships(), 'value');
        $extendedFamilyValues = array_column(Relationship::getExtendedFamilyRelationships(), 'value');
        $allFamilyValues = array_merge($familyValues, $extendedFamilyValues);
        
        return $query->whereIn('relationship', $allFamilyValues);
    }

    /**
     * Scope para filtrar relaciones no familiares
     */
    public function scopeNonFamilyRelationships($query)
    {
        $nonFamilyValues = array_column(Relationship::getNonFamilyRelationships(), 'value');
        return $query->whereIn('relationship', $nonFamilyValues);
    }

    /**
     * Scope para filtrar por cédula
     */
    public function scopeByCedula($query, string $cedula)
    {
        return $query->where('cedula', $cedula);
    }

    /**
     * Scope para buscar por nombre
     */
    public function scopeByName($query, string $name)
    {
        return $query->where('full_name', 'like', "%{$name}%");
    }

    /**
     * Verifica si es una relación familiar
     */
    public function isFamilyRelationship(): bool
    {
        return $this->relationship?->isFamilyRelationship() ?? false;
    }

    /**
     * Verifica si es una relación directa de familia
     */
    public function isDirectFamilyRelationship(): bool
    {
        return $this->relationship?->isDirectFamilyRelationship() ?? false;
    }

    /**
     * Obtiene el nombre completo formateado con icono
     */
    public function getFormattedNameAttribute(): string
    {
        $icon = $this->relationship_icon ?? '';
        $name = $this->full_name ?? 'Sin nombre';
        $relationship = $this->relationship_label ?? 'Sin relación';
        
        return "{$icon} {$name} ({$relationship})";
    }

    /**
     * Obtiene información de contacto formateada
     */
    public function getContactInfoAttribute(): string
    {
        $info = [];
        
        if ($this->cedula) {
            $info[] = "Cédula: {$this->cedula}";
        }
        
        if ($this->cell_phone) {
            $info[] = "Tel: {$this->cell_phone}";
        }
        
        return implode(' | ', $info);
    }
}
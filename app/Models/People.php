<?php

namespace App\Models;

use App\Enums\EmploymentStatus;
use App\Enums\MaritalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_photo',
        'code_unique',
        'code',
        'name',
        'last_name',
        'dni',
        'previous_dni',
        'country',
        'zip_code',
        'birth_place',
        'cell_phone',
        'home_phone',
        'email',
        'birth_date',
        'age',
        'marital_status',
        'social_media_1',
        'social_media_2',
        'position_applied_for',
        'blood_type',
        'company_code',
        'company_name',
        'medication_allergies',
        'illnesses',
        'emergency_contact_name',
        'emergency_contact_phone',
        'other_emergency_contacts',
        'employment_status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'marital_status' => MaritalStatus::class,
        'employment_status' => EmploymentStatus::class,
    ];

    /**
     * Obtiene el label del estado civil
     */
    public function getMaritalStatusLabelAttribute(): ?string
    {
        return $this->marital_status?->getLabel();
    }

    /**
     * Obtiene el label del estatus laboral
     */
    public function getEmploymentStatusLabelAttribute(): ?string
    {
        return $this->employment_status?->getLabel();
    }

    /**
     * Obtiene las opciones de estado civil para formularios
     */
    public static function getMaritalStatusOptions(): array
    {
        return MaritalStatus::getOptions();
    }

    /**
     * Obtiene las opciones de estatus laboral para formularios
     */
    public static function getEmploymentStatusOptions(): array
    {
        return EmploymentStatus::getOptions();
    }

    /**
     * Scope para filtrar por estado civil
     */
    public function scopeByMaritalStatus($query, MaritalStatus $status)
    {
        return $query->where('marital_status', $status->value);
    }

    /**
     * Scope para filtrar por estatus laboral
     */
    public function scopeByEmploymentStatus($query, EmploymentStatus $status)
    {
        return $query->where('employment_status', $status->value);
    }

    /**
     * Scope para filtrar por estatus activos
     */
    public function scopeActiveEmployment($query)
    {
        $activeStatuses = EmploymentStatus::getActiveStatuses();
        $values = array_column($activeStatuses, 'value');
        return $query->whereIn('employment_status', $values);
    }

    /**
     * Scope para filtrar por estatus de finalización
     */
    public function scopeTerminatedEmployment($query)
    {
        $terminationStatuses = EmploymentStatus::getTerminationStatuses();
        $values = array_column($terminationStatuses, 'value');
        return $query->whereIn('employment_status', $values);
    }

    /**
     * Relación con User (belongsTo)
     * Una persona puede tener un usuario asociado (opcional)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para filtrar personas con usuario asociado
     */
    public function scopeWithUser($query)
    {
        return $query->whereNotNull('user_id');
    }

    /**
     * Scope para filtrar personas sin usuario asociado
     */
    public function scopeWithoutUser($query)
    {
        return $query->whereNull('user_id');
    }

    /**
     * Verifica si la persona tiene un usuario asociado
     */
    public function hasUser(): bool
    {
        return !is_null($this->user_id);
    }

    /**
     * Obtiene el nombre completo del usuario asociado
     */
    public function getUserFullNameAttribute(): ?string
    {
        return $this->user ? $this->user->name : null;
    }

    /**
     * Relación con ResidenceInformation (hasOne)
     * Una persona puede tener una información de residencia
     */
    public function residenceInformation()
    {
        return $this->hasOne(ResidenceInformation::class);
    }

    /**
     * Relación con PersonalReference (hasMany)
     * Una persona puede tener múltiples referencias personales
     */
    public function personalReferences()
    {
        return $this->hasMany(PersonalReference::class);
    }

    /**
     * Relación con EducationalSkills (hasMany)
     * Una persona puede tener múltiples habilidades educativas
     */
    public function educationalSkills()
    {
        return $this->hasMany(EducationalSkills::class);
    }

    /**
     * Relación con WorkExperiences (hasMany)
     * Una persona puede tener múltiples experiencias laborales
     */
    public function workExperiences()
    {
        return $this->hasMany(WorkExperiences::class);
    }

    /**
     * Relación con Aspirations (hasOne)
     * Una persona puede tener una aspiración laboral
     */
    public function aspirations()
    {
        return $this->hasOne(Aspirations::class);
    }

    /**
     * Scope para filtrar personas con información de residencia
     */
    public function scopeWithResidenceInformation($query)
    {
        return $query->whereHas('residenceInformation');
    }

    /**
     * Scope para filtrar personas con referencias personales
     */
    public function scopeWithPersonalReferences($query)
    {
        return $query->whereHas('personalReferences');
    }

    /**
     * Scope para filtrar personas con habilidades educativas
     */
    public function scopeWithEducationalSkills($query)
    {
        return $query->whereHas('educationalSkills');
    }

    /**
     * Scope para filtrar personas con experiencias laborales
     */
    public function scopeWithWorkExperiences($query)
    {
        return $query->whereHas('workExperiences');
    }

    /**
     * Scope para filtrar personas con aspiraciones
     */
    public function scopeWithAspirations($query)
    {
        return $query->whereHas('aspirations');
    }

    /**
     * Obtiene el perfil completo de la persona
     */
    public function getCompleteProfileAttribute(): array
    {
        return [
            'person' => $this,
            'residence_information' => $this->residenceInformation,
            'personal_references' => $this->personalReferences,
            'educational_skills' => $this->educationalSkills,
            'work_experiences' => $this->workExperiences,
            'aspirations' => $this->aspirations,
            'user' => $this->user,
        ];
    }

    /**
     * Verifica si la persona tiene perfil completo
     */
    public function hasCompleteProfile(): bool
    {
        return $this->residenceInformation !== null &&
               $this->personalReferences()->count() > 0 &&
               $this->educationalSkills()->count() > 0 &&
               $this->workExperiences()->count() > 0 &&
               $this->aspirations !== null;
    }

    /**
     * Obtiene el porcentaje de completitud del perfil
     */
    public function getProfileCompletenessAttribute(): int
    {
        $totalSections = 5; // residence, references, education, work, aspirations
        $completedSections = 0;

        if ($this->residenceInformation) $completedSections++;
        if ($this->personalReferences()->count() > 0) $completedSections++;
        if ($this->educationalSkills()->count() > 0) $completedSections++;
        if ($this->workExperiences()->count() > 0) $completedSections++;
        if ($this->aspirations) $completedSections++;

        return round(($completedSections / $totalSections) * 100);
    }
}
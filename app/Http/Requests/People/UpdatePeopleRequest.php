<?php

namespace App\Http\Requests\People;

use App\Enums\MaritalStatus;
use App\Enums\EmploymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $personId = $this->route('id') ?? $this->route('person');

        return [
            // Datos de Identificación
            'code_unique' => [
                'nullable',
                'string',
                'max:255'
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'dni' => [
                'required',
                'string',
                'max:255',
                Rule::unique('people', 'dni')->ignore($personId),
                'regex:/^\d{3}-\d{7}-\d{1}$/'
            ],
            'previous_dni' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^\d{3}-\d{7}-\d{1}$/'
            ],

            // Información Personal
            'birth_date' => [
                'required',
                'date',
                'before:today',
                'after:1900-01-01'
            ],
            'age' => [
                'nullable',
                'integer',
                'min:0',
                'max:150'
            ],
            'marital_status' => [
                'nullable',
                'string',
                Rule::in(array_keys(MaritalStatus::getOptions()))
            ],

            // Información de Contacto
            'zip_code' => [
                'nullable',
                'string',
                'max:20'
            ],
            'cell_phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}-\d{3}-\d{4}$/'
            ],
            'home_phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^\d{4}-\d{3}-\d{4}$/'
            ],

            // Contacto Electrónico y Redes Sociales
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('people', 'email')->ignore($personId)
            ],
            'social_media_1' => [
                'nullable',
                'string',
                'max:255'
            ],
            'social_media_2' => [
                'nullable',
                'string',
                'max:255'
            ],

            // Información de Salud
            'blood_type' => [
                'nullable',
                'string',
                'max:10'
            ],
            'medication_allergies' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'illnesses' => [
                'nullable',
                'string',
                'max:1000'
            ],

            // Contactos de Emergencia
            'emergency_contact_name' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'emergency_contact_phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^\d{4}-\d{3}-\d{4}$/'
            ],
            'other_emergency_contacts' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Datos de Identificación
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'last_name.required' => 'Los apellidos son obligatorios.',
            'last_name.min' => 'Los apellidos deben tener al menos 2 caracteres.',
            'dni.required' => 'La cédula es obligatoria.',
            'dni.unique' => 'La cédula ya está registrada.',
            'dni.regex' => 'La cédula debe tener el formato 000-0000000-0.',
            'previous_dni.regex' => 'La cédula anterior debe tener el formato 000-0000000-0.',

            // Información Personal
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'birth_date.after' => 'La fecha de nacimiento debe ser posterior a 1900.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser menor a 0.',
            'age.max' => 'La edad no puede ser mayor a 150.',
            'marital_status.in' => 'El estado civil seleccionado no es válido.',

            // Información de Contacto
            'cell_phone.required' => 'El teléfono celular es obligatorio.',
            'cell_phone.regex' => 'El teléfono celular debe tener el formato 0000-000-0000.',
            'home_phone.regex' => 'El teléfono fijo debe tener el formato 0000-000-0000.',

            // Contacto Electrónico
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            // Contactos de Emergencia
            'emergency_contact_name.required' => 'El nombre del contacto de emergencia es obligatorio.',
            'emergency_contact_name.min' => 'El nombre del contacto de emergencia debe tener al menos 2 caracteres.',
            'emergency_contact_phone.required' => 'El teléfono de emergencia es obligatorio.',
            'emergency_contact_phone.regex' => 'El teléfono de emergencia debe tener el formato 0000-000-0000.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'code_unique' => 'código único',
            'name' => 'nombre',
            'last_name' => 'apellidos',
            'dni' => 'cédula',
            'previous_dni' => 'cédula anterior',
            'birth_date' => 'fecha de nacimiento',
            'age' => 'edad',
            'marital_status' => 'estado civil',
            'cell_phone' => 'teléfono celular',
            'home_phone' => 'teléfono fijo',
            'email' => 'correo electrónico',
            'social_media_1' => 'red social 1',
            'social_media_2' => 'red social 2',
            'blood_type' => 'tipo de sangre',
            'medication_allergies' => 'alergias a medicamentos',
            'illnesses' => 'enfermedades',
            'emergency_contact_name' => 'nombre del contacto de emergencia',
            'emergency_contact_phone' => 'teléfono de emergencia',
            'other_emergency_contacts' => 'otros contactos de emergencia',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Limpiar y formatear datos antes de la validación
        $this->merge([
            'name' => trim($this->name),
            'last_name' => trim($this->last_name),
            // Mantener el formato de cédula con guiones
            'dni' => $this->dni,
            'previous_dni' => $this->previous_dni,
            // Mantener el formato de teléfono con guiones
            'cell_phone' => $this->cell_phone,
            'home_phone' => $this->home_phone,
            'emergency_contact_phone' => $this->emergency_contact_phone,
            'blood_type' => $this->blood_type ? strtoupper(trim($this->blood_type)) : null,
        ]);
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validar que la edad coincida con la fecha de nacimiento si se proporciona
            if ($this->birth_date && $this->age) {
                $birthDate = new \DateTime($this->birth_date);
                $today = new \DateTime();
                $calculatedAge = $today->diff($birthDate)->y;
                
                if ($this->age != $calculatedAge) {
                    $validator->errors()->add('age', 'La edad no coincide con la fecha de nacimiento.');
                }
            }
        });
    }
}

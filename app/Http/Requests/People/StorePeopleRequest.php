<?php

namespace App\Http\Requests\People;

use App\Enums\MaritalStatus;
use App\Enums\EmploymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePeopleRequest extends FormRequest
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
        return [
            // Datos de Identificación
            'code' => [
                'required',
                'string',
                'max:255',
                'unique:people,code'
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
                'unique:people,dni',
                'regex:/^[0-9]{7,10}$/'
            ],
            'previous_dni' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[0-9]{7,10}$/'
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
            'birth_place' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'country' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],

            // Información de Contacto
            'zip_code' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9]{4,6}$/'
            ],
            'cell_phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s()]{7,20}$/'
            ],
            'home_phone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s()]{7,20}$/'
            ],

            // Contacto Electrónico y Redes Sociales
            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:people,email'
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

            // Aspiración Laboral y Empleo Actual
            'position_applied_for' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'blood_type' => [
                'nullable',
                'string',
                'max:10',
                'regex:/^(A|B|AB|O)[+-]$/i'
            ],
            'company_code' => [
                'nullable',
                'string',
                'max:50'
            ],
            'company_name' => [
                'nullable',
                'string',
                'max:255'
            ],

            // Información de Salud
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
                'regex:/^[0-9+\-\s()]{7,20}$/'
            ],
            'other_emergency_contacts' => [
                'nullable',
                'string',
                'max:1000'
            ],

            // Estado Laboral
            'employment_status' => [
                'required',
                'string',
                Rule::in(array_keys(EmploymentStatus::getOptions()))
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
            'code.required' => 'El código es obligatorio.',
            'code.unique' => 'El código ya está en uso.',
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'last_name.required' => 'Los apellidos son obligatorios.',
            'last_name.min' => 'Los apellidos deben tener al menos 2 caracteres.',
            'dni.required' => 'La cédula es obligatoria.',
            'dni.unique' => 'La cédula ya está registrada.',
            'dni.regex' => 'La cédula debe contener entre 7 y 10 dígitos.',
            'previous_dni.regex' => 'La cédula anterior debe contener entre 7 y 10 dígitos.',

            // Información Personal
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'birth_date.after' => 'La fecha de nacimiento debe ser posterior a 1900.',
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser menor a 0.',
            'age.max' => 'La edad no puede ser mayor a 150.',
            'marital_status.in' => 'El estado civil seleccionado no es válido.',
            'birth_place.required' => 'El lugar de nacimiento es obligatorio.',
            'birth_place.min' => 'El lugar de nacimiento debe tener al menos 2 caracteres.',
            'country.required' => 'El país es obligatorio.',
            'country.min' => 'El país debe tener al menos 2 caracteres.',

            // Información de Contacto
            'zip_code.regex' => 'El código postal debe contener entre 4 y 6 dígitos.',
            'cell_phone.required' => 'El teléfono celular es obligatorio.',
            'cell_phone.regex' => 'El formato del teléfono celular no es válido.',
            'home_phone.regex' => 'El formato del teléfono fijo no es válido.',

            // Contacto Electrónico
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            // Aspiración Laboral
            'position_applied_for.required' => 'El cargo que aspira es obligatorio.',
            'position_applied_for.min' => 'El cargo que aspira debe tener al menos 2 caracteres.',
            'blood_type.regex' => 'El tipo de sangre debe tener un formato válido (ej: A+, B-, AB+, O-).',

            // Contactos de Emergencia
            'emergency_contact_name.required' => 'El nombre del contacto de emergencia es obligatorio.',
            'emergency_contact_name.min' => 'El nombre del contacto de emergencia debe tener al menos 2 caracteres.',
            'emergency_contact_phone.required' => 'El teléfono de emergencia es obligatorio.',
            'emergency_contact_phone.regex' => 'El formato del teléfono de emergencia no es válido.',

            // Estado Laboral
            'employment_status.required' => 'El estado laboral es obligatorio.',
            'employment_status.in' => 'El estado laboral seleccionado no es válido.',
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
            'code' => 'código',
            'name' => 'nombre',
            'last_name' => 'apellidos',
            'dni' => 'cédula',
            'previous_dni' => 'cédula anterior',
            'birth_date' => 'fecha de nacimiento',
            'age' => 'edad',
            'marital_status' => 'estado civil',
            'birth_place' => 'lugar de nacimiento',
            'country' => 'país',
            'zip_code' => 'código postal',
            'cell_phone' => 'teléfono celular',
            'home_phone' => 'teléfono fijo',
            'email' => 'correo electrónico',
            'social_media_1' => 'red social 1',
            'social_media_2' => 'red social 2',
            'position_applied_for' => 'cargo que aspira',
            'blood_type' => 'tipo de sangre',
            'company_code' => 'código de empresa',
            'company_name' => 'nombre de empresa',
            'medication_allergies' => 'alergias a medicamentos',
            'illnesses' => 'enfermedades',
            'emergency_contact_name' => 'nombre del contacto de emergencia',
            'emergency_contact_phone' => 'teléfono de emergencia',
            'other_emergency_contacts' => 'otros contactos de emergencia',
            'employment_status' => 'estado laboral',
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
            'dni' => preg_replace('/[^0-9]/', '', $this->dni),
            'previous_dni' => $this->previous_dni ? preg_replace('/[^0-9]/', '', $this->previous_dni) : null,
            'cell_phone' => preg_replace('/[^0-9+\-\s()]/', '', $this->cell_phone),
            'home_phone' => $this->home_phone ? preg_replace('/[^0-9+\-\s()]/', '', $this->home_phone) : null,
            'emergency_contact_phone' => preg_replace('/[^0-9+\-\s()]/', '', $this->emergency_contact_phone),
            'zip_code' => $this->zip_code ? preg_replace('/[^0-9]/', '', $this->zip_code) : null,
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

            // Validar que al menos un teléfono esté presente
            if (empty($this->cell_phone) && empty($this->home_phone)) {
                $validator->errors()->add('cell_phone', 'Debe proporcionar al menos un número de teléfono.');
            }
        });
    }
}

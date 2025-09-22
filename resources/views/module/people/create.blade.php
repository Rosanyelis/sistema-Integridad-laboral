@extends('layouts/contentNavbarLayout')

@section('title', 'Crear Personal')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
<script src="{{asset('assets/js/forms-pickers.js')}}"></script>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Crear Personal</h5>
        <a href="{{ route('people.index') }}" class="btn btn-outline-secondary">
          <i class="icon-base ti tabler-arrow-left me-1"></i>
          Volver
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('people.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <!-- Sección 1: Identificación y Datos Básicos -->
          <div class="row mb-4">
            <div class="col-12">
              <h6>1. Datos de Identificación</h6>
              <hr class="mt-0">
            </div>
            <div class="col-md-2 mb-3">
              <label for="code" class="form-label">*CÓDIGO</label>
              <input type="text" class="form-control @error('code') is-invalid @enderror" 
                     id="code" name="code" value="{{ old('code') }}" >
              @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="name" class="form-label">*NOMBRE(S)</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name') }}" >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="last_name" class="form-label">*APELLIDOS</label>
              <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                     id="last_name" name="last_name" value="{{ old('last_name') }}" >
              @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="dni" class="form-label">*CÉDULA</label>
              <input type="text" class="form-control @error('dni') is-invalid @enderror" 
                     id="dni" name="dni" value="{{ old('dni') }}" >
              @error('dni')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="previous_dni" class="form-label">CÉDULA ANT.</label>
              <input type="text" class="form-control @error('previous_dni') is-invalid @enderror" 
                     id="previous_dni" name="previous_dni" value="{{ old('previous_dni') }}">
              @error('previous_dni')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="birth_date" class="form-label">*FECHA NAC</label>
              <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                     id="birth_date" name="birth_date" value="{{ old('birth_date') }}" >
              @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="age" class="form-label">EDAD</label>
              <input type="number" class="form-control @error('age') is-invalid @enderror" 
                     id="age" name="age" value="{{ old('age') }}" readonly>
              @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="marital_status" class="form-label">ESTADO CIVIL</label>
              <select class="form-select @error('marital_status') is-invalid @enderror" 
                      id="marital_status" name="marital_status">
                <option value="">Seleccionar Estado Civil</option>
                @foreach(\App\Enums\MaritalStatus::getOptions() as $value => $label)
                  <option value="{{ $value }}" {{ old('marital_status') == $value ? 'selected' : '' }}>
                    {{ $label }}
                  </option>
                @endforeach
              </select>
              @error('marital_status')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="birth_place" class="form-label">*LUGAR DE NACIMIENTO</label>
              <input type="text" class="form-control @error('birth_place') is-invalid @enderror" 
                     id="birth_place" name="birth_place" value="{{ old('birth_place') }}" >
              @error('birth_place')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="country" class="form-label">*PAÍS</label>
              <input type="text" class="form-control @error('country') is-invalid @enderror" 
                     id="country" name="country" value="{{ old('country') }}" >
              @error('country')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip_code" class="form-label">COD. POSTAL</label>
              <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                     id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
              @error('zip_code')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="cell_phone" class="form-label">*TELÉFONO CELULAR</label>
              <input type="text" class="form-control @error('cell_phone') is-invalid @enderror" 
                      id="cell_phone" name="cell_phone" value="{{ old('cell_phone') }}" >
              @error('cell_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="home_phone" class="form-label">TELÉFONO FIJO</label>
              <input type="text" class="form-control @error('home_phone') is-invalid @enderror" 
                      id="home_phone" name="home_phone" value="{{ old('home_phone') }}">
              @error('home_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="email" class="form-label">CORREO ELECTRÓNICO</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" 
                     id="email" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="social_media_1" class="form-label">RED SOCIAL 1</label>
              <input type="text" class="form-control @error('social_media_1') is-invalid @enderror" 
                     id="social_media_1" name="social_media_1" value="{{ old('social_media_1') }}">
              @error('social_media_1')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="social_media_2" class="form-label">RED SOCIAL 2</label>
              <input type="text" class="form-control @error('social_media_2') is-invalid @enderror" 
                     id="social_media_2" name="social_media_2" value="{{ old('social_media_2') }}">
              @error('social_media_2')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Sección 5: Aspiración Laboral y Empleo Actual -->
          <div class="row mb-4">
            <div class="col-12">
              <h6>2. Aspiración Laboral y Empleo Actual</h6>
              <hr class="mt-0">
            </div>
            <div class="col-md-4 mb-3">
              <label for="position_applied_for" class="form-label">*CARGO QUE ASPIRA</label>
              <input type="text" class="form-control @error('position_applied_for') is-invalid @enderror" 
                     id="position_applied_for" name="position_applied_for" value="{{ old('position_applied_for') }}" >
                <div id="defaultFormControlHelp" class="form-text">En caso de no aspirar, poner "No aplica"</div>
              @error('position_applied_for')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="company_code" class="form-label">CÓDIGO EMPRESA</label>
              <input type="text" class="form-control @error('company_code') is-invalid @enderror" 
                     id="company_code" name="company_code" value="{{ old('company_code') }}">
              @error('company_code')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="company_name" class="form-label">NOMBRE EMPRESA</label>
              <input type="text" class="form-control @error('company_name') is-invalid @enderror" 
                     id="company_name" name="company_name" value="{{ old('company_name') }}">
              @error('company_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Sección 6: Información de Salud -->
          <div class="row mb-4">
            <div class="col-12">
              <h6>3. Información de Salud</h6>
              <hr class="mt-0">
            </div>
            <div class="col-md-4 mb-3">
              <label for="blood_type" class="form-label">TIPO DE SANGRE</label>
              <input type="text" class="form-control @error('blood_type') is-invalid @enderror" 
                     id="blood_type" name="blood_type" value="{{ old('blood_type') }}">
              @error('blood_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="medication_allergies" class="form-label">ALÉRGICO A MEDICAMENTO</label>
              <input type="text" class="form-control @error('medication_allergies') is-invalid @enderror" 
                        id="medication_allergies" name="medication_allergies" value="{{ old('medication_allergies') }}">
              @error('medication_allergies')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="illnesses" class="form-label">ENFERMEDADES QUE PADECE</label>
              <input type="text" class="form-control @error('illnesses') is-invalid @enderror" 
                        id="illnesses" name="illnesses" value="{{ old('illnesses') }}">
              @error('illnesses')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Sección 7: Contactos de Emergencia -->
          <div class="row mb-4">
            <div class="col-12">
              <h6>4. Contactos de Emergencia</h6>
              <hr class="mt-0">
            </div>
            <div class="col-md-4 mb-3">
              <label for="emergency_contact_name" class="form-label">*NOMBRE CONTACTO EMERGENCIA</label>
              <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" 
                     id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" >
              @error('emergency_contact_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="emergency_contact_phone" class="form-label">*TELÉFONO EMERGENCIA</label>
              <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror" 
                     id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" >
              @error('emergency_contact_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="other_emergency_contacts" class="form-label">OTROS CONTACTOS DE EMERGENCIA</label>
              <input type="text" class="form-control @error('other_emergency_contacts') is-invalid @enderror" 
                        id="other_emergency_contacts" name="other_emergency_contacts" value="{{ old('other_emergency_contacts') }}">
              @error('other_emergency_contacts')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12">
              <h6>5. Estado Laboral</h6>
              <hr class="mt-0">
            </div>
            <div class="col-md-12 mb-3">
              <label for="employment_status" class="form-label">*ESTADO LABORAL</label>
              <div class="flex flex-wrap gap-2">
              @foreach(\App\Enums\EmploymentStatus::getOptions() as $value => $label)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="{{ $value }}" id="employment_status" name="employment_status" {{ old('employment_status') == $value ? 'checked' : '' }}>
                <label class="form-check-label" for="employment_status"> {{ $label }} </label>
              </div>
              @endforeach
              </div>
              @error('employment_status')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <!-- Botones de Acción -->
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('people.index') }}" class="btn btn-outline-secondary">
                  <i class="icon-base ti tabler-x me-1"></i>
                  Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                  <i class="icon-base ti tabler-check me-1"></i>
                  Guardar Personal
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Calcular edad automáticamente
  const birthDateInput = document.getElementById('birth_date');
  const ageInput = document.getElementById('age');
  
  birthDateInput.addEventListener('change', function() {
    if (this.value) {
      const birthDate = new Date(this.value);
      const today = new Date();
      let age = today.getFullYear() - birthDate.getFullYear();
      const monthDiff = today.getMonth() - birthDate.getMonth();
      
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
      }
      
      ageInput.value = age;
    } else {
      ageInput.value = '';
    }
  });

  // Funcionalidad para agregar teléfonos adicionales (placeholder)
  document.getElementById('addCellPhone').addEventListener('click', function() {
    // Aquí se puede implementar la funcionalidad para agregar múltiples teléfonos
    console.log('Agregar teléfono celular adicional');
  });

  document.getElementById('addHomePhone').addEventListener('click', function() {
    // Aquí se puede implementar la funcionalidad para agregar múltiples teléfonos
    console.log('Agregar teléfono fijo adicional');
  });
});
</script>
@endsection

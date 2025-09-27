@extends('layouts/contentNavbarLayout')

@section('title', 'Crear Personal')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/select2/select2.scss', 
  'resources/assets/vendor/libs/@form-validation/form-validation.scss', 
  'resources/assets/vendor/libs/animate-css/animate.scss', 
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/select2/select2.js', 
  'resources/assets/vendor/libs/@form-validation/popular.js', 
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 
  'resources/assets/vendor/libs/@form-validation/auto-focus.js', 
  'resources/assets/vendor/libs/cleave-zen/cleave-zen.js', 
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/pages-account-settings-account.js',
  'resources/assets/js/forms-selects.js',
  'resources/js/people-create.js'
])
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-uppercase">Crear Personal</h5>
        <a href="{{ route('people.index') }}" class="btn btn-outline-secondary text-uppercase">
          <i class="icon-base ti tabler-arrow-left me-1"></i>
          Volver
        </a>
      </div>
      <div class="card-body">
        <form id="formAccountSettings" action="{{ route('people.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="border border-primary bg-primary rounded-3 py-2 px-3 mb-4">
            <h6 class="text-uppercase text-white m-0">1. Datos de Identificación</h6>
          </div>
          <!-- Sección 1: Identificación y Datos Básicos -->
          <div class="row">
            
            <div class="col-md-3 mb-3">
              <label for="name" class="form-label">*NOMBRE(S)</label>
              <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name') }}" >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="last_name" class="form-label">*APELLIDOS</label>
              <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" 
                     id="last_name" name="last_name" value="{{ old('last_name') }}" >
              @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="dni" class="form-label">*CÉDULA</label>
              <input type="text" class="form-control form-control-sm @error('dni') is-invalid @enderror" 
                     id="dni" name="dni" value="{{ old('dni') }}" >
              @error('dni')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="previous_dni" class="form-label">CÉDULA ANTERIOR</label>
              <input type="text" class="form-control form-control-sm @error('previous_dni') is-invalid @enderror" 
                     id="previous_dni" name="previous_dni" value="{{ old('previous_dni') }}">
              @error('previous_dni')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="birth_date" class="form-label">*FECHA NAC</label>
              <input type="date" class="form-control form-control-sm @error('birth_date') is-invalid @enderror" 
              id="birth_date" name="birth_date" value="{{ old('birth_date') }}" >
              @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-1 mb-3">
              <label for="age" class="form-label">EDAD</label>
              <input type="number" class="form-control form-control-sm @error('age') is-invalid @enderror" 
                     id="age" name="age" value="{{ old('age') }}" readonly>
              @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="marital_status" class="form-label">ESTADO CIVIL</label>
              <select class="form-select form-select-sm @error('marital_status') is-invalid @enderror" 
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
            <div class="col-md-2 mb-3">
              <label for="cell_phone" class="form-label">*TELÉFONO CELULAR</label>
              <input type="text" class="form-control form-control-sm @error('cell_phone') is-invalid @enderror" 
                      id="cell_phone" name="cell_phone" value="{{ old('cell_phone') }}" >
              @error('cell_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="home_phone" class="form-label">TELÉFONO FIJO</label>
              <input type="text" class="form-control form-control-sm @error('home_phone') is-invalid @enderror" 
                      id="home_phone" name="home_phone" value="{{ old('home_phone') }}">
              @error('home_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="email" class="form-label">CORREO ELECTRÓNICO</label>
              <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" 
                     id="email" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="social_media_1" class="form-label">RED SOCIAL 1</label>
              <input type="text" class="form-control form-control-sm @error('social_media_1') is-invalid @enderror" 
                     id="social_media_1" name="social_media_1" value="{{ old('social_media_1') }}">
              @error('social_media_1')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="social_media_2" class="form-label">RED SOCIAL 2</label>
              <input type="text" class="form-control form-control-sm @error('social_media_2') is-invalid @enderror" 
                     id="social_media_2" name="social_media_2" value="{{ old('social_media_2') }}">
              @error('social_media_2')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="border border-primary bg-primary rounded-3 py-2 px-3 mb-4">
            <h6 class="text-uppercase text-white m-0">2. Información de Residencia</h6>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="birth_place" class="form-label">*LUGAR DE NACIMIENTO</label>
              <input type="text" class="form-control form-control-sm @error('birth_place') is-invalid @enderror" 
                     id="birth_place" name="birth_place" value="{{ old('birth_place') }}" >
              @error('birth_place')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-1 mb-3">
              <label for="zip_code" class="form-label">COD. POSTAL</label>
              <input type="text" class="form-control form-control-sm @error('zip_code') is-invalid @enderror" 
                     id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
              @error('zip_code')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="country" class="form-label">*PAÍS</label>
              <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" 
                     id="country" name="country" value="{{ old('country') }}" >
              @error('country')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="province_id" class="form-label">*PROVINCIA</label>
              <select class="form-select form-select-sm select2 @error('province_id') is-invalid @enderror" 
                      id="province_id" name="province_id">
                <option value="">Seleccionar Provincia</option>
                @foreach(\App\Models\Province::all() as $province)
                  <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>
                    {{ $province->name }}
                  </option>
                @endforeach
              </select>
              @error('province_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="municipality_id" class="form-label">*MUNICIPIO</label>
              <select class="form-select form-select-sm select2 @error('municipality_id') is-invalid @enderror" 
                      id="municipality_id" name="municipality_id">
                <option value="">Seleccionar Municipio</option>
                
              </select>
              @error('municipality_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="sector_id" class="form-label">SECTOR</label>
              <select class="form-select form-select-sm select2 @error('sector_id') is-invalid @enderror" 
                      id="sector_id" name="sector_id">
                <option value="">Seleccionar Sector</option>
              </select>
              @error('sector_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="residential_complex" class="form-label">RESIDENCIAL</label>
              <input type="text" class="form-control form-control-sm @error('residential_complex') is-invalid @enderror" 
                     id="residential_complex" name="residential_complex" value="{{ old('residential_complex') }}">
              @error('residential_complex')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="building" class="form-label">EDIFICIO</label>
              <input type="text" class="form-control form-control-sm @error('building') is-invalid @enderror" 
                     id="building" name="building" value="{{ old('building') }}">
              @error('building')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="apartment" class="form-label">APARTAMENTO</label>
              <input type="text" class="form-control form-control-sm @error('apartment') is-invalid @enderror" 
                     id="apartment" name="apartment" value="{{ old('apartment') }}">
              @error('apartment')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="neighborhood" class="form-label">BARRIO</label>
              <input type="text" class="form-control form-control-sm @error('neighborhood') is-invalid @enderror" 
                     id="neighborhood" name="neighborhood" value="{{ old('neighborhood') }}">
              @error('neighborhood')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="street_and_number" class="form-label">CALLE Y NÚMERO</label>
              <input type="text" class="form-control form-control-sm @error('street_and_number') is-invalid @enderror" 
                     id="street_and_number" name="street_and_number" value="{{ old('street_and_number') }}">
              @error('street_and_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="coordinates" class="form-label">COORDENADA</label>
              <input type="text" class="form-control form-control-sm @error('coordinates') is-invalid @enderror" 
                     id="coordinates" name="coordinates" value="{{ old('coordinates') }}">
              @error('coordinates')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-5 mb-3">
              <label for="arrival_reference" class="form-label">REFERENCIA DE LLEGADA</label>
              <input type="text" class="form-control form-control-sm @error('arrival_reference') is-invalid @enderror" 
                     id="arrival_reference" name="arrival_reference" value="{{ old('arrival_reference') }}">
              @error('arrival_reference')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="border border-primary bg-primary rounded-3 py-2 px-3 mb-4">
            <h6 class="text-uppercase text-white m-0">3. Información de Seguridad y Emergencia</h6>
          </div>
          <div class="row">
            <div class="col-md-1 mb-3">
              <label for="blood_type" class="form-label">TIPO SANGRE</label>
              <input type="text" class="form-control form-control-sm @error('blood_type') is-invalid @enderror" 
                     id="blood_type" name="blood_type" value="{{ old('blood_type') }}">
              @error('blood_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="medication_allergies" class="form-label">ALÉRGICO A MEDICAMENTO</label>
              <input type="text" class="form-control form-control-sm @error('medication_allergies') is-invalid @enderror" 
                        id="medication_allergies" name="medication_allergies" value="{{ old('medication_allergies') }}">
              @error('medication_allergies')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="illnesses" class="form-label">ENFERMEDADES QUE PADECE</label>
              <input type="text" class="form-control form-control-sm @error('illnesses') is-invalid @enderror" 
                        id="illnesses" name="illnesses" value="{{ old('illnesses') }}">
              @error('illnesses')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="emergency_contact_name" class="form-label">*NOMBRE CONTACTO EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('emergency_contact_name') is-invalid @enderror" 
                     id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" >
              @error('emergency_contact_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="emergency_contact_phone" class="form-label">*TELÉFONO EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('emergency_contact_phone') is-invalid @enderror" 
                     id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" >
              @error('emergency_contact_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="other_emergency_contacts" class="form-label">OTROS CONTACTOS DE EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('other_emergency_contacts') is-invalid @enderror" 
                        id="other_emergency_contacts" name="other_emergency_contacts" value="{{ old('other_emergency_contacts') }}">
              @error('other_emergency_contacts')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
          </div>

          <!-- Botones de Acción -->
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('people.index') }}" class="btn btn-outline-secondary text-uppercase">
                  <i class="icon-base ti tabler-x me-1"></i>
                  Cancelar
                </a>
                <button type="submit" class="btn btn-primary text-uppercase">
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


@endsection

@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Perfil de la persona')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/select2/select2.scss', 
  'resources/assets/vendor/libs/@form-validation/form-validation.scss', 
  'resources/assets/vendor/libs/animate-css/animate.scss', 
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
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

<!-- Page Scripts -->
@section('page-script')
@vite([
  'resources/assets/js/pages-account-settings-account.js',
  'resources/js/info-people.js'
])
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <!-- Header con botones de acción -->
    <div class="card mb-6">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="mb-0 text-uppercase"><strong>{{ $person->name }} {{ $person->last_name }}</strong></h4>
          <div class="d-flex gap-2">
            <a href="{{ route('people.index') }}" class="btn btn-outline-secondary text-uppercase btn-sm">
              <i class="icon-base ti tabler-arrow-left me-1"></i>
              Volver
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-12">
    @include('module.people.partials.nav-show')
    <div class="card mb-6">
      <!-- Account -->
      <form id="formAccountSettings" action="{{ route('people.update', $person->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-6">
            @if ($person->profile_photo)
              <img src="{{ asset('storage/' . $person->profile_photo) }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
            @else
              <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
            @endif
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Subir foto del candidato</span>
                <i class="icon-base ti tabler-upload d-block d-sm-none"></i>
                <input type="file" id="upload" class="account-file-input" name="profile_photo" hidden accept="image/png, image/jpeg" />
              </label>
              <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                <i class="icon-base ti tabler-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Resetear</span>
              </button>

              <div>Permitido JPG, GIF o PNG. Tamaño máximo de 800K</div>
            </div>
          </div>
        </div>
        <div class="card-body pt-4">
          <div class="row">
            <div class="col-md-2 mb-3">
              <label for="name" class="form-label">CODIGO ÚNICO</label>
              <input type="text" class="form-control form-control-sm @error('code_unique') is-invalid @enderror" 
                     id="code_unique" name="code_unique" value="{{ old('code_unique', $person->code_unique) }}" disabled>
            </div>
            <div class="col-md-3 mb-3">
              <label for="name" class="form-label">*NOMBRE(S)</label>
              <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name', $person->name) }}" >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="last_name" class="form-label">*APELLIDOS</label>
              <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" 
                     id="last_name" name="last_name" value="{{ old('last_name', $person->last_name) }}" >
              @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="dni" class="form-label">*CÉDULA</label>
              <input type="text" class="form-control form-control-sm @error('dni') is-invalid @enderror" 
                     id="dni" name="dni" value="{{ old('dni', $person->dni) }}" >
              @error('dni')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="previous_dni" class="form-label">CÉDULA ANTERIOR</label>
              <input type="text" class="form-control form-control-sm @error('previous_dni') is-invalid @enderror" 
                     id="previous_dni" name="previous_dni" value="{{ old('previous_dni', $person->previous_dni) }}">
              @error('previous_dni')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="birth_date" class="form-label">*FECHA NAC</label>
              <input type="date" class="form-control form-control-sm @error('birth_date') is-invalid @enderror" 
              id="birth_date" name="birth_date" value="{{ old('birth_date', $person->birth_date->format('Y-m-d')) }}" >
              @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-1 mb-3">
              <label for="age" class="form-label">EDAD</label>
              <input type="number" class="form-control form-control-sm @error('age') is-invalid @enderror" 
                     id="age" name="age" value="{{ old('age', $person->age) }}" readonly>
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
                  <option value="{{ $value }}" {{ old('marital_status', $person->marital_status?->value) === $value ? 'selected' : '' }}>
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
                      id="cell_phone" name="cell_phone" value="{{ old('cell_phone', $person->cell_phone) }}" >
              @error('cell_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="home_phone" class="form-label">TELÉFONO FIJO</label>
              <input type="text" class="form-control form-control-sm @error('home_phone') is-invalid @enderror" 
                      id="home_phone" name="home_phone" value="{{ old('home_phone', $person->home_phone) }}">
              @error('home_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="email" class="form-label">CORREO ELECTRÓNICO</label>
              <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" 
                     id="email" name="email" value="{{ old('email', $person->email) }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="social_media_1" class="form-label">RED SOCIAL 1</label>
              <input type="text" class="form-control form-control-sm @error('social_media_1') is-invalid @enderror" 
                     id="social_media_1" name="social_media_1" value="{{ old('social_media_1', $person->social_media_1) }}">
              @error('social_media_1')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="social_media_2" class="form-label">RED SOCIAL 2</label>
              <input type="text" class="form-control form-control-sm @error('social_media_2') is-invalid @enderror" 
                     id="social_media_2" name="social_media_2" value="{{ old('social_media_2', $person->social_media_2) }}">
              @error('social_media_2')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-1 mb-3">
              <label for="blood_type" class="form-label">TIPO SANGRE</label>
              <input type="text" class="form-control form-control-sm @error('blood_type') is-invalid @enderror" 
                     id="blood_type" name="blood_type" value="{{ old('blood_type', $person->blood_type) }}">
              @error('blood_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="medication_allergies" class="form-label">ALÉRGICO A MEDICAMENTO</label>
              <input type="text" class="form-control form-control-sm @error('medication_allergies') is-invalid @enderror" 
                        id="medication_allergies" name="medication_allergies" value="{{ old('medication_allergies', $person->medication_allergies) }}">
              @error('medication_allergies')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="illnesses" class="form-label">ENFERMEDADES QUE PADECE</label>
              <input type="text" class="form-control form-control-sm @error('illnesses') is-invalid @enderror" 
                        id="illnesses" name="illnesses" value="{{ old('illnesses', $person->illnesses) }}">
              @error('illnesses')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="emergency_contact_name" class="form-label">*NOMBRE CONTACTO EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('emergency_contact_name') is-invalid @enderror" 
                     id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name', $person->emergency_contact_name) }}" >
              @error('emergency_contact_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="emergency_contact_phone" class="form-label">*TELÉFONO EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('emergency_contact_phone') is-invalid @enderror" 
                     id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $person->emergency_contact_phone) }}" >
              @error('emergency_contact_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="other_emergency_contacts" class="form-label">OTROS CONTACTOS DE EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('other_emergency_contacts') is-invalid @enderror" 
                        id="other_emergency_contacts" name="other_emergency_contacts" value="{{ old('other_emergency_contacts', $person->other_emergency_contacts) }}">
              @error('other_emergency_contacts')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
          </div>
          <!-- Botones de Acción -->
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-end gap-2 ">
                <button type="submit" class="btn btn-primary text-uppercase">
                  <i class="icon-base ti tabler-check me-1"></i>
                  Actualizar
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- /Account -->
    </div>
  </div>
</div>
<!-- Incluir alerts para mensajes flash con SweetAlert -->
@include('layouts/sections/alerts')

@endsection
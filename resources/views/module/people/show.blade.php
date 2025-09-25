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
@vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
        <li class="nav-item">
          <a class="nav-link active" href="javascript:void(0);">
            <i class="icon-base ti tabler-users icon-sm me-1_5"></i> 
            Inf. Personal
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);">
            <i class="icon-base ti tabler-lock icon-sm me-1_5"></i> 
            Inf. Residencial
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);">
            <i class="icon-base ti tabler-bookmark icon-sm me-1_5"></i> 
            Referencias Personales
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);">
            <i class="icon-base ti tabler-bell icon-sm me-1_5"></i> 
            Hab. Educativas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);">
            <i class="icon-base ti tabler-bell icon-sm me-1_5"></i> 
            Experiencia Laboral
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);">
            <i class="icon-base ti tabler-link icon-sm me-1_5"></i> 
            Aspiraciones
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);">
            <i class="icon-base ti tabler-link icon-sm me-1_5"></i> 
            Disponibilidad
          </a>
        </li>
      </ul>
    </div>
    <div class="card mb-6">
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-6">
          <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Subir foto del candidato</span>
              <i class="icon-base ti tabler-upload d-block d-sm-none"></i>
              <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
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
        <form id="formAccountSettings" action="{{ route('people.store') }}" method="POST" enctype="multipart/form-data">
          <div class="row mb-4">
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
              <label for="previous_dni" class="form-label">CÉDULA ANT.</label>
              <input type="text" class="form-control form-control-sm @error('previous_dni') is-invalid @enderror" 
                     id="previous_dni" name="previous_dni" value="{{ old('previous_dni') }}">
              @error('previous_dni')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="birth_date" class="form-label">*FECHA NAC</label>
              <input type="text" class="form-control form-control-sm flatpickr-input @error('birth_date') is-invalid @enderror" 
              id="flatpickr-date" name="birth_date" value="{{ old('birth_date') }}" >
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
            <div class="col-md-3 mb-3">
              <label for="birth_place" class="form-label">*LUGAR DE NACIMIENTO</label>
              <input type="text" class="form-control form-control-sm @error('birth_place') is-invalid @enderror" 
                     id="birth_place" name="birth_place" value="{{ old('birth_place') }}" >
              @error('birth_place')
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
            <div class="col-md-2 mb-3">
              <label for="zip_code" class="form-label">COD. POSTAL</label>
              <input type="text" class="form-control form-control-sm @error('zip_code') is-invalid @enderror" 
                     id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
              @error('zip_code')
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
            <div class="col-md-4 mb-3">
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
            <div class="col-md-2 mb-3">
              <label for="social_media_2" class="form-label">RED SOCIAL 2</label>
              <input type="text" class="form-control form-control-sm @error('social_media_2') is-invalid @enderror" 
                     id="social_media_2" name="social_media_2" value="{{ old('social_media_2') }}">
              @error('social_media_2')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="blood_type" class="form-label">TIPO DE SANGRE</label>
              <input type="text" class="form-control form-control-sm @error('blood_type') is-invalid @enderror" 
                     id="blood_type" name="blood_type" value="{{ old('blood_type') }}">
              @error('blood_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label for="medication_allergies" class="form-label">ALÉRGICO A MEDICAMENTO</label>
              <input type="text" class="form-control form-control-sm @error('medication_allergies') is-invalid @enderror" 
                        id="medication_allergies" name="medication_allergies" value="{{ old('medication_allergies') }}">
              @error('medication_allergies')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label for="illnesses" class="form-label">ENFERMEDADES QUE PADECE</label>
              <input type="text" class="form-control form-control-sm @error('illnesses') is-invalid @enderror" 
                        id="illnesses" name="illnesses" value="{{ old('illnesses') }}">
              @error('illnesses')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="emergency_contact_name" class="form-label">*NOMBRE CONTACTO EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('emergency_contact_name') is-invalid @enderror" 
                     id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" >
              @error('emergency_contact_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="emergency_contact_phone" class="form-label">*TELÉFONO EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('emergency_contact_phone') is-invalid @enderror" 
                     id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" >
              @error('emergency_contact_phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-3">
              <label for="other_emergency_contacts" class="form-label">OTROS CONTACTOS DE EMERGENCIA</label>
              <input type="text" class="form-control form-control-sm @error('other_emergency_contacts') is-invalid @enderror" 
                        id="other_emergency_contacts" name="other_emergency_contacts" value="{{ old('other_emergency_contacts') }}">
              @error('other_emergency_contacts')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
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
      <!-- /Account -->
    </div>
  </div>
</div>

@endsection
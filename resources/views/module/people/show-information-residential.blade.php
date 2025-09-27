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
  'resources/js/information-residence.js'
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
      <form id="formAccountSettings" action="{{ route('people.update-residence', $person->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body pt-4">
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="birth_place" class="form-label">*LUGAR DE NACIMIENTO</label>
              <input type="text" class="form-control form-control-sm @error('birth_place') is-invalid @enderror" 
                     id="birth_place" name="birth_place" value="{{ old('birth_place', $person->birth_place) }}" >
              @error('birth_place')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-1 mb-3">
              <label for="zip_code" class="form-label">COD. POSTAL</label>
              <input type="text" class="form-control form-control-sm @error('zip_code') is-invalid @enderror" 
                     id="zip_code" name="zip_code" value="{{ old('zip_code', $person->zip_code) }}">
              @error('zip_code')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="country" class="form-label">*PAÍS</label>
              <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" 
                     id="country" name="country" value="{{ old('country', $person->country) }}" >
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
                  <option value="{{ $province->id }}" {{ old('province_id', $person->residenceInformation?->province_id) == $province->id ? 'selected' : '' }}>
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
                @if($person->residenceInformation && $person->residenceInformation->municipality_id)
                  @foreach(\App\Models\Municipality::where('province_id', $person->residenceInformation->province_id)->get() as $municipality)
                    <option value="{{ $municipality->id }}" {{ old('municipality_id', $person->residenceInformation?->municipality_id) == $municipality->id ? 'selected' : '' }}>
                      {{ $municipality->name }}
                    </option>
                  @endforeach
                @endif
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
                @if($person->residenceInformation && $person->residenceInformation->sector_id)
                  @foreach(\App\Models\Sector::where('municipality_id', $person->residenceInformation->municipality_id)->get() as $sector)
                    <option value="{{ $sector->id }}" {{ old('sector_id', $person->residenceInformation?->sector_id) == $sector->id ? 'selected' : '' }}>
                      {{ $sector->name }}
                    </option>
                  @endforeach
                @endif
              </select>
              @error('sector_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="residential_complex" class="form-label">RESIDENCIAL</label>
              <input type="text" class="form-control form-control-sm @error('residential_complex') is-invalid @enderror" 
                     id="residential_complex" name="residential_complex" value="{{ old('residential_complex', $person->residenceInformation?->residential_complex) }}">
              @error('residential_complex')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="building" class="form-label">EDIFICIO</label>
              <input type="text" class="form-control form-control-sm @error('building') is-invalid @enderror" 
                     id="building" name="building" value="{{ old('building', $person->residenceInformation?->building) }}">
              @error('building')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="apartment" class="form-label">APARTAMENTO</label>
              <input type="text" class="form-control form-control-sm @error('apartment') is-invalid @enderror" 
                     id="apartment" name="apartment" value="{{ old('apartment', $person->residenceInformation?->apartment) }}">
              @error('apartment')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="neighborhood" class="form-label">BARRIO</label>
              <input type="text" class="form-control form-control-sm @error('neighborhood') is-invalid @enderror" 
                     id="neighborhood" name="neighborhood" value="{{ old('neighborhood', $person->residenceInformation?->neighborhood) }}">
              @error('neighborhood')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="street_and_number" class="form-label">CALLE Y NÚMERO</label>
              <input type="text" class="form-control form-control-sm @error('street_and_number') is-invalid @enderror" 
                     id="street_and_number" name="street_and_number" value="{{ old('street_and_number', $person->residenceInformation?->street_and_number) }}">
              @error('street_and_number')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-2 mb-3">
              <label for="coordinates" class="form-label">COORDENADA</label>
              <input type="text" class="form-control form-control-sm @error('coordinates') is-invalid @enderror" 
                     id="coordinates" name="coordinates" value="{{ old('coordinates', $person->residenceInformation?->coordinates) }}">
              @error('coordinates')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-5 mb-3">
              <label for="arrival_reference" class="form-label">REFERENCIA DE LLEGADA</label>
              <input type="text" class="form-control form-control-sm @error('arrival_reference') is-invalid @enderror" 
                     id="arrival_reference" name="arrival_reference" value="{{ old('arrival_reference', $person->residenceInformation?->arrival_reference) }}">
              @error('arrival_reference')
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
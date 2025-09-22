@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Detalles de Persona')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Detalles de: {{ $person->name }} {{ $person->last_name }}</h5>
          <a href="{{ route('people.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Regresar
          </a>
        </div>
        
        <div class="card-body">
          <!-- Información Personal -->
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Información Personal</h6>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Nombre Completo:</label>
              <p class="form-control-plaintext">{{ $person->name }} {{ $person->last_name }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Cédula:</label>
              <p class="form-control-plaintext">{{ $person->dni }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Edad:</label>
              <p class="form-control-plaintext">{{ $person->age }} años</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Estado Civil:</label>
              <p class="form-control-plaintext">{{ $person->marital_status_label ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Fecha de Nacimiento:</label>
              <p class="form-control-plaintext">{{ $person->birth_date ? $person->birth_date->format('d/m/Y') : 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Lugar de Nacimiento:</label>
              <p class="form-control-plaintext">{{ $person->birth_place ?? 'No especificado' }}</p>
            </div>
          </div>

          <!-- Información de Contacto -->
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Información de Contacto</h6>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Email:</label>
              <p class="form-control-plaintext">{{ $person->email ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Teléfono Celular:</label>
              <p class="form-control-plaintext">{{ $person->cell_phone ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Teléfono de Casa:</label>
              <p class="form-control-plaintext">{{ $person->home_phone ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">País:</label>
              <p class="form-control-plaintext">{{ $person->country ?? 'No especificado' }}</p>
            </div>
          </div>

          <!-- Información Laboral -->
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Información Laboral</h6>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Estado de Empleo:</label>
              <span class="badge bg-label-{{ $person->employment_status->value === 'contratado' ? 'success' : ($person->employment_status->value === 'disponible' ? 'info' : 'warning') }}">
                {{ $person->employment_status_label }}
              </span>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Posición Aplicada:</label>
              <p class="form-control-plaintext">{{ $person->position_applied_for ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Código de Empresa:</label>
              <p class="form-control-plaintext">{{ $person->company_code ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Nombre de Empresa:</label>
              <p class="form-control-plaintext">{{ $person->company_name ?? 'No especificado' }}</p>
            </div>
          </div>

          <!-- Información de Usuario -->
          @if($person->user)
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Información de Usuario</h6>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Usuario Asociado:</label>
              <p class="form-control-plaintext">{{ $person->user->name }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Email del Usuario:</label>
              <p class="form-control-plaintext">{{ $person->user->email }}</p>
            </div>
          </div>
          @endif

          <!-- Información de Residencia -->
          @if($person->residenceInformation)
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Información de Residencia</h6>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Dirección:</label>
              <p class="form-control-plaintext">{{ $person->residenceInformation->address ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Ciudad:</label>
              <p class="form-control-plaintext">{{ $person->residenceInformation->city ?? 'No especificado' }}</p>
            </div>
          </div>
          @endif

          <!-- Referencias Personales -->
          @if($person->personalReferences->count() > 0)
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Referencias Personales</h6>
            </div>
            @foreach($person->personalReferences as $reference)
            <div class="col-md-6 mb-3">
              <div class="card border">
                <div class="card-body">
                  <h6 class="card-title">{{ $reference->name ?? 'Sin nombre' }}</h6>
                  <p class="card-text">
                    <strong>Teléfono:</strong> {{ $reference->phone ?? 'No especificado' }}<br>
                    <strong>Relación:</strong> {{ $reference->relationship ?? 'No especificado' }}
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          <!-- Habilidades Educativas -->
          @if($person->educationalSkills->count() > 0)
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Habilidades Educativas</h6>
            </div>
            @foreach($person->educationalSkills as $skill)
            <div class="col-md-6 mb-3">
              <div class="card border">
                <div class="card-body">
                  <h6 class="card-title">{{ $skill->institution ?? 'Sin institución' }}</h6>
                  <p class="card-text">
                    <strong>Título:</strong> {{ $skill->degree ?? 'No especificado' }}<br>
                    <strong>Año:</strong> {{ $skill->year ?? 'No especificado' }}
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          <!-- Experiencias Laborales -->
          @if($person->workExperiences->count() > 0)
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Experiencias Laborales</h6>
            </div>
            @foreach($person->workExperiences as $experience)
            <div class="col-md-6 mb-3">
              <div class="card border">
                <div class="card-body">
                  <h6 class="card-title">{{ $experience->company ?? 'Sin empresa' }}</h6>
                  <p class="card-text">
                    <strong>Posición:</strong> {{ $experience->position ?? 'No especificado' }}<br>
                    <strong>Período:</strong> {{ $experience->start_date ?? 'No especificado' }} - {{ $experience->end_date ?? 'Presente' }}
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          <!-- Aspiraciones -->
          @if($person->aspirations)
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Aspiraciones Laborales</h6>
            </div>
            <div class="col-12">
              <div class="card border">
                <div class="card-body">
                  <p class="card-text">{{ $person->aspirations->description ?? 'No especificado' }}</p>
                </div>
              </div>
            </div>
          </div>
          @endif

          <!-- Información Adicional -->
          <div class="row mb-4">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Información Adicional</h6>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Tipo de Sangre:</label>
              <p class="form-control-plaintext">{{ $person->blood_type ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Alergias a Medicamentos:</label>
              <p class="form-control-plaintext">{{ $person->medication_allergies ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Enfermedades:</label>
              <p class="form-control-plaintext">{{ $person->illnesses ?? 'No especificado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Contacto de Emergencia:</label>
              <p class="form-control-plaintext">
                {{ $person->emergency_contact_name ?? 'No especificado' }}<br>
                <small class="text-muted">{{ $person->emergency_contact_phone ?? 'Sin teléfono' }}</small>
              </p>
            </div>
          </div>

          <!-- Información del Sistema -->
          <div class="row">
            <div class="col-12">
              <h6 class="fw-semibold mb-3">Información del Sistema</h6>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Fecha de Registro:</label>
              <p class="form-control-plaintext">{{ $person->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Última Actualización:</label>
              <p class="form-control-plaintext">{{ $person->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Código Único:</label>
              <p class="form-control-plaintext">{{ $person->code_unique ?? 'No asignado' }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-medium">Código:</label>
              <p class="form-control-plaintext">{{ $person->code ?? 'No asignado' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

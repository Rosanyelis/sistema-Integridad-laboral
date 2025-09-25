@extends('layouts/layoutMaster')

@section('title', 'Detalles del Usuario')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Detalles del Usuario</h5>
          <div class="d-flex gap-2">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">
              <i class="icon-base ti tabler-edit me-1"></i> Editar
            </a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
              <i class="icon-base ti tabler-arrow-left me-1"></i> Volver
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Nombre Completo</label>
              <p class="form-control-plaintext">{{ $user->name }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Email</label>
              <p class="form-control-plaintext">{{ $user->email }}</p>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Rol</label>
              <p class="form-control-plaintext">
                @if($user->roles->count() > 0)
                  <span class="badge bg-label-primary fs-6">
                    {{ $user->roles->first()->name }}
                  </span>
                @else
                  <span class="badge bg-label-secondary fs-6">Sin rol asignado</span>
                @endif
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Estado</label>
              <p class="form-control-plaintext">
                @if($user->email_verified_at)
                  <span class="badge bg-label-success fs-6">Activo</span>
                @else
                  <span class="badge bg-label-warning fs-6">Pendiente de verificación</span>
                @endif
              </p>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Fecha de Registro</label>
              <p class="form-control-plaintext">{{ $user->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Última Actualización</label>
              <p class="form-control-plaintext">{{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
          </div>
        </div>
        
        @if($user->roles->count() > 0)
          <div class="row">
            <div class="col-12">
              <div class="mb-4">
                <label class="form-label fw-bold">Permisos del Rol</label>
                <div class="mt-2">
                  @foreach($user->roles->first()->permissions as $permission)
                    <span class="badge bg-label-info me-1 mb-1">{{ $permission->name }}</span>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

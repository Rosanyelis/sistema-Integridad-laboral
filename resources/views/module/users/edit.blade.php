@extends('layouts/contentNavbarLayout')

@section('title', 'Editar Usuario')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/select2/select2.scss', 
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/animate-css/animate.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/select2/select2.js', 
  'resources/assets/vendor/libs/@form-validation/popular.js', 
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
@vite(['resources/js/user-edit.js'])
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Editar Usuario</h5>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
          <i class="icon-base ti tabler-arrow-left me-1"></i>
          Volver
        </a>
      </div>
      <div class="card-body">
        <form id="editUserForm" method="POST" action="{{ route('users.update', $user->id) }}">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name', $user->name) }}" required>
              <div class="invalid-feedback" id="name-error"></div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" 
                     id="email" name="email" value="{{ old('email', $user->email) }}" required>
              <div class="invalid-feedback" id="email-error"></div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="role" class="form-label">Rol <span class="text-danger">*</span></label>
              <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="">Seleccionar rol</option>
                @foreach($roles as $role)
                  <option value="{{ $role->name }}" 
                          {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                  </option>
                @endforeach
              </select>
              <div class="invalid-feedback" id="role-error"></div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Estado</label>
              <div class="form-control-plaintext">
                @if($user->is_active == 0)
                  <span class="badge bg-label-danger">Inactivo</span>
                @elseif($user->email_verified_at)
                  <span class="badge bg-label-success">Activo</span>
                @else
                  <span class="badge bg-label-warning">Pendiente</span>
                @endif
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary me-2">
                <i class="icon-base ti tabler-edit me-1"></i>
                Actualizar Usuario
              </button>
              <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="icon-base ti tabler-x me-1"></i>
                Cancelar
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
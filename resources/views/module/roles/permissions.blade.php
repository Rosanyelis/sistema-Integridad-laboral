@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Crear Nuevo Rol')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
@vite(['resources/js/roles-create.js'])
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <!-- Header Section -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="mb-1">Crear Nuevo Rol</h4>
            <p class="text-muted mb-0">Asigna permisos específicos para definir las capacidades del rol</p>
          </div>
          <div>
            <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary me-2">
              <i class="icon-base ti tabler-arrow-left me-1"></i>Regresar
            </a>
          </div>
        </div>
      </div>
    </div>

    <form id="permissionsForm">
      @csrf
      <input type="hidden" id="roleId" name="role_id" value="">
      
      <!-- Role Name Section -->
      <div class="card mb-4">
        <div class="card-body">
          <h6 class="mb-3 text-primary">
            <i class="icon-base ti tabler-user me-2"></i>Información del Rol
          </h6>
          <div class="row">
            <div class="col-md-12">
              <label for="roleName" class="form-label fw-medium">Nombre del Rol</label>
              <input type="text" class="form-control form-control-lg" id="roleName" name="role_name" 
                     value="" placeholder="Ej: Administrador, Editor, Usuario, etc.">
            </div>
          </div>
        </div>
      </div>

      <!-- Permissions Table -->
      <div class="card">
        <div class="card-header bg-light">
          <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold">Permisos del Rol</h6>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="selectAll" style="transform: scale(1.1);">
              <label class="form-check-label fw-medium" for="selectAll">
                Seleccionar Todo
              </label>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
              <thead class="table-light">
                <tr>
                  <th class="fw-semibold">MÓDULOS</th>
                  <th class="text-center">LISTA</th>
                  <th class="text-center">CREAR</th>
                  <th class="text-center">VER</th>
                  <th class="text-center">EDITAR</th>
                  <th class="text-center">ELIMINAR</th>
                </tr>
              </thead>
              <tbody>
                @foreach($modules as $module)
                <tr>
                  <td class="fw-medium">
                    <div class="d-flex align-items-center">
                      <span class="cursor-pointer" onclick="toggleModulePermissions('{{ $module['key'] }}')" 
                            style="cursor: pointer;" title="Clic para seleccionar/deseleccionar todos los permisos">
                        {{ $module['name'] }}
                      </span>
                      <i class="icon-base ti tabler-info-circle text-muted ms-2" 
                         data-bs-toggle="tooltip" 
                         title="{{ $module['description'] }}"></i>
                    </div>
                  </td>
                  @php
                    $permissionTypes = ['read', 'create', 'view', 'edit', 'delete'];
                  @endphp
                  @foreach($permissionTypes as $permissionType)
                  <td class="text-center">
                    @php
                      $permissionKey = $permissionType . '_' . $module['key'];
                      $permission = collect($module['permissions'])->firstWhere('key', $permissionKey);
                    @endphp
                    @if($permission)
                      <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input permission-checkbox" 
                               type="checkbox" 
                               id="permission_{{ $permission['id'] }}" 
                               name="permissions[]" 
                               value="{{ $permission['id'] }}"
                               data-module="{{ $module['key'] }}"
                               data-permission="{{ $permission['key'] }}">
                      </div>
                    @endif
                  </td>
                  @endforeach
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
              <small class="text-muted">
                <i class="icon-base ti tabler-info-circle me-1"></i>
                Selecciona los permisos necesarios para el rol y haz clic en "Crear Rol" para guardar los cambios.
              </small>
            </div>
            <div>
              <button type="button" class="btn btn-primary btn-sm" id="savePermissions" disabled>
                <i class="icon-base ti tabler-device-floppy me-1"></i>Crear Rol
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>

@endsection

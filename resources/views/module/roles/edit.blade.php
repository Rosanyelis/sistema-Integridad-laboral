@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Editar Rol')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/@form-validation/popular.js', 
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
<script>
// Configurar variables globales ANTES de cargar el script
window.isEditMode = true;
window.roleId = {{ $role->id }};
window.updateRoleUrl = '{{ route("roles.update", $role->id) }}';
console.log('Global variables set:', {
  isEditMode: window.isEditMode,
  roleId: window.roleId,
  updateRoleUrl: window.updateRoleUrl
});
</script>
@vite(['resources/js/roles-edit.js'])
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Editar Rol: {{ $role->name }}</h5>
          <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Regresar
          </a>
        </div>
        <div class="card-body">
          <form id="editRoleForm">
            @csrf
            @method('PUT')
            
            <!-- Información del Rol -->
            <div class="row mb-4">
              <div class="col-md-12">
                <label for="roleName" class="form-label">Nombre del Rol <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="roleName" name="name" value="{{ $role->name }}" required>
                <div class="invalid-feedback"></div>
              </div>
            </div>

            <!-- Permisos del Rol -->
            <div class="row">
              <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="mb-0">Permisos del Rol</h6>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="selectAllPermissions">
                    <label class="form-check-label" for="selectAllPermissions">
                      Seleccionar Todo
                    </label>
                  </div>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead class="table-light text-center">
                      <tr>
                        <th style="width: 25%">MÓDULOS</th>
                        <th >LISTA</th>
                        <th >CREAR</th>
                        <th >VER</th>
                        <th >EDITAR</th>
                        <th >ELIMINAR</th>
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
                              <input 
                                class="form-check-input permission-checkbox" 
                                type="checkbox" 
                                name="permissions[]" 
                                value="{{ $permission['id'] }}" 
                                id="permission_{{ $permission['id'] }}"
                                {{ $role->permissions->contains('id', $permission['id']) ? 'checked' : '' }}
                              >
                            </div>
                          @else
                            <span class="text-muted">-</span>
                          @endif
                        </td>
                        @endforeach
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="alert alert-info mt-3">
                  <i class="bx bx-info-circle me-2"></i>
                  Selecciona los permisos necesarios para el rol y haz clic en "Actualizar Rol" para guardar los cambios.
                </div>
              </div>
            </div>
          </form>
        </div>
        
        <!-- Footer con botón de guardar -->
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" id="updateRoleBtn">
              <i class="bx bx-save me-1"></i>
              Actualizar Rol
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

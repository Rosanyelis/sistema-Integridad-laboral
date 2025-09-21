@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Gestión de Roles y Permisos')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 
  'resources/assets/vendor/libs/@form-validation/popular.js', 
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
@vite(['resources/js/roles-index.js', 'resources/assets/js/modal-add-role.js'])
@endsection

@section('content')

<!-- Filtros -->
<div class="row mb-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Lista de Roles</h5>
        <div class="card-toolbar">
          <div class="card-toolbar">
             <a href="{{ route('roles.create') }}" class="btn btn-primary">
               <i class="icon-base ti tabler-plus me-1"></i>Agregar Nuevo Rol
             </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Role cards -->
<div class="row g-6">
  @forelse($roles as $role)
  <div class="col-xl-4 col-lg-6 col-md-6">
    <div class="card role-card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-end">
          <div class="role-heading">
            <h5 class="mb-1 role-name">{{ $role->name }} </h5>
            <small class="text-muted">({{ $role->permissions->count() }} Permisos)</small>
          </div>
          <div class="d-flex align-items-center">
            <a href="{{ route('roles.show', $role->id) }}" class="view-role ms-2" data-role-id="{{ $role->id }}">
              <i class="icon-base ti tabler-eye icon-md text-info"></i>
            </a>
            <a href="{{ route('roles.edit', $role->id) }}" class="edit-role ms-2" data-role-id="{{ $role->id }}">
              <i class="icon-base ti tabler-edit icon-md text-warning"></i>
            </a>
            <a href="javascript:void(0);" class="delete-role ms-2" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}">
              <i class="icon-base ti tabler-trash icon-md text-danger"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @empty
  <div class="col-12">
    <div class="card">
      <div class="card-body text-center py-5">
        <i class="icon-base ti tabler-shield-off icon-48px text-muted mb-3"></i>
        <h5 class="text-muted">No hay roles disponibles</h5>
        <p class="text-muted">Comienza creando tu primer rol para gestionar permisos.</p>
        <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary">
          <i class="icon-base ti tabler-plus me-1"></i>Crear Primer Rol
        </button>
      </div>
    </div>
  </div>
  @endforelse

</div>


<!--/ Role cards -->

<!-- Add Role Modal -->
@include('_partials/_modals/modal-add-role')
<!-- / Add Role Modal -->

<!-- Delete Role Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Confirmar Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <p>¿Estás seguro de que deseas eliminar el rol <strong id="deleteRoleName"></strong>?</p>
            <p class="text-muted">Esta acción no se puede deshacer.</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Cancelar
        </button>
        <button type="button" class="btn btn-danger" id="confirmDeleteRole">
          Eliminar
        </button>
      </div>
    </div>
  </div>
</div>
<!-- / Delete Role Modal -->
@endsection

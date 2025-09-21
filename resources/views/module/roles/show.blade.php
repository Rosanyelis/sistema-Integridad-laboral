@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Detalles del Rol')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Detalles del Rol</h5>
          <div class="d-flex gap-2">
            <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary btn-sm">
              <i class="icon-base ti tabler-edit me-1"></i> Editar
            </a>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
              <i class="icon-base ti tabler-arrow-left me-1"></i> Volver
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Nombre del Rol</label>
              <p class="form-control-plaintext fs-5">{{ $role->name }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Guard</label>
              <p class="form-control-plaintext">
                <span class="badge bg-label-info fs-6">{{ $role->guard_name }}</span>
              </p>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Total de Permisos</label>
              <p class="form-control-plaintext">
                <span class="badge bg-label-primary fs-6">{{ $role->permissions->count() }} permisos</span>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Usuarios Asignados</label>
              <p class="form-control-plaintext">
                <span class="badge bg-label-success fs-6">{{ $role->users->count() }} usuarios</span>
              </p>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Fecha de Creación</label>
              <p class="form-control-plaintext">{{ $role->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label fw-bold">Última Actualización</label>
              <p class="form-control-plaintext">{{ $role->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
          </div>
        </div>
        
        @if($role->permissions->count() > 0)
        <div class="row">
          <div class="col-12">
            <div class="mb-4">
              <label class="form-label fw-bold">Permisos Asignados</label>
              <div class="mt-3">
                @php
                  $permissionsByModule = [
                    'usuarios' => [],
                    'roles' => [],
                    'dashboard' => [],
                    'profile' => []
                  ];
                  
                  foreach($role->permissions as $permission) {
                    if (str_contains($permission->name, 'usuarios')) {
                      $permissionsByModule['usuarios'][] = $permission;
                    } elseif (str_contains($permission->name, 'roles')) {
                      $permissionsByModule['roles'][] = $permission;
                    } elseif (str_contains($permission->name, 'dashboard')) {
                      $permissionsByModule['dashboard'][] = $permission;
                    } elseif (str_contains($permission->name, 'profile')) {
                      $permissionsByModule['profile'][] = $permission;
                    }
                  }
                @endphp
                
                @foreach($permissionsByModule as $module => $permissions)
                  @if(count($permissions) > 0)
                    <div class="mb-4">
                      <h6 class="text-primary mb-2">
                        @switch($module)
                          @case('usuarios')
                            <i class="icon-base ti tabler-users me-1"></i>Módulo de Usuarios
                            @break
                          @case('roles')
                            <i class="icon-base ti tabler-shield me-1"></i>Módulo de Roles
                            @break
                          @case('dashboard')
                            <i class="icon-base ti tabler-dashboard me-1"></i>Dashboard
                            @break
                          @case('profile')
                            <i class="icon-base ti tabler-user me-1"></i>Perfil
                            @break
                        @endswitch
                      </h6>
                      <div class="row">
                        @foreach($permissions as $permission)
                          <div class="col-md-3 col-sm-6 mb-2">
                            <span class="badge bg-label-info w-100 text-start">
                              @switch($permission->name)
                                @case('read_usuarios')
                                  <i class="icon-base ti tabler-list me-1"></i>Listar Usuarios
                                  @break
                                @case('create_usuarios')
                                  <i class="icon-base ti tabler-plus me-1"></i>Crear Usuarios
                                  @break
                                @case('view_usuarios')
                                  <i class="icon-base ti tabler-eye me-1"></i>Ver Usuarios
                                  @break
                                @case('edit_usuarios')
                                  <i class="icon-base ti tabler-edit me-1"></i>Editar Usuarios
                                  @break
                                @case('delete_usuarios')
                                  <i class="icon-base ti tabler-trash me-1"></i>Eliminar Usuarios
                                  @break
                                @case('read_roles')
                                  <i class="icon-base ti tabler-list me-1"></i>Listar Roles
                                  @break
                                @case('create_roles')
                                  <i class="icon-base ti tabler-plus me-1"></i>Crear Roles
                                  @break
                                @case('view_roles')
                                  <i class="icon-base ti tabler-eye me-1"></i>Ver Roles
                                  @break
                                @case('edit_roles')
                                  <i class="icon-base ti tabler-edit me-1"></i>Editar Roles
                                  @break
                                @case('delete_roles')
                                  <i class="icon-base ti tabler-trash me-1"></i>Eliminar Roles
                                  @break
                                @case('view-dashboard')
                                  <i class="icon-base ti tabler-dashboard me-1"></i>Ver Dashboard
                                  @break
                                @case('view-profile')
                                  <i class="icon-base ti tabler-user me-1"></i>Ver Perfil
                                  @break
                                @case('edit-profile')
                                  <i class="icon-base ti tabler-edit me-1"></i>Editar Perfil
                                  @break
                                @default
                                  {{ $permission->name }}
                              @endswitch
                            </span>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
        @endif
        
        @if($role->users->count() > 0)
        <div class="row">
          <div class="col-12">
            <div class="mb-4">
              <label class="form-label fw-bold">Usuarios Asignados</label>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Estado</th>
                      <th>Fecha de Asignación</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($role->users as $user)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="avatar avatar-sm me-2">
                            <span class="avatar-initial rounded-circle bg-label-primary">
                              {{ substr($user->name, 0, 1) }}
                            </span>
                          </div>
                          <div>
                            <h6 class="mb-0">{{ $user->name }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if($user->email_verified_at)
                          <span class="badge bg-label-success">Activo</span>
                        @else
                          <span class="badge bg-label-warning">Pendiente</span>
                        @endif
                      </td>
                      <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="row">
          <div class="col-12">
            <div class="alert alert-info">
              <i class="icon-base ti tabler-info-circle me-2"></i>
              Este rol no tiene usuarios asignados actualmente.
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

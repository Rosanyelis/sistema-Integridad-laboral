@extends('layouts/layoutMaster')

@section('title', 'Gestión de Personas')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 
  'resources/assets/vendor/libs/select2/select2.scss', 
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/animate-css/animate.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/moment/moment.js', 
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 
  'resources/assets/vendor/libs/select2/select2.js', 
  'resources/assets/vendor/libs/@form-validation/popular.js', 
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 
  'resources/assets/vendor/libs/@form-validation/auto-focus.js', 
  'resources/assets/vendor/libs/cleave-zen/cleave-zen.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
@vite('resources/js/people-index.js')


@endsection

@section('content')
<!-- Estadísticas -->
<div class="row g-6 mb-6">
  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span class="text-heading">Total Personas</span>
            <div class="d-flex align-items-center my-1">
              <h4 class="mb-0 me-2">{{ number_format($stats['total_people'] ?? 0) }}</h4>
            </div>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="icon-base ti tabler-users icon-26px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span class="text-heading">Personas Disponibles</span>
            <div class="d-flex align-items-center my-1">
              <h4 class="mb-0 me-2">{{ number_format($stats['available_people'] ?? 0) }}</h4>
            </div>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-success">
              <i class="icon-base ti tabler-user-check icon-26px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span class="text-heading">Personas Contratadas</span>
            <div class="d-flex align-items-center my-1">
              <h4 class="mb-0 me-2">{{ number_format($stats['hired_people'] ?? 0) }}</h4>
            </div>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-info">
              <i class="icon-base ti tabler-user-plus icon-26px"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tabla de Personas -->
<div class="card">
  <div class="card-header border-bottom">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title mb-0">Filtros</h5>
      
    </div>
    <div class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0">
      <div class="col-md-4">
        <label class="form-label">Estado</label>
        <select class="form-select" id="statusFilter">
          <option value="">Todos los estados</option>
          <option value="pendiente">Pendiente</option>
          <option value="disponible">Disponible</option>
          <option value="en_proceso">En Proceso</option>
          <option value="contratado">Contratado</option>
          <option value="part_time">Part-Time</option>
          <option value="despido">Despido</option>
          <option value="desaucio">Desaucio</option>
          <option value="renuncia">Renuncia</option>
          <option value="aplica">Aplica</option>
          <option value="no_aplica">No Aplica</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Verificación</label>
        <select class="form-select" id="verifiedFilter">
          <option value="">Todas las verificaciones</option>
          <option value="with_user">Con Usuario</option>
          <option value="without_user">Sin Usuario</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Buscar Persona</label>
        <input type="text" class="form-control" id="searchInput" placeholder="Buscar por nombre, apellido o cédula...">
      </div>
    </div>
  </div>
  
  <div class="card-datatable">
    <table class="datatables-people table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
          <th>Código</th>
          <th>Nombre</th>
          <th>Cédula</th>
          <th>Edad</th>
          <th>Verificado</th>
          <th>Estatus</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Modal para cambiar estado -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar Estado de Personas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="changeStatusForm">
          <div class="mb-3">
            <label for="newStatus" class="form-label">Nuevo Estado</label>
            <select class="form-select" id="newStatus" name="new_status" required>
              <option value="">Seleccionar estado...</option>
              <option value="pendiente">Pendiente</option>
              <option value="disponible">Disponible</option>
              <option value="en_proceso">En Proceso</option>
              <option value="contratado">Contratado</option>
              <option value="part_time">Part-Time</option>
              <option value="despido">Despido</option>
              <option value="desaucio">Desaucio</option>
              <option value="renuncia">Renuncia</option>
              <option value="aplica">Aplica</option>
              <option value="no_aplica">No Aplica</option>
            </select>
          </div>
          <div class="alert alert-info">
            <i class="bx bx-info-circle me-2"></i>
            <span id="selectedCountText">0 personas seleccionadas</span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="confirmStatusChange">
          <i class="bx bx-check me-1"></i>
          Cambiar Estado
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Incluir alerts para mensajes flash con SweetAlert -->
@include('layouts/sections/alerts')

@endsection
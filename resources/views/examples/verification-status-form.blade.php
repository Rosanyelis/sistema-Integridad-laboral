{{-- Ejemplo de uso del enum VerificationStatus en formularios --}}

{{-- En un formulario de selección simple --}}
<div class="mb-3">
    <label for="verification_status" class="form-label">Estado de Verificación <span class="text-danger">*</span></label>
    <select class="form-select @error('verification_status') is-invalid @enderror" 
            id="verification_status" 
            name="verification_status" 
            required>
        <option value="">Seleccione un estado de verificación</option>
        @foreach(App\Enums\VerificationStatus::getOptions() as $value => $label)
            <option value="{{ $value }}" 
                    {{ old('verification_status', $document->verification_status?->value ?? '') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('verification_status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Mostrar el estado de verificación en una vista --}}
<div class="row mb-3">
    <div class="col-sm-3">
        <strong>Estado de Verificación:</strong>
    </div>
    <div class="col-sm-9">
        @if($document->verification_status)
            <span class="badge bg-{{ $document->verification_status->getBootstrapColor() }}">
                {{ $document->verification_status->getIcon() }} {{ $document->verification_status->getLabel() }}
            </span>
            <small class="text-muted ms-2">{{ $document->verification_status->getDescription() }}</small>
        @else
            <span class="text-muted">No especificado</span>
        @endif
    </div>
</div>

{{-- Botones de selección rápida --}}
<div class="mb-3">
    <label class="form-label">Seleccione el Estado de Verificación</label>
    <div class="row">
        @foreach(App\Enums\VerificationStatus::getOptions() as $value => $label)
            <div class="col-md-3 col-sm-6 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" 
                           name="verification_status" 
                           value="{{ $value }}" 
                           id="verification_{{ $value }}"
                           {{ old('verification_status', $document->verification_status?->value ?? '') == $value ? 'checked' : '' }}>
                    <label class="form-check-label d-flex align-items-center" for="verification_{{ $value }}">
                        <span class="me-2">{{ App\Enums\VerificationStatus::from($value)->getIcon() }}</span>
                        {{ $label }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Filtro por categorías de verificación --}}
<div class="row mb-3">
    <div class="col-md-4">
        <label for="filter_verification_status" class="form-label">Filtrar por Estado de Verificación</label>
        <select class="form-select" id="filter_verification_status" name="verification_status_filter">
            <option value="">Todos los estados</option>
            <optgroup label="Estados Activos">
                @foreach(App\Enums\VerificationStatus::getActiveStatuses() as $status)
                    <option value="{{ $status->value }}" 
                            {{ request('verification_status_filter') == $status->value ? 'selected' : '' }}>
                        {{ $status->getIcon() }} {{ $status->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="Estados Completados">
                @foreach(App\Enums\VerificationStatus::getCompletedStatuses() as $status)
                    <option value="{{ $status->value }}" 
                            {{ request('verification_status_filter') == $status->value ? 'selected' : '' }}>
                        {{ $status->getIcon() }} {{ $status->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="No Aplicable">
                @foreach(App\Enums\VerificationStatus::getNotApplicableStatuses() as $status)
                    <option value="{{ $status->value }}" 
                            {{ request('verification_status_filter') == $status->value ? 'selected' : '' }}>
                        {{ $status->getIcon() }} {{ $status->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
        </select>
    </div>
</div>

{{-- Barra de progreso de verificación --}}
@if($document->verification_status)
<div class="mb-3">
    <label class="form-label">Progreso de Verificación</label>
    <div class="progress" style="height: 25px;">
        <div class="progress-bar bg-{{ $document->verification_status->getBootstrapColor() }}" 
             role="progressbar" 
             style="width: {{ $document->verification_status->getProgressPercentage() }}%"
             aria-valuenow="{{ $document->verification_status->getProgressPercentage() }}" 
             aria-valuemin="0" 
             aria-valuemax="100">
            {{ $document->verification_status->getProgressPercentage() }}%
        </div>
    </div>
    <small class="text-muted">{{ $document->verification_status->getDescription() }}</small>
</div>
@endif

{{-- Estadísticas por estado de verificación --}}
@php
    $activeCount = $documents->whereIn('verification_status', App\Enums\VerificationStatus::getActiveStatuses())->count();
    $completedCount = $documents->whereIn('verification_status', App\Enums\VerificationStatus::getCompletedStatuses())->count();
    $notApplicableCount = $documents->whereIn('verification_status', App\Enums\VerificationStatus::getNotApplicableStatuses())->count();
@endphp

<div class="row mb-3">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">⏳ En Proceso</h5>
                <h3 class="text-warning">{{ $activeCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">✅ Completados</h5>
                <h3 class="text-success">{{ $completedCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">❌ No Aplicable</h5>
                <h3 class="text-secondary">{{ $notApplicableCount }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- Tabla con estados de verificación --}}
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Documento</th>
                <th>Estado</th>
                <th>Progreso</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->name }}</td>
                <td>
                    <span class="badge bg-{{ $document->verification_status?->getBootstrapColor() ?? 'secondary' }}">
                        {{ $document->verification_status?->getIcon() ?? '❓' }} 
                        {{ $document->verification_status?->getLabel() ?? 'Sin estado' }}
                    </span>
                </td>
                <td>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar bg-{{ $document->verification_status?->getBootstrapColor() ?? 'secondary' }}" 
                             style="width: {{ $document->verification_status?->getProgressPercentage() ?? 0 }}%">
                            {{ $document->verification_status?->getProgressPercentage() ?? 0 }}%
                        </div>
                    </div>
                </td>
                <td>
                    <small class="text-muted">
                        {{ $document->verification_status?->getDescription() ?? 'No especificado' }}
                    </small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- JavaScript para validación --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const verificationStatusSelect = document.getElementById('verification_status');
    const verificationStatusRadios = document.querySelectorAll('input[name="verification_status"]');
    const validValues = @json(array_keys(App\Enums\VerificationStatus::getOptions()));
    
    // Validación para select
    if (verificationStatusSelect) {
        verificationStatusSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            
            if (selectedValue && !validValues.includes(selectedValue)) {
                this.setCustomValidity('Por favor seleccione un estado de verificación válido');
            } else {
                this.setCustomValidity('');
            }
        });
    }
    
    // Sincronización entre select y radios
    verificationStatusRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (verificationStatusSelect) {
                verificationStatusSelect.value = this.value;
            }
        });
    });
    
    if (verificationStatusSelect) {
        verificationStatusSelect.addEventListener('change', function() {
            verificationStatusRadios.forEach(radio => {
                radio.checked = radio.value === this.value;
            });
        });
    }
});
</script>

{{-- Ejemplo de uso del código único en formularios --}}

{{-- Mostrar el código único generado automáticamente --}}
@if(isset($person) && $person->code_unique)
<div class="row mb-3">
    <div class="col-sm-3">
        <strong>Código Único:</strong>
    </div>
    <div class="col-sm-9">
        <span class="badge bg-success fs-6">{{ $person->code_unique }}</span>
        <small class="text-muted ms-2">Generado automáticamente</small>
    </div>
</div>
@endif

{{-- En un formulario de creación, el campo code_unique será opcional --}}
<div class="mb-3">
    <label for="code_unique" class="form-label">Código Único</label>
    <input type="text" 
           class="form-control" 
           id="code_unique" 
           name="code_unique" 
           value="{{ old('code_unique') }}"
           placeholder="Se generará automáticamente si se deja vacío">
    <div class="form-text">
        Si se deja vacío, se generará automáticamente en formato: XX-DDMMYYYY
    </div>
</div>

{{-- Mostrar estadísticas del día actual --}}
@php
    $dailyStats = \App\Helpers\PersonCodeHelper::getDailyStats();
@endphp

<div class="card mb-3">
    <div class="card-header">
        <h6 class="mb-0">Estadísticas del Día</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <strong>Fecha:</strong><br>
                {{ $dailyStats['date'] }}
            </div>
            <div class="col-md-3">
                <strong>Registros Hoy:</strong><br>
                <span class="badge bg-primary">{{ $dailyStats['total_registrations'] }}</span>
            </div>
            <div class="col-md-3">
                <strong>Último Código:</strong><br>
                <code>{{ $dailyStats['last_code'] ?? 'N/A' }}</code>
            </div>
            <div class="col-md-3">
                <strong>Siguiente:</strong><br>
                <code>{{ $dailyStats['next_code'] }}</code>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript para mostrar el código generado en tiempo real --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Si hay un formulario de creación, mostrar el código que se generará
    const form = document.querySelector('form');
    if (form && form.action.includes('store')) {
        const codeInput = document.getElementById('code_unique');
        if (codeInput && !codeInput.value) {
            // Simular la generación del código (solo para mostrar)
            const today = new Date();
            const dateString = String(today.getDate()).padStart(2, '0') + 
                             String(today.getMonth() + 1).padStart(2, '0') + 
                             today.getFullYear();
            
            codeInput.placeholder = `Se generará: XX-${dateString}`;
        }
    }
});
</script>

{{-- Ejemplo de uso del enum EmploymentStatus en formularios --}}

{{-- En un formulario de creación/edición --}}
<div class="mb-3">
    <label for="employment_status" class="form-label">Estatus Laboral <span class="text-danger">*</span></label>
    <select class="form-select @error('employment_status') is-invalid @enderror" 
            id="employment_status" 
            name="employment_status" 
            required>
        <option value="">Seleccione un estatus laboral</option>
        @foreach(App\Enums\EmploymentStatus::getOptions() as $value => $label)
            <option value="{{ $value }}" 
                    {{ old('employment_status', $person->employment_status?->value ?? '') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('employment_status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Mostrar el estatus laboral en una vista --}}
<div class="row mb-3">
    <div class="col-sm-3">
        <strong>Estatus Laboral:</strong>
    </div>
    <div class="col-sm-9">
        @if($person->employment_status)
            <span class="badge bg-primary">{{ $person->employment_status_label }}</span>
        @else
            <span class="text-muted">No especificado</span>
        @endif
    </div>
</div>

{{-- Filtro por estatus laboral con categorías --}}
<div class="row mb-3">
    <div class="col-md-4">
        <label for="filter_employment_status" class="form-label">Filtrar por Estatus Laboral</label>
        <select class="form-select" id="filter_employment_status" name="employment_status">
            <option value="">Todos los estatus</option>
            <optgroup label="Estatus Activos">
                @foreach(App\Enums\EmploymentStatus::getActiveStatuses() as $status)
                    <option value="{{ $status->value }}" 
                            {{ request('employment_status') == $status->value ? 'selected' : '' }}>
                        {{ $status->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="Estatus de Finalización">
                @foreach(App\Enums\EmploymentStatus::getTerminationStatuses() as $status)
                    <option value="{{ $status->value }}" 
                            {{ request('employment_status') == $status->value ? 'selected' : '' }}>
                        {{ $status->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="Estatus de Aplicación">
                @foreach(App\Enums\EmploymentStatus::getApplicationStatuses() as $status)
                    <option value="{{ $status->value }}" 
                            {{ request('employment_status') == $status->value ? 'selected' : '' }}>
                        {{ $status->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
        </select>
    </div>
</div>

{{-- Checkboxes para múltiples estatus (como en la imagen) --}}
<div class="mb-3">
    <label class="form-label">Estatus Laboral (Múltiple selección)</label>
    <div class="row">
        @php
            $activeStatuses = App\Enums\EmploymentStatus::getActiveStatuses();
            $terminationStatuses = App\Enums\EmploymentStatus::getTerminationStatuses();
            $applicationStatuses = App\Enums\EmploymentStatus::getApplicationStatuses();
        @endphp
        
        <div class="col-md-4">
            <h6>Estatus Activos</h6>
            @foreach($activeStatuses as $status)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                           name="employment_statuses[]" 
                           value="{{ $status->value }}" 
                           id="status_{{ $status->value }}"
                           {{ in_array($status->value, old('employment_statuses', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_{{ $status->value }}">
                        {{ $status->getLabel() }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <div class="col-md-4">
            <h6>Estatus de Finalización</h6>
            @foreach($terminationStatuses as $status)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                           name="employment_statuses[]" 
                           value="{{ $status->value }}" 
                           id="status_{{ $status->value }}"
                           {{ in_array($status->value, old('employment_statuses', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_{{ $status->value }}">
                        {{ $status->getLabel() }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <div class="col-md-4">
            <h6>Estatus de Aplicación</h6>
            @foreach($applicationStatuses as $status)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                           name="employment_statuses[]" 
                           value="{{ $status->value }}" 
                           id="status_{{ $status->value }}"
                           {{ in_array($status->value, old('employment_statuses', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_{{ $status->value }}">
                        {{ $status->getLabel() }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- En JavaScript para validación --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const employmentStatusSelect = document.getElementById('employment_status');
    const validValues = @json(array_keys(App\Enums\EmploymentStatus::getOptions()));
    
    if (employmentStatusSelect) {
        employmentStatusSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            
            if (selectedValue && !validValues.includes(selectedValue)) {
                this.setCustomValidity('Por favor seleccione un estatus laboral válido');
            } else {
                this.setCustomValidity('');
            }
        });
    }
});
</script>

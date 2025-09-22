{{-- Ejemplo de uso del enum MaritalStatus en formularios --}}

{{-- En un formulario de creación/edición --}}
<div class="mb-3">
    <label for="marital_status" class="form-label">Estado Civil <span class="text-danger">*</span></label>
    <select class="form-select @error('marital_status') is-invalid @enderror" 
            id="marital_status" 
            name="marital_status" 
            required>
        <option value="">Seleccione un estado civil</option>
        @foreach(App\Enums\MaritalStatus::getOptions() as $value => $label)
            <option value="{{ $value }}" 
                    {{ old('marital_status', $person->marital_status?->value ?? '') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('marital_status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Mostrar el estado civil en una vista --}}
<div class="row mb-3">
    <div class="col-sm-3">
        <strong>Estado Civil:</strong>
    </div>
    <div class="col-sm-9">
        @if($person->marital_status)
            <span class="badge bg-primary">{{ $person->marital_status_label }}</span>
        @else
            <span class="text-muted">No especificado</span>
        @endif
    </div>
</div>

{{-- Filtro por estado civil --}}
<div class="col-md-3">
    <label for="filter_marital_status" class="form-label">Filtrar por Estado Civil</label>
    <select class="form-select" id="filter_marital_status" name="marital_status">
        <option value="">Todos los estados</option>
        @foreach(App\Enums\MaritalStatus::getOptions() as $value => $label)
            <option value="{{ $value }}" 
                    {{ request('marital_status') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

{{-- En JavaScript para validación --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const maritalStatusSelect = document.getElementById('marital_status');
    const validValues = @json(array_keys(App\Enums\MaritalStatus::getOptions()));
    
    maritalStatusSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        
        if (selectedValue && !validValues.includes(selectedValue)) {
            this.setCustomValidity('Por favor seleccione un estado civil válido');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>

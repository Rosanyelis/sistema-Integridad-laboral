{{-- Ejemplo de uso del enum Relationship en formularios --}}

{{-- En un formulario de selección simple --}}
<div class="mb-3">
    <label for="relationship" class="form-label">Tipo de Relación <span class="text-danger">*</span></label>
    <select class="form-select @error('relationship') is-invalid @enderror" 
            id="relationship" 
            name="relationship" 
            required>
        <option value="">Seleccione un tipo de relación</option>
        @foreach(App\Enums\Relationship::getOptions() as $value => $label)
            <option value="{{ $value }}" 
                    {{ old('relationship', $reference->relationship?->value ?? '') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('relationship')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Mostrar la relación en una vista --}}
<div class="row mb-3">
    <div class="col-sm-3">
        <strong>Tipo de Relación:</strong>
    </div>
    <div class="col-sm-9">
        @if($reference->relationship)
            <span class="badge bg-primary">
                {{ $reference->relationship->getIcon() }} {{ $reference->relationship->getLabel() }}
            </span>
            <small class="text-muted ms-2">{{ $reference->relationship->getDescription() }}</small>
        @else
            <span class="text-muted">No especificado</span>
        @endif
    </div>
</div>

{{-- Botones de selección rápida (como en la imagen) --}}
<div class="mb-3">
    <label class="form-label">Seleccione el Tipo de Relación</label>
    <div class="row">
        @foreach(App\Enums\Relationship::getOptions() as $value => $label)
            <div class="col-md-4 col-sm-6 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" 
                           name="relationship" 
                           value="{{ $value }}" 
                           id="relationship_{{ $value }}"
                           {{ old('relationship', $reference->relationship?->value ?? '') == $value ? 'checked' : '' }}>
                    <label class="form-check-label d-flex align-items-center" for="relationship_{{ $value }}">
                        <span class="me-2">{{ App\Enums\Relationship::from($value)->getIcon() }}</span>
                        {{ $label }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Filtro por categorías de relación --}}
<div class="row mb-3">
    <div class="col-md-4">
        <label for="filter_relationship" class="form-label">Filtrar por Tipo de Relación</label>
        <select class="form-select" id="filter_relationship" name="relationship_filter">
            <option value="">Todas las relaciones</option>
            <optgroup label="Familia Directa">
                @foreach(App\Enums\Relationship::getFamilyRelationships() as $relationship)
                    <option value="{{ $relationship->value }}" 
                            {{ request('relationship_filter') == $relationship->value ? 'selected' : '' }}>
                        {{ $relationship->getIcon() }} {{ $relationship->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="Familia Extendida">
                @foreach(App\Enums\Relationship::getExtendedFamilyRelationships() as $relationship)
                    <option value="{{ $relationship->value }}" 
                            {{ request('relationship_filter') == $relationship->value ? 'selected' : '' }}>
                        {{ $relationship->getIcon() }} {{ $relationship->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
            <optgroup label="No Familiar">
                @foreach(App\Enums\Relationship::getNonFamilyRelationships() as $relationship)
                    <option value="{{ $relationship->value }}" 
                            {{ request('relationship_filter') == $relationship->value ? 'selected' : '' }}>
                        {{ $relationship->getIcon() }} {{ $relationship->getLabel() }}
                    </option>
                @endforeach
            </optgroup>
        </select>
    </div>
</div>

{{-- Estadísticas por tipo de relación --}}
@php
    $familyCount = $references->whereIn('relationship', App\Enums\Relationship::getFamilyRelationships())->count();
    $extendedFamilyCount = $references->whereIn('relationship', App\Enums\Relationship::getExtendedFamilyRelationships())->count();
    $nonFamilyCount = $references->whereIn('relationship', App\Enums\Relationship::getNonFamilyRelationships())->count();
@endphp

<div class="row mb-3">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">👨‍👩‍👧‍👦 Familia Directa</h5>
                <h3 class="text-primary">{{ $familyCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">👨‍👩‍👧‍👦 Familia Extendida</h5>
                <h3 class="text-info">{{ $extendedFamilyCount }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">👥 No Familiar</h5>
                <h3 class="text-secondary">{{ $nonFamilyCount }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript para validación --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const relationshipSelect = document.getElementById('relationship');
    const relationshipRadios = document.querySelectorAll('input[name="relationship"]');
    const validValues = @json(array_keys(App\Enums\Relationship::getOptions()));
    
    // Validación para select
    if (relationshipSelect) {
        relationshipSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            
            if (selectedValue && !validValues.includes(selectedValue)) {
                this.setCustomValidity('Por favor seleccione un tipo de relación válido');
            } else {
                this.setCustomValidity('');
            }
        });
    }
    
    // Sincronización entre select y radios
    relationshipRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (relationshipSelect) {
                relationshipSelect.value = this.value;
            }
        });
    });
    
    if (relationshipSelect) {
        relationshipSelect.addEventListener('change', function() {
            relationshipRadios.forEach(radio => {
                radio.checked = radio.value === this.value;
            });
        });
    }
});
</script>

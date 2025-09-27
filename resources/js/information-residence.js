/**
 * Information Residence - JavaScript refactorizado para formulario de información residencial
 * Manejo mejorado de selects dinámicos y validaciones
 */

'use strict';

(function () {
  'use strict';

  // Configuración y estado
  const config = {
    selectors: {
      form: '#formAccountSettings',
      province: '#province_id',
      municipality: '#municipality_id',
      sector: '#sector_id',
      zipCode: '#zip_code'
    },
    api: {
      municipalities: '/api/municipalities',
      sectors: '/api/sectors'
    },
    delays: {
      select2Init: 100,
      dataLoad: 200,
      sectorLoad: 500
    }
  };

  // Estado de la aplicación
  let state = {
    formChanged: false,
    originalFormData: {},
    isInitialized: false
  };

  // Inicialización principal
  document.addEventListener('DOMContentLoaded', function() {
    if (state.isInitialized) return;
    
    console.log('Inicializando formulario de información residencial...');
    
    try {
      initializeApplication();
      state.isInitialized = true;
    } catch (error) {
      console.error('Error al inicializar la aplicación:', error);
    }
  });

  /**
   * Inicializar la aplicación completa
   */
  function initializeApplication() {
    const form = document.querySelector(config.selectors.form);
    if (!form) {
      console.warn('Formulario no encontrado');
      return;
    }

    // Guardar datos originales
    saveOriginalFormData();
    
    // Inicializar componentes
    initializeSelects();
    initializeValidation();
    initializeFormTracking();
    initializeZipCodeMask();
    
    console.log('Aplicación inicializada correctamente');
  }

  /**
   * Inicializar todos los selects
   */
  function initializeSelects() {
    // Inicializar Select2 primero
    initializeSelect2();
    
    // Luego cargar datos existentes
    setTimeout(() => {
      loadExistingData();
    }, config.delays.dataLoad);
  }

  /**
   * Inicializar Select2 para todos los selects
   */
  function initializeSelect2() {
    const selects = document.querySelectorAll('.select2');
    
    selects.forEach(select => {
      if (!select.classList.contains('select2-hidden-accessible')) {
        const $select = $(select);
        
        // Guardar valor actual antes de inicializar
        const currentValue = select.value;
        
        // Configurar Select2
        $select.select2({
          dropdownParent: $select.parent(),
          placeholder: select.querySelector('option:first-child')?.textContent || 'Seleccionar...',
          width: '100%'
        });
        
        // Restaurar valor si existe
        if (currentValue) {
          $select.val(currentValue).trigger('change');
        }
      }
    });
  }

  /**
   * Cargar datos existentes de residencia
   */
  function loadExistingData() {
    const provinceSelect = document.querySelector(config.selectors.province);
    const municipalitySelect = document.querySelector(config.selectors.municipality);
    const sectorSelect = document.querySelector(config.selectors.sector);

    if (!provinceSelect) return;

    const provinceId = provinceSelect.value;
    const municipalityId = municipalitySelect?.value;
    const sectorId = sectorSelect?.value;

    console.log('Datos existentes:', {
      provincia: provinceId,
      municipio: municipalityId,
      sector: sectorId
    });

    // Si hay provincia pero no municipios cargados, cargar municipios
    if (provinceId && municipalitySelect && municipalitySelect.options.length <= 1) {
      loadMunicipalities(provinceId, municipalityId).then(() => {
        // Si hay municipio pero no sectores cargados, cargar sectores
        if (municipalityId && sectorSelect && sectorSelect.options.length <= 1) {
          loadSectors(municipalityId, sectorId);
        }
      });
    }
    // Si hay municipio pero no sectores cargados, cargar sectores directamente
    else if (municipalityId && sectorSelect && sectorSelect.options.length <= 1) {
      loadSectors(municipalityId, sectorId);
    }

    // Configurar eventos de cambio
    setupSelectEvents();
  }

  /**
   * Configurar eventos de cambio para los selects
   */
  function setupSelectEvents() {
    const provinceSelect = document.querySelector(config.selectors.province);
    const municipalitySelect = document.querySelector(config.selectors.municipality);
    const sectorSelect = document.querySelector(config.selectors.sector);

    // Evento de cambio para provincia
    if (provinceSelect) {
      $(provinceSelect).off('change').on('change', function() {
        const provinceId = this.value;
        console.log('Provincia cambiada:', provinceId);
        
        // Limpiar municipios y sectores
        clearSelect(municipalitySelect);
        clearSelect(sectorSelect);
        
        // Cargar municipios si hay provincia seleccionada
        if (provinceId) {
          loadMunicipalities(provinceId);
        }
      });
    }

    // Evento de cambio para municipio
    if (municipalitySelect) {
      $(municipalitySelect).off('change').on('change', function() {
        const municipalityId = this.value;
        console.log('Municipio cambiado:', municipalityId);
        
        // Limpiar sectores
        clearSelect(sectorSelect);
        
        // Cargar sectores si hay municipio seleccionado
        if (municipalityId) {
          loadSectors(municipalityId);
        }
      });
    }
  }

  /**
   * Cargar municipios por provincia
   */
  function loadMunicipalities(provinceId, selectedMunicipalityId = null) {
    const municipalitySelect = document.querySelector(config.selectors.municipality);
    if (!municipalitySelect) return Promise.resolve();

    console.log('Cargando municipios para provincia:', provinceId);

    // Mostrar estado de carga
    setSelectLoading(municipalitySelect, 'Cargando municipios...');

    return fetch(`${config.api.municipalities}/${provinceId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCSRFToken()
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        populateSelect(municipalitySelect, data.data, selectedMunicipalityId, 'Seleccionar Municipio');
        console.log('Municipios cargados:', data.data.length);
      } else {
        throw new Error(data.message || 'Error al cargar municipios');
      }
    })
    .catch(error => {
      console.error('Error cargando municipios:', error);
      setSelectError(municipalitySelect, 'Error al cargar municipios');
      showNotification('Error al cargar los municipios', 'error');
    });
  }

  /**
   * Cargar sectores por municipio
   */
  function loadSectors(municipalityId, selectedSectorId = null) {
    const sectorSelect = document.querySelector(config.selectors.sector);
    if (!sectorSelect) return;

    console.log('Cargando sectores para municipio:', municipalityId);

    // Mostrar estado de carga
    setSelectLoading(sectorSelect, 'Cargando sectores...');

    fetch(`${config.api.sectors}/${municipalityId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCSRFToken()
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        populateSelect(sectorSelect, data.data, selectedSectorId, 'Seleccionar Sector');
        console.log('Sectores cargados:', data.data.length);
      } else {
        throw new Error(data.message || 'Error al cargar sectores');
      }
    })
    .catch(error => {
      console.error('Error cargando sectores:', error);
      setSelectError(sectorSelect, 'Error al cargar sectores');
      showNotification('Error al cargar los sectores', 'error');
    });
  }

  /**
   * Poblar un select con opciones
   */
  function populateSelect(select, options, selectedValue = null, placeholder = 'Seleccionar...') {
    if (!select) return;

    // Limpiar opciones existentes
    select.innerHTML = '';
    
    // Agregar opción por defecto
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = placeholder;
    select.appendChild(defaultOption);

    // Agregar opciones
    options.forEach(option => {
      const optionElement = document.createElement('option');
      optionElement.value = option.id;
      optionElement.textContent = option.name;
      
      if (selectedValue && option.id == selectedValue) {
        optionElement.selected = true;
      }
      
      select.appendChild(optionElement);
    });

    // Habilitar el select después de poblar
    select.disabled = false;

    // Actualizar Select2 si está inicializado
    if ($(select).hasClass('select2-hidden-accessible')) {
      $(select).trigger('change.select2');
    }
  }

  /**
   * Limpiar un select
   */
  function clearSelect(select) {
    if (!select) return;
    
    select.innerHTML = '<option value="">Seleccionar...</option>';
    
    if ($(select).hasClass('select2-hidden-accessible')) {
      $(select).trigger('change.select2');
    }
  }

  /**
   * Establecer estado de carga en un select
   */
  function setSelectLoading(select, message) {
    if (!select) return;
    
    select.innerHTML = `<option value="">${message}</option>`;
    select.disabled = true;
    
    if ($(select).hasClass('select2-hidden-accessible')) {
      $(select).trigger('change.select2');
    }
  }

  /**
   * Establecer estado de error en un select
   */
  function setSelectError(select, message) {
    if (!select) return;
    
    select.innerHTML = `<option value="">${message}</option>`;
    select.disabled = false;
    
    if ($(select).hasClass('select2-hidden-accessible')) {
      $(select).trigger('change.select2');
    }
  }

  /**
   * Inicializar validaciones del formulario
   */
  function initializeValidation() {
    const form = document.querySelector(config.selectors.form);
    if (!form) return;

    // Campos requeridos
    const requiredFields = ['birth_place', 'country', 'province_id', 'municipality_id'];
    
    requiredFields.forEach(fieldName => {
      const field = form.querySelector(`[name="${fieldName}"]`);
      if (field) {
        // Validación al perder el foco
        field.addEventListener('blur', () => validateField(field));
        
        // Validación al escribir (solo si ya tiene error)
        field.addEventListener('input', () => {
          if (field.classList.contains('is-invalid')) {
            validateField(field);
          }
        });
      }
    });

    // Validación especial para código postal
    const zipCodeField = document.querySelector(config.selectors.zipCode);
    if (zipCodeField) {
      zipCodeField.addEventListener('blur', () => validateZipCode(zipCodeField));
    }

    // Permitir envío del formulario sin validaciones restrictivas
    form.addEventListener('submit', (e) => {
      // Siempre permitir envío - sin validaciones que bloqueen
      validateForm(); // Solo para limpiar clases de validación
    });
  }

  /**
   * Validar un campo individual
   */
  function validateField(field) {
    if (!field.value.trim()) {
      field.classList.add('is-invalid');
      field.classList.remove('is-valid');
      return false;
    } else {
      field.classList.remove('is-invalid');
      field.classList.add('is-valid');
      return true;
    }
  }

  /**
   * Validar código postal (sin restricciones de dígitos)
   */
  function validateZipCode(field) {
    // Código postal es opcional y sin validación de formato
    field.classList.remove('is-invalid', 'is-valid');
    return true;
  }

  /**
   * Validar formulario completo (sin validaciones restrictivas)
   */
  function validateForm() {
    const form = document.querySelector(config.selectors.form);
    if (!form) return true; // Siempre permitir envío

    // Limpiar clases de validación de todos los campos
    const allFields = form.querySelectorAll('input, select, textarea');
    allFields.forEach(field => {
      field.classList.remove('is-invalid', 'is-valid');
    });

    return true; // Siempre válido para permitir actualización
  }

  /**
   * Inicializar seguimiento de cambios en el formulario
   */
  function initializeFormTracking() {
    const form = document.querySelector(config.selectors.form);
    if (!form) return;

    const formInputs = form.querySelectorAll('input, select, textarea');
    
    formInputs.forEach(input => {
      input.addEventListener('change', () => {
        state.formChanged = true;
        updateFormState();
      });

      input.addEventListener('input', () => {
        state.formChanged = true;
        updateFormState();
      });
    });

    // Confirmar antes de salir si hay cambios sin guardar
    window.addEventListener('beforeunload', (e) => {
      if (state.formChanged) {
        e.preventDefault();
        e.returnValue = '¿Estás seguro de que quieres salir? Los cambios no guardados se perderán.';
        return e.returnValue;
      }
    });

    // Marcar formulario como guardado cuando se envía exitosamente
    form.addEventListener('submit', () => {
      state.formChanged = false;
    });
  }

  /**
   * Actualizar estado del formulario
   */
  function updateFormState() {
    const submitButton = document.querySelector('button[type="submit"]');
    if (!submitButton) return;

    if (state.formChanged) {
      submitButton.classList.add('btn-warning');
      submitButton.classList.remove('btn-primary');
      submitButton.innerHTML = '<i class="icon-base ti tabler-edit me-1"></i>Guardar Cambios';
    } else {
      submitButton.classList.add('btn-primary');
      submitButton.classList.remove('btn-warning');
      submitButton.innerHTML = '<i class="icon-base ti tabler-check me-1"></i>Actualizar';
    }
  }

  /**
   * Inicializar máscara para código postal
   */
  function initializeZipCodeMask() {
    const zipCodeField = document.querySelector(config.selectors.zipCode);
    if (!zipCodeField) return;

    zipCodeField.addEventListener('input', (e) => {
      let value = e.target.value.replace(/\D/g, ''); // Solo números
      
      // Limitar a 5 dígitos
      if (value.length > 5) {
        value = value.substring(0, 5);
      }
      
      e.target.value = value;
    });

    // Permitir solo números
    zipCodeField.addEventListener('keypress', (e) => {
      const char = String.fromCharCode(e.which);
      if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 0) {
        e.preventDefault();
      }
    });
  }

  /**
   * Guardar datos originales del formulario
   */
  function saveOriginalFormData() {
    const form = document.querySelector(config.selectors.form);
    if (!form) return;

    const formData = new FormData(form);
    state.originalFormData = {};
    
    for (let [key, value] of formData.entries()) {
      state.originalFormData[key] = value;
    }
  }

  /**
   * Obtener token CSRF
   */
  function getCSRFToken() {
    const token = document.querySelector('meta[name="csrf-token"]');
    return token ? token.getAttribute('content') : '';
  }

  /**
   * Mostrar notificaciones al usuario
   */
  function showNotification(message, type = 'info') {
    // Verificar si SweetAlert2 está disponible
    if (typeof Swal !== 'undefined') {
      const iconMap = {
        success: 'success',
        error: 'error',
        warning: 'warning',
        info: 'info'
      };
      
      Swal.fire({
        icon: iconMap[type] || 'info',
        title: type === 'error' ? 'Error' : 'Información',
        text: message,
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
      });
    } else {
      // Fallback a alert nativo si SweetAlert2 no está disponible
      alert(message);
    }
  }

  // Exponer funciones globalmente si es necesario
  window.ResidenceInfo = {
    loadMunicipalities: loadMunicipalities,
    loadSectors: loadSectors,
    validateForm: validateForm,
    showNotification: showNotification,
    config: config,
    state: state
  };

})();
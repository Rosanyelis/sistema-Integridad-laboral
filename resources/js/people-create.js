/**
 * People Create Form
 * Funcionalidades específicas para el formulario de creación de personas
 */

'use strict';

(function () {
  'use strict';

  // Variables globales
  let flatpickrInstance = null;

  // Inicialización cuando el DOM esté listo
  document.addEventListener('DOMContentLoaded', function() {
    initializeFlatpickr();
    initializeImageUpload();
    initializeAgeCalculation();
    initializeInputMasks();
    initializeDynamicSelects();
  });

  /**
   * Inicializar Flatpickr para el campo de fecha de nacimiento
   */
  function initializeFlatpickr() {
    const flatpickrDate = document.querySelector('#flatpickr-date');
    
    if (flatpickrDate) {
      flatpickrInstance = flatpickrDate.flatpickr({
        monthSelectorType: 'static',
        static: true,
        dateFormat: 'Y-m-d',
        maxDate: 'today',
        locale: {
          firstDayOfWeek: 1,
          weekdays: {
            shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
          },
          months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
          }
        },
        onChange: function(selectedDates, dateStr, instance) {
          // Calcular edad automáticamente cuando cambie la fecha
          if (selectedDates.length > 0) {
            calculateAge(selectedDates[0]);
          }
        }
      });
    }
  }

  /**
   * Calcular la edad basada en la fecha de nacimiento
   * @param {Date} birthDate - Fecha de nacimiento
   */
  function calculateAge(birthDate) {
    const ageInput = document.getElementById('age');
    if (!ageInput) return;
    
    const today = new Date();
    const birth = new Date(birthDate);
    
    // Validar que la fecha de nacimiento no sea futura
    if (birth > today) {
      ageInput.value = '';
      showNotification('La fecha de nacimiento no puede ser futura', 'error');
      return;
    }
    
    let age = today.getFullYear() - birth.getFullYear();
    const monthDiff = today.getMonth() - birth.getMonth();
    
    // Ajustar la edad si el cumpleaños aún no ha ocurrido este año
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
      age--;
    }
    
    // Validar que la edad sea razonable (entre 0 y 120 años)
    if (age >= 0 && age <= 120) {
      ageInput.value = age;
    } else {
      ageInput.value = '';
      showNotification('La edad calculada no es válida', 'error');
    }
  }

  /**
   * Inicializar el cálculo de edad si ya hay una fecha cargada
   */
  function initializeAgeCalculation() {
    const birthDateInput = document.getElementById('flatpickr-date');
    
    if (birthDateInput && birthDateInput.value) {
      calculateAge(new Date(birthDateInput.value));
    }
  }

  /**
   * Inicializar máscaras de entrada para cédula y teléfono
   */
  function initializeInputMasks() {
    // Máscara para cédula (000-0000000-0)
    const dniInput = document.getElementById('dni');
    if (dniInput) {
      applyCedulaMask(dniInput);
    }

    // Máscara para cédula anterior (000-0000000-0)
    const previousDniInput = document.getElementById('previous_dni');
    if (previousDniInput) {
      applyCedulaMask(previousDniInput);
    }

    // Máscara para teléfono celular (0000-000-0000)
    const cellPhoneInput = document.getElementById('cell_phone');
    if (cellPhoneInput) {
      applyPhoneMask(cellPhoneInput);
    }

    // Máscara para teléfono de emergencia (0000-000-0000)
    const emergencyPhoneInput = document.getElementById('emergency_contact_phone');
    if (emergencyPhoneInput) {
      applyPhoneMask(emergencyPhoneInput);
    }
  }

  /**
   * Aplicar máscara de cédula (000-0000000-0)
   * @param {HTMLInputElement} input - Campo de entrada
   */
  function applyCedulaMask(input) {
    input.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, ''); // Solo números
      
      // Limitar a 11 dígitos
      if (value.length > 11) {
        value = value.substring(0, 11);
      }
      
      // Aplicar formato: 000-0000000-0
      let formattedValue = '';
      
      if (value.length > 0) {
        // Primeros 3 dígitos
        formattedValue = value.substring(0, 3);
        
        if (value.length > 3) {
          // Agregar primer guión y siguientes 7 dígitos
          formattedValue += '-' + value.substring(3, 10);
          
          if (value.length > 10) {
            // Agregar segundo guión y último dígito
            formattedValue += '-' + value.substring(10, 11);
          }
        }
      }
      
      e.target.value = formattedValue;
    });

    // Permitir solo números y guiones en el campo
    input.addEventListener('keypress', function(e) {
      const char = String.fromCharCode(e.which);
      if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 0) {
        e.preventDefault();
      }
    });

    // Manejar teclas de navegación y eliminación
    input.addEventListener('keydown', function(e) {
      // Permitir teclas de navegación, eliminación y edición
      const allowedKeys = [8, 9, 27, 46, 37, 38, 39, 40]; // backspace, tab, escape, delete, arrow keys
      if (allowedKeys.includes(e.keyCode) || 
          (e.keyCode === 65 && e.ctrlKey) || // Ctrl+A
          (e.keyCode === 67 && e.ctrlKey) || // Ctrl+C
          (e.keyCode === 86 && e.ctrlKey) || // Ctrl+V
          (e.keyCode === 88 && e.ctrlKey) || // Ctrl+X
          (e.keyCode === 90 && e.ctrlKey)) { // Ctrl+Z
        return;
      }
      
      // Permitir solo números
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
      }
    });
  }

  /**
   * Aplicar máscara de teléfono (0000-000-0000)
   * @param {HTMLInputElement} input - Campo de entrada
   */
  function applyPhoneMask(input) {
    input.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, ''); // Solo números
      
      // Limitar a 11 dígitos (4-3-4 = 11 dígitos total)
      if (value.length > 11) {
        value = value.substring(0, 11);
      }
      
      // Aplicar formato: 0000-000-0000
      let formattedValue = '';
      
      if (value.length > 0) {
        // Primeros 4 dígitos
        formattedValue = value.substring(0, 4);
        
        if (value.length > 4) {
          // Agregar primer guión y siguientes 3 dígitos
          formattedValue += '-' + value.substring(4, 7);
          
          if (value.length > 7) {
            // Agregar segundo guión y últimos 4 dígitos
            formattedValue += '-' + value.substring(7, 11);
          }
        }
      }
      
      e.target.value = formattedValue;
    });

    // Permitir solo números y guiones en el campo
    input.addEventListener('keypress', function(e) {
      const char = String.fromCharCode(e.which);
      if (!/[0-9]/.test(char) && e.which !== 8 && e.which !== 0) {
        e.preventDefault();
      }
    });

    // Manejar teclas de navegación y eliminación
    input.addEventListener('keydown', function(e) {
      // Permitir teclas de navegación, eliminación y edición
      const allowedKeys = [8, 9, 27, 46, 37, 38, 39, 40]; // backspace, tab, escape, delete, arrow keys
      if (allowedKeys.includes(e.keyCode) || 
          (e.keyCode === 65 && e.ctrlKey) || // Ctrl+A
          (e.keyCode === 67 && e.ctrlKey) || // Ctrl+C
          (e.keyCode === 86 && e.ctrlKey) || // Ctrl+V
          (e.keyCode === 88 && e.ctrlKey) || // Ctrl+X
          (e.keyCode === 90 && e.ctrlKey)) { // Ctrl+Z
        return;
      }
      
      // Permitir solo números
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
      }
    });
  }

  /**
   * Inicializar funcionalidad de carga de imágenes
   */
  function initializeImageUpload() {
    const uploadInput = document.getElementById('upload');
    const uploadedAvatar = document.getElementById('uploadedAvatar');
    const resetButton = document.querySelector('.account-image-reset');

    if (uploadInput && uploadedAvatar) {
      // Evento para cuando se selecciona una imagen
      uploadInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
          // Validar tipo de archivo
          if (!file.type.match('image.*')) {
            showNotification('Por favor selecciona un archivo de imagen válido', 'error');
            return;
          }
          
          // Validar tamaño de archivo (800KB máximo)
          if (file.size > 800 * 1024) {
            showNotification('El archivo es demasiado grande. Máximo 800KB', 'error');
            return;
          }
          
          // Crear objeto FileReader para previsualizar la imagen
          const reader = new FileReader();
          
          reader.onload = function(e) {
            uploadedAvatar.src = e.target.result;
            uploadedAvatar.style.display = 'block';
          };
          
          reader.readAsDataURL(file);
        }
      });
    }

    // Evento para resetear la imagen
    if (resetButton) {
      resetButton.addEventListener('click', function() {
        if (uploadInput) {
          uploadInput.value = '';
        }
        if (uploadedAvatar) {
          uploadedAvatar.src = "{{ asset('assets/img/avatars/1.png') }}";
        }
      });
    }
  }

  /**
   * Inicializar selects dinámicos para provincia, municipio y sector
   */
  function initializeDynamicSelects() {
    console.log('Inicializando selects dinámicos...');
    // Esperar a que Select2 se inicialice
    setTimeout(() => {
      const provinceSelect = $('#province_id');
      const municipalitySelect = $('#municipality_id');
      const sectorSelect = $('#sector_id');

      console.log('Selects encontrados:', {
        province: provinceSelect.length,
        municipality: municipalitySelect.length,
        sector: sectorSelect.length
      });

      if (provinceSelect.length) {
        console.log('Configurando evento change para provincia');
        provinceSelect.on('change', function() {
          const provinceId = $(this).val();
          console.log('Provincia seleccionada:', provinceId);
          
          // Limpiar municipios y sectores
          clearSelect2(municipalitySelect);
          clearSelect2(sectorSelect);
          
          if (provinceId) {
            loadMunicipalities(provinceId);
          }
        });
      }

      if (municipalitySelect.length) {
        municipalitySelect.on('change', function() {
          const municipalityId = $(this).val();
          
          // Limpiar sectores
          clearSelect2(sectorSelect);
          
          if (municipalityId) {
            loadSectors(municipalityId);
          }
        });
      }

      // Cargar municipios y sectores si ya hay valores seleccionados (para edición)
      if (provinceSelect.length && provinceSelect.val()) {
        loadMunicipalities(provinceSelect.val(), municipalitySelect.val());
      }
    }, 100);
  }

  /**
   * Cargar municipios por provincia
   * @param {string} provinceId - ID de la provincia
   * @param {string} selectedMunicipalityId - ID del municipio previamente seleccionado (opcional)
   */
  function loadMunicipalities(provinceId, selectedMunicipalityId = null) {
    const municipalitySelect = $('#municipality_id');
    
    if (!municipalitySelect.length) return;

    // Mostrar indicador de carga
    municipalitySelect.prop('disabled', true);
    municipalitySelect.empty().append('<option value="">Cargando municipios...</option>');
    municipalitySelect.trigger('change');

    console.log('Cargando municipios para provincia:', provinceId);
    
    fetch(`/api/municipalities/${provinceId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
      .then(response => {
        console.log('Respuesta del servidor:', response.status);
        return response.json();
      })
      .then(data => {
        console.log('Datos recibidos:', data);
        if (data.success) {
          municipalitySelect.empty().append('<option value="">Seleccionar Municipio</option>');
          
          data.data.forEach(municipality => {
            const option = $('<option></option>')
              .attr('value', municipality.id)
              .text(municipality.name);
            
            if (selectedMunicipalityId && municipality.id == selectedMunicipalityId) {
              option.prop('selected', true);
            }
            
            municipalitySelect.append(option);
          });
          console.log('Municipios cargados exitosamente');
        } else {
          municipalitySelect.empty().append('<option value="">Error al cargar municipios</option>');
          showNotification('Error al cargar los municipios', 'error');
        }
      })
      .catch(error => {
        console.error('Error en la petición:', error);
        municipalitySelect.empty().append('<option value="">Error al cargar municipios</option>');
        showNotification('Error al cargar los municipios', 'error');
      })
      .finally(() => {
        municipalitySelect.prop('disabled', false);
        municipalitySelect.trigger('change');
      });
  }

  /**
   * Cargar sectores por municipio
   * @param {string} municipalityId - ID del municipio
   * @param {string} selectedSectorId - ID del sector previamente seleccionado (opcional)
   */
  function loadSectors(municipalityId, selectedSectorId = null) {
    const sectorSelect = $('#sector_id');
    
    if (!sectorSelect.length) return;

    // Mostrar indicador de carga
    sectorSelect.prop('disabled', true);
    sectorSelect.empty().append('<option value="">Cargando sectores...</option>');
    sectorSelect.trigger('change');

    fetch(`/api/sectors/${municipalityId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          sectorSelect.empty().append('<option value="">Seleccionar Sector</option>');
          
          data.data.forEach(sector => {
            const option = $('<option></option>')
              .attr('value', sector.id)
              .text(sector.name);
            
            if (selectedSectorId && sector.id == selectedSectorId) {
              option.prop('selected', true);
            }
            
            sectorSelect.append(option);
          });
        } else {
          sectorSelect.empty().append('<option value="">Error al cargar sectores</option>');
          showNotification('Error al cargar los sectores', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        sectorSelect.empty().append('<option value="">Error al cargar sectores</option>');
        showNotification('Error al cargar los sectores', 'error');
      })
      .finally(() => {
        sectorSelect.prop('disabled', false);
        sectorSelect.trigger('change');
      });
  }

  /**
   * Limpiar un select y agregar opción por defecto
   * @param {jQuery} select - Elemento select a limpiar
   */
  function clearSelect2(select) {
    if (select && select.length) {
      select.empty().append('<option value="">Seleccionar...</option>');
      select.trigger('change');
    }
  }

  /**
   * Limpiar un select y agregar opción por defecto (versión vanilla JS)
   * @param {HTMLSelectElement} select - Elemento select a limpiar
   */
  function clearSelect(select) {
    if (select) {
      select.innerHTML = '<option value="">Seleccionar...</option>';
    }
  }

  /**
   * Mostrar notificaciones al usuario
   * @param {string} message - Mensaje a mostrar
   * @param {string} type - Tipo de notificación (success, error, warning, info)
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

  /**
   * Validar formulario antes del envío
   */
  function validateForm() {
    const requiredFields = [
      'name',
      'last_name', 
      'dni',
      'birth_date',
      'birth_place',
      'country',
      'province_id',
      'municipality_id',
      'cell_phone',
      'emergency_contact_name',
      'emergency_contact_phone'
    ];

    let isValid = true;
    let firstInvalidField = null;

    requiredFields.forEach(fieldName => {
      const field = document.querySelector(`[name="${fieldName}"]`);
      if (field && !field.value.trim()) {
        field.classList.add('is-invalid');
        if (!firstInvalidField) {
          firstInvalidField = field;
        }
        isValid = false;
      } else if (field) {
        field.classList.remove('is-invalid');
      }
    });

    // Validar email si está presente
    const emailField = document.querySelector('[name="email"]');
    if (emailField && emailField.value) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailField.value)) {
        emailField.classList.add('is-invalid');
        showNotification('Por favor ingresa un email válido', 'error');
        isValid = false;
      }
    }

    // Validar formato de cédula
    const dniField = document.querySelector('[name="dni"]');
    if (dniField && dniField.value) {
      const cedulaRegex = /^\d{3}-\d{7}-\d{1}$/;
      if (!cedulaRegex.test(dniField.value)) {
        dniField.classList.add('is-invalid');
        showNotification('La cédula debe tener el formato 000-0000000-0', 'error');
        isValid = false;
      }
    }

    // Validar formato de cédula anterior si está presente
    const previousDniField = document.querySelector('[name="previous_dni"]');
    if (previousDniField && previousDniField.value) {
      const cedulaRegex = /^\d{3}-\d{7}-\d{1}$/;
      if (!cedulaRegex.test(previousDniField.value)) {
        previousDniField.classList.add('is-invalid');
        showNotification('La cédula anterior debe tener el formato 000-0000000-0', 'error');
        isValid = false;
      }
    }

    // Validar formato de teléfono celular
    const cellPhoneField = document.querySelector('[name="cell_phone"]');
    if (cellPhoneField && cellPhoneField.value) {
      const phoneRegex = /^\d{4}-\d{3}-\d{4}$/;
      if (!phoneRegex.test(cellPhoneField.value)) {
        cellPhoneField.classList.add('is-invalid');
        showNotification('El teléfono celular debe tener el formato 0000-000-0000', 'error');
        isValid = false;
      }
    }

    if (!isValid && firstInvalidField) {
      firstInvalidField.focus();
      showNotification('Por favor completa todos los campos obligatorios', 'error');
    }

    return isValid;
  }

  // Evento para validar formulario antes del envío
  const form = document.getElementById('formAccountSettings');
  if (form) {
    form.addEventListener('submit', function(e) {
      if (!validateForm()) {
        e.preventDefault();
        return false;
      }
    });
  }

  // Funcionalidad para agregar teléfonos adicionales (placeholder)
  const addCellPhoneBtn = document.getElementById('addCellPhone');
  const addHomePhoneBtn = document.getElementById('addHomePhone');
  
  if (addCellPhoneBtn) {
    addCellPhoneBtn.addEventListener('click', function() {
      // Aquí se puede implementar la funcionalidad para agregar múltiples teléfonos
      console.log('Agregar teléfono celular adicional');
      showNotification('Funcionalidad de teléfonos adicionales próximamente', 'info');
    });
  }

  if (addHomePhoneBtn) {
    addHomePhoneBtn.addEventListener('click', function() {
      // Aquí se puede implementar la funcionalidad para agregar múltiples teléfonos
      console.log('Agregar teléfono fijo adicional');
      showNotification('Funcionalidad de teléfonos adicionales próximamente', 'info');
    });
  }

  // Exponer funciones globalmente si es necesario
  window.PeopleCreate = {
    calculateAge: calculateAge,
    showNotification: showNotification,
    validateForm: validateForm,
    applyCedulaMask: applyCedulaMask,
    applyPhoneMask: applyPhoneMask,
    loadMunicipalities: loadMunicipalities,
    loadSectors: loadSectors,
    clearSelect: clearSelect,
    clearSelect2: clearSelect2
  };

})();

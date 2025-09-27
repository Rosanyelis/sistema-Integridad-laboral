/**
 * People Show Form
 * Funcionalidades específicas para la vista de perfil de persona con edición
 */

'use strict';

(function () {
  'use strict';

  // Variables globales
  let isEditMode = false;

  // Inicialización cuando el DOM esté listo
  document.addEventListener('DOMContentLoaded', function() {
    initializeEditMode();
    initializeAgeCalculation();
    initializeImageUpload();
    initializeInputMasks();
    initializeDynamicSelects();
  });

  /**
   * Inicializar modo de edición
   */
  function initializeEditMode() {
    const editBtn = document.getElementById('editBtn');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const form = document.getElementById('formAccountSettings');
    const readOnlyView = document.getElementById('readOnlyView');
    const imageUploadSection = document.getElementById('imageUploadSection');

    if (editBtn) {
      editBtn.addEventListener('click', function() {
        enableEditMode();
      });
    }

    if (cancelEditBtn) {
      cancelEditBtn.addEventListener('click', function() {
        disableEditMode();
      });
    }
  }

  /**
   * Habilitar modo de edición
   */
  function enableEditMode() {
    isEditMode = true;
    
    const editBtn = document.getElementById('editBtn');
    const form = document.getElementById('formAccountSettings');
    const readOnlyView = document.getElementById('readOnlyView');
    const imageUploadSection = document.getElementById('imageUploadSection');

    // Cambiar botón de editar
    if (editBtn) {
      editBtn.style.display = 'none';
    }

    // Mostrar formulario y ocultar vista de solo lectura
    if (form) {
      form.style.display = 'block';
    }
    if (readOnlyView) {
      readOnlyView.style.display = 'none';
    }
    if (imageUploadSection) {
      imageUploadSection.style.display = 'block';
    }

    // Inicializar Select2 en los selects del formulario
    setTimeout(() => {
      $('.select2').select2({
        placeholder: 'Seleccionar...',
        allowClear: true
      });
    }, 100);
  }

  /**
   * Deshabilitar modo de edición
   */
  function disableEditMode() {
    isEditMode = false;
    
    const editBtn = document.getElementById('editBtn');
    const form = document.getElementById('formAccountSettings');
    const readOnlyView = document.getElementById('readOnlyView');
    const imageUploadSection = document.getElementById('imageUploadSection');

    // Restaurar botón de editar
    if (editBtn) {
      editBtn.style.display = 'inline-block';
    }

    // Ocultar formulario y mostrar vista de solo lectura
    if (form) {
      form.style.display = 'none';
    }
    if (readOnlyView) {
      readOnlyView.style.display = 'block';
    }
    if (imageUploadSection) {
      imageUploadSection.style.display = 'none';
    }

    // Limpiar errores de validación
    const errorElements = document.querySelectorAll('.is-invalid');
    errorElements.forEach(element => {
      element.classList.remove('is-invalid');
    });
  }

  /**
   * Inicializar el cálculo de edad con el input date nativo
   */
  function initializeAgeCalculation() {
    const birthDateInput = document.getElementById('birth_date');
    
    if (birthDateInput) {
      // Establecer fecha máxima como hoy
      const today = new Date().toISOString().split('T')[0];
      birthDateInput.setAttribute('max', today);
      
      // Agregar evento para calcular edad cuando cambie la fecha
      birthDateInput.addEventListener('change', function() {
        if (this.value) {
          calculateAge(new Date(this.value));
        } else {
          // Limpiar campo de edad si no hay fecha
          const ageInput = document.getElementById('age');
          if (ageInput) {
            ageInput.value = '';
          }
        }
      });
      
      // Calcular edad si ya hay una fecha cargada
      if (birthDateInput.value) {
        calculateAge(new Date(birthDateInput.value));
      }
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
  }

  /**
   * Inicializar selects dinámicos para provincia, municipio y sector
   */
  function initializeDynamicSelects() {
    // Esperar a que Select2 se inicialice
    setTimeout(() => {
      const provinceSelect = $('#province_id');
      const municipalitySelect = $('#municipality_id');
      const sectorSelect = $('#sector_id');

      if (provinceSelect.length) {
        provinceSelect.on('change', function() {
          const provinceId = $(this).val();
          
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
    }, 100);
  }

  /**
   * Cargar municipios por provincia
   * @param {string} provinceId - ID de la provincia
   */
  function loadMunicipalities(provinceId) {
    const municipalitySelect = $('#municipality_id');
    
    if (!municipalitySelect.length) return;

    // Mostrar indicador de carga
    municipalitySelect.prop('disabled', true);
    municipalitySelect.empty().append('<option value="">Cargando municipios...</option>');
    municipalitySelect.trigger('change');
    
    fetch(`/api/municipalities/${provinceId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          municipalitySelect.empty().append('<option value="">Seleccionar Municipio</option>');
          
          data.data.forEach(municipality => {
            const option = $('<option></option>')
              .attr('value', municipality.id)
              .text(municipality.name);
            
            municipalitySelect.append(option);
          });
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
   */
  function loadSectors(municipalityId) {
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
   * Validar formulario antes del envío (sin validaciones restrictivas)
   */
  function validateForm() {
    const form = document.getElementById('formAccountSettings');
    if (!form) return true; // Siempre permitir envío

    // Limpiar clases de validación de todos los campos
    const allFields = form.querySelectorAll('input, select, textarea');
    allFields.forEach(field => {
      field.classList.remove('is-invalid', 'is-valid');
    });

    return true; // Siempre válido para permitir actualización
  }

  // Evento para validar formulario antes del envío (sin restricciones)
  const form = document.getElementById('formAccountSettings');
  if (form) {
    form.addEventListener('submit', function(e) {
      // Siempre permitir envío - sin validaciones que bloqueen
      validateForm(); // Solo para limpiar clases de validación
    });
  }

  // Exponer funciones globalmente si es necesario
  window.PeopleShow = {
    enableEditMode: enableEditMode,
    disableEditMode: disableEditMode,
    calculateAge: calculateAge,
    showNotification: showNotification,
    validateForm: validateForm,
    loadMunicipalities: loadMunicipalities,
    loadSectors: loadSectors,
    clearSelect2: clearSelect2
  };

})();

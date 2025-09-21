// ========================================
// ARCHIVO ESPECÍFICO PARA CREAR ROLES
// ========================================

// Variables globales para creación
let originalPermissions = [];

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function (e) {
  console.log('=== INICIALIZANDO MÓDULO DE CREACIÓN DE ROLES ===');
  initializeCreateModule();
});

// También inicializar inmediatamente si el DOM ya está listo
if (document.readyState === 'loading') {
  console.log('DOM still loading, waiting for DOMContentLoaded');
} else {
  console.log('DOM already loaded, initializing immediately');
  initializeCreateModule();
}

function initializeCreateModule() {
  console.log('=== INICIALIZANDO MÓDULO DE CREACIÓN ===');
  console.log('Document ready state:', document.readyState);
  
  setTimeout(() => {
    console.log('Ejecutando inicialización de creación después del timeout...');
    initializeTooltips();
    initializeCreateEventListeners();
    loadOriginalPermissions();
    console.log('Create module initialized successfully');
  }, 100);
}

function initializeCreateEventListeners() {
  console.log('=== INICIALIZANDO EVENT LISTENERS DE CREACIÓN ===');
  
  const selectAllCheckbox = document.getElementById('selectAllPermissions') || document.getElementById('selectAll');
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  const roleNameInput = document.getElementById('roleName');
  const saveBtn = document.getElementById('savePermissions');
  
  console.log('Elements found:', {
    selectAllCheckbox: !!selectAllCheckbox,
    selectAllId: selectAllCheckbox ? selectAllCheckbox.id : 'not found',
    permissionCheckboxes: permissionCheckboxes.length,
    roleNameInput: !!roleNameInput,
    saveBtn: !!saveBtn,
    saveBtnId: saveBtn ? saveBtn.id : 'not found'
  });

  if (selectAllCheckbox) {
    console.log('Configurando event listener para Select All...');
    selectAllCheckbox.addEventListener('change', function () {
      console.log('=== SELECT ALL CHANGED ===');
      console.log('Select All changed to:', this.checked);
      const isChecked = this.checked;
      permissionCheckboxes.forEach((checkbox, index) => {
        checkbox.checked = isChecked;
        console.log(`Checkbox ${index + 1}:`, checkbox.value, '->', isChecked);
      });
      updateFormState();
      console.log('=== SELECT ALL COMPLETED ===');
    });
    console.log('Event listener configurado correctamente');
  } else {
    console.error('Select All checkbox not found!');
  }

  // Event listeners para checkboxes individuales
  permissionCheckboxes.forEach((checkbox, index) => {
    checkbox.addEventListener('change', function() {
      console.log(`Checkbox ${index + 1} changed:`, this.value, '->', this.checked);
      updateFormState();
    });
  });

  if (saveBtn) {
    console.log('Configurando event listener para botón de guardar...');
    saveBtn.addEventListener('click', function(e) {
      console.log('=== BOTÓN DE CREAR CLICKEADO ===');
      console.log('Event:', e);
      console.log('Button ID:', this.id);
      console.log('Button text:', this.textContent);
      
      const roleName = roleNameInput ? roleNameInput.value.trim() : '';
      console.log('Role name:', roleName);
      
      if (!roleName) {
        console.log('Error: Nombre del rol vacío');
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'El nombre del rol es obligatorio',
          confirmButtonText: 'Entendido'
        });
        return;
      }
      
      const selectedPermissions = Array.from(permissionCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
      console.log('Selected permissions:', selectedPermissions);
      
      if (selectedPermissions.length === 0) {
        console.log('Error: No hay permisos seleccionados');
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Debe seleccionar al menos un permiso para el rol',
          confirmButtonText: 'Entendido'
        });
        return;
      }
      
      console.log('Calling createRole()');
      createRole();
      console.log('=== BOTÓN DE CREAR COMPLETADO ===');
    });
    console.log('Event listener del botón configurado correctamente');
  } else {
    console.error('Save button not found!');
  }
  
  updateFormState();
}

function createRole() {
  console.log('=== FUNCIÓN createRole() INICIADA ===');
  const form = document.getElementById('createRoleForm') || document.querySelector('form');
  const saveBtn = document.getElementById('savePermissions');
  
  console.log('Elements found:', {
    form: !!form,
    saveBtn: !!saveBtn,
    formId: form ? form.id : 'not found',
    saveBtnId: saveBtn ? saveBtn.id : 'not found'
  });
  
  if (!form || !saveBtn) {
    console.error('Formulario o botón no encontrado');
    return;
  }

  const originalText = saveBtn.innerHTML;
  saveBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Creando...';
  saveBtn.disabled = true;
  
  // Obtener permisos seleccionados como array de enteros
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]:checked');
  const permissions = Array.from(permissionCheckboxes).map(cb => parseInt(cb.value));
  
  // Validar que se hayan seleccionado permisos
  if (permissions.length === 0) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Debe seleccionar al menos un permiso para el rol.',
      confirmButtonText: 'Entendido'
    });
    saveBtn.innerHTML = originalText;
    saveBtn.disabled = false;
    return;
  }
  
  const data = {
    _method: 'POST',
    name: document.getElementById('roleName').value.trim(),
    permissions: permissions
  };
  
  // Log para debug
  console.log('Sending role data:', data);
  console.log('Permissions array:', permissions);
  
  // Mostrar loading
  saveBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Creando...';
  saveBtn.disabled = true;
  
  fetch(form.action, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    console.log('Response status:', response.status);
    console.log('Response headers:', response.headers);
    
    // Verificar si la respuesta es JSON
    const contentType = response.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      console.error('Response is not JSON, content-type:', contentType);
      throw new Error('El servidor devolvió una respuesta no válida');
    }
    
    return response.json();
  })
  .then(data => {
    console.log('Response data:', data);
    
    if (data.success) {
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: data.message,
        confirmButtonText: 'Continuar',
        timer: 2000,
        timerProgressBar: true
      }).then(() => {
        // Redirigir a la lista de roles después de crear
        window.location.href = '/roles';
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: data.message,
        confirmButtonText: 'Entendido'
      });
      
      if (data.errors) {
        displayValidationErrors(data.errors);
      }
    }
  })
  .catch(error => {
    console.error('Error:', error);
    console.error('Error details:', {
      message: error.message,
      stack: error.stack
    });
    
    // Verificar si SweetAlert está disponible
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Error al crear el rol: ' + error.message,
        confirmButtonText: 'Entendido'
      });
    } else {
      alert('Error al crear el rol: ' + error.message);
    }
  })
  .finally(() => {
    saveBtn.innerHTML = originalText;
    saveBtn.disabled = false;
    console.log('=== FUNCIÓN createRole() COMPLETADA ===');
  });
}

function updateFormState() {
  const roleNameInput = document.getElementById('roleName');
  const saveBtn = document.getElementById('savePermissions');
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  const selectAllCheckbox = document.getElementById('selectAllPermissions') || document.getElementById('selectAll');
  
  if (!roleNameInput || !saveBtn) return;
  
  const roleName = roleNameInput.value.trim();
  const selectedPermissions = Array.from(permissionCheckboxes).filter(cb => cb.checked);
  
  // Habilitar/deshabilitar botón de guardar
  const hasValidName = roleName.length > 0;
  const hasPermissions = selectedPermissions.length > 0;
  
  saveBtn.disabled = !(hasValidName && hasPermissions);
  
  // Actualizar estado del "Seleccionar Todo"
  if (selectAllCheckbox) {
    const totalCheckboxes = permissionCheckboxes.length;
    const checkedCheckboxes = selectedPermissions.length;
    
    if (checkedCheckboxes === 0) {
      selectAllCheckbox.checked = false;
      selectAllCheckbox.indeterminate = false;
    } else if (checkedCheckboxes === totalCheckboxes) {
      selectAllCheckbox.checked = true;
      selectAllCheckbox.indeterminate = false;
    } else {
      selectAllCheckbox.checked = false;
      selectAllCheckbox.indeterminate = true;
    }
  }
}

function displayValidationErrors(errors) {
  // Limpiar errores anteriores
  document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
  document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
  
  // Mostrar nuevos errores
  Object.keys(errors).forEach(field => {
    const input = document.querySelector(`[name="${field}"]`);
    if (input) {
      input.classList.add('is-invalid');
      const errorDiv = document.createElement('div');
      errorDiv.className = 'invalid-feedback';
      errorDiv.textContent = errors[field][0];
      input.parentNode.appendChild(errorDiv);
    }
  });
  
  Swal.fire({
    icon: 'error',
    title: 'Errores de Validación',
    text: 'Por favor, corrige los errores en el formulario',
    confirmButtonText: 'Entendido'
  });
}

function loadOriginalPermissions() {
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  originalPermissions = Array.from(permissionCheckboxes).map(cb => ({
    id: cb.value,
    checked: cb.checked
  }));
  console.log('Original permissions loaded:', originalPermissions);
}

function initializeTooltips() {
  // Inicializar tooltips si es necesario
  if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }
}

// Función global para ser llamada desde el HTML
window.toggleModulePermissions = function(moduleKey) {
  console.log('toggleModulePermissions called for:', moduleKey);
  updateFormState();
};

window.checkModulePermissions = function(moduleKey) {
  console.log('checkModulePermissions called for:', moduleKey);
  updateFormState();
};

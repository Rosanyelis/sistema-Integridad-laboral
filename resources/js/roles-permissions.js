/**
 * Roles Permissions Management Module
 */

'use strict';

// Variables globales
let hasChanges = false;
let originalPermissions = [];

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function (e) {
  console.log('DOM Content Loaded - Iniciando módulo');
  initializePermissionsModule();
});

// También inicializar inmediatamente si el DOM ya está listo
if (document.readyState === 'loading') {
  console.log('DOM still loading, waiting for DOMContentLoaded');
} else {
  console.log('DOM already loaded, initializing immediately');
  initializePermissionsModule();
}

/**
 * Inicializa el módulo de permisos
 */
function initializePermissionsModule() {
  console.log('=== INICIALIZANDO MÓDULO DE PERMISOS ===');
  console.log('Document ready state:', document.readyState);
  console.log('Window variables:', {
    isEditMode: window.isEditMode,
    roleId: window.roleId
  });
  
  // Esperar un poco para asegurar que el DOM esté completamente cargado
  setTimeout(() => {
    console.log('Ejecutando inicialización después del timeout...');
    
    // Inicializar tooltips
    initializeTooltips();
    
    // Inicializar event listeners
    initializeEventListeners();
    
    // Cargar permisos originales
    loadOriginalPermissions();
    
    console.log('Permissions module initialized successfully');
  }, 100);
}

/**
 * Inicializa los tooltips
 */
function initializeTooltips() {
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}

/**
 * Inicializa los event listeners
 */
function initializeEventListeners() {
  console.log('=== INICIALIZANDO EVENT LISTENERS ===');
  console.log('Window variables:', {
    isEditMode: window.isEditMode,
    roleId: window.roleId
  });
  
  const selectAllCheckbox = document.getElementById('selectAllPermissions') || document.getElementById('selectAll');
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  const moduleCheckboxes = document.querySelectorAll('input[data-module]');
  const roleNameInput = document.getElementById('roleName');
  const roleStatusInput = document.getElementById('roleStatus');
  const saveBtn = document.getElementById('savePermissions') || document.getElementById('updateRoleBtn');
  const confirmSaveBtn = document.getElementById('confirmSaveChanges');
  
  console.log('Elements found:', {
    selectAllCheckbox: !!selectAllCheckbox,
    selectAllId: selectAllCheckbox ? selectAllCheckbox.id : 'not found',
    permissionCheckboxes: permissionCheckboxes.length,
    moduleCheckboxes: moduleCheckboxes.length,
    roleNameInput: !!roleNameInput,
    saveBtn: !!saveBtn,
    saveBtnId: saveBtn ? saveBtn.id : 'not found',
    isEditMode: window.isEditMode,
    roleId: window.roleId
  });


  // Event listener para "Seleccionar Todo" global
  console.log('Select All Checkbox found:', selectAllCheckbox);
  console.log('Permission checkboxes found:', permissionCheckboxes.length);
  
  if (selectAllCheckbox) {
    console.log('Configurando event listener para Select All...');
    selectAllCheckbox.addEventListener('change', function () {
      console.log('=== SELECT ALL CHANGED ===');
      console.log('Select All changed to:', this.checked);
      const isChecked = this.checked;
      
      // Actualizar todos los checkboxes de permisos
      console.log('Actualizando', permissionCheckboxes.length, 'checkboxes...');
      permissionCheckboxes.forEach((checkbox, index) => {
        checkbox.checked = isChecked;
        console.log(`Checkbox ${index + 1}:`, checkbox.value, '->', isChecked);
      });
      
      console.log('Llamando updateFormState...');
      updateFormState();
      console.log('=== SELECT ALL COMPLETED ===');
    });
    console.log('Event listener configurado correctamente');
  } else {
    console.error('Select All checkbox not found!');
    console.log('Buscando elementos con id selectAllPermissions o selectAll...');
    console.log('Elementos encontrados:', {
      selectAllPermissions: document.getElementById('selectAllPermissions'),
      selectAll: document.getElementById('selectAll')
    });
  }

  // Event listeners para checkboxes de módulos (ahora no hay checkboxes de módulo individuales en la tabla)
  // La funcionalidad de selección por módulo se maneja a través de la tabla

  // Event listeners para checkboxes de permisos individuales - VERSIÓN SIMPLIFICADA
  permissionCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      // Log para debug
      console.log('Checkbox changed:', {
        id: this.id,
        value: this.value,
        checked: this.checked
      });
      
      // Solo actualizar el estado del formulario
      updateFormState();
    });
  });

  // Event listeners para campos de texto
  if (roleNameInput) {
    roleNameInput.addEventListener('input', function() {
      checkFormChanges();
    });
  }
  
  if (roleStatusInput) {
    roleStatusInput.addEventListener('change', function() {
      markAsChanged();
    });
  }

  // Botón de guardar cambios - GUARDADO DIRECTO CON SWEETALERT
  if (saveBtn) {
    console.log('Configurando event listener para botón de guardar...');
    saveBtn.addEventListener('click', function(e) {
      console.log('=== BOTÓN DE GUARDAR CLICKEADO ===');
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
          text: 'El nombre del rol es obligatorio.',
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
          text: 'Debe seleccionar al menos un permiso para el rol.',
          confirmButtonText: 'Entendido'
        });
        return;
      }
      
      // Determinar si es modo edición o creación
      console.log('Checking mode:', {
        isEditMode: window.isEditMode,
        roleId: window.roleId,
        saveBtnId: saveBtn.id
      });
      
      if (window.isEditMode && window.roleId) {
        console.log('Calling updateRole()');
        updateRole();
      } else {
        console.log('Calling savePermissions()');
        savePermissions();
      }
      console.log('=== BOTÓN DE GUARDAR COMPLETADO ===');
    });
    console.log('Event listener del botón configurado correctamente');
  } else {
    console.error('Save button not found!');
    console.log('Buscando botones de guardar...');
    console.log('Elementos encontrados:', {
      savePermissions: document.getElementById('savePermissions'),
      updateRoleBtn: document.getElementById('updateRoleBtn')
    });
  }
  
  // Actualizar el estado inicial del formulario
  updateFormState();
}

/**
 * Carga los permisos originales
 */
function loadOriginalPermissions() {
  const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
  originalPermissions = Array.from(checkboxes).map(cb => ({
    id: cb.value,
    checked: cb.checked
  }));
  
  console.log('Original permissions loaded:', originalPermissions);
}

/**
 * Carga los permisos del rol
 */
function loadRolePermissions() {
  const roleId = document.getElementById('roleId').value;
  if (!roleId) return;
  
  fetch(`/roles/${roleId}/data`)
    .then(response => response.json())
    .then(data => {
      if (data.success && data.role.permissions) {
        // Desmarcar todos los permisos
        const checkboxes = document.querySelectorAll('input[name="permissions[]"]');
        checkboxes.forEach(checkbox => {
          checkbox.checked = false;
        });
        
        // Marcar los permisos del rol
        data.role.permissions.forEach(permission => {
          const checkbox = document.querySelector(`input[name="permissions[]"][value="${permission.id}"]`);
          if (checkbox) {
            checkbox.checked = true;
          }
        });
        
        // Actualizar el estado de los módulos
        updateAllModuleStates();
        
        // Recargar permisos originales
        loadOriginalPermissions();
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification('Error al cargar los permisos del rol', 'error');
    });
}

/**
 * Verifica si todos los módulos están seleccionados para activar el select all global - VERSIÓN SIMPLIFICADA
 */
function checkGlobalSelectAll() {
  const selectAllCheckbox = document.getElementById('selectAllPermissions') || document.getElementById('selectAll');
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  
  console.log('Checking global select all:', {
    selectAllCheckbox: !!selectAllCheckbox,
    permissionCheckboxes: permissionCheckboxes.length
  });
  
  if (selectAllCheckbox && permissionCheckboxes.length > 0) {
    const checkedPermissions = Array.from(permissionCheckboxes).filter(cb => cb.checked);
    const allChecked = checkedPermissions.length === permissionCheckboxes.length;
    selectAllCheckbox.checked = allChecked;
    
    console.log('Global select all updated:', {
      checked: checkedPermissions.length,
      total: permissionCheckboxes.length,
      allChecked: allChecked
    });
  }
}

/**
 * Actualiza el estado del formulario de manera simple
 */
function updateFormState() {
  const roleNameInput = document.getElementById('roleName');
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  const saveBtn = document.getElementById('savePermissions') || document.getElementById('updateRoleBtn');

  const currentRoleName = roleNameInput ? roleNameInput.value.trim() : '';
  const selectedPermissions = Array.from(permissionCheckboxes).filter(cb => cb.checked);

  // Habilitar botón solo si hay nombre y al menos un permiso
  const canSave = currentRoleName !== '' && selectedPermissions.length > 0;

  if (saveBtn) {
    saveBtn.disabled = !canSave;
    if (canSave) {
      saveBtn.classList.remove('btn-secondary');
      saveBtn.classList.add('btn-primary');
    } else {
      saveBtn.classList.remove('btn-primary');
      saveBtn.classList.add('btn-secondary');
    }
  }

  // Actualizar el estado del select all global
  checkGlobalSelectAll();

  // Log para debug
  console.log('Form state updated:', {
    roleName: currentRoleName,
    selectedCount: selectedPermissions.length,
    canSave: canSave,
    saveBtn: !!saveBtn
  });
}

/**
 * Verifica si hay cambios en el formulario para habilitar/deshabilitar el botón de guardar
 */
function checkFormChanges() {
  updateFormState();
}

/**
 * Marca que hay cambios pendientes
 */
function markAsChanged() {
  hasChanges = true;
  updateFormState();
}

/**
 * Toggle de permisos por módulo - VERSIÓN SIMPLIFICADA
 */
function toggleModulePermissions(moduleKey) {
  const permissionCheckboxes = document.querySelectorAll(`input[name="permissions[]"][data-module="${moduleKey}"]`);
  
  // Si no hay permisos seleccionados, seleccionar todos
  // Si todos están seleccionados, deseleccionar todos
  const checkedCount = Array.from(permissionCheckboxes).filter(cb => cb.checked).length;
  const isAllChecked = checkedCount === permissionCheckboxes.length;
  
  // Cambiar el estado de todos los checkboxes del módulo
  permissionCheckboxes.forEach(checkbox => {
    checkbox.checked = !isAllChecked;
  });
  
  // Actualizar el estado del formulario
  updateFormState();
}

/**
 * Verifica el estado de los permisos de un módulo - VERSIÓN SIMPLIFICADA
 */
function checkModulePermissions(moduleKey) {
  // Solo actualizar el estado del formulario
  updateFormState();
}

/**
 * Actualiza el estado de todos los módulos - VERSIÓN SIMPLIFICADA
 */
function updateAllModuleStates() {
  // Solo actualizar el estado del formulario
  updateFormState();
}

/**
 * Guarda los permisos
 */
function savePermissions() {
  console.log('savePermissions() called');
  const form = document.getElementById('permissionsForm') || document.getElementById('createRoleForm') || document.getElementById('editRoleForm');
  const saveBtn = document.getElementById('savePermissions') || document.getElementById('updateRoleBtn');
  
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
  saveBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Guardando...';
  saveBtn.disabled = true;
  
  // Obtener permisos seleccionados como array de enteros - VERSIÓN SIMPLIFICADA
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
  .then(response => response.json())
  .then(data => {
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
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Error al guardar los permisos. Por favor, inténtalo de nuevo.',
      confirmButtonText: 'Entendido'
    });
  })
  .finally(() => {
    saveBtn.innerHTML = originalText;
    saveBtn.disabled = false;
  });
}

/**
 * Muestra una notificación
 */
function showNotification(message, type = 'info') {
  // Usar alert nativo con estilos básicos
  const alertClass = type === 'success' ? 'alert-success' : type === 'error' ? 'alert-danger' : 'alert-info';
  const alertHtml = `
    <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
         style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
  
  // Crear y mostrar el alert
  const alertElement = document.createElement('div');
  alertElement.innerHTML = alertHtml;
  document.body.appendChild(alertElement.firstElementChild);
  
  // Auto-remover después de 3 segundos
  setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (alert) {
      alert.remove();
    }
  }, 3000);
}

/**
 * Muestra errores de validación con SweetAlert
 */
function displayValidationErrors(errors) {
  // Limpiar errores anteriores
  document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
  document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
  
  // Crear mensaje de errores
  let errorMessage = 'Se encontraron los siguientes errores:\n\n';
  Object.keys(errors).forEach(field => {
    errorMessage += `• ${errors[field][0]}\n`;
    
    // También marcar el campo como inválido
    const input = document.querySelector(`[name="${field}"]`);
    if (input) {
      input.classList.add('is-invalid');
      
      const errorDiv = document.createElement('div');
      errorDiv.className = 'invalid-feedback';
      errorDiv.textContent = errors[field][0];
      
      input.parentNode.appendChild(errorDiv);
    }
  });
  
  // Mostrar errores con SweetAlert
  Swal.fire({
    icon: 'error',
    title: 'Errores de Validación',
    text: errorMessage,
    confirmButtonText: 'Entendido'
  });
}

/**
 * Valida el formulario antes de guardar con SweetAlert
 */
function validateForm() {
  const roleName = document.getElementById('roleName').value.trim();
  if (!roleName) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'El nombre del rol es requerido',
      confirmButtonText: 'Entendido'
    });
    return false;
  }
  
  const selectedPermissions = document.querySelectorAll('input[name="permissions[]"]:checked');
  if (selectedPermissions.length === 0) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Debe seleccionar al menos un permiso',
      confirmButtonText: 'Entendido'
    });
    return false;
  }
  
  return true;
}

/**
 * Actualiza un rol existente
 */
function updateRole() {
  console.log('=== FUNCIÓN updateRole() INICIADA ===');
  const form = document.getElementById('editRoleForm');
  const saveBtn = document.getElementById('updateRoleBtn');
  
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
  saveBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Actualizando...';
  saveBtn.disabled = true;

  const data = {
    _method: 'PUT',
    name: document.getElementById('roleName').value.trim(),
    permissions: Array.from(document.querySelectorAll('input[name="permissions[]"]:checked')).map(cb => parseInt(cb.value))
  };

  console.log('Updating role with data:', data);
  console.log('Update role URL:', window.updateRoleUrl);
  
  // Verificar que la URL esté disponible
  if (!window.updateRoleUrl) {
    console.error('updateRoleUrl no está definida');
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'URL de actualización no configurada',
      confirmButtonText: 'Entendido'
    });
    return;
  }

  // Usar FormData para enviar PUT correctamente
  const formData = new FormData();
  formData.append('_method', 'PUT');
  formData.append('name', data.name);
  data.permissions.forEach(permissionId => {
    formData.append('permissions[]', permissionId);
  });

  fetch(window.updateRoleUrl, {
    method: 'POST', // Laravel requiere POST para simular PUT
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: formData
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
        // Redirigir a la lista de roles después de actualizar
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
        text: 'Error al actualizar el rol: ' + error.message,
        confirmButtonText: 'Entendido'
      });
    } else {
      alert('Error al actualizar el rol: ' + error.message);
    }
  })
  .finally(() => {
    saveBtn.innerHTML = originalText;
    saveBtn.disabled = false;
    console.log('=== FUNCIÓN updateRole() COMPLETADA ===');
  });
}

// Función global para ser llamada desde el HTML
window.toggleModulePermissions = toggleModulePermissions;
window.checkModulePermissions = checkModulePermissions;

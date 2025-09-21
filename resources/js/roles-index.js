/**
 * Roles Management Module
 */

'use strict';

// Variables globales
let rolesData = [];
let currentRoleId = null;

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function (e) {
  initializeRolesModule();
});

/**
 * Inicializa el módulo de roles
 */
function initializeRolesModule() {
  // Inicializar búsqueda
  initializeSearch();
  
  // Inicializar modales
  initializeModals();
  
  // Inicializar botones de acción
  initializeActionButtons();
  
  // Cargar datos iniciales
  loadRolesData();
}

/**
 * Inicializa la funcionalidad de búsqueda
 */
function initializeSearch() {
  const searchInput = document.getElementById('searchRole');
  const searchBtn = document.getElementById('searchBtn');
  
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      filterRoles(searchTerm);
    });
  }
  
  if (searchBtn) {
    searchBtn.addEventListener('click', function() {
      const searchTerm = document.getElementById('searchRole').value.toLowerCase();
      filterRoles(searchTerm);
    });
  }
}

/**
 * Filtra los roles según el término de búsqueda
 */
function filterRoles(searchTerm) {
  const roleCards = document.querySelectorAll('.role-card');
  
  roleCards.forEach(card => {
    const roleName = card.querySelector('.role-name h5').textContent.toLowerCase();
    const roleContainer = card.closest('.col-xl-4');
    
    if (roleName.includes(searchTerm)) {
      roleContainer.style.display = 'block';
    } else {
      roleContainer.style.display = 'none';
    }
  });
}

/**
 * Inicializa los modales
 */
function initializeModals() {
  // Modal de agregar/editar rol
  const addRoleModal = document.getElementById('addRoleModal');
  if (addRoleModal) {
    addRoleModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const roleId = button ? button.getAttribute('data-role-id') : null;
      
      if (roleId) {
        // Modo edición
        currentRoleId = roleId;
        loadRoleData(roleId);
        document.querySelector('.role-title').textContent = 'Editar Rol';
      } else {
        // Modo creación
        currentRoleId = null;
        resetRoleForm();
        document.querySelector('.role-title').textContent = 'Agregar Nuevo Rol';
      }
    });
  }
  
  // Modal de confirmación de eliminación
  const deleteModal = document.getElementById('deleteRoleModal');
  if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const roleId = button.getAttribute('data-role-id');
      const roleName = button.getAttribute('data-role-name');
      
      currentRoleId = roleId;
      document.querySelector('#deleteRoleName').textContent = roleName;
    });
  }
}

/**
 * Inicializa los botones de acción
 */
function initializeActionButtons() {
  // Botones de editar rol
  document.addEventListener('click', function(e) {
    if (e.target.closest('.role-edit-modal')) {
      e.preventDefault();
      const roleId = e.target.closest('.role-edit-modal').getAttribute('data-role-id');
      openEditRoleModal(roleId);
    }
  });
  
  // Botones de eliminar rol
  document.addEventListener('click', function(e) {
    if (e.target.closest('.delete-role')) {
      e.preventDefault();
      const roleId = e.target.closest('.delete-role').getAttribute('data-role-id');
      const roleName = e.target.closest('.delete-role').getAttribute('data-role-name');
      openDeleteRoleModal(roleId, roleName);
    }
  });
  
  // Botones de copiar rol
  document.addEventListener('click', function(e) {
    if (e.target.closest('.copy-role')) {
      e.preventDefault();
      const roleId = e.target.closest('.copy-role').getAttribute('data-role-id');
      copyRole(roleId);
    }
  });
  
  // Formulario de rol
  const roleForm = document.getElementById('roleForm');
  if (roleForm) {
    roleForm.addEventListener('submit', function(e) {
      e.preventDefault();
      saveRole();
    });
  }
  
  // Botón de confirmar eliminación
  const confirmDeleteBtn = document.getElementById('confirmDeleteRole');
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
      deleteRole(currentRoleId);
    });
  }
}

/**
 * Abre el modal de edición de rol
 */
function openEditRoleModal(roleId) {
  const modal = new bootstrap.Modal(document.getElementById('addRoleModal'));
  currentRoleId = roleId;
  loadRoleData(roleId);
  document.querySelector('.role-title').textContent = 'Editar Rol';
  modal.show();
}

/**
 * Abre el modal de confirmación de eliminación
 */
function openDeleteRoleModal(roleId, roleName) {
  const modal = new bootstrap.Modal(document.getElementById('deleteRoleModal'));
  currentRoleId = roleId;
  document.querySelector('#deleteRoleName').textContent = roleName;
  modal.show();
}

/**
 * Carga los datos de un rol específico
 */
function loadRoleData(roleId) {
  fetch(`/roles/${roleId}/data`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const role = data.role;
        
        // Llenar formulario
        document.getElementById('roleName').value = role.name;
        document.getElementById('roleDescription').value = role.description || '';
        
        // Cargar permisos
        loadRolePermissions(role.permissions);
      } else {
        showNotification('Error al cargar los datos del rol', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification('Error al cargar los datos del rol', 'error');
    });
}

/**
 * Carga los permisos del rol en el formulario
 */
function loadRolePermissions(permissions) {
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  
  // Desmarcar todos los permisos
  permissionCheckboxes.forEach(checkbox => {
    checkbox.checked = false;
  });
  
  // Marcar los permisos del rol
  permissions.forEach(permission => {
    const checkbox = document.querySelector(`input[name="permissions[]"][value="${permission.id}"]`);
    if (checkbox) {
      checkbox.checked = true;
    }
  });
}

/**
 * Resetea el formulario de rol
 */
function resetRoleForm() {
  document.getElementById('roleForm').reset();
  
  // Desmarcar todos los permisos
  const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
  permissionCheckboxes.forEach(checkbox => {
    checkbox.checked = false;
  });
}

/**
 * Guarda el rol (crear o actualizar)
 */
function saveRole() {
  const formData = new FormData(document.getElementById('roleForm'));
  const permissions = Array.from(document.querySelectorAll('input[name="permissions[]"]:checked')).map(cb => cb.value);
  
  const data = {
    name: formData.get('name'),
    description: formData.get('description'),
    permissions: permissions
  };
  
  const url = currentRoleId ? `/roles/${currentRoleId}` : '/roles';
  const method = currentRoleId ? 'PUT' : 'POST';
  
  fetch(url, {
    method: method,
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showNotification(data.message, 'success');
      closeModal('addRoleModal');
      location.reload(); // Recargar la página para mostrar los cambios
    } else {
      showNotification(data.message, 'error');
      if (data.errors) {
        displayValidationErrors(data.errors);
      }
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('Error al guardar el rol', 'error');
  });
}

/**
 * Elimina un rol
 */
function deleteRole(roleId) {
  fetch(`/roles/${roleId}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showNotification(data.message, 'success');
      closeModal('deleteRoleModal');
      location.reload(); // Recargar la página para mostrar los cambios
    } else {
      showNotification(data.message, 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('Error al eliminar el rol', 'error');
  });
}

/**
 * Copia un rol
 */
function copyRole(roleId) {
  fetch(`/roles/${roleId}/data`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const role = data.role;
        
        // Llenar formulario con datos del rol a copiar
        document.getElementById('roleName').value = role.name + ' (Copia)';
        document.getElementById('roleDescription').value = role.description || '';
        
        // Cargar permisos
        loadRolePermissions(role.permissions);
        
        // Abrir modal
        currentRoleId = null; // Para crear nuevo rol
        document.querySelector('.role-title').textContent = 'Copiar Rol';
        const modal = new bootstrap.Modal(document.getElementById('addRoleModal'));
        modal.show();
      } else {
        showNotification('Error al cargar los datos del rol', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showNotification('Error al cargar los datos del rol', 'error');
    });
}

/**
 * Carga los datos de roles
 */
function loadRolesData() {
  // Esta función se puede usar para cargar datos adicionales si es necesario
  console.log('Roles data loaded');
}

/**
 * Cierra un modal
 */
function closeModal(modalId) {
  const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
  if (modal) {
    modal.hide();
  }
}

/**
 * Muestra una notificación
 */
function showNotification(message, type = 'info') {
  // Usar SweetAlert2 si está disponible, sino usar alert nativo
  if (typeof Swal !== 'undefined') {
    const icon = type === 'success' ? 'success' : type === 'error' ? 'error' : 'info';
    Swal.fire({
      title: message,
      icon: icon,
      timer: 3000,
      showConfirmButton: false
    });
  } else {
    alert(message);
  }
}

/**
 * Muestra errores de validación
 */
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
}

/**
 * Toggle de permisos por categoría
 */
function togglePermissionCategory(category) {
  const categoryCheckbox = document.getElementById(`category_${category}`);
  const permissionCheckboxes = document.querySelectorAll(`input[name="permissions[]"][data-category="${category}"]`);
  
  permissionCheckboxes.forEach(checkbox => {
    checkbox.checked = categoryCheckbox.checked;
  });
}

/**
 * Verifica si todos los permisos de una categoría están seleccionados
 */
function checkCategoryPermissions(category) {
  const permissionCheckboxes = document.querySelectorAll(`input[name="permissions[]"][data-category="${category}"]`);
  const categoryCheckbox = document.getElementById(`category_${category}`);
  
  const checkedCount = Array.from(permissionCheckboxes).filter(cb => cb.checked).length;
  const totalCount = permissionCheckboxes.length;
  
  if (checkedCount === 0) {
    categoryCheckbox.indeterminate = false;
    categoryCheckbox.checked = false;
  } else if (checkedCount === totalCount) {
    categoryCheckbox.indeterminate = false;
    categoryCheckbox.checked = true;
  } else {
    categoryCheckbox.indeterminate = true;
  }
}

// Inicializar toggles de categorías
document.addEventListener('DOMContentLoaded', function() {
  // Agregar event listeners a los checkboxes de categorías
  document.querySelectorAll('input[id^="category_"]').forEach(checkbox => {
    const category = checkbox.id.replace('category_', '');
    checkbox.addEventListener('change', () => togglePermissionCategory(category));
  });
  
  // Agregar event listeners a los checkboxes de permisos individuales
  document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
    const category = checkbox.getAttribute('data-category');
    if (category) {
      checkbox.addEventListener('change', () => checkCategoryPermissions(category));
    }
  });
});

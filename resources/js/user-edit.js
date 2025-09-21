'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const editUserForm = document.getElementById('editUserForm');
  
  if (editUserForm) {
    editUserForm.addEventListener('submit', function (e) {
      e.preventDefault();
      
      // Limpiar errores previos
      clearErrors();
      
      // Mostrar loading
      const submitBtn = editUserForm.querySelector('button[type="submit"]');
      const originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<i class="icon-base ti tabler-loader-2 me-1"></i>Actualizando...';
      submitBtn.disabled = true;
      
      // Preparar datos del formulario
      const formData = new FormData(editUserForm);
      
      // Enviar petición AJAX
      fetch(editUserForm.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => {
        console.log('Respuesta recibida, status:', response.status);
        return response.json().then(data => {
          return { status: response.status, data: data };
        });
      })
      .then(result => {
        console.log('Datos procesados:', result);
        
        if (result.status === 200 || result.status === 201) {
          // Éxito
          if (result.data.success) {
            Swal.fire({
              title: '¡Usuario actualizado!',
              text: result.data.message,
              icon: 'success',
              confirmButtonText: 'Aceptar',
              timer: 3000,
              timerProgressBar: true
            }).then(() => {
              window.location.href = '/users';
            });
          } else {
            Swal.fire({
              title: 'Error',
              text: result.data.message || 'Error al actualizar el usuario',
              icon: 'error',
              confirmButtonText: 'Aceptar'
            });
          }
        } else if (result.status === 422) {
          // Errores de validación
          if (result.data.errors) {
            showValidationErrors(result.data.errors);
          }
        } else {
          // Otros errores
          Swal.fire({
            title: 'Error',
            text: result.data.message || `Error del servidor (${result.status})`,
            icon: 'error',
            confirmButtonText: 'Aceptar'
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        Swal.fire({
          title: 'Error',
          text: 'Error de conexión. Inténtalo de nuevo.',
          icon: 'error',
          confirmButtonText: 'Aceptar'
        });
      })
      .finally(() => {
        // Restaurar botón
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      });
    });
  }
  
  function clearErrors() {
    // Limpiar clases de error
    const errorElements = document.querySelectorAll('.is-invalid');
    errorElements.forEach(element => {
      element.classList.remove('is-invalid');
    });
    
    // Limpiar mensajes de error
    const errorMessages = document.querySelectorAll('.invalid-feedback');
    errorMessages.forEach(message => {
      message.textContent = '';
    });
  }
  
  function showValidationErrors(errors) {
    // Mostrar errores de validación en los campos correspondientes
    Object.keys(errors).forEach(field => {
      const fieldElement = document.querySelector(`[name="${field}"]`);
      const errorElement = document.getElementById(`${field}-error`);
      
      if (fieldElement && errorElement) {
        fieldElement.classList.add('is-invalid');
        errorElement.textContent = errors[field][0];
      }
    });
  }
});

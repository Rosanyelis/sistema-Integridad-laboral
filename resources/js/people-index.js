/**
 * Page People Management - DataTable Configuration
 */

'use strict';

// Datatable (js)
document.addEventListener('DOMContentLoaded', function (e) {
  let borderColor, bodyBg, headingColor;

  borderColor = config.colors.borderColor;
  bodyBg = config.colors.bodyBg;
  headingColor = config.colors.headingColor;

  // Variable declaration for table
  const dt_people_table = document.querySelector('.datatables-people'),
    peopleView = (window.baseUrl || '/') + 'people/',
    statusObj = {
      'Pendiente': { title: 'Pendiente', class: 'bg-label-warning' },
      'Disponible': { title: 'Disponible', class: 'bg-label-info' },
      'En Proceso': { title: 'En Proceso', class: 'bg-label-primary' },
      'Contratado': { title: 'Contratado', class: 'bg-label-success' },
      'Part-Time': { title: 'Part-Time', class: 'bg-label-secondary' },
      'Despido': { title: 'Despido', class: 'bg-label-danger' },
      'Desaucio': { title: 'Desaucio', class: 'bg-label-danger' },
      'Renuncia': { title: 'Renuncia', class: 'bg-label-warning' },
      'Aplica': { title: 'Aplica', class: 'bg-label-info' },
      'No Aplica': { title: 'No Aplica', class: 'bg-label-secondary' }
    };
  var select2 = $('.select2');

  if (select2.length) {
    var $this = select2;
    $this.wrap('<div class="position-relative"></div>').select2({
      placeholder: 'Seleccionar Opción',
      dropdownParent: $this.parent()
    });
  }

  // People datatable
  if (dt_people_table) {
    const dt_people = new DataTable(dt_people_table, {
      ajax: {
        url: (window.baseUrl || '/') + 'people',
        type: 'GET',
        data: function (d) {
          d.search = $('#searchInput').val() || '';
          d.status = $('#statusFilter').val() || '';
          d.verified = $('#verifiedFilter').val() || '';
        }
      },
      columns: [
        // columns according to JSON
        { data: 'id' },
        { data: 'id', orderable: false, render: DataTable.render.select() },
        { data: 'name' },
        { data: 'dni' },
        { data: 'age' },
        { data: 'verified' },
        { data: 'status' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // For Checkboxes
          targets: 1,
          orderable: false,
          searchable: false,
          responsivePriority: 4,
          checkboxes: {
            selectRow: true,
            selectAllRender: '<input type="checkbox" class="form-check-input" id="selectAll">'
          }
        },
        {
          targets: 2,
          responsivePriority: 3,
          render: function (data, type, full, meta) {
            var name = full['name'];
            var output;

            // For Avatar badge
            var stateNum = Math.floor(Math.random() * 6);
            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
            var state = states[stateNum];
            var initials = (name.match(/\b\w/g) || []).map(char => char.toUpperCase());
            initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();
            output = '<span class="avatar-initial rounded-circle bg-label-' + state + '">' + initials + '</span>';

            // Creates full output for row
            var row_output =
              '<div class="d-flex justify-content-start align-items-center user-name">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar avatar-sm me-4">' +
              output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<a href="' +
              peopleView + full['id'] +
              '" class="text-heading text-truncate"><span class="fw-medium">' +
              name +
              '</span></a>' +
              '</div>' +
              '</div>';
            return row_output;
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            return '<span class="text-truncate d-flex align-items-center text-heading">' + data + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            return '<span class="text-heading">' + data + ' años</span>';
          }
        },
        {
          // Verification Status
          targets: 5,
          render: function (data, type, full, meta) {
            const verified = full['verified'];
            const verifiedClass = verified === 'Parcial' ? 'bg-label-success' : 'bg-label-warning';
            return (
              '<span class="badge ' +
              verifiedClass +
              '" text-capitalized>' +
              verified +
              '</span>'
            );
          }
        },
        {
          // Employment Status
          targets: 6,
          render: function (data, type, full, meta) {
            const status = full['status'];
            return (
              '<span class="badge ' +
              statusObj[status].class +
              '" text-capitalized>' +
              status +
              '</span>'
            );
          }
        },
        {
          targets: -1,
          title: 'Acciones',
          searchable: false,
          orderable: false,
          render: (data, type, full, meta) => {
            return `
              <div class="d-flex align-items-center">
                <a href="${peopleView}${full['id']}" class="btn btn-text-secondary rounded-pill waves-effect btn-icon">
                  <i class="icon-base ti tabler-eye icon-22px"></i>
                </a>
                <a href="${peopleView}${full['id']}/edit" class="btn btn-text-secondary rounded-pill waves-effect btn-icon">
                  <i class="icon-base ti tabler-edit icon-22px"></i>
                </a>
                <a href="javascript:;" class="btn btn-text-secondary rounded-pill waves-effect btn-icon delete-record" data-id="${full['id']}" data-status="${full['status']}">
                  <i class="icon-base ti tabler-trash icon-22px"></i>
                </a>
              </div>
            `;
          }
        }
      ],
      select: {
        style: 'multi',
        selector: 'td:nth-child(2)'
      },
      order: [[2, 'desc']],
      layout: {
        topStart: {
          rowClass: 'row m-3 my-0 justify-content-between',
          features: [
            {
              pageLength: {
                menu: [10, 25, 50, 100],
                text: '_MENU_'
              }
            }
          ]
        },
        topEnd: {
          features: [
            {
              search: {
                placeholder: 'Buscar Persona',
                text: '_INPUT_'
              }
            },
            {
              buttons: [
                {
                  extend: 'collection',
                  className: 'btn btn-label-secondary dropdown-toggle',
                  text: '<span class="d-flex align-items-center gap-2"><i class="icon-base ti tabler-upload icon-xs"></i> <span class="d-none d-sm-inline-block">Exportar</span></span>',
                  buttons: [
                    {
                      extend: 'print',
                      text: `<span class="d-flex align-items-center"><i class="icon-base ti tabler-printer me-1"></i>Imprimir</span>`,
                      className: 'dropdown-item',
                      exportOptions: {
                        columns: [2, 3, 4, 5, 6],
                        format: {
                          body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;

                            // Check if inner is HTML content
                            if (inner.indexOf('<') > -1) {
                              const parser = new DOMParser();
                              const doc = parser.parseFromString(inner, 'text/html');

                              // Get all text content
                              let text = '';

                              // Handle specific elements
                              const userNameElements = doc.querySelectorAll('.user-name');
                              if (userNameElements.length > 0) {
                                userNameElements.forEach(el => {
                                  // Get text from nested structure
                                  const nameText =
                                    el.querySelector('.fw-medium')?.textContent ||
                                    el.querySelector('.d-block')?.textContent ||
                                    el.textContent;
                                  text += nameText.trim() + ' ';
                                });
                              } else {
                                // Get regular text content
                                text = doc.body.textContent || doc.body.innerText;
                              }

                              return text.trim();
                            }

                            return inner;
                          }
                        }
                      },
                      customize: function (win) {
                        win.document.body.style.color = config.colors.headingColor;
                        win.document.body.style.borderColor = config.colors.borderColor;
                        win.document.body.style.backgroundColor = config.colors.bodyBg;
                        const table = win.document.body.querySelector('table');
                        table.classList.add('compact');
                        table.style.color = 'inherit';
                        table.style.borderColor = 'inherit';
                        table.style.backgroundColor = 'inherit';
                      }
                    },
                    {
                      extend: 'csv',
                      text: `<span class="d-flex align-items-center"><i class="icon-base ti tabler-file-text me-1"></i>CSV</span>`,
                      className: 'dropdown-item',
                      exportOptions: {
                        columns: [2, 3, 4, 5, 6],
                        format: {
                          body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;

                            // Parse HTML content
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(inner, 'text/html');

                            let text = '';

                            // Handle user-name elements specifically
                            const userNameElements = doc.querySelectorAll('.user-name');
                            if (userNameElements.length > 0) {
                              userNameElements.forEach(el => {
                                // Get text from nested structure - try different selectors
                                const nameText =
                                  el.querySelector('.fw-medium')?.textContent ||
                                  el.querySelector('.d-block')?.textContent ||
                                  el.textContent;
                                text += nameText.trim() + ' ';
                              });
                            } else {
                              // Handle other elements (status, role, etc)
                              text = doc.body.textContent || doc.body.innerText;
                            }

                            return text.trim();
                          }
                        }
                      }
                    },
                    {
                      extend: 'excel',
                      text: `<span class="d-flex align-items-center"><i class="icon-base ti tabler-file-spreadsheet me-1"></i>Excel</span>`,
                      className: 'dropdown-item',
                      exportOptions: {
                        columns: [2, 3, 4, 5, 6],
                        format: {
                          body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;

                            // Parse HTML content
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(inner, 'text/html');

                            let text = '';

                            // Handle user-name elements specifically
                            const userNameElements = doc.querySelectorAll('.user-name');
                            if (userNameElements.length > 0) {
                              userNameElements.forEach(el => {
                                // Get text from nested structure - try different selectors
                                const nameText =
                                  el.querySelector('.fw-medium')?.textContent ||
                                  el.querySelector('.d-block')?.textContent ||
                                  el.textContent;
                                text += nameText.trim() + ' ';
                              });
                            } else {
                              // Handle other elements (status, role, etc)
                              text = doc.body.textContent || doc.body.innerText;
                            }

                            return text.trim();
                          }
                        }
                      }
                    },
                    {
                      extend: 'pdf',
                      text: `<span class="d-flex align-items-center"><i class="icon-base ti tabler-file-description me-1"></i>PDF</span>`,
                      className: 'dropdown-item',
                      exportOptions: {
                        columns: [2, 3, 4, 5, 6],
                        format: {
                          body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;

                            // Parse HTML content
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(inner, 'text/html');

                            let text = '';

                            // Handle user-name elements specifically
                            const userNameElements = doc.querySelectorAll('.user-name');
                            if (userNameElements.length > 0) {
                              userNameElements.forEach(el => {
                                // Get text from nested structure - try different selectors
                                const nameText =
                                  el.querySelector('.fw-medium')?.textContent ||
                                  el.querySelector('.d-block')?.textContent ||
                                  el.textContent;
                                text += nameText.trim() + ' ';
                              });
                            } else {
                              // Handle other elements (status, role, etc)
                              text = doc.body.textContent || doc.body.innerText;
                            }

                            return text.trim();
                          }
                        }
                      }
                    },
                    {
                      extend: 'copy',
                      text: `<i class="icon-base ti tabler-copy me-1"></i>Copiar`,
                      className: 'dropdown-item',
                      exportOptions: {
                        columns: [2, 3, 4, 5, 6],
                        format: {
                          body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;

                            // Parse HTML content
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(inner, 'text/html');

                            let text = '';

                            // Handle user-name elements specifically
                            const userNameElements = doc.querySelectorAll('.user-name');
                            if (userNameElements.length > 0) {
                              userNameElements.forEach(el => {
                                // Get text from nested structure - try different selectors
                                const nameText =
                                  el.querySelector('.fw-medium')?.textContent ||
                                  el.querySelector('.d-block')?.textContent ||
                                  el.textContent;
                                text += nameText.trim() + ' ';
                              });
                            } else {
                              // Handle other elements (status, role, etc)
                              text = doc.body.textContent || doc.body.innerText;
                            }

                            return text.trim();
                          }
                        }
                      }
                    }
                  ]
                },
                {
                  text: '<span class="d-flex align-items-center gap-2"><i class="icon-base ti tabler-plus icon-xs"></i> <span class="d-none d-sm-inline-block">Agregar Persona</span></span>',
                  className: 'add-new btn btn-primary',
                  action: function() {
                    window.location.href = '/people/create';
                  }
                }
              ]
            }
          ]
        },
        bottomStart: {
          rowClass: 'row mx-3 justify-content-between',
          features: ['info']
        },
        bottomEnd: 'paging'
      },
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Buscar Persona',
        paginate: {
          next: '<i class="icon-base ti tabler-chevron-right scaleX-n1-rtl icon-18px"></i>',
          previous: '<i class="icon-base ti tabler-chevron-left scaleX-n1-rtl icon-18px"></i>',
          first: '<i class="icon-base ti tabler-chevrons-left scaleX-n1-rtl icon-18px"></i>',
          last: '<i class="icon-base ti tabler-chevrons-right scaleX-n1-rtl icon-18px"></i>'
        },
        info: 'Mostrando _START_ a _END_ de _TOTAL_ personas',
        infoEmpty: 'Mostrando 0 a 0 de 0 personas',
        infoFiltered: '(filtrado de _MAX_ personas totales)',
        infoPostFix: '',
        loadingRecords: 'Cargando...',
        zeroRecords: 'No se encontraron personas',
        emptyTable: 'No hay personas disponibles',
      },
      // For responsive popup
      responsive: {
        details: {
          display: DataTable.Responsive.display.modal({
            header: function (row) {
              const data = row.data();
              return 'Detalles de ' + data['name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            const data = columns
              .map(function (col) {
                return col.title !== '' // Do not show row in modal popup if title is blank (for check box)
                  ? `<tr data-dt-row="${col.rowIndex}" data-dt-column="${col.columnIndex}">
                      <td>${col.title}:</td>
                      <td>${col.data}</td>
                    </tr>`
                  : '';
              })
              .join('');

            if (data) {
              const div = document.createElement('div');
              div.classList.add('table-responsive');
              const table = document.createElement('table');
              div.appendChild(table);
              table.classList.add('table');
              const tbody = document.createElement('tbody');
              tbody.innerHTML = data;
              table.appendChild(tbody);
              return div;
            }
            return false;
          }
        }
      },
      initComplete: function () {
        const api = this.api();

        // Helper function to create a select dropdown and append options
        const createFilter = (columnIndex, containerClass, selectId, defaultOptionText) => {
          const column = api.column(columnIndex);
          const container = document.querySelector(containerClass);
          
          // Verificar que el contenedor existe antes de proceder
          if (!container) {
            console.warn(`Container not found: ${containerClass}`);
            return;
          }
          
          const select = document.createElement('select');
          select.id = selectId;
          select.className = 'form-select text-capitalize';
          select.innerHTML = `<option value="">${defaultOptionText}</option>`;
          container.appendChild(select);

          // Add event listener for filtering
          select.addEventListener('change', () => {
            const val = select.value ? `^${select.value}$` : '';
            column.search(val, true, false).draw();
          });

          // Populate options based on unique column data
          const uniqueData = Array.from(new Set(column.data().toArray())).sort();
          uniqueData.forEach(d => {
            const option = document.createElement('option');
            option.value = d;
            option.textContent = d;
            select.appendChild(option);
          });
        };

        // Status filter
        createFilter(6, '.people_status', 'PeopleStatus', 'Seleccionar Estado');

        // Verification filter
        const verificationContainer = document.querySelector('.people_verification');
        if (!verificationContainer) {
          console.warn('Verification container not found: .people_verification');
        } else {
          const verificationFilter = document.createElement('select');
          verificationFilter.id = 'FilterVerification';
          verificationFilter.className = 'form-select text-capitalize';
          verificationFilter.innerHTML = '<option value="">Seleccionar Verificación</option>';
          verificationContainer.appendChild(verificationFilter);
          
          verificationFilter.addEventListener('change', () => {
            const val = verificationFilter.value ? `^${verificationFilter.value}$` : '';
            api.column(5).search(val, true, false).draw();
          });

          const verificationColumn = api.column(5);
          const uniqueVerificationData = Array.from(new Set(verificationColumn.data().toArray())).sort();
          uniqueVerificationData.forEach(d => {
            const option = document.createElement('option');
            option.value = d;
            option.textContent = d;
            option.className = 'text-capitalize';
            verificationFilter.appendChild(option);
          });
        }
      }
    });

    //? The 'delete-record' class is necessary for the functionality of the following code.
    function deleteRecord(event) {
      console.log('deleteRecord function called', event);
      let row = document.querySelector('.dtr-expanded');
      if (event) {
        row = event.target.parentElement.closest('tr');
      }
      if (row) {
        // Buscar el elemento con data-id, puede estar en el enlace o en el ícono
        const deleteButton = event.target.closest('.delete-record');
        const personId = deleteButton ? deleteButton.getAttribute('data-id') : null;
        const personStatus = deleteButton ? deleteButton.getAttribute('data-status') : null;
        console.log('Person ID:', personId);
        console.log('Person Status:', personStatus);
        console.log('Base URL:', window.baseUrl);
        console.log('Delete button found:', deleteButton);
        
        // Validar que tenemos el personId
        if (!personId) {
          console.error('No se pudo obtener el ID de la persona');
          Swal.fire({
            title: 'Error',
            text: 'No se pudo obtener el ID de la persona. Inténtalo de nuevo.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          });
          return;
        }
        
        // Determinar el mensaje según el estado de la persona
        let title, text, confirmText;
        
        if (personStatus === 'Inactivo') {
          title = '¿Reactivar persona?';
          text = '¿Estás seguro de que deseas reactivar esta persona? La persona podrá volver a ser considerada para empleos.';
          confirmText = 'Sí, reactivar';
        } else if (personStatus === 'Pendiente') {
          title = '¿Desactivar persona pendiente?';
          text = '¿Estás seguro de que deseas desactivar esta persona? La persona no podrá completar su registro ni ser considerada para empleos.';
          confirmText = 'Sí, desactivar';
        } else {
          title = '¿Desactivar persona activa?';
          text = '¿Estás seguro de que deseas desactivar esta persona? La persona no podrá ser considerada para empleos hasta que sea reactivada.';
          confirmText = 'Sí, desactivar';
        }

        // Usar SweetAlert2 para confirmar desactivación/reactivación
        Swal.fire({
          title: title,
          text: text,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: personStatus === 'Inactivo' ? '#28a745' : '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: confirmText,
          cancelButtonText: 'Cancelar',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            // Determinar la acción y endpoint según el estado
            const isReactivating = personStatus === 'Inactivo';
            const endpoint = isReactivating ? 'reactivate' : 'deactivate';
            const actionText = isReactivating ? 'reactivar' : 'desactivar';
            
            // Send PATCH request to deactivate/reactivate person
            fetch(`${window.baseUrl || '/'}people/${personId}/${endpoint}`, {
              method: 'PATCH',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
              }
            })
            .then(response => {
              if (response.ok) {
                // Recargar la tabla para mostrar el estado actualizado
                dt_people.ajax.reload();
                // Show success message
                Swal.fire({
                  title: isReactivating ? '¡Persona reactivada!' : '¡Persona desactivada!',
                  text: isReactivating ? 'La persona ha sido reactivada exitosamente.' : 'La persona ha sido desactivada exitosamente.',
                  icon: 'success',
                  timer: 3000,
                  showConfirmButton: false
                });
              } else {
                throw new Error(`Error al ${actionText} la persona`);
              }
            })
            .catch(error => {
              console.error('Error:', error);
              Swal.fire({
                title: 'Error',
                text: `Error al ${actionText} la persona. Inténtalo de nuevo.`,
                icon: 'error',
                confirmButtonText: 'Aceptar'
              });
            });
          }
        });
      }
    }

    function bindDeleteEvent() {
      const peopleListTable = document.querySelector('.datatables-people');
      const modal = document.querySelector('.dtr-bs-modal');

      if (peopleListTable && peopleListTable.classList.contains('collapsed')) {
        if (modal) {
          modal.addEventListener('click', function (event) {
            if (event.target.parentElement.classList.contains('delete-record') || event.target.classList.contains('delete-record')) {
              deleteRecord(event);
              const closeButton = modal.querySelector('.btn-close');
              if (closeButton) closeButton.click(); // Simulates a click on the close button
            }
          });
        }
      } else {
        const tableBody = peopleListTable?.querySelector('tbody');
        if (tableBody) {
          tableBody.addEventListener('click', function (event) {
            if (event.target.parentElement.classList.contains('delete-record') || event.target.classList.contains('delete-record')) {
              deleteRecord(event);
            }
          });
        }
      }
    }

    // Initial event binding
    bindDeleteEvent();

    // Select All functionality
    $(document).on('change', '#selectAll', function() {
      if (this.checked) {
        dt_people.rows().select();
      } else {
        dt_people.rows().deselect();
      }
    });

    // Filter functionality
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(function() {
        dt_people.ajax.reload();
      }, 500); // Debounce de 500ms
    });

    $('#statusFilter').on('change', function() {
      dt_people.ajax.reload();
    });

    $('#verifiedFilter').on('change', function() {
      dt_people.ajax.reload();
    });

    // Re-bind events when modal is shown or hidden
    document.addEventListener('show.bs.modal', function (event) {
      if (event.target.classList.contains('dtr-bs-modal')) {
        bindDeleteEvent();
      }
    });

    document.addEventListener('hide.bs.modal', function (event) {
      if (event.target.classList.contains('dtr-bs-modal')) {
        bindDeleteEvent();
      }
    });
  }

  // Filter form control to default size
  // ? setTimeout used for people-list table initialization
  setTimeout(() => {
    const elementsToModify = [
      { selector: '.dt-buttons .btn', classToRemove: 'btn-secondary' },
      { selector: '.dt-search .form-control', classToRemove: 'form-control-sm' },
      { selector: '.dt-length .form-select', classToRemove: 'form-select-sm', classToAdd: 'ms-0' },
      { selector: '.dt-length', classToAdd: 'mb-md-6 mb-0' },
      {
        selector: '.dt-layout-end',
        classToRemove: 'justify-content-between',
        classToAdd: 'd-flex gap-md-4 justify-content-md-between justify-content-center gap-2 flex-wrap'
      },
      { selector: '.dt-buttons', classToAdd: 'd-flex gap-4 mb-md-0 mb-4' },
      { selector: '.dt-layout-table', classToRemove: 'row mt-2' },
      { selector: '.dt-layout-full', classToRemove: 'col-md col-12', classToAdd: 'table-responsive' }
    ];

    // Delete record
    elementsToModify.forEach(({ selector, classToRemove, classToAdd }) => {
      document.querySelectorAll(selector).forEach(element => {
        if (classToRemove) {
          classToRemove.split(' ').forEach(className => element.classList.remove(className));
        }
        if (classToAdd) {
          classToAdd.split(' ').forEach(className => element.classList.add(className));
        }
      });
    });
  }, 100);

  // Validation & Phone mask
  const phoneMaskList = document.querySelectorAll('.phone-mask'),
    addNewPersonForm = document.getElementById('addNewPersonForm');

  // Phone Number
  if (phoneMaskList) {
    phoneMaskList.forEach(function (phoneMask) {
      phoneMask.addEventListener('input', event => {
        const cleanValue = event.target.value.replace(/\D/g, '');
        phoneMask.value = formatGeneral(cleanValue, {
          blocks: [3, 3, 4],
          delimiters: [' ', ' ']
        });
      });
      registerCursorTracker({
        input: phoneMask,
        delimiter: ' '
      });
    });
  }
  
  // Add New Person Form Validation
  if (addNewPersonForm) {
    const fv = FormValidation.formValidation(addNewPersonForm, {
      fields: {
        name: {
          validators: {
            notEmpty: {
              message: 'Por favor ingrese el nombre completo'
            }
          }
        },
        dni: {
          validators: {
            notEmpty: {
              message: 'Por favor ingrese la cédula'
            }
          }
        },
        age: {
          validators: {
            notEmpty: {
              message: 'Por favor ingrese la edad'
            },
            numeric: {
              message: 'La edad debe ser un número válido'
            }
          }
        },
        status: {
          validators: {
            notEmpty: {
              message: 'Por favor seleccione un estado'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          eleValidClass: '',
          rowSelector: function (field, ele) {
            // field is the field name & ele is the field element
            return '.form-control-validation';
          }
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      }
    });
  }
});
document.addEventListener('DOMContentLoaded', () => {
  const actionModal = document.getElementById('actionModal');
  const modalForm = document.getElementById('modalForm');
  const modalTitle = document.getElementById('modalTitle');
  const modalMessage = document.getElementById('modalMessage');
  const modalCancelButton = document.getElementById('modalCancelButton');

  const actionButtons = document.getElementById('actionButtons');
  const selectAllCheckbox = document.getElementById('selectAll'); // Checkbox para seleccionar todos
  const checkboxes = document.querySelectorAll('.itemCheckbox'); // Checkboxes individuales

  const deleteButton = document.getElementById('deleteButton');
  const deleteButtonText = document.getElementById('deleteButtonText'); // Contenedor del texto dinámico

  // Actualizar la visibilidad de los botones
  const updateDeleteButtonVisibility = () => {
    const anyChecked = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
    deleteButtonText.textContent = `seleccionados (${anyChecked})`;
    console.log('¿Hay algún checkbox marcado?', anyChecked);

    if (anyChecked) {
      actionButtons.classList.remove('hidden');
      actionButtons.classList.add('flex');
    } else {
      actionButtons.classList.remove('flex');
      actionButtons.classList.add('hidden');
    }
  };

  // Evento: Actualizar al cambiar el estado de un checkbox
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateDeleteButtonVisibility);
  });

  // Evento: Seleccionar/deseleccionar todos los checkboxes
  if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', () => {
      checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
      });

      updateDeleteButtonVisibility();
    });
  }

  // Inicializar estado de los botones al cargar la página
  updateDeleteButtonVisibility();

  // Conectaar el botón "Eliminar" con el modal
  deleteButton.addEventListener('click', () => {
    const actionUrl = deleteButton.dataset.action;
    const method = deleteButton.dataset.method || 'POST';
    const title = deleteButton.dataset.title || 'Confirmación';
    const message = deleteButton.dataset.message || '¿Estás segura de realizar esta acción?';

    // Obtener los IDs seleccionados
    const selectedIds = Array.from(checkboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.value);

    if (selectedIds.length === 0) {
      alert('Por favor, selecciona al menos un elemento para eliminar.');
      return;
    }

    // Actualizar el formulario del modal
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    modalForm.action = actionUrl;
    modalForm.querySelector('[name="_method"]').value = method;

    // Crear un input oculto para los IDs
    let idsInput = modalForm.querySelector('input[name="ids"]');

    if (!idsInput) {
      idsInput = document.createElement('input');
      idsInput.type = 'hidden';
      idsInput.name = 'ids';
      modalForm.appendChild(idsInput);
    }
    idsInput.value = JSON.stringify(selectedIds);

    // Mostrar el modal
    actionModal.classList.remove('hidden');
    actionModal.classList.add('flex');
  });

  // Vincular eventos a los botones con data-action
  document.querySelectorAll('[data-action]').forEach(button => {
    button.addEventListener('click', () => {
      console.log('Botón clickeado:', button);

      const actionUrl = button.dataset.action;
      const method = button.dataset.method || 'POST';
      const title = button.dataset.title || 'Confirmación';
      const message = button.dataset.message || '¿Estás segura de realizar esta acción?';

      // Mostrar el modal con la información configurada
      showModal({ title, message, actionUrl, method });
    });
  });

  // Función para mostrar el modal
  function showModal({ title, message, actionUrl, method }) {
    console.log('Mostrando modal con:', { title, message, actionUrl, method });

    // Actualizar contenido del modal
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    modalForm.action = actionUrl;
    modalForm.querySelector('[name="_method"]').value = method;

    actionModal.classList.remove('hidden');
    actionModal.classList.add('flex');
  }

  // Cerrar el modal al cancelar
  document.getElementById('modalCancelButton').addEventListener('click', () => {
    actionModal.classList.remove('flex');
    actionModal.classList.add('hidden');
  });

  // Cerrar el modal al cancelar
  modalCancelButton.addEventListener('click', () => {
    actionModal.classList.remove('flex');
    actionModal.classList.add('hidden');

    // Desmarcar todos los checkboxes
    checkboxes.forEach(checkbox => {
      checkbox.checked = false;
    });

    if (selectAllCheckbox) {
      selectAllCheckbox.checked = false;
    }

    updateDeleteButtonVisibility();
  });

  // Función para mostrar notificaciones
  /* function showNotification(message, type = 'success', duration = 3000) {
    const notificationContainer = document.getElementById('notificationContainer');

    // Crear el elemento de notificación
    const notification = document.createElement('div');
    notification.className = `px-4 py-2 rounded shadow-lg transition-all duration-500 ${type === 'success' ? 'bg-green-500 text-slate-50' : 'bg-red-500 text-slate-50'
      }`;

    notification.textContent = message;

    // Agregar la notificación al contenedor
    notificationContainer.appendChild(notification);

    // Eliminar la notificación después del tiempo configurado
    setTimeout(() => {
      notification.style.opacity = '0';
      setTimeout(() => notification.remove(), 500); // Esperar el final de la transición
    }, 5000); // Usa el mismo tiempo para todas las notificaciones
  }; */

  // Notificación al confirmar
  /* modalForm.addEventListener('submit', (event) => {
    showNotification('La eliminación fue confirmada.', 'success', 10000); // Duración: 3 segundos
  }); */

  // Notificación al cancelar
  /* modalCancelButton.addEventListener('click', () => {
    showNotification('La eliminación fue cancelada.', 'error', 3000); // Duración: 3 segundos
  }); */

  /* function showNotification({ type, message }) {
    const notification = document.createElement('div');
    notification.classList.add('notification', `is-${type}`);
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
      notification.remove();
    }, 5000);
  } */
});
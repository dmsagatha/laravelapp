document.addEventListener('DOMContentLoaded', () => {
  // Referencias a los botones
  const selectAllCheckbox = document.getElementById('selectAll'); // Checkbox para seleccionar todos
  const checkboxes = document.querySelectorAll('.itemCheckbox'); // Checkboxes individuales
  const deleteButton = document.getElementById('deleteButton');
  const restoreButton = document.getElementById('restoreButton');
  const forceDeleteButton = document.getElementById('forceDeleteButton');

  // Actualizar la visibilidad y texto de los botones dinámicamente
  const updateButtonVisibility = () => {
    const selectedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
    console.log('¿Hay algún checkbox marcado?', selectedCount);

    // Actualizar texto y visibilidad de los botones
    if (deleteButton) {
      deleteButton.textContent = `Eliminar seleccionados (${selectedCount})`;
      deleteButton.classList.toggle('hidden', selectedCount === 0);
    }

    if (restoreButton) {
      restoreButton.textContent = `Restaurar seleccionados (${selectedCount})`;
      restoreButton.classList.toggle('hidden', selectedCount === 0);
    }

    if (forceDeleteButton) {
      forceDeleteButton.textContent = `Eliminar definitivamente (${selectedCount})`;
      forceDeleteButton.classList.toggle('hidden', selectedCount === 0);
    }
  };

  // Evento: Actualizar al cambiar el estado de un checkbox
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateButtonVisibility);
  });

  // Evento: Seleccionar/deseleccionar todos los checkboxes
  if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', () => {
      checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
      });

      updateButtonVisibility();
    });
  }

  // Función para mostrar el modal
  function showModal(actionType, actionUrl) {
    const actionModal = document.getElementById('actionModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalForm = document.getElementById('modalForm');

    if (!modalTitle || !modalMessage || !modalForm || !actionModal) {
      console.error('Los elementos del modal no están en el DOM.');
      return;
    }

    const selectedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

    if (selectedCount === 0) {
      alert('Por favor, selecciona al menos un registro para continuar.');
      return;
    }

    const titles = {
      delete: 'Confirmar eliminación',
      restore: 'Confirmar restauración',
      forceDelete: 'Eliminar permanentemente',
    };

    const messages = {
      delete: `¿Está seguro de que desea eliminar ${selectedCount} registros?`,
      restore: `¿Está seguro de que desea restaurar ${selectedCount} registros?`,
      forceDelete: `¿Está seguro de que desea eliminar permanentemente ${selectedCount} registros?`,
    };

    modalTitle.textContent = titles[actionType];
    modalMessage.textContent = messages[actionType];
    modalForm.action = actionUrl;
    modalForm.querySelector('[name="_method"]').value = actionType === 'restore' ? 'POST' : 'DELETE';

    actionModal.classList.remove('hidden');
    actionModal.classList.add('flex');
  }

  // Asignar eventos a los botones que están presentes
  if (deleteButton) {
    deleteButton.addEventListener('click', function () {
      showModal('delete', this.dataset.action);
    });
  }

  if (restoreButton) {
    restoreButton.addEventListener('click', function () {
      showModal('restore', this.dataset.action);
    });
  }

  if (forceDeleteButton) {
    forceDeleteButton.addEventListener('click', function () {
      showModal('forceDelete', this.dataset.action);
    });
  }

  // Inicializar estado de los botones al cargar la página
  updateButtonVisibility();

  // Conectar el botón "Eliminar" con el modal
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
      alert('Por favor, seleccionar al menos un elemento para eliminar.');
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
});
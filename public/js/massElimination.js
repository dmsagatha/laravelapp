document.addEventListener('DOMContentLoaded', () => {
  // Referencias a los botones
  const selectAllCheckbox = document.getElementById('selectAll');
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
      const deleteButtonText = document.getElementById('deleteButtonText');
      if (deleteButtonText) {
        deleteButtonText.textContent = `Eliminar seleccionados (${selectedCount})`;
      }
      // deleteButton.classList.toggle('hidden', selectedCount === 0);
      deleteButton.classList.toggle('hidden', selectedCount === 0);
      deleteButton.classList.toggle('flex', selectedCount > 0);
    }

    if (restoreButton) {
      const restoreButtonText = document.getElementById('restoreButtonText');
      if (restoreButtonText) {
        restoreButtonText.textContent = `Restaurar seleccionados (${selectedCount})`;
      }
      restoreButton.classList.toggle('hidden', selectedCount === 0);
      restoreButton.classList.toggle('flex', selectedCount > 0);
    }

    if (forceDeleteButton) {
      const forceDeleteButtonText = document.getElementById('forceDeleteButtonText');
      if (forceDeleteButtonText) {
        forceDeleteButtonText.textContent = `Eliminar definitivamente (${selectedCount})`;
      }
      forceDeleteButton.classList.toggle('hidden', selectedCount === 0);
      forceDeleteButton.classList.toggle('flex', selectedCount > 0);
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
    const selectedIdsInput = document.getElementById('selectedIds');

    const selectedIds = Array.from(checkboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.value);

    if (selectedIds.length === 0) {
      alert('Por favor, selecciona al menos un registro para continuar.');
      return;
    }

    selectedIdsInput.value = JSON.stringify(selectedIds);

    const selectedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

    if (!modalTitle || !modalMessage || !modalForm || !actionModal) {
      console.error('Los elementos del modal no están en el DOM.');
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

  // Asignar eventos a los botones que están presentes en el DOM
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

    updateButtonVisibility();
  });

  // Inicializar estado de los botones al cargar la página
  updateButtonVisibility();
});
// Script para eliminación masiva de Periféricos
document.addEventListener('DOMContentLoaded', () => {
  const selectAllCheckbox = document.getElementById('selectAll');   // <thead> - Todos
  const checkboxes = document.querySelectorAll('.recordCheckbox');  // <tbody> - Individuales
  const bulkDeleteButton = document.getElementById('bulkDeleteButton');
  const selectCount = document.getElementById('select_count');
  const deleteModal = document.getElementById('deleteModal');
  const confirmDeleteButton = document.getElementById('confirmDeleteButton');
  const cancelButton = document.getElementById('cancelButton');
  const bulkDeleteIdsInput = document.getElementById('bulkDeleteIds');  // form - input

  let selectedIds = []; // IDs seleccionados

  // Actualizar el contador y el botón de eliminar
  const updateUI = () => {
    const count = selectedIds.length;
    selectCount.textContent = count;

    // Mostrar u ocultar el botón
    if (count > 0) {
      bulkDeleteButton.classList.remove('hidden');
    } else {
      bulkDeleteButton.classList.add('hidden');
    }
  };

  // Manejo del checkbox "Seleccionar todos"
  selectAllCheckbox.addEventListener('change', () => {
    const isChecked = selectAllCheckbox.checked;

    checkboxes.forEach((checkbox) => {
      checkbox.checked = isChecked;
      const id = checkbox.value;

      if (isChecked && !selectedIds.includes(id)) {
        selectedIds.push(id);
      } else if (!isChecked) {
        selectedIds = [];
      }
    });

    updateUI();
  });

  // Manejo de los checkboxes individuales
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
      const id = checkbox.value;

      if (checkbox.checked) {
        if (!selectedIds.includes(id)) {
          selectedIds.push(id);
        }
      } else {
        selectedIds = selectedIds.filter((selectedId) => selectedId !== id);
      }

      // Sincronizar "Seleccionar todos" con los checkboxes individuales
      selectAllCheckbox.checked = selectedIds.length === checkboxes.length;

      updateUI();
    });
  });

  // Mostrar ventana modal al hacer clic en el botón de eliminación
  /* bulkDeleteButton.addEventListener('click', () => {
    deleteModal.classList.remove('hidden');
    deleteModal.classList.add('flex');
  }); */
  bulkDeleteButton.addEventListener('click', showModal);

  // Confirmar la eliminación
  confirmDeleteButton.addEventListener('click', () => {
    // Asignar los IDs seleccionados al campo oculto del formulario
    bulkDeleteIdsInput.value = selectedIds.join(',');

    // Enviar el formulario
    document.getElementById('bulkDeleteForm').submit();
    hideModal();
    showNotification('¡Registros eliminados correctamente!', 'success', 4000); // Muestra por 4 segundos
  });

  // Cancelar la eliminación
  cancelButton.addEventListener('click', () => {
    // deleteModal.classList.add('hidden');
    hideModal(); // Cerrar el modal con animación
    showNotification('Eliminación cancelada.', 'error', 4000);

    // Reiniciar checkboxes y contador
    selectedIds = [];
    selectAllCheckbox.checked = false;

    checkboxes.forEach((checkbox) => {
      checkbox.checked = false;
    });

    updateUI();
  });

  // Ocultar ventana modal al presionar la tecla Esc
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') hideModal();
  });

  // Ocultar el modal con animación
  function hideModal() {
    // const deleteModal = document.getElementById('deleteModal');
    /* deleteModal.classList.add('hidden');
    deleteModal.classList.remove('flex'); */
    deleteModal.classList.add('modal-leave'); // Aplicar la clase de salida

    // Esperar que termine la animación antes de ocultar completamente el modal
    setTimeout(() => {
      deleteModal.classList.remove('modal-leave', 'modal-enter-active'); // Limpiar las clases de animación
      deleteModal.classList.add('hidden'); // Ocultar el modal
    }, 200); // El tiempo de duración de la animación debe coincidir con el tiempo de
  }

  // Mostrar el modal con animación
  function showModal() {
    // const deleteModal = document.getElementById('deleteModal');
    deleteModal.classList.remove('hidden');
    deleteModal.classList.add('flex');
    deleteModal.classList.add('modal-enter', 'modal-enter-active'); // Clases para la animación

    // Esperar a que termine la animación antes de eliminar las clases
    setTimeout(() => {
      deleteModal.classList.remove('modal-enter'); // Remover las clases después de la animación
    }, 300); // El tiempo de duración de la animación debe coincidir con el tiempo definido en CSS
  }

  function showNotification(message, type = 'success', displayDuration = 3000) {
    const notification = document.getElementById('notification');

    // Ajustar colores según el tipo
    const colors = {
      success: 'bg-green-500',
      error: 'bg-red-500',
    };

    // Configurar el mensaje y el color
    notification.textContent = message;
    notification.className = `fixed top-32 right-5 z-50 bg-green-500 text-slate-50 dark:text-slate-800 text-sm rounded-md px-4 py-2 shadow-lg transition-opacity duration-1000 ${colors[type]}`;

    // Mostrar el mensaje
    notification.classList.remove('hidden', 'opacity-0');
    notification.classList.add('opacity-100');

    // Ocultar después de 3 segundos
    setTimeout(() => {
      notification.classList.add('opacity-0');
      setTimeout(() => notification.classList.add('hidden'), 300); // Esconde tras el desvanecimiento
    }, displayDuration);
  }
});
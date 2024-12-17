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
  });

  // Cancelar la eliminación
  cancelButton.addEventListener('click', () => {
    // deleteModal.classList.add('hidden');
    hideModal(); // Cerrar el modal con animación

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
    const deleteModal = document.getElementById('deleteModal');
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
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.classList.remove('hidden');
    deleteModal.classList.add('flex');
    deleteModal.classList.add('modal-enter', 'modal-enter-active'); // Clases para la animación

    // Esperar a que termine la animación antes de eliminar las clases
    setTimeout(() => {
      deleteModal.classList.remove('modal-enter'); // Remover las clases después de la animación
    }, 300); // El tiempo de duración de la animación debe coincidir con el tiempo definido en CSS
  }
});
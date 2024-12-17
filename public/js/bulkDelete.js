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
      selectAllCheckbox.checked =
        selectedIds.length === checkboxes.length;

      updateUI();
    });
  });

  // Mostrar ventana modal al hacer clic en el botón de eliminación
  bulkDeleteButton.addEventListener('click', () => {
    deleteModal.classList.remove('hidden');
  });

  // Confirmar la eliminación
  confirmDeleteButton.addEventListener('click', () => {
    // Asignar los IDs seleccionados al campo oculto del formulario
    bulkDeleteIdsInput.value = selectedIds.join(',');

    // Enviar el formulario
    document.getElementById('bulkDeleteForm').submit();
  });

  // Cancelar la eliminación
  cancelButton.addEventListener('click', () => {
    deleteModal.classList.add('hidden');

    // Reiniciar checkboxes y contador
    selectedIds = [];
    selectAllCheckbox.checked = false;

    checkboxes.forEach((checkbox) => {
      checkbox.checked = false;
    });

    updateUI();
  });
});
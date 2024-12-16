document.addEventListener('DOMContentLoaded', () => {
  const selectAllCheckbox = document.getElementById('selectAll');   // <thead> - Todos
  const checkboxes = document.querySelectorAll('.recordCheckbox');  // <tbody> - Individuales
  const selectCount = document.getElementById('select_count');
  const bulkDeleteButton = document.getElementById('bulkDeleteButton');
  const bulkDeleteIdsInput = document.getElementById('bulkDeleteIds');  // form - input
  const deleteModal = document.getElementById('deleteModal');
  const cancelButton = document.getElementById('cancelButton');
  const confirmDeleteButton = document.getElementById('confirmDeleteButton');
  const bulkDeleteForm = document.getElementById('bulkDeleteForm'); // form de eliminación

  // Actualizar el contador y el botón de eliminar
  function updateUI() {
    // const selectedCheckboxes = [...checkboxes].filter(cb => cb.checked);
    const selectedCheckboxes = [...checkboxes].filter(checkbox => checkbox.checked);
    const selectedCount = selectedCheckboxes.length;
    selectCount.textContent = selectedCount;  // Actualiza el contador

    // Actualiza los IDs seleccionados
    /* const selectedIds = selectedCheckboxes.map(cb => cb.value).join(',');
    bulkDeleteIdsInput.value = selectedIds; */

    // Muestra/oculta el botón de eliminación masiva
    if (selectedCount > 0) {
      bulkDeleteButton.classList.remove('hidden'); // Muestra el botón
      bulkDeleteIdsInput.value = selectedCheckboxes.map(checkbox => checkbox.value).join(',');
    } else {
      bulkDeleteButton.classList.add('hidden'); // Oculta el botón
      bulkDeleteIdsInput.value = '';
    }
  }

  // Evento para el checkbox "Seleccionar todo"
  if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('change', function () {
      const isChecked = this.checked;
      
      checkboxes.forEach(checkbox => {
        checkbox.checked = isChecked;
      });
      updateUI();
    });
  }

  // Evento para cada checkbox individual
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      updateUI();
    });
  });

  // Actualiza la interfaz al cargar la página
  updateUI();

  // Abrir el modal
  bulkDeleteButton.addEventListener('click', (e) => {
    e.preventDefault(); // Previene cualquier acción por defecto
    const selectedCount = parseInt(document.getElementById('select_count').textContent, 10);

    if (selectedCount > 0) {
      deleteModal.classList.remove('hidden');
    } else {
      alert('Por favor, selecciona al menos un periférico para eliminar.');
    }
  });

  // Cerrar el modal al cancelar
  cancelButton.addEventListener('click', () => {
    deleteModal.classList.add('hidden');  // Cierra el modal

    // Deseleccionar todos los checkboxes
    checkboxes.forEach(checkbox => {
      checkbox.checked = false;
    });

    selectAllCheckbox.forEach(checkbox => {
      checkbox.checked = false;
    });

    // Resetear el contador y el campo oculto
    updateUI();
  });

  // Confirmar eliminación y enviar el formulario
  confirmDeleteButton.addEventListener('click', () => {
    if (bulkDeleteForm) {
      bulkDeleteForm.submit();
    }
  });
});
document.addEventListener('DOMContentLoaded', function () {
  const selectAllCheckbox = document.getElementById('selectAll');   // <thead> - Todos
  const checkboxes = document.querySelectorAll('.recordCheckbox');  // <tbody> - Individuales
  const selectCount = document.getElementById('select_count');
  const bulkDeleteButton = document.getElementById('bulkDeleteButton');
  const bulkDeleteIdsInput = document.getElementById('bulkDeleteIds');  // form - input

  // Actualizar el contador y el botón de eliminar
  function updateUI() {
    const selectedCheckboxes = [...checkboxes].filter(cb => cb.checked);
    const selectedCount = selectedCheckboxes.length;

    selectCount.textContent = selectedCount;  // Actualiza el contador

    // Actualiza los IDs seleccionados
    const selectedIds = selectedCheckboxes.map(cb => cb.value).join(',');
    bulkDeleteIdsInput.value = selectedIds;

    // Muestra/oculta el botón de eliminación masiva
    if (selectedCount > 0) {
      bulkDeleteButton.classList.remove('hidden'); // Muestra el botón
    } else {
      bulkDeleteButton.classList.add('hidden'); // Oculta el botón
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
});
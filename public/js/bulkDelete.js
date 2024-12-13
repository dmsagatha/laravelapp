// Manejar la selección de checkboxes
function toggleAllCheckboxes(source) {
  const checkboxes = document.querySelectorAll('.recordCheckbox');

  checkboxes.forEach(checkbox => checkbox.checked = source.checked);
}

document.getElementById('bulkDeleteForm').addEventListener('submit', function(e) {
  if (!confirm('¿Esta seguro de eliminar los registros seleccionados?')) {
    e.preventDefault();
  }
});

// El checkbox maestro cambie su estado dinámicamente según los checkboxes seleccionados
document.addEventListener('DOMContentLoaded', function() {
  const selectAllCheckbox = document.getElementById('selectAll');   // <thead>
  const checkboxes = document.querySelectorAll('.recordCheckbox');  // <tbody>

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const allChecked = Array.from(checkboxes).every(cb => cb.checked);
      const noneChecked = Array.from(checkboxes).every(cb => !cb.checked);

      if (allChecked) {
        selectAllCheckbox.checked = true;
        selectAllCheckbox.indeterminate = false;
      } else if (noneChecked) {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = false;
      } else {
        selectAllCheckbox.indeterminate = true;
      }
    });
  });
});
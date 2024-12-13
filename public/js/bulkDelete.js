function toggleAllCheckboxes(source) {
  const checkboxes = document.querySelectorAll('.recordCheckbox');

  checkboxes.forEach(checkbox => checkbox.checked = source.checked);
}

document.getElementById('bulkDeleteForm').addEventListener('submit', function(e) {
  if (!confirm('¿Esta seguro de eliminar los registros seleccionados?')) {
      e.preventDefault();
  }
});
document.addEventListener('DOMContentLoaded', function () {
  const checkboxes = document.querySelectorAll('.recordCheckbox');  // <tbody>
  const selectCount = document.getElementById('select_count');
  const deleteButton = document.getElementById('bulkDeleteButton');
  // const selectAllCheckbox = document.getElementById('selectAll');   // <thead>

  let selectedIds = [];

  // Actualiza la lista de seleccionados
  checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function () {
          if (this.checked) {
              selectedIds.push(this.value);
          } else {
              selectedIds = selectedIds.filter(id => id !== this.value);
          }
          updateSelectCount();
      });
  });

  // Actualiza el conteo visual
  function updateSelectCount() {
      selectCount.textContent = selectedIds.length;
  }
});
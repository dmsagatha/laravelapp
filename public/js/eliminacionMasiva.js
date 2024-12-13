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

/* document.addEventListener('DOMContentLoaded', function () {
  const selectAllCheckbox = document.getElementById('selectAll');   // <thead> - Todos
  const checkboxes = document.querySelectorAll('.recordCheckbox');  // <tbody> - Checkboxes individuales
  const selectCount = document.getElementById('select_count');
  
  // Función para contar seleccionados
  const updateSelectedCount = () => {
      const selected = Array.from(checkboxes).filter(cb => cb.checked).length;
      selectCount.textContent = selected;
  };

  // Seleccionar o deseleccionar todos
  selectAllCheckbox.addEventListener('change', function () {
      checkboxes.forEach(cb => {
          if (!cb.disabled) {
              cb.checked = selectAllCheckbox.checked;
          }
      });
      updateSelectedCount();
  });

  // Actualizar el contador al cambiar un checkbox individual
  checkboxes.forEach(cb => {
      cb.addEventListener('change', updateSelectedCount);
  });

  // Inicializar el contador
  updateSelectedCount();
}); */


/* document.addEventListener('DOMContentLoaded', function () {
  const checkboxes = document.querySelectorAll('.recordCheckbox');  // <tbody> - Checkboxes individuales
  const selectCount = document.getElementById('select_count');
  const deleteButton = document.getElementById('bulkDeleteButton');

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

  // Manejar la acción de eliminación
  deleteButton.addEventListener('click', function () {
    if (selectedIds.length === 0) {
        alert('Por favor selecciona al menos un registro para eliminar.');
        return;
    }

    if (!confirm('¿Estás seguro de que deseas eliminar los registros seleccionados?')) {
        return;
    }

    // Enviar la solicitud de eliminación
    fetch('{{ route("users.massDestroy") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ ids: selectedIds })
    })
    .then(response => {
        if (response.ok) {
            alert('Los registros seleccionados han sido eliminados.');
            location.reload();
        } else {
            alert('Hubo un error al eliminar los registros.');
        }
    })
    .catch(error => console.error('Error:', error));
  });
}); */
@push('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

  <script>
    let table = new DataTable('#dtTailwindcss', {
      responsive: true,
      lengthMenu: [[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, "Todos"]],
      pageLength: 5,
      processing: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
      }
    });
  </script>

  {{-- <script src="{{ asset('js/bulkDelete.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/massElimination.js') }}"></script> --}}

  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar y deseleccionar todos los checkboxes
        const selectAllCheckbox = document.getElementById('select-all');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('click', function(event) {
                const checkboxes = document.querySelectorAll('.record-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
            });
        }

        // Mostrar modal
        function showModal(action, url) {
            document.getElementById('modal-title').innerText = action.charAt(0).toUpperCase() + action.slice(1);
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('confirm-button').onclick = function() { handleAction(action, url); };
        }

        // Manejar el envío de la acción
        function handleAction(action, url) {
            const selectedIds = Array.from(document.querySelectorAll('.record-checkbox:checked')).map(cb => cb.value);
            if (!selectedIds.length) {
                alert('Por favor, selecciona al menos un registro.');
                return;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids: selectedIds })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            });
        }

        // Asignar eventos a los botones
        const deleteButton = document.getElementById('delete-button');
        if (deleteButton) {
            deleteButton.addEventListener('click', function() {
                showModal('delete', this.dataset.action);
            });
        }

        const restoreButton = document.getElementById('restore-button');
        if (restoreButton) {
            restoreButton.addEventListener('click', function() {
                showModal('restore', this.dataset.action);
            });
        }

        const resetButton = document.getElementById('reset-button');
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                showModal('reset', this.dataset.action);
            });
        }

        // Cancelar modal
        const cancelButton = document.getElementById('cancel-button');
        if (cancelButton) {
            cancelButton.addEventListener('click', () => {
                document.getElementById('modal').classList.add('hidden');
            });
        }
    });
</script>
@endpush
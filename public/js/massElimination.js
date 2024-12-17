const actionModal = document.getElementById('actionModal');
const modalTitle = document.getElementById('modalTitle');
const modalMessage = document.getElementById('modalMessage');
const cancelButton = document.getElementById('cancelButton');
const confirmButton = document.getElementById('confirmButton');

// IDs seleccionados para las acciones masivas
let selectedIds = [];
let currentAction = ''; // Puede ser 'delete', 'restore', 'forceDelete'

// Función para mostrar el modal
function showModal(action, ids) {
  currentAction = action;
  selectedIds = ids;

  // Configurar el contenido del modal según la acción
  switch (action) {
    case 'massDestroy':
      modalTitle.textContent = 'Eliminar registros';
      modalMessage.textContent = '¿Estás seguro de que deseas eliminar los registros seleccionados?';
      confirmButton.classList.replace('bg-red-500', 'bg-yellow-500');
      confirmButton.textContent = 'Eliminar';
      break;
    case 'restoreAll':
      modalTitle.textContent = 'Restaurar registros';
      modalMessage.textContent = '¿Deseas restaurar los registros seleccionados?';
      confirmButton.classList.replace('bg-yellow-500', 'bg-green-500');
      confirmButton.textContent = 'Restaurar';
      break;
    /* case 'forceDelete':
        modalTitle.textContent = 'Eliminar permanentemente';
        modalMessage.textContent = '¿Estás seguro de que deseas eliminar permanentemente estos registros? Esta acción no se puede deshacer.';
        confirmButton.classList.replace('bg-green-500', 'bg-red-500');
        confirmButton.textContent = 'Eliminar permanentemente';
        break; */
    default:
      return;
  }

  actionModal.classList.remove('hidden');
  actionModal.classList.add('flex');
}

// Función para ocultar el modal
function hideModal() {
  actionModal.classList.add('hidden');
  actionModal.classList.remove('flex');
  currentAction = '';
  selectedIds = [];
}

// Configurar botones del modal
cancelButton.addEventListener('click', hideModal);
confirmButton.addEventListener('click', () => {
  executeAction(currentAction, selectedIds);
  hideModal();
});

// Función para ejecutar la acción seleccionada
function executeAction(action, ids) {
  console.log(`Acción: ${action}, IDs: ${ids}`);
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // URL base para las acciones de eliminación, restauración y eliminación permanente
  const urlMap = {
    massDestroy: '/usuarios/eliminar-en-masa',
    restoreAll: '/usuarios/restaurar-todos',
    // forceDelete: '/',
  };

  fetch(urlMap[action], {
    method: action === 'restoreAll' ? 'POST' : 'DELETE',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
    body: JSON.stringify({ ids }),
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);
      // Recargar o actualizar tabla
    })
    .catch((error) => console.error(error));
}

function getSelectedIds() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  return Array.from(checkboxes).map((checkbox) => checkbox.value);
}
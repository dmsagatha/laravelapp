document.addEventListener('DOMContentLoaded', () => {
  const actionModal = document.getElementById('actionModal');
  const modalForm = document.getElementById('modalForm');
  const modalTitle = document.getElementById('modalTitle');
  const modalMessage = document.getElementById('modalMessage');

  // Vincular eventos a los botones con data-action
  document.querySelectorAll('[data-action]').forEach(button => {
    button.addEventListener('click', () => {
      console.log('Botón clickeado:', button);

      const actionUrl = button.dataset.action;
      const method = button.dataset.method || 'POST';
      const title = button.dataset.title || 'Confirmación';
      const message = button.dataset.message || '¿Estás segura de realizar esta acción?';

      // Mostrar el modal con la información configurada
      showModal({ title, message, actionUrl, method });
    });
  });

  // Función para mostrar el modal
  function showModal({ title, message, actionUrl, method }) {
    console.log('Mostrando modal con:', { title, message, actionUrl, method });

    // Actualizar contenido del modal
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    modalForm.action = actionUrl;
    modalForm.querySelector('[name="_method"]').value = method;

    actionModal.classList.remove('hidden');
    actionModal.classList.add('flex');
  }

  // Cerrar el modal al cancelar
  document.getElementById('modalCancelButton').addEventListener('click', () => {
    actionModal.classList.remove('flex');
    actionModal.classList.add('hidden');
  });



  // Buscar todos los botones con data-action
  /* const buttons = document.querySelectorAll('[data-action]');
  console.log('Botones encontrados:', buttons);

  buttons.forEach(button => {
    // Log para verificar cada botón
    console.log('Configurando evento para botón:', button);

    // Agregar evento click
    button.addEventListener('click', () => {
      console.log('¡Se hizo clic en el botón!', button);

      // Extraer atributos del botón
      const actionUrl = button.dataset.action;
      const method = button.dataset.method || 'POST';
      const title = button.dataset.title || '¿Estás segura?';
      const message = button.dataset.message || 'Esta acción no se puede deshacer.';

      // Mostrar datos en la consola
      console.log('Datos del botón:', { actionUrl, method, title, message });

      // Aquí se llamaría la función que abre el modal
      showModal({ title, message, actionUrl, method });
    });
  });

  function showModal({ title, message, actionUrl, method }) {
    console.log('Mostrando modal con:', { title, message, actionUrl, method });

    const actionModal = document.getElementById('actionModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalForm = document.getElementById('modalForm');

    // Actualizar contenido del modal
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    modalForm.action = actionUrl;
    modalForm.method = method;

    // Mostrar modal
    actionModal.classList.remove('hidden');
    actionModal.classList.add('flex');
  } */
});
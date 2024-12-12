// [7] Cómo Seleccionar Todo con Checkbox en JavaScript - https://www.youtube.com/watch?v=8rxxUhPPna0
  const selectedAll = document.querySelector("#selectedAll")
  const itemSelected = document.querySelectorAll('#selectIds')
  const bulkDeleteButton = document.querySelector("#bulkDeleteButton")

  // Convertir a un arreglo
  const itemSelectedArray = Array.from(itemSelected)

  // Evento al dar clic en el botón de "Todos" (2 opciones)
  /* selectedAll.addEventListener('change', (event) => {
    // alert('La selección funciona!');
    // console.log(event);

    itemSelected.forEach((item) => {
      // console.log(item.checked)
      item.checked = false;
    })

    if (event.target.checked) {
      itemSelected.forEach((item) => {
        item.checked = true;
      });
    }
  }); */
  
  // Convertir la lista de nodos a una matriz con el método Array.from
  selectedAll.addEventListener('change', () => {
    Array.from(itemSelected).map((chkbx) => {
      chkbx.checked = selectedAll.checked;
    });
  });

  function isSelected(item) {
    return item.checked
  }

  // Al seleccionar un Item o Todos, mostrar el botón para eliminar
  // Verificar que al menos un ítem este seleccionado
  itemSelected.forEach((item) => {
    item.addEventListener('change', (event) => {
      const someSelected = itemSelectedArray.some(isSelected);
      console.log(someSelected);
      bulkDeleteButton.classList.add('hidden');

      if (someSelected) {
        bulkDeleteButton.classList.remove('hidden');
        bulkDeleteButton.classList.add('flex');
      }
    });
  });
  




  /* itemSelected = Array.from(itemSelected);

  // Evento al dar clic en el botón de "Eliminar Selección"
  bulkDeleteButton.addEventListener('click', () => {
    // alert('Se eliminan los items seleccionados!');
    itemSelected.forEach((item) => {
      if (item.checked) {
        item.parentElement.removeChild(item);
      }
    });

    // Ocultar el botón de Eliminar si no hay más items seleccionados
    if (!Array.from(itemSelected).some((chkbx) => chkbx.checked)) {
      bulkDeleteButton.classList.remove('flex');
      bulkDeleteButton.classList.add('hidden');
    }
  }); */
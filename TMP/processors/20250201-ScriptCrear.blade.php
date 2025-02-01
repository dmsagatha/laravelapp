
    
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById("memory-fields");
        const addMemoryBtn = document.getElementById("add-memory-btn");
        const memoryTable = document.getElementById("memory-table");
        const memoryList = document.getElementById("memory-list");

        // Ocultar la tabla si no hay memorias cargadas
        if (memoryList.children.length === 0) {
          memoryTable.classList.add("hidden");
        }

        addMemoryBtn.addEventListener("click", function () {
          console.log("🟡 Botón de agregar memoria clickeado");
        
          // Mostrar la tabla
          memoryTable.classList.remove("hidden");

          const index = memoryList.children.length;
          const memoryField = document.createElement("tr");
          memoryField.classList.add("memory-item");

          memoryField.innerHTML = `
            <td>
              <select name="memories[${index}][id]" class="select--control sm:w-80 md:w-60 p-2" required>
                <option value="">Seleccionar</option>
                @foreach($memories as $memory)
                  <option value="{{ $memory->id }}">
                    {{ $memory->serial }} - {{ $memory->technology }} - {{ $memory->capacity }}
                  </option>
                @endforeach
                </select>
            </td>
            <td>
              <input type="number" name="memories[${index}][quantity]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" min="1" required>
            </td>
            <button type="button" class="remove-memory-btn bg-red-500 text-white px-2 py-1 rounded">
              <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
              </svg>
            </button>
          `;
          memoryList.appendChild(memoryField);
        });

        // Validación de referencias duplicadas
        container.addEventListener("change", function (event) {
          if (event.target.classList.contains("memory-select")) {
            const selectedValues = Array.from(document.querySelectorAll(".memory-select"))
            .map(select => select.value)
            .filter(value => value !== "");

            const uniqueValues = new Set(selectedValues);

            if (selectedValues.length !== uniqueValues.size) {
              /* Swal.fire({
                icon: "warning",
                title: "Referencia duplicada",
                text: "Esta referencia ya ha sido seleccionada. Por favor, elegir otra.",
                confirmButtonColor: "#d33",
              }); */
        Swal.fire(
          'Buen trabajo, estoy funcionando!',
          'Haga clic en el botón!',
          'success')

              // Restablecer la selección
              event.target.value = "";
            }
          }
        });

        container.addEventListener("click", function (event) {
          if (event.target.classList.contains("remove-memory-btn")) {
            console.log("🔴 Botón de eliminar clickeado");

            // Buscar la memoria en una fila `<tr>` si es una memoria guardada
            let memoryField = event.target.closest("tr");

            if (memoryField) {
              console.log("✅ Elemento encontrado para eliminar:", memoryField);

              const hiddenInput = memoryField.querySelector('select[name^="memories"][name$="[id]"]');
              
              if (hiddenInput && hiddenInput.value) {
                console.log("🔵 Memoria existente detectada con ID:", hiddenInput.value);

                memoryField.style.display = "none";

                let deleteInput = document.querySelector(`input[name="memories_to_delete[]"][value="${hiddenInput.value}"]`);

                if (!deleteInput) {
                  deleteInput = document.createElement("input");
                  deleteInput.type = "hidden";
                  deleteInput.name = "memories_to_delete[]";
                  deleteInput.value = hiddenInput.value;
                  container.appendChild(deleteInput);
                  console.log("🟢 Input hidden creado para marcar la memoria como eliminada:", deleteInput);
                }
              } else {
                console.log("🟠 Memoria nueva eliminada completamente del DOM");
                memoryField.remove();
              }
            } else {
              console.log("⚠️ No se encontró el contenedor de la memoria. Probando con `event.target.parentElement`...");
              console.log("📌 Parent Element:", event.target.parentElement);
            }

            // Ocultar la tabla si ya no quedan memorias
            if (memoryList.children.length === 0) {
              memoryTable.classList.add("hidden");
            }
          }
        });
      });
    </script>
    




    
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById("memory-fields");
        const addMemoryBtn = document.getElementById("add-memory-btn");
    
        container.addEventListener("click", function (event) {
          if (event.target.classList.contains("remove-memory-btn")) {
            let memoryField = event.target.closest("tr") || event.target.closest(".memory-item");
    
            if (memoryField) {
              const hiddenInput = memoryField.querySelector('select[name^="memories"][name$="[id]"]');
              if (hiddenInput && hiddenInput.value) {
                memoryField.style.display = "none";
                let deleteInput = document.querySelector(`input[name="memories_to_delete[]"][value="${hiddenInput.value}"]`);
                if (!deleteInput) {
                  deleteInput = document.createElement("input");
                  deleteInput.type = "hidden";
                  deleteInput.name = "memories_to_delete[]";
                  deleteInput.value = hiddenInput.value;
                  container.appendChild(deleteInput);
                }
              } else {
                memoryField.remove();
              }
            }
          }
        });
    
        addMemoryBtn.addEventListener("click", function () {
          const index = container.children.length;
          const memoryField = document.createElement("div");
          memoryField.classList.add("memory-item", "flex", "items-center", "space-x-4");
          memoryField.innerHTML = `
            <div>
              <select name="memories[${index}][id]" class="memory-select select--control sm:w-80 md:w-60 p-2" required>
                <option value="">Seleccionar</option>
                @foreach($memories as $memory)
                  <option value="{{ $memory->id }}">{{ $memory->serial }} - {{ $memory->capacity }}GB</option>
                @endforeach
              </select>
            </div>
            <div>
              <input type="number" name="memories[${index}][quantity]" class="block py-2 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer text-center" min="1" required>
            </div>
            <button type="button" class="remove-memory-btn bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
          `;
          container.appendChild(memoryField);
        });
    
        // 🔹 Mejorado: Detectar referencias duplicadas en tiempo real
        container.addEventListener("change", function (event) {
          if (event.target.classList.contains("memory-select")) {
            const allSelects = document.querySelectorAll(".memory-select");
            const selectedValues = [];
    
            allSelects.forEach(select => {
              if (select.value) selectedValues.push(select.value);
            });
    
            // Revisa si hay valores repetidos
            const duplicates = selectedValues.filter((item, index) => selectedValues.indexOf(item) !== index);
    
            if (duplicates.length > 0) {
              Swal.fire({
                icon: "warning",
                title: "Referencia duplicada",
                text: "Esta referencia ya ha sido seleccionada. Por favor, elige otra.",
                confirmButtonColor: "#d33",
              });
    
              // Restablecer el `select` a la opción vacía si es duplicado
              event.target.value = "";
            }
          }
        });
      });
    </script>
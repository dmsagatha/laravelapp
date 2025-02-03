document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("memory-fields");
  const addMemoryBtn = document.getElementById("add-memory-btn");

  container.addEventListener("click", function (event) {
    if (event.target.classList.contains("remove-memory-btn")) {
      console.log("🔴 Botón de eliminar clickeado");

      // Buscar la memoria en una fila `<tr>` si es una memoria guardada
      let memoryField = event.target.closest("tr") || event.target.closest(".memory-item") || event.target.closest(".flex");

      if (memoryField) {
        console.log("✅ Elemento encontrado para eliminar:", memoryField);

        const hiddenInput = memoryField.querySelector('input[name^="memories"][name$="[id]"]');
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
    }
  });

  addMemoryBtn.addEventListener("click", function () {
    console.log("🟡 Botón de agregar memoria clickeado");

    const index = container.children.length;

    const memoryField = document.createElement("div");
    memoryField.classList.add("memory-item", "flex", "items-center", "space-x-4");
    memoryField.innerHTML = `
          <div>
              <label for="memories[${index}][id]">Memory:</label>
              <select name="memories[${index}][id]" class="border border-gray-300 rounded p-2" required>
                  @foreach($memories as $memory)
                      <option value="{{ $memory->id }}">{{ $memory->serial }} - {{ $memory->capacity }}GB</option>
                  @endforeach
              </select>
          </div>
          <div>
              <label for="memories[${index}][quantity]">Quantity:</label>
              <input type="number" name="memories[${index}][quantity]" class="border border-gray-300 rounded p-2" min="1" required>
          </div>
          <button type="button" class="remove-memory-btn bg-red-500 text-white px-2 py-1 rounded">Remove</button>
      `;
    container.appendChild(memoryField);
  });
});
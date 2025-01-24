<div class="grid grid-cols-6 gap-x-10 gap-y-8">
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="mac" id="inputMac" value="{{ old('mac', $processor->mac) }}" autocomplete="mac" autofocus />
      <x-label for="mac" class="required" value="Mac" />
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative z-0 group mt-3">
      <x-input name="servicetag" id="inputServicetag" value="{{ old('servicetag', $processor->servicetag) }}" autocomplete="servicetag" autofocus />
      <x-label for="servicetag" class="required" value="Servicetag" />
    </div>
  </div>
  
  <div class="col-span-6 sm:col-span-3 md:col-span-2">
    <div class="relative form-group">
      {{-- <x-select-label name="user_id" id="user_id" label="Usuario">
        @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
      </x-select-label> --}}
      <label for="user_id">Usuario</label>
      <select id="user_id" name="user_id" required>
          @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
      </select>
    </div>
  </div>

  <div class="col-span-6 sm:col-span-3">
    <div class="relative form-group">
      {{-- <x-select-label name="prototype_id" id="prototype_id" label="Referencia de Modelo">
        @foreach ($prototypes as $prototype)
          <option value="{{ $prototype->id }}">{{ $prototype->reference }}</option>
        @endforeach
      </x-select-label> --}}
      <label for="prototype_id">Prototipo</label>
      <select id="prototype_id" name="prototype_id" required>
          @foreach ($prototypes as $prototype)
              <option value="{{ $prototype->id }}">{{ $prototype->reference }}</option>
          @endforeach
      </select>
    </div>
  </div> 
</div>

<!-- Sección de Memorias -->
<div id="memory-section">
  <h3>Agregar Memorias</h3>
  <button type="button" id="add-memory-btn">Agregar Memoria</button>

  <table>
      <thead>
          <tr>
              <th>Memoria</th>
              <th>Cantidad</th>
              <th>Acción</th>
          </tr>
      </thead>
      <tbody id="memory-list"></tbody>
  </table>
</div>
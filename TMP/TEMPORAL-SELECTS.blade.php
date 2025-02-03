
        <option selected value="">Seleccionar</option>
        @foreach ($prototypes as $prototype)
        <option value="{{ $prototype->id }}" @selected(old('prototype_id', $processor->prototype_id) == $prototype->id) />
          {{ $prototype->reference }}
        </option>



        {{-- <option selected value="">Seleccionar</option>
        @foreach ($prototypes as $value => $label)
          <option value="{{ $value }}" {{ old('prototype_id', old('prototype_id', $processor->prototype->id ?? '')) == $value ? 'selected' : '' }}>
            {{ $label->reference }}
          </option>
          <option value="{{ $value }}"
            {{ (old('prototype_id') ? old('prototype_id') : $processor->prototype->id ?? '') == $value ? 'selected' : '' }}>
            {{ $label->reference }}
          </option>
          @endforeach --}}
          {{-- <option value disabled {{ old('prototype_id', null) === null ? 'selected' : '' }}>
            Seleccionar
          </option> --}}
          {{-- @foreach ($prototypes as $value => $label)
            <option value="{{ $value }}" @selected(old('prototype_id', $processor->prototype->id) == $value)>
              {{ $label->reference }}
            </option>
          @endforeach --}}
          @foreach ($prototypes as $prototype)
            <option value="{{ $prototype->id }}" @selected(old('prototype_id', $processor->prototype_id) == $prototype->id) />
              {{ $prototype->reference }}
            </option>
          @endforeach















  <div class="col-span-6 sm:col-span-3">
    <div class="relative form-group">
      <label for="prototype_id" class="select--label required">
        Referencia de Modelo
      </label>
      <select name="prototype_id" id="prototype_id" class="select--control">
        <option value="">Seleccionar</option>
        {{-- @foreach($prototypes as $key => $value)
          <option value="{{ $key }}" @selected(old('prototype_id', $processor->prototype->id ?? ''))>{{ $value->reference }}</option>
        @endforeach --}}
        {{-- @foreach ($prototypes as $key => $value)
          <option value="{{ $value }}" @selected(old('user_id', $processor->user->id ?? ''))>
            {{ $value->reference }}
          </option>
        @endforeach --}}
        @foreach($prototypes as $key => $option)
          <option value="{{ $key }}" {{ $value === $key ? 'selected' : '' }} >{{ $option->reference }}</option>
        @endforeach
      </select>

      @error('prototype_id')
        <p class="text-sm text-red-600 dlabelark:text-rose-400">
          {{ $message }}
        </p>
      @enderror
      {{-- @foreach ($prototypes as $prototype)
        <option value="{{ $prototype->id }}" @selected(old('prototype_id', $processor->prototype_id) == $prototype->id) />
          {{ $prototype->reference }}
        </option>
      @endforeach --}}
    </div>
  </div>





  

  <div class="col-span-6 sm:col-span-3">
    <div class="relative form-group">
      <label for="prototype_id" class="select--label required">
        Referencia de Modelo
      </label>
      {{-- <select name="prototype_id">
        <option selected value="">Seleccionar</option>
        @foreach($prototypes as $prototype)
            <option
                value="{{ $prototype->id }}"
                @selected($prototype->id === $processor->prototype_id)
            >
                {{ $prototype->reference }}
            </option>
        @endforeach
    </select> --}}
    <select name="prototype_id" id="prototype_id" class="select--control required">
      <option selected value="">Seleccionar</option>
      @foreach ($prototypes as $id => $label)
          <option value="{{ $id }}" @selected(old('prototype_id', $processor->prototype->id ?? '') == $id)>
              {{ $label->reference }}
          </option>
      @endforeach
  </select>
    </div>
  </div>
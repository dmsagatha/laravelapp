<table id="dtTheme" class="display compact nowrap row-border stripe">
  <thead>
    <tr>
      <th width="1%">N°</th>
      <th>ID</th>
      <th>Acciones</th>
      <th>Usuario</th>
      <th>MAC</th>
      <th>Service Tag</th>
      <th>Memorias</th>
      <th>Prototipos</th>
      <th>Memorias Adicionales</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($processors as $key => $item)
      <tr>
        <td style="text-align: center;">{{ $key + 1 }}</td>
        <td>{{ $item->id }}</td>
        <td>
          <div class="flex items-stretch justify-center">
            <a href="{{ route('processors.edit', $item) }}">
              <svg class="text-blue-500 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                <line x1="16" y1="5" x2="19" y2="8" />
              </svg>
            </a>
            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>
            </a>
          </div>
        </td>
        <th>{{ $item->user->name }}</th>
        <th>{{ $item->mac }}</th>
        <td>{{ $item->servicetag }}</td>
        <td>
          @if(!$item->memories->isEmpty())
            @foreach($item->memories as $memory)
              {{ $memory->serial }} - {{ $memory->capacity }} - {{ $memory->technology }} x {{
              $memory->pivot->quantity }}<br>
            @endforeach
          @endif
        </td>
        <td>{{ $item->prototype->reference }}</td>
        <td class="text-xs">
          @if(!$item->addMemories->isEmpty())
            <p><span class="underline">Adicionales:</span></p>
            @foreach($item->addMemories as $addMemory)
              {{ $addMemory->brand }} - {{ $addMemory->technology }} - {{ $addMemory->velocity }} MHz - {{
              $addMemory->capacity }} x {{ $addMemory->pivot->quantity_addmem }}<br>
            @endforeach
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
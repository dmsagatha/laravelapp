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
              <svg class="text-red-500 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6" />
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                <line x1="10" y1="11" x2="10" y2="17" />
                <line x1="14" y1="11" x2="14" y2="17" />
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
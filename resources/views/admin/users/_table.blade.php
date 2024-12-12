<table id="dtTheme" class="display compact nowrap row-border stripe" style="width:100%">
  <thead>
    <tr>
      <th rowspan="2" width="1%">N°</th>
      <th rowspan="2">
        <p class="text-xs">Eliminar Todos</p>
        {{-- <input type="checkbox" id="selectAll" onchange="selectAllChkboxes()" /> --}}
        <input type="checkbox" id="selectedAll" />
      </th>
      <th rowspan="2">Acciones</th>
      <th colspan="2">Datos Personales</th>
      <th colspan="2">Contacto</th>
    </tr>
    <tr>
      <th>Nombre</th>
      <th>Correo Electrónico</th>
      <th>Profesión</th>
      <th>Teléfono</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key => $item)
      <tr>
        <td style="text-align: center;">{{ $key + 1 }}</td>
        <td class="text-center">
          <input type="checkbox" name="ids" id="selectIds" value="{{ $item->id }}" />
        </td>
        <td>
          <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
          <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
        </td>
        <th>{{ $item->name }}</th>
        <td>{{ $item->email }}</td>
        <td>{{ $item->jobTitle }}</td>
        <td>{{ $item->phone_number }}</td>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>N°</th>
      <th>Eliminar</th>
      <th>Acciones</th>
      <th>Nombre</th>
      <th>Correo Electrónico</th>
      <th>Profesión</th>
      <th>Teléfono</th>
    </tr>
  </tfoot>
</table>
<table id="dtTheme" class="display compact nowrap row-border stripe" style="width:100%">
  <thead>
    <tr>
      <th rowspan="2" width="1%">N°</th>
      <th colspan="2">Datos Personales</th>
      <th colspan="2">Contacto</th>
      <th rowspan="2">Acciones</th>
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
      <th>{{ $item->name }}</th>
      <td>{{ $item->email }}</td>
      <td>{{ $item->jobTitle }}</td>
      <td>{{ $item->phone_number }}</td>
      <td>
        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>N°</th>
      <th>Nombre</th>
      <th>Correo Electrónico</th>
      <th>Profesión</th>
      <th>Teléfono</th>
      <th>Acciones</th>
    </tr>
  </tfoot>
</table>
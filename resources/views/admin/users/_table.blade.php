<table id="dtTailwindcss" class="display" style="width:100%">
  <thead>
    <tr>
      <th rowspan="2" width="1%">N°</th>
      <th rowspan="2">Nombre</th>
      <th rowspan="2">Correo Electrónico</th>
      <th colspan="2">Datos Personales</th>
      <th rowspan="2">Acciones</th>
    </tr>
    <tr>
      <th>País</th>
      <th>Profesión</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key => $item)
      <tr>
        <td style="text-align: center;">{{ $key + 1 }}</td>
        <th>{{ $item->name }}</th>
        <td>{{ $item->email }}</td>
        <th>{{ $item->country }}</th>
        <td>{{ $item->jobTitle }}</td>
        <td>
          <a href="#"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
          <a href="#"
            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Eliminar</a>
        </td>
      </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>N°</th>
      <th>Nombre</th>
      <th>Correo Electrónico</th>
      <th>País</th>
      <th>Dirección</th>
      <th>Acciones</th>
    </tr>
  </tfoot>
</table>
@if (session()->has('failures'))
  <div class="flow-root w-full mx-auto md:w-full lg:w-4/5 shadow px-4 py-4rounded sm:px-1 sm:py-2 bg-slate-50 dark:bg-slate-700 dark:text-slate-50">
    <table class="tableFialures">
      <tr>
        <th>Fila</th>
        <th>Atributo</th>
        <th>Errores</th>
        <th>Valor</th>
      </tr>
      @foreach (session()->get('failures') as $validation)
        <tr>
          <td>{{ $validation->row() }}</td>
          <td>{{ $validation->attribute() }}</td>
          <td>
            <ul>
              @foreach ($validation->errors() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </td>
          <td>{{ $validation->values()[$validation->attribute()] }}</td>
        </tr>
      @endforeach
    </table>
  </div>
@endif
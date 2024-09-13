<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correos masivos</title>
    <style>
      table {
        border-collapse: collapse;
      }

      table th {
        text-align: center;
      }

      table td,
      table th {
        border: 1px solid black;
        padding: 8px;
      }

      p {
        text-align: justify;
        font-size: 1.5rem;
      }

      .p_inline {
        margin-inline: 2em;
        margin-left: 0cm;
      }

      .p_mailto {
        font-size: .8em;
      }
    </style>
  </head>
  <body>
    <div style="font-family: Georgia, serif;">
      <h1>Hola {{ $data['nombre'] }}</h1>

      <p class="text-left rtl:text-right text-gray-500 dark:text-gray-400">{{ $data['mensaje'] }}</p>
    </div>
  </body>
</html>
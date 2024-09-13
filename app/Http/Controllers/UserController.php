<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendBulkMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $usuarios = User::all();
    
    return view('users.index', compact('usuarios'));
  }

  public function enviarCorreosMasivos(Request $request)
  {
    $request->validate([
      'usuarios'   => 'required|array',
      'usuarios.*' => 'exists:users,id', // Asegúrate de que los IDs existan
    ]);

    // Obtener los usuarios seleccionados
    $usuariosSeleccionados = User::whereIn('id', $request->usuarios)->get();

    // Enviar el correo a cada usuario seleccionado
    foreach ($usuariosSeleccionados as $usuario) {
      $data = [
        'nombre'  => $usuario->name,
        'mensaje' => 'Este es un mensaje para ti.',
      ];

      Mail::to($usuario->email)->send(new SendBulkMail($data));
    }

    return redirect()->back()->with('success', 'Correos enviados exitosamente');
  }
}

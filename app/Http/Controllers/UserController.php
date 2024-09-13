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
    $users = User::all();
    
    return view('users.index', compact('users'));
  }

  public function sendBulkEmails(Request $request)
  {
    $request->validate([
      'users'   => 'required|array',
      'users.*' => 'exists:users,id', // Asegurarse de que los IDs existan
    ]);

    // Obtener los usuarios seleccionados
    $selectedUsers = User::whereIn('id', $request->users)->get();

    // Enviar el correo a cada usuario seleccionado
    foreach ($selectedUsers as $usuario) {
      $data = [
        'nombre'  => $usuario->name,
        'mensaje' => 'Este es un mensaje para ti.',
      ];

      Mail::to($usuario->email)->send(new SendBulkMail($data));
    }

    return redirect()->back()->with('success', 'Correos enviados exitosamente');
  }
}

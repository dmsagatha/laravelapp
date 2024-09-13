<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendBulkMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Exception;

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

    // Enviar el correo a cada usuario seleccionado y verificar si hubo fallos en el envío
    try {
      foreach ($selectedUsers as $user) {
        $data = [
          'nombre'  => $user->name,
          'mensaje' => 'Este es un mensaje para ti.',
        ];

        Mail::to($user->email)->send(new SendBulkMail($data));
      }

      return redirect()->back()->with('success', 'Correos enviados exitosamente');
    } catch (Exception $e) {
      // Manejo de errores
      return response()->json(['status' => 'fail', 'message' => 'Error al enviar el correo: ' . $e->getMessage()]);
    }
  }
}
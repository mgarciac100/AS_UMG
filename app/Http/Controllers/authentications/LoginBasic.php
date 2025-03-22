<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  // Método para mostrar la vista de login
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  // Método para procesar el login
  public function login(Request $request)
  {
    // Validar los datos del formulario
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    // Intentar autenticar al usuario
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      dd('Autenticación exitosa');
      // Autenticación exitosa
      return redirect()->intended('/dashboard'); // Redirige al dashboard o a donde desees
    }

    dd('Autenticación fallida');
    // Autenticación fallida
    return back()->withErrors([
      'email' => 'Las credenciales no coinciden.',
    ]);
  }

  // Método para cerrar sesión
  public function logout()
  {
    Auth::logout();
    return redirect('/auth/login-basic');
  }
}

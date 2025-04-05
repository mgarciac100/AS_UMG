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
    // Si el usuario ya está autenticado, redirígelo al dashboard
    if (Auth::check()) {
      return redirect()->route('dashboard-analytics'); // o la página a la que quieras redirigir
    }

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
      // Autenticación exitosa, redirige al dashboard o página deseada
      return redirect()->intended(route('dashboard-analytics'));
    }

    // Autenticación fallida, regresa con errores
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

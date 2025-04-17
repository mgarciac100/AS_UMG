<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'rol' => 'required|exists:roles,id'
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    // Asignar el rol al usuario
    $user->roles()->attach($request->rol, [
      'fechaCreacion' => now(),
      'fechaModificacion' => null
    ]);

    // auth()->login($user); // Descomente si desea loguearlo automáticamente

    return redirect('/')->with('success', '¡Usuario registrado exitosamente con su rol!');
  }

  public function administracion_usuarios()
  {

    $UsuariosRoles = User::with('roles')->get();

//    dd($users, $roles);

    return view('content.administracion.usuarios', get_defined_vars());

  }
}


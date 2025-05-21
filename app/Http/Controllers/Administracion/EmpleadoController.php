<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Empleados;
use App\Models\Puesto;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
  public function index()
  {
    $empleados = Empleados::with(['puesto','user.roles'])->paginate(10);
    $puestos   = Puesto::pluck('pstDescripcion','pstPuestoID');
    $roles     = Roles::pluck('nombre','id');
    return view('administracion.empleados.index', compact('empleados','puestos','roles'));
  }

  public function create()
  {
    $puestos = Puesto::pluck('pstDescripcion','pstPuestoID');
    $roles   = Roles::pluck('nombre','id');
    return view('administracion.empleados.create', compact('puestos','roles'));
  }

  public function store(Request $request)
  {
    $request->validate([
      // datos de usuario
      'name'     => 'required|string|max:255',
      'email'    => 'required|email|unique:users,email',
      'password' => 'required|string|min:8|confirmed',
      // datos de empleado
      'nombre'   => 'required|string',
      'apellidos'=> 'required|string',
      'fecha_nac'=> 'required|date',
      'fecha_ing'=> 'required|date',
      'puesto'   => 'required|exists:puestos,pstPuestoID',
      'salario'  => 'required|numeric|min:0',
      'estado'   => 'required|boolean',
    ]);

    // 1) Crear usuario
    $user = User::create([
      'name'     => $request->name,
      'email'    => $request->email,
      'password' => Hash::make($request->password),
    ]);

    // 2) Crear empleado vinculado (esto dispara tu trigger y asigna el rol)
    Empleados::create([
      'empNombre'         => $request->nombre,
      'empApellidos'      => $request->apellidos,
      'empFechaNacimiento'=> $request->fecha_nac,
      'empFechaIngreso'   => $request->fecha_ing,
      'empPuestoID'       => $request->puesto,
      'empSalarioDiario'  => $request->salario,
      'empEstado'         => $request->estado,
      'empUsuario'        => $user->id,
    ]);

    return redirect()
      ->route('administracion.empleados.index')
      ->with('success', 'Empleado dado de alta correctamente.');
  }

  public function edit(Empleados $empleado)
  {
    $puestos = Puesto::pluck('pstDescripcion','pstPuestoID');
    $roles   = Roles::pluck('nombre','id');
    return view('administracion.empleados.edit', compact('empleado','puestos','roles'));
  }

  public function update(Request $request, Empleados $empleado)
  {
    $request->validate([
      'nombre'   => 'required|string',
      'apellidos'=> 'required|string',
      'fecha_nac'=> 'required|date',
      'fecha_ing'=> 'required|date',
      'puesto'   => 'required|exists:puestos,pstPuestoID',
      'salario'  => 'required|numeric|min:0',
      'estado'   => 'required|boolean',
    ]);

    $empleado->update([
      'empNombre'         => $request->nombre,
      'empApellidos'      => $request->apellidos,
      'empFechaNacimiento'=> $request->fecha_nac,
      'empFechaIngreso'   => $request->fecha_ing,
      'empPuestoID'       => $request->puesto,
      'empSalarioDiario'  => $request->salario,
      'empEstado'         => $request->estado,
    ]);

    return redirect()
      ->route('administracion.empleados.index')
      ->with('success','Empleado actualizado correctamente.');
  }

  public function destroy(Empleados $empleado)
  {
    // Marcar como inactivo en lugar de borrar
    $empleado->update(['empEstado' => 0]);

    return back()->with('success','Empleado dado de baja correctamente.');
  }
}

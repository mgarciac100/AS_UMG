<?php
namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Nomina;
use App\Models\Empleados;
use Illuminate\Http\Request;

class NominaController extends Controller
{
  protected $periodos = [
    1 => 'Semanal',
    2 => 'Quincenal',
    3 => 'Mensual',
  ];

// app/Http/Controllers/Administracion/NominaController.php

  public function index()
  {
    $nominas   = Nomina::with('empleado')->paginate(10);
    $periodos  = [1=>'Semanal',2=>'Quincenal',3=>'Mensual'];
    $empleados = Empleados::selectRaw("empEmpleadosID, empNombre + ' ' + empApellidos as full_name")
      ->pluck('full_name','empEmpleadosID');
    return view('administracion.nominas.index', compact('nominas','periodos','empleados'));
  }


  public function store(Request $request)
  {

    $request->validate([
      'empleado'     => 'required|exists:Empleados,empEmpleadosID',
      'periodo'      => 'required|in:1,2,3',
      'fecha_inicio' => 'required|date',
      'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
      'bruto'        => 'required|numeric|min:0',
      'deducciones'  => 'required|numeric|min:0',
    ]);

    Nomina::create([
      'nmnEmpleado'      => $request->empleado,
      'nmnPeriodo'       => $request->periodo,
      'nmnFechaInicio'   => $request->fecha_inicio,
      'nmnFechaFin'      => $request->fecha_fin,
      'nmnSalarioBruto'  => $request->bruto,
      'nmnDeducciones'   => $request->deducciones,
      'nmnSalarioNeto'   => $request->bruto - $request->deducciones,
    ]);

    return back()->with('success','Nómina registrada correctamente.');
  }

  public function update(Request $request, Nomina $nomina)
  {
    $request->validate([
      'empleado'     => 'required|exists:Empleados,empEmpleadosID',
      'periodo'      => 'required|in:1,2,3',
      'fecha_inicio' => 'required|date',
      'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
      'bruto'        => 'required|numeric|min:0',
      'deducciones'  => 'required|numeric|min:0',
    ]);

    $nomina->update([
      'nmnEmpleado'     => $request->empleado,
      'nmnPeriodo'      => $request->periodo,
      'nmnFechaInicio'  => $request->fecha_inicio,
      'nmnFechaFin'     => $request->fecha_fin,
      'nmnSalarioBruto' => $request->bruto,
      'nmnDeducciones'  => $request->deducciones,
      'nmnSalarioNeto'  => $request->bruto - $request->deducciones,
    ]);

    return back()->with('success','Nómina actualizada correctamente.');
  }

  public function destroy(Nomina $nomina)
  {
    $nomina->delete();
    return back()->with('success','Nómina eliminada.');
  }
}

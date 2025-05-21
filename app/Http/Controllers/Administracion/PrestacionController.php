<?php
namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Prestacion;
use App\Models\Empleados;
use Illuminate\Http\Request;

class PrestacionController extends Controller
{
  // Tipos “1=Bono, 2=Comisión, 3=Otro”
  protected $tipos = [
    1 => 'IGSS',
    2 => 'IRTRA',
    3 => 'ISR',
  ];

  public function index()
  {
    $prestaciones  = Prestacion::with('empleado')->paginate(10);
    $empleadosList = Empleados::selectRaw("empEmpleadosID, empNombre+' '+empApellidos AS full_name")
      ->pluck('full_name','empEmpleadosID');
    $tipos         = $this->tipos;
    return view('administracion.prestaciones.index', compact(
      'prestaciones','empleadosList','tipos'
    ));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'empleado'   => 'required|exists:Empleados,empEmpleadosID',
      'tipo'       => 'required|in:1,2,3',
      'monto'      => 'required|numeric|min:0',
      'fecha'      => 'required|date',
    ]);

    Prestacion::create([
      'prsEmpleado'        => $data['empleado'],
      'prsTipoPrestacion'  => $data['tipo'],
      'prsMonto'           => $data['monto'],
      'prsFecha'           => $data['fecha'],
    ]);

    return back()->with('success','Prestación agregada.');
  }

  public function update(Request $request, Prestacion $prestacion)
  {
    $data = $request->validate([
      'empleado'   => 'required|exists:Empleados,empEmpleadosID',
      'tipo'       => 'required|in:1,2,3',
      'monto'      => 'required|numeric|min:0',
      'fecha'      => 'required|date',
    ]);

    $prestacion->update([
      'prsEmpleado'        => $data['empleado'],
      'prsTipoPrestacion'  => $data['tipo'],
      'prsMonto'           => $data['monto'],
      'prsFecha'           => $data['fecha'],
    ]);

    return back()->with('success','Prestación actualizada.');
  }

  public function destroy(Prestacion $prestacion)
  {
    $prestacion->delete();
    return back()->with('success','Prestación eliminada.');
  }
}

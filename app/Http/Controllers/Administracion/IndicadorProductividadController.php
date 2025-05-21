<?php
// app/Http/Controllers/Administracion/IndicadorProductividadController.php
namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\IndicadorProductividad;
use App\Models\Empleados;
use Illuminate\Http\Request;

class IndicadorProductividadController extends Controller
{
  public function index()
  {
    $items      = IndicadorProductividad::with('empleado')->paginate(10);
    $empleados  = Empleados::selectRaw("empEmpleadosId, empNombre+' '+empApellidos as full_name")
      ->pluck('full_name','empEmpleadosId');
    return view('administracion.productividad.index', compact('items','empleados'));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'empleado_id' => 'required|exists:Empleados,empEmpleadosId',
      'indicador'   => 'required|string|max:100',
      'valor'       => 'required|numeric|min:0',
      'fecha'       => 'required|date',
    ]);

    IndicadorProductividad::create($data);

    return back()->with('success','Indicador creado correctamente.');
  }

  public function update(Request $request, IndicadorProductividad $item)
  {
    $data = $request->validate([
      'empleado_id' => 'required|exists:Empleados,empEmpleadosId',
      'indicador'   => 'required|string|max:100',
      'valor'       => 'required|numeric|min:0',
      'fecha'       => 'required|date',
    ]);

    $item->update($data);

    return back()->with('success','Indicador actualizado correctamente.');
  }

  public function destroy(IndicadorProductividad $item)
  {
    $item->delete();
    return back()->with('success','Indicador eliminado.');
  }
}

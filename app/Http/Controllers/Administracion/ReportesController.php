<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Nomina;
use App\Models\Prestacion;
use App\Models\IndicadorProductividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
  // 1) Página con enlaces
  public function index()
  {
    return view('administracion.reportes.index');
  }

  // 2) Reporte de nóminas: totales brutos y deducciones por mes/año
// app/Http/Controllers/Administracion/ReportesController.php

  public function nominas(Request $request)
  {
    // 1. Reporte mensual
    $reporteMensual = Nomina::selectRaw(
      'YEAR(nmnFechaInicio)   AS anio,
                           MONTH(nmnFechaInicio)  AS mes,
                           SUM(nmnSalarioBruto)   AS total_bruto,
                           SUM(nmnDeducciones)    AS total_deducciones'
    )
      ->groupByRaw('YEAR(nmnFechaInicio), MONTH(nmnFechaInicio)')
      ->orderByRaw('YEAR(nmnFechaInicio) DESC, MONTH(nmnFechaInicio) DESC')
      ->get();

    // 2. Reporte por usuario y año
    $reporteUsuario = Nomina::join('Empleados', 'Nominas.nmnEmpleado', '=', 'Empleados.empEmpleadosID')
      ->selectRaw(
        "Empleados.empNombre + ' ' + Empleados.empApellidos as nombre,
                         YEAR(nmnFechaInicio)       as anio,
                         SUM(nmnSalarioBruto)       as total_bruto,
                         SUM(nmnDeducciones)        as total_deducciones"
      )
      ->groupByRaw("Empleados.empNombre, Empleados.empApellidos, YEAR(nmnFechaInicio)")
      ->orderBy('nombre')
      ->orderBy('anio','desc')
      ->get();

    return view('administracion.reportes.nominas', compact('reporteMensual','reporteUsuario'));
  }

  // 3) Reporte de prestaciones: totales por tipo
  public function prestaciones()
  {
    $reporte = Prestacion::selectRaw(
      'prsTipoPrestacion,
                         COUNT(*)          as cantidad,
                         SUM(prsMonto)    as total_monto'
    )
      ->groupBy('prsTipoPrestacion')
      ->get();

    // Mapea tipo→etiqueta si necesitas
    $tipos = [
      1=>'Bono',2=>'Comisión',3=>'Otro'
    ];

    return view('administracion.reportes.prestaciones', compact('reporte','tipos'));
  }

  // 4) Reporte de productividad: promedio de valor por indicador
  public function productividad()
  {
    $reporte = IndicadorProductividad::selectRaw(
      'indicador,
                         COUNT(*)           as registros,
                         AVG(valor)         as promedio_valor'
    )
      ->groupBy('indicador')
      ->get();

    return view('administracion.reportes.productividad', compact('reporte'));
  }
}

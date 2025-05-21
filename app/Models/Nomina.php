<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
  protected $table = 'Nominas';        // nombre de la tabla
  protected $primaryKey = 'nmnNominaID';
  public $timestamps = false;          // si no tienes created_at/updated_at

  protected $fillable = [
    'nmnEmpleado',
    'nmnPeriodo',
    'nmnFechaInicio',
    'nmnFechaFin',
    'nmnSalarioBruto',
    'nmnDeducciones',
    'nmnSalarioNeto',
  ];

  protected $casts = [
    'nmnFechaInicio'   => 'date:Y-m-d',
    'nmnFechaFin'      => 'date:Y-m-d',
    'nmnSalarioBruto'  => 'decimal:2',
    'nmnDeducciones'   => 'decimal:2',
    'nmnSalarioNeto'   => 'decimal:2',
  ];

  public function empleado()
  {
    return $this->belongsTo(Empleados::class, 'nmnEmpleado', 'empEmpleadosID');
  }
}

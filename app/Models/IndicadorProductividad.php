<?php
// app/Models/IndicadorProductividad.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Empleados; // ← importar el modelo

class IndicadorProductividad extends Model
{
  protected $table      = 'indicadores_productividad';
  public    $timestamps = false;

  protected $fillable = [
    'empleado_id',
    'indicador',
    'valor',
    'fecha',
  ];

  protected $casts = [
    'valor' => 'decimal:2',
    'fecha' => 'date:Y-m-d',
  ];

  public function empleado()
  {
    return $this->belongsTo(
      Empleados::class,
      'empleado_id',        // FK en indicadores_productividad
      'empEmpleadosID'      // PK exacta en Empleados
    );
  }
}

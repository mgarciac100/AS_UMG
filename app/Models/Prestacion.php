<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
  protected $table      = 'Prestaciones';
  protected $primaryKey = 'prsPrestacionID';
  public    $timestamps = false;

  protected $fillable = [
    'prsEmpleado',
    'prsTipoPrestacion',
    'prsMonto',
    'prsFecha',
  ];

  protected $casts = [
    'prsFecha'        => 'date:Y-m-d',
    'prsMonto'        => 'decimal:2',
  ];

  public function empleado()
  {
    return $this->belongsTo(Empleados::class, 'prsEmpleado', 'empEmpleadosID');
  }
}

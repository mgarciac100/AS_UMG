<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
  protected $table = 'Empleados';
  protected $primaryKey = 'empEmpleadosID';



  protected $fillable = [
    'empNombre',
    'empApellidos',
    'empFechaNacimiento',
    'empFechaIngreso',
    'empPuestoID',
    'empSalarioDiario',
    'empEstado',
    'empUsuario'
  ];
  protected $casts = [
    'empFechaNacimiento' => 'date:Y-m-d',
    'empFechaIngreso'    => 'date:Y-m-d',
  ];
  public $timestamps = false;


  public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(Roles::class, 'empleado_rol', 'idEmpleado', 'idRol')
      ->withPivot('fechaCreacion', 'fechaModificacion');
  }

  public function puesto()
  {
    return $this->belongsTo(Puesto::class,'empPuestoID','pstPuestoID');
  }

  public function user()
  {
    return $this->belongsTo(User::class,'empUsuario','id');
  }

  public function nominas()
  {
    return $this->hasMany(Nomina::class, 'nmnEmpleado', 'empEmpleadosID');
  }

  public function prestaciones()
  {
    return $this->hasMany(Prestacion::class, 'prsEmpleado', 'empEmpleadosID');
  }

  public function indicadoresProductividad()
  {
    return $this->hasMany(
      IndicadorProductividad::class,
      'empleado_id',
      'empEmpleadosId'
    );
  }



}

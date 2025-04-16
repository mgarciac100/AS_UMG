<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
  protected $table = 'permisos';

  protected $fillable = [
    'nombre',
    'descripcion',
    'fechaCreacion',
    'fechaModificacion',
  ];

  public $timestamps = false;

  public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(Roles::class, 'permiso_rol', 'idPermiso', 'idRol')
      ->withPivot('fechaCreacion', 'fechaModificacion');
  }
}

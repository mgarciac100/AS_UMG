<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
  protected $table = 'roles';

  protected $fillable = [
    'nombre',
    'descripcion',
    'fechaCreacion',
    'fechaModificacion',
  ];

  public $timestamps = false;

  public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(User::class, 'roles_users', 'idRol', 'idUsuario')
      ->withPivot('fechaCreacion', 'fechaModificacion');
  }

  public function permisos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(Permisos::class, 'permiso_rol', 'idRol', 'idPermiso')
      ->withPivot('fechaCreacion', 'fechaModificacion');
  }
}


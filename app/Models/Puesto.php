<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
  protected $primaryKey = 'pstPuestoID';
  public $timestamps = false;
  protected $fillable = ['pstDescripcion','pstSalarioBase'];
}


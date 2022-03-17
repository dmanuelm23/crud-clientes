<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'domicilio',
        'correo_electronico',
    ];
    public function getNombreAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }
}

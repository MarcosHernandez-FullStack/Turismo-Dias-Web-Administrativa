<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCiudad extends Model
{
    use HasFactory;
    protected $table = 'sub_ciudad';
    protected $guarded = [];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function rutas_sub_ciudad_origen()
    {
        return $this->hasMany(Ruta::class, 'sub_ciudad_origen_id');
    }

    public function rutas_sub_ciudad_destino()
    {
        return $this->hasMany(Ruta::class, 'sub_ciudad_destino_id');
    }

}

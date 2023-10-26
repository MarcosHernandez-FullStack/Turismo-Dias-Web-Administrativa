<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'ciudad';
    protected $guarded = [];

    public function ambientes()
    {
        return $this->hasMany(Ambiente::class);
    }

    public function rutas_ciudad_origen()
    {
        return $this->hasMany(Rutas::class, 'ciudad_origen_id', 'ciudad_id');
    }

    public function rutas_ciudad_destino()
    {
        return $this->hasMany(Rutas::class, 'ciudad_destino_id', 'ciudad_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;
    protected $table = 'ruta';
    protected $guarded = [];

    public function tipo_bus()
    {
        return $this->belongsTo(TipoBus::class);
    }

    public function ciudad_origen()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_origen_id');
    }

    public function ciudad_destino()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_destino_id');
    }

    public function sub_ciudad_origen()
    {
        return $this->belongsTo(SubCiudad::class, 'sub_ciudad_origen_id');
    }

    public function sub_ciudad_destino()
    {
        return $this->belongsTo(SubCiudad::class, 'sub_ciudad_destino_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoBus extends Model
{
    use HasFactory;
    protected $table = 'tipo_bus';
    protected $guarded = [];

    public function rutas()
    {
        return $this->hasMany(Ruta::class);
    }
}

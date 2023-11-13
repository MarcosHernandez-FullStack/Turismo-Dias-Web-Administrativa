<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;
    protected $table = 'configuracion';
    protected $guarded = [];

    public function obtenerURLDeVideo($urlInsercion)
    {
        $urlBase = "https://www.youtube.com/watch?v=";
        $inicio = strpos($urlInsercion, "/embed/") + 7;
        $fin = strpos($urlInsercion, "?");

        if ($inicio !== false && $fin !== false) {
            $idVideo = substr($urlInsercion, $inicio, $fin - $inicio);
            return $urlBase . $idVideo;
        } else {
            return null; // Maneja el caso en el que la URL de inserción no sea válida.
        }
    }
}

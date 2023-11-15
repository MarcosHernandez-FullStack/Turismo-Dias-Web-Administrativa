<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroReclamacion extends Model
{
    use HasFactory;
    protected $table = 'libro_reclamacion';
    protected $guarded = [];
    public $timestamps = true;

    public function tiempoTranscurridoDesde($campo)
    {
        $createdAt = Carbon::parse($campo);
        $now = Carbon::now();
        $diff = $now->diff($createdAt);

        $units = [
            'año' => $diff->y,
            'mes' => $diff->m,
            'semana' => $diff->days / 7,
            'día' => $diff->d,
            'hora' => $diff->h,
            'minuto' => $diff->i,
        ];

        foreach ($units as $unit => $value) {
            if ($value >= 1) {
                if ($unit == 'mes') {
                    $unit = intval($value) > 1 ? $unit . 'es' : $unit; // Agregar 's' para plural si el valor es mayor que 1
                } else {
                    $unit = intval($value) > 1 ? $unit . 's' : $unit; // Agregar 's' para plural si el valor es mayor que 1
                }
                return "hace " . intval($value) . " $unit";
            }
        }

        return "Recién creado"; // Puedes manejar este caso como desees
    }
}

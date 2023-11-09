<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feriado;

class FeriadoController extends Controller
{
    public function index()
    {     
        try {
            $feriados = Feriado::where('estado', '1')->get();
         
            return response()->json([
                "status" => "success",
                "data" =>[
                    "feriados"  => $feriados->map(function ($feriado) {
                        return [
                            "id" => $feriado->id,
                            "start" => $feriado->fecha_inicio,
                            "end" => $feriado->fecha_fin,
                            "title" => $feriado->razon,
                            "estado" => $feriado->estado,
                        ];
                    }),
                ]   
            ], 200); // 200 OK para indicar una respuesta exitosa.
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error en la consulta de Feriados",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

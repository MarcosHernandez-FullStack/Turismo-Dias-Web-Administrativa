<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{

    public function index()
    {
        try {

            $servicios = Servicio::where('estado', '1')->get();

            return response()->json([
                "status" => "success",
                "data" => [
                    "servicios"  => $servicios->map(function ($servicio) {
                        return [
                            "id" => $servicio->id,
                            "nombre" => $servicio->nombre,
                            "descripcion" => $servicio->descripcion,
                            "ruta_foto" => env("APP_URL") . Storage::url($servicio->ruta_foto),
                            "estado" => $servicio->estado
                        ];

                    }),
                ],
            ], 200); // 200 OK para indicar una respuesta exitosa.

        } catch (\Exception $e) {

            return response()->json([
                "message" => "Error en la consulta de Servicios",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}


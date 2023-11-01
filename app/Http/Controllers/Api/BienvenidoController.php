<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Servicio;
use App\Models\Institucional;
use App\Models\Ruta;

class BienvenidoController extends Controller
{
    public function index()
    {
        try {
            $institucional = Institucional::with(['valores' => function ($query) {
                $query->where('estado', '1');
            }])->where('estado', '1')->first();
            $servicios = Servicio::where('estado', '1')->get();
            $rutas = Ruta::where('estado', '1')->get();

            return response()->json([
                "status" => "success",
                "data" => [
                            "id" => $institucional->id,
                            "nombre" => $institucional->slogan_home,
                            "breve_historia" => $institucional->breve_historia,
                            "ruta_foto_principal" =>  env("APP_URL") . Storage::url($institucional->ruta_foto_principal),
                            "ruta_foto_secundaria" =>  env("APP_URL") . Storage::url($institucional->ruta_foto_secundaria),
                            "valores" => $institucional->valores->map(function ($valor) {
                                return [
                                    "id" => $valor->id,
                                    "descripcion" => $valor->descripcion,
                                    "estado" => $valor->estado,
                                    "institucional_id"=>$valor->institucional_id,
                                ];
                            }),
                            "servicios"  => $servicios->map(function ($servicio) {
                                return [
                                    "id" => $servicio->id,
                                    "nombre" => $servicio->nombre,
                                    "descripcion" => $servicio->descripcion,
                                    "ruta_foto" => env("APP_URL") . Storage::url($servicio->ruta_foto),
                                    "estado" => $servicio->estado
                                ];

                            }),
                            "rutas" => $rutas->map(function ($ruta) {
                                return [
                                    "id" => $ruta->id,
                                    "ciudad_origen" => $ruta->ciudad_origen->descripcion,
                                    "ciudad_destino" => $ruta->ciudad_destino->descripcion,
                                    "hora_salida" => $ruta->hora_salida,
                                    "hora_llegada" => $ruta->hora_llegada,
                                    "tipo_bus" =>$ruta->tipo_bus->nombre,
                                    "estado" => $ruta->estado
                                ];

                            }),       
                ],
            ], 200); // 200 OK para indicar una respuesta exitosa.

        } catch (\Exception $e) {

            return response()->json([
                "message" => "Error en la consulta de Bienvenido",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Servicio;
use App\Models\Institucional;
use App\Models\Ruta;
use App\Models\TipoBus;
use Carbon\Carbon;
use App\Models\Configuracion;

class BienvenidoController extends Controller
{
    public function index()
    {
        try {
            $institucional = Institucional::with(['valores' => function ($query) {
                $query->where('estado', '1');
            }])->where('estado', '1')->first();
            $servicios = Servicio::where('estado', '1')->get();
            $tipobuses = TipoBus::with(['rutas' => function ($query) {
                $query->where('estado', '1');
            }])->where('estado', '1')->get();
            $configuracion = Configuracion::where('estado', '1')->first();
            $fecha_inicio = date('d/m/Y', strtotime($institucional->fecha_inicio));
            $fechaActual = now();
            $aniosDeDiferencia = $fechaActual->diffInYears($fecha_inicio);
            return response()->json([
                "status" => "success",
                "data" => [
                            
                            "institucional" => [  
                                

                                    "id" => $institucional->id,
                                    "slogan_home" => $institucional->slogan_home,
                                    "aniosDeDiferencia" =>$aniosDeDiferencia,
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
                            ],
                            "servicios"  => $servicios->map(function ($servicio) {
                                return [
                                    "id" => $servicio->id,
                                    "nombre" => $servicio->nombre,
                                    "descripcion" => $servicio->descripcion,
                                    "ruta_foto" => env("APP_URL") . Storage::url($servicio->ruta_foto),
                                    "estado" => $servicio->estado
                                ];

                            }),
                            "tipobuses" => $tipobuses->map(function ($tipobus) {
                                return [
                                    "id" => $tipobus->id,
                                    "nombre" => $tipobus->nombre,
                                    "ruta_foto" => env("APP_URL") . Storage::url($tipobus->ruta_foto),
                                    "rutas" => $tipobus->rutas->take(2)->map(function ($ruta) {
                                        return [
                                            "id"=>$ruta->id,
                                            "ciudad_origen" => $ruta->ciudad_origen->descripcion,
                                            "ciudad_destino" => $ruta->ciudad_destino->descripcion,
                                            "hora_salida" => Carbon::parse($ruta->hora_salida)->format('h:i a'),
                                            "hora_llegada" => Carbon::parse($ruta->hora_llegada)->format('h:i a'),
                                            
                                        ]; 
                                    }),
                                    
                                ];

                            }),  
                            "configuracion" =>[
                                "foto" => env("APP_URL") . Storage::url($configuracion->ruta_foto_principal),
                                "slogan" => $configuracion->slogan,
                                "video" => $configuracion->ruta_video
                            ]    
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institucional;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;

class InstitucionalController extends Controller
{
    //
    public function index()
    {
        try {
            $institucional = Institucional::with(['valores' => function ($query) {
                $query->where('estado', '1');
            }])->where('estado', '1')->first();

            $configuracion = Configuracion::where('estado', '1')->first();

            return response()->json([
                "status" => "success",
                "data" =>[

                    "institucional" => [
                        "id" => $institucional->id,
                            "slogan_home" => $institucional->slogan_home,
                            "breve_historia" => $institucional->breve_historia,
                            "mision" => $institucional->mision,
                            "vision" => $institucional->vision,
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
                    "fotoHeader" => env("APP_URL") . Storage::url($configuracion->ruta_foto_header_seccion)




                ]


            ], 200); // 200 OK para indicar una respuesta exitosa.


        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error en la consulta de Institucional",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

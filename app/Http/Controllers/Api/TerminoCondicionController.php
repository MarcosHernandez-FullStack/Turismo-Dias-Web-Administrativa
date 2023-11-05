<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Configuracion;
use App\Models\TerminoCondicion;

class TerminoCondicionController extends Controller
{
    public function index()
    {     
        try {
            $terminos = TerminoCondicion::where('estado', '1')->orderBy('orden', 'asc')->get();

            $configuracion = Configuracion::where('estado', '1')->first();
         
            return response()->json([
                "status" => "success",
                "data" =>[
                    "configuracion" => [
                        "subtitulo_seccion" => $configuracion->subtitulo_servicio,
                        "fotoHeader" => env("APP_URL") . Storage::url($configuracion->ruta_foto_header_seccion)
                    ],
                    "terminos" => $terminos,
                    
                ]   
                    
                
            ], 200); // 200 OK para indicar una respuesta exitosa.


        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error en la consulta de Terminos y Condiciones",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

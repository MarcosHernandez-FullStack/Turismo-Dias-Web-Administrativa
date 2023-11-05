<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuracion;

class FooterController extends Controller
{
    
    
    public function index()
    {
        try {

            $configuracion = Configuracion::where('estado', '1')->first();

            return response()->json([
                "status" => "success",
                "data" => [
                    "correoPrincipal" => $configuracion->correo_principal,
                    "facebook" => $configuracion->link_facebook,
                    "instagram" => $configuracion->link_instagram,
                    "youtube" => $configuracion->link_youtube,
                    "linkedin" => $configuracion->link_linkedln,
                    "twitter" => $configuracion->link_linkedln,
                    "celularPrincipal" => $configuracion->celular_principal,
                    "slogan" => $configuracion->slogan,
                    
                    
                ],
            ], 200); // 200 OK para indicar una respuesta exitosa.

        } catch (\Exception $e) {

            return response()->json([
                "message" => "Error en la consulta de Footer",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

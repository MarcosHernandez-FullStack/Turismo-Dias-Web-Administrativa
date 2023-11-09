<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LibroReclamacion;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;

class LibroReclamacionController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->input('data'); // Accede a la clave 'data' en la solicitud
        $reclamo = LibroReclamacion::create($data);

        return response()->json(["message" => "Registro creado con éxito"]);
    }

    public function index()
    {
        try {

            $configuracion = Configuracion::where('estado', '1')->first();

            return response()->json([
                "status" => "success",
                "data" => [
                    "fotoHeader" => env("APP_URL") . Storage::url($configuracion->ruta_foto_header_seccion),
                    "subtitulo_seccion" => $configuracion->subtitulo_libro_reclamacion,
                    "celularPrincipal" => $configuracion->celular_principal,
                    "correoPrincipal" => $configuracion->correo_principal,
                    "facebook" => $configuracion->link_facebook,
                    "instagram" => $configuracion->link_instagram,
                    "youtube" => $configuracion->link_youtube,
                    "linkedin" => $configuracion->link_linkedln,
                    "twitter" => $configuracion->link_twitter                  
                    
                ],
            ], 200); // 200 OK para indicar una respuesta exitosa.

        } catch (\Exception $e) {

            return response()->json([
                "message" => "Error en la consulta de Libro Reclamacion",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

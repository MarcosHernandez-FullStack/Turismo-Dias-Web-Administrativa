<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;

class FAQController extends Controller
{

    public function index()
    {

        try {

            $faqsPrincipal = Faq::where('tipo', 1)->get();
            $faqsSecundaria = Faq::where('tipo', 2)->get();
            $configuracion = Configuracion::where('estado', '1')->first();

            return response()->json([
                "status" => "success",
                "data" => [
                    "faqsPrincipal" => $faqsPrincipal,
                    "faqsSecundaria" => $faqsSecundaria,
                    "fotoHeader" => env("APP_URL") . Storage::url($configuracion->ruta_foto_header_seccion)
                ],
            ], 200); // 200 OK para indicar una respuesta exitosa.


        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error en la consulta de FAQs",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

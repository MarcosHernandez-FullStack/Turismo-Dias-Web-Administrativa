<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LibroReclamacion;
use Illuminate\Http\Request;

class LibroReclamacionController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->input('data'); // Accede a la clave 'data' en la solicitud
        $reclamo = LibroReclamacion::create($data);

        return response()->json(["message" => "Registro creado con éxito"]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Ruta;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
class RutaController extends Controller
{
    //PRINCIPAL: SE ENCUENTRAN LAS CIUDADES Y CALL CENTER
    public function principal(){
        try {
            $ciudades = Ciudad::where('estado', '1')->orderBy('descripcion','asc')->get();
            $configuracion = Configuracion::where('estado', '1')->first();
            return response()->json([
                "status" => "success",
                "data" => [
                    "ciudades"  => $ciudades->map(function ($ciudad) {
                        return [
                            "id" => $ciudad->id,
                            "descripcion" => $ciudad->descripcion,
                           
                        ];

                    }),
                    "call_center" => [
                        "celular_principal" =>  $configuracion->celular_principal,
                        "celular_secundario" => $configuracion->celular_secundario,
                        "correo_principal" => $configuracion->correo_principal,
                        "correo_secundario" => $configuracion->correo_secundario,
                        "horario_atencion_principal" => $configuracion->horario_atencion_principal,
                    ] 
                ],
            ], 200); // 200 OK para indicar una respuesta exitosa.
        } catch (\Exception $e) {

            return response()->json([
                "message" => "Error en la consulta de Ciudades",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }

    //DETALLES DE UNA CIUDAD
    public function detallesDeUnaCiudad($ciudad_id){
        try {

            $rutas = Ruta::where('ciudad_origen_id', $ciudad_id)->where('estado', '1')->get();
            $tipo_buses_disponibles=DB::table('ruta as r')
                                        ->join('tipo_bus as tb', 'r.tipo_bus_id', '=', 'tb.id')
                                        ->where('ciudad_origen_id', $ciudad_id)
                                        ->select('tb.id', 'tb.nombre')
                                        ->distinct()
                                        ->get();
            return response()->json([
                "status" => "success",
                "data" => [
                    "rutas"  => $rutas->map(function ($ruta) {
                        return [
                            "id" => $ruta->id,
                            "nombre_ruta" => $ruta->ciudad_origen->descripcion.'-'.$ruta->ciudad_destino->descripcion,
                            "hora_salida" => $ruta->hora_salida,
                            "hora_llegada" => $ruta->hora_llegada,
                            "nombre_tipo_bus" => $ruta->tipo_bus->nombre,
                            "descripcion_tipo_bus" => $ruta->tipo_bus->descripcion,
                            /* "ruta_foto_tipo_bus" =>env("APP_URL") . Storage::url($ruta->tipo_bus->ruta_foto), */
                            "ruta_foto_tipo_bus" =>$ruta->tipo_bus->ruta_foto,
                            "estado_tipo_bus" => $ruta->tipo_bus->estado,

                        ];

                    }),
                    "tipo_buses_disponibles"  => $tipo_buses_disponibles->map(function ($tbd) {
                        return [
                            "id_tipo_bus" => $tbd->id,
                            "nombre_tipo_bus" => $tbd->nombre,
                        ];
                    })   
                ],
            ], 200); // 200 OK para indicar una respuesta exitosa.
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error en la consulta de rutas de ciudad",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }

}

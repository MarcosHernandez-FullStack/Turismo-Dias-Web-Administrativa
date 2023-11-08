<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Ambiente;
use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Ruta;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
use App\Models\TipoBus;

class RutaController extends Controller
{
    //PRINCIPAL: SE ENCUENTRAN LAS CIUDADES Y CALL CENTER
    public function principal()
    {
        try {
            $ciudades = Ciudad::where('estado', '1')->orderBy('descripcion', 'asc')->get();
            $ambientes = Ambiente::where('estado', '1')->get();
            $configuracion = Configuracion::where('estado', '1')->first();
            return response()->json([
                "status" => "success",
                "data" => [
                    "ambientes" =>$ambientes,
                    "ciudades"  => $ciudades->map(function ($ciudad) {
                        $primerAmbiente = $ciudad->ambientes->first();
                        $latitude = $primerAmbiente ? floatval($primerAmbiente->coordenada_latitud) : null;
                        $longitude = $primerAmbiente ? floatval($primerAmbiente->coordenada_longitud) : null;

                        return [
                            "id" => $ciudad->id,
                            "descripcion" => $ciudad->descripcion,
                            'latitude' => $longitude,
                            'longitude' => $latitude,
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

    /*  $rutas = Ruta::where('ciudad_origen_id', $ciudad_id)->where('estado', '1')->get(); */
    /*  $tipo_buses_disponibles=DB::table('ruta as r')
                                        ->join('tipo_bus as tb', 'r.tipo_bus_id', '=', 'tb.id')
                                        ->where('ciudad_origen_id', $ciudad_id)
                                        ->select('tb.id', 'tb.nombre','tb.descripcion')
                                        ->distinct()
                                        ->get(); */

    //DETALLES DE UNA CIUDAD
    public function detallesDeUnaCiudad($ciudad_id)
    {
        try {
            $tipo_buses = TipoBus::where('estado', '1')->get();

            return response()->json([
                "status" => "success",
                "data" => [

                    "tipo_buses"  => $tipo_buses->map(function ($tipo_bus) use ($ciudad_id) {
                        return [

                            "id" => $tipo_bus->id,
                            "nombre" => $tipo_bus->nombre,
                            "descripcion" => $tipo_bus->descripcion,
                            "ruta_foto_tipo_bus" => env("APP_URL") . Storage::url($tipo_bus->ruta_foto),
                            "rutas" => $tipo_bus->rutas
                                ->filter(function ($ruta) use ($ciudad_id) {
                                    return $ruta->estado == '1' && $ruta->ciudad_origen_id == $ciudad_id;
                                })
                                ->map(function ($ruta) {
                                    return [
                                        "id" => $ruta->id,
                                        "nombre_ruta" => $ruta->ciudad_origen->descripcion . '-' . $ruta->ciudad_destino->descripcion,
                                        "hora_salida" => $ruta->hora_salida,
                                        "hora_llegada" => $ruta->hora_llegada,
                                        "nombre_tipo_bus" => $ruta->tipo_bus->nombre,
                                        "descripcion_tipo_bus" => $ruta->tipo_bus->descripcion,

                                        "estado_tipo_bus" => $ruta->tipo_bus->estado
                                    ];
                                })
                                ->sortBy('hora_salida') //ordena de para ordenar de manera ascendente respecto a la hora_salida
                                ->values(), //se usa al final para reindexar los elementos de la colección, lo cual puede ser útil en caso de que quieras tener índices de 0 en adelante.




                        ];
                    }),
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

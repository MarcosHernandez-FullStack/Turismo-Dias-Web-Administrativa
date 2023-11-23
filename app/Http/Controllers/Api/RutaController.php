<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ambiente;
use App\Models\Ciudad;
use App\Models\Configuracion;
use App\Models\Ruta;
use App\Models\TipoBus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                    "ambientes" => $ambientes,
                    "ciudades" => $ciudades->map(function ($ciudad) {
                        $primerAmbiente = $ciudad->ambientes->first();
                        $latitude = $primerAmbiente ? floatval($primerAmbiente->coordenada_latitud) : null;
                        $longitude = $primerAmbiente ? floatval($primerAmbiente->coordenada_longitud) : null;

                        return [
                            "id" => $ciudad->id,
                            "descripcion" => $ciudad->descripcion,
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                        ];
                    }),
                    "call_center" => [
                        "celular_principal" => $configuracion->celular_principal,
                        "celular_secundario" => $configuracion->celular_secundario,
                        "correo_principal" => $configuracion->correo_principal,
                        "correo_secundario" => $configuracion->correo_secundario,
                        "horario_atencion_principal" => $configuracion->horario_atencion_principal,
                    ],
                    "fotoHeader" => env("APP_URL") . Storage::url($configuracion->ruta_foto_header_seccion),
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

                    "tipo_buses" => $tipo_buses->map(function ($tipo_bus) use ($ciudad_id) {
                        return [

                            "id" => $tipo_bus->id,
                            "nombre" => $tipo_bus->nombre,
                            "descripcion" => $tipo_bus->descripcion,
                            "ruta_foto_tipo_bus" => env("APP_URL") . Storage::url($tipo_bus->ruta_foto),
                            "rutas" => $tipo_bus->rutas
                                ->filter(function ($ruta) use ($ciudad_id) {
                                    return $ruta->estado == '1' && isset($ruta->ciudad_origen_id) ? $ruta->ciudad_origen_id == $ciudad_id : $ruta->sub_ciudad_origen->ciudad->id == $ciudad_id;
                                })
                                ->map(function ($ruta) {
                                    return [
                                        "id" => $ruta->id,
                                        /* "nombre_ruta" => isset($ruta->ciudad_origen)?$ruta->ciudad_origen->descripcion:$ruta->sub_ciudad_origen->descripcion. '-' . isset($ruta->ciudad_destino)?$ruta->ciudad_destino->descripcion:$ruta->sub_ciudad_destino->descripcion, */
                                        "nombre_origen" => isset($ruta->ciudad_origen) ? $ruta->ciudad_origen->descripcion : $ruta->sub_ciudad_origen->descripcion,
                                        "nombre_destino" => isset($ruta->ciudad_destino) ? $ruta->ciudad_destino->descripcion : $ruta->sub_ciudad_destino->descripcion,
                                        "hora_salida" => Carbon::parse($ruta->hora_salida)->format('h:i a'),
                                        "hora_llegada" => Carbon::parse($ruta->hora_llegada)->format('h:i a'),
                                        "nombre_tipo_bus" => $ruta->tipo_bus->nombre,
                                        "descripcion_tipo_bus" => $ruta->tipo_bus->descripcion,
                                        "estado_tipo_bus" => $ruta->tipo_bus->estado,
                                    ];
                                })
                                ->sortBy('hora_salida') //ordena de para ordenar de manera ascendente respecto a la hora_salida
                                ->sortBy("nombre_origen") //ordena de para ordenar de manera ascendente respecto a la hora_salida
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

    public function destinos(Request $request)
    {
        $ciudadDescripcion = $request->input('ciudad');
        try {
            $ciudad = Ciudad::whereRaw("UPPER(descripcion) = UPPER(?)", [$ciudadDescripcion])->where('estado', '1')->first();
            if ($ciudad) {
                $rutas = Ruta::where('estado', '1')->get();
                $ciudad_id_salida = $ciudad->id;
                return response()->json([
                    "status" => "success",
                    "data" => [

                        "destinos" => $rutas->filter(function ($ruta) use ($ciudad_id_salida) {
                            return isset($ruta->ciudad_origen_id) ? $ruta->ciudad_origen_id == $ciudad_id_salida : $ruta->sub_ciudad_origen->ciudad->id == $ciudad_id_salida;
                        })->map(function ($ruta) {
                            return [
                                "nombre_origen" => isset($ruta->ciudad_origen) ? $ruta->ciudad_origen->descripcion : $ruta->sub_ciudad_origen->descripcion,
                                "hora_salida" => Carbon::parse($ruta->hora_salida)->format('h:i a'),
                                "nombre_destino" => isset($ruta->ciudad_destino) ? $ruta->ciudad_destino->descripcion : $ruta->sub_ciudad_destino->descripcion,
                            ];
                        })->sortBy('hora_salida') //ordena de para ordenar de manera ascendente respecto a la hora_salida
                            ->sortBy("nombre_origen")
                            ->values(),
                    ],
                ], 200); // 200 OK para indicar una respuesta exitosa.
            } else {
                return response()->json([
                    "status" => "NotFound",
                    "message" => "No ha encontrado una ciudad con al descripción enviada",
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error en la consulta de rutas de ciudad",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }

    public function salidas(Request $request)
    {
        $ciudadDescripcion = $request->input('ciudad');
        try {
            $ciudad = Ciudad::whereRaw("UPPER(descripcion) = UPPER(?)", [$ciudadDescripcion])->first();
            if ($ciudad) {
                $rutas = Ruta::where('estado', '1')->get();
                $ciudad_id_destino = $ciudad->id;
                return response()->json([
                    "status" => "success",
                    "data" => [

                        "destinos" => $rutas->filter(function ($ruta) use ($ciudad_id_destino) {
                            return isset($ruta->ciudad_destino_id) ? $ruta->ciudad_destino_id == $ciudad_id_destino : $ruta->sub_ciudad_destino->ciudad->id == $ciudad_id_destino;
                        })->map(function ($ruta) {
                            return [
                                "nombre_origen" => isset($ruta->ciudad_origen) ? $ruta->ciudad_origen->descripcion : $ruta->sub_ciudad_origen->descripcion,
                                "hora_salida" => Carbon::parse($ruta->hora_salida)->format('h:i a'),
                                "nombre_destino" => isset($ruta->ciudad_destino) ? $ruta->ciudad_destino->descripcion : $ruta->sub_ciudad_destino->descripcion,
                            ];
                        })->sortBy('hora_salida') //ordena de para ordenar de manera ascendente respecto a la hora_salida
                            ->sortBy("nombre_origen")
                            ->values(),

                    ],
                ], 200); // 200 OK para indicar una respuesta exitosa.
            } else {
                return response()->json([
                    "status" => "NotFound",
                    "message" => "No ha encontrado una ciudad con al descripción enviada",
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error en la consulta de rutas de ciudad",
                "error" => $e->getMessage(),
            ], 500); // Devuelve un código de estado 500 en caso de error.
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruta;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruta::insert(
            [
                //CAJARMARCA-CLASICO
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 15,
                    'hora_salida' => '10:00',
                    'hora_llegada' => '04:30',
                    'tipo_bus_id' => 1,
                ],
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 4,
                    'hora_salida' => '11:00',
                    'hora_llegada' => '05:00',
                    'tipo_bus_id' => 1,
                ],
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 8,
                    'hora_salida' => '04:00',
                    'hora_llegada' => '08:00',
                    'tipo_bus_id' => 1,
                ],

                //CAJARMARCA-PLATA
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 4,
                    'hora_salida' => '12:30',
                    'hora_llegada' => '06:30',
                    'tipo_bus_id' => 2,
                ],
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 8,
                    'hora_salida' => '05:00',
                    'hora_llegada' => '09:00',
                    'tipo_bus_id' => 2,
                ],
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 12,
                    'hora_salida' => '09:45',
                    'hora_llegada' => '06:45',
                    'tipo_bus_id' => 2,
                ],


                //CAJARMARCA-ORO
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 8,
                    'hora_salida' => '06:00',
                    'hora_llegada' => '10:00',
                    'tipo_bus_id' => 3,
                ],
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 12,
                    'hora_salida' => '08:30',
                    'hora_llegada' => '05:30',
                    'tipo_bus_id' => 3,
                ],
                [
                    'ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 15,
                    'hora_salida' => '11:00',
                    'hora_llegada' => '05:00',
                    'tipo_bus_id' => 3,
                ],


                //CHEPEN-CLASICO
                [
                    'ciudad_origen_id' => 3,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '06:30',
                    'hora_llegada' => '11:00',
                    'tipo_bus_id' => 1,
                ],

                //CHEPEN-ORO
                [
                    'ciudad_origen_id' => 3,
                    'ciudad_destino_id' => 8,
                    'hora_salida' => '07:30',
                    'hora_llegada' => '07:30',
                    'tipo_bus_id' => 3,
                ],


                //CHICLAYO-CLASICO
                [
                    'ciudad_origen_id' => 4,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '05:00',
                    'hora_llegada' => '11:00',
                    'tipo_bus_id' => 1,
                ],
                //CHICLAYO-PLATA
                [
                    'ciudad_origen_id' => 4,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '10:00',
                    'hora_llegada' => '04:00',
                    'tipo_bus_id' => 2,
                ],
                //CHICLAYO-ORO
                [
                    'ciudad_origen_id' => 4,
                    'ciudad_destino_id' => 8,
                    'hora_salida' => '06:00',
                    'hora_llegada' => '07:30',
                    'tipo_bus_id' => 3,
                ],



                //CHILETE-PLATA
                [
                    'ciudad_origen_id' => 5,
                    'ciudad_destino_id' => 4,
                    'hora_salida' => '02:30',
                    'hora_llegada' => '06:30',
                    'tipo_bus_id' => 2,
                ],
                //CHILETE-PLATA
                [
                    'ciudad_origen_id' => 5,
                    'ciudad_destino_id' => 8,
                    'hora_salida' => '07:00',
                    'hora_llegada' => '09:00',
                    'tipo_bus_id' => 2,
                ],
                //CHILETE-PLATA
                [
                    'ciudad_origen_id' => 5,
                    'ciudad_destino_id' => 12,
                    'hora_salida' => '11:45',
                    'hora_llegada' => '06:45',
                    'tipo_bus_id' => 2,
                ],
                //CHILETE-ORO
                [
                    'ciudad_origen_id' => 5,
                    'ciudad_destino_id' => 8,
                    'hora_salida' => '08:00',
                    'hora_llegada' => '10:00',
                    'tipo_bus_id' => 3,
                ],


                 //JAEN-PLATA
                 [
                    'ciudad_origen_id' => 7,
                    'ciudad_destino_id' => 12,
                    'hora_salida' => '09:30',
                    'hora_llegada' => '04:30',
                    'tipo_bus_id' => 2,
                ],
                //JAEN-PLATA
                [
                    'ciudad_origen_id' => 7,
                    'ciudad_destino_id' => 15,
                    'hora_salida' => '08:00',
                    'hora_llegada' => '07:00',
                    'tipo_bus_id' => 2,
                ],


                //LIMA(LA VICTORIA)-CLASICO
                [
                    'sub_ciudad_origen_id' => 1,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '04:00',
                    'hora_llegada' => '08:00',
                    'tipo_bus_id' => 1,
                ],
                //LIMA(PLAZA NORTE)-CLASICO
                [
                    'sub_ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '04:45',
                    'hora_llegada' => '08:00',
                    'tipo_bus_id' => 1,
                ],
                //LIMA(LA VICTORIA)-PLATA
                [
                    'sub_ciudad_origen_id' => 1,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '05:00',
                    'hora_llegada' => '09:00',
                    'tipo_bus_id' => 2,
                ],
                //LIMA(PLAZA NORTE)-PLATA
                [
                    'sub_ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '05:45',
                    'hora_llegada' => '09:00',
                    'tipo_bus_id' => 2,
                ],
                //LIMA(LA VICTORIA)-ORO
                [
                    'sub_ciudad_origen_id' => 1,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '06:00',
                    'hora_llegada' => '10:00',
                    'tipo_bus_id' => 3,
                ],
                //LIMA(PLAZA NORTE)-ORO
                [
                    'sub_ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '07:00',
                    'hora_llegada' => '10:00',
                    'tipo_bus_id' => 3,
                ],
                //LIMA-ORO
                [
                    'ciudad_origen_id' => 8,
                    'ciudad_destino_id' => 4,
                    'hora_salida' => '07:30',
                    'hora_llegada' => '08:30',
                    'tipo_bus_id' => 3,
                ],
                //LIMA(PLAZA NORTE)-ORO
                [
                    'sub_ciudad_origen_id' => 2,
                    'ciudad_destino_id' => 4,
                    'hora_salida' => '08:15',
                    'hora_llegada' => '08:30',
                    'tipo_bus_id' => 3,
                ],
                //LIMA(LA VICTORIA)-ORO
                [
                    'sub_ciudad_origen_id' => 1,
                    'ciudad_destino_id' => 15,
                    'hora_salida' => '09:00',
                    'hora_llegada' => '06:30',
                    'tipo_bus_id' => 3,
                ],

                //MOYOBAMBA-CLASICO
                [
                    'ciudad_origen_id' => 9,
                    'ciudad_destino_id' => 15,
                    'hora_salida' => '05:00',
                    'hora_llegada' => '10:00',
                    'tipo_bus_id' => 1,
                ],

                //MOYOBAMBA-CLASICO
                [
                    'ciudad_origen_id' => 10,
                    'ciudad_destino_id' => 15,
                    'hora_salida' => '06:00',
                    'hora_llegada' => '10:00',
                    'tipo_bus_id' => 1,
                ],

                //PACASMAYO-CLASICO
                [
                    'ciudad_origen_id' => 10,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '11:30',
                    'hora_llegada' => '04:30',
                    'tipo_bus_id' => 1,
                ],
                //PACASMAYO-CLASICO
                [
                    'ciudad_origen_id' => 10,
                    'ciudad_destino_id' => 14,
                    'hora_salida' => '05:00',
                    'hora_llegada' => '10:30',
                    'tipo_bus_id' => 1,
                ],


                //PIURA-PLATA
                [
                    'ciudad_origen_id' => 12,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '07:15',
                    'hora_llegada' => '04:15',
                    'tipo_bus_id' => 2,
                ],
                //PIURA-PLATA
                [
                    'ciudad_origen_id' => 12,
                    'ciudad_destino_id' => 7,
                    'hora_salida' => '09:30',
                    'hora_llegada' => '05:00',
                    'tipo_bus_id' => 2,
                ],
                //PIURA-ORO
                [
                    'ciudad_origen_id' => 12,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '08:00',
                    'hora_llegada' => '05:00',
                    'tipo_bus_id' => 3,
                ],


                //TARAPOTO-CLASICO
                [
                    'ciudad_origen_id' => 14,
                    'ciudad_destino_id' => 15,
                    'hora_salida' => '03:00',
                    'hora_llegada' => '10:00',
                    'tipo_bus_id' => 1,
                ],
                //TARAPOTO-CLASICO
                [
                    'ciudad_origen_id' => 14,
                    'ciudad_destino_id' => 11,
                    'hora_salida' => '03:00',
                    'hora_llegada' => '08:00',
                    'tipo_bus_id' => 1,
                ],
                //TARAPOTO-CLASICO
                [
                    'ciudad_origen_id' => 14,
                    'ciudad_destino_id' => 3,
                    'hora_salida' => '03:00',
                    'hora_llegada' => '07:30',
                    'tipo_bus_id' => 1,
                ],
                //TARAPOTO-CLASICO
                [
                    'ciudad_origen_id' => 14,
                    'ciudad_destino_id' => 4,
                    'hora_salida' => '03:00',
                    'hora_llegada' => '07:00',
                    'tipo_bus_id' => 1,
                ],


                //TRUJILLO-CLASICO
                [
                    'ciudad_origen_id' => 15,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '10:00',
                    'hora_llegada' => '04:30',
                    'tipo_bus_id' => 1,
                ],
                 //TRUJILLO-CLASICO
                 [
                    'ciudad_origen_id' => 15,
                    'ciudad_destino_id' => 14,
                    'hora_salida' => '03:00',
                    'hora_llegada' => '10:30',
                    'tipo_bus_id' => 1,
                ],
                //TRUJILLO-PLATA
                [
                    'ciudad_origen_id' => 15,
                    'ciudad_destino_id' => 7,
                    'hora_salida' => '06:00',
                    'hora_llegada' => '04:30',
                    'tipo_bus_id' => 2,
                ],
                //TRUJILLO-ORO
                [
                    'ciudad_origen_id' => 15,
                    'ciudad_destino_id' => 2,
                    'hora_salida' => '10:30',
                    'hora_llegada' => '05:30',
                    'tipo_bus_id' => 3,
                ],
                //TRUJILLO-ORO
                [
                    'ciudad_origen_id' => 15,
                    'ciudad_destino_id' => 16,
                    'hora_salida' => '08:00',
                    'hora_llegada' => '06:00',
                    'tipo_bus_id' => 3,
                ],
                //TRUJILLO-ORO
                [
                    'ciudad_origen_id' => 15,
                    'sub_ciudad_destino_id' => 2,
                    'hora_salida' => '08:00',
                    'hora_llegada' => '06:00',
                    'tipo_bus_id' => 3,
                ],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoBus;

class TipoBusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoBus::insert(
            [
                [
                    'nombre' => 'CLASICO',
                    'descripcion' => 'Servicios higienicos, Reclinación 140°, Cargador entrada USB, Aire acondicionado',
                    'ruta_foto' => 'public/servicio/tipo-bus-1.png'
                ],
                [
                    'nombre' => 'PLATA',
                    'descripcion' => 'Servicios higienicos, Reclinación 140°/160°, Cargador entrada USB, Aire acondicionado',
                    'ruta_foto' => 'public/servicio/tipo-bus-2.png'
                ],
                [
                    'nombre' => 'ORO',
                    'descripcion' => 'Servicios higienicos, Reclinación 160°/160°, Cargador entrada USB, Aire acondicionado',
                    'ruta_foto' => 'public/servicio/tipo-bus-3.png'
                ],


            ]
        );
    }
}

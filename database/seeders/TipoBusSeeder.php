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
                    'ruta_foto' => 'public/tipoBus/kaQNuWVqnWIcop9aP3gjrIaBPLmVoqKaoe4PQvVm.jpg'
                ],
                [
                    'nombre' => 'PLATA',
                    'descripcion' => 'Servicios higienicos, Reclinación 140°/160°, Cargador entrada USB, Aire acondicionado',
                    'ruta_foto' => 'public/tipoBus/MaQNuWVqnWIcop9aP3gjrIaBPLmVoqKaoe4PQvVm.jpg'
                ],
                [
                    'nombre' => 'ORO',
                    'descripcion' => 'Servicios higienicos, Reclinación 160°/160°, Cargador entrada USB, Aire acondicionado',
                    'ruta_foto' => 'public/tipoBus/LaQNuWVqnWIcop9aP3gjrIaBPLmVoqKaoe4PQvVm.jpg'
                ],


            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::insert(
            [
                [
                    'nombre' => 'Transporte de personal',
                    'descripcion' => 'Servicio de transporte terrestre brindado hacia empresas para el traslado de sus trabajadores.',
                    'ruta_foto' => '#',
                ],
                [
                    'nombre' => 'Transporte de pasajeros',
                    'descripcion' => 'Servicio de transporte terrestre que brinda el traslado de pasajeros en rutas definidas por la empresa.',
                    'ruta_foto' => '#',
                ],
                [
                    'nombre' => 'Encomiendas',
                    'descripcion' => 'Servicio de envío de encomiendas y paquetería en las diversas rutas de la empresa.',
                    'ruta_foto' => '#',
                ],
                [
                    'nombre' => 'Carga corporativa',
                    'descripcion' => 'Servicio de envío de carga dirigido a empresas.',
                    'ruta_foto' => '#',
                ],
                [
                    'nombre' => 'Mudanzas',
                    'descripcion' => 'Servicio de mudanza provincial o interprovincial.',
                    'ruta_foto' => '#',
                ],
                [
                    'nombre' => 'Delegaciones',
                    'descripcion' => 'Servicio de alquiler de buses para empresas, colegios, instituciones.',
                    'ruta_foto' => '#',
                ],
                
            ]
        );
    }
}

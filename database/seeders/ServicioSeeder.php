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
                    'ruta_foto' => 'public/servicio/oBEUkCabxxrkRDKF9UcDSK2MCFy3CoGK42uwqg1N.jpg',
                ],
                [
                    'nombre' => 'Transporte de pasajeros',
                    'descripcion' => 'Servicio de transporte terrestre que brinda el traslado de pasajeros en rutas definidas por la empresa.',
                    'ruta_foto' => 'public/servicio/rp2jM9S4KgJQ7j0CBROOaVF3IQ30u1dkAOFRD73L.jpg',
                ],
                [
                    'nombre' => 'Encomiendas',
                    'descripcion' => 'Servicio de envío de encomiendas y paquetería en las diversas rutas de la empresa.',
                    'ruta_foto' => 'public/servicio/2jozTJI1Ph0jcCX7LqjLVuLfn8mljb7vWXWEpZlk.jpg',
                ],
                [
                    'nombre' => 'Carga corporativa',
                    'descripcion' => 'Servicio de envío de carga dirigido a empresas.',
                    'ruta_foto' => 'public/servicio/4RoRRnsuX6ni0Hja1uuSTxCNNQVSj2edjNTbf9Zd.jpg',
                ],
                [
                    'nombre' => 'Mudanzas',
                    'descripcion' => 'Servicio de mudanza provincial o interprovincial.',
                    'ruta_foto' => 'public/servicio/sOlnN17QHbpUMOdStSs91pr9Hq4gCLfSaZFjSOjp.jpg',
                ],
                [
                    'nombre' => 'Delegaciones',
                    'descripcion' => 'Servicio de alquiler de buses para empresas, colegios, instituciones.',
                    'ruta_foto' => 'public/servicio/ugIDVGpdMd2YovJCEUaejhwGJpp2d4Iwao5zW7dD.jpg',
                ],

            ]
        );
    }
}

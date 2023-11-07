<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institucional;

class InstitucionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Institucional::insert(
            [
                [
                    'slogan_home' => 'Más de 25 años brindando servicio de transporte en Perú',
                    'breve_historia' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
                    'mision' => 'Proporcionar una mejora constante de los servicios de transporte de pasajeros y de carga; con la tecnología más avanzada, ofreciendo un servicio personalizado y profesional, donde los clientes se sientan seguros y cómodos.',
                    'vision' => 'Ser una de las principales empresas de transporte de personas y de carga del Perú, siempre cuidando que la calidad y excelencia del servicio, beneficien tanto a los trabajadores como a los clientes.',
                    'fecha_inicio' => '1995-01-01',
                    'ruta_foto_principal' => 'public/institucionales/principal/DISEÑO_WEB.jpg',
                    'ruta_foto_secundaria' => 'public/institucionales/secundaria/ECOMMERCE.jpg',
                    'estado' => '1'

                ],             
                
            ]
        );
    }
}
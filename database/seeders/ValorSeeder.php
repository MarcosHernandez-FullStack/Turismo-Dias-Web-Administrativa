<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Valor;
class ValorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Valor::insert(
            [
                [
                    'descripcion' => 'Excelente servicio al cliente',
                    'estado' => '1',
                    'institucional_id' => 1
                ],   
                [
                    'descripcion' => 'Soporte 24/7',
                    'estado' => '1',
                    'institucional_id' => 1
                ], 
                [
                    'descripcion' => 'Consultas Gratuitas',
                    'estado' => '1',
                    'institucional_id' => 1
                ], 
                [
                    'descripcion' => 'Experiencia de usuario',
                    'estado' => '1',
                    'institucional_id' => 1
                ],
                [
                    'descripcion' => 'Big Data & Analytics',
                    'estado' => '1',
                    'institucional_id' => 1
                ],
                [
                    'descripcion' => 'Asesoramiento',
                    'estado' => '1',
                    'institucional_id' => 1
                ],         
                
            ]
        );
    }
}

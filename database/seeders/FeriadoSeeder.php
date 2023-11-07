<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feriado;
class FeriadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feriado::insert(
            [
                [
                    'fecha_inicio' => '2023-12-08',
                    'fecha_fin' => '2023-12-08',
                    'razon' => 'Día de la Inmaculada Concepción',
                ],
                [
                    'fecha_inicio' => '2023-12-09',
                    'fecha_fin' => '2023-12-09',
                    'razon' => 'Batalla de Ayacucho',
                ],
                [
                    'fecha_inicio' => '2023-12-25',
                    'fecha_fin' => '2023-12-25',
                    'razon' => 'Navidad',
                ],
                [
                    'fecha_inicio' => '2023-12-26',
                    'fecha_fin' => '2023-12-26',
                    'razon' => 'Día no laborable para el sector público',
                ],
                [
                    'fecha_inicio' => '2024-01-01',
                    'fecha_fin' => '2024-01-01',
                    'razon' => 'Año Nuevo',
                ],
                [
                    'fecha_inicio' => '2024-01-02',
                    'fecha_fin' => '2024-01-02',
                    'razon' => 'Día no laborable para el sector público',
                ],
            ]
        );
    }
}

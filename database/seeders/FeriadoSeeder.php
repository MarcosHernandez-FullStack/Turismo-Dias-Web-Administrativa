<?php

namespace Database\Seeders;

use App\Models\Feriado;
use Illuminate\Database\Seeder;

class FeriadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feriado::insert([
            ['fecha_inicio' => '2023-12-08', 'fecha_fin' => '2023-12-08', 'razon' => 'Día de la Inmaculada Concepción', 'estado' => '1', 'created_at' => '2023-11-01 20:45:02', 'updated_at' => '2023-11-01 20:45:02'],
            ['fecha_inicio' => '2023-12-09', 'fecha_fin' => '2023-12-09', 'razon' => 'Batalla de Ayacucho', 'estado' => '1', 'created_at' => '2023-11-01 20:45:02', 'updated_at' => '2023-11-01 20:45:02'],
            ['fecha_inicio' => '2023-12-25', 'fecha_fin' => '2023-12-25', 'razon' => 'Navidad', 'estado' => '1', 'created_at' => '2023-11-01 20:45:02', 'updated_at' => '2023-11-01 20:45:02'],
            ['fecha_inicio' => '2023-12-26', 'fecha_fin' => '2023-12-26', 'razon' => 'Día no laborable para el sector público', 'estado' => '1', 'created_at' => '2023-11-01 20:45:02', 'updated_at' => '2023-11-01 20:45:02'],
            ['fecha_inicio' => '2024-01-01', 'fecha_fin' => '2024-01-01', 'razon' => 'Año Nuevo', 'estado' => '1', 'created_at' => '2023-11-01 20:45:02', 'updated_at' => '2023-11-01 20:45:02'],
            ['fecha_inicio' => '2024-01-02', 'fecha_fin' => '2024-01-02', 'razon' => 'Día no laborable para el sector público', 'estado' => '1', 'created_at' => '2023-11-01 20:45:02', 'updated_at' => '2023-11-01 20:45:02']
        ]);
    }
}

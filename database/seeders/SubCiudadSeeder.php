<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCiudad;
class SubCiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCiudad::insert(
            [
                [
                    'descripcion' => 'LIMA(LA VICTORIA)',
                    'ciudad_id'=>8
                ],
                [
                    'descripcion' => 'LIMA(PLAZA NORTE)',
                    'ciudad_id'=>8
                ]
            ]);
    }
}

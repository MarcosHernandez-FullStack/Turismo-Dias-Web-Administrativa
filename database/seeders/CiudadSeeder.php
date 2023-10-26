<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciudad;
class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudad::insert(
            [
                [
                    'descripcion' => 'CAJABAMBA'
                ],
                [
                    'descripcion' => 'CAJAMARCA'
                ],
                [
                    'descripcion' => 'CHEPEN'
                ],
                [
                    'descripcion' => 'CHICLAYO'
                ],
                [
                    'descripcion' => 'CHILETE'
                ],
                [
                    'descripcion' => 'CHIMBOTE'
                ],
                [
                    'descripcion' => 'JAEN'
                ],
                [
                    'descripcion' => 'LIMA'
                ],
                [
                    'descripcion' => 'MOYOBAMBA'
                ],
                [
                    'descripcion' => 'NUEVA CAJAMARCA'
                ],
                [
                    'descripcion' => 'PACASMAYO'
                ],
                [
                    'descripcion' => 'PIURA'
                ],
                [
                    'descripcion' => 'SAN MARCOS'
                ],
                [
                    'descripcion' => 'TARAPOTO'
                ],
                [
                    'descripcion' => 'TRUJILLO'
                ],
                [
                    'descripcion' => 'LIMA(LA VICTORIA)'
                ],
                [
                    'descripcion' => 'LIMA(PLAZA NORTE)'
                ],
            ]
        );
    }
}

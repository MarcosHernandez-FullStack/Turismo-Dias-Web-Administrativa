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
        //
        Valor::insert(
            [
                [
                    "descripcion" => "integridad",
                    "institucional_id" => 1
                    ] ,
                [
                    "descripcion" => "Innovación",
                    "institucional_id" => 1
                    ] ,
                [
                    "descripcion" => "Compromiso",
                    "institucional_id" => 1
                    ] ,
                [
                    "descripcion" => "Responsabilidad social",
                    "institucional_id" => 1
                    ] ,
                [
                    "descripcion" => "Desarrollo de empleados",
                    "institucional_id" => 1
                    ] ,
            ]
        );
    }
}
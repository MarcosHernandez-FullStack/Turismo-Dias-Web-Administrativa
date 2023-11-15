<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TerminoCondicion;

class TerminoCondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TerminoCondicion::insert(
            [
                [
                    'seccion' => 'Términos y Condiciones',
                    'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal loremmmmmmmmmmmmmmmmmmmmmmmmm',
                    'orden' => 1,
                ],             
                [
                    'seccion' => 'Política de Privacidad',
                    'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal loremmmmmmmmmmmmmmmmmmmmmmmmm',
                    'orden' => 2,
                ],             
                [
                    'seccion' => 'Política de Cookies',
                    'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal loremmmmmmmmmmmmmmmmmmmmmmmmm',
                    'orden' => 3,
                ],             
                [
                    'seccion' => 'Política de Envíos',
                    'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal loremmmmmmmmmmmmmmmmmmmmmmmmm',
                    'orden' => 4,
                ],             
                [
                    'seccion' => 'Política de Devoluciones',
                    'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal loremmmmmmmmmmmmmmmmmmmmmmmmm',
                    'orden' => 5,
                ],             
                [
                    'seccion' => 'Política de Reembolsos',
                    'descripcion' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal loremmmmmmmmmmmmmmmmmmmmmmmmm',
                    'orden' => 6,
                ],
            ]
        );
    }
}
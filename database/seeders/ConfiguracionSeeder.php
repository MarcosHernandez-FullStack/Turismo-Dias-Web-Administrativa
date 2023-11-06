<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Configuracion;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuracion::insert([
            [
                'ruta_foto_principal' => 'public/configuracion/jXQ5jsOUVFPlBvPjJeXm6KcYUVRZtfssnliahUVt.png',
                'slogan' => 'Viaja por todo el Norte y Nororiente de nuestro pais con Turismo Dias',
                'ruta_video' => 'https://www.youtube.com/embed/jAcf4LCR8NM?si=p2r-i7fWagfonYxA',
                'celular_principal' => '978334357',
                'celular_secundario' => '987654321',
                'correo_principal' => 'turismo-dias@gmail.com',
                'correo_secundario' => 'turismo-dias@consultas.com',
                'horario_atencion_principal' => '10:00 am - 08:00 pm',
                'link_facebook' => 'https://www.facebook.com/',
                'link_instagram' => 'https://www.instagram.com/',
                'link_youtube' => 'https://www.youtube.com/',
                'link_linkedln' => 'https://linkedin.com/',
                'razon_social' => 'TURISMO DIAS S.A.C.',
                'nombre' => 'Turismo Dias',
                'subtitulo_servicio' => 'Consulta nuestro catálogo de servicios disponibles',
                'subtitulo_ruta' => 'Selecciona una ciudad para conocer nuestras oficinas, rutas y horarios disponibles.',
                'subtitulo_libro_reclamacion' => 'Libro de Reclamaciones',
                'subtitulo_evento' => 'Consulta nuestras fechas importantes y nuestros feriados no laborables',
                'subtitulo_termino_condicion' => 'Consulta todos nuestros términos y condiciones',
                'ruta_foto_header_seccion' => 'public/configuracion/7zcbO8g5YXZxdJXQT1bP0p3jQGpqN7fYaUJNpNpM.jpg',
                'created_at' => '2023-11-04 22:11:18',
                'updated_at' => '2023-11-05 00:15:47'
            ],
        ]);
    }
}
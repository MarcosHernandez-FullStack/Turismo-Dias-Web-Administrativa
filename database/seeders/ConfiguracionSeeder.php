<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use Illuminate\Database\Seeder;

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
                'ruta_video' => 'https://www.youtube.com/embed/jAcf4LCR8NM?si=be0lgVX_czG3xuj-',
                'celular_principal' => '(+51) 978 334 357',
                'celular_secundario' => '(+51) 987 654 321',
                'correo_principal' => 'turismo-dias@gmail.com',
                'correo_secundario' => 'turismo-dias@consultas.com',
                'horario_atencion_principal' => '10:00 am - 08:00 pm',
                'link_facebook' => 'https://www.facebook.com/TurismoDias/',
                'link_instagram' => 'https://www.instagram.com/turismodias/',
                'link_youtube' => 'https://www.youtube.com/watch?v=jAcf4LCR8NM',
                'link_linkedln' => 'https://linkedin.com/',
                'link_twitter' => 'https://twitter.com/turdiassa?lang=es',
                'razon_social' => 'TURISMO DIAS S.A.C.',
                'nombre' => 'Turismo Dias',
                'subtitulo_servicio' => 'Consulta nuestro catálogo de servicios disponibles',
                'subtitulo_ruta' => 'Selecciona una ciudad para conocer nuestras oficinas, rutas y horarios disponibles.',
                'subtitulo_libro_reclamacion' => 'Libro de Reclamaciones',
                'subtitulo_evento' => 'Consulta nuestras fechas importantes y nuestros feriados no laborables',
                'subtitulo_termino_condicion' => 'Consulta todos nuestros términos y condiciones',
                'ruta_foto_header_seccion' => 'public/configuracion/7zcbO8g5YXZxdJXQT1bP0p3jQGpqN7fYaUJNpNpM.jpg',
                'created_at' => '2023-11-04 22:11:18',
                'updated_at' => '2023-11-05 00:15:47',
            ],
        ]);
    }
}

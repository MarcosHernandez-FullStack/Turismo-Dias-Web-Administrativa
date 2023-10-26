<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::insert(
            [
                [
                    'pregunta' => '¿Se pueden realizar viajes con animales?',
                    'respuesta' => 'No es posible, no transportamos animales.',
                    'tipo'=>'1'
                ],
                [
                    'pregunta' => '¿Cuáles son los requisitos para el viaje de un menor de edad?',
                    'respuesta' => 'Los niños a partir de 5 años deberán pagar su pasaje correspondiente, viajarán acompañados de sus padres o caso contrario portar permiso notarial.',
                    'tipo'=>'1'
                ],
                [
                    'pregunta' => '¿Con cuánto tiempo anticipado puede postergar mi pasaje?',
                    'respuesta' => 'Las postergaciones se realizan hasta 4 horas antes de la salida del bus que ya tiene comprado.',
                    'tipo'=>'1'
                ],
                [
                    'pregunta' => '¿Cuál es el tiempo de espera para el embarque?',
                    'respuesta' => 'La espera para el embarque es de 5 minutos como máximo.',
                    'tipo'=>'2'
                ],
                [
                    'pregunta' => '¿Puedo viajar con DNI vencido?',
                    'respuesta' => 'No es posible, debe adicionar su Ticket de Tramite y una FICHA RENIEC.',
                    'tipo'=>'2'
                ],
                [
                    'pregunta' => '¿Puede un menor de edad viajar en asientos panorámico?',
                    'respuesta' => 'No es posible, los menores de edad, mujeres embarazadas y personas de la tercera edad; a partir de los 65 años, no podrán viajar en asientos PANORÁMICOS',
                    'tipo'=>'2'
                ],
                [
                    'pregunta' => '¿De cuantos grados es el servicio?',
                    'respuesta' => 'Nuestro servicio económico es de 140° y nuestro servicio vip es 160°.',
                    'tipo'=>'2'
                ],
                [
                    'pregunta' => '¿Los buses tienen Cargador micro USB?',
                    'respuesta' => 'Si, todos nuestros servicios lo tienen.',
                    'tipo'=>'2'
                ],
                [
                    'pregunta' => '¿Cuántos kilos de equipaje equivale mi pasaje?',
                    'respuesta' => 'El pasajero portará libre de pago 20 kg de equipaje.',
                    'tipo'=>'2'
                ],

            ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ambiente;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ambiente::insert(
            [
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-7.619349571307369',
                    'coordenada_longitud' => '-78.04651461118492',
                    'direccion' => 'JR. C. HEROS 147',
                    'horario_atencion' => '08:00 am-06:00 pm / LUNES-DOMINGO',
                    'telefono' => '976236206',
                    'ciudad_id' => '1',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-7.169277906947396',
                    'coordenada_longitud' => '-78.49935732474903',
                    'direccion' => 'SEC. SAN MARTIN DE PORRAS AV. EVITAMIENTO 1260',
                    'horario_atencion' => '07:00 am-11:00 pm / LUNES-DOMINGO',
                    'telefono' => '943778033',
                    'ciudad_id' => '2',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-7.220315757404323',
                    'coordenada_longitud' => '-79.4338664734544',
                    'direccion' => 'AV. EXEQUIEL GONZALES CACEDA 188',
                    'horario_atencion' => '07:00 am-08:30 pm / LUNES-DOMINGO',
                    'telefono' => '963355909',
                    'ciudad_id' => '3',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-6.774972807314014',
                    'coordenada_longitud' => '-79.84086754798415',
                    'direccion' => 'CERCADO CAL. JUAN UGLIEVAN 190',
                    'horario_atencion' => '08:00 am-09:00 pm / LUNES-DOMINGO',
                    'telefono' => '948339081',
                    'ciudad_id' => '4',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-7.221201250915764',
                    'coordenada_longitud' => '-78.83842270379817',
                    'direccion' => 'JR. CAJAMARCA 113',
                    'horario_atencion' => '08:00 am-10:00 pm / LUNES-DOMINGO',
                    'telefono' => '976394842',
                    'ciudad_id' => '5',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-9.104641573352891',
                    'coordenada_longitud' => '-78.5577858481776',
                    'direccion' => 'TERMINAL TERRESTRE EL CHIMBADOR-STAND 32',
                    'horario_atencion' => '08:00 am-10:00 pm / LUNES-DOMINGO',
                    'telefono' => '943776241',
                    'ciudad_id' => '6',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-5.716060201763289',
                    'coordenada_longitud' => '-78.80385760235674',
                    'direccion' => 'CENTRO PUCARA AV. JAEN S/N',
                    'horario_atencion' => '07:00 am-09:30 pm / LUNES-DOMINGO',
                    'telefono' => '969380245',
                    'ciudad_id' => '7',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-5.7174560441466',
                    'coordenada_longitud' => '-78.80343274093227',
                    'direccion' => 'SEC. LOS AROMOS JR. PEDRO CORNEJO 836',
                    'horario_atencion' => '07:00 am-09:30 pm / LUNES-DOMINGO',
                    'telefono' => '969380245',
                    'ciudad_id' => '7',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-12.064914041814859',
                    'coordenada_longitud' => '-77.03253476749774',
                    'direccion' => 'AV. JAIME BAUSATE Y MEZA 116',
                    'horario_atencion' => '07:00 am-09:30 pm / LUNES-DOMINGO',
                    'telefono' => '989016237',
                    'ciudad_id' => '8',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-12.00697039943493',
                    'coordenada_longitud' => '-77.05983148717102',
                    'direccion' => 'TERMINAL TERRESTRE PLAZA NORTE-AV. GERARDO UNGER 6917 Int LB 49 - 50',
                    'horario_atencion' => 'PASAJES 07.00 am-9:30 pm / LUNES-DOMINGO & CARGA 08.00 am-08:00 pm / LUNES-SABADO & CARGA 08.00 am-04:00 pm / SABADO',
                    'telefono' => '989016235',
                    'ciudad_id' => '8',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-6.044957379566646',
                    'coordenada_longitud' => '-76.9702329445253',
                    'direccion' => 'TERMINAL TERRESTRE STAND 48 -SEC. VILLA HERMOSA AV. ALMIRANTE GRAU 557',
                    'horario_atencion' => '08:00 am-07:00 pm / LUNES-DOMINGO',
                    'telefono' => '948339117',
                    'ciudad_id' => '9',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-5.908688128732039',
                    'coordenada_longitud' => '-77.3158939995273',
                    'direccion' => 'LOS OLIVOS IV ETAPA AV. CAJAMARCA NORTE 459- TERMINAL TERRESTRE EL MOLINO',
                    'horario_atencion' => '08:00 am-07:00 pm / LUNES-DOMINGO',
                    'telefono' => '948339067',
                    'ciudad_id' => '10',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-7.399274442246691',
                    'coordenada_longitud' => '-79.56751454635669',
                    'direccion' => 'CENTRO PACASMAYO AV. GONZALO UGAZ SALCEDO 187',
                    'horario_atencion' => '07:15 am-10:00 pm / LUNES-DOMINGO',
                    'telefono' => '944271943',
                    'ciudad_id' => '11',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-5.201744678968791',
                    'coordenada_longitud' => '-80.63148210591729',
                    'direccion' => 'AV. LORETO 1485',
                    'horario_atencion' => '07:00 am-09:30 pm / LUNES-DOMINGO',
                    'telefono' => '969381108',
                    'ciudad_id' => '12',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-7.333236819831224',
                    'coordenada_longitud' => '-78.17152892863437',
                    'direccion' => 'AV. TUPAC AMARU 585',
                    'horario_atencion' => '07:00 am-07:00 pm / LUNES-DOMINGO',
                    'telefono' => '976236207',
                    'ciudad_id' => '13',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-6.482889625527211',
                    'coordenada_longitud' => '-76.3816309152708',
                    'direccion' => 'TERMINAL TERRESTRE JR. PRIMERO DE MAYO CDRA 3 . Int 01',
                    'horario_atencion' => '07:00 am-06:00 pm / LUNES-DOMINGO',
                    'telefono' => '948330314',
                    'ciudad_id' => '14',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '1',
                    'coordenada_latitud' => '-8.094579814340284',
                    'coordenada_longitud' => '-79.0383563443035',
                    'direccion' => 'URB. SAN FERNANDO AV. PABLO CASALS 110',
                    'horario_atencion' => '07:00 am-10:00 pm / LUNES-DOMINGO',
                    'telefono' => '948339133',
                    'ciudad_id' => '15',
                ],
                [
                    'nombre' => 'OFICINA',
                    'tipo' => '2',
                    'coordenada_latitud' => '-8.137695979844915',
                    'coordenada_longitud' => '-79.0177129481968',
                    'direccion' => 'OTR. TERRAPUERTO CAR. PANAMER NORTE Km 558 Int 9',
                    'horario_atencion' => '#',
                    'telefono' => '#',
                    'ciudad_id' => '15',
                ],

            ]
        );
    }
}

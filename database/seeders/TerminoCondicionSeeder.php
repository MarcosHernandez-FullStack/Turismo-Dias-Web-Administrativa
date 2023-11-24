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
                    'descripcion' => '<ul><li><strong>CLÁUSULA 1.</strong> EL PASAJERO PERSONALMENTE PUEDE ENDOSAR, TRANSFERIR, POSTERGAR SU BOLETO DE VIAJE CON UNA <i><strong>ANTICIPACIÓN DE 24 HORAS</strong></i>. SÍ A LA FECHA DE HACER USO DEL BOLETO LA TARIFA ES MAYOR EL PASAJERO ABONARÁ LA DIFERENCIA, DE SER MENOR O EN CASO YA NO QUIERA VIAJAR NO HABRÁ DEVOLUCIONES.&nbsp;</li><li><strong>CLÁUSULA 2.</strong> EL PASAJERO DEBERÁ PRESENTARSE <i><strong>30´ MINUTOS ANTES DEL EMBARQUE</strong></i> PORTANDO SU DOCUMENTO DE IDENTIDAD. LA HORA DE EMBARQUE Y DESEMBARQUE EN PUNTOS DE ESCALA ES REFERENCIAL, DEBIDO QUE ESTÁ SUJETO A CONDICIONES DE LA VÍA CLIMÁTICAS, TRÁNSITO Y OTROS FACTORES AJENOS A LA EMPRESA.</li><li><strong>CLÁUSULA 3.</strong> LOS NIÑOS A PARTIR DE LOS <i><strong>5 AÑOS DE EDAD PAGAN SU PASAJE COMPLETO</strong></i>. LOS MENORES DE EDAD DEBEN VIAJAR ACOMPAÑADOS DE SU(S) PADRE(S) O CON SU AUTORIZACIÓN DE VIAJE NOTARIAL O JUDICIAL, ASÍ COMO PORTAR SU DNI ORIGINAL EN FÍSICO.</li><li><strong>CLÁUSULA 4.&nbsp;</strong>EL PASAJERO PORTARA <i><strong>LIBRE DE PAGO 20KG DE EQUIPAJE</strong></i> (EXCEPTUÁNDOSE BIENES MUEBLES) EL EXCESO SERÁ ADMITIDO CUANDO LA CAPACIDAD DEL BUS LO PERMITE PREVIO PAGO DEL SERVICIO SEGÚN TARIFARIO. <i><strong>LA EMPRESA NO ES RESPONSABLE POR EL CONTENIDO DEL EQUIPAJE NI POR SU DETERIORO A CAUSA DEL MAL EMBALAJE</strong></i>.</li><li><strong>CLÁUSULA 5.</strong> EL PASAJERO NO PODRÁ VIAJAR Y PERDERÁ EL VALOR DE SU BOLETO DE VIAJE CUANDO PORTE PRODUCTOS PROHIBIDOS, ARMAS DE FUEGO, ESTÉ BAJO INFLUENCIA DE ALCOHOL, DROGAS Y/O ESTUPEFACIENTES O CUANDO SU ESTADO O CONDICIÓN FÍSICA Y/O PSICOLÓGICA EVIDENCIE QUE PUEDE PONER EN&nbsp;RIESGO SU INTEGRIDAD Y LA DE LOS DEMÁS PASAJEROS. LA EMPRESA NO ASUME RESPONSABILIDAD ALGUNA POR EL ESTADO FÍSICO O DE SALUD DEL PASAJERO, NI POR CUALQUIER TRASTORNO O INCIDENTE QUE PUDIERA SOBREVENIR COMO CONSECUENCIA DE SU ESTADO FÍSICO O SALUD NO EVIDENCIADO.</li><li><strong>CLÁUSULA 6.</strong> ESTÁ PROHIBIDO TRANSPORTAR COMO EQUIPAJE: JOYAS, ARTEFACTOS, PRODUCTOS DE VALOR, DINERO EN EFECTIVO, DE HACERLO, ESTARÁ OBLIGADO A DECLARARLO Y MOSTRARLOS, PAGANDO EL 10% DE SU VALOR Y ESTÁ PROHIBIDO TRASLADAR ANIMALES EN EL SALÓN DEL DE PASAJEROS</li><li><strong>CLÁUSULA 7.&nbsp;</strong>SE PROHÍBE EL TRANSPORTE DE PRODUCTOS PERECIBLES, ANIMALES, EXPLOSIVOS, PIROTÉCNICOS, ARMAS, ENTRE OTROS, EN CASO DE INCUMPLIMIENTO EL PASAJERO ES RESPONSABLE FRENTE A LA EMPRESA Y TERCEROS POR TODOS LOS DAÑOS MATERIALES Y/O PERSONALES QUE SE OCASIONARON.</li><li><strong>CLÁUSULA 8.&nbsp;</strong>EL PASAJERO ANTES DE RETIRARSE DE LA VENTANILLA DE LA VENTA DE PASAJES DEBERÁ VERIFICAR QUE LOS DATOS CONSIGNADOS (NOMBRES E IDENTIFICACIÓN, DESTINO, HORARIO, RAZÓN SOCIAL, RUC, ENTRE OTROS DATOS) ESTÉN CONFORMES. SI EL PASAJERO NO VERIFICARA LO ANTES INDICADO LA EMPRESA ASUMIRÁ QUE DICHOS DATOS ESTÁN CORRECTOS</li><li><strong>CLÁUSULA 9.&nbsp;</strong>EN CASO DE PRESENTARSE ALGUNA EVENTUALIDAD POR CASO FORTUITO O FUERZA MAYOR, EN EL LUGAR DE PARTIDA O DURANTE EL TRAYECTO DEL VIAJE QUE IMPIDA LA CULMINACIÓN Y/O PRESTACIÓN DEL SERVICIO, AUTOMÁTICAMENTE EL PASAJERO BRINDA SU CONSENTIMIENTO PARA QUE LA EMPRESA REALICE EL TRANSBORDO EN UNIDADES ESTÁNDAR (PROPIAS O TERCERAS). SI POR CAUSAS AJENAS LA EMPRESA SE VE IMPOSIBILITADA DE HACER EL TRANSBORDO SE REEMBOLSARÁ EL MONTO EQUIVALENTE AL TRAMO DE VIAJE NO RECORRIDO.</li><li><strong>CLÁUSULA 10.&nbsp;</strong>SI EL PASAJERO ES MIEMBRO DE LAS FUERZAS ARMADAS O PNP, Y PORTA UN ARMA DE FUEGO, ESTA DEBERÁ SER DECLARADA&nbsp;ANTE LA ADMINISTRACIÓN DE LA EMPRESA.</li></ul>',
                    'orden' => 1,
                ],
                /* [
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
                ], */
            ]
        );
    }
}

<?php

namespace App\Actions;

use DateTime;
use App\Models\Turno;

class TurnoAction
{

    public static function calculaHorasTrabalhadas(DateTime $hora_inicial, DateTime $hora_final){

        $return_format = "%H:%I:%S";
        $vazio = "00:00:00";
        $dia_inicial = $hora_inicial->format('Y-m-d');
        $dia_final = $hora_final->format('Y-m-d');
        $limite_diurno = new DateTime("$dia_inicial 22:00:00");
        $limite_noturno = new DateTime("$dia_final 05:00:00");

        $interval = $hora_inicial->diff($hora_final);

        if($hora_inicial <  $limite_diurno && $hora_inicial > $limite_noturno) {
                if($hora_final < $limite_diurno ){
                    return array("horas_diurnas" =>  $interval->format($return_format), "horas_noturnas" => $vazio);
                }

            return self::calcTurnoDiurnoNoturno($hora_inicial, $limite_diurno, $hora_final);
        }

        if($hora_final <  $limite_noturno || $hora_final >= $limite_diurno){
            return array("horas_diurnas" =>  $vazio, "horas_noturnas" => $interval->format($return_format));
        }

        return self::calcTurnoDiurnoNoturno($hora_inicial, $limite_noturno, $hora_final);

    }

    /**
     * @param DateTime $hora_inicial
     * @param DateTime $limite_diurno
     * @param DateTime $hora_final
     * @return \DateInterval|false
     */
    public static function calcTurnoDiurnoNoturno(DateTime $hora_inicial, DateTime $limite, DateTime $hora_final)
    {
        $interval_inicial = $hora_inicial->diff($limite);
        $interval_final = $limite->diff($hora_final);

        return array("horas_dirunas" => $interval_inicial, "horas_noturnas" => $interval_final);
    }
}

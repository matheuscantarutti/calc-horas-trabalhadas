<?php

namespace App\Actions;

use DateTime;
use DateInterval;
use App\Helper\TurnoActionHelper;

class TurnoAction
{

    public static function returnFormat()
    {
        return "%H:%I:%S";
    }

    public static function returnVazio()
    {
        return "00:00:00";
    }

    public static function calculaHorasTrabalhadas(DateTime $hora_inicial, DateTime $hora_final)
    {
        $helper = new TurnoActionHelper($hora_inicial, $hora_final);

        $entrada_diurna = self::isEntradaDiurna($helper, $hora_inicial);
        $saida_diurna = self::isSaidaDiurna($helper, $hora_final);
        $saida_noturna = self::isSaidaNoturna($helper, $hora_final);
        $tipo_turno = 'simples';


        if ($entrada_diurna) {

            if ($helper->getDiaInicial() !== $helper->getDiaFinal()) {
                $helper->trocaDiaReferencia();
                $tipo_turno = 'duplo';
                $saida_diurna = self::isSaidaDiurna($helper, $hora_final);
            }

            if ($saida_diurna) {
                return self::getTurnoDiurno($helper, $tipo_turno);
            }

            return self::calcTurnoDiurnoNoturno($hora_inicial, $helper->getLimiteDiurno(), $hora_final);
        }

        if ($helper->getDiaInicial() !== $helper->getDiaFinal()) {
            $helper->trocaDiaReferencia();
            $tipo_turno = 'duplo';
            $saida_noturna = self::isSaidaNoturna($helper, $hora_final);
        }

        if ($saida_noturna) {
            return self::getTurnoNoturno($helper, $tipo_turno);
        }

        return self::calcTurnoDiurnoNoturno($hora_inicial, $helper->getLimiteNoturno(), $hora_final);

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

        return array("horas_diurnas" => $interval_inicial->format(self::returnFormat()),
            "horas_noturnas" => $interval_final->format(self::returnFormat()));
    }

    /**
     * @param TurnoActionHelper $helper
     * @param DateTime $hora_inicial
     * @return bool
     */
    public static function isEntradaDiurna(TurnoActionHelper $helper, DateTime $hora_inicial): bool
    {
        return $hora_inicial < $helper->getLimiteDiurno() && $hora_inicial > $helper->getLimiteNoturno() ? true : false;
    }

    /**
     * @param TurnoActionHelper $helper
     * @param DateTime $hora_final
     * @return bool
     */
    public static function isSaidaDiurna(TurnoActionHelper $helper, DateTime $hora_final): bool
    {
        return $hora_final < $helper->getLimiteDiurno() && $hora_final > $helper->getLimiteNoturno() ? true : false;
    }

    /**
     * @param TurnoActionHelper $helper
     * @param DateTime $hora_final
     * @return bool
     */
    public static function isSaidaNoturna(TurnoActionHelper $helper, DateTime $hora_final): bool
    {
        return $hora_final < $helper->getLimiteNoturno() || $hora_final >= $helper->getLimiteDiurno();
    }

    /**
     * @param $helper
     * @return array
     */
    public static function calcTurnoDiurnoSimples($helper): array
    {
        return array("horas_diurnas" => $helper->getIntervalo()->format(self::returnFormat()),
            "horas_noturnas" => self::returnVazio()
        );
    }

    /**
     * @param TurnoActionHelper $helper
     * @return array
     * @throws \Exception
     */
    public static function calcTurnoDiurnoDuplo(DateInterval $intervalo): array
    {
        $horas_noturnas = new DateInterval("PT7H");
        $data_aux = new DateTime($intervalo->format(self::returnFormat()));
        $horas_diurnas = $data_aux->sub($horas_noturnas);

        return array(
            "horas_diurnas" => $horas_diurnas->format('H:i:s'),
            "horas_noturnas" => $horas_noturnas->format(self::returnFormat())
        );
    }

    private static function getTurnoNoturno(TurnoActionHelper $helper, string $tipo_turno)
    {
        return $tipo_turno == 'simples' ? self::calcTurnoNoturnoSimples($helper) : self::calcTurnoNoturnoDuplo($helper);
    }

    /**
     * @param TurnoActionHelper $helper
     * @return array
     * @throws \Exception
     */
    private static function calcTurnoNoturnoDuplo(TurnoActionHelper $helper): array
    {
        $horas_diurnas = new DateInterval("PT17H");
        $data_aux = new DateTime($helper->getIntervalo()->format(self::returnFormat()));
        $horas_noturnas = $data_aux->sub($horas_diurnas);

        dd($horas_noturnas);

        return array("horas_diurnas" => $horas_diurnas->format(self::returnFormat()),
            "horas_noturnas" => $horas_noturnas->format('H:i:s')
        );
    }

    /**
     * @param $helper
     * @return array
     */
    private static function calcTurnoNoturnoSimples($helper): array
    {
        return array("horas_diurnas" => self::returnVazio(),
            "horas_noturnas" => $helper->getIntervalo()->format(self::returnFormat()));
    }

    private static function getTurnoDiurno(TurnoActionHelper $helper, string $tipo_turno)
    {
        return $tipo_turno == 'simples' ? self::calcTurnoDiurnoSimples($helper) : self::calcTurnoDiurnoDuplo($helper->getIntervalo());
    }

}

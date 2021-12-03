<?php

namespace App\Helper;
use DateTime;
use DateInterval;

class TurnoActionHelper
{
    private  $dia_inicial;
    private  $dia_final;
    private Datetime $limite_diurno;
    private DateTime $limite_noturno;
    private bool $entrada_diurna;
    private bool $saida_diurna;
    private DateInterval $intervalo;

    public function __construct(DateTime $hora_inicial, DateTime $hora_final )
    {
        $this->intervalo = $hora_inicial->diff($hora_final);
        $this->dia_inicial = $hora_inicial->format('Y-m-d');
        $this->dia_final = $hora_final->format('Y-m-d');
        $this->limite_diurno = new DateTime("$this->dia_inicial 22:00:00");
        $this->limite_noturno = new DateTime("$this->dia_inicial 05:00:00");

    }

    public function trocaDiaReferencia(){
        $this->limite_diurno = new DateTime("$this->dia_final 22:00:00");
        $this->limite_noturno = new DateTime("$this->dia_final 05:00:00");
    }

    /**
     * @return DateTime
     */
    public function getDiaInicial(): DateTime
    {
        return new DateTime($this->dia_inicial);
    }

    /**
     * @return DateTime
     */
    public function getDiaFinal(): DateTime
    {
        return new DateTime($this->dia_final);
    }

    /**
     * @return DateTime
     */
    public function getLimiteDiurno(): DateTime
    {
        return $this->limite_diurno;
    }

    /**
     * @return DateTime
     */
    public function getLimiteNoturno(): DateTime
    {
        return $this->limite_noturno;
    }

    /**
     * @return bool
     */
    public function isEntradaDiurna(): bool
    {
        return $this->entrada_diurna;
    }

    /**
     * @return bool
     */
    public function isSaidaDiurna(): bool
    {
        return $this->saida_diurna;
    }

    /**
     * @return DateInterval
     */
    public function getIntervalo(): DateInterval
    {
        return $this->intervalo;
    }

    /**
     * @param DateTime $dia_inicial
     */
    public function setDiaInicial(DateTime $dia_inicial): void
    {
        $this->dia_inicial = $dia_inicial;
    }

    /**
     * @param DateTime $dia_final
     */
    public function setDiaFinal(DateTime $dia_final): void
    {
        $this->dia_final = $dia_final;
    }

    /**
     * @param DateTime $limite_diurno
     */
    public function setLimiteDiurno(DateTime $limite_diurno): void
    {
        $this->limite_diurno = $limite_diurno;
    }

    /**
     * @param DateTime $limite_noturno
     */
    public function setLimiteNoturno(DateTime $limite_noturno): void
    {
        $this->limite_noturno = $limite_noturno;
    }

    /**
     * @param bool $entrada_diurna
     */
    public function setEntradaDiurna(bool $entrada_diurna): void
    {
        $this->entrada_diurna = $entrada_diurna;
    }

    /**
     * @param bool $saida_diurna
     */
    public function setSaidaDiurna(bool $saida_diurna): void
    {
        $this->saida_diurna = $saida_diurna;
    }

    /**
     * @param DateInterval $intervalo
     */
    public function setIntervalo(DateInterval $intervalo): void
    {
        $this->intervalo = $intervalo;
    }


}

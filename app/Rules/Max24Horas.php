<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DateTime;

class Max24Horas implements Rule
{

    private $hora_inicial;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($hora_inicial)
    {
        $this->hora_inicial = new DateTime($hora_inicial);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $intervalo = $this->hora_inicial->diff(new DateTime($value));

        if($intervalo->d > 0 &&  ($intervalo->h > 0 || $intervalo->i > 0  || $intervalo->s > 0)){
            return false;
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A duração máxima do período deverá ser inferior a 24 horas.';
    }
}

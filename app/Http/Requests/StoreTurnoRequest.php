<?php

namespace App\Http\Requests;

use App\Rules\Max24Horas;
use Illuminate\Foundation\Http\FormRequest;

class StoreTurnoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $max_24horas = new Max24Horas(FormRequest::input()["data_hora_inicial"]);
        $format = 'Y-m-d\TH:i';
        return [
            'data_hora_inicial' =>
                ['required', "date_format:$format"],
            'data_hora_final' =>
                ['required', "date_format:$format" ,'after:data_hora_inicial', $max_24horas]
        ];
    }

    public function messages(){

        $format_msg = 'Formato incorreto. Modelo = Y-m-d\TH:i';
        $required_msg = "é de preenchimento obrigatório.";

        return [
            'data_hora_inicial.required' => "Horário inicial $required_msg",
            'data_hora_inicial.date_format' => $format_msg ,
            'data_hora_final.date_format' => $format_msg,
            'data_hora_final.required' => "Horário final $required_msg",
            'data_hora_final.after' => 'Horário final não pode ser igual ou anterior ao inicial.'

        ];
    }
}

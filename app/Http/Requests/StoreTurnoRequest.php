<?php

namespace App\Http\Requests;

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
        return [
            'hora_inicial' => 'required',
            'hora_final' => 'required'
        ];
    }

    public function messages(){
        return [
            'hora_inicial.required' => "Campo Horário inicial é de preenchimento obrigatório.",
            'hora_final.required' => "Campo Horário final é de preenchimento obrigatório.",

        ];
    }
}

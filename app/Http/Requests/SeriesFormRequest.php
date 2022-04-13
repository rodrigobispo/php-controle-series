<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'nome' => 'required|min:3'
        ];
    }
    
    /**
     * Definição de mensagem para cada regra de validação (substituição da mensagem original em inglês)
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Campo :attribute obrigatório.',
            'nome.min' => 'O nome deve conter pelo menos três caracteres.'
        ];
    }

}

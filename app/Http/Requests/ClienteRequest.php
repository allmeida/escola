<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'nome' => 'required|min:5',
                    'idade' => 'required|integer',
                    'email' => 'required|unique:content',
                    'cep' => 'required',
                    'logradouro' => 'required',
                    'bairro' => 'required',
                    'cidade' => 'required',
                    'estado' => 'required',
                    'formacao_id' => 'required',
                ];
            }
            case 'PUT':
            {
                return [
                    'nome' => 'required|min:5',
                    'idade' => 'required|integer',
                    'email' => 'required|unique:content',
                    'cep' => 'required',
                    'logradouro' => 'required',
                    'bairro' => 'required',
                    'cidade' => 'required',
                    'estado' => 'required',
                    'formacao_id' => 'required',                
                ];
            }
        }
    }
}

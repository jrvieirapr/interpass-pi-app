<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nomeCliente" =>  'required|unique:clientes,nomeCliente',
            "idade" => 'required|numeric|unique:clientes,idade',
            "sexo" => 'required',
            "rgIE" => 'required|unique:clientes,rgIE',
            "cpfCNPJ" => 'required|unique:clientes,cpfCNPJ',
            "email" => 'required|unique:clientes,email',
            "telefone" => 'required|unique:clientes,telefone',
        ];
    }
}

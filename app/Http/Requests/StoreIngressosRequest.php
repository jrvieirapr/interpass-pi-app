<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIngressosRequest extends FormRequest
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
            "chaveIngresso" =>  'required|unique:ingressos,chaveIngresso',
            "evento_id" =>  'required|exists:eventos,id',
            "dataEmissao" =>  'required|date',
            "cliente_id" =>  'required|exists:clientes,id',
            "metodoPagamento" =>  'required|unique:ingressos,metodoPagamento',
            "valorCompra" => 'required|numeric',
        ];
    }
}

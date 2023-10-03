<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventoRequest extends FormRequest
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
            "nomeEvento" =>  'required|unique:eventos,nomeEvento',
            "dataEvento" =>  'required|date',
            "localEvento" =>  'required|unique:eventos,localEvento',
            "qtIngresso" => 'required|numeric',
            "cidade_id" => "required|exists:cidades,id"
        ];
    }
}

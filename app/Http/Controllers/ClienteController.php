<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        //Pegar a lista do banco
        $clientes = Cliente::all();

        //Retornar lista em formato json
        return response()->json(['data' => $clientes]);
    }

    /**
     * STORE
     */
    public function store(StoreClienteRequest $request)
    {
        // Crie um novo cliente
        $cliente = Cliente::create($request->all());

        // Retorne o codigo 201
        return response()->json($cliente, 201);
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        // procure o cliente por id
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        return response()->json($cliente);
    }

    /**
     * UPDATE
     */
    public function update(UpdateClienteRequest $request, $id)
    {
        // Procure o cliente pelo id
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        // Faça o update do cliente
        $cliente->update($request->all());

        // Retorne o cliente
        return response()->json($cliente);
    }

    /**
     * DESTROY
     */
    public function destroy($id)
    {
        // Encontre um cliente pelo id
        $cliente = Cliente::find($id);
 
        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado!'], 404);
        }  
 
        //Se tiver dependentes deve retornar erro


  
        $cliente->delete();
 
        return response()->json(['message' => 'Cliente deletado com sucesso!'], 200);
     }
}

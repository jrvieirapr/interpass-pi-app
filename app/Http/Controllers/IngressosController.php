<?php

namespace App\Http\Controllers;

use App\Models\Ingressos;
use App\Http\Requests\StoreIngressosRequest;
use App\Http\Requests\UpdateIngressosRequest;

class IngressosController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        //Pegar a lista do banco
        $ingressos = Ingressos::all();

        //Retornar lista em formato json
        return response()->json(['data' => $ingressos]);
    }

    /**
     * STORE
     */
    public function store(StoreIngressosRequest $request)
    {
        // Crie um novo ingresso
        $ingresso = Ingressos::create($request->all());

        // Retorne o codigo 201
        return response()->json($ingresso, 201);
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        // procure o ingresso por id
        $ingresso = Ingressos::find($id);

        if (!$ingresso) {
            return response()->json(['message' => 'Ingressos não encontrado'], 404);
        }

        return response()->json($ingresso);
    }

    /**
     * UPDATE
     */
    public function update(UpdateIngressosRequest $request, $id)
    {
        // Procure o ingresso pelo id
        $ingresso = Ingressos::find($id);

        if (!$ingresso) {
            return response()->json(['message' => 'Ingressos não encontrado'], 404);
        }

        // Faça o update do ingresso
        $ingresso->update($request->all());

        // Retorne o ingresso
        return response()->json($ingresso);
    }

    /**
     * DESTROY
     */
    public function destroy($id)
    {
        // Encontre um ingresso pelo id
        $ingresso = Ingressos::find($id);
 
        if (!$ingresso) {
            return response()->json(['message' => 'Ingressos não encontrado!'], 404);
        }  
 
        //Se tiver dependentes deve retornar erro


  
        $ingresso->delete();
 
        return response()->json(['message' => 'Ingressos deletado com sucesso!'], 200);
     }
}

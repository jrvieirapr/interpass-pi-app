<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Http\Requests\StoreCidadeRequest;
use App\Http\Requests\UpdateCidadeRequest;
use App\Models\Estado;
use App\Models\Pais;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cidades = Cidade::all();
        return response()->json(['data' => $cidades]);
    }

    
    public function store(StoreCidadeRequest $request)
    {
        $cidade = Cidade::create($request->all());

        return response()->json($cidade, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cidade = Cidade::find($id);

        if (!$cidade) {
            return response()->json(['message' => 'Cidade não encontrada!'], 404);
        }

        return response()->json($cidade);
    }

    
    public function update(UpdateCidadeRequest $request,  $id)
    {
        $cidade = Cidade::find($id);

        if (!$cidade) {
            return response()->json(['message' => 'Cidade não encontrada!'], 404);
        }

        $cidade->update($request->all());

        return response()->json($cidade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cidade = Cidade::find($id);

        if (!$cidade) {
            return response()->json(['message' => 'Cidade não encontrada!'], 404);
        }

        // Verifique se há dependências antes de deletar (se necessário)

        $cidade->delete();

        return response()->json(['message' => 'Cidade deletada com sucesso!'], 200);
    }
}

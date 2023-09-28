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
    public function index(Pais $pais, Estado $estado)
    {
        $cidades = $estado->cidades()->get();
        return response()->json(['data' => $cidades]);
    }

    
    public function store(StoreCidadeRequest $request, Pais $pais, Estado $estado)
    {
        $cidade = $estado->cidades()->create($request->validated());
        return response()->json(['data' => $cidade]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pais $pais, Estado $estado, $id)
    {
        $cidade = $estado->cidades()->findOrFail($id);
        return response()->json(['data' => $cidade]);
    }

    
    public function update(UpdateCidadeRequest $request, Pais $pais, Estado $estado, $id)
    {
        $cidade = $estado->cidades()->findOrFail($id);
        $cidade->update($request->validated());
        return response()->json(['data' => $cidade]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pais $pais, Estado $estado, $id)
    {
        $cidade = $estado->cidades()->findOrFail($id);
        $cidade->delete();
        return response()->json(['message' => 'Cidade deletada com sucesso.']);
    }
}

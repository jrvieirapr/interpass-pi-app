<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Http\Requests\StoreEstadoRequest;
use App\Http\Requests\UpdateEstadoRequest;
use App\Models\Pais;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = Estado::all();
        return response()->json(['data' => $estados]); 
    }

    
    public function store(StoreEstadoRequest $request, Pais $pais)
    {
        $estado = $pais->estados()->create($request->validated());
        return response()->json(['data' => $estado]);
    }

    
    public function show(Pais $pais, $id)
    {
        $estado = $pais->estados()->findOrFail($id);
        return response()->json(['data' => $estado]);
    }

    
    public function update(UpdateEstadoRequest $request, Pais $pais, $id)
    {
        $estado = $pais->estados()->findOrFail($id);
        $estado->update($request->validated());
        return response()->json(['data' => $estado]);
    }

    
    public function destroy(Pais $pais, $id)
    {
        $estado = $pais->estados()->findOrFail($id);
        $estado->delete();
        return response()->json(['message' => 'Estado deletado com sucesso.']);
    }
}

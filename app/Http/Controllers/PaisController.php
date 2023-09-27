<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Http\Requests\StorePaisRequest;
use App\Http\Requests\UpdatePaisRequest;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = Pais::all();
        return response()->json(['data' => $paises]);
    }

    
    public function store(StorePaisRequest $request)
    {
        $pais = Pais::create($request->validated());
        return response()->json(['data' => $pais]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pais = Pais::findOrFail($id);
        return response()->json(['data' => $pais]);
    }

    
    public function update(UpdatePaisRequest $request, $id)
    {
        $pais = Pais::findOrFail($id);
        $pais->update($request->validated());
        return response()->json(['data' => $pais]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pais = Pais::findOrFail($id);
        $pais->delete();
        return response()->json(['message' => 'Pais deletado com sucesso.']);
    }
}

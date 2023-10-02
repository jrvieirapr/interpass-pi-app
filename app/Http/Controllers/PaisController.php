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
        return response()->json($pais, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pais = Pais::find($id);

        if (!$pais) {
            return response()->json(['message' => 'Pais não encontrado'], 404);
        }

        return response()->json($pais);
    }


    public function update(UpdatePaisRequest $request, $id)
    {
        $pais = Pais::find($id);

        if (!$pais) {
            return response()->json(['message' => 'Pais não encontrado'], 404);
        }

        $pais->update([
            'nome' => $request->input('nome'),
        ]);

        return response()->json($pais);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pais = Pais::find($id);

        if (!$pais) {
            return response()->json(['message' => 'Pais não encontrado!'], 404);
        }

        $pais->delete();

        return response()->json(['message' => 'Pais deletado com sucesso']);
    }
}

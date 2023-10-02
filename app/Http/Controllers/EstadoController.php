<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Http\Requests\StoreEstadoRequest;
use App\Http\Requests\UpdateEstadoRequest;
use Illuminate\Http\JsonResponse;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = Estado::all();

        dd($estados);

        return response()->json(['data' => $estados]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadoRequest $request): JsonResponse
    {
        $estado = Estado::create($request->all());

        return response()->json($estado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $estado = Estado::find($id);

        if (!$estado) {
            return response()->json(['message' => 'Estado não encontrado!'], 404);
        }

        return response()->json($estado);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadoRequest $request, $id): JsonResponse
    {
        $estado = Estado::find($id);

        if (!$estado) {
            return response()->json(['message' => 'Estado não encontrado!'], 404);
        }

        $estado->update($request->all());

        return response()->json($estado);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $estado = Estado::find($id);

        if (!$estado) {
            return response()->json(['message' => 'Estado não encontrado!'], 404);
        }

        // Verifique se há dependências antes de deletar (se necessário)

        $estado->delete();

        return response()->json(['message' => 'Estado deletado com sucesso!'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;

class EventoController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        //Pegar a lista do banco
        $eventos = Evento::all();

        //Retornar lista em formato json
        return response()->json(['data' => $eventos]);
    }

    /**
     * STORE
     */
    public function store(StoreEventoRequest $request)
    {
        // Crie um novo evento
        $evento = Evento::create($request->all());

        // Retorne o codigo 201
        return response()->json($evento, 201);
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        // procure o evento por id
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        return response()->json($evento);
    }

    /**
     * UPDATE
     */
    public function update(UpdateEventoRequest $request, $id)
    {
        // Procure o evento pelo id
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }

        // Faça o update do evento
        $evento->update($request->all());

        // Retorne o evento
        return response()->json($evento);
    }

    /**
     * DESTROY
     */
    public function destroy($id)
    {
        // Encontre um evento pelo id
        $evento = Evento::find($id);
 
        if (!$evento) {
            return response()->json(['message' => 'Evento não encontrado!'], 404);
        }  
 
        //Se tiver dependentes deve retornar erro
  
        $evento->delete();
 
        return response()->json(['message' => 'Evento deletado com sucesso!'], 200);
     }
}

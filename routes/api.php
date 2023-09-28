<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EventoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Routes Clientes
Route::middleware('api')->prefix('clientes')->group(function () {
    Route::get('/', [ClienteController::class, 'index']);
    Route::post('/', [ClienteController::class, 'store']);
    Route::get('/{cliente}', [ClienteController::class, 'show']);
    Route::put('/{cliente}', [ClienteController::class, 'update']);
    Route::delete('/{cliente}', [ClienteController::class, 'destroy']);
});


Route::middleware('paises')->group(function() {
    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::get('/{id}', [PaisController::class, 'show']);
    Route::put('/{id}', [PaisController::class, 'update']);
    Route::delete('/{id}', [PaisController::class, 'destroy']);
});

//Routes Eventos
Route::middleware('api')->prefix('eventos')->group(function () {
    Route::get('/', [EventoController::class, 'index']);
    Route::post('/', [EventoController::class, 'store']);
    Route::get('/{evento}', [EventoController::class, 'show']);
    Route::put('/{evento}', [EventoController::class, 'update']);
    Route::delete('/{evento}', [EventoController::class, 'destroy']);
});



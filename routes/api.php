<?php

use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EstadoController;
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

// Pais
Route::middleware('paises')->group(function() {
    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::get('/{id}', [PaisController::class, 'show']);
    Route::put('/{id}', [PaisController::class, 'update']);
    Route::delete('/{id}', [PaisController::class, 'destroy']);
});

// Estado
Route::middleware('estados')->group(function() {
    Route::get('/', [EstadoController::class, 'index']);
    Route::post('/', [EstadoController::class, 'store']);
    Route::get('/{id}', [EstadoController::class, 'show']);
    Route::put('/{id}', [EstadoController::class, 'update']);
    Route::delete('/{id}', [EstadoController::class, 'destroy']);
});

// Cidade
Route::middleware('cidades')->group(function() {
    Route::get('/', [CidadeController::class, 'index']);
    Route::post('/', [CidadeController::class, 'store']);
    Route::get('/{id}', [CidadeController::class, 'show']);
    Route::put('/{id}', [CidadeController::class, 'update']);
    Route::delete('/{id}', [CidadeController::class, 'destroy']);
});

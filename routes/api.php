<?php

use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\PaisController;
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
Route::middleware('api')->prefix('paises')->group(function() {
    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::get('/{pais}', [PaisController::class, 'show']);
    Route::put('/{pais}', [PaisController::class, 'update']);
    Route::delete('/{pais}', [PaisController::class, 'destroy']);
});

// Estado
Route::middleware('api')->prefix('estados')->group(function() {
    Route::get('/', [EstadoController::class, 'index']);
    Route::post('/', [EstadoController::class, 'store']);
    Route::get('/{estado}', [EstadoController::class, 'show']);
    Route::put('/{estado}', [EstadoController::class, 'update']);
    Route::delete('/{estado}', [EstadoController::class, 'destroy']);
});

// Cidade
Route::middleware('api')->prefix('cidades')->group(function() {
    Route::get('/', [CidadeController::class, 'index']);
    Route::post('/', [CidadeController::class, 'store']);
    Route::get('/{cidade}', [CidadeController::class, 'show']);
    Route::put('/{cidade}', [CidadeController::class, 'update']);
    Route::delete('/{cidade}', [CidadeController::class, 'destroy']);
});

<?php


use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\IngressosController;

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

//Routes Paises
Route::middleware('api')->prefix('paises')->group(function () {
    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::get('/{pais}', [PaisController::class, 'show']);
    Route::put('/{pais}', [PaisController::class, 'update']);
    Route::delete('/{pais}', [PaisController::class, 'destroy']);
});


//Routes Clientes
Route::middleware('api')->prefix('clientes')->group(function () {
    Route::get('/', [ClienteController::class, 'index']);
    Route::post('/', [ClienteController::class, 'store']);
    Route::get('/{cliente}', [ClienteController::class, 'show']);
    Route::put('/{cliente}', [ClienteController::class, 'update']);
    Route::delete('/{cliente}', [ClienteController::class, 'destroy']);
});


Route::middleware('paises')->group(function () {

    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::get('/{pais}', [PaisController::class, 'show']);
    Route::put('/{pais}', [PaisController::class, 'update']);
    Route::delete('/{pais}', [PaisController::class, 'destroy']);
});

// Estado
Route::middleware('api')->prefix('estados')->group(function () {
    Route::get('/', [EstadoController::class, 'index']);
    Route::post('/', [EstadoController::class, 'store']);
    Route::get('/{estado}', [EstadoController::class, 'show']);
    Route::put('/{estado}', [EstadoController::class, 'update']);
    Route::delete('/{estado}', [EstadoController::class, 'destroy']);
});


// Cidade
Route::middleware('api')->prefix('cidades')->group(function () {
    Route::get('/', [CidadeController::class, 'index']);
    Route::post('/', [CidadeController::class, 'store']);
    Route::get('/{cidade}', [CidadeController::class, 'show']);
    Route::put('/{cidade}', [CidadeController::class, 'update']);
    Route::delete('/{cidade}', [CidadeController::class, 'destroy']);
});

//Routes Eventos
Route::middleware('api')->prefix('eventos')->group(function () {
    Route::get('/', [EventoController::class, 'index']);
    Route::post('/', [EventoController::class, 'store']);
    Route::get('/{evento}', [EventoController::class, 'show']);
    Route::put('/{evento}', [EventoController::class, 'update']);
    Route::delete('/{evento}', [EventoController::class, 'destroy']);
});

//Routes Eventos
Route::middleware('api')->prefix('ingressos')->group(function () {
    Route::get('/', [IngressosController::class, 'index']);
    Route::post('/', [IngressosController::class, 'store']);
    Route::get('/{ingresso}', [IngressosController::class, 'show']);
    Route::put('/{ingresso}', [IngressosController::class, 'update']);
    Route::delete('/{ingresso}', [IngressosController::class, 'destroy']);
});

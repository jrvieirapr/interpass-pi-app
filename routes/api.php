<?php

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


Route::middleware('paises')->group(function() {
    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::get('/{id}', [PaisController::class, 'show']);
    Route::put('/{id}', [PaisController::class, 'update']);
    Route::delete('/{id}', [PaisController::class, 'destroy']);
});


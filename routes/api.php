<?php

use App\Http\Controllers\Api\ChamadoApiController;
use App\Http\Controllers\Api\ClienteEmpresaApiController;
use App\Http\Controllers\Api\FaturaApiController;
use App\Http\Controllers\Api\PlanoApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('planos', [PlanoApiController::class, 'index']);

    Route::middleware('auth')->group(function () {
        Route::get('clientes', [ClienteEmpresaApiController::class, 'index']);
        Route::get('clientes/{cliente}', [ClienteEmpresaApiController::class, 'show']);

        Route::get('faturas', [FaturaApiController::class, 'index']);
        Route::get('faturas/{fatura}', [FaturaApiController::class, 'show']);

        Route::get('chamados', [ChamadoApiController::class, 'index']);
        Route::post('chamados', [ChamadoApiController::class, 'store']);
        Route::get('chamados/{chamado}', [ChamadoApiController::class, 'show']);
    });
});

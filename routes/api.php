<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLeilaoController;

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

Route::get('/health-check', [ApiLeilaoController::class, 'healthCheck']);
Route::apiResource('/leilao', ApiLeilaoController::class);

// Route::get('/api/leilao/check-access', 'App\Http\Controllers\api\LeilaoApiController@checkAccess');
// Route::get('/api/leilao', 'App\Http\Controllers\api\LeilaoApiController@index');
// Route::get('/api/leilao/listar', 'App\Http\Controllers\api\LeilaoApiController@listarLeiloes');

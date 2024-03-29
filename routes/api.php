<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Middleware;
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

Route::group([
    'prefix' => '/auth'
],function (){

    Route::post('/login', [ClienteController::class, 'inicioSesion']);
    Route::post('/signup', [ClienteController::class, 'registroUsuario']);
}
);

Route::group(['middleware' => 'authenticated'],function () {
    Route::get('/logout', [ClienteController::class, 'cerrarSesion']);
});

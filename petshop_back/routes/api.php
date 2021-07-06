<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PetController,
    RacaController,
    VacinaController,
    EspecieController,
    UsuarioController,
    ProcedimentoController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/cadastro', [UsuarioController::class, 'cadastro']);

Route::middleware('auth:api')->group(function (){
    Route::prefix('user')->group(function () {
        Route::get('/', [UsuarioController::class, 'usuario']);
        Route::put('/editar', [UsuarioController::class, 'editar']);
    });

    Route::get('/vacina/select', [VacinaController::class, 'select']);
    Route::get('/raca/select/{id}', [RacaController::class, 'select']);
    Route::get('/especie/select', [EspecieController::class, 'select']);

    Route::prefix('pet')->group(function() {
        Route::get('/listar', [PetController::class, 'listar']);
        Route::get('/editar/{id}', [PetController::class, 'editar']);
        Route::get('/select/{id}', [PetController::class, 'select']);
        Route::post('/cadastro', [PetController::class, 'cadastro']);
        Route::post('/atualizar/{id}', [PetController::class, 'atualizar']);
    });

    Route::prefix('procedimento')->group(function () {
        Route::get('/listar', [ProcedimentoController::class, 'list']);
        Route::post('/cadastro', [ProcedimentoController::class, 'create']);
    });
});




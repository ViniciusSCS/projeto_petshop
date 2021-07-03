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
Route::middleware('auth:api')->get('/user', [UsuarioController::class, 'usuario']);
Route::middleware('auth:api')->put('/editar', [UsuarioController::class, 'editar']);

Route::middleware('auth:api')->get('/pet/listar', [PetController::class, 'listar']);
Route::middleware('auth:api')->get('/pet/editar/{id}', [PetController::class, 'editar']);
Route::middleware('auth:api')->get('/pet/select/{id}', [PetController::class, 'select']);
Route::middleware('auth:api')->post('/pet/cadastro', [PetController::class, 'cadastro']);
Route::middleware('auth:api')->post('/pet/atualizar/{id}', [PetController::class, 'atualizar']);

Route::middleware('auth:api')->get('/raca/select/{id}', [RacaController::class, 'select']);

Route::middleware('auth:api')->get('/especie/select', [EspecieController::class, 'select']);

Route::middleware('auth:api')->get('/vacina/select', [VacinaController::class, 'select']);

route::middleware('auth:api')->get('/procedimento/listar', [ProcedimentoController::class, 'list']);
route::middleware('auth:api')->post('/procedimento/cadastro', [ProcedimentoController::class, 'create']);


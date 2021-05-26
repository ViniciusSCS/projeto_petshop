<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PetController, RacaController, UsuarioController};

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

Route::middleware('auth:api')->post('/pet/cadastro', [PetController::class, 'cadastro']);
Route::middleware('auth:api')->get('/pet/listar', [PetController::class, 'listar']);

Route::middleware('auth:api')->get('/raca/select', [RacaController::class, 'select']);


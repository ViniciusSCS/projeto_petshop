<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastro(Request $request)
    {
        $data = $request->all();

        $pet = new Pet();

        $pet->nome = $data['nome'];
        $pet->peso = $data['peso'];
        $pet->raca = $data['raca'];
        $pet->sexo = $data['sexo'];
        $pet->idade = $data['idade'];
        $pet->user_id = $data['user_id'];
        $pet->especie_id = $data['especie_id'];

        $pet->save();

        return ['status' => true, "pet" => $pet];
    }

    /**
     * Lista os pets cadastrados.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
    {
        $user = $request->user();

        $query = Pet::with('especie')
            ->where('user_id', '=', DB::raw("'" . $user->id . "'"))
            ->get();

        return ['status' => true, "pets" => $query, "usuario" => $user];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

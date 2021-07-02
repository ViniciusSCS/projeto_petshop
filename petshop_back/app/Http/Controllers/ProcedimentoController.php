<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProcedimentoController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 15:26
 * @package App\Http\Controllers
 */
class ProcedimentoController extends Controller
{

    /**
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $data = $request->all();

        return $data;


        $procedimento = new Procedimento();

        $procedimento->pet_id = 1;
        $procedimento->user_id = 1;
        $procedimento->castrado = "Sim";
        $procedimento->vacina_id = null;
        $procedimento->banho_tosa = null;
        $procedimento->cirurgia_id = null;
        $procedimento->user_created = 1;
        $procedimento->data_castracao = "2020-11-29";
        $procedimento->descricao_cirurgica = null;

        $procedimento->save();

        return ['status' => true, "procedimento" => $procedimento];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

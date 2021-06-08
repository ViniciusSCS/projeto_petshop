<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $validacao = Validator::make($data, [
            'nome' => 'required|string',
            'peso' => 'required|string',
            'raca' => 'required',
            'sexo' => 'required|string',
            'especie' => 'required',
            'data_nascimento' => 'required|string',
        ]);

        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
        }

        $pet = new Pet();

        $pet->nome = $data['nome'];
        $pet->peso = $data['peso'];
        $pet->raca_id = $data['raca'];
        $pet->sexo = $data['sexo'];
        $pet->user_id = $data['usuario']['id'];
        $pet->especie_id = $data['especie'];
        $pet->data_nascimento = $data['data_nascimento'];

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

        $query = Pet::select(
            'nome',
            'especie_id',
            'raca_id',
            DB::raw("date_format(data_nascimento, '%d/%m/%Y') as data_nascimento"),
            DB::raw("
                CONCAT(
                    FLOOR(( DATE_FORMAT(NOW(),'%Y%m%d') - DATE_FORMAT(data_nascimento,'%Y%m%d'))/10000), ' ano(s) ',
                    FLOOR((1200 + DATE_FORMAT(NOW(),'%m%d') - DATE_FORMAT(data_nascimento,'%m%d'))/100) %12, ' mes(es) ',
                    REPLACE(
                        (SIGN(DAY(curdate()) - DAY(data_nascimento)))/2 * (DAY(curdate()) - DAY(data_nascimento)) +
                        (SIGN(DAY(curdate()) - DAY(data_nascimento)))/2 * (DAY(curdate()) - DAY(data_nascimento)),
                        '.0000', ''
                    ),' dia(s)'
                ) as idade"
            )
        )
            ->with('especie')
            ->with('raca')
            ->where('user_id', '=', DB::raw("'" . $user->id . "'"))
            ->paginate(10);

        return ['status' => true, "pets" => $query, "usuario" => $user];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function select(Request $request)
    {
        $user = $request->user();
        $query = Pet::where('user_id', '=', DB::raw("'" . $user->id . "'"))->get();

        return ['status' => true, "pets" => $query];
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

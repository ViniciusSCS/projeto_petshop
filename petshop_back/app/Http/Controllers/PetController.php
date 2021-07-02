<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class PetController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Http\Controllers
 */
class PetController extends Controller
{
    /**
     * Cadastra Pets
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
     * Edita pets por id
     *
     * @param Request $request
     * @param $id
     * @return array
     */
    public function editar(Request $request, $id)
    {
        $pet = Pet::find($id);

        return ['status' => true, "pet" => $pet];
    }

    /**
     * Atualiza pet por id
     *
     * @param Request $request
     * @param $id
     * @return array
     */
    public function atualizar(Request $request, $id)
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

        $pet = Pet::find($id);

        $pet->update($data);

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
            '*',
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
            ->with('procedimento')
            ->where('user_id', '=', DB::raw("'" . $user->id . "'"))
            ->paginate(10);

        return ['status' => true, "pets" => $query, "usuario" => $user];
    }

    /**
     * Seleciona pets
     *
     * @param Request $request
     * @return array
     */
    public function select(Request $request, $id)
    {
        $user = $request->user();
        $query = Pet::where('id', DB::raw($id))
            ->where('user_id', '=', DB::raw("'" . $user->id . "'"))
            ->get();

        return ['status' => true, "pets" => $query];
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

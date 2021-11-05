<?php

namespace App\Http\Controllers;

use App\Models\Raca;
use Illuminate\Http\Request;

/**
 * Class RacaController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Http\Controllers
 */
class RacaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select($especie_id)
    {
        $query = Raca::where('especie_id', $especie_id)->orWhere('especie_id', 4)->get();

        return ['status' => true, "racas" => $query];
    }
}

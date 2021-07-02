<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Pet
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Models
 */
class Pet extends Model
{
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'raca_id',
        'peso',
        'sexo',
        'user_id',
        'especie_id',
        'data_nascimento',
    ];

    public function especie()
    {
        return $this->hasOne(Especie::class, 'id', 'especie_id');
    }

    public function raca()
    {
        return $this->hasOne(Raca::class, 'id', 'raca_id');
    }
}

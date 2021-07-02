<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pet_id',
        'user_id',
        'castrado',
        'vacina_id',
        'banho_tosa',
        'cirurgia_id',
        'user_created',
        'data_castracao',
        'descricao_cirurgia',
    ];
}

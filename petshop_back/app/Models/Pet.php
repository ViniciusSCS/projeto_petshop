<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'raca',
        'idade',
        'peso',
        'sexo',
        'user_id',
        'especie_id',
    ];

    public function especie()
    {
        return $this->hasOne(Especie::class, 'id', 'especie_id');
    }
}

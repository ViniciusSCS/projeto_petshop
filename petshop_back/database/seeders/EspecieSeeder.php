<?php

namespace Database\Seeders;

use App\Models\Especie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especies = [
            [
                'descricao' => 'Cachorro',
            ],
            [
                'descricao' => 'Gato'
            ],
            [
                'descricao' => 'Pássaro'
            ],
            [
                'descricao' => 'Espécie Não Definida'
            ]
        ];

        foreach ($especies as $especie) {
            Especie::UpdateOrCreate($especie, $especie);
        }
    }
}

<?php

namespace Database\Seeders;

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
        DB::table('especies')->insert([
            [
                'descricao' => 'Cachorro',
            ],
            [
                'descricao' => 'Gato'
            ],
            [
                'descricao' => 'Pássaro'
            ]
        ]);
    }
}

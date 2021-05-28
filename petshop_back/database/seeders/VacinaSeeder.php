<?php

namespace Database\Seeders;

use App\Http\Controllers\VacinaController;
use Illuminate\Database\Seeder;

class VacinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'descricao' => 'V8 E V10'
            ],
            [
                'descricao' => 'TRAQUEOBRONQUITE INFECCIOSA CANINA'
            ],
            [
                'descricao' => 'GIARDÍASE'
            ],
            [
                'descricao' => 'RAIVA'
            ],
        ];

        foreach ($tipos as $tipo) {
            VacinaController::UpdateOrCreate($tipo, $tipo);
        }
    }
}

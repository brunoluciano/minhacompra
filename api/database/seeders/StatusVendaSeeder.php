<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusVendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_vendas')->insert(array(
            0 =>
            array(
                'id' => '1',
                'descricao' => 'Confirmado',
            ),
            1 =>
            array(
                'id' => '2',
                'descricao' => 'Separado',
            ),
            2 =>
            array(
                'id' => '3',
                'descricao' => 'Em rota',
            ),
            3 =>
            array(
                'id' => '4',
                'descricao' => 'Entregue',
            ),
        ));
    }
}

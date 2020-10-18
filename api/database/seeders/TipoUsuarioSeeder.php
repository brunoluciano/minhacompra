<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuarios')->insert(array(
            0 =>
            array(
                'id' => '1',
                'descricao' => 'Gerente',
            ),
            1 =>
            array(
                'id' => '2',
                'descricao' => 'Funcionário',
            ),
            2 =>
            array(
                'id' => '3',
                'descricao' => 'Entregador',
            ),
        ));
    }
}

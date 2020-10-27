<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeMedidaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidade_medida_produtos')->insert(array(
            0 =>
            array(
                'id' => '1',
                'descricao' => 'Caixa',
                'sigla' => 'CX',
            ),
            1 =>
            array(
                'id' => '2',
                'descricao' => 'Dúzia',
                'sigla' => 'DZ',
            ),
            2 =>
            array(
                'id' => '3',
                'descricao' => 'Embalagem',
                'sigla' => 'EM',
            ),
            3 =>
            array(
                'id' => '4',
                'descricao' => 'Fardo',
                'sigla' => 'FD',
            ),
            4 =>
            array(
                'id' => '5',
                'descricao' => 'Frasco',
                'sigla' => 'FC',
            ),
            5 =>
            array(
                'id' => '6',
                'descricao' => 'Galão',
                'sigla' => 'GL',
            ),
            6 =>
            array(
                'id' => '7',
                'descricao' => 'Garrafa',
                'sigla' => 'GF',
            ),
            7 =>
            array(
                'id' => '8',
                'descricao' => 'Grama',
                'sigla' => 'G',
            ),
            8 =>
            array(
                'id' => '9',
                'descricao' => 'Jogo',
                'sigla' => 'JG',
            ),
            9 =>
            array(
                'id' => '10',
                'descricao' => 'Quilograma',
                'sigla' => 'KG',
            ),
            10 =>
            array(
                'id' => '11',
                'descricao' => 'Kit',
                'sigla' => 'KT',
            ),
            11 =>
            array(
                'id' => '12',
                'descricao' => 'Lata',
                'sigla' => 'LT',
            ),
            12 =>
            array(
                'id' => '13',
                'descricao' => 'Litro',
                'sigla' => 'L',
            ),
            13 =>
            array(
                'id' => '14',
                'descricao' => 'Metro',
                'sigla' => 'M',
            ),
            14 =>
            array(
                'id' => '15',
                'descricao' => 'Mililitro',
                'sigla' => 'ML',
            ),
            15 =>
            array(
                'id' => '16',
                'descricao' => 'Pacote',
                'sigla' => 'PT',
            ),
            16 =>
            array(
                'id' => '17',
                'descricao' => 'Peça',
                'sigla' => 'PC',
            ),
            17 =>
            array(
                'id' => '18',
                'descricao' => 'Unidade',
                'sigla' => 'UN',
            ),
        ));
    }
}

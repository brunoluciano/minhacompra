<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(array(
            0 =>
            array(
                'id' => '1',
                'descricao' => 'Acre',
                'sigla' => 'AC',
            ),
            1 =>
            array(
                'id' => '2',
                'descricao' => 'Alagoas',
                'sigla' => 'AL',
            ),
            2 =>
            array(
                'id' => '3',
                'descricao' => 'Amazonas',
                'sigla' => 'AM',
            ),
            3 =>
            array(
                'id' => '4',
                'descricao' => 'Amapá',
                'sigla' => 'AP',
            ),
            4 =>
            array(
                'id' => '5',
                'descricao' => 'Bahia',
                'sigla' => 'BA',
            ),
            5 =>
            array(
                'id' => '6',
                'descricao' => 'Ceará',
                'sigla' => 'CE',
            ),
            6 =>
            array(
                'id' => '7',
                'descricao' => 'Distrito Federal',
                'sigla' => 'DF',
            ),
            7 =>
            array(
                'id' => '8',
                'descricao' => 'Espírito Santo',
                'sigla' => 'ES',
            ),
            8 =>
            array(
                'id' => '9',
                'descricao' => 'Goiás',
                'sigla' => 'GO',
            ),
            9 =>
            array(
                'id' => '10',
                'descricao' => 'Maranhão',
                'sigla' => 'MA',
            ),
            10 =>
            array(
                'id' => '11',
                'descricao' => 'Minas Gerais',
                'sigla' => 'MG',
            ),
            11 =>
            array(
                'id' => '12',
                'descricao' => 'Mato Grosso do Sul',
                'sigla' => 'MS',
            ),
            12 =>
            array(
                'id' => '13',
                'descricao' => 'Mato Grosso',
                'sigla' => 'MT',
            ),
            13 =>
            array(
                'id' => '14',
                'descricao' => 'Pará',
                'sigla' => 'PA',
            ),
            14 =>
            array(
                'id' => '15',
                'descricao' => 'Paraiba',
                'sigla' => 'PB',
            ),
            15 =>
            array(
                'id' => '16',
                'descricao' => 'Pernambuco',
                'sigla' => 'PE',
            ),
            16 =>
            array(
                'id' => '17',
                'descricao' => 'Piauí',
                'sigla' => 'PI',
            ),
            17 =>
            array(
                'id' => '18',
                'descricao' => 'Paraná',
                'sigla' => 'PR',
            ),
            18 =>
            array(
                'id' => '19',
                'descricao' => 'Rio de Janeiro',
                'sigla' => 'RJ',
            ),
            19 =>
            array(
                'id' => '20',
                'descricao' => 'Rio Grande do Norte',
                'sigla' => 'RN',
            ),
            20 =>
            array(
                'id' => '21',
                'descricao' => 'Rondônia',
                'sigla' => 'RO',
            ),
            21 =>
            array(
                'id' => '22',
                'descricao' => 'Roraima',
                'sigla' => 'RR',
            ),
            22 =>
            array(
                'id' => '23',
                'descricao' => 'Rio Grande do Sul',
                'sigla' => 'RS',
            ),
            23 =>
            array(
                'id' => '24',
                'descricao' => 'Santa Catarina',
                'sigla' => 'SC',
            ),
            24 =>
            array(
                'id' => '25',
                'descricao' => 'Sergipe',
                'sigla' => 'SE',
            ),
            25 =>
            array(
                'id' => '26',
                'descricao' => 'São Paulo',
                'sigla' => 'SP',
            ),
            26 =>
            array(
                'id' => '27',
                'descricao' => 'Tocantins',
                'sigla' => 'TO',
            ),
        ));
    }
}

<?php

namespace Database\Seeders;

use Database\Seeders\EstadoSeeder;
use Database\Seeders\UnidadeMedidaProdutoSeeder;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EstadoSeeder::class,
            UnidadeMedidaProdutoSeeder::class,
        ]);
    }
}

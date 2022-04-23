<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Se puede hacer uso del factory de 2 formas:

        // 1. Llamar directamente el factory
        // \App\Models\User::factory(2)->create();
        // User::factory(1)->create();

        // 2. O en este caso crear un archivo especifico para cada Seeder y solo llamar aquí el seeder
        $this->call(UsersTableSeeder::class);
    }
}

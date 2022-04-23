<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Estamos especificando que crearemos 50 usuarios
        // Se puede hacer de 2 formas:
        
        // 1
        // \App\Models\User::factory(3)->create();

        
        // Si queremos definir un usuario manualmente, o sea, a pesar que reiniciemos la BD siempre exista
        User::create([
            'name' => 'Angel Díaz',
            'email' => 'angelcortes834@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Historia'), // password
            'remember_token' => Str::random(10),
            'address' => 'Acapulco',
            'phone' => '7442115099',
            'role' => 'admin'
        ]);

        
        // 2
        User::factory()
        ->count(50)
        ->create();
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Esta tabla de aqui nos permite almacenar la informacion basica de cualquier tipo de usuario ('admin', 'patient', 'doctor')
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // $table->string('dni');

            // Le ponemos nullable para que estos campos sean opcionales
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            
            // Este campo nos va a permitir decidir que informacion mostrar a un usuario a partir de su rol
            $table->string('role'); // 'admin', 'patient', 'doctor'


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

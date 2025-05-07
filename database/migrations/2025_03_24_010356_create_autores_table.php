<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoresTable extends Migration
{
    public function up()
    {
        Schema::create('autores', function (Blueprint $table) {
            $table->increments('id_autor');
            $table->string('nombre_autor', 150);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            // Solo se permiten 'Investigador' y 'Admin'
            $table->enum('role', ['Investigador', 'Admin']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('autores');
    }
}

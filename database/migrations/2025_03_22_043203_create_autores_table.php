<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoresTable extends Migration
{
    public function up()
    {
        Schema::create('autores', function (Blueprint $table) {
            $table->increments('id_autor');
            $table->string('nombre_autor', 150);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->enum('role', ['Docente', 'Investigador', 'Admin'])->default('Docente');
            $table->timestamps(); // opcional: created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('autores');
    }
}

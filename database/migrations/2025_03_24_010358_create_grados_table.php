<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradosTable extends Migration
{
    public function up()
    {
        Schema::create('grados', function (Blueprint $table) {
            $table->increments('id_grado');
            // Se acepta solo 'Pregrado' o 'Postgrado'
            $table->enum('tipo', ['Pregrado', 'Postgrado']);
            $table->string('curso', 100);
            $table->string('ciclo', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grados');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorProductoTable extends Migration
{
    public function up()
    {
        Schema::create('autor_producto', function (Blueprint $table) {
            $table->unsignedInteger('id_autor');
            $table->unsignedInteger('id_producto');
            $table->enum('rol_autor', ['Principal', 'Coautor'])->default('Coautor');
            $table->timestamps();

            $table->primary(['id_autor', 'id_producto']);

            $table->foreign('id_autor')
                  ->references('id_autor')
                  ->on('autores');
            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('producto_investigacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('autor_producto');
    }
}

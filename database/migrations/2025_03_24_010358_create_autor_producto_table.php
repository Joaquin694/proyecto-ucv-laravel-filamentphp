<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorProductoTable extends Migration
{
    public function up()
    {
        Schema::create('autor_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_autor');
            $table->unsignedInteger('id_producto');
            // Solo se permiten 'Principal' o 'Coautor'
            $table->enum('rol_autor', ['Principal', 'Coautor'])->default('Coautor');

            // Clave primaria compuesta
            $table->unique(['id_autor', 'id_producto']);

            // Llaves foráneas
            $table->foreign('id_autor')->references('id_autor')->on('autores')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('producto_investigacion')->onDelete('cascade');

            $table->timestamps();  // Esto agrega las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('autor_producto');

    }
}

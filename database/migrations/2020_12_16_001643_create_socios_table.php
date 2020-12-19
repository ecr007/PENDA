<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nombre',40)->nullable(false)->default('');
            $table->string('apellido',50)->nullable(false)->default('');
            $table->string('cedula',11)->nullable(false);
            $table->string('telefono',11)->nullable(false);
            $table->string('celular',11)->nullable(false);
            $table->integer('provincia')->nullable(false);
            $table->integer('municipio')->nullable(false);
            $table->string('direccion',255)->nullable(false)->default('');

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
        Schema::dropIfExists('socios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('socio_id')->unsigned();
            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');

            $table->bigInteger('numero');

            $table->decimal('balance_sin_intereses',10,2)->nullable(false)->default(0.00);
            $table->decimal('balance_inicial',10,2)->nullable(false)->default(0.00);
            $table->decimal('balance',10,2)->nullable(false)->default(0.00);
            $table->decimal('tasa',10,2)->nullable(false);
            $table->integer('cuotas_restantes')->nullable(false)->default(0);
            $table->decimal('monto_cuota',10,2)->nullable(false);
            $table->boolean('status')->nullable(false)->default(0);

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
        Schema::dropIfExists('prestamos');
    }
}

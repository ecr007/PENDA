<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_transacciones', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('cuenta_id')->unsigned();
            $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade');

            $table->bigInteger('tipo_transaccion_id')->unsigned();
            $table->foreign('tipo_transaccion_id')->references('id')->on('tipo_transacciones')->onDelete('cascade');

            $table->decimal('monto',10,2)->nullable(false)->default(0.00);
            
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
        Schema::dropIfExists('cuentas_transacciones');
    }
}

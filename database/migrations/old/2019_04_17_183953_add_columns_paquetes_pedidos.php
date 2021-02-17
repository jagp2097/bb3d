<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPaquetesPedidos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('paquetes_pedidos', function (Blueprint $table) {
      $table->string('pedido_direccion')->nullable();
      $table->string('pedido_codigo_postal')->nullable();
      $table->string('pedido_estado')->nullable();
      $table->string('pedido_ciudad')->nullable();
      $table->string('pedido_colonia')->nullable();
      $table->string('pedido_telefono')->nullable();
      $table->string('pedido_referencia_direccion')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('paquetes_pedidos', function (Blueprint $table) {
      //
    });
  }
}

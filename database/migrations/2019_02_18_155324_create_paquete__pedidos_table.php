<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaquetePedidosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('paquetes_pedidos', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('pedido_id')->unsigned();
      $table->integer('paquete_id')->unsigned();
      $table->integer('cantidad')->unsigned();
      $table->string('archivo')->nullable();
      $table->boolean('entregable');
      $table->string('comentario')->nullable();
      $table->string('pedido_direccion')->nullable();
      $table->string('pedido_codigo_postal')->nullable();
      $table->string('pedido_estado')->nullable();
      $table->string('pedido_ciudad')->nullable();
      $table->string('pedido_colonia')->nullable();
      $table->string('pedido_telefono')->nullable();
      $table->string('pedido_referencia_direccion')->nullable();
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
    Schema::dropIfExists('paquetes_pedidos');
  }
}

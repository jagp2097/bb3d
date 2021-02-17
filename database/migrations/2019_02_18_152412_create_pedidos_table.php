<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pedidos', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->string('pedido_email');
      $table->string('pedido_nombre');
      //~ $table->string('pedido_direccion');
      //~ $table->string('pedido_codigo_postal');
      //~ $table->string('pedido_estado');
      //~ $table->string('pedido_ciudad');
      //~ $table->string('pedido_colonia');
      //~ $table->string('pedido_telefono');
      //~ $table->string('pedido_referencia_direccion');
      $table->string('pedido_nombre_en_tarjeta');
      $table->string('pedido_subtotal');
      $table->string('pedido_tax');
      $table->string('pedido_total');
      //~ $table->boolean('enviado')->default(false);
      $table->boolean('entregado')->default(false);
      $table->string('error')->nullable();
      $table->string('transaction_id')->nullable();
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
    Schema::dropIfExists('pedidos');
  }
}

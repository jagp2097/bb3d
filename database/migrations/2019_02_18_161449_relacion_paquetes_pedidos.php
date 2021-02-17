<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionPaquetesPedidos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('paquetes_pedidos', function (Blueprint $table) {

      $table->foreign('pedido_id')->references('id')->on('pedidos')
        ->onUpdate('cascade')
        ->onDelete('cascade');

      $table->foreign('paquete_id')->references('id')->on('paquetes')
        ->onUpdate('cascade')
        ->opDelete('cascade');

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

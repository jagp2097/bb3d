<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPaquetePedidos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('paquetes_pedidos', function (Blueprint $table) {

      $table->boolean('entregable');
      $table->string('comentario')->nullable();

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

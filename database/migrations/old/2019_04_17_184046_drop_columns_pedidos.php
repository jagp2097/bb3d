<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsPedidos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('pedidos', function (Blueprint $table) {

      $table->dropColumn([
        'pedido_direccion', 'pedido_codigo_postal', 'pedido_estado',
        'pedido_ciudad', 'pedido_colonia', 'pedido_telefono', 'pedido_referencia_direccion'
      ]);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('pedidos', function (Blueprint $table) {
      //
    });
  }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModColumnsToNull extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('pedidos', function (Blueprint $table) {

      $table->string('pedido_direccion')->nullable()->change();
      $table->string('pedido_codigo_postal')->nullable()->change();
      $table->string('pedido_estado')->nullable()->change();
      $table->string('pedido_ciudad')->nullable()->change();
      $table->string('pedido_colonia')->nullable()->change();
      $table->string('pedido_telefono')->nullable()->change();
      $table->string('pedido_referencia_direccion')->nullable()->change();

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

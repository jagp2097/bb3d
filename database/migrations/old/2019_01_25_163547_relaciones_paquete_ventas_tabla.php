<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionesPaqueteVentasTabla extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('paquete_venta', function (Blueprint $table) {

     $table->foreign('paquete_id')->references('id')->on('paquetes')
      ->onDelete('cascade')
      ->onUpdate('cascade');

     $table->foreign('venta_id')->references('id')->on('ventas')
      ->onDelete('cascade')
      ->onUpdate('cascade');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('paquete_venta', function (Blueprint $table) {

      $table->dropForeign('paquete_venta_paquete_id_foreign');
      $table->dropForeign('paquete_venta_venta_id_foreign');

    });
  }
}

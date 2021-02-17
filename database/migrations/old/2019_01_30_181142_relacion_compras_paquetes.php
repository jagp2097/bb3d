<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionComprasPaquetes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('compras_paquetes', function (Blueprint $table) {

      $table->foreign('compra_id')->references('id')->on('compras')
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->foreign('paquete_id')->references('id')->on('paquetes')
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
    Schema::table('compras_paquetes', function (Blueprint $table) {

      //~ $table->dropColumn('compra_id');
      //~ $table->dropColumn('paquete_id');
      $table->dropForeign('compras_paquetes_compra_id_foreign');
      $table->dropForeign('compras_paquetes_paquete_id_foreign');


    });
  }
}

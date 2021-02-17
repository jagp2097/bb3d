<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionCouponConCuponProductosPedidos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('cupon_producto_pedidos', function (Blueprint $table) {

      $table->foreign('coupon_id')->references('id')->on('coupons')
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
    Schema::table('cupon_producto_pedidos', function (Blueprint $table) {

      //~ $table->dropColumn('coupon_id');
      $table->dropForeign('coupon_id');

    });
  }
}

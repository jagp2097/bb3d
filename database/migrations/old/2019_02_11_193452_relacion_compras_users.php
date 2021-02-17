<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionComprasUsers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('compras', function (Blueprint $table) {
      $table->foreign('user_id')->references('id')->on('users')
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
    Schema::table('compras', function (Blueprint $table) {
      //~ $table->dropColumn('user_id');
      $table->dropForeign('compras_user_id_foreign');
    });
  }
}

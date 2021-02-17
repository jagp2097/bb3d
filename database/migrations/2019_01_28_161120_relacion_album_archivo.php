<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelacionAlbumArchivo extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('archivos', function (Blueprint $table) {

     $table->foreign('album_id')->references('id')->on('albums')
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
    Schema::table('archivos', function (Blueprint $table) {

      //~ $table->dropColumn('album_id');
      $table->dropForeign('archivos_album_id_foreign');

    });
  }
}

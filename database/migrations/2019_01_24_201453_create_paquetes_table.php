<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaquetesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('paquetes', function (Blueprint $table) {
      $table->increments('id');
      $table->string('nombre');
      $table->string('descripcion');
      $table->decimal('precio', 8, 2);
      $table->string('foto');
      $table->integer('publicado')->default(0);
      $table->boolean('entregable');
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
    Schema::dropIfExists('paquetes');
  }
}

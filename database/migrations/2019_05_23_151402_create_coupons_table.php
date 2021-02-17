<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {

            $table->increments('id');
            $table->string('codigo')->unique();
            $table->integer('porcentaje_descuento')->nullable();
            $table->integer('valor_descuento')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->boolean('usado')->default(0);
            $table->string('tipo_cupon');

            $table->timestamps();
        });

// - el uuid o codigo
// - el porcentaje de descuento
// - la fecha de inicio
// - la fecha en que termina
// - un booleano que indica si ya se uso o no
// - una referencia al usuario administrador que lo creo
// - un campo que indique si es de 1 uso o generico

// [11:55 AM, 5/17/2019] Dr. Antonio SS: 
// [11:56 AM, 5/17/2019] Dr. Antonio SS: Si una persona paga por adelantado le hacemos un "cupon" de 1 uso con el 100% de descuento
// [11:57 AM, 5/17/2019] Dr. Antonio SS: algo asi "d5eb802c-532d-4d8f-9077-b59fc9e41687"
// [11:58 AM, 5/17/2019] Dr. Antonio SS: si hacemos una promo, hacemos un cupón genérico de 10 o 15% que funcione en un periodo de tiempo
// [11:58 AM, 5/17/2019] Dr. Antonio SS: algo asi "bb3dmayo10"

// [12:04 PM, 5/17/2019] Jesús Arnulfo 🐅🐯: O el cupón tendría la cantidad de dinero que se gastó?
// [12:14 PM, 5/17/2019] Dr. Antonio SS: Yo creo que debería tener el producto
// [12:15 PM, 5/17/2019] Dr. Antonio SS: O chance un campo que determine si es por porcentaje o cantidad...



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}

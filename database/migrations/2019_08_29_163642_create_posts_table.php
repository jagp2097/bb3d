<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('posts');

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_author')->unsigned();
            $table->string('post_title');
            $table->string('post_title_slug');
            $table->string('post_thumbnail');
            $table->longText('post_content');
            $table->longText('post_description');
            $table->boolean('post_published')->default(1);
            $table->timestamps();

            $table->foreign('post_author')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_images', function (Blueprint $table) {
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            $table->foreign('file_id')->on('files')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('post_id')->on('posts')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *p
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_images');
    }
}

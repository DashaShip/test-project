<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('индетификатор');
            $table->string('name');
            $table->string('slug')->comment('название, выведенное в ссылку');
            $table->unsignedInteger('ordering')->default(0)->comment('сортировка');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('индетификатор подкатегории');
            $table->timestamps();

            $table->foreign('parent_id')->on('product_categories')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}

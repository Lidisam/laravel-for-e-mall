<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_cats', function (Blueprint $table) {
            $table->integer('goods_id')->unsigned();
            $table->integer('cat_id')->unsigned();
            $table->foreign('goods_id')->references('id')->on('goods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('categorys')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_cats');
    }
}

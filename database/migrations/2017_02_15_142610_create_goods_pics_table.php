<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsPicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_pics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pic',150);
            $table->string('sm_pic',150);
            $table->integer('goods_id')->unsigned();
            $table->foreign('goods_id')->references('id')->on('goods')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_pics');
    }
}

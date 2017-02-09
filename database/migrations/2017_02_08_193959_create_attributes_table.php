<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attr_name', 30)->index('attr_name')->comment("属性名");
            $table->tinyInteger('attr_type')->unsigned()->default(0)->comment("属性的类型:0唯一，1可选");
            $table->string('attr_option_values', 150)->comment("属性的可选值，多个可选值用,隔开");
            $table->tinyInteger('type_id')->unsigned()->comment('所在类型id');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('types');  //设置外键
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attributes');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_prices', function (Blueprint $table) {
            $table->integer('goods_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->decimal('price', 10, 2)->default('0.00')->comment('会员价');
            $table->foreign('goods_id')->references('id')->on('goods')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('member_levels')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member_prices');
    }
}

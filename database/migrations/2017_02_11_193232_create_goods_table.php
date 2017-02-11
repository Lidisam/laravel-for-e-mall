<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name', 45)->comment('商品名');
            $table->smallInteger('cat_id')->unsigned()->comment('类型id');
            $table->smallInteger('brand_id')->unsigned()->comment('品牌id');
            $table->decimal('market_price', 10, 2)->default('0.00')->comment('市场价');
            $table->decimal('shop_price', 10, 2)->default('0.00')->comment('本店价');
            $table->integer('jifen')->unsigned()->comment('赠送积分');
            $table->integer('jyz')->unsigned()->comment('赠送经验值');
            $table->integer('jifen_price')->unsigned()->comment('如果要用积分兑换，需要的积分；如果不填则不用');
            $table->unsignedTinyInteger('is_promote')->default('0')->comment('是否促销，1是0否');
            $table->decimal('promote_price', 10, 2)->default('0.00')->comment('促销价');
            $table->integer('promote_start_time')->unsigned()->default('0')->comment('促销开始时间');
            $table->integer('promote_end_time')->unsigned()->default('0')->comment('促销结束时间');
            $table->string('logo', 150)->default('')->comment('logo原图');
            $table->string('sm_logo', 150)->default('')->comment('logo缩略图');
            $table->longText('goods_desc')->comment('商品描述');
            $table->unsignedTinyInteger('is_hot')->default('0')->comment('是否热卖');
            $table->unsignedTinyInteger('is_new')->default('0')->comment('是否新品');
            $table->unsignedTinyInteger('is_best')->default('0')->comment('是否精品');
            $table->unsignedTinyInteger('is_on_sale')->default('1')->comment('是否上架：0下架，1上架');
            $table->string('sec_keyword', 150)->default('')->comment('seo_关键字');
            $table->string('sec_description', 150)->default('')->comment('seo_描述');
            $table->unsignedMediumInteger('type_id')->default('0')->comment('商品类型id');
            $table->unsignedTinyInteger('sort_num')->default('100')->comment('排序数字');
            $table->unsignedTinyInteger('is_delete')->default('0')->comment('是否删除(放置回收站),0不删除');
            $table->unsignedInteger('addtime')->comment('添加时间');
            $table->timestamps();
            $table->index('shop_price');
            $table->index('cat_id');
            $table->index('brand_id');
            $table->index('is_on_sale');
            $table->index('is_hot');
            $table->index('is_new');
            $table->index('is_best');
            $table->index('is_delete');
            $table->index('sort_num');
            $table->index('promote_start_time');
            $table->index('promote_end_time');
            $table->index('addtime');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods');
    }
}

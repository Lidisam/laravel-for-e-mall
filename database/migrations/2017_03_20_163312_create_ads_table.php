<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ad_name', 100)->comment('广告名');
            $table->unsignedTinyInteger('ad_weight')->default(0)->comment('广告权重(数字越大，广告越前)');
            $table->string('ad_start_time', 20)->comment('开始时间');
            $table->string('ad_end_time', 20)->comment('结束时间');
            $table->string('ad_url', 100)->comment('广告链接');
            $table->string('ad_logo', 100)->comment('广告图片');
            $table->string('ad_sm_logo', 100)->comment('广告缩略图片');
            $table->unsignedTinyInteger('is_open')->default(0)->comment('是否开启,默认不开启，1为开启');
            $table->string('linkman', 100)->comment('广告联系人');
            $table->string('lm_email', 100)->comment('联系人邮箱');
            $table->string('lm_num', 11)->comment('联系人电话');
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
        Schema::drop('ads');
    }
}

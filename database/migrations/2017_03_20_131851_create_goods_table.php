<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('shopName', 100)->comment('商品名称');
            $table->unsignedTinyInteger('shopType')->nullabel()->default(0)->comment('商品类型');
            $table->float('shopPrice')->comment('商品价格');
            $table->integer('shopNumber')->comment('商品数量');
            $table->longText('image')->comment('商品图片路径');
            $table->text('shopPicture')->comment('商品海报图片路径');
            $table->longText('shopDescription')->comment('商品描述');
            $table->unsignedTinyInteger('status')->default(0)->comment('商品状态');
            $table->unsignedTinyInteger('authChoice')->default(1)->comment('是否显示商家信息');
            $table->unsignedInteger('user_id')->comment('用户Id,外键');
            $table->softDeletes();
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
        Schema::dropIfExists('goods');
    }
}

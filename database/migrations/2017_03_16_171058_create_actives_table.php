<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('活动名称');
            $table->string('time', 20)->comment('活动时间');
            $table->string('address', 100)->comment('活动地址');
            $table->string('lnt', 50)->nullable()->default('')->comment('经度');
            $table->string('lat', 50)->nullable()->default('')->comment('纬度');
            $table->text('poster')->comment('活动海报图片');
            $table->longText('images')->comment('活动图片');
            $table->unsignedInteger('count')->default(0)->comment('参与人数');
            $table->string('phone', 30)->comment('联系人电话');
            $table->text('description')->nullable()->comment('活动描述');
            $table->unsignedTinyInteger('status')->comment('活动状态');
            $table->unsignedInteger('person')->comment('人数限制');
            $table->float('money')->comment('报名金额');
            $table->unsignedInteger('user_id')->comment('用户表外键');
            $table->text('condition')->nullable()->comment('邀请条件');
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
        Schema::dropIfExists('actives');
    }
}

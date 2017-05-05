<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable()->unique()->comment('昵称');
            $table->string('realname', 20)->nullable()->comment('真实姓名');
            $table->unsignedInteger('student_id')->nullable()->comment('学号');
            $table->string('college', 30)->nullable()->comment('学院');
            $table->string('grade', 10)->nullable()->comment('年级');
            $table->unsignedTinyInteger('gender')->nullable()->comment('性别');
            $table->string('phone', 20)->nullable()->comment('联系电话');
            $table->string('wx_openid')->nullable()->comment('微信openid');
            $table->string('wx_head_img')->nullable()->comment('微信头像路径');
            $table->string('wx_nickname')->nullable()->comment('微信昵称');
            $table->string('birthday', 10)->nullable()->comment('生日');
            $table->unsignedInteger('user_id')->comment('用户外键');
            $table->unsignedTinyInteger('is_certified')->default(0)->comment('认证状态');
            $table->unsignedTinyInteger('adminset')->default(0)->comment('管理员标识');
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
        Schema::dropIfExists('user_infos');
    }
}

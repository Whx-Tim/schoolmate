<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partimes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name', 100)->comment('公司名称');
            $table->string('address')->comment('办公地点');
            $table->string('phone', 30)->comment('公司电话');
            $table->string('email')->comment('公司邮箱');
            $table->string('salary', 100)->comment('薪资');
            $table->string('position', 50)->comment('招聘职位');
            $table->unsignedTinyInteger('job_time')->nullable()->default(5)->comment('工作时间');
            $table->string('company_type', 100)->comment('公司类型');
            $table->longText('description')->comment('兼职招聘描述');
            $table->string('duration', 20)->comment('工作最少时长');
            $table->string('education', 10)->comment('学历要求');
            $table->unsignedTinyInteger('amount')->comment('招聘人数');
            $table->dateTime('end_time')->comment('截止时间');
            $table->unsignedInteger('user_id')->comment('用户id，外键');
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
        Schema::dropIfExists('partimes');
    }
}

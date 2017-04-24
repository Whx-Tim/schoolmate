<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number')->comment('课程号');
            $table->string('name', 50)->comment('课程名称');
            $table->string('teacher', 20)->comment('主讲教师');
            $table->tinyInteger('status')->default(0)->comment('课程状态');
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
        Schema::dropIfExists('courses');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('社团名称');
            $table->unsignedInteger('amount')->comment('限制人数');
            $table->text('introduction')->comment('社团介绍');
            $table->unsignedTinyInteger('type')->nullable()->default(0)->comment('社团类型');
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
        Schema::dropIfExists('leagues');
    }
}

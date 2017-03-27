<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('聊天内容');
            $table->unsignedTinyInteger('readed')->nullable()->default(0)->comment('是否已读');
            $table->unsignedInteger('send_to')->comment('消息对象，外键');
            $table->unsignedInteger('send_from')->comment('消息来源, 外键');
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
        Schema::dropIfExists('messages');
    }
}

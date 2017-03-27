<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_id')->comment('付款用户id，外键');
            $table->unsignedInteger('to_id')->comment('收款用户id，外键');
            $table->float('money')->comment('付款金额');
            $table->unsignedInteger('transaction_id')->comment('交易号');
            $table->unsignedTinyInteger('status')->comment('付款状态');
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
        Schema::dropIfExists('payments');
    }
}

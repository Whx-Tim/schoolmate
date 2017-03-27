<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('pay_method')->comment('支付方式');
            $table->unsignedTinyInteger('status')->nullable()->default(0)->comment('订单状态');
            $table->float('total_money')->comment('订单总金额');
            $table->float('postage')->nullable()->default(0)->comment('运费');
            $table->unsignedInteger('receipt_id')->comment('收货id，外键');
            $table->unsignedInteger('payment_id')->comment('付款id，外键');
            $table->dateTime('clinch_at')->nullable()->comment('成交时间');
            $table->dateTime('send_at')->nullable()->comment('发货时间');
            $table->dateTime('pay_at')->nullable()->comment('付款时间');
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
        Schema::dropIfExists('orders');
    }
}

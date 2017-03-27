<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id，外键');
            $table->unsignedInteger('league_id')->comment('社团id，外键');
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
        Schema::dropIfExists('league_groups');
    }
}

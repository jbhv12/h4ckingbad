<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_in_rounds', function (Blueprint $table) {
            $table->increments('id');

            //One User allowed for multiple rounds , one by one
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            //One round having multiple users
            $table->integer('round_id')->unsigned();
            $table->foreign('round_id')->references('id')->on('rounds')
                    ->onDelete('cascade')->onUpdate('cascade');

            //composite unique key
            //User can enter any round one time only
            $table->unique(['user_id', 'round_id']);

            $table->dateTime('starttime');
            //End time = Start Time + MaxTime in this Round
            $table->dateTime('endtime');

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
        Schema::dropIfExists('users_in_rounds');
    }
}

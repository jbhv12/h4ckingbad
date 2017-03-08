<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaderboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->increments('id');

            //One User allowed for multiple rounds , one by one
            $table->integer('user_in_round_id')->unsigned()->unique();
            $table->foreign('user_in_round_id')->references('id')->on('users_in_rounds')
                    ->onDelete('cascade')->onUpdate('cascade');

            //Time taken to solve the whole rounds
            //Addition of time taken for all problems solved in this round
            //(HH * 3600) + (MM * 60) + 60 Seconds
            $table->integer('time');

            //Point gained for this round by this user
            $table->integer('points');

            //Position of user in this round on leader board
            $table->integer('position')->unsigned();

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
        Schema::dropIfExists('leaderboards');
    }
}

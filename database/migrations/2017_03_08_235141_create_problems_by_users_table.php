<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsByUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems_by_users', function (Blueprint $table) {
            $table->increments('id');

            //One User can solve multiple problems
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            //One problem may be given to multiple Users
            $table->integer('problem_id')->unsigned();
            $table->foreign('problem_id')->references('id')->on('problems')
                    ->onDelete('cascade')->onUpdate('cascade');

            //composite unique key
            //User may be given any problem one time only
            $table->unique(['user_id', 'problem_id']);

            //Each problem will be given through One round
            $table->integer('users_in_rounds_id')->unsigned();
            $table->foreign('users_in_rounds_id')->references('id')->on('users_in_rounds')
                    ->onDelete('cascade')->onUpdate('cascade');
                    
            //Check weather user has tried to solve problem or not
            $table->boolean('hastried');

            //Check weather user has taken minor hint or not
            $table->boolean('hastakenminorhint');

            //Check weather user has taken major hint or not
            $table->boolean('hastakenmajorhint');

            //Time taken to solve the problem
            //(HH * 3600) + (MM * 60) + 60 Seconds
            $table->integer('time');

            //Point gained for this problem after considering all hints taken and attempts
            $table->integer('points');

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
        Schema::dropIfExists('problems_by_users');
    }
}

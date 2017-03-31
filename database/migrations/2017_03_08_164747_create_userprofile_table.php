<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->increments('id');

            //This Profile Belongs To one user(team) only
            $table->integer('user_id')->unsigned();
            $table->unique('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->string('teamname',128);
            $table->unique('teamname');

            $table->string('firstmembername',128);
            $table->string('secondmembername',128);

            $table->string('firstmemberemail',64);
            $table->string('secondmemberemail',64);

            $table->string('firstmembermobile',16);
            $table->string('secondmembermobile',16);
            
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
        Schema::dropIfExists('userprofiles');
    }
}

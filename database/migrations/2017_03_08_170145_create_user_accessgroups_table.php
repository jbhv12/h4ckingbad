<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccessgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accessgroups', function (Blueprint $table) {
            $table->increments('id');

            //One User may have many access roles
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');

            //Many Users may belongsTo One accessgroup
            $table->integer('accessgroup_id')->unsigned();
            $table->foreign('accessgroup_id')->references('id')->on('accessgroups')
                    ->onDelete('cascade')->onUpdate('cascade');

            //composite unique key
            $table->unique(['user_id', 'accessgroup_id']);

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
        Schema::dropIfExists('user_accessgroups');
    }
}

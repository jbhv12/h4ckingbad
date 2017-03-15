<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('problems', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');     //added this
          $table->integer('categoryid');
          $table->text('abstract');
          $table->string('minortHint');
          $table->string('majorHint');
          $table->string('flag');
          $table->integer('points');    //multiple values???
          $table->string('problemPageUrl');
          $table->string('downloadableFilePath');
          //$table->rememberToken();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

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

    //  hintArray = [pointstodeduct...] sorted by pointstodeduct

      Schema::create('problems', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');     //added this
          $table->text('categoryid');  //multiple values???
          $table->text('abstract');

          // $table->string('minortHint');
          // $table->string('majorHint');
          // $table->integer('minortHintCost');  //added this

          $table->string('hintArray');    //use text maybe?

          $table->string('flag');
          $table->integer('points');
          $table->string('problemPageUrl');
          $table->string('downloadableFilePath');
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

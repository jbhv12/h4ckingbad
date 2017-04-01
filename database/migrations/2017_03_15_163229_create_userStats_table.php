<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /**
      Schema::create('userStats', function (Blueprint $table) {
          $table->increments('id');
          $table->string('problems_solved');  //problems_solved=[prob_id...]
          $table->string('hints_taken');     // hints_taken = [(prob_id,hint1cost,hint2cost,..)..]
          $table->integer('score');
      //    $table->integer('no_of_prob_solved');
          $table->integer('rank');
          $table->integer('st')->nullable();
          $table->integer('cc');

      });
      */
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

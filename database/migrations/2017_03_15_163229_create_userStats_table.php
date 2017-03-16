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
      Schema::create('userStats', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name')->nullable();
          $table->string('member_name')->nullable();  //add-on features
          $table->string('problems_solved');  //problems_solved=[prob_id...]
          $table->string('hints_taken');     // hints_taken = [(prob_id,totaldeductedpoints)..]

          $table->integer('score');
      //    $table->integer('no_of_prob_solved');
          $table->integer('rank');
          $table->integer('start_time')->nullable();
          $table->integer('cur_lvl');

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

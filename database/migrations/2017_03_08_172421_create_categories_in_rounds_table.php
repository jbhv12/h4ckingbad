<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesInRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_in_rounds', function (Blueprint $table) {
            $table->increments('id');

            //One Category under multiple rounds
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
                    ->onDelete('cascade')->onUpdate('cascade');

            //One round having multiple categories
            $table->integer('round_id')->unsigned();
            $table->foreign('round_id')->references('id')->on('rounds')
                    ->onDelete('cascade')->onUpdate('cascade');

            //composite unique key
            $table->unique(['category_id', 'round_id']);

            //Number of Problems from this category in one Set of this round
            $table->tinyInteger('total_problems')->unsigned();

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
        Schema::dropIfExists('categories_in_rounds');
    }
}

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

            $table->string('title',128)->unique();
            //Points for this problem comes from Category
            //Multiple Problems under one category
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
                    ->onDelete('cascade')->onUpdate('cascade');

            $table->longText('abstraction');
            $table->string('minorhint',256);
            $table->string('majorhint',1024);
            $table->string('flag',256);     //Anwser
            $table->string('problempageurl',256)->nullable();   //Page where to find solution
            $table->string('problemfilespath',256)->nullable();     //Single Zip file's path

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
        Schema::dropIfExists('problems');
    }
}

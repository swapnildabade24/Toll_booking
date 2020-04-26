<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->biginteger('road_id')->unsigned();
            $table->foreign('road_id')->references('id')->on('roads');
            $table->string('toll_lat');
            $table->string('toll_lng');
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
        Schema::dropIfExists('tolls');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTollBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toll_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('source');
            $table->string('destination');
            $table->string('vehicle_number');
            $table->string('vehicle_type');
            $table->string('journey_date');
            $table->string('toll_count');
            $table->string('total_toll_cost');
            $table->longText('toll_names');
            $table->longText('road_names');
            $table->longText('toll_costs');
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
        Schema::dropIfExists('toll_bookings');
    }
}

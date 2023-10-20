<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRideBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_bookings', function (Blueprint $table) {
            $table->id('ride_id');
            $table->integer('persons'); // Number of persons
            $table->integer('luggage'); // Number of luggage items
            $table->decimal('total_distance', 8, 2); // Total distance in kilometers
            $table->dateTime('date_time'); // Date and time of the booking

            $table->unsignedBigInteger('car_id'); // Reference to the selected car
            $table->foreign('car_id')->references('car_id')->on('cars'); // Assuming a 'cars' table
                     
            $table->decimal('total_price', 8, 2); // Total price for the ride booking


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
        Schema::dropIfExists('ride_bookings');
    }
}

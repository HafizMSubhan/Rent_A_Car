<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id('driver_id'); // Auto-increment ID
            $table->string('Name');
            $table->string('Email')->unique(); // Unique email addresses
            $table->string('Phone_No');
            $table->string('Residential_Address');
            $table->string('CNIC_Number')->unique(); // Unique CNIC numbers
            $table->string('License_Number');
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('car_id')->on('cars');

            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    public function up()
    {
        Schema::create('car_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id'); // Foreign key to link pictures with cars
            $table->string('path'); // Path to the picture file
            $table->timestamps();
        
            $table->foreign('car_id')->references('car_id')->on('cars');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCapacityColumnsToCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            if (!Schema::hasColumn('cars', 'passenger_capacity')) {
                $table->integer('passenger_capacity');
            }
            if (!Schema::hasColumn('cars', 'luggage_capacity')) {
                $table->integer('luggage_capacity');
            }
        });
    }

    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('passenger_capacity');
            $table->dropColumn('luggage_capacity');
        });
    }
}

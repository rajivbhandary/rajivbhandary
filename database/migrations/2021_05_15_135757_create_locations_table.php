<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->string('realtor')->nullable();
            $table->string('building_name');
            $table->string('street');
            $table->string('landmark')->nullable();
            $table->string('locality');
            $table->string('town');
            $table->string('city');
            $table->string('pincode');
            $table->string('state');
            $table->string('country');

            $table->string('latitude');
            $table->string('longitude');

            $table->text('additional_info')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('locations');
    }
}

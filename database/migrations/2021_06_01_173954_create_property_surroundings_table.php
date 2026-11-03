<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertySurroundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_surroundings', function (Blueprint $table) {
            $table->id();

            //eg:(railway station, jain temple)
            $table->string('name');
            $table->unsignedBigInteger('property_id');

            $table->text('additional_info')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_surroundings');
    }
}

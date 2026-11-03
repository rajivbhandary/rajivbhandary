<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');

            //eg:(central_air_conditioning, oxygen_duct, UPS)
            $table->string('name');

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
        Schema::dropIfExists('property_facilities');
    }
}

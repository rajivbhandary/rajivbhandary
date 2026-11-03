<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_amenities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('property_id');
            //eg:(gym, swimming pool, clubhouse)
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
        Schema::dropIfExists('property_amenities');
    }
}

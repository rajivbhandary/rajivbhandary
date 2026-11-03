<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residentials', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('property_id');

            $table->string('house_no');
            $table->integer('number_of_bedrooms');
            $table->integer('number_of_separate_toilets')->nullable();
            $table->boolean('furnishing');
            $table->integer('number_of_covered_parkings');
            $table->integer('number_of_open_parkings');
            $table->string('facing_direction');

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
        Schema::dropIfExists('residentials');
    }
}

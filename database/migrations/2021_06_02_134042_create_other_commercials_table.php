<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherCommercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_commercials', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('property_id');

            $table->string('office_no');
            $table->boolean('furnishing');
            $table->integer('number_of_covered_parkings');
            $table->integer('number_of_open_parkings');

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
        Schema::dropIfExists('other_commercials');
    }
}

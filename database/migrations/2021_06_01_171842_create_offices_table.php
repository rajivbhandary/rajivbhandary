<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('property_id');

            $table->string('office_no');
            $table->integer('number_of_seats');
            $table->integer('number_of_cabins');
            $table->integer('number_of_meeting_rooms');
            $table->boolean('reception_area');
            $table->boolean('pantry');
            $table->boolean('staircase');
            $table->boolean('lift');

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
        Schema::dropIfExists('offices');
    }
}

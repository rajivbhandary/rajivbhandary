<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fre_amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('f_r_e_id');
            //eg:(gym, swimming pool, clubhouse)
            $table->string('name');

            $table->text('additional_info')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('f_r_e_id')
                ->references('id')
                ->on('fre')
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
        Schema::dropIfExists('fre_amenities');
    }
}

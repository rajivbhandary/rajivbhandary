<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreSurroundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fre_surroundings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('f_r_e_id');
            $table->string('name');

            $table->text('additional_info')->nullable();
            $table->softDeletes();

            $table->foreign('f_r_e_id')
                ->references('id')
                ->on('fre')
                ->onDelete('cascade');
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
        Schema::dropIfExists('fre_surroundings');
    }
}

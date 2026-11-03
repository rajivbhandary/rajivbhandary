<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fre_image', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('f_r_e_id');
            $table->unsignedBigInteger('image_id');

            $table->text('additional_info')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('f_r_e_id')
                ->references('id')
                ->on('fre')
                ->onDelete('cascade');

            $table->foreign('image_id')
                ->references('id')
                ->on('images')
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
        Schema::dropIfExists('fre_image');
    }
}

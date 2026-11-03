<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverviewKeypointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overview_keypoints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('f_r_e_id');
            $table->string('name');
            $table->text('additional_info')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('overview_keypoints');
    }
}

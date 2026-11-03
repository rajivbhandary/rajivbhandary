<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('model')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string("name");
            $table->string("email");
            $table->string("phone_number");
            $table->string("city");
            $table->string("state");
            $table->string('message', 500)->nullable();

            $table->text('additional_info')->nullable();
            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquiries');
    }
}

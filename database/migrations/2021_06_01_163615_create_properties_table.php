<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('location_id');
            $table->string('slug');

            $table->string('status'); //eg:(tent/sell)
            $table->string('type'); //eg:(residential/commercial)
            $table->string('detailed_type'); //eg:(bungalow, studio apartment)
            $table->unsignedBigInteger('rent_detail_id')->nullable(); //nullable... if null then rent else buy
            $table->integer('number_of_bathrooms')->nullable();
            $table->integer('total_floors')->nullable();
            $table->integer('floor_number')->nullable();  // ground floor-0 
            $table->smallInteger('age_of_property');
            $table->float('carpet');
            $table->float('built_up')->nullable();
            $table->float('super_built_up')->nullable();
            $table->string('rera_number')->nullable();
            $table->bigInteger('price')->nullable(); //if rent details avaliable, price will be null
            $table->boolean('negotiable');
            $table->boolean('under_construction');
            $table->date('available_by')->nullable(); //available_from
            $table->text('description');
            $table->string('feature_image_path');

            $table->string('owner_name');
            $table->string('owner_email');
            $table->string('owner_phone_number');

            $table->string('seo_description')->nullable();
            $table->string('seo_keywords', 2000)->nullable();
            $table->string('seo_og_description')->nullable();
            $table->string('seo_og_title')->nullable();

            $table->text('additional_info')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('rent_detail_id')
                ->references('id')
                ->on('rent_details')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
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
        Schema::dropIfExists('properties');
    }
}

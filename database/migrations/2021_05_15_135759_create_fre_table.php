<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateFreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fre', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('developer_id');
            
            $table->string('title');
            $table->string('slug');
            $table->text('overview');
            $table->string('commercial_space');
            $table->date('possesion_date');
            $table->bigInteger('total_price');
            $table->string('minimum_investment');
            $table->float('rental_yield')->nullable();
            $table->float('gross_yield')->nullable();
            $table->float('expected_irr')->nullable();
            $table->float('target_multiplier')->nullable();
            $table->text('details_info')->nullable();
            $table->float('floor_plate')->nullable();
            $table->string('floor')->nullable();
            $table->integer('car_parking')->nullable();
            $table->integer('elevators')->nullable();
            $table->float('built_up_area')->nullable();
            $table->float('carpet_area')->nullable();
            $table->string('property_type')->nullable();
            $table->string('tenant_overview');
            $table->year('founded')->nullable();
            $table->string('industry')->nullable();
            $table->string('market_cap')->nullable();
            $table->bigInteger('employees')->nullable();
            $table->string('website')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords', 2000)->nullable();
            $table->string('seo_og_description')->nullable();
            $table->string('seo_og_title')->nullable();
            $table->string('rera_number')->nullable();
            $table->string('feature_image_path');
           
            $table->softDeletes();
            $table->text('additional_info')->nullable();
            $table->timestamps();

            
            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');

            $table->foreign('developer_id')
                ->references('id')
                ->on('developers')
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
        Schema::dropIfExists('fre');
    }
}

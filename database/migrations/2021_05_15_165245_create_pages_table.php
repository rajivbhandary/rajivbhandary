<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('route_name')->unique();
            $table->string('route_url')->unique();

            $table->string('seo_description')->nullable();
            $table->string('seo_keywords', 2000)->nullable();
            $table->string('seo_og_description')->nullable();
            $table->string('seo_og_title')->nullable();

            $table->string('additional_info')->nullable();
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
        Schema::dropIfExists('pages');
    }
}

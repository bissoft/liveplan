<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('category')->nullable();
            $table->unsignedBigInteger('yelp_rating')->nullable();
            $table->text('yelp_reviews')->nullable();
            $table->unsignedBigInteger('facebook_rating')->nullable();
            $table->text('facebook_reviews')->nullable();
            $table->unsignedBigInteger('facebook_followers')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook_marketing')->nullable();
            $table->string('adwords')->nullable();
            $table->string('twitter_ads')->nullable();
            $table->string('linkedin_ads')->nullable();
            $table->string('employees')->nullable();
            $table->string('year_established')->nullable();
            $table->string('responsive')->nullable();
            $table->string('web_hosting')->nullable();
            $table->string('email_hosting')->nullable();
            $table->string('cms')->nullable();
            $table->string('marketing_auto')->nullable();
            $table->string('schema')->nullable();
            $table->string('open_graph')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->string('keywords')->nullable();
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
        Schema::dropIfExists('companies');
    }
}

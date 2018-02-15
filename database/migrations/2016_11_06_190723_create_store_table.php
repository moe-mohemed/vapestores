<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('stores', function (Blueprint $table){
            // our schema is defined in here
            $table->increments('id');
            $table->string('store_name');
            $table->string('store_name_slug');
            $table->string('store_description');
            $table->string('notes');
            $table->string('store_address');
            $table->string('store_phone');
            $table->string('store_email');
            $table->string('website');
            $table->string('store_hours');
            $table->string('country');
            $table->string('country_slug');
            $table->string('region');
            $table->string('region_slug');
            $table->string('city');
            $table->string('city_slug');
            $table->string('main_img');
            $table->float('lat', 10, 6);
            $table->float('lng', 10, 6);
            $table->string('place_id');
            $table->boolean('atm_machine');
            $table->boolean('parking');
            $table->string('established');
            $table->boolean('closed_down');
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
        //
        Schema::drop('stores');
    }
}

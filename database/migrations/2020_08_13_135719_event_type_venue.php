<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventTypeVenue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_type_venue', function (Blueprint $table) {

            $table->increments('id');

          
            

            $table->Integer('venue_id')->unsigned();

            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');

            $table->Integer('event_type_id')->unsigned();

            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

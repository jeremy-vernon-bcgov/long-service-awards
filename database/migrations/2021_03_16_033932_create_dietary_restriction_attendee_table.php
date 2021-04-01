<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietaryRestrictionAttendeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietary_restriction_attendee', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('dietary_restriction_id');
            $table->foreignId('attendee_id');

            $table->foreign('dietary_restriction_id')->references('id')->on('dietary_restrictions');
            $table->foreign('attendee_id')->references('id')->on('attendees');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dietary_restriction_registration');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_option_selections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('recipient_id');
            $table->foreignId('award_option_id');
            $table->string('value');

            $table->foreign('recipient_id')->references('id')->on('recipients');
            $table->foreign('award_option_id')->references('id')->on('award_options');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('award_selections');
    }
}

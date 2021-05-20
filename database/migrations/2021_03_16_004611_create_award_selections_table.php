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
            $table->string('award_options');
            $table->foreignId('recipient_id')->nullable()->constrained();
            //$table->unsignedBigInteger('recipient_id')->nullable();

            //$table->foreign('recipient_id')->references('id')->on('recipients');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('award_option_selections');
    }
}

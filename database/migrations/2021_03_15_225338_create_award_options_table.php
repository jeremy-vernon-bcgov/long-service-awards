<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignID('award_id');
            $table->string('name');
            $table->string('short_name');
            $table->enum('type',['text', 'number', 'select', 'table-reference']);
            $table->text('select_options')->nullable();
            $table->text('table_referenced')->nullable();
            $table->text('column_name')->nullable();


            $table->foreign('award_id')->references('id')->on('awards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('award_options');
    }
}

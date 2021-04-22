<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vips', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('organization_id');
            $table->integer('group_number')->nullable();;
            $table->foreignId('category_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('prenominal')->nullable();
            $table->string('postnominal')->nullable();
            $table->string('title')->nullable();
            $table->foreignId('address_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_prenominal')->nullable();
            $table->string('contact_postnominal')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_email')->nullable();
            $table->integer('total_attending')->default('1');
            $table->integer('parking_spots_required')->nullable();

            $table->string('address_prefix')->nullable();
            $table->string('address_suite')->nullable();
            $table->string('address_street_address')->nullable();
            $table->foreignId('address_community_id')->nullable();
            $table->string('address_postal_code')->nullable();

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('category_id')->references('id')->on('vip_categories');
            $table->foreign('address_community_id')->references('id')->on('communities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vips');
    }
}

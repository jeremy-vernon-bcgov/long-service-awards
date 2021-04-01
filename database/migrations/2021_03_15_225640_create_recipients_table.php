<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //Identifying Information
            $table->string('idir')->nullable();
            $table->string('guid')->nullable();
            $table->string('employee_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('is_bcgeu_member')->nullable();

            $table->foreignId('award_id');

            //Milestone Information
            $table->enum('milestone',[25, 30, 35, 40, 45, 50]);
            $table->boolean('retiring_this_year')->default(false);
            $table->date('retirement_date');
            $table->boolean('survey_participation')->default(true);

            //Work Contact Information
            $table->string('government_email');
            $table->string('government_phone_number');
            $table->foreignId('government_address_id');
            $table->foreignId('organization_id');
            $table->string('branch_name');

            //Personal Contact Information
            $table->string('personal_email');
            $table->string('personal_phone_number');
            $table->foreignId('personal_address_id');

            //Supervisor Information
            $table->string('supervisor_first_name');
            $table->string('supervisor_last_name');
            $table->string('supervisor_email');
            $table->foreignId('supervisor_address_id');

            //Administrivia
            //None of these should be input directly by the user
            //All should have defeaults or permit null values.
            $table->boolean('registered_in_2019')->default(false);
            $table->boolean('award_received')->default(false);
            $table->string('milestone_20_certificate_name')->nullable();
            $table->boolean('milestone_20_certificate_ordered')->nullable();
            $table->boolean('is_retroactive')->default(false);
            $table->boolean('noshow_at_ceremony')->nullable();
            $table->integer('presentation_number');
            $table->boolean('executive_recipient')->default(false);
            $table->boolean('recipient_speaker')->default(false);
            $table->boolean('reserved_seating')->default(false);
            $table->text('admin_notes')->nullable();
            $table->integer('photo_frame_range')->nullable();
            $table->integer('photo_order')->nullable();
            $table->datetime('photo_sent')->nullable();

            $table->softDeletes();

            //Foreign Key Constraints
            $table->foreign('government_address_id')->references('id')->on('addresses');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('personal_address_id')->references('id')->on('addresses');
            $table->foreign('supervisor_address_id')->references('id')->on('addresses');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}

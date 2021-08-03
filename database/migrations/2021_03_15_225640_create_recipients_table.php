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
            $table->integer('milestone');
            $table->integer('milestone_year')->nullable();
            $table->boolean('retiring_this_year')->default(false);
            $table->date('retirement_date')->nullable();
            $table->boolean('survey_participation')->default(true);

            //Work Contact Information
            $table->string('government_email');
            $table->string('government_phone_number');

            //work address
            $table->string('office_address_prefix')->nullable();
            $table->string('office_address_suite')->nullable();
            $table->string('office_address_street_address');
            $table->string('office_address_postal_code');
            $table->string('office_address_community_id');

            $table->foreignId('organization_id');
            $table->string('branch_name');

            //Personal Contact Information
            $table->string('personal_email')->nullable();
            $table->string('personal_phone_number')->nullable();

            //Personal address
            $table->string('personal_address_prefix')->nullable();
            $table->string('personal_address_suite')->nullable();
            $table->string('personal_address_street_address');
            $table->string('personal_address_postal_code');
            $table->string('personal_address_community_id');

            //Supervisor Information
            $table->string('supervisor_first_name');
            $table->string('supervisor_last_name');
            $table->string('supervisor_email');


            //Supervisor
            $table->string('supervisor_address_prefix')->nullable();
            $table->string('supervisor_address_suite')->nullable();
            $table->string('supervisor_address_street_address');
            $table->string('supervisor_address_postal_code');
            $table->string('supervisor_address_community_id');

            //Administrivia
            //None of these should be input directly by the user
            //All should have defeaults or permit null values.
            $table->boolean('registered_in_2019')->default(false);
            $table->boolean('award_received')->default(false);
            $table->string('certificate_name')->nullable();
            $table->boolean('milestone_certificate_ordered')->nullable();
            $table->boolean('is_retroactive')->default(false);

            $table->foreignId('ceremony_id')->nullable()->references('id')->on('ceremonies');
            $table->boolean('noshow_at_ceremony')->nullable();
            $table->integer('presentation_number')->nullable();
            $table->boolean('executive_recipient')->default(false);
            $table->boolean('recipient_speaker')->default(false);
            $table->boolean('reserved_seating')->default(false);
            $table->text('admin_notes')->nullable();
            $table->integer('photo_frame_range')->nullable();
            $table->integer('photo_order')->nullable();
            $table->datetime('photo_sent')->nullable();

            // Preferred Email/phone
            $table->string('preferred_email')->nullable();
            $table->string('preferred_phone_number')->nullable();

            $table->softDeletes();




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

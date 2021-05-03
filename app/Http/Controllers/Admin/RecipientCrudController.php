<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RecipientRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RecipientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecipientCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Recipient::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recipient');
        CRUD::setEntityNameStrings('recipient', 'recipients');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::column('id');
        //CRUD::column('created_at');
        //CRUD::column('updated_at');
        //CRUD::column('idir');
        //CRUD::column('guid');
        CRUD::column('employee_number');
        CRUD::column('first_name');
        CRUD::column('last_name');
        //CRUD::column('is_bcgeu_member');
        CRUD::column('milestone');
        CRUD::column('retiring_this_year');
        //CRUD::column('retirement_date');
        //CRUD::column('organizational_branch');
        //CRUD::column('survey_participation');
        //CRUD::column('government_email');
        //CRUD::column('government_phone_number');
        CRUD::column('organization_id');
        CRUD::column('branch_name');
        //CRUD::column('personal_email');
        //CRUD::column('personal_phone_number');
        //CRUD::column('supervisor_first_name');
        //CRUD::column('supervisor_last_name');
        //CRUD::column('supervisor_email');
        CRUD::column('registered_in_2019');
        CRUD::column('award_received');
        //CRUD::column('milestone_20_certificate_name');
        //CRUD::column('milestone_20_certificate_ordered');
        //CRUD::column('is_retroactive');
        //CRUD::column('noshow_at_ceremony');
        //CRUD::column('presentation_number');
        //CRUD::column('executive_recipient');
        //CRUD::column('recipient_speaker');
        CRUD::column('reserved_seating');
        //CRUD::column('admin_notes');
        //CRUD::column('photo_frame_range');
        //CRUD::column('photo_order');
        //CRUD::column('photo_sent');
        //CRUD::column('deleted_at');

        if (backpack_user()->hasRole('Organization Contact')) {
           $this->crud->addClause('where', 'organization_id', backpack_user()->organization );
        } else {
            $this->crud->addFilter([
                'type' => 'select2',
                'name' => 'organization',
                'label' => 'Organization'
            ], function () {
                return \App\Models\Organization::all()->pluck('name', 'id')->toArray();
            },
                function ($value) {
                    $this->crud->addClause('where', 'organization_id', $value);
                });
        }

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'qualifying_year',
            'label' => 'Qualifying Year'
        ], [
            2017 => '2017',
            2018 => '2018',
            2019 => '2019',
            2020 => '2020',
            2021 => '2021'
        ], function($value) {
           $this->crud->addClause('where','milestone_year', $value);
        });

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'milestone',
            'label' => 'Milestone',
        ],
        [
            20 => '20',
            25 => '25',
            30 => '30',
            35 => '35',
            40 => '40',
            45 => '45',
            50 => '50'
        ], function ($value) {
            $this->crud->addClause('where', 'milestone', $value);
        });

        $this->crud->addFilter([
            'type'  => 'simple',
            'name'  => 'award_received',
            'label' => 'Award Received'
        ], false,
        function ($value) {
            $this->crud->addClause('where','award_received', 1);
        });




        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RecipientRequest::class);

       // CRUD::field('id');
       // CRUD::field('created_at');
       // CRUD::field('updated_at');

        CRUD::field('first_name')->type('text')->label('First Name')->tab('Milestone Info');
        CRUD::field('last_name')->type('text')->label('Last Name')->tab('Milestone Info');
        CRUD::field('milestone')->type('select2_from_array')->options([25,30,35,40,45,50])->tab('Milestone Info');
        CRUD::field('retiring_this_year')->type('checkbox')->tab('Milestone Info');
        CRUD::field('retirement_date')->type('date')->tab('Milestone Info');
        CRUD::field('registered_in_2019')->type('checkbox')->tab('Milestone Info');
        CRUD::field('award_received')->type('checkbox')->tab('Milestone Info');
        CRUD::field('milestone_20_certificate_name')->tab('Milestone Info');
        CRUD::field('milestone_20_certificate_ordered')->type('checkbox')->tab('Milestone Info');
        CRUD::field('is_retroactive')->type('checkbox')->tab('Milestone Info');
        CRUD::field('survey_participation')->type('checkbox')->tab('Milestone Info');

        CRUD::field('idir')->type('text')->label('IDIR')->tab('Employee Info');
        CRUD::field('guid')->type('text')->label('GUID')->tab('Employee Info');
        CRUD::field('employee_number')->tab('Employee Info');
        CRUD::field('is_bcgeu_member')->type('checkbox')->tab('Employee Info');


        CRUD::field('government_email')->type('email')->tab('Employee Info');
        CRUD::field('government_phone_number')->tab('Employee Info');


        //Gov Address
        CRUD::field('office_address_prefix')->type('text')->tab('Employee Info');
        CRUD::field('office_address_suite')->type('text')->tab('Employee Info');
        CRUD::field('office_address_street_address')->type('text')->tab('Employee Info');
        CRUD::field('office_address_community_id')->type('select')->label('Community')->tab('Employee Info');
        CRUD::field('office_address_postal_code')->type('text')->tab('Employee Info');


        CRUD::field('organization')->type('select')->label('Organization')->tab('Employee Info');
        CRUD::field('branch_name')->tab('Employee Info');

        CRUD::field('supervisor_first_name')->tab('Supervisor');
        CRUD::field('supervisor_last_name')->tab('Supervisor');
        CRUD::field('supervisor_email')->type('email')->tab('Supervisor');
        //CRUD::field('supervisor_address_id')->tab('Supervisor');
        //Supervisor Address
        CRUD::field('supervisor_address_prefix')->entity('supervisorAddress')->attribute('prefix')->tab('Supervisor');
        CRUD::field('supervisor_address_suite')->entity('supervisorAddress')->attribute('suite')->tab('Supervisor');
        CRUD::field('supervisor_address_street_address')->entity('supervisorAddress')->attribute('street_address')->tab('Supervisor');
        CRUD::field('supervisor_address_community_id')->entity('supervisorAddress')->attribute('community')->tab('Supervisor');
        CRUD::field('supervisor_address_postal_code')->entity('supervisorAddress')->attribute('postal_code')->tab('Supervisor');

        //Personal Info
        CRUD::field('personal_email')->type('email')->tab('Personal Info');
        CRUD::field('personal_phone_number')->tab('Personal Info');
        //CRUD::field('personal_address_id')->tab('Personal Info');
        //Supervisor Address
        CRUD::field('personal_address_prefix')->entity('personalAddress')->attribute('prefix')->tab('Personal Info');
        CRUD::field('personal_address_suite')->entity('personalAddress')->attribute('suite')->tab('Personal Info');
        CRUD::field('personal_address_street_address')->entity('personalAddress')->attribute('street_address')->tab('Personal Info');
        CRUD::field('personal_address_community_id')->entity('personalAddress')->attribute('community')->tab('Personal Info');
        CRUD::field('personal_address_postal_code')->entity('personalAddress')->attribute('postal_code')->tab('Personal Info');


      //  CRUD::field('noshow_at_ceremony');
      //  CRUD::field('presentation_number');
      //  CRUD::field('executive_recipient');
      //  CRUD::field('recipient_speaker');
      //  CRUD::field('reserved_seating');
      //  CRUD::field('admin_notes');
      //  CRUD::field('photo_frame_range');
      //  CRUD::field('photo_order');
      //  CRUD::field('photo_sent');
      //  CRUD::field('deleted_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::field('first_name')->type('text')->label('First Name')->tab('Milestone Info');
        CRUD::field('last_name')->type('text')->label('Last Name')->tab('Milestone Info');
        CRUD::field('milestone')->type('select2_from_array')->options([25,30,35,40,45,50])->tab('Milestone Info');
        CRUD::field('retiring_this_year')->tab('Milestone Info');
        CRUD::field('retirement_date')->type('date')->tab('Milestone Info');
        CRUD::field('registered_in_2019')->tab('Milestone Info');
        CRUD::field('award_received')->tab('Milestone Info');
        CRUD::field('milestone_20_certificate_name')->tab('Milestone Info');
        CRUD::field('milestone_20_certificate_ordered')->tab('Milestone Info');
        CRUD::field('is_retroactive')->tab('Milestone Info');
        CRUD::field('survey_participation')->tab('Milestone Info');

        CRUD::field('idir')->type('text')->label('IDIR')->tab('Employee Info');
        CRUD::field('guid')->type('text')->label('GUID')->tab('Employee Info');
        CRUD::field('employee_number')->tab('Employee Info');
        CRUD::field('is_bcgeu_member')->tab('Employee Info');


        CRUD::field('government_email')->type('email')->tab('Employee Info');
        CRUD::field('government_phone_number')->tab('Employee Info');

        //Gov Address
        CRUD::field('office_address_prefix')->type('text')->tab('Employee Info');
        CRUD::field('office_address_suite')->type('text')->tab('Employee Info');
        CRUD::field('office_address_street_address')->type('text')->tab('Employee Info');
        CRUD::field('officeCommunity')->type('select')->entity('Community')->attribute('name')->tab('Employee Info');
        CRUD::field('office_address_postal_code')->type('text')->tab('Employee Info');

        CRUD::field('organization')->type('select')->label('Organization')->tab('Employee Info');
        CRUD::field('branch_name')->tab('Employee Info');

        CRUD::field('supervisor_first_name')->tab('Supervisor');
        CRUD::field('supervisor_last_name')->tab('Supervisor');
        CRUD::field('supervisor_email')->type('email')->tab('Supervisor');

        //Supervisor Address
        CRUD::field('supervisor_address_prefix')->type('text')->tab('Supervisor');
        CRUD::field('supervisor_address_suite')->type('text')->tab('Supervisor');
        CRUD::field('supervisor_address_street_address')->type('text')->tab('Supervisor');
        CRUD::field('supervisorCommunity')->type('select')->entity('Community')->attribute('name')->tab('Supervisor');
        CRUD::field('supervisor_address_postal_code')->type('text')->tab('Supervisor');

        //Personal Info
        CRUD::field('personal_email')->type('email')->tab('Personal Info');
        CRUD::field('personal_phone_number')->tab('Personal Info');

        //Personal Address
        CRUD::field('personal_address_prefix')->type('text')->tab('Personal Info');
        CRUD::field('personal_address_suite')->type('text')->tab('Personal Info');
        CRUD::field('personal_address_street_address')->type('text')->tab('Personal Info');
        CRUD::field('personalCommunity')->type('select')->entity('Community')->attribute('name')->tab('Personal Info');
        CRUD::field('personal_address_postal_code')->type('text')->tab('Personal Info');

        //Admin Fields
        CRUD::field('noshow_at_ceremony')->tab('Admin Info');
        CRUD::field('presentation_number')->tab('Admin Info');
        CRUD::field('executive_recipient')->tab('Admin Info');
        CRUD::field('recipient_speaker')->tab('Admin Info');
        CRUD::field('reserved_seating')->tab('Admin Info');
        CRUD::field('admin_notes')->tab('Admin Info');
        CRUD::field('photo_frame_range')->tab('Admin Info');
        CRUD::field('photo_order')->tab('Admin Info');
        CRUD::field('photo_sent')->tab('Admin Info');
        CRUD::field('deleted_at')->tab('Admin Info');
    }

    /**
     * Display Recipient Totals by Milestone
     */
    public function setByMilestoneOperation()
    {

    }
}

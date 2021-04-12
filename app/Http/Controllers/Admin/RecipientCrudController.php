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
        //CRUD::column('government_address_id');
        CRUD::column('organization_id');
        CRUD::column('branch_name');
        //CRUD::column('personal_email');
        //CRUD::column('personal_phone_number');
        //CRUD::column('personal_address_id');
        //CRUD::column('supervisor_first_name');
        //CRUD::column('supervisor_last_name');
        //CRUD::column('supervisor_email');
        //CRUD::column('supervisor_address_id');
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

        CRUD::field('id');
        CRUD::field('created_at');
        CRUD::field('updated_at');
        CRUD::field('idir');
        CRUD::field('guid');
        CRUD::field('employee_number');
        CRUD::field('first_name');
        CRUD::field('last_name');
        CRUD::field('is_bcgeu_member');
        CRUD::field('milestone');
        CRUD::field('retiring_this_year');
        CRUD::field('retirement_date');
        CRUD::field('organizational_branch');
        CRUD::field('survey_participation');
        CRUD::field('government_email');
        CRUD::field('government_phone_number');
        CRUD::field('government_address_id');
        CRUD::field('organization_id');
        CRUD::field('branch_name');
        CRUD::field('personal_email');
        CRUD::field('personal_phone_number');
        CRUD::field('personal_address_id');
        CRUD::field('supervisor_first_name');
        CRUD::field('supervisor_last_name');
        CRUD::field('supervisor_email');
        CRUD::field('supervisor_address_id');
        CRUD::field('registered_in_2019');
        CRUD::field('award_received');
        CRUD::field('milestone_20_certificate_name');
        CRUD::field('milestone_20_certificate_ordered');
        CRUD::field('is_retroactive');
        CRUD::field('noshow_at_ceremony');
        CRUD::field('presentation_number');
        CRUD::field('executive_recipient');
        CRUD::field('recipient_speaker');
        CRUD::field('reserved_seating');
        CRUD::field('admin_notes');
        CRUD::field('photo_frame_range');
        CRUD::field('photo_order');
        CRUD::field('photo_sent');
        CRUD::field('deleted_at');

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
        $this->setupCreateOperation();
    }
}

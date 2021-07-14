<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AttendeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AttendeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AttendeeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Attendee::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/attendee');
        CRUD::setEntityNameStrings('attendee', 'attendees');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('ceremony_id');
       // CRUD::column('created_at');
       // CRUD::column('guest_id');
       // CRUD::column('id');
       // CRUD::column('recipient');
        CRUD::addColumn(['name' => 'attendable_id', 'type' => 'relationship' , 'label'=> 'First', 'attribute' => 'first_name']);
        CRUD::addColumn(['name' => 'attendable_id', 'key' => 'attendable_last_name', 'type' => 'relationship' , 'label'=> 'Last', 'attribute' => 'last_name']);
        CRUD::addColumn(['name' => 'attendable_id', 'key' => 'attendable_milestone', 'type' => 'relationship' , 'label'=> 'Milestone', 'attribute' => 'milestone']);
        CRUD::addColumn(['name' => 'org_name', 'type' => 'text']);
        CRUD::addColumn(['name' => 'attendable_type', 'type' => 'text']);
        //CRUD::column('attendable');
        CRUD::column('status');
       // CRUD::column('type');
       // CRUD::column('updated_at');
       // CRUD::column('vip_id');


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
        CRUD::setValidation(AttendeeRequest::class);

        CRUD::field('ceremony_id');
        CRUD::field('created_at');
        CRUD::field('guest_id');
        CRUD::field('id');
        CRUD::field('recipient_id');
        CRUD::field('status');
        CRUD::field('type');
        CRUD::field('updated_at');
        CRUD::field('vip_id');

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

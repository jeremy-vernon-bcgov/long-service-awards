<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\CeremonyInviteOperation;
use App\Http\Requests\RecipientCeremonyRequest;
use App\Models\Ceremony;
use App\Models\Organization;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RecipientCeremonyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RecipientCeremonyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use CeremonyInviteOperation; //app/Http/Controllers/Admin/Operations/CeremonyInviteOperation.php

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\RecipientCeremony::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recipientceremony');
        CRUD::setEntityNameStrings('recipientceremony', 'recipient_ceremonies');
        // Join in Ceremonies info, make sure to specifically selelct recipients.id or it will get overwritten.
        $this->crud->addClause('join','ceremonies', 'ceremonies.id', '=' , 'recipients.ceremony_id');
       // $this->crud->addClause('join', 'attendees', 'recipients.id', '=', 'attendees.recipient_id' );
        $this->crud->addClause('select', 'recipients.id', 'recipients.ceremony_id', 'recipients.organization_id','recipients.first_name', 'recipients.last_name', 'recipients.government_email', 'ceremonies.scheduled_datetime');
        $this->crud->allowAccess('ceremonyInvite');
        $this->crud->allowAccess(['list', 'update']);


        CRUD::column('ceremony_id');
        CRUD::column('first_name');
        CRUD::column('last_name');
        CRUD::column('government_email');
        CRUD::column('organization_id');
        //CRUD::column('status');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // Add in email functionality and a few restrictions on setup.
        $this->crud->allowAccess('ceremonyInvite');

        // Only show users who have a ceremony_id.
        $this->crud->addClause('where', 'recipients.ceremony_id', '<>', 'null');

        // Don't want to create records here.
        $this->crud->removeButton('create');

        // Don't need these buttons.
        $this->crud->removeButtons(['delete', 'show', 'update']);
        // Allow export.
        $this->crud->enableExportButtons();

        // Build array for search
        $ceremony_array = $this->getCeremoniesFilterData();

        //******** Filters **********************************************************//
        // Ceremony filter//
        $this->crud->addFilter([
            'name' => 'ceremony_id',
            'type' => 'dropdown',
            'label' => 'Ceremony'
        ],
        $ceremony_array
        , function($value){
                $this->crud->addClause(
                    'where', 'recipients.ceremony_id', $value
                );
        });

        // Ministry filter //
        $this->crud->addFilter([
            'name' => 'organization_id',
            'type' => 'select2_multiple',
            'label' => 'Ministries'
        ], function() {
            return  $this->getMinistryFilterData(); // Get all ministries by id/name.
        }, function($values) {
           $this->crud->addClause(
               'whereIn', 'organization_id', json_decode($values)
           );
        });

        // User status filter //
        $this->crud->addFilter([
            'name' => 'status',
            'type' => 'dropdown',
            'label'=> 'Attendee status',
        ],
        [
            'assigned' => 'Not yet invited',
            'invited' => 'Has been invited, no reponse',
        ], function($value) {
            $this->crud->addClause(
                'where', 'status', $value
            );
        });

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RecipientCeremonyRequest::class);

        CRUD::field('ceremony_id');
        CRUD::field('scheduled_datetime');
        CRUD::field('first_name');
        CRUD::field('last_name');
        CRUD::field('government_email');

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
        $this->crud->addField('first_name');
        $this->crud->addField('last_name');
        $this->crud->addField('government_email');
        $this->crud->addField('ceremony_id');
    }

    private function getCeremoniesFilterData() {
        $ceremony_array = [];
        $ceremonies = Ceremony::all();
        // Could use the toArray method above, but throws out a format we want.
        foreach($ceremonies as $ceremony){
            $ceremony_array[$ceremony->id] = $ceremony->scheduled_datetime;
        }
        return $ceremony_array;
    }

    private function getMinistryFilterData() {
        $ministry_array = [];
        $ministries = Organization::all();
        // Could use toArray method above, but this sets things up ready for the filter.
        foreach($ministries as $ministry) {
            $ministry_array[$ministry->id] = $ministry->name;
        }
        return $ministry_array;
    }

}

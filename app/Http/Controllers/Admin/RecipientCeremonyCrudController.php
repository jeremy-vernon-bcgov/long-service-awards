<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\CeremonyInviteOperation;
use App\Http\Requests\RecipientCeremonyRequest;
use App\Models\Ceremony;
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
        $this->crud->addClause('join','ceremonies', 'ceremonies.id', '=' , 'ceremony_id');
        $this->crud->addClause('select', 'recipients.id', 'recipients.ceremony_id', 'recipients.first_name', 'recipients.last_name', 'recipients.government_email', 'ceremonies.scheduled_datetime', 'ceremonies.night_number');
        $this->crud->allowAccess('ceremonyInvite');
        //$this->crud->setOperation('ceremonyInvite');
        $this->crud->allowAccess(['list', 'update']);

        CRUD::column('night_number');
        CRUD::column('ceremony_id');
        CRUD::column('first_name');
        CRUD::column('last_name');
        CRUD::column('government_email');
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
        // TODO: add this as a default filter.
        $this->crud->addClause('where', 'ceremony_id', '<>', 'null');
        $this->crud->addClause('where', 'ceremony_id', '<>', 'attending');
        $this->crud->addClause('where', 'ceremony_id', '<>', 'declined');
        $this->crud->addClause('where', 'ceremony_id', '<>', 'waitlisted');

        // Don't want to create records here.
        $this->crud->removeButton('create');
        // Don't need these buttons.
        $this->crud->removeButtons(['delete', 'show']);
        // Allow export.
        $this->crud->enableExportButtons();
        // Collect all ceremony ids
        $ceremonies = Ceremony::all();
        // Build array for search
        $ceremony_array = [];
        foreach($ceremonies as $ceremony){
            $ceremony_array[$ceremony->id] = "night " . $ceremony->night_number . ": " . $ceremony->scheduled_datetime;
        }

        // We need to add some filters for the user
        $this->crud->addFilter([
            'name' => 'ceremony_id',
            'type' => 'dropdown',
            'label' => 'Ceremony'
        ],
        $ceremony_array
        , function($value){
                $this->crud->addClause(
                    'where', 'ceremony_id', $value);
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



}

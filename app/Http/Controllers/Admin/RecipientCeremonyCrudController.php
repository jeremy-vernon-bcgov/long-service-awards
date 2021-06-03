<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\CeremonyInviteOperation;
use App\Http\Requests\RecipientCeremonyRequest;
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

        //$this->crud->enableBulkActions();
        // Add in email funcitonality and a few restrictions on setup.
        $this->crud->allowAccess('ceremonyInvite');

        // Only show users who have a ceremony_id
        // TODO: add this as a default filter.
        $this->crud->addClause('where', 'ceremony_id', '<>', 'null');
        $this->crud->removeButton('create');
        $this->crud->removeButtons(['delete', 'show']);
        //$this->crud->addButtonFromView('top', 'email', 'ceremonyinvite', 'beginning');


        $this->crud->enableExportButtons();
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

<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait CeremonyInviteOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupCeremonyInviteRoutes($segment, $routeName, $controller)
    {
        Route::post($segment.'/ceremonyinvite', [
            'as'        => $routeName.'.ceremonyInvite',
            'uses'      => $controller.'@ceremonyInvite',
            'operation' => 'ceremonyInvite',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupCeremonyInviteDefaults()
    {
        $this->crud->allowAccess('ceremonyInvite');

        $this->crud->operation('list', function () {
            $this->crud->enableBulkActions();
            $this->crud->addButtonFromView('top', 'email', 'ceremonyinvite', 'beginning');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */

    public function ceremonyInvite()
    {

        $this->crud->hasAccessOrFail('ceremonyInvite');
        $entries = $this->crud->getRequest()->input('entries');
        dd($entries);
        // Do something
        // return something

    }
}


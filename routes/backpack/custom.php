<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('recipient', 'RecipientCrudController');
    Route::crud('organization', 'OrganizationCrudController');
    Route::crud('dietaryrestriction', 'DietaryRestrictionCrudController');
    Route::crud('pecsfcharity', 'PecsfCharityCrudController');
    Route::crud('pecsfregion', 'PecsfRegionCrudController');
    Route::crud('accessibilityoption', 'AccessibilityOptionCrudController');
    Route::crud('ceremony', 'CeremonyCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('award', 'AwardCrudController');

}); // this should be the absolute last line of this file

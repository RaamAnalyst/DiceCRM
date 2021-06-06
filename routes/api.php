<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Client
    Route::apiResource('clients', 'ClientApiController');

    // Industry
    Route::apiResource('industries', 'IndustryApiController');

    // Department
    Route::apiResource('departments', 'DepartmentApiController');

    // Status
    Route::apiResource('statuses', 'StatusApiController');

    // Project
    Route::post('projects/media', 'ProjectApiController@storeMedia')->name('projects.storeMedia');
    Route::apiResource('projects', 'ProjectApiController');

    // Tasks
    Route::post('tasks/media', 'TasksApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TasksApiController');

    // Leads
    Route::post('leads/media', 'LeadsApiController@storeMedia')->name('leads.storeMedia');
    Route::apiResource('leads', 'LeadsApiController');

    // Appointment
    Route::apiResource('appointments', 'AppointmentApiController');
});

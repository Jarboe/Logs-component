<?php

Route::group(array('prefix' => config('jarboe.admin.uri'), 'before' => array('auth_admin', 'check_permissions')), function() {

    Route::any('logs', 'Jarboe\Component\Logs\Http\Controllers\AdminController@logs');
    
});


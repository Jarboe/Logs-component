<?php

namespace Jarboe\Component\Logs\Http\Controllers;

use Jarboe;


class AdminController extends \App\Http\Controllers\Controller
{
    
    public function logs()
    {
        return Jarboe::table([
            'url'      => '/admin/logs',
            'def_name' => 'logs',
        ]);
    } // end logs
    
}

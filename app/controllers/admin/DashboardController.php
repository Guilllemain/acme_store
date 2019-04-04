<?php

namespace App\Controllers\Admin;

use App\Classes\Session;
use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        Session::add('admin', 'you are in a session');

        $session = Session::get('admin');

        return view('admin.dashboard', ['session' => $session]);
    }
}

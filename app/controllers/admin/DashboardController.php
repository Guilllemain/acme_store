<?php

namespace App\Controllers\Admin;

use App\Classes\Session;
use App\Controllers\BaseController;
use App\Classes\Request;
use App\Models\Category;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function store()
    {
        dd(Request::all());
    }
}

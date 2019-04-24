<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductsController
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
}

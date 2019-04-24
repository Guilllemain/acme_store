<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class SearchCategoriesController
{
    protected $categories;
    protected $links;

    public function __construct()
    {
        $total = Category::all()->count();
        $object = new Category();
        list($this->categories, $this->links) = paginate(20, $total, 'categories', $object);
    }

    public function show()
    {

        if (!Request::has('get')) return;

        $request = Request::get('get');

        $categories = Category::where('name', 'LIKE', '%' . $request->search . '%')->get();

        return view('admin.products.categories', ['categories' => $categories, 'links' => $this->links]);
    }
}

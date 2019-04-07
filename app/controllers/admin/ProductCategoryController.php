<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController
{
    protected $categories;
    protected $links;

    public function __construct()
    {
        $total = Category::all()->count();
        $object = new Category();
        list($this->categories, $this->links) = paginate(2, $total, 'categories', $object);
    }

    public function index()
    {   
        return view('admin.products.categories', ['categories' => $this->categories, 'links' => $this->links]);
    }

    public function store()
    {
        if (!Request::has('post')) return;

        $request = Request::get('post');
        $validator = new ValidateRequest;
        $validator->validate($_POST, [
            'name' => ['required' => true, 'unique' => 'categories']
        ]);

        if ($validator->hasError()) {
            $errors = $validator->getErrorMessage();
            return view('admin.products.categories', ['categories' => $this->categories, 'links' => $this->links, 'errors' => $errors]);
        }

        if (!CSRFToken::verifyCSRFToken($request->token)) {
            throw new \Exception("Token mismatch");
        }

        $name = $request->name;
        $parent_id = $request->parent_id === '0' ? null : $request->parent_id;
        
        Category::create([
            'name' => $name,
            'slug' => strtolower(str_replace(' ', '-', $name)),
            'parent_id' => $parent_id
        ]);
        $total = Category::all()->count();
        $object = new Category();
        list($this->categories, $this->links) = paginate(2, $total, 'categories', $object);

        return view( 'admin.products.categories', ['categories' => $this->categories, 'links' => $this->links, 'success' => 'Category created']);
    }

    public function destroy($category_id)
    {
        dd(Request::all());
    }
}

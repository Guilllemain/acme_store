<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;

class ProductCategoryController
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.products.categories', compact('categories'));
    }

    public function store()
    {
        if (!Request::has('post')) return;

        $request = Request::get('post');
        $validator = new ValidateRequest;
        dd($validator->unique('name', $request->name, 'categories'));

        if (!CSRFToken::verifyCSRFToken($request->token)) {
            throw new Exception("Token mismatch");
        }

        $name = $request->name;
        $parent_id = $request->parent_id === '0' ? null : $request->parent_id;
        
        Category::create([
            'name' => $name,
            'slug' => strtolower(str_replace(' ', '-', $name)),
            'parent_id' => $parent_id
        ]);

        return Redirect::back();
    }

    public function destroy($category_id)
    {
        dd(Request::all());
    }
}

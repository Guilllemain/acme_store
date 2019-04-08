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

    public function update($id)
    {
        if (!Request::has('post')) return;

        $request = Request::get('post');
        $validator = new ValidateRequest;
        $validator->validate($_POST, [
            'name' => ['required' => true, 'unique' => 'categories']
        ]);

        if ($validator->hasError()) {
            $errors = $validator->getErrorMessage();
            header('Content-Type: application/json');
            http_response_code(422);
            echo json_encode($errors);
            die();
        }

        if (!CSRFToken::verifyCSRFToken($request->token)) {
            throw new \Exception("Token mismatch");
        }

        $name = $request->name;
        $parentId = $request->parentId === '0' ? null : $request->parentId;

        Category::where('id', $id)->update(['name' => $name]);
        echo json_encode(['success' => 'Category updated']);
    }

    public function destroy($category_id)
    {
        dd(Request::all());
    }
}

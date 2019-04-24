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
        list($this->categories, $this->links) = paginate(20, $total, 'categories', $object);
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
        $parent_id = $request->parent_id === 'NULL' ? null : $request->parent_id;
        
        Category::create([
            'name' => $name,
            'slug' => strtolower(str_replace(' ', '-', $name)),
            'parent_id' => $parent_id
        ]);
        $total = Category::all()->count();
        $object = new Category();
        list($this->categories, $this->links) = paginate(20, $total, 'categories', $object);

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
        $parent_id = $request->parent_id === '0' ? null : $request->parent_id;
        Category::where('id', $id)->update([
            'name' => $name,
            'slug' => strtolower(str_replace(' ', '-', $name)),
            'parent_id' => $parent_id
        ]);
        echo json_encode(['success' => 'Category updated']);
    }

    public function destroy($id)
    {
        if (!Request::has('post')) return;

        $request = Request::get('post');
        $categories = Category::where('parent_id', $id)->get();
        if (count($categories)) {
            foreach ($categories as $category) {
                $sub_categories = Category::where('parent_id', $category->id)->get();
                if(count($sub_categories)) {
                    foreach ($sub_categories as $sub_category) {
                        $sub_category->delete();
                    }
                }
                $category->delete();
            };
        }
        
        if (!CSRFToken::verifyCSRFToken($request->token)) {
            dd('error');
            throw new \Exception("Token mismatch");
        }

        Category::destroy($id);

        

        echo json_encode(['success' => 'Category destroyed']);
    }
}

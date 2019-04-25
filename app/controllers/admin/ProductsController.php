<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
use App\Classes\UploadFile;

class ProductsController
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store()
    {
        if (!Request::has('post')) return;

        $request = Request::get('post');
        
        $validator = new ValidateRequest;
        $validator->validate($_POST, [
            'name' => ['required' => true, 'unique' => 'products'],
            'price' => ['required' => true, 'number' => true],
            'stock' => ['required' => true, 'number' => true],
            'category_id' => ['required' => true, 'number' => true],
            'description' => ['required' => true]
        ]);
        
        $file_errors = [];
        $file = Request::get('file');
        $filename = $file->image->name;
        if (empty($filename)) {
            $file_errors['image'] = ['The product image is required'];
        } else if (!UploadFile::isImage($filename)) {
            $file_errors['image'] = ['The file must be an image'];
        }

        if ($validator->hasError()) {
            $response = $validator->getErrorMessage();
            count($file_errors) ? $errors = array_merge($response, $file_errors) : $errors = $response;
            return view('admin.products.create', ['categories' => Category::all(), 'errors' => $errors]);
        }

        if (!CSRFToken::verifyCSRFToken($request->token)) {
            throw new \Exception("Token mismatch");
        }

        $tmp_path = $file->image->tmp_name;
        $image_path = UploadFile::move($tmp_path, 'images/products', $filename)->getPath();

        Product::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'stock' => $request->stock,
            'description' => $request->description,
            'image_path' => $image_path
        ]);

        Request::clear();

        return view('admin.dashboard', ['success' => 'Product created']);
    }
}

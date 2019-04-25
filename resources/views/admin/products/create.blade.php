@extends('admin.layout.base')

@section('title', 'Create Product')
@section('page-id', 'create-product')

@section('content')

<div class="m-8">
    <h3 class="font-normal">Add Product</h3>

    <div class="my-8">
        <form action="/admin/products/create" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
            <div class="flex mb-5">
                <div class="w-1/4">
                    <div>
                        <label for="name">Name</label>
                        <input class="input" type="text" name="name" value="{{\App\Classes\Request::old('post', 'name')}}">
                    </div>
                    <div class="flex mt-5">
                        <div class="w-32 mr-8">
                            <label for="price">Price</label>
                            <input class="input" type="number" name="price" value="{{\App\Classes\Request::old('post', 'price')}}">
                        </div>
                        <div class="w-32">
                            <label for="stock">Stock</label>
                            <input class="input" type="number" name="stock" value="{{\App\Classes\Request::old('post', 'stock')}}">
                        </div>
                    </div>
                </div>
                <select-category :categories="{{json_encode($categories)}}" :category_id="{{\App\Classes\Request::old('post', 'category_id')}}"></select-category>
                <div>
                    <label for="image">Image</label>
                    <input class="input" type="file" name="image">
                </div>
            </div>
            
            
            <div>
                <label for="description">Description</label>
                <textarea class="input" name="description" rows="3">
                    {{\App\Classes\Request::old('post', 'description')}}
                </textarea>
            </div>
            <button class="btn mt-4">Create</button>
        </form>
    </div>
</div>
@endsection
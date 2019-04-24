@extends('admin.layout.base')

@section('title', 'Create Product')
@section('page-id', 'create-product')

@section('content')

<div class="m-8">
    <h3 class="font-normal">Add Product</h3>

    <div class="my-8">
        <form action="/admin/products/create" method="POST">
            <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
            <div>
                <label for="name">Name</label>
                <input class="input" type="text" name="name" value="{{\App\Classes\Request::old('post', 'name')}}">
            </div>
            <div class="relative">
                <label for="category">Category</label>
                <select class="input bg-white" name="parent_id">
                <option value="NULL" selected value="{{\App\Classes\Request::old('post', 'category') ?: ''}}">{{\App\Classes\Request::old('post', 'category') ?: 'Select a category'}}</option>
                    @foreach ($categories as $category)
                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            <div>
                <label for="price">Price</label>
                <input class="input" type="number" name="price" value="{{\App\Classes\Request::old('post', 'price')}}">
            </div>
        </form>
    </div>
</div>
@endsection
@extends('admin.layout.base')

@section('title', 'Product Category')
@section('page-id', 'update-category')

@section('content')

<div class="m-8">
    <h3 class="font-normal">Product Category</h3>

    <div class="my-8">
        <div class="flex">
            <div class="w-1/4">
                <form action="" method="POST" class="flex">
                    <input type="text" class="input" placeholder="Search by name">
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
            <div class="ml-auto w-2/3">
                <form action="/admin/products/categories" method="POST">
                    <div class="flex">
                        <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                        <div class="w-1/3">
                            <input type="text" name="name" class="input" placeholder="Category name">
                        </div>
                        <div class="relative w-1/4">
                            <select class="input bg-white" name="parent_id">
                                <option value="NULL" selected>Parent category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <button class="btn" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-12">
            <table class="w-full">
                <thead class="text-left bg-grey-light">
                    <tr>
                        <th class="p-4">ID</th>
                        <th>Category name</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td width="80" class="p-4">{{$category['id']}}</td>
                        <td>{{$category['name']}}</td>
                        <td>{{$category['added']}}</td>
                        <td width="100">
                            <div class="flex justify-end mr-4">
                                <update-category :categories="{{json_encode($categories)}}" :selected-category="{{json_encode($category)}}" :token="{{json_encode(\App\Classes\CSRFToken::_token())}}"></update-category>
                                <delete-category :category="{{json_encode($category)}}" :token="{{json_encode(\App\Classes\CSRFToken::_token())}}"></delete-category>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $links !!}
        </div>
    </div>
</div>
@endsection
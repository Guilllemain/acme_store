@extends('admin.layout.base')

@section('title', 'Product Category')
@section('page-id', 'update-category')

@section('content')
<div class="dashboard">
    <div class="grid-x expanded">
        <h2>Product Category</h2>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="small-12 medium-3 cell">
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" class="input-group-field" placeholder="Search by name">
                    <div class="input-group-button">
                        <button type="submit" class="button">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="small-12 medium-8 cell">
            <form action="/admin/products/categories" method="POST">
                <div class="input-group">
                    <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                    <input type="text" name="name" class="input-group-field" placeholder="Category name">
                    <input type="number" name="parent_id" class="input-group-field" value="0" placeholder="Parent id">
                    <div class="input-group-button">
                        <button class="button" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="small-12 medium-11">
            <table class="hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category name</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category['id']}}</td>
                        <td>{{$category['name']}}</td>
                        <td>{{$category['added']}}</td>
                        <td width="100" class="text-right">
                            <a data-open="item-{{$category['id']}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/admin/products/categories/{{$category['id']}}" method="POST">
                                <input type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                                <button type="submit">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            <div class="reveal" id="item-{{$category['id']}}" data-reveal>
                              <h3>Edit category</h3>
                              <form class="update-category" data-token="{{\App\Classes\CSRFToken::_token()}}" data-id="{{$category['id']}}">
                                  <div class="input-group">
                                        <input type="text" name="name" id="category-name" class="input-group-field" value="{{$category['name']}}">
                                        <input type="number" name="parent_id" id="parent-category-id" class="input-group-field" value="">
                                        <div class="input-group-button">
                                            <button class="button" type="submit" >Update</button>
                                        </div>
                                  </div>
                              </form>
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
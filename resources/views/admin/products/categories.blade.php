@extends('admin.layout.base')

@section('title', 'Product Category')

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
                    <input type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
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
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at->toFormattedDateString()}}</td>
                        <td width="100" class="text-right">
                            <a href="#">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/admin/products/categories/{{$category->id}}" method="POST">
                                <input type="hidden" value="{{\App\Classes\CSRFToken::_token()}}">
                                <button type="submit">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
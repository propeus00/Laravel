@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">{{isset($category) ? "Edit category" : "Create category"}}</div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach ($errors->all() as $item)
                <li class="list-item-group">
                    {{$item}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{isset($category) ? route("categories.update", $category->id) : route("categories.store")}}"
            method="POST">
            @if(isset($category))
            @method("PUT")

            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name"
                    value="{{isset($category) ? $category->name : ""}}">
            </div>
            <div class="form-group">
                <button class="btn btn-success">{{isset($category) ? "Edit" : "Add"}}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="d-flex flex-row-reverse mb-2">
    <a href={{route("categories.create")}} class="btn btn-success float-right">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header">Categories</div>
    @if(Session::get("previouseCategoryName"))

    <div class="alert alert-success">
        Category changed from {{Session::get("previouseCategoryName")}} to {{Session::get("afterValue")}}.
    </div>
    @elseif(Session::get("successDelete"))
    <div class="alert alert-success">
        {{Session::get("successDelete")}}
    </div>
    @endif




    <div class="card-body">
        <table class="table">
            <thead>
                <th>
                    Name
                </th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>
                        {{$category->name}} <br />
                        <small>{{$category->posts->count()}} posts</small>
                    </td>
                    <td>
                        <a href="{{route("categories.edit", $category->id )}}" class="btn btn-info btn-sm">
                            Edit
                        </a>
                    </td>
                    <td>
                        <a data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm"
                            onclick="deleteCategory({{$category->id}})">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="" method="POST" id="deleteCategoryForm">
            @method("DELETE")
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Yes</button>
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Go back</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
@section('script')
<script>
    function deleteCategory(id){

            var form = document.getElementById("deleteCategoryForm")

            form.action = "/categories/" + id

            $("#deleteModal").modal("show")
        }
</script>
@endsection

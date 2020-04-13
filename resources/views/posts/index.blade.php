@extends('layouts.app')

@section('content')
<div class="d-flex flex-row-reverse mb-2">
    <a href={{route("posts.create")}} class="btn btn-success float-right">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">Posts</div>
    <div class="card-body">
        @if ($posts->count()>0)
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                <tr>
                    <td>
                        <img src="{{asset('storage/'.$post->image)}}" width="70px" height="70px" alt="">
                    </td>
                    <td>
                        {{$post->title}}
                        @if ($post->published_at > now())
                        <svg class="bi bi-x" width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="red"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>This article is not published yet.</title>
                            <path fill-rule="evenodd"
                                d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z"
                                clip-rule="evenodd" />
                        </svg>
                        @else
                        <svg class="bi bi-check" width="1.3em" height="1.3em" viewBox="0 0 16 16" fill="green"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>This article is published.</title>
                            <path fill-rule="evenodd"
                                d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z"
                                clip-rule="evenodd" />
                        </svg>
                        @endif<br />
                        <small>{{$post->category->name}} category.</small>
                    </td>

                    @if ($post->trashed())
                    <td>
                        <form action="{{route("restore-posts", $post->id )}}" method="POST">
                            @method("PUT")
                            <button type="submit" class="btn btn-info btn-sm"> Restore </button>
                        </form>

                    </td>
                    @else
                    <td>
                        <a href="{{route("posts.edit", $post->id )}}" class="btn btn-info btn-sm">
                            Edit
                        </a>
                    </td>
                    @endif


                    <td>
                        <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                {{$post->trashed() ? "Delete" : "Trash"}}
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-primary">No posts to show.</div>
        @endif
    </div>
</div>
@endsection

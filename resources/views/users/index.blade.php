@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card-header">Users</div>
    <div class="card-body">
        @if ($users->count()>0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Email</th>
            </thead>
            <tbody>

                @foreach ($users as $user)
                <tr>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        @if (!$user->isAdmin()&&$user->remember_token==null)
                        <form method="POST" action="{{route("users.make-admin",  $user->id)}}">
                            <button type="submit" class="btn btn-success btn-sm">
                                Make Admin
                            </button>
                        </form>

                        @endif
                        @if ($user->isAdmin()&&$user->remember_token==null)
                        <form method="POST" action="{{route("users.remove-admin",  $user->id)}}">
                            <button type="submit" class="btn btn-success btn-sm">
                                Remove Admin
                            </button>
                        </form>

                        @endif

                    </td>


                </tr>

                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-primary">No users to show.</div>
        @endif
    </div>
</div>
@endsection

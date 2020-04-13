@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (!auth()->user()->isAdmin())
                    <h5>Welcome to the <b>user area</b> where you can add or edit posts and categories.</h5>
                    @elseif(auth()->user()->isAdmin())
                    <h5>Welcome to the <b>admin area</b>, add or edit posts and categories and give users the right to
                        become
                        admins and restore posts from the trash.</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

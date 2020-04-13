<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body>
    <div id="app">
        @include('partials.navbar')

        <main class="py-4">
            @if (session()->has("success"))
            <div class="alert alert-success">
                {{session()->get("success")}}
            </div>
            @endif
            @if (session()->has("error"))
            <div class="alert alert-danger">
                {{session()->get("error")}}
            </div>
            @endif
            @auth
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
                            @if (auth()->user()->isAdmin())
                            <li class="list-group-item">
                                <a href="{{route("users.index")}}">Users</a>
                            </li>
                            @endif

                            <li class="list-group-item">
                                <a href="{{route("posts.index")}}">Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{route("categories.index")}}">Categroies</a>
                            </li>
                            @if (auth()->user()->isAdmin())
                            <li class="list-group-item">
                                <a href="{{route("trashed-posts")}}">Trashed posts</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-8">
                        @yield('content')
                    </div>
                </div>
            </div>
            @else
            @yield('content')
            @endauth

        </main>
    </div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
    integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous">
</script>
@yield('script')

</html>

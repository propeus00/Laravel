<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>B00349443</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{asset("css/all.min.css")}}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
        type='text/css'>
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="{{asset("css/clean-blog.min.css")}}" rel="stylesheet" crossorigin="anonymous">

</head>

<body>

    <!-- Navigation -->
    @include('partials.navbar')

    <!-- Page Header -->
    <header class="masthead" style="background-image: url({{asset('img/home-bg.jpg')}})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">Share your knowledge.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-9 mx-auto">

                @foreach ($posts as $post)
                @if ($post->published_at>now())

                @else
                <div class="post-preview">
                    <a href="{{route("posts.show", $post->id)}}">
                        <h2 class="post-title">
                            {{$post->title}}
                        </h2>
                        <h3 class="post-subtitle">
                            {{$post->description}}
                        </h3>
                    </a>
                    <p class="post-meta">Posted at
                        {{$post->published_at}}
                        in {{$post->category->name}} category.</p>
                </div>
                <hr>
                @endif

                @endforeach

            </div>
            <div class="col-lg-4 col-md-3 mx-auto">
                <h4>Categories</h4>
                <ul class="list-group">

                    @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{route("categories.show", $category->id)}}"><small
                                style="font-size: 14px; list-style:none;">{{$category->name}}</small></a>
                        <span class="badge badge-primary badge-pill">{{$category->posts->count()}}<br />Posts</span>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">

                    <p class="copyright text-muted">Copyright &copy; Your Website 2019</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Custom scripts for this template -->
    <script src={{asset("js/clean-blog.min.js")}}></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('/assets/style/style.css') }}">
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <!-- forum -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="{{ asset('/assets/style/forumStyle.css') }}" rel="stylesheet">
    
    <title>{{ config('app.name')}} - @yield('title') </title>
</head>

<body>
    @php  $locale = session()->get('locale'); @endphp  <!-- // pure php in blade -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="{{route('etudiant.welcome')}}">ETUDOK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end custom-margin-right" id="navbarNav">
            <ul class="navbar-nav">
                @auth
                <li class="nav-item">
                <p class="nav-link"> @lang('Welcome'), {{ Auth::user()->name }} <p>
                </li>
                @endauth
                <li class="nav-item">
                <p> <p>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('etudiant.welcome')}}">@lang('Home')</a>
                </li>
                @auth
                
                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false"> Forum </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('article.index')}}">@lang('List of articles')</a></li>
                                <li><a class="dropdown-item" href="{{route('article.create')}}">@lang('Add an articles')</a></li>
                            
                            </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('fichier.index')}}">@lang('Document area')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('etudiant.index')}}">Admin -@lang('Students List')</a>
                </li>

                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('Contuct us')</a>
                </li>
                 
                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="fa-regular fa-user"></i></a>
                            <ul class="dropdown-menu">
                            @guest
                                <li><a class="dropdown-item" href="{{route('login')}}">@lang('Login')</a></li>
                                <li><a class="dropdown-item" href="{{route('etudiant.create')}}">@lang('Create an Account') <i class="fa-solid fa-user-plus"></i></a></li>
                            @else
                                <li><a class="dropdown-item" href="{{route('etudiant.show', Auth::user()->id)}}">@lang('My Account')</a></li>
                                <li><a class="dropdown-item" href="{{route('logout')}}">@lang('Logout')</a></li>
                            @endguest
                            </ul>
                </li>
                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false"><i class="nav-link fa-solid fa-earth-americas"></i>{{ session()->get('locale') == '' ? '' : "$locale"}} </a>
                            <ul class="dropdown-menu">
                            
                                <li><a class="dropdown-item" href="{{route('lang', 'fr')}}">FR</a></li>
                                <li><a class="dropdown-item" href="{{route('lang', 'en')}}">EN</a></li>
                            
                            </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--<div class="container my-5">

         @guest
            <p>Please log in with your account</p>
        @endguest 
    </div>-->
    <main>


        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @yield('content')

    </main>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <footer>

        &copy {{ date('Y')}} {{ config('app.name')}} - @lang('lang.text_copyright')
    </footer>


</body>





</html>
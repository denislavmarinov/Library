<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('/assets/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/main.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/main.css') }}">
</head>
<body>
    @if (Auth::check())
        @if (Route::currentRouteName() !== "homepage" && Auth::check() && Route::currentRouteName() !== "password_update")
            @yield('title')
            <div class="d-flex justify-content-center">
                @include('includes.user_menu')
            </div>
        @endif
    @endif
    <div class="container">
        @if (Route::currentRouteName() == "homepage" || !Auth::check() || Route::currentRouteName() == "password_update")
            @yield('title')
            @include('includes.menu')
        @endif
        @if (Session::has('message'))
           <div class="alert-{{Session::get('type')}}">
            <p>{{ Session::get('message') }}</p>
           </div>
        @endif
        @yield('content')
    </div>
</body>
</html>

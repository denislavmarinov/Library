<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <!-- Bootstrap 4.4.2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bootstrap.css') }}">
    <!-- Link for project stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/main.css') }}">
    <!-- Link for the font-family (Mali) -->
    <link href="https://fonts.googleapis.com/css2?family=Mali&display=swap" rel="stylesheet">
    <!-- jQuery 3.5.1 -->
    <script type="text/javascript" src="{{ asset('/assets/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="{{ asset('/assets/bootstrap.js') }}"></script>
    <!-- Bootstrap Bundle -->
    <script type="text/javascript" src="{{ asset('/assets/bootstrap.bundle.js') }}"></script>
    <!-- Project JavaScript file -->
    <script type="text/javascript" src="{{ asset('/assets/main.js') }}"></script>
</head>
<body>
    <div class="container">
        @yield('title')
        @include('includes.user_menu')
        @yield('content')
    </div>
</body>
</html>

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
</head>
<body>
    <div class="container">
        @yield('title')
        @include('includes.user_menu')
        @yield('content')
    </div>
</body>
</html>

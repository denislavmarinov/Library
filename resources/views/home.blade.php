@php
 	$title = "Homepage";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Welcome to our Library</h1>
    @endsection
@section('content')
    <p>Welcome to our library.</p>
    <p>Here you can read and view books from more than 1000 authors from different countries around the world.</p>
    <p>To start reading please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>. And remember have fun, while reading our books.</p>
@endsection

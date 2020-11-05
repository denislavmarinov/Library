@php
 	$title = "Homepage";
 @endphp
@extends('layouts/main')
@section('title')
    <h1 class="page_title">Welcome to our Library</h1>
@endsection
@if (Session::has('message'))
<script type="text/javascript">alert("{{ Session::get('message') }}");</script>
@endif
@section('content')
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
@endsection

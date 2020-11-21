@if (Auth::user()->role_id == '2')
	@php
	$page_heading = "Admin panel";
	@endphp
@else
	@php
	$page_heading = "User dashboard";
	@endphp
@endif
@php
	$title = $page_heading;
@endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">{{$page_heading}}</h1>
@endsection
@section('content')
<p></p>
<div class="row">
	<div class="col-5">
		<h4 class="text-center">Profile image</h4>
		<hr>
		@if (Auth::user()->image)
		<img style="border: 35px solid #ccc;" width="300" src="{{ asset('storage/' . Auth::user()->image)}}">
		<p></p>
		<a href="{{ route('change_user_image') }}">Change profile image</a>
		@else
			<a href="{{ route('change_user_image') }}">Add profile image</a>
		@endif
	</div>
	<div class="col-6">
		<p>Name: <span class="font-weight-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></p>
		<p>Email: <span class="font-weight-bold">{{ Auth::user()->email }}</span></p>
	</div>
</div>
@endsection

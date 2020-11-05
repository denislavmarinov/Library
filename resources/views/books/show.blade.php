@php
	$title = ucfirst(str_replace('_', ' ', $book->title)) . " book";
@endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">Book:  {{ ucfirst(str_replace('_', ' ', $book->title)) }}</h1>
@endsection
@section('content')
	<br>
	<h2 class="text-center">Title: {{ ucfirst($book->title) }}</h2>
	<hr>
	<div class="row">
		<div class="col-6">
			<p>Image 250 x 250</p>
		</div>
		<div class="col-6">
			<p>Description: </p>
			<p>{{ $book->short_content }}</p>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-6">
			<p>Author: <a href="route('authors.show', $book->author)">{{ $book->first_name}} {{ $book->last_name }}</a></p>
			<p>Genre: <a href="route('genre.show', $book->genre_id)">{{ $book->genre}}</a></p>
			<p>ISBN: {{ $book->isbn }} </p>
			<p>Pages: {{ $book->pages }}</p>
			<p>Edition: {{ $book->edition }}</p>
		</div>
		<div class="col-2 offset-2">
			<div class="col-2">
				<a href="" class="btn btn-outline-teal">Add to wishlist</a>
			</div>
			<p> </p><p> </p><p> </p>
			<div class="col-2">
				<a href="" class="btn btn-outline-cyan">Start reading</a>
			</div>
		</div>

	</div>
@endsection

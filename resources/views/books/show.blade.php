@php
	$title = ucfirst(str_replace('_', ' ', $book->title)) . " book";
@endphp
@extends('layouts.main')
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
			<p>Author: <a href="{{ route('authors.show', $book->author) }}">{{ $book->first_name}} {{ $book->last_name }}</a></p>
			<p>Genre: <a href="{{ route('genres.show', $book->genre_id) }}">{{ $book->genre}}</a></p>
			<p>ISBN: {{ $book->isbn }} </p>
			<p>Pages: {{ $book->pages }}</p>
			<p>Edition: {{ $book->edition }}</p>
		</div>
		<div class="col-4 offset-2">
			<div class="row">
				<div class="col-3">
					<a href="" class="btn btn-outline-teal">Add to wishlist</a>
				</div>
				<div class="col-3">
					<form method="post" action="{{ route('start_reading', $book->id) }}">
						@csrf
						<input type="submit" name="submit" value="Start reading" class="btn btn-outline-cyan">
					</form>
				</div>
			</div>
			<p> </p><p> </p><p> </p><p> </p><p> </p><p> </p>
			@if(Auth::user()->role_id == 2)
			<div class="row">
				<div class="col-3">
					<a href="{{route('books.edit', $book->id) }}" class="btn btn-outline-orange">Update</a>
				</div>
				<div class="col-3">
					<form action="{{route('books.destroy', $book->id) }}" method="post">
						@csrf
						@method('DELETE')
						<input type="submit" name="submit" value="Delete" class="btn btn-outline-danger">
					</form>
				</div>
			</div>
			@endif
		</div>
	</div>
@endsection

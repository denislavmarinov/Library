@php
	$title = 'Authors';
@endphp
@extends('layouts.main')
@section('title')
	<h1 class="page_title">All Authors</h1>
@endsection
@section('content')


<table class="table">
	<tr class="badge-success">
		<th>#</th>
		<th>Author name</th>
		<th>Date of birth</th>
		<th>Nationality</th>
		@if(Auth::user()->role_id == 2)	
			<th>Edit</th>
		@endif
	</tr>
	<tbody>
@php
    $num = 1;
@endphp
@foreach( $authors as $author )
	<tr>
		<td>{{ $num++ }}</td>
		<td><a href="{{ route('authors.show', $author->id) }}">{{ $author->author_name }}</a></td>
		<td><a href="{{ route('authors.show', $author->date_of_birth) }}">{{ $author->date_of_birth }}</a></td>
		<td><a href="{{ route('nationalities.show', $author->nationality) }}">{{ $author->nationality_name }}</a></td>
		@if(Auth::user()->role_id == 2)	
			<td><a href="{{ route('authors.edit', $author->id) }}">Edit</a></td>
		@endif
	</tr>
@endforeach
	</tbody>
</table>

@endsection

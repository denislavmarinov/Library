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
			<th>Delete</th>
		@endif
	</tr>
	<tbody>
@php
    $num = 1;
@endphp
@if (empty($authors[0]))
	<tr>
		<td colspan="6" class="text-center">No authors added in this app</td>
	</tr>
@endif
@foreach( $authors as $author )
	<tr>
		<td>{{ $num++ }}</td>
		<td><a href="{{ route('authors.show', $author->id) }}">{{ $author->author_name }}</a></td>
		<td style="color:#770202">{{ $author->date_of_birth }}</td>
		<td><a href="{{ route('nationalities.show', $author->nationality) }}">{{ $author->nationality_name }}</a></td>
		@if(Auth::user()->role_id == 2)
			<td><a href="{{ route('authors.edit', $author->id) }}" class="btn btn-outline-orange">Edit</a></td>
			<td>
				<form action="{{ route('authors.destroy', $author->id) }}" method="post">
					@csrf
					@method('DELETE')
					<input type="submit" name="submit" value="Delete" class="btn btn-outline-red">
				</form>
			</td>
		@endif
	</tr>
@endforeach
	</tbody>
</table>

@endsection

@php
    $title = "Genres";
 @endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">All genres</h1>
@endsection
@section('content')

<br>

<a href="{{ route('genres.create') }}">Add genre</a>
<table class="table">
	<tr>
		<th>#</th>
		<th>Genres</th>
		<th>Description</th>
		<th>Edit</th>
	</tr>	
	<tbody class="">
@php
    $num = 1;
@endphp		
@foreach( $genres as $genre )
	<tr>
		<td>{{ $num++ }}</td>
		<td><a href="{{ route('genres.show', $genre->id) }}">{{ $genre->genre }}</a></td>
		<td>{{ $genre->description }}</td>
		<td><a href="{{ route('genres.edit', $genre->id) }}">Edit</a></td>
	</tr>
@endforeach	

	</tbody>
</table>

@endsection
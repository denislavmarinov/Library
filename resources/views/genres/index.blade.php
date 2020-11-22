@php
    $title = "Genres";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">All genres</h1>
@endsection
@section('content')

<table class="table">
	<tr class="badge-success">
		<th>#</th>
		<th>Genres</th>
		<th>Description</th>
		@if(Auth::user()->role_id == 2)
			<th>Edit</th>
		@endif
	</tr>
	<tbody>
@php
    $num = 1;
@endphp
@foreach( $genres as $genre )
	<tr>
		<td>{{ $num++ }}</td>
		<td><a href="{{ route('genres.show', $genre->id) }}">{{ $genre->genre }}</a></td>
		<td>{{ $genre->description }}</td>
		@if(Auth::user()->role_id == 2)
			<td><a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-outline-orange">Edit</a></td>
		@endif
	</tr>
@endforeach

	</tbody>
</table>

@endsection

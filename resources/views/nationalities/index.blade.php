@php
	$title = 'Nationalities';
@endphp
@extends('layouts.main')
@section('title')
	<h1 class="page_title">All Nationalities</h1>
@endsection
@section('content')
<br>
<table class="table">
	<tr class="badge-success">
		<th>#</th>
		<th>Flag</th>
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
@foreach( $nationalities as $nationality )
	<tr>
		<td>{{ $num++ }}</td>
		<td><a href="{{ $nationality->history_link }}" target="__blank"><img width="50px" src="{{ asset('storage/' . $nationality->flag) }}"></a></td>
		<td><a href="{{ route('nationalities.show', $nationality->id) }}">{{ $nationality->nationality }}</a></td>
		@if(Auth::user()->role_id == 2)
			<td><a href="{{ route('nationalities.edit', $nationality->id) }}" class="btn btn-outline-orange">Edit</a></td>
			<td>
				<form action="{{ route('nationalities.destroy', $nationality->id) }}" method="post">
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

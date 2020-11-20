@php
	$title = 'Nationalities';
@endphp
@extends('layouts.main')
@section('title')
	<h1 class="page_title">All Nationalities</h1>
@endsection
@section('content')


<table class="table">
	<tr class="badge-success">
		<th>#</th>
		<th>Nationality</th>
		<th>History link</th>
		<th>Flag</th>
		@if(Auth::user()->role_id == 2)	
			<th>Edit</th>
		@endif	
	</tr>
	<tbody>
@php
    $num = 1;
@endphp
@foreach( $nationalities as $nationality )
	<tr>
		<td>{{ $num++ }}</td>
		<td><a href="{{ route('nationalities.show', $nationality->id) }}">{{ $nationality->nationality }}</a></td>
		<td><a href="{{ $nationality->history_link }}">Link</a></td>
		<td><a href="{{ route('nationalities.show', $nationality->id) }}">{{ $nationality->nationality }}</a></td>
		@if(Auth::user()->role_id == 2)	
			<td><a href="{{ route('nationalities.edit', $nationality->id) }}">Edit</a></td>
		@endif
	</tr>
@endforeach
	</tbody>
</table>

@endsection

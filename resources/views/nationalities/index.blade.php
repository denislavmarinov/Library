@php
	$title = 'Nationalities';
@endphp
@extends('layouts.main')
@section('title')
	<h1 class="page_title">All Nationalities</h1>
@endsection
@section('content')

<br>
<a href="{{ route('nationalities.create') }}" class="btn btn-outline-primary">Add nationality</a>
<table class="table">
	<tr class="badge-primary">
		<th>#</th>
		<th>Nationality</th>
		<th>History link</th>
		<th>Flag</th>
		<th>Update</th>
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
	</tr>
@endforeach
	</tbody>
</table>

@endsection

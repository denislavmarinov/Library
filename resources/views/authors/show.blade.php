@php
	$title = ucfirst(str_replace('_', ' ', $author->author_name)) . " author";
@endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Author:  {{ ucfirst(str_replace('_', ' ', $author->author_name)) }}</h1>
@endsection
@section('content')
<br>
	<div class="row">
		<div class="col-6">
			<img style="border: 35px solid #ccc;" width="500" src="{{ asset('storage/' . $author->image)}}">
		</div>
		<div class="col-6">
			<p>Biographic: </p>
			<p>{{ $author->biographic }}</p>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-6">
			<p>Books count: {{ $books }}</p>
			<p>Nationality: <a href="{{ route('nationalities.show', $author->nationality) }}"> {{ $author->nationality_name }}</a></p>
			<p>Date of birthday: {{ $author->date_of_birth }}</p>
			<p>Date of death: {{ $author->date_of_death }}</p>
		</div>
	</div>
@endsection

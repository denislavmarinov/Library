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
	</div>
	<div class="col-6">
		<p>Date of birthday: {{ $author->date_of_birth }}</p>
		<p>Date of death: {{ $author->date_of_death }}</p>
	</div>
</div>
<table class="table">
    <tr class="badge-red">
        <td>#</td>
        <td>Book</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if (count($all_books) === 0)
        <tr>
            <td colspan="2" class="text-center">There is no books from this author!!!</td>
        </tr>
    @endif

    @foreach ($all_books as $book)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
        </tr>
    @endforeach
</table>
@endsection

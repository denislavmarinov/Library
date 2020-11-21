@php
    $title = "Readlist";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Readlist</h1>
@endsection
@section('content')
<table class="table">
    <tr class="badge-success">
        <td>#</td>
        <td>Book name</td>
        <td>Book description</td>
        <td>Book genre</td>
        <td>Book author</td>
        <td>Edition</td>
        <td>Book pages</td>
        <td>Up to page</td>
        <td>Started to read</td>
        <td>Ended to read</td>
        <td>Delete from readlist</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if ($books->count() === 0)
        <tr>
            <td colspan="10" class="text-center">No books in readlist! <a href="{{ route('books.index') }}">Add</a> some now</td>
        </tr>
    @endif
    @foreach ($books as $book)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('read_book', $book->id) }}">{{ $book->title }}</a></td>
            <td type="button" data-toggle="tooltip" data-placement="top" title="To see more click on the book title"> {{ str_split($book->short_content, 20)[0] }} ...</td>
            <td><a href="route('genre.show', $book->genre)"> {{ $book->genre }}</a> </td>
            <td><a href="route('author.show', $book->author)"> {{ $book->first_name  }} {{$book->last_name}}</a> </td>
            <td> {{ $book->edition }} </td>
            <td> {{ $book-> pages}} </td>
            <td> {{ $book->up_to_page }}</td>
            <td>{{ $book->started_to_read->diffForHumans() }}</td>
            <td>{{ ($book->ended_to_read == null) ? 'Still in reading' :  $book->ended_to_read->diffForHumans() }}</td>
            <td>
            	<form action="{{ route('delete_from_readlist', $book->id) }}" method="post">
            		@csrf
            		<input type="submit" name="submit" class="btn btn-outline-danger" value="Delete from readlist">
            	</form>
            </td>
        </tr>
    @endforeach
</table>
@endsection

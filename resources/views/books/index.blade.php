@php
    $title = "Books";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">All books</h1>
@endsection
@section('content')
<br>
{!! Form::open(['route' => ['books.index'], 'method' => 'get']) !!}
<div class="row d-flex justify-content-center" style="margin: 10px;">
    <div class="col-5">
        <span class="col-2">Sort by:</span>
        {!! Form::select('sort_by', ['title' => 'Book name', 'isbn' => 'ISBN', 'pages' => 'Pages', 'authors.first_name' => 'Author name', 'genres.genre' => 'Genre'], (isset($_GET['sort_by']) && !empty($_GET['sort_order'])) ? $_GET['sort_by'] : null, ['class' => 'custom-select filters', 'placeholder' => 'Sort by ...']) !!}
        {!! Form::select('sort_order', ['asc' => 'From A to Z', 'desc' => 'From Z to A'], (isset($_GET['sort_order']) && !empty($_GET['sort_by'])) ? $_GET['sort_order'] : null, ['class' => 'custom-select filters', 'placeholder' => 'Sort order ...']) !!}
    </div>
    <div class="col-5">
        <span class="col-2">Search by book name:</span>
        {!! Form::text('filter', (isset($_GET['filter'])) ? $_GET['filter'] : null, ['placeholder' => 'Book name', 'class' => 'form-control filters']) !!}
    </div>
    <div class="col-2">
        {!! Form::submit('Search', ['class' => 'btn btn-outline-orange']) !!}
        <a class="btn btn-outline-danger" href="{{ route('books.index') }}">Clear</a>
    </div>
</div>
{!! Form::close() !!}
<table class="d-flex justify-content-center table">
    <tr class="badge-success">
        <td>#</td>
        <td>Book name</td>
        <td>Book description</td>
        <td>Book isbn</td>
        <td>Book pages</td>
        <td>Needed days to read</td>
        <td>Book author</td>
        <td>Book genre</td>
        <td>Add to wishlist</td>
        <td>Start reading</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if ($books->count() == 0)
        <tr>
            <td colspan="10" class="text-center">No match!!!</td>
        </tr>
    @endif
    @foreach ($books as $book)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
            <td type="button" data-toggle="tooltip" data-placement="top" title="To see more click on the book title"> {{ str_split($book->short_content, 20)[0] }} ...</td>
            <td> {{ $book->isbn }} </td>
            <td> {{ $book-> pages }} </td>
            <td>{{ $read_speed == 0 ? 'You will need to start reading first' : ceil($book->pages /  $read_speed) }}</td>
            <td><a href="{{ route('authors.show', $book->author)}}"> {{ $book->first_name  }} {{$book->last_name}}</a> </td>
            <td><a href="{{route('genres.show', $book->genre)}}"> {{ $book->genre }}</a> </td>
            <td>
                <form method="post" action="{{ route('wishlists.store') }}">
                    @csrf
                    <input type="hidden" name="book_id" value="{{$book->id}}">
                    <input type="submit" name="submit" value="Add to wishlist" class="btn btn-outline-teal">
                </form>
            </td>
            <td>
                <form method="post" action="{{ route('start_reading', $book->id) }}">
                    @csrf
                    <input type="submit" name="submit" value="Start reading" class="btn btn-outline-cyan">
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection

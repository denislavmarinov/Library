@php
    $title = "Books";
 @endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">All books</h1>
@endsection
@section('content')
@if (Session::has('message'))
    <script type="text/javascript">alert('{{ Session::get('message' )}}');</script>
@endif
<p>
    <a href="{{ route('books.create') }}">Add book</a>
</p>
{!! Form::open(['route' => ['books.index'], 'method' => 'get']) !!}
<div class="row">
    <div class="col-5">
        <span class="col-2">Sort by:</span>
        {!! Form::select('sort_by', ['title' => 'Book name', 'isbn' => 'ISBN', 'pages' => 'Pages'], (isset($_GET['sort_by']) && !empty($_GET['sort_order'])) ? $_GET['sort_by'] : null, ['class' => 'custom-select filters', 'placeholder' => 'Sort by ...']) !!}
        {!! Form::select('sort_order', ['asc' => 'From A to Z', 'desc' => 'From Z to A'], (isset($_GET['sort_order']) && !empty($_GET['sort_by'])) ? $_GET['sort_order'] : null, ['class' => 'custom-select filters', 'placeholder' => 'Sort order ...']) !!}
    </div>
    <div class="col-5">
        <span class="col-2">Search by book name:</span>
        {!! Form::text('filter', (isset($_GET['filter'])) ? $_GET['filter'] : null, ['placeholder' => 'Book name', 'class' => 'form-control filters']) !!}
    </div>
    <div class="col-2">
        {!! Form::submit('Search', ['class' => 'btn btn-outline-warning']) !!}
        <a class="btn btn-outline-danger" href="{{ route('books.index') }}">Clear</a>
    </div>
</div>
{!! Form::close() !!}
<br>
<table class="table">
    <tr>
        <td>#</td>
        <td>Book name</td>
        <td>Book description</td>
        <td>Book isbn</td>
        <td>Book pages</td>
        <td>Book author</td>
        <td>Book genre</td>
        <td>Add to wishlist</td>
        <td>Start reading</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if ($books->count() === 0)
        <tr>
            <td colspan="9" class="text-center">No match!!!</td>
        </tr>
    @endif
    @foreach ($books as $book)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
            <td type="button" data-toggle="tooltip" data-placement="top" title="To see more click on the book title"> {{ str_split($book->short_content, 20)[0] }} ...</td>
            <td> {{ $book->isbn }} </td>
            <td> {{ $book-> pages}} </td>
            <td><a href="route('author.show', $book->author)"> {{ $book->first_name  }} {{$book->last_name}}</a> </td>
            <td><a href="route('genre.show', $book->genre)"> {{ $book->genre }}</a> </td>
            <td> <a href="" class="btn btn-outline-teal">Add to wishlist</a> </td>
            <td> <a href="" class="btn btn-outline-cyan">Start reading</a> </td>
        </tr>
    @endforeach
</table>
@endsection

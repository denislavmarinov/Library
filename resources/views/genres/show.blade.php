@php
    $title = "Show genre";
 @endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">Show genre</h1>
@endsection
@section('content')
<h2>{{ $genre[0]->genre }}</h2>
<p>{{ $genre[0]->description }}</p>

<hr>
<table class="table">
    <tr>
        <td>#</td>
        <td>Book name</td>
        <td>Book description</td>
        <td>Book isbn</td>
        <td>Book pages</td>
        <td>Book author</td>
        <td>Add to wishlist</td>
        <td>Start reading</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if ($genre->count() === 0)
        <tr>
            <td colspan="8" class="text-center">No match!!!</td>
        </tr>
    @endif
    @foreach ($genre as $book)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('books.show', $book->book_id) }}">{{ $book->title }}</a></td>
            <td type="button" data-toggle="tooltip" data-placement="top" title="To see more click on the book title"> {{ str_split($book->short_content, 20)[0] }} ...</td>
            <td> {{ $book->isbn }} </td>
            <td> {{ $book-> pages}} </td>
            <td><a href="route('author.show', $book->author)"> {{ $book->first_name  }} {{$book->last_name}}</a> </td>
            <td> <a href="" class="btn btn-outline-teal">Add to wishlist</a> </td>
            <td>
                <form method="post" action="{{ route('start_reading', $book->book_id) }}">
                    @csrf
                    <input type="submit" name="submit" value="Start reading" class="btn btn-outline-cyan">
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection
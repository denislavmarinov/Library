@php
    $title = "Wishlist";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Wishlist</h1>
@endsection
@section('content')
<br>
<table class="table">
    <tr>
        <td>#</td>
        <td>Book name</td>
        <td>Book author</td>
        <td>Remove from wishlist</td>
        <td>Start reading</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if ($wishlist->count() === 0)
        <tr>
            <td colspan="5" class="text-center">No books in wishlist!!!</td>
        </tr>
    @endif
    @foreach ($wishlist as $book)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td>
            <td><a href="route('author.show', $book->author)"> {{ $book->first_name  }} {{$book->last_name}}</a> </td>
            <td>
                <form action="{{route('wishlists.destroy', $book->wishlist)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="submit" name="submit" value="Remove from wishlist" class="btn btn-outline-red">
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

@php
    $title = "Show nationalities";
 @endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">Show nationalities</h1>
@endsection
@section('content')
<h2>{{ $nationality[0]->nationality }}</h2>
<p>{{ $nationality[0]->history_link }}</p>
<p>{{ $nationality[0]->flag }}</p>

<hr>
<table class="table">
    <tr>
        <td>#</td>
        <td>Authors</td>
        <td>Nationality</td>
        <td>Books</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if ($nationality->count() === 0)
        <tr>
            <td colspan="4" class="text-center">No match!!!</td>
        </tr>
    @endif

    @for( $i=0; $i < count($nationality); $i++) 
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="route('author.show', $book->author)"> {{ $nationality[$i]->first_name  }} {{$nationality[$i]->last_name}}</a></td>
            <td>{{ $nationality[$i]->nationality }}</td>
            <td>{{ $authors_books[$i]['count_of_books'] }}</td>
        </tr>
    @endfor
</table>

@endsection
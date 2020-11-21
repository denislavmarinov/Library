@php
    $title = "Show nationalities";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Show nationalities</h1>
@endsection
@section('content')
<br>
<div class="row">
    <div class="col-6">
        <h2>Country:
            <a href="{{ $nationality[0]->history_link }}" target="__blank">
                <img width="70" src="{{ asset('storage/' . $nationality[0]->flag)}}">
            </a>
            {{ $nationality[0]->nationality }}
        </h2>
    </div>
    @if (Auth::user()->role_id == 2)
        <div class="col-3">
            <a href="{{ route('nationalities.edit', $nationality[0]->nationality_id) }}" class="btn btn-outline-orange">Edit</a>
       </div>
       <div class="col-3">
            <form action="{{ route('nationalities.destroy', $nationality[0]->nationality_id) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" name="submit" value="Delete" class="btn btn-outline-red">
            </form>
        </div>
    @endif
</div>
<hr>
<h2 class="text-center">Authors with this nationality</h2>
<table class="table">
    <tr class="badge-red">
        <td>#</td>
        <td>Authors</td>
        <td>Books</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @if (count($authors_books) === 0)
        <tr>
            <td colspan="3" class="text-center">No authors with this nationality!!!</td>
        </tr>
    @endif

    @for ( $i=0; $i < count($authors_books); $i++)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{route('authors.show', $authors_books[$i]->author)}}"> {{ $authors_books[$i]->first_name  }} {{ $authors_books[$i]->last_name }}</a></td>
            <td>{{ $authors_books[$i]->book_count }}</td>
        </tr>
    @endfor
</table>

@endsection

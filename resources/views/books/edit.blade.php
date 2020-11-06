@php
    $title = "Update book";
 @endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">Update book</h1>
@endsection
@section('content')
@if (Session::has('message'))
    <script type="text/javascript">alert('{{ Session::get('message' )}}');</script>
@endif
<br>
{!! Form::open(['route' => ['books.update', $book->first()->id], 'method' => 'put']) !!}
<!-- Title  -->
@if ($errors->has('title'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('title')[0] }}</strong>
    </span>
@endif
{!! Form::label('title', 'The book title: ', ['class' => 'form-control-label']) !!}
{!! Form::text('title', $book->first()->title, ['placeholder' => 'Title', 'class' => 'form-control']) !!}
<br>
<!-- ISBN -->
@if ($errors->has('isbn'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('isbn')[0] }}</strong>
    </span>
@endif
{!! Form::label('isbn', 'The book ISBN: ', ['class' => 'form-control-label']) !!}
{!! Form::text('isbn', $book->first()->isbn, ['placeholder' => 'ISBN', 'class' => 'form-control']) !!}
<br>
<!-- Pages -->
@if ($errors->has('pages'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('pages')[0] }}</strong>
    </span>
@endif
{!! Form::label('pages', 'The book pages: ', ['class' => 'form-control-label']) !!}
{!! Form::text('pages', $book->first()->pages, ['placeholder' => 'Pages', 'class' => 'form-control']) !!}
<br>
<!-- Short content -->
@if ($errors->has('short_content'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('short_content')[0] }}</strong>
    </span>
@endif
{!! Form::label('short_content', 'The book short content: ', ['class' => 'form-control-label']) !!}
{!! Form::textarea('short_content', $book->first()->short_content, ['class' => 'form-control']) !!}
<br>
<!-- Author -->
@if ($errors->has('author'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('author')[0] }}</strong>
    </span>
@endif
{!! Form::label('author', 'The book author: ', ['class' => 'form-control-label']) !!}
{!! Form::select('author', $authors, $book->first()->author,  ['class' => 'custom-select', 'placeholder' => 'Choose author']) !!}
<br>
<!-- Edition -->
@if ($errors->has('edition'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('edition')[0] }}</strong>
    </span>
@endif
{!! Form::label('edition', 'The book edition: ', ['class' => 'form-control-label']) !!}
{!! Form::text('edition', $book->first()->edition, ['placeholder' => 'Edition', 'class' => 'form-control']) !!}
<br>
<!-- Genre -->
@if ($errors->has('genre'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('genre')[0] }}</strong>
    </span>
@endif
{!! Form::label('genre', 'The book genre: ', ['class' => 'form-control-label']) !!}
{!! Form::select('genre', $genres, $book->first()->genre,  ['class' => 'custom-select', 'placeholder' => 'Choose genre']) !!}
<br>
{!! Form::submit('Update book', ['class' => 'btn btn-outline-teal']) !!}
{!! Form::close() !!}
@endsection

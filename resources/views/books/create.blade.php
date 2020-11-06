@php
    $title = "Add book";
 @endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">Add book</h1>
@endsection
@section('content')
@if (Session::has('message'))
    <script type="text/javascript">alert('{{ Session::get('message' )}}');</script>
@endif
<br>
{!! Form::open(['route' => 'books.store']) !!}
<!-- Title  -->
@if ($errors->has('title'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('title')[0] }}</strong>
    </span>
@endif
{!! Form::label('title', 'The book title: ', ['class' => 'form-control-label']) !!}
{!! Form::text('title', old('title'), ['placeholder' => 'Title', 'class' => 'form-control']) !!}
<br>
<!-- ISBN -->
@if ($errors->has('isbn'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('isbn')[0] }}</strong>
    </span>
@endif
{!! Form::label('isbn', 'The book ISBN: ', ['class' => 'form-control-label']) !!}
{!! Form::text('isbn', old('isbn'), ['placeholder' => 'ISBN', 'class' => 'form-control']) !!}
<br>
<!-- Pages -->
@if ($errors->has('pages'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('pages')[0] }}</strong>
    </span>
@endif
{!! Form::label('pages', 'The book pages: ', ['class' => 'form-control-label']) !!}
{!! Form::text('pages', old('pages'), ['placeholder' => 'Pages', 'class' => 'form-control']) !!}
<br>
<!-- Short content -->
@if ($errors->has('short_content'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('short_content')[0] }}</strong>
    </span>
@endif
{!! Form::label('short_content', 'The book short content: ', ['class' => 'form-control-label']) !!}
{!! Form::textarea('short_content', old('short_conteny'), ['class' => 'form-control']) !!}
<br>
<!-- Author -->
@if ($errors->has('author'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('author')[0] }}</strong>
    </span>
@endif
{!! Form::label('author', 'The book author: ', ['class' => 'form-control-label']) !!}
{!! Form::select('author', $authors, old('auhhor'),  ['class' => 'custom-select', 'placeholder' => 'Choose author']) !!}
<br>
<!-- Edition -->
@if ($errors->has('edition'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('edition')[0] }}</strong>
    </span>
@endif
{!! Form::label('edition', 'The book edition: ', ['class' => 'form-control-label']) !!}
{!! Form::text('edition', old('edition'), ['placeholder' => 'Edition', 'class' => 'form-control']) !!}
<br>
<!-- Genre -->
@if ($errors->has('genre'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('genre')[0] }}</strong>
    </span>
@endif
{!! Form::label('genre', 'The book genre: ', ['class' => 'form-control-label']) !!}
{!! Form::select('genre', $genres, old('genre'),  ['class' => 'custom-select', 'placeholder' => 'Choose genre']) !!}
<br>
<!-- File -->
@if ($errors->has('book_file'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('book_file')[0] }}</strong>
    </span>
@endif
{!! Form::label('book_file', 'The book: ', ['class' => 'form-control-label']) !!}
{!! Form::file('book_file', ['class' => 'form-control-file']) !!}
<br>
{!! Form::submit('Add book', ['class' => 'btn btn-outline-teal']) !!}
{!! Form::close() !!}
@endsection

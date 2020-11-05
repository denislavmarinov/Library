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
{!! Form::label('title', 'The book title: ', ['class' => 'form-control-label']) !!}
{!! Form::text('title', '', ['placeholder' => 'Title', 'class' => 'form-control']) !!}
<br>
<!-- ISBN -->
{!! Form::label('isbn', 'The book ISBN: ', ['class' => 'form-control-label']) !!}
{!! Form::text('isbn', '', ['placeholder' => 'ISBN', 'class' => 'form-control']) !!}
<br>
<!-- Pages -->
{!! Form::label('pages', 'The book pages: ', ['class' => 'form-control-label']) !!}
{!! Form::text('pages', '', ['placeholder' => 'Pages', 'class' => 'form-control']) !!}
<br>
<!-- Short content -->
{!! Form::label('short_content', 'The book short content: ', ['class' => 'form-control-label']) !!}
{!! Form::textarea('short_content', '', ['class' => 'form-control']) !!}
<br>
<!-- Author -->
{!! Form::label('author', 'The book author: ', ['class' => 'form-control-label']) !!}
{!! Form::select('author', $authors, null,  ['class' => 'custom-select', 'placeholder' => 'Choose author']) !!}
<br>
<!-- Edition -->
{!! Form::label('edition', 'The book edition: ', ['class' => 'form-control-label']) !!}
{!! Form::text('edition', '', ['placeholder' => 'Title', 'class' => 'form-control']) !!}
<br>
<!-- Genre -->
{!! Form::label('genre', 'The book genre: ', ['class' => 'form-control-label']) !!}
{!! Form::select('genre', $genres, null,  ['class' => 'custom-select', 'placeholder' => 'Choose genre']) !!}
<br>
<!-- File -->
{!! Form::label('book_file', 'The book: ', ['class' => 'form-control-label']) !!}
{!! Form::file('book_file', ['class' => 'form-control-file']) !!}
<br>
{!! Form::submit('Add book', ['class' => 'btn btn-outline-teal']) !!}
{!! Form::close() !!}
@endsection

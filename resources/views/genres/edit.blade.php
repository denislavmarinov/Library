@php
    $title = "Edit Genres";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Edit genres</h1>
@endsection
@section('content')

{!! Form::open(['route' => ['genres.update', $genre->id], 'method' => 'put' ]) !!}
<!-- Genre name  -->
@if ($errors->has('genre'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('genre')[0] }}</strong>
    </span>
@endif
{!! Form::label('genre', 'Genre name: ', ['class' => 'form-control-label']) !!}
{!! Form::text('genre', $genre->genre, ['placeholder' => 'genre', 'class' => 'form-control']) !!}
<br>
<!-- Description -->
@if ($errors->has('description'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('description')[0] }}</strong>
    </span>
@endif
{!! Form::label('description', 'Description: ', ['class' => 'form-control-label']) !!}
{!! Form::textarea('description', $genre->description, ['placeholder' => 'description', 'class' => 'form-control']) !!}
<br>
{!! Form::submit('Add genre', ['class' => 'btn btn-outline-teal']) !!}
{!! Form::close() !!}
@endsection

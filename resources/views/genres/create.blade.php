@php
    $title = "Add Genres";
 @endphp
@extends('layouts/user')
@section('title')
    <h1 class="page_title">Add genres</h1>
@endsection
@section('content')

{!! Form::open(['route' => 'genres.store']) !!}
<!-- Genre name  -->
@if ($errors->has('genre'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('genre')[0] }}</strong>
    </span>
@endif
{!! Form::label('genre', 'Genre name: ', ['class' => 'form-control-label']) !!}
{!! Form::text('genre', old('genre'), ['placeholder' => 'genre', 'class' => 'form-control']) !!}
<br>
<!-- Description -->
@if ($errors->has('description'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('description')[0] }}</strong>
    </span>
@endif
{!! Form::label('description', 'Description: ', ['class' => 'form-control-label']) !!}
{!! Form::textarea('description', old('description'), ['placeholder' => 'description', 'class' => 'form-control']) !!}
<br>
{!! Form::submit('Add genre', ['class' => 'btn btn-outline-teal']) !!}
{!! Form::close() !!}
@endsection
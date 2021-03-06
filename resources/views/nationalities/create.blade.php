@php
    $title = "Add Nationalities";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Add nationalities</h1>
@endsection
@section('content')

{!! Form::open(['route' => 'nationalities.store', 'enctype' => 'multipart/form-data']) !!}
<!-- Nationality name  -->
@if ($errors->has('nationality'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('nationality')[0] }}</strong>
    </span>
@endif
{!! Form::label('nationality', 'Nationality name: ', ['class' => 'form-control-label']) !!}
{!! Form::text('nationality', old('nationality'), ['placeholder' => 'nationality', 'class' => 'form-control']) !!}
<br>
@if ($errors->has('history_link'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('history_link')[0] }}</strong>
    </span>
@endif
{!! Form::label('history_link', 'History link: ', ['class' => 'form-control-label']) !!}
{!! Form::text('history_link', old('history_link'), ['placeholder' => 'History link', 'class' => 'form-control']) !!}
<br>
@if ($errors->has('flag'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('flag')[0] }}</strong>
    </span>
@endif
{!! Form::label('flag', 'Flag: ', ['class' => 'form-control-label']) !!}
{!! Form::file('flag', ['class' => 'form-control-file']) !!}
<br>
{!! Form::submit('Add nationality', ['class' => 'btn btn-outline-success']) !!}
{!! Form::close() !!}
@endsection

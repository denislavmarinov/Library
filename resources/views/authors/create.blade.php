@php
    $title = "Add author";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Add author</h1>
@endsection
@section('content')
<br>
{!! Form::open(['route' => ['authors.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
<!-- Author first name  -->
@if ($errors->has('first_name'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('first_name')[0] }}</strong>
    </span>
@endif
{!! Form::label('first_name', 'The first name:', ['class' => 'form-control-label']) !!}
{!! Form::text('first_name', old('first_name'), ['class' => 'form-control']) !!}
<br>
<!-- Author last name  -->
@if ($errors->has('last_name'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('last_name')[0] }}</strong>
    </span>
@endif
{!! Form::label('last_name', 'The last name:', ['class' => 'form-control-label']) !!}
{!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}
<br>
<!-- Birthday -->
@if ($errors->has('date_of_birth'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('date_of_birth')[0] }}</strong>
    </span>
@endif
{!! Form::label('date_of_birth', 'Birthday: ', ['class' => 'form-control-label']) !!}
{!! Form::text('date_of_birth', old('date_of_birth'), ['class' => 'form-control']) !!}
<br>
<!-- Date of death -->
@if ($errors->has('date_of_death'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('date_of_death')[0] }}</strong>
    </span>
@endif
{!! Form::label('date_of_death', 'Day of death: ', ['class' => 'form-control-label']) !!}
{!! Form::text('date_of_death', old('date_of_death'), ['class' => 'form-control']) !!}
<br>
<!-- Nationality -->
@if ($errors->has('nationality'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('nationality')[0] }}</strong>
    </span>
@endif
{!! Form::label('nationality', 'Nationality: ', ['class' => 'form-control-label']) !!}
{!! Form::select('nationality', $nationalities, old('nationality'), ['class' => 'custom-select']) !!}
<br>
<!-- Biographic -->
@if ($errors->has('biographic'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('biographic')[0] }}</strong>
    </span>
@endif
{!! Form::label('biographic', 'The biogprahic author:', ['class' => 'form-control-label']) !!}
{!! Form::textarea('biographic', old('biographic'), ['class' => 'form-control']) !!}
<br><br>
<!-- Image -->
@if ($errors->has('image'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('image')[0] }}</strong>
    </span>
@endif
{!! Form::label('image', 'Image: ', ['class' => 'form-control-label']) !!}
{!! Form::file('image', ['class' => 'form-control-file']) !!}
<br>
{!! Form::submit('Update author', ['class' => 'btn btn-outline-teal']) !!}
{!! Form::close() !!}
@endsection

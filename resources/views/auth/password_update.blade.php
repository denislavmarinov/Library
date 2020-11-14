@php
$title = "Password update";
@endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Password update</h1>
@endsection
@section('content')
<p>You see this page because your password is old and you should change it. This will ensure that your profile is secured.</p>
{!! Form::open(['route' => ['password_update_store'], 'method' => 'put']) !!}
@if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('password')[0] }}</strong>
    </span>
@endif
{!! Form::label('password', 'New password', ['class' => 'form-control-label']) !!}
{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'New password']) !!}
@if ($errors->has('password_confirmation'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('password_confirmation')[0] }}</strong>
    </span>
@endif
{!! Form::label('password_confirmation', 'Repeat new password', ['class' => 'form-control-label']) !!}
{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat new password']) !!}
<p></p>
{!! Form::submit('Change', ['class' => 'btn btn-outline-orange']) !!}
{!! Form::close() !!}
@endsection

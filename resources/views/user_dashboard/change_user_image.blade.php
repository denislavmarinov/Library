@php
	$title = 'Change user image';
@endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">{{$title}}</h1>
@endsection
@section('content')
{!! Form::open(['route' => 'change_user_image_action', 'method' => 'PATCH', 'enctype' => 'multipart/form-data' ]) !!}
@if ($errors->has('image'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('image')[0] }}</strong>
    </span>
@endif
<p style="margin-top: 15px;"></p>
<div class="row">
	<div class="col-{{ Auth::user()->image ? 6 : 12 }}">
		{!! Form::label('image', 'Image:', ['class' => 'form-control-label']) !!}
		{!! Form::file('image', ['class' => 'form-control-file']) !!}
	</div>
	@if (Auth::user()->image)
	<div class="col-6">
		<p>Old image:</p>
		<img width="300" src="{{ asset('storage/' . Auth::user()->image)}}">
	</div>
	@endif
</div>
<p></p>
{!! Form::submit('Update', ['class' => 'btn btn-outline-orange']) !!}
{!! Form::close() !!}
@endsection

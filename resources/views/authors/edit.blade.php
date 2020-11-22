@php
    $title = "Edit author";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Edit author</h1>
@endsection
@section('content')
<br>
{!! Form::open(['route' => ['authors.update', $author[0]->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
<!-- Author first name  -->
@if ($errors->has('first_name'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('first_name')[0] }}</strong>
    </span>
@endif
{!! Form::label('first_name', 'The first name:', ['class' => 'form-control-label']) !!}
{!! Form::text('first_name', $author[0]->first_name, ['class' => 'form-control']) !!}
<br>
<!-- Author last name  -->
@if ($errors->has('last_name'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('last_name')[0] }}</strong>
    </span>
@endif
{!! Form::label('last_name', 'The last name:', ['class' => 'form-control-label']) !!}
{!! Form::text('last_name', $author[0]->last_name, ['class' => 'form-control']) !!}
<br>
<!-- Birthday -->
@if ($errors->has('date_of_birth'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('date_of_birth')[0] }}</strong>
    </span>
@endif
{!! Form::label('date_of_birth', 'Birthday: ', ['class' => 'form-control-label']) !!}
{!! Form::text('date_of_birth', $author[0]->date_of_birth, ['class' => 'form-control']) !!}
<br>
<!-- Date of death -->
@if ($errors->has('date_of_death'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('date_of_death')[0] }}</strong>
    </span>
@endif
{!! Form::radio('death_or_not', 'false',true, ['id' => 'alive']) !!}
{!! Form::label('alive', "Alive") !!}
<br>
{!! Form::radio('death_or_not', 'true', false,  ['id' => 'death']) !!}
{!! Form::label('death', "Death") !!}
<div id='alive_div'>
    <input type='hidden' value='' name='date_of_death'>
</div>
<br>
<!-- Nationality -->
@if ($errors->has('nationality'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('nationality')[0] }}</strong>
    </span>
@endif
{!! Form::label('nationality', 'Nationality: ', ['class' => 'form-control-label']) !!}
{!! Form::select('nationality', $nationalities, $author[0]->nationality, ['class' => 'custom-select']) !!}
<br>
<!-- Biographic -->
@if ($errors->has('biographic'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->get('biographic')[0] }}</strong>
    </span>
@endif
{!! Form::label('biographic', 'The biogprahic author:', ['class' => 'form-control-label']) !!}
{!! Form::textarea('biographic', $author[0]->biographic, ['class' => 'form-control']) !!}
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
{!! Form::submit('Edit author', ['class' => 'btn btn-outline-teal']) !!}
{!! Form::close() !!}
<script type="text/javascript">
    $("input[name='death_or_not']").on('change', function(e) {
        $('#death_div').remove();
        $('#alive_div').remove();
        e.preventDefault();
        if ($(this).attr('id') == "alive"){
            let str = "<div id='alive_div'><input type='hidden' value=' ' name='date_of_death'></div>" ;
            $("form").append(str);
            $('#death_div').remove();
        }else{
            let str = "<div id='death_div'><label for='date_of_death' class='form-control-label'>Day of death: </label><input class='form-control' name='date_of_death' type='date' id='date_of_death' value='{{$author[0]->date_of_death}}'><br></div>";
            $("label[for='death']").after(str);
            $('#alive_div').remove();
        }
    })
</script>
@endsection

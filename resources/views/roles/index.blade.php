@php
    $title = "Roles";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Roles</h1>
@endsection
@section('content')
<table class="table">
    <tr class="badge-success">
        <td>#</td>
        <td>Role name</td>
        <td>Users whit this role</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @foreach ($roles as $role)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('roles.show', $role->id) }}">{{ucfirst(str_replace('_', ' ', $role->role )) }}</a></td>
            <td>{{ $role->users->count() }}</td>
        </tr>
    @endforeach
</table>
@endsection

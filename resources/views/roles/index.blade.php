<?php $title = "Roles"; ?>
@extends('layouts/main')
@section('title')
    <h1 class="page_title">Roles</h1>
@endsection
@section('content')
<table class="table">
    <tr>
        <td>#</td>
        <td>Role name</td>
        <td>Users whit this role</td>
        <td>Update</td>
        <td>Delete</td>
    </tr>
    <?php $num = 1; ?>
    @foreach ($roles as $role)
        <tr>
            <td>{{ $num++ }}</td>
            <td><a href="{{ route('roles.show', $role->id) }}">{{ $role->role }}</a></td>
            <td>{{ $role->user->count() }}</td>
            <td><a class="btn btn-outline-warning" href="{{ route('roles.edit', $role->id) }}">Update</a></td>
            <td><button class="delete btn btn-outline-danger" data-id="{{ $role->id }}">Delete</button></td>
        </tr>
    @endforeach
</table>
@endsection

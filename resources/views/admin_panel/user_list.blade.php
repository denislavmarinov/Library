@php
    $title = "User list";
@endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">User list</h1>
@endsection
@section('content')
<table class="table">
    <tr class="badge-success">
        <td>#</td>
        <td>First name</td>
        <td>Last name</td>
        <td>Email</td>
        <td>Created at</td>
        <td>Updated at</td>
        <td>Role</td>
        <td>Require to update password</td>
    </tr>
    @php
        $num = 1;
    @endphp
    @foreach ($users as $user)
        <tr>
            <td>{{ $num++ }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ($user->created_at === null) ? 'Never' : $user->created_at->diffForHumans() }}</td>
            <td>{{ ($user->updated_at === null) ? 'Never' : $user->updated_at->diffForHumans() }}</td>
            <td>{{ $user->role }}</td>
            @if ($user->change)
            <td>Already sent!</td>
            @else
            <td><button  class="require_change_password_btn btn btn-outline-teal" data-user="{{ $user->id }}" data-first_name="{{ $user->first_name }}" data-last_name="{{ $user->last_name }}" type="button" data-toggle="modal" data-target="change_user_role_modal">Require to update password</button></td>
            @endif
        </tr>
    @endforeach
</table>
<!-- The Modal -->
<div class="modal" id="require_change_password_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="user_name"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Are you sure?</p>
        {!! Form::open(['route' =>['require_change_password'], 'id' => 'require_change_password', 'method' => 'put'] ) !!}
        {!! Form::hidden('user_id', ' ', ['id' => 'user_id_hidden']) !!}
        {!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        {!! Form::submit('Send', ['class' => 'btn btn-outline-orange', 'form' => 'require_change_password']) !!}
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $('.require_change_password_btn').on('click', function(e) {
        e.preventDefault();
        let user_id = $(this).data('user'),
            user_first_name = $(this).data('first_name'),
            user_last_name = $(this).data('last_name');
        $('#user_name').html("Name: <span class='font-weight-bold'>" + user_first_name + " " + user_last_name + "</span>");
        $('#user_id_hidden').val(user_id);
        $('#require_change_password_modal').modal();
    });
</script>
@endsection

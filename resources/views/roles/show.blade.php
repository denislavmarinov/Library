@php
 	$title = ucfirst(str_replace('_', ' ', $role[0]->role)) . " role";
@endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Role {{ ucfirst(str_replace('_', ' ', $role[0]->role)) }}</h1>
@endsection
@section('content')
@php
$num = 1;
@endphp
<table class="table">
	<tr>
		<td>#</td>
		<td>First name</td>
		<td>Last name</td>
		<td>Email</td>
		<td>Role</td>
		<td>Change role</td>
	</tr>
	@foreach ($role as $user)
		<tr>
			<td>{{ $num++ }}</td>
			<td>{{ $user->first_name }}</td>
			<td>{{ $user->last_name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->role }}</td>
			<td><button class="change_role_button btn btn-outline-info change_user_role_btn" data-user="{{ $user->id }}" data-first_name="{{ $user->first_name }}" data-last_name="{{ $user->last_name }}" data-role="{{ $user->role_id }}" type="button" data-toggle="modal" data-target="change_user_role_modal">Change role</button></td>
		</tr>
	@endforeach
</table>
<!-- The Modal -->
<div class="modal" id="change_user_role_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="user_name"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	{!! Form::open(['route' =>['change_user_role'], 'id' => 'change_role_form', 'method' => 'put'] ) !!}
      	{!! Form::hidden('user_id', ' ', ['id' => 'user_id_hidden']) !!}
      	{!! Form::label('new_role', 'Select user new role:', ['class' => 'form-control-label']) !!}
      	{!! Form::select('new_role', $roles, $user->role_id, ['class' => 'custom-select']) !!}
      	{!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	{!! Form::submit('Change', ['class' => 'btn btn-outline-warning', 'form' => 'change_role_form']) !!}
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('.change_user_role_btn').on('click', function(e) {
		e.preventDefault();
		let user_id = $(this).data('user'),
			user_first_name = $(this).data('first_name'),
			user_last_name = $(this).data('last_name');

		$('#user_name').html("Name: <span class='font-weight-bold'>" + user_first_name + " " + user_last_name + "</span>");
		$('#user_id_hidden').val(user_id);
		$('#change_user_role_modal').modal();
	});
</script>
@endsection

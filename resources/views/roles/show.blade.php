<?php $title = ucfirst(str_replace('_', ' ', $role[0]->role)) . " role"; ?>
@extends('layouts/main')
@section('title')
    <h1 class="page_title">Role {{ ucfirst(str_replace('_', ' ', $role[0]->role)) }}</h1>
@endsection
@section('content')
<?php $num = 1 ?>
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
			<td><button class="change_role_button btn btn-outline-info">Change role</button></td>
		</tr>
	@endforeach
</table>
<script type="text/javascript">

</script>
@endsection

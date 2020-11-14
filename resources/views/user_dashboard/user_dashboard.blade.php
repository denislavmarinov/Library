@if (Auth::user()->role_id == '2')
	@php
	$page_heading = "Admin panel";
	@endphp
@elseif (Auth::user()->role_id == "3")
	@php
	$page_heading = "Authors panel";
	@endphp
@else
	@php
	$page_heading = "User dashboard";
	@endphp
@endif
@php
	$title = $page_heading;
@endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">{{$page_heading}}</h1>
@endsection
@section('content')
<p></p>
<div class="row">
	<div class="col-5">
		<h4 class="text-center">Profile image</h4>
		<hr>
		<img width="250" src="#">
		<p></p>
		<a href="">Change profile image</a>
	</div>
	<div class="col-6">
		<p>Name: <span class="font-weight-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></p>
		<p>Email: <span class="font-weight-bold">{{ Auth::user()->email }}</span></p>
	</div>
	<div class="col-1">
		<button class="btn btn-outline-teal notifications">Notifications</button>
		@if (Auth::user()->role_id == '1')
		<a href="">Candidate to be author</a>
		@endif
	</div>
</div>
<!-- The Modal -->
<div class="modal" id="all_notifications">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
      	<div class="row">
      		<div class="col-8"><h4 class="modal-title">All notifications</h4></div>
      		<div class="col-4"><button id="clear_all" class="btn btn-outline-danger">Clear all</button></div>
      	</div>
      		<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	@if (empty($notifications[0]))
      		<div class='card card-body bg-light'>
      			<p class='text-center'>There is no notifications</p>
      		</div>
      	@else
	      	@foreach ($notifications as $notification)
		      	<div class="card card-body bg-light">
		      		<div class="col-1 offset-11">
		      			<button class="notification_seen close" data-notification_id = "{{ $notification->id }}" data-toggle="tooltip" data-placement="top" title="Remove this notifications"><span class="text-danger text-right">&times;</span></button>
		      		</div>
		      		<h5 class="text-center font-weight-bold">{{ $notification->notification }}</h5>
		      		<hr>
		      		<p>Description: <span class="font-weight-bold">{{ $notification->description }}</span></p>
		      		<p>Book: <a href="{{ route('books.show', $notification->book_id) }}">{{ $notification->title }}</a></p>
		      		<p>Author: <a href="route('authors.show', $notification->author_id)">{{ $notification->first_name }} {{ $notification->last_name }}</a></p>
		      		<p>Genre: <a href="{{ route('genres.show', $notification->genre_id) }}">{{ $notification->genre }}</a></p>
		      		<div class="row">
		      			<div class="col-6">
		      				<a href="" class="btn btn-outline-teal">Add to wishlist</a>
		      			</div>
		      			<div class="col-6">
							<form method="post" action="{{ route('start_reading', $notification->book_id) }}">
								@csrf
								<input type="submit" name="submit" value="Start reading" class="btn btn-outline-cyan">
							</form>
		      			</div>
		      		</div>
		      	</div>
	      	@endforeach
      	@endif
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	// AJAX setup
	$.ajaxSetup({
		headers: {
			'X-CSFR-TOKEN': '{{ csrf_field() }}'
		}
	});

	// Open the modal with all notifications listed
	$('.notifications').on('click', function(e) {
		e.preventDefault();
		$('#all_notifications').modal();
	});

	// Remove the notification from the notification tab
	$('.notification_seen').on('click', function(e){
		e.preventDefault();

		let notification_id = $(this).data('notification_id'),
		element = $(this).parent().parent(),
		url = '{{ route('notification_seen', ':notification_id') }}';
		url = url.replace(':notification_id', notification_id);

		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			data: '',
			success: function(response){
				if(response){
					$(element).remove();
				}
			}
		});
	});

	// Remove all notifications from notifications tab (premanently)
	$('#clear_all').on('click', function(e){
		e.preventDefault();

		let	element = $('.card'),
		append = "<div class='card card-body bg-light'><p class='text-center'>There is no notifications</p></div>",
		url = "{{ route('mark_all_notifications_as_seen') }}";

		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			data: '',
			success: function(response){
				if(response){
					$(element).remove();
					$('.modal_body').append(append);
				}
			}
		});
	});
</script>
@endsection

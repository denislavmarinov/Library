@php
    $title = "Read book";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Read book</h1>
@endsection
@section('content')
<br>
<button class="btn btn-outline-teal" id="save_new_pages_read">Save your page, up to which you have read this book</button>
<p>All book pages are: <strong>{{ $count_of_pages }}</strong></p>
@if (!isset($user_page[0]))
	@php
		$user_page = 0;
	@endphp
@else
	@php
		$user_page =  $user_page[0]->up_to_page;
	@endphp
@endif
{!! Form::text('go_to_page', $user_page == 0 ? 1 : $user_page, ['class' => 'form-control', 'id' => 'go_to_page']) !!}
<button id="go_to_page_btn" class="btn btn-outline-success">Go to page</button>
<div class="content">
	<div class="d-flex justify-content-center">
		<button class="btn btn-outline-info previousBtn"> <- Previous</button>
		<span style="margin-left: 15px; margin-right: 15px;" class="current_page">{{ $user_page == 0 ? 1 : $user_page }}</span>
		<button class="btn btn-outline-info nextBtn">Next -> </button>
	</div>
	<div>
		@php
			echo $all_pages_content[$user_page == 0 ? 1 : $user_page];
		@endphp
	</div>
	<div class="d-flex justify-content-center">
		<button class="btn btn-outline-info previousBtn"> <- Previous</button>
		<span style="margin-left: 15px; margin-right: 15px;" class="current_page">{{ $user_page == 0 ? 1 : $user_page }}</span>
		<button class="btn btn-outline-info nextBtn">Next -> </button>
	</div>
</div>
<div class="modal" id="confirm_page_before_leave">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="user_name"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	{!! Form::open(['route' =>['save_up_to_page', $book->id], 'id' => 'confirm_up_to_page_form', 'method' => 'put'] ) !!}
      	{!! Form::label('up_to_page', 'Are you really up to page:', ['class' => 'form-control-label']) !!}
      	{!! Form::text('up_to_page', null, ['class' => 'form-control']) !!}
      	{!! Form::hidden('book_id', $book->id) !!}
      	{!! Form::hidden('book_pages', $book->pages) !!}
      	{!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	{!! Form::submit('Change', ['class' => 'btn btn-outline-orange', 'form' => 'confirm_up_to_page_form']) !!}
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	// Get all pages
	let allPages = <?php echo json_encode($all_pages_content); ?>, max_page = "<?php echo $count_of_pages ?>";

	$(".previousBtn").on('click', function(e) {
		e.preventDefault();
		let pageId = $(".container>.content>div:nth-of-type(2)>div").attr('id'), previousPageNum, previousPage;
		// Get the current page number
		pageId = pageId.replace(/^\D+/g, '');
		// Set the previous page number
		previousPageNum = parseInt(pageId) - 1;
		if(previousPageNum > 0 ){
			// Get only the previous page
			previousPage = allPages[previousPageNum];
			// Remove the old one from the DOM tree
			$('.container>.content>div:nth-of-type(2)>div').remove();
			// Add the new one to the DOM tree
			$('.container>.content>div:nth-of-type(2)').append(previousPage);
			//Set the current page num
			$("#go_to_page").val(previousPageNum);
			$(".current_page").text(previousPageNum);
		}else{
			alert("This is the first page");
		}

	});

	$(".nextBtn").on('click', function(e) {
		e.preventDefault();
		let pageId = $(".container>.content>div:nth-of-type(2)>div").attr('id'), nextPageNum, nextPage;
		// Get the current page number
		pageId = pageId.replace(/^\D+/g, '');
		// Set the previous page number
		nextPageNum = parseInt(pageId) + 1;
		if (nextPageNum <= max_page){
			// Get only the previous page
			nextPage = allPages[nextPageNum];
			// Remove the old one from the DOM tree
			$('.container>.content>div:nth-of-type(2)>div').remove();
			// Add the new one to the DOM tree
			$('.container>.content>div:nth-of-type(2)').append(nextPage);
			//Set the current page num
			$("#go_to_page").val(nextPageNum);
			$(".current_page").text(nextPageNum);
		}else{
			alert("You reach the last page of the book!");
		}

	});
	$("#save_new_pages_read").on('click', function() {
		$('#confirm_page_before_leave').modal();
		let pageId = $(".container>.content>div:nth-of-type(2)>div").attr('id');
		pageId = pageId.replace(/^\D+/g, '');
		$("#up_to_page").val(parseInt(pageId));
	});

	$('#go_to_page_btn').on('click', function() {
		let go_to_page = $('#go_to_page').val();
		if (parseInt(go_to_page) > 0  && parseInt(go_to_page) <= parseInt(max_page)) {
			// Get only the previous page
			newPage = allPages[go_to_page];
			// Remove the old one from the DOM tree
			$('.container>.content>div:nth-of-type(2)>div').remove();
			// Add the new one to the DOM tree
			$('.container>.content>div:nth-of-type(2)').append(newPage);
			//Set the current page num
			$("#go_to_page").val(go_to_page);
			$(".current_page").text(go_to_page);
		}else{
			alert("Please enter a valid page!");
		}
	});
</script>
@endsection

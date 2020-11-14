@php
    $title = "Read book";
 @endphp
@extends('layouts.main')
@section('title')
    <h1 class="page_title">Read book</h1>
@endsection
@section('content')
<div>
	<object id="test" data="../../files/Test.pdf" type="application/pdf" width="100%" height="750px">
		alt: Not working
	</object>
</div>
<script type="text/javascript">
	$('embed').hide();
	console.log(document.getElementById('test').contentDocument)
</script>
@endsection

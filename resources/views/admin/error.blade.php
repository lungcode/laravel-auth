@extends('layouts.admin')

@section('main')
<?php 
$code = isset($code) ? $code : 404;
$title = isset($title) ? $title : 'Not Found';
$message = isset($message) ? $message : 'Page not found';

 ?>
<div class="jumbotron">
	<div class="container">
		<h1>{{$code}}, {{$title}}!</h1>
		<p>{{$message}} ...</p>
		<p>
			<a class="btn btn-primary btn-lg">Learn more</a>
		</p>
	</div>
</div>
@stop()
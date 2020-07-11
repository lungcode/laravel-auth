<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

	</head>
	<body>
		<?php 
		$user = Auth::user(); 
		$menus = config('menu');
		?>
		<nav class="navbar navbar-inverse">
			<div class="container">
				<a class="navbar-brand" href="#">Title</a>
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="{{route('admin.index')}}">Dashboard</a>
					</li>
					@foreach($menus as $m)
					@if($user->can($m['route']))
					<li class="dropdown">
						<a href="{{route($m['route'])}}" class="dropdown-toggle" data-toggle="dropdown">{{$m['label']}} <b class="caret"></b></a>
						@if(isset($m['items']))
						<ul class="dropdown-menu">
							@foreach($m['items'] as $mi)
							@if($user->can($mi['route']))
							<li><a href="{{route($mi['route'])}}">{{$mi['label']}}</a></li>
							@endif
							@endforeach
						</ul>
						@endif
					</li>
					@endif
					@endforeach
					
				</ul>
			</div>
		</nav>
		<div class="container">
			@if(Session::has('success'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{Session::get('success')}}
			</div>
			<hr>
			@endif
			@if(Session::has('error'))
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{Session::get('error')}}
			</div>
			<hr>
			@endif
			@yield('main')
		</div>

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		@yield('js')
	</body>
</html>
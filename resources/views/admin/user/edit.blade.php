@extends('layouts.admin')

@section('main')
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Panel title</h3>
	</div>
	<div class="panel-body">
		@if($errors->count())
			@foreach($errors as $error)
				<p>{{$error}}</p>
			@endforeach
		@endif
		<form action="{{route('admin.user.update',$user->id)}}" method="POST" role="form">
		@csrf @method('PUT')
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control" name="name" value="{{$user->name}}">
						@error('name') <p>{{$message}}</p>@enderror
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="text" class="form-control" name="email" value="{{$user->email}}">
						@error('email') <p>{{$message}}</p>@enderror
					</div>
					<div class="form-group">
						<label for="">Phone</label>
						<input type="text" class="form-control" name="phone" value="{{$user->phone}}">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password" />
						@error('password') <p>{{$message}}</p>@enderror
					</div>
					<div class="form-group">
						<label for="">Confirm Password</label>
						<input type="password" class="form-control" name="confirm_password" />
						@error('confirm_password') <p>{{$message}}</p>@enderror
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Roles</label>
						@foreach($roles as $role)
						<?php $checked = in_array($role->name,$role_assignments) ? 'checked' : ''; ?>
						<div class="checkbox">
						<label>
							<input type="checkbox" {{$checked}} name="role[]" value="{{$role->id}}">
							{{$role->name}}
						</label>
						@endforeach
					</div>
					</div>
					
				</div>
			</div>
		
			
		
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
@stop()
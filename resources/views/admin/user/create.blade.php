@extends('layouts.admin')

@section('main')
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Panel title</h3>
	</div>
	<div class="panel-body">
		<form action="{{route('admin.user.store')}}" method="POST" role="form">
		@csrf 
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control" name="name" value="">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="text" class="form-control" name="email" value="">
					</div>
					<div class="form-group">
						<label for="">Phone</label>
						<input type="text" class="form-control" name="phone" value="">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" class="form-control" name="password" value="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Roles</label>
						@foreach($roles as $role)
						<div class="checkbox">
						<label>
							<input type="checkbox" name="role[]" value="{{$role->id}}">
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
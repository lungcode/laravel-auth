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
		
		<div class="col-md-4 col-md-offset-4 col-">
			<form action="" method="POST" role="form">
				@csrf
				<legend>Form login</legend>
			
				<div class="form-group">
					<label for="">Email</label>
					<input type="text" class="form-control" name="email" placeholder="Input email">
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" class="form-control" name="password" placeholder="Input email">
				</div>
				
			
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</body>
</html>
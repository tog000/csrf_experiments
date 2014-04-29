<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="shortcut icon" href="../../assets/ico/favicon.ico"> -->

	<title>Panel de Control</title>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<link href="css/style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>

  <body>

	<div class="container login">

		<form role="form" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="POST">
			<input type="hidden" name="action" value="login"/>
			<div class="form-group">
				<label for="user">User</label>
				<input type="text" name="user" class="form-control" id="user" placeholder="User">
			</div>
			<div class="form-group">
				<label for="pass">Password</label>
				<input type="password" name="password" class="form-control" id="pass" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-default">Login</button>
		</form>
		


	</div> <!-- /container -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </body>
</html>

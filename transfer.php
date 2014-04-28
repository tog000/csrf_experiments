<?php

?>

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

	<div class="container">
	  <div class="header">
		<ul class="nav nav-pills pull-right">
		  <li class="active"><a href="./">Balance</a></li>
		  <li><a href="./">Transfer</a></li>
		  <li><a href="?logout">Logout</a></li>
		</ul>
		<h3 class="text-muted">Bank System</h3>
	  </div>

	  <div class="row main-form">
		<div class="col-lg-6">
			<h3>Agregar link</h3>
			<form role="form" method="POST">
				<input type="hidden" name="action" value="add_link"/>
				<div class="form-group">
					<label for="form-link">Password/Link</label>
					<input name="link" type="text" class="form-control" id="form-link" placeholder="Link">
				</div>
				<div class="form-group">
					<label for="form-nota">Notas</label>
					<textarea name="nota" id="form-nota" class="form-control" rows="3"></textarea>
				</div>
				<div class="form-group">
					<label for="form-max">M&aacute;ximas Descargas</label>
					<input name="max" type="text" class="form-control" id="form-max" value="1">
				</div>
				<div class="form-group">
					<label for="form-archivo">Archivo</label>
					<select name="archivo" id="form-archivo" class="form-control">
						<?php
							if ($handle = opendir('./'.$REAL_FOLDER)) {
								while (false !== ($entry = readdir($handle))) {
									if ($entry != "." && $entry != "..") {
										echo "<option value=\"$entry\">$entry</option>";
									}
								}
							}
						?>
					</select>
				</div>
				<button type="submit" class="btn btn-default">Guardar</button>
			</form>
		</div>
	  </div>

	  <div class="footer">
		<p>&copy; Jorge Trisca 2014</p>
	  </div>

	</div> <!-- /container -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		jQuery(function(){
			jQuery(".select-on-click").on("click",function(){
				this.select();
			});
		});
	</script>

  </body>
</html>

<?php

include_once("config.php");

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

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,500,300' rel='stylesheet' type='text/css'>
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
		<div id="wrap">
			<div class="container">
				<div class="header">
					<ul class="nav nav-pills pull-right">
						<li><a href="./">Balance</a></li>
						<li class="active"><a href="transfer.php">Transfer</a></li>
						<li><a href="?logout">Logout</a></li>
					</ul>
					<h3 class="text-muted">Bank System</h3>
					<div class="pull-left text-muted">
						You are logged in as <?php echo $_SESSION['name']; ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<hr/>
				<div class="row main-form">
					<?php if($error_message!=""): ?>

						<div class="alert alert-danger"><b>Error:</b>  <?php echo $error_message;?></div>
					
					<?php endif; ?>

					<?php if($success_message!=""): ?>

						<div class="alert alert-success"><?php echo $success_message;?></div>
					
					<?php endif; ?>


					<div class="col-lg-offset-3 col-lg-6">
						<h3>Transfer Funds</h3>
						<form role="form" method="POST">
							<input type="hidden" name="action" value="transfer"/>
							<?php include('token.php');?>
							<div class="form-group">
								<label for="form-from">From Your Account</label>
								<input disabled type="text" class="form-control" id="form-from" value="<?php echo $_SESSION['account']; ?>">
							</div>
							<div class="form-group">
								<label for="form-to">Destination Account</label>
								<select name="to" id="form-to" class="form-control">
									<option value="" disabled selected>Select an account...</option>
								<?php
									$all_accounts = mysql_query("SELECT * FROM `account` WHERE account.number!=\"{$_SESSION['account']}\"");
									while(($row = mysql_fetch_row($all_accounts)) != FALSE){
										echo "<option value=\"$row[1]\">{$row[2]} - {$row[1]}</option>";
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label for="form-amount">Amount to transfer</label>
								<input name="amount" autocomplete="off" type="text" class="form-control" id="form-amount" value="0">
							</div>
							<button type="submit" class="btn btn-default">Transfer</button>
						</form>
					</div>
				</div>

			</div>
		</div> <!-- /container -->
	</div> <!-- /wrap -->

	<div id="push"></div>
	<div id="footer">
		<div class="container">
			&copy; Boise State University &mdash; Software Security 2014
		</div>
	</div>

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

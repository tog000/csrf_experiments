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

	<title>Bank System</title>
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
						<li class="active"><a href="./">Balance</a></li>
						<li><a href="transfer.php">Transfer</a></li>
						<li><a href="?logout">Logout</a></li>
					</ul>
					<h3 class="text-muted">Bank System</h3>
					<div class="pull-left text-muted">
						You are logged in as <?php echo $_SESSION['name']; ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<hr/>
				
				<div class="row">
					<div class="col-lg-12 text-center">
						<h3>Account Balance</h3>
						<div class="huge">$<?php echo $funds; ?></div>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-lg-12">
						<h4><span class="glyphicon glyphicon-import text-success">&nbsp;</span>Incoming Transaction History</h4>
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>Date</th>
									<th>From</th>
									<th>Amount</th>
								</tr>
								<?php
								$result = mysql_query("SELECT * FROM `transaction` LEFT JOIN `account` on account.number = transaction.from WHERE transaction.to=\"{$_SESSION['account']}\" ORDER BY transaction.date ASC");
								while(($row = mysql_fetch_row($result)) != FALSE){
									echo "<tr>
									<td>{$row[0]}</td>
									<td>{$row[4]}</td>
									<td>{$row[7]}</td>
									<td>{$row[3]}</td>
								</tr>";
							}
							?>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<h4><span class="glyphicon glyphicon-export text-danger">&nbsp;</span>Outgoing Transaction History</h4>
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>Date</th>
									<th>To</th>
									<th>Amount</th>
								</tr>
								<?php
								$result = mysql_query("SELECT * FROM `transaction` LEFT JOIN `account` on account.number = transaction.to WHERE transaction.from=\"{$_SESSION['account']}\" ORDER BY transaction.date ASC");
								while(($row = mysql_fetch_row($result)) != FALSE){
									echo "<tr>
									<td>{$row[0]}</td>
									<td>{$row[4]}</td>
									<td>{$row[7]}</td>
									<td>{$row[3]}</td>
								</tr>";
							}
							?>
							</table>
						</div>
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

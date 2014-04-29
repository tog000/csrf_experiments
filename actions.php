<?php
	
	session_start();

	$error_message = "";
	$success_message = "";

	require_once('config.php');

	if(isset($_GET['logout'])){
		$_SESSION['logged'] = FALSE;
		unset($_SESSION['logged']);
		$url = sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST'],$_SERVER['REQUEST_URI']);
		$url = strtok($url, '?');
		header("Location: $url");
	}
	
	// If the user is not trying to login, and it is not logged in
	if( (!isset($_SESSION['logged']) ||  isset($_SESSION['logged']) != TRUE) && !(isset($_POST['action']) && $_POST['action']=="login")){
		include("login.php");
		die();
	}

	mysql_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD);
	mysql_select_db($DB_NAME);


	if(isset($_SESSION['logged']) && $_SESSION['logged']){
		$funds = mysql_query("SELECT * FROM `account` WHERE account.number=\"{$_SESSION['account']}\"");
		$funds = mysql_fetch_row($funds)[3];
	}

	$request = $_REQUEST;

	// Start processing actions
	if(isset($request['action'])){

		if($request['action']=="login"){

			$user = mysql_real_escape_string($request['user']);
			$password = mysql_real_escape_string($request['password']);

			$result = mysql_query("SELECT * FROM `users` WHERE user=\"{$user}\" and password=\"${password}\"");

			if(mysql_num_rows($result) == 1){
				$_SESSION['logged'] = TRUE;
				$row = mysql_fetch_row($result);
				$_SESSION['user'] = $row[0];
				$_SESSION['account'] = $row[1];

				$funds = mysql_query("SELECT * FROM `account` WHERE account.number=\"{$_SESSION['account']}\"");
				$funds = mysql_fetch_row($funds)[3];

				$result = mysql_query("SELECT * FROM `account` WHERE account.number=\"{$row[1]}\"");
				$row = mysql_fetch_row($result);

				$_SESSION['name'] = $row[2];

			}else{
				include("login.php");
				die();
			}
		}

		if($request['action']=="transfer"){

			if(!isset($request['to'])){
				$error_message = "No destination account";
				return;
			}

			if(!isset($request['to']) || $request['amount']=="0"){
				$error_message = "Enter an amount";
				return;
			}

			$to = mysql_real_escape_string($request['to']);
			$amount = mysql_real_escape_string($request['amount']);

			if($funds<$amount){
				$error_message = "Not enough funds";
			}else{
				$result = mysql_query("INSERT INTO `transaction` (transaction.from, transaction.to, amount, transaction.date) VALUES (\"{$_SESSION['account']}\",\"$to\", \"$amount\", now())");
				$result = mysql_query("UPDATE `account` SET balance=balance-{$amount} WHERE account.number={$_SESSION['account']}");
				$result = mysql_query("UPDATE `account` SET balance=balance+{$amount} WHERE account.number={$to}");

				$success_message = "Your money transfer was successful!";

			}

		}
	}























		/*
		if($_POST['action']=="transfer"){

			$funds = mysql_query("SELECT * FROM `account` WHERE account.number=\"{$_SESSION['account']}\"");
			$funds = mysql_fetch_row($funds)[3];

			if(!isset($_POST['to'])){
				$error_message = "No destination account";
				return;
			}

			if(!isset($_POST['to']) || $_POST['amount']=="0"){
				$error_message = "Enter an amount";
				return;
			}

			$to = mysql_real_escape_string($_POST['to']);
			$amount = mysql_real_escape_string($_POST['amount']);

			if($funds<$amount){
				$error_message = "Not enough funds";
			}else{
				$funds = mysql_query("INSERT INTO `transaction` (transaction.from, transaction.to, amount, transaction.date) VALUES (\"{$_SESSION['account']}\",\"$to\", \"$amount\", now())");
				$funds = mysql_query("UPDATE `account` SET balance=balance-{$amount} WHERE account.number={$_SESSION['account']})");

				echo $_SERVER['POST_URI'];

				$success_message = "Your money transfer was successful!";

				//$url = strtok($_SERVER['POST_URI'], '?');
				//header("Location: $url");

			}

		}
	*/

?>
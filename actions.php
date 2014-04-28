<?php

require_once('config.php');

	if(isset($_GET['logout'])){
		$_SESSION['logged'] = FALSE;
		unset($_SESSION['logged']);
		$url = sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['HTTP_HOST'],$_SERVER['REQUEST_URI']);
		$url = strtok($url, '?');
		header("Location: $url");
	}
	
	mysql_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD);
	mysql_select_db($DB_NAME);


	if(isset($_GET['action']) && $_GET['action']=="download"){

		$link = explode("/",$_GET['link']);
		$link = $link[count($link)-1];

		if(isset($_GET['link']) && $link != str_replace("/", "", $DOWNLOAD_FOLDER) && $link != "" && $_GET['link'] != ""){

			$link = mysql_real_escape_string($link);
			$result = mysql_fetch_row(mysql_query("select * from `links` where link=\"$link\" limit 1"));
			if($result!=[]){
				$file = $REAL_FOLDER.$result[2];

				if(intval($result[4])+1 <= intval($result[5]) && file_exists($file)){
					mysql_query("update `links` set downloads = downloads+1 where id=${result[0]}");
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.basename($file));
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					ob_clean();
					flush();
					readfile($file);
				}
			}
			exit;
		}else{
			include_once("download.php");
			exit;
		}
	}

	if(isset($_POST['action']) && $_POST['action']=="login"){
		if($_POST['user']==$ACCCESS_USER && $_POST['password']==$ACCCESS_PASSWORD){
			$_SESSION['logged'] = TRUE;
		}
	}

	if(!isset($_SESSION['logged']) ||  isset($_SESSION['logged']) != TRUE){
		include("login.php");
		die();
	}

?>
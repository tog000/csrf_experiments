<?php

	global $USE_TOKEN;

	if(isset($USE_TOKEN) && $USE_TOKEN==TRUE){
		if(!isset($_SESSION['token'])){
			generateToken();
		}

		echo "<input type=\"hidden\" value=\"{$_SESSION['token']}\" name=\"token\"/>";
	}

?>
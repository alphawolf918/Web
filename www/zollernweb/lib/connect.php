<?php
	if($_SERVER["REMOTE_ADDR"] != "::1" AND $_SERVER["REMOTE_ADDR"] != "127.0.0.1"){
		$con = mysqli_connect("mysql.zollernverse.org","","", "zweb");
	}else{
		$con = mysqli_connect("localhost","root","","zweb") OR exit("Connection error.");
	}
?>
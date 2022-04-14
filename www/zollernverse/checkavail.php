<?php
require 'functions.php';
connect();
if(isset($_POST["user"])){
$r = sql("SELECT rnames FROM sitedata");
$rs = explode(",",$r["rnames"]);
if($_POST["user"] == ""){
	 echo "<img src=\"buttons/cancel.png\" /> You did not enter a username.";
}
if(!preg_match("/[a-zA-Z0-9]{5,30}/i",$_POST["user"])){
	echo "<img src=\"buttons/cancel.png\" /> Invalid username.";
}else{
$c = sql("SELECT id FROM members WHERE name = '".userFormat($_POST["user"])."'");
if($c["id"] == "" AND !in_array(userFormat($_POST["user"]),$rs)){
	echo "<img src=\"buttons/accept.png\" /> Nice! This username is available.";
}else{
	echo "<img src=\"buttons/cancel.png\" /> Whoops, looks like that one's taken.";
}
}
}elseif(isset($_POST["pw"])){
	if($_POST["pw"] == "" OR strlen($_POST["pw"]) < 6){
		echo "<img src=\"buttons/cancel.png\" /> Invalid password.";
	}else{
		echo "<img src=\"buttons/accept.png\" /> Radical!";
	}
}elseif(isset($_POST["p2"]) AND isset($_POST["pass"])){
	if($_POST["pass"] != $_POST["p2"]){
		echo "<img src=\"buttons/cancel.png\" /> Uh dude, your passwords kinda don't match.";
	}else{
		if($_POST["pass"] != "" AND $_POST["p2"] != ""){
			echo "<img src=\"buttons/accept.png\" /> Nice job! Passwords match.";
		}else{
			echo "<img src=\"buttons/cancel.png\" /> Empty password.";
		}
	}
}
if(isset($_POST["email"])){
	$em = sql("SELECT id FROM members WHERE email = '".$_POST["email"]."'");
	if($em["id"] != ""){
		echo "<img src=\"buttons/cancel.png\" /> Sorry, that e-mail is taken.";
	}else{
	if($_POST["email"] == ""){
		echo "<img src=\"buttons/cancel.png\" /> You did not enter an e-mail address.";
	}
	if(!preg_match("/^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$/i",$_POST["email"])){
		echo "<img src=\"buttons/cancel.png\" /> Please enter a valid e-mail address.";
	}else{
		echo "<img src=\"buttons/accept.png\" /> Great job!";
	}
	}
}
?>
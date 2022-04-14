<?php
include 'functions.php';
if(!(int)$_POST["boardid"]) exit("Error");
connect();
$watchers = sql("SELECT watchers FROM boards WHERE id = '".$_POST["boardid"]."'");
$w = explode(":",$watchers["watchers"]);
if(!in_array($_COOKIE["id"],$w)){
	$w[] = $_COOKIE["id"];
	query("UPDATE boards SET watchers = '".implode(":",$w)."' WHERE id = '".$_POST["boardid"]."'");
	loguser($_COOKIE["id"],"subscribed to a board.");
	echo "<img src=\"buttons/accept.png\" /> <strong>Listening!</strong>";
}else{
	$getKey = array_search($_COOKIE["id"],$w);
	unset($w[$getKey]);
	query("UPDATE boards SET watchers = '".implode(":",$w)."' WHERE id = '".$_POST["boardid"]."'");
	loguser($_COOKIE["id"],"unsubscribed from a board.");
	echo "<img src=\"buttons/accept.png\" /> <strong>Unsubscribed.</strong>";
}
?>
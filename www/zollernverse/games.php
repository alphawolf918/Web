<?php
require 'functions.php';
connect();
onlineCheck();
if(!isset($_POST["id"]) OR !isset($_POST["type"])) exit("Error");
$userdata = sql("SELECT games_want,games_have FROM members WHERE id = '".$_COOKIE["id"]."'");
$gamesWant = explode(":",$userdata["games_want"]);
$gamesHave = explode(":",$userdata["games_have"]);
switch($_POST["type"]){
	case 'want':
		if(!in_array($_POST["id"],$gamesWant)){
			$wstr = "<img src=\"buttons/accept.png\" /> Added!";
			$gamesWant[] = $_POST["id"];
			$newGames = implode(":",$gamesWant);
			query("UPDATE members SET games_want = '".$newGames."' WHERE id = '".$_COOKIE["id"]."'");
		}else{
			$wstr = "<img src=\"buttons/delete.png\" /> Deleted.";
			$newGames = array_delete($_POST["id"],$gamesWant);
			query("UPDATE members SET games_want = '".$newGames."' WHERE id = '".$_COOKIE["id"]."'");
		}
		echo $wstr;
	break;
	case 'have':
		if(!in_array($_POST["id"],$gamesHave)){
			$hstr = "<img src=\"buttons/accept.png\" /> Added!";
			$gamesHave[] = $_POST["id"];
			$newGames = implode(":",$gamesHave);
			query("UPDATE members SET games_have = '".$newGames."' WHERE id = '".$_COOKIE["id"]."'");
		}else{
			$hstr = "<img src=\"buttons/delete.png\" /> Deleted.";
			$newGames = array_delete($_POST["id"],$gamesHave);
			query("UPDATE members SET games_have = '".$newGames."' WHERE id = '".$_COOKIE["id"]."'");
		}
		echo $hstr;
	break;
}
?>
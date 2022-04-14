<?php
require "functions.php";
connect();
onlineCheck();
if(!isset($_POST["gameid"])) invData();
$game = $_POST["gameid"];
$mode = $_POST["mode"];
$gameData = sql("SELECT * FROM games WHERE id = '".$game."'");
if($mode){
	$data = sql("SELECT * FROM beacons WHERE userid = '".$_COOKIE["id"]."'");
	if($data["gameid"] == $game) exit("Error - This game is already set in your beacons.");
	query("INSERT INTO beacons(userid,gameid,posted,message)VALUES('".$_COOKIE["id"]."','".$game."',CURRENT_TIMESTAMP,'I want to play this game with friends.')");
	loguser($_COOKIE["id"],"set a beacon for a game.");
	echo "Beacon Set!";
	$friendList = sql("SELECT friends FROM members WHERE id = '".$_COOKIE["id"]."'");
	$friend = explode(":",$friendList["friends"]);
		foreach($friend as $f){
			$beacon = sql("SELECT * FROM beacons WHERE userid = '".$f."'");
			if($beacon["gameid"] == $game){
				sendPM($beacon["userid"],'3',"Beacon Notification!","Hiya! I'm messaging you to let you know that your friend [user=".$_COOKIE["id"]."] has set a beacon for [url=index.php?mode=viewgame&id=".$game."]".$gameData["name"]."[/url], and would now like others to play this game with.");
			}
		}
}else{
	query("DELETE FROM beacons WHERE userid = '".$_COOKIE["id"]."' AND gameid = '".$game."'");
	echo "Beacon Removed!";
}
?>
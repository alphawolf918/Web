<?php
require 'functions.php';
connect();
if(!isset($_POST["type"]) OR !isset($_POST["touser"])) exit("Error");
switch($_POST["type"]){
	case 'add':
		$check = sql("SELECT * FROM freq WHERE touser = '".$_POST["touser"]."' AND fromuser = '".$_COOKIE["id"]."'");
		if($check["id"] == ""){
			query("INSERT INTO freq(touser,fromuser)VALUES('".$_POST["touser"]."','".$_COOKIE["id"]."')");
			notifyUser($_POST["touser"],"[user=".$_COOKIE["id"]."] sent you a [url=?act=friendrequests]friend request[/url].");
		}
			echo "<img src=\"buttons/accept.png\" /> Request Sent!";
	break;
	case 'remove':
		$gf = sql("SELECT friends FROM members WHERE id = '".$_POST["touser"]."'");
		$x = explode(":",$gf["friends"]);
		$n = array_delete($_COOKIE["id"],$x);
		query("UPDATE members SET friends = '".$n."' WHERE id = '".$_POST["touser"]."'");
		$myFriends = sql("SELECT friends FROM members WHERE id = '".$_COOKIE["id"]."'");
		$y = explode(":",$myFriends["friends"]);
		$m = array_delete($_POST["touser"],$y);
		query("UPDATE members SET friends = '".$m."' WHERE id = '".$_COOKIE["id"]."'");
		echo "<img src=\"buttons\cancel.png\" /> Friend Removed!";
	break;
	case 'approve':
		$myFriends = sql("SELECT friends FROM members WHERE id = '".$_COOKIE["id"]."'");
		$myList = explode(":",$myFriends["friends"]);
		if(in_array($_POST["touser"],$myList)) exit("Error: This user is already in your friends list.");
		$myList[] = $_POST["touser"];
		$myNewFriendList = implode(":",$myList);
		query("UPDATE members SET friends = '".$myNewFriendList."' WHERE id = '".$_COOKIE["id"]."'");
		$theirFriends = sql("SELECT friends FROM members WHERE id = '".$_POST["touser"]."'");
		$theirList = explode(":",$theirFriends["friends"]);
		if(in_array($_COOKIE["id"],$theirList)) exit("Error: 1");
		$theirList[] = $_COOKIE["id"];
		$theirNewFriendList = implode(":",$theirList);
		query("UPDATE members SET friends = '".$theirNewFriendList."' WHERE id = '".$_POST["touser"]."'");
		query("DELETE FROM freq WHERE touser = '".$_POST["touser"]."' AND fromuser = '".$_COOKIE["id"]."'");
		query("DELETE FROM freq WHERE fromuser = '".$_POST["touser"]."' AND touser = '".$_COOKIE["id"]."'");
		echo "<img src=\"buttons/accept.png\" /> Accepted!";
		notifyUser($_POST["touser"],"[user=".$_COOKIE["id"]."] has accepted your friend request.");
	break;
	case 'deny':
		query("DELETE FROM freq WHERE touser = '".$_POST["touser"]."' AND fromuser = '".$_COOKIE["id"]."'");
		query("DELETE FROM freq WHERE fromuser = '".$_POST["touser"]."' AND touser = '".$_COOKIE["id"]."'");
		echo "<img src=\"buttons/cancel.png\" /> Denied.";
	break;
}
?>
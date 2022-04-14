<?php
require "functions.php";
connect();
onlineCheck();
if(!isset($_POST["id"])) exit("Invalid data.");
query("INSERT INTO reports(postid,userid,details)VALUES('".$_POST["id"]."','".$_COOKIE["id"]."','".addslashes($_POST["details"])."')");
loguser($_COOKIE["id"],"sent in a report.");
$getStaff = mysql_query("SELECT id FROM members WHERE perms >= '2'") OR SQLError();
while($s = fetch($getStaff)){
	notifyUser($s["id"],"[user=".$_COOKIE["id"]."] sent in a report.");
}
?>
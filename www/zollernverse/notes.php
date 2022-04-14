<?php
if(!isset($_POST["id"])) exit("Error");
include 'functions.php';
connect();
AuthCheck(3);
query("INSERT INTO notes(userid,note,topic_id)VALUES('".$_COOKIE["id"]."','".addslashes($_POST["details"])."','".$_POST["id"]."')");
loguser($_COOKIE["id"],"added a note to a post.");
$userData = sql("SELECT userid FROM topics WHERE topic_id = '".$_POST["id"]."'");
notifyUser($userData["userid"],"[user=".$_COOKIE["id"]."] added a note to your [url=?act=topic&id=".$_POST["id"]."]topic[/url].");
?>
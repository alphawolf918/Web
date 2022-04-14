<?php
require "functions.php";
connect();
onlineCheck();
if($_POST["message"] != ""){
	$tdata = sql("SELECT * FROM topics WHERE id = '".$_POST["id"]."'");
	$getReplies = numRows("SELECT id FROM topics WHERE topic_id = '".$_POST["id"]."' AND reply = 'yes'");
	$tp = ceil($getReplies/10);
	query("INSERT INTO topics(subject,post,userid,boardid,topic_id,reply)VALUES('".addslashes("Re: ".$tdata["subject"])."','".addslashes($_POST["message"])."','".$_COOKIE["id"]."','".$tdata["boardid"]."','".$_POST["id"]."','yes')");
	$nextPage = ($tp > 1) ? "&p=".$tp : "";
	loguser($_COOKIE["id"],"replied to the topic [url=?act=topic&id=".$_GET["id"]."]".$tdata["subject"]."[/url].");
}else{
	exit;
}
?>
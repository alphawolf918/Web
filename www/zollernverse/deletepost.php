<?php
if(!isset($_POST["pid"])) exit("Illegal access.");
require 'functions.php';
connect();
switch($_POST["t"]){
case 'post':
$data = sql("SELECT userid,subject,locked FROM topics WHERE id = '".$_POST["pid"]."'");
if($data["locked"] AND !checkPerms(3)) exit("Error");
if(isMe($data["userid"]) OR checkPerms(3)){
	query("DELETE FROM topics WHERE id = '".$_POST["pid"]."'");
	loguser($_COOKIE["id"],"deleted their post in ".$data["subject"].".");
	$udata = sql("SELECT tokens FROM members WHERE id = '".$data["userid"]."'");
	$tokens = $udata["tokens"]-5;
	query("UPDATE members SET tokens = '".$tokens."' WHERE id = '".$data["userid"]."'");
}else{
echo "Error";
}
break;
case 'topic':
$data = sql("SELECT userid,boardid,subject,locked FROM topics WHERE id = '".$_POST["pid"]."'");
if($data["locked"] AND !checkPerms(3)) exit("Error");
if(isMe($data["userid"]) OR checkPerms(4)){
	query("DELETE FROM topics WHERE id = '".$_POST["pid"]."' OR topic_id = '".$_POST["pid"]."'");
	loguser($_COOKIE["id"],"deleted their entire topic ".$data["subject"].".");
	$udata = sql("SELECT tokens FROM members WHERE id = '".$data["userid"]."'");
	$tokens = $udata["tokens"]-10;
	query("UPDATE members SET tokens = '".$tokens."' WHERE id = '".$data["userid"]."'");
	echo "forum.php?act=viewtopics&bid=".$data["boardid"];
}else{
echo "Error";
}
break;
}
?>
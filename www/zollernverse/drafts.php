<?php
require 'functions.php';
onlineCheck();
connect();
$draftCheck = sql("SELECT id FROM drafts WHERE boardid = '".$_POST["boardid"]."' AND userid = '".$_POST["userid"]."'");
if($draftCheck["id"] == ""){
	query("INSERT INTO drafts(boardid,post,last_saved,userid,description,subject)VALUES('".$_POST["boardid"]."','".addslashes($_POST["post"])."',CURRENT_TIMESTAMP,'".$_POST["userid"]."','".addslashes($_POST["d"])."','".addslashes($_POST["subject"])."')");
}else{
	query("UPDATE drafts SET post = '".addslashes($_POST["post"])."', description = '".addslashes($_POST["d"])."', subject = '".addslashes($_POST["subject"])."' WHERE boardid = '".$_POST["boardid"]."' AND userid = '".$_POST["userid"]."'");
}
loguser($_COOKIE["id"],"saved a topic draft.");
echo "<img src=\"buttons/accept.png\" /> <strong>Saved.</strong>";
?>
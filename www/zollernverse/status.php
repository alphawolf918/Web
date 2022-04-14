<?php
if(!isset($_POST["s"])) exit("Error");
require 'functions.php';
connect();
onlineCheck();
$userid = $_COOKIE["id"];
query("DELETE FROM status_history WHERE status = '' AND userid = '".$_COOKIE["id"]."'");
if(!isset($_POST["mode"])){
	if(isset($_POST["id"])){
		$u = sql("SELECT userid FROM status_history WHERE id = '".$_POST["id"]."'");
		$canPost = true;
		if(is_blocked($u["userid"],$_COOKIE["id"])) $canPost = false;
		if(foCheck($_COOKIE["id"])) $canPost = false;
		if($canPost){
			query("INSERT INTO status_comments(userid,comment,status_id,posted)VALUES('".$userid."','".addslashes($_POST["s"])."','".$_POST["id"]."',CURRENT_TIMESTAMP)");
			loguser($_COOKIE["id"],"posted a commment on [user=".$u["userid"]."]'s profile.");
			notifyUser($u["userid"],"[user=".$_COOKIE["id"]."] posted a comment on your status.");
		}else{
			exit("Whoops, looks like this user isn't accepting comments. Bummer. ".ubbc(":("));
		}
		$getcomments = mysql_query("SELECT * FROM status_comments WHERE status_id = '".$_POST["id"]."'");
		while($c = fetch($getcomments)){
			echo dateFormat($c["posted"])." ".getDisplay($c["userid"])." ".ubbc($c["comment"])."<br/>";
		}
	}else{
		$ls = sql("SELECT posted FROM status_history WHERE userid = '".$_COOKIE["id"]."' ORDER BY id DESC LIMIT 1");
			query("INSERT INTO status_history(userid,status)VALUES('".$userid."','".addslashes($_POST["s"])."')");
			loguser($_COOKIE["id"],"updated their status to: ".$_POST["s"]);
			echo getStatus($userid);
	}
}else{
	query("INSERT INTO status_history(userid,status)VALUES('".$userid."','')");
	echo getStatus($userid);
}
?>
<?php
require 'functions.php';
connect();
onlineCheck();
switch($_POST["mode"]){
case 'inbox':
getMessages();
break;
case 'outbox':
getMessages("outbox");
break;
case 'delete':
	if(!isset($_POST["id"])) exit("Error");
	query("UPDATE pm SET trashed = 1, saved = 0 WHERE id = '".$_POST["id"]."'");
break;
case 'trash':
getMessages("trash");
break;
case 'restore':
	if(!isset($_POST["id"])) exit("Error");
	query("UPDATE pm SET trashed = 0 WHERE id = '".$_POST["id"]."'");
break;
case 'saved':
getMessages("saved");
break;
case 'view':
$pmdata = sql("SELECT * FROM pm WHERE id = '".$_POST["id"]."'");
$userid = (isMe($pmdata["touser"])) ? $pmdata["fromuser"] : $pmdata["touser"];
$userdata = sql("SELECT * FROM members WHERE id = '".$pmdata["fromuser"]."'");
echo '<table cellspacing="0" cellpadding="4" class="bordercolor">
<th class="titlebg" colspan="2">'.stripslashes($pmdata["subject"]).'</th>';
echo '<tr>
	<td class="mainbg" valign="top" height="10" id="s">
	From: '.getDisplay($pmdata["fromuser"])."<br />To: ".getDisplay($pmdata["touser"]).'<br />
	<a href="javascript:savePM('.$_POST["id"].');"><img src="buttons/save_as.png" /> Save</a>
	&nbsp; &nbsp;
	<a href="javascript:;" onclick="downloadMessage('.$_POST["id"].');"><img src="buttons/inbox_download.png" /> Download</a>
	&nbsp; &nbsp;
	<a href="?act=sendpm&f='.$_POST["id"].'"><img src="buttons/folder_go.png" /> Forward</a>
	&nbsp; &nbsp;
	<a href="javascript:;" onclick="getMessages();"><img src="buttons/mail_box.png" /> Inbox</a>
	</td>
	</tr>
	<tr>
	<td class="mainbg" valign="top">
	<strong>Message:</strong><br />
		<div class="quote">'.ubbc($pmdata["message"]).'</div>
	</td>
</tr>
<tr>
	<td class="mainbg2" height="24">
		<form action="javascript:sendPM('.$_POST["id"].',$(\'#msg\').val());" method="post">
		<textarea cols="60" rows="5" name="msg" id="msg"></textarea>
		<br />
		<input type="submit" value="Send Reply" name="submit" id="sr" />
		</form>
	</td>
	</tr>
</table>';
if(isMe($pmdata["touser"]))
query("UPDATE pm SET unread = 'no' WHERE id = '".$_POST["id"]."'");
break;
case 'send':
$pmdata = sql("SELECT * FROM pm WHERE id = '".$_POST["id"]."'");
sendPM($pmdata["fromuser"],$_COOKIE["id"],addslashes($pmdata["subject"]),addslashes($_POST["msg"]));
loguser($_COOKIE["id"],"sent a reply PM to [user=".$pmdata["fromuser"]."].");
notifyUser($pmdata["fromuser"],"[user=".$_COOKIE["id"]."] sent you a message.");
break;
case 'save':
	query("UPDATE pm SET saved = 1 WHERE id = '".$_POST["id"]."'");
break;
case 'deleteforever':
	query("DELETE FROM pm WHERE touser = '".$_COOKIE["id"]."' AND trashed = 1");
break;
case 'download':
	$pmdata = sql("SELECT * FROM pm WHERE id = '".$_POST["id"]."'");
	$toData = sql("SELECT name FROM members WHERE id = '".$pmdata["touser"]."'");
	$fromData = sql("SELECT name FROM members WHERE id = '".$pmdata["fromuser"]."'");
	$theFile = "pm_".$pmdata["id"].".txt";
	$f = fopen($theFile,"w+") OR exit("Could not create file.");
	fwrite($f,"To: ".$toData["name"]."\r\nFrom: ".$fromData["name"]."\r\n----------------------------------\r\n".stripslashes($pmdata["message"]));
	echo "nWin(\"".$theFile."\")";
	unlink($theFile);
break;
case 'req':
	sendPM(1,$_COOKIE["id"],"Birthday Change","I would like my birthday changed, please. Message me back and I will provide you with the details.[br][br]-- [user=".$_COOKIE["id"]."]");
	sendPM(2,$_COOKIE["id"],"Birthday Change","I would like my birthday changed, please. Message me back and I will provide you with the details.[br][br]-- [user=".$_COOKIE["id"]."]");
	loguser($_COOKIE["id"],"requested a change of their birthday.");
	notifyUser(1,"[user=".$_COOKIE["id"]."] has requested a birthday change.");
	notifyUser(2,"[user=".$_COOKIE["id"]."] has requested a birthday change.");
break;
}
?>
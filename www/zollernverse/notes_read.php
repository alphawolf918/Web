<?php
switch($_POST["notes"]){
default:
	displayNotes();
break;
case 'read':
require 'functions.php';
connect();
onlineCheck();
query("UPDATE notifications SET unread = 'no' WHERE userid = '".$_COOKIE["id"]."'");
break;
case 'delete':
require 'functions.php';
connect();
onlineCheck();
if(isset($_POST["id"])){
	if($_POST["id"] == "all"){
		query("DELETE FROM notifications WHERE userid = '".$_COOKIE["id"]."'");
		loguser($_COOKIE["id"], "deleted all of their notifications.");
		displayNotes();
	}else{
		query("DELETE FROM notifications WHERE id = '".intval($_POST["id"])."'");
		loguser($_COOKIE["id"],"deleted one of their notifications.");
		displayNotes();	
	}
}
break;
}
?>
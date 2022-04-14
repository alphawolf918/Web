<?php
require 'functions.php';
if(!isset($_POST["id"])) exit("Error!");
connect();
onlineCheck();
$data = sql("SELECT id,name,gpoints FROM medals WHERE id = '".$_POST["id"]."'");
echo '<img src="buttons/xbox.png" style="height: 45px; width: 45px; border-radius: 80px; float: left;" /> <div style="font-size: 14px; font-weight: bold;"><a href="?p=viewmedal&id='.$data["id"].'" style="color: #fff !important;" class="nWin">'.stripslashes($data["name"])."</a></div><div style=\"font-size:11px;\"> Unlocked For: ".$data["gpoints"]."G</div>"; 
notifyUser($_COOKIE["id"],"You have unlocked the [b]".stripslashes($data["name"])."[/b] achievement!");
?>
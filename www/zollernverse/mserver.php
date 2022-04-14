<?php
require "functions.php";
connect();
if(!checkPerms(4)) exit("Error");
$data = sql("SELECT server_status FROM sitedata");
$newValue = ($data["server_status"] == "on") ? "off" : "on";
query("UPDATE sitedata SET server_status = '".$newValue."'");
$newData = sql("SELECT server_status FROM sitedata");
echo ucfirst($newData["server_status"]);
loguser($_COOKIE["id"], "updated the Minecraft server status.");
?>
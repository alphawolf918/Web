<?php
require 'functions.php';
connect();
onlineCheck();
if(!(int)$_POST["id"]) invData();
$getDisp = sql("SELECT display FROM members WHERE id = '".$_POST["id"]."'");
$rgCheck = sql("SELECT id FROM rg_names WHERE name = '".sqlEsc($getDisp["display"])."'");
if($rgCheck["id"] != "") errMsg("This display name is already registered.");
useTokens(500);
query("INSERT INTO rg_names(name,userid)VALUES('".sqlEsc($getDisp["display"])."','".$_POST["id"]."')");
loguser($_POST["id"],"registered their display name.");
echo ubbc($getDisp["display"]." is now a registered display name!");
?>
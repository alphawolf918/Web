<?php
require '../xsp/xsp.php';
include 'functions.php';
$xsp = new XSP;
connect();
$i=1;
$getUsers = mysql_query("SELECT id,name FROM members ORDER BY id ASC");
while($users = fetch($getUsers)){
	$xsp->Parse("append element member to //users in new.xml");
	$xsp->Parse("append text <".$users["name"]."> to //member[".$i."] in new.xml");
	$xsp->Parse("set attr <id=".$users["id"]."> to //member[".$i."] in new.xml");
	$i++;
}
echo "Success";
?>
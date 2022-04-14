<?php
require "functions.php";
connect();
if(!GET("t")) errMsg("No timestamp was given.");
$getBirthdays = mysql_query("SELECT id FROM members WHERE birthday LIKE '".(date("____-m-d 00:00:00",$_GET["t"]))."'");
while($bdays = fetch($getBirthdays)){
	echo getDisplay($bdays["id"])."<br />";
}
?>
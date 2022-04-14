<?php
$numRows;
if(!isset($_POST["id"])){
	$getMembers = mysql_query("SELECT * FROM members ORDER BY name ASC") OR SQLError();
}else{
	require 'functions.php';
	connect();
	$getMembers = mysql_query("SELECT * FROM members WHERE `".$_POST["searchIn"]."` LIKE '%".addslashes($_POST["searchFor"])."%' ORDER BY name ASC") OR SQLError();
	$numResults = mysql_num_rows($getMembers);
	echo FormatRes($numResults,"Result").":";
}
while($m = fetch($getMembers)){
	echo "<div class=\"mainbg\"> [username: ".$m["name"]."] &nbsp; &nbsp; <img src=\"".$m["avatar"]."\" style=\"height:20px;width:20px;\" /> ".getDisplay($m["id"])."</div>";
}
?>
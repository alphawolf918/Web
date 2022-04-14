<!DOCTYPE html>
<html>
<head>
<title>Viewing Guests</title>
</head>
<body>
<?php
require "functions.php";
connect();
AuthCheck(3);
$when = ($_GET["t"] == "today") ? "86400" : "300";
$getguests = mysql_query("SELECT ip,online_when FROM guests WHERE UNIX_TIMESTAMP(online_when) >= ".(time()-$when)." ORDER BY online_when DESC") OR SQLError();
while($g = fetch($getguests)){
	echo $g["ip"];
	if(checkPerms(4)){
		echo " (".gethostbyaddr($g["ip"]).") &nbsp; &nbsp;  ";
	}
	echo dateFormat($g["online_when"])."<br />";
}
?>
</body>
</html>
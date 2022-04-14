<!DOCTYPE html>
<html>
<head>
<title>Warn Center</title>
</head>
<body>
<?php
require "functions.php";
connect();
onlineCheck();
echo "This is where this user's warning will appear. If there are none here, then you're doing excellent.";
if(!(int)$_GET["id"]) errMsg("No user was specified.");
$getwarns = mysql_query("SELECT * FROM warn WHERE userid = '".$_GET["id"]."'") OR SQLError();
if(checkPerms(3)){
	if(isset($_POST["submit"])){
		$amount;
		switch($_POST["reason"]){
			default:
				$amount = 10;
			break;
			case 'Flaming':
				$amount = 50;
			break;
			case 'Spamming':
				$amount = 10;
			break;
			case 'Inappropriate Post':
				$amount = 35;
			break;
			case 'Disobeying Staff':
				$amount = 80;
			break;
			case 'Advertising':
				$amount = 30;
			break;
			case 'Bumping':
				$amount = 20;
			break;
			case 'Staff Impersonation':
				$amount = 45;
			break;
			case 'Disrespectful':
				$amount = 25;
			break;
		}
			warnReason($_GET["id"],$reason,$_POST["details"],$amount);
			loguser($_COOKIE["id"],"warned [user=".$_GET["id"]."].");
			notifyUser($_GET["id"],"You have received a ".$amount."% warning level for the following offense: <em>".$reason."</em>.");
			toLoc("warn.php?id=".$_GET["id"]);
	}else{
	echo "<form action=\"\" method=\"post\"><fieldset><legend>Warn User</legend>Reason:<br/><select name=\"reason\"><option value=\"Flaming\">Flaming (50%)</option><option value=\"Spamming\">Spamming (10%)</option><option value=\"Inappropriate Post\">Inappropriate Post (35%)</option><option value=\"Disobeying Staff\">Disobeying Staff (80%)</option><option value=\"Advertising\">Advertising (30%)</option><option value=\"Bumping\">Bumping (20%)</option><option vaue=\"Staff Impersonation\">Staff Impersonation (45%)</option><option value=\"Disrespectful\">Disrespectful (25%)</option></select><br/>Details: <input type=\"text\" name=\"details\" /><br/><input type=\"submit\" value=\"Warn\" name=\"submit\" id=\"w\" /></fieldset></form>";
	}
}
while($w = fetch($getwarns)){
	echo getDisplay($w["warner_id"])." (".dateFormat($w["warned_on"])."): ".$w["reason"]." &nbsp; &nbsp; ".$w["amount"]."%<br/>&nbsp;Details: ".ubbc($w["details"])."<br/>";
}
?>
</body>
</html>
<?php
require 'functions.php';
connect();
$logged = sql("SELECT skinid FROM members WHERE id = '".$_COOKIE["id"]."'");
?>
<!DOCTYPE html>
<html>
<head>
<title>Replies</title>
<link rel="stylesheet" href="styles/skinid-<?php echo $logged["skinid"]; ?>.css" />
</head>
<body>
<?php
if(!(int)$_GET["id"]) invData();
echo "<table align=\"center\" cellspacing=\"0\" cellpadding=\"1\" class=\"bordercolor\" width=\"100%\">
<tr>
<th class=\"titlebg\">Who Has Posted Here?</th>
</tr>";
$getPosts = mysql_query("SELECT userid FROM topics WHERE topic_id = '".$_GET["id"]."' GROUP BY userid ORDER BY id DESC");
while($p = fetch($getPosts)){
	echo "<tr><td class=\"mainbg\">".getDisplay($p["userid"])."</td></tr>";
}
echo "</table>";
?>
</body>
</html>
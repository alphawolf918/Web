<?php
require "functions.php";
connect();
onlineCheck();
if($_GET["p"]){
	if(!intval($_GET["p"])) exit("Error");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<?php
	$defaultSkin = sql("SELECT id FROM skins WHERE main = 1");
	$skinid = (online()) ? $logged["skinid"] : $defaultSkin["id"];
	if($skinid == "") $skinid = $defaultSkin["id"];
	if($logged["skinid"] == 0) query("UPDATE members SET skinid = '".$defaultSkin["id"]."' WHERE id = '".$_COOKIE["id"]."'");
	if($logged["tokens"] < 0) query("UPDATE members SET tokens = '0' WHERE id = '".$_COOKIE["id"]."'");
	?>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="styles/skinid-<?php echo $skinid; ?>.css" media="all" id="skin-id" />
	<link rel="stylesheet" type="text/css" href="styles/main.css" media="all" id="main" />
	<title>Participated Topics</title>
</head>
<body>
<?php
$page = ($_GET["p"] == 0 OR $_GET["p"] == "") ? 0 : ($_GET["p"]-1);
$which = ceil($page) * 10;
$i = 1;
$gettotalposts = mysql_query("SELECT * FROM topics WHERE userid = '".$_COOKIE["id"]."' AND reply != 'yes' GROUP BY topic_id") OR SQLError();
$totalPosts = mysql_num_rows($gettotalposts);
$totalPages = ceil($totalPosts / 10);
$getposts = mysql_query("SELECT * FROM topics WHERE userid = '".$_COOKIE["id"]."' AND reply != 'yes' GROUP BY topic_id ORDER BY last_updated DESC LIMIT ".$which.",10") OR SQLError();
?>
<table class="table bordercolor" cellspacing="1" cellpadding="4" id="pTopics">
	<tr>
		<th class="titlebg" colspan="5">Participated Topics</th>
	</tr>	
<?php
while($posts = fetch($getposts)){
	$memberData = sql("SELECT name FROM members WHERE id = '".$posts["userid"]."'");
	if($memberData["name"] == "") continue;
	$topicData = sql("SELECT * FROM topics WHERE id = '".$posts["topic_id"]."'");
	$lastPost = sql("SELECT userid FROM topics WHERE id = '".$posts["topic_id"]."' ORDER BY id DESC LIMIT 1");
	echo "<tr><td class=\"mainbg\">";
		$newData = sql("SELECT * FROM topics WHERE topic_id = '".$topicData["id"]."'");
		echo "<a href=\"forum.php?act=topic&id=".$newData["id"]."\">".$newData["subject"]."</a>
		      <div style=\"font-size:12px; font-family: 'Verdana';\"><strong>Started By:</strong> ".getDisplay($newData["userid"])." on ".dateFormat($newData["posted"])."
		      <div style=\"text-align: right;\">
		      	<strong>Last Post Made By:</strong> ".getDisplay($lastPost["userid"])."
		      </div>
		      </div>";
	      echo "</td>
	      </tr>";
}
if($totalPages > 1){
	echo '<tr>
		<td class=\"mainbg2\">
		<strong>Pages:</strong> ';
		$cH = 0;
		while($i <= $totalPages){
			$cH++;
			echo "<a href=\"?p=".$i."\">".$i."</a>";
			if($cH < $totalPages){
				echo ", ";
			}
			$i++;
		}
	echo '	</td>
	</tr>';
}
?>
</table>
</body>
</html>
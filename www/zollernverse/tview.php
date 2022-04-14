<?php
require 'functions.php';
connect();
onlineCheck();
if(!isset($_POST["view"])) exit("Insufficient data.");
switch($_POST["view"]){
	default:
	case 'all':
		$getTopics = mysql_query("SELECT id FROM topics WHERE boardid = '".$_POST["boardid"]."' AND reply != 'yes' ORDER BY last_updated DESC") OR SQLError();
		while($t = fetch($getTopics)){
			fetchTopic($t["id"]);
		}
	break;
	case 'my':
		$getTopics = mysql_query("SELECT id FROM topics WHERE boardid = '".$_POST["boardid"]."' AND reply != 'yes' AND userid = '".$_COOKIE["id"]."' ORDER BY last_updated DESC") OR SQLError();
		while($t = fetch($getTopics)){
			fetchTopic($t["id"]);
		}
	break;
	case 'friends':
		$data = sql("SELECT friends FROM members WHERE id = '".$_COOKIE["id"]."'");
		extract($data);
		$gf = explode(":",$friends);
		asort($gf);
		foreach($gf as $friend){
			$getTopics = mysql_query("SELECT * FROM topics WHERE userid = '".$friend."' AND reply != 'yes' AND boardid = '".$_POST["boardid"]."' ORDER BY last_updated DESC") OR SQLError();
			while($t = fetch($getTopics)){
				fetchTopic($t["id"]);
			}
		}
	break;
}
?>
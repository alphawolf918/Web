<?php
include '../functions.php';
connect();
?>
<html>
<head>
	<title>DreamSpand Database</title>
	<link rel="stylesheet" href="../styles/halo.css" type="text/css" media="all" />
</head>
<body>
<table align="center" cellspacing="0" cellpadding="4" class="bordercolor" width="780">
<?php
$gt = mysql_query("SHOW TABLES FROM dreamspand");
while($t = fetch($gt)){
	echo '<tr><th class="titlebg">'.$t['Tables_in_dreamspand'].'</th></tr>';
	$gf = mysql_query("SHOW COLUMNS FROM ".$t['Tables_in_dreamspand']);
	while($f = fetch($gf)){
		//var_dump($f);
		echo '<tr><td class="mainbg">'.$f['Field']."</td></tr>";
	}
}
?>
</table>
</body>
</html>
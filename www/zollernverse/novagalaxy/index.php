<?php
	ob_start();
	$con = mysql_connect("localhost","root","giga") OR exit(mysql_error());
	mysql_select_db("novagalaxy",$con) OR exit(mysql_error());
	require 'sql.php';
	require 'core.php';
	$galaxyCheck = sql("SELECT id FROM galaxies WHERE name = '".$galaxyName."'","Line 78");
?><!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="jscripts/jquery.js"></script>
		<script type="text/javascript" src="jscripts/main.js"></script>
		<link rel="stylesheet" href="css/styles.css" type="text/css" media="all" />
		<title>Zollern Universe</title>
	</head>
	<body>
		<div class="controlPanel">
			<h1>Control Panel</h1>
			<strong>Name:</strong> <input type="text" class="txtInput" name="name" id="txtName" />
			<div style="height: 30px;"></div>
			<button onclick="zSpacecreateUniverse">Create Universe</button>
			<button onclick="zSpace.createGalaxy();">Create Galaxy</button>
			<button onclick="zSpace.createStar();">Create Star</button>
			<button onclick="zSpace.createPlanet();">Create Planet</button>
			<button onclick="zSpace.createMoon();">Create Moon</button>
		</div>
	</body>
</html><?php
	mysql_close($con);
	ob_end_flush();
?>
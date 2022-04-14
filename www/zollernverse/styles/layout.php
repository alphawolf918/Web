<?php
	include '../functions.php';
	$con = connect();
	header("Content-type: text/css; charset: UTF-8");
	//This is a PHP file, but due to the content-type header, the browser will parse it as a CSS stylesheet. Using the .php extension, however, it is possible to use PHP scripting (e.g., if-else, variables, etc) within them, and without any errors.
	query("CREATE TABLE IF NOT EXISTS layouts (
		id INT NOT NULL AUTO_INCREMENT,
		name VARCHAR(58) NOT NULL,
		stylesheet TEXT NOT NULL,
		banner_img TEXT NOT NULL,
		userid INT NOT NULL,
		last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
		modified_by INT NOT NULL,
		default_layout INT NOT NULL,
		primary key(id)
	);");
	if(online()){
		$gl = sql("SELECT skinid FROM members WHERE id = '".$_COOKIE["id"]."'");
		$layoutID = ($gl["skinid"] == "" OR $gl["skinid"] == "0") ? "default_layout = 1" : "id = ".$gl["skinid"];
	}else{
		$layoutID = "default_layout = 1";
	}
	$layout = sql("SELECT name,stylesheet FROM layouts WHERE ".$layoutID);
	echo $layout["stylesheet"];
?>
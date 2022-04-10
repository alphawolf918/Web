<?php
	$width = (int) $_POST["width"];
	$height = (int) $_POST["height"];
	
	if($width <= 320){
		echo 'yes';
	}
?>
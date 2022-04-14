<?php
	require 'xcrypt.php';
	$i = 0;
	$n = $_POST["n"];
	$xc = new XCrypt();
	while($i < $n){
		$symb = $_POST["symbols"];
		$symb = ($symb == "true") ? true : false;
		$ul = $_POST["ul"];
		$ul = ($ul == "true") ? true : false;
		$ft = $_POST["ft"];
		$ft = ($ft != "") ? $ft : 0;
		$pw = $xc->generatePassword($_POST["strbase"],$symb,$_POST["length"],$ul,$ft);
		if(isset($_POST["rev"]) AND $_POST["rev"] == "true"){
			$pw = strrev($pw);
		}
		echo ucfirst($pw)."<br />";
		$i++;
	}
?>
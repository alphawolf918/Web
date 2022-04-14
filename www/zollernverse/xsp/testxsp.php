<?php
	require "xsp.php";
	$xsp = new XSP();
	$xsp->Parse("set var i = \"0\";
		for i to 4 {out var:i}");
?>
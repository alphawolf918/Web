<?php
if(!isset($_POST["type"]) OR !isset($_POST["user"])) exit("Error");
	if($_POST["user"] != $_COOKIE["id"]){
		include 'functions.php';
		connect();
		onlineCheck();
		$lk = sql("SELECT lastkarma FROM members WHERE id = '".$_COOKIE["id"]."'");
		$lastkarma = date("g",strtotime($lk["lastkarma"]));
       		$current = date("g");
       		$h = $current-$lastkarma;
		if($h > 0){
			$urep = sql("SELECT rep FROM members WHERE id = '".$_POST["user"]."'");
			$newRep = ($_POST["type"] == "add") ? $urep["rep"]+1 : $urep["rep"]-1;
			query("UPDATE members SET rep = '".$newRep."' WHERE id = '".$_POST["user"]."'");
			query("UPDATE members SET lastkarma = CURRENT_TIMESTAMP WHERE id = '".$_COOKIE["id"]."'");
			echo $newRep;
		}
	}else{
		echo "Nope";
	}
?>
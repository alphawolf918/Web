<?php

	$pass = "[REDACTED]";

	function changeTitle($newTitle){
		js('ZollernJS.changeTitle("'.$newTitle.'");');
	}
	
	function js($script){
		echo '
		<script>
		'
		.$script.'
		</script>
		';
	}
	
	function alert($msg){
		js('alert("'.$msg.'")');
	}
	
	function sqlEsc($str){
		$str = mysql_real_escape_string($str);
		$str = addslashes($str);
		$str = strip_tags($str);
		$strx = $str;
		return $strx;
	}
	
	function query($q){
		return mysql_query($q) OR sqlError();
	}
	
	function sqlError($s="There was a problem internally:"){
		exit($s." ".mysql_error());
	}
	
	function fetch($q){
		return mysql_fetch_assoc($q);
	}
	
	function fetchAll($query,$funcToCall){
		$q = mysql_query($query) OR sqlError();
		while($f = fetch($q)){
			$funcToCall();
		}
	}
	
	function numRows($q){
		$r = mysql_query($q) OR SQLError();
		return mysql_num_rows($r);
	}
	
	function sql($q){
		$r = mysql_query($q) OR SQLError();
		return mysql_fetch_assoc($r);
	}
	
	function checkAdmin(){
		session_start();
		return ($_SESSION["id"] == "1");
	}
	
	function unauthorized(){
		echo "<h1 class=\"title\">Error</h1>
		<p style=\"margin-left: 0.56%;\">You are not authorized to view this page.</p>";
	}
	
	function dataError(){
		echo '<h1 class="title">Error</h1>
		<div style="margin-left: 0.56%;" class="p">There was an error in your request.</div>';
	}
?>
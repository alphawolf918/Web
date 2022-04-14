<?php

	function changeTitle($newTitle){
		js('changeTitle("'.$newTitle.'");');
	}
	
	function js($script){
		echo '
		<script type="text/javascript">
		'
		.$script.'
		</script>
		';
	}
	
	function sqlEsc($str){
		$str = mysql_real_escape_string($str);
		$str = addslashes($str);
	}
	
	function query($q){
		return mysql_query($q) OR sqlError();
	}
	
	function sqlError($s="There was a problem internally:"){
		exit($s." ".mysql_error());
	}
	
	function fetch($q){
		$r = mysql_query($q) OR sqlError();
		return mysql_fetch_assoc($r);
	}
	
	function fetchAll($query,$funcToCall){
		$q = mysql_query($query) OR sqlError();
		while($f = fetch($q)){
			$funcToCall();
		}
	}
?>
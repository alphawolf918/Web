<?php
	
	function sql($query,$errorMessage="Error"){
		$q = mysql_query($query) OR sqlError($errorMessage);
		return mysql_fetch_assoc($q);
	}
	
	function query($query,$errorMessage="Error"){
		return mysql_query($query) OR sqlError($errorMessage);
	}
	
	function sqlError($msg="Error"){
		exit($msg.": ".mysql_error());
	}
	
?>
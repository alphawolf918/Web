<?php
	
	function errMsg($er){
		exit($er);
	}
	
	function br($type="normal"){
		$cssClass = ($type == 'normal') ? "br" : "brl";
		echo '<div class="'.$cssClass.'"></div>';
	}
	
	function multiBreak($numBreaks,$type="normal"){
		while($i < $numBreaks){
			br($type);
			$i++;
		}
	}
	
	function numRows($mysqlQueryResource){
		return mysql_num_rows($mysqlQueryResource);
	}
	
	function noRows($mysqlQueryResource){
		return (numRows($mysqlQueryResource) <= 0);
	}
	
	function query($q){
		return mysql_query($q) OR SQLError();
	}
	
	function sql($q){
		$query = mysql_query($q) OR SQLError();
		return mysql_fetch_assoc($query);
	}
	
	function fetch($q){
		return mysql_fetch_assoc($q);
	}
	
	function SQLError($str="SQL Error:"){
		exit("<strong>".$str.":</strong> ".mysql_error());
	}
	
	function sqlClose($con){
		mysql_close($con);
	}
	
	function textFormat($str){
		$iStr = stripslashes($str);
		$iStr = nl2br($iStr);
		$iStr = censor($iStr);
		return $iStr;
	}
	
	function censor($iStr){
		return $iStr;
	}
	
	function changeTitle($newTitle){
		javascript('changeTitle("'.$newTitle.'")');
	}
	
	function javascript($script){
		echo '
		<script type="text/javascript">
		<!--
		 '.$script.'
		// -->
		</script>';
	}
	
	function storeValue($key,$val){
		setCookie($key,$val,(time()+86400));
	}

	function unstoreValue($key){
		setCookie($key,"",(time()-86400));
	}
	
	function shorten($str,$len=15){
		if(strlen($str) > $len){
			$str = "<span title=\"".$str."\">".substr($str,0,$len)."</span>";
			$str .= "<span style=\"font-size: 11px;\">&hellip;</span>";
		}
		return $str;
	}
	
	function varDebug(&$var){
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
	
	function GET($item,$idCheck=0){
		if($idCheck){
			idCheck($item);
		}
		return sqlEsc($_GET[$item]);
	}

	function sqlEsc($str){
		return mysql_real_escape_string($str);
	}
	
	function FormatRes($_INT,$_STR){
		(string) $newStr;
		if($_INT > 1 or $_INT == 0):
			$newStr = $_STR."s";
		else:
			$newStr = $_STR;
		endif;
		if($_STR != "birthday"){
			$newStr = (strtolower($_STR) != "day") ? str_replace("ys","ies",$newStr) : "days";
		}else{
			$newStr = "birthdays";
		}
		return number_format($_INT)." ".$newStr;
	}
	
	function dirCheck($dir,$perm=0777){
		if(!is_dir($dir)){
			mkdir($dir,$perm);
		}
	}
?>
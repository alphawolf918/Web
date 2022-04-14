<?php
require 'functions.php';
connect();
      			$userdata = sql("SELECT display FROM members WHERE id = '".$_COOKIE["id"]."'");
			$clrs = explode(":",$_POST["clr1"].":".$_POST["clr2"]);
		$c = array();
		if($clrs["1"] != "" AND $clrs["0"] != ""){
			$n = str_split($userdata["display"],1);
			for($t=0;$t<count($n);$t++){
				$n2 = ($c[$t-1] == $clrs["0"]) ? $clrs["1"] : $clrs["0"];
				$c[$t] = $n2;
				$r .= "<a href=\"?act=profile&u=".$_COOKIE["id"]."\"><span style=\"color:#".$c[$t].";\">".$n[$t]."</span></a>";
			}
		}else{
			$whichOne = ($clrs["0"] == "") ? $clrs["1"] : $clrs["0"];
			$r = "<a href=\"?act=profile&u=".$_COOKIE["id"]."\"><span style=\"color:#".$whichOne.";\">".$userdata["display"]."</span></a>";
		}
		echo $r;
?>
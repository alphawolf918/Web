<?php
	$ua = $_SERVER["HTTP_USER_AGENT"];
	if (
		stristr($ua, "Windows CE") or
		stristr($ua, "AvantGo") or
		stristr($ua,"Mazingo") or
		stristr($ua, "Mobile") or
		stristr($ua, "T68") or
		stristr($ua,"Syncalot") or
		stristr($ua, "Blazer") ) {
			$DEVICE_TYPE="MOBILE";
		}else{
			$DEVICE_TYPE="PC";
		}
		
		if($DEVICE_TYPE == "MOBILE"){
			//Redirect to mobile version of site..
			//TODO
		}
?>
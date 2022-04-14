<?php
require 'functions.php';
connect();
if(!(int)$_POST["id"]) errMsg("Error");
$getpost = sql("SELECT post FROM topics WHERE id = '".$_POST["id"]."'");
if(!$_POST["ubbc"]){
	echo stripslashes($getpost["post"]);
}else{
	if($_POST["val"] != ""){
		query("UPDATE topics SET post = '".addslashes($_POST["val"])."', lastedit = '".$_COOKIE["id"]."', edit_reason = '[Quick-Edit]' WHERE id = '".$_POST["id"]."'");
		loguser($_COOKIE["id"],"used Quick-Edit on a post.");
		$newGetPost = sql("SELECT post FROM topics WHERE id = '".$_POST["id"]."'");
		echo ubbc($newGetPost["post"]);
	}else{
		echo "<strong>Error:</strong> Post was empty and was not updated.";
	}
}
?>
<?php
 require 'functions.php';
 connect();
 onlineCheck();
 if(!isset($_POST["id"])) invData();
	$id = $_POST["id"];
	$data = sql("SELECT * FROM p_items WHERE id = '".$id."'");
	$inv = sql("SELECT contents,max_inv FROM p_inv WHERE userid = '".$_COOKIE["id"]."'");
	$contents = explode(":",$inv["contents"]);
	if((count($contents)-1) >= $inv["max_inv"]){
		exit("Sorry, but your inventory is full, as you can only have ".$inv["max_inv"]." different items in your inventory. Please clear out some space first.");
	}
	useTokens($data["price"]);
	$contents[] = $data["id"];
	$nc = implode(":",$contents);
	query("UPDATE p_inv SET contents = '".$nc."' WHERE userid = '".$_COOKIE["id"]."'");
	echo '<img src="buttons/accept.png" class="icon" /> <strong>Done</strong>.';
?>
<?php
require 'functions.php';
if(!isset($_COOKIE["id"])) PleaseLogin();
connect();
if(isset($_POST["sid"])){
	likeStatus($_POST["sid"]);
}elseif(isset($_POST["tid"])){
	$lb1 = sql("SELECT likedBy FROM topics WHERE id = '".$_POST["tid"]."'");
	$lb = explode(":",$lb1["likedBy"]);
if(!in_array($_COOKIE["id"],$lb)){
	$lb[] = $_COOKIE["id"];
	$l = implode(":",$lb);
	query("UPDATE topics SET likedBy = '".$l."' WHERE id = '".$_POST["tid"]."'");
}else{
	$ad = array_delete($_COOKIE["id"],$lb);
	$ln = implode(":",$ad);
	query("UPDATE topics SET likedBy = '".$ln."' WHERE id = '".$_POST["tid"]."'");
}
$lb2 = sql("SELECT likedBy FROM topics WHERE id = '".$_POST["tid"]."'");
$likedBy = explode(":",$lb2["likedBy"]);
$icon = (in_array($_COOKIE["id"],$likedBy)) ? "down" : "up";
echo "<a href=\"javascript:;\" onclick=\"likeTopic(".$_POST["tid"].");\"><img src=\"buttons/thumb_".$icon.".png\" /></a><div style=\"-moz-border-radius:25px;border-radius:25px;height:27px;padding:2px;\" class=\"mainbg2\">";
       	              		$d = count($likedBy)-1;
       	              		if($d>0){
					$i=1;
       	              			$cH=0;
       	              			while($i <= $d){
       	              				$cH++;
       	              				echo getDisplay($likedBy[$i]);
       	              				if($cH<$d AND $i != (count($likedBy)-2)){
       	              					echo ", ";
       	              				}
       	              				if($i == (count($likedBy)-2)){
       	              					echo " and ";
       	              				}
       	              				$i++;
       	              			}
       	              			$likes = ($d > 1) ? "like" : "likes";
       	              			echo " ".$likes." this</div>";
       	              		}
}else{
	errMsg("Invalid reference.");
}
?>
<?php
$con = connect();
$logged = sql("SELECT * FROM members WHERE id = '".$_COOKIE["id"]."'");
$numberOfUserTopics = mysqli_num_rows(mysqli_query($con, "SELECT id FROM topics WHERE userid = '".$_COOKIE["id"]."'"));
$numberOfUserPosts = mysqli_num_rows(mysqli_query($con, "SELECT id FROM topics WHERE userid = '".$_COOKIE["id"]."' AND reply = 'yes'"));
$msgs = sql("SELECT id FROM pm WHERE fromuser = '".$_COOKIE["id"]."'");
$userStatus = sql("SELECT id FROM status_history WHERE userid = '".$_COOKIE["id"]."' ORDER BY id DESC LIMIT 1");
$numComments = mysqli_num_rows(mysqli_query($con, "SELECT id FROM status_comments WHERE userid = '".$_COOKIE["id"]."'"));
$le = sql("SELECT id FROM topics WHERE lastedit = '".$_COOKIE["id"]."'");
$up = sql("SELECT id FROM updates WHERE userid = '".$_COOKIE["id"]."'");
$uptrue = ($up["id"] == "") ? 0 : 1;
$skinChange = sql("SELECT main FROM skins WHERE id = '".$logged["skinid"]."'");
$nd = mysqli_num_rows(mysqli_query($con, "SELECT id FROM display_history WHERE userid = '".$_COOKIE["id"]."'"));
$uc = mysqli_num_rows(mysqli_query($con, "SELECT id FROM update_comments WHERE userid = '".$_COOKIE["id"]."'"));
$ach_book = explode(":",$logged["bookmarks"]);
$ach_bcount = count($ach_book)-1;
$securityCheck = sql("SELECT id FROM s_questions WHERE userid = '".$_COOKIE["id"]."'");
// /* DC Achievements */
if(online()){
	$amountOfUserChao = numRows("SELECT id FROM chao WHERE owner = '".$_COOKIE["id"]."'");
	$firstChao = ($amountOfUserChao >= 1);
	$getCE = explode(":",$logged["chaos_emeralds"]);
	$CEamount = count($getCE)-1;
	$allSeven = ($CEamount == 7);
	$userInvisChaoCheck = numRows("SELECT id FROM chao WHERE invis = 'y' AND owner = '".$_COOKIE["id"]."'");
	$userInvisChao = ($userInvisChaoCheck >= 1);
	$perfectChaos = sql("SELECT id,image FROM chao WHERE image = 'chaos/Chaos 7.gif' AND owner = '".$_COOKIE["id"]."'");
	$haveIt = ($perfectChaos["id"] != "");
	/* ------------- --------------*/
	if($logged["website"] != ""){
		$afGet = sql("SELECT id FROM affiliates WHERE url = '".$logged["website"]."'");
		$afCheck = ($afGet["id"] != "") ? 1 : 0;
	}
	$checkRG = sql("SELECT id FROM rg_names WHERE name = '".addslashes($logged["display"])."'");
	$CHRG = ($checkRG["id"] == "") ? 0 : 1;
	$AlienChaoImage = numRows("SELECT image FROM chao WHERE image = 'Alien.gif' AND owner = '".$_COOKIE["id"]."'");
	$alienChao = ($AlienChaoImage >=1);
	$sonicBoom = numRows("SELECT image FROM chao WHERE image = 'super-sonic.gif' AND owner = '".$_COOKIE["id"]."'");
	$superShadow = numRows("SELECT image FROM chao WHERE image = 'Super Shadow.gif' AND owner = '".$_COOKIE["id"]."'");
}
?>
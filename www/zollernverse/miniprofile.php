<?php
$rowspan = (preg_match("/profile/i",$_SERVER["REQUEST_URI"])) ? "8" : "6";
$userdataID = ($userdata["id"] != "") ? $userdata["id"] : 0;
$userCheckID = sql("SELECT id FROM members WHERE id = '".$userdataID."'");
?>
<tr>
<td class="mainbg2" style="vertical-align: top; width: 20%;" rowspan="<?php echo $rowspan; ?>">
<?php
echo "<div class=\"mainbg pageContent\" style=\"border-radius: 4px; border: 1px solid #ccc; text-align: center;\">
<div class=\"title topBorder\">".getDisplay($userdataID)."</div>";
$rank;
$star;
if($userdataID != 0){
switch($userdata["perms"]){
default:
$star[$userdataID] = "buttons/bullet_star.png";
break;
case '1.5':
$rank[$userdataID] = "Board Mod";
break;
case '2':
$rank[$userdataID] = "Moderator";
$star[$userdataID] = "buttons/mod_star.png";
break;
case '3':
$rank[$userdataID] = "Site Staff";
$star[$userdataID] = "buttons/staff_star.png";
break;
case '4';
case '5':
$rank[$userdataID] = "Administrator";
$star[$userdataID] = "buttons/admin_star.png";
break;
}
echo $rank[$userdataID];
if($star[$userdataID] != "buttons/bullet_star.png") echo "<br />";
	$getrank = sql("SELECT name FROM ranks WHERE posts <= '".postCount($userdataID)."' ORDER BY posts DESC");
	$rank2 = $getrank["name"];
if($star[$userdataID] != ""){
	for($h=0;$h<5;$h++){
		echo "<img src=\"".$star[$userdataID]."\" />";
	}
	echo "<br />".$rank2." (<a href=\"?act=vmedals&user=".$userdataID."\">".number_format($userdata["gpoints"])."G</a>)<br />";
}
if($userdata["customTitle"] != ""){
	echo "<div style=\"text-align: center;\">".ubbc($userdata["customTitle"])."</div>";
}
if($userdata["warn"] > 0){
	echo "<div style=\"text-align: left !important;\">
		&nbsp; 
		<img src=\"buttons/poll_left.gif\" />";
	if($userdata["warn"] <= 10){
		$warnTimes = 5;
	}elseif($userdata["warn"] <= 20){
		$warnTimes = 8;
	}elseif($userdata["warn"] <= 30){
		$warnTimes = 10;
	}elseif($userdata["warn"] <= 40){
		$warnTimes = 15;
	}elseif($userdata["warn"] <= 45){
		$warnTimes = 17;
	}elseif($userdata["warn"] <= 50){
		$warnTimes = 25;
	}elseif($userdata["warn"] <= 60){
		$warnTimes = 28;
	}elseif($userdata["warn"] <= 70){
		$warnTimes = 35;
	}elseif($userdata["warn"] <= 80){
		$warnTimes = 40;
	}elseif($userdata["warn"] <= 90){
		$warnTimes = 46;
	}elseif($userdata["warn"] <= 95){
		$warnTimes = 48;
	}else{
		$warnTimes = 50;
	}
	for($i=0;$i<$warnTimes;$i++){
		echo "<img src=\"buttons/poll_middle.gif\" />";
	}
	echo "<img src=\"buttons/poll_right.gif\" />
	</div>";
	echo "<a href=\"javascript:nWin('warn.php?id=".$userdataID."');\">".$userdata["warn"]."%</a>";
}
}
echo "</div>
<div class=\"brl\"></div>
";
if(!$logged["hide_av"]){
if($userdata["avatar"] != ""){
echo "<div style=\"text-align: center;padding: 2px;\"><img src=\"".$userdata["avatar"]."\" style=\"width:100px;height:100px;border-radius:25%;\" /></div>";
}
}
if($userdata["p_quote"] != ""){
echo "<div class=\"pageContent\" style=\"text-align: center;\">".$userdata["p_quote"]."</div>";
}
$banCheck = sql("SELECT id FROM banned WHERE userid = '".$userdataID."'");
if($banCheck["id"] != ""){
	echo "<img src=\"buttons/banned.gif\" />";
}
if($userdataID != 0){
?>
<br />
<table class="table bordercolor" cellspacing="1" cellpadding="4" style="width: 190px !important;">
<tr><th class="catbg" colspan="2">User Info</th></tr>
<tr><td class="mainbg pageContent">Joined:</td><td class="mainbg2 pageContent"><?php echo date("M Y",strtotime($userdata["joined"])); ?></td></tr>
<tr><td class="mainbg2 pageContent" colspan="2" style="text-align: center;"><?php $check = sql("SELECT id FROM members WHERE UNIX_TIMESTAMP(lastonline) >= '".(time()-300)."' AND id = '".$userdataID."'");
				if(!$userdata["invisible"] OR checkPerms(3)){
				if($check["id"] != ""){
					echo "<img src=\"buttons/status_online.png\" /> <strong>Online</strong>";
				}else{
					echo "<img src=\"buttons/status_offline.png\" /> Offline";
				}
				}else{
					echo "<img src=\"buttons/status_offline.png\" /> Offline";
				}
                          ?></td></tr>
<?php if($userdata["gender"] != "") { ?>
<tr><td class="mainbg pageContent">Gender:</td><td class="mainbg2 pageContent"> <?php echo ucfirst($userdata["gender"]);
					if($userdata["gender"] != "robot"){
					$gender = ($userdata["gender"] == "male") ? "male" : "female";
					echo " <img src=\"buttons/".$gender.".png\" style=\"height:20px;width:20px;\" />";
					}
					?></td></tr>
<?php } ?>
<tr><td class="mainbg pageContent">Species:</td><td class="mainbg2 pageContent"><?php echo ucfirst($userdata["species"]); ?></td></tr>
<?php
if($userdata["location"] != ""){
	echo "<tr><td class=\"mainbg pageContent\">Location:</td><td class=\"mainbg2 pageContent\">".stripslashes($userdata["location"])."</td></tr>";
}
?>
<tr><td class="mainbg pageCotent">Posts:</td><td class="mainbg2 pageContent"><?php echo number_format(postCount($userdataID)); ?></td></tr>
<tr><td class="mainbg pageContent">Tokens:</td><td class="mainbg2 pageContent">$<?php echo number_format(getTokens($userdataID)); ?></td></tr>
<?php 
	if($userdata["xbox_tag"] != ""){
	?>
<tr><td class="mainbg pageContent"><img src="buttons/xbox.png" style="height:20px;width:20px;" /> GT:</td><td class="mainbg2 pageContent"> <?php echo $userdata["xbox_tag"]; ?></td></tr>
	<?php
	}
	if($userdata["psn"] != ""){
	?>
	<tr><td class="mainbg pageContent"><img src="buttons/controller.png" style="height:20px;width:20px;" /> PSN:</td><td class="mainbg2 pageContent"> <?php echo $userdata["psn"]; ?></td></tr>
	<?php
	}
	if($userdata["wii_code"] != ""){
	?>
	<tr><td class="mainbg pageContent"><img src="buttons/wii.png" style="height:20px;width:20px;" /> Wii Code:</td><td class="mainbg2 pageContent" style="overflow: auto;"> <?php echo $userdata["wii_code"]; ?></td></tr>
	<?php
	}
	$nextRank = sql("SELECT posts,name FROM ranks WHERE posts > ".postCount($userdataID)." ORDER BY posts ASC");
	$warnImage;
	switch($userdata["warn"]){
		default:
			$warnImage = "battery_full";
		break;
		case '25':
			$warnImage = "battery_half";
		break;
		case '75':
			$warnImage = "battery_low";
		break;
		case '100':
			$warnImage = "battery_drained";
		break;
	}
?>
<tr><td class="mainbg pageContent">Next Rank:</td><td class="mainbg2 pageContent"><?php echo $nextRank["posts"] - postCount($userdataID); ?></td></tr>
<tr><td class="mainbg pageContent">Warn:</td><td class="mainbg2 pageContent"><img src="buttons/<?php echo $warnImage; ?>.png" /> <?php echo "<a href=\"javascript:nWin('warn.php?id=".$userdataID."');\">".$userdata["warn"]."</a>"; ?>%</td></tr>
<tr><th class="catbg" colspan="2">Contact</th></tr>
<tr><td class="mainbg pageContent" colspan="2">
<a href="?act=sendpm&user=<?php echo $userdataID; ?>"><img src="buttons/folder_go.png" title="Send PM" /></a> &nbsp; 
<?php
if($userdata["aim"] != ""){
	echo "<a href=\"aim:goim?screenname=".$userdata["aim"]."&message=Hello,%20".$userdata["aim"]."\"><img src=\"buttons/aol_messenger.png\" title=\"AIM\" /></a> &nbsp; ";
}
if($userdata["skype"] != ""){
	echo "<img src=\"buttons/skype.png\" title=\"Skype\" /> &nbsp;";
}
if($userdata["yim"] != ""){
	echo "<a href=\"http://edit.yahoo.com/config/send_webmesg?.target=".$userdata["yim"]."\"><img src=\"buttons/yahoo_messenger.png\" title=\"YIM\" /></a> &nbsp;";
}
if($userdata["msn"] != ""){
	echo "<img src=\"buttons/msn_messenger.png\" title=\"MSN\" /> &nbsp;";
}
if($userdata["website"] != ""){
	echo "<a href=\"".$userdata["website"]."\" onclick=\"window.open(this.href);return false;\"><img src=\"buttons/home_page.png\" title=\"Web Site\" /></a>";
}
?>
</td>
</tr>
</table>
</div>
<?php 
$rep = sql("SELECT karma FROM karma WHERE userid = '".$userdataID."'");
echo "<div class=\"pageContent\" style=\"text-align: center;\">Reputation: ".$rep["karma"]."</div>
	<div style=\"text-align: center;\">";
	if(!isMe($userdataID) AND online() AND gamerPoints($_COOKIE["id"]) >= 50){
		$lastKarma = sql("SELECT id FROM members WHERE id = '".$_COOKIE["id"]."' AND UNIX_TIMESTAMP(last_karma) >= '".(time()-3600)."'");
		if($lastKarma["id"] == ""){
			echo "[ <a href=\"?act=karma&user=".$userdataID."&vote=1\">Vote Up</a> | <a href=\"?act=karma&user=".$userdataID."&vote=0\">Vote Down</a> ]
		<br />";
		}
	}
	if(checkPerms(3) AND !isMe($userdataID)){
		echo "<a href=\"?act=banuser&id=".$userdataID."\" onclick=\"if(!reConf('Are you sure you want to ban this user?')) return false;\" class=\"siteLink\"><img src=\"buttons/ip_block.png\" /> Ban</a>";
	}
	if(isMe($userdataID) OR checkPerms(3)){
		echo " &nbsp; &nbsp; <a href=\"?act=editprofile&u=".$userdataID."\" class=\"siteLink\"><img src=\"buttons/user_edit.png\" /> Edit</a>";
	}
	echo "</div>";
}
?>
</td>
</tr>
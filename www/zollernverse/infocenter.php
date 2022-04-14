<?php
if($_GET["act"] != "viewtopics"){
$nt = numRows("SELECT id FROM topics WHERE reply != 'yes'");
$np = numRows("SELECT id FROM topics WHERE reply = 'yes'");
$sitedata = sql("SELECT * FROM sitedata");
?>
<table class="table bordercolor" cellspacing="1" cellpadding="4">
<tr><th class="titlebg pageContent" colspan="4"><?php echo stripslashes($sitedata["forum_name"]); ?> Stats</th></tr>
<tr><td class="mainbg pageContent" style="vertical-align: top; width: 25%;"><div class="title topBorder">Online Now</div>
<div style="height: 120px; width: 100%; overflow-y: auto; overflow-x: hidden;" id="online">
<?php echo currentlyOnline(); ?>
</div>
</td>
<td class="mainbg pageContent">
<div style="text-align:left;">
Threads: <?php echo number_format($nt); ?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
Replies: <?php echo number_format($np); ?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
Total Posts: <?php echo number_format($nt+$np); ?>
</div>
<div id="lastPost" style="padding: 2px;">
<?php getForumLastPost(); ?>
</div>
<div style="text-align:center;">
<form action="?act=recentposts" method="post">
Recent Posts:
<input type="text" value="10" style="text-align:center;" size="1" name="rposts" id="rp" class="form-control" />
<button type="submit" name="submit" id="go" class="formButton form-control">Go</button>
</form>
</div>
<a href="javascript:;" onclick="updateOnline();">Refresh Online Now</a> &bull; 
<a href="javascript:;" onclick="updateForumLastPost();">Refresh Last Post</a>
<div class="brl"></div>
<div style="font-size:12px;text-align:left !important; padding: 2px;">
Total Members: <a href="?act=members"><?php echo mysql_num_rows(mysql_query("SELECT id FROM members")); ?></a>
<?php 
$newest = sql("SELECT id,s_tag,name,gender,display FROM members ORDER BY id DESC LIMIT 1");
$nm = numRows("SELECT id FROM pm WHERE touser = '".$_COOKIE["id"]."' AND unread = 'yes'");
?>
<div style="height: 1px;"></div>
Latest Member: <?php echo getDisplay($newest["id"]); ?>
</div>
<?php
if(online()){
?>
<div style="text-align:right !important;"><a href="?act=sendpm" class="siteLink">Send PM</a> - Inbox (<a href="?act=inbox" class="siteLink"><?php echo number_format($nm); ?></a>)</div>
<div id="mu" style="font-size:12px;">
Most users online at one time was <strong><?php echo $sitedata["mostusers"]; ?></strong> on <?php echo dateFormat($sitedata["mostuserswhen"]); ?>.
</div>
<?php
}
?><td class="mainbg pageContent" style="vertical-align: top; width: 25%;"><div class="title topBorder">Online Today</div><div style="height: 120px; width: 100%; overflow-y: auto; overflow-x: hidden;">
<?php
onlineToday();
?>
</div>
</td>
</tr>
<tr>
<td class="mainbg2 pageContent" colspan="4" style="text-align: center; vertical-align: top;">
<?php
if(online()){
echo "<form action=\"javascript:setStatus();\" method=\"post\" name=\"set_status\">
	  <label for=\"status\" class=\"formLabel\">Update Status:</label>
		<input type=\"text\" value=\"What's going on right now?\" onfocus=\"this.value='';\" onblur=\"(this.value == '') ? this.value='What\'s going on right now?' : '';\" size=\"40\" name=\"status\" id=\"sform\" class=\"form-control\" />
		<button type=\"submit\" name=\"submit\" id=\"statusButton\" class=\"formButton form-control\">Set</button>
	  </form>
	  <div id=\"status\" style=\"text-align: left;\">
		<strong>Status:</strong> ";
	  getStatus($_COOKIE["id"]);
$statusGet = sql("SELECT status FROM status_history WHERE userid = '".$_COOKIE["id"]."' ORDER BY id DESC LIMIT 1");
if($statusGet["status"] != ""){
echo " &bull; <a href=\"javascript:;\" onclick=\"clearStatus();\" class=\"siteLink\">Clear</a>";
}
echo "</div>";
}
?>
<div class="mainbg pageContent" style="width: 700px; margin: 0px auto;">
<?php getBirthdays(); ?>
<div class="brl"></div>
<?php getEvents(); ?>
</div>
</td>
</tr>
</table>
<?php
}else{
$board = sql("SELECT name FROM boards WHERE id = '".$_GET["bid"]."'");
$nt = numRows("SELECT id FROM topics WHERE reply != 'yes' AND boardid = '".$_GET["bid"]."'");
$np = numRows("SELECT id FROM topics WHERE reply = 'yes' AND boardid = '".$_GET["bid"]."'");
?>
<div style="height: 10px;"></div>
<table cellspacing="1" cellpadding="4" class="table bordercolor">
<tr><th class="titlebg pageContent" colspan="4"><?php echo $board["name"]; ?> Statistics</th></tr>
<tr>
<td class="mainbg pageContent" style="vertical-align: top;">
<div style="text-align:left;">
Threads: <?php echo number_format($nt); ?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
Replies: <?php echo number_format($np); ?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
Total Posts: <?php echo number_format($nt+$np); ?>
</div>
<div id="lastPost" style="padding: 4px; height: 10px; text-align: center;">
<?php getForumLastPost(); ?>
</div>
<div style="height: 5px;"></div>
</td>
</tr>
<tr>
<td class="mainbg2 pageContent" colspan="4" align="center">
<?php
if(online()){
echo "<form action=\"javascript:setStatus();\" method=\"post\" name=\"set_status\"><strong>Update Status:</strong> <input type=\"text\" value=\"What's going on right now?\" onfocus=\"this.value='';\" onblur=\"(this.value == '') ? this.value='What\'s going on right now?' : '';\" size=\"45\" name=\"status\" id=\"sform\" /> <input type=\"submit\" value=\"Set Status\" name=\"submit\" /></form><div id=\"status\" style=\"text-align: left;\"><strong>Status:</strong> ";
	getStatus($_COOKIE["id"]);
$statusGet = sql("SELECT status FROM status_history WHERE userid = '".$_COOKIE["id"]."' ORDER BY id DESC LIMIT 1");
if($statusGet["status"] != ""){
echo " &bull; <a href=\"javascript:;\" onclick=\"clearStatus();\" class=\"siteLink\">Clear</a>";
}
echo "</div>";
}
?>
</td>
</tr>
</table>
<?php
}
?>
<?php
ob_start();
	require "functions.php"; //Functions file
	require "sql.php"; //Query File
	require "startup.php";
	$defaultSkin = sql("SELECT id FROM layouts WHERE default_layout = 1");
	$skinid = (online()) ? $logged["skinid"] : $defaultSkin["id"];
	if($skinid == "") $skinid = $defaultSkin["id"];
	if($logged["skinid"] == 0) query("UPDATE members SET skinid = '".$defaultSkin["id"]."' WHERE id = '".$_COOKIE["id"]."'");
	if($logged["tokens"] < 0) query("UPDATE members SET tokens = '0' WHERE id = '".$_COOKIE["id"]."'");
	$metas = sql("SELECT * FROM meta");
	$httpMethod = "http://";
	$root = $_SERVER["SERVER_NAME"];
	if($root == "localhost"){
		$root = $httpMethod.$root."/zollernverse/";
	}else{
		$root = $httpMethod."www.zollernverse.org/";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="name" content="<?php echo stripslashes($metas["name"]); ?>" />
		<meta name="description" content="<?php echo stripslashes($metas["about"]); ?>" />
		<meta name="author" content="<?php echo $metas["author"]; ?>" />
		<meta name="reply-to" content="<?php echo $metas["reply_to"]; ?>" />
		<meta name="copyright" content="<?php echo $metas["copyright"]; ?>" />
		<meta name="language" content="<?php echo $metas["lang"]; ?>" />
		<meta name="distribution" content="<?php echo $metas["distribution"]; ?>" />
		<meta name="title" content="<?php echo stripslashes($metas["title"]); ?>" />
		<meta name="revisit-after" content="<?php echo $metas["revisit_after"]; ?>" />
		<meta name="rating" content="<?php echo $metas["rating"]; ?>" />
		<meta name="robots" content="index,follow" />
		<link rel="shortcut icon" href="favicon.ico" />
		<!-- <link rel="stylesheet" type="text/css" href="<?php echo $root; ?>styles/skinid-8.css" media="all" id="skin-id" /> -->
		<link rel="stylesheet" href="<?php echo $root; ?>styles/layout.php" media="all" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>styles/main.css" media="all" id="main" />
		<link rel="stylesheet" href="<?php echo $root; ?>styles/forumv2.css" type="text/css" media="all" />
		<script type="text/javascript" src="<?php echo $root; ?>scripts/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $root; ?>scripts/main.js"></script>
		<?php
		$forumName = sql("SELECT forum_name FROM sitedata");
		?>
		<title><?php echo $forumName["forum_name"]; ?></title>
	<?php
		//Call the site headers..
		$sandhead = sql("SELECT header FROM sandbox");
		echo stripslashes($sandhead["header"]);
		if($sitedata["m_mode"]) setTitle("Construction Mode");
		if($_GET["act"] == "register" OR $_GET["act"] == "signup"){
			?>
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
			<?php
		}
	?>
	</head>
	<body>
	<?php
		notifications();
		//Check for sent in reports..
		if(checkPerms(3)){
			$reportNum = numRows("SELECT id FROM reports");
			if($reportNum>= 1){
				echo "<div class=\"mainbg\" style=\"border-radius: 25px; width: 750px; height: 50px; text-align: center; margin:0px auto;\"><a href=\"?act=reportcenter\" style=\"font-weight: bold; font-size: 18px;\">".FormatRes($reportNum,"Report")."</a><br />".FormatRes($reportNum,"Report")." sent in by a community member. Click the link above to view it.</div>
			<div style=\"height:25px;\"></div>";
			}
		}
	?>
	<div class="mainbg2" id="achID" style="position: absolute; width: 15%; background: #444; color: #eee; border-radius: 5px; text-align: center; padding: 4px; display: none; margin-left: 42%; margin-top: 1%; border: 1px solid #0f0;"></div>
	<?php
	AchievementCheck();
		//Require the welcome table..
		require("v2/welcome2.php");
				require "checks.php";
					switch($_GET["act"]){
					default:
					changeTitle("Home");
					require("v2/default2.php");
					break;
					case 'bank':
					onlineCheck();
					changeTitle("My SSM Account");
					$checkAccount = sql("SELECT * FROM bank_accounts WHERE userid = '".$_COOKIE["id"]."'");
					if($checkAccount["id"] == ""){
						query("INSERT INTO bank_accounts(userid,balance,last_accessed)VALUES('".$_COOKIE["id"]."',0,NOW())");
					}
					?>
					<table class="table bordercolor" cellspacing="1" cellpadding="4" id="bankTable">
					<tr>
						<th class="titlebg" colspan="5">My SSM Account</th>
					</tr>
					<tr>
						<td class="mainbg pageContent" colspan="5">
						<strong>Note:</strong> SSM stands for Site Specific Money; it is not actual money, but rather currency for the site.
						<br />
							<strong>Actions:</strong>
							<a href="javascript:;" onclick="showSection('deposit');">Deposit</a>
							&bull;
							<a href="javascript:;" onclick="showSection('withdraw');">Withdraw</a>
							<div id="ba"></div>
							<div id="deposit" style="display: none;">
							<form action="javascript:bankAction('deposit');" method="post">
							Please enter the amount you wish to deposit:
							$<input type="text" size="3" name="deposit" id="txtDeposit" />
							<input type="submit" value="Submit" id="btnDeposit" name="submit1" />
							</form>
							</div>
							<div id="withdraw" style="display: none;">
							<form action="javascript:bankAction('withdraw');" method="post">
							Please enter the amount you wish to withdraw:
							$<input type="text" size="3" name="withdraw" id="txtWithdraw" />
							<input type="submit" value="Submit" id="btnWithdraw" name="withdraw1" />
							</form>
							</div>
						</td>
					</tr>
					<tr>
						<th class="catbg">Balance</th>
						<th class="catbg">Created</th>
						<th class="catbg">Last Accessed</th>
						<th class="catbg">Deposits</th>
						<th class="catbg">Withdrawals</th>
					</tr>
					<tr>
						<td class="mainbg2 pageContent">
							$<?php echo number_format($checkAccount["balance"]); ?>
						</td>
						<td class="mainbg2 pageContent">
							<?php echo dateFormat($checkAccount["created"]); ?>
						</td>
						<td class="mainbg2 pageContent">
							<?php echo dateFormat($checkAccount["last_accessed"]); ?>
						</td>
						<td class="mainbg2 pageContent">
							<?php echo $checkAccount["deposits"]; ?>
						</td>
						<td class="mainbg2 pageContent">
							<?php echo $checkAccount["withdrawals"]; ?>
						</td>
					</tr>
					</table>
					<?php
					break;
					case 'avmanage':
					AuthCheck(3);
					$getAvs = mysqli_query($con, "SELECT id,url FROM avatars ORDER BY id ASC") OR SQLError();
					if(isset($_POST["submit"])){
						$r = explode("\r\n",$_POST["avs"]);
						foreach($r as $av){
							$avcheck = sql("SELECT id FROM avatars WHERE url = '".$av."'");
							if($avcheck["id"] != "") continue;
								query("INSERT INTO avatars(url)VALUES('".$av."')");
						}
						loguser($_COOKIE["id"],"edited the forum avatars.");
						forumMsg("Your avatars were successfully updated.");
						admin();
					}else{
						echo "<div class=\"bordercolor table\">
							<div class=\"titlebg\">User Avatars</div>
							<div class=\"mainbg2\">
							This is a list of all the current avatars that are available to a user by default. To add another, simply add another URL on a new line.<br />
							<form action=\"\" method=\"post\">
							<textarea cols=\"40\" rows=\"10\" name=\"avs\" id=\"avs\">";
							while($a = fetch($getAvs)){
								echo $a["url"]."\r\n";
							}
							echo "</textarea>
							<br />
							<input type=\"submit\" value=\"Save Changes\" name=\"submit\" id=\"sc\" />
							</form>
							</div>
							<div class=\"titlebg\">
							</div>
						</div>";
					}
					break;
					case 'changepass':
						onlineCheck();
						changeTitle("Change Password");
						$id = $_COOKIE["id"];
						$data = sql("SELECT pass,newsys,newpass FROM members WHERE id = '".$id."'");
						$xc = new XCrypt();
						$oldPass = $data["pass"];
						$newPass = $data["newpass"];
						$ok = 0;
       	              	$sqCheck = sql("SELECT id FROM s_questions WHERE userid = '".$_COOKIE["id"]."'");
						if($sqCheck["id"] == ""){
							errMsg('You must <a href="?act=securequestion" class="nWin">set up a security question</a> first before you can change your password.');
						}
						if(isset($_POST["passSubmit"])){
							$postPass = $_POST["password"];
							$postOldPass = md5($postPass);
							$postNewPass = $xc->encrypt($postPass);
							if($data["newsys"] == 'yes'){
								if($postNewPass == $newPass){
									$ok = 1;
								}else{
									errMsg("The current password entered was incorrect.<br />NEW: ".$postNewPass.":".$data["newpass"]);
								}
							}else{
								if($postOldPass == $oldPass){
									$ok = 1;
								}else{
									errMsg("The current password entered was incorrect.OLD");
								}
							}
							if($ok){
								$postPassNew = $_POST["passwordNew1"];
								$postPassOld1 = md5($postPassNew);
								$postPassNew2 = ($xc->encrypt($postPassNew));
								query("UPDATE members SET pass = '".$postPassOld1."', newsys = 'yes', newpass = '".$postPassNew2."', secure_check = 0 WHERE id = '".$id."'");
								logUser($id,"changed their account's password.");
								forumMsg("Your password was successfully changed.");
							}
						}else{
							?>
						<form action="?act=changepass" method="post">
							<table class="table pageContent bordercolor" cellspacing="1" cellpadding="4">
								</tr>
								<tr>
									<th class="titlebg" colspan="2">Change Password</th>
								</tr>
								<tr>
									<td class="mainbg" colspan="2">
										You may change your password using this form. For a strong, secure password, use the free <a href="http://www.zollernverse.org/xcrypt/index.php" class="nWin">XCrypt Generator</a> Web app.
									</td>
								<tr>
									<td class="mainbg2">
										<label for="password" class="formLabel">Current Password:</label>
									</td>
									<td class="mainbg">
										<input type="password" id="txtPass" class="form-control" name="password" />
									</td>
								</tr>
								<tr>
									<td class="mainbg2">
										<label for="password" class="formLabel">New Password:</label>
									</td>
									<td class="mainbg">
										<input type="password" id="txtPassNew1" class="form-control" name="passwordNew1" />
									</td>
								</tr>
								<tr>
									<td class="mainbg2">
										<label for="password" class="formLabel">Confirm Password:</label>
									</td>
									<td class="mainbg2">
										<input type="password" id="txtPassNew2" class="form-control" name="passwordNew2" />
									</td>
								</tr>
								<tr>
									<td class="mainbg" style="text-align: center;" colspan="2"> &nbsp; &nbsp; &nbsp;<button type="submit" class="form-control formButton" name="passSubmit" id="btnPass">Save Changes</button></td>
								</tr>
							</table>
						</form>
							<?php
						}
					break;
					case 'viewtopics':
						if(!intval($_GET["bid"])) errMsg("Invalid query.");
						$bdata2 = sql("SELECT name,staff,banned,ctg_id,whopost,watchers,p_req,post_en,order_by,header,footer FROM boards WHERE id = '".$_GET["bid"]."'");
						if(postCount($_COOKIE["id"]) < $bdata2["p_req"] AND !checkPerms(3)){
							errMsg("Whoops! Sorry, you don't have enough posts to enter this board yet; you need <strong>".($bdata2["p_req"]-postCount($_COOKIE["id"]))."</strong> more posts.");
						}
						$ctg = sql("SELECT id,name FROM ctgs WHERE id = '".$bdata2["ctg_id"]."'");
						if($bdata2["staff"]) AuthCheck(2);
						$banned = explode(",",$bdata2["banned"]);
						if(online()){
						if(in_array($logged["name"],$banned)){
							unauthorized();
						}
						}
						viewCheck($_GET["bid"]);
						changeTitle($bdata2["name"]);
						$subCheck = mysqli_query($con, "SELECT id,subboard FROM boards WHERE subboard = '".$_GET["bid"]."'");
							$siteData = sql("SELECT tpp FROM sitedata");
							$numberOfTopicsPerPage = $siteData["tpp"];
						if(mysqli_num_rows($subCheck) != 0){
							echo "<!-- Sub Boards -->\r\n";
							?>
							<table class="table bordercolor pageContent" cellspacing="1" cellpadding="4">
							<tr><th class="titlebg" colspan="5">Sub Boards</th></tr>
							<?php
							while($b = fetch($subCheck)){
								fetchBoard($b["id"]);
							}
							?>
							<tr><th class="titlebg" colspan="5">&nbsp;</th></tr>
							</table>
							<br />
							<?php
						}
								if($bdata2["header"] != ""){
									echo $bdata2["header"];
								}
						echo "<form action=\"\" method=\"post\">
						<table class=\"table bordercolor pageContent\" cellspacing=\"1\" cellpadding=\"4\"><tr><th class=\"titlebg\" colspan=\"5\">".$bdata2["name"]."</th></tr>
						<tr><td class=\"mainbg2\" colspan=\"5\"><strong>Category:</strong> <a href=\"?act=viewcategory&id=".$ctg["id"]."\">".$ctg["name"]."</a></td></tr>";
						?>
						<tr>
						<th class="titlebg">&nbsp;</th>
						<th class="titlebg">Subject</th>
						<th class="titlebg">Started By</th>
						<th class="titlebg">Replies</th>
						<th class="titlebg">Last Post</th>
						</tr>
						<?php
						$getAnnounced = mysqli_query($con, "SELECT * FROM topics WHERE reply != 'yes' AND announced = '1' ORDER BY last_updated DESC") OR SQLError();
						if(mysqli_num_rows($getAnnounced)> 0){
							echo "<tr><th class=\"titlebg\" colspan=\"5\">Announcements</th></tr>";
							while($announced = fetch($getAnnounced)){
							$lp = sql("SELECT * FROM topics WHERE reply = 'yes' AND topic_id = '".$announced["id"]."' ORDER BY id DESC LIMIT 1");
							$u = sql("SELECT name,display,s_tag FROM members WHERE id = '".$lp["userid"]."'");
							$lp2 = ($lp["id"] != "") ? "on ".dateFormat($lp["posted"])." by ".getDisplay($lp["userid"]) : "No replies..";
							$userdata = sql("SELECT * FROM members WHERE id = '".$announced["userid"]."'");
							$o = explode(":",$announced["readby"]);
							$k = (in_array($_COOKIE["id"],$o)) ? "" : "<img src=\"new.png\" />&nbsp;";
							$replies = numRows("SELECT id FROM topics WHERE reply = 'yes' AND topic_id = '".$announced["id"]."'");
							$totalAn = ceil($replies/10);
							echo "<tr><td class=\"mainbg2\" style=\"width: 8%;\"><img src=\"buttons/folder_blue.png\" />";
							if($announced["locked"]) echo "<br />LOCKED";
							echo "</td><td class=\"mainbg\" style=\"width: 45%;\" onmouseover=\"hCell(this);\" onmouseout=\"uhCell(this);\"><a href=\"?act=topic&id=".$announced["id"]."\" class=\"siteLink\">".$k.stripslashes($announced["subject"])."</a><br /><div style=\"font-size:12px;\"><strong>Posted:</strong> ".dateFormat($announced["posted"])."</div><br /><span style=\"font-weight:bold;font-size:13px;\">Description: </span> <div style=\"font-size:13px;\">".ubbc($announced["description"])."</div>";
							if($totalAn> 1){
								echo "<br />(( Pages: ";
								$ta = 1;
								$taCH = 0;
								while($ta <= $totalAn){
									$taCH++;
									echo "<a href=\"?act=topic&id=".$announced["id"]."&p=".$ta."\">".$ta."</a>";
									if($taCH < $totalAn){
										echo ", ";
									}
									$ta++;
								}
								echo " ))";
							}
							echo "</td><td class=\"mainbg2\" align=\"center\">".getDisplay($announced["userid"])."</td><td class=\"mainbg2\" align=\"center\" width=\"1%\"><a href=\"javascript:;\" onclick=\"nWin('replies.php?id=".$announced["id"]."');\">".$replies."</a></td><td class=\"mainbg\">".$lp2."</tr>";
						}
						echo "<tr><th class=\"titlebg\" colspan=\"5\">&nbsp;</th></tr>";
						}
						$getStickies = mysqli_query($con, "SELECT * FROM topics WHERE boardid = '".$_GET["bid"]."' AND reply != 'yes' AND stickied = '1' ORDER BY last_updated DESC") OR SQLError();
						$gp = makePages($numberOfTopicsPerPage,"p");
						$p = $gp["0"];
						$gettopics = mysqli_query($con, "SELECT * FROM topics WHERE boardid = '".$_GET["bid"]."' AND reply != 'yes' AND stickied = '0' ORDER BY last_updated DESC") OR SQLError();
						$nt = mysqli_num_rows($gettopics);
						$which = $gp["1"];
						$totalPages = ceil($nt/$numberOfTopicsPerPage);
						$ntpp = mysqli_query($con, "SELECT * FROM topics WHERE boardid = '".$_GET["bid"]."' AND reply != 'yes' AND stickied != '1' ORDER BY ".$bdata2["order_by"]." LIMIT ".$which.", ".$numberOfTopicsPerPage) OR SQLError();
						if($nt == 0 AND mysqli_num_rows($getStickies) == 0){
							echo "<tr><td align=\"center\" class=\"mainbg2\" colspan=\"5\">No topics have been made in this board yet.</td></tr>";
						}
						if(online()){
							echo "<tr><td class=\"mainbg2 pageContent\" colspan=\"5\" align=\"right\"><div class=\"titlebg\" style=\"width: 180px; border-radius: 4px; font-size: 13px; border: 1px solid #000000; float: left;\"><a href=\"?act=markread&board=".$_GET["bid"]."\">Mark Read</a></div>";
							if($bdata2["whopost"] == "everyone" OR checkPerms(3)){
								echo " <div class=\"titlebg\" style=\"width: 180px; border-radius: 4px; font-size: 13px; border: 1px solid #000000;  \"><a href=\"?act=post&board=".$_GET["bid"]."\">New Thread</a></div>
								&nbsp; &nbsp; 
									<div class=\"titlebg\" style=\"width: 180px; border-radius: 4px; font-size: 13px; border: 1px solid #000000;  \"><a href=\"?act=post&board=".$_GET["bid"]."&poll=1\">New Poll</a></div>";
							if(numRows("SELECT id FROM drafts WHERE boardid = '".$_GET["bid"]."' AND userid = '".$_COOKIE["id"]."'") > 0){
								echo "<div style=\"text-align:left !important; height: 16px; width: 16px;\"><img src=\"buttons/information.png\" /> You have a saved draft!</div>";
							}
							}else{
								echo "<br /> Only staff may post in this board.";
							}
							$listeners = explode(":",$bdata2["watchers"]);
							$ihtml = (!in_array($_COOKIE["id"],$listeners)) ? "<div class=\"titlebg\" style=\"width: 180px; border-radius: 4px; font-size: 13px; border: 1px solid #000000; float: left;\"><a href=\"javascript:;\" onclick=\"listenTo(".$_GET["bid"].");\">Subscribe</a></div>" : "<div class=\"titlebg\" style=\"width: 180px; border-radius: 4px; font-size: 16px; border: 1px solid #000000; float: left;\"><a href=\"javascript:;\" onclick=\"listenTo(".$_GET["bid"].");\">Unsubscribe</a></div>";
							echo "<div id=\"listen\">".$ihtml."</div>";
							if(online()){
								$topicViews = array("all:All Topics","friends:Friends' Topics","my:My Topics"/*,"subscribed:Subscription Topics"*/);
								echo "<div class=\"sbreak\"></div>
								Viewing: 
								<select name=\"view\" onchange=\"topicView(this.options[this.selectedIndex].value,".$_GET["bid"].");\" class=\"form-control\">";
								foreach($topicViews as $tv){
									$tviews = explode(":",$tv);
									echo "<option value=\"".$tviews["0"]."\">".$tviews["1"]."</option>";
								}
								echo "</select>";
							}
							echo "</td></tr>
							<tbody id=\"topicView\">";
						}
						while($sticky = fetch($getStickies)){
							fetchTopic($sticky["id"],"sticky");
						}
						while($t = mysqli_fetch_assoc($ntpp)){
							fetchTopic($t["id"]);
						}
						echo "</tbody><tr><td class=\"mainbg2\" colspan=\"5\">";
						if($totalPages> 1){
							echo "<strong>Pages:</strong> ((";
							$cH=0;
							$i=1;
							while($i <= $totalPages){
								$cH++;
								echo " <a href=\"?act=viewtopics&bid=".$_GET["bid"]."&p=".$i."\">".$i."</a>";
								if($cH<$totalPages) echo ", ";
								$i++;
							}
							echo " ))<br />";
							?>
							Page Jump: <input type="text" size="4" name="goto" id="gopage" class="form-control" /> 
							<script type="text/javascript">
							<!--
							var iGo = $('#gopage');
							// -->
							</script>
							<input type="button" onclick="location.href='<?php echo $root; ?>?act=viewtopics&bid=<?php echo $_GET["bid"]; ?>&p='+iGo.val();" value="Jump" name="buttonJump" class="form-control" />
							<?php
						}
						?>
						<br />
						<?php if(checkPerms(3)){ ?>
						<input type="checkbox" onclick="javascript:checkAll();" name="selectall" id="sa" class="form-control" /> <div id="sv">Select All</div>
						<br />
						&nbsp; &nbsp; &nbsp; &nbsp; With Selected: 
						<select name="action" class="form-control">
							<option value="lock">Lock / Unlock</option>
							<option value="sticky">Sticky / UnSticky</option>
							<option value="delete">Delete</option>
							<option value="bump">Bump</option>	
						  </select>
									   <button type="submit" name="submit" id="go" class="formButton form-control">Go</button>
						               <br />
						<?php
						}
						?>
						<div style="font-size:16px;font-weight:bold;">Legend:</div>
						<div class="mainbg">
						<img src="buttons/accept.png" /> = You have posted here
						&nbsp; &nbsp;
						<img src="new.png" /> = New post
						&nbsp; &nbsp;
						<img src="buttons/topic_folder.png" /> = Regular topic
						&nbsp; &nbsp; 
						<img src="buttons/folder_red.png" /> = Sticky topic
						&nbsp; &nbsp;
						<img src="buttons/folder_blue.png" /> = Announcement
						<br />
						<img src="buttons/folder_black.png" /> = Locked
						&nbsp; &nbsp;
						<img src="buttons/sticky_lock.png" /> = Locked sticky
						</div>
						<?php
						echo "</td></tr>";
						$gv = mysqli_query($con, "SELECT userid FROM viewing WHERE boardid = '".$_GET["bid"]."' AND UNIX_TIMESTAMP(viewing)>= '".(time()-300)."'");
						if(mysqli_num_rows($gv) != 0){
							echo "<tr><td class=\"mainbg2\" colspan=\"5\"><strong>Users Viewing This Board:</strong> ";
							$cH=0;
							while($v = fetch($gv)){
								$cH++;
								echo ubbc("[user=".$v["userid"]."]");
								if($cH<mysqli_num_rows($gv)){
									echo ", ";
								}
							}
						}
						if(!$bdata2["post_en"]){
							echo "<tr>
								<td class=\"mainbg2\" colspan=\"5\">Tokens are <strong>disabled</strong> in this board. You will not receive them when you post.</td>
							</tr>";
						}
						echo "<tr><th class=\"titlebg\" colspan=\"5\">&nbsp;</th></tr></table>
						</form>";
						include 'infocenter.php';
								if($bdata2["footer"] != ""){
									echo $bdata2["footer"];
								}
						if(isset($_POST["submit"])){
							$gtp = mysqli_query($con, "SELECT id,locked,stickied,topic_id FROM topics WHERE boardid = '".$_GET["bid"]."'") OR SQLError();
							while($tp = fetch($gtp)){
								if($_POST["ch".$tp["id"]] == "on"){
									switch($_POST["action"]){
									case 'delete':
										query("DELETE FROM topics WHERE id = '".$tp["id"]."' OR topic_id = '".$tp["id"]."'");
										loguser($_COOKIE["id"],"ran an advanced moderation deletion command on the [b]".$bdata2["name"]."[/b] board.");
										toLoc("?act=viewtopics&bid=".$_GET["bid"]);
									break;
									case 'lock':
										$wh = ($tp["locked"]) ? 0 : 1;
										query("UPDATE topics SET locked = '".$wh."' WHERE id = '".$tp["id"]."'");
										loguser($_COOKIE["id"],"ran an advanced moderation lock command on the [b]".$bdata2["name"]."[/b] board.");
										toLoc("?act=viewtopics&bid=".$_GET["bid"]);
									break;
									case 'sticky':
										$wh = ($tp["stickied"]) ? 0: 1;
										query("UPDATE topics SET stickied = '".$wh."' WHERE id = '".$tp["id"]."'");
										loguser($_COOKIE["id"],"ran an advanced moderation sticky command on the [b]".$bdata2["name"]."[/b] board.");
										toLoc("?act=viewtopics&bid=".$_GET["bid"]);
									break;
									case 'bump':
										query("UPDATE topics SET last_updated = CURRENT_TIMESTAMP WHERE id = '".$tp["id"]."'");
										loguser($_COOKIE["id"],"ran an advanced moderation bump command on the [b]".$bdata2["name"]."[/b] board.");
										toLoc("?act=viewtopics&bid=".$_GET["bid"]);
									break;
									}
								}
							}
						}
					break;
					case 'topic':
						idCheck();
						$np = NumRows("SELECT * FROM topics WHERE topic_id = '".$_GET["id"]."' ORDER BY posted ASC");
						$gp = makePages(10,"p");
						$p = ((int)$_GET["p"]==1 OR $_GET["p"]==0)?0:($_GET["p"]);
						$which = $gp["1"];
						$tdata = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
						if($_GET["id"] != $tdata["topic_id"])
							errMsg("This topic does not exist. It might have been deleted, or somebody may have given you a false link.");
						if($tdata["subject"] == "") errMsg("This topic does not exist. It might have been deleted, or someone may have given you a false link.");
						$board = sql("SELECT name,staff,banned,ctg_id,p_req FROM boards WHERE id = '".$tdata["boardid"]."'");
						if(postCount($_COOKIE["id"]) < $board["p_req"] AND !checkPerms(3)){
							$pAmount = $board["p_req"]-postCount($_COOKIE["id"]);
							errMsg("Whoops! Sorry, you need <strong>".$pAmount."</strong> more posts before you can enter this board.");
						}
						$c = sql("SELECT name FROM ctgs WHERE id = '".$board["ctg_id"]."'");
						if($board["staff"] AND !checkPerms(2)) unauthorized();
						if(online()){
							$banned = explode(",",$board["banned"]);
							if(in_array($logged["name"],$banned)) unauthorized();
						}
						changeTitle($tdata["subject"]);
						if(online()){
							$t = explode(":",$tdata["readby"]);
							if(!in_array($_COOKIE["id"],$t)){
								$t[] = $_COOKIE["id"];
								$t2 = implode(":",$t);
								query("UPDATE topics SET readby = '".$t2."' WHERE id = '".$_GET["id"]."'");
							}
						}
						$siteData = sql("SELECT ppp FROM sitedata");
						$numberOfPostsPerPage = $siteData["ppp"];
						viewCheck($tdata["boardid"]);
						updateViews($_GET["id"]);
						$userdata = sql("SELECT * FROM members WHERE id = '".$tdata["userid"]."'");
						$board = sql("SELECT name,ctg_id FROM boards WHERE id = '".$tdata["boardid"]."'");
						$tp = ceil(($np-1)/$numberOfPostsPerPage);
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4" id="t<?php echo $_GET["id"]; ?>">
						<tr><th class="titlebg">User</th><th class="titlebg">Post</th></tr>
						<tr><td class="mainbg2" colspan="2"><strong>Category:</strong> <a href="?act=viewcategory&id=<?php echo $board["ctg_id"]; ?>"><?php echo stripslashes($c["name"]); ?></a> &nbsp; &nbsp; <strong>Board:</strong> <a href="?act=viewtopics&bid=<?php echo $tdata["boardid"]; ?>"><?php echo stripslashes($board["name"]); ?></a>
						<?php
						$pollCheck = sql("SELECT * FROM polls WHERE topic_id = '".$_GET["id"]."'");
						if($pollCheck["id"] != ""){
							if(online() AND canVote($pollCheck["id"])){
								echo "<form action=\"\" method=\"post\">";
							}
								echo "<div class=\"table bordercolor\">
							<div class=\"titlebg\">Poll: ".stripslashes($pollCheck["question"])."</div>
							<div class=\"mainbg\" style=\"border-radius: 25px; padding: 4px;\">
							<strong>Choose Below:</strong><br />";
							$choices = explode("|",$pollCheck["choices"]);
							$i=1;
							$nv = array();
							foreach($choices as $opt){
								if($opt == "") continue;
								$votes = explode(":",$opt);
								$nv[] = $votes["1"];
								if(online() AND canVote($pollCheck["id"])){
									echo "<input type=\"radio\" name=\"option\" value=\"".$opt."\" id=\"opt[]\" />";
								}
								echo " (".FormatRes($votes["1"],"Vote").") ".stripslashes($votes["0"])."<br />";
								$i++;
							}
							if(online() AND canVote($pollCheck["id"])){
								echo "<input type=\"submit\" value=\"Cast Vote\" name=\"poll\" id=\"cv\" />";
							}
								echo "</div>";
							if(online() AND canVote($pollCheck["id"])){
								echo "</form>
								You are allowed to vote ".FormatRes($pollCheck["num_votes"],"time").".<br />";
							}
							if(checkPerms(3)){
								echo "<strong>Staff Functions</strong>: ";
								if(!$pollCheck["locked"]){
									echo "<a href=\"?act=lockpoll&id=".$pollCheck["id"]."\">Lock</a>";
								}else{
									echo "<a href=\"?act=unlockpoll&id=".$pollCheck["id"]."\">Unlock</a>";
								}
							}
							if(isset($_POST["poll"])){
								if(!online()) unauthorized();
								if(!canVote($pollCheck["id"])) errMsg("You are no longer eligible to vote in this poll.");
								$ch = explode(":",$_POST["option"]);
								$t = $ch["1"]+1;
								$y = str_replace($_POST["option"],$ch["0"].":".$t,$pollCheck["choices"]);
								query("UPDATE polls SET choices = '".addslashes($y)."' WHERE topic_id = '".$_GET["id"]."'");
								query("INSERT INTO voters(userid,poll_id)VALUES('".$_COOKIE["id"]."','".$pollCheck["id"]."')");
								toLoc("?act=topic&id=".$_GET["id"]);
							}
						}
						if($tp> 1){
							echo "<br /><br />
							<select name=\"page\" onchange=\"toLoc('?act=topic&id=".$_GET["id"]."&p='+this.options[this.selectedIndex].value);\" class=\"form-control\">
							<option value=\"\">---- Pages ----</option>";
							$i=1;
							while($i<=$tp){
								echo "<option value=\"".$i."\">Page ".$i."</option>";
								$i++;
							}
							echo "</select>";
						}
						?>
						</td></tr>
						<?php if($p<=1){ ?>
						<tr><th class="titlebg" colspan="2"><?php echo stripslashes($tdata["subject"]); ?> &nbsp; &nbsp; &nbsp; &nbsp; (<?php echo FormatRes($tdata["views"],"View"); ?>)</th></tr>
						<?php require("miniprofile.php"); ?>
						<tr><td class="mainbg" style="vertical-align: top;" height="24">
						<?php
						$gprev = mysqli_query($con, "SELECT topic_id,subject FROM topics WHERE id < ".$_GET["id"]." AND boardid = '".$tdata["boardid"]."' AND reply != 'yes' ORDER BY id DESC LIMIT 1") OR SQLError();
						$numPrev = mysqli_num_rows($gprev);
						if($numPrev> 0){
						 	$prev = fetch($gprev);
						 echo "&laquo; Previous (<a href=\"?act=topic&id=".$prev["topic_id"]."\">".stripslashes($prev["subject"])."</a>) &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;";
						}
						$gnext = mysqli_query($con, "SELECT topic_id,subject FROM topics WHERE id> ".$_GET["id"]." AND boardid = '".$tdata["boardid"]."' AND reply != 'yes' ORDER BY id ASC LIMIT 1") OR SQLError();
						$numNext = mysqli_num_rows($gnext);
						if($numNext> 0){
						$next = fetch($gnext);
						echo " Next (<a href=\"?act=topic&id=".$next["topic_id"]."\">".stripslashes($next["subject"])."</a>) &raquo;";
						}
						?>
						<div style="font-size:12px;"><strong>Topic Description:</strong> <?php echo ubbc($tdata["description"])."<div style=\"text-align:left;\">&laquo; <strong>Topic Made:</strong> ".dateFormat($tdata["posted"])." &raquo; <div id=\"icon\">";
						$likedBy = explode(":",$tdata["likedBy"]);
						$icon = (in_array($_COOKIE["id"],$likedBy)) ? "thumb_down" : "thumb_up";
						if(online()){
							echo "<a href=\"javascript:;\" onclick=\"likeTopic(".$_GET["id"].");\">";
							echo "<img src=\"buttons/".$icon.".png\" />";
							echo "</a> ";
					}
       	              		$d = count($likedBy)-1;
       	              		if($d>0){
       	              		$i=1;
       	              		$cH=0;
       	              		echo "<div style=\"border-radius:25px;height:27px;padding:2px;\" class=\"mainbg2\">";
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
       	              		$likes = ($d> 1) ? "like" : "likes";
       	              		echo " ".$likes." this topic.</div>";
       	              		}
       	              				if($tdata["autoLock"]>0){
							echo "<br />This thread features AutoLock. It will automatically lock after <strong>".$tdata["autoLock"]."</strong> posts.";
						}
						echo "</div>";
						$tags = explode(",",$tdata["tags"]);
						if(count($tags)> 0){
							foreach($tags as $t){
								if($t == "") continue;
								$t2 = str_replace(" ","",$t);
								echo "
								<a href=\"".$root."?act=search&filter=".$t2."\"><img src=\"buttons/tag_blue.png\" style=\"height:20px;width:20px;\" />".$t2."</a> (".numRows("SELECT id FROM topics WHERE tags LIKE '%".addslashes($t2)."%'").") &nbsp; &nbsp; ";
							}
						}
						if(online()){
						if(!$tdata["locked"] OR checkPerms(3)){
						?>
						<div align="right">
						<div style="border: 2px outset #000000; width: 75px; padding: 2px; border-radius: 25px; cursor: pointer;" class="mainbg" onclick="showMenu('atmenu');"><span style="font-size: 12px;">Options</span> &#9660;</div>
						<div style="width: 125px; text-align: left; padding: 2px; border: 1px solid #000000; border-radius: 25px; position: absolute; right: 222px; display: none; " class="mainbg2" id="atmenu" name="atmenu">
						<?php
							if(!isMe($tdata["userid"])){
								echo '<div><img src="'.$root.'buttons/comment.png" /> <a href="javascript:;" onclick="quote('.$tdata["id"].');showSection(\'atmenu\');">Quote</a></div>';
							}
						        if(isMe($tdata["userid"]) OR checkPerms(3)){ 
						        	echo '<div><img src="'.$root.'buttons/pencil.png" /> <a href="'.$root.'?act=modifypost&id='.$tdata["id"].'">Modify</a></div>';
							}
							if(checkPerms(3)){
								echo '<div><img src="'.$root.'buttons/delete.png" /> <a href="javascript:;" onclick="if(reConf(\'Are you sure you wish to delete this entire topic and all of its posts?\')) deleteTopic(\''.$tdata["id"].'\'); showSection(\'atmenu\');">Delete</a></div>
								     <div><img src="'.$root.'buttons/arrow_right.png" style="height:20px;width:20px;" /> <a href="'.$root.'?act=movetopic&id='.$_GET["id"].'">Move</a></div>';
							}
							$udbm = sql("SELECT bookmarks FROM members WHERE id = '".$_COOKIE["id"]."'");
							$bookmarks = explode(":",$udbm["bookmarks"]);
							echo "<div id=\"bookmark\" name=\"bookmark\">";
							if(!in_array($_GET["id"],$bookmarks)){
								echo "<img src=\"".$root."buttons/book_add.png\" style=\"height: 20px; width: 20px;\" /> <a href=\"javascript:;\" onclick=\"bookmarkTopic(".$_GET["id"].");showSection('atmenu');\"> Bookmark</a>";
							}else{
								echo "<a href=\"javascript:;\" onclick=\"removeBookmark(0, ".$_GET["id"].");showSection('atmenu');\"><img src=\"".$root."buttons/book_delete.png\" style=\"height: 20px; width: 20px;\" /> Unbookmark</a>";
							}
							echo "</div>";
						?>
						</div>
						</div>
						</div>
						</div>
						</td>
						</tr>
						<?php }
						 }
						?>
						<tr>
						<td class="mainbg" style="vertical-align: top;" name="<?php echo $tdata["id"]; ?>">
						<div id="m<?php echo $tdata["id"]; ?>" class="post">
						<?php 
							echo "<div id=\"userPost".$tdata["id"]."\"";
							if(checkPerms(3) OR isMe($tdata["userid"])){
								if(checkPerms(3) OR !$tdata["locked"]){
									echo " ondblclick=\"switchEdit(".$tdata["id"].",'edit');\"";
								}
							}
							echo ">".ubbc($tdata["post"])."</div>";
						?>
						</div>
						</td>
						</tr>
						<?php
						echo "<tr><td class=\"mainbg\" style=\"vertical-align: top\" style=\"text-align: right; height: 10px;\">
							  <div style=\"font-size:13px;\">";
						$getNotes = mysqli_query($con, "SELECT * FROM notes WHERE topic_id = '".$_GET["id"]."'");
						if(mysqli_num_rows($getNotes) != 0){
							echo "<div style=\"font-weight:bold;text-align:left;\"><img src=\"".$root."buttons/note.png\" /> Notes:</div>
							<div class=\"mainbg2\" style=\"border-radius:25px;text-align:left;padding:2px;\">";
							while($n = fetch($getNotes)){
								echo getDisplay($n["userid"])." ".ubbc($n["note"])."<br />";
							}
							echo "</div>";
						}
						echo "
						<div style=\"text-align: right; font-size: 13px;\">
						Word Count: ";
							$wordCount = explode(" ",$tdata["post"]);
							echo number_format(count($wordCount));
						echo "</div>";
						if(online()){
							if($tdata["lastedit"] != 0){
								echo "Last Edit: ".getDisplay($tdata["lastedit"])." &nbsp; &nbsp;";
								if($tdata["edit_reason"] != ""){
									echo "(Reason: ".stripslashes($tdata["edit_reason"]).")";
								}
								echo " <br />";
							}
							if(checkPerms(3)){
								?>
								<?php
							echo "<div class=\"report mainbg2\" id=\"n".$_GET["id"]."\">
								<form action=\"javascript:sendNote(".$_GET["id"].",".$_COOKIE["id"].");\" method=\"post\">
								<div style=\"text-align:center;\">Staff Notes:</div>
									<input type=\"text\" size=\"65\" name=\"n".$_GET["id"]."\" required=\"1\" id=\"note".$_GET["id"]."\" class=\"form-control\" />
									<br />
									<button type=\"submit\" class=\"formButton form-control\">Submit Note</button>
								</form>
								<a href=\"javascript:;\" onclick=\"showSection('n".$_GET["id"]."');\">close</a>
							</div>";
						}
								echo "<div class=\"report mainbg2\" id=\"r".$_GET["id"]."\">
								<form action=\"javascript:report(".$_GET["id"].",".$_COOKIE["id"].");\" method=\"post\">
								<div style=\"text-align:center;\">Please provide us with a few brief details:</div>
									<input type=\"text\" size=\"65\" name=\"details\" required=\"1\" id=\"details".$_GET["id"]."\" />
									<br />
									<input type=\"submit\" value=\"Submit Report\" name=\"submit\"  />
								</form>
								</div>";
								if(checkPerms(3)){
								echo "<a href=\"javascript:;\" onclick=\"showSection('n'+".$_GET["id"].");\"><img src=\"".$root."buttons/note_add.png\" /> Add Note</a> &nbsp; &nbsp;";
								}
								echo " <a href=\"javascript:;\" onclick=\"showSection('r".$_GET["id"]."');\"><img src=\"".$root."buttons/siren.png\" /> Report Topic</a>
								&nbsp; &nbsp; ";
						}
						echo "<a href=\"".$root."?act=topic&id=".$_GET["id"]."\"><img src=\"".$root."buttons/world.png\" /> Link to this Post</a> &nbsp; &nbsp;
						 <a href=\"#top\"><img src=\"".$root."buttons/arrow_up.png\" /> To Top</a>";
						if(checkPerms(3)){
							echo " &nbsp; &nbsp; <img src=\"".$root."buttons/ip.png\" /> ".$userdata["ip"]."";
						}
						echo "</div></td></tr>
						<tr><td class=\"mainbg\" style=\"vertical-align: top\" height=\"24\"><div style=\"font-size:12px;\">";
						if(!$logged["hide_sig"]){
							echo ubbc($userdata["sig"]);
						}
						echo "</div></td></tr>";
						}
							$getposts = mysqli_query($con, "SELECT * FROM topics WHERE topic_id = '".$_GET["id"]."' AND reply = 'yes' ORDER BY posted ASC LIMIT ".$which.", ".$numberOfPostsPerPage) OR exit(mysqli_error());
							$tdClass = array();
							$tdClass["0"] = "mainbg";
							$nextTd = 1;
							while($posts = mysqli_fetch_assoc($getposts)){
								$userdata = sql("SELECT * FROM members WHERE id = '".$posts["userid"]."'");
								echo "<tbody id=\"p".$posts["id"]."\"><tr><th class=\"titlebg\" colspan=\"2\">Re: ".$tdata["subject"]."</th></tr>";
								require("miniprofile.php");
								$tdClass[$nextTd] = ($tdClass[$nextTd-1] == "mainbg") ? "mainbg2" : "mainbg";
								echo "<tr><td class=\"".$tdClass[$nextTd]."\" style=\"vertical-align: top;\" height=\"24\"><a name=\"".$posts["id"]."\"></a>";
								?>
								<div style="font-size:14px;">
								&laquo; <strong>Replied: </strong> <?php echo dateFormat($posts["posted"]); ?> &raquo;
								</div>
								<?php
								if(!$tdata["locked"] OR checkPerms(3)){
								?>
								<div style="text-align:right;">
								<a href="javascript:;" onclick="quote(<?php echo $posts["id"]; ?>);"><img src="quote.gif" /></a>
								<?php
								if(isMe($posts["userid"]) OR checkPerms(3)){
								?>
									<a href="?act=modifypost&id=<?php echo $posts["id"]; ?>"><img src="modify.gif" style="border: none;" /></a>
									<?php if(checkPerms(3)) { ?>
									<a href="javascript:;" onclick="function rC(){ return confirm('Are you sure you want to delete this post?'); } if(rC()){ deletePost('<?php echo $posts["id"]; ?>'); }"><img src="delete.gif" style="border: none;" /></a>
									<?php } ?>
								</div>
								<?php
								}
								}
								echo "</td></tr>
								<tr>
								<td class=\"".$tdClass[$nextTd]."\" style=\"vertical-align: top;\">
									<div id=\"userPost".$posts["id"]."\"";
									if(checkPerms(3) OR isMe($posts["userid"])){
										if(checkPerms(3) OR !$tdata["locked"]);
											echo " ondblclick=\"switchEdit(".$posts["id"].",'edit');\"";
									}
									echo " class=\"post\">".ubbc($posts["post"])."</div>";
								echo "</td></tr>
								<tr><td class=\"".$tdClass[$nextTd]."\" style=\"vertical-align: top\" height=\"10\" align=\"right\"><div style=\"font-size:13px;\">";
								if(online()){
								if(checkPerms(3)){
									echo "<div class=\"report mainbg2\" id=\"n".$posts["id"]."\">
								<form action=\"javascript:sendNote(".$posts["id"].",".$_COOKIE["id"].");\" method=\"post\">
								<div style=\"text-align:center;\">Staff Notes:</div>
									<input type=\"text\" size=\"65\" name=\"n".$posts["id"]."\" required=\"1\" id=\"note".$posts["id"]."\" />
									<br />
									<input type=\"submit\" value=\"Submit Note\" />
								</form>
								<a href=\"javascript:;\" onclick=\"showSection('n".$posts["id"]."');\">close</a>
							</div>";
								}
									echo "
								<div class=\"report mainbg2\" id=\"r".$posts["id"]."\">
								<form action=\"javascript:report(".$posts["id"].",".$_COOKIE["id"].");\" method=\"post\">
								Please provide us with a few brief details:<br />
									<input type=\"text\" size=\"65\" name=\"details\" required=\"1\" id=\"details".$posts["id"]."\" class=\"form-control\" />
									<div class=\"b\"></div>
									<button type=\"submit\" name=\"submit\" class=\"formButton form-control\" id=\"btnSubmit\">Submit Report</button>
								</form>
								</div>";
						$getNotes2 = mysqli_query($con, "SELECT * FROM notes WHERE topic_id = '".$posts["id"]."'");
						if(mysqli_num_rows($getNotes2) != 0){
							echo "<div style=\"font-weight:bold;text-align:left;\"><img src=\"".$root."buttons/note.png\" /> Notes:</div>
							<div class=\"mainbg2\" style=\"border-radius:25px;text-align:left;padding:2px;\">";
							while($n = fetch($getNotes2)){
								echo getDisplay($n["userid"])." ".ubbc($n["note"])."<br />";
							}
							echo "</div>";
						}
								if($posts["lastedit"] != 0){
									echo "Last Edit: ".getDisplay($posts["lastedit"])." &nbsp; &nbsp; ";
									if($posts["edit_reason"] != ""){
										echo "(Reason: ".stripslashes($posts["edit_reason"]).")";
									}
									echo "<br />";
								}
						if(checkPerms(3)){
							echo "<a href=\"javascript:;\" onclick=\"showSection('n".$posts["id"]."');\"><img src=\"".$root."buttons/note_add.png\" /> Add Note</a> &nbsp; &nbsp; ";
						}
								echo  "<a href=\"javascript:;\" onclick=\"showSection('r'+".$posts["id"].");\"><img src=\"".$root."buttons/siren.png\" /> Report Post</a> &nbsp; &nbsp; ";
								}
								echo "<a href=\"".$root."?act=topic&id=".$_GET["id"]."#".$posts["id"]."\"><img src=\"".$root."buttons/world.png\" /> Link to this Post</a> &nbsp; &nbsp; <a href=\"#top\"><img src=\"".$root."buttons/arrow_up.png\" /> To Top</a>";
								if(checkPerms(3)){
									echo " &nbsp; &nbsp; <img src=\"".$root."buttons/ip.png\" /> ".$userdata["ip"];
								}
								echo "</div></td></tr>
								<tr><td class=\"".$tdClass[$nextTd]."\" style=\"vertical-align: top\" height=\"24\"><div style=\"font-size:12px;\">";
								if(!$logged["hide_sig"]){
									echo ubbc($userdata["sig"]);
								}
								echo "</div></td></tr></tbody>";
								$nextTd++;
							}
							if($tp> 1){
							?>
							<tr><td class="mainbg2" colspan="2">
							<select name="pages" onchange="toLoc('<?php echo $root; ?>?act=topic&id=<?php echo $_GET["id"]; ?>&p='+this.options[this.selectedIndex].value);" class="form-control">
							<option value="">---- Pages ----</option>
							<?php 
								$i = 1;
								while($i<=$tp){
									echo "<option value=\"".$i."\">Page ".$i."</option>";
									$i++;
								}
							?>
							</select>
							</td></tr>
							<?php
							}
							if(online()){
								$bd2 = sql("SELECT whopost,watchers,post_en FROM boards WHERE id = '".$tdata["boardid"]."'");
								if($bd2["whopost"] == "everyone" OR checkPerms(3)){
								if(!$tdata["locked"] OR checkPerms(3)){
								if(isset($_POST["submit"]) AND $_POST["post"] != ""){
									$previousPost = sql("SELECT userid FROM topics WHERE topic_id = '".$_GET["id"]."' ORDER BY id DESC LIMIT 1");
									if($previousPost["userid"] == $_COOKIE["id"] AND !checkPerms(3)) errMsg("You were the last one to post in this topic. Please wait for someone else to post first.");
									mysqli_query($con, "INSERT INTO topics(subject,post,userid,boardid,topic_id,reply)VALUES('".addslashes("Re: ".$tdata["subject"])."','".addslashes($_POST["post"])."','".$_COOKIE["id"]."','".$tdata["boardid"]."','".$_GET["id"]."','yes')") OR exit("Reply: ".mysqli_error());
									$n = mysqli_insert_id();
									notifyUser($previousPost["userid"],"[user=".$_COOKIE["id"]."] replied to your [url=?act=topic&id=".$_GET["id"]."]topic[/url].");
									if($bd2["post_en"]){
										addTokens($_COOKIE["id"],10);
									}
									query("UPDATE topics SET readby = '' WHERE id = '".$_GET["id"]."'");
									query("UPDATE topics SET last_updated = CURRENT_TIMESTAMP WHERE id = '".$_GET["id"]."'");
									loguser($_COOKIE["id"],"replied to the topic [url=".$root."?act=topic&id=".$_GET["id"]."]".$tdata["subject"]."[/url].");
									$w = explode(":",$bd2["watchers"]);
									foreach($w AS $ID){
										if($ID == "") continue;
										sendPM($ID,'3',"New Post!","Hiya! There's been a new post in a board you've subscribed to. [br][br] Click [url=".$root."?act=topic&id=".$_GET["id"]."]here[/url] to view the topic. To unsubscribe, simply click on \"Unsubscribe\" on the view topics page of the board.[br][br]You're welcome!",0);
										query("UPDATE members SET lastonline = CURRENT_TIMESTAMP WHERE id = '3'");
										loguser('3',"sent a PM to [user=".$ID."].");
									}
									$getSubbed = mysqli_query($con, "SELECT email,display,topic_email FROM members WHERE id = '".$tdata["userid"]."'") OR SQLError();
									while($subbed = fetch($getSubbed)){
										if($subbed["topic_email"] AND $tdata["userid"] != $_COOKIE["id"]){
											$id = $_COOKIE["id"];
       	              									$headers  = 'MIME-Version: 1.0' . "\r\n";
											$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
											$headers .= "From: noreply@zollernverse.org";
											$message = "Hello, ".$subbed["display"]."! You are receiving this e-mail because there has been a new post in a topic that you made and subscribed to, by [user=".$id."] : [url=".$root."?act=topic&id=".$_GET["id"]."#".$n."]".$tdata["subject"]."[/url]: By: [user=".$_COOKIE["id"]."]:[br][br]-------Message--------[br]".$_POST["post"]."[br]-------End-------[br][br]To no longer receive these messages, log in with your username and password, and change the Topic E-Mail section in your profile to \"Unsubscribed.\" Have a great day![br][hr][b]DO NOT[/b] reply to this e-mail.";
											mail($subbed["email"],"Reply in \"".stripslashes($tdata["subject"])."\"",ubbc($message),$headers);
											loguser('3',"An e-mail was sent to [user=".$tdata["userid"]."] because their topic was updated.");
										}
									}
									$nextPage = ($tp> 1) ? "&p=".$tp : "";
									toLoc("?act=topic&id=".$_GET["id"].$nextPage."#".$n);
							     }
							if(checkPerms(3)){
								echo "<tr><td align=\"center\" class=\"mainbg2\" colspan=\"2\" id=\"staffArea\">";
								$lock = ($tdata["locked"]) ? "unlock" : "lock";
								$lockImage = ($tdata["locked"]) ? "folder_unlock" : "folder_black";
								$sticky = ($tdata["stickied"]) ? "unsticky" : "sticky";
								$an = ($tdata["announced"]) ? "unannounce" : "announce";
								$al = ($tdata["autolock"]>0) ? "active" : $tdata["autolock"];
								echo "<a href=\"".$root."?act=".$sticky."topic&id=".$_GET["id"]."\"><img src=\"".$root."".$sticky.".png\" /></a> &nbsp; &nbsp; <a href=\"".$root."?act=".$lock."topic&id=".$_GET["id"]."\"><img alt=\"[".$lock."]\" src=\"".$root."buttons/".$lockImage.".png\" /></a> &nbsp; &nbsp; <a href=\"".$root."?act=".$an."topic&id=".$_GET["id"]."\"><img src=\"announce.png\" /></a> &nbsp; &nbsp; <a href=\"".$root."?act=movetopic&id=".$_GET["id"]."\"><img src=\"".$root."buttons/arrow_right.png\" /></a></td></tr>";
							}
							if(!$tdata["locked"] OR checkPerms(3)){
							$lpid = sql("SELECT userid FROM topics WHERE topic_id = '".$_GET["id"]."' ORDER BY id DESC LIMIT 1");
							if($lpid["userid"] != $_COOKIE["id"] OR checkPerms(4)){
						?>
						<tr><th class="titlebg" colspan="4">Reply</th></tr>
						<tr>
						<td class="mainbg" colspan="4">
						<a name="reply"></a>
						<form action="" method="post" name="replyForm" id="replyForm">
						Message:
						<div style="height: 10px;"></div>
						<textarea cols="100" rows="5" name="post" id="post" class="form-control"></textarea>
							<script src="scripts/nicEdit.js" type="text/javascript"></script>
							<?php
							$fullPanel = (checkPerms(4)) ? "{fullPanel: true}" : "";
							?>
							<script type="text/javascript">
							new nicEditor(<?php echo $fullPanel; ?>).panelInstance('post');
							</script>
						<div style="height: 15px;"></div>
						<button type="submit" name="submit" id="s" class="formButton form-control">Post Reply</button>
						</form>
						</td>
						</tr>
						<?php
						}else{
							echo "<tr><td class=\"mainbg\" colspan=\"2\">You were the last one to post in this topic. Please wait for someone else to post first.</td></tr>";
						}
						}else{
							echo "<tr><td class=\"mainbg\" colspan=\"2\"><strong>Sorry, but this topic has been locked. Only staff may reply to it.</strong></td></tr>";
						}
						?>
						</table>
						<?php
						}
						}
						}
					break;
					case 'locktopic':
					AuthCheck(3);
					idCheck();
					query("UPDATE topics SET locked = '1' WHERE id = '".$_GET["id"]."'");
					$data = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
					loguser($_COOKIE["id"],"locked topic [url=?act=topic&id=".$_GET["id"]."]".$data["subject"]."[/url].");
					header("Location: ".$root."?act=topic&id=".$_GET["id"]);
					break;
					case 'unlocktopic':
					AuthCheck(3);
					idCheck();
					query("UPDATE topics SET locked = '0' WHERE id = '".$_GET["id"]."'");
					$data = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
					loguser($_COOKIE["id"],"unlocked topic [url=?act=topic&id=".$_GET["id"]."]".$data["subject"]."[/url].");
					header("Location: ".$root."?act=topic&id=".$_GET["id"]);
					break;
					case 'lockpoll':
					AuthCheck(3);
					idCheck();
					$tdata = sql("SELECT topic_id FROM polls WHERE id = '".$_GET["id"]."'");
					query("UPDATE polls SET locked = 1 WHERE id = '".$_GET["id"]."'");
					toLoc($root."?act=topic&id=".$tdata["topic_id"]);
					break;
					case 'unlockpoll':
					AuthCheck(3);
					idCheck();
					$tdata = sql("SELECT topic_id FROM polls WHERE id = '".$_GET["id"]."'");
					query("UPDATE polls SET locked = 0 WHERE id = '".$_GET["id"]."'");
					toLoc($root."?act=topic&id=".$tdata["topic_id"]);
					break;
					case 'stickytopic':
					AuthCheck(3);
					idCheck();
					query("UPDATE topics SET stickied = '1' WHERE id = '".$_GET["id"]."'");
					$data = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
					loguser($_COOKIE["id"],"stickied topic [url=?act=topic&id=".$_GET["id"]."]".$data["subject"]."[/url].");
					header("Location: ".$root."?act=topic&id=".$_GET["id"]);
					break;
					case 'unstickytopic':
					AuthCheck(3);
					idCheck();
					query("UPDATE topics SET stickied = '0' WHERE id = '".$_GET["id"]."'");
					$data = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
					loguser($_COOKIE["id"],"unstickied topic [url=?act=topic&id=".$_GET["id"]."]".$data["subject"]."[/url].");
					header("Location: ?act=topic&id=".$_GET["id"]);
					break;
					case 'announcetopic':
					AuthCheck(3);
					idCheck();
					query("UPDATE topics SET announced = '1' WHERE id = '".$_GET["id"]."'");
					$data = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
					loguser($_COOKIE["id"],"announced topic [url=?act=topic&id=".$_GET["id"]."]".$data["subject"]."[/url].");
					header("Location: ?act=topic&id=".$_GET["id"]);
					break;
					case 'unannouncetopic':
					AuthCheck(3);
					idCheck();
					query("UPDATE topics SET announced = '0' WHERE id = '".$_GET["id"]."'");
					$data = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
					loguser($_COOKIE["id"],"unannounced topic [url=?act=topic&id=".$_GET["id"]."]".$data["subject"]."[/url].");
					header("Location: ?act=viewtopics&bid=".$data["boardid"]);
					break;
					case 'profile':
					case 'user':
						(int) $uid = (!intval($_GET["u"])) ? intval($_COOKIE["id"]) : intval($_GET["u"]);
						$userdata = sql("SELECT * FROM members WHERE id = '".$uid."'");
						if($userdata["id"] == "") errMsg("This profile does not exist.");
						foCheck($uid);
						$display = ($_COOKIE["id"] == $uid) ? "My" : $userdata["display"]."'s";
						changeTitle($display." Profile");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="2"><?php echo $display; ?> Profile</th></tr>
						<?php require "miniprofile.php"; ?>
						<tr>
						<td class="mainbg2 pageContent" style="vertical-align: top">
						<?php
						if(checkPerms(4) OR isMe($uid)){
							echo "<a href=\"?act=editprofile&u=".$uid."\"><img src=\"buttons/user_edit.png\" /> Edit &nbsp;</a>";
						}
						if(online()){
							echo " &nbsp; <a href=\"?act=status_history&user=".$uid."\"><img src=\"buttons/attributes_display.png\" /> Status History</a>";
						}
						if(online()){
							echo " &nbsp; <a href=\"?act=displayhistory&user=".$uid."\"><img src=\"buttons/cats_display.png\" /> Name History</a>
							       &nbsp; <a href=\"?act=readjournals&userid=".$_COOKIE["id"]."\"><img src=\"buttons/clipboard.png\" /> View Journals</a>";
						}
						if(checkPerms(3) AND !isMe($uid)){
							echo " &nbsp; <a href=\"?act=banuser&id=".$uid."\" onclick=\"return reConf('Are you sure you wish to ban this user?');\"><img src=\"buttons/ip_block.png\" /> Banish User</a>";
							$b = ($userdata["token_banned"]) ? "Unban" : "Ban";
							echo " &nbsp; <a href=\"?act=tokenban&id=".$uid."\"><img src=\"buttons/coins.png\" /> Token ".$b."</a>";
						}
						if(checkPerms(3) AND !isMe($uid)){
							echo " &nbsp; <a href=\"?act=flaguser&id=".$uid."\"><img src=\"buttons/flag_1.png\" /> Flag User</a>";
						}
						if(online()){
						?>
						&nbsp; <a href="?act=sendpm&user=<?php echo $uid; ?>"><img src="buttons/folder_go.png" /> Send PM</a>
						<?php } if($userdata["website"] != ""){ ?>
						&nbsp; <a href="<?php echo $userdata["website"]; ?>" onclick="window.open(this.href);return false;"><img src="buttons/website.png" /> View Site</a>
						<?php } ?>
						</td>
						</tr>
						<tr>
						<td class="mainbg pageContent" style="vertical-align: top">
						<?php
						 if(online() AND !isMe($uid)){
						 	if(!checkFriend($_COOKIE["id"],$uid)){
						 		$reqCheck = sql("SELECT id FROM freq WHERE touser = '".$uid."' AND fromuser = '".$_COOKIE["id"]."'");
						 		if($reqCheck["id"] == ""){
						 			echo "<div class=\"pageContent\" style=\"border-radius:10px;border:1px outset;width:100px;padding:2px;\"><a href=\"javascript:;\" onclick=\"addFriend(".$uid.");\" id=\"fbutton\"><img src=\"buttons/bullet_add.png\" /> Add Friend</a></div>";
						 		}else{
						 			echo "<div style=\"font-weight:bold;\" class=\"pageContent\">Request Sent!</div>";
						 		}
						 	}else{
						 		echo "<div class=\"pageContent\" style=\"border-radius:10px;border:1px outset;width:130px;padding:2px;\"><a href=\"javascript:;\" onclick=\"removeFriend(".$uid.");\" id=\"fbutton\"><img src=\"buttons/cancel.png\" /> Remove Friend</a></div>";
						 	}
						 }
						echo getStatus($uid); ?>
						<div style="text-align: right;">
						<a href="?act=buddies&id=<?php echo $uid; ?>" class="siteLink">View Friends (<?php
							$uf = explode(":",$userdata["friends"]);
							echo (count($uf)-1);
						?>)</a>
						<?php
						if(!isMe($uid)){
						 $mf = array();
						 $myFriends = explode(":",$logged["friends"]);
						 if(in_array($uid,$myFriends)){
						 	foreach($uf as $mt){
						 		if(in_array($mt,$myFriends) AND !isMe($mt)){
						 			$mf[] = $mt;
						 		}
						 	}
						 }
						 $numMut = (count($mf));
						 echo "<div class=\"pageContent\"><a href=\"javascript:;\" onclick=\"showSection('mf');\">".FormatRes($numMut,"Mutual Friend")."</a>";
						 if($numMut > 0){
						 	echo "<div id=\"mf\" style=\"display: none;\">";
						 		$cH = 0;
						 		 foreach($mf as $friend){
						 		 	if($friend == "") continue;
						 		 	$cH++;
						 		 	echo getDisplay($friend)."";
						 		 	if($cH<$numMut){
						 		 		echo ", ";
						 		 	}else{
						 		 		echo " ";
						 		 	}
						 		 }
						 		echo "</div>";
						 }
						 echo "</div>";
						} 
						?>
						</div>
						<br />
						<p>
						<strong>Username:</strong> <?php echo $userdata["name"]; ?><br />
						<strong>Forum Tag:</strong> <?php echo getDisplay($uid); ?><br />
						<strong>E-Mail:</strong> <?php if(checkPerms(3) OR isMe($uid)) echo "<a href=\"mailto:".$userdata["email"]."\">".$userdata["email"]."</a>"; ?> <div style="font-size:13px;"><em>(visible to staff only)</em></div><br />
						<?php if($userdata["show_age"] == 'yes' OR checkPerms(3)){ ?>
						<strong>Birthday:</strong> <?php echo date("F jS, Y",strtotime($userdata["birthday"]));
						if($userdata["show_age"] == 'no' AND !checkPerms(3)) 
							echo ' <div style="font-size:13px;">(visible to staff only)</div>'; 
						if(isMe($uid)){
							echo '<br /> &nbsp; &nbsp; <span style="font-size:12px !important;" id="bres"><a href="javascript:;" onclick="sendReq(\'birthday\','.$_COOKIE["id"].');">change</a></span>';
						}
							?>
							<br />
						<strong>Age:</strong> <?php echo userAge($uid); if($userdata["show_age"] == 'no') echo ' <div style="font-size:13px;"><em>(visible to staff only)</em></div>'; ?><br />
						<?php } ?>
						<strong>Gender:</strong> <?php echo ucfirst($userdata["gender"]); ?><br />
						<strong>Species:</strong> <?php echo ucfirst($userdata["species"]); ?><br />
						<?php if($userdata["herefor"] != ""){ ?>
						<strong>Here For:</strong> <?php echo $userdata["herefor"]; ?><br />
						<?php } ?>
						<strong>Total Posts:</strong> <?php echo postCount($uid); ?><br />
						<strong>Joined On:</strong> <?php echo date("F jS, Y g:i A",strtotime($userdata["joined"])); ?><br />
						<strong>Last Online:</strong> <?php echo dateFormat($userdata["lastonline"]); ?><br />
						<strong>Achievements:</strong> <?php $e = explode(":",$userdata["medals"]); echo count($e)-1; ?> (<a href="?act=vmedals&user=<?php echo $uid; ?>">view</a>)<br />
						<strong>Gamer Points:</strong> <?php echo number_format($userdata["gpoints"]); 
						if(checkPerms(3)){
						?>
						<br />
						<strong>Last IP:</strong> <?php echo $userdata["ip"]; 
								$eIP = explode(":",$userdata["iplist"]);
								$cIP = count($eIP)-1;
								echo " (".$cIP." total) ";
								?>
						<?php }
						?><br />
						<strong>Account:</strong> <?php
							if($userdata["activated"]){
								echo "Activated";
							}else{
								echo "Not Activated";
								if(isMe($uid) OR checkPerms(4)){
									echo " <div style=\"font-size:14px;\">(<a href=\"?act=resendact&id=".$uid."\">click here to activate</a>)</div>";
								}
							}
						?>
						<?php
							$contactCheck = false;
							if($userdata["aim"] != "" OR $userdata["msn"] != "" OR $userdata["skype"] != "" OR $userdata["yim"] != "")
								$contactCheck = true;
							if($contactCheck){
								echo "<hr/>";
								if($userdata["aim"] != "")
									echo "<strong>AIM:</strong> <a href=\"aim:goim?screenname=".$userdata["aim"]."&message=Hello,%20".$userdata["aim"]."\">".$userdata["aim"]."</a><br />";
								if($userdata["skype"] != "")
									echo "<strong>Skype:</strong> ".$userdata["skype"]."<br />";
								if($userdata["msn"] != "")
									echo "<strong>MSN:</strong> <a href=\"mailto:".$userdata["msn"]."\">".$userdata["msn"]."</a><br />";
								if($userdata["yim"] != "")
									echo "<strong>Yahoo:</strong> <a href=\"http://edit.yahoo.com/config/send_webmesg?.target=".$userdata["yim"]."\">".$userdata["yim"]."</a>";
							}
						?>
						<hr/>
						<strong>Recent Posts:</strong><br />
						<?php
						$getPosts = mysqli_query($con, "SELECT id,subject,posted,userid,topic_id FROM topics WHERE userid = '".$uid."' ORDER BY id DESC LIMIT 6") OR SQLError();
						while($p = fetch($getPosts)){
							echo " &nbsp; &raquo; <a href=\"?act=topic&id=".$p["topic_id"]."#".$p["id"]."\" class=\"siteLink\">".stripslashes($p["subject"])."</a> ".dateFormat($p["posted"])."<br />";
						}
						?>
						</p>
						</td></tr>
						<tr>
						<td class="mainbg pageContent">
						<strong>About Me:</strong><br />
						<?php echo ubbc($userdata["about_me"]); ?>
						</td>
						</tr>
						<tr><td class="mainbg pageContent" colspan="2">
						<?php
						 if(!$logged["hide_sig"]){
						?>
						<p>
						<?php echo ubbc($userdata["sig"]);
						}
						?>
						</p>
						</td></tr>
						<?php
							if(online()){
							//js("getComments(".$uid.");");
						?>
						<tr>
							<td class="mainbg pageContent">
								<div style="background:#ffffff;border:1px solid #00000;color:#000000;height:150px;width:692px;overflow:auto;" id="cmnts">
								<div class="titlebg">Comments</div>
								<?php
								$getcomments = mysqli_query($con, "SELECT * FROM profile_comments WHERE prof_id = '".$uid."' ORDER BY id DESC") OR SQLError();
								while($c = fetch($getcomments)){
									echo "<div style=\"background:#aaaaaa;border-radius:25px;border-radius:25px;padding:2px;border:1px solid #000000;\">[".dateFormat($c["posted"])."] ".getDisplay($c["userid"]).": ".ubbc($c["comment"])."</div>";
								}
								?>
								</div>
							</td>
						</tr>
						<tr>
							<td class="mainbg">
							<form action="javascript:profileComment(<?php echo $uid; ?>);" method="post">
							Message:<br />
							<textarea cols="70" rows="5" name="c" id="p_cmnt"></textarea>
							<br />
							<input type="submit" value="Send" />
							</form>
							</td>
						</tr>
						<?php } ?>
						</table>
						<?php
					break;
					case 'checkpin':
						//if(!isset($_POST["pinSubmit"])) header("Location: /");
						$id = sqlEsc($_POST["id"]);
						$pin = sqlEsc($_POST["pin"]);
						$lf = $_POST["lf"];
						$data = sql("SELECT pin FROM members WHERE id = '".$id."'");
						if($pin == $data["pin"]){
							setcookie("token",createUToken($id),(time()*86400*365));
							$t = ($lf == '1') ? time()+86400*365*10 : time()+21600;
							$p = "/";
							$d = "zollernverse.org";
							setcookie("id",$id,$t);
							setcookie("st_site_id",checkSecUID3160($id),$t);
							logUser($id,"logged in.");
							toLoc("./");
						}else{
							header("Refresh: 1; forum.php?act=login");
							errMsg("The information entered was incorrect. You will be redirected to the log-in screen.");
						}
					break;
					case 'login':
						loginForm("Log in to your user account here, using the information that you provided during registration. If you have forgotten your password, don't fret - we have a way of resetting it for you.",$_POST["email"],$_POST["pass"]);
					break;
					case 'logout':
						loguser($_COOKIE["id"],"logged out.");
						setcookie("id","",time()-300);
						setcookie("st_site_id","",time()-300);
						header("Location: ".$root);
					break;
					case 'post':
						if(!online()) PleaseLogin();
						if(!(int)$_GET["board"]) errMsg("You did not specify a board to put this in.");
						$board = sql("SELECT name,staff,ctg_id,banned,whopost,watchers,post_en FROM boards WHERE id = '".$_GET["board"]."'");
						if($board["whopost"] == "staff" AND !checkPerms(3)) errMsg("Only staff may post in this board.");
						if(online()){
							$banned = explode(",",$board["banned"]);
							if(in_array($logged["name"],$banned)){
								unauthorized();
							}
						}
						$ctg = sql("SELECT name FROM ctgs WHERE id = '".$board["ctg_id"]."'");
						if($board["staff"]) AuthCheck(2);
						changeTitle($board["name"]." - Post");
						if(isset($_POST["submit"])){
							$descr = ($_POST["descr"] == "") ? "N/A" : addslashes($_POST["descr"]);
							$pCheck = explode(" ",$_POST["post"]);
							$pCheck = array_delete("\s",$pCheck);
							if(str_replace(" ","",$_POST["post"]) == "") errMsg("Your post was empty. Please press backspace and actually type something.");
							mysqli_query($con, "INSERT INTO topics(subject,reply,post,boardid,userid,description,last_updated,autoLock,tags)VALUES('".addslashes($_POST["subject"])."','no','".addslashes($_POST["post"])."','".$_GET["board"]."','".$_COOKIE["id"]."','".$descr."',CURRENT_TIMESTAMP,'".$_POST["autolock"]."','".addslashes($_POST["kw"])."')") OR exit("Post: ".mysqli_error());
							$n = mysqli_insert_id();
							if($board["post_en"]){
								addTokens($_COOKIE["id"]);
							}
							mysqli_query($con, "UPDATE topics SET topic_id = '".$n."' WHERE id = '".$n."'") OR exit("Updating: ".mysqli_error());
							loguser($_COOKIE["id"],"posted a new topic: [url=?act=topic&id=".$n."]".addslashes($_POST["subject"])."[/url].");
							query("DELETE FROM drafts WHERE userid = '".$_COOKIE["id"]."' AND boardid = '".$_GET["board"]."'");
							$watchers = explode(":",$board["watchers"]);
							foreach($watchers AS $ID){
								if($ID == "") continue;
								loguser('3',"sent a PM to [user=".$ID."].");
								notifyUser($ID,"There has been a new [url=?act=topic&id=".$n."]topic[/url] in a board that you have subscribed to.");
							}
							$opt;
							if($_GET["poll"] == 1){
								for($i=0;$i<=20;$i++){
									if(!isset($_POST["opt".$i]) OR $_POST["opt".$i] == "") continue;
									$opt .= "|".$_POST["opt".$i].":0";
								}
								query("INSERT INTO polls(question,choices,num_votes,topic_id)VALUES('".addslashes($_POST["question"])."','".$opt."','".$_POST["num_votes"]."','".$n."')");
							}
							toLoc("?act=topic&id=".$n);
						}
						?>
						<form action="?act=post&board=<?php echo $_GET["board"]; ?>" method="post" name="postForm">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg pageContent" colspan="3"><?php echo $board["name"]; ?> - Post <?php if($_GET["poll"]) echo " Poll"; ?></th></tr>
						<tr><td class="mainbg2 pageContent" colspan="3"><strong>Category:</strong> <a href="?act=viewcategory&id=<?php echo $board["ctg_id"]; ?>"><?php echo stripslashes($ctg["name"]); ?></a> &nbsp; &nbsp; <strong>Board:</strong> <a href="?act=viewtopics&bid=<?php echo $_GET["board"]; ?>"><?php echo $board["name"]; ?></a></td></tr>
						<?php
							if($_GET["poll"] == 1){
								echo "<tr>
								<td class=\"mainbg pageContent\">Question:</td>
								<td class=\"mainbg2 pageContent\" colspan=\"2\"><input type=\"text\" size=\"55\" maxlength=\"120\" value=\"".$_POST["question"]."\" name=\"question\" class=\"form-control\" /></td>
								</tr>
								<tr>
								<td class=\"mainbg pageContent\">Allowed Votes:</td>
								<td class=\"mainbg2 pageContent\" colspan=\"2\"><input type=\"text\" size=\"5\" style=\"text-align: center;\" value=\"1\" name=\"num_votes\" class=\"form-control\" /></td>
								</tr>
								<tr>
								<td class=\"mainbg pageContent\">Option 1:</td>
								<td class=\"mainbg2 pageContent\" colspan=\"2\"><input type=\"text\" size=\"40\" name=\"opt1\" id=\"opt1\" class=\"form-control\" /></td>
								</tr>
								<tr>
								<td class=\"mainbg pageContent\">Option 2:</td>
								<td class=\"mainbg2 pageContent\" colspan=\"2\"><input type=\"text\" size=\"40\" name=\"opt2\" id=\"opt2\" class=\"form-control\" /></td>
								</tr>
								<tr>
								<td class=\"mainbg pageContent\" colspan=\"3\" id=\"opt_area\" name=\"opt_area\"><div style=\"text-align: center;\"><a href=\"javascript:;\" onclick=\"addOpt();\"><img src=\"buttons/bullet_add.png\" />Add Option</a></div></td>
								</tr>";
							}
						?>
						<tr><td class="mainbg pageContent">Subject:</td>
								<td class="mainbg pageContent">
								<input type="text" size="45" id="sbjct" value="<?php
								$checkDrafts = sql("SELECT post,subject FROM drafts WHERE userid = '".$_COOKIE["id"]."' AND boardid = '".$_GET["board"]."'");
								echo stripslashes($checkDrafts["subject"]);
								?>" name="subject" required="1" class="form-control" />
								<div class="help-block">Give your topic a brief, <em>relevant</em> subject.</div>
								</td>
						</tr>
						<tr><td class="mainbg pageContent">
							Topic Description:
							</td>
							<td class="mainbg pageContent">
							<input type="text" size="45" name="descr" id="d" class="form-control" />
							<div class="help-block"><strong>Optional</strong>. Give a brief description of what your topic is about.</div>
							</td>
							</tr>
							<tr>
							<td class="mainbg pageContent" style="vertical-align: top">AutoLock:</td>
							<td class="mainbg pageContent">
								<input type="text" pattern="(\d){0,3}" size="1" value="0" style="text-align: center;" name="autolock" class="form-control" />
								<div class="help-block">Number of posts before your topic locks automatically. Leave at 0 for none.</div>
							</td>
							</tr>
							<tr>
							<td class="mainbg pageContent" style="vertical-align: top;">
							Post:
							</td>
							<td class="mainbg pageContent">
							<div class="mainbg2">
							Before posting, please make sure you've read our <a href="http://www.zollernverse.org/forum.php?act=topic&id=217" class="nWin">RULES</a> first!
							</div>
							<div id="autoSave">
							</div>
							<?php
								if($logged["draft_save"]){
									js("if($('#post').val() != \"\") setTimeout(\"saveDraft(".$_COOKIE["id"].",".$_GET["board"].",1);\",60000);");
								}
							?><a href="javascript:;" onclick="saveDraft(<?php echo $_COOKIE["id"]; ?>,<?php echo $_GET["board"]; ?>);">Save Draft</a>
							<br />
							<textarea cols="130" rows="20" name="post" id="post" required="1">&nbsp;</textarea>
							<script src="scripts/nicEdit.js" type="text/javascript"></script>
							<?php
							$fullPanel = (checkPerms(4)) ? "{fullPanel: true}" : "";
							?>
							<script type="text/javascript">
							new nicEditor(<?php echo $fullPanel; ?>).panelInstance('post');
							</script>
							</tr>
							<tr>
							<td class="mainbg2 pageContent" colspan="4">
							<strong>Buzz Words:</strong>
							<br />
							<input type="text" size="55" name="kw" id="kw" class="form-control" />
							<div class="help-block"><strong>Optional.</strong> Separate each word with a comma.</div>
							</td>
							</tr>
						<tr><td align="center" class="mainbg2 pageContent" colspan="3">
							<button type="submit" name="submit" id="sc" class="formButton form-control">Post</button>
						</td></tr>
						</table>
						</form>
						<?php
						js("var e = 2;");
					break;
					case 'members':
					changeTitle("View Members");
					$p = ($_GET["p"] == "" OR $_GET["p"] == 0) ? 0 : ($_GET["p"] - 1);
					$which = ceil($p)*10;
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr>
						<th class="titlebg" colspan="4">Members</th>
						</tr>
						<tr>
						<th class="catbg">Display</th>
						<th class="catbg">Status</th>
						<th class="catbg">Rank</th>
						<th class="catbg">Username</th>
						</tr>
						<tr>
						<td class="mainbg2" colspan="4"> &nbsp; &nbsp; &nbsp; &nbsp; <a href="?act=searchmembers"><img src="buttons/magnifier.png" /> Search.. </a></td>
						</tr>
						<?php
						$getmembers = mysqli_query($con, "SELECT display,name,s_tag,id FROM members ORDER BY name ASC LIMIT ".$which.",10") OR SQLError();
						while($members = mysqli_fetch_assoc($getmembers)){
							$s = sql("SELECT status,posted FROM status_history WHERE userid = '".$members["id"]."' ORDER BY id DESC LIMIT 1");
							echo "<tr><td class=\"mainbg\">".getDisplay($members["id"])."</td><td class=\"mainbg\">";
							if($s["status"] != ""){
								echo ubbc($s["status"])." ".dateFormat($s["posted"]);
							}else{
								echo "<em>none</em>";
							}
								echo "</td>
								<td class=\"mainbg\">
									";
								$getrank = sql("SELECT name FROM ranks WHERE posts <= '".postCount($members["id"])."' ORDER BY posts DESC");
								echo $getrank["name"]."</td>
								<td class=\"mainbg\">".$members["name"]."</td></tr>";
						}
						$nm = mysqli_num_rows(mysqli_query($con, "SELECT id FROM members"));
						$totalPages = ($nm/10);
						if($totalPages> 1){
							echo "<tr><td class=\"mainbg2\" colspan=\"4\">Pages: (( ";
							$i=0;
							$cH=0;
							while($i<$totalPages){
								$i++;
								$cH++;
								echo "<a href=\"?act=members&p=".$i."\">".$i."</a>";
								if($cH<$totalPages){
									echo ", ";
								}
							}
							echo " ))</td></tr>";
						}
						echo "<tr><th class=\"titlebg\" colspan=\"4\"> &nbsp; &nbsp; </th></tr></table>";
					break;
					case 'inbox':
						toLoc("?act=pmcenter");
					break;
					case 'sendpm':
						changeTitle("Send Message");
						if(!online()) PleaseLogin();
						if(isset($_POST["submit"])){
							$subject = ($_POST["subject"] == "") ? "-No Subject-" : $_POST["subject"];
							$touser = ((int)$_GET["user"]) ? $_GET["user"] : $_POST["to"];
							foCheck($touser);
							if(isset($_POST["urgent"])){
								$isUrgent = ($_POST["urgent"] == 'on') ? 1 : 0;
							}else{
								$isUrgent = 0;
							}
							if($_GET["u"] == "all"){
								$getusers = mysqli_query($con, "SELECT id FROM members") OR SQLError();
								while($u = mysqli_fetch_assoc($getusers)){
									query("INSERT INTO pm(subject,touser,fromuser,message,urgent)VALUES('".addslashes($subject)."','".$u["id"]."','".$_COOKIE["id"]."','".addslashes($_POST["msg"])."','".$isUrgent."')");
									loguser($_COOKIE["id"],"sent a PM to all users.");
								}
							}else{
							$p = sql("SELECT name FROM members WHERE id = '".$touser."'");
							if($_COOKIE["id"] == $touser) errMsg("We know how loneliness can be sometimes, but messaging yourself is never the answer.");
							sendPM($touser,$_COOKIE["id"],addslashes($subject),addslashes($_POST["msg"]),$isUrgent);
							}
							forumMsg("Your message has been sent.");
						}else{
						?>
						<form action="" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
							<tr>
								<th class="titlebg" colspan="2">Send PM</th></tr>
							<tr>
								<td class="mainbg" style="text-align:right;">Subject:</td>
								<td class="mainbg2">
								<?php
								if(!(int)$_GET["f"]){
								?>
								<input type="text" name="subject" />
								<?php
								}else{
								$getSubj = sql("SELECT subject FROM pm WHERE id = '".$_GET["f"]."'");
								echo "&raquo; FWD: &nbsp; &nbsp;".stripslashes($getSubj["subject"]).
								"<input type=\"hidden\" value=\"FWD: ".$getSubj["subject"]."\" name=\"subject\" id=\"sbjct\" />";
								}
								?>
								</td>
							</tr>
							<tr>
							<td class="mainbg" style="text-align:right;">To:</td>
							<td class="mainbg2">
							<?php
								if(!(int)$_GET["user"]AND!$_GET["u"]){
									echo "Select User:<br /><select name=\"to\">";
									$gm = mysqli_query($con, "SELECT id,display,name,s_tag FROM members ORDER BY name ASC") OR SQLError();
									while($m = mysqli_fetch_assoc($gm)){
										if($m["id"] == $_COOKIE["id"]) continue;
										echo "<option value=\"".$m["id"]."\">".$m["display"]."(".$m["s_tag"].")</option>";
									}
									echo "</select>";
							?>
							<?php
								}else if($_GET["u"] == "all" AND checkPerms(3)){
									echo "<em>All</em>";
								}else{
									$udata = sql("SELECT display,s_tag FROM members WHERE id = '".$_GET["user"]."'");
									echo getDisplay($_GET["user"]);
								}
							?>
							</td>
							</tr>
							<tr>
								<td class="mainbg" style="text-align:right;">Message:</td>
								<td class="mainbg2"><textarea cols="50" rows="10" name="msg" id="msg" required="1"><?php 
								if((int)$_GET["f"]){ 
									$pmData = sql("SELECT message,fromuser FROM pm WHERE id = '".$_GET["f"]."'");
									echo "[quote]Original Message Was From: [user=".$pmData["fromuser"]."][br][br]".stripslashes($pmData["message"])."[/quote]";
								}
								?></textarea></td>
							</tr>
							<?php
							if(gamerPoints($_COOKIE["id"])>= 500 OR checkPerms(4)){
								$lastUrgent = sql("SELECT id FROM members WHERE id = '".$_COOKIE["id"]."' AND UNIX_TIMESTAMP(last_urgent)>= '".(time()-86400)."'");
								if($lastUrgent["id"] == ""){
									echo '<tr><td class="mainbg2" colspan="2"><input type="checkbox" name="urgent" /> Mark Message As Urgent</td></tr>';
									}else{
										echo '<tr><td class="mainbg2" colspan="2">You must wait one more day before sending another urgent PM.</td></tr>';
									}
							}
							?>
							<tr>
								<td class="mainbg" colspan="2" style="text-align:center;" id="s"><input type="submit" value="Send" name="submit" id="send" /></td>
							</tr>
						</table>
						</form>
						<?php
						}
					break;
					case 'recentposts':
						if(!isset($_POST["rposts"])) errMsg("You did not specify the amount of posts to display.");
						changeTitle($_POST["rposts"]." Recent Posts");
						(int) $p = $_POST["rposts"];
						$getposts = mysqli_query($con, "SELECT * FROM topics ORDER BY id DESC LIMIT ".$p) OR SQLError();
						loguser($_COOKIE["id"],"viewed the [b]".$p."[/b] most recent posts.");
						while($posts = mysqli_fetch_assoc($getposts)){
							$userdata = sql("SELECT * FROM members WHERE id = '".$posts["userid"]."'");
							$board = sql("SELECT staff FROM boards WHERE id = '".$posts["boardid"]."'");
							if(!checkPerms(3) AND $board["staff"])
								continue;
							echo '<table class="table bordercolor" cellspacing="1" cellpadding="4">
								<tr><th class="titlebg" colspan="2"><a href="?act=topic&id='.$posts["topic_id"].'">'.$posts["subject"].'</a></th></tr>
								<tr><th class="catbg">User</th><th class="catbg">Post</th></tr>';
								require("miniprofile.php");
							echo '<tr><td class="mainbg" style="vertical-align: top">'.ubbc($posts["post"]).'</td></tr
								<tr><td class="mainbg" style="vertical-align: top"><div style="font-size:12px;">';
								if(!$logged["hide_sig"]){
									echo ubbc($userdata["sig"]);
								}
								echo '</div></td></tr>
							      </table>
							      <br /><br />
							';
						}
					break;
					case 'cpanel':
						admin();
					break;
					case 'createcategory':
						AuthCheck(4);
						changeTitle("Create Category");
						if(isset($_POST["submit"])){
							query("INSERT INTO ctgs(name,about,staff)VALUES('".addslashes($_POST["name"])."','".addslashes($_POST["about"])."','".$_POST["so"]."')");
							$ct_order = sql("SELECT ct_order FROM sitedata");
							$ct = explode(",",$ct_order["ct_order"]);
							$ct[] = $_POST["name"];
							$t = implode(",",$ct);
							query("UPDATE sitedata SET ct_order = '".$t."'");
							loguser($_COOKIE["id"],"created a new category: ".$_POST["name"]);
							forumMsg("Your category has been created.");
							admin();
						}else{
						?>
						<form action="" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="2">Create Category</th></tr>
						<tr>
						<td class="mainbg" width="25%">Name:</td><td class="mainbg2" width="50%"><input type="text" name="name" /></td>
						</tr>
						<tr>
						<td class="mainbg" width="25%">About:</td><td class="mainbg2"><textarea cols="60" rows="5" name="about" id="about"></textarea></td>
						</tr>
						<tr>
						<td class="mainbg" width="25%">
						Staff Only:
						</td>
						<td class="mainbg2" width="50%">
						<select name="so">
						<option value="0">No</option>
						<option value="1">Yes</option>
						</select>
						</td>
						</tr>
						<tr>
						<td class="mainbg2" colspan="2"><input type="submit" value="Create" name="submit" id="create" /></td>
						</tr>
						</table>
						</form>
						<?php
						}
					break;
					case 'modifycategory':
						AuthCheck(4);
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Select Category</th></tr>
						<tr>
						<td class="mainbg">
						Please select which category you want to modify. When you select it, you will automatically be redirected to the modifcation area for that particular category.<br />
						<select id="ctg" onchange="document.location.href='?act=modifycategory2&cid='+getID('ctg').options[getID('ctg').selectedIndex].value;">
						<option value="">------------------------</option>
						
						<?php
						$getctgs = mysqli_query($con, "SELECT id,name FROM ctgs ORDER BY name ASC") OR SQLError();
						while($ctgs = mysqli_fetch_assoc($getctgs)){
						extract($ctgs);
						echo "<option value=\"".$id."\">".$name."</option>
						     ";
						}
						?>
						</select>
						</td>
						</tr>
						</table>
						<?php
					break;
					case 'modifycategory2':
						AuthCheck(4);
						changeTitle("Modify Category");
						if(!(int)$_GET["cid"]) invData();
						$data = sql("SELECT * FROM ctgs WHERE id = '".$_GET["cid"]."'");
						if(isset($_POST["submit"])){
							$cd = sql("SELECT ct_order FROM sitedata");
							$ct = explode(",",$cd["ct_order"]);
							if(in_array($data["name"],$ct)){
								$ct = str_replace($data["name"],$_POST["name"],$ct);
							}
							$t1 = implode(",",$ct);
							query("UPDATE sitedata SET ct_order = '".$t1."'");
							query("UPDATE ctgs SET name = '".addslashes($_POST["name"])."', about = '".addslashes($_POST["about"])."', staff = '".$_POST["so"]."' WHERE id = '".$_GET["cid"]."'");
							loguser($_COOKIE["id"],"modified the [b]".$data["name"]."[/b] category to [b]".$_POST["name"]."[/b]");
							forumMsg("Your category has been modified.");
							admin();
						}else{
						?>
						<form action="" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="2">Modify Category</th></tr>
						<tr>
						<td class="mainbg" width="25%">Name:</td><td class="mainbg2" width="50%"><input type="text" value="<?php echo $data["name"]; ?>"name="name" /></td>
						</tr>
						<tr>
						<td class="mainbg" width="25%">About:</td><td class="mainbg2"><textarea cols="60" rows="5" name="about" id="about" style="padding: 2px;"><?php echo $data["about"]; ?></textarea></td>
						</tr>
						<tr>
						<td class="mainbg" width="25%">
						Staff Only:
						</td>
						<td class="mainbg2" width="50%">
						<select name="so">
						<option value="0"<?php if(!$data["staff"]) echo " selected=\"1\""; ?>>No</option>
						<option value="1"<?php if($data["staff"]) echo " selected=\"1\""; ?>>Yes</option>
						</select>
						</td>
						</tr>
						<tr>
						<td class="mainbg2" colspan="2"><input type="submit" value="Update" name="submit" id="update" /></td>
						</tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'createboard':
						AuthCheck(4);
						changeTitle("Create Board");
						if(isset($_POST["submit"])){
							query("INSERT INTO boards(ctg_id,name,about,staff,whopost,subboard,moderators,p_req,post_en,order_by)VALUES('".$_POST["ctg"]."','".addslashes($_POST["name"])."','".addslashes($_POST["about"])."','".$_POST["so"]."','".$_POST["whopost"]."','".$_POST["sb"]."','".$_POST["mods"]."','".$_POST["pq"]."','".$_POST["post_en"]."','".$_POST["order_by"]."')");
							loguser($_COOKIE["id"],"created a new board: [b]".$_POST["name"]."[/b]");
							forumMsg("Your board has been created.");
							admin();
							$bd = sql("SELECT bd_order FROM ctgs WHERE id = '".$_POST["ctg"]."'");
							$e = explode(",",$bd["bd_order"]);
							$e[] = addslashes($_POST["name"]);
							$f = implode(",",$e);
							query("UPDATE ctgs SET bd_order = '".addslashes($f)."' WHERE id = '".$_POST["ctg"]."'");
						}else{
						?>
						<form action="?act=createboard" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="3">Create Board</th></tr>
							<tr>
								<td class="mainbg2" width="25%">
								Category:
								</td>
								<td class="mainbg" width="25%">
								<select name="ctg" class="form-control">
								<?php
								$getctgs = mysqli_query($con, "SELECT id,name FROM ctgs ORDER BY name ASC") OR SQLError();
								while($ctg = mysqli_fetch_assoc($getctgs)){
									extract($ctg);
									echo "<option value=\"".$id."\">".$name."</option>";
								}
								?>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Please select the category that you wish to place this board in.
								</td>
							</tr>
							<tr>
									<td class="mainbg2" width="25%">
									Name:
									</td>
									<td class="mainbg" width="25%">
									<input type="text" class="form-control" name="name" />
									</td>
									<td class="mainbg" width="50%">The name of the board.</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Description:
								</td>
								<td class="mainbg" width="25%">
								<textarea cols="40" rows="10" name="about" id="ab" class="form-control"></textarea>
								</td>
								<td class="mainbg" width="50%">
								Give a <span style='text-decoration: underline;'>brief</span> description of what the board is about. Make it sound good, though.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Moderator(s):
								</td>
								<td class="mainbg" width="25%">
								<input type="text" name="mods" class="form-control" />
								</td>
								<td class="mainbg" width="50%">
								<strong>Optional.</strong> List the <strong>USERNAMES</strong> of the users you wish to make mods of this board, separate each one with a comma.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Allowed Posting:
								</td>
								<td class="mainbg" width="25%">
								<select name="whopost" class="form-control">
								<option value="everyone">Everyone</option>
								<option value="staff">Staff</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								This decides who can post in this board.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Tokens:
								</td>
								<td class="mainbg" width="25%">
								<select name="post_en" class="form-control">
								<option value="1">Enabled</option>
								<option value="0">Disabled</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Disabling this feature for a board means that they will not receive tokens when they post.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Staff Only:
								</td>
								<td class="mainbg" width="25%">
								<select name="so" class="form-control">
								<option value="0">No</option>
								<option value="1">Yes</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Control whether or not only staff have access to this board.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Order By:
								</td>
								<td class="mainbg" width="25%">
								<select name="order_by" class="form-control">
								<option value="last_updated DESC">Recently Updated</option>
								<option value="subject ASC">Subject</option>
								<option value="posted ASC">Date Posted</option>
								<option value="userid ASC">Member Grouping</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Control the flow of how topics are ordered.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Sub-Board:
								</td>
								<td class="mainbg" width="25%">
								<select name="sb" class="form-control">
								<option value="0">None</option>
								<?php
								$getBoards = mysqli_query($con, "SELECT id,name FROM boards WHERE subboard = '0'") OR SQLError();
								while($b = fetch($getBoards)){
									echo "<option value=\"".$b["id"]."\">".$b["name"]."</option>";
								}
								?>
								</select>
								</td>
								<td class="mainbg" width="50%">
								If you wish to make this board a sub-board, then please select its parent board, otherwise, leave it alone.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Posts Required:
								</td>
								<td class="mainbg" width="25%">
								<input type="text" size="1" style="text-align: center;" class="form-control" value="0" name="pq" />
								</td>
								<td class="mainbg" width="50%">
								If you wish to set a post requirement for this board, please enter it here. Otherwise, leave this at zero.
								</td>
							</tr>
							<tr>
								<th class="titlebg" colspan="3"><button type="submit" name="submit" id="cr" class="formButton form-control">Save</button></th>
							</tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'modifyboard':
						AuthCheck(4);
						changeTitle("Modify Board");
						?>
						<table class="table borderolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Modify Board</th></tr>
						<tr><td class="mainbg">Please select the board from the dropdown list that you would like to modify.<br />
							<select id="s" onchange="location.href='?act=modboard2&id='+$('#s').val();" class="form-control">
							<option value="">---------------------</option>
							<?php
								$getboards = mysqli_query($con, "SELECT id,name FROM boards ORDER BY name ASC") OR SQLError();
								while($boards = fetch($getboards)){
								extract($boards);
								echo "<option value=\"".$id."\">".$name."</option>";
								}
							?>
							</select>
						</td></tr>
						</table>
						<?php
						break;
						case 'modboard2':
						AuthCheck(4);
						idCheck();
						$data = sql("SELECT * FROM boards WHERE id = '".$_GET["id"]."'");
						extract($data);
						$bd = sql("SELECT bd_order FROM ctgs WHERE id = '".$ctg_id."'");
						$t = explode(",",$bd["bd_order"]);
						changeTitle("Modify Board: ".$name);
						if(isset($_POST["submit"])){
						if(in_array($data["name"],$t)){
							$t = str_replace($data["name"],addslashes($_POST["name"]),$t);
						}
						$f = implode(",",$t);
						query("UPDATE ctgs SET bd_order = '".addslashes($f)."' WHERE id = '".$ctg_id."'");
							query("UPDATE boards SET ctg_id = '".$_POST["ctg"]."', name = '".addslashes($_POST["name"])."', about = '".addslashes($_POST["about"])."', staff = '".$_POST["so"]."', whopost = '".$_POST["whopost"]."', subboard = '".$_POST["sb"]."', moderators = '".$_POST["mods"]."', p_req = '".$_POST["pq"]."', post_en = '".$_POST["post_en"]."', order_by = '".$_POST["order_by"]."' WHERE id = '".$_GET["id"]."'");
							forumMsg("Your board was successfully modified.");
							loguser($_COOKIE["id"],"modified the [b]".$data["name"]."[/b] board to [b]".$_POST["name"]."[/b]");
							admin();
						}else{
						?>
						<form action="?act=modboard2&id=<?php echo $_GET["id"]; ?>" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="3">Modify Board</th></tr>
							<tr>
								<td class="mainbg2" width="25%">
								Category:
								</td>
								<td class="mainbg" width="25%">
								<select name="ctg" class="form-control">
								<?php
								$getctgs = mysqli_query($con, "SELECT id,name FROM ctgs ORDER BY name ASC") OR SQLError();
								while($ctg = mysqli_fetch_assoc($getctgs)){
								echo "<option value=\"";
								echo $ctg["id"]."\"";
								if($ctg["id"] == $data["ctg_id"]) echo " selected=\"1\"";
								echo ">".$ctg["name"]."</option>";
								}
								?>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Please select the category that you wish to place this board in.
								</td>
							</tr>
							<tr>
									<td class="mainbg2" width="25%">
									Name:
									</td>
									<td class="mainbg" width="25%">
									<input type="text" value="<?php echo $name; ?>" class="form-control" name="name" />
									</td>
									<td class="mainbg" width="50%">The name of the board.</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Description:
								</td>
								<td class="mainbg" width="25%">
								<textarea cols="40" rows="10" name="about" id="ab" class="form-control"><?php echo $about; ?></textarea>
								</td>
								<td class="mainbg" width="50%">
								Give a <u>brief</u> description of what the board is about. Make it sound good, though.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Moderator(s):
								</td>
								<td class="mainbg" width="25%">
								<input type="text" value="<?php echo $moderators; ?>" id="mods" name="mods" class="form-control" />
								</td>
								<td class="mainbg" width="50%">
								<strong>Optional.</strong> List the <strong>USERNAMES</strong> of the users you wish to make mods of this board, separate each one with a comma.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Allowed Posting:
								</td>
								<td class="mainbg" width="25%">
								<select name="whopost" class="form-control">
								<option value="everyone"<?php if($whopost == "everyone") echo " selected=\"1\""; ?>>Everyone</option>
								<option value="staff"<?php if($whopost == "staff") echo " selected=\"1\""; ?>>Staff</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								This decides who can post in this board.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Tokens:
								</td>
								<td class="mainbg" width="25%">
								<select name="post_en" class="form-control">
								<option value="1"<?php if($post_en) echo " selected=\"1\""; ?>>Enabled</option>
								<option value="0"<?php if(!$post_en) echo " selected=\"1\""; ?>>Disabled</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Disabling this feature for a board means that they will not receive tokens when they post.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Staff Only:
								</td>
								<td class="mainbg" width="25%">
								<select name="so" class="form-control">
								<option value="no"<?php if(!$staff) echo " selected=\"selected\""; ?>>No</option>
								<option value="yes"<?php if($staff) echo " selected=\"selected\""; ?>>Yes</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Control whether or not only staff have access to this board.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Order By:
								</td>
								<td class="mainbg" width="25%">
								<select name="order_by" class="form-control">
								<option value="last_updated DESC"<?php if($order_by == "last_updated DESC") echo " selected=\"1\""; ?>>Recently Updated</option>
								<option value="subject ASC"<?php if($order_by == "subject ASC") echo " selected=\"1\""; ?>>Subject</option>
								<option value="posted ASC"<?php if($order_by == "posted ASC") echo " selected=\"1\""; ?>>Date Posted</option>
								<option value="userid ASC"<?php if($order_by == "userid ASC") echo " selected=\"1\""; ?>>Member Grouping</option>
								</select>
								</td>
								<td class="mainbg" width="50%">
								Control the flow of how topics are ordered.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Sub-Board:
								</td>
								<td class="mainbg" width="25%">
								<select name="sb" class="form-control">
								<option value="0">None</option>
								<?php
								$getBoards = mysqli_query($con, "SELECT id,name FROM boards WHERE subboard = '0'") OR SQLError();
								while($b = fetch($getBoards)){
									echo "<option value=\"".$b["id"]."\"";
									if($b["id"] == $subboard)
										echo " selected=\"1\"";
									echo ">".$b["name"]."</option>";
								}
								?>
								</select>
								</td>
								<td class="mainbg" width="50%">
								If you wish to make this board a sub-board, then please select its parent board, otherwise, leave it alone.
								</td>
							</tr>
							<tr>
								<td class="mainbg2" width="25%">
								Posts Required:
								</td>
								<td class="mainbg" width="25%">
								<input type="text" size="1" style="text-align: center;" value="<?php echo $p_req; ?>" name="pq" class="form-control" />
								</td>
								<td class="mainbg" width="50%">
								If you wish to set a post requirement for this board, please enter it here. Otherwise, leave this at zero.
								</td>
							</tr>
							<tr>
								<th class="titlebg" colspan="3"><button type="submit" name="submit" id="submit" class="formButton form-control">Save Changes</button></th>
							</tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'modifypost':
							if(!online()) PleaseLogin();
							idCheck();
							changeTitle("Modifying Post");
							$data = sql("SELECT * FROM topics WHERE id = '".$_GET["id"]."'");
							if($data["locked"] AND !checkPerms(3)) errMsg("We're sorry, but this topic has been locked, and is therefore not editable.");
							(int) $id = ($data["reply"] == 'yes') ? $data["topic_id"] : $_GET["id"];
							extract($data);
							if(!isMe($userid) AND !checkPerms(2)) unauthorized();
							$board = sql("SELECT id,name,ctg_id FROM boards WHERE id = '".$boardid."'");
							$ctg = sql("SELECT name FROM ctgs WHERE id = '".$board["ctg_id"]."'");
							if(isset($_POST["submit"])){
								query("UPDATE topics SET post = '".addslashes($_POST["post"])."', description = '".addslashes($_POST["descr"])."', subject = '".$_POST["subject"]."', autoLock = '".$_POST["autolock"]."', lastedit = '".$_COOKIE["id"]."', tags = '".$_POST["kw"]."', edit_reason = '".addslashes($_POST["er"])."' WHERE id = '".$_GET["id"]."'");
								loguser($_COOKIE["id"],"modified their post in the topic: [url=?act=topic&id=".$id."]".addslashes($_POST["subject"])."[/url]");
								header("Location: ?act=topic&id=".$data["topic_id"]);
							}else{
							?>
							<form action="?act=modifypost&id=<?php echo $_GET["id"]; ?>" method="post" name="postForm">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="3"><?php echo $board["name"]; ?> - Post</th></tr>
						<tr><td class="mainbg2" colspan="3"><strong>Category:</strong> <a href="?act=viewcategory&id=<?php echo $board["ctg_id"]; ?>"><?php echo stripslashes($ctg["name"]); ?></a> &nbsp; &nbsp; <strong>Board:</strong> <a href="?act=viewtopics&bid=<?php echo $data["boardid"]; ?>"><?php echo $board["name"]; ?></a></td></tr>
						<tr><td class="mainbg">Subject:</td>
								<td class="mainbg">
								<input type="text" size="45" id="sbjct" value="<?php echo stripslashes($subject); ?>" name="subject" required="1" class="form-control" />
								<div class="help-block">Give your topic a brief, <em>relevant</em> subject.</div>
								</td>
						</tr>
						<tr><td class="mainbg">
							Topic Description:
							</td>
							<td class="mainbg">
							<input type="text" size="45" value="<?php echo $description; ?>" name="descr" id="d" class="form-control" />
							<div class="help-block"><strong>Optional.</strong> Give a brief description of what your topic is about.</div>
							</td>
							</tr>
							<tr>
							<td class="mainbg" style="vertical-align: top">AutoLock:</td>
							<td class="mainbg"><input type="text" pattern="(\d){0,3}" size="1" value="<?php echo $data["autoLock"]; ?>" style="text-align: center;" name="autolock" class="form-control" />
							<div class="help-block">Number of posts before your topic automatically locks. Leave at 0 for none.</div>
							</td>
							</tr>
							<tr>
							<td class="mainbg">
							Post:
							</td>
							<td class="mainbg">
							<div class="mainbg2">
							Before editing, please make sure you've read our <a href="http://www.zollernverse.org/?act=topic&id=217" class="nWin">RULES</a> first!
							</div>
							<textarea cols="130" rows="20" name="post" id="post" required="1"><?php echo stripslashes($data["post"]); ?></textarea>
							<script src="scripts/nicEdit.js" type="text/javascript"></script>
							<?php
							$fullPanel = (checkPerms(4)) ? "{fullPanel: true}" : "";
							?>
							<script type="text/javascript">
							new nicEditor(<?php echo $fullPanel; ?>).panelInstance('post');
							</script>
							</td>
							</tr>
							<?php
							if($reply != "yes"){
							?>
							<tr>
							<td class="mainbg2" colspan="4">
							<strong>Key Words:</strong>
							<br />
							<input type="text" size="55" value="<?php echo $tags; ?>" name="kw" id="kw" class="form-control" />
							<div class="help-block"><strong>Optional.</strong> Separate each word with a comma.</div>
							</td>
							</tr>
							<?php
							}
							?>
							<tr>
							<td class="mainbg2" colspan="4">
							<strong>Edit Reason:</strong>
							<br />
							<input type="text" size="55" value="<?php echo stripslashes($edit_reason); ?>" name="er" id="er" class="form-control" />
							<div class="help-block"><strong>Optional.</strong> Give a reason for editing the post.</div>
							</td>
							</tr>
						<tr><td align="center" class="mainbg2" colspan="3"><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button></td></tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'headfoot':
						AuthCheck(4);
						changeTitle("Headers & Footers");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4" id="hfTable">
							<tr>
								<th class="titlebg">Select Board</th>
							</tr>
							<tr>
								<td class="mainbg2">
									<p>Please select the board from the drop-down list that you wish to add coding to.</p>
									<select name="board" onchange="toLoc('?act=sandbox&id='+this.options[this.selectedIndex].value);" class="form-control">
									<option value="">----------------</option>
									<option value="0">Global</option><?php
									$getBoards = mysqli_query($con, "SELECT id,name FROM boards ORDER BY name ASC");
									while($boards = fetch($getBoards)){
										echo "<option value=\"".$boards["id"]."\">".$boards["name"]."</option>";
									}
									?>
									</select>
								</td>
							</tr>
						</table>
						<?php
						break;
						case 'sandbox':
						AuthCheck(4);
						changeTitle("The Sandbox");
						if(!(int)$_GET["id"] OR $_GET["id"] == '0'){
							$data = sql("SELECT header,footer FROM sandbox");
							changeTitle("Global");
						}else{
							$data = sql("SELECT name,header,footer FROM boards WHERE id = '".$_GET["id"]."'");
							changeTitle($data["name"]);
						}
						extract($data);
						if(isset($_POST["submit"])){
							if(!(int)$_GET["id"] OR $_GET["id"] == '0'){
								query("UPDATE sandbox SET header = '".addslashes($_POST["header"])."', footer = '".addslashes($_POST["footer"])."'");
							}else{
								query("UPDATE boards SET header = '".addslashes($_POST["header"])."', footer = '".addslashes($_POST["footer"])."'");
							}
							forumMsg("Your coding was updated and saved successfully.");
							if(!(int)$_GET["id"] OR $_GET["id"] == '0'){
								loguser($_COOKIE["id"],"edited The Sandbox header and footer.");
							}else{
								loguser($_COOKIE["id"],"edited the [url=?act=viewtopics&id=".$_GET["id"]."]".$data["name"]."[/url] header and footer.");
							}
							admin();
						}else{
						?>
						<form action="" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Sandbox</th></tr>
						<tr><td class="mainbg2" align="center">Welcome to The Sandbox. From here, you can modify extra coding for the header and footer of the site. The header will appear in the head tags and the footer will appear within the body tags. Be cautious. The slightest mess-up could cause a mass hysteria, and we don't want that. Happy coding!</td></tr>
						<tr><th class="catbg">Header</th></tr>
						<tr><td align="center" class="mainbg"><textarea cols="180" rows="20" name="header" id="h" class="form-control"><?php echo $header; ?></textarea></td></tr>
						<tr><th class="catbg">Footer</th></tr>
						<tr><td align="center" class="mainbg"><textarea cols="180" rows="20" name="footer" id="f" class="form-control"><?php echo $footer; ?></textarea></td></tr>
						<tr><td class="mainbg2" align="center"><button type="submit" name="submit" id="sc">Save Changes</button></td></tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'delboard1':
						AuthCheck(4);
						changeTitle("Delete Board");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Delete Board</th></tr>
						<tr><td class="mainbg">
							<u>Please note that once you delete a board, 
							<strong>it cannot be brought back</strong>. All topics will be deleted along with it. None of this can be undone. If you are sure about your decision, proceed.</u><br />Please select the board from the dropdown list that you wish to delete.<br />
							<select id="s" onchange="location.href='?act=delboard2&id='+$('#s').val();" class="form-control">
							<option value="">---------------------</option>
							<?php
								$getboards = mysqli_query($con, "SELECT id,name FROM boards ORDER BY name ASC") OR SQLError();
								while($boards = fetch($getboards)){
								extract($boards);
								echo "<option value=\"".$id."\">".$name."</option>";
								}
							?>
							</select>
						</td></tr>
						</table>
						<?php
						break;
						case 'delboard2':
						AuthCheck(4);
						if(!(int)$_GET["id"]) errMsg("Whoops. You forgot to pick a board to delete.");
						$bdata = sql("SELECT name,ctg_id FROM boards WHERE id = '".$_GET["id"]."'");
						$bd_order = sql("SELECT bd_order FROM ctgs WHERE id = '".$bdata["ctg_id"]."'");
						$t = explode(",",$bd_order["bd_order"]);
						if(in_array($bdata["name"],$t)){
							$t = preg_replace("/(,)?".$bdata["name"]."(,)?/i","",$t);
						}
						$f = implode(",",$t);
						query("UPDATE ctgs SET bd_order = '".addslashes($f)."' WHERE id = '".$bdata["ctg_id"]."'");
						loguser($_COOKIE["id"],"deleted the [b]".$bdata["name"]."[/b] board.");
						query("DELETE FROM boards WHERE id = '".$_GET["id"]."'");
						query("DELETE FROM topics WHERE boardid = '".$_GET["id"]."'");
						forumMsg("All topics within this board, as well as the board itself, have been deleted.");
						admin();
						break;
						case 'delctg1':
						AuthCheck(4);
						changeTitle("Delete Category");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Delete Category</th></tr>
						<tr><td class="mainbg"><u>Please note that once you delete a category, 
							<strong>it cannot be brought back</strong>. All boards and topics will be deleted along with it. None of this can be undone. If you are sure about your decision, proceed.</u><br />Please select the category from the dropdown list that you wish to delete.<br />
							<?php
							$getctgs = mysqli_query($con, "SELECT id,name FROM ctgs ORDER BY name ASC") OR SQLError();
							echo "<select id=\"s\" onchange=\"location.href='?act=delctg2&id='+$('#s').val();\" class=\"form-control\">
							<option value=\"\">------------------</option>";
							while($ctgs = fetch($getctgs)){
								extract($ctgs);
								echo "<option value=\"".$id."\">".$name."</option>";
							}
							echo "
							</select>";
							?>
						</td></tr>
						</table>
						<?php
						break;
						case 'delctg2':
						AuthCheck(4);
						if(!(int)$_GET["id"]) errMsg("Whoops. You didn't specify a category to delete.");
						$data = sql("SELECT name FROM ctgs WHERE id = '".$_GET["id"]."'");
						$order = sql("SELECT ct_order FROM sitedata");
						$t = explode(",",$order["ct_order"]);
						if(in_array($data["name"],$t)){
								$ct = preg_replace("/(,)?".$data["name"]."(,)?/i","",$t);
							}
						$t1 = implode(",",$ct);
						query("UPDATE sitedata SET ct_order = '".$t1."'");
						query("DELETE FROM ctgs WHERE id = '".$_GET["id"]."'");
						$getboards = mysqli_query($con, "SELECT id FROM boards WHERE ctg_id = '".$_GET["id"]."'") OR SQLError();
						while($gb = fetch($getboards)){
							query("DELETE FROM topics WHERE boardid = '".$gb["id"]."'");
						}
						query("DELETE FROM boards WHERE ctg_id = '".$_GET["id"]."'");
						forumMsg("All boards and topics, as well as the category itself, have been deleted.");
						loguser($_COOKIE["id"],"deleted the [b]".$data["name"]."[/b] board.");
						admin();
						break;
						case 'categoryorder':
						AuthCheck(4);
						changeTitle("Reorder Categories");
						$ct = sql("SELECT ct_order FROM sitedata");
						extract($ct);
						if(isset($_POST["submit"])){
							query("UPDATE sitedata SET ct_order = '".$_POST["order"]."'");
							forumMsg("Your category order has been saved.");
							loguser($_COOKIE["id"],"edited the category order.");
							admin();
						}else{
						?>
						<form action="" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="2">Reorder Categories</th></tr>
						<tr>
							<td class="mainbg2">
							<textarea cols="50" rows="10" name="order" id="o" class="form-control"><?php echo $ct_order; ?></textarea>
							</td>
							<td class="mainbg" style="vertical-align: top">
							This is the order of your categories. To reorder them, separate them with a comma. Separate each one with a new line. Be sure to type the <u>exact</u> name of the category or the site will not recognize it.
							</td>
						</tr>
						<tr><th align="center" colspan="2" class="titlebg"><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button></th></tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'boardorder1':
						AuthCheck(4);
						changeTitle("Reorder Boards - Select Category");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Select Category</th></tr>
						<tr><td class="mainbg" style="vertical-align: top">
						Please select the category you wish to reorder the boards for.<br />
						<select id="s" onchange="location.href='?act=boardorder2&id='+$('#s').val();" class="form-control">
						<option value="">------------------------------</option>
						<?php
						$gc = mysqli_query($con, "SELECT id,name FROM ctgs ORDER BY name ASC") OR SQLError();
						while($c = fetch($gc)){
							extract($c);
							echo "<option value=\"".$id."\">".$name."</option>";
						}
						?>
						</select>
						</td></tr>
						</table>
						<?php
						break;
						case 'boardorder2':
						AuthCheck(4);
						changeTitle("Reorder Boards");
						if(!(int)$_GET["id"]) errMsg("No category was specified.");
						$ct = sql("SELECT name,bd_order FROM ctgs WHERE id = '".$_GET["id"]."'");
						if(isset($_POST["submit"])){
							query("UPDATE ctgs SET bd_order = '".addslashes($_POST["order"])."' WHERE id = '".$_GET["id"]."'");
							forumMsg("The order of the boards in the <strong>".$ct["name"]."</strong> category have been saved.");
							admin();
							loguser($_COOKIE["id"],"edited the board order in the [b]".$ct["name"]."[/b] category.");
						}else{
						?>
						<form action="" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="2">Reorder Boards</th></tr>
						<tr>
							<td class="mainbg2">
							<textarea cols="50" rows="10" name="order" id="o" class="form-control"><?php echo stripslashes($ct["bd_order"]); ?></textarea>
							</td>
							<td class="mainbg" style="vertical-align: top">
							This is the order of your boards in the <strong><?php echo $ct["name"]; ?></strong> category. To reorder them, separate them with a comma. Separate each one with a new line. Be sure to type the <u>exact</u> name of the board or the site will not recognize it.
							</td>
						</tr>
						<tr><th align="center" colspan="2" class="titlebg"><input type="submit" value="Save Changes" name="submit" id="sc" /><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button></th></tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'xspcons':
						AuthCheck(4);
						changeTitle("XSP Console");
						?>
	<table class="table bordercolor pageContent" cellspacing="1" cellpadding="4">
		<tr>
			<th class="titlebg">XSP Console</th>
		</tr>
		<tr>
			<td class="mainbg">
				<div style="width: 885px; height: 350px; overflow-y: auto; background: #000000; color: #eeeeee; font-family: 'Verdana'; font-size: 15px; padding: 4px; font-weight: bold; text-align: left; border-radius: 5px;" id="cmd">
					<strong></strong>
				</div>
			</td>
		</tr>
		<tr>
			<td class="mainbg pageContent">
			<input type="button" onclick="$('#cmd').html('<strong></strong>')" value="Clear Screen" name="ClrScrn" />
			<br />
			You may run XSP commands by using this console.
			<form action="javascript:xspSystem();" method="post">
				<br />
				<input type="text" size="120" name="cin" value="Command here.." onfocus="(this.value=='Command here..') ? this.value='' : this.value=this.value;" onblur="(this.value!='')?this.value=this.value:this.value='Command here..';" id="cin" style="background:#000000;color:#eeeeee;" required="1" />
				<button type="submit">Run</button>
			</form>
			</td>
		</tr>
	</table>
						<?php
						break;
						case 'sqlcons':
						AuthCheck(4);
						changeTitle("SQL Console");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr>
						<th class="titlebg">SQL CMD</th>
						</tr>
						<tr>
						<td class="mainbg">
						<div style="width: 885px; height: 350px; overflow: auto; background: #000000; color: #eeeeee; font-family: 'Courier New'; font-size: 16px; padding: 2px; font-weight:bold; text-align: left; border-radius: 20px;" id="cmd"><strong></strong></div></td></tr><tr><td class="mainbg"><form action="javascript:system();" method="post">You can control the entire site with this console - every aspect is at your fingertips. Please exercise caution when using this device, and remember that usage of this device is logged.<br /><input type="text" size="100" name="cin" value="Command here.." onfocus="(this.value=='Command here..') ? this.value='' : this.value=this.value;" onblur="(this.value!='')?this.value=this.value:this.value='Command here..';" id="cin" style="background:#000000;color:#eeeeee;" required="1" />
<button type="submit">Run</button>
<br /><br />
						<div id="adMode">
						<strong>SQL Keyboard</strong><br />
						<?php
							$vals = array("SELECT","*","FROM","CREATE","TABLE","DATABASE","IF", "EXISTS","DELETE","ALTER","CHANGE","DROP","VALUES","INSERT","INTO","TEXT","INT","VARCHAR","BOOLEAN","NOT","NULL","DEFAULT","UPDATE","SET","PRIMARY KEY","UNIQUE","INDEX","AUTO_INCREMENT","ENUM","TIMESTAMP","CURRENT_TIMESTAMP","ON","UNSIGNED","NOW()","DUAL","WHERE","=","!","ADD","JOIN","REPLACE","CONTAINS","HEX","CONCAT","DATETIME","SHOW","OPEN","TINYINT","BIGINT","REGEX","VIEW","WITHIN","ROUND","CLOSE","SLEEP","USE","CASE","MIN","MAX","LEAST","GREATEST","REVERSE","ISNULL","USER","LCASE","UCASE","CURRENT_USER","<",">","UNIX_TIMESTAMP","IS","MATCH","AGAINST","EVENT","HELP","RESET","ENCODE","DECODE","<=>","!=","LOAD","XML","DATE","DO","ITERATE","CURTIME","LOOP","WHILE","REPEAT","OR","||","AND","&&","ZEROFILL","WHEN","IFNULL","ELSE","BLOB","TINYTEXT","BIGTEXT","RENAME","LIKE","%","FUNCTION","COUNT","RAND","DEC","FLOAT","BETWEEN","GRANT","MD5","UNHEX","INSTR","DESCRIBE","TRUNCATE","X","Y","TIME","IN","UNION","SUBSTRING","CAST","CONVERT","SERVER","SOUNDS","SOUNDEX","FETCH","TRUE","FALSE","POINT","MULTIPOINT","QUOTE","CHECK","DATE_SUB","CEIL","FLOOR","LENGTH","ENCRYPT","LOCALTIME","CHAR","BYTE","MERGE","PASSWORD","FOR","CURDATE","RETURN");
							asort($vals);
							foreach($vals as $v){
								echo '
								<input type="button" value="'.$v.'" onclick="cinVal(this.value);" name="'.$v.'" />';
							}
						?>
						</div>
</form>
</td>
</tr>
<tr>
<th class="titlebg">&nbsp;</th>
</tr>
</table>
						<?php
						break;
						case 'viewlogs':
						AuthCheck(4);
						changeTitle("Viewing Logs");
						if((int)$_GET["userid"])
							$extra = " WHERE userid = '".sqlEsc($_GET["userid"])."'";
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Viewing Logs</th></tr>
						<tr><td class="mainbg2 pageContent">Below are the activities of every user on the site. Only admins can view this.<br />
						<a href="?act=flogs">Log Files</a>
						<?php
						$page = ($_GET["p"] == 0 OR $_GET["p"] == "") ? 0 : ($_GET["p"]-1);
						$which = (ceil($page)*10);
						$i = 1;
						$gtp = mysqli_query($con, "SELECT id FROM userLogs".$extra);
						$tp = mysqli_num_rows($gtp);
						$totalPages = ceil($tp/10);
						if($tp == 0){
							echo "<tr><td class=\"mainbg pageContent\">There have not been any recorded activities as of yet. Bummer.</td></tr>";
						}else{
						?>
						<br />
						<a href="?act=clearlogs" class="siteLink">Clear Logs</a>
						<?php
						}
						$gl = mysqli_query($con, "SELECT * FROM userLogs".$extra." ORDER BY posted DESC LIMIT ".$which.",10") OR SQLError();
						$tdClass = array();
						$tdClass["0"] = "mainbg";
						$nextTd = 1;
						while($l = fetch($gl)){
							$tdClass[$nextTd] = ($tdClass[$nextTd-1] == "mainbg") ? "mainbg2" : "mainbg";
							extract($l);
							$userdata = sql("SELECT display,ip FROM members WHERE id = '".$userid."'");
							echo "<tr><td class=\"".$tdClass[$nextTd]."\">(".dateFormat($posted).") ".getDisplay($userid)." (".$userdata["ip"].") ".ubbc($action)."</td></tr>";
							$nextTd++;
						}
						if($totalPages> 1){
							echo "<tr><td class=\"mainbg2\">(( Pages: ";
							$cH = 0;
							while($i <= $totalPages){
								$cH++;
							$checker = ((int)$_GET["userid"]) ? "&userid=".$_GET["userid"] : "";
								echo "<a href=\"?act=viewlogs".$checker."&p=".$i."\"";
								if($i == ($page+1)) echo " style=\"font-weight:bold;color:#ffffff;\"";
								echo ">".$i."</a>";
								if($cH<$totalPages) echo ", ";
								$i++;
							}
							echo " ))</td></tr>";
						}
						?>
						</table>
						<?php
						break;
						case 'flogs':
						AuthCheck(4);
						changeTitle("Log Files");
						$getFiles = scandir("slogsx");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4" id="lfTable">
						<tr>
							<th class="titlebg">Log Files</th>
						</tr>
						<tr>
							<td class="mainbg2 pageContent">
							<p>These are the files where the logs are kept. They are separate from the user logs, but serve the same purpose.</p>
							</td>
						</tr>
						<?php
							$i = 2;
							while($i < count($getFiles)){
								echo "<tr><td class=\"mainbg2\"><a href=\"?act=logfile&fname=".$getFiles[$i]."\">".str_replace("-"," ",$getFiles[$i])."</a></td></tr>";
								$i++;
							}
						?>
						</table>
						<?php
						break;
						case 'logfile':
						AuthCheck(4);
						changeTitle("Viewing: ".$_GET["fname"]);
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4" id="logTable">
						<tr>
							<th class="titlebg"><?php echo $_GET["fname"]; ?></th>
						</tr>
						<td class="mainbg2 pageContent">
						<?php
							echo nl2br(file_get_contents("slogsx/".$_GET["fname"]));
						?>
						</td>
						</table>
						<?php
						break;
						case 'newsfader':
						AuthCheck(3);
						$news = sql("SELECT news,news_speed FROM sitedata");
  						if(isset($_POST["save"])){
   						$n = preg_replace("/\r\n/","<br />",$_POST["news"]);
  						  query("UPDATE sitedata SET news = '".addslashes($n)."', news_speed = '".$_POST["ns"]."'");
  						  loguser($_COOKIE["id"],"edited the news fader settings.");
    						  forumMsg("Your news fader settings have been saved.");
   						  admin();
 						}else{
  						$n = str_replace("<br />","\r\n",$news["news"]);
						echo "<form action=\"\" method=\"post\"><table cellspacing=\"1\" cellpadding=\"4\" class=\"table bordercolor\"><tr><th class=\"titlebg\">News Fader</th><tr><td class=\"mainbg2\">Below you can edit the settings for your news fader. Separate each section of news with a new line (carriage return). Each one will fade into the next. Be reasonable. Don't use too many.</td><tr><td class=\"mainbg\"><textarea cols=\"85\" rows=\"5\" name=\"news\" id=\"news\">".stripslashes($n)."</textarea></td></tr><tr><td class=\"mainbg\">Speed:<br /><input type=\"text\" name=\"ns\" maxlength=\"1\" id=\"ns\" size=\"5\" value=\"".$news["news_speed"]."\" /><br /><span style=\"font-size:12px;\">(Higher numbers indicate longer fades)</span></td></tr><tr><td align=\"center\" class=\"mainbg2\"><input type=\"submit\" value=\"Save\" id=\"submit\" name=\"save\" /></td></tr></table></form>";
						}
						break;
						case 'settings':
						AuthCheck(4);
						changeTitle("Forum Settings");
						$sitedata = sql("SELECT m_mode,enable_signups,message_guests,limited_register,enable_af,force_active,split_ctgs,boards_center,forum_name,tpp,ppp FROM sitedata");
						$defaultSkin = sql("SELECT id,main FROM skins WHERE main = 1");
						$es = $sitedata["enable_signups"];
						if(isset($_POST["submit"])){
							query("UPDATE skins SET main = 0 WHERE id = '".$defaultSkin["id"]."'");
							query("UPDATE skins SET main = 1 WHERE id = '".$_POST["ds"]."'");
							query("UPDATE sitedata SET m_mode = '".$_POST["mm"]."', enable_signups = '".$_POST["es"]."', message_guests = '".$_POST["ms"]."', limited_register = '".$_POST["ls"]."', enable_af = '".$_POST["ea"]."', force_active = '".$_POST["fa"]."', split_ctgs = '".$_POST["sc"]."', boards_center = '".$_POST["bc"]."', forum_name = '".addslashes($_POST["fn"])."', tpp = '".$_POST["tpp"]."', ppp = '".$_POST["ppp"]."'");
							loguser($_COOKIE["id"],"updated the forum settings.");
							forumMsg("Your forum settings have been saved.");
							admin();
						}else{
						?>
						<form action="" method="post">
						<table cellspacing="1" cellpadding="4" class="table bordercolor">
						<tr><th class="titlebg" colspan="2">Forum Settings</th></tr>
						<tr><td class="mainbg2" colspan="2">These are the global settings for Zollernverse. Only admins can access this area.</td>
						</tr>
						<tr>
						<th class="titlebg" colspan="2">General Settings</th>
						</tr>
						<tr>
						<td class="mainbg">
						Forum Name:
						</td>
						<td class="mainbg">
						<input type="text" value="<?php echo $sitedata["forum_name"] ?>" name="fn" size="35" maxlength="20" class="form-control" />
						<div style="font-size: 10px;">
						This will appear as the name of the forums, but not for the home page of the site.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg">
						Construction Setting:
						</td>
						<td class="mainbg">
						<select name="mm" class="form-control">
						<option value="0"<?php if($sitedata["m_mode"]) echo " selected=\"1\""; ?>>Disabled</option>
						<option value="1"<?php if($sitedata["m_mode"]) echo " selected=\"1\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
						Enables or disables maintenance mode, meaning only staff and admins may log in.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Website Registration:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="es" class="form-control">
						<option value="0"<?php if($es) echo " selected=\"selected\""; ?>>Disabled</option>
						<option value="1"<?php if($es) echo " selected=\"selected\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
							Enables/disables users to register to the site.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Login To See Posts:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="ms" class="form-control">
						<option value="no"<?php if($sitedata["message_guests"] == 'no') echo " selected=\"selected\""; ?>>Disabled</option>
						<option value="yes"<?php if($sitedata["message_guests"] == 'yes') echo " selected=\"selected\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
						Enables/disables whether or not users must log in/have an account to access the forums.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Limited Registration:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="ls" class="form-control">
						<option value="0"<?php if(!$sitedata["limited_register"]) echo " selected=\"0\""; ?>>Disabled</option>
						<option value="1"<?php if($sitedata["limited_register"]) echo " selected=\"1\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
						If enabled, users may register, but must be approved by an admin before they can do anything.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Enable Affiliates:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="ea" class="form-control">
						<option value="0"<?php if(!$sitedata["enable_af"]) echo " selected=\"0\""; ?>>Disabled</option>
						<option value="1"<?php if($sitedata["enable_af"]) echo " selected=\"1\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
						Enables/disables the affiliate bar.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Force Activation:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="fa" class="form-control">
						<option value="0"<?php if(!$sitedata["force_active"]) echo " selected=\"0\""; ?>>Disabled</option>
						<option value="1"<?php if($sitedata["force_active"]) echo " selected=\"1\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
						If enabled, registered users MUST activate their account before they can do anything.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Default Skin:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="ds">
						<?php
						$getSkins = mysqli_query($con, "SELECT * FROM skins ORDER BY name ASC") OR SQLError();
						while($skins = fetch($getSkins)){
							echo "<option value=\"".$skins["id"]."\"";
							if($skins["main"] == 1){
								echo " selected=\"1\"";
							}
							echo ">".stripslashes($skins["name"])."</option>";
						}
						?>
						</select>
						<div style="font-size: 10px;">
						Sets the default skin for the site.
						</div>
						</td>
						</tr>
						<tr>
						<th class="titlebg" colspan="2">Boards & Categories</th>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Split Categories:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="sc" class="form-control">
						<option value="0"<?php if(!$sitedata["split_ctgs"]) echo " selected=\"0\""; ?>>Disabled</option>
						<option value="1"<?php if($sitedata["split_ctgs"]) echo " selected=\"1\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
						If enabled, splits each category, giving space in between them.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Center Text On Boards:
						</td>
						<td class="mainbg" style="width: 50%;">
						<select name="bc" class="form-control">
						<option value="0"<?php if(!$sitedata["boards_center"]) echo " selected=\"0\""; ?>>Disabled</option>
						<option value="1"<?php if($sitedata["boards_center"]) echo " selected=\"1\""; ?>>Enabled</option>
						</select>
						<div style="font-size: 10px;">
						If enabled, centers the text on the boards, otherwise the text is on the left.
						</div>
						</td>
						</tr>
						<tr>
						<th class="titlebg" colspan="2">Topics & Posts</th>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Topics Per Page:
						</td>
						<td class="mainbg" style="width: 50%;">
						<input type="text" value="<?php echo $sitedata["tpp"]; ?>" size="5" name="tpp" class="form-control" />
						<div style="font-size: 10px;">
						The amount of topics to list per page in a board.
						</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg" style="width: 50%;">
						Posts Per Page:
						</td>
						<td class="mainbg" style="width: 50%;">
						<input type="text" value="<?php echo $sitedata["ppp"]; ?>" size="5" name="ppp" class="form-control" />
						<div style="font-size: 10px;">
						The amount of posts to list per page in a topic.
						</div>
						</td>
						</tr>
						<tr>
						<td align="center" class="mainbg2" colspan="2" id="subcell"><input type="submit" value="Save Changes" name="submit" id="sc" /></td>
						</tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'register':
						case 'signup':
						if(online() AND !checkPerms(4)) errMsg("You already have an account here.");
						changeTitle("Sign Up");
						if(!$sitedata["enable_signups"]) errMsg("We're sorry, but sign ups are currently disabled.");
		if(isset($_POST["submit"])){
    	 	$username = userFormat($_POST["username"]);
    	 	$pass = md5($_POST["pw"]);
    	 	$d1 = getdate(strtotime($_POST["year"]."-".$_POST["month"]."-".$_POST["day"]));
    	 	$month = $_POST["month"];
    	 	$d2 = getdate();
    	 	$age = ($d2["year"]-$d1["year"]);
    	 	if( ($d1["mon"] < $d2["mon"]) or ($d1["mon"] == $d2["mon"] and $d1["yday"] == $d2["yday"])) $age--;
    	 	$errors = "";
    	 	if($errors != "") $errors = "<ul>";
    	 	if(!checkAvailability($username)) $errors .= "<li>This username is already taken.</li>";
    	 	if(!checkEmail($_POST["email"])) $errors .= "<li>Sorry, that e-mail is being used.</li>";
    	 	if(!preg_match("/[a-zA-Z0-9]{5,30}/i",$username)) $errors .= "<li>Username must be alphanumeric, between 5 and 30 characters (underscores are not allowed).</li>";
    	 	if(!preg_match("/^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$/i",$_POST["email"]) OR $_POST["email"] == "") 
    	 		$errors .= "<li>Please enter a valid e-mail address. If you feel that the address is valid, e-mail as at <a href=\"mailto:support@zollernverse.org\">support@zollernverse.org</a> and we will try to assist you.</li>";
    	 	if($username == "") $errors .= "<li>You did not specify a username.</li>";
    	 	if($_POST["pw"] != $_POST["pw2"]) $errors .= "<li>Your passwords do not match.</li>";
    	 	$rs = explode(",",$sitedata["rnames"]);
    	 	if(in_array($username,$rs)) $errors .= "<li>That username is on the reserved names list - sorry. Please choose a different one.</em>";
    	 	if($_POST["pw"] == "") $errors .= "<li>You did not enter a password.</li>";
    	 	$securityCheck = sql("SELECT hiddentext FROM security_images WHERE hiddentext = '".$_POST["ctext"]."'");
    	 	$sc2 = sql("SELECT hiddentext FROM security_images WHERE referenceid = '".$_COOKIE["PHPSESSID"]."'");
    	 	//if($securityCheck["hiddentext"] == "") $errors .= "<li>These characters do not match the ones on the security image. Please re-enter them and try again.</li>";
    	 	if($age < 13) $errors .= "<li>Sorry, you have to be at least 13 to register. If you wish, you may sign up using your parent or guardian's e-mail and information, and under <em>their</em> supervision.</li>";
			$gc = $_POST["g-recaptcha-response"];
			// if($gc == ""){ 
				// $errors .= "<li>reCAPTCHA failed.</li>";
			// }
    	 	if($errors != "") $errors .= "</ul>";
    	 	}
		if(isset($_POST["submit"]) AND $errors==""){
			$lr = ($sitedata["limited_register"]) ? 0 : 1;
    	 	mysqli_query($con, "INSERT INTO members(name,pass,gender,ip,joined,birthday,display,email,skinid,approved,v2mode)VALUES('".$username."','".md5($_POST["pw"])."','".$_POST["gender"]."','".$_SERVER["REMOTE_ADDR"]."',CURRENT_TIMESTAMP,'".$_POST["year"]."-".$month."-".$_POST["day"]."','".userFormat($_POST["username"])."','".$_POST["email"]."','".$defaultSkin["id"]."',".$lr.",1)") OR SQLError();
    	 	$n = mysqli_insert_id();
    	 	sendPM($n,'3','Welcome!',"Hello there![br][br]We're very excited to have you here at Zollernverse, a friendly, gaming & tech community. Welcome to the forums, [user=".$n."]. I am Zollernbot, the robot of the site. I also have an uncle here named Bazibzib, but he's not as active as I am. It's disappointing but, hey, what can ya do, right?[br][br]Err.. anyway, before you do anything else, please read our [url=?act=topic&id=217]Rules[/url]. There aren't very many and it's really just basic stuff anyway, but still, we'd really appreciate it if you could have a look really quick. If you have any questions, post them in the Help Desk board and we will do our best to assist you. I hope you have a wonderful stay here! :)");
    	 	activEmail($_POST["email"]);
    	 	forumMsg("Your account has been created successfully. You may now [url=?act=login]log in[/url] with the information you provided us with.");
    	 	logUser($n,"registered an account with Zollernverse.");
    	 	$getStaff = mysqli_query($con, "SELECT id FROM members WHERE perms >= '2'") OR SQLError();
    	 	while($s = fetch($getStaff)){
    	 		notifyUser($s["id"],"[user=".$n."] has registered with Zollernverse.");
    	 	}
    	 					}else{
						?>
						<form action="" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="2">Sign Up</th></tr>
						<tr><td class="mainbg2 pageContent" colspan="2">
						<?php if($errors!="") echo "There were errors while creating your account:<br />".$errors."<hr/>"; ?>Welcome to Zollernverse, potential member. Thank you for your interest in our web site. To join, please fill out the information below. Should you come across any problems, send an e-mail to <a href="mailto:support@zollernverse.org">support@zollernverse.org</a>.</td></tr>
						<tr>
							<td class="mainbg pageContent" width="35%"><label for="user" accesskey="u"><strong>U</strong>sername:</label></td>
							<td class="mainbg2 pageContent"><input type="text" onblur="checkAvail();" value="<?php echo userFormat($_POST["username"]); ?>" id="user" required="1" pattern="[a-zA-Z0-9]{5,30}" size="50" name="username" class="form-control" /><div style="font-size:12px;">This will be your unique username on the site, it cannot be changed. Alphanumeric characters only (a-z & 0-9), between 5 and 30 characters (underscores are not allowed).</div><div id="av"></div></td>
						</tr>
						<tr>
							<td class="mainbg pageContent" width="35%">E-Mail:</td>
							<td class="mainbg2 pageContent"><input type="text" onblur="checkEmail();" size="50" name="email" required="1" id="email" class="form-control" /><div style="font-size:12px;">Your e-mail will be hidden from the public, and we won't spam you, don't worry.</div><div id="e"></div></td>
						</tr>
						<tr>
							<td class="mainbg pageContent" width="35%">Password:</td>
							<td class="mainbg2 pageContent"><input type="password" required="1" id="pw" size="50" onblur="checkPass();" name="pw" class="form-control" /><div style="font-size:12px;">Please choose a <u>secure</u> password with letters and numbers. Do not make a password that relates to your username, birthday, name, state, email, etc.</div><div id="p1"></div></td>
						</tr>
						<tr>
							<td class="mainbg pageContent" width="35%">Confirm Password:</td>
							<td class="mainbg2 pageContent"><input type="password" required="1" size="50" onblur="confirmPass();" name="pw2" id="password2" class="form-control" /><div style="font-size:12px;">For security purposes, please enter your password again, exactly the way you entered it in the previous input field.</div><div id="p2"></div></td>
						</tr>
						<tr>
							<td class="mainbg pageContent" width="35%">Birthday:</td>
							<td class="mainbg2 pageContent">
							<select name="month" class="form-control">
    <?php
    	$months = array("","January","February","March","April","May","June","July","August","September","October","November","December");
    	for($i=1;$i<13;$i++){
    		$t = (strlen($i)==1) ? "0".$i : $i;
    		echo "<option value=\"".$t."\"";
    		if($_POST["month"] == $m) echo " selected=\"selected\"";
    		echo ">".$months[$i]."</option>\r\n";
    	}
    ?>
    </select>
    <select name="day" class="form-control">
    <?php
    	for($i=1;$i<32;$i++){
    		//$d = (strlen($i)==1) ? "0" . $i : $i;
    		(int) $d = ($i<10)?"0".$i:$i;
    		echo "<option value=\"".$d."\"";
    		if($_POST["days"] == $d) echo " selected=\"selected\"";
    		echo ">".$i."</option>";
    	}
    ?>
    </select>
    <select name="year" class="form-control">
    <?php
    	for($i=1920;$i<(date("Y")-13);$i++){
    		echo "<option value=".$i."";
    		if($_POST["year"] == $i) echo " selected=\"selected\"";
    		echo ">".$i."</option>";
    	}
    ?>
    </select>
							<div style="font-size:12px;">Please enter your birthday.</div></td>
						</tr>
						<tr>
							<td class="mainbg pageContent" width="35%">Gender:</td>
							<td class="mainbg2 pageContent"><select name="gender" class="form-control"><option value="unspecified">Unspecified</option><option value="male">Male</option><option value="female">Female</option></select>
								<div style="font-size:12px;">Please tell us whether you are male or female. You may choose unspecified for now, if you wish.</div>
							</td>
						</tr>
						<?php if(!isset($_POST["submit"]) OR $errors != ""){ ?>
						<tr>
							<td class="mainbg pageContent" style="vertical-align: top; width: 35%;" name="cptch">reCAPTCHA:</td>
							<td class="mainbg2 pageContent"><!--<div id="cptch">
							<img src="captcha.php" style="border-radius: 4px;" />
							</div>-->
							<div class="g-recaptcha" data-sitekey="6Lc5mAMTAAAAALcDfFEw65-npCZkuqXR2Ei-b1_H"></div>
							<div style="font-size: 12px;">Please verify that you are not cybernetic.</div>
							</td>
						</tr>
						<?php } ?>
						<tr>
							<td class="mainbg pageContent" colspan="2" id="cr1">
								<div class="brl"></div>
								<div style="text-transform: uppercase; font-family: 'sans-serif','arial'; font-size: 11px; text-align: center; font-weight: bolder;">Terms of Service:</div>
								<div class="brl"></div>
								<div style="background: #dddddd; color: #000000; height: 150px; width: 50%; overflow: auto; border: 1px solid #ccc; padding: 2px; margin: 0px auto; border-radius: 4px;"><?php
									$data = sql("SELECT content FROM pages WHERE alias = 'tos'");
									echo $data["content"];
								?></div>
								<div class="brl"></div>
								<div style="text-align: center;">
								By registering with this Web site and/or its community, you are bound by the Web site's <a href="http://www.zollernverse.org/p/tos" class="nWin">Terms of Service</a> (shown above). Click <strong>Finish</strong> to continue.
								</div>
								<div class="brl"></div>
								<div style="text-align: center;">
								<button type="submit" name="submit" id="cr" style="vertical-align: top;"><img src="buttons/accept.png" /> Finish</button>
								<button type="reset"><img src="buttons/delete.png" /> Clear All</button>
								</div>
							</td>
						</tr>
						<tr><th class="titlebg" colspan="2">&nbsp;</th></tr>
						</table>
						</form>
						<?php
						}
						break;
						case 'unansweredtopics':
						changeTitle("Unanswered Topics");
						?>
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg">Unanswered Topics</th></tr>
						<tr>
						<td class="mainbg2">Below are all topics that have not yet had a reply.</td>
						</tr>
						<?php
						$gettopics = mysqli_query($con, "SELECT id FROM topics ORDER BY posted DESC") OR SQLError();
						while($t = fetch($gettopics)){
							$i++;
							$gu = mysqli_query($con, "SELECT * FROM topics WHERE topic_id = '".$t["id"]."'") OR SQLError();
							$u = fetch($gu);
							if(mysqli_num_rows($gu) == 1){
							$userdata = sql("SELECT display,s_tag FROM members WHERE id = '".$u["userid"]."'");
							echo "<tr><td class=\"mainbg\"><a href=\"?act=topic&id=".$u["id"]."\">".$u["subject"]."</a> by ".getDisplay($u["userid"])."</td></tr>";
							}
						}
						?>
				</table>
		</div>
		<?php
			break;
			case 'realtime':
			AuthCheck(4);
			changeTitle("Security Log");
			?>
			<table class="table bordercolor" cellspacing="1" cellpadding="4">
			<tr><th class="titlebg">Current Activity</th></tr>
			<tr>
			<td class="mainbg">
			Below is the current activity of the forum. It updates the second someone does something else.
			<div id="ar"></div>
			</td>
			</tr>
			</table>
			<?php
			js("updateAct();");
			break;
			case 'ipcenter':
			require "ipcenter.php";
       	              break;
       	              case 'hostname':
       	              AuthCheck(4);
       	              changeTitle("Hostname Lookup");
       	              ?>
       	              <form action="" method="post">
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg">Hostname</th></tr>
       	              <tr><td class="mainbg">
       	              <?php
       	              if(isset($_POST["submit"])){
       	              	(string) $hostname = $_POST["ip"];
       	              	echo "<strong>Hostname:</strong> ".gethostbyaddr($hostname)."(".$hostname.")<br />";
       	              	loguser($_COOKIE["id"],"looked up hostname [b]".gethostbyaddr($hostname)."[/b] for IP address [b]".$hostname."[/b].");
       	              }
       	              ?>
       	              IP:<br />
       	              <input type="text" name="ip" class="form-control" />
					  <button type="submit" name="submit" id="go" class="formButton form-control">Go</button>
       	              </td></tr>
       	              </table>
       	              </form>
       	              <?php
       	              break;
       	              case 'boardban1':
       	              AuthCheck(3);
       	              changeTitle("Board Ban - Select Board");
       	              ?>
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg">Select Board</th></tr>
       	              <tr><td class="mainbg">
       	              Please select the board you wish to edit the banned users for.<br />
       	              <select onchange="location.href = '?act=boardban2&id='+$('#s').val();" id="s" class="form-control">
       	              <option value="0">----------------------------------</option>
       	              <?php
       	              $gc = mysqli_query($con, "SELECT id,name FROM boards ORDER BY name ASC") OR SQLError();
       	              while($c = fetch($gc)){
       	              	echo "<option value=\"".$c["id"]."\">".$c["name"]."</option>";
       	              }
       	              ?>
       	              </select>
       	              </td></tr>
       	              </table>
       	              <?php
       	              break;
       	              case 'boardban2':
       	              AuthCheck(3);
       	              (int) $bid = $_GET["id"];
       	              $data = sql("SELECT name,banned FROM boards WHERE id = '".$bid."'");
       	              extract($data);
       	              changeTitle("Board Ban: ".$name);
       	              if(isset($_POST["submit"])){
       	              	query("UPDATE boards SET banned = '".$_POST["bu"]."' WHERE id = '".$bid."'");
       	              	forumMsg("The banned users for this board have been successfully updated.");
       	              	loguser($_COOKIE["id"],"updated the banned users for the [url=?act=viewtopics&bid=".$id."]".$name."[/url] board.");
       	              	admin();
       	              }else{
       	              ?>
       	              <form action="" method="post">
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg">Banned Users</th></tr>
       	              <tr><td class="mainbg2">
       	              This will prevent the users you list from accessing the chosen board only; it won't even be listed on the homepage. Please enter them and separate the exact name with a comma (,); please make sure that there are no spaces.<hr/><textarea cols="50" rows="10" name="bu" id="bu" class="form-control"><?php echo $banned ?></textarea><br /><input type="submit" value="Save Changes" name="submit" />
       	              </td></tr>
       	              </table>
       	              </form>
       	              <?php
       	              }
       	              break;
       	              case 'phpcons':
       	              AuthCheck(4);
       	              changeTitle("PHP Console");
       	              $x = ($_POST["cin"] != "") ? ">> Results:<br /> &nbsp; " : "";
       	              if(isset($_POST["submit"])) loguser($_COOKIE["id"],"eval'd this code in the PHP Console: ".$_POST["cin"]);
       	              ?>
       	              <form action="" method="post">
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg">PHP Console</th></tr>
       	              <tr>
       	              <td class="mainbg2">
       	              This is the PHP Console. It's similar to the mysqli console, but way more powerful and - subsequently - way more dangerous, also. Be EXTREMELY careful when using this. PHP can be incredibly lethal and can put the whole entire site in jeopary, the key to its very existence rests here in your hands. The whole site and its entire community depend upon what you do next. Happy coding!
       	              </td>
       	              </tr>
       	              <tr>
       	              <td class="mainbg">
       	              <div style="width: 760px; height: 350px; overflow: auto; background: #000000; color: #eeeeee; font-family: 'Courier New'; font-size: 16px; padding: 4px; font-weight:bold; text-align: left;" id="cmd"><?php echo $x; eval($_POST["cin"]); ?></div>
       	              </td>
       	              </tr>
       	              <tr>
       	              <td class="mainbg2">
       	              <input type="text" size="90" name="cin" value="Command here.." onfocus="(this.value=='Command here..') ? this.value='' : this.value=this.value;" onblur="(this.value!='')?this.value=this.value:this.value='Command here..';" id="cin" style="background:#000000;color:#eeeeee;" class="form-control" /> <input type="submit" value="Go" name="submit" id="go" />
       	               </td>
       	              </tr>
       	              </table>
       	              <?php
       	              break;
       	              case 'deletepostsbymember':
       	              AuthCheck(3);
       	              changeTitle("Delete Posts For Member");
       	              if(isset($_POST["submit"])){
       	              	if($_POST["user"] == "admin" OR $_POST["user"] == "alphawolf") errMsg("You can't do that.");
       	              	$l = sql("SELECT id FROM members WHERE name = '".$_POST["user"]."'");
       	              	query("DELETE FROM topics WHERE userid = '".$l["id"]."'");
       	              	forumMsg("Posts deleted.");
       	              	loguser($_COOKIE["id"],"deleted all the posts for ".$_POST["user"].".");
       	              	admin();
       	              }else{
       	              ?>
       	              <form action="" method="post">
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg">Delete Posts For Member</th></tr>
       	              <tr><td class="mainbg">
       	              Please enter the username of the person you wish to delete <u>ALL</u> of the posts for.<br />
       	              <input type="text" size="35" id="tu" name="user" required="1" list="users" class="form-control" /> 
       	              <datalist id="users">
       	              <?php
       	              $getusers = mysqli_query($con, "SELECT name FROM members ORDER BY name ASC") OR SQLError();
       	              while($u = fetch($getusers)){
       	              		echo "<option value=\"".$u["name"]."\" />\r\n";
       	              }
       	              ?>
       	              </datalist>
					  <button type="submit" name="submit" id="sub" class="formButton form-control">Go</button>
       	              </td></tr>
       	              <tr><th class="titlebg">&nbsp;</th></tr>
       	              </table>
       	              </form>
       	              <?php
       	              }
       	              break;
       	              case 'bannedusers':
       	              AuthCheck(3);
       	              changeTitle("Banned Users");
       	              $totalBanned = mysqli_num_rows(mysqli_query($con, "SELECT id FROM banned"));
       	              (int) $page = $_GET["page"];
       	              $p = ($page == "" OR $page == 0) ? 0 : ($page-1);
       	              $which = ceil($p*5);
       	              $totalPages = ceil($tb/5);
       	              $getbanned = mysqli_query($con, "SELECT * FROM banned GROUP BY names ORDER BY id DESC LIMIT ".$which.", 5") OR SQLError();
       	              ?>
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg" colspan="4">Banned Users</th></tr>
       	              <tr>
       	              	<th class="catbg">IP</th>
       	              	<th class="catbg">Username</th>
       	              	<th class="catbg">Display</th>
       	              	<th class="catbg">Hostname</th>
       	              </tr>
       	              <tr><td class="mainbg2" colspan="4">
       	              Below are all of the banned users for Zollernverse. Before editing anything here, you must first ask permission from one of the site admins.
       	              </td></tr>
       	              <?php
       	              if($totalBanned == 0){
       	              	echo "<tr><td class=\"mainbg\" colspan=\"4\">No users in the ban list. Not really sure if that's good or bad.</td></tr>";
       	              }
       	              while($banned = fetch($getbanned)){
       	              	extract($banned);
       	              	echo "<tr><td class=\"mainbg\">".$ips."</td><td class=\"mainbg\">".$names."</td><td class=\"mainbg\">".getDisplay($userid)." &nbsp; &nbsp; &nbsp; &nbsp; (<a href=\"?act=unban&id=".$userid."\">unban</a>)</td><td class=\"mainbg\">".$hostname."</td></tr>";
       	              }
       	              ?>
       	              <tr><th class="titlebg" colspan="4">&nbsp;</th></tr>
       	              </table>
       	              <?php
       	              break;
       	              case 'editprofile':
       	              onlineCheck();
					  $xc = new XCrypt();
       	              (int) $uid = ($_GET["u"] == "") ? $_COOKIE["id"] : $_GET["u"];
       	              if($uid == "1" AND $_COOKIE["id"] != "1"){ 
       	              		loguser($_COOKIE["id"],"attempted to modify the admin's profile.");
       	              		errMsg("You cannot modify the admin's profile - a note of this has been made in the logs.");
       	              }
       	              if(isMe($uid) OR checkPerms(4)){
       	              		$hereFor = array("Because I Wanna Be","Video Games","Entertainment","User Interaction","To Make New Friends","Socializing","Game Info","Graphics Or Web Design","Programming","Game Competitors","X-Box Achievements","PS3 Trophies","Lurking","Bragging");
       	              			asort($hereFor);
       	              	if(isset($_POST["submit"])){
							$_tz = $_POST["timezone"];
							$skinid = $_POST["skinid"];
       	              		query("UPDATE members SET s_tag = '".$_POST["s_tag"]."', avatar = '".$_POST["avatar"]."', p_quote = '".addslashes($_POST["p_quote"])."', sig = '".addslashes($_POST["sig"])."', about_me = '".addslashes($_POST["am"])."', species = '".$_POST["species"]."', aim = '".$_POST["aim"]."', msn = '".$_POST["msn"]."', skype = '".$_POST["skype"]."', yim = '".$_POST["yim"]."', website = '".$_POST["website"]."', show_age = '".$_POST["show_age"]."', enable_fade = '".$_POST["ef"]."', disable_pm = '".$_POST["dm"]."', xbox_tag = '".addslashes($_POST["gamertag"])."', invisible = '".$_POST["invis"]."', location = '".addslashes($_POST["location"])."', e_opt = '".$_POST["eo"]."', disabled = '".$_POST["ds"]."', topic_email = '".$_POST["te"]."', psn = '".$_POST["psn"]."', wii_code = '".$_POST["wc"]."', look_in = '".$_POST["look_in"]."', m_email = '".$_POST["m_email"]."', customTitle = '".addslashes($_POST["customTitle"])."', v2mode = '1', hide_av = '".$_POST["hide_av"]."', tfa = '".$_POST["tfa"]."', pin = '".$_POST["pin"]."', hide_sig = '".$_POST["hide_sig"]."', friendsOnly = '".$_POST["friendsOnly"]."', timezone = '".$_tz."', skinid = '".$skinid."' WHERE id = '".$uid."'");
       	              		if(isMe($uid)){
       	              			$rs = implode(", ",$_POST["hereFor"]);
       	              			query("UPDATE members SET herefor = '".$rs."' WHERE id = '".$uid."'");
       	              		}
				$rgCheck = sql("SELECT id,name,userid FROM rg_names WHERE name = '".addslashes($_POST["display"])."'");
				if($rgCheck["id"] == "" OR $_COOKIE["id"] == $rgCheck["userid"]){
       	              			query("UPDATE members SET display = '".$_POST["display"]."' WHERE id = '".$uid."'");
       	              		}else{
       	              			errMsg("This display name is on the site's registered names list and therefore cannot be used by anyone other than the person that has registered it. Sorry. :/");
       	              		}
       	              		$displayCheck = sql("SELECT id FROM display_history WHERE name = '".$_POST["display"]."'");
       	              		if($displayCheck["id"] == ""){
       	              			query("INSERT INTO display_history(name,userid)VALUES('".$_POST["display"]."','".$_COOKIE["id"]."')");
       	              		}
       	              		if(checkPerms(4)){
       	              			query("UPDATE members SET perms = '".$_POST["perms"]."' WHERE id = '".$uid."'");
       	              		}
       	              		loguser($_COOKIE["id"],"edited [user=".$uid."]'s profile.");
       	              		header("Location: ?act=profile&u=".$uid);
       	              	}else{
       	              	$userdata = sql("SELECT * FROM members WHERE id = '".$uid."'");
       	              	changeTitle("Edit Profile: ".$userdata["display"]);
       	              	echo "<form action=\"?act=editprofile&u=",$userdata["id"],"\" method=\"post\">";
       	              	echo '  <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              		<tr><th class="titlebg" colspan="3">Modifying Profile</th></tr>
       	              		<tr><td class="mainbg2" colspan="3">From here, you can edit almost everything about your profile. Customize it to best fit your needs.</td></tr>
       	              		<tr><td class="mainbg">Username:</td>
							<td class="mainbg" style="width: 45%;">'.$userdata['name'].'</td>
       	              		<td class="mainbg2" style="width: 40%;">This is the username you picked when you registered. It cannot be changed.</td></tr>';
       	              		if(isMe($uid)){
								echo '
								<tr>
									<td class="mainbg2" colspan="3" style="text-align: center;">
										<a href="?act=changepass" class="changePass nWin"><img src="buttons/cms_key.png" class="icon" /> Change Password</a>
									</td>
								</tr>';
       	              		}
							echo '
							<tr>
								<td class="mainbg">Enable 2FA:</td>
								<td class="mainbg">
									<select name="tfa" class="form-control" onchange="chkVl();" id="txt2FA" required="1">
										<option value="yes"';
										if($userdata["tfa"] == 'yes'){
											echo ' selected="1"';
										}
										echo '>Enabled</option>
										<option value="no"';
										if($userdata["tfa"] != 'yes'){
											echo ' selected="1"';
										}
										echo '>Disabled</option>
									</select>
									<div style="height: 8px;"></div>
									<div id="tfa" style="display: none;">
										&nbsp; <strong>Enter PIN:</strong> <input type="password" value="'.$userdata["pin"].'" name="pin" pattern="[0-9]{4}" maxlength="4" id="txtPin" placeholder="(4 digit PIN)" class="form-control" /> <a href="javascript:;" onclick="shPIN();" title="Show/Hide PIN"><img src="buttons/siren.png" style="height: 16px; width: 16px;" /></a>
									</div>
								</td>
								<td class="mainbg2">
									Enable or disable <a href="http://en.wikipedia.org/wiki/Two_factor_authentication" onclick="window.open(this.href);return false;">two-factor authentication</a>.
								</td>
							</tr>';
       	              		echo '
       	              		<tr><th class="catbg" colspan="3">Customization</th></tr>
       	              		<tr><td class="mainbg">Display Name:</td><td class="mainbg"><input type="text" value="'.$userdata["display"].'" required="1" maxlength="15" name="display" class="form-control" /></td><td class="mainbg2">This is your public display name, you can change this. Must be between 2 and 10 characters, alphanumeric only (apostrophe and space allowed).
       	              		<div style="text-align: center !important;font-size:13px;font-family:Verdana;border-radius:10px;border:1px solid;width: 150px;"><a href="?act=rgname" onclick="window.open(this.href);return false;">Register Name</a></div></td></tr>
       	              		<tr><td class="mainbg">Member Tag:</td><td class="mainbg"><input type="text" value="'.$userdata["s_tag"].'" maxlength="5" pattern="[a-zA-z0-9]{0,5}" name="s_tag" class="form-control" /></td><td class="mainbg2">This is your member tag that will appear beside your name. 5 characters or less.</td></tr>
       	              		<tr><td class="mainbg">Avatar:</td><td class="mainbg">
       	              		Site Defaults:
							<div class="brl"></div>
       	              		<select name="avSel" onchange="getID(\'av\').src = this.options[this.selectedIndex].value;$(\'#avatar\').val(this.options[this.selectedIndex].value);" class="form-control">
       	              		<option value="">-----------------</option>';
       	              		$getavs = mysqli_query($con, "SELECT url FROM avatars ORDER BY id ASC") OR SQLError();
       	              		while($avs = fetch($getavs)){
       	              			echo "<option value=\"".$avs["url"]."\">".basename($avs["url"])."</option>";
       	              		}
       	              		echo '</select>
							<div class="brl"></div>';
       	              		if($userdata["avatar"] != ""){
       	              			echo '<div><img src="'.$userdata["avatar"].'" id="av" style="height:100px;width:100px;border-radius:4px;" /></div>';
       	              		}
       	              		$species = array("human","alien","robot","ghost","beast","monster","dragon","prophet","guardian","mutant","vulcan","angel","demon","vampire","werewolf","wraith","revenant","banshee","prowler","politician");
       	              		echo '<input type="text" value="'.$userdata["avatar"].'" onblur="updateAv();" id="avatar" size="35" name="avatar" class="form-control" /></td><td class="mainbg2">This is the image that will appear in your mini profile.</td></tr>';
       	              		if(gamerPoints($uid)>= 200 OR checkPerms(3)){
       	              			echo '<tr>
       	              				<td class="mainbg">Personal Title:</td>
       	              				<td class="mainbg">
       	              				<input type="text" value="'.stripslashes($userdata["customTitle"]).'" maxlength="50" name="customTitle" class="form-control" />
       	              				</td>
       	              				<td class="mainbg2">A personal title that will appear beneath your rank in your mini profile. No more than 50 characters.</td>
       	              			</tr>';
       	              		}
								echo '<tr>
									<td class="mainbg">Theme:</td>
									<td class="mainbg">
										<select name="skinid" class="form-control">
										';
										$sk = $userdata["skinid"];
										$getLayouts = mysqli_query($con, "SELECT id,name FROM layouts ORDER BY name ASC") OR SQLError();
										while($l = fetch($getLayouts)){
											echo '<option value="'.$l["id"].'"';
											if($l["id"] == $sk){
												echo ' selected="1"';
											}
											echo '>'.stripslashes($l["name"]).'</option>';
										}
										echo '
										</select>
									</td>
									<td class="mainbg2">Choose your preferred theme for the site.</td>
								</tr>';
       	              		echo '<tr>
       	              		
       	              			<td class="mainbg">Location:</td>
       	              			<td class="mainbg">
       	              			<input type="text" value="'.stripslashes($userdata["location"]).'" name="location" id="lc" class="form-control" />
       	              			</td>
       	              			<td class="mainbg2">
       	              			Where are you at?
       	              			</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg">Species:</td>
       	              			<td class="mainbg">
								<select name="species" class="form-control">
       	              			';
       	              			asort($species);
       	              			foreach($species as $type){
       	              				echo "<option value=\"".$type."\"";
       	              				if($type == $userdata["species"]){
       	              					echo " selected=\"selected\"";
       	              				}
       	              				echo ">".ucfirst($type)."</option>";
       	              			}
       	              			echo '</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              			Just for fun, pick what species you wanna be.
       	              			</td>
       	              		</tr>
       	              		<tr><td class="mainbg">Quote:</td><td class="mainbg"><input type="text" value="'.$userdata["p_quote"].'" maxlength="100" size="35" name="p_quote" class="form-control" /></td><td class="mainbg2">Your own personal quote. This will appear beneath your avatar.</td></tr>
       	              		<tr><td class="mainbg">Signature:</td><td class="mainbg"><textarea cols="35" rows="5" name="sig" id="sig" class="form-control">'.stripslashes($userdata["sig"]).'</textarea></td><td class="mainbg2">This is your signature that will appear beneath your posts and messages.</td></tr>
       	              		<tr><th class="catbg" colspan="3">Settings</th></tr>
       	              		<tr>
       	              			<td class="mainbg">E-Mails:</td>
       	              			<td class="mainbg">
								<select name="eo" class="form-control">
       	              			<option value="1"';
       	              			if($userdata["e_opt"])
       	              				echo ' selected="1"';
       	              			echo '>Opt-In</option>
       	              			<option value="0"';
       	              			if(!$userdata["e_opt"])
       	              				echo ' selected="1"';
       	              			echo '>Opt-Out</option>
       	              			</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              			Choose whether or not to receive mass e-mails from the admins.
       	              			</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg">Topic E-Mails:</td>
       	              			<td class="mainbg">
								<select name="te" class="form-control">
       	              			<option value="1"';
       	              			if($userdata["topic_email"])
       	              				echo ' selected="1"';
       	              			echo '>Subscribed</option>
       	              			<option value="0"';
       	              			if(!$userdata["topic_email"])
       	              				echo ' selected="1"';
       	              			echo '>Unsubscribed</option>
       	              			</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              			Subscribing to this feature allows you to receive e-mails when people reply to your topic.
       	              			</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg">PM E-Mails:</td>
       	              			<td class="mainbg">
								<select name="m_email" class="form-control">
       	              			<option value="1"';
       	              			if($userdata["m_email"])
       	              				echo ' selected="1"';
       	              			echo '>Subscribed</option>
       	              			<option value="0"';
       	              			if(!$userdata["m_email"])
       	              				echo ' selected="1"';
       	              			echo '>Unsubscribed</option>
       	              			</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              			Subscribing to this feature allows you to receive e-mails when people send you a new personal message.
       	              			</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg">Show Age:</td>
       	              			<td class="mainbg">
       	              			<select name="show_age" class="form-control">
       	              			<option value="yes"';
       	              				if($userdata["show_age"] == 'yes')
       	              					echo " selected=\"1\"";
       	              				echo '>Yes</option>
       	              			<option value="no"';
       	              				if($userdata["show_age"] == 'no')
       	              					echo " selected=\"1\"";
       	              				echo '>No</option>
       	              				</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              				Choose whether or not to show your age and birthday.
       	              			</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg">Show Avatars:</td>
       	              			<td class="mainbg">
       	              			<select name="hide_av" class="form-control">
       	              			<option value="0"';
       	              				if(!$userdata["hide_av"])
       	              					echo " selected=\"1\"";
       	              				echo '>Yes</option>
       	              			<option value="1"';
       	              				if($userdata["hide_av"])
       	              					echo " selected=\"1\"";
       	              				echo '>No</option>
       	              				</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              				Disabling this feature will hide all avatars on the forums.
       	              			</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg">Show Signatures:</td>
       	              			<td class="mainbg">
       	              			<select name="hide_sig" class="form-control">
       	              			<option value="0"';
       	              				if(!$userdata["hide_av"])
       	              					echo " selected=\"1\"";
       	              				echo '>Yes</option>
       	              			<option value="1"';
       	              				if($userdata["hide_av"])
       	              					echo " selected=\"1\"";
       	              				echo '>No</option>
       	              				</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              				Disabling this feature will hide all signatures on the forums.
       	              			</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg">Appear Offline:</td>
       	              			<td class="mainbg">
       	              			<select name="invis" class="form-control">
       	              			<option value="1"';
       	              				if($userdata["invisible"] == '1')
       	              					echo " selected=\"1\"";
       	              				echo '>Enabled</option>
       	              			<option value="0"';
       	              				if($userdata["invisible"] == '0')
       	              					echo " selected=\"1\"";
       	              				echo '>Disabled</option>
       	              			</select>
       	              			</td>
       	              			<td class="mainbg2">
       	              				Enabling this feature allows you to appear offline to regular members.
       	              			</td>
       	              		</tr>
       	              		 <tr>
       	              		 	<td class="mainbg">Enable Fader:</td>
       	              		 	<td class="mainbg">
       	              		 		<select name="ef" class="form-control">
       	              		 		<option value="y"';
       	              		 			if($userdata["enable_fade"] == 'y')
       	              		 				echo " selected=\"selected\"";
       	              		 		echo '>Yes</option>
       	              		 		<option value="n"';
       	              		 			if($userdata["enable_fade"] == 'n')
       	              		 				echo " selected=\"selected\"";
       	              		 		echo '>No</option>
       	              		 		</select>
       	              		 	</td>
       	              		 	<td class="mainbg2">Choose whether or not to enable the news fader on the home page.</td>
       	              		</tr>
       	              		  <tr>
       	              		 	<td class="mainbg">Disable Messaging:</td>
       	              		 	<td class="mainbg">
       	              		 		<select name="dm" class="form-control">
       	              		 		<option value="y"';
       	              		 			if($userdata["disable_pm"] == 'y')
       	              		 				echo " selected=\"selected\"";
       	              		 		echo '>Yes</option>
       	              		 		<option value="n"';
       	              		 			if($userdata["disable_pm"] == 'n')
       	              		 				echo " selected=\"selected\"";
       	              		 		echo '>No</option>
       	              		 		</select>
       	              		 	</td>
       	              		 	<td class="mainbg2">Choosing "yes" blocks all incoming private messages.</td>
       	              		 </tr>
       	              		  <tr>
       	              		 	<td class="mainbg">Friends Only:</td>
       	              		 	<td class="mainbg">
       	              		 		<select name="fonly" class="form-control">
       	              		 		<option value="1"';
       	              		 			if($userdata["friendsOnly"])
       	              		 				echo " selected=\"selected\"";
       	              		 		echo '>Enabled</option>
       	              		 		<option value="0"';
       	              		 			if(!$userdata["friendsOnly"])
       	              		 				echo " selected=\"selected\"";
       	              		 		echo '>Disabled</option>
       	              		 		</select>
       	              		 	</td>
       	              		 	<td class="mainbg2">Enabling this feature means that only users on your friends list can see your profile and statuses, and only friends can send PMs or post comments to you.</td>
       	              		 </tr>
							 <tr>
								<td class="mainbg">Timezone:</td>
								<td class="mainbg">
									<select name="timezone" class="form-control">';
									$tzi = array("America/Chicago","America/New_York","America/Los_Angeles","America/Denver","Pacific/Midway");
									require 'timezones.php';
									echo '
									</select>
								</td>
								<td class="mainbg2">
									Set your timezone for the site.
								</td>
							 </tr>
       	              		 <tr><th class="catbg" colspan="3">Contact Info</th></tr>';
       	              		if(postCount($_COOKIE["id"])>= 100){
       	              		echo '
       	              		<tr>
       	              			<td class="mainbg">Web Site:</td><td class="mainbg"><input type="text" value="'.$userdata["website"].'" id="wbst" name="website" class="form-control" /></td><td class="mainbg2">If you have a web site, please enter it in here.</td>
       	              		</tr>';
       	              		}
       	              		echo '
       	              		<tr>
       	              			<td class="mainbg"><img src="buttons/aol_messenger.png" /> AIM:</td><td class="mainbg"><input type="text" name="aim" value="'.$userdata["aim"].'" id="aim" class="form-control" /></td><td class="mainbg2">Enter your AIM username, if you have one.</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg"><img src="buttons/skype.png" /> Skype:</td><td class="mainbg">
       	              				<input type="text" name="skype" value="'.$userdata["skype"].'" id="skype" class="form-control" />
       	              			</td>
       	              			<td class="mainbg2">If you have Skype, enter your username here.</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg"><img src="buttons/msn_messenger.png" /> MSN:</td><td class="mainbg">
       	              				<input type="text" name="msn" value="'.$userdata["msn"].'" id="msn" class="form-control" />
       	              			</td>
       	              			<td class="mainbg2">If you have Live or MSN Messenger, enter your username here.</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg"><img src="buttons/yahoo_messenger.png" /> Yahoo! IM:</td>
       	              			<td class="mainbg"><input type="text" name="yim" value="'.$userdata["yim"].'" id="yim" class="form-control" /></td>
       	              			<td class="mainbg2">Your <em>Yahoo!</em> username, if you have one.</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg"><img src="buttons/xbox.png" style="height:20px;width:20px;" /> Gamer Tag:</td>
       	              			<td class="mainbg"><input type="text" value="'.$userdata["xbox_tag"].'" name="gamertag" id="gt"  class="form-control" /></td>
       	              			<td class="mainbg2">Enter your X-Box LIVE Gamer Tag here.</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg"><img src="buttons/controller.png" style="height:20px;width:20px;" /> PSN:</td>
       	              			<td class="mainbg"><input type="text" value="'.$userdata["psn"].'" name="psn" id="psn" class="form-control" /></td>
       	              			<td class="mainbg2">Enter your PSN here.</td>
       	              		</tr>
       	              		<tr>
       	              			<td class="mainbg"><img src="buttons/wii.png" style="height:20px;width:20px;" /> Wii Code:</td>
       	              			<td class="mainbg"><input type="text" value="'.$userdata["wii_code"].'" name="wc" id="wc" class="form-control" /></td>
       	              			<td class="mainbg2">Enter your Wii Code here.</td>
       	              		</tr>
       	              		<tr><th class="catbg" colspan="3">Personal</th></tr>
       	              		<tr><td class="mainbg">About Me:</td><td class="mainbg"><textarea cols="35" rows="5" name="am" id="am" class="form-control">'.stripslashes($userdata["about_me"]).'</textarea></td><td class="mainbg2">Tell us a little bit about yourself. Just don\'t get crazy.</td></tr>';
       	              		if(isMe($uid)){
       	              			echo '<tr><td class="mainbg" style="vertical-align: top">Here For:</td>
       	              			<td class="mainbg">';
       	              			$href = explode(", ",$userdata["herefor"]);
       	              			foreach($hereFor AS $hf){
       	              				echo "<input type=\"checkbox\" value=\"".$hf."\"";
       	              				if(in_array($hf,$href))
       	              					echo " checked=\"1\"";
       	              				echo " name=\"hereFor[]\" id=\"hf[]\" class=\"form-control\" /> ".$hf."<br />";
       	              			}
       	              			echo '</td>
       	              			<td class="mainbg2" style="vertical-align: top">What are you here for? Check all that apply (optional).</td>';
       	              		}
       	              		if(checkPerms(4)){
       	              			$ps = array("0:Member","1.5:Robot","2:Moderator","3:Staff","4:Admin","5:Manager");
       	              			echo '<tr><th class="catbg" colspan="3">Administrative Settings</th></tr>
       	              			<tr>
       	              			<td class="mainbg">Permissions:</td>
       	              			<td class="mainbg">
       	              				<select name="perms" class="form-control">
       	              				';
       	              				foreach($ps as $rank){
       	              					$r = explode(":",$rank);
       	              					echo "<option value=\"".$r["0"]."\"";
       	              					if($r["0"] == $userdata["perms"])
       	              						echo " selected=\"selected\"";
       	              					echo ">".$r["1"]."</option>";
       	              				}
       	              				echo '</select>
       	              				</td>
       	              			<td class="mainbg2">The permissions that this user has on the site.</td>
       	              			</tr>
       	              			<tr>
       	              			<td class="mainbg">Disable Account:</td>
       	              			<td class="mainbg">
       	              				<select name="ds" class="form-control">
       	              				<option value="0"';
       	              				if(!$userdata["disabled"])
       	              					echo ' selected="1"';
       	              				echo '>No</option>
       	              				<option value="1"';
       	              				if($userdata["disabled"])
       	              					echo ' selected="1"';
       	              				echo '>Yes</option>
       	              				</select>
       	              				</td>
       	              			<td class="mainbg2">Disabling a user\'s account prevents them from logging in.</td>
       	              			</tr>';
       	              		}
       	              		echo '<tr><td class="titlebg" align="center" colspan="3"><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <button name="da" id="da" onclick="if(reConf(\'Are you sure you want to delete your account? This action can NOT be undone.\')) toLoc(\'?act=deleteaccount&id='.$uid.'\');" class="formButton form-control">Delete Account</button></td></tr>
       	              	</table>';
       	              echo "</form>";
       	              js("function updateAv(){
       	              		$('#av').attr('src',$('#avatar').val());
       	              }
						$(document).ready(function(){
							$('#pass1').text(\"\");
					});");
       	              }
       	              }else{
       	              	unauthorized();
       	              }
       	              break;
       	              case 'clearlogs':
       	              AuthCheck(4);
       	              query("DELETE FROM userLogs");
       	              loguser($_COOKIE["id"],"cleared the user logs.");
       	              notifyUser(1,"[user=".$_COOKIE["id"]."] cleared the user logs.");
       	              header("Location: ?act=viewlogs");
       	              break;
       	              case 'status_history':
       	              onlineCheck();
       	              if(!(int)$_GET["user"]) errMsg("You did not specify a user to check the statuses for.");
       	              changeTitle("Status History");
       	              $totalStatuses = mysqli_query($con, "SELECT * FROM status_history WHERE userid = '".$_GET["user"]."' AND `status` != \"\"") OR SQLError();
       	              $ts = mysqli_num_rows($totalStatuses);
       	              if($ts == 0){
       	              	errMsg("This user does not have any statuses.");
       	              }
       	              $gp = makePages(5);
       	              $p = $gp["0"];
       	              $which = $gp["1"];
       	              $getStatuses = mysqli_query($con, "SELECT * FROM status_history WHERE userid = '".$_GET["user"]."' AND status != \"\" ORDER BY id DESC LIMIT ".$which.",5") OR SQLError();
       	              ?>
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg" colspan="5">Status History</th></tr>
       	              <tr><td class="mainbg2" colspan="5">This user has a total of <strong><?php echo $ts; ?></strong> statuses.</td></tr>
       	              <tr>
       	              	<th class="catbg">User</th><th class="catbg">Status</th><th class="catbg">Posted</th><th class="catbg">Privacy</th>
       	              </tr>
       	              <?php
       	              while($s = fetch($getStatuses)){
       	              	$st = (strlen($s["status"])> 25) ? substr($s["status"],0,25)."..." : $s["status"];
       	              	$el = explode(":",$s["likedBy"]);
			$numComments = numRows("SELECT id FROM status_comments WHERE status_id = '".$s["id"]."'");
       	              	echo "<tr><td class=\"mainbg\">".getDisplay($_GET["user"])."</td>
       	              		<td class=\"mainbg\">".ubbc($st)."
       	              		<br />
       	              		&nbsp; 
       	              		&nbsp;
       	              		 <a href=\"?act=viewstatus&id=".$s["id"]."\"><img src=\"buttons/thumb_up.png\" /></a>  (".(count($el)-1).")
       	              		 &nbsp; &nbsp;
       	              		 <a href=\"?act=viewstatus&id=".$s["id"]."\"><img src=\"buttons/comments.png\" /> Comments</a> (".$numComments.")";
       	              		 if(isMe($s["userid"]) OR checkPerms(3)){
       	              			 echo "&nbsp; &nbsp;
       	              		 <a href=\"?act=deletestatus&id=".$s["id"]."\"><img src=\"buttons/cancel.png\" /> Delete</a>";
       	              		 }
       	              		 echo " </td>
       	              		<td class=\"mainbg\">"
       	              		.dateFormat($s["posted"])." 
       	              		 </td>
       	              		<td class=\"mainbg2\">".ucfirst($s["privacy"])."</td>
       	              	      </tr>
       	              	";
       	              }
       	              $totalPages = ceil($ts/5);
       	              if($totalPages> 1){
       	              	echo "<tr><td class=\"mainbg2\" colspan=\"5\">Pages: (( ";
       	              $i=1;
       	              $cH=0;
       	              while($i <= $totalPages){
       	              	$cH++;
       	              	echo "<a href=\"?act=status_history&user=".$_GET["user"]."&page=".$i."\">".$i."</a>";
       	              	if($cH<$totalPages){
       	              		echo ", ";
       	              	}
       	              	$i++;
       	              }
       	              echo " ))</td></tr>";
       	              }
       	              ?>
       	              <tr><th class="titlebg" colspan="5">&nbsp;</th></tr>
       	              </table>
       	              <?php
       	              break;
       	              case 'deletestatus':
       	              onlineCheck();
       	              idCheck();
       	              $sdata = sql("SELECT * FROM status_history WHERE id = '".$_GET["id"]."'");
       	              if(!checkPerms(3) AND !isMe($sdata["userid"])) unauthorized();
       	              query("DELETE FROM status_history WHERE id = '".$_GET["id"]."'");
       	              query("DELETE FROM status_comments WHERE status_id = '".$_GET["id"]."'");
       	              loguser($_COOKIE["id"],"deleted a status of [user=".$sdata["userid"]."].");
       	              toLoc("?act=status_history&user=".$sdata["userid"]);
       	              break;
       	              case 'banuser':
       	              AuthCheck(3);
       	              if(!(int)$_GET["id"]) errMsg("No user ID was given.");
       	              (int) $uid = $_GET["id"];
       	              $udata = sql("SELECT display FROM members WHERE id = '".$uid."'");
       	              changeTitle("Ban: ".$udata["display"]);
       	              banUser($uid);
       	              forumMsg("This user was banned successfully.");
       	              admin();
       	              break;
       	              case 'unban':
       	              AuthCheck(3);
       	              if(!(int)$_GET["id"]) errMsg("No user ID was given.");
       	              (int) $uid = $_GET["id"];
       	              $udata = sql("SELECT display FROM members WHERE id = '".$uid."'");
       	              changeTitle("Unban: ".$udata["display"]);
       	              query("DELETE FROM banned WHERE userid = '".$uid."'");
       	              query("UPDATE members SET warn = 0 WHERE id = '".$uid."'");
       	              loguser($_COOKIE["id"],"unbanned [user=".$uid."].").
       	              forumMsg("This user was unbanned successfully.");
       	              admin();
       	              break;
       	              case 'wordsub':
       	              AuthCheck(3);
       	              changeTitle("Word Substitution");
       	              $getcensors = mysqli_query($con, "SELECT * FROM censored") OR SQLError();
       	              if(isset($_POST["submit"])){
       	            	  $i = $_POST["i"];
       	                  $t = 0;
       	                  while($t < $i){
       	                  	$orig = $_POST["cens".$t];
       	                  	$iNew = $_POST["new".$t];
       	                  	if($orig != ""){
       	                  	$check = sql("SELECT id FROM censored WHERE original = '".$orig."'");
       	                  	if($check["id"] == ""){
       	                  		query("INSERT INTO censored(original,censor,userid,added)VALUES('".$orig."','".$iNew."','".$_COOKIE["id"]."',CURRENT_TIMESTAMP)");
       	                  	}else{
       	                  		query("UPDATE censored SET original = '".$orig."', censor = '".$iNew."' WHERE id = '".$_POST["id".$i]."'");
       	                  	}
       	                  	}
       	                  	$t++;
       	                  }
       	                  loguser($_COOKIE["id"],"updated the censored words.");
       	                  forumMsg("Your censored words were updated successfully.");
       	                  admin();
       	              }else{
       	              ?>
       	              	<form action="" method="post">
       	              	<table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              	<tr><th class="titlebg" colspan="2">Word Substitution</th></tr>
       	              	<tr><td class="mainbg2" colspan="2">These are the substituted words (or censors) for Zollernverse. Whatever you enter in the 'original' field will be replaced by what's in its adjacent 'new' field.<br /><strong>NOTE:</strong> If you delete a censor, DO NOT click on 'save changes.' Simply leave and come back, otherwise the deleted item will still be there.</td></tr>
       	              	<tr>
       	              		<th class="catbg">Original</th>
       	              		<th class="catbg">New</th>
       	              	</tr>
       	              	<?php
       	              		$i=0;
       	              		while($c = fetch($getcensors)){
       	              			echo '<tbody id="t-'.$i.'">
       	              			<tr>
       	              				<td class="mainbg" align="center">(<a href="javascript:;" onclick="deleteCensor('.$i.');">X</a>) &nbsp; <input type="text" value="'.$c["original"].'" size="35" id="o'.$i.'" name="cens'.$i.'" class="form-control" /></td>
       	              				<td class="mainbg" align="center"><input type="text" value="'.$c["censor"].'" size="35" id="n'.$i.'" name="new'.$i.'" class="form-control" />
       	              					<input type="hidden" value="'.$c["id"].'" id="id'.$i.'" name="id'.$i.'" size="0" class="form-control" /></td>
       	              			</tr>
       	              		       </tbody>';
       	              			$i++;
       	              		}
       	              		for((int)$f=$i;$f<($i+5);$f++){
       	              			echo '<tr>
       	              				<td class="mainbg" align="center">
										<input type="text" size="35" value="" name="cens'.$f.'" class="form-control" />
									</td>
       	              				<td class="mainbg" align="center">
										<input type="text" size="35" value="" name="new'.$f.'" class="form-control" />
       	              					<input type="hidden" name="id'.$f.'" class="form-control" />
									</td>
       	              			</tr>';
       	              		}
       	              		echo '<tr style="display: none;"><td><input type="hidden" value="'.$f.'" name="i" class="form-control" /></td></tr>';
       	              		
       	              	?>
       	              	<tr><td class="mainbg2" colspan="2"  id="subCell" align="center"><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button></td></tr>
       	              	<tr><th class="titlebg" colspan="2">&nbsp;</th></tr>
       	              	</table>
       	              	</form>
       	              <?php
       	              }
       	              break;
       	              case 'mranks':
       	              AuthCheck(4);
       	              changeTitle("Member Ranks");
       	              $getranks = mysqli_query($con, "SELECT name,posts FROM ranks ORDER BY posts ASC") OR SQLError();
       	              $nr = mysqli_num_rows($getranks);
       	              if(isset($_POST["submit"])){
       	            	 (int) $i = $_POST["i"];
       	                  $t = 0;
       	                  while($t <= $i){
       	                  	$name = $_POST["rank".$t];
       	                  	$posts = $_POST["post".$t];
       	                  	if($name != ""){
       	                  	$check = sql("SELECT id FROM ranks WHERE name = '".$name."'");
       	                  	if($check["id"] == ""){
       	                  		query("INSERT INTO ranks(name,posts)VALUES('".addslashes($name)."','".$posts."')");
       	                  	}else{
       	                  		query("UPDATE ranks SET posts = '".$posts."' WHERE name = '".addslashes($name)."'");
       	                  	}
       	                  	}
       	                  	$t++;
       	                  }
       	                  loguser($_COOKIE["id"],"updated the member ranks.");
       	                  forumMsg("Your member ranks were updated successfully.");
       	                  admin();
       	              }else{
       	              ?>
       	              <form action="" method="post">
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg" colspan="2">Member Ranks</th></tr>
       	              	<tr><td class="mainbg2" colspan="2">These are the ranks of Zollernverse's forums. For a user to reach the next rank or "level up," they must reach the amount of posts required for that particular rank. On the left are the names of the ranks, and on the right are the amount of posts needed in order to reach it. Be sure to keep them reasonable.<div style="text-align: center;">
       	              	There are <strong><?php echo number_format($nr); ?></strong> current ranks.
       	   </div>     </td></tr>
       	              <tr>
       	              	<th class="catbg">Rank Name</th>
       	              	<th class="catbg">Posts Required</th>
       	              </tr>
       	              <?php
       	              		$i=0;
       	              		while($r = fetch($getranks)){
       	              			echo "<tbody id=\"r".$i."\">
       	              			<tr>
       	              				<td class=\"mainbg\" align=\"right\">
       	              				<input type=\"text\" value=\"".stripslashes($r["name"])."\" size=\"35\" name=\"rank".$i."\" id=\"rank".$i."\" class=\"form-control\" />
       	              				</td>
       	              				<td class=\"mainbg\">
       	              				<input type=\"text\" value=\"".stripslashes($r["posts"])."\" size=\"35\" name=\"post".$i."\" id=\"post".$i."\" class=\"form-control\" />
       	              				</td>
       	              			</tr>
       	              			<input type=\"hidden\" value=\"".$i."\" name=\"i\" id=\"0\" size=\"0\" />
       	              			<input type=\"hidden\" value=\"".$i."\" name=\"id".$i."\" id=\"id".$i."\" size=\"0\" />
       	              		       </tbody>
       	              		       ";
       	              		       $i++;
       	              		}
       	              		for((int)$y=$i;$y<($i+5);$y++){
       	              			echo "<tr>
       	              				<td class=\"mainbg\" align=\"right\"><input type=\"text\" size=\"35\" name=\"rank".$y."\" id=\"rank".$y."\" class=\"form-control\" /></td>
       	              				<td class=\"mainbg\"><input type=\"text\" size=\"35\" name=\"post".$y."\" id=\"post".$y."\" class=\"form-control\" /></td>
       	              			</tr>
       	              			<input type=\"hidden\" value=\"".$y."\" name=\"i\" id=\"0\" size=\"0\" />
       	              			<input type=\"hidden\" value=\"".$y."\" name=\"id".$y."\" id=\"id".$y."\" size=\"0\" />";
       	              		}
       	              ?>
       	              	<tr><td class="mainbg2" align="center" colspan="2" id="subCell"><button type="submit" id="sc" name="submit" class="formButton form-control">Save Changes</button></td></tr> 
       	              	<tr><th class="titlebg" colspan="2">&nbsp;</th></tr>
       	              </table>
       	              <?php
       	              }
       	              break;
       	              case 'viewranks':
       	              changeTitle("View Ranks");
       	              $getranks = mysqli_query($con, "SELECT * FROM ranks ORDER BY posts ASC") OR SQLError();
       	              ?>
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg" colspan="2">Member Ranks</th></tr>
       	              <tr>
       	              	<th class="catbg">Rank Name</th>
       	              	<th class="catbg">Posts Required</th>
       	              </tr>
       	              <?php
       	              		while($r = fetch($getranks)){
       	              			echo "<tr>
       	              				<td class=\"mainbg\">".stripslashes($r["name"])."</td>
       	              				<td class=\"mainbg\">".number_format($r["posts"])."</td>
       	              			</tr>";
       	              		}
       	              ?>
       	              <tr><th class="titlebg" colspan="2">&nbsp;</th></tr>
       	              </table>
       	              <?php
       	              break;
       	              case 'reserved':
       	              AuthCheck(3);
       	              changeTitle("Reserved Names");
       	              $reserved = sql("SELECT rnames FROM sitedata");
       	              if(isset($_POST["submit"])){
       	              		query("UPDATE sitedata SET rnames = '".$_POST["names"]."'");
       	              		loguser($_COOKIE["id"],"updated the reserved names.");
       	              		forumMsg("Restricted names successfully updated.");
       	              		admin();
       	              }else{
       	              ?>
       	              <form action="" method="post">
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg" colspan="2">Reserved Names</th></tr>
       	              <tr>
       	              	<td class="mainbg" style="vertical-align: top">
       	              		<?php
       	              			echo "<textarea cols=\"45\" rows=\"5\" name=\"names\" class=\"form-control\">".$reserved["rnames"]."</textarea>";
       	              		?></td>
       	              	<td class="mainbg2" style="vertical-align: top">This is the site's list of reserved names. Users will not be able to sign up with these names that are listed here. Separate each name with a comma (,).</td>
       	              </tr>
       	              <tr>
       	              	<td class="mainbg" colspan="2" align="center" id="subCell"><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button></td>
       	              </tr>
       	              </table>
       	              </form>
       	              <?php
       	              }
       	              break;
       	              case 'updates':
       	              changeTitle("View Updates");
       	              $page = ($_GET["page"] == 0 OR $_GET["page"] == "") ? 0 : ($_GET["page"]-1);
		      $which = ceil($page)*2;
		      $totalUpdates = mysqli_num_rows(mysqli_query($con, "SELECT id FROM updates"));
       	              ?>
       	              <table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              <tr><th class="titlebg">Zollernverse Updates</th></tr>
       	              <tr><td class="mainbg2">Wanna keep up with the updates easier? Subscribe to our <a href="rss/updates.xml" onclick="window.open(this.href);return false;"><img src="buttons/rss.png" /></a> feed.
       	              <?php
       	              if(checkPerms(4)){
       	              	echo "<div style=\"text-align:right;\"><a href=\"?act=addupdate\"> <img src=\"buttons/bullet_add.png\" /> Add Update</a></div>";
       	              }
       	              ?>
       	              </td></tr>
       	              <?php
       	              if(!(int)$_GET["id"]){
       	              	$getupdates = mysqli_query($con, "SELECT * FROM updates ORDER BY posted DESC LIMIT ".$which.", 2");
       	              	while($u = fetch($getupdates)){
       	              		echo "<tr><th class=\"catbg\">&raquo; ".ubbc($u["subject"])."</th></tr>
       	              			<tr>
       	              				<td class=\"mainbg\">";
       	              					if(checkPerms(4)){
       	              						echo "<div style=\"text-align:right;font-size:14px;\">
       	              							<a href=\"?act=modupdate&id=".$u["id"]."\"><img src=\"modify.gif\" /></a>
       	              							&nbsp;
       	              							<a href=\"?act=delupdate&id=".$u["id"]."\"><img src=\"delete.gif\" /></a>
       	              						</div>";
       	              					}
       	              					echo "<div style=\"font-size:14px;\">Author:</div> ".ubbc("[user=".$u["userid"]."]")." &nbsp; &nbsp; ".dateFormat($u["posted"])." 
       	              					<br />
       	              					<div id=\"update".$u["id"]."\" style=\"padding:4px;\">
       	              					 &nbsp; &nbsp; &nbsp; &nbsp; ".ubbc($u["post"])."
       	              					</div>";
       	              					if(online()){
       	              						echo "
       	              					<div style=\"text-align:right;font-weight:bold;\">
       	              					<a href=\"?act=updatecomments&id=".$u["id"]."\"><img src=\"buttons/comments.png\" /> ("
       	              					.mysqli_num_rows(mysqli_query($con, "SELECT id FROM update_comments WHERE update_id = '".$u["id"]."'")).")
       	              					</a>
       	              					</div>";
       	              					}
       	              					echo "<a href=\"?act=updates&id=".$u["id"]."\" style=\"border-radius:15px;border:1px outset #000000;\" class=\"mainbg\">Permalink</a>
       	              			    	</td>
       	              			</tr>
       	              		";    
       	              	}
       	              	$totalPages = ceil($totalUpdates/2);
       	              	if($totalPages> 1){
       	              		echo "<tr>
       	              			<td class=\"mainbg2\">Pages: (( ";
       	              		$i = 1;
       	              		$cH = 0;
       	              		while($i <= $totalPages){
       	              			$cH++;
       	              			echo "<a href=\"?act=updates&page=".$i."\">".$i."</a>";
       	              			if($cH<$totalPages)
       	              				echo ", ";
       	              			$i++;
       	              		}
       	              		echo " ))</td></tr>";
       	              	}
       	              }else{
       	              	$u = sql("SELECT * FROM updates WHERE id = '".$_GET["id"]."'");
       	              	echo "<tr><th class=\"catbg\">&raquo; ".ubbc($u["subject"])."</th></tr>
       	              			<tr>
       	              				<td class=\"mainbg\">";
       	              					if(checkPerms(4)){
       	              						echo "<div style=\"text-align:right;font-size:14px;\">
       	              							<a href=\"?act=modupdate&id=".$u["id"]."\"><img src=\"modify.gif\" /></a>
       	              							&nbsp;
       	              							<a href=\"?act=delupdate&id=".$u["id"]."\"><img src=\"delete.gif\" /></a>
       	              						</div>";
       	              					}
       	              					echo "<div style=\"font-size:14px;\">Author:</div> ".ubbc("[user=".$u["userid"]."]")." &nbsp; &nbsp; ".dateFormat($u["posted"])." 
       	              					<br />
       	              					<div id=\"update".$u["id"]."\" style=\"padding:4px;\">
       	              					 &nbsp; &nbsp; &nbsp; &nbsp; ".ubbc($u["post"])."
       	              					</div>
       	              					<div style=\"text-align:right;font-weight:bold;\">
       	              					<a href=\"?act=updatecomments&id=".$u["id"]."\"><img src=\"buttons/comments.png\" /> ("
       	              					.mysqli_num_rows(mysqli_query($con, "SELECT id FROM update_comments WHERE update_id = '".$u["id"]."'")).
       	              					")
       	              					</a>
       	              					</div>
       	              			    	</td>
       	              			</tr>
       	              		";    
       	              	}
       	              ?>
       	              </table>
       	              <?php
       	              break;
       	              case 'addupdate':
       	              	AuthCheck(3);
       	              	changeTitle("Adding Update");
       	              		?>
       	              		<div id="a"></div>
       	              		<form action="javascript:saveRSS();" method="post">
       	              		<table class="table bordercolor" cellspacing="1" cellpadding="4">
       	              		<tr><th class="titlebg">Add Update</th></tr>
       	              		<tr><td class="mainbg">
       	              			Subject:<br />
       	              				<input type="text" name="subject" size="60" required="1" id="sb" class="form-control" />
       	              				<br />
       	              			Update:<br />
       	              				<textarea cols="93" rows="10" name="post" id="update" required="1" class="form-control"></textarea>
       	              		</td></tr>
       	              		<tr><th align="center" class="mainbg2"><button type="submit" name="submit" id="au" class="formButton form-control">Add Update</button></th></tr>
       	              		</table>
       	              		</form>
       	              		<?php
       	              break;
       	              case 'modupdate':
       	              	AuthCheck(4);
       	              	changeTitle("Modifying Update");
       	              	idCheck();
       	              		$updateData = sql("SELECT subject,post FROM updates WHERE id = '".$_GET["id"]."'");
       	              	if(isset($_POST["submit"])){
       	              		extract($_POST);
       	              		query("UPDATE updates SET subject = '".addslashes($subject)."', post = '".addslashes($post)."' WHERE id = '".$_GET["id"]."'");
       	              		loguser($_COOKIE["id"],"modified a site update.");
       	              		header("Location: ?act=updates");
       	              	}else{
       	              		extract($updateData);
       	              	?>
       	              		<form action="" method="post">
       	              		<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              		<tr><th class="titlebg">Modify Update</th></tr>
       	              		<tr><td class="mainbg">
       	              			Subject:<br />
       	              				<input type="text" value="<?php echo stripslashes($subject); ?>" name="subject" required="1" id="sb" class="form-control" />
       	              				<br />
       	              			Update:<br />
       	              				<textarea cols="40" rows="10" name="post" id="update" required="1" class="form-control"><?php echo stripslashes($post); ?></textarea>
       	              		</td></tr>
       	              		<tr><th align="center" class="mainbg2"><button type="submit" name="submit" id="au" class="formButton form-control">Save Changes</button></th></tr>
       	              		</table>
       	              		</form>
       	              	<?php
       	              	}
       	              break;
       	              case 'delupdate':
       	              	AuthCheck(4);
       	              	idCheck();
       	              	query("DELETE FROM updates WHERE id = '".$_GET["id"]."'");
       	              	loguser($_COOKIE["id"],"deleted a site update.");
       	              	header("Location: ?act=updates");
       	              break;
       	              case 'reportcenter':
       	              AuthCheck(3);
       	              changeTitle("Report Center");
       	              ?>
       	              <table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              <tr><th class="titlebg">Report Center</th></tr>
       	              <tr>
       	              	<td class="mainbg">
       	              	&nbsp; &nbsp; Below are all the sent-in reports for the forum posts. You can choose from several different options of what action you would like to take.<hr/>
       	              	<?php
       	              	$gr = mysqli_query($con, "SELECT * FROM reports ORDER BY id DESC") OR SQLError();
       	              	while($r = fetch($gr)){
       	              		$pdata = sql("SELECT post,userid FROM topics WHERE id = '".$r["postid"]."'");
       	              		echo "<strong>Sent In:</strong> ".dateFormat($r["sent_in"])."
       	              		<br /><strong>By User:</strong> ".getDisplay($r["userid"])."
       	              		<div class=\"quote\">
       	              			".getDisplay($pdata["userid"]).":
       	              			<br />
       	              			".ubbc($pdata["post"])."
       	              		</div>".
       	              			ubbc($r["details"])."
       	              			<br />
       	              			<a href=\"?act=acceptreport&id=".$r["id"]."\">Accept Report / Warn Offender</a><br />
       	              			<a href=\"?act=denyreport&id=".$r["id"]."\">Deny Report / Warn Sender</a><br />
       	              			<a href=\"?act=deletereport&id=".$r["id"]."\">Delete Report</a>
       	              			";
       	              	}
       	              	?>
       	              	</td>
       	              </tr>
       	              </table>
       	              <?php
       	              break;
       	              case 'acceptreport':
       	              	AuthCheck(3);
       	              	idCheck();
       	              	$data = sql("SELECT postid,userid FROM reports WHERE id = '".$_GET["id"]."'");
       	              	$postdata = sql("SELECT userid FROM topics WHERE id = '".$data["postid"]."'");
       	              	warnReason($postdata["userid"],'via report',"Report accepted by staff",10);
       	              	query("DELETE FROM reports WHERE id = '".$_GET["id"]."'");
       	              	loguser($_COOKIE["id"],"accepted a report from the center.");
       	              	notifyUser($data["userid"],"[user=".$_COOKIE["id"]."] has accepted your report.");
       	              	header("Location: ?act=reportcenter");
       	              break;
       	              case 'denyreport':
       	              	AuthCheck(3);
       	              	idCheck();
       	              	$data = sql("SELECT userid FROM reports WHERE id = '".$_GET["id"]."'");
       	              	warnReason($data["userid"],"via report","Report denied by staff",10);
       	              	query("DELETE FROM reports WHERE id = '".$_GET["id"]."'");
       	              	loguser($_COOKIE["id"],"denied a report from the center.");
       	              	notifyUser($data["userid"],"[user=".$_COOKIE["id"]."] has denied your report.");
       	              	header("Location: ?act=reportcenter");
       	              break;
       	              case 'deletereport':
       	              	AuthCheck(3);
       	              	idCheck();
       	              	query("DELETE FROM reports WHERE id = '".$_GET["id"]."'");
       	              	loguser($_COOKIE["id"],"deleted a report from the center.");
       	              	header("Location: ?act=reportcenter");
       	              break;
       	              case 'medals':
       	              AuthCheck(4);
       	              changeTitle("Forum Achievements");
       	              ?>
       	              <table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              <tr><th class="titlebg" colspan="4">Forum Achievements</th></tr>
       	              <tr>
       	              		<td class="mainbg" colspan="4">Below are all of the forum achievements. You can add one by clicking <a href="?act=addmedal">here</a>.</td>
       	              </tr>
       	              <tr>
       	              	<th class="catbg">Name</th>
       	              	<th class="catbg">About</th>
       	              	<th class="catbg">Requirement</th>
       	              	<th class="catbg">Points</th>
       	              </tr>
       	              <?php
       	              	$getach = mysqli_query($con, "SELECT * FROM medals ORDER BY gpoints ASC");
       	              	if(mysqli_num_rows($getach) == 0){
       	              		echo "<tr><td class=\"mainbg\" colspan=\"4\">No achievements have been added yet.</td></tr>";
       	              	}
       	              	while($a = fetch($getach)){
       	              		echo "<tr>
       	              			<td class=\"mainbg\">(<a href=\"?act=editmedal&id=".$a["id"]."\">edit</a> / <a href=\"?act=deletemedal&id=".$a["id"]."\">delete</a>) ".stripslashes($a["name"])."</td>
       	              			<td class=\"mainbg\">".stripslashes($a["about"])."</td>
       	              			<td class=\"mainbg\">".$a["requirement"]."</td>
       	              			<td class=\"mainbg\">".$a["gpoints"]."</td>
       	              		</tr>";
       	              	}
       	              ?>
       	              </table>
       	              <?php
       	              break;
       	              case 'editmedal':
       	              AuthCheck(4);
       	              changeTitle("Edit Medal");
       	              idCheck();
       	              if(isset($_POST["submit"])){
       	              		query("UPDATE medals SET name = '".addslashes($_POST["name"])."', about = '".addslashes($_POST["about"])."', requirement = '".addslashes($_POST["required"])."', gpoints = '".$_POST["gpoints"]."' WHERE id = '".$_GET["id"]."'");
       	              		loguser($_COOKIE["id"],"edited a forum achievement.");
       	              		toLoc("?act=medals");
       	              }else{
       	              echo '<form action="" method="post">
       	              <table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              <tr><th class="titlebg" colspan="4">Forum Achievements</th></tr>
       	              <tr>
       	              	<th class="catbg">Name</th>
       	              	<th class="catbg">About</th>
       	              	<th class="catbg">Requirement</th>
       	              	<th class="catbg">Points</th>
       	              </tr>';
       	              $data = sql("SELECT * FROM medals WHERE id = '".$_GET["id"]."'");
       	              echo '<tr>
       	              	<td class="mainbg"><input type="text" value="'.stripslashes($data["name"]).'" name="name" id="n" class="form-control" /></td>
       	              	<td class="mainbg"><textarea cols="40" rows="3" name="about" id="a" class="form-control">'.stripslashes($data['about']).'</textarea></td>
       	              	<td class="mainbg"><input type="text" value="'.$data["requirement"].'" name="required" id="r" class="form-control" /></td>
       	              	<td class="mainbg"><select name="gpoints" id="gp" class="form-control">';
       	              	$gpoints = array(5,10,15,20,25,50,75,100,150,200,250,300);
       	              	$i = 0;
       	              	do {
       	              		echo "<option value=\"".$gpoints[$i]."\"";
       	              		if($gpoints[$i] == $data["gpoints"])
       	              			echo " selected=\"selected\"";
       	              		echo ">".$gpoints[$i]."</option>";
       	              		$i++;
       	              	} while($i < count($gpoints));
       	              	echo '</select>
       	              	     </td>
       	              	    </tr>
       	              	    <tr>
       	              	    	<th class="catbg" colspan="4" align="center" name="sub"><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button></th>
       	              	    </tr>
       	                   </table>
       	                  </form>';
       	              }
       	              break;
       	              case 'deletemedal':
       	              AuthCheck(4);
       	              if(!(int)$_GET["id"]) errMsg("Error");
       	              query("DELETE FROM medals WHERE id = '".$_GET["id"]."'");
       	              loguser($_COOKIE["id"],"deleted a forum achievement.");
       	              toLoc("?act=medals");
       	              break;
       	              case 'addmedal':
       	              AuthCheck(4);
       	              changeTitle("Add Medal");
       	              if(isset($_POST["submit"])){
       	              		query("INSERT INTO medals(name,about,requirement,gpoints)VALUES('".addslashes($_POST["name"])."','".addslashes($_POST["about"])."','".$_POST["required"]."','".$_POST["gpoints"]."')");
       	              		loguser($_COOKIE["id"],"added a forum achievement.");
       	              		toLoc("?act=medals");
       	              }else{
       	             	 echo '<form action="" method="post">
       	              <table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              <tr><th class="titlebg" colspan="4">Forum Achievements</th></tr>
       	              <tr>
       	              	<th class="catbg">Name</th>
       	              	<th class="catbg">About</th>
       	              	<th class="catbg">Requirement</th>
       	              	<th class="catbg">Points</th>
       	              </tr>
       	               <tr>
       	              	<td class="mainbg"><input type="text" name="name" id="n" class="form-control" /></td>
       	              	<td class="mainbg"><textarea cols="40" rows="3" name="about" id="a" class="form-control"></textarea></td>
       	              	<td class="mainbg"><input type="text" name="required" id="r" class="form-control" /></td>
       	              	<td class="mainbg"><select name="gpoints" id="gp" class="form-control">';
       	              	$gpoints = array(5,10,15,20,25,50,75,100,150,200,250,300);
       	              	$i = 0;
       	              	do {
       	              		echo "<option value=\"".$gpoints[$i]."\">".$gpoints[$i]."</option>";
       	              		$i++;
       	              	} while($i < count($gpoints));
       	              	echo '</select>
       	              	     </td>
       	              	    </tr>
       	              	    <tr>
       	              	    	<th class="catbg" colspan="4" align="center" name="sub"><button type="submit" name="submit" id="sc" class="formButton form-control">Add</button></th>
       	              	    </tr>
       	                   </table>
       	                  </form>';
       	                }
       	              break;
       	              case 'vmedals':
       	              $m = sql("SELECT medals FROM members WHERE id = '".((int)$_GET["user"])."'");
       	              $n = explode(":",$m["medals"]);
       	              changeTitle($logged["display"]."'s Achievements");
       	              if(!online()) $getmedals = mysqli_query($con, "SELECT * FROM medals") OR SQLError();
       	              ?>
       	              <table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              <tr><th class="titlebg" colspan="4"><?php echo ubbc("[user=".$_GET["user"]."]"); ?>'s Achievements</th></tr>
       	              <tr>
       	              	<td class="mainbg" colspan="4">(<?php echo count($n)-1; ?> / <?php echo mysqli_num_rows($getmedals); ?>)</td>
       	              </tr>
       	              <tr>
       	              		<th class="catbg">Name</th>
       	              		<th class="catbg">About</th>
       	              </tr>
       	              <?php
       	              	$e = explode(":",$m["medals"]);
       	              	$i=1;
       	              	$c = count($e);
       	              	while($i < $c){
       	              		$data = sql("SELECT * FROM medals WHERE id = '".$e[$i]."'");
       	              		echo "<tr>
       	              			<td class=\"mainbg\">(".$data["gpoints"]."G) &nbsp; &nbsp; ".stripslashes($data["name"])."</td>
       	              			<td class=\"mainbg\">".stripslashes($data["about"])."</td>
       	              		</tr>";
       	              		$i++;
       	              	}
       	              	break;
       	              ?>
		      </table>
       	              <?php
       	              case 'achview':
       	              changeTitle("View Achievements");
       	              $gdata = mysqli_query($con, "SELECT * FROM medals ORDER BY gpoints ASC");
       	              ?>
       	              <table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              <tr><th class="titlebg" colspan="4">Forum Achievements</th></tr>
       	              <tr>
       	              	<td class="mainbg2" colspan="2">There are <?php echo mysqli_num_rows($gdata); ?> current achievements.</td>
       	              </tr>
       	              <tr>
       	              		<th class="catbg">Name</th>
       	              		<th class="catbg">About</th>
       	              </tr>
       	              <?php
       	              	$e = explode(":",$m["medals"]);
       	              	$i=1;
       	              	$c = count($e);
       	              	$gdata = mysqli_query($con, "SELECT * FROM medals ORDER BY gpoints ASC");
       	              	while($data = fetch($gdata)){
       	              		echo "<tr>
       	              		<td class=\"mainbg\">".stripslashes($data["name"])." (".$data["gpoints"]."G)</td>
       	              		<td class=\"mainbg\">".stripslashes($data["about"])."</td>
       	              		</tr>";
       	              	}
       	              	echo "</table>";
       	              	break;
       	              	case 'viewstatus':
       	              	onlineCheck();
       	              	idCheck();
       	              	$data = sql("SELECT * FROM status_history WHERE id = '".$_GET["id"]."'");
       	              	foCheck($data["userid"]);
       	              	if($data["id"] == "") errMsg("This status does not exist.");
       	              	changeTitle(stripslashes($data["status"]));
       	              	$el = explode(":",$data["likedBy"]);
       	              	if(isset($_POST["submit"])){
       	              		query("INSERT INTO status_comments(comment,userid,status_id,posted)VALUES('".addslashes($_POST["comment"])."','".$_COOKIE["id"]."','".$_GET["id"]."',CURRENT_TIMESTAMP)");
       	              		toLoc("?act=viewstatus&id=".$_GET["id"]);
       	              	}
       	              	$d = count($el)-1;
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              	<th class="titlebg"><?php echo ubbc("[user=".$data["userid"]."]")."'s status"; ?></th>
       	              	</tr>
       	              	<tr>
       	              	<td class="mainbg">
       	              	<?php 
       	              		echo getDisplay($data["userid"])." ".ubbc($data["status"])." &nbsp; &nbsp; ";
       	              		if(!isMe($data["userid"]) AND online() AND !in_array($_COOKIE["id"],$el)){
       	              			echo " &bull; <div id=\"l".$data["id"]."\"><a href=\"javascript:;\" onclick=\"likeStatus(".$data["id"].");\" name=\"ls\">Like</a></div>";
       	              		}
       	              		echo FormatRes($d,"Like");
       	              		if($d> 0){
       	              		echo ":<div class=\"mainbg2\" style=\"border-radius:25px;border-radius:25px;height:27px;padding:2px;\">";
       	              		$i=1;
       	              		$cH=0;
       	              		while($i < count($el)){
       	              			if($el[$i] == "") continue;
       	              			$cH++;
       	              			echo getDisplay($el[$i]);
       	              			if($cH<$d AND $i != (count($el)-2)){
       	              				echo ", ";
       	              			}
       	              			if($i == (count($el)-2)){
       	              				echo " and ";
       	              			}
       	              			$i++;
       	              		}
       	              		$likes = ($d> 1) ? "like" : "likes";
       	              		echo " ".$likes." this";
       	              		}
       	              		echo "</div>".ubbc("[section=Comments]");
       	              		$getcomments = mysqli_query($con, "SELECT * FROM status_comments WHERE status_id = '".$_GET["id"]."'") OR SQLError();
       	              		echo "<img src=\"buttons/comments.png\" /> (".mysqli_num_rows($getcomments).") &nbsp; &nbsp; 
       	              		<a href=\"javascript:;\" onclick=\"showSection('comment');\"><img src=\"buttons/comment_add.png\" /></a>
       	              		<div id=\"cmnts\">";
       	              		while($c = fetch($getcomments)){
       	              			echo dateFormat($c["posted"])." ".getDisplay($c["userid"])." ".ubbc($c["comment"])."<br />";
       	              		}
       	              		echo "</div>";
       	              	?>
       	              	</td>
       	              	</tr>
       	              	<tr>
       	              	<td class="mainbg2">
       	              	<div id="comment">
       	              	<form action="javascript:statusComment(<?php echo $_GET["id"]; ?>);" method="post">
       	              	<input type="text" size="65" name="comment" id="cmnt" required="1" class="form-control" /> <button type="submit" name="submit" id="s" class="formButton form-control">Post Comment</button>
       	              	</form>
       	              	</div>
       	              	</td>
       	              	</tr>
       	              	</table>
       	              	<?php
       	              	break;
       	              	case 'chat':
       	              	AuthCheck(4);
       	              	changeTitle("Zollernverse Chatroom");
       	              	exec("java ChatServer");
       	              	?>
			<div class="table mainbg2">
			<div class="titlebg">Zollernverse Chatroom</div>
			<applet code="FormTest.class" width="750" height="380">
			<param name="user" value="<?php echo $logged['name']; ?>">
			</applet>
			</div>
			<?php
       	              	break;
       	              	case 'markread':
       	              	onlineCheck();
       	              	if(!(int)$_GET["board"]) invData();
       	              	$gt = mysqli_query($con, "SELECT id,readby FROM topics WHERE boardid = '".$_GET["board"]."' AND reply != 'yes'") OR SQLError();
       	              	while($t = fetch($gt)){
       	              		$readby = explode(":",$t["readby"]);
       	              		$readby[] = $_COOKIE["id"];
       	              		$rb = implode(":",$readby);
       	              		query("UPDATE topics SET readby = '".$rb."' WHERE id = '".$t["id"]."'");
       	              		toLoc("?act=viewtopics&bid=".$_GET["board"]);
       	              	}
       	              	break;
       	              	case 'markallasread':
       	              	onlineCheck();
       	              	$gt = mysqli_query($con, "SELECT id,readby FROM topics WHERE reply != 'yes'") OR SQLError();
       	              	while($t = fetch($gt)){
       	              		$readby = explode(":",$t["readby"]);
       	              		$readby[] = $_COOKIE["id"];
       	              		$rb = implode(":",$readby);
       	              		query("UPDATE topics SET readby = '".$rb."' WHERE id = '".$t["id"]."'");
       	              		toLoc("./");
       	              	}
       	              	break;
       	              	case 'createskin':
       	              	AuthCheck(4);
       	              	changeTitle("Create Skin");
       	              	if(isset($_POST["submit"])){
       	              		$data = '.ach { height:40px;width:40px;float:left;border:1px solid #000000;border-radius:25px; }
body { 
	background-image: url("'.$_POST["Background_Image"].'");
	background-attachment: fixed;
	background-color: '.$_POST["Background_Color"].';
	color: '.$_POST["Default_Forum_Table_Color"].';
 }
.banner { 
	position: relative; 
}
.mainbg { 
	background: '.$_POST["Main_Background_1"].';
	color: '.$_POST["Main_Background_1_Text_Color"].'; 
}
.mainbg2 {
 	background: '.$_POST["Main_Background_2"].';
 	color: '.$_POST["Main_Background_2_Text_Color"].';
  }
.bordercolor: { 
	background: '.$_POST["Border_Color"].';
 }
.titlebg { 
	background: url("'.$_POST["Default_Gradient"].'") repeat; 
	color: '.$_POST["Default Gradient_Font Color"].';
	height: 24px; 
	text-align: center;
	font-weight: bold; 
	}
.catbg { 
	background: url("'.$_POST["Default_Gradient"].'") repeat;
	color: '.$_POST["Default_Gradient_Font_Color"].';
	height: 24px; 
	text-align: center; 
	font-weight: bold;
 }
a { 
	text-decoration: none; 
	color: '.$_POST["Default_Link"].';
}
a:visited {
	text-decoration: none;
	color: '.$_POST["Visited_Link"].';
}
a:hover { 
	text-decoration: none; 
	color: '.$_POST["Hover_Link"].';
}
table {
	 border: 1px solid #000000; 
}
td,th { 
	border: 1px solid '.$_POST["Main_Background_2"].';
}
.code, .quote { background: '.$_POST["Quote_Background"].'; color: '.$_POST["Quote_Color"].'; font-size: 13px; border: 1px solid #000000; padding: 2px; }
.code {  font-family: "Courier New"; font-size: 12px; }
input[type="text"],textarea, input[type="password"], select {  border-radius: 25px; font-size: 14px; border: 1px solid #000000; }
input[type="text"], input[type="password"] { height: 31px; }
img { border: none; }
img[src="admin.gif"] { height: 16px; width: 16px; }
.inside { height:100px; width:300px; overflow:auto; display: none; z-index: 1000; position: absolute; text-align: left !important; }
.report { border-radius: 25px; display: none; }
.achievement { background: '.$_POST["Main_Background_1"].'; color: '.$_POST["Main_Background_1_Text_Color"].'; border-radius: 25px; width: 170px; height: 40px; border: 1px solid #000000; padding: 4px; position: absolute; z-index: 1000; display: none; }
.sc { background: '.$_POST["Main_Background_2"].'; color: '.$_POST["Main_Background_2_Text_Color"].'; display: none; border: 1px solid #000000; padding: 2px; position: absolute; z-index: 1000; border-radius: 25px; }';
				query("INSERT INTO skins(name,data,banner,made_on)VALUES('".addslashes($_POST["Skin_Name"])."','".$data."','".$_POST["Banner_URL"]."',CURRENT_TIMESTAMP)");
				$n = mysqli_insert_id();
       	              		$f = fopen("styles/skinid-".$n.".css","w+");
       	              		fwrite($f,$data);
       	              		loguser($_COOKIE["id"],"created a new skin.");
       	              		forumMsg("Your skin was created successfully.");
       	              		admin();
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              		<th class="titlebg" colspan="2">Create Skin</th>
       	              	</tr>
       	              	<?php
       	              	$values = array("Skin Name","Banner URL","Default Gradient","Default Gradient Font Color","Default Forum Table Color","Background Color","Background Image","Default Link","Visited Link","Active Link","Hover Link","Main Background 1","Main Background 2","Main Background 1 Text Color","Main Background 2 Text Color","Border Color","Quote Background","Quote Color");
        for($i = 0; $i < sizeof($values); $i++){
         echo "<tr>
                <td class=\"mainbg\" width=\"50%\">".$values[$i].":</td>
                <td class=\"mainbg\" width=\"50%\"><input type=\"text\" value=\"".preg_replace("/\s/","_",$_POST[$values[$i]])."\" name=\"".preg_replace("/\s/","_",$values[$i])."\" /></td>
          </tr>";
        }
        ?>
        	<tr>
        		<th class="mainbg2" align="center" colspan="2" id="subCell"><input type="submit" value="Create Skin" name="submit" id="cs" /></th>
        	</tr>
        		</table>
        		</form>
        <?php
       	              	}
       	              	break;
       	              	case 'modifyskin':
       	              	AuthCheck(4);
       	              	changeTitle("Edit Skin");
       	              	$getSkins = mysqli_query($con, "SELECT id,name FROM skins ORDER BY name ASC") OR SQLError();
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor pageContent">
       	              	<tr>
       	              		<th class="titlebg">Choose Skin</th>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg2">
       	              		Please choose which skin you would like to modify:
       	              		<br />
       	              		<select name="skin" id="skin" class="form-control">
       	              			<option value="">--------------------</option>
       	              			<?php
       	              				while($skins = fetch($getSkins)){
       	              					echo "<option value=\"".$skins["id"]."\">".stripslashes($skins["name"])."</option>";
       	              				}
       	              			?>
       	              		</select>
       	              		<br />
							<button type="button" onclick="document.location.href = '?act=editskin&id='+skin.options[skin.selectedIndex].value;" name="continueButton" class="formButton form-control">Continue</button>
       	              		</td>
       	              	</tr>
       	              	</table>
       	              	<script type="text/javascript">
       	              	<!--
       	              	var skin = document.getElementById('skin');
       	              	// -->
       	              	</script>
       	              	<?php
       	              	break;
       	              	case 'editskin':
       	              	AuthCheck(4);
       	              	changeTitle("Edit Layout");
       	              	idCheck();
       	              	$skindata = sql("SELECT id,name,banner FROM skins WHERE id = '".$_GET["id"]."'");
       	              	if(isset($_POST["submit"])){
       	              		query("UPDATE skins SET banner = '".addslashes($_POST["banner"])."', name = '".addslashes($_POST["name"])."' WHERE id = '".$_GET["id"]."'");
       	              		file_put_contents("styles/skinid-".$_GET["id"].".css", $_POST["skin"]);
       	              		loguser($_COOKIE["id"],"modified the [b]".stripslashes($skindata["name"])."[/b] skin.");
       	              		forumMsg("Your [b]".stripslashes($skindata["name"])."[/b] skin has been updated.");
       	              		admin();
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor pageContent">
       	              	<tr>
       	              		<th class="titlebg">Editing Layout</th>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg pageContent">
       	              		The stylesheet and banner for this skin are below. You are currently editing the <strong><?php echo stripslashes($skindata["name"]); ?></strong> skin.
       	              		</td>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg pageContent">
       	              		Name:<br />
       	              		<input type="text" size="35" value="<?php echo stripslashes($skindata["name"]); ?>" name="name" class="form-control" />
       	              		</td>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg pageContent">
       	              		Banner:
       	              		<br />
       	              		<input type="text" size="35" value="<?php echo stripslashes($skindata["banner"]); ?>" name="banner" class="form-control" />
       	              		</td>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg pageContent">
       	              		Stylesheet:
       	              		<br />
       	              			<textarea cols="121" rows="20" name="skin" id="skin" class="form-control">
       	              			<?php
       	              			echo file_get_contents("styles/skinid-".$_GET["id"].".css");
       	              			?>
       	              			</textarea>
       	              		</td>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg2" style="text-align: center;">
								<button type="submit" name="submit" id="submit" class="formButton form-control">Save Changes</button>
       	              		</td>
       	              	</tr>
       	              	</table>
       	              	</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'deleteskin':
       	              	AuthCheck(4);
       	              	changeTitle("Delete Skin");
       	              	$getSkins = mysqli_query($con, "SELECT id,name FROM skins ORDER BY name ASC") OR SQLError();
       	              	if(isset($_POST["submit"])){
       	              		$skindata = sql("SELECT name FROM skins WHERE id = '".$_POST["skin"]."'");
       	              		query("DELETE FROM skins WHERE id = '".$_POST["skin"]."'");
       	              		loguser($_COOKIE["id"],"deleted the [b]".stripslashes($skindata["name"])."[/b] skin.");
       	              		forumMsg("Your [b]".stripslashes($skindata["name"])."[/b] skin has been deleted.");
       	              		admin();
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor pageContent">
       	              	<tr>
       	              		<th class="titlebg">Choose Skin</th>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg2">
       	              		Please choose which skin you would like to delete:
       	              		<br />
       	              		<select name="skin" id="skin" class="form-control">
       	              			<option value="">--------------------</option>
       	              			<?php
       	              				while($skins = fetch($getSkins)){
       	              					echo "<option value=\"".$skins["id"]."\">".stripslashes($skins["name"])."</option>";
       	              				}
       	              			?>
       	              		</select>
       	              		<br />
							<button type="submit" name="submit" id="submitButton" class="formButton form-control">Delete</button>
       	              		</td>
       	              	</tr>
       	              	</table>
       	              	</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'pmcenter':
       	              	onlineCheck();
       	              	changeTitle("My Messages");
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor pageContent">
       	              	<tr><th class="titlebg" colspan="2">Message Center</th></tr>
       	              	<tr><td class="mainbg2" colspan="2"><img src="buttons/folder_go.png" /> <a href="?act=sendpm">New Message</a></td></tr>
       	              	<tr>
       	              		<td class="mainbg pageContent" width="20%">
       	              			<div style="height:310px;width:160px;background:#ffffff;border-radius:25px;">
       	              			<div class="catbg">Nav</div>
       	              			<?php
       	              			$button = ($nm>= 1) ? "document" : "empty";
       	              			?>
       	              			<img src="buttons/inbox_<?php echo $button; ?>.png" /> <a href="javascript:getMessages();" style="color:#0000ff;">Inbox</a> 
       	              			<span style="color: #000000;">
       	              			(<?php echo $nm; ?>)
       	              			</span>
       	              			<br />
       	              			<img src="buttons/folder_go.png" /> <a href="javascript:getSent();" style="color:#0000ff;">Sent</a><br />
       	              			<img src="buttons/folder_heart.png" /> <a href="javascript:getSaved();" style="color:#0000ff;">Saved</a><br />
       	              			<img src="buttons/mail-trash.png" /> <a href="javascript:getTrash();" style="color:#0000ff;">Trash</a>
       	              			</div>
       	              			<a href="?act=pmprefs"><img src="buttons/wrench.png" style="height:16px;width:16px;" /> Preferences</a>
       	              		</td>
       	              		<td class="mainbg2" width="80%" style="vertical-align: top">
       	              			<div style="height:410px;width:695px;background:#ffffff;overflow:auto;border-radius:25px;" id="c">
       	              			<?php
       	              				getMessages();
       	              			?>
       	              			</div>
       	              		</td>
       	              	</tr>
       	              	</table>
       	              	<?php
       	              	break;
       	              	case 'pmprefs':
       	              	onlineCheck();
       	              	if(isset($_POST["submit"])){
       	              		query("UPDATE members SET blocked = '".$_POST["blocked"]."' WHERE id = '".$_COOKIE["id"]."'");
       	              		forumMsg("Your blocked users have been updated.");
       	              	}else{
       	              		$blocked = sql("SELECT blocked FROM members WHERE id = '".$_COOKIE["id"]."'");
       	              		?>
       	              		<form action="" method="post">
       	              		<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              		<tr>
       	              		<th class="titlebg" colspan="2">PM Prefs</th>
       	              		</tr>
       	              		<tr>
       	              		<td class="mainbg" width="50%">
       	              		<textarea cols="50" rows="10" name="blocked" id="bl" class="form-control"><?php echo $blocked["blocked"]; ?></textarea>
       	              		</td>
       	              		<td class="mainbg2" width="50%" style="vertical-align: top" id="bl2">
       	              		These are your blocked users. Separate each <u>username</u> with a comma (,). These users will not be able to message you. Likewise, you will not be able to message them. 
       	              		</td>
       	              		</tr>
       	              		<tr>
       	              		<td class="mainbg" colspan="2"><button type="submit" name="submit" id="s" class="formButton form-control">Save Changes</button></td>
       	              		</tr>
       	              		</table>
       	              		</form>
       	              		<?php
       	              	}
       	              	break;
       	              	case 'colors':
       	              	onlineCheck();
       	              	changeTitle("Name Colorizer");
       	              	if(gamerPoints($_COOKIE["id"]) < 100) errMsg("Whoops. You must have 100 gamer points or higher before you can access this area. Sorry. To get gamer points, unlock more site medals by doing different things around the site.");
       	              	$colors = sql("SELECT colors FROM members WHERE id = '".$_COOKIE["id"]."'");
       	              	$c = explode(":",$colors["colors"]);
       	              	if(isset($_POST["submit"])){
       	              		$str = $_POST["color1"].":".$_POST["color2"];
       	              		useTokens(50);
       	              		query("UPDATE members SET colors = '".$str."' WHERE id = '".$_COOKIE["id"]."'");
       	              		loguser($_COOKIE["id"],"changed their name colors.");
       	              		forumMsg("Your name colors were changed succcessfully.");
       	              	}else{
       	              	?>
       	              	<form action="" method="post" id="cForm" onsubmit="return reConf('Are you sure about changing your name colors? This will cost 50 tokens.');">
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr><th class="titlebg" colspan="2">Name Colorizer</th></tr>
       	              	<tr><td class="mainbg" colspan="2"><a href="javascript:;" onclick="previewColors();">Preview</a>: <div id="pr"></div></td></tr>
       	              	<tr><td class="mainbg2" colspan="2">Please enter the hexadecimal value(s) that you wish to color your name with here (DO <strong>NOT</strong> put in the # sign, a-f and 0-9 only). You can browse <a href="http://www.december.com/html/spec/color.html" onclick="window.open(this.href);return false;">here</a> for the value(s) that you want. If you want one color, only enter one. If you want two colors, enter two <u>different</u> colors. &nbsp; &nbsp; <strong>It will cost 50 tokens each time you change your name colors.</strong></td></tr>
       	              	<tr>
       	              	<td class="mainbg">
       	              	First Color:
       	              	</td>
       	              	<td class="mainbg2">
       	              	<input type="text" name="color1" id="c1" pattern="[a-f0-9]{6}" maxlength="6" value="<?php echo $c["0"]; ?>" class="form-control" />
       	              	</td>
       	              	</tr>
       	              	<tr>
       	              	<td class="mainbg">
       	              	Second Color:
       	              	</td>
       	              	<td class="mainbg2">
       	              	<input type="text" name="color2" id="c2" pattern="[a-f0-9]{6}" maxlength="6" value="<?php echo $c["1"]; ?>" class="form-control" />
       	              	</td>
       	              	</tr>
       	              	<tr>
       	              	<td class="mainbg2" align="center" id="clr" colspan="2"><button type="submit" name="submit" id="clrz" class="formButton form-control">Save Changes</button></td>
       	              	</tr>
       	              	</table>
       	              	</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'deleteaccount':
       	              	onlineCheck();
       	              	changeTitle("Deleting Account..");
       	              	idCheck();
       	              	if((int)$_GET["id"] == 1){
       	              		 loguser($_COOKIE["id"],"attempted to delete the admin's account.");
							 notifyAdmins($_COOKIE["id"]." attempted to delete the admin's account.");
       	              		 errMsg("You cannot delete the admin's account - a note of this has been made in the logs.");
       	              	}
       	              	loguser($_GET["id"],"has deleted their account.");
       	              	notifyUser(1,"[user=".$_GET["id"]."] has deleted their account.");
       	              	notifyUser(2,"[user=".$_GET["id"]."] has deleted their account.");
       	              	query("DELETE FROM members WHERE id = '".$_GET["id"]."'");
       	              	setcookie("id","",(time()-300));
       	              	forumMsg("The account has been permanently deleted.");
       	              	header("Refresh:2;./");
       	              	break;
       	              	case 'displayhistory':
       	              	onlineCheck();
       	              	changeTitle("Name History");
       	              	if(!(int)$_GET["user"]) invData();
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              		<th class="titlebg">Display Names</th>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg2">This is the list of every display name that this user has ever had. Every time they change it, it will be added to this list.</td>
       	              	</tr>
       	              	<?php
       	              		$getnames = mysqli_query($con, "SELECT * FROM display_history WHERE userid = '".$_GET["user"]."'") OR SQLError();
       	              		while($n = fetch($getnames)){
       	              			echo "<tr>
       	              				<td class=\"mainbg\">".$n["name"]."</td>
       	              			</tr>";
       	              		}
       	              	?>
       	              	</table>
       	              	<?php
       	              	break;
       	              	case 'flaguser':
       	              	AuthCheck(3);
       	              	changeTitle("Flag User");
       	              	idCheck();
       	              	$getFlag = sql("SELECT flagged FROM members WHERE id = '".$_GET["id"]."'");
       	              	$flag = ($getFlag["flagged"]) ? 0 : 1;
       	              	query("UPDATE members SET flagged = ".$flag." WHERE id = '".$_GET["id"]."'");
       	              	forumMsg("This user has been successfully flagged; thank you.");
       	              	loguser($_COOKIE["id"],"has flagged [user=".$_GET["id"]."].");
       	              	notifyUser($_GET["id"],"You have been flagged by [user=".$_COOKIE["id"]."].");
       	              	break;
       	              	case 'karma':
       	              	onlineCheck();
       	              	if(!(int)$_GET["user"]) invData();
       	              	$vote = ($_GET["vote"] == 1) ? 1 : -1;
       	              	$vup = ($vote == 1) ? "up" : "down";
       	              	$lastKarma = sql("SELECT id FROM members WHERE id = '".$_COOKIE["id"]."' AND UNIX_TIMESTAMP(last_karma)>= '".(time()-3600)."'");
       	              	if($lastKarma["id"] != "") errMsg("You may only do this every hour.");
       	              	$karma = sql("SELECT karma FROM karma WHERE userid = '".$_GET["user"]."'");
       	              	$newKarma = ($karma["karma"]+$vote);
       	              	query("UPDATE karma SET karma = '".$newKarma."' WHERE userid = '".$_GET["user"]."'");
       	              	query("UPDATE members SET last_karma = NOW() WHERE id = '".$_COOKIE["id"]."'");
       	              	loguser($_COOKIE["id"],"voted [user=".$_GET["user"]."]'s reputation ".$vup.".");
       	              	toLoc("?act=profile&u=".$_GET["user"]);
       	              	break;
       	              	case 'topposters':
       	              	onlineCheck();
       	              	changeTitle("Top Posters");
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr><th class="titlebg" colspan="2">Top Posters</th></tr>
       	              	<tr><td class="mainbg" colspan="2">These are the ten top posters of the site. We love them very much.</td></tr>
       	              	<tr>
       	              		<th class="catbg">User</th>
       	              		<th class="catbg">Posts</th>
       	              	</tr>
       	              	<?php
       	              	$topTen = array();
       	              	$memberID = array();
       	              	$i=0;
       	              	$getMembers = mysqli_query($con, "SELECT id FROM members ORDER BY id ASC");
       	              	while($m = fetch($getMembers)){
       	              		$topTen[$i] = postCount($m["id"]);
       	              		$memberID[$i] = $m["id"];
       	              		$i++;
       	              	}
       	              	$pCount = 0;
       	              	$topDog = max($topTen);
       	              	$dogKey = array_search($topDog,$topTen);
       	              	query("UPDATE members SET top_poster = '1' WHERE id = '".$memberID[$dogKey]."'");
       	              	while($pCount < 10){
       	              		$topPosts = max($topTen);
       	              		$arrKey = array_search($topPosts,$topTen);
       	              		echo "<tr><td class=\"mainbg\">".getDisplay($memberID[$arrKey])."</td><td class=\"mainbg2\">".$topPosts."</td></tr>";
       	              		query("UPDATE members SET top_ten = '1' WHERE id = '".$memberID[$arrKey]."'");
       	              		unset($topTen[$arrKey]);
       	              		unset($memberID[$arrKey]);
       	              		$pCount++;
       	              	}
       	              	?>
       	              	</table>
       	              	<?php
       	              	break;
       	              	case 'updatecomments':
       	              	changeTitle("Update Comments");
       	              	idCheck();
       	              	if(isset($_POST["submit"])){
       	              		if($_POST["comment"] != ""){
       	              			query("INSERT INTO update_comments(userid,update_id,comment,posted)VALUES('".$_COOKIE["id"]."','".$_GET["id"]."','".addslashes($_POST["comment"])."',CURRENT_TIMESTAMP)");
       	              			loguser($_COOKIE["id"],"posted a comment on an update.");
       	              			notifyUser(1,"[user=".$_COOKIE["id"]."] posted a comment on an update.");
       	              			toLoc("?act=updatecomments&id=".$_GET["id"]);
       	              		}
       	              	}
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr><th class="titlebg">Comments</th></tr>
       	              	<tr><td class="mainbg2">You are more than welcomed to post a comment on this update, but keep it civilized and follow the rules. Don't make an idiot out of yourself or anyone else.</td></tr>
       	              	<?php
       	              	$getComments = mysqli_query($con, "SELECT * FROM update_comments WHERE update_id = '".$_GET["id"]."'") OR SQLError();
       	              	while($c = fetch($getComments)){
       	              		echo "<tr><td class=\"mainbg\">".getDisplay($c["userid"])." [".dateFormat($c["posted"])."]: &nbsp; &nbsp; ".ubbc($c["comment"])."</td></tr>";
       	              	}
       	              	if(online()){
       	              	?>
       	              	<tr>
       	              		<td class="mainbg2">
       	              		<strong>Comment Below:</strong>
       	              		<br />
       	              		<form action="" method="post">
       	              		<textarea cols="40" rows="5" required="1" name="comment" id="cmnt" class="form-control"></textarea>
       	              		<br />
							<button type="submit" name="submit" id="pc" class="formButton form-control">Post</button>
       	              		</form>
       	              		</td>
       	              	</tr>
       	              	<?php
       	              	}
       	              	?>
       	              	</table>
       	              	<?php
       	              	break;
       	              	case 'bookmarks':
       	              	onlineCheck();
       	              	changeTitle("My Bookmarks");
       	              	$bookmarks = explode(":",$logged["bookmarks"]);
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              		<th class="titlebg" colspan="2">My Bookmarks</th>
       	              	</tr>
       	              	<tr>
       	              		<th class="catbg">Topic</th>
       	              		<th class="catbg">User</th>
       	              	</tr>
       	              		<?php
       	              		$i = 0;
       	              		foreach($bookmarks AS $topicID){
       	              			$i++;
       	              			if($topicID == "") continue;
       	              			$tdata = sql("SELECT subject,userid FROM topics WHERE id = '".$topicID."'");
       	              			echo "<tr>
       	              				<td class=\"mainbg\" width=\"50%\"><div id=\"book".$i."\"><a href=\"javascript:;\" onclick=\"removeBookmark(".$i.",".$topicID.");\"><img src=\"buttons/book_delete.png\" style=\"height:20px;width:20px;\" /> Delete &nbsp; &nbsp; </a><a href=\"?act=topic&id=".$topicID."\">".stripslashes($tdata["subject"])."</a></div></td>
       	              				<td class=\"mainbg2\" width=\"50%\">".getDisplay($tdata["userid"])."</td>
       	              			</tr>";
       	              		}
       	              		?>
       	              	</table>
       	              	<?php
       	              	break;
       	              	case 'movetopic':
       	              	AuthCheck(3);
       	              	changeTitle("Moving Topic");
       	              	idCheck();
       	              	$tdata = sql("SELECT boardid,userid FROM topics WHERE id = '".$_GET["id"]."'");
       	              	if(isset($_POST["submit"])){
       	              		query("UPDATE topics SET boardid = '".$_POST["board"]."' WHERE topic_id = '".$_GET["id"]."'");
       	              		forumMsg("Topic was successfully moved.");
       	              		loguser($_COOKIE["id"],"has moved a topic.");
       	              		notifyUser($tdata["userid"],"[user=".$_COOKIE["id"]."] has moved your [url=?act=topic&id=".$_GET["id"]."]topic[/url].");
       	              		header("Refresh:2;?act=topic&id=".$_GET["id"]);
       	              	}else{
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              	<th class="titlebg">Moving Topic</th>
       	              	</tr>
       	              	<tr>
       	              	<td class="mainbg">
       	              	Please select the board you wish to move this topic to:
       	              	<br />
       	              	<form action="" method="post">
       	              	<select name="board" class="form-control">
       	              	<?php
       	              	$getBoards = mysqli_query($con, "SELECT id,name FROM boards ORDER BY name ASC") OR SQLError();
       	              	while($b = fetch($getBoards)){
       	              		if($tdata["boardid"] == $b["id"]) continue;
       	              		echo "<option value=\"".$b["id"]."\">".$b["name"]."</option>";
       	              	}
       	              	?>
       	              	</select>
						<button type="submit" name="submit" id="go" class="formButton form-control">Go</button>
       	              	</form>
       	              	</td>
       	              	</tr>
       	              	</table>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'search':
       	              	if(!$_GET["filter"]){
       	              		/* if(!checkPerms(4))
       	              			errMsg("Under Construction"); */
       	              		if(isset($_POST["submit"])){
       	              		}else{
       	              			?>
       	              			<form action="javascript:simpleSearch();" method="post">
       	              			<table class="table bordercolor" cellspacing="1" cellpadding="4" id="searchTable">
       	              				<tr>
       	              					<th class="titlebg">Topic Search</th>
       	              				</tr>
       	              				<tr>
       	              					<td class="mainbg2 pageContent">
       	              					Type something in the search box below and either press <strong>Enter</strong> or click on the <strong>Go</strong> button.
       	              					<div style="padding: 4px;">
       	              						<img src="buttons/magnifier.png" /> <input type="text" maxlength="50" size="35" name="filter" id="filter" />
       	              						<input type="submit" value="Go" name="submit" id="go" />
       	              					</div> 
       	              					</td>
       	              				</tr>
       	              			</table>
       	              			</form>
       	              			<?php 
       	              		}
       	              	}else{
       	              	changeTitle("Searching: ".$_GET["filter"]);
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              	<th class="titlebg">Search Results</th>
       	              	</tr>
       	              	<?php
       	              	(int) $page = ((int)$_GET["page"] == 0 OR $_GET["page"] == "") ? 0 : ($_GET["page"]-1);
       	              	$which = ceil($page*10);
       	              	$getTopics = mysqli_query($con, "SELECT * FROM topics WHERE tags LIKE '%".$_GET["filter"]."%' LIMIT ".$which.",10") OR SQLError();
       	              	$totalTopics = numRows("SELECT id FROM topics WHERE tags LIKE '%".$_GET["filter"]."%'");
       	              	$totalPages = ceil($totalTopics/10);
       	              	echo "<tr>
       	              	       <td class=\"mainbg2\">
       	              		      <a href=\"?act=search\">Search again..</a>";
       	              	if($totalTopics > 10){
       	              		echo "<select name=\"page\" onchange=\"toLoc('?act=search&filter=".$_GET["filter"]."&page='+this.options[this.selectedIndex].value);\" class=\"form-control\">
       	              		      <option value=\"\">-- Pages --</option>";
       	              		      $i = 1;
       	              		      while($i <= $totalPages){
       	              		      	    echo "<option value=\"".$i."\"";
       	              		      	    if($i == $_GET["page"])
       	              		      	    	echo " selected=\"1\"";
       	              		      	    echo ">Page ".$i."</option>";
       	              		      	    $i++;
       	              		      }
       	              		      echo "</select>";
       	              	}
       	              	echo "</td></tr>";
       	              	while($topics = fetch($getTopics)){
       	              		echo "<tr><td class=\"mainbg\"><a href=\"?act=topic&id=".$topics["id"]."\">".stripslashes($topics["subject"])."</a> by ".getDisplay($topics["userid"])." &nbsp; &nbsp; ".dateFormat($topics["posted"]);
       	              		if($topics["tags"] != ""){
       	              			echo "<br />";
       	              			$tags = explode(",",$topics["tags"]);
       	              			foreach($tags AS $t){
       	              				if($t == "") continue;
       	              				$t2 = str_replace(" ","",$t);
       	              				$nr = numRows("SELECT id FROM topics WHERE tags LIKE '%".$t2."%'");
       	              				echo "<a href=\"?act=search&filter=".$t2."\"><img src=\"buttons/tag_blue.png\" style=\"height:20px;width:20px;\" />".$t2."</a> (".$nr.") 
       	              				&nbsp; &nbsp; ";
       	              			}
       	              		}
       	              		echo "</td></tr>";
       	              	}
       	              	loguser($_COOKIE["id"],"searched topics with the ".$_GET["filter"]." filter.");
       	              	?>
       	              	</table>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'emailall':
       	              	AuthCheck(4);
       	              	changeTitle("E-Mail All");
       	              	if(isset($_POST["submit"])){
       	              		$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: noreply@zollernverse.org";
				$getMembers = mysqli_query($con, "SELECT * FROM members WHERE e_opt = 1 AND email != \"\" ORDER BY name ASC") OR SQLError();
				while($m = fetch($getMembers)){
					$message = $_POST["message"];
					$message .= "[hr]
					You are receiving this message because you are a member of Zollernverse:
					
					[url=http://www.zollernverse.org/]http://www.zollernverse.org/[/url]
					
					Your username at this site is [b]".$m["name"]."[/b].
					
					To opt out of e-mails, simply log in to your profile and change the \"accept emails\" field to \"opt out.\"
					
					See you around, hopefully!
					
					-- Zollernverse";
					mail($m["email"],$_POST["subject"],ubbc($message),$headers);
				}
				forumMsg("Your e-mail will be sent out to your members that have opted in for mass emails. Please note, that with a large user base, the emails will take a while. So only use this if you have a good email to send.");
				admin();
				loguser($_COOKIE["id"],"sent out a mass email.");
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              	<th class="titlebg">Mass Email</th>
       	              	</tr>
       	              	<tr>
       	              	<td class="mainbg2">
       	              	<strong>Subject:</strong>
       	              	<br />
       	              	<input type="text" name="subject" class="form-control" />
       	              	<br />
       	              	<strong>Message:</strong>
       	              	<br />
       	              	<textarea cols="80" rows="20" name="message" id="m" class="form-control"></textarea>
       	              	<br />
						<button type="submit" name="submit" id="send" class="formButton form-control">Send</button>
       	              	</td>
       	              	</tr>
       	              	</table>
       	              	</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'resetpass':
       	              	if(online()) errMsg("You are already logged in. To reset your password, please modify your profile.");
       	              	if(!$_GET["token"]) errMsg("You have accessed this page illegally.");
       	              	$checkToken = sql("SELECT id FROM members WHERE tempcode = '".sqlEsc($_GET["token"])."'");
       	              	if($checkToken["id"] == "" OR $checkToken["id"] == 0)
       	              		errMsg("This is an invalid tempcode.");
       	              	changeTitle("Reset Password");
       	              	if(isset($_POST["submit"])){
       	              		if($_POST["newpass"] != $_POST["newpass2"])
       	              			errMsg("Passwords do not match - try again.");
       	              		if($_POST["newpass"] == "" OR $_POST["newpass2"] == "")
       	              			errMsg("One or more of the password fields were blank.");
       	              		query("UPDATE members SET pass = '".md5($_POST["newpass"])."', tempcode = '' WHERE id = '".$checkToken["id"]."'");
       	              	echo '<table class="table bordercolor" cellspacing="1" cellpadding="4" id="resetPass">
       	              	<tr>
       	              		<th class=\"titlebg\">Success!</th>
       	              	</tr>
       	              	<tr>
       	              		<td class=\"mainbg2 pageContent=\">
       	              			Your password was successfully changed!
       	              		</td>
       	              	</tr>
       	              	</table>';
       	              	loguser($checkToken["id"],"has reset their password.");
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              	<table class="table bordercolor" cellspacing="1" cellpadding="4" id="resetPass">
       	              	<tr>
       	              		<th class="titlebg" colspan="2">Reset Password</th>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg2 pageContent">
       	              		New Password:
       	              		</td>
       	              		<td class="mainbg2 pageContent">
       	              			<input type="password" name="newpass" class="form-control" />
       	              		</td>
       	              		</tr>
       	              		<tr>
       	              		<td class="mainbg2 pageContent">
       	              		Confirm It (retype password):
       	              		</td>
       	              		<td class="mainbg2 pageContent">
       	              			<input type="password" name="newpass2" class="form-control" />
       	              		</td>
       	              	</tr>
       	              	<tr>
       	              		<td class="mainbg" align="center" colspan="2" id="submitIt">
								<button type="submit" name="submit" id="save" class="formButton form-control">Save Changes</button>
       	              		</td>
       	              	</tr>
       	              	</table>
       	              	</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'forgotpass':
       	              	if(online()) errMsg("What are you doing? You're online, why bother using the forgot password link?");
       	              	changeTitle("Forgot Password");
       	              	if(isset($_POST["submit"])){
       	              		$check = sql("SELECT id,name,email FROM members WHERE name = '".sqlEsc($_POST["user"])."' OR email = '".sqlEsc($_POST["em"])."'");
       	              		$check2 = sql("SELECT id FROM s_questions WHERE userid = '".$check["id"]."'");
       	              		if($check2["id"] != ""){
       	              		$token = md5(createToken());
       	              		query("UPDATE members SET tempcode = '".$token."' WHERE id = ".$check["id"]);
       	              		$message = "Hello there! Sorry to bother you, but the IP address of <strong>".$_SERVER["REMOTE_ADDR"]."</strong> requested that a password reset e-mail be sent for your account. If this was not you, please e-mail <a href=\"mailto:admin@zollernverse.org\">admin@zollernverse.org</a> to inform him of this mistake. If this <em>was</em> you, however, then please click the below link to reset your password:
       	              			
<a href=\"http://www.zollernverse.org/forum.php?act=resetpass&token=".$token."\">http://www.zollernverse.org/forum.php?act=resetpass&token=".$token."</a>

If the above link doesn't work, copy and paste it into your address bar. See ya 'round sometime, hope this helps!

-- Zollernverse";
       	              		}else{
       	              			errMsg("We're sorry, but this account does not have a security question set and therefore cannot request a password reset. Please send an e-mail to <a href='mailto:admin@zollernverse.org'>admin@zollernverse.org</a> for assistance.");
       	              		}
				if($check["name"] != ""){
       	              			ini_set("sendmail_from","noreply@zollernverse.org");
       	              			$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= "From: noreply@zollernverse.org";
       	              			mail($check["email"],"Reset Password",nl2br($message),$headers);
       	              			forumMsg("Your information has been sent to the e-mail associated with this account. Please be aware that sometimes our e-mails take a minute, and that you might want to check your spam/bulk folder, in case it winds up there.");
       	              		}else{
       	              			errMsg("Err, sorry, but we couldn't find you in our database. Awkward.");
       	              		}
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              	<div class="table bordercolor">
       	              	<div class="row titlebg">Password Retriever</div>
       	              	<div class="mainbg2">
       	              		Need to reset your password? No problem! Just enter your username in the field below. We'll then send your information to the e-mail address that is associated with the account.
       	              		<br />
       	              		<input type="text" name="user" class="form-control" />
       	              		<br />
       	              		Alternatively, you can enter your e-mail address and we will send your information to that account, provided that you have a username here.
       	              		<br />
       	              		<input type="text" name="em" class="form-control" />
       	              	</div>
       	              	<div class="mainbg" style="text-align: center;">
						<button type="submit" name="submit" id="fp" class="formButton form-control">Go</button>
       	              	</div>
       	              	</div>
       	              	</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'securequestion':
       	              	onlineCheck();
       	              	changeTitle("Security Question");
       	              	$sqCheck = sql("SELECT * FROM s_questions WHERE userid = '".$_COOKIE["id"]."'");
       	              	if(isset($_POST["submit"])){
       	              		if($sqCheck["id"] == ""){
       	              			query("INSERT INTO s_questions(userid,question,answer)VALUES('".$_COOKIE["id"]."','".addslashes($_POST["question"])."','".addslashes($_POST["answer"])."')");
       	              		}else{
       	              			query("UPDATE s_questions SET question = '".addslashes($_POST["question"])."', answer = '".addslashes($_POST["answer"])."' WHERE userid = '".$_COOKIE["id"]."'");
       	              		}
       	              		forumMsg("Your security question has been successfully updated.");
       	              		loguser($_COOKIE["id"],"updated their security question information.");
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              	<div class="table mainbg2">
       	              	<div class="titlebg">Security Question</div>
       	              	Your security question information is below. To setup a question for your account, simply type one into the form below. Security questions are used for password changes. While having a question is not required, it is <strong>highly</strong> recommended. It is, however, necessary to have a security question set before changing your password, or requesting to reset it (if you should lose it).
       	              	<br /><br />
       	              	<?php
       	              	if($sqCheck["id"] == ""){
       	              		echo "<img src=\"buttons/information.png\" style=\"height:16px;width:16px;\" /> Uh-Oh! Looks like you don't have a security question, you should fix that.";
       	              	}else{
       	              		echo "<img src=\"buttons/accept.png\" style=\"height:16px;width:16px;\" /> Good! You have a security question ready, you're in safe hands now.";
       	              	}
       	              	?>
       	              	<div class="mainbg">
       	              	Question: <br /> <input type="text" size="60" value="<?php echo stripslashes($sqCheck["question"]); ?>" required="1" list="suggestions" name="question" id="q" class="form-control" />
       	              	<datalist id="suggestions">
       	              	<?php
       	              	$suggest = array("What's your mother's maiden name?","What was the name of your first pet?","What's your favorite color?","What was your high school football team called?","What was your major in college?","What's your full name?","What's your spouse's middle name?");
       	              	foreach($suggest as $s){
       	              	?>
       	              		<option value="<?php echo $s; ?>"><?php echo $s; ?></option>"
       	              	<?php
       	              	}
       	              	?>
       	              	</datalist>
       	              	<br />
       	              	<div style="font-size:13px;">Doube-click the field or start typing in it to be offered suggestions.</div>
       	              	<br /><br />
       	              	Answer: <br /> <input type="text" size="60" value="<?php echo stripslashes($sqCheck["answer"]); ?>" required="1" name="answer" id="a"  class="form-control" />
       	              	</div>
       	              	<div class="mainbg2" style="text-align: center;">
						<button type="submit" name="submit" id="save" class="formButton form-control">Save Changes</button>
       	              	</div>
       	              	</div>
       	              	</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'dreamerchao':
       	              	onlineCheck();
       	              	changeTitle("Dreamer Chao");
       	              	?>
       	              	<div class="table mainbg2">
       	              	<div class="titlebg">Game Launcher</div>
       	              	<a href="classes/DreamerChao.jnlp" onclick="window.open(this.href);return false;">Launch</a>
       	              	</div>
       	              	<?php
       	              	break;
       	              	case 'pending':
       	              	AuthCheck(4);
       	              	changeTitle("Pending Accounts");
       	              	?>
       	              	<form action="" method="post">
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr>
       	              	<th class="titlebg">Pending Members</th>
       	              	</tr>
       	              	<tr>
       	              	<td class="mainbg2">These are the members that have signed up during limited registration. Before they can log in and access their accounts, they must first be approved. To do so, check the boxes next to the usernames of the members you wish to approve. If you do not wish to approve an account, then ignore it for now. There will soon be a way to delete the accounts that you do not wish to keep here.<br /></td>
       	              	</tr>
       	              	<?php
       	              	if(isset($_POST["submit"])){
       	              		$numPost = count($_POST);
       	              		foreach($_POST as $key => $data){
       	              			if($key == 'submit') continue;
       	              			$key = str_replace("id","",$key);
       	              			query("UPDATE members SET approved = 1 WHERE id = '".$key."'");
       	              			loguser('3',"[user=".$key."] has had their account approved.");
       	              			notifyUser($key,"Your account has been approved.");
       	              			toLoc("?act=pending");
       	              		}
       	              	}
       	              	$getMembers = mysqli_query($con, "SELECT * FROM members WHERE approved = 0 ORDER BY name ASC") OR SQLError();
       	              	while($m = fetch($getMembers)){
       	              		echo "<tr>
       	              			<td class=\"mainbg\"><input type=\"checkbox\" name=\"id".$m["id"]."\" class=\"form-control\" /> ".getDisplay($m["id"])."</td>
       	              		</tr>";
       	              	}
       	              	?>
       	              	<tr>
       	              	<td class="mainbg2" align="center"><button type="submit" name="submit" id="save" class="formButton form-control">Save Changes</button></td>
       	              	</tr>
       	              	</table>
       	              	</form>
       	              	<?php
       	              	break;
       	              	case 'affiliatecenter':
       	              	AuthCheck(4);
       	              	changeTitle("Affiliate Center");
       	              	$getaf = mysqli_query($con, "SELECT * FROM affiliates") OR SQLError();
       	              	?>
       	              	<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              	<tr><th class="titlebg">Affiliation CP</th></tr>
       	              	<tr><td class="mainbg2">These are the affiliates of Zollernverse. To edit one, simply click on the title.
       	              	<br /><br />
       	              	<a href="?act=addaffiliate"><img src="buttons/bullet_add.png" /> Add</a></td></tr>
       	              	<?php
       	              	while($af = fetch($getaf)){
       	              		echo "<tr><td class=\"mainbg\"><a href=\"?act=deleteaffiliate&id=".$af["id"]."\" onclick=\"return reConf('Are you sure you wish to delete this entry?');\"><img src=\"buttons/cancel.png\" /> &nbsp; <a href=\"?act=editaffiliate&id=".$af["id"]."\"><img src=\"".$af["banner"]."\" /> &nbsp; ".stripslashes($af["name"])."</a><br />&nbsp;".stripslashes($af["description"])."<br /> &nbsp; &nbsp; <strong>HITS</strong> [In: ".$af["hits_in"]."  | Out: ".$af["hits_out"]."]</td></tr>";
       	              	}
       	              	?>
       	              	<tr><th class="catbg">&nbsp;</th></tr>
       	              	</table>
       	              	<?php
       	              	break;
       	              	case 'addaffiliate':
       	              	AuthCheck(4);
       	              	changeTitle("Add Affiliate");
       	              	if(isset($_POST["submit"])){
       	              		query("INSERT INTO affiliates(name,banner,url,description)VALUES('".addslashes($_POST["name"])."','".$_POST["banner"]."','".$_POST["url"]."','".addslashes($_POST["description"])."')");
       	              		loguser($_COOKIE["id"],"added an affiliate to the center.");
       	              		toLoc("?act=affiliatecenter");
       	              	}else{
       	              	?>
       	              	<form action="" method="post">
       	              		<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              		<tr><th class="titlebg">Add Affiliate</th></tr>
       	              		<tr>
       	              		<td class="mainbg2">
       	              		Name:<br />
       	              		<input type="text" size="45" name="name" class="form-control" />
       	              		<br />
       	              		Banner URL:
       	              		<br />
       	              		<input type="text" size="45" name="banner" class="form-control" />
       	              		<br />
       	              		Site URL:
       	              		<br />
       	              		<input type="text" size="45" name="url" class="form-control" />
       	              		<br />
       	              		Description:
       	              		<br />
       	              		<textarea cols="40" rows="10" name="description" id="d" class="form-control"></textarea>
       	              		<br />
       	              		</td>
       	              		</tr>
       	              		<tr>
       	              		<td class="mainbg" style="text-align: center;"><button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button></td>
       	              		</tr>
       	              		<tr>
       	              		<th class="catbg">&nbsp;</th>
       	              		</tr>
       	              		</table>
       	              		</form>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'editaffiliate':
       	              	AuthCheck(4);
       	              	changeTitle("Editing Affiliate");
       	              	idCheck();
       	              	$af = sql("SELECT * FROM affiliates WHERE id = '".$_GET["id"]."'");
       	              	if(isset($_POST["submit"])){
       	              		query("UPDATE affiliates SET name = '".addslashes($_POST["name"])."', banner = '".$_POST["banner"]."', url = '".$_POST["url"]."', description = '".addslashes($_POST["description"])."' WHERE id = '".$_GET["id"]."'");
       	              		loguser($_COOKIE["id"],"edited an entry in the affiliate center.");
       	              		toLoc("?act=affiliatecenter");
       	              	}else{
       	              		?>
       	              		<form action="" method="post">
       	              		<table cellspacing="1" cellpadding="4" class="table bordercolor">
       	              		<tr><th class="titlebg">Edit Affiliate</th></tr>
       	              		<tr>
       	              		<td class="mainbg2">
       	              		Name:<br />
       	              		<input type="text" value="<?php echo stripslashes($af["name"]); ?>" size="45" name="name" class="form-control" />
       	              		<br />
       	              		Banner URL:
       	              		<br />
       	              		<input type="text" value="<?php echo $af["banner"]; ?>" size="45" name="banner" class="form-control" />
       	              		<br />
       	              		Site URL:
       	              		<br />
       	              		<input type="text" value="<?php echo $af["url"]; ?>" size="45" name="url" class="form-control" />
       	              		<br />
       	              		Description:
       	              		<br />
       	              		<textarea cols="40" rows="10" name="description" id="d" class="form-control"><?php echo stripslashes($af["description"]); ?></textarea>
       	              		<br />
       	              		</td>
       	              		</tr>
       	              		<tr>
       	              		<td class="mainbg" style="text-align: center;"><input type="submit" value="Save Changes" name="submit" id="sc" class="form-control" /></td>
       	              		</tr>
       	              		<tr>
       	              		<th class="catbg">&nbsp;</th>
       	              		</tr>
       	              		</table>
       	              		</form>
       	              		<?php
       	              	}
       	              	break;
       	              	case 'deleteaffiliate':
       	              	AuthCheck(4);
       	              	idCheck();
       	              	query("DELETE FROM affiliates WHERE id = '".$_GET["id"]."'");
       	              	loguser($_COOKIE["id"],"deleted an entry from the affiliate center.");
       	              	toLoc("?act=affiliatecenter");
       	              	break;
       	              	case 'site':
       	              	idCheck();
       	              	$data = sql("SELECT * FROM affiliates WHERE id = '".$_GET["id"]."'");
       	              	switch($_GET["mode"]){
       	              		case 'out':
       	              			$n = $data["hits_out"]+1;
       	              			query("UPDATE affiliates SET hits_out = '".$n."' WHERE id = '".$_GET["id"]."'");
       	              			toLoc($data["url"]);
       	              		break;
       	              		case 'in':
       	              			$n = $data["hits_in"]+1;
       	              			query("UPDATE affiliates SET hits_in = '".$n."' WHERE id = '".$_GET["id"]."'");
       	              			toLoc("./");
       	              		break;
       	              	}
       	              	break;
       	              	case 'tokenban':
       	              	AuthCheck(3);
       	              	idCheck();
       	              	$userdata = sql("SELECT token_banned FROM members WHERE id = '".$_GET["id"]."'");
       	              	$b = ($userdata["token_banned"]) ? 0 : 1;
       	              	if($b){
       	              		sendPM($_GET["id"],'3',"Token Banned","Hello, [user=".$_GET["id"]."]. It is my displeasure to inform you that a member of the staff has token-banned you. This means that you can still post and interact, but you will not receive tokens for it. This is usually done to prevent spamming, though there are other uses as well. Consider this as being let off easy. Have a nice day..");
       	              	}else{
       	              		sendPM($_GET["id"],'3',"Your token ban is cleared","Hello, [user=".$_GET["id"]."]. It is my pleasure to inform you that a member of the staff has lifted your token ban. This means that you can still post and interact, but now you will receive tokens for it. This is usually because of good behavior. Consider this a very good thing. Have a nice day..");
       	              	}
       	              	query("UPDATE members SET token_banned = '".$b."' WHERE id = '".$_GET["id"]."'");
       	              	loguser($_COOKIE["id"],"updated the token ban for [user=".$_GET["id"]."].");
       	              	notifyUser($_GET["id"],"You have been token banned by [user=".$_COOKIE["id"]."].");
       	              	toLoc("?act=profile&u=".$_GET["id"]);
       	              	break;
       	              	case 'rgname':
       	              	onlineCheck();
       	              	changeTitle("Register Name");
       	              	if(gamerPoints($_COOKIE["id"]) < 400) errMsg("Sorry, ".getDisplay($_COOKIE["id"]).", but you need to have at least 400 gamer points first. :(");
       	              	if(isset($_POST["submit"])){
       	              	}else{
       	              		?>
       	              		<div class="table mainbg">
       	              		<div class="titlebg">Register Name</div>
       	              		<div class="mainbg2">Here, you can register your display name. Registering your display name means no one else can use that name but you, even when you're not using it. This will cost <strong>500</strong> tokens. If you are SURE about the display name you have, then click the registration link below.
       	              		<div style="text-align:center;" id="lwait">
       	              		<?php
       	              		$rgCheck = sql("SELECT id FROM rg_names WHERE name = '".$logged["display"]."'");
       	              		if($rgCheck["id"] == ""){
       	              		?>
       	              		&raquo; <a href="javascript:;" onclick="loadIcon(this.parentNode.id);rgName(<?php echo $_COOKIE["id"]; ?>);">Register My Display Name</a> &laquo;
       	              		<?php
       	              		}else{
       	              			echo $logged["display"]." registered.";
       	              		}
       	              		?>
       	              		</div>
       	              		</div>
       	              		</div>
       	              		<?php
       	              	}
       	              	break;
       	              	case 'activate':
       	              	if(online() AND !checkPerms(4)) unauthorized();
       	              	if(!(int)$_GET["id"] OR !$_GET["code"]) invData();
       	              	$act_code = sqlEsc($_GET["code"]);
       	              	$checkAct = sql("SELECT act_code,activated FROM members WHERE id = '".$_GET["id"]."'");
       	              	if($act_code != $checkAct["act_code"]) errMsg("This activation code is incorrect. Please send an email to <a href=\"mailto:support@zollernverse.org\">support@zollernverse.org</a>.");
       	              	query("UPDATE members SET activated = 1 WHERE id = '".$_GET["id"]."'");
       	              	forumMsg("Thank you! Your account is now activated and you may now proceed to log in.");
       	              	header("Refresh:2;?act=login");
       	              	break;
       	              	case 'resendact':
       	              	onlineCheck();
       	              	changeTitle("Resend Activation");
       	              	idCheck();
       	              	if(isMe((int)$_GET["id"]) OR checkPerms(4)){
       	              		$activ = sql("SELECT activated,email FROM members WHERE id = '".$_GET["id"]."'");
       	              		if($activ["activated"]) errMsg("This account is already activated.");
       	              		activEmail($activ["email"]);
       	              		loguser($_GET["id"],"requested that a new activation code be sent to their email.");
       	              		forumMsg("A new activation code has been sent to your email.");
       	              	}else{
       	              		unauthorized();
       	              	}
       	              	break;
       	              	case 'checkout':
       	              	if(!$_GET["mode"]) invData();
       	              	switch($_GET["mode"]){
       	              		case 'finished':
       	              			if(isset($_POST["submit"])){
       	              				query("INSERT INTO checkout_messages(ip,userid,mode,message)VALUES('".$_SERVER["REMOTE_ADDR"]."','".$_COOKIE["id"]."','finished','".addslashes($_POST["message"])."')");
       	              				loguser($_COOKIE["id"],"sent feedback from Alpha.Dev.");
       	              				notifyUser($_COOKIE["id"],"sent feedback from Alpha.Dev.");
       	              				forumMsg("Thank you for your feedback.");
       	              				header("Refresh:2;./");
       	              				exit;
       	              			}else{
       	              				?>
       	              				<form action="" method="post">
       	              				<div class="table">
       	              				<div class="titlebg">Finish Checkout</div>
       	              				<div class="mainbg">
       	              				Please provide feedback about your purchase:<br />
       	              				<input type="text" name="feedback" class="form-control" />
									<button type="submit" name="submit" id="sc" class="formButton form-control">Submit</button>
       	              				</div>
       	              				</div>
       	              				</form>
       	              				<?php
       	              			}
       	              		break;
       	              		case 'cancel':
       	              			if(isset($_POST["submit"])){
       	              				query("INSERT INTO checkout_messages(ip,userid,mode,message)VALUES('".$_SERVER["REMOTE_ADDR"]."','".$_COOKIE["id"]."','cancelled','".addslashes($_POST["message"])."')");
       	              				loguser($_COOKIE["id"],"sent feedback from Alpha.Dev.");
       	              				notifyUser($_COOKIE["id"],"sent feedback from Alpha.Dev.");
       	              				forumMsg("Thank you for your feedback.");
       	              				header("Refresh:2;./");
       	              				exit;
       	              			}else{
       	              				?>
       	              				<form action="" method="post">
       	              				<div class="table">
       	              				<div class="titlebg">Cancel Checkout</div>
       	              				<div class="mainbg">
       	              				Please provide feedback about your purchase, such as why you chose to cancel:<br />
       	              				<input type="text" name="feedback" class="form-control" />
       	              				<input type="submit" name="submit" />
									<button type="submit" name="submit" id="sc" class="formButton form-control">Cancel Order</button>
       	              				</div>
       	              				</div>
       	              				</form>
       	              				<?php
       	              			}
       	              		break;
       	              	}
       	              	break;
       	              	case 'createsite':
       	              	onlineCheck();
       	              	changeTitle("Site Construction");
       	              	if(isset($_POST["submit"]) AND $_POST["details"] != ""){
       	              		query("INSERT INTO clients(userid,plan,details,requested_on)VALUES('".$_COOKIE["id"]."','".$_POST["plan"]."','".addslashes($_POST["details"])."',CURRENT_TIMESTAMP)");
       	              		loguser($_COOKIE["id"],"submitted a web site creation request.");
       	              		sendPM('1','3','Development Request','Hello, creator. I am messaging you to inform you that a client has requested your work on a web site. Details are included below. Thank you.[br][br][b]Plan: [/b] '.ucfirst($_POST["plan"]).'[br][b]User: [/b] [user='.$_COOKIE["id"].'][br][br][quote]'.$_POST["details"].'[/quote][br]Have a nice day!');
       	              		forumMsg("Thank you for your submission. Your entry has been made in the database and the creator has been messaged.");
       	              	}else{
       	              	?>
       	              	<div class="table bordercolor">
       	              	<div class="titlebg">Site Construction</div>
       	              	<div class="mainbg2" style="padding: 2px; word-spacing: 1px;"><div style="font-family: Verdana; font-size: 13px;"> &nbsp; &nbsp; Hello and thank you for your potential interest in my web site development business. As a guy in college, necessities are expensive, and in order to pay my way, I need to do these commissions. For details and specifications regarding plans and what you can expect from them, please click <a href="Plans.docx">here</a> to view the Word document file. Once you have read over the plans and decided what you would like, please fill out the form below. It will be in my database and I will check it as soon as possible. Thank you!</div>
       	              	</div>
       	              	<div class="mainbg">
       	              	<form action="" method="post">
       	              	Please provide details below of what plan (as well as possible extras) you would like:<br />
       	              	<br />
       	              	Plan: <select name="plan" class="form-control">
       	              		<option value="bronze">Bronze ($80)</option>
       	              		<option value="silver">Silver ($180)</option>
       	              		<option value="gold">Gold ($280)</option>
       	              		<option value="platinum">Platinum ($460)</option>
       	              	</select>
       	              	<br />
       	              		<div style="font-size:11px;">* Payment is not required yet - the prices are just to inform you.</div>
       	              		<div class="br"></div>
       	              	<textarea cols="50" rows="10" name="details" id="dt" class="form-control"></textarea><br />
						<button type="submit" name="submit" id="send" class="formButton form-control">Send</button>
       	              	</form>
       	              	</div>
       	              	</div>
       	              	<?php
       	              	}
       	              	break;
       	              	case 'purchasesite':
       	              	onlineCheck();
       	              	changeTitle("Commission Payment");
       	              	?>
       	              				<div class="table">
       	              				<div class="titlebg">Commission Payment</div>
       	              				<div class="mainbg2">Thank you for your interest in my services and work. Please use the form below for payment:</div>
       	              				<div class="mainbg">
       	              				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="BVVXPHZFSWK4N">
<table>
<tr><td><input type="hidden" name="on0" value="Construction Options">Construction Options</td></tr><tr><td><select name="os0" class="form-control">
	<option value="Bronze">Bronze $80.00 USD</option>
	<option value="Silver">Silver $180.00 USD</option>
	<option value="Gold">Gold $280.00 USD</option>
	<option value="Platinum">Platinum $460.00 USD</option>
</select></td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
       	              				</div>
       	              				</div>
       	              	<?php
       	              	break;
       	              	case 'chaomart':
					                                       onlineCheck();
														   changeTitle("Chao Mart");
					                                        query("CREATE TABLE IF NOT EXISTS chao_shop (
					                                         id INT NOT NULL AUTO_INCREMENT,
					                                         name VARCHAR(10) NOT NULL,
					                                         price INT NOT NULL,
					                                         image VARCHAR(200) NOT NULL,
					                                         bought INT NOT NULL,
					                                         primary key (id)
					                                        )");
					                                         echo "<table cellspacing=\"1\" cellpadding=\"4\" class=\"table bordercolor\"><tr><th class=\"titlebg\" colspan=\"2\">Chao Mart</th></tr><tr><td class=\"mainbg2\" colspan=\"2\">You may purchase a chao for the Dreamer Chao System here. Each chao is immortal. The chao below are ordered by price. These chao may be traded, but they cannot be cloned. <strong>Grades are completely randomized</strong>.";
					                                          if(AuthCheck(3)){
					                                           echo "<br /><strong>Options:</strong> <a href=\"?act=uploadchao\">Upload Chao</a> &bull; <a href=\"?act=addchao\">Add A Chao</a>";
					                                         }
					                                         echo "</td></tr>
															 <tr>
																<th class='titlebg' colspan='2'>Chao</th>
															 </tr>";
					                                          $getChao = mysqli_query($con, "SELECT id,name,price,image,bought FROM chao_shop ORDER BY price ASC");
					                                           while($chao = mysqli_fetch_assoc($getChao)){
					                                            echo "<td class=\"mainbg\">".$chao["name"]." Chao<br /><img alt=\"[".$chao["name"]."]\" src=\"userchao/".$chao["image"]."\" /></td><td class=\"mainbg2\"><strong>Price:</strong> ".number_format($chao["price"])." tokens.<br /><strong>Bought:</strong> ".FormatRes($chao["bought"],"time").".<div clas='brl'></div><div class='formButton'><a href=\"?act=buychao&amp;cid=".$chao["id"]."\" class='whiteLink'>Buy Chao</a></div>";
					                                             if(checkPerms(3)){
					                                              echo "<div style='text-align: right;'><strong>Staff Options:</strong> <a href=\"?act=editchao&amp;cid=".$chao["id"]."\">Edit</a> &bull; <a href=\"?act=deletechao&amp;cid=".$chao["id"]."\">Delete</a></div>";
					                                            }
					                                              echo "</td></tr>";
					                                          }
															  
					                                         if(mysqli_num_rows($getChao) == 0){
					                                          echo "<tr><td class=\"mainbg\">No chao have been uploaded yet. Please be patient, and some will be added soon.</td></tr>";
					                                       }
														     $getDrives = mysqli_query($con, "SELECT * FROM p_items WHERE name = 'Swim Drive' OR name = 'Fly Drive' OR name = 'Run Drive' OR name = 'Power Drive'") OR SQLError();
															 echo '<tr>
																<th class="titlebg" colspan="2">Chao Drives</th>
															 </tr>';
															 while($d = fetch($getDrives)){
																echo '<tr>
																	<td class="mainbg">
																		<img src="'.$d["img"].'" class="icon" />
																		'.stripslashes($d["name"]).'
																	</td>
																	<td class="mainbg2">
																		<strong>Price:</strong> '.number_format($d["price"]).' tokens.
																		<br />
																		<strong>About:</strong> '.stripslashes($d["about"]).'
																		<br />
																		<strong>Bought:</strong> '.FormatRes($d["bought"],"time").'
																		<div class="brl"></div>
																		<div class="formButton" id="item'.$d["id"].'">
																			<a href="javascript:;" class="whiteLink" onclick="buyItem('.$d["id"].',\'item'.$d["id"].'\');">Buy Drive</a>
																		</div>
																	</td>
																</tr>';
															 }
					                                         echo "</table>
															 <script type='text/javascript' src='scripts/chaomart.js'></script>";
					                                        break;
												   break;
					                               case 'buychao':
					                                if(!online()) PleaseLogin();
					                                 if(!(int)$_GET["cid"]) errMsg("You did not specify a chao!");
					                                  $chaodata = SQLQuerySelect("name,price,image,bought","chao_shop","id = '".$_GET["cid"]."'");
					                                  $num_chao = mysqli_num_rows(mysqli_query($con, "SELECT id FROM chao WHERE owner = '".$_COOKIE["id"]."'"));
					                                   if($num_chao>= 24) errMsg("Sorry, you have too many chao. You can only have up to 24.");
					                                    if($logged["tokens"] < $chaodata["price"]) errMsg("Sorry, you don't have enough tokens for this chao!");
					                                   $g = array("S","A","B","C","D","E");
					                                   $swim = $g[mt_rand(0,count($g)-1)];
					                                   $fly = $g[mt_rand(0,count($g)-1)];
					                                   $run = $g[mt_rand(0,count($g)-1)];
					                                   $power = $g[mt_rand(0,count($g)-1)];
					                                   $stamina = $g[mt_rand(0,count($g)-1)];
					                                    query("INSERT INTO chao(name,image,owner,evolved,hatched,swimgrade,flygrade,rungrade,powergrade,staminagrade)VALUES('".$chaodata["name"]."','".$chaodata["image"]."','".$_COOKIE["id"]."','y','y','".$swim."','".$fly."','".$run."','".$power."','".$stamina."')");
					                                    $MSID = mysqli_insert_id();
					                                     useTokens($chaodata["price"]);
					                                     $b = $chaodata["bought"] + 1;
					                                    query("UPDATE chao_shop SET bought = '".$b."' WHERE id = '".$_GET["cid"]."'");
					                                     loguser($_COOKIE["id"],"bought a ".$chaodata["name"]." chao.");
					                                    forumMsg("You successfully bought a ".$chaodata["name"]." chao!");
					                               break;
					                              case 'addchao':
					                               AuthCheck(4);
					                                if(!isset($_POST["submit"])){
					                                 ucg_form("Add A Chao","This will add a chao to the Dreamer Chao Mart. Please specify an image (root directory is uchaogarden/userchao, so once you upload the image, it'll go there; type JUST the filename in the URL box), a name (10 characters or less) and a reasonable price.<div style=\"text-align: center; font-weight: bold;\">Please make sure that you have <a href=\"?act=uploadchao\">uploaded</a> the chao first!</strong></div>Name:<br /><input type=\"text\" name=\"name\" /><br />Price:<br /><input type=\"text\" name=\"price\" /><br />Image Name:<br /><input type=\"text\" name=\"image\" /><br /><input type=\"submit\" value=\"Add Chao\" name=\"submit\" />","post");
					                               }else{
					                                 if(file_exists("userchao/".$_POST["image"])){
					                                  query("INSERT INTO chao_shop(name,price,image)VALUES('".$_POST["name"]."','".$_POST["price"]."','".$_POST["image"]."')");
					                                    loguser('3',"completed the chao addition.");
					                               }else{
					                                errMsg("File <strong>".$_POST["image"]."</strong> does not exist.");
					                             }
					                                  forumMsg("Chao successfully added! Here is the chao's image: [img]userchao/".$_POST["image"]."[/img][br]If you don't see an image, then it means that the file wasn't found, and that you did something wrong. Please make sure the chao was uploaded first!");
					                            }
					                         break;
					                          case 'editchao':
					                           AuthCheck(4);
					                            if(!(int)$_GET["cid"]) errMsg("No chao ID specified!");
					                             $chaodata = SQLQuerySelect("name,price,image","chao_shop","id = '".$_GET["cid"]."'");
					                              if(!isset($_POST["submit"])){
					                               ucg_form("Edit Chao","Name:<br /><input type=\"text\" value=\"".$chaodata["name"]."\" name=\"name\" /><br />Price:<br /><input type=\"text\" value=\"".$chaodata["price"]."\" name=\"price\" /><br />Image Name:<br /><input type=\"text\" value=\"".$chaodata["image"]."\" name=\"image\" /><br /><input type=\"submit\" value=\"Edit Chao\" name=\"submit\" />","post");
					                           }else{
					                            query("UPDATE chao_shop SET name = '".$_POST["name"]."', image = '".$_POST["image"]."', price = '".$_POST["price"]."' WHERE id = '".$_GET["cid"]."'");
					                             forumMsg($chaodata["name"]." successfully modified.");
					                          }
					                         break;
					                        case 'deletechao':
					                         AuthCheck(4);
					                          if(!(int)$_GET["cid"]) errMsg("No chao ID specified!");
					                           $chaodata = SQLQuerySelect("name","chao_shop","id = '".$_GET["cid"]."'");
					                            query("DELETE FROM chao_shop WHERE id = '".$_GET["cid"]."'");
					                             forumMsg($chaodata["name"]." successfully deleted.");
					                  break;
					                   case 'uploadchao':
					                    AuthCheck(4);
					                     if(!isset($_POST["submit"])){
					                      echo "<table cellspacing=\"1\" cellpadding=\"4\" class=\"table bordercolor\"><tr><th class=\"titlebg\">Upload Chao</th></tr><tr><td class=\"mainbg\">Please only upload animated, transparent .gif chao sprites. No copies of any of the original chao unless they're super, hyper, shiny, jewel, or translucent.<br /><form action=\"\" method=\"post\" enctype=\"multipart/form-data\"><input type=\"file\" name=\"chao_file\" /><br /><input type=\"submit\" value=\"Upload\" name=\"submit\" /></form></td></tr></table>";
					                  }else{
					                   move_uploaded_file($_FILES["chao_file"]["tmp_name"],"userchao/".$_FILES["chao_file"]["name"]) OR errMsg("Error in uploading file. Please contact the Administrator.");
					                    forumMsg("Chao successfully uploaded! Now please [url=?act=addchao]add[/url] the chao to the shop list.");
					                }
					               break;
					               case 'searchmembers':
					               onlineCheck();
					               changeTitle("Member Search");
					               ?>
					               <div class="table bordercolor">
					               <div class="titlebg">Search Members</div>
					               <div class="mainbg">
					               Type your search text in the input below, and the list will update in real-time.
					               <br />
					               <img src="buttons/magnifier.png" /> <input type="text" value="Search.." onfocus="this.value='';" onblur="(this.value == '') ? this.value='Search..'" onkeypress="searchUsers();" onkeydown="searchUsers();" onkeyup="searchUsers();" size="44" name="search" id="search" />
					               <br />
					               Search In: 
					               <select name="sb" id="sb" class="form-control">
					               <option value="display">Display Name</option>
					               <option value="name">User Name</option>
					               </select>
					               </div>
					               <div id="result" class="mainbg" name="result" style="padding: 4px; font-size: 18px;">
					               <?php
					               require 'members.php';
					               ?>
					               </div>
					               <div class="titlebg">&nbsp;</div>
					               </div>
					               <?php
					               break;
					               case 'dnsrecord':
					               AuthCheck(4);
					               changeTitle("DNS Record");
					               ?>
					               <form action="" method="post">
					               <div class="table bordercolor">
					               <div class="titlebg">DNS Record</div>
					               <div class="mainbg">
					               <?php 
					               	if(isset($_POST["submit"])){
					               		$dnsr = dns_get_record($_POST["hostname"],$_POST["dns_type"],$authns,$addtl);
					               		echo "<pre>";
					               		var_dump($dnsr);
					               		print_r($authns);
					               		print_r($addtl);
					               		echo "</pre>";
					               		if(checkdnsrr($_POST["hostname"],$dnsr["0"]["type"]))
					               			echo "<img src=\"buttons/accept.png\" /> Records Found.";
					               		else
					               			echo "<img src=\"buttons/cancel.png\" /> No records were found.";
					               		echo "<br /><strong>Known IP Addresses On Record</strong>:<pre>";
					               		var_dump(gethostbynamel($_POST["hostname"]));
					               		echo "</pre>";
					               	} ?>
					               	<br /><br />
					               Please provide the host-name to look up below:
					               <br />
					               <input type="text" size="55" id="hn" name="hostname" class="form-control" />
					               <br />
					               DNS Type:<br />
					               <select name="dns_type" class="form-control">
					               <?php
					               $dnsTypes = array(DNS_A, DNS_CNAME, DNS_HINFO, DNS_MX, DNS_NS, DNS_PTR, DNS_SOA, DNS_TXT, DNS_AAAA, DNS_SRV, DNS_NAPTR, DNS_A6, DNS_ALL,DNS_ANY);
					               $dnsTypeNames = array("DNS_A","DNS_CNAME","DNS_HINFO","DNS_MX","DNS_NS","DNS_PTR","DNS_SOA","DNS_TXT","DNS_AAAA","DNS_SRV","DNS_NAPTR","DNS_A6","DNS_ALL","DNS_ANY");
					               $i=0;
					               foreach($dnsTypes as $dt){
					               		echo "<option value=\"".$dt."\"";
					               		if($dt == DNS_ANY)
					               			echo " selected=\"1\"";
					               		echo ">".$dnsTypeNames[$i]."</option>";
					               		$i++;
					               }
					               ?>
					               </select>
					               <br />
								   <button type="submit" name="submit" id="go" class="formButton form-control">Go</button>
					               </div>
					               </div>
					               </form>
					               <?php
					               break;
					               case 'usershops':
					               onlineCheck();
					               if(!(int)$_GET["uid"]) invData();
					               //unfinished..
					               break;
					               case 'buddies':
					               onlineCheck();
					               $userdata = sql("SELECT display,friends FROM members WHERE id = '".GET("id",1)."'");
					               $buddies = explode(":",$userdata["friends"]);
					               $pageTitle = $userdata["display"]."'s Buddies";
					               changeTitle($pageTitle);
					               ?>
					               <table class="table bordercolor" cellspacing="1" cellpadding="4" id="friends">
					               	<tr>
					               		<th class="titlebg"><?php echo $pageTitle; ?></th>
					               	</tr>
					               	<tr>
					               		<td class="mainbg pageContent">These are all of <?php echo getDisplay(GET("id",1)); ?>'s buddies on the site.</td>
					               	</tr>
					               	<?php
					               		if((count($buddies)-1) == 0){
					               			echo '<tr>
					               				<td class="mainbg pageContent">
					               				This user doesn\'t have any buddies. '.ubbc(':\'(').'
					               				</td>
					               			</tr>';
					               		}else{
					               			foreach($buddies as $buddyID){
					               				if(!checkFriend(GET("id",1),$buddyID) OR $buddyID == "") continue;
					               				echo '<tr>
					               					<td class="mainbg2 pageContent">
					               					'.getDisplay($buddyID).'
					               					</td>
					               				</tr>';
					               			}
					               		}
					               	?>
					               </table>
					               <?php
					               break;
					               case 'friendrequests':
					               onlineCheck();
					               changeTitle("Friend Requests");
					               $getRequests = mysqli_query($con, "SELECT * FROM freq WHERE touser = '".$_COOKIE["id"]."'") OR SQLError();
					               ?>
					               <table class="table bordercolor" cellspacing="1" cellpadding="4" id="friend">
					               	<tr>
					               		<th class="titlebg">Friend Requests</th>
					               	</tr>
					               	<tr>
					               		<td class="mainbg2">
					               		These are all of your friend requests. You may accept or deny them.
					               		</td>
					               	</tr>
					               	<?php
					               		if(mysqli_num_rows($getRequests) == 0){
					               			echo '<tr>
					               				<td class="mainbg2 pageContent">
					               				You have no friend requests.
					               				</td>
					               			</tr>';
					               		}
					               		while($r = fetch($getRequests)){
					               			echo '<tr>
					               				<td class="mainbg2">
					               				'.getDisplay($r["fromuser"]).'
					               				<div id="results">
					               				&nbsp; &nbsp;
					               				<a href="javascript:;" onclick="acceptFriend('.$r["fromuser"].');" class="siteLink" id="approve">
					               				<img src="buttons/bullet_add.png" /> Approve
					               				</a>
					               				&nbsp; &nbsp; 
					               				<a href="javascript:;" onclick="denyFriend('.$r["fromuser"].');" class="siteLink" id="deny">
					               				<img src="buttons/delete.png" /> Deny
					               				</a>
					               				</div>
					               				</td>
					               			</tr>';
					               		}
					               	?>
					               </table>
					               <?php
					               break;
					               case 'labels':
					               AuthCheck(4);
					               changeTitle("Label Manager");
					               if(!isset($_POST["submit"])){
					               	?>
					               	 <table class="table bordercolor" cellspacing="1" cellpadding="4" id="labelTable">
					               	 <tr>
					               	 	<th class="titlebg">Manage Labels</th>
					               	 </tr>
					               	 </table>
					               	 <?php
					               }
					               break;
					               case 'mserver':
					               AuthCheck(4);
					               changeTitle("Minecraft Server");
					               $serverdata = sql("SELECT server_status FROM sitedata");
					               ?>
					                <table class="table bordercolor" cellspacing="1" celpadding="4" id="serverTable">
					                <tr>
					                	<th class="titlebg">Server Status</th>
					                </tr>
					                <tr>
					                	<td class="mainbg pageContent" id="tcell">
					                	This is the control for the Minecraft Server status. It indicates whether the server is active or not. To change its current status, simply click the button. It will update in real-time.
					                	<div style="height: 10px;" id="statChanged"></div>
					                	The Minecraft Server is currently <b id="status"><?php echo ucfirst($serverdata["server_status"]); ?></strong>
					                	<br />
					                	<img src="http://panel.exodushosting.net/index.php?r=status/4413.png" />
					                	<div style="height: 10px;"></div>
					                	<div style="text-align: center;" id="btnChange">
					                	<input type="button" onclick="serverStatus();" value="Change Status" id="change" />
					                	</div>
					                	</td>
					                </tr>
					                </table>
					               <?php
					               break;
					               case 'calendar':
    echo "<table class=\"table bordercolor\" cellspacing=\"1\" cellpadding=\"4\" id=\"calendar\"><tr><th class=\"titlebg\" colspan=\"".date("t")."\"><a href=\"index.php?action=calendar\">Zollernverse Calendar</a></th></tr><tr><td class=\"mainbg2\" colspan=\"7\">";
     if(checkPerms(3)){
      echo "<a href=\"?act=addevent\">Add Event</a> &bull; ";
   }
    echo "<a href=\"?act=allevents\">All Events</a></td></tr>";
     if(!$_GET["month"]){
      echo "<tr><td class=\"mainbg\">Please select the month of which you would like to view the events for:<br /><form action=\"javascript:doEventSubmit();\" method=\"post\"><select name=\"month\" id=\"evmonth\">";
       $months = Array("January","February","March","April","May","June","July","August","September","October","November","December");
        for($i=0;$i<count($months);$i++){
           echo "<option value=\"".$months[$i]."\">".$months[$i]."</option>";
       }
      echo "</select><br /><input type=\"submit\" value=\"Continue\" /></form></td></tr>";
      }else{
       $d = array("Sun","Mon","Tues","Wed","Thurs","Fri","Sat");
       echo "<tr>";
        for($i=0;$i<sizeof($d);$i++){
        	echo "<th class=\"titlebg pageContent\" width=\"5%\">".$d[$i]."</th>";
        }
       echo "</tr>";
        $t = 1;
        $dm = date("t",strtotime($_GET["month"]));
        $tx = 1;
         echo "<tr>";
         while($t <= $dm){
          echo "<td class=\"mainbg pageContent\" height=\"75\" style=\"vertical-align: top\">".$t;
            $getevents = mysqli_query($con, "SELECT id,name,`date` FROM events") OR SQLError();
             while($events = mysqli_fetch_assoc($getevents)){
              if((date("d",strtotime($events["date"])) == $t) AND (date("F",strtotime($events["date"])) == $_GET["month"])){
               echo "<br /><a href=\"?act=viewevent&amp;id=".$events["id"]."\" class=\"siteLink\">".$events["name"]."</a>";
             }
            }
            $getbirthdays = mysqli_query($con, "SELECT id,birthday FROM members WHERE birthday LIKE '".(date("____-m-d 00:00:00",strtotime($_GET["month"]." ".$t)))."'") OR SQLError();
            if(mysqli_num_rows($getbirthdays) > 0){
            	echo "<br /><a href=\"javascript:;\" class=\"siteLink\" id=\"b".$t."\" onclick=\"nWin('birthdays.php?t=".strtotime($_GET["month"]." ".$t)."');\">". mysqli_num_rows($getbirthdays). " birthday";
            	if(mysqli_num_rows($getbirthdays) > 1){
            		echo "s";
            	}
            	echo "</a>";
            }
        $t++;
        $tx++;
        echo "</td>";
         if($tx > 7){
         	echo "</tr><tr>";
         	$tx=1;
         }
       }
     echo "</tr></table>";
     }
   break;
   case 'addevent':
    if(checkPerms(3)){
     if(!isset($_POST["submit"])){
      echo "<form action=\"\" method=\"post\"><table class=\"table bordercolor\" cellspacing=\"1\" cellpadding=\"4\" id=\"addEvent\"><tr><th class=\"titlebg\">Add Event</th></tr><tr><td align=\"center\" class=\"mainbg\"><u>Name:</u><br /><input type=\"text\" name=\"event\" /><br /><u>Date of Event:</u><br /><select name=\"month\">";
       for($i=1;$i<13;$i++){
        $t=(strlen($i)==1)?"0".$i:$i;
          echo("<option value=\"".$t."\">".$t."</option>");
      }
       echo "</select> <select name=\"day\">";
        for($r=1;$r<32;$r++){
                   $t=(strlen($r)==1)?"0".$r:$r;
                    echo("<option value=\"".$t."\">".$t."</option>");
                 }
         echo "</select> <select name=\"year\">";
          for($y=date("Y");$y>date("Y")-13;$y--){
                echo("<option value=\"".$y."\">".$y."</option>");
             }
       echo "</select><br /><u>Description:</u><br /><textarea cols=\"100\" rows=\"5\" name=\"desc\"></textarea></td></tr><tr><td align=\"center\" class=\"mainbg2\"><input type=\"submit\" value=\"Add Event\" name=\"submit\" /> <input type=\"reset\" value=\"reset\" /></td></tr></table>";
     }else{
      $date = $_POST["year"].":".$_POST["month"].":".$_POST["day"];
       query("INSERT INTO events(name,`date`,description,userid)VALUES('".$_POST["event"]."','".$date."','".$_POST["desc"]."','".$_COOKIE["id"]."')");
        forumMsg("Event successfully added.");
     }
    }
  break;
  case 'viewevent':
  idCheck();
  $eventdata = sql("SELECT id,name,`date`,description,userid,locked FROM events WHERE id = '".$_GET["id"]."'");
      changeTitle("Event: ".$eventdata["name"]);
      if(isset($_POST["submit"]) AND $eventdata["locked"] != 'y'){
      	query("INSERT INTO cal_cmts(ev_id,userid,cmt,posted)VALUES('".$eventdata["id"]."','".$_COOKIE["id"]."','".addslashes($_POST["cm"])."',CURRENT_TIMESTAMP)");
      	header("Location: #comments");
      }
      $userdata = sql("SELECT * FROM members WHERE id = '".$eventdata["userid"]."'");
      echo "<table class=\"table bordercolor\" cellspacing=\"1\" cellpadding=\"4\" id=\"event\"><tr><th class=\"titlebg\" colspan=\"2\">".$eventdata["name"]."</th></tr>";
       require("miniprofile.php");
        echo "<tr rowspan=\"3\"><td class=\"mainbg pageContent\">";
         if(checkPerms(3)){
          $l = ($eventdata["locked"] == 'y') ? "unlock" : "lock";
           echo "(<a href=\"?act".$l."event&id=".$_GET["id"]."\">".ucfirst($l)."</a>) ";
         }
         echo "<strong>Date of Event:</strong> ".dateFormat($eventdata["date"])."<div style=\"height: 400px;\"><hr/>".ubbc($eventdata["description"])."</div></td></tr>";
           $gc = mysqli_query($con, "SELECT * FROM cal_cmts WHERE ev_id = '".$eventdata["id"]."' ORDER BY posted DESC") OR SQLError();
           echo("<tr><th class=\"titlebg\">Posted Comments</th></tr><tr><td class=\"mainbg2 pageContent\"><div style=\"height: 250px; overflow: auto; background: #ffffff; color: #000000; padding: 2px;\">");
            while($c = mysqli_fetch_assoc($gc)){
            	echo getDisplay($c["userid"]) . " posted on ".dateFormat($c["posted"]).": ".ubbc($c["cmt"])."<br />";
            }
             if(mysqli_num_rows($gc) == 0){
             	echo "No comments have yet been posted.";
             }
            echo "</div></td></tr><tr><th class=\"titlebg\">Add Comment</th></tr><tr><td class=\"mainbg2\">";
             if(!$eventdata["locked"] AND online()){
              echo "<form action=\"\" method=\"post\"><textarea cols=\"80\" rows=\"5\" name=\"cm\" id=\"cm\" class=\"form-control\"></textarea><br /><input type=\"submit\" value=\"Post\" name=\"submit\" id=\"post\" /><button type=\"submit\" name=\"submit\" id=\"fb\" class=\"formButton form-control\">Post</button></form><a name=\"comments\"></a>";
            }else{
            	echo "This event is locked to new comments.";
            }
           echo("</td></tr></table>");
  break;
   case 'lockevent':
    if(!(int)$_GET["id"]) errMsg("You did not specify an event.");
     AuthCheck(3);
      query("UPDATE events SET locked = 'y' WHERE id = '".$_GET["id"]."'");
      header("Location: ?act=viewevent&id=".$_GET["id"]);
  break;
   case 'unlockevent':
    if(!(int)$_GET["id"]) errMsg("You did not specify an event.");
     AuthCheck(3);
      query("UPDATE events SET locked = 'n' WHERE id = '".$_GET["id"]."'");
      header("Location: ?act=viewevent&id=".$_GET["id"]);
  break; 
 case 'allevents':
  $ge = mysqli_query($con, "SELECT * FROM events ORDER BY `date` ASC");
  echo "<table class=\"table bordercolor\" cellspacing=\"1\" cellpadding=\"4\" id=\"allEvents\"><tr><th class=\"titlebg\" colspan=\"4\">All Events</th></tr><tr><td class=\"mainbg2\" colspan=\"4\">Below are all events that are set. They are ordered by date in ascending order.</td></tr><tr><th class=\"catbg\">Date</th><th class=\"catbg\">Event</th><th class=\"catbg\">User</th><th class=\"catbg\">Description</th></tr>";
   while($eg = mysqli_fetch_assoc($ge)){
   	echo "<tr><td class=\"mainbg\">".dateFormat($eg["date"])."</td><td class=\"mainbg\"><a href=\"?act=viewevent&id=".$eg["id"]."\">".$eg["name"]."</a></td><td class=\"mainbg\">".getDisplay($eg["userid"])."</td><td class=\"mainbg\">".substr($eg["description"],0,55)."..</td></tr>";
   }
  echo "</table>";
break;
	case 'viewcategory':
		if(!intval($_GET["id"]))
			errMsg("No valid category ID was specified.");
			$getBoards = mysqli_query($con, "SELECT id FROM boards WHERE ctg_id = '".$_GET["id"]."'") OR SQLError();
			$cData = sql("SELECT name FROM ctgs WHERE id = '".$_GET["id"]."'");
			changeTitle($cData["name"]);
			echo '<table class="table bordercolor pageContent" cellspacing="1" cellpadding="4">
				<tr>
					<th class="titlebg" colspan="4">'.$cData["name"].'</th>
				</tr>';
			while($boards = fetch($getBoards)){
				fetchBoard($boards["id"]);
			}
			echo '</tr><tr><th class="titlebg" colspan="4">&nbsp;</th></tr></table>';
	break;
       	              }
  echo "<div class=\"table\" style=\"text-align: right; border: none;\"><select id=\"fj\" onchange=\"forumJump(this.options[this.selectedIndex].value);\" style=\"font-size:12px;\" class=\"form-control\"><option value=\"0\" selected=\"selected\"> --------- Forum Jump ---------</option>";
   $getboards = mysqli_query($con, "SELECT id,name FROM boards ORDER BY name ASC");
    while($boards = mysqli_fetch_assoc($getboards)){
     echo "<option value=\"".$boards["id"]."\">".$boards["name"]."</option>";
   }
   echo "</select>";
   if(checkPerms(3)){
   	//Admin Jump
   	echo " &nbsp; &nbsp; <select name=\"aj\" style=\"font-size:12px;\" id=\"aj\" onchange=\"toLoc('?act='+this.options[this.selectedIndex].value);\" class=\"form-control\">
   	<option value=\"cpanel\">--------- Admin Jump --------</option>";
   	$actions = array("createboard:Create Board","modifyboard:Modify Board","delboard1:Delete Board","boardorder1:Reorder Boards","boardban1:Board Bans","createcategory:Create Category","modifycategory:Modify Category","delctg1:Delete Category","categoryorder:Reorder Categories","phpcons:PHP Console","sqlcons:SQL Console","viewlogs:View Logs","realtime:RTL Feed","hostname:Hostname Lookup","ipcenter:IP Center","settings:Forum Settings","medals:Site Medals","affiliatecenter:Affiliate Center","addupdate:Add Update","sandbox:The Sandbox","newsfader:News Fader","avmanage:User Avatars","wordsub:Word Substitution","reserved:Reserved Names","bannedusers:Banned Users","deletepostsbymember:Delete Posts For Member","mranks:Member Ranks","emailall:E-Mail All","pending:Pending Members","sendpm&u=all:PM All","reportcenter:Report Center","createskin:New Layout");
   	asort($actions);
   	foreach($actions as $a){
   		$actSplit = explode(":",$a);
   		echo "<option value=\"".$actSplit["0"]."\">".$actSplit["1"]."</option>";
   	}
   }
   echo "</select></div>";
   if($sitedata["enable_af"]){
   ?>
   <br />
   <table cellspacing="1" cellpadding="4" class="table bordercolor">
<tr><th class="titlebg" colspan="2">Affiliate Bar</th></tr>
<tr>
<td class="mainbg" colspan="2">
<div style="font-size:14px;">These are the current affiliates of Zollernverse.</div>
</td></tr>
<tr>
<th class="catbg">Mini-Banner</th>
<th class="catbg">Affiliates</th>
</tr>
<tr>
<td class="mainbg" width="10%"><img src="minibanner2.png" /></td>
<td class="mainbg2">
<?php
$getaffiliates = mysqli_query($con, "SELECT * FROM affiliates ORDER BY name ASC") OR SQLError();
while($af = fetch($getaffiliates)){
	echo "<a href=\"?act=site&mode=out&id=".$af["id"]."\" onclick=\"window.open(this.href);return false;\"><img alt=\"".stripslashes($af["description"])."\" title=\"".stripslashes($af["description"])."\" src=\"".$af["banner"]."\" style=\"height:31px;width:88px;\" /></a> &nbsp;";
}
?>
</td>
</tr>
<tr><th class="catbg" colspan="2"> </th></tr>
</table>
   <?php
}
$sandfoot = sql("SELECT footer FROM sandbox");
echo stripslashes($sandfoot["footer"]);
		?>
		<script type="text/javascript" src="scripts/external.js"></script>
	</body>
</html>
<?php
ob_end_flush();
?>
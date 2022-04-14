<?php
ob_start();
	require 'functions.php';
	require 'sql.php';
	require 'startup.php';
$con = connect();
$defaultSkin = sql("SELECT id FROM layouts WHERE default_layout = '1'");
$skinid = (online()) ? $logged["skinid"] : 1;
if($skinid == "") $skinid = $defaultSkin["id"];
if(online()){
	if($logged["skinid"] == 0) query("UPDATE members SET skinid = '".$defaultSkin["id"]."' WHERE id = '".$_COOKIE["id"]."'");
	if($logged["tokens"] < 0) query("UPDATE members SET tokens = '0' WHERE id = '".$_COOKIE["id"]."'");
}
$getCtgs = mysqli_query($con, "SELECT * FROM page_categories WHERE pc = 0 ORDER BY name ASC");// OR SQLError();
$banner = sql("SELECT banner_img FROM layouts WHERE id = '".$skinid."'");
$metas = sql("SELECT * FROM meta");
?><!DOCTYPE html>
<html lang="en" xml:lang="en" dir="ltr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="HandheldFriendly" content="true">
		<meta name="viewport" content="width=device-width"/>
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
		<?php
		echo '
		<script type="text/javascript" src="'.$root.'scripts/angular.js"></script>
		<script type="text/javascript" src="'.$root.'scripts/jquery.js"></script>
		<script type="text/javascript" src="'.$root.'scripts/main.js"></script>
		<link rel="stylesheet" href="'.$root.'styles/normalize.css" type="text/css" media="all" />
		<link rel="stylesheet" href="'.$root.'styles/homepage.css" type="text/css" media="all" />
		<link rel="stylesheet" href="'.$root.'styles/main.css" type="text/css" media="all" />
		<link rel="stylesheet" href="'.$root.'styles/v2.0.css" type="text/css" media="all" />
		<link rel="stylesheet" href="'.$root.'styles/forumv2.css" type="text/css" media="all" />
		<link rel="stylesheet" href="'.$root.'styles/layout.php" media="all" type="text/css" />
		<link rel="shortcut icon" href="'.$root.'favicon.ico" />';
		?>
		<title><?php echo stripslashes($metas["name"]); ?></title>
	</head>
	<body>
	<?php
		$sandhead = sql("SELECT header FROM sandbox");
		echo stripslashes($sandhead["header"]);
		if($sitedata["m_mode"]) setTitle("Construction Mode");
		notifications(); 
	?>
	<div id="achID" style="position: absolute; width: 15%; background: #444; color: #eee; border-radius: 5px; text-align: center; padding: 4px; display: none; margin-left: 42%; margin-top: 1%; z-index: 9000;"></div>
	<?php
		AchievementCheck();
	?>
	<div id="mainArea">
		<section id="container">
			<section id="content" class="mainbg">
				<section id="main" class="mainbg2">
					<div class="title">Zollernverse</div>
					<div class="br"></div>
					<div style="width: 50%; margin: 0% auto;">
						<a href="<?php echo $root; ?>"><img src="<?php echo $root.$banner["banner_img"]; ?>" style="border-radius: 5px;" /></a>
					</div>
					<div class="brl"></div>
						 <div style="margin-left: 2%; padding: 4px; width: 36%;" class="ui-field-contain">
						 <form action="<?php echo $root; ?>search" method="post">
							&nbsp; <input type="text" name="search" id="txtSearch" style="display: inline-block;" />
							<button type="submit" class="ui-btn ui-icon-search ui-btn-icon-left" style="border-radius: 5px;" name="searchSubmit" id="btnSearch">Search</button>
						 </form>
						 </div>
					<div class="brl"></div>
					<div style="margin-left: 2%;">
					<?php
						switch($_GET["p"]){
							default:
								changeTitle("Home");
								echo '<div class="brm"></div>';
								RSSFeed();
								$page = ($_GET["page"] == 0 OR $_GET["page"] == "") ? 0 : ($_GET["page"]-1);
								$which = ceil($page)*2;
								$totalUpdates = numRows("SELECT id FROM updates");
								if(!(int)$_GET["id"]){
									$getupdates = mysqli_query($con, "SELECT * FROM updates ORDER BY posted DESC LIMIT ".$which.", 2") OR SQLError();
									while($u = fetch($getupdates)){
									echo "<div style=\"text-align: left;\">
									<div style=\"font-weight: bold; font-size: 16px;\">&raquo; ".ubbc($u["subject"])."</div>";
       	              					if(checkPerms(4)){
       	              						echo "<div style=\"margin-left: 65%; font-size:14px;\">
       	              							<a href=\"".$root."forum.php?act=modupdate&id=".$u["id"]."\"><img src=\"".$root."modify.gif\" /></a>
       	              							&nbsp;
       	              							<a href=\"".$root."forum.php?act=delupdate&id=".$u["id"]."\"><img src=\"".$root."delete.gif\" /></a>
       	              						</div>";
       	              					}
       	              					echo "<div style=\"font-size:14px;\">Author:</div> ".ubbc("[user=".$u["userid"]."]")." 
       	              					&nbsp; &nbsp; ".dateFormat($u["posted"])."
       	              					<div id=\"update".$u["id"]."\" style=\"padding:4px;\">
       	              					 <div>
       	              					 &nbsp; &nbsp; &nbsp; &nbsp; ".ubbc($u["post"])."</div>
       	              					 </div>";
       	              					if(online()){
       	              						echo "
       	              					<div style=\"margin-left: 45%;font-size:12px;\">
       	              					<a href=\"".$root."forum.php?act=updatecomments&id=".$u["id"]."\"><img src=\"".$root."buttons/comments.png\" /> ("
       	              					.mysqli_num_rows(mysqli_query($con, "SELECT id FROM update_comments WHERE update_id = '".$u["id"]."'")).")
       	              					</a>
       	              					</div>";
       	              					}
       	              					echo "&raquo; <a href=\"".$root."update/".$u["id"]."\" class=\"siteLink\">Permalink</a>
       	              					<div style=\"height: 20px;\"></div>
       	              		";
       	              	}
       	              	$totalPages = ceil($totalUpdates/2);
       	              	if($totalPages > 1){
       	              		echo "<div style=\"text-align: left; padding: 4px;\">
       	              		<select name=\"page\" onchange=\"document.location.href='".$root."updates/'+this.options[this.selectedIndex].value;\">";
       	              		$i = 1;
       	              		$cH = 0;
       	              		while($i <= $totalPages){
       	              			$cH++;
       	              			echo "<option value=\"".$i."\"";
       	              			if($i == (int) $_GET["page"]){
       	              				echo " selected=\"selected\"";
       	              			}
       	              			echo ">Page ".$i."</option>";
       	              			$i++;
       	              		}
       	              		echo "</select>
       	              		</div>";
       	              	}
       	              }else{
       	              	$u = sql("SELECT * FROM updates WHERE id = '".$_GET["id"]."'");
       	              	echo "
       	              		<div style=\"text-align: left;\"><div style=\"font-weight: bold; font-size: 16px;\">&raquo; ".ubbc($u["subject"])."</div>";
       	              					if(checkPerms(4)){
       	              						echo "<div style=\"text-align:right;font-size:14px;\">
       	              							<a href=\"".$root."forum.php?act=modupdate&id=".$u["id"]."\"><img src=\"".$root."modify.gif\" /></a>
       	              							&nbsp;
       	              							<a href=\"".$root."forum.php?act=delupdate&id=".$u["id"]."\"><img src=\"".$root."delete.gif\" /></a>
       	              						</div>";
       	              					}
       	              					echo "<div style=\"font-size:14px;\">Author:</div> ".ubbc("[user=".$u["userid"]."]")." &nbsp; &nbsp; ".dateFormat($u["posted"])." 
       	              					<div class='brl'></div>
       	              					<div id=\"update".$u["id"]."\" style=\"padding:4px;\">
       	              					 &nbsp; &nbsp; &nbsp; &nbsp; ".ubbc($u["post"])."
       	              					</div>
       	              					<div style=\"text-align:right;\">
       	              					<a href=\"".$root."forum?act=updatecomments&id=".$u["id"]."\"><img src=\"".$root."buttons/comments.png\" /> ("
       	              					.numRows("SELECT id FROM update_comments WHERE update_id = '".$u["id"]."'").
       	              					")
       	              					</a>
       	              					</div>
       	              					</div>
       	              		";    
       	              	}
								echo '</div>';
							break;
							case 'logout':
							OnlineCheck();
							setcookie("id","",time()-300);
							setcookie("st_site_id","",time()-300);
							toLoc($root);
							break;
							case 'cpanel':
							case 'admin':
								AuthCheck(3);
								changeTitle("Control Panel");
							?><h2 style="text-align: center;">Content Management System</h2>
       	        		<h1 style="text-align: center;">Administrative Tools</h1>
       	        		&nbsp; &nbsp; &nbsp; &nbsp; <strong>Developed By:</strong> <?php echo getDisplay(1); ?>
       	        		<div class="br"></div>
       	        		<div class="mainbg cpanel">
							<div class="titlebg top">zVerse cPanel</div>
							<div class="adminRow">
								<div class="adminSection">
									<div class="titlebg adminTitle top">Security</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>forum?act=banneduers">Banned Users</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>forum?act=viewlogs">View Logs</a>
									</div>
								</div>
								<div class="adminSection">
									<div class="titlebg adminTitle top">Pages</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/managepages">Page Manager</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/managecategories">Category Manager</a>
									</div>
								</div>
								<div class="adminSection">
									<div class="titlebg adminTitle top">Content</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>forum?act=addupdate">Add Update</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/metatags">Meta Tags</a>
										<div class="brxl"></div>
									</div>
								</div>
								<div class="adminSection">
									<div class="titlebg adminTitle top">Config</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/config">General Settings</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/mobile">Mobile Settings</a>
									</div>
								</div>
							</div>
							<div class="br"></div>
							<div class="adminRow">
								<div class="adminSection">
									<div class="titlebg adminTitle top">Toolbox</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/modules">Module Manager</a>
									</div>
								</div>
								<div class="adminSection">
									<div class="titlebg adminTitle top">Consoles</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>forum/?act=sqlcons">mysqli Console</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>forum/?act=phpcons">PHP Console</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>forum/?act=xspcons">XSP Console</a>
									</div>
								</div>
								<div class="adminSection">
									<div class="titlebg adminTitle top">Management</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/database">Database Manager</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/files">File Manager</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/layoutmanager">Layout Manager</a>
									</div>
								</div>
								<div class="adminSection">
									<div class="titlebg adminTitle top">Tasks</div>
									<div class="adminContent">
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/backupmanager">Backup Manager</a>
										<div class="brxl"></div>
										&nbsp; &raquo; <a href="<?php echo $root; ?>page/tasks">Task Manager</a>
									</div>
								</div>
							</div>
							<div class="br"></div>
							<div class="titlebg bottom">&nbsp;</div>
       	        		</div>
							<?php
							break;
						 case 'tasks':
							AuthCheck(4);
							changeTitle("Task Scheduler");
						?>
							<div style="margin-left: 2%;">
								 <a href="<?php echo $root; ?>admin">&laquo; Control Panel</a>
								 <h2>Task Manager</h2>
								 &nbsp; From here you can manage your scheduled tasks for the site. They will automatically run at their specified time, once the site is loaded. With how often Googlebot visits, you can be sure that these custom scripts and commands will run. This page is currently under construction.
								 <div class="br"></div>
								 <div class="brl"></div>
								 <a href="<?php echo $root; ?>createtask"><img src="<?php echo $root; ?>buttons/book_add.png" class="icon" /> New Task</a>
								 <?php
								 ?>
							</div>
						<?php
						 break;
						 case 'createtask':
							AuthCheck(4);
							changeTitle("Create Task");
						?>
							<a href="<?php echo $root; ?>tasks">&laquo; Task Manager</a>
							<h2>New Task</h2>
							<form action="<?php echo $root; ?>createtask" method="post">
							<div>
								<label for="name" class="formLabel">Name:</label>
								<div class="brl"></div>
								<input type="text" class="form-control" name="name" style="width: 27%;" id="txtName" placeholder="Enter name.." required="1" />
							</div>
							<div class="br"></div>
							<div>
								<label for="about" class="formLabel">About:</label>
								<div class="brl"></div>
								<textarea cols="30" rows="4" name="about" id="txtAbout" required="1" class="form-control" placeholder="About task.."></textarea>
								<div class="brl"></div>
							</div>
							<div class="br"></div>
							<div>
								<label for="code" class="formLabel">PHP Code:</label>
								<div class="brl"></div>
								<textarea cols="60" rows="8" name="code" id="txtCode" required="1" class="form-control" placeholder="PHP Code.."></textarea>
							</div>
							<div class="br"></div>
							<div>
								<label for="time" class="formLabel">Run Time:</label>
								<div class="brl"></div>
								<input type="text" name="time" id="txtTime" required="1" class="form-control" placeholder="12:00 am"></textarea>
							</div>
							<div class="br"></div>
							</form>
						<?php
						 break;
						 case 'metatags':
       	        		AuthCheck(4);
       	        		changeTitle("Meta Management");
       	        		$metaData = sql("SELECT * FROM meta");
       	        		if(isset($_POST["submit"])){
       	        			query($con, "UPDATE meta SET name = '".addslashes($_POST["name"])."', about = '".addslashes($_POST["about"])."',
       	        			       keywords = '".addslashes($_POST["keywords"])."', title = '".addslashes($_POST["title"])."'");
       	        			?>
       	        		  <div style="width: 680px; padding: 4px; border: 2px solid #008b00; font-size: 15px; border-radius: 20px; background: #0d0; color: #009900;
       	        		  font-weight: bold;"><img src="<?php echo $root; ?>buttons/on.gif" style="height:16px;width:16px;" /> Your changes were applied successfully.</div>
       	        		<?php
       	        		}
       	        		?>
						<div style="margin-left: 1%; width: 90%;">
						<a href="<?php echo $root; ?>admin">&laquo; Control Panel</a>
						<div class="brl"></div>
       	        		<h2> &raquo; Meta Management</h2>
       	        		From here, admins can manage the meta tags and their values for their web site, using a user-friendly system interface, eliminating the need for basic markup knowledge. However, it does benefit to have substantial knowledge of the concept before attempting to make any changes.
       	        		<div class="br"></div>
       	        		<strong>Last Modified: </strong> On <?php echo dateFormat($metaData["last_modified"]); ?> by <?php echo getDisplay($metaData["last_user_id"]); ?>
						<div class="brl"></div>
       	        		<div style="margin: 0px auto; width: 100%; padding: 4px; background: url(<?php echo $root; ?>auroramainbg.png);">
       	        		<div style="text-align: center; font-weight: bold; font-size: 15px; text-decoration: underline;">Meta Manager</div>
							<form action="<?php echo $root; ?>page/metatags" method="post">
							<p>
								<label class="formLabel" for="name">Site Name</label>: 
								<br />
								<input type="text" size="50" class="form-control" value="<?php echo stripslashes($metaData["name"]); ?>" required="1" name="name" />
								<div style="font-size: 11px;">The name of your web site. Duh.</div>
							</p>
							<p>
								<label class="formLabel" for="keywords">Key Words</label>:<br />
								<input type="text" class="form-control" name="keywords" id="kw" placeholder="Enter keywords.." value="<?php echo stripslashes($metaData["keywords"]); ?>" size="50" />
								<div style="font-size: 11px;">Key words are words that users type in to search engines, and this is a list of words that will yield this site as a result. Separate each key word with a comma, and please try not to use more than 15.</div>
							</p>
							<p>
								<label class="formLabel" for="about">Description:</label><br />
								<textarea cols="62" rows="5" name="about" required="1" id="desc" class="form-control"><?php echo stripslashes($metaData["about"]); ?></textarea>
								<div style="font-size: 11px;">Provide a brief, alluring description for the web site -- this shows up in the site's search engine entry.</div>
							</p>
							<p>
								<label class="formLabel" for="title">Title</label>:<br />
								<input type="text" value="<?php echo stripslashes($metaData["title"]); ?>" size="50" name="title" required="1" class="form-control" />
								<div style="font-size: 11px;">This is what appears when the user hovers their mouse over the site's name in the results.</div>
							</p>
							<p style="text-align: center;">
								<button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button>
							</p>
							</form>
						</div>
					   </div>
       	        		<?php
       	        		break;
						case 'modules':
       	        		AuthCheck(3);
       	        		changeTitle("Module Manager");
       	        		?>
						<!--#echo var="DATE_LOCAL"-->
						<div style="margin-left: 2%; width: 95%;">
							<h2> &raquo; Module Manager</h2>
       	        		&nbsp; Modules are a great way to add new, interesting content to your pages. The user may create a module and assign it an ID. Inside of this module is their own HTML, text, JScript, CSS, jQuery, etc. To use a module in a page, you reference the ID of the module desired. For example, if you were to create a module with the ID of <em>footer</em>, you would reference it in the page you're creating by using <strong>${mod:footer}</strong>. The CMS will then replace this value with the coding that was provided inside of the module upon its creation. Users may edit and delete modules as they need to, so long as they only edit or delete their own. Admins have the ability to override this check, however, for security reasons.
							<div style="height: 25px;"></div>
							<a href="<?php echo $root; ?>addmodule" class="siteLink"><img src="<?php echo $root; ?>buttons/pages_add.png" /> Create Module</a>
						</div>
       	        		<div class="br"></div>
       	        		<?php
       	        		$getModules = mysqli_query($con, "SELECT * FROM modules ORDER BY name ASC") OR SQLError();
       	        		while($mod = fetch($getModules)){
       	        			?>
       	        			<div style="border-radius: 4px; background: #fff; color: #000; border: 1px solid #ccc; padding: 4px; width: 95%; margin-left: 2%;" id="m<?php echo $mod["id"]; ?>">
       	        			<img src="<?php echo $root; ?>buttons/bullet_add.png" id="icon<?php echo $mod["id"]; ?>" style="cursor: pointer;" 
       	        			onclick="showSection('mod<?php echo $mod["id"]; ?>');" /> 
       	        			&nbsp; &nbsp; <span style="font-weight: bold; font-size: 16px;"><?php echo stripslashes($mod["name"]); ?></span>
       	        			<div style="text-align: right;">
       	        				<?php echo dateFormat($mod["posted"]);
       	        				      if(checkPerms(4) OR isMe($mod["userid"])){
       	        				      	echo "<br /> &nbsp; &nbsp; <a href=\"".$root."editmodule/".$mod["id"]."\" class=\"siteLink\"><img src=\"".$root."buttons/pages_modify.png\" style=\"height: 16px; width: 16px;\" /> Modify</a> &nbsp; &nbsp; <a href=\"".$root."deletemodule/".$mod["id"]."\" onclick=\"return confirm('Are you sure you you wish to delete this module?');\"><img src=\"".$root."buttons/pages_delete.png\" style=\"height: 16px; width: 16px;\" /> Delete</a>";
       	        				      }
       	        				?>
       	        			</div>
       	        			<div style="background: #eee; border: 1px solid #bbb; border-radius: 4px; padding: 4px; display: none;" id="mod<?php echo $mod["id"]; ?>">
       	        			<strong>About:</strong> <br /> <?php echo stripslashes($mod["about"]); ?>
       	        			<br /><br />
       	        			<strong>Alias:</strong> ${mod:<?php echo $mod["m_alias"]; ?>}
       	        			</div>
       	        			</div>
       	        			<div class="br"></div>
       	        			<?php
       	        		}
       	        		break;
       	        		case 'addmodule':
       	        		AuthCheck(3);
       	        		changeTitle("Adding Module");
       	        		if(isset($_POST["submit"])){
       	        			$check = sql("SELECT id FROM modules WHERE m_alias = '".addslashes($_POST["alias"])."'");
       	        			if($check["id"] != ""){
       	        				errMsg("This alias already exists - please press Backspace and choose another.");
       	        			}
       	        			query($con, "INSERT INTO modules(name,m_alias,userid,about,content)VALUES('".addslashes($_POST["name"])."', '".addslashes($_POST["alias"])."', '".$_COOKIE["id"]."','".addslashes($_POST["about"])."', '".addslashes($_POST["content"])."')");
       	        			loguser($_COOKIE["id"],"created a new module.");
       	        			header("Location: ".$root."/modules");
       	        		}
       	        		?>
						<div style="margin-left: 2%;">
       	        		<div style="padding: 2px;">&laquo; <a href="<?php echo $root; ?>page/modules" style="font-size: 12px !important;" class="siteLink" id="sl">Module Manager</a></div>
       	        		<h1>Adding Module</h1>
       	        		Use this page to create a new module - a tool to essentially add external HTML to your pages (with limited server-scripting as well).
       	        		<div style="height: 5px;"></div>
       	        		<form action="<?php echo $root; ?>addmodule" method="post">
       	        		<p>
							<label class="formLabel" for="name">Name:</label> <br />
       	        			<input type="text" size="35" name="name" id="modName" class="form-control" required="1" />
       	        			<div style="padding: 2px; font-size: 12px;">The name of your module as it will appear in the list.</div>
       	        		</p>
       	        		<p>
       	        			<label class="formLabel" for="alias">Alias:</label> <br />
       	        				<input type="text" size="15" maxlength="10" name="alias" id="modAlias" class="form-control" />
       	        				<div style="padding: 2px; font-size: 12px;">
       	        				The alias determines how you will reference the module within your pages.
       	        				</div>
       	        		</p>
       	        		<p>
       	        			<label class="formLabel" for="about">About:</label> <br />
       	        				<textarea cols="60" rows="5" class="form-control" name="about" id="modAbout" class="form-control"></textarea>
       	        				<div style="padding: 2px; font-size: 12px;">Tell the other staff and admins an accurate description of what this module is for.
       	        				Modules without descriptions will more than likely be deleted.</div>
       	        		</p>
       	        		<p>
       	        			<label class="formLabel" for="content">Content:</label> <br />
       	        				<textarea cols="60" rows="15" name="content" id="modContent" class="form-control"></textarea>
       	        				<div style="padding: 2px; font-size: 12px;">
       	        				The coding for your module goes here - this is the heart of it and what will make it function. 
       	        				Write carefully and neatly.
       	        				</div>
       	        		</p>
       	        		<p style="text-align: center;">
							<button type="submit" name="submit" id="fw" class="formButton form-control">Finish Module</button>
       	        		</p>
       	        		</form>
						</div>
       	        		<?php
       	        		break;
       	        		case 'editmodule':
       	        		AuthCheck(3);
       	        		idCheck();
       	        		$data = sql("SELECT * FROM modules WHERE id = '".GET("id")."'");
       	        		if(!isMe($data["userid"]) AND !checkPerms(4)){
       	        			unauthorized();
       	        		}
       	        		changeTitle("Modifying Module");
       	        		if(isset($_POST["submit"])){
       	        			$check = sql("SELECT id FROM modules WHERE m_alias = '".addslashes($_POST["alias"])."' AND m_alias != '".$data["m_alias"]."'");
       	        			if($check["id"] != ""){
       	        				errMsg("Sorry, this module already exists. Please press backspace and try again.");
       	        			}
       	        			query($con, "UPDATE modules SET name = '".addslashes($_POST["name"])."', m_alias = '".addslashes($_POST["alias"])."', about = '".addslashes($_POST["about"])."', content = '".addslashes($_POST["content"])."', last_modified_by = '".$_COOKIE["id"]."' WHERE id = '".GET("id")."'");
       	        			loguser($_COOKIE["id"],"modified the site's ".addslashes($_POST["name"])."' module.");
       	        			forumMsg("Your module was modified successfully.");
       	        			header("Refresh: 1; ".$root."page/modules");
       	        		}else{
       	        		?>
						<div style="margin-left: 2%;">
       	        		<div style="padding: 2px;">&laquo; <a href="<?php echo $root; ?>page/modules" style="font-size: 12px !important;" class="siteLink" id="sl">Module Manager</a></div>
       	        		<?php
       	        			if($data["last_modified_by"] != 0){
       	        			?>
       	        			<div style="padding: 2px;">
       	        			This module was last modified by <?php echo getDisplay($data["last_modified_by"]); ?> on <?php echo dateFormat($data["last_modified"]); ?>.
       	        			</div>
       	        			<?php
       	        			}
       	        		?>
       	        		<h1>Modifying Module</h1>
       	        		Use this page to create a new module - a tool to essentially add external HTML to your pages (with limited server-scripting as well).
       	        		<div style="height: 25px;"></div>
       	        		<form action="" method="post">
       	        		<p>
							<label class="formLabel" for="name">Name:</label> <br />
       	        			<input type="text" value="<?php echo stripslashes($data["name"]); ?>" class="form-control" size="35" name="name" id="modName" />
       	        			<div style="padding: 2px; font-size: 12px;">
       	        			The name of your module as it will appear in the list.
       	        			</div>
       	        		</p>
       	        		<p>
       	        			<label class="formLabel" for="alias">Alias:</label> <br />
       	        				<input type="text" size="15" value="<?php echo stripslashes($data["m_alias"]); ?>" maxlength="10" name="alias" id="modAlias" class="form-control" />
       	        				<div style="padding: 2px; font-size: 12px;">
       	        				The alias determines how you will reference the module within your pages.
       	        				</div>
       	        		</p>
       	        		<p>
       	        			<label class="formLabel" for="about">About:</label> <br />
       	        				<textarea cols="60" rows="5" name="about" id="modAbout" class="form-control"><?php echo stripslashes($data["about"]); ?></textarea>
       	        				<div style="padding: 2px; font-size: 12px;">
       	        				Tell the other staff and admins an accurate description of what this module is for.
       	        				Modules without descriptions will more than likely be deleted.
       	        				</div>
       	        		</p>
       	        		<p>
       	        			Content: <br />
       	        				<textarea cols="60" rows="15" name="content" id="modContent" class="form-control"><?php echo stripslashes($data["content"]); ?></textarea>
       	        				<div style="padding: 2px; font-size: 12px;">
       	        				The coding for your module goes here - this is the heart of it and what will make it function. 
       	        				Write carefully and neatly.
       	        				</div>
       	        		</p>
       	        		<p style="text-align: center;">
							<button type="submit" name="submit" id="fw" class="formButton form-control">Save Changes</button>
       	        		</p>
       	        		</form>
						</div>
       	        		<?php
       	        		}
       	        		break;
       	        		case 'deletemodule':
       	        		AuthCheck(3);
       	        		idCheck();
       	        		$data = sql("SELECT userid,name FROM modules WHERE id = '".GET("id")."'");
       	        		if(!isMe($data["userid"]) AND !checkPerms(4)){
       	        			unauthorized();
       	        		}
       	        		query($con, "DELETE FROM modules WHERE id = '".GET("id")."'");
       	        		loguser($_COOKIE["id"],"deleted the [b]".$data["name"]."[/b] module.");
       	        		header("Location: ".$root."page/modules");
       	        		break;
						case 'createpcategory':
						case 'createcategory':
       	        		AuthCheck(4);
       	        		changeTitle("Create Category");
       	        		if(isset($_POST["submit"])){
							query($con, "INSERT INTO page_categories(name,alias,about,userid,pc)VALUES('".addslashes($_POST["name"])."','".$_POST["aliasID"]."','".addslashes($_POST["about"])."','".$_COOKIE["id"]."','".$_POST["pc"]."')");
							toLoc($root."page/managecategories");
       	        		}else{
       	        		?>
						<div style="margin-left: 2%;">
       	        		<h1>Creating Category</h1>
       	        		You may create a new category for web site pages by filling out the form below.
       	        		<div class="br"></div>
       	        		<form action="" method="post">
       	        		<p>
							<label class="formLabel" for="name">Name:</label> &nbsp; &nbsp; &nbsp; <input type="text" name="name" class="form-control" required="1" placeholder="Enter name.." />
							<div>This is what the category will show up as.</div>
						</p>
       	        		<p>
							<label class="formLabel" for="aliasID">AliasID:</label> &nbsp; &nbsp; <input type="text" name="aliasID" class="form-control" required="1" placeholder="Enter alias.." />
							<div>The AliasID is essentially a unique identifier for the page -- give it one that another page <strong>does not</strong> have.</div>
						</p>
						<p>
							<label class="formLabel" for="pc">Parent Category:</label>
							&nbsp; &nbsp;
							<select name="pc" class="form-control">
								<option value="0">None</option><?php
									$getCategories = mysqli_query($con, "SELECT * FROM page_categories ORDER BY name ASC") OR SQLError();
									while($c = fetch($getCategories)){
										echo '<option value="'.$c["id"].'">'.stripslashes($c["name"]).'</option>';
									}
								?>
							</select>
						</p>
						<p>
							<label class="formLabel" for="about">About:</label><br />
							<textarea cols="50" rows="5" name="about" id="txtAbout" required="1" placeholder="Enter description.." class="form-control"></textarea>
						</p>
						<div>
							<button type="submit" name="submit" id="create" class="formButton form-control">Create Category</button>
						</div>
       	        		</form>
						</div>
       	        		<?php
       	        		}
       	        		break;
						case 'editpcategory':
						case 'editcategory':
       	        		AuthCheck(3);
						idCheck;
						$data = sql("SELECT * FROM page_categories WHERE id = '".$_GET["id"]."'");
       	        		changeTitle("Editing Category: ".stripslashes($data["name"]));
       	        		if(isset($_POST["submit"])){
							query($con, "UPDATE page_categories SET name = '".addslashes($_POST["name"])."', alias = '".$_POST["aliasID"]."', about = '".addslashes($_POST["about"])."', userid = '".$_COOKIE["id"]."', pc = '".$_POST["pc"]."' WHERE id = '".$_GET["id"]."'");
							logUser($_COOKIE["id"],"modified an existing page category.");
							toLoc($root."page/managecategories");
       	        		}else{
       	        		?>
						<div style="margin-left: 2%;">
       	        		<h1>Editing Category: <?php echo stripslashes($data["name"]); ?></h1>
       	        		You may create a new category for web site pages by filling out the form below.
       	        		<div class="br"></div>
       	        		<form action="<?php echo $root; ?>editpcategory/<?php echo $_GET["id"]; ?>" method="post">
       	        		<p>
							<label class="formLabel" for="name">Name:</label> &nbsp; &nbsp; &nbsp; <input type="text" name="name" value="<?php echo stripslashes($data["name"]); ?>" class="form-control" required="1" placeholder="Enter name.." />
							<div>This is what the category will show up as.</div>
						</p>
       	        		<p>
							<label class="formLabel" for="aliasID">AliasID:</label> &nbsp; &nbsp; <input type="text" name="aliasID" value="<?php echo $data["alias"]; ?>" class="form-control" required="1" placeholder="Enter alias.." />
							<div>The AliasID is essentially a unique identifier for the page -- give it one that another page <strong>does not</strong> have.</div>
						</p>
						<p>
							<label class="formLabel" for="pc">Parent Category:</label>
							&nbsp; &nbsp;
							<select name="pc" class="form-control">
								<option value="0">None</option><?php
									$getCategories = mysqli_query($con, "SELECT * FROM page_categories ORDER BY name ASC") OR SQLError();
									while($c = fetch($getCategories)){
										echo '<option value="'.$c["id"].'"';
										if($data["pc"] == $c["id"]){
											echo ' selected="1"';
										}
										echo '>'.stripslashes($c["name"]).'</option>';
									}
								?>
							</select>
						</p>
						<p>
							<label class="formLabel" for="about">About:</label><br />
							<textarea cols="50" rows="5" name="about" id="txtAbout" required="1" placeholder="Enter description.." class="form-control"><?php echo stripslashes($data["about"]); ?></textarea>
						</p>
						<div style="text-align: center;">
							<button type="submit" name="submit" id="create" class="formButton form-control">Save Changes</button>
						</div>
       	        		</form>
						</div>
       	        		<?php
       	        		}
       	        		break;
						case 'deletepcategory':
						case 'deletecategory':
							AuthCheck(4);
							idCheck();
							query($con, "DELETE FROM page_categories WHERE id = '".$_GET["id"]."'");
							logUser($_COOKIE["id"],"deleted a site category.");
							header("Location: ".$root."page/managecategories");
						break;
						case 'managepages':
       	        		AuthCheck(3);
       	        		changeTitle("Page Manager");
						$getPages = mysqli_query($con, "SELECT * FROM pages ORDER BY title ASC") OR SQLError();
       	        		?>
						<div style="margin-left: 2%;">
						<a href="<?php echo $root; ?>admin" class="siteLink">&laquo; Control Panel</a>
       	        		<h2> &raquo; Page Manager</h2>
						<img src="<?php echo $root; ?>buttons/page_add.png" class="icon" /> <a href="<?php echo $root; ?>createpage" class="siteLink">Create Page</a>
						<div class="brl"></div>
						<img src="<?php echo $root; ?>buttons/flashdisk.png" class="icon" /> <a href="<?php echo $root; ?>import" class="siteLink">Import Page</a>
						<div class="brl"></div>
       	        		<img src="<?php echo $root; ?>buttons/folder.png" class="icon" /> <a href="<?php echo $root; ?>page/managecategories" class="siteLink">Page Categories</a>
						<div class="br"></div>
							<?php
								while($p = fetch($getPages)){
									echo '<div style="font-weight: bold; font-size: 14px;">
										&nbsp; &nbsp; 
										<a href="'.$root.'exportpage/'.$p["alias"].'" class="nWin"><img src="'.$root.'buttons/flashdisk_2.png" class="icon" /></a>
										<a href="'.$root.'editpage/'.$p["id"].'"><img src="'.$root.'buttons/edit_button.png" class="icon" /></a>
										<a href="'.$root.'deletepage/'.$p["id"].'"><img src="'.$root.'buttons/cancel.png" class="icon" /></a>
										<a href="'.$root.'p/'.$p["alias"].'" class="siteLink nWin">'.stripslashes($p["title"]).'</a>
										<span style="font-weight: normal; font-size: 12px;">
										by '.getDisplay($p["userid"]).'
										on '.dateFormat($p["posted"]).'
										</span>
										';
									$clr = ($p["published"]) ? "0d0" : "f00";
									$published = ($clr == "0d0") ? "Published" : "Unpublished";
									echo '<div style="color: #'.$clr.'; font-weight: bold;">
											 &nbsp; &nbsp; '.$published.'
										  </div>
										  <div class="br"></div>
									';
										echo '
									</div>';
								}
							?>
						</div>
       	        		<?php
       	        		break;
       	        		case 'managecategories':
       	        		AuthCheck(3);
       	        		changeTitle("Category Manager");
						$getPCs = mysqli_query($con, "SELECT id,name,userid,posted FROM page_categories WHERE pc = 0 ORDER BY name ASC") OR SQLError();
       	        		?>
						<div class="brl"></div>
						<div style="margin-left: 2%;">
						<a href="<?php echo $root; ?>page/managepages" class="siteLink">&laquo; Pages</a>
       	        		<h2> &raquo; Page Categories</h2>
       	        		 <a href="<?php echo $root; ?>createpcategory" class="siteLink"><img src="<?php echo $root; ?>buttons/folder_add.png" class="icon" /> Create Category</a>
						</div>
						<div class="brm"></div>
       	        		<?php
						while($c = fetch($getPCs)){
							echo '<div style="font-weight: bold; font-size: 14px;">
									&nbsp; &nbsp;
									<a href="'.$root.'editpcategory/'.$c["id"].'"><img src="'.$root.'buttons/edit_button.png" class="icon" /></a>
									<a href="'.$root.'deletepcategory/'.$c["id"].'" onclick="return confirm(\'Are you sure you wish to delete this category? This action cannot be undone.\');"><img src="'.$root.'buttons/cancel.png" class="icon" /></a>
									'.stripslashes($c["name"]).'
									<span style="font-weight: normal; font-size: 12px;">by '.getDisplay($c["userid"]).' on '.dateFormat($c["posted"]).'</span>
									';
									$getSubs = mysqli_query($con, "SELECT id,name,userid,posted FROM page_categories WHERE pc = '".$c["id"]."' ORDER BY name ASC") OR SQLError();
									while($s = fetch($getSubs)){
										echo '<div class="brl"></div>
										<div style="font-weight: bold; font-size: 12px; margin-left: 4%;">
											&nbsp; &nbsp;
											<a href="'.$root.'editpcategory/'.$s["id"].'"><img src="'.$root.'buttons/edit_button.png" class="icon" /></a>
											<a href="'.$root.'deletepcategory/'.$s["id"].'" onclick="return confirm(\'Are you sure you wish to delete this category? This action cannot be undone.\');"><img src="'.$root.'buttons/cancel.png" class="icon" /></a>
											'.stripslashes($s["name"]).'
											<span style="font-weight: normal; font-size: 12px;">by '.getDisplay($s["userid"]).' on '.dateFormat($s["posted"]).'</span>
										</div>';
									}
							echo '
							</div>
							<div class="brm"></div>';
						}
       	        		break;
						case 'page':
							//idCheck();
							//$data = sql("SELECT * FROM pages WHERE id = '".$_GET["id"]."'");
							if(!$_GET["id"]){
								invData();
							}
							$alias = sqlEsc($_GET["id"]);
							$q = (checkPerms(3)) ? "" : " AND published";
							$qr = "SELECT * FROM pages WHERE alias = '".$alias."'".$q;
							$data = sql($qr);
							changeTitle(stripslashes($data["title"]));
							echo '<div class="title topBorder">&nbsp;</div>
							<div class="pageContent mainbg">';
							if($data["id"] == ""){
								echo "
									<img src='".$root."buttons/cancel.png' class='icon' /> 
									<strong>Error: </strong> This page does not exist.";
							}else{
							if(!$data["published"] AND checkPerms(3)){
								echo "<div style='margin-left: 2%;'>
									<img src='".$root."buttons/cancel.png' class='icon' />
									<strong>NOTE:</strong> This page is unpublished. It is not visible to regular users or guests.
									</div>";
							}
							echo '
								<h2 class="headline">'.stripslashes($data["title"]).'</h2>';
								if(checkPerms(3)){
									?>
									<div class="brl"></div>
									<div class="formButton" style="margin-left: 2%;">
										<a href="<?php echo $root; ?>export/<?php echo $_GET["id"]; ?>" style="color: #fff;">Export Page</a>
									</div>
									<div class="brl"></div>
									<?php
								}
								$tags = explode(",",$data["tags"]);
								if($data["tags"] != ""){
								echo '<div>
									 &nbsp; &nbsp; <strong>Tags:</strong> ';
								foreach($tags as $tag){
									echo ' &nbsp; <img src="'.$root.'buttons/tag_red.png" class="icon" /> <a href="'.$root.'page/tag/'.stripslashes(strtolower(ltrim($tag))).'">'.stripslashes($tag).'</a>';
								}
								echo '</div>
								<div class="brl"></div>';
								}
								echo '
								<div class="tinyText">
									Author: '.getDisplay($data["userid"]);
								echo '
								</div>
								<div class="tinyText">
									Posted: '.dateFormat($data["posted"]).'
								</div>';
								if(checkPerms(3)){
									echo '<div class="tinyText">
											<a href="'.$root.'page/editpage/'.$data["id"].'" class="siteLink"><img src="'.$root.'buttons/edit_button.png" class="icon" /> Edit</a>
											 &nbsp; &nbsp; &nbsp; &nbsp; 
											<a href="'.$root.'page/deletepage/'.$data["id"].'" class="siteLink" onclick="return confirm(\'Are you sure you wish to delete this page? This action cannot be undone.\');"><img src="'.$root.'buttons/cancel.png" class="icon" /> Delete</a>
									</div>';
								}
								echo '
								<div class="br"></div>
								<div class="pageSub">
									'.pageContent($data["content"]).'
								</div>
							</div>
							<div style="margin-left: 2%; display: none;">';
									if(online()){
										?>
										<form action="<?php echo $root; ?>p/<?php echo $_GET["id"]; ?>" method="post">
											<label for="content" class="formLabel">Content:</label>
											<br />
											<textarea cols="79" rows="6" name="content" class="form-control" id="txtContent" required="1" placeholder="Enter comment..."></textarea>
											<br />
											<button type="submit" name="buttonSubmit" id="btnSubmit" class="formButton form-control">Post</button>
										</form>
										<?php
									}else{
										echo 'Log In or Sign Up to post a comment.';
									}
								}
							echo '</div>';
						break;
						case 'createpage':
							AuthCheck(3);
							changeTitle("Create Page");
							if(isset($_POST["buttonSubmit"])){
								query($con, "INSERT INTO pages(title,pc_id,userid,content,alias,tags)VALUES('".addslashes($_POST["title"])."','".$_POST["category_id"]."','".$_COOKIE["id"]."','".addslashes($_POST["content"])."','".strtolower($_POST["alias"])."','".$_POST["tags"]."');");
								$n = mysqli_insert_id();
								logUser($_COOKIE["id"],"created a new page.");
								header("Location: ".$root."p/".strtolower($_POST["alias"]));
							}
						?>
							<div style="margin-left: 2%;">
								<div class="brl"></div>
								<a href="<?php echo $root; ?>page/managepages" class="siteLink">&laquo; Page Manager</a>
								<h2> &raquo; Create Page</h2>
								<form action="<?php echo $root; ?>createpage" method="post">
								<div class="p">
									<label class="formLabel" for="title">Title:</label>
									<div class="brl"></div>
									<input type="text" name="title" id="txtTitle" required="1" class="form-control" size="50" placeholder="Enter title.." />
								</div>
								<div class="brm"></div>
								<div class="p">
									<label class="formLabel" for="category_id">Category:</label>
									<br />
									<?php
										$getCtgs = mysqli_query($con, "SELECT * FROM page_categories ORDER BY name ASC") OR SQLError();
										if(mysqli_num_rows($getCtgs) > 0){
											echo '<select name="category_id" class="form-control" required="1" id="cid">
												<option value="">---------------------</option>';
											while($ci = fetch($getCtgs)){
												echo '<option value="'.$ci["id"].'">'.stripslashes($ci["name"]).'</option>';
											}
											echo '</select>';
										}else{
											echo 'No categories have been added yet.<br /><a href="'.$root.'createpcategory" class="siteLink">Add One</a>!';
										}
									?>
								</div>
								<div class="brm"></div>
								<div class="p">
									<label class="formLabel" for="alias">AliasID:</label>
									<div class="brl"></div>
									<input type="text" name="alias" id="txtAlias" required="1" class="form-control" size="50" placeholder="Enter aliasID.." />
								</div>
								<div class="brm"></div>
								<label class="formLabel" for="published">Visibility:</label>
								<div class="brl"></div>
								<select name="published" class="form-control">
									<option value="0">Unpublished</option>
									<option value="1">Published</option>
								</select>
								<div class="brm"></div>
								<div class="p">
									<label class="formLabel" for="content">Content:</label>
									<div class="brl"></div>
									<textarea cols="100" rows="16" name="content" id="txtContent" required="1" class="form-control" placeholder="Enter content..">&nbsp;</textarea>
								</div>
								<div class="brm"></div>
									<label for="tags" class="formLabel">Tags:</label>
									<div class="brl"></div>
									<input type="text" name="tags" id="txtTags" class="form-control" size="62" />
									<div class="tinyText mainbg">Please separate each tag with a comma.</div>
								<div class="brm"></div>
								<div class="p">
									<button type="submit" class="form-control formButton" name="buttonSubmit" id="btnSubmit">Save & Finish</button>
								</div>
								</form>
							</div>
							<script src="<?php echo $root; ?>scripts/nicEdit.js" type="text/javascript"></script>
							<script type="text/javascript">
							<!--
							//bkLib.onDomLoaded(nicEditors.allTextAreas);
							new nicEditor({
								fullPanel: true
							}).panelInstance('txtContent');
							// -->
							</script>
						<?php
						break;
						case 'editpage':
							AuthCheck(3);
							idCheck();
							$data = sql("SELECT * FROM pages WHERE id = '".$_GET["id"]."'");
							changeTitle("Editing Page: ".stripslashes($data["title"]));
							if(isset($_POST["buttonSubmit"])){
								$pb = $_POST["published"];
								query($con, "UPDATE pages SET title = '".addslashes($_POST["title"])."', pc_id = '".$_POST["category_id"]."', userid = '".$_COOKIE["id"]."', content = '".addslashes($_POST["content"])."', alias = '".strtolower($_POST["alias"])."', published = '".$pb."', tags = '".addslashes($_POST["tags"])."' WHERE id = '".$_GET["id"]."'");
								//$n = $_GET["id"];
								$n = strtolower($_POST["alias"]);
								logUser($_COOKIE["id"],"modified an existing page.");
								header("Location: ".$root."p/".$n);
							}
						?>
							<div style="margin-left: 2%;">
								<div class="brl"></div>
								<a href="<?php echo $root; ?>page/managepages" class="siteLink">&laquo; Page Manager</a>
								<h2> &raquo; Editing Page: <?php echo stripslashes($data["title"]); ?></h2>
								<form action="<?php echo $root; ?>editpage/<?php echo $_GET["id"]; ?>" method="post">
								<div class="p">
									<label class="formLabel" for="title">Title:</label>
									<div class="brl"></div>
									<input type="text" value="<?php echo stripslashes($data["title"]); ?>" name="title" id="txtTitle" required="1" class="form-control" size="50" placeholder="Enter title.." />
								</div>
								<div class="brm"></div>
								<div class="p">
									<label class="formLabel" for="category_id">Category:</label>
									<br />
									<?php
										$getCtgs = mysqli_query($con, "SELECT id,name FROM page_categories ORDER BY name ASC") OR SQLError();
										if(mysqli_num_rows($getCtgs) > 0){
											echo '<select name="category_id" class="form-control" required="1" id="cid">
												<option value="">---------------------</option>
												<option value="101010">Unlisted</option>';
											while($ci = fetch($getCtgs)){
												echo '<option value="'.$ci["id"].'"';
												if($ci["id"] == $data["pc_id"]){
													echo ' selected=\"1\"';
												}
												echo '>'.stripslashes($ci["name"]).'</option>';
											}
											echo '</select>';
										}else{
											echo '<strong>No categories have been added yet.<br /><a href="'.$root.'createpcategory" class="siteLink">Add One</a>!';
										}
									?>
								</div>
								<div class="brm"></div>
								<div class="p">
									<label class="formLabel" for="alias">AliasID:</label>
									<div class="brl"></div>
									<input type="text" name="alias" value="<?php echo $data["alias"]; ?>" id="txtAlias" required="1" class="form-control" size="50" placeholder="Enter aliasID.." />
								</div>
								<div class="brm"></div>
								<label class="formLabel" for="published">Visibility:</label>
								<div class="brl"></div>
								<select name="published" class="form-control">
									<option value="1"<?php if($data["published"]) echo ' selected="1"'; ?>>Published</option>
									<option value="0"<?php if(!$data["published"]) echo ' selected="1"'; ?>>Unpublished</option>
								</select>
								<div class="brm"></div>
								<div class="p">
									<label class="formLabel" for="content">Content:</label>
									<div class="brl"></div>
									<textarea cols="100" rows="16" name="content" id="txtContent" required="1" class="form-control" placeholder="Enter content.."><?php echo stripslashes($data["content"]); ?></textarea>
								</div>
								<div class="brm"></div>
									<label for="tags" class="formLabel">Tags:</label>
									<div class="brl"></div>
									<input type="text" name="tags" value="<?php echo stripslashes($data["tags"]); ?>" id="txtTags" class="form-control" size="62" />
									<div class="tinyText mainbg">Please separate each tag with a comma.</div>
								<div class="brm"></div>
								<div>
									<button type="submit" class="form-control formButton" name="buttonSubmit" id="btnSubmit">Save & Finish</button>
								</div>
								</form>
							</div>
							<script src="<?php echo $root; ?>scripts/nicEdit.js" type="text/javascript"></script>
							<script type="text/javascript">
							//bkLib.onDomLoaded(nicEditors.allTextAreas);
							new nicEditor({
								fullPanel: true
							}).panelInstance('txtContent');
							</script>
						<?php
						break;
						case 'deletepage':
							idCheck();
							query($con, "DELETE FROM pages WHERE id = '".$_GET["id"]."'");
							logUser($_COOKIE["id"],"deleted a site page.");
							header("Location: ".$root."page/managepages");
						break;
						case 'database':
							AuthCheck(5);
							echo '<div style="margin-left: 2%; margin-top: 2%;"> <img src="buttons/bullet_error.png" /> This feature is under construction and will likely not be completed any time soon.</div>';
						break;
						case 'config':
							AuthCheck(4);
							changeTitle("Global Settings");
							?>
							<div style="margin-left: 2%;">
								<img src="<?php echo $root; ?>buttons/bullet_error.png" /> This page is currently under construction.
							</div>
							<?php
						break;
						case 'checkpin':
							if(!isset($_POST["pinSubmit"])) header("Location: /");
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
								toLoc("forum.php");
							}else{
								header("Refresh: 1; forum.php?act=login");
								errMsg("The information entered was incorrect. You will be redirected to the log-in screen.");
							}
						break;
						case 'mobile':
							AuthCheck(4);
						break;
						case 'layoutmanager':
							AuthCheck(4);
							changeTitle("Layout Manager");
							?>
								<a href="<?php echo $root; ?>admin">&laquo; Control Panel</a>
								<h2 class="headline">Layout Manager</h2>
								<div class="brl"></div>
								<div style="margin-left: 4%;">
									<a href="<?php echo $root; ?>createlayout">Create Layout</a>
									<div class="brl"></div>
									<strong>Current Layouts:</strong>
									<div style="margin-left: 2%; padding: 4px;">
										<div class="brl"></div>
										<?php
										$getLayouts = mysqli_query($con, "SELECT id,name FROM layouts ORDER BY name ASC") OR SQLError();
										while($l = fetch($getLayouts)){
											echo '<div class="brl"></div> &nbsp; <a href="'.$root.'editlayout/'.$l["id"].'"><img src="'.$root.'buttons/edit_button.png" class="icon" /></a> <a href="'.$root.'deletelayout/'.$l["id"].'"><img src="'.$root.'buttons/cancel.png" class="icon" /></a> '.stripslashes($l["name"]);
										}
										?>
									</div>
								</div>
							<?php
						break;
						case 'editlayout':
							AuthCheck(4);
							changeTitle("Edit Layout");
							idCheck();
							$data = sql("SELECT * FROM layouts WHERE id = '".$_GET["id"]."'");
							if(isset($_POST["submit"])){
								if($_POST["main"] == "1"){
									query($con, "UPDATE layouts SET default_layout = 0 WHERE default_layout = 1");
								}
									query($con, "UPDATE layouts SET name = '".addslashes($_POST["name"])."', stylesheet = '".addslashes($_POST["style"])."', banner_img = '".$_POST["banner"]."', default_layout = 1 WHERE id = '".$_GET["id"]."'");
									logUser($_COOKIE["id"],"modified a site skin.");
									header("Location: ".$root."page/layoutmanager");
							}else{
								?>
								<a href="<?php echo $root; ?>page/layoutmanager">&laquo; Layout Manager</a>
								<h2>Edit Layout</h2>
								<form action="<?php echo $root; ?>editlayout/<?php echo $_GET["id"]; ?>" method="post">
									<fieldset style="width: 95%; border-radius: 4px;">
										<legend style="text-decoration: underline;">Layout Form</legend>
										<div class="brl"></div>
										<label for="name" class="formLabel">Name:</label>
										<div class="brl"></div>
										<input type="text" name="name" value="<?php echo stripslashes($data["name"]); ?>" id="txtName" style="width: 35%;" required="1" class="form-control" />
										<div class="brm"></div>
										<label for="style" class="formLabel">Stylesheet:</label>
										<div class="brl"></div>
										<textarea cols="120" rows="20" name="style" id="txtStyle" required="1" class="form-control"><?php echo stripslashes($data["stylesheet"]); ?></textarea>
										<div class="brm"></div>
										<label for="banner" class="formLabel">Banner:</label>
										<div class="brl"></div>
										<input type="text" name="banner" value="<?php echo stripslashes($data["banner_img"]); ?>" style="width: 35%;" id="txtBanner" required="1" class="form-control" />
										<div class="brm"></div>
										<label for="main" class="formLabel">Default Layout:</label>
										<select name="main" class="form-control">
											<option value="0"<?php if($data["default_layout"] == 0){ echo ' selected="1"'; } ?>>No</option>
											<option value="1"<?php if($data["default_layout"] == 1){ echo ' selected="1"'; } ?>>Yes</option>
										</select>
										<div class="brm"></div>
										<button type="submit" class="formButton form-control" name="submit" id="btnSubmit">Save Changes</button>
									</fieldset>
								</form>
								<?php
							}
						break;
						case 'deletelayout':
							AuthCheck(4);
							idCheck();
							query($con, "DELETE FROM layouts WHERE id = '".$_GET["id"]."'");
							logUser($_COOKIE["id"],"deleted a site layout.");
						break;
						case 'createlayout':
							AuthCheck(4);
							changeTitle("Create Layout");
							if(isset($_POST["submit"])){
								if($_POST["main"] == "1"){
									query($con, "UPDATE layouts SET default_layout = 0 WHERE default_layout = 1 AND id != ".$_GET["id"]);
								}
									query($con, "INSERT INTO layouts(name,stylesheet,banner_img,default_layout)VALUES('".addslashes($_POST["name"])."','".addslashes($_POST["style"])."','".$_POST["banner"]."','".$_POST["main"]."')");
									logUser($_COOKIE["id"],"made a new site skin.");
									header("Location: ".$root."page/layoutmanager");
							}else{
								?>
								<a href="<?php echo $root; ?>page/layoutmanager">&laquo; Layout Manager</a>
								<h2>Create Layout</h2>
								<form action="<?php echo $root; ?>createlayout" method="post">
									<fieldset style="width: 95%; border-radius: 4px;">
										<legend style="text-decoration: underline;">Layout Form</legend>
										<div class="brl"></div>
										<label for="name" class="formLabel">Name:</label>
										<div class="brl"></div>
										<input type="text" name="name" id="txtName" style="width: 35%;" required="1" class="form-control" />
										<div class="brm"></div>
										<label for="style" class="formLabel">Stylesheet:</label>
										<div class="brl"></div>
										<textarea cols="120" rows="20" name="style" id="txtStyle" required="1" class="form-control"></textarea>
										<div class="brm"></div>
										<label for="banner" class="formLabel">Banner:</label>
										<div class="brl"></div>
										<input type="text" name="banner" style="width: 35%;" id="txtBanner" required="1" class="form-control" />
										<div class="brm"></div>
										<label for="main" class="formLabel">Default Layout:</label>
										<select name="main" class="form-control">
											<option value="0">No</option>
											<option value="1">Yes</option>
										</select>
										<div class="brm"></div>
										<button type="submit" class="formButton form-control" name="submit" id="btnSubmit">Finish</button>
									</fieldset>
								</form>
								<?php
							}
						break;
						case 'search':
							changeTitle("Search Pages");
							echo '<div style="margin-left: 2%;">';
							if(!isset($_POST["searchSubmit"])){
								echo "Error";
							}else{
								$t = $_POST["search"];
								$getMatches = mysqli_query($con, "SELECT * FROM pages WHERE title LIKE '%".$t."%' AND published OR tags LIKE '%".$t."%' AND published") OR SQLError();
								$nm = mysqli_num_rows($getMatches);
								echo "<strong>".FormatRes($nm,"Result").": </strong>
								<div class=\"brl\"></div>";
								if($nm == 0){
									echo "No matches were found.";
								}else{
									while($m = fetch($getMatches)){
										if(!$m["published"]) continue;
										echo "<div>
											&nbsp; &raquo; <a href=\"".$root."p/".$m["alias"]."\" style=\"font-weight: bold; font-size: 16px;\">".stripslashes($m["title"])."</a>
											<div class=\"brl\"></div>
											 &nbsp; &nbsp; &nbsp; by ".getDisplay($m["userid"])." on ".dateFormat($m["posted"])."
										</div>
										<div class=\"brl\"></div>";
									}
								}
							}
							echo '</div>';
						break;
						case 'tags':
							changeTitle("Search Tags");
							echo '<div style="margin-left: 2%;">
							<h2>Tag Search</h2>';
							if(!$_GET["filter"]){
								echo "No filter was specified.";
							}
							$getResults = mysqli_query($con, "SELECT alias,title,published,userid,posted FROM pages WHERE tags LIKE '%".sqlEsc($_GET["filter"])."%'") OR SQLError();
							$nr = mysqli_num_rows($getResults);
							echo '<strong>'.FormatRes($nr,"Result").": </strong>
								<div class='br'></div>";
								while($m = fetch($getResults)){
									if(!$m["published"]) continue;
										echo "<div>
											&nbsp; &raquo; <a href=\"".$root."p/".$m["alias"]."\" style=\"font-weight: bold; font-size: 16px;\">".stripslashes($m["title"])."</a>
											<div class=\"brl\"></div>
											 &nbsp; &nbsp; &nbsp; by ".getDisplay($m["userid"])." on ".dateFormat($m["posted"])."
										</div>
										<div class=\"brl\"></div>";
								}
							echo '</div>';
						break;
						case 'viewcategory':
							echo '<div style="margin-left: 2%;">';
							if(!$_GET["id"]){
								echo "This page does not exist.";
							}else{
								$id = sqlEsc($_GET["id"]);
								$data = sql("SELECT id,name,userid,posted FROM page_categories WHERE alias = '".$id."'");
								echo '<h2>Category: '.$data["name"].'</h2>
								<p>
									Below are the pages listed in this sub-category.
								</p>
								<div style="br"></div>';
								$getPages = mysqli_query($con, "SELECT * FROM pages WHERE pc_id = '".$data["id"]."'") OR SQLError();
								while($p = fetch($getPages)){
									echo '<div style="font-weight: bold; font-size: 14px;">
										&nbsp; &nbsp;';
										if(checkPerms(3)){
										echo '
										<a href="'.$root.'exportpage/'.$p["alias"].'" class="nWin"><img src="'.$root.'buttons/flashdisk_2.png" class="icon" /></a>
										<a href="'.$root.'editpage/'.$p["id"].'"><img src="'.$root.'buttons/edit_button.png" class="icon" /></a>
										<a href="'.$root.'deletepage/'.$p["id"].'"><img src="'.$root.'buttons/cancel.png" class="icon" /></a>';
										}
										echo '
										<a href="'.$root.'p/'.$p["alias"].'" class="siteLink nWin">'.stripslashes($p["title"]).'</a>
										<span style="font-weight: normal; font-size: 12px;">
										by '.getDisplay($p["userid"]).'
										on '.dateFormat($p["posted"]).'
										</span>
										';
									if(checkPerms(3)){
									$clr = ($p["published"]) ? "0d0" : "f00";
									$published = ($clr == "0d0") ? "Published" : "Unpublished";
									echo '<div style="color: #'.$clr.'; font-weight: bold;">
											 &nbsp; &nbsp; '.$published.'
										  </div>
										  <div class="br"></div>
									';
									}
										echo '
									</div>';
								}
							}
							echo '</div>';
						break;
						case 'importpage':
							AuthCheck(3);
							changeTitle("Importing Page");
							echo '
								<div style="margin-left: 2%;">
								<h2>Importing File</h2>
							<p>You may import a previously-exported page here.</p>';
							if(isset($_POST["submit"])){
								$ftname = $_FILES["importfile"]["tmp_name"];
								$r = file_get_contents($ftname);
								$fn = explode("\n",$r);
								$pn = explode("=",$fn[0]);
								$cn = explode("=",$fn[1]);
								$cn2 = explode("=",$fn[2]);
								$an = explode("=",$fn[3]);
								$tn = explode("=",$fn[4]);
								$pn2 = explode("=",$fn[5]);
								$pagename = $pn[1];
								$categoryalias = $cn[1];
								$categoryalias = rtrim($categoryalias);
								$content = $cn2[1];
								$alias = $an[1];
								$tags = $tn[1];
								$published = ($pn2[1] == "true") ? "1" : "0";
								$pc = sql("SELECT * FROM page_categories WHERE alias = '".$categoryalias."'");
								$categoryid = $pc["id"];
								$userid = $_COOKIE["id"];
								query($con, "INSERT INTO pages(title,pc_id,userid,content,alias,tags,published)VALUES('".addslashes($pagename)."','".$categoryid."','".$userid."','".addslashes($content)."','".strtolower($alias)."','".$tags."','".$published."');");
								$n = mysqli_insert_id();
								logUser($userid,"imported a new page.");
								echo 'Import successful. You may view the page via the <a href="'.$root.'page/managepages" class="nWin">Page Manager</a>.';
							}else{
								?>
									<form action="<?php echo $root; ?>import" method="post" enctype="multipart/form-data" id="importForm">
										<label for="importfile" class="formLabel">Import File:</label>
										<input type="file" name="importfile" class="form-control" id="txtFile" style="display: inline-block;" />
										<div class="brl"></div>
										<button type="submit" class="formButton form-control" name="submit" id="ss">Import</button>
									</form>
								<?php
							}
							echo '
								</div>';
						break;
						case 'exportpage':
							AuthCheck(3);
							changeTitle("Exporting Page");
							$data = sql("SELECT * FROM pages WHERE alias = '".sqlEsc($_GET["id"])."'");
							extract($data);
							$r = sql("SELECT alias FROM page_categories WHERE id = '".$pc_id."'");
							$aliasr = $r["alias"];
							$f = fopen("ext/".$alias.".exp","w+") OR exit("Error in creating/opening file");
							$p = ($published) ? "true" : "false";
							$c = preg_replace("/\r|\n|\r\n/","<br />",$content);
							$c = str_replace("<b>","<strong>",$c);
							$c = str_replace("</b>","</strong>",$c);
							$c = preg_replace("/&nbsp;/i"," ",$c);
							fwrite($f, "%PAGENAME%=".$title."\r\n%CATEGORY%=".$aliasr."\r\n%CONTENT%=".$c."\r\n%ALIAS%=".$alias."\r\n%TAGS%=".$tags."\r\n"."%PUBLISHED%=".$p);
							echo '<div style="margin-left: 2%;">
								<h2 class="headline">Exporting Page</h2>
								Export complete. Click the below link to view the file.
								<div class="brl"></div>
								<a href="'.$root.'ext/'.$alias.'.exp" class="nWin">'.$root.'ext/'.$alias.'.exp</a>
								<div class="brl"></div>
								Remember to save the file as <strong>'.$alias.'.exp</strong>, otherwise the import feature might not work right later. Simply copy and paste the text from one file to another.
							</div>';
						break;
						case 'backupmanager':
						case 'backups':
							AuthCheck(4);
							changeTitle("Backup Manager");
						?>
							<div style="margin-left: 2%; width: 95%;">
								<a href="<?php echo $root; ?>admin">&laquo; Control Panel</a>
								<div class="brl"></div>
								<h2>Backup Manager</h2>
								 &nbsp; &nbsp; You may use this page to run backups of the site. Note that sometimes the maximum execution time of seconds will run out, and the backup will then not be completed. It is advised to delete unnecessary files for this reason before running the backup. You have the option of backing up files and folders, or database information (content, users, posts, pages, etc.). Note that backups will <em>not</em> replace one another, and should be cleaned out/downloaded regularly, otherwise the previous backup will be included in the new backup as well, doubling its size and execution time.
								<div class="br"></div>
								<a href="<?php echo $root; ?>page/backupfiles"><img src="<?php echo $root; ?>buttons/folder_blue.png" class="icon" /> Backup Files</a>
								<div class="brl"></div>
								<a href="<?php echo $root; ?>page/backupsql"><img src="<?php echo $root; ?>buttons/database.png" class="icon" /> Backup Database</a>
							</div>
						<?php
						break;
						case 'backupfiles':
							AuthCheck(4);
							$rp = ($root == "http://localhost/zollernverse/") ? "../zollernverse" : "../zollernverse.org";
							$rootPath = realpath($rp);
							changeTitle("Site Backup");
							echo "
								<div style='margin-left: 2%;'>";
							echo '
								<a href="'.$root.'page/backupmanager">&laquo; Backup Manager</a>
								<div class="brl"></div>';
							echo "
							Archive created, access it here: ";
							echo '<a href="'.$root.'backups/backup-'.date("n-d-y").'.zip" class="nWin">'.$root.'backups/backup-'.date("n-d-y").'.zip</a><br />';
							ini_set("max_execution_time",300);//5 minutes
							ZipFolder($rootPath,$root);
							echo "</div>";
						break;
						case 'backupsql':
							AuthCheck(4);
							changeTitle("Database Backup");
							backup_sql();
						?>
							<div style="margin-left: 2%;">
								<a href="<?php echo $root; ?>page/backupmanager">&laquo; Backup Manager</a>
								<div class="brl"></div>
								<h2 class="headline">Database Backup</h2>
								<div style="margin-left: 2%;">
									SQL data has been successfully backed up. You may find the file within the backups folder.
								</div>
							</div>
						<?php
						break;
						}
						?>
					</div>
				</section>
			</section>
			<section class="spRight mainbg2 sidePanel">
				<div class="title">Member Panel</div>
						<div class="brl"></div>
				<nav>
					<div class="navLog">
						<div style="margin-left: 4%;">
						<strong>Total Members:</strong> 
							<a href="<?php echo $root; ?>forum?act=members" class="siteLink">
						<?php
							$getMembers = mysqli_query($con, "SELECT id FROM members") OR SQLError();
							$numMembers = mysqli_num_rows($getMembers);
							echo $numMembers;
						?>
						</a>
						<div style="height: 2px;"></div>
						<strong>Most Recent:</strong>
							<?php
								$member = sql("SELECT id FROM members ORDER BY id DESC LIMIT 1") OR SQLError();
								echo ubbc("[user=".$member["id"]."]");
							?>
						</div>
						<?php
						if(!online()){
							loginForm();
							?>
							<div class="menu">
								<a href="<?php echo $root; ?>forum?act=register" class="navLink whiteLink" title="We have cookies">Join Us</a>
							</div>
							<?php
						}else{
									$getMessages = mysqli_query($con, "SELECT id FROM pm WHERE touser = '".$_COOKIE["id"]."' AND unread = 'yes'");
									$nr = mysqli_num_rows($getMessages);
							?>
							<div class="menu">
								<a href="<?php echo $root; ?>forum?act=profile" class="navLink whiteLink">My Profile</a>
							</div>
							<div class="brNav"></div>
							<div class="menu">
							<?php if($nr > 0){
								echo '<img src="'.$root.'images/new.png" class="icon" /> ';
							} ?>
								<a href="<?php echo $root; ?>forum?act=inbox" class="navLink whiteLink">Inbox</a> (<?php
									echo $nr;
								?>)
							</div>
							<div class="brNav"></div>
							<div class="menu">
								<a href="<?php echo $root; ?>?p=logout" class="navLink whiteLink">&laquo; Logout</a>
							</div>
							<?php
						}
						?>
					</div>
				</nav>
			</section>
			<div style="height: 93%;"></div>
		<footer id="footer" style="display: none;">
			<!--&nbsp; &nbsp; All content on <?php echo pageContent("##title##"); ?> is copyright &copy; to its respective authors 2014 - Present (<?php echo date("Y"); ?>). -->
		</footer>
		</section>
		</div>
		<!--
		<section id="footer"><div class="sbreak"></div>All content is copyright &copy; to its respective authors. (2012 - <?php echo date("Y"); ?>)</section>
		-->
		<script type="text/javascript" src="<?php echo $root; ?>scripts/external.js"></script>
	</body>
</html>
<?php
ob_end_flush();
?>
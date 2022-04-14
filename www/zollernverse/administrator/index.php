<?php
ob_start();
	require '../functions.php';
	require '../sql.php';
	require '../startup.php';
	AuthCheck(4);
?><!doctype html>
<html lang="en" xml:lang="en" dir="ltr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script type="text/javascript" src="<?php echo $root; ?>scripts/angular.js"></script>
		<script type="text/javascript" src="<?php echo $root; ?>scripts/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $root; ?>scripts/main.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $root; ?>administrator/styles/main.css" media="all" />
		<link rel="shortcut icon" href="<?php echo $root; ?>administrator/favicon.ico" />
		<title>zTech+ Admin</title>
	</head>
	<body>
		<section class="cmsContainer">
			<section class="cmsHeader">
			<div class="cmsLogo" onclick="location.href='<?php echo $root; ?>administrator/';">&nbsp;</div>
			<div class="br"></div>
				<div class="cmsTitle">
					Administration
				</div>
				<section class="cmsNav">
					&nbsp; &nbsp; 
					<div class="cmsMenuItem">
						<span class="mainLink"><a href="<?php echo $root; ?>administrator">Home</a></span>
					</div>
					&nbsp; &nbsp;
					&nbsp; &nbsp;
					<div class="cmsMenuItem" onmouseover="$('#cmsSub1').show();" onmouseout="$('#cmsSub1').hide();">
						<span class="mainLink">Managers</span>
						<div class="cmsSubMenuItem" onmouseout="$(this).hide();" id="cmsSub1">
							 &nbsp; <a href="<?php echo $root; ?>administrator/pages" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/page.png" class="icon" /> Page Manager</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/menus" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/menu.png" class="icon" /> Menu Manager</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/media" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/image.png" class="icon" /> Media Manager</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/modules" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/script_binary.png" class="icon" /> Module Manager</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/backups" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/backups.png" class="icon" /> Backup Manager</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/layouts" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/layout.png" class="icon" /> Layout Manager</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/meta" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/globe_place.png" class="icon" /> Meta Manager</a>
							 <div class="br"></div>
						</div>
					</div>
					&nbsp; &nbsp;
					&nbsp; &nbsp;
					<div class="cmsMenuItem" onmouseover="$('#cmsSub2').show();" onmouseout="$('#cmsSub2').hide();">
						<span class="mainLink">Content</span>
						<div class="cmsSubMenuItem" onmouseout="$(this).hide();" id="cmsSub2">
							 &nbsp; <a href="<?php echo $root; ?>administrator/addupdate" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/netvibes.png" class="icon" /> Add Update</a>
							 <div class="br"></div>
						</div>
					</div>
					&nbsp; &nbsp;
					&nbsp; &nbsp;
					<div class="cmsMenuItem" onmouseover="$('#cmsSub3').show();" onmouseout="$('#cmsSub3').hide();">
						<span class="mainLink">Consoles</span>
						<div class="cmsSubMenuItem" onmouseout="$(this).hide();" id="cmsSub3">
							 &nbsp; <a href="<?php echo $root; ?>administrator/sqlcons" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/sql.png" class="icon" /> SQL Console</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/phpcons" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/php.png" class="icon" /> PHP Console</a>
						</div>
					</div>
					&nbsp; &nbsp;
					&nbsp; &nbsp; 
					<div class="cmsMenuItem" onmouseover="$('#cmsSub4').show();" onmouseout="$('#cmsSub4').hide();">
						<span class="mainLink">Security</span>
						<div class="cmsSubMenuItem" onmouseout="$(this).hide();" id="cmsSub4">
							 &nbsp; <a href="<?php echo $root; ?>administrator/security" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/security.png" class="icon" /> Security Page</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/banned" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/ip_block.png" class="icon" /> Banned Users</a>
							 <div class="br"></div>
							 &nbsp; <a href="<?php echo $root; ?>administrator/htaccess" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/code.png" class="icon" /> .htaccess Editor</a>
							 <div class="br"></div>
						</div>
					</div>
					&nbsp; &nbsp; 
					&nbsp; &nbsp; 
					<div class="cmsMenuItem" onmouseover="$('#cmsSub5').show();" onmouseout="$('#cmsSub5').hide();">
						<span class="mainLink">Help</span>
						<div class="cmsSubMenuItem" onmouseout="$(this).hide();" id="cmsSub5">
							&nbsp; <a href="<?php echo $root; ?>administrator/help" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/help.png" class="icon" /> Help Page</a>
							<div class="br"></div>
							&nbsp; <a href="<?php echo $root; ?>administrator/faq" class="cmsNavMenuLink"><img src="<?php echo $root; ?>administrator/images/icons/information.png" class="icon" /> F.A.Q.</a>
							<div class="br"></div>
						</div>
					</div>
				</section>
			</section>
			<section class="cmsPanel">
				<div class="brd"></div>
				<div style="margin-left: 2%;">
				<?php
					switch($_GET["p"]){
						default:
				?>
				<div class="cmsRow">
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/createpage">
						<img src="<?php echo $root; ?>administrator/images/icons/page_add.png" class="webIcon" />
						<div class="br"></div>
						Add New Page
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/pages">
						<img src="<?php echo $root; ?>administrator/images/icons/page.png" class="webIcon" />
						<div class="br"></div>
						Page Manager
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/menus">
						<img src="<?php echo $root; ?>administrator/images/icons/menu.png" class="webIcon" />
						<div class="br"></div>
						Menu Manager
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/media">
						<img src="<?php echo $root; ?>administrator/images/icons/image.png" class="webIcon" />
						<div class="br"></div>
						Media Manager
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/modules">
						<img src="<?php echo $root; ?>administrator/images/icons/script_binary.png" class="webIcon" />
						<div class="br"></div>
						Module Manager
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/security">
						<img src="<?php echo $root; ?>administrator/images/icons/security.png" class="webIcon" />
						<div class="br"></div>
						Security
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/settings">
						<img src="<?php echo $root; ?>administrator/images/icons/setting_tools.png" class="webIcon" />
						<div class="br"></div>
						Configuration
						</a>
					</div>
				</div>
				<div class="brt"></div>
				<div class="cmsRow">
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/meta">
						<img src="<?php echo $root; ?>administrator/images/icons/globe_place.png" class="webIcon" />
						<div class="br"></div>
						Meta Manager
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/backups">
						<img src="<?php echo $root; ?>administrator/images/icons/backups.png" class="webIcon" />
						<div class="br"></div>
						Backup Manager
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/addupdate">
						<img src="<?php echo $root; ?>administrator/images/icons/newspaper_add.png" class="webIcon" />
						<div class="br"></div>
						Add Update
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/tasks">
						<img src="<?php echo $root; ?>administrator/images/icons/list.png" class="webIcon" />
						<div class="br"></div>
						Task Scheduler
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/mobile">
						<img src="<?php echo $root; ?>administrator/images/icons/blackberry.png" class="webIcon" />
						<div class="br"></div>
						Mobile Settings
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/shop">
						<img src="<?php echo $root; ?>administrator/images/icons/cart.png" class="webIcon" />
						<div class="br"></div>
						Shop
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/consoles">
						<img src="<?php echo $root; ?>administrator/images/icons/console.png" class="webIcon" />
						<div class="br"></div>
						Consoles
						</a>
					</div>
				</div>
				<div class="brt"></div>
				<div class="cmsRow">
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/layouts">
						<img src="<?php echo $root; ?>administrator/images/icons/layout.png" class="webIcon" />
						<div class="br"></div>
						Layout Manager
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/browsefiles">
						<img src="<?php echo $root; ?>administrator/images/icons/file_manager.png" class="webIcon" />
						<div class="br"></div>
						Browse Files
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/balance">
						<img src="<?php echo $root; ?>administrator/images/icons/account_balances.png" class="webIcon" />
						<div class="br"></div>
						Fund Balance
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/recyclebin">
						<img src="<?php echo $root; ?>administrator/images/icons/bin_recycle.png" class="webIcon" />
						<div class="br"></div>
						Recycling Bin
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/changelog">
						<img src="<?php echo $root; ?>administrator/images/icons/change_log.png" class="webIcon" />
						<div class="br"></div>
						Changelog
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/webmail">
						<img src="<?php echo $root; ?>administrator/images/icons/mail_box.png" class="webIcon" />
						<div class="br"></div>
						Web Mail
						</a>
					</div>
					&nbsp; &nbsp; 
					<div class="cmsCell">
						<div class="brm"></div>
						<a href="<?php echo $root; ?>administrator/paypal">
						<img src="<?php echo $root; ?>administrator/images/icons/paypal.png" class="webIcon" />
						<div class="br"></div>
						Paypal Accounts
						</a>
					</div>
				</div>
				<?php
					break;
					case 'meta':
						
       	        		$metaData = sql("SELECT * FROM meta");
						changeTitle("Meta Manager");
						if(isset($_POST["submit"])){
       	        			query("UPDATE meta SET name = '".addslashes($_POST["name"])."', about = '".addslashes($_POST["about"])."',
       	        			       keywords = '".addslashes($_POST["keywords"])."', title = '".addslashes($_POST["title"])."'");
							?>
       	        		  <div style="width: 680px; padding: 4px; border: 2px solid #008b00; font-size: 15px; border-radius: 20px; background: #0d0; color: #009900;
       	        		  font-weight: bold;"><img src="<?php echo $root; ?>buttons/on.gif" style="height:16px;width:16px;" /> Your changes were applied successfully.</div>
							<?php
							header("Refresh: 1; ".$root."administrator");
						}else{
							?>
							<div class="headline">Meta Manager</div>
							<form action="<?php echo $root; ?>administrator/meta" method="post">
							<p>
								<label class="formLabel" for="name">Site Name</label>: 
								<br />
								<input type="text" size="50" class="form-control" value="<?php echo stripslashes($metaData["name"]); ?>" required="1" name="name" />
								<div class="infoText">The name of your web site. Duh.</div>
							</p>
							<p>
								<label class="formLabel" for="keywords">Key Words</label>:
								<br />
								<input type="text" class="form-control" name="keywords" id="kw" placeholder="Enter keywords.." value="<?php echo stripslashes($metaData["keywords"]); ?>" size="50" />
								<div class="infoText">Key words are words that users type in to search engines, and this is a list of words that will yield this site as a result. Separate each key word with a comma, and please try not to use more than 15.</div>
							</p>
							<p>
								<label class="formLabel" for="about">Description:</label>
								<br />
								<textarea cols="62" rows="5" name="about" required="1" id="desc" class="form-control"><?php echo stripslashes($metaData["about"]); ?></textarea>
								<div class="infoText">Provide a brief, alluring description for the web site -- this shows up in the site's search engine entry.</div>
							</p>
							<p>
								<label class="formLabel" for="title">Title</label>:
								<br />
								<input type="text" value="<?php echo stripslashes($metaData["title"]); ?>" size="50" name="title" required="1" class="form-control" />
								<div class="infoText">This is what appears when the user hovers their mouse over the site's name in the results.</div>
							</p>
							<p style="text-align: center;">
								<button type="submit" name="submit" id="sc" class="formButton form-control">Save Changes</button>
							</p>
							</form>
							<?php
						}
					break;
					case 'backups':
						
						changeTitle("Backup Manager");
						?><div style="margin-left: 2%; width: 95%;">
								<div class="brl"></div>
								<h1 class="headline">Backup Manager</h1>
								 &nbsp; &nbsp; You may use this page to run backups of the site. Note that sometimes the maximum execution time of seconds will run out, and the backup will then not be completed. It is advised to delete unnecessary files for this reason before running the backup. You have the option of backing up files and folders, or database information (content, users, posts, pages, etc.). Note that backups will <em>not</em> replace one another, and should be cleaned out/downloaded regularly, otherwise the previous backup will be included in the new backup as well, doubling its size and execution time.
								 <div class="br"></div>
								 <strong>Note:</strong> The file backup here seems to be on the fritz. Please use the one on the main cPanel of the Web site, instead of the one here on zTech+.
								<div class="br"></div>
								<div class="cmsRow">
								<div class="cmsCell">
								<div class="brm"></div>
								<a href="<?php echo $root; ?>administrator/backups/files"><img src="<?php echo $root; ?>buttons/folder_blue.png" class="webIcon" />
								<div class="br"></div>
								Backup Files</a>
								</div>
								&nbsp; &nbsp; 
								<div class="cmsCell">
								<div class="brm"></div>
								<a href="<?php echo $root; ?>administrator/backups/sql"><img src="<?php echo $root; ?>buttons/database.png" class="webIcon" />
								<div class="br"></div>
								Backup Database</a>
								</div>
								</div>
							</div>
						<?php
					break;
					case 'backupfiles':
						
						$rp = ($root == "http://localhost/dreamspand/") ? "../dreamspand" : "../zollernverse.org";
						$rootPath = realpath($rp);
						changeTitle("Site Backup");
						echo "
							<div style='margin-left: 2%;'>";
						echo '
							<a href="'.$root.'administrator/backups">&laquo; Backup Manager</a>
							<div class="brl"></div>';
						echo "
							Archive created, access it here: ";
						$bck = $root.'administrator/backups/backup-'.date("n-d-y").'.zip';
						echo '<a href="'.$bck.'" class="nWin">'.$bck.'</a><br />';
						ini_set("max_execution_time",300);//5 minutes
						ZipFolder($rootPath,$root,"administrator/");
						echo "</div>";
					break;
					case 'backupsql':
						
						changeTitle("Database Backup");
						backup_sql();
						?>
							<div style="margin-left: 2%;">
								<a href="<?php echo $root; ?>administrator/backups">&laquo; Backup Manager</a>
								<div class="brl"></div>
								<h2 class="headline">Database Backup</h2>
								<div style="margin-left: 2%;">
									SQL data has been successfully backed up. You may find the file within the backups folder.
								</div>
							</div>
						<?php
					break;
					case 'pages':
       	        		AuthCheck(3);
       	        		changeTitle("Page Manager");
						$getPages = mysql_query("SELECT * FROM pages ORDER BY title ASC") OR SQLError();
       	        		?>
						<div style="margin-left: 2%;">
						<a href="<?php echo $root; ?>administrator" class="siteLink">&laquo; Control Panel</a>
       	        		<h1 class="headline">Page Manager</h1>
						<div class="cmsRow">
							<div class="cmsCell">
								<div class="brm"></div>
									<a href="<?php echo $root; ?>administrator/createpage" class="siteLink">
										<img src="<?php echo $root; ?>administrator/images/icons/page_add.png" class="webIcon" />
										<div class="br"></div>
										Create Page
									</a>
							</div>
							&nbsp; &nbsp; 
							<div class="cmsCell">
							<div class="brm"></div>
								<a href="<?php echo $root; ?>administrator/import" class="siteLink">
									<img src="<?php echo $root; ?>administrator/images/icons/flashdisk.png" class="webIcon" />
									<div class="br"></div>
									Import Page
								</a>
							</div>
							&nbsp; &nbsp; 
							<div class="cmsCell">
							<div class="brm"></div>
							<a href="<?php echo $root; ?>administrator/categories" class="siteLink">
								<img src="<?php echo $root; ?>administrator/images/icons/folder.png" class="webIcon" />
								<div class="brl"></div>
								Page Categories
							</a>
							</div>
						</div>
						<div class="brt"></div>
						<div class="pageList">
						<div class="title">Page List</div>
							<div class="brt"></div>
							<?php
							while($p = fetch($getPages)){
									echo '<div style="font-size: 14px;">
										&nbsp; &nbsp; &nbsp; &nbsp; 
										<a href="'.$root.'administrator/export/'.$p["alias"].'" class="nWin"><img src="'.$root.'buttons/flashdisk_2.png" class="icon" /></a>
										<a href="'.$root.'administrator/editpage/'.$p["alias"].'"><img src="'.$root.'administrator/images/icons/edit_button.png" class="icon" /></a>
										<a href="'.$root.'administrator/deletepage/'.$p["alias"].'" onclick="return confirm(\'Are you sure you wish to delete this page? This cannot be undone.\');"><img src="'.$root.'buttons/cancel.png" class="icon" /></a>
										<a href="'.$root.'administrator/recyclepage/'.$p["alias"].'" onclick="return confirm(\'Are you sure you wish to recycle this page? This can be undone.\');"><img src="'.$root.'administrator/images/icons/bin.png" class="icon" /></a>
										<a href="'.$root.'administrator/p/'.$p["alias"].'" class="siteLink nWin">'.stripslashes($p["title"]).'</a>
										<span style="font-size: 12px;">
										by '.getDisplay($p["userid"]).'
										on '.dateFormat($p["posted"]).'
										</span>
										';
									$clr = ($p["published"]) ? "0d0" : "f00";
									$published = ($clr == "0d0") ? "Published" : "Unpublished";
									echo '<div style="color: #'.$clr.';">
											 &nbsp; &nbsp; '.$published.'
										  </div>
										  <div class="br"></div>
									';
										echo '
									</div>
									<div class="brd"></div>';
							}
							?>
						<div class="title bottom">&nbsp;</div>
						</div>
						</div>
						<div class="brm"></div>
       	        		<?php
       	        		break;
						case 'createpage':
							AuthCheck(3);
							changeTitle("Create Page");
							if(isset($_POST["buttonSubmit"])){
								$al = $_POST["alias"];
								$al = sqlEsc($al);
								$data = sql("SELECT id FROM pages WHERE alias = '".$al."'");
								if($data["id"] != ""){
									$al .= "2";
								}
								$al = str_replace(" ","-",$al);
								$al = strtolower($al);
								query("INSERT INTO pages(title,pc_id,userid,content,alias,tags)VALUES('".addslashes($_POST["title"])."','".$_POST["category_id"]."','".$_COOKIE["id"]."','".addslashes($_POST["content"])."','".$al."','".$_POST["tags"]."');");
								$n = mysql_insert_id();
								logUser($_COOKIE["id"],"created a new page.");
								?>
								<a href="<?php echo $root; ?>administrator/">&laquo; Control Panel</a>
								<div class="brm"></div>
								Your page has been successfully created, and may be viewed in the page manager.
								<div class="br"></div>
								<?php
							}else{
						?>
							<div style="margin-left: 2%;">
								<div class="brl"></div>
								<a href="<?php echo $root; ?>administrator/pages" class="siteLink">&laquo; Page Manager</a>
								<h2> &raquo; Create Page</h2>
								<form action="<?php echo $root; ?>administrator/createpage" method="post">
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
										$getCtgs = mysql_query("SELECT * FROM page_categories ORDER BY name ASC") OR SQLError();
										if(mysql_num_rows($getCtgs) > 0){
											echo '<select name="category_id" class="form-control" required="1" id="cid">
												<option value="">---------------------</option>';
											while($ci = fetch($getCtgs)){
												echo '<option value="'.$ci["id"].'">'.stripslashes($ci["name"]).'</option>';
											}
											echo '</select>';
										}else{
											echo 'No categories have been added yet.<br /><a href="'.$root.'administrator/createpcategory" class="siteLink">Add One</a>!';
										}
									?>
								</div>
								<div class="brm"></div>
								<div class="p">
									<label class="formLabel" for="alias">Alias:</label>
									<div class="brl"></div>
									<input type="text" name="alias" id="txtAlias" required="1" class="form-control" size="50" placeholder="Enter alias.." />
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
							}
						break;
						case 'editpage':
							AuthCheck(3);
							$id = aliasCheck();
							$data = sql("SELECT * FROM pages WHERE alias = '".$id."'");
							changeTitle("Editing Page: ".stripslashes($data["title"]));
							if(isset($_POST["buttonSubmit"])){
								$al = $_POST["alias"];
								$al = sqlEsc($al);
								$data = sql("SELECT id FROM pages WHERE alias = '".$al."'");
								if($data["id"] != ""){
									$al .= "2";
								}
								$al = str_replace(" ","-",$al);
								$al = strtolower($al);
								$pb = $_POST["published"];
								query("UPDATE pages SET title = '".addslashes($_POST["title"])."', pc_id = '".$_POST["category_id"]."', userid = '".$_COOKIE["id"]."', content = '".addslashes($_POST["content"])."', alias = '".$al."', published = '".$pb."', tags = '".addslashes($_POST["tags"])."' WHERE alias = '".$id."'");
								$n = strtolower($_POST["alias"]);
								logUser($_COOKIE["id"],"modified an existing page.");
								echo "<p class=\"infoRow\"><img src=\"".$root."administrator/images/icons/info_rhombus.png\" /> Your changes were saved successfully.</p>
									<div class=\"brd\"></div>
								";
								$data = sql("SELECT * FROM pages WHERE alias = '".$id."'");
							}
						?>
							<div style="margin-left: 2%;">
								<div class="brl"></div>
								<a href="<?php echo $root; ?>administrator/pages" class="siteLink">&laquo; Page Manager</a>
								<h2> &raquo; Editing Page: <?php echo stripslashes($data["title"]); ?></h2>
								<form action="<?php echo $root; ?>administrator/editpage/<?php echo $id; ?>" method="post">
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
										$getCtgs = mysql_query("SELECT id,name FROM page_categories ORDER BY name ASC") OR SQLError;
										if(mysql_num_rows($getCtgs) > 0){
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
									<label class="formLabel" for="alias">Alias:</label>
									<div class="brl"></div>
									<input type="text" name="alias" value="<?php echo $data["alias"]; ?>" id="txtAlias" required="1" class="form-control" size="50" placeholder="Enter alias.." />
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
							AuthCheck(3);
							$id = aliasCheck();
							query("DELETE FROM pages WHERE alias = '".$id."'");
							header("Location: ".$root."administrator/pages");
						break;
						case 'import':
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
								query("INSERT INTO pages(title,pc_id,userid,content,alias,tags,published)VALUES('".addslashes($pagename)."','".$categoryid."','".$userid."','".addslashes($content)."','".strtolower($alias)."','".$tags."','".$published."');");
								$n = mysql_insert_id();
								logUser($userid,"imported a new page.");
								echo 'Import successful. You may view the page via the <a href="'.$root.'administrator/pages" class="nWin">Page Manager</a>.';
							}else{
								?>
									<form action="<?php echo $root; ?>administrator/import" method="post" enctype="multipart/form-data" id="importForm">
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
						case 'export':
							AuthCheck(3);
							changeTitle("Exporting Page");
							$data = sql("SELECT * FROM pages WHERE alias = '".sqlEsc($_GET["id"])."'");
							extract($data);
							$r = sql("SELECT alias FROM page_categories WHERE id = '".$pc_id."'");
							$aliasr = $r["alias"];
							$f = fopen("../ext/".$alias.".exp","w+") OR exit("Error in creating/opening file");
							$p = ($published) ? "true" : "false";
							$c = preg_replace("/\r|\n|\r\n/","<br />",$content);
							$c = str_replace("<b>","<strong>",$c);
							$c = str_replace("</b>","</strong>",$c);
							$c = preg_replace("/&nbsp;/i"," ",$c);
							fwrite($f, "%PAGENAME%=".$title."\r\n%CATEGORY%=".$aliasr."\r\n%CONTENT%=".$c."\r\n%ALIAS%=".$alias."\r\n%TAGS%=".$tags."\r\n"."%PUBLISHED%=".$p) OR exit("Error in writing to file");
							echo '<div style="margin-left: 2%;">
								<h2 class="headline">Exporting Page</h2>
								Export complete. Click the below link to view the file.
								<div class="brl"></div>
								<a href="'.$root.'ext/'.$alias.'.exp" class="nWin">'.$root.'ext/'.$alias.'.exp</a>
								<div class="brl"></div>
								Remember to save the file as <strong>'.$alias.'.exp</strong>, otherwise the import feature might not work right later. Simply copy and paste the text from one file to another.
							</div>';
						break;
						case 'recyclepage':
							changeTitle("Recycling Page");
						break;
						case 'recyclebin':
							changeTitle("Recycling Bin");
						break;
						case 'mobile':
							changeTitle("Mobile Settings");
							$data = sql("SELECT enabled FROM mobile_settings");
							$enabled = $data["enabled"];
							if($data["enabled"] == ""){
								$enabled = 0;
								query("INSERT INTO mobile_settings(enabled)VALUES('0');");
							}
							if(isset($_POST["buttonSubmit"])){
								query("UPDATE mobile_settings SET enabled = '".$_POST["enabled"]."'");
								echo 'Changes saved.';
								header("Refresh: 1; ".$root."administrator");
							}
							?>
							<h2 class="headline">Mobile Settings</h2>
							<form action="<?php echo $root; ?>administrator/mobile" method="post">
								<label for="enabled" class="formLabel">Mobile Capabilities:</label>
								 &nbsp; &nbsp; 
								<select name="enabled" class="form-control">
									<option value="0"<?php if(!$data["enabled"]) echo ' selected="1"'; ?>>Disabled</option>
									<option value="1"<?php if($data["enabled"]) echo ' selected="1"'; ?>>Enabled</option>
								</select>
								<div class="br"></div>
								<button type="submit" name="buttonSubmit" class="formButton form-control" id="btnSubmit">Save Changes</button>
							</form>
							<?php
						break;
						case 'settings':
							changeTitle("Site Configuration");
						break;
						case 'security':
							changeTitle("Security Manager");
							?>
							<a href="<?php echo $root; ?>administrator">&laquo; Control Panel</a>
							<h2 class="headline">Security Manager</h2>
							<div class="cmsRow">
								<div class="cmsCell">
									<div class="brm"></div>
									<a href="<?php echo $root; ?>administrator/htaccess">
										<img src="<?php echo $root; ?>administrator/images/icons/code.png" class="webIcon" />
										<div class="br"></div>
										.htaccess Editor
									</a>
								</div>
								&nbsp; &nbsp; 
								<div class="cmsCell">
									<div class="brm"></div>
									<a href="<?php echo $root; ?>administrator/banned">
										<img src="<?php echo $root; ?>administrator/images/icons/ip_block.png" class="webIcon" />
										<div class="br"></div>
										Banned Users
									</a>
								</div>
							</div>
							<?php
						break;
						case 'htaccesseditor':
							AuthCheck(5);
							changeTitle(".htaccess Editor");
							if(isset($_POST["buttonSubmit"])){
								file_put_contents(".htaccess",$_POST["hta_post"]);
								echo "Changes saved.
								<div class=\"br\"></div>";
								header("Refresh: 1; ".$root."administrator/security");
							}
							?>
							<div style="margin-left: 2%;">
							<h2 class="headline">.htaccess Editor</h2>
							<p style="width: 60%;">
								From here you can modify the site's .htaccess file. This file is what governs the "pretty URLs", redirects, site access, spambot prevention, URL rewrites, etc. Please ONLY touch this if you <strong>KNOW</strong> what you are doing.
							</p>
							<div class="br"></div>
							<form action="<?php echo $root; ?>administrator/htaccess" method="post">
								<textarea cols="100" rows="18" name="hta_post" id="hta_editor" class="form-control" spellcheck="false"><?php
									$f = file_get_contents(".htaccess");
									echo $f;
								?></textarea>
								<div class="br"></div>
								<button type="submit" class="formButton form-control" name="buttonSubmit" id="btnSubmit">Save Changes</button>
							</form>
							</div>
							<?php
						break;
						case 'bannedusers':
							changeTitle("Suspended Users");
							$getData = mysql_query("SELECT * FROM banned") OR SQLError();
							?>
							<style type="text/css">
							<!--
							th {
								width: 25%;
								text-align: left;
								text-decoration: underline;
								font-size: 14pt;
							}
							-->
							</style>
							You are here: 
							<a href="<?php echo $root; ?>administrator/security">Security Manager</a> &raquo; <strong>Banned Users</strong>
							<h2 class="headline">List of suspended users and accounts</h2>
							<p style="margin-left: 2%; width: 60%;">
								This is the list of all suspended users and accounts. Not all are registered users; some are spambots or ex-members who have either had their account rights revoked or deleted their account to try and get out of the suspension. You may view them, modify them, unban them, or add a new entry. An auto-unbanner will be added soon.
							</p>
							<div class="br"></div>
							<table style="width: 80%; margin-left: 2%;">
								<tr>
									<th>User</th>
									<th>IP addresses</th>
									<th>Date of Suspension</th>
									<th>Hostname</th>
								</tr><?php
									while($data = fetch($getData)){
										$userdata = sql("SELECT id FROM members WHERE id = '".$data["userid"]."'");
										if($userdata["id"] == ""){
											$user = $data["names"];
										}else{
											$user = getDisplay($data["userid"]);
										}
										$ip = $data["ips"];
										$d = dateFormat($data["on_date"]);
										$hostname = $data["hostname"];
										$hostname = ($hostname == "") ? "Unresolved" : $hostname;
										echo '<tr>
											<td><a href="'.$root.'administrator/unban/'.$data["id"].'"><img src="'.$root.'administrator/images/icons/unban.png" class="icon" /></a>'.$user.'</td>
											<td>'.$ip.'</td>
											<td>'.dateFormat($data["on_date"]).'</td>
											<td>'.$hostname.'</td>
										</tr>';
									}
								?>
							</table>
							<?php
							case 'banuser':
								changeTitle("Ban User");
							break;
						break;
				}
				?>
				</div>
			</section>
			<section class="cmsFooter">All content is <span class="copyright">&copy;</span> zTech+ and its author 2015 - <?php echo date("Y"); ?></section>
		</section>
	</body>
</html>
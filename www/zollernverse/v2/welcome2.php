		        <?php
				$getstuffs = sql("SELECT ct_order,split_ctgs,forum_name,boards_center FROM sitedata");
		        ?>
		        <table class="table bordercolor" cellspacing="1" cellpadding="4" id="welcomeTable">
			        <tr>
			        <th class="titlebg" colspan="4"><?php echo stripslashes($getstuffs["forum_name"]); ?></th>
			        </tr>
			        <tr>
			        <td class="mainbg2 pageContent" style="text-align: center;" colspan="4" id="wl">
			        <?php
			        	$banner = sql("SELECT banner_img FROM layouts WHERE id = ".$skinid);
			        ?>
				<a href="forum.php"><img src="<?php echo $banner["banner_img"]; ?>" style="border: none; border-radius: 14px;" /></a>
				</td>
				</tr>
				<tr><td class="mainbg pageContent" valign="top" style="overflow: auto; width: 25%;">
				<img src="buttons/siren.png" class="icon" /> <strong>Site Staff:</strong>
				<br />
				<?php
				$getstaff = mysqli_query($con, "SELECT id FROM members WHERE perms >= 2 ORDER BY perms DESC") OR SQLError();
				while($staff = fetch($getstaff)){
					echo getDisplay($staff["id"])."<br />";
				}
				?>
				</td>
				<td class="mainbg pageContent" style="text-align: center;">
				Welcome to <?php echo stripslashes($getstuffs["forum_name"]); ?>.
				<div style="text-align: center;">Become acquainted with our <a href="?act=topic&id=217"><strong>Rules</strong></a>!</div>
				<script type="text/javascript">
				<!--
				//Google Plus
				document.write('<g'+':plusone annotation="inline"></g:plusone>');
				// -->
				</script>
				<!--
					<p>
					  <strong>Interested in having an amazing web site built for you at an affordable price?</strong> <br /> &raquo; <a href="?act=createsite" class="siteLink">Click Here</a>! &laquo;
					</p>
				-->
				</td>
				<td class="mainbg2 pageContent" style="text-align: center; width: 25%;">
				<?php
				if(online()){
				//Unread Inbox
				$nm = numRows("SELECT id FROM pm WHERE touser = '".$_COOKIE["id"]."' AND unread = 'yes' AND trashed != 1 AND saved != 1");
				$om = numRows("SELECT id FROM pm WHERE touser = '".$_COOKIE["id"]."' AND trashed != 1 AND saved != 1 AND unread != 'yes'");
				?>
				<a href="?act=pmcenter" class="siteLink"><img src="buttons/mail_box.png" /> Inbox</a>
				<br />
				(New: <?php echo $nm; ?> | Old: <?php echo $om; ?>)
				<?php
				}
				?>
				</td>
				</tr>
				<tr>
				<td class="mainbg2" colspan="3" id="menu" style="text-align: center; font-size: 12px;">
				<div style="height: 10px;"></div>
				<div class="nav">
					<div class="item" style="display: inline; cursor: pointer;" onclick="location.href='forum.php'" id="sn1">Forum Home</div>
					&nbsp; &nbsp;
					<div class="item" style="display: inline; cursor: pointer;" onclick="location.href='./'" id="sn1">Site Home</div>
					&nbsp; &nbsp;
					<div class="item" style="display: inline; cursor: pointer;" onclick="subNav(2);" id="sn2">Members
					</div>
					&nbsp; &nbsp;
					<div class="item" style="display: inline; cursor: pointer;" onclick="subNav(3);" id="sn3">General</div>
					<?php
						if(checkPerms(3)){
					?>
					&nbsp; &nbsp; 
					<div class="item" style="display: inline; cursor: pointer;" onclick="subNav(4);" id="sn4">Staff</div>
					<?php
						}
					?>
					&nbsp; &nbsp;
					<div class="item" style="display: inline; cursor: pointer;" onclick="subNav(5);" id="sn5">Extras</div>
				</div>
					<div style="height: 5px;"></div>
					<div id="subnav" style="display: none;">
					</div>
				<div class="br"></div>
				<?php
				 if(online()){
				?>
				<div id="notes">
					<div class="item" style="width: 250px;">
						<a href="javascript:;" onclick="showSection('notesContent');notesRead();" id="notesLink">
						<?php
						 $getNotesAlpha = numRows("SELECT id FROM notifications WHERE userid = '".$_COOKIE["id"]."' AND unread = 'yes'");
						 if($getNotesAlpha >= 1){
						 	echo " <img src=\"new.png\" /> ";
						 }
						?>
						<img src="buttons/world.png" /> 
						<?php 
						if($getNotesAlpha > 0) 
							echo FormatRes($getNotesAlpha,"Notification");
						else
							echo " Notifications"; ?>
						</a>
					</div>
					<div class="break"></div>
						<div style="display: none; text-align: left;" id="notesContent" class="quote">
							<?php require 'notes_read.php'; ?>
						</div>
				</div>
				<?php
				 }
				?>
				<div class="br"></div>
				</td>
				</tr>
				<?php
				if(!online()){
					echo '<tr>
						<td class="mainbg" colspan="3">
						<form action="forum.php?act=login" method="post">
						Log In: &nbsp; &nbsp; &nbsp; &nbsp; E-Mail: <input type="text" name="email" class="form-control" /> &nbsp; &nbsp; &nbsp; &nbsp; Password: <input type="password" name="pass" class="form-control" /> &nbsp; <button name="submit" id="li" class="formButton form-control">Log In</button>
						<div class="b"></div>
						<input type="checkbox" name="lf" class="form-control" /> Remember Me
						</form>
						<div class="break"></div> &nbsp; &nbsp; &nbsp; Not a member here? <a href="?act=register" class="siteLink">Sign Up</a>!
						</td>
					</tr>';
				}
				if(online()){
				?>
				<tr>
				<td class="mainbg" colspan="3">
					<div style="text-align:left;">
					<img src="buttons/bank.png" />
					<a href="?act=bank" class="siteLink">SSM Account</a>
					<?php
					$bankAccount = sql("SELECT id,balance FROM bank_accounts WHERE userid = '".$_COOKIE["id"]."'");
					if($bankAccount["id"] != ""){
						nbsp(4);
						echo "<span class=\"pageContent\">Balance: $".number_format(ceil($bankAccount["balance"]))."</span>";
					}
					?>
					</div></td>
				</tr>
				<?php 
				}
				?>
				</table>
				<div style="height:25px;"></div>
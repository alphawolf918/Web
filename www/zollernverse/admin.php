<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr><th class="titlebg" colspan="4">Admin CP</th></tr>
						<?php
						if(checkPerms(5)){
						?>
						<tr>
						<td class="mainbg" colspan="4">
						Extras:
						 <a href="?act=addchao" class="siteLink">Chao Management</a>
						 </td>
						 </tr>
						<?php
						}
						?>
						<tr>
						<td class="mainbg2" valign="top">
							<img src="admin.gif" /> <strong> Boards</strong><br />
							<?php
							if(checkPerms(4)){
							?>
							&nbsp; <a href="?act=createboard" class="siteLink">Create Board</a><br />
							&nbsp; <a href="?act=modifyboard" class="siteLink">Modify Board</a><br />
							&nbsp; <a href="?act=delboard1" class="siteLink">Delete Board</a><br />
							&nbsp; <a href="?act=boardorder1" class="siteLink">Reorder Boards</a><br />
							<?php 
							}
							?>
							&nbsp; <a href="?act=boardban1" class="siteLink">Board Bans</a>
						</td>
						<td class="mainbg2" valign="top">
							<img src="admin.gif" /> <strong>Consoles</strong><br />
							<?php
							if(checkPerms(4)){
							?>
								&nbsp; <a href="?act=phpcons" class="siteLink">PHP Console</a><br />
								&nbsp; <a href="?act=sqlcons" class="siteLink">SQL Console</a><br />
								&nbsp; <a href="?act=xspcons" class="siteLink">XSP Console</a><br />
							<?php
							}
							?>
						</td>
						<td class="mainbg2" valign="top">
							<img src="admin.gif" /> <strong>Site Management</strong><br />
							<?php
							if(checkPerms(4)){
							?>
							&nbsp; <a href="?act=settings" class="siteLink">Forum Settings</a><br />
							&nbsp; <a href="?act=medals" class="siteLink">Site Medals</a><br />
							&nbsp; <a href="?act=affiliatecenter" class="siteLink">Affiliate Center</a><br />
							<?php
							}
							?>
							&nbsp; <a href="?act=addupdate" class="siteLink">Add Update</a><br />
							<?php
							if(checkPerms(4)){
							?>
							&nbsp; <a href="?act=headfoot" class="siteLink">The Sandbox</a><br />
							<?php } ?>
							&nbsp; <a href="?act=newsfader" class="siteLink">News Fader</a><br />
							&nbsp; <a href="?act=avmanage" class="siteLink">User Avatars</a>
						</td>
						<td class="mainbg2" valign="top">
							<img src="admin.gif" /> <strong>Member Management</strong><br />
							&nbsp; <a href="?act=bannedusers" class="siteLink">Banned Users</a><br />
							&nbsp; <a href="?act=deletepostsbymember" class="siteLink">Delete Posts For Member</a><br />
							<?php
							if(checkPerms(4)){
							?>
							&nbsp; <a href="?act=mranks" class="siteLink">Member Ranks</a><br />
							&nbsp; <a href="?act=emailall" class="siteLink">E-Mail All</a><br />
							<?php
							$sitedata = sql("SELECT * FROM sitedata");
							if($sitedata["limited_register"]){
							?>
							&nbsp; <a href="?act=pending" class="siteLink">Pending Members</a><br />
							<?php
							}
							}
							?>
							&nbsp; <a href="?act=sendpm&u=all" class="siteLink">PM All</a><br />
							&nbsp; <a href="?act=reportcenter" class="siteLink">Report Center</a>
							
						</td>
						</tr>
						<tr>
						<td class="mainbg2" valign="top">
						<img src="admin.gif" /> <strong>Categories</strong><br />
						<?php
						if(checkPerms(4)){
						?>
						&nbsp; <a href="?act=createcategory" class="siteLink">Create Category</a><br />
						&nbsp; <a href="?act=modifycategory" class="siteLink">Modify Category</a><br />
						&nbsp; <a href="?act=delctg1" class="siteLink">Delete Category</a><br />
						&nbsp; <a href="?act=categoryorder" class="siteLink">Reorder Categories</a>
						<?php
						}
						?>
						</td>
						<td class="mainbg2" valign="top">
							<img src="admin.gif" /> <strong>Surveilance</strong><br />
							<?php
							if(checkPerms(4)){
							?>
							&nbsp; <a href="?act=viewlogs" class="siteLink">View Logs</a><br />
							&nbsp; <a href="?act=realtime" class="siteLink">RTL Feed</a><br />
							<?php
							}
							?>
							&nbsp; <a href="?act=hostname" class="siteLink">Hostname Lookup</a><br />
							&nbsp; <a href="?act=ipcenter" class="siteLink">IP Center</a><br />
							<?php
							if(checkPerms(4)){
							?>
							&nbsp; <a href="?act=dnsrecord" class="siteLink">DNS Record</a>
							<?php
							}
							?>
						</td>
						<td class="mainbg2" valign="top">
							<img src="admin.gif" /> <strong>Restrictions</strong><br />
							&nbsp; <a href="?act=wordsub" class="siteLink">Word Substitution</a><br />
							&nbsp; <a href="?act=reserved" class="siteLink">Reserved Names</a>
						</td>
						<td class="mainbg2" valign="top">
							<img src="admin.gif" /> <strong>Layouts</strong><br />
							&nbsp; <a href="?act=createskin" class="siteLink">New Layout</a> <br />
							&nbsp; <a href="?act=modifyskin" class="siteLink">Edit Layout</a> <br />
							&nbsp; <a href="?act=deleteskin" class="siteLink">Delete Layout</a>
						</td>
						</tr>
						</table>
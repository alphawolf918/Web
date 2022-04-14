<div class="nav mainbg2">
	<div class="titlebg">User Panel</div>
	<nav>
	<?php
	if(!online()){
	?>
		- <a href="?act=register">Sign Up</a>
		<br />
		- <a href="?act=login">Log In</a>
	<?php
	}else{
	$nm = mysql_num_rows(mysql_query("SELECT id FROM pm WHERE touser = '".$_COOKIE["id"]."' AND unread = 'yes'"));
	?>
		- <a href="?act=profile">Profile</a> [<a href="?act=editprofile">edit</a>]
		<br />
		- <a href="?act=sendpm">Send PM</a>
		<br />
		- Inbox (<a href="?act=inbox"><?php echo $nm; ?></a>)
		<br />
		- <a href="?act=logout">Log Out</a>
		<?php if(checkPerms(2)){ ?>
		<div class="titlebg">Control Panel</div>
		- <a href="?act=sendpm&u=all">PM All</a><br />
		- <a href="?act=cpanel">Admin CP</a>
		<?php } ?>
	<?php
	}
	?>
	</nav>
	</div>
	<div class="nav_r mainbg2">
		<nav>
		<div class="titlebg">Main Panel</div>
			- <a href="./">Home</a><br />
			- <a href="?act=updates">Updates</a>
		<div class="titlebg">Forum Panel</div>
			- <a href="?act=viewranks">View Ranks</a><br />
			- <a href="?act=achview">Forum Achievements</a>
		</nav>
	</div>
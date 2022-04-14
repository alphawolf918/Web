<?php
if(!isset($_POST["check"])) exit("Error!");
require 'functions.php';
connect();
switch($_POST["type"]){
	default:
		echo "Invalid";
	break;
	//Home
	case 1:
		?>
		<a href="forum.php"><img src="buttons/home_page.png" /> Forum Home</a>
		&nbsp; &nbsp;
		<a href="."><img src="buttons/website.png" /> Site Home</a>
		&nbsp; &nbsp;
		<?php
	break;
	//Members
	case 2:
		?>
						<a href="?act=members"><img src="buttons/group.png" /> Members</a>
						&nbsp; &nbsp;
						<a href="?act=searchmembers"><img src="buttons/magnifier.png" /> Search</a>
						&nbsp; &nbsp;
		<?php
		if(online()){
		?>
		<a href="?act=friendrequests"><img src="buttons/group.png" /> Friend Requests</a>
		(<?php 
		echo numRows("SELECT id FROM freq WHERE touser = '".$_COOKIE["id"]."'"); 
		?>)
		&nbsp; &nbsp;
		<a href="javascript:;" onclick="nWin('participated.php');"><img src="buttons/award_star_gold_1.png" /> Participated</a>
		&nbsp; &nbsp;
		<a href="?act=pmcenter"><img src="buttons/mail_box.png" /> Inbox</a>
		&nbsp; &nbsp;
		<a href="?act=profile"><img src="buttons/user.png" /> My Profile</a>
		&nbsp; &nbsp;
		<a href="?act=bookmarks"><img src="buttons/book.png" style="height:18px;width:18px;" /> Bookmarks</a>
		&nbsp; &nbsp;
		<a href="?act=logout"><img src="buttons/door_out.png" /> Log Out</a>
		&nbsp; &nbsp;
		<?php
		}else{
		?>
		<a href="?act=register"><img src="buttons/application_form_add.png" /> Sign Up</a>
		&nbsp; &nbsp;
		<a href="?act=login"><img src="buttons/door_in.png" /> Log In</a>
		<?php
		}
		?>
		<?php
		break;
		//General
		case 3:
			?>
			<a href="?act=updates"><img src="buttons/world.png" /> Site Updates</a>
			&nbsp; &nbsp;
			<a href="forum.php?act=topic&id=217"><img src="buttons/book.png" style="height:18px;width:18px;" /> Rules</a>
			&nbsp; &nbsp;
			<a href="?act=calendar"><img src="calendar.gif" style="height:18px;width:18px;" /> Calendar</a>
			&nbsp; &nbsp;
			<a href="?act=journals"><img src="buttons/clipboard.png" style="height:18px;width:18px;" /> Journals</a>
			<?php
		break;
		//Staff
		case 4:
			AuthCheck(4);
			?>
			<a href="?act=cpanel"><img src="buttons/key.png" /> Admin CP</a>
			&nbsp; &nbsp;
			<a href="?act=ipcenter"><img src="buttons/ip.png" /> IP Center</a>
			&nbsp; &nbsp;
			<a href="?act=bannedusers"><img src="buttons/ip_block.png" /> Banned Users</a>
			&nbsp; &nbsp;
			<a href="?act=viewlogs"><img src="buttons/note.png" /> View Logs</a>
			&nbsp; &nbsp;
			<a href="?act=addupdate"><img src="buttons/bullet_add.png" /> Add Update</a>
			<?php
	break;
		//Extras
		case 5:
			?>
			<a href="chao.php"><img src="ucgimages/new.gif" /> Dreamer Chao</a>
			&nbsp; &nbsp;
			<a href="?act=achview"><img src="buttons/star.png" /> Medals</a>
			&nbsp; &nbsp;
			<a href="?act=viewranks"><img src="buttons/cats_display.png" /> View Ranks</a>
			&nbsp; &nbsp;
			<a href="?act=colors"><img src="buttons/color_wheel.png" /> Name Colors</a>
			<?php
	break;
}
?>
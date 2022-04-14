<?php
	ob_start();
	require 'ext/startup.php';
	$path = ($_SERVER["REMOTE_ADDR"] == "127.0.0.1" OR $_SERVER["REMOTE_ADDR"] == "::1") ? "./?p=" : "./";
	$currentPage = $_SERVER["QUERY_STRING"];
	$currentPage = str_replace("p=", "", $currentPage);
	//echo $currentPage;
?><!doctype html>
<html xmlns:fb="http://ogp.me/ns/fb#">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta http-equiv="Content-Language" content="en-US" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<meta name="description" content="All of Zollern Wolf's and Zane's mods in one place." />
			<meta name="keywords" content="zollern wolf, zane, mods, minecraft, forge, 1.7.10, 1.8.9, extras, custom blocks, modding tutorials, web site, technic, tekkit" />
			<meta name="subject" content="Minecraft Mods" />
			<meta name="revisit-after" content="1 day" />
			<meta name="robots" content="NOODP,index,follow" />
			<meta name="author" content="Zollern Wolf, admin@zollernverse.org" />
			<meta name="reply-to" content="admin@zollernverse.org" />
			<meta name="HandheldFriendly" content="true" />
			
			<!-- Begin Open Graph Protocol -->
			<meta property="og:title" content="zTech+ Mods - Official Web Site" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="http://ztech.zollernverse.org" />
			<meta property="og:image" content="http://www.zollernverse.org/favicon.ico" />
			<meta property="og:description" content="All of Zollern Wolf's mods in one place." />
			<meta property="locale" content="en_US" />
			<meta property="og:site_name" content="Zollern Wolf&039;s Official Mod Web Site" />
			<!-- End Open Graph Protocol -->
			
			<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
			<link rel="shortcut icon" href="favicon.ico" />
			<script type="text/javascript" src="jscripts/main.js"></script>
			<title>zTech+ Web</title>
		</head>
		<body>
			<div id="container">
				<div id="logoContainer">
					<img src="images/logo2.png" class="logo" alt="[zTech+ Logo]" title="zTech+" onclick="window.location.href='<?php echo $path; ?>home';" />
				</div>
				<nav id="navContainer" style="overflow: hidden;">
					<div class="glare" style="padding: 2% 0; width: 100%; height: 5%;"></div>
					<table cellspacing="4" cellpadding="4">
						<tr class="navRow">
							<td class="navCell emptyCell">
								
							</td>
							<td class="navCell" <?php
								if($currentPage == "" OR $currentPage == "home"){
									echo 'id="specialNavCell"';
								}
							?>>
								<div class="navButton" style="margin-left: 4%;">
									<a href="<?php echo $path; ?>home" class="navLink">Home</a>
								</div>
							</td>
							<td class="navCell"<?php
								if($currentPage == "about"){
									echo 'id="specialNavCell"';
								}
							?>>
								<div class="navButton">
									<a href="<?php echo $path; ?>about" class="navLink">About</a>
								</div>
							</td>
							<td class="navCell">
								<div class="navButton">
									<a href="http://www.zollernverse.org/forum.php" class="navLink" onclick="window.open(this.href);return false;">Forum</a>
								</div>
							</td>
							<td class="navCell"<?php
								if($currentPage == "download" OR $currentPage == "downloads"){
									echo 'id="specialNavCell"';
								}
							?>>
								<div class="navButton">
									<a href="<?php echo $path; ?>downloads" class="navLink">Downloads</a>
								</div>
							</td>
							<td class="navCell">
								<div class="navButton">
									<a href="https://github.com/alphawolf918/" class="navLink" onclick="window.open(this.href);return false;">GitHub</a>
								</div>
							</td>
							<td class="navCell"<?php
								if($currentPage == "donate"){
									echo 'id="specialNavCell"';
								}
							?>>
								<div class="navButton">
									<a href="<?php echo $path; ?>donate" class="navLink">Donate</a>
								</div>
							</td>
							<td class="navCell"<?php
								if($currentPage == "server" OR $currentPage == "servers"){
									echo 'id="specialNavCell"';
								}
							?>>
								<div class="navButton">
									<a href="<?php echo $path; ?>server" class="navLink">Server</a>
								</div>
							</td>
							<td class="navCell">
								<div class="navButton">
									<a href="http://www.zollernverse.org/wiki/index.php" class="navLink" onclick="window.open(this.href);return false;">Wiki</a>
								</div>
							</td>
							<td class="navCell lastCell">
							</td>
						</tr>
					</table>
				</nav>
				<div class="hsep">
					<noscript>You must have JavaScript enabled in order to use this site properly.</noscript>
					Web site built from scratch & by hand by Zollern Wolf of <a href="http://design.zollernverse.org/" onclick="window.open(this.href);return false;" class="externalLink">Zollern Web Design</a>. Content is copyright &copy; to its respective owners.
				</div>
				<div id="mainBody">
					<?php
							switch($_GET["p"]){
								default:
									changeTitle("Home");
					?>
					<div class="titleBar">
						<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						zTech+ &raquo; Home
					</div>
					<div class="text">
						Welcome to the official web site for <strong>zTech+</strong>, our beautiful Minecraft server.
						<br />
						<br />
						&bull; To download one of our mods, please go to the <strong>Downloads</strong> page.
						<br />
						&bull; If you have a question about something, please contact us at our <strong>Forum</strong>.
						<br />
						&bull; Curious about how something in one of our mods works? Check out our <strong>GitHub</strong> repository for source code!
						<br />
						&bull; For us to keep our server up and running, the server admins (Zane, Mike and I) have to team up to pay it. If you would like to help support us (so that maybe we can even get more space and cooler stuff!), then please consider <strong>Donating</strong> to help us out.
						<br />
						&bull; Need a server to play on? Check out our <strong>Server</strong> page for details!
					</div>
						<?php
							break;
							case 'about':
								changeTitle("About");
						?>
					<div class="titleBar">
						<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						zTech+ &raquo; About
					</div>
					<div class="text">
						<strong>zTech+</strong> is the collective name of all of our Minecraft mods and plugins that we have developed. We currently do not have a wiki set up for our mods, but we plan to change this eventually. You can download any version of any of our mods here, and later we will add plugins and schematics, as well. We will also eventually have videos up, via our Let's Play channel, <a href="https://www.youtube.com/channel/UCl-u6cPQ1lpD_RvzA_SsN7A" onclick="window.open(this.href);return false;" class="externalLink">Howling Avengers</a>. I also plan to write a few modding tutorials, though they will be for 1.7.10 only. You can also get all of the information and items that you require in order to play on our heavily-modded Minecraft server on the <strong>Server</strong> page.
						<div class="br"></div>
					</div>
						<?php
							break;
							case 'downloads':
							case 'download':
								changeTitle("Downloads");
							?>
						<div class="titleBar">
							<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						zTech+ &raquo; Downloads
						</div>
						<div class="text">
							All of our currently active Minecraft mods are listed below.
						</div>
					<div class="titleBar" style="margin-top: 8%; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;">
						<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						Zollern Extras
					</div>
					<div class="titleBar" style="margin-top: 25%; border-radius: 0px;">
						<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						Zane Extras
					</div>
							<?php
							break;
							case 'donate':
								changeTitle("Donate");
							?>
						<div class="titleBar">
							<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						zTech+ &raquo; Donate
						</div>
						<div class="text">
							givez us da moneyz
						</div>
							<?php
							break;
							case 'server':
								changeTitle("Server Details");
							?>
						<div class="titleBar">
							<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						zTech+ &raquo; Server Information
						</div>
						<div class="text">
							<h1>Using Our Minecraft Server</h1>
							Anyone is welcomed to play on our server, so long as they adhere to our very basic, common sense <a href="<?php echo $path; ?>rules" class="externalLink">Rules</a>. Setting it up the first time can be a little complicated, but after that it's very easy to update (with just a push of a button!).
							<div class="br"></div>
							<h2>Installation</h2>
							<ol>
								<li>First, you will need to download the <a href="http://www.technicpack.net/download" onclick="window.open(this.href);return false;" class="externalLink">Technic Launcher</a>.</li>
								<li>You will need to use <a href="http://www.oracle.com/technetwork/java/javase/downloads/jre7-downloads-1880261.html" onclick="window.open(this.href);return false;" class="externalLink">Java 7 x64 bit</a> in order to play on our actual modpack. It <em>might</em> work with Java 8, but again, be sure to get x64 bit.</li>
								<li>Next, you will need to install our modpack. You can get our modpack URL by clicking <a href="http://www.technicpack.net/modpack/zverse" onclick="window.open(this.href);return false;" class="externalLink">here</a>. The instructions for how to install it are there, but I will explain them as well: click on <strong>Install This Modpack</strong>, and it will ask you to copy a URL. Once you have that copied, paste it into the Search box of the launcher on the <strong>Modpacks</strong> tab, and it should find it. Click on Install and let it do its thing (this can take a while).</li>
								<li>On the <strong>Modpacks</strong> tab, click on <strong>Launcher Options</strong> on the top right, and then on <strong>Java Settings</strong>. Choose the Java 7 (<strong>1.7.####</strong>) version, or any other x64 bit Java that you have installed (though don't go any lower than 7). Allocate (at minimum) 4 GB to our modpack, but you shouldn't actually need anymore than 6 GB (if you have more to spare). <strong>Note:</strong> In order to allocate 4 GB to our modpack, you will need to have a computer with 6 GB RAM installed minimum. If you're confused about this, please feel free to contact us on our forum. Click OK and then you should be good to go.</li>
								<li>Once you're loaded in, you may join our server at <strong>209.222.104.133:25565</strong>. Happy Minecrafting!</li>
							</ol>
							<div class="br"></div>
							Again, if any of this process confuses you or if you have any questions, you can contact us at our forum and we will be more than happy to assist you.
						</div>
							<?php
							break;
							case 'wiki':
							?>
						<div class="titleBar">
							<div class="glare" style="height: 4%; padding-top: 0.6% !important; margin-top: 0.6%; z-index: 1;">&nbsp;</div>
						zTech+ &raquo; Wiki
						</div>
						<div class="text">
							Under Construction
						</div>
							<?php
							break;
							case 'rules':
								changeTitle("Server Rules");
									?>
						<div class="titleBar">
							<div class="glare" style="top: 0; left: 0; height: 4%; z-index: 1;">&nbsp;</div>
						zTech+ &raquo; Server Rules and Advisements
						</div>
						<div class="text">
							Most of our "rules" are really just common sense: don't be a jerkbag and don't cheat. Pretty simple. But for formality's sakes (and to cover our booty butts later), our actual rules are listed (in a silly way, to promote humor and fun) below. Please adhere to them so that everyone can have the best server experience possible. Thank you.<div class="br"></div>
							<div class="br"></div>
							<strong>Note:</strong> If you break any of these rules, I will torment and screw with you on the server, without end, myself. òبó
							<div class="br"></div>
							<div class="br"></div>
							<ol>
								<li><strong>NO STEALIES THE STUFFS.</strong> Don't be takin' stuff that belongs to someone else - earn it yourself if you need it that badly.</li>
								<li><strong>DON'T DO THE CHEATY CHEATS.</strong> This includes X-Raying, getting stuff from creative (if you're an op, in which case you should know better), or any other kinda way that gives you an advantage over everyone else. NEI, Waila, OptiFine, and Rei's Mini Map are included with this modpack, so really you shouldn't need anything else anyway.</li>
								<li><strong>plz dnt ask 2 b op lol.</strong> We have too many already, and only the original members (that have been with us since the beginning) and those who have helped us time and time again can be opped. In short: "can i be op plz" LOL NO.</li>
								<li><strong>DON'T HURT OR KEELZ THE ANIMULS.</strong> Some of the mobs (such as the Wyvern from Mo'Creatures and my Baby Ender Dragon from Zollern Extras) are very difficult and/or time-consuming to tame or obtain, and require a lot of hard work and time. Some Players become attached to their pets and will likely endeavor upon a personal, bloody vendetta, should you harm or otherwise kill any of their pets. If it's outside, not around houses, doesn't have a name tag, and there isn't someone chasing it (perhaps shouting "COME HERE YOU PIECE OF SH*bleep*!"), then it's probably okay. It's usually pretty obvious to tell when a mob is someone's pet. If you're not sure, ask. <strong>Note:</strong> Asking "can I kill this Wyvern/Dragon outside your house" may not end very well for you. We are not responsible for injuries as a direct result of a Player's own stupidity.</li>
								<li><strong>DON'T PLANT THE SACRED RUBBER TREE SAPLING FOR THE LOVE OF GOD.</strong> I'm looking at <em>you</em>, Zane. This is an ENORMOUS tree from MineFactory Reloaded, and I mean it is big enough to take up a few <em>THOUSAND</em> blocks. It's big enough that when it grows, it crashes the server, and then we have to restart it, and usually that means that the world didn't have time to save, and then when we do load back in, the tree isn't even there, because it made the server crash before it could be planted. Also, if it DOES still survive the crash, you won't be able to be around it without your game freezing. Mike and I have top of the line computer technology, and we can't even get around it. The MEGA RUBBER SAPLING is fine, but <strong>NOT</strong> the SACRED one! If you're truly curious about it, please do it in Single Player. Please.</li>
								<li><strong>DON'T BREAK THE HOMESIES OF OTHER PLAYER BEINGS.</strong> A lot of people work very hard on their bases, myself included. Don't be that guy (or girl, for the smarty butts out there). We also have a mod called Ruins that pastes structures and stuff into the world. Those are okay to destroy and are usually pretty obvious as to what they are. They typically won't have lights, will be made of vanilla blocks, be small, or be empty. Again, if you're not sure, ask. We have some pretty creative people though, so you'll likely be able to tell if a build actually belongs to a Player or not. Heck, maybe you could even turn a Ruins structure into a base.</li>
							</ol>
							<div class="br"></div>
							That's pretty much it. As I said, a lot of these "rules" are really just common sense. So just be nice to each other and respect everyone else's stuff. The biggest rule of all? Have fun!
						</div>
									<?php
								break;
						}
						?>
					</div>
				</div>
				<div id="footer" style="height: 80%; margin-top: 35%;">&nbsp;</div>
			<script type="text/javascript" src="jscripts/external.js"></script>
		</body>
</html><?php
	ob_end_flush();
?>
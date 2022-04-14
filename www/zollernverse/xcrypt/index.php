<?php
ob_start();
	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if (strlen(strstr($agent, 'Firefox')) > 0) {
			$browser = "Firefox";
		} else if (strlen(strstr($agent, 'WOW64')) > 0){
			$browser = "IE";
		} else if (strlen(strstr($agent, 'Chrome')) > 0){
			$browser= "Chrome";
		}
	}
?><!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="A simple complex-password generator, with various customization options." />
		<meta name="keywords" content="password,security,generator,random,complex,simple,advanced,new,customize,customization" />
		<meta name="author" content="Paul Shannon; Alpha Wolf" />
		<meta name="application-name" content="XCrypt Secure" />
		<link rel="stylesheet" type="text/css" href="styles.css" media="all" />
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="main.js"></script>
		<script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "0b868c1f-12c0-4bcb-b5d0-f351dac630a3", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
		<title>XCrypt Secure - Security Starts With YOU!</title>
	</head>
	<body>
		<section class="container">
			<div class="title">XCrypt Manager</div>
			<section class="content">
				<form action="javascript:generatePassword();" method="post">
				<fieldset>
					<legend>Password Generator</legend>
				<div class="cblock">
					<label for="base" style="vertical-align: top;">Base:</label>
					 <input type="text" size="27" name="base" class="form-control" list="sites" id="txtBase" placeholder="(e.g., Facebook, YouTube, etc..)" />
					 <datalist id="sites">
						<?php
							$sites = array("facebook","youtube","tumblr","yahoo","google","twitter","linkedin","skype","instagram","joomla","evernote","dashlane","microsoft","playstation","nintendo","sony","samsung","twitch","ustream","xbox","msn","pandora","last.fm");
							sort($sites);
							foreach($sites as $entry){
								echo '<option value="'.$entry.'">'.ucfirst($entry).'</option>';
							}
						?>
					 </datalist>
				</div>
				 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
				<div class="cblock">
					<label for="length" style="vertical-align: top;">Length:</label>
						<input type="range" name="length" class="form-control" value="15" defaultvalue="15" min="10" max="40" oninput="nmbr();" id="txtLength" />
					 <span id="nmbr" class="cblock">15</span>
					 <div id="warning"></div>
				</div>
				<div style="height: 18px;"></div>
					<input type="checkbox" name="symbols" id="txtSymbols" />
					<label for="symbols" style="vertical-align: top;">Use symbols</label>
					<div></div>
					<input type="checkbox" name="rev" id="txtRev" />
					<label for="rev" style="vertical-align: top;">Reverse String</label>
					<div style="text-align: right;">
					<label for="number">Generate <input type="number" value="1" required="1" style="width: 5%;" class="form-control" min="1" max="5" name="number" id="txtNumber" /> password(s).</label>
					</div>
					<div style="text-align: right;">
					<input type="checkbox" name="ul" id="txtUl" /> <label for="ft">Use the first <input type="number" value="2" required="1" style="width: 5%;" class="form-control" min="0" max="3" name="ft" id="txtFt" /> character(s) of the base.</label>
					</div>
					<div style="height: 5px;"></div>
					<button type="submit" class="formButton form-control" id="btnSubmit" onclick="$(this).html('Regenerate');">Generate</button>
				<div id="password" class="cblock">
				<div class="subtitle">Generated Password(s)</div>
				<div id="pw"></div>
				</div>
				</fieldset>
				</form>
				<div id="author">
					By <a href="http://chaobreederxl2.proboards.com/user/1" onclick="window.open(this.href);return false;">Paul</a> (a.k.a Zollern Wolf)
					<div style='text-align: center;'>
					<?php
					if($browser != "Firefox"){
						echo "This Web site is best viewed in Firefox.";
					}
					?>We recommend <a href='http://www.dashlane.com/' onclick='window.open(this.href);return false;'>Dashlane</a> as an amazing password manager!
					<div></div>
					Curious how strong your password is? Click <a href="https://howsecureismypassword.net/" onclick="window.open(this.href);return false;">here</a>!
					</div>
					<div style="height: 8px;"><a href="#" onclick="showSection('about');">About...</a></div>
				</div>
				<div id="share">
					* These share this page, not any of the generated passwords.
					<div></div>
					<span class='st_sharethis_hcount' displayText='ShareThis'></span>
					<span class='st_facebook_hcount' displayText='Facebook'></span>
					<span class='st_twitter_hcount' displayText='Tweet'></span>
					<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
					<span class='st_pinterest_hcount' displayText='Pinterest'></span>
					<span class='st_email_hcount' displayText='Email'></span>
				</div>
			</section>
		</section>
		<section id="about">
			<div class="title">About XCrypt</div>
			<div style="height: 6px;"></div>
			<div style="text-indent: 2%;" class="aboutText">
				(<a href="#" onclick="showSection('about');">hide</a>)
				<strong>XCrypt Secure</strong> is a complex-password generator. We value nothing but the highest security in today's Web world, and that's exactly what we wish to deliver. XCSPG (XCrypt Secure Password Generator) is but the first of a line of freeware Web Apps to make Internet life and security easier and more efficient. As you can see, the password generator comes with customization options, and can be as complex, or (if it need be) as simple as you would like. However, even the simple passwords can be difficult to crack. Everything about the passwords is completely random and unguessable. It's true that they can be hard to remember, but that's where <a href="http://www.dashlane.com/" onclick="window.open(this.href);return false;">Dashlane</a> comes in! It remembers passwords for you in a secure environment, and will even log you in to your favorite Web sites automatically. If you don't like the idea of trusting a machine with your passwords, though, then we recommend you store them in a text file (Notepad, TextPad, etc.) on a USB flash drive, if possible. It's a secure way to make sure that you and <em>only</em> you can access your data. Below, you can find an explanation for each of the generator's features.
				<ul>
					<li><strong>Base</strong> - This is the base string that the password will be based on. It also can help you to remember what site the password is for.</li>
					<li><strong>Length</strong> - This is just the length of the password. Note that many sites (Facebook and AOL for example) tend to complain if you have a password longer than 20, and sometimes even 16 characters. The minimum amount that this generator allows your password to be is 10 characters long, but it is recommended that you go above that, at least to 13. The maximum is 40. Note also that as you change the length, the number beside the form field will update.</li>
					<li><strong>Use Symbols</strong> - Allows symbols (special characters: $,#,@,%,!, etc.) to be a part of the password. This is highly recommended as it increases the <a href="http://en.wikipedia.org/wiki/Password#Password_longevity" onclick="window.open(this.href);return false;">lifetime of the password</a>.</li>
					<li><strong>Reverse String</strong> - Simple enough, this just reverses the password that would normally generate, giving you the password backwards. Useful if you wanna change things up a bit.</li>
					<li><strong>Generate N Password(s)</strong> - Generates N number of passwords where N is a number from 1 through 5.</li>
					<li><strong>Use The First N Characters of The Base</strong> - This only works if a base is provided, but can include the first N (0 - 3) character(s) of the base into the password, helping you to remember what it was for. It is strongly recommended that if this feature is used, you alternate between reversing the string and not reversing the string.</li>
				</ul>
			</div>
		</section>
		<div style="height: 10px;"></div>
	</body>
</html><?php
ob_end_flush();
?>
<?php
	ob_start();
	require 'lib/functions.php';
	if($_SERVER["REMOTE_ADDR"] != "::1" AND $_SERVER["REMOTE_ADDR"] != "127.0.0.1"){
		$con = mysql_connect("mysql.zollernverse.org","jzollern","X1R56G09MJ3JFz?3") OR exit("Connection error.");
		$db = mysql_select_db("zweb",$con) OR exit("Database error.");
	}else{
		$con = mysql_connect("localhost","root","giga") OR exit("Connection error.");
		$db = mysql_select_db("zweb",$con) OR exit("Database error.");
	}
?><!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="subject" content="Web Development" />
		<meta name="description" content="Zollern Web builds and designs beautiful, dynamic web sites and user interaction media with quality and affordability." />
		<meta name="keywords" content="zollern wolf, web site, design, dynamic, user interaction, media, affordable, paul shannon, developer, programmer, beautiful, services" />
		<meta name="revisit-after" content="1 day" />
		<meta name="robots" content="NOODP,index,follow" />
		<meta name="author" content="Paul T Shannon Jr, admin@zollernverse.org" />
		<meta name="reply-to" content="admin@zollernverse.org" />
		<meta name="HandheldFriendly" content="true" />
		<link rel="stylesheet" type="text/css" href="styles/main.css" media="screen and (min-width: 640px)" />
		<link rel="stylesheet" type="text/css" href="styles/mobile.css" media="screen" />
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
		<title>Zollern Web</title>
	</head>
	<body>
		<noscript style="color: #f00;">** You must have JavaScript enabled for this site to function properly.</noscript>
		<section class="container">
			<section class="header">
				<div class="logo">
					<img alt="logo" src="images/logo.png" class="siteLogo" onclick="document.location.href = './home';" />
				</div>
				<div class="tagLine">
					I am a freelance web designer that loves building web sites from scratch. It's my passion, my work of art. I'm very easy to work with and affordable. If I build it, they will come. I turn "impossible" into "I'm possible."
					<div></div>
					&raquo; <a href="./hire-me" class="hireMe">Hire Me</a>
				</div>
			</section>
			<div class="contentBreak34"></div>
				<nav class="navMenu">
					<div class="aquaButton">
						<div class="glare"></div>
						<a href="./home">Home</a>
					</div>
					<div class="aquaButton">
						<div class="glare"></div>
						<a href="./about">About Me</a>
					</div>
					<div class="aquaButton">
						<div class="glare"></div>
						<a href="./contact">Contact</a>
					</div>
					<div class="aquaButton">
						<div class="glare"></div>
						<a href="./services">Services</a>
					</div>
					<div class="aquaButton">
						<div class="glare"></div>
						<a href="./policy">Policy</a>
					</div>
				</nav>
			<section class="content">
				<div class="contentBreak25"></div>
				<div class="contentBreak100"></div>
						<div class="subContents">
				<?php
					switch($_GET["p"]){
						default:
							changeTitle("Home");
							?>
								Welcome to <strong>Zollern Web</strong>. Here, you can get an idea of what kind of web services I offer, and what kind of plans you might want. There's also a brief history about my web experiences since I started learning in 2003, for anyone who might be interested in ways to learn the same concepts that I have, and to show that anything is possible once you set your mind to it. Please take your time to look around and familiarize yourself with everything, and if you wish to contact me, then please don't hesitate (just don't spam me, either). I take pride in my work, and I work hard to ensure that I get it right. Programming and web site development come naturally to me - I've been tinkering with PC software since I was about eight or nine years old, and I have always loved the ecstatic feeling of <em>creating</em>. Even when I'm sleeping, I'm usually thinking of ways to improve my work, or how to create something new.
								<div style="height: 20px;"></div>
								<h1>Why You Should Hire Me</h1>
								<div style="height: 20px;"></div>
								 &nbsp; &nbsp; <span style="font-size: 14px; font-weight: bold; font-style: italic;">I'm...</span>
								<ol>
									<li><strong>Easy to work with.</strong> I manage my projects effectively and I communicate with you frequently to be sure that you're getting your money's worth.</li>
									<li><strong>Friendly.</strong> It's generally very difficult to find someone <em>real</em> in the world anymore, someone with a <em>positive</em> outlook. I believe in spreading good vibes all around. This means showing that I'm human, and not just some worker bee robot.</li>
									<li><strong>Flexible.</strong> If for some reason you wish to upgrade or downgrade your plan, it won't be a problem.</li>
									<li><strong>Understanding.</strong> If you're struggling to pay, then maybe we can work out some sort of payment plan. This will vary depending on the situation, however. This is not a get-out-of-paying-free card.</li>
									<li><strong>Knowledgeable.</strong> Everything I know is self-taught, and I work all from my head. In other words, I make web sites from scratch, without using any programs other than syntax highlighters, generally Notepad++. This also means that I can find errors and workarounds that most people wouldn't even think of.</li>
									<li><strong>Affordable.</strong> Most web developers charge outrageous prices like $75 an hour, and that's considered cheap in today's world. <strong>Zollern Web</strong>, however, charges based upon a "plan" system (Bronze, Silver, Gold, or Platinum), and sells <a href="./warranties" style="color: #00f; font-weight: bold; font-size: 12px;" onclick="window.open(this.href);return false;">Warranties</a> separately. Each plan is allocated a certain number of hours, and I do charge hourly if those hours are exceeded. But I only charge for the hours that I spend working on the web site, and I don't charge much for going over, generally between $10 - $15. I also sell <a href="./hosting" style="color: #00f; font-weight: bold; font-size: 12px;" onclick="window.open(this.href);return false;">Hosting Setups</a> separately. </li>
									<li><strong>Talented.</strong> I know at least 26 different kinds of programming and markup languages, and am fluent in at least 14 of them. Did I mention that everything I know is self-taught? That's a lot of reading right there -- and a lot of dedication.</li>
									<li><strong>Advisable.</strong> I will make suggestions to you, and will listen to yours, regarding the web site. It won't be just you telling me and then me doing it; I will communicate back with you, and offer suggestions as to the look, load time, etc. Two seconds may not sound like a long load-time to you, but it could always be better. That being said, they are just suggestions. I just like to make sure that you get your money's worth.</li>
									<li><strong>Not a know-it-all jerk.</strong> Believe me, I understand the frustrations that people have regarding developers because honestly, half of them don't listen to their customers, and generally have an excuse like "well, I know more than you, so I know what's best." I don't believe in doing that. I will advise you, but I will do so politely and maturely, without being degrading or unprofessional. There are a lot of web developer businesses out there, but you're going to be hard-pressed to find someone as polite and affordable as I am. I'm a strong believer in connecting with the customer and treating the work like we're working together on a college project (which I have always aced in web and programming stuff). That means that I won't stop until I get a 100%.</li>
									<li><strong>Not lazy.</strong> I will work hard on your project, but it will not be just thrown under the rug for me to get to "when I feel like it." No, I'm going to make sure I get it done, and that I get it done right, guaranteed!</li>
								</ol>
							<?php
						break;
						case 'about':
							changeTitle("About Me");
							?>
								 &nbsp; &nbsp; My name is Paul Shannon, Jr., and I have been coding and programming since 2003. I learned HTML (the most basic, first thing you should learn) when I was 12, after I created an MSN group (back when they were still around) and was working on a page. I clicked on the <strong>View HTML</strong> button and started tinkering and editing things until I found out what changed and how to alter the page. After learning this way for a while, I finally bought an HTML book and my web building really started to take off. Then I started experimenting with web sites on Freewebs (which is called just "Webs" now), and ran a few video-game-themed forums. At the end of the HTML book, there were a couple of basic JavaScript tutorials, so I started tinkering with those, and then bought a JavaScript book. In the middle of learning that, I heard about CSS and started learning that as well. Naturally, while reading and learning both of these, I learned how to combine the two of them together, as well as with HTML. This was called DHTML back in the day, and it's still useable, but there are new web technologies out now that pretty much make that obsolete. At the time, though, this was one of the leading technologies. Around 2005, one of my friends showed me PHP, and then later, MySQL, and how it could be used on the web. These two combined with everything else revolutionized the way I wrote my code, and they still do today. It was during this time, between 2005 and 2012, that I ran several different web sites, one which I built from the ground up. I wrote my own very basic but efficient forum software, all from my head, none of it from a program. Although I did require <em>some</em> help from a buddy of mine for concepts, I wrote everything myself. JQuery came out a few years later, and I didn't really start learning it until around 2012, but now I use it all the time, and it's arguably the best web tool out there. I've also used .htaccess for years, but really didn't start learning it efficiently until 2014. In 2010, after having used web technologies for ~7 years, I decided to write my own, called <a href="https://sourceforge.net/projects/extensiveserver/" onclick="window.open(this.href);return false;" style="color: #00f; font-size: 13px;">eXtensive Server Path</a>, although at the time it was called fileQuery, and I abandoned it after a few months. In 2012 I picked back up the project, and renamed it to its name that it still has today. Essentially, it's designed for querying a file system, primarily XML files, much in the same way that SQL is used for querying databases. It's been a lot of fun writing my own language, and I'm hopeful that someday its potential will be recognized. I have written web sites for people, and have worked on web sites for many others as I was growing up. Computer science comes naturally to me, it's basically like fluently speaking another language. Everything I know is self-taught, using books, web articles, the help of friends, Google, and dissecting the source code of other projects to understand how they work. When I was in college, I wound up being the go-to person for all things tech, primarily programming and web design. In many instances, I knew more than the professors did, and found glitches and incorrect questions in the quizzes and groupwork that otherwise would have made things impossible. Of course, I didn't just <em>say</em> it was wrong; I was able to show the professor (I had the same one for those classes) what I meant and prove my point (quite politely, of course). I actually wound up helping to teach the web design class, and because of this, students petitioned for me to be a programming tutor. This lasted for a good 6 or so months, maybe more, until a financial dispute caused me to leave. However, this same professor helped me get the job that I have now by talking to one of the adjunct professors, who is the accountant at where I work. She shot me an e-mail on behalf of the C.E.O., requesting my résumé. About 10 minutes after I sent the e-mail with my résumé attached, I received a call from the C.E.O., asking me to come in for an interview the next morning. Naturally, this went very well, as I scored the highest on their personality test that they had in 10 years, and I was 2 points above that person's score. I still work at <a href="http://www.gigainc.com/" onclick="window.open(this.href);return false;" style="color: #00f; font-size: 13px;">GIGA Incorporated</a>, and even helped redesign the web site and its contents, down to its core. I have also created for them an Intranet web site to digitize clocking in and out, calendar events, etc. I have had this job as an "I.T. Guy" ever since, and am quite happy with it. As I mentioned earlier, I did take CIS classes in high school and in college, but in many instances I knew more than the teacher/professor did. I took them because I had to, essentially. One of the benefits of hiring me as your web developer is this: I write everything by hand, line for line, without using a program to do it for me. That's rare in today's world. I also spell-check and proof-read everything that I write, and if I find a mistake or glitch, I will keep working at it until the problem is resolved. Web design is my work of art, my passion, and I work hard to ensure that I get it right. When I say "art", by the way, I don't mean something like Picasso. I guarantee you that your web site will make sense. I've been told that I should be getting paid to do web work for years, and I'm happy to be doing it now. Check my Portfolio page for screenshots of the work I've done, as well as some live examples. As I mentioned earlier, I also redesigned GIGA's web site, so have a look at that as well. Check out the <a href="./hire-me" style="color: #00f !important;">Hire Me</a> page to see what kind of <strong>plans</strong> I offer, and let's see what's right for you.
 							<?php
						break;
						case 'contact':
							changeTitle("Contact Me");
								if(isset($_POST["submit"])){
									query("INSERT INTO messages(name,email,message)VALUES('".sqlEsc($_POST["name"])."','".$_POST["email"]."','".sqlEsc($_POST["message"])."')");
									echo "Your message was sent.";
								}else{
							?>
								 &nbsp; &nbsp; For privacy reasons, I don't like giving out my cellphone number publicly. However, you may fill out the form below and it will automatically e-mail me.<br />
								 <br />
								 &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; Please remember, though, that I am quite busy. I may not respond right away; I will get back to you as soon as I can, so please don't keep e-mailing me over and over. That will put you below other clients in my queue. Thank you for your patience and understanding.
								 <div style="height: 25px;"></div>
								 <h2>Contact Form</h2>
								 <div style="height: 10px;"></div>
								 <p><span style="color: #f00;">*</span> denotes a required field.</p>
								 <form action="?p=contact" method="post">
									<p>
										<label for="name" class="formLabel">Your Name:</label> <span style="color: #f00;">*</span>
										&nbsp;<input type="text" class="form-control" name="name" id="txtName" required="1" />
									</p>
									<p>
										<label for="email" class="formLabel">Your E-Mail:</label> <span style="color: #f00;">*</span>
										<input type="text" class="form-control" name="email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" id="txtEmail" required="1" />
									</p>
									<p>
										<label for="message" class="formLabel">Your Message:</label> <span style="color: #f00;">*</span>
										<br />
										 &nbsp; &nbsp; <textarea cols="40" rows="5" name="message" id="txtMessage" required="1" class="form-control"></textarea>
									</p>
									<p style="margin-left: 13%;">
										<button type="submit" name="submit" class="formButton form-control" id="btnSubmit">Submit</button>
									</p>
								 </form>
							<?php
								}
						break;
						case 'policy':
							changeTitle("Policy");
							?>
							 <h2>Policy</h2>
							 &nbsp; &nbsp; Please understand that I do not work for free, regardless of the circumstances. I will be negotiable on prices, but not by too much. In other words: I'm negotiable, not stupid. Also, please be sure to buy a warranty along with your desired plan or service. This allows you to contact me if something goes wrong with the web site, and I will try to fix it with no cost, provided the warranty still applies. If one of our meetings or conversations gets loud or at all violent (including verbally), then I have the right to refuse service and may or may not contact the police. These are just things that exist for my protection as well as for my business. <strong>I do not do your homework for you.</strong> I'm only interested in real and professional clients - if you're being graded to make a web site, please make it yourself. Thank you.
							 <div style="height: 10px;"></div>
							 <h2>Warranties</h2>
							 &nbsp; &nbsp; 1 year - $30<br />
							 &nbsp; &nbsp; 2 years - $60<br />
							 &nbsp; &nbsp; 4 years - $90<br />
							 <br />
							 &nbsp; &nbsp; If, after the creation, you experience an error of any kind, I will be more than happy to fix it for you; however, whether the warranty applies or not (see below) will be the deciding factor of whether or not you’ll have to pay for the maintenance, or if I’ll even do it in some cases (voided warranties).<br />
							 <br />
							 &nbsp; &nbsp; <strong>** While under one warranty, you are not permitted to buy another - your original must expire, first.</strong>
							 <br />
							 <br />
							&nbsp; &nbsp; Please note, that even though warranties are provided, they are not limitless. Any of the actions below will render your warranty void regardless of the chosen plan, and therefore further work or maintenance will cost extra or may not happen at all, dependent on what went wrong:
							 <div style="height: 10px;"></div>
							 &nbsp; &nbsp; <h2>Warranty Voids</h2>
							 <div style="height: 5px;"></div>
							 <ul class="policies">
							 <li><strong>Tampering with the coding.</strong> Simple things such as the way something’s worded, or how something’s colored will not matter, but changing (or attempting to change) the way something functions or works, will. I will potentially still fix it, it will just cost money. As for how much, it depends on the error and how much work it took. <strong><em>** If you wish to just change text or something else simple, however, and something accidentally goes wrong, I will completely understand and not charge you for it, because usually it's just a missing tag.</em></strong> However, this will be under my judgment.</li>
							<li><strong>Hiring someone else to fix or edit my work.</strong> This makes it rather difficult to tell where my errors are, compared to where theirs are, so in order for me to address mine specifically, I need it clean. I will probably not fix it at this point, but if I do, it will cost much extra for breaking warranty. The amount it will cost is dependent upon how much work needed to be done. <strong><em>** If you had your buddy take a quick look at the site and do something as simple as repairing a tag or moving something somewhere else, that's okay. I'm only talking about major changes, here.</em></strong> Note though, that when I say "your buddy," I don't mean another web developer business, or another programmer for that matter. I do not wish to get two businesses or coding styles confused - it never ends well. Not to mention, it’s a big, confusing mess. So if you use mine, please stick with mine. It won't bother me, but it will void your warranty if you don't, and it is non-refundable, so please get your money's worth. If you feel you can change something, I highly encourage you to contact me first, because it makes everything so much easier.</li>
							<li><strong>Abuse of any of the systems or features.</strong> If I see that the site has been intentionally spammed or otherwise vandalized, I will not do anything about it (unless it was by an outside party such as a bot or a misbehaving member), as I don’t work to have it mistreated. Web sites are my work of art – I spend days if not weeks on them to make them absolutely perfect. If I am to include them in my portfolio, I need them to look presentable, so that I may show them to other, more interested clients. If the site is not presentable enough to be put in a portfolio, the warranty will expire.</li>
							<li><strong>Sites that criticize or otherwise mock a select individual or group (discrimination).</strong> It’s not right to have an entire web site dedicated to bashing someone. That is not why I create web sites and I will not have anything to do with those that do. If you have a web site like this and come across an error, find someone else. I refuse to work with this and FYI, it is illegal. I do not support bullying and will report it to the FCC if I find out.</li>
							<li><strong>Any encouragement of illegal activity.</strong> Much like the above, anything illegal is prohibited. As I said earlier, I need the money, but I also need the reputation, and I will not tolerate having it tarnished by acts such as this. Just like the above, I will report anything like this that I see. Asking me to “look the other way” will also lead to problems.</li>
							<li><strong>Inappropriate content (pornography, violence, drugs, alcohol, etc.).</strong> The first two examples of this are always prohibited no matter what – no exceptions. However, the latter two are acceptable only for doctor’s offices and pharmacies for legal drugs, and restaurants or bars for alcohol. Sites about getting “wasted” or getting “high,” anything to that effect, will not be tolerated and will cause the warranty to expire.</li>
						</ul>
							<?php
						break;
						case 'services':
							changeTitle("Services");
							?>
							The best way to find out about my services is to check out my <strong>Plans</strong> file. You can view it by clicking <a href="Plans.docx" style="color: #f00; font-size: 13px;">here</a>.
							<?php
						break;
						case 'portfolio':
							changeTitle("Web Portfolio (WIP)");
							echo "Under Construction..";
						break;
						case 'downloads':
							changeTitle("Downloads");
						break;
						case 'hireme':
							changeTitle("Hire Me!");
							if(isset($_POST["submit"])){
								$name = "Name: ".mysql_real_escape_string(addslashes($_POST["name"]));
								$email = "E-mail: ".mysql_real_escape_string(addslashes($_POST["email"]));
								$planType = "Plan: ".mysql_real_escape_string(ucfirst($_POST["plan"]));
								$extraDetails = "Details: ".mysql_real_escape_string(addslashes($_POST["details"]));
								if($_POST["18years"] == "true"){
									$extraDetails .= "\r\n\r\nUser is at least 18 years of age and agrees to the policies.";
								}else{
									$extraDetails .= "\r\n\r\nUser is NOT 18 years of age and/or did not agree to the policies.";
								}
								$message .= $name."\r\n".$email."\r\n".$planType."\r\n".ucfirst($extraDetails);
								query("INSERT INTO messages(name,email,message)VALUES('".$name."','".$email."','".$message."')");
								echo "Your message has been sent to me. I will review it shortly and then e-mail you. Thank you for your submission. I hope we can do business together.";
							}else{
							?>
								<h2>Hire Me!</h2>
								<div style="height: 15px;"></div>
								 &nbsp; &nbsp; &nbsp; &nbsp; If you wish to hire me, then first of all, great! Secondly, please make sure you've read my <a href="Plans.docx" style="color: #00f; font-size: 14px;">Plans</a> document and are comfortable with everything. I want my clients to be sure that they get their money's worth. That means making sure that they're well informed. To start off with, please fill out the form below, and when you're done, please click on <strong>Submit</strong>. This will send me a message and I will respond to it as soon as I can.<br />
								 <br />
								 &nbsp; &nbsp; &nbsp; &nbsp; <strong>Note:</strong> Payment is not yet required. We will talk first before you submit payment, to ensure customer satisfaction.
								 <br />
								 <br />
								 &nbsp; &nbsp; &nbsp; &nbsp; Please also take note of my <a href="./policy" style="color: #00f; font-size: 14px;">Policies</a> before you submit this form. Thank you!
								 <div style="height: 15px;"></div>
								 <div>
									<p>
										<span style="color: #f00;">*</span> indicates a required field.
									</p>
									<form action="?p=hireme" method="post">
										<p>
											<label class="formLabel" for="name">Name:</label> <span style="color: #f00;">*</span>
											<input type="text" class="form-control" name="name" id="txtName" required="1" placeholder="Enter name" />
											<br />
											<span class="tinyText">Please enter your name here that you would like to be called.</span>
										</p>
										<p>
											<label class="formLabel" for="email">E-Mail:</label> <span style="color: #f00;">*</span>
											<input type="text" class="form-control" name="email" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" id="txtEmail" required="1" placeholder="Enter email" />
											<br />
											<span class="tinyText">Please enter your e-mail so I can contact you.</span>
										</p>
										<p>
											<label class="formLabel" for="plan">Plan Type:</label> <span style="color: #f00;">*</span>
											<select name="plan" id="selPlan" class="form-control" required="1">
												<option value="">-------------------</option>
												<option value="bronze">Bronze ($250)</option>
												<option value="silver">Silver ($380)</option>
												<option value="gold">Gold ($520)</option>
												<option value="platinum">Platinum ($720)</option>
											</select>
											<br />
											<span class="tinyText">This is the desired plan for your order.</span>
										</p>
										<p>
											<label class="formLabel" for="colors">Colors:</label>
											<select name="colors" id="selColors" class="form-control">
												<option value="undecided">Undecided</option>
												<option value="cold">Something cold</option>
												<option value="warm">Something warm</option>
												<option value="mixture">A mixture of colors</option>
												<option value="complimentary">Complementary colors</option>
												<option value="solid">Solid color</option>
												<option value="shaded">Different shades of one color</option>
												<option value="blackwhite">Black & white</option>
											</select>
											<br />
											<span class="tinyText">This helps me get an idea of what you want the site to look like.</span>
										</p>
										<p>
											<label class="formLabel" for="details">Extra Details:</label>
											<br />
											 &nbsp; &nbsp; <textarea cols="45" rows="10" class="form-control" name="details" id="txtDetails" placeholder="Enter details"></textarea>
											 <br />
											 <span class="tinyText">Any extra details you'd like to mention.</span>
										</p>
										<div style="height: 10px;"></div>
										<p>
											 <input type="checkbox" value="true" name="18years" class="form-control" id="chkOver18" /> <label class="formLabel" for="over18">I am at least 18 years of age and agree to the policies stated on this web site.</label>
										</p>
										<div style="height: 10px;"></div>
										<p style="margin-left: 4%;">
											<strong>** If you're ready, click the <em>Submit</em> button below. You must be at least 18 years or older to order.</strong>
											<br />
											<button type="submit" class="form-control" style="height: 36px; width: 20%;" name="submit" id="btnSubmit" disabled="1">
												<div class="glare" style="height: 2px; width: 96%;"></div>
												Submit
											</button>
										</p>
									</form>
								 </div>
							<?php
							}
						break;
						case 'hosting':
							changeTitle("Hosting Setups");
							
						break;
					}
				?>
				</div>
			</section>
			<div style="height: 20px;">&nbsp;</div>
		</section>
		<footer>
			All content &copy; Paul T. Shannon, Jr. / Zollern Wolf <?php date("Y"); ?>
		</footer>
		<script type="text/javascript" src="scripts/external.js"></script>
	</body>
</html><?php
	mysql_close($con);
	ob_end_flush();
?>
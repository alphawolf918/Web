<?php
	ob_start();
	require 'lib/functions.php';
	require 'lib/connect.php';
	$isLocal = ($_SERVER["REMOTE_ADDR"] == "127.0.0.1" OR $_SERVER["REMOTE_ADDR"] == "::1");
	$directPath = ($isLocal) ? "http://localhost/zollernweb/" : "http://design.zollernverse.org/";
	$path = ($_SERVER["REMOTE_ADDR"] == "127.0.0.1" OR $_SERVER["REMOTE_ADDR"] == "::1") ? $directPath."?p=" : "/";
	$currentPage = $_SERVER["QUERY_STRING"];
	$currentPage = str_replace("p=", "", $currentPage);
	$publicKey = "6LeIsggUAAAAACLHx2_ZQF7dt_9ppmMNTLyS-K1Z";
	$secretKey = "6LeIsggUAAAAAI_xHrjLN28KgBnE4RuqqfwU-Ssx";
?><!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="HandheldFriendly" content="true" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale = 1.0, user-scalable = no" />
		<meta name="subject" content="Web Development" />
		<meta name="description" content="Zollern Web builds and designs beautiful, dynamic web sites and user interaction media with quality and affordability." />
		<meta name="keywords" content="zollern wolf, web site, design, dynamic, user interaction, media, affordable, paul shannon, developer, programmer, beautiful, services" />
		<meta name="revisit-after" content="1 day" />
		<meta name="robots" content="NOODP,index,follow" />
		<meta name="author" content="Paul Shannon Jr, zollern.web@gmail.com" />
		<meta name="reply-to" content="zollern.web@gmail.com" />
		
		<!-- Begin Open Graph Protocol -->
		<meta property="og:title" content="Zollern Web Design - Official Web Site" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://design.zollernverse.org" />
		<meta property="og:image" content="favicon.ico" />
		<meta property="og:description" content="Zollern Web builds and designs beautiful, dynamic web sites and user interaction media with quality and affordability." />
		<meta property="locale" content="en_US" />
		<meta property="og:site_name" content="Zollern Web Design" />
		<!-- End Open Graph Protocol -->
			
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo $directPath; ?>styles/main.css" />
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
		<link rel="shortcut icon" href="<?php echo $directPath; ?>favicon.png" />
		<script src="<?php echo $directPath; ?>scripts/jquery.js"></script>
		<script src="<?php echo $directPath; ?>scripts/main.js"></script>
		<script src="<?php echo $directPath; ?>scripts/angular.js"></script>
		<script src="<?php echo $directPath; ?>bootstrap/js/bootstrap.js"></script>
		<script src="http://www.w3schools.com/appml/2.0.3/appml.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<!--[if lt IE 9]>
			<script src = "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<title>Zollern Web</title>
	</head>
	<body>
		<div class="w3-container container">
			<noscript style="color: #f00;">** You must have JavaScript enabled for this site to function properly.</noscript>
			<div class="header">
				<div class="logo">
					<img alt="logo" src="<?php echo $directPath; ?>images/logo.png" class="img-responsive" onclick="document.location.href = '<?php echo $path; ?>home';" title="Zollern Web" />
				</div>
				<div class="tagLine well">
					I am a freelance web designer that loves building web sites from scratch. It's my passion, my work of art. I'm very easy to work with and affordable. If I build it, they will come. I turn "impossible" into "I'm possible."
					<div class="br-10"></div>
					<a href="<?php echo $path; ?>hire-me" class="btn btn-info formButton" role="button" style="font-style: normal;">&raquo; Hire Me</a>
					 &nbsp; <small>* Serious business inquiries only.</small>
				</div>
			</div>
			<div class="main">
				<div class="row">
					<div class="col-sm-10">
						<div class="br-20"></div>
						<!--<img alt="[Zollern Web Design Logo]" src="images/ZollernWeb.png" class="zWebLogo img-responsive" onclick="document.location.href = '<?php echo $path; ?>home';" title="Zollern Web Design" />
						<div class="br-20"></div>-->
						<nav class="navbar navbar-inverse webNav">
							<div class="glare"></div>
							<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-nav">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
								<a class="navbar-brand webName" href="<?php echo $path; ?>home">Zollern Web</a>
							</div>
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo $path; ?>home" class="webMenu btn" role="button">Home</a></li>
								<li><a href="<?php echo $path; ?>portfolio" class="webMenu btn" role="button">Portfolio</a></li><?php
									if(checkAdmin()){
										?>
								<li><a href="<?php echo $path; ?>messages" class="webMenu btn" role="button">Messages</a></li>
										<?php
									}
								?>
								<li>
									<a href="#" class="webMenu btn dropdown-toggle" data-toggle="dropdown" role="button">Information <span class="caret"></span></a>
									<ul class="dropdown-menu dd">
										<li class="navItem"><a href="<?php echo $path; ?>about">About Me</a></li>
										<li class="divider"></li>
										<li class="navItem"><a href="<?php echo $path; ?>how-it-works">How It Works</a></li>
										<li class="divider"></li>
										<li class="navItem"><a href="<?php echo $path; ?>rewards">Rewards Program</a></li>
										<li class="divider"></li>
										<li class="navItem"><a href="<?php echo $path; ?>policy">Business Policy</a></li>
										<li class="divider"></li>
										<li class="navItem"><a href="<?php echo $path; ?>portfolio">Web Portfolio</a></li>
									</ul>
								</li>
								<li>
									<a href="#" class="webMenu btn dropdown-toggle" data-toggle="dropdown" role="button">Downloads <span class="caret"></span></a>
									<ul class="dropdown-menu dd">
										<li class="navItem"><a href="<?php echo $path; ?>esp">eXtensive Server Path</a></li>
									</ul>
								</li>
								<li>
									<a href="#" class="webMenu btn dropdown-toggle" data-toggle="dropdown" role="button">Contact <span class="caret"></span></a>
									<ul class="dropdown-menu dd">
										<li class="navItem"><a href="<?php echo $path; ?>contact">Contact Me</a>
										<li class="divider"></li>
										<li class="navItem"><a href="<?php echo $path; ?>hire-me">Hire Me</a></li>
									</ul>
								</li>
								<?php
									if(checkAdmin()){
										?>
										
								<li><a href="<?php echo $path; ?>logout" class="webMenu btn" role="button">Log Out</a></li>
										<?php
									}else{
										?>
								<li><a href="<?php echo $path; ?>login" class="webMenu btn" role="button">Login</a></li>
										<?php
									}
								?>
							</ul>
						</nav>
						<div class="panel panel-default content">
							<div class="panel-body">
							<?php
								switch($_GET["p"]){
									default:
										changeTitle("Home");
									?>
									<p><strong> &raquo; Quick Links:</strong> <a href="#hire">Why You Should Hire Me</a> &bull; <a href="#qualifications">My Qualifications</a> </p>
									Welcome to <strong>Zollern Web</strong>. Here, you can get an idea of what kind of web services I offer, and what kind of plans you might want. There's also a brief history about my web experiences since I started learning in 2003, for anyone who might be interested in ways to learn the same concepts that I have, and to show that anything is possible once you set your mind to it. Please take your time to look around and familiarize yourself with everything, and if you wish to contact me, then please don't hesitate. I take pride in my work, and I work hard to ensure that I get it right. Programming and web site development come naturally to me - I've been tinkering with PC software since I was about eight or nine years old, and I have always loved the ecstatic feeling of <em>creating</em>. Even when I'm sleeping, I'm usually thinking of ways to improve my work, or how to create something new.
									<h1 class="title" id="hire">Why You Should Hire Me</h1>
									&nbsp; <span class="startingWord">I'm...</span>
									<ol>
										<li><strong>Easy to work with.</strong> I manage my projects effectively and I communicate with you frequently to be sure that you're getting your money's worth.</li>
										<li><strong>Friendly.</strong> It's generally very difficult to find someone <em>real</em> in the world anymore, someone with a <em>positive</em> outlook. I believe in spreading good vibes all around. This means showing that I'm human, and not just some worker bee robot.</li>
										<li><strong>Flexible.</strong> If for some reason you wish to upgrade or downgrade your plan, it won't be a problem.</li>
										<li><strong>Understanding.</strong> I know that sometimes, life happens - and I do my best to work through it with you.</li>
										<li><strong>Knowledgeable.</strong> Everything I know is self-taught, and I work all from my head. In other words, I make web sites from scratch, without using any programs other than syntax highlighters, generally Notepad++. This also means that I can find errors and workarounds that most people wouldn't even think of.</li>
										<li><strong>Affordable.</strong> Most web developers charge outrageous prices like $75 an hour, and that's considered cheap in today's world. <strong>Zollern Web</strong>, however, charges based upon a "plan" system (Bronze, Silver, Gold, or Platinum, although you can opt to purchase my hourly rate instead), and sells <a href="<?php echo $path; ?>policy#warranties" class="boldLink" onclick="window.open(this.href);return false;">warranties</a> separately. Each plan is allocated a certain number of hours, and I do charge hourly if those hours are exceeded. But I only charge for the hours that I spend working on the web site, and I don't charge much for going over, generally $25 (this is explained thoroughly in the Plans document). <!-- I also sell <a href="./<?php echo $path; ?>hosting" class="boldLink" onclick="window.open(this.href);return false;">hosting packages</a> separately. --> </li>
										<li><strong>Talented.</strong> I know at least 26 different kinds of programming and markup languages, and am fluent in at least 14 of them. Did I mention that everything I know is self-taught? That's a lot of reading right there -- and a lot of dedication. There are developers out there that charge heavily for their services, but the quality they produce is <abbr title="mediocre; produced purely for financial gain">potboiler</abbr>, at best, whereas my work will be <abbr title="celebrated; well-known">renowned</abbr>.</li>
										<li><strong>Advisable.</strong> I will make suggestions to you, and will listen to yours, regarding the web site. It won't be just you telling me and then me doing it; I will communicate back with you, and offer suggestions as to the look, load time, etc. Two seconds may not sound like a long load-time to you, but it could always be better. That being said, they are just suggestions. I just like to make sure that you get your money's worth.</li>
										<li><strong>Not a know-it-all jerk.</strong> Believe me, I understand the frustrations that people have regarding developers because honestly, half of them don't listen to their customers, and generally have an excuse like "well, I know more than you, so I know what's best." I don't believe in doing that. I will advise you, but I will do so politely and maturely, without being degrading or unprofessional. There are a lot of web developer businesses out there, but you're going to be hard-pressed to find someone as polite and affordable as I am. I'm a strong believer in connecting with the customer and treating the work like we're working together on a college project (which I have always aced in web and programming projects). That means that I won't stop until I get a 100%.</li>
										<li><strong>Not lazy.</strong> I will work hard on your project, but it will not be just thrown under the rug for me to get to "when I feel like it." No, I'm going to make sure I get it done, and that I get it done right, guaranteed!</li>
									</ol>
									<h1 class="title" id="qualifications">My Qualifications</h1>
									<p><strong>&raquo; Sub Links: </strong> <a href="#languages">Development Languages</a> &bull; <a href="#skills">Specific Skills</a></p>
									<p>It has occurred to me that prospective clients might be interested to know what qualifies me to design web sites so freely as to run my own company for it, as well as what knowledge or unique skills I may possess to help me achieve my goals. The purpose of this page is that very thing: to give potential clients a reason or, more hopefully, multiple reasons to hire me. Listed below are just a few of those reasons.</p>
									<h2 class="title" id="languages">Development Languages</h2>
									<p>While it may seem common to be capable of developing a quality web site, I do have rare, specific knowledge that makes me, I believe, an exceptional developer in the field. Listed below are the various markup, programming, intercommunication and design languages that I know, in no particular order.</p>
									<ol>
										<li><abbr title="eXtensive Hypertext Markup Language">XHTML</abbr>/<abbr title="Hypertext Markup Language">HTML</abbr>/HTML5</li>
										<li><abbr title="Dynamic Hypertext Markup Language">DHTML</abbr></li>
										<li><abbr title="eXtensive Markup Language">XML</abbr></li>
										<li><abbr title="Document Type Definitions">DTD</abbr></li>
										<li><abbr title="eXtensible Stylesheet Transformation Language">XSLT</abbr></li>
										<li>Schema</li>
										<li><abbr title="XML Path">XPath</abbr></li>
										<li><abbr title="XML Link">XLink</abbr></li>
										<li><abbr title="XML Query">XQuery</abbr></li>
										<li><abbr title="Application Modeling Language">AppML</abbr></li>
										<li><abbr title="Really Simple Syndication">RSS</abbr></li>
										<li><abbr title="Representational State Transfer">REST</abbr></li>
										<li><abbr title="Personal Home Page; Hypertext Preprocessor">PHP</abbr></li>
										<li><abbr title="My Structured Query Language">MySQL</abbr> / <abbr title="Structured Query Language">SQL</abbr></li>
										<li><abbr title="Active Server Pages">ASP</abbr>/ASP.NET</li>
										<li><abbr title="ActiveX Data Objects">ADO</abbr></li>
										<li><abbr title="Asynchronous JavaScript and XML">AJAX</abbr></li>
										<li>JavaScript</li>
										<li><abbr title="JavaScript Query">jQuery</abbr></li>
										<li><abbr title="Angular JavaScript">AngularJS</abbr></li>
										<li><abbr title="JavaScript Object Notation">JSON</abbr></li>
										<li><abbr title="Cascading Stylesheets">CSS3</abbr></li>
										<li>Bootstrap</li>
										<li><abbr title="Hypertext Access">.htaccess</abbr></li>
										<li><abbr title="Open Graphics Library">OpenGL</abbr></li>
										<li><abbr title="Web Graphics Library">WebGL</abbr></li>
										<li><abbr title="Syntactically Awesome Stylesheets">SASS</abbr></li>
										<li>Ruby</li>
										<li><abbr title="Java Server Pages">JSP</abbr></li>
										<li>Java</li>
										<li>C#</li>
										<li>Python</li>
										<li>Visual Basic/<abbr title="Visual Basic.NET">VB.NET</abbr>/<abbr title="Visual Basic Access">VBA</abbr></li>
										<li>Perl</li>
										<li>Batch</li>
										<li>PowerShell</li>
										<li>Lua</li>
									</ol>
									<h2 class="title" id="skills">Specific Skills</h2>
									<div ng-app="" ng-init="skills=['Debugging','DOM Scripting','Relational Databases','Content Management Systems','Web GL','UX/UI Design','Web Authoring','API Integration','Interapplication Communication','Pseudocode','Page Layout and Aesthetics','Interactive Design','Dynamic Scripting','Cross Browser Scripting','Cross Site Scripting','Multimedia Integration','Web 2.0','Safe Fonts and Hexadecimal Notation','Client-Side and Server-Side Scripting','Social Networking Services','Web Servers','Web Security','Meta Tags','Protection Against SQL Injection','Apache/WAMP/XAMP','Internet Information Services','Web Development Tools','Access Control Lists','Progressive Enhancement','Extensions and Plugins','Tableless Web Layout','SEO','Open Graph Protocol','Google Analytics','Web Typography','W3C Standards','Unobstrusive JavaScript','Computer Building and Troubleshooting','XSS Protection']">
										<ol>
											<li ng-repeat="x in skills">
												{{x}}
											</li>
										</ol>
									</div>
									<div class="br-10"></div>
									<x-zml class="p">{{top}}</x-zml>
									<?php
									break;
									case 'about':
										changeTitle("About Me");
										?>
										 <h1 class="title">About Me</h1>
										 <p>My name is Paul Shannon Jr, and I have been coding and programming since 2003. I learned <abbr title="Hypertext Markup Language">HTML</abbr> (the most basic, first thing you should learn) when I was 12, after I created an <abbr title="Microsoft Network">MSN</abbr> group (back when they were still around) and was working on a page. I clicked on the <strong>View HTML</strong> button and started tinkering and editing things until I found out what changed and how to alter the page. After learning this way for a while, I finally bought an HTML book and my web building really started to take off. Then I started experimenting with web sites on Freewebs (which is called just "Webs" now), and ran a few video-game-themed forums. At the end of the HTML book, there were a couple of basic JavaScript tutorials, so I started tinkering with those, and then bought a JavaScript book. In the middle of learning that, I heard about <abbr title="Cascading Stylesheets">CSS</abbr> and started learning that as well. Naturally, while reading and learning both of these, I learned how to combine the two of them together, as well as with HTML. This was called <abbr title="Dynamic Hypertext Markup Language">DHTML</abbr> back in the day, and it's still useable, but there are new web technologies out now that pretty much make that obsolete. At the time, though, this was one of the leading technologies. Around 2005, one of my friends showed me <abbr title="Personal Home Page; Hypertext Preprocessor">PHP</abbr>, and then later, <abbr title="My Structured Query Language">MySQL</abbr>, and how it could be used on the web. These two combined with everything else revolutionized the way I wrote my code, and they still do today. It was during this time, between 2005 and 2012, that I ran several different web sites, one which I built from the ground up. I wrote my own very basic but efficient forum software, all from my head, none of it from a program. Although I did require <em>some</em> help from a buddy of mine for concepts, I wrote everything myself. JQuery came out a few years later, and I didn't really start learning it until around 2012, but now I use it all the time, and it's arguably the best web tool out there. I've also used .htaccess for years, but really didn't start learning it efficiently until 2014. In 2010, after having used web technologies for ~7 years, I decided to write my own, called <a href="<?php echo $path; ?>esp" onclick="window.open(this.href);return false;">eXtensive Server Path</a>, although at the time it was called fileQuery, and I abandoned it after a few months. In 2012 I picked back up the project, and renamed it to its name that it still has today. Essentially, it's designed for querying a file system, primarily XML files, much in the same way that SQL is used for querying databases. It's been a lot of fun writing my own language, and I'm hopeful that someday its potential will be recognized. I have written web sites for people, and have worked on web sites for many others as I was growing up. Computer science comes naturally to me, it's basically like fluently speaking another language. Everything I know is self-taught, using books, web articles, the help of friends, Google, and dissecting the source code of other projects to understand how they work. When I was in college, I wound up being the go-to person for all things tech, primarily programming and web design. In many instances, I knew more than the professors did, and found glitches and incorrect questions in the quizzes and groupwork that otherwise would have made things impossible. Of course, I didn't just <em>say</em> it was wrong; I was able to show the professor (I had the same one for those classes) what I meant and prove my point (quite politely, of course). I actually wound up helping to teach the web design class, and because of this, students petitioned for me to be a programming tutor. This lasted for a good 6 or so months, maybe more, until a financial dispute caused me to leave. However, this same professor helped me get the job that I have now by talking to one of the adjunct professors, who is the accountant at where I work. She shot me an e-mail on behalf of the C.E.O., requesting my résumé. About 10 minutes after I sent the e-mail with my résumé attached, I received a call from the C.E.O., asking me to come in for an interview the next morning. Naturally, this went very well, as I scored the highest on their personality test that they had in 10 years, and I was 2 points above that person's score. I still work at <a href="http://www.gigainc.com/" onclick="window.open(this.href);return false;">GIGA Incorporated</a>, and even helped redesign the web site and its contents, down to its core. I have also created for them an Intranet web site to digitize clocking in and out, calendar events, etc. I have had this job as an "I.T. Guy" ever since, and am quite happy with it. As I mentioned earlier, I did take CIS classes in high school and in college, but in many instances I knew more than the teacher/professor did. I took them because I had to, essentially. One of the benefits of hiring me as your web developer is this: I write everything by hand, line for line, without using a program to do it for me. That's rare in today's world. I also spell-check and proof-read everything that I write, and if I find a mistake or glitch, I will keep working at it until the problem is resolved. Web design is my work of art, my passion, and I work hard to ensure that I get it right. When I say "art", by the way, I don't mean something like Picasso. I guarantee you that your web site will make sense. I've been told that I should be getting paid to do web work for years, and I'm happy to be doing it now. Check out my <a href="<?php echo $path; ?>portfolio" onclick="window.open(this.href);return false;">Portfolio</a> page for screenshots of the work I've done, as well as some live examples.As I mentioned earlier, I also redesigned GIGA's web site, so have a look at that as well. Check out the <a href="<?php echo $path; ?>hire-me" onclick="window.open(this.href);return false;">Hire Me</a> page to see what kind of <strong>plans</strong> I offer, and let's see what's right for you.</p>
										<?php
									break;
									case 'contact':
									changeTitle("Contact Me");
									if(isset($_POST["submit"])){
										if($_POST["g-recaptcha-response"] == ""){
											echo '<div class="alert alert-danger">Error: Could not process request. Please check the reCAPTCHA box before proceeding.</div>';
											header("Refresh: 2; ".$path."contact"); 
										}else{
											query("INSERT INTO messages(name,email,message,ip,g_response)VALUES('".sqlEsc($_POST["name"])."','".$_POST["email"]."','".sqlEsc($_POST["message"])."','".$_SERVER["REMOTE_ADDR"]."','".$_POST["g-recaptcha-response"]."')");
											echo "Your message was sent.";
											header("Refresh: 2; ".$path."home"); 
										}
									}else{
							?>
								<div class="p">For privacy reasons, I don't give out my cellphone number publicly. However, you may fill out the form below and it will automatically e-mail me. Please remember, though, that I am quite busy. I may not respond right away; I will get back to you as soon as I can, so please don't keep e-mailing me over and over. That will put you below other clients in my queue. Thank you for your patience and understanding.
								<div class="br-5"></div>
								If you so wish, you may e-mail me at my business e-mail: <a href="mailto:zollern.web@gmail.com">zollern.web@gmail.com</a></div>
								 <h2 class="title">Contact Form</h2>
								 <div class="br-10"></div>
								 <div class="p zml">{{req}} denotes a required field.</div>
								 <div class="zollernForm">
									<form action="<?php echo $path; ?>contact" method="post" data-ng-app="validateApp" data-ng-controller="validateCtrl" name="contactForm">
										<div class="p">
											<label for="name" class="formLabel">Your Name:</label> <x-zml>{{req}}</x-zml>
											<input type="text" class="form-control" name="name" id="txtName" data-ng-model="name" required="1" placeholder=	"Enter your name..." />
											<div data-ng-show="contactForm.name.$dirty && contactForm.name.$invalid" class="alert alert-danger">You must enter your name.</div>
										</div>
										<div class="p">
											<label for="email" class="formLabel">Your E-Mail:</label>  <x-zml>{{req}}</x-zml>
											<input type="email" class="form-control" name="email" id="txtEmail" data-ng-model="email" required="1" placeholder="yourname@yourdomain.com" />
											<div data-ng-show="contactForm.email.$dirty && contactForm.email.$invalid" class="alert alert-danger">A valid e-mail address is required.</div>
										</div>
										<div class="p">
											<label for="message" class="formLabel">Your Message:</label>  <x-zml>{{req}}</x-zml>
											<br />
											<textarea cols="40" rows="5" name="message" id="txtMessage" data-ng-model="message" required="1" class="form-control" placeholder="Enter message here..."></textarea>
											<div data-ng-show="contactForm.message.$dirty && contactForm.message.$invalid" class="alert alert-danger">Please enter a message.</div>
										</div>
										<div class="g-recaptcha" data-sitekey="6LeIsggUAAAAACLHx2_ZQF7dt_9ppmMNTLyS-K1Z"></div>
										<div class="br-5"></div>
										<div class="p">
											<button type="submit" name="submit" class="btn btn-primary formButton" data-ng-hide="(contactForm.name.$dirty && contactForm.name.$invalid) || (contactForm.email.$dity && contactForm.email.$invalid) || (contactForm.message.$dirty && contactForm.message.$invalid) || (contactForm.name.$untouched) || (contactForm.email.$untouched) || (contactForm.message.$untouched)" id="btnSubmit">&raquo; Send</button>
										</div>
									</form>
								</div>
								<script>
								<!--
								var app = angular.module('validateApp', []);
								app.controller('validateCtrl', function($scope){
									$scope.name = $('#txtName').text();
									$scope.email = $('#txtEmail').text();
									$scope.message = $('#txtMessage').text();
								});
								// -->
								</script>
							<?php
								}
						break;
						case 'policy':
							changeTitle("Policy");
							?>
							 <h2 class="title">Policy</h2>
							<p> Please understand that I do not work for free, regardless of the circumstances. Also, please be sure to buy a warranty along with your desired plan or service. This allows you to contact me if something goes wrong with the web site, and I will try to fix it with no cost, provided the warranty still applies. If one of our meetings or conversations gets loud or at all violent (including verbally), then I have the right to refuse service and may or may not contact the police. These are just things that exist for my protection as well as for my business. <strong>I do not do your homework for you.</strong> I'm only interested in real and professional clients - if you're being graded to make a web site, please make it yourself. Thank you.</p>
							 <div class="br-10"></div>
							 <h2 class="title" id="warranties">Warranties</h2>
							 &nbsp; &nbsp; 1 year - $50
							 <div class="br-5"></div>
							 &nbsp; &nbsp; 2 years - $100
							 <div class="br-5"></div>
							 &nbsp; &nbsp; 4 years - $150
							 <div class="br-10"></div>
							 <p>If, after the creation, you experience an error of any kind, I will be more than happy to fix it for you; however, whether the warranty applies or not (see below) will be the deciding factor of whether or not you’ll have to pay for the maintenance, or if I’ll even do it in some cases (voided warranties).</p>
							 <div class="br-10"></div>
							 <p><strong>** While under one warranty, you are not permitted to buy another - your original must expire, first.</strong><p>
							 <div class="br-10"></div>
							 <p>Please note, that even though warranties are provided, they are not limitless. Any of the actions below will render your warranty void regardless of the chosen plan, and therefore further work or maintenance will cost extra or may not happen at all, dependent on what went wrong:</p>
							 <div class="br-10"></div>
							 <h2 class="title">Warranty Voids</h2>
							 <div class="br-5"></div>
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
							<p>The best way to find out about my services is to check out my <strong>Plans</strong> file. You can view it by clicking <a href="Plans.docx" style="color: #f00; font-size: 13px;">here</a>.</p>
							<?php
						break;
						case 'xsp':
							changeTitle("eXtensive Server Path");
							?>
							<h1 class="title">eXtensive Server Path</h1>
							<p>e<strong>X</strong>tensive <strong>S</strong>erver <strong>P</strong>ath (download link below) is a command-line language that I authored myself. I originally began the project in 2010, under the name of <strong>fileQuery</strong>. I left it alone for a while, and then in 2012, I picked it back up and renamed it to <strong>XSP</strong>. I've been working on it on and off through the years, but I really started working on it pretty heavily in 2014, and have been doing so ever since. The primary purpose of this language is to query XML files, much in the same way that MySQL is used to query databases. So, in a way, you can think of it as a flat-file database language. You can click <a href="Documentation.txt" onclick="window.open(this.href);return false;">here</a> to view the documentation file, which explains the language pretty thoroughly. There is also a tutorial file, which you can view by clicking <a href="XSPTutorial.docx">here</a> - it goes through the absolute basics of the language, in order to familiarize you with its syntax. I also wrote a console for it, so you can easily "query" and parse XML files. It utilizes XPath and PHP together to create something new and robust. It has been immeasurably fun and challenging to write my own language, and although it is not yet well known, I hope that one day it will be widely used. Download link is below.</p>
							<p style="font-weight: bold; font-size: 14px;"><a href="downloads/xsp.zip"> &raquo; Download</a> <span style="font-size: 12px !important;">(<?php echo floor(filesize("downloads/xsp.zip")/1024); ?> KB)</span></p>
							<?php
						break;
						case 'hire-me':
							changeTitle("Hire Me!");
							if(isset($_POST["submit"])){
								$name = "Name: ".sqlEsc($_POST["name"]);
								$email = "E-mail: ".sqlEsc(addslashes($_POST["email"]));
								$planType = "Plan: ".sqlEsc(ucfirst($_POST["plan"]));
								$extraDetails = "Details: ".sqlEsc($_POST["details"]);
								if(empty($_POST["name"]) OR empty($_POST["email"]) OR empty($_POST["plan"] OR empty($_POST["18years"]))){
									echo '<div class="alert alert-danger">You must fill in a name and e-mail to submit this form.</div>';
								}else{
									if($_POST["18years"] == "true"){
										$extraDetails .= "\r\n\r\nUser is at least 18 years of age and agrees to the policies.";
									}else{
										$extraDetails .= "\r\n\r\nUser is NOT 18 years of age and/or did not agree to the policies.";
									}
									$extraDetails .= "\r\nColors: ".$_POST["colors"]."\r\n Warranty: ".$_POST["warranty"];
									$message .= $name."\r\n".$email."\r\n".$planType."\r\n".ucfirst($extraDetails);
									if($_POST["rewards"] == "yes"){
										$message .= "\r\n Client is interested in Rewards Program!";
									}else if($_POST["rewards"] == "undecided"){
										$message .= "\r\n Client is undecided about Rewards Program.";
									}
									$message = sqlEsc($message);
									if($_POST["g-recaptcha-response"] == ""){
										echo '<div class="alert alert-danger">Error: Could not process request. Please check the reCAPTCHA box before continuing.</div>';
										header("Refresh: 2; ".$path."hire-me");
									}else{
										query("INSERT INTO messages(name,email,message,ip,g_response)VALUES('".$name."','".$email."','".$message."','".$_SERVER["REMOTE_ADDR"]."','".$_POST["g-recaptcha-response"]."')");
										echo "<div class=\"alert alert-success\">Your message has been sent to me. I will review it shortly and then e-mail you. Thank you for your submission. I hope we can do business together.</div>";
									}
								}
							}else{
							?>
								<h2 class="title">Hire Me!</h2>
								<div class="br-10"></div>
								<p>If you wish to hire me, then first of all, great! Secondly, please make sure you've read my <a href="Plans.docx">Plans</a> document and are comfortable with everything. I want my clients to be sure that they get their money's worth. That means making sure that they're well informed. To start off with, please fill out the form below, and when you're done, please click on <strong>Submit</strong>. This will send me a message and I will respond to it as soon as I can.</p>
								 <div class="br-5"></div>
								<p><strong>Note:</strong> Payment is not yet required. We will talk first before you submit payment, to ensure customer satisfaction. Please also take note of my <a href="<?php echo $path; ?>policy">Policies</a> before you submit this form. Thank you!</p>
								 <div class="br-5"></div>
								 <div class="form-group">
									<div class="p zml">{{req}} indicates a required field.</div>
									<div class="zollernForm">
									<form action="<?php echo $path; ?>hire-me" method="post" data-ng-app="validateApp" data-ng-controller="validateCtrl" name="hireForm">
										<div class="p">
											<label class="formLabel" for="name">Name:</label> <x-zml>{{req}}</x-zml>
											<input type="text" class="form-control" name="name" id="txtName" data-ng-model="name" required="1" placeholder="Enter name" />
											<div data-ng-show="hireForm.name.$dirty && hireForm.name.$invalid" class="alert alert-danger">
												<div data-ng-show="hireForm.name.$error.required">Please enter your name.</div>
											</div>
										</div>
										<div class="p">
											<label class="formLabel" for="email">E-Mail:</label> <x-zml>{{req}}</x-zml>
											<input type="email" class="form-control" name="email" id="txtEmail" data-ng-model="email" required="1" placeholder="Enter email" />
											<div data-ng-show="hireForm.email.$dirty && hireForm.email.$invalid" class="alert alert-danger">
												Please enter a valid e-mail address, so that we may easily contact you.
											</div>
										</div>
										<div class="p">
											<label class="formLabel" for="plan">Plan Type:</label> <x-zml>{{req}}</x-zml>
											<select name="plan" id="selPlan" class="form-control" required="1">
												<option value="">-------------------</option>
												<option value="bronze">Bronze ($560)</option>
												<option value="silver">Silver ($720)</option>
												<option value="gold">Gold ($810)</option>
												<option value="platinum">Platinum ($1,200)</option>
												<option value="hourly">Hourly (Varies)</option>
											</select>
										</div>
										<div class="p">
											<label class="formLabel" for="colors">Colors:</label>
											<select name="colors" id="selColors" class="form-control">
												<option value="undecided">Undecided</option>
												<option value="cold">Something cold</option>
												<option value="warm">Something warm</option>
												<option value="solid">Solid color</option>
												<option value="shaded">Different shades of one color</option>
												<option value="blackwhite">Black & white</option>
											</select>
										</div>
										<div class="p">
											<label class="formLabel" for="warranties">Warranty:</label>
											<select name="warranty" id="selWarranty" class="form-control">
												<option value="none">No Warranty</option>
												<option value="1year">One Year ($50)</option>
												<option value="2years">Two Years ($100)</option>
												<option value="3years">Three Years ($150)</option>
											</select>
										</div>
										<div class="p">
											<label class="formLabel" for="rewards">Are you interested in entering the <a href="<?php echo $path; ?>rewards" onclick="window.open(this.href);return false;" style="color: #0af !important;">Rewards Program</a></label>?
											<select name="rewards" id="selRewards" class="form-control">
												<option value="undecided">Undecided</option>
												<option value="no">No</option>
												<option value="yes">Yes</option>
											</select>
										</div>
										<div class="p">
											<label class="formLabel" for="details">Extra Details:</label>
											<br />
											 <textarea cols="45" rows="10" class="form-control" name="details" id="txtDetails" placeholder="Enter details"></textarea>
										</div>
										<div class="br-10"></div>
										<div class="p">
											 <x-zml>{{req}}</x-zml> <input type="checkbox" value="true" name="18years" id="chkOver18" required="1" /> <label class="formLabel" for="18years">I am at least 18 years old and agree to the policies stated on this web site.</label>
										</div>
										<div class="br-10"></div>
										<div class="p">
											<strong>** If you're ready, click the <em>Submit</em> button below. You must be at least 18 years or older to order.</strong>
											<div class="g-recaptcha" style="margin-left: 1%;" data-sitekey="6LeIsggUAAAAACLHx2_ZQF7dt_9ppmMNTLyS-K1Z"></div>
											<div class="br-5"></div>
											<button type="submit" class="form-control submitBtn formButton" name="submit" id="btnSubmit" data-ng-hide="(hireForm.name.$dirty && hireForm.name.$invalid) || (hireForm.email.$dirty && hireForm.email.$invalid)" disabled="1" onclick="return confirm('Are you sure you wish to submit this form?');">
												Submit
											</button>
										</div>
									</form>
									</div>
								 </div>
								 <script>
								 var app = angular.module("validateApp", []);
								 app.controller("validateCtrl", function($scope){
									 $scope.name = $('#txtName').text();
									 $scope.email = $('#txtEmail').text();
								 });
								 </script>
							<?php
							}
						break;
						case 'hosting':
							changeTitle("Hosting Setups");
							
						break;
						case 'how-it-works':
							changeTitle("How The Process Works");
							?>
							<h1 class="title">How It Works</h1>
							<p>If you're considering hiring me to develop a web site for you, then chances are that you want to know how the whole process is going to work. Don't worry, I'm very friendly and I'm here to help. The process can <em>seem</em> a little confusing at first, but once we get down to it, it's actually pretty simple. The following is a step-by-step process that details how the business will be conducted, and how both sides will communicate their intentions and ideas. Please read it carefully, and do not hesitate to ask me if you have any questions.</p>
							<p>
								<ol>
									<li>The first thing that you should do is read my <a href="Plans.docx" style="font-weight: bold;">Plans</a> file. This will give you a general overview of the services that I offer, as well as my pricing for said services.</li>
									<li>Once you've read over everything, navigate to the <a href="<?php echo $path; ?>hire-me" style="font-weight: bold;">Hire Me</a> page, and fill out the form with the necessary information. Once you click <strong>Submit</strong>, this will send the information to my database, which I will receive during my normal business hours (Monday through Friday, 9 A.M. to 5 P.M. EST).</li>
									<li>I will then contact you at my earliest convenience and attempt to set up a meeting, either through the phone, Skype, or (preferably) in person. During this meeting, we will discuss the specifics of the web site that you wish for me to design for you. This is where we will hash out the details and make sure that we understand one another, in order to minimize confusion on both sides and to ensure that maximum satisfaction is achieved. Any questions that you might have for me are best asked during this time. We can also talk about warranties and extras, though please note that these do cost extra.</li>
									<li>After the meeting, I will print out a binding contract that helps both of us to stick to the agreed to plan, and it helps to keep things professional and cover any potential discrepancies in the future, which must be signed in full by you (the client) before work can begin. Once the signed contract is returned to me, I will invoice you for half of my price (<strong>50% of the payment is required upfront</strong>) - this is to ensure that you get your work, and that I receive my payment. After this, I will begin work on the web site, and will check in with you regularly to ensure that the process is progressing in the way that you intend for it to.</li>
									<li>As I work, I will keep track of <em>only</em> the hours that I spend working. In other words: if I spend one hour working, then an hour for lunch, and then another hour for work, then only those two hours of work are counted. <strong>Note:</strong> Depending on your chosen plan (Bronze, Silver, Gold, Platinum or Hourly), a certain number of hours are "allocated" to the work. For example, Bronze has a minimum of 30 hours. If I spend 30 hours or less working on your web site, then it will not cost you anything extra. However, if I spend one or more hours over 30 hours, then an additional charge of $25 will apply, per hour that I spent working. It sounds confusing, but it actually makes everything much simpler and much easier on both of us. Most web developers charge an outrageous amount per hour (I rarely see freelancers go below $75 per hour), with no exceptions. However, I charge based on a plan system <em>first</em>, and then charge if the prepaid hours are worked over, and even then, I charge a very low amount compared to most other developers (typically $25, though this may vary as demand for my services increases).</li>
									<li>Once the web site is finished and both parties are happy with the result, I will invoice you for the remaining 50% of the work, and once I receive the payment, I will turn your files over to you. Please note, however, that as of right now, I do not host your site for you. I can recommend web hosts, and help you get everything uploaded, but for now, this is up to you. Once I have a more steady workflow, I can begin offering hosting packages to my clients, but this could be a while from now. Also, we can talk about my <a href="<?php echo $path; ?>rewards" onclick="window.open(this.href);return false;" class="boldLink">Rewards Program</a>. Basically, the rewards program gets you a free spot on my web portfolio, at no extra cost to you. What this means is that to promote my services, I will provide a direct link to your web site that I built for you, to A.) show off my skills for potential clients for me, and B.) increase traffic to your web site, which benefits you as well. I will also take $30 off of your final price for allowing me to link to your site. <strong>Note:</strong> This must happen <strong>BEFORE</strong> the second, final invoice is received, or it will not apply.</li>
								</ol>
							</p>
							<?php
						break;
						case 'portfolio':
						case 'examples':
							changeTitle("Web Portfolio");
							?>
								<h1 class="title">Web Portfolio</h1>
								<p>Welcome to my web portfolio. Here you will find examples of my previous works as well as any web sites that I have created for a willing, participating client in my <strong>Rewards Program</strong>. As I begin to have more clients, and begin to make more web sites in general, more web sites will be added to this list.</p>
								<p><strong>zTech+</strong> - <a href="http://ztech.zollernverse.org/" onclick="window.open(this.href);return false;">http://ztech.zollernverse.org/</a> <span class="glyphicon glyphicon-new-window"></span>  - This web site was authored for my friends and I's Minecraft server, and I'm quite proud of how the web site turned out. It reflects my colorful, "sleek" style, while still appearing professional. It's also easily <abbr title="easy to get around in; maneuverable">navigable</abbr>, and shows off my nav menu styling. The logo could be better - I'm not fond of the colors, but I actually do like how the layout is structured. You will also find a link back to this web site, however this is because zTech+ is also my web site - you will not have one of those links on your web site without your permission, first.</p>
								<p><strong>GIGA Inc.</strong> - <a href="http://www.gigainc.com/" onclick="window.open(this.href);return false;">http://www.gigainc.com/</a> <span class="glyphicon glyphicon-new-window"></span> - This is the web site for the company at which I work. In mid-2014 I helped to redesign their web site at its core, using Joomla 2.5, but still working using the code, as well. A lot of the work that I did for them was "under the hood", but you can see some of my work on the Line Cards page. The way most of the pages are structured and laid out is also a (small) reflection of my work. This is a good example of a basic work done by me.</p>
							<?php
						break;
						case 'rewards':
							changeTitle("Rewards Program");
							?>
							<h1 class="title">Rewards Program</h1>
							<p>My <strong>Rewards Program</strong> is something new that I'm starting, in order to promote happy, healthy business - business that spreads! In order to do that, I'm introducing an <abbr title="a reward or encouragement">incentive</abbr> that benefits both parties: the <strong>Rewards Program</strong>! Basically, the rewards program <abbr title="to propose or offer">proffers</abbr> the following.</p>
							<h3 class="title">Benefits</h3>
							<p>There are numerous benefits to this program, both for myself and for my clients (you) as well.</p>
							<ul>
								<li>Free exposure for your finished web site, through this web site, at no extra charge to you</li>
								<li>More exposure for my web development business, both through word of mouth and from linking back to me</li>
								<li>
									$30 off of your final invoice price (the remaining 50% left after completion)
									<ul>
										<li>This affects only your <strong>final</strong> invoice - it does <strong>NOT</strong> affect the 50% payment upfront.</li>
									</ul>
								</li>
							</ul>
							<h3 class="title">Requirements</h3>
							<p>Yes, unfortunately, there is a small catch - but it is a catch that does not involve you spending extra money.</p>
							<ul>
								<li>
									Your web site must have a working, easily-visible link that takes the user straight back to this web site specifically.
									<ul>
										<li>If you choose to do this, I will set this up for you no problem - the link must remain untouched by anyone other than myself after it is created.</li>
									</ul>
								</li>
							</ul>
							<?php
						break;
						case 'messages':
							changeTitle("Client Messages");
							if(checkAdmin()){
							?>
							<h1 class="title">Client Messages</h1>
							<?php
							$q = mysql_query("SELECT id FROM messages") OR SQLError();
							if(numRows("SELECT id FROM messages") == 0){
								echo '<p>No messages. :(</p>';
							}else{
							?>
							<table class="table table-striped table-responsive" appml-data="<?php echo $directPath; ?>lib/messages.php">
								<thead>
									<tr>
										<th>Name</th>
										<th>E-Mail</th>
										<th>IP</th>
									</tr>
								</thead>
								<tbody>
									<tr appml-repeat="records">
										<td><a href="<?php echo $path; if($isLocal){
											echo 'viewmessage&id={{id}}';
										}else{
											echo 'viewmessage/{{id}}';
										} ?>">{{name}}</a></td>
										<td>{{email}}</td>
										<td>{{ip}}</td>
									</tr>
								</tbody>
							</table>
							<?php
							}
						}else{
							unauthorized();
						}
						break;
						case 'viewmessage':
							if(!(int)$_GET["id"]){
								dataError();
							}elseif(!checkAdmin()){
								unauthorized();
							}else{
								$data = sql("SELECT * FROM messages WHERE id = '".$_GET["id"]."'");
								changeTitle("View Message - ".$data["id"].".".sqlEsc($data["name"]));
								?>
								<a href="<?php echo $path; ?>messages">&laquo; Back to Messages</a>
								<h1 class="title">View Message - <?php echo $data["id"].".".sqlEsc($data["name"]); ?></h1>
								<div class="p">
									<strong>Name:</strong> <?php echo sqlEsc($data["name"]); ?>
									<div class="br-5"></div>
									<strong>E-Mail:</strong> <?php echo sqlEsc($data["email"]); ?>
									<div class="br-5"></div>
									<strong>IP:</strong> <?php echo $data["ip"]; ?>
									<div class="br-5"></div>
									<strong>Message:</strong> <?php echo sqlEsc($data["message"]); ?>
								</div>
								<?php
							}
						break;
						case 'login':
							changeTitle("Log In");
							if(checkAdmin()){
								exit("You're already logged in!");
							}
							if(isset($_POST["submit"])){
								if($_POST["user"] == "admin" AND md5($_POST["pass"]) == md5($pass)){
									/*$t = time()+86400*10*365;
									setcookie("id","1",$t);
									setcookie("ztech_82135", md5($pass));*/
									session_start();
									$_SESSION["id"] = "1";
									header("Location: ".$path."messages");
								}else{
									?>
									<div class="alert alert-danger">Incorrect log in information.</div>
									<?php
								}
							}
							?>
							<h1 class="title">Log In</h1>
							<div class="well well-responsive">Please note that this log in form is for staff only. Thank you.</div>
							<div class="zml">{{req}} denotes a required field.</div>
							<div class="zollernForm">
								<form action="<?php echo $path; ?>login" method="post" data-ng-app="validateApp" data-ng-controller="validateCtrl" name="loginForm">
									<div class="p">
										<label for="user" class="formLabel">User:</label> <x-zml>{{req}}</x-zml>
										<div class="br-5"></div>
										<input type="text" class="form-control" id="txtUser" data-ng-model="user" required="1" name="user" placeholder="Username" />
										<div class="br-5"></div>
										<label for="pass" class="formLabel">Pass:</label> <x-zml>{{req}}</x-zml>
										<input type="password" class="form-control" id="txtPass" data-ng-model="pass" required="1" name="pass" />
										<div class="br-10"></div>
										<button type="submit" class="btn formButton" name="submit">Log In</button>
										<div class="br-5"></div>
									</div>
								</form>
							</div>
							<?php
						break;
						case 'logout':
							changeTitle("Log Out");
							/*$t = time()-300;
							setcookie("id","",$t);
							setcookie("ztech_82135","",$t);*/
							session_unset();
							session_destroy();
							header("Location: ".$path."home");
						break;
					}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="br-20"></div>
			<div class="footer well-sm">
				<div class="row">
					<div class="col-sm-15">All content is copyright &copy; <strong>Zollern Web Design</strong> <?php echo date("Y"); ?>.</div>
				</div>
			</div>
			<div class="br-10"></div>
		</div>
		<script src="<?php echo $directPath; ?>scripts/zml.js"></script>
		<script src="<?php echo $directPath; ?>scripts/external.js"></script>
	</body>
</html>
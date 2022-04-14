<?php
require 'xcrypt/xcrypt.php';

 function makePages($num,$p_name="page"){
 	(int) $p = (!(int)$_GET[$p_name] OR $_GET[$p_name] == 0) ? 0 : ($_GET[$p_name] - 1);
 	$returnData = array();
 	$returnData[] = $p;
 	$which = ceil($p*$num);
 	$returnData[] = $which;
 	return $returnData;
}

function createUToken($str){
	$xc = new XCrypt();
	$newStr = "::%2a$$".$str."$$2a%::";
	$newStr = $xc->encrypt($newStr);
	$newStr = $xc->xcrypt($newStr);
	return $newStr;
}

function setAuth($id,$lf,$token=NULL){
	$xc = new XCrypt();
	$data = sql("SELECT id,tfa,pin FROM members WHERE id = '".$id."'");
	$cid = $_COOKIE["id"];
	$authToken = (isset($_COOKIE["token"])) ?  createUToken($cid) : 0;
	if($data["tfa"] == 'yes' AND $_COOKIE["token"] != createUToken($cid)){
		echo('
			<div style="position: absolute; width: 35%; min-height: 15%; border: 1px solid #000; border-radius: 5px; padding: 6px; margin-left: 20%;" class="mainbg2">
				This account has enabled the <a href="http://en.wikipedia.org/wiki/Two_factor_authentication" onclick="window.open(this.href);return false;">2FA</a> feature enabled.
				<div style="height: 8px;"></div>
					<form action="index.php?p=checkpin" method="post">
						<label for="pin" class="formLabel">Enter PIN:</label>
						<input type="password" name="pin" class="form-control" id="txtPin" /> <a href="javascript:;" onclick="shPIN();" title="Show/Hide PIN"><img src="buttons/siren.png" style="height: 16px; width: 16px;" /></a>
						<input type="hidden" value="'.$id.'" name="id" id="txtID" />
						<input type="hidden" value="'.$lf.'" name="lf" id="txtLF" />
						<div style="height: 4px;"></div>
						<div style="margin-left: 4%;">
							<button type="submit" name="pinSubmit" class="form-control" id="btnAuth">Authenticate</button>
						</div>
					</form>
				</div>
		');
		exit;
	}
	$t = ($lf == '1') ? time()+86400*365*10 : time()+21600;
	$p = "/";
	$d = "zollernverse.org";
	setcookie("id",$id,$t);
	setcookie("st_site_id",checkSecUID3160($id),$t);
	logUser($id,"logged in.");
	toLoc("forum.php");
}
 
 function loginForm($msg="Log in to your user account here, using the information that you provided during registration. If you have forgotten your password, don't fret - we have a way of resetting it for you.",$email="",$pass=""){
	$xc = new XCrypt();
	if(online()) errMsg("You are already logged in, genius.");
	setTitle("Log In");
	if(isset($_POST["submit"]) AND !preg_match("/\?act=register/i",$_SERVER["REQUEST_URI"])){
		$email = ($email == "") ? $_POST["email"] : $email;
		$pass = ($_POST["pass"] == "") ? $_POST["pass"] : $pass;
		$lf = $_POST["lf"];
		$sd2 = sql("SELECT limited_register FROM sitedata");
		$data = sql("SELECT id,approved,newsys,newpass,numfails,pass,email,locked FROM members WHERE email = '".$email."'");
		if($data["id"] == ""){
			$c = "<br /><img src=\"buttons/bullet_error.png\" /><strong>Error:</strong> The e-mail and password combination that you used were incorrect.";
		}
		$numFails = $data["numfails"];
		if($numFails == 4){
			$c = "<br /><img src=\"buttons/cancel.png\" /><strong>WARNING:</strong> One more failed log in attempt will lock this account.";
		}else if($numFails >= 5){
			query("UPDATE members SET locked = 1 WHERE id = '".$data["id"]."'");
			logUser($data["id"],"had their account locked due to suspicious activity.");
			$c = "<br /><img src=\"buttons/cancel.png\" /><strong>WARNING:</strong> This account has been locked due to suspicious activity.";
		}
		if($data["newsys"] == 'yes'){
			$xp = $xc->encrypt($pass);
			if($xp == $data["newpass"]){
				setAuth($data["id"],$lf);
			}else{
				$numFails++;
				query("UPDATE members SET numfails = '".$numFails."' WHERE id = '".$data["id"]."'");
				$c = "<br /><img src=\"buttons/bullet_error.png\" /><strong>Error:</strong> The e-mail and password combination that you used were incorrect.";
			}
		}else{
			if(md5($pass) == $data["pass"]){
				setAuth($data["id"],$lf);
			}else{
				$numFails++;
				query("UPDATE members SET numfails = '".$numFails."' WHERE id = '".$data["id"]."'");
				$c = "<br /><img src=\"buttons/bullet_error.png\" /><strong>Error:</strong> The e-mail and password combination that you used were incorrect.";
			}
		}
	}
						?>
						<form action="?act=login" method="post">
						<table class="table bordercolor" cellspacing="1" cellpadding="4">
						<tr>
						<th class="titlebg" colspan="2">Log In To Your Account</th>
						</tr>
						<tr>
						<td class="mainbg2 pageContent" colspan="2">
						<?php echo $msg.$c; ?>
						<div class="brl"></div>
						<a href="?act=forgotpass">Forgot Password?</a>
						</td>
						<tr>
						<td class="mainbg pageContent" style="width: 50%; text-align: right;">
						<label class="formLabel" for="email">
						E-Mail:
						</label>
						</td>
						<td class="mainbg pageContent" style="width: 50%;">
						<input type="text" value="<?php echo $_POST['email']; ?>" name="email" id="pu" class="form-control" required="1" placeholder="Enter email.." />
						</td>
						</tr>
						<tr>
						<td class="mainbg pageContent" style="width: 50%; text-align: right;">
						<label class="formLabel" for="pass">
						Password:
						</label>
						</td>
						<td class="mainbg pageContent" style="width: 50%;">
						<input type="password" name="pass" class="form-control" required="1" placeholder="Enter password.." />
						</td>
						</tr>
						</tr>
						<tr>
						<td class="mainbg pageContent" id="rmcell" style="text-align: center;" colspan="2">
						<input type="checkbox" value="1" name="lf" class="form-control" /> <div style="display: inline-block;">Remember Me</div>
						<div class="tinyText">Tick this box to log in forever.</div>
						</td>
						</tr>
						<tr>
						<td class="mainbg2 pageContent" colspan="2" style="text-align: center; vertical-align: top;">
						<button type="submit" name="submit" id="login" class="formButton form-control">Log In</button>
				<div style="text-align: right;">
				Not registered? Click <a href="?act=register">here</a> to sign up.
				</div>
						</td>
						</tr>
						<tr>
						<th class="titlebg" colspan="2">&nbsp;</th>
						</tr>
						</table>
						</form>
						<?php
}
 
function loginForm2(){
?>
<div class="loginForm mainbg2">
	<form action="forum.php?act=login" method="post" name="loginForm">
		<label class="formLabel" for="email">E-Mail:</label>
		<br />
		<input type="text" class="form-control" value="<?php echo $_POST["email"]; ?>" style="width: 70%;" name="email" id="txtUser" required="1" placeholder="Enter e-mail.." />
		<br />
		<label class="formLabel" for="password">Password:</label>
		<br />
		<input type="password" class="form-control" style="width: 70%;" name="pass" id="txtPass" required="1" placeholder="Enter password.." />
		<div class="brl"></div>
		<input type="checkbox" name="lf" value="1" id="txtLF" /> Remember Me
		<div class="brl"></div>
		<button type="submit" name="submit" id="btnSubmit" class="formButton form-control">&raquo; Log In</button>
		<div class="brl"></div>
		<a href="forum.php?act=forgotpass" class="siteLink">Forgot Password</a>?
	</form>
</div>
<div class="brl"></div>
<?php
}

 function connect(){
 	if($_SERVER["REMOTE_ADDR"] == "::1" OR $_SERVER["REMOTE_ADDR"] == '127.0.0.1'){
		$con = mysqli_connect("localhost","userName","lolPasswordGoesHereButIRemovedIt","databaseName");
	}else{
		$con = mysqli_connect("mysql.zollernverse.org","jzollern","redacted", "databaseName");
	}
	return $con;
 }
 
 function checkSecUID3160($cookieID){
	$xc = new XCrypt();
	$userdata = sql("SELECT name FROM members WHERE id = '".$cookieID."'");
	$xt = $xc->encrypt("$".($cookieID+8726).":%%:".md5($userdata["name"]."$#$#:".($cookieID+50))."$");
 	return $xc->xcrypt($xt);
 }
 
 function errMsg($msg){
 	setTitle("Whoops!");
 	$width = (preg_match("/chao\.php/i",basename($_SERVER["PHP_SELF"]))) ? "680" : "795";
 	exit('
 	<table cellspacing="1" cellpadding="4" class="table bordercolor" style="width: '.$width.'px;">
 	<tr>
 	<th class="titlebg pageContent">Whoa, cowboy!</th>
 	</tr>
 	<tr>
 	<td class="mainbg2 pageContent"><img src="buttons/bullet_error.png" /> '.$msg.'</td>
 	</tr>
 	</table>
 	');
 }
 
 function forumMsg($msg){
 	$width = (preg_match("/chao\.php/i",basename($_SERVER["PHP_SELF"]))) ? "680" : "795";
 	$forumName = sql("SELECT forum_name FROM sitedata");
 	echo '<table cellspacing="1" cellpadding="4" class="table bordercolor" style="width: '.$width.'px;">
 		<tr>
 		<th class="titlebg">'.stripslashes($forumName["forum_name"]).'</th>
 		</tr>
 		<tr>
 		<td class="mainbg2">'.ubbc($msg).'</td>
 		</tr>
 		</table>
 		<br />';
 }
 
 function FormatRes($_INT,$_STR){
    (string) $newStr;
  	if($_INT > 1 or $_INT == 0):
  		$newStr = $_STR."s";
  	else:
  	 $newStr = $_STR;
   endif;
   if($_STR != "birthday"){
    $newStr = (strtolower($_STR) != "day") ? str_replace("ys","ies",$newStr) : "days";
   }else{
    $newStr = "birthdays";
   }
     return number_format($_INT)." ".$newStr;
  }
  
  function changeTitle($newTitle){
  	js('changeTitle("'.$newTitle.'");');
  }
  
  function SQLError($msg="ERROR"){
  	// $con = connect();
	// logUser('3',mysqli_error($con));
  	// errMsg("There has been an internal server error. Please report it to the administrators at once.<br /><strong>Details:</strong> ".mysqli_error($con));
  }
  
  function js($str){
  	echo "<script type=\"text/javascript\">
  	<!--
  	".$str."
  	// -->
  	</script>";
  }
  
			function ubbc($section){
			    $tdp = htmlentities($section);
                            $tdp = str_replace("[table]","<table border=\"1\">",$tdp);
                            $tdp = str_replace("[/table]","</table>",$tdp);
                            $tdp = str_replace("[tr]","<tr>",$tdp);
                            $tdp = str_replace("[/tr]","</tr>",$tdp);
                            $tdp = str_replace("[th]","<th class=\"titlebg\" colspan=\"5\">",$tdp);
                            $tdp = str_replace("[/th]","</th>",$tdp);
                            $tdp = str_replace("[td]","<td>",$tdp);
                            $tdp = str_replace("[/td]","</td>",$tdp);
							$tdp = str_replace("javascript:","",$tdp);
					$tdp = $section;
      			    $tdp = nl2br($tdp);
      			    $tdp = stripslashes($tdp);
      			    //Smilies
      			    	$tdp = str_replace(":)","<img src=\"smilies/smile.png\" />",$tdp);
      			    	$tdp = str_replace(":(","<img src=\"smilies/sad.png\" />",$tdp);
      			    	$tdp = str_replace(":'(","<img src=\"smilies/bawling.png\" />",$tdp);
      			    	$tdp = str_replace(";)","<img src=\"smilies/wink.gif\" />",$tdp);
      			    	$tdp = str_replace(":D","<img src=\"smilies/grin.png\" />",$tdp);
      			    	$tdp = str_replace("XD","<img src=\"smilies/XD-smiley.png\" />",$tdp);
      			    	$tdp = str_replace("xD","<img src=\"smilies/XD-smiley.png\" />",$tdp);
      			    	$tdp = str_replace(":p","<img src=\"smilies/tongueout.png\" />",$tdp);
      			    	$tdp = str_replace("8)","<img src=\"smilies/cool.png\" />",$tdp);
      			    	$tdp = str_replace("^^;","<img src=\"smilies/modest.png\" />",$tdp);
      			    	$tdp = str_replace(":\\)","<img src=\"smilies/blush.gif\" />",$tdp);
      			    	$tdp = str_replace(":s","<img src=\"smilies/sealed.gif\" />",$tdp);
      			    	$tdp = str_replace("(:@)","<img src=\"smilies/angry2.gif\" />",$tdp);
      			    	$tdp = str_replace(":{","<img src=\"smilies/sick.png\" />",$tdp);
      			    	$tdp = str_replace(":heart:","<img src=\"smilies/heart.png\" />",$tdp);
      			    	$tdp = str_replace(":idea:","<img src=\"smilies/idea.png\" />",$tdp);
      			    	$tdp = str_replace("(/:|)","<img src=\"smilies/angry.png\" />",$tdp);
      			    	$tdp = str_replace(":love:","<img src=\"smilies/inlove.png\" />",$tdp);
      			    	$tdp = str_replace("O_O","<img src=\"smilies/eek.png\" />",$tdp);
      			    	$tdp = str_replace("*_*","<img src=\"smilies/star.gif\" />",$tdp);
      			    	$tdp = str_replace(":hot:","<img src=\"smilies/hot.png\" />",$tdp);
      			    	$tdp = str_replace("/:}","<img src=\"smilies/naughty.gif\" />",$tdp);
      			    	$tdp = str_replace(":\\","<img src=\"smilies/confused.png\" />",$tdp);
      			    	$tdp = str_replace(":o","<img src=\"smilies/surprised.gif\" />",$tdp);
      			    	$tdp = str_replace(":[","<img src=\"smilies/embarrassed.png\" />",$tdp);
      		            $tdp = preg_replace("/\[b\]/i", "<strong>", $tdp);
      		            $tdp = preg_replace("/\[\/b\]/i", "</strong>", $tdp);
      		            $tdp = preg_replace("/\[i\]/i", "<em>", $tdp); 
      		            $tdp = preg_replace("/\[\/i\]/i", "</em>", $tdp);    
                            $tdp = preg_replace("/\[u\]/i", "<span style=\"text-decoration:underline;\">", $tdp);
                            $tdp = preg_replace("/\[\/u\]/i", "</span>", $tdp);
                            $tdp = preg_replace("/\[s\]/i","<s>", $tdp);
                            $tdp = preg_replace("/\[\/s\]/i","</s>", $tdp);
                            $tdp = preg_replace("/\[center\]/i", "<span style=\"text-align:center;\">", $tdp);
                            $tdp = preg_replace("/\[\/center\]/i", "</span>", $tdp);
                            $tdp = preg_replace("/\[url=(.+?)\](.+?)\[\/url\]/i", "<a href=\"$1\" onclick=\"window.open(this.href);return false;\" class=\"siteLink\">$2</a>", $tdp);
                            $tdp = preg_replace("/\[sup\](.+?)\[\/sup\]/i", "<sup>$1</sup>", $tdp);
                            $tdp = preg_replace("/\[sub\](.+?)\[\/sub\]/i", "<sub>$1</sub>", $tdp);
                            $tdp = preg_replace("/\[size=(\d+?)\]/i", "<div size=\"$1\">", $tdp);
                            $tdp = preg_replace("/\[\/size\]/i", "</span>", $tdp);
                            $tdp = preg_replace("/\[code\]/i", "<strong>Code:</strong><div class=\"code\">", $tdp);
                            $tdp = preg_replace("/\[\/code\]/i", "</span>", $tdp);
                            $tdp = preg_replace("/\[highlight=(.+?)\](.+?)\[\/highlight\]/i","<span style=\"background-color:#$1;\">$2</span>",$tdp);
                            $tdp = preg_replace("/\[hr\]/i", "<hr/>", $tdp);
      			    $tdp = preg_replace("/\[img\](.+?)\[\/img\]/i", "<a href=\"$1\" onclick=\"window.open(this.href);return false;\"><img alt=\"[image]\" src=\"$1\" style=\"border: none; cursor: pointer;\" class=\"postedImage\" title=\"Click for larger view\" /></a>", $tdp); 
      			    $tdp = preg_replace("/\[list\]/i", "<ul>", $tdp);
      			    $tdp = preg_replace("/\[br\]/i", "<br />", $tdp);
      			    $tdp = preg_replace("/\[wbr\]/i", "<wbr />", $tdp);
      			    $tdp = preg_replace("/\[section=(.+?)\]/i", "<div class=\"titlebg\" style=\"text-align:center !important;\">$1</span>", $tdp);
      			    $tdp = preg_replace("/\[anchor=(.+?)\]/i","<a name=\"$1\" id=\"$1\"></a>",$tdp);
      			    $tdp = preg_replace("/\[link=(.+?)\](.+?)\[\/link\]/i","<a href=\"$1\" class=\"siteLink\">$2</a>",$tdp);
     			    $tdp = preg_replace("/\[\*\]/", "<li>", $tdp);
     			    $tdp = preg_replace("/\[\/\*\]/", "</li>", $tdp);
      			    $tdp = preg_replace("/\[\/list\]/i", "</ul>", $tdp);
      			    $tdp = preg_replace("/\[left\](.+?)\[\/left\]/i","<span style=\"text-align:left !important;\">$1</span>",$tdp);
      			    $tdp = preg_replace("/\[right\](.+?)\[\/right\]/i","<span style=\"text-align:right !important;\">$1</span>",$tdp);
      			    $tdp = preg_replace("/\[pre\]/i","<pre>",$tdp);
      			    $tdp = preg_replace("/\[\/pre\]/i","</pre>",$tdp);
      			    $getID = ($_COOKIE["id"] != "") ? $_COOKIE["id"] : 0;
      			    $tdp = str_replace("{id}",$getID,$tdp);
      			    $tdp = str_replace("{ip}",$_SERVER["REMOTE_ADDR"],$tdp);
					$httpMethod = "http://";
					$root = $_SERVER["SERVER_NAME"];
					if($root == "localhost"){
						$root = $httpMethod.$root."/zollernverse/";
					}else{
						$root = $httpMethod."www.zollernverse.org/";
					}
      			    if(preg_match("/\[user=(\d+?)\]/i",$tdp,$m)){
      			    	if($m["1"] != 0){
      			    	$userdata = sql("SELECT display,s_tag,colors,flagged,perms FROM members WHERE id = '".$m["1"]."'");
      			    	$r = "";
      			    	switch($userdata["perms"]){
      			    		default:
      			    			$rank = "";
      			    		break;
      			    		case '1':
      			    			$rank = "<img src=\"".$root."BoardMod.png\" />";
      			    		break;
      			    		case '2':
      			    			$rank = "<img src=\"".$root."Mod.png\" />";
      			    		break;
      			    		case '3':
      			    			$rank = "<img src=\"".$root."Staff.png\" />";
      			    		break;
      			    		case 4:
      			    		case 5:
      			    			$rank = "<img src=\"".$root."Admin.png\" />";
      			    		break;
      			    	}
      			    	$flag = ($userdata["flagged"]) ? "<img src=\"".$root."buttons/flag_1.png\" /> " : "";
			$clrs = explode(":",$userdata["colors"]);
			if($userdata["colors"] != ""){
		$c = array();
		if($clrs["1"] != "" AND $clrs["0"] != ""){
			$n = str_split($userdata["display"],1);
			for($t=0;$t<count($n);$t++){
				$t2 = ($t == 0) ? -1 : 1;
				$n2 = ($c[$t-$t2] == $clrs["0"]) ? $clrs["1"] : $clrs["0"];
				$c[$t] = $n2;
				$r .= "<a href=\"".$root."forum?act=profile&u=".$m["1"]."\"><span style=\"color:#".$c[$t].";\">".$n[$t]."</span></a>";
			}
		}else{
			$whichColor = ($clrs["1"] == "") ? $clrs["0"] : $clrs["1"];
			$r = "<a href=\"".$root."forum?act=profile&u=".$m["1"]."\"><span style=\"color:#".$whichColor.";\">".$userdata["display"]."</span></a>";
		}
	}else{
		$r = "<a href=\"".$root."forum?act=profile&u=".$m["1"]."\">".$userdata["display"]."</a>";
	}
		if($userdata["s_tag"] != "") $r .= "<span style=\"font-size:12px;\">(".strtoupper($userdata["s_tag"]).")</span>";
      			    	$tdp = preg_replace("/\[user=(\d+?)\]/i",$flag.$rank." ".$r." ".$rank,$tdp);
      				}else{
      					$tdp = "Guest";
      				}
      			    }
      			    if(preg_match("/\[quote pid=(\d+?)\]/i",$tdp,$m)){
      			    	$post = sql("SELECT userid,post FROM topics WHERE id = '".$m["1"]."'");
      			    	$p = getDisplay($post["userid"])." said:<div class=\"quote\">".ubbc($post["post"])."</span>";
      			    	$tdp = preg_replace("/\[quote pid=(\d+?)\]/i",$p,$tdp);
      			    }
      			    if(preg_match("/\{rank\}/i",$tdp)){
      			    	$s = sql("SELECT name FROM ranks WHERE posts <= '".postCount($_COOKIE["id"])."' ORDER BY posts DESC");
      			    	$tdp = str_replace("{rank}",$s["name"],$tdp);
      			    }
      			    $u = sql("SELECT display FROM members WHERE id = '".$_COOKIE["id"]."'");
      			    $disp = (online()) ? $u["display"] : "Guest";
      			    $tdp = str_replace("{display}",$disp,$tdp);
      			    $tdp = preg_replace("/\[quote\]/i","<strong>Quote:</strong><div class='quote'>",$tdp);
      			    $tdp = str_replace("[/quote]","</span>",$tdp);
      			    $tdp = preg_replace("/\[shadow=(.+?)\](.+?)\[\/shadow\]/i","<span style='text-shadow: 5px 5px 5px $1;'>$2</span>",$tdp);
      			    if(preg_match("/\[whisper=(\d+?)\](.+?)\[\/whisper\]/i",$tdp,$m)){
      			    	if($_COOKIE["id"] == $m["1"] AND online() OR checkPerms(4)){
      			    		$tdp = preg_replace("/\[whisper=(\d+?)\](.+?)\[\/whisper\]/i","<strong>Whisper:</strong><div class=\"quote\">$2</span>",$tdp);
      			    	}else{
      			    		$tdp = preg_replace("/\[whisper=(\d+?)\](.+?)\[\/whisper\]/i","<strong>** Whisper **</strong>",$tdp);
      			    	}
      			    }
      			    $tdp = preg_replace("/\[move\]/i","<marquee>",$tdp);
      			    $tdp = preg_replace("/\[\/move\]/i","</marquee>",$tdp);
      			    $tdp = preg_replace("/\[color=(.+?)\]/i", "<span style=\"color:#$1;\">", $tdp);
      			    $tdp = preg_replace("/\[\/color\]/i", "</span>", $tdp);
      			    $tdp = preg_replace("/\[font=(.+?)]/i","<span family=\"$1\">",$tdp);
      			    $tdp = preg_replace("/\[\/font\]/i","</span>",$tdp);
      			    $tdp = preg_replace("/\[style clr=(.+?) txt=(.+?)\]/i","<span style=\"color:#$1;font-family:'$2';\">",$tdp);
      			    $tdp = preg_replace("/\[\/style\]/i","</span>",$tdp);
      			    $tdp = preg_replace("/\[spoilers\](.+?)\[\/spoilers\]/i", "<strong>Spoilers:</strong><span style=\"border:1px solid #000000;\" class=\"mainbg2\"><a href=\"javascript:void(0);\" onclick=\"if(this.parentNode.firstChild.nextSibling.style.display!=''){this.parentNode.firstChild.nextSibling.style.display='';this.innerHTML='Hide spoilers';}else{this.parentNode.firstChild.nextSibling.style.display='none';this.innerHTML='Show spoilers';}\" class=\"siteLink\">Show spoilers</a><span style=\"display:none;\"><br />$1</span></span>", $tdp);
      			    $tdp = preg_replace("/\[yt\](.+?)\[\/yt\]/i","<object width=\"425\" height=\"350\"><param name=\"movie\" value=\"http://www.youtube.com/v/$1\"></param><embed src=\"http://www.youtube.com/v/$1\" type=\"application/x-shockwave-flash\" width=\"425\" height=\"350\"></embed></object>",$tdp);
      			     $tdp = preg_replace("/(?<!\")((aim|ftp|http|https|yim):\/\/(www\.)?[0-9a-zA-Z\-\.]+(\/['&=!\/\-\(\)\.\+#\?;\w]+)?)(?!\")/", "<a href=\"$1\" target=\"_blank\">$1</a>", preg_replace("/\[img\](.+)\[\/img\]/", "<img alt=\"Image\" src=\"$1\" />", $tdp));
      			     $serverdata = sql("SELECT server_status FROM sitedata");
      			     $tdp = str_replace("[mserver]",$serverdata["server_status"],$tdp);
      			     $tdp = preg_replace("/\[glow=(.+?)\](.+?)\[\/glow\]/i", "<span style=\"width:5px; filter:glow(color=$1,strength=5)\">$2</span>", $tdp);
                            $gc = mysqli_query($con,  "SELECT original,censor FROM censored") OR SQLError();
                            while($c = fetch($gc)){
                            	$tdp = preg_replace("/".$c["original"]."/i",$c["censor"],$tdp);
                            }
					 $tdp = str_replace("<script","",$tdp);
					 $tdp = str_replace("</script","",$tdp);
      			     $tdpx = $tdp;
      			      return $tdpx;
      		}
			
  function PleaseLogin(){
  	errMsg("You must <a href=\"?act=login\">Log In</a> to do that!");
  }
  
  function array_delete($needle,$haystack){
  	$needleFound = array_search($needle,$haystack);
  	unset($haystack[$needleFound]);
  	return $haystack;
  }
  
  function checkRd($id){
	(string) $c;
	$getstuffs = mysqli_query($con,  "SELECT readby FROM topics WHERE boardid = '".$id."' AND reply != 'yes'") OR SQLError();
	$t = mysqli_num_rows($getstuffs);
	if($t == 0) $c = "off";
	while($stuffs = fetch($getstuffs)){
		$s = explode(":",$stuffs["readby"]);
			if(!in_array($_COOKIE["id"],$s)){
				$c = "on";
				break;
			}else{
				$c = "off";
			}
   	 }
    return $c;
  }
  
  function viewCheck($boardid){
  	$vc = sql("SELECT id FROM viewing WHERE userid = '".$_COOKIE["id"]."'");
  	if($vc["id"] != ""){
  		query("UPDATE viewing SET viewing = CURRENT_TIMESTAMP WHERE boardid = '".intval($boardid)."' AND userid = '".$_COOKIE["id"]."'");
  	}else{
  		query("INSERT INTO viewing(boardid,userid)VALUES('".$boardid."','".$_COOKIE["id"]."')");
  	}
  }
  
  function checkPerms($amnt){
  	$pc = sql("SELECT perms FROM members WHERE id = '".$_COOKIE["id"]."'");
  	return($pc["perms"]>=$amnt OR $_COOKIE["id"] == 1);
  }

 function sql($q){
	$con = connect();
 	$q1 = mysqli_query($con,  $q) OR SQLError("SQL ERROR");
 	return fetch($q1);
 }
 
 function query($q,$r=0){
 	$con = connect();
	if($r == 0){
 		mysqli_query($con,  $q) OR SQLError("SQL ERROR");
 	}else{
 		return mysqli_query($con,  $q) OR SQLError("SQL ERROR");
 	}
 }
 
 function NoRows($v){
 	return (mysqli_num_rows($v) == 0);
 }
 
function capitals($str,$format=0){
	if(is_string($str)){
		if($format=1) 
			$str=strtolower($str);
		if($format=2)
			$str=strtoupper($str);
		if($format=3){
			$str=explode(" ",strtolower($str));
			for($a=0;$a < count($str);$a++){
				$str[$a][0]=strtoupper($str[$a][0]);
				$temp[]=$str[$a];
			}
			$str=implode(" ",$temp);
		}else{
			$str=strtolower($str);
			$str[0]=strtoupper($str[0]);
		}
	return $str;
	}
return $str;
}

                			function ucg_form($formname,$formcontent,$formmethod){
                			  $width = (basename($_SERVER["SCRIPT_FILENAME"]) != "chao.php") ? "780" : "680";
                				echo "<form action=\"\" method=\"".$formmethod."\"><table align=\"center\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\" style=\"width: ".$width."px;\"><tr><th class=\"titlebg\">".$formname."</th></tr><tr><td class=\"mainbg\">".$formcontent."</td></tr></table></form>";
                			}
							
 function online(){
 	return(isset($_COOKIE["id"]));
 }
 
 function unauthorized(){
 	errMsg("You do not have permission to do that!");
 }
 
 function AuthCheck($a=2){
 	onlineCheck();
 	if(!checkPerms($a)){
 		unauthorized();
 	}
 }
 
 function onlineCheck(){
 	if(!online()) PleaseLogin();
 }
 
 function isMe($userid){
 	return($userid==$_COOKIE["id"]);
 }
 
 function fetch($q){
 	return mysqli_fetch_assoc($q);
 }
 
	function pr($st,$rt=0){
		$t;
		if($rt){
			$t = "<pre>"+$st+"</pre>";
			return $t;
		}else{
			echo "<pre>";
			print_r($st);
			echo "</pre>";
		}
	}
	
        function checkAvailability($u){
        	$uget = sql("SELECT id FROM members WHERE name = '".userFormat($u)."'");
        	return ($uget["id"] == "");
        }
		
if(!function_exists('str_split')) {
//From php.net
    function str_split($string,$string_length=1) {
        if(strlen($string)>$string_length || !$string_length) {
            do {
                $c = strlen($string);
                $parts[] = substr($string,0,$string_length);
                $string = substr($string,$string_length);
            } while($string !== false);
        } else {
            $parts = array($string);
        }
        return $parts;
    }
}

function getTokens($userid){
	$t = sql("SELECT tokens FROM members WHERE id = '".intval($userid)."'");
	return $t["tokens"];
}

function admin(){
	AuthCheck(3);
	setTitle("Admin CP");
	require "admin.php";
}

function setTitle($t){
	$getTitle = sql("SELECT name FROM meta");
	js("document.title = '".$getTitle["name"]." - ".$t."';");
}

function userFormat($u){
                 $username = $u;
                 $username = sqlEsc($u);
                 $username = str_replace(" ","",$username);
                 $username = strtolower($username);
                 $username = strip_tags($username);
                 $username = htmlentities($username);
                 $username = htmlspecialchars($username);
                 $username = trim($username);
                 $username = str_replace(".","",$username);
                 $username = str_replace("'","",$username);
                 $username = str_replace('"',"",$username);
		 $username = str_replace(":","",$username);
		 $username = str_replace(";","",$username);
		 $username = preg_replace("/\?|\|,\\|#|\$|\^/","",$username);
                 return $username;
        }
		
function loguser($userid,$reason){
	if(online()){
		if(!is_dir("slogsx")){
			mkdir("slogsx");
		}
		$fetch = sql("SELECT name FROM members WHERE id = '".$userid."'");
		$fileName = "slogsx/".date("F-jS-Y").".txt";
		$f = fopen($fileName,"a+");
		$g = sql("SELECT gender FROM members WHERE id = '".$userid."'");
		if($g["gender"] != "robot" AND $g["gender"] != "unspecified"){
			$gender = ($g["gender"] == "male") ? "his" : "her";
		}else{
			$gender = "their";
		}
		$r = str_replace("their",$gender,sqlEsc($reason));
		query("INSERT INTO userLogs(userid,action,ip)VALUES('".$userid."','".addslashes($r)."','".$_SERVER["REMOTE_ADDR"]."')");
		fwrite($f,"[".$_SERVER["REMOTE_ADDR"]."] [user=".$userid."] ".$r." at ".date("g:i a")."\r\n");
		query("UPDATE members SET lastonline = CURRENT_TIMESTAMP WHERE id = '".$userid."'");
	}
}

function notifyUser($userid,$content){
	if(online()){
		query("INSERT INTO notifications(userid,content)VALUES('".$userid."','".sqlEsc($content)."')");
		loguser($_COOKIE["id"],"received a notification.");
	}
}

function displayNotes(){
							echo '
							<a href="javascript:;" onclick="showSection(this.parentNode.id);">close</a>
							<br />';
							 $getNotes = mysqli_query($con,  "SELECT * FROM notifications WHERE userid = '".$_COOKIE["id"]."' ORDER BY id DESC LIMIT 5") OR SQLError();
							 if(mysqli_num_rows($getNotes) == 0){
							 	echo "You have no notifications.";
							 }else{
							 	echo "<a href=\"javascript:;\" onclick=\"notesDelete('all');\">Delete All</a>";
							 }
							 while($n = fetch($getNotes)){
							 	echo "<div class=\"note_item mainbg2\">";
							 	if($n["unread"] == "yes"){
							 		echo " <img src=\"new.png\" /> ";
							 	}
							 	?>
							 	<a href="javascript:;" onclick="notesDelete(<?php echo $n["id"]; ?>);"><img src="buttons/delete.png" /></a>
							 	<?php
							 	echo ubbc($n["content"])."<br /> &nbsp; &nbsp; ".dateFormat($n["posted"])."</div><div style=\"height: 4px;\"></div>";
							 }
}

function SQLQuerySelect($what,$from,$where="1",$num_or_fetch="fetch"){
  $tmp = mysqli_query($con,  "SELECT ".$what." FROM ".$from." WHERE ".$where) OR SQLError();
    if($num_or_fetch == "fetch"):
     return $tmp = mysqli_fetch_assoc($tmp);
  elseif($num_or_fetch == "num"): 
   return $tmp = mysqli_num_rows($tmp);
    else:
     exit("Unsupported type."); 
 endif;
 }
 
  function userAge($id){
   $userdata=SQLQuerySelect("birthday","members","id='".$id."'");
    $d1=getdate(strtotime($userdata["birthday"]));
     $d2=getdate();
      $age=($d2["year"]-$d1["year"]);
       if($d2["yday"] < $d1["yday"]){
       	$age--;
      }
    return $age;
   }
   
 function getStatus($id){
 	$fetchStatus = sql("SELECT * FROM status_history WHERE userid = '".intval($id)."' ORDER BY id DESC LIMIT 1");
 	$s = sql("SELECT id,status,likedBy FROM status_history WHERE userid = '".intval($id)."' ORDER BY id DESC LIMIT 1");
 	$u = sql("SELECT friendsOnly,friends FROM members WHERE id = '".$fetchStatus["userid"]."'");
	$uf = explode(":",$u["friends"]);
	if(!$u["friendsOnly"] OR in_array($_COOKIE["id"],$uf) OR isMe($fetchStatus["userid"]) OR checkPerms(4)){
	$l = explode(":",$s["likedBy"]);
	$l2 = ($s["likedBy"] != "") ? "(".FormatRes((count($l)-1),"like").")" : "";
	if($s["status"] != ""){
		echo "<br /><div style=\"font-size:12px;\">".ubbc($s["status"])." ".$l2;
	if($_COOKIE["id"] != $id AND online()){
		if(!in_array($_COOKIE["id"],$l)){
			echo " &nbsp; &nbsp; <a href=\"javascript:likeStatus(".$s["id"].");\" id=\"l".$s["id"]."\"><img src=\"buttons/thumb_up.png\" /></a> ";
		}else{
			echo " &nbsp; &nbsp; <a href=\"javascript:likeStatus(".$s["id"].");\" id=\"l".$s["id"]."\"><img src=\"buttons/thumb_down.png\" /></a> ";
		}
	}
	if(online()){
		$numComments = mysqli_query($con,  "SELECT id FROM status_comments WHERE status_id = '".$s["id"]."'");
		echo "&nbsp; &nbsp; <br />";
			echo " <a href=\"javascript:;\" onclick=\"canUpdate=false;showSection('sc".$s["id"]."');\"><img src=\"buttons/comment_add.png\" /></a> &nbsp; &nbsp;";
		echo " <a href=\"?act=viewstatus&id=".$s["id"]."\" class=\"siteLink\"><img src=\"buttons/comments.png\" /></a> (".mysqli_num_rows($numComments).")
			<div id=\"sc".$s["id"]."\" class=\"sc\">
			<form action=\"javascript:sc(".$s["id"].");\" method=\"post\" name=\"scForm".$s["id"]."\" id=\"scForm".$s["id"]."\">
			<input type=\"text\" name=\"comment".$s["id"]."\" size=\"15\" required=\"1\" id=\"s_comment".$s["id"]."\" class=\"form-control\" />
			<input type=\"submit\" value=\"Send\" />
			<button type=\"submit\" name=\"submit\" id=\"sc\" class=\"formButton form-control\">Send</button>
			<br />
			&nbsp; &nbsp; <div style=\"font-size:11px;\"><a href=\"?act=viewstatus&id=".$s["id"]."\">view</a></div>
			</form>
			</div>";
	}
	echo "</div>";
	}
     }
 }
 
 function currentlyOnline(){
 	$mostUsers = sql("SELECT mostusers FROM sitedata");
 	$guests = numRows("SELECT ip FROM guests WHERE UNIX_TIMESTAMP(online_when) >= '".(time()-150)."' ORDER BY online_when DESC");
 $go = mysqli_query($con,  "SELECT id,name,s_tag,gender,display,invisible FROM members WHERE UNIX_TIMESTAMP(lastonline) >= '".(time()-300)."' ORDER BY lastonline DESC") OR SQLError();
$no = mysqli_num_rows($go);
(int) $mu = $mostUsers["mostusers"];
if($no > $mu){
	query("UPDATE sitedata SET mostusers = '".$no."', mostuserswhen = CURRENT_TIMESTAMP");
}
$cH=0;
echo "<div style=\"font-size:13px;\">".FormatRes($no,"Member").", ";
if(checkPerms(3) AND $guests > 0){
	echo " <a href=\"javascript:;\" onclick=\"nWin('viewguests.php');\" class=\"siteLink\">";
}
echo FormatRes($guests,"Guest");
if(checkPerms(3) AND $guests > 0){
	echo "</a>";
}
echo "</div>";
while($o = mysqli_fetch_assoc($go)){
	$cH++;
	if($o["invisible"] AND !checkPerms(3)) continue;
	$s = sql("SELECT id,status,likedBy FROM status_history WHERE userid = '".$o["id"]."' ORDER BY id DESC LIMIT 1");
	$l = explode(":",$s["likedBy"]);
	$l2 = ($s["likedBy"] != "") ? "(".FormatRes((count($l)-1),"like").")" : "";
	echo getDisplay($o["id"]);
	getStatus($o["id"]);
	echo '<div class="break"></div>';
}
}

function onlineToday(){
 	$con = connect();
	$guests = numRows("SELECT ip FROM guests WHERE UNIX_TIMESTAMP(online_when) >= '".(time()-86400)."' ORDER BY online_when DESC");
$got = mysqli_query($con,  "SELECT id,name,s_tag,gender,display,invisible FROM members WHERE UNIX_TIMESTAMP(lastonline) >= '".(time()-86400)."' ORDER BY lastonline DESC") OR exit("SQL Error");
$not = mysqli_num_rows($got);
$cH2=0;
echo "<div style=\"font-size:13px;\">".FormatRes($not,"Member").", ";
if(checkPerms(3) AND $guests > 0){
	echo " <a href=\"javascript:;\" onclick=\"nWin('viewguests.php?t=today');\">";
}
echo FormatRes($guests,"Guest");
if(checkPerms(3)){
	echo "</a>";
}
echo "</div>";
while($o2 = mysqli_fetch_assoc($got)){
	if($o2["invisible"] AND !checkPerms(3)) continue;
	$s = sql("SELECT status,likedBy FROM status_history WHERE userid = '".$o2["id"]."' ORDER BY id DESC LIMIT 1");
	$cH2++;
	echo getDisplay($o2["id"]);
	if($s["status"] != ""){
		echo "<br /><span style=\"font-size:12px;\">".ubbc($s["status"])."</span>";
	}
	if($cH2<$not){
		echo '<div class="break"></div>';
	}
}
}

function likeStatus($sid){
	$s = sql("SELECT likedBy,userid FROM status_history WHERE id = '".intval($sid)."'");
	$userdata = sql("SELECT display FROM members WHERE id = '".$s["userid"]."'");
	if($_COOKIE["id"] == $s["userid"]) exit("Error.");
	if(!online()) exit("Error.");
	$l = explode(":",$s["likedBy"]);
	if(!in_array($_COOKIE["id"],$l)){
		$l[] = $_COOKIE["id"];
		$l2 = implode(":",$l);
		query("UPDATE status_history SET likedBy = '".$l2."' WHERE id = '".$sid."'");
		loguser($_COOKIE["id"],"likes [user=".$s["userid"]."]'s status.");
		notifyUser($s["userid"],"[user=".$_COOKIE["id"]."] likes your status.");
	}else{
		$ad = array_delete($_COOKIE["id"],$l);
		query("UPDATE status_history SET likedBy = '".$ad."' WHERE id = '".$sid."'");
		loguser($_COOKIE["id"],"unliked [user=".$s["userid"]."]'s status.");
	}
}

function postCount($userid){
	$p = mysqli_query($con,  "SELECT id FROM topics WHERE userid = '".intval($userid)."'") OR SQLError();
	return mysqli_num_rows($p);
}

function banuser($userid){
	$userdata = sql("SELECT name,iplist,ip FROM members WHERE id = '".intval($userid)."'");
	$ips = explode(":",$userdata["iplist"]);
	query("INSERT INTO banned(ips,names,hostname,userid)VALUES('".$userdata["ip"]."','".$userdata["name"]."','".gethostbyaddr($userdata["ip"])."','".intval($userid)."')");
	$l=0;
	for($i=0;$i<count($ips);$i++){
		if($ips[$i] == "") continue;
		$u = sql("SELECT userList FROM ipcenter WHERE ip = '".$ips[$i]."'");
		$usrs = explode(":",$u["userList"]);
		$l++;
		for($y=0;$y<count($usrs);$y++){
			if($usrs[$y] == "") continue;
			$l++;
			query("INSERT INTO banned(ips,names,hostname,userid)VALUES('".$ips[$i]."','".$usrs[$y]."','".gethostbyaddr($ips[$i])."','".$userid."')");
		}
		query("INSERT INTO banned(ips,names,hostname,userid)VALUES('".$ips[$i]."','".$userdata["name"]."','".gethostbyaddr($ips[$i])."','".$userid."')");
	}
	query("UPDATE members SET warn = 100 WHERE id = '".$userid."'");
	loguser($_COOKIE["id"],"successfully banned [user=".$userid."] from the website with [b]".$l."[/b] records.");
}

function getDisplay($userid){
	return ubbc("[user=".$userid."]");
}

function lastPost($userid){
	$lp = sql("SELECT * FROM topics WHERE userid = '".$userid."' ORDER BY id DESC LIMIT 1");
	$np = numRows("SELECT id FROM topics WHERE topic_id = '".$lp["topic_id"]."'");
	$tp = ceil($np/10);
	$pages = ($tp > 1) ? "&p=".$tp : "";
	$bo = sql("SELECT name,staff FROM boards WHERE id = '".$lp["boardid"]."'");
	if($bo["staff"] AND !checkPerms(2)){
		echo "<em>Staff Post</em>";
	}else{
	if($lp["id"] == "") echo "No posts.";
	else
	return "<a href=\"?act=topic&id=".$lp["topic_id"].$pages."#".$lp["id"]."\">".stripslashes($lp["subject"])."</a> (<a href=\"?act=viewtopics&bid=".$lp["boardid"]."\">".$bo["name"]."</a>) ".dateFormat($lp["posted"]);
	}
}

 function dateFormat($tdate){
  	$f = strtotime($tdate);
 	$startDate = getDate($f);
 	$days = getDate();
 	$numDays = ($days["yday"] - $startDate["yday"]);
 	$weeks=0;
 	$g;
 	switch((int)$numDays){
 		default:
 			$g = "<em>".date("F jS, Y",$f)."</em>";
 		break;
 		case '0':
 			$g = "<strong>Today</strong> (".date("g:i a",$f).")";
 		break;
 		case '1':
 			$g = "<em>Yesterday</em> (".date("g:i a",$f).")";
 		break;
 	}
 	return "<span style=\"font-size:12px;font-family:'Verdana';\">".$g."</span>";
}

      function warnuser($warn=10,$userid){
      $warn_level = sql("SELECT warn FROM members WHERE id = '".$userid."'");
      $warn_level = $warn_level["warn"]+$warn;
      $warn_user = query("UPDATE members SET warn = '".$warn_level."' WHERE id = '".$userid."'");
   }
   
function warnReason($userid,$details,$reason,$amount){
	warnuser($amount,$userid);
	query("INSERT INTO warn(userid,amount,reason,details,warner_id)VALUES('".$userid."','".$amount."','".$reason."','".addslashes($details)."','".$_COOKIE["id"]."')");
}

function invData(){
	errMsg("Whoops. Looks like you might not've supplied enough data. Terribly sorry about that. Please try again with an <em>actual</em> link, or contact the admin if you believe this was a mistake. Also, please note that we do not tolerate web site exploitation or hacking under any circumstances.");
}
function addTokens($id,$i=5){
	$userdata = sql("SELECT token_banned FROM members WHERE id = '".intval($id)."'");
	if(!$userdata["token_banned"]){
		$t = sql("SELECT tokens FROM members WHERE id = '".$id."'");
		$tokens = $t["tokens"]+$i;
		query("UPDATE members SET tokens = '".$tokens."' WHERE id = '".$id."'");
		notifyUser($_COOKIE["id"],"Your tokens have been increased by $".$i.".");
	}
}

function useTokens($amnt){
	$t = getTokens($_COOKIE["id"]);
	if($t < $amnt) errMsg("You don't have enough tokens to do that. You are short by ".FormatRes(($amnt-$t),"token").".");
	$tokensY = $t-=$amnt;
	query("UPDATE members SET tokens = '".$tokensY."' WHERE id = '".$_COOKIE["id"]."'");
	updateBank($amnt);
}

function updateBank($amnt){
	$bank = sql("SELECT bank FROM sitedata");
	$newAm = $bank["bank"]+$amnt;
	query("UPDATE sitedata SET bank = '".$newAm."'");
}

function toLoc($location){
	header("Location: ".$location);
}

function getBirthdays(){
	$birthdays = array();
	$getbdays = mysqli_query($con,  "SELECT id,birthday,show_age FROM members");
	while($bdays = fetch($getbdays)){
		if(date("m d",strtotime($bdays["birthday"])) == date("m d")){
			$birthdays[] = $bdays["id"]."|".$bdays["show_age"]."|".$bdays["id"];
		}
	}
	$bdCount = (count($bdays) > 1) ? "s" : "";
	if(count($birthdays) > 0){
		echo FormatRes(count($birthdays),"birthday").$bdCount." today: &nbsp; &nbsp; ";
		$cH=0;
		for($i=0;$i<count($birthdays);$i++){
			$cH++;
			$ds = explode("|",$birthdays[$i]);
			echo "<img src=\"buttons/birthday.gif\" /> ".getDisplay($ds["0"]);
			if($ds["1"] == 'yes' OR checkPerms(3)){
				echo " (".userAge($ds["2"]).") ";
			}
			if($cH < count($birthdays)){
				echo ", ";
			}
		}
	}else{
		echo "There are no birthdays today.";
	}
}

function getMessages($t="inbox"){
	?>
       	              			<table class="table bordercolor" cellspacing="1" cellpadding="4">
	<?php
	switch($t){
		case 'inbox':
					echo "<tr><th class=\"titlebg\" colspan=\"4\">Inbox</th></tr>";
       	              			$getMessages = mysqli_query($con,  "SELECT * FROM pm WHERE touser = '".$_COOKIE["id"]."' AND trashed != 1 AND saved != 1 ORDER BY sent DESC") OR SQLError("Could not retrive messages.");
       	              			while($m = fetch($getMessages)){
       	              				echo "<tr>
       	              					<td class=\"mainbg\" align=\"center\">
       	              					<a href=\"javascript:if(reConf('Are you sure you wish to delete this message?')) deleteMsg(".$m["id"].",'inbox');\"><img src=\"buttons/cross.png\" /></a>
       	              					</td>
       	              					<td class=\"mainbg\">
       	              					<strong>From:</strong> ".getDisplay($m["fromuser"])."
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"35%\">";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo "<img src=\"new.png\" /> ";
       	              				      }
       	              				      echo "<a href=\"javascript:viewMsg(".$m["id"].");\"";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo " style=\"font-weight:bold;\"";
       	              				      }
       	              				      echo ">";
       	              				      if($m["urgent"]){
       	              				      	echo "<img src=\"buttons/tag_red.png\" style=\"height:20px;width:20px;\" /> **URGENT** ";
       	              				      }
       	              				      echo stripslashes($m["subject"])."</a>
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"25%\">
       	              				      ".date("F jS, Y",strtotime($m["sent"]))."
       	              				      </td>
       	              				      </tr>";
       	              			}
       	              			break;
       	        case 'outbox':
					echo "<tr><th class=\"titlebg\" colspan=\"4\">Outbox</th></tr>";
       	              			$getMessages = mysqli_query($con,  "SELECT * FROM pm WHERE fromuser = '".$_COOKIE["id"]."' AND trashed != 1 ORDER BY sent DESC") OR SQLError("Could not retrive messages.");
       	              			while($m = fetch($getMessages)){
       	              				echo "<tr>
       	              					<td class=\"mainbg\">
       	              					<strong>To:</strong> ".getDisplay($m["touser"])."
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"35%\">";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo "<img src=\"new.png\" /> ";
       	              				      }
       	              				      echo "<a href=\"javascript:viewMsg(".$m["id"].");\"";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo " style=\"font-weight:bold;\"";
       	              				      }
       	              				      echo ">".stripslashes($m["subject"])."</a>
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"25%\">
       	              				      ".date("F jS, Y",strtotime($m["sent"]))."
       	              				      </td>
       	              				      </tr>";
       	              			}
       	        break;
       	        case 'trash':
       	        echo "<tr><th class=\"titlebg\" colspan=\"4\">Trash</th></tr>
       	        	<tr><td class=\"mainbg\" colspan=\"4\"><a href=\"javascript:deleteForever();\">Delete Forever</a></td></tr>";
       	              			$getMessages = mysqli_query($con,  "SELECT * FROM pm WHERE touser = '".$_COOKIE["id"]."' AND trashed = 1 AND saved != 1 ORDER BY sent DESC") OR SQLError("Could not retrive messages.");
       	              			while($m = fetch($getMessages)){
       	              				echo "<tr>
       	              					<td class=\"mainbg\">
       	              					<a href=\"javascript:restoreItem(".$m["id"].");\"><img src=\"buttons/recycle.png\" /></a>
       	              					</td>
       	              					<td class=\"mainbg\">
       	              					<strong>From:</strong> ".getDisplay($m["fromuser"])."
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"35%\">";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo "<img src=\"new.png\" /> ";
       	              				      }
       	              				      echo "<a href=\"javascript:viewMsg(".$m["id"].");\"";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo " style=\"font-weight:bold;\"";
       	              				      }
       	              				      echo ">".stripslashes($m["subject"])."</a>
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"25%\">
       	              				      ".date("F jS, Y",strtotime($m["sent"]))."
       	              				      </td>
       	              				      </tr>";
       	              			}
       	        break;
       	        case 'saved':
					echo "<tr><th class=\"titlebg\" colspan=\"4\">Saved</th></tr>";
       	              			$getMessages = mysqli_query($con,  "SELECT * FROM pm WHERE touser = '".$_COOKIE["id"]."' AND trashed != 1 AND saved = 1 ORDER BY sent DESC") OR SQLError("Could not retrive messages.");
       	              			while($m = fetch($getMessages)){
       	              				echo "<tr>
       	              					<td class=\"mainbg\">
       	              						<a href=\"javascript:deleteMsg(".$m["id"].",'inbox');\"><img src=\"buttons/cross.png\" /></a>
       	              					</td>
       	              					<td class=\"mainbg\">
       	              					<strong>From:</strong> ".getDisplay($m["fromuser"])."
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"35%\">";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo "<img src=\"new.png\" /> ";
       	              				      }
       	              				      echo "<a href=\"javascript:viewMsg(".$m["id"].");\"";
       	              				      if($m["unread"] == "yes"){
       	              				      	echo " style=\"font-weight:bold;\"";
       	              				      }
       	              				      echo ">".stripslashes($m["subject"])."</a>
       	              				      </td>
       	              				      <td class=\"mainbg2\" width=\"25%\">
       	              				      ".date("F jS, Y",strtotime($m["sent"]))."
       	              				      </td>
       	              				      </tr>";
       	              			}
       	        break;
       	        }
       	              			?>
       	              			</table>
       	              			<?php
}

function gamerPoints($userid){
	$gp = sql("SELECT gpoints FROM members WHERE id = '".$userid."'");
	return $gp["gpoints"];
}

function checkEmail($em){
	$em = sql("SELECT id FROM members WHERE email = '".sqlEsc($_POST["email"])."'");
	return($em["id"] == "");
}

function sendPM($to,$from,$subject,$message,$urgent=0){
	if(!is_blocked($to,$from) OR $from == '3'){
		if(!pmDisabled($to,$from)){
			if($urgent){
				query("UPDATE members SET last_urgent = CURRENT_TIMESTAMP WHERE id = '".$from."'");
			}
			if($from != '3'){
				foCheck($to);
			}
			$toEmail = sql("SELECT id,m_email,email,activated FROM members WHERE id = '".intval($to)."'");
			query("INSERT INTO pm(touser,fromuser,subject,message,urgent)VALUES('".intval($to)."','".intval($from)."','".sqlEsc($subject)."','".sqlEsc($message)."',".$urgent.")");
			loguser(intval($from),"sent a PM to [user=".intval($to)."].");
			notifyUser($to,"[user=".$from."] sent you a message.");
			if($toEmail["m_email"] AND $toEmail["activated"]){
       	              		$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: noreply@zollernverse.org";
    	 			$message = "Hello, [user=".$toEmail["id"]."]! You are receiving this e-mail because [user=".$from."] has sent you a new Private Message on Zollernverse's forums.[br][br]Subject: ".strip_tags($subject)." [br][br]----- Message -----:[br]".ubbc($message)."[br]----- End -----[hr]To stop receiving this e-mails, please log in to your account at http://www.zollernverse.org/ and change your \"PM E-Mails\" subscription to \"Unsubscribed.\" Thank you and have a great day.[hr][b]DO NOT[/b] reply to this e-mail. You will simply receive an automated response.";
    	 		mail($toEmail["email"],"You Have A New Personal Message!",$message,$headers);
    	 		loguser('3',"An e-mail was sent to [user=".$to."] because of a new private message.");
			}
		}else{
			errMsg("Looks like either you or the recipient have disabled PMs. Sorry. ".ubbc(":/"));
		}
	}else{
		errMsg("Whoops, looks like this user isn't accepting messages. Bummer. " . ubbc(":("));
	}
}

function botPM($to,$from=3,$subject,$message){
	sendPM($to,$from,$subject,$message);
	query("UPDATE members SET lastonline = CURRENT_TIMESTAMP WHERE id = '".$from."'");
	botComment($to,"Welcome to Zollernverse, [user=".$to."]. I am one of the site's robots, and I am here to assist you. :)");
	logUser($from,"sent a PM to [user=".$to."].");
}

function botComment($userid,$comment){
	query("INSERT INTO profile_comments(userid,prof_id,comment,posted)VALUES('3','".$userid."','".addslashes($comment)."',CURRENT_TIMESTAMP)");
	query("UPDATE members SET lastonline = CURRENT_TIMESTAMP WHERE id = '3'");
	loguser('3','commented on [user='.$userid.']\'s profile.');
	notifyUser($_COOKIE["id"],"[user=3] commented on your profile.");
}

function is_blocked($userid,$myID){
	$blocked = sql("SELECT name,blocked,disable_pm FROM members WHERE id = '".$userid."'");
	$b = explode(",",$blocked["blocked"]);
	$name = sql("SELECT name FROM members WHERE id = '".$myID."'");
	$myBlocked = sql("SELECT blocked FROM members WHERE id = '".$myID."'");
	$bl = explode(",",$myBlocked["blocked"]);
	return(in_array($name["name"],$b) OR in_array($blocked["name"],$bl));
}

function pmDisabled($to,$from){
	$to_dm = sql("SELECT disable_pm FROM members WHERE id = '".$to."'");
	$from_dm = sql("SELECT disable_pm FROM members WHERE id = '".$from."'");
	return ($to_dm["disable_pm"] == 'y' OR $from_dm['disable_pm'] == 'y');
}

function updateViews($topic_id){
	$v = sql("SELECT views FROM topics WHERE id = '".$topic_id."'");
	(int) $views = $v["views"]+=1;
	query("UPDATE topics SET views = '".$views."' WHERE id = '".$topic_id."'");
}

function isOwner(){
	return ($_COOKIE["id"] == 1 OR $_COOKIE["id"] == 2);
}

function ownerCheck(){
	if(!isOwner()) errMsg("You do not have the authorization here.");
}

function numRows($q){
	$query = mysqli_query($con,  $q) OR SQLError();
	return mysqli_num_rows($query);
}

function getForumLastPost(){
$check = ($_GET["act"] == 'viewtopics') ? " WHERE boardid = '".$_GET["bid"]."'" : "";
$last_post = sql("SELECT subject,id,userid,posted,topic_id,boardid,reply FROM topics ".$check." ORDER BY id DESC LIMIT 1");
$board = sql("SELECT staff,name FROM boards WHERE id = '".$last_post["boardid"]."'");
if($board["staff"] AND !checkPerms(2)){
	echo "Last post was made in a staff area.";
}else{
$udata = sql("SELECT name,s_tag,display FROM members WHERE id = '".$last_post["userid"]."'");
if($last_post["id"] != ""){
$np1 = numRows("SELECT id FROM topics WHERE topic_id = '".$last_post["topic_id"]."'");
$tp = ceil(($np1-1)/10);
$pages = ($tp > 1) ? "&p=".$tp : "";
?>
<strong>Last Post</strong>: <a href="?act=topic&id=<?php echo $last_post["topic_id"].$pages; ?>#<?php echo $last_post["id"]; ?>" class="siteLink"><?php echo $last_post["subject"]; ?></a> (<a href="?act=viewtopics&bid=<?php echo $last_post["boardid"]; ?>" class="siteLink"><?php echo stripslashes($board["name"]); ?></a>) by <?php echo getDisplay($last_post["userid"]); ?> <?php echo dateFormat($last_post["posted"]); ?>
<?php
}else{
echo "<strong>Last Post</strong>: N/A";
}
}
}

function createToken(){
       	              			$letters = array("a","b","c","d","e","f","g",
       	              			"h","i","j","k","l","m","n","o","p","q","r",
       	              			"s","t","u","v","w","x","y","z");
       	              			$numbers = array("1","2","3","4","5","6","7","8","9","0");
       	              			$i = 0;
       	              			$token;
       	              			while($i < 25){
       	              				$token .= 
       	              				$letters[mt_rand(0,count($letters))]."::".
       	              				$numbers[mt_rand(0,count($numbers))];
       	              			$i++;
       	              			}
 return $token;
}

function activEmail($email){
    $headers = "From: support@zollernverse.org \r\n";
    $headers .= 'MIME-Version: 1.0 \r\n';
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $data = sql("SELECT name,pass FROM members WHERE email = '".$email."'");
    $act_code = md5($data["name"]."::".$data["pass"]);
    query("UPDATE members SET act_code = '".$act_code."' WHERE id = '".$n."'");
    $message = "Hello! Thank you for registering at Zollernverse!<br /><br />Before you get started, please click on the link below (or copy and paste it into your address bar) to confirm and activate your account with us:<br /><br /> <strong>Click here:</strong> http://www.zollernverse.org/forum.php?act=activate&id=".$n."&code=".$act_code;
    mail($email,"Activate Your Zollernverse Account",$message,$headers);
}

//DC Functions
         function evolve($cid,$alignment){
          $chaodata = ucg_query("SELECT * FROM chao WHERE id = '".$cid."'",1);
          $invis = ($chaodata["invis"] == 'y') ? "invisible/" : "";
           if(($chaodata["swimlevel"] == "7") AND ($chaodata["powerlevel"] /* IT'S OVER NINE THOUSAAAAAAND! */ == "7") AND ($chaodata["reincarnated"] >= 1)){
            if($alignment == "hero") $chao = "Nebula"; else $chao = "Raxius";
             query("UPDATE chao SET image = '".$invis."special/".$chao.".gif' WHERE id = '".$cid."'");
              query("UPDATE chao SET evolved = 'y' WHERE id = '".$cid."'");
			  addTokens($_COOKIE["id"],5000);
               $sg = $chaodata["swimgrade"];
             $val = "";
              if($sg == "A"){
               $val = "S";
            }elseif($sg == "B"){
             $val = "A";
           }elseif($sg == "C"){
            $val = "B";
         }elseif($sg == "D"){
          $val = "C";
        }elseif($sg == "E"){
         $val = "D";
        }elseif($sg == "S"){
         $val = "X";
       }else{
        $val = "X";
     }
       query("UPDATE chao SET swimgrade = '".$val."' WHERE id = '".$cid."'");
        $pg = $chaodata["powergrade"];
             $val2 = "";
              if($pg == "A"){
               $val2 = "S";
            }elseif($pg == "B"){
             $val2 = "A";
           }elseif($pg == "C"){
            $val2 = "B";
         }elseif($pg == "D"){
          $val2 = "C";
        }elseif($pg == "E"){
         $val2 = "D";
        }elseif($pg == "S"){
         $val2 = "X";
       }else{
        $val2 = "X";
     }
       query("UPDATE chao SET powergrade = '".$val2."' WHERE id = '".$cid."'");
   }elseif(($chaodata["swimgrade"] == "A" AND $chaodata["flygrade"] == "A" AND $chaodata["rungrade"] == "A" AND $chaodata["powergrade"] == "A" AND $chaodata["staminagrade"] == "A") AND ($chaodata["flylevel"] >= 20) AND ($chaodata["reincarnated"] >= 2)){
    query("UPDATE chao SET image = '".$invis."Omochao.gif', evolved = 'y' WHERE id = '".$cid."'");
    addTokens($_COOKIE["id"],"1500");
 }else{
           $the_stat = ucg_query("SELECT GREATEST(".$chaodata["swim"].", ".$chaodata["fly"].", ".$chaodata["run"].", ".$chaodata["power"].", ".$chaodata["stamina"].")",1);
                $iStat = $the_stat['GREATEST('.$chaodata["swim"].', '.$chaodata["fly"].', '.$chaodata["run"].', '.$chaodata["power"].', '.$chaodata["stamina"].')'];
                 if($iStat == $chaodata["swim"]){
                  $evolution = "swim";
                 }elseif($iStat == $chaodata["fly"]){
                  $evolution = "fly";
                 }elseif($iStat == $chaodata["run"]){
                $evolution = "run";
               }elseif($iStat == $chaodata["power"]){
               $evolution = "power";
              }else{
             $evolution = "stamina";
           }
           $evo_row = $evolution."grade";
             $alignevo = $invis.$alignment . "/" . $evolution . "/" . $evolution . ".gif";
              $chaograde = ucg_query("SELECT `".$evo_row."` FROM chao WHERE id = '".$cid."'",1);
           query("UPDATE chao SET image = '".$alignevo."', evolved = 'y' WHERE id = '".$cid."'");
		   addTokens($_COOKIE["id"],"865");
            $val = "";
              if($chaograde[$evo_row] == "A"){
               $val = "S";
            }elseif($chaograde[$evo_row] == "B"){
             $val = "A";
           }elseif($chaograde[$evo_row] == "C"){
            $val = "B";
         }elseif($chaograde[$evo_row] == "D"){
          $val = "C";
        }elseif($chaograde[$evo_row] == "E"){
         $val = "D";
        }elseif($chaograde[$evo_row] == "S"){
         $val = "X";
       }else{
        $val = "X";
     }
             query("UPDATE chao SET `".$evo_row."` = '".$val."' WHERE id = '".$cid."'");
       }
       	       echo '<audio controls="controls" autoplay="true" hidden="true" id="alignEvolve">
       	       		<source src="userchao/chaosounds/'.$alignment.'.wav" id="soundOne" />
       	       </audio>';
   }
   
    function second_evolution($cid,$enable_2nd_evo="off"){
      $chaodata = ucg_query("SELECT * FROM chao WHERE id = '".$cid."'",1);
       if($chaodata["second_evolved"] != 'y'){
      $invis = ($chaodata["invis"] == 'y') ? "invisible/" : "";
       if(getAge($cid) >= 2){
        $the_stat = ucg_query("SELECT GREATEST(".$chaodata["swim"].", ".$chaodata["fly"].", ".$chaodata["run"].", ".$chaodata["power"].", ".$chaodata["stamina"].")",1);
                $iStat = $the_stat['GREATEST('.$chaodata["swim"].', '.$chaodata["fly"].', '.$chaodata["run"].', '.$chaodata["power"].', '.$chaodata["stamina"].')'];
                echo $iStat.":";
                 if($iStat == $chaodata["swim"]){
                  $evolution = "swim";
                  echo "Swim".":";
                 }elseif($iStat == $chaodata["fly"]){
                  $evolution = "fly";
                 }elseif($iStat == $chaodata["run"]){
                $evolution = "run";
               }elseif($iStat == $chaodata["power"]){
               $evolution = "power";
              }else{
             $evolution = "stamina";
            }
           $chaograde = $evolution."grade";
           echo $chaograde.":";
            $chaoimg = $chaodata["image"];
            echo $chaoimg;
             $alignevo = explode("/",$chaoimg);
              if($invis == "invisible/"){
               $alignment = "invisible/".$alignevo["1"];
               $evo = $alignevo["2"];
             }else{
              $alignment = $alignevo["0"];
              $evo = $alignevo["1"];
            }
                $ev = $alignment . "/" . $evo . "/" . $evolution . "/" . $evolution . ".gif";
                 query("UPDATE chao SET image = '".$ev."', second_evolved = 'y' WHERE id = '".$cid."'");
                 addTokens($_COOKIE["id"],"432");
             $val = "";
              if($chaograde[$evo_row] == "A"){
               $val = "S";
            }elseif($chaograde[$evo_row] == "B"){
             $val = "A";
           }elseif($chaograde[$evo_row] == "C"){
            $val = "B";
         }elseif($chaograde[$evo_row] == "D"){
          $val = "C";
        }elseif($chaograde[$evo_row] == "E"){
         $val = "D";
        }elseif($chaograde[$evo_row] == "S"){
         $val = "X";
       }else{
        $val = "X";
     }
      query("UPDATE chao SET ".$chaograde." = '".$val."' WHERE id = '".$cid."'");
    }
   }
  }
  
  function isSuperChao($cid){
  	$chaodata = sql("SELECT image FROM chao WHERE id = '".$cid."'");
  	return ($chaodata["image"] == "Sonic.gif" OR $chaodata["image"] == "neutral/run/run/run.gif" OR $chaodata["image"] == "dark/run/run/run.gif" OR $chaodata["image"] == "Silver.gif");
  }
  
   function chaos($cid,$em){
    $cd = SQLQuerySelect("chaos_emeralds,image,run","chao","id = '".$cid."'");
    $ce = explode(":",$cd["chaos_emeralds"]);
    if(preg_match("/chaos\/Chaos (\d+?)\.gif/i",$cd["image"]) OR $cd["image"] == "Chaos 0.gif"){
       $t = array("1","2","4","6","7");
        if(in_array($em,$t)){
           query("UPDATE chao SET image = 'chaos/Chaos ".$em.".gif' WHERE id = '".$cid."'");
		   addTokens($_COOKIE["id"],$em."000");
      }
    }else if($cd["image"] == 'Sonic.gif' OR $cd["image"] == 'neutral/run/run/run.gif'){
    	if($em == 7){
    		query("UPDATE chao SET image = 'super-sonic.gif' WHERE id = '".$cid."'");
			addTokens($_COOKIE["id"],"8000");
    	}
    }else if($cd["image"] == "dark/run/run/run.gif"){
    	if($em == 7){
    		query("UPDATE chao SET image = 'Super Shadow.gif' WHERE id = '".$cid."'");
			addTokens($_COOKIE["id"],"8000");
    	}
    }else if($cd["image"] == "Silver.gif"){
    	if($em == 7){
    		query("UPDATE chao SET image = 'Super Silver.gif' WHERE id = '".$cid."'");
			addTokens($_COOKIE["id"],"9600");
    	}
    }
   }
   
  function reincarnate($cid){
   $chaodata = ucg_query("SELECT * FROM chao WHERE id = '".$cid."'",1);
    if(isYourChao($cid)){
     if(!isChaosChao($cid)AND!isShopChao($cid)){
      $age = getAge($cid);
       if($age >= 5){
        if($chaodata["happiness"] >= 100){
        $swim = ceil($chaodata["swim"]/2);
        $fly = ceil($chaodata["fly"]/2);
        $run = ceil($chaodata["run"]/2);
        $power = ceil($chaodata["power"]/2);
        $stamina = ceil($chaodata["stamina"]/2);
        $rein = $chaodata["reincarnated"]+1;
        $im = ($chaodata["invis"] == 'y') ? "InvisibleChao-Final-1.gif" : "member.gif";
         query("UPDATE `chao` SET `image` = '".$im."', `evolved` = 'n', `second_evolved` = 'n', `born` = CURRENT_TIMESTAMP, `age` = '0', `reincarnated` = '".$rein."', `swim` = '".$swim."', `fly` = '".$fly."', `run` = '".$run."', `power` = '".$power."', `stamina` = '".$stamina."', swimlevel = '1', flylevel = '1', runlevel = '1', powerlevel = '1', staminalevel = '1' WHERE `id` = '".$cid."'");
		 addTokens($_COOKIE["id"],600);
     }else{
      chao_die($cid);
    }
   }
  }
 }
}

   function chao_die($cid){
    $chaodata = ucg_query("SELECT name,age,happiness FROM chao WHERE id = '".$cid."'",1);
     if(isYourChao($cid)){
      if(!isChaosChao($cid)AND!isShopChao($cid)){
       $age = getAge($cid);
        if($age >= 5){
         if($chaodata["happiness"] < 100){
          query("DELETE FROM chao WHERE id = '".$cid."'");
           forumMsg("We are sorry, but your chao has passed on.<br /><br />R.I.P., ".$chaodata["name"].".");
            header("Refresh:5;chao.php");
        }
       }
      }
     }
    }
	
        function isChaosChao($cid){
          $chaoschao = ucg_query("SELECT `image`,`invis` FROM `chao` WHERE `id` = '".$cid."'",1);
           $chao_list = array("special/Nebula.gif","special/Raxius.gif","special/ChaoGod.gif","hero/chaos/hero.gif","dark/chaos/dark.gif","neutral/chaos/neutral.gif");
            return (in_array($chaoschao["image"],$chao_list));
          }
		  
       function isShopChao($cid){
       $chaodata = ucg_query("SELECT image,invis FROM chao WHERE id = '".$cid."'",1);
        if($chaodata["invis"] != 'y'){
          if(!preg_match("/member|new|neutral|hero|dark|special|Invisible/",$chaodata["image"])){
           return true;
         }else{
          return false;
         }
        }else{
         return false;
       }
      }
	  
        function getAge($id){
          $age = ucg_query("SELECT age FROM chao WHERE id = '".$id."'",1);
           return $age["age"];
    }
	
     function is_hatched($cid){
      $hatched = ucg_query("SELECT hatched FROM chao WHERE id = '".$cid."'",1);
        if($hatched["hatched"] == 'y') return true; else return false;
    }
	
   function ucg_query($q,$tmp_bool=0){
    $tmp=mysqli_query($con,  $q) OR SQLError();
     if($tmp_bool): return $tmp=mysqli_fetch_assoc($tmp); endif;
 }
 
  function isYourChao($cid){
   $is_your_chao = ucg_query("SELECT owner FROM chao WHERE id = '".$cid."'",1);
    return (isMe($is_your_chao["owner"]));
 }
 
function is_evolved($cid){
 $chaodata = ucg_query("SELECT image FROM chao WHERE id = '".$cid."'",1);
  if($chaodata["image"]  != "member.gif" AND $chaodata["image"] != "InvisibleChao-Final-1.gif"): return true;
 else: return false; 
endif;
}

// ------- 

function sqlEsc($q){
	return mysqli_real_escape_string($q);
}

function canVote($pollid){
	$pollData = sql("SELECT num_votes,locked FROM polls WHERE id = '".$pollid."'");
	$voted = numRows("SELECT userid FROM voters WHERE poll_id = '".$pollid."' AND userid = '".$_COOKIE["id"]."'");
	return ($voted <= $pollData["num_votes"] AND !$pollData["locked"]);
}

function noValue($str){
	return ($str == "");
}

function getPostFromBoard($boardID){
	$board = sql("SELECT * FROM boards WHERE id = '".$boardID."'");
	$getLastPost = sql("SELECT * FROM topics WHERE boardid = '".$boardID."' ORDER BY last_updated DESC LIMIT 1");
	$lp = mysqli_query($con,  "SELECT posted,subject,userid,id,topic_id,post FROM topics WHERE boardid = '".$boardID."' ORDER BY id DESC LIMIT 1");
	$lp2 = fetch($lp);
	$subj = ($logged["v2mode"]) ? ((strlen($lp2["subject"]) >= 18) ? substr($lp2["subject"],0,18).".." : $lp2["subject"]) : ((strlen($lp2["subject"]) >= 25) ? substr($lp2["subject"],0,25).".." : $lp2["subject"]);
	$np = numRows("SELECT id FROM topics WHERE topic_id = '".$lp2["topic_id"]."'");
	$tp = ceil(($np-1)/10);
	$pages = ($tp > 1) ? "&p=".$tp : "";
	$getSB = mysqli_query($con,  "SELECT * FROM boards WHERE subboard = '".$boardID."'");
	$numSB = mysqli_num_rows($getSB);
	if($numSB > 0){
		$sbID = array();
		$sbDate = array();
		$i=0;
		while($sb = fetch($getSB)){
			$subPost = sql("SELECT id,last_updated FROM topics WHERE boardid = '".$sb["id"]."' ORDER BY id DESC LIMIT 1");
			$sbID[$i] = $subPost["id"];
			$sbDate[$i] = strtotime($subPost["last_updated"]);
			$i++;
		}
		$getKey = max($sbDate);
		$keyPost = array_search($getKey,$sbDate);
		$lpID = $sbID[$keyPost];
		$LPdata = sql("SELECT * FROM topics WHERE id = '".$lpID."'");
		$LPsubj = (strlen($LPdata["subject"]) >= 18) ? substr($LPdata["subject"],0,18).".." : $LPdata["subject"];
		if(strtotime($getLastPost["last_updated"]) < strtotime($LPdata["last_updated"])){
			$lastpost = ($LPdata["id"] != "") ? getDisplay($LPdata["userid"])." posted in <a href=\"?act=topic&id=".$LPdata["topic_id"].$pages."#".$LPdata["id"]."\" style=\"font-size:18px;\" onmouseover=\"showSection('topic".$LPdata["id"]."');\" class=\"siteLink\">".$LPsubj."</a><br />".dateFormat($LPdata["posted"]): "N/A";
		}else{
			$lastpost = ($lp2["id"] != "") ? getDisplay($lp2["userid"])." posted in <a href=\"?act=topic&id=".$lp2["topic_id"].$pages."#".$lp2["id"]."\" onmouseover=\"showSection('topic".$lp2["id"]."');\" class=\"siteLink\">".$subj."</a><br />".dateFormat($lp2["posted"]): "Nothing posted..";
		}
	}else{
		$lastpost = ($lp2["id"] != "") ? getDisplay($lp2["userid"])." posted in <a href=\"?act=topic&id=".$lp2["topic_id"].$pages."#".$lp2["id"]."\" style=\"font-size:18px;\" onmouseover=\"showSection('topic".$lp2["id"]."');\" class=\"siteLink\">".$subj."</a><br />".dateFormat($lp2["posted"]): "N/A";
	}
	return $lastpost;
}

function fetchBoard($fboardid){
	$v2mode = sql("SELECT v2mode FROM members WHERE id = '".$_COOKIE["id"]."'");
	$centerCheck = sql("SELECT boards_center FROM sitedata");
	$centered = $centerCheck["boards_center"];
	$boards = sql("SELECT * FROM boards WHERE id = '".$fboardid."'");
	$getsubboards = mysqli_query($con,  "SELECT * FROM boards WHERE subboard = '".$fboardid."' ORDER BY name ASC") OR SQLError();
	$numSB = mysqli_num_rows($getsubboards);
	$lastpost = getPostFromBoard($fboardid);
	$num_rows = mysqli_query($con,  "SELECT id FROM topics WHERE boardid = '".$fboardid."' AND reply = 'no'") OR SQLError();
	$num_rows2 = mysqli_query($con,  "SELECT id FROM topics WHERE boardid = '".$fboardid."' AND reply = 'yes'") OR SQLError();
	$onOff = checkRd($boards["id"]);
	$viewing = mysqli_query($con,  "SELECT id FROM viewing WHERE boardid = '".$fboardid."' AND UNIX_TIMESTAMP(viewing) >= '".(time()-200)."'") OR SQLError();
	$v = (mysqli_num_rows($viewing) != 0) ? "<span style=\"font-size:11px;\"> - " . mysqli_num_rows($viewing)." Viewing</span>" : "";
	echo "<tr>";
		echo "<td style=\"text-align: center; width: 4%;\" class=\"mainbg2\">
			<img src=\"buttons/".$onOff.".gif\" />
		</td>
		<td class=\"mainbg\" style=\"cursor: pointer; width: 68%;";
		if($centered){
			echo "text-align: center;";
		}
		echo "\" id=\"b".stripslashes($boards["name"])."\" valign=\"top\" onmouseover=\"hCell(this); c = false; winStat('".addslashes($boards["name"])."');\" onmouseout=\"uhCell(this); c = true; winStat('');\" onclick=\"if(c) window.location.href='?act=viewtopics&bid=".$fboardid."';\">
		<div style=\"font-size:22px !important;font-weight:bold\">
			<a href=\"?act=viewtopics&bid=".$boards["id"]."\" class=\"forumMainLink\">".stripslashes($boards["name"])."</a>".$v."
			</div>
			<div class=\"pageContent\" style=\"padding: 5px;\">".
			ubbc($boards["about"])."
			</div>";
	if($boards["moderators"] != ""){
	$ex = explode(",",$boards["moderators"]);
	$exCount = count($ex);
	echo "
		<div class=\"brl\"></div>
	<div style=\"font-size:13px; padding: 2px;\" class=\"mainbg2 boardInfo\"><img src=\"buttons/information.png\" class=\"icon\" /> ".FormatRes($exCount,"Moderator").": ";
	$cH2 = 0;
	foreach($ex AS $ID){
		$cH2++;
		$getID = sql("SELECT id FROM members WHERE name = '".$ID."'");
		echo getDisplay($getID["id"]);
		if($cH2 < $exCount)
			echo ", ";
		}
		echo "</div>";
	}
		if($numSB >= 1){
								echo "<div class=\"mainbg2\" style=\"font-size:13px;width: 35%; padding: 2px;\"><img src=\"buttons/information.png\" style=\"height:16px;width:16px;\" /> ".FormatRes($numSB,"Sub-Board").": ";
								$cH=0;
								while($sb = fetch($getsubboards)){
									$cH++;
									echo "<a href=\"?act=viewtopics&bid=".$sb["id"]."\">".ubbc($sb["name"])."</a>";
									if($cH<$numSB){
										echo ", ";
									}
								}
								echo "</div> &raquo; <a href=\"javascript:;\" onclick=\"swapSb('".$fboardid."');\" id=\"sb".$fboardid."\">Expand</a> &laquo;";
		}
	if($boards["p_req"] > 0){
		echo "<div class=\"mainbg2\" style=\"border-radius:4px;\"><strong>Posts Required:</strong> ".$boards["p_req"]."</div>";
	}
	echo "
		<div class=\"br\"></div>
	<div class=\"boardInnerCell pageContent\" style=\"width: 35%;\">".FormatRes(mysqli_num_rows($num_rows),"Topic");
	nbsp(4);
	echo FormatRes(mysqli_num_rows($num_rows2),"Reply")."</div>
		<div style=\"text-align: right !important;\"> Last Post: ".
		$lastpost
		."</div></td></tr>";
	if($numSB >= 1){
								echo "<tr style=\"display: none;\" id=\"bd_id".$fboardid."\">
									<td class=\"mainbg pageContent\" colspan=\"6\">
									<table cellspacing=\"1\" cellpadding=\"4\" class=\"table bordercolor\" style=\"width: 790px;\">
									<tbody>
									<tr>
										<th class=\"titlebg\" colspan=\"6\">Sub-Boards</th>
									</tr>
									<tr>";
								$getsubboards2 = mysqli_query($con,  "SELECT * FROM boards WHERE subboard = '".$fboardid."' ORDER BY name ASC") OR SQLError();
								while($tab = fetch($getsubboards2)){
									fetchBoard($tab["id"]);
								}
									echo "
									<tr>
									<th class=\"titlebg\" colspan=\"6\">&nbsp;</th>
									</tr>
									</tbody>
									</table>
									</td>";
							}
}

function nbsp($amount){
	for($i=0;$i<$amount;$i++){
		echo " &nbsp; ";
	}
}

function pageContent($str){
	$rt = $str;
	if(preg_match("/\{pages id=(\d+?)\}/i",$rt,$m)){
		$getPages = mysqli_query($con,  "SELECT * FROM pages WHERE pc_id = (SELECT id FROM page_categories WHERE alias = '".$m["1"]."') ORDER BY pagename ASC") OR SQLError();
		$rt .= "<div style=\"font-weight: bold; font-size: 15px;\">Pages In This Category:</div>";
		while($pages = fetch($getPages)){
			$rt .= " &nbsp; &nbsp; &raquo; <a href=\"?p=".$pages["page_id"]."\">".stripslashes($pages["pagename"])."</a><br />
				&nbsp; &nbsp; &nbsp; &nbsp; By: ".getDisplay($pages["userid"])." &nbsp; &nbsp; ".dateFormat($pages["posted"])."<br />";
		}
		$rt = preg_replace("/\{pages id=(\d+?)\}/i","",$rt);
	}
	if(preg_match("/\{mods\}/i",$rt,$m)){
		$getMods = mysqli_query($con,  "SELECT * FROM mc_mods WHERE mod_type = 'mod' ORDER BY name ASC");
		if(online()){
			$rt .= "<h2>Client Mods</h2><div style=\"padding: 2px; text-align: center;\"><a href=\"?p=addmod\"><img src=\"buttons/bullet_add.png\" /> Add Yours</a>!</div>";
		}
		if(NoRows($getMods)){
			$rt .= "<img src=\"buttons/cancel.png\" /> No mods have been added yet.";
		}else{
			$rt .= "<div style=\"text-align: left; padding: 4px;\">Click on the names of the mods to have the info expanded. You may browse and download mods without signing up, however to add one, you must register with us first.</div>";
			while($mods = fetch($getMods)){
				if(!$mods["approved"] AND !checkPerms(4)) continue;
					$rt .= "<div class=\"listItem\">";
					if(!$mods["approved"] AND checkPerms(4)){
						$rt .= "<strong>Pending Submission</strong><br />";
					}
					$rt .= "&nbsp; &nbsp; <span class=\"itemName\" onclick=\"showItem(".$mods["id"].");\"><img src=\"buttons/bullet_add.png\" class=\"imgItem\" id=\"imgItem".$mods["id"]."\" />&nbsp; ".stripslashes($mods["name"])." (for ".$mods["version"].")</span> by ".getDisplay($mods["userid"])."
					<div style=\"text-align: right;\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".dateFormat($mods["posted"])."
					</div>
					<div id=\"m".$mods["id"]."\" class=\"item\">";
					if(isMe($mods["userid"]) OR checkPerms(4)){
						$rt .= "&nbsp; <a href=\"?p=editmod&id=".$mods["id"]."\"><img src=\"buttons/pencil.png\" /> Edit</a>";
						if(checkPerms(4)){
							$rt .= "
						 &nbsp; <a href=\"?p=deletemod&id=".$mods["id"]."\" onclick=\"return confirm('Are you sure you wish to delete this mod? This action cannot be undone.');\"><img src=\"buttons/cancel.png\" /> Delete</a>";
						}
						$rt .= "<br />";
					} 
					if($mods["about"] != ""){
						$rt .= " &nbsp; &nbsp; ".ubbc($mods["about"]);
					}
					if(!$mods["approved"] AND checkPerms(4)){
						$rt .= "<div style=\"text-indent: 6em;\">(<a href=\"?p=approvemod&id=".$mods["id"]."\">Approve</a> &bull; <a href=\"?p=denymod&id=".$mods["id"]."\">Deny</a>)</div>";
					}
					$rt .= "</div>
					<div style=\"text-align: center; font-size: 14px; width: 200px; margin: 0px auto; border-radius: 4px; border: 2px outset #000;\">&raquo; <a href=\"".$mods["file_url"]."\" onclick=\"window.open(this.href);return false;\">Download</a> &laquo;</div>
					<div class=\"hbreak\"></div>
					</div>
					<div class=\"hbreak\"></div>";
			}
		}
		$rt = preg_replace("/\{mods\}/i","",$rt);
	}
	if(preg_match("/\{plugins\}/i",$rt,$m)){
		$getMods = mysqli_query($con,  "SELECT * FROM mc_mods WHERE mod_type = 'plugin'");
		if(online()){
			$rt .= "<h2>Server Plugins</h2><div style=\"padding: 2px; text-align: center;\"><a href=\"?p=addplugin\"><img src=\"buttons/bullet_add.png\" /> Add Yours</a>!</div>";
		}
		if(NoRows($getMods)){
			$rt .= "<img src=\"buttons/cancel.png\" /> No plugins have been added yet.";
		}else{
			$rt .= "<div style=\"text-align: left; padding: 4px;\">Click on the names of the plugins to have the info expanded. You may browse and download plugins without signing up, however to add one, you must register with us first.</div>";
			while($mods = fetch($getMods)){
				if(!$mods["approved"] AND !checkPerms(4)) continue;
					$rt .= "<div class=\"listItem\">";
					if(!$mods["approved"] AND checkPerms(4)){
						$rt .= "<strong>Pending Submission</strong><br />";
					}
					$rt .= "&nbsp; &nbsp; <div class=\"itemName\" onclick=\"showItem(".$mods["id"].");\"><img src=\"buttons/bullet_add.png\" class=\"imgItem\" id=\"imgItem".$mods["id"]."\" />&nbsp; ".stripslashes($mods["name"])." (for ".$mods["version"].")</div> by ".getDisplay($mods["userid"])."
					<div style=\"text-align: right;\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".dateFormat($mods["posted"])."
					</div>
					<div id=\"m".$mods["id"]."\" class=\"item\">";
					if(isMe($mods["userid"]) OR checkPerms(4)){
						$rt .= "&nbsp; <a href=\"?p=editplugin&id=".$mods["id"]."\"><img src=\"buttons/pencil.png\" /> Edit</a>";
						if(checkPerms(4)){
							$rt .= "
						 &nbsp; <a href=\"?p=editmod&id=".$mods["id"]."\" onclick=\"return confirm('Are you sure you wish to delete this plugin? This action cannot be undone.');\"><img src=\"buttons/cancel.png\" /> Delete</a>";
						}
						$rt .= "<br />";
					} 
					if($mods["about"] != ""){
						$rt .= " &nbsp; &nbsp; ".ubbc($mods["about"]);
					}
					if(!$mods["approved"] AND checkPerms(4)){
						$rt .= "<div style=\"text-indent: 6em;\">(<a href=\"?p=plugins&type=approve&id=".$mods["id"]."\">Approve</a> &bull; <a href=\"?mode=plugins&type=deny&id=".$mods["id"]."\">Deny</a>)</div>";
					}
					$rt .= "</div>
					<div style=\"text-align: center; font-size: 14px; width: 200px; margin: 0px auto; border-radius: 4px; border: 2px outset #000;\">&raquo; <a href=\"".$mods["file_url"]."\" onclick=\"window.open(this.href);return false;\">Download</a> &laquo;</div>
					<div class=\"hbreak\"></div>
					</div>
					<div class=\"hbreak\"></div>";
			}
		}
		$rt = preg_replace("/\{plugins\}/i","",$rt);
	}
	if(preg_match("/\{schematics\}/i",$rt,$m)){
		$getMods = mysqli_query($con,  "SELECT * FROM mc_schem ORDER BY name ASC");
		if(online()){
			$rt .= "<h2>World Schematics</h2>
			<div style=\"padding: 2px; text-align: center;\">
				<a href=\"?p=addschematic\"><img src=\"buttons/bullet_add.png\" /> Add Yours</a>!
			</div>";
		}
		if(NoRows($getMods)){
			$rt .= "<img src=\"buttons/cancel.png\" /> No schematics have been added yet.";
		}else{
			$rt .= "<div style=\"text-align: left; padding: 4px;\">Click on the names of the schematics to have the info expanded. You may browse and download schematics without signing up, however to add one, you must register with us first.</div>";
			while($mods = fetch($getMods)){
				if(!$mods["approved"] AND !checkPerms(4)) continue;
					$rt .= "<div class=\"listItem\">";
					if(!$mods["approved"] AND checkPerms(4)){
						$rt .= "<strong>Pending Submission</strong><br />";
					}
					$rt .= "&nbsp; &nbsp; <div class=\"itemName\" onclick=\"showItem(".$mods["id"].");\"><img src=\"buttons/bullet_add.png\" class=\"imgItem\" id=\"imgItem".$mods["id"]."\" />&nbsp; ".stripslashes($mods["name"])." (for ".$mods["version"].")</div> by ".getDisplay($mods["userid"])."
					<div style=\"text-align: right;\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;".dateFormat($mods["posted"])."
					</div>
					<div id=\"m".$mods["id"]."\" class=\"item\">";
					if(isMe($mods["userid"]) OR checkPerms(4)){
						$rt .= "&nbsp; <a href=\"?p=editschematic&id=".$mods["id"]."\"><img src=\"buttons/pencil.png\" /> Edit</a>";
						if(checkPerms(4)){
							$rt .= "
						 &nbsp; <a href=\"?p=deleteschematic&id=".$mods["id"]."\" onclick=\"return confirm('Are you sure you wish to delete this schematic? This action cannot be undone.');\"><img src=\"buttons/cancel.png\" /> Delete</a>";
						}
						$rt .= "<br />";
					} 
					if($mods["about"] != ""){
						$rt .= " &nbsp; &nbsp; ".ubbc($mods["about"]);
					}
					if(!$mods["approved"] AND checkPerms(4)){
						$rt .= "<div style=\"text-indent: 6em;\">(<a href=\"?p=approveschematic&id=".$mods["id"]."\">Approve</a> &bull; <a href=\"?p=denyschematic&id=".$mods["id"]."\">Deny</a>)</div>";
					}
					$rt .= "</div>
					<div style=\"text-align: center; font-size: 14px; width: 200px; margin: 0px auto; border-radius: 4px; border: 2px outset #000;\">&raquo; <a href=\"".$mods["file_url"]."\" onclick=\"window.open(this.href);return false;\">Download</a> &laquo;</div>
					<div class=\"hbreak\"></div>
					</div>
					<div class=\"hbreak\"></div>";
			}
		}
		$rt = preg_replace("/\{schematics\}/i","",$rt);
	}
		if(preg_match("/\{skins\}/i",$rt,$m)){
			$getMods = mysqli_query($con,  "SELECT * FROM mc_skins ORDER BY name ASC") OR SQLError();
			echo "<h2>Player Skins</h2>
				You don't need to register to browse or download skins, but you must do so before adding one yourself.
			<div class=\"hbreak\"></div>
			<div style=\"padding: 2px; text-align: center;\">
				<a href=\"?p=addskin\"><img src=\"buttons/bullet_add.png\" /> Add Yours</a>!
			</div>";
			if(NoRows($getMods)){
				$rt .= "<br /><img src=\"buttons/cancel.png\" /> No skins have been added yet.";
			}
			
			while($mods = fetch($getMods)){
				if(!$mods["approved"] AND !checkPerms(4)) continue;
				$rt .= "<div class=\"hbreak\"></div>
				<div id=\"s".$mods["id"]."\" class=\"skinItem\">";
				if(!$mods["approved"] AND checkPerms(4)){
					$rt .= "<strong>Pending Submission</strong><br />";
				}
				$rt .= "<img src=\"".stripslashes($mods["image"])."\" /> &nbsp; &nbsp; <span class=\"itemName\">".stripslashes($mods["name"])."</span> &nbsp; &nbsp; 
				by ".getDisplay($mods["userid"])." &nbsp; &nbsp; ".dateFormat($mods["posted"])."
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
				&raquo; <a href=\"".stripslashes($mods["image"])."\" onclick=\"window.open(this.href);return false;\">Download</a> &laquo;";
				if(isMe($mods["userid"]) OR checkPerms(4)){
					$rt .= "<div style=\"text-align: right;\">
						<a href=\"?p=editskin&id=".$mods["id"]."\"><img src=\"buttons/pencil.png\" /> Edit</a> &nbsp; &nbsp;
						<a href=\"?p=deleteskin&id=".$mods["id"]."\" onclick=\"return confirm('Are you sure you wish to delete this skin? This action can NOT be undone.');\"><img src=\"buttons/delete.png\" /> Delete</a>
						</div>";
				}
				if(!$mods["approved"] AND checkPerms(4)){
					$rt .= "<div style=\"text-align: center;\">(<a href=\"?p=approveskin&id=".$mods["id"]."\">Approve</a> &bull; <a href=\"?p=denyskin&id=".$mods["id"]."\">Deny</a>)</div>";
				}
				$rt .= "</div>";
			}
			$rt = preg_replace("/\{skins\}/i","",$rt);
		}
		//Modules
		if(preg_match("/\\$\{mod:(.+?)\}/i",$rt,$m)){
			$modName = $m["1"];
			$mdata = sql("SELECT id,content FROM modules WHERE m_alias = '".$modName."'");
			if($mdata["id"] = ""){
				echo "This module does not exist.";
			}
			$rt = preg_replace("/\\$\{mod:(.+?)\}/i",$mdata["content"],$rt);
		}
		
		//Hashcodes
		if(preg_match("/##(.+?)##/",$rt,$m)){
			$str = $m["1"];
			switch(strtolower($str)){
				default:
					$str = "#?";
				break;
				case 'title':
					$x = sql("SELECT name FROM meta");
					$str = stripslashes($x["name"]);
				break;
			}
			$rt = preg_replace("/##(.+?)##/",$str,$rt);
		}
		return $rt;
	}
	
function idCheck($t="id"){
	if(!(int)$_GET[$t])
		invData();
}

function GET($item,$idCheck=0){
	if($idCheck){
		idCheck($item);
	}
	return sqlEsc($_GET[$item]);
}

function checkFriend($to,$from){
	$toCheck = sql("SELECT friends FROM members WHERE id = '".$to."'");
	$tFC = explode(":",$toCheck["friends"]);
	$fromCheck = sql("SELECT friends FROM members WHERE id = '".$from."'");
	$fFC = explode(":",$fromCheck["friends"]);
	return (in_array($from,$tFC) AND in_array($to,$fFC));
}

function foCheck($id){
	$userdata = sql("SELECT friendsOnly,friends FROM members WHERE id = '".$id."'");
	$FC = explode(":",$userdata["friends"]);
	$data = getDisplay($id)." has their profile set to friends only, and therefore must be on your friends list in order to complete this action.";
	$extra = "<div style=\"font-weight:bold;\" class=\"pageContent\">Request Sent!</div>";
	$extra2 = "<div class=\"pageContent\" style=\"font-size:14px;border-radius:4px;border:1px outset;width:100px;padding:4px;\"><a href=\"javascript:;\" onclick=\"addFriend(".$id.");\" id=\"fbutton\"><img src=\"buttons/bullet_add.png\" /> Add Friend</a></div>";
	$reqCheck = sql("SELECT id FROM freq WHERE touser = '".$ud."' AND fromuser = '".$_COOKIE["id"]."'");
	if(online()){
	if($reqCheck["id"] != "") 
		$data .= $extra;
	else
		$data .= $extra2;
	}
	if($userdata["friendsOnly"] AND !in_array($_COOKIE["id"],$FC) AND !isMe($id) AND !checkPerms(4)){
		onlineCheck();
		errMsg($data);
	}
}

function fetchTopic($id,$type="topic"){
	switch($type){
		case 'topic':
			$t = sql("SELECT * FROM topics WHERE id = '".$id."'");
							$lp = sql("SELECT * FROM topics WHERE reply = 'yes' AND topic_id = '".$t["id"]."' ORDER BY id DESC LIMIT 1");
							$u = sql("SELECT name,display,s_tag FROM members WHERE id = '".$lp["userid"]."'");
							$lp2 = ($lp["id"] != "") ? "on ".dateFormat($lp["posted"])." by ".getDisplay($lp["userid"]) : "No replies..";
							$userdata = sql("SELECT * FROM members WHERE id = '".$t["userid"]."'");
							$o = explode(":",$t["readby"]);
							$k = (in_array($_COOKIE["id"],$o)) ? "" : "<img src=\"new.png\" />&nbsp;";
							$gr = mysqli_query($con,  "SELECT id,userid FROM topics WHERE topic_id = '".$t["id"]."' AND reply = 'yes'");
							$replies = mysqli_num_rows($gr);
							while($rg = fetch($gr)){
								if($rg["userid"] == $_COOKIE["id"]){ 
									$tick = " &nbsp; <img src=\"buttons/accept.png\" title=\"You have posted here.\" class=\"icon\" />";
									break;
								}else{
									$tick = "";
								}
							}
							echo "<tr><td class=\"mainbg2\" width=\"8%\" style=\"vertical-align: middle;\" align=\"center\">";
							if(checkPerms(3)){
							echo "<input type=\"checkbox\" name=\"ch".$t["id"]."\" class=\"form-control\" /><br />";
							}
							$folder = ($t["locked"] == 1) ? "folder_black" : "topic_folder";
							echo "<img src=\"buttons/".$folder.".png\" />";
							echo "</td><td class=\"mainbg\" width=\"45%\" onmouseover=\"hCell(this);\" onmouseout=\"uhCell(this);\"><a href=\"?act=topic&id=".$t["id"]."\" class=\"siteLink\">".$k.stripslashes($t["subject"])."</a>".$tick."<br />";
							$totalPosts = mysqli_num_rows(mysqli_query($con,  "SELECT id FROM topics WHERE topic_id = '".$t["topic_id"]."'"));
							$totalPages2 = ceil(($totalPosts-1)/10);
							if($totalPages2> 1){
								echo "((Pages: ";
								$i = 1;
								$cH = 0;
								while($i <= $totalPages2){
									$cH++;
									echo "<a href=\"?act=topic&id=".$t["id"]."&p=".$i."\">".$i."</a>";
									$i++;
									if($cH<$totalPages2){
										echo ", ";
									}
								}
								echo " ))<br />";
							}
							echo "<div style=\"font-size:12px;\"><strong>Posted:</strong> ".dateFormat($t["posted"])."</div><br /><div style=\"font-weight:bold;font-size:13px;\">Description: </div> <div style=\"font-size:13px;\">";
							if($t["description"] != ""){
								echo ubbc($t["description"]);
							}else{
								echo "N/A";
							}
							echo "</div></td><td style=\"text-align: center;\" class=\"mainbg2\">".getDisplay($t["userid"])."</td><td class=\"mainbg2\" style=\"text-align: center;\" style=\"width: 1%;\"><a href=\"javascript:;\" onclick=\"nWin('replies.php?id=".$t["id"]."');\">".$replies."</a></td><td class=\"mainbg\">".$lp2."</tr>";
		break;
		case 'sticky':
			$sticky = sql("SELECT * FROM topics WHERE id = '".$id."'");
							$lp = sql("SELECT * FROM topics WHERE reply = 'yes' AND topic_id = '".$sticky["id"]."' ORDER BY id DESC LIMIT 1");
							$u = sql("SELECT name,display,s_tag FROM members WHERE id = '".$lp["userid"]."'");
							$lp2 = ($lp["id"] != "") ? "on ".dateFormat($lp["posted"])." by ".getDisplay($lp["userid"]) : "No replies..";
							$userdata = sql("SELECT * FROM members WHERE id = '".$sticky["userid"]."'");
							$o = explode(":",$sticky["readby"]);
							$k = (in_array($_COOKIE["id"],$o)) ? "" : "<img src=\"new.png\" />&nbsp;";
							$replies = mysqli_num_rows(mysqli_query($con,  "SELECT id FROM topics WHERE reply = 'yes' AND topic_id = '".$sticky["id"]."'"));
							echo "<tr><td class=\"mainbg2\" width=\"8%\">";
							if(checkPerms(3)){
								echo "<input type=\"checkbox\" name=\"ch".$sticky["id"]."\"  class=\"form-control\" />";
							}
							$stickyImage = ($sticky["locked"]) ? "sticky_lock" : "folder_red";
							echo "<img src=\"buttons/".$stickyImage.".png\" class=\"icon\" />";
							echo "</td><td class=\"mainbg\" width=\"45%\" onmouseover=\"hCell(this);\" onmouseout=\"uhCell(this);\"><strong>Sticky:</strong> <a href=\"?act=topic&id=".$sticky["id"]."\">".$k.stripslashes($sticky["subject"])."</a><br /><div style=\"font-size:12px;\"><strong>Posted:</strong> ".dateFormat($sticky["posted"])."</div><br /><div style=\"font-weight:bold;font-size:13px;\">Description: </div> <div style=\"font-size:13px;\">";
							if($sticky["description"] != ""){
								echo ubbc($sticky["description"]);
							}else{
								echo "N/A";
							}
							echo "</div>";
							$totalSticky = numRows("SELECT id FROM topics WHERE topic_id = '".$sticky["id"]."'");
							$totalSticky2 = ceil(($totalSticky-1)/10);
							if($totalSticky2> 1){
								echo "<br />((Pages: ";
								$stickyCH = 0;
								$s=0;
								while($s < $totalSticky2){
									$stickyCH++;
									$s++;
									echo "<a href=\"?act=topic&id=".$sticky["id"]."&p=".$s."\">".$s."</a>";
									if($stickyCH < $totalSticky2){
										echo ", ";
									}
								}
								echo " ))";
							}
							echo "</td><td class=\"mainbg2\" style=\"text-align: center;\">".getDisplay($sticky["userid"])."</td><td class=\"mainbg2\" align=\"center\" style=\"width: 1%;\"><a href=\"javascript:;\" onclick=\"nWin('replies.php?id=".$sticky["id"]."');\">".$replies."</a></td><td class=\"mainbg\">".$lp2."</tr>";
		break;
	}
}

function notifyAdmins($msg){
	notifyUser('1',$msg);
	notifyUser('2',$msg);
}

function getEvents(){
    (string) $tevents;
        $getevents = mysqli_query($con,  "SELECT id,name,`date`,remind FROM events") OR SQLError();
          $cHx2 = 0;
         while($events = mysqli_fetch_assoc($getevents)){
           if(date("F",strtotime($events["date"])) == date("F")){
				$tevents .= ":".$events["id"];
				if(date("F j Y",strtotime($events["date"])) == date("F j Y") AND !$events["remind"]){
					notifyAdmins("EVENT ALERT: An event has been scheduled for today. This is your reminder for that event.");
					query("UPDATE events SET remind = 1 WHERE id = '".$events["id"]."'");
				}
		    }
        }
          echo "<span style=\"font-size:13px;\">";
           if($tevents != ""){
           $x = explode(":",$tevents);
            echo FormatRes((count($x)-1),"calendar entry")." for ".date("F").":</span><br />";
            for($i=1;$i<count($x);$i++){
             $cHx2++;
              $eventdata = sql("SELECT name FROM events WHERE id = '".$x[$i]."'",1);
               $g = mysqli_num_rows(mysqli_query($con,  "SELECT ev_id FROM cal_cmts WHERE ev_id = '".$x[$i]."'"));
               if($cHx2<count($x)-1){
                echo "<a href=\"?act=viewevent&amp;id=".$x[$i]."\">".$eventdata["name"]."</a> (".FormatRes($g,"comment")."), ";
              }else{
               echo "<a href=\"?act=viewevent&amp;id=".$x[$i]."\">".$eventdata["name"]."</a> (".FormatRes($g,"comment").") ";
             }
           }
          }else{
           echo("No events this month.");
         }
         echo "</span>";
 }

function showName($id){
	return getUserDisplayName($id);
} 
 
function getUserDisplayName($id){
$userdata = sql("SELECT display,s_tag,colors,flagged,perms FROM members WHERE id = '".$id."'");
      			    	$r = "";
      			    	switch($userdata["perms"]){
      			    		default:
      			    			$rank = "";
      			    		break;
      			    		case '1':
      			    			$rank = "<img src=\"BoardMod.png\" />";
      			    		break;
      			    		case '2':
      			    			$rank = "<img src=\"Mod.png\" />";
      			    		break;
      			    		case '3':
      			    			$rank = "<img src=\"Staff.png\" />";
      			    		break;
      			    		case 4:
      			    		case 5:
      			    			$rank = "<img src=\"Admin.png\" />";
      			    		break;
      			    	}
      			    	$flag = ($userdata["flagged"]) ? "<img src=\"buttons/flag_1.png\" /> " : "";
			$clrs = explode(":",$userdata["colors"]);
			if($userdata["colors"] != ""){
		$c = array();
		if($clrs["1"] != "" AND $clrs["0"] != ""){
			$n = str_split($userdata["display"],1);
			for($t=0;$t<count($n);$t++){
				$t2 = ($t == 0) ? -1 : 1;
				$n2 = ($c[$t-$t2] == $clrs["0"]) ? $clrs["1"] : $clrs["0"];
				$c[$t] = $n2;
				$r .= "<a href=\"forum.php?act=profile&u=".$m["1"]."\"><span style=\"color:#".$c[$t].";\">".$n[$t]."</span></a>";
			}
		}else{
			$whichColor = ($clrs["1"] == "") ? $clrs["0"] : $clrs["1"];
			$r = "<a href=\"forum.php?act=profile&u=".$m["1"]."\"><span style=\"color:#".$whichColor.";\">".$userdata["display"]."</span></a>";
		}
	}else{
		$r = "<a href=\"forum.php?act=profile&u=".$m["1"]."\">".$userdata["display"]."</a>";
	}
		if($userdata["s_tag"] != "") $r .= "<span style=\"font-size:12px;\">(".strtoupper($userdata["s_tag"]).")</span>";
		return $rank." ".$r." ".$rank;
}

function AchievementCheck(){
	if(online()){
	$logged = sql("SELECT * FROM members WHERE id = '".$_COOKIE["id"]."'");
	$t;
	$getmedals = mysqli_query($con,  "SELECT * FROM medals") OR SQLError;
	while($m = fetch($getmedals)){
		eval("if(".$m["requirement"]."){
			\$t = 1;
		  }else{
		  	\$t = 0;
		  }");
		if($t == 1){
			$m2 = explode(":",$logged["medals"]);
			if(!in_array($m["id"],$m2)){
				$m2[] = $m["id"];
				$mx = implode(":",$m2);
				$gp = $logged["gpoints"]+=$m["gpoints"];
				query("UPDATE members SET medals = '".$mx."', gpoints = '".$gp."' WHERE id = '".$_COOKIE["id"]."'");
				js("achievement(".$m["id"].");");
				loguser($_COOKIE["id"],"unlocked the ".$m["name"]." medal.");
				break;
				}
			}
		}
	}
}

function notifications(){
	//Notifications..
	if(online()){
		$notifs = numRows("SELECT id FROM notifications WHERE userid = '".$_COOKIE["id"]."' AND unread = 'yes'");
		if($notifs > 0){
			setTitle(" - (".$notifs.")");
		}
}}
	
function RSSFeed(){
	$httpMethod = "http://";
	$root = $_SERVER["SERVER_NAME"];
	if($root == "localhost"){
		$root = $httpMethod.$root."/zollernverse/";
	}else{
		$root = $httpMethod."www.zollernverse.org/";
	}
	echo 'Wanna keep up with the updates easier? Subscribe to our <a href="'.$root.'rss/updates.xml" onclick="window.open(this.href);return false;"><img src="'.$root.'buttons/rss.png" /></a> feed. ';
}

function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}

function ZipFolder($realPath,$root){
	$rp = ($root == "http://localhost/zollernverse/") ? "C:/wamp/www/" : "./";
	$za = new ZipArchive();
	dircheck("backups");
	$d = date("n-d-y");
	$dir = "backups/backup-".$d.".zip";
	chmod($dir,0777);
	chmod($rp,0777);
	chmod("C:\wamp\www",0777);
	if($za->open($dir,ZipArchive::CREATE)){
		$files = new RecursiveIteratorIterator(
					new RecursiveDirectoryIterator($realPath));
		$i = 0;
		foreach($files as $file){
			$i++;
			if($i == 1 OR $i == 2){
				continue;
			}
			//$filePath = $file->getRealPath();
			$filePath = $file;
			$fp = basename($filePath);
			if($filePath == $rp OR $fp == "Thumbs.db" OR $filePath == "C:\wamp\www\zollernverse" OR $fp == "backups" OR $fp == "results.txt"){
				continue;
			}
			if(is_dir($filePath)){
				$folderPath = str_replace("\..","",$filePath);
				$folderPath = str_replace("\.","",$folderPath);
				$folderPath = str_replace("C:\wamp\www\zollernverse\\","",$folderPath);
				$folderPath = str_replace("/home/jameszollern/zollernverse.org/","",$folderPath);
				if($folderPath == "backups" OR $folderPath == "slogsx" OR $folderPath == "uchaogarden"){
					continue;
				}
				$za->addEmptyDir($folderPath);
				if(file_exists("results.txt")){
					unlink("results.txt");
				}
				$f = fopen("results.txt","a+");
				fwrite($f,"Added Folder: ".$folderPath."\r\n");
				continue;
			}
			chmod($filePath,0777);
			$filePath = $file->getRealPath();
			$filePath = str_replace("C:\wamp\www\zollernverse\\","",$filePath);
			$filePath = str_replace("/home/jameszollern/zollernverse.org/","",$filePath);
			if(!$za->addFile($filePath)){
				echo "Error in adding file: ".$filePath."<br />";
			}else{
				if(file_exists("results.txt")){
					unlink("results.txt");
				}
				$f = fopen("results.txt","a+");
				fwrite($f,"Added File: ".$filePath."\r\n");
			}
		}
		echo "<br />".FormatRes($za->numFiles,"file")." added.<br />";
		$za->close();
	}else{
		echo "Failed to create zip file.<br />";
	}
}

function dirCheck($dir,$perm=0777){
	if(!is_dir($dir)){
		mkdir($dir,$perm);
	}
}

function backup_sql($tables = '*')
{
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($con,  'SHOW TABLES') OR SQLError();
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	foreach($tables as $table)
	{
		$result = mysqli_query($con,  'SELECT * FROM `'.$table.'`') OR SQLError();
		$num_fields = mysqli_num_fields($result);
		$return.= 'DROP TABLE `'.$table.'`;';
		$qx12 = mysqli_query($con,  'SHOW CREATE TABLE `'.$table.'`') OR SQLError();
		$row2 = mysqli_fetch_row($qx12);
		$return.= "\n\n".$row2[1].";\n\n";
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO `'.$table.'` VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	$dir = "backups";
	if(!is_dir($dir)){
		mkdir($dir,0777);
	}
	$handle = fopen($dir.'/sql-db-backup-'.date("n-d-y").'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
?>
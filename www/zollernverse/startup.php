<?php
// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
if(isset($_COOKIE["id"])){
	$id = $_COOKIE["id"];
	$data = sql("SELECT tfa FROM members WHERE id = '".$id."'");
	if(checkSecUID3160($_COOKIE["id"]) != $_COOKIE["st_site_id"] OR !isset($_COOKIE["st_site_id"]) OR !isset($_COOKIE["id"])){
		loguser(intval($_COOKIE["id"]),"had their account accessed illegally.");
		setcookie("id","",(time()-300));
		setcookie("st_site_id","",(time()-300));
		exit("<!doctype html>
		<html lang=\"en\">
			<head>
				<title>Unauthorized Access</title>
			</head>
			<body>
				<p style=\"font-family:'Verdana';font-size:12px;\">Error - invalid authentication data detected. You will be contacted if this is due to error.<br /><br /><strong>Note:</strong> If this error is the result of attempted exploitation of the site or any of its resources, we will not help you, and you will be banned from the site permanently. Attempted hacking of the site's server or illegal access to its files or database will resort in law enforcement measures.</p>
			</body>
		</html>");
	}	
}
//END PARSING

$con = connect();

if(isset($_COOKIE["id"])){
	$id = $_COOKIE["id"];
	$info = sql("SELECT `timezone` FROM members WHERE id = '".$id."'");
	if($info["timezone"] != ""){
		ini_set('date.timezone',$info["timezone"]);
		eval('date_default_timezone_set(\''.$info["timezone"].'\');');
	}
}

$httpMethod = "http://";
$root = $_SERVER["SERVER_NAME"];
if($root == "localhost"){
	$root = $httpMethod.$root."/zollernverse/";
}else{
	$root = $httpMethod."www.zollernverse.org/";
}

require 'medals.php';
//Banned Users
	query("UPDATE members SET ip = '".$_SERVER["REMOTE_ADDR"]."' WHERE id = '".$_COOKIE["id"]."'");
	$banned = sql("SELECT id FROM banned WHERE ips = '".$_SERVER["REMOTE_ADDR"]."' OR names = '".$logged["name"]."' OR userid = '".$_COOKIE["id"]."'");
	if($banned["id"] != ""){
		exit("<html>\r\n<head>\r\n<title>Zollernverse - Error!</title>\r\n<h1>Error!</h1>\r\n</head>\r\n<body>\r\nSorry, you have been banned from this Web site by a Web site authority.\r\n<hr />\r\n<em>".$_SERVER["SERVER_SIGNATURE"]."</em>\r\n</body>\r\n</html>");
	}
	//Site checks..
	$sitedata = sql("SELECT m_mode,enable_signups,rnames,message_guests,limited_register,mostusers,enable_af,force_active,mostuserswhen FROM sitedata");
	//IP Center..
	if(online()){
        $ips = SQLQuerySelect("iplist,warn","members","id = '".$_COOKIE["id"]."'");
         $iplist = explode(":",$ips["iplist"]);
          if(!in_array($_SERVER["REMOTE_ADDR"],$iplist)){
           $ip2 = $ips["iplist"].":".$_SERVER["REMOTE_ADDR"];
            query("UPDATE members SET iplist = '".$ip2."' WHERE id = '".$_COOKIE["id"]."'");
         }
          $users = SQLQuerySelect("userlist","ipcenter","ip = '".$_SERVER["REMOTE_ADDR"]."'");
           if($users["userlist"] != ""){
            $userlist = explode(":",$users["userlist"]);
             if(!in_array($logged["name"],$userlist)){
              $user2 = $users["userlist"].":".$logged["name"];
               query("UPDATE ipcenter SET userlist = '".$user2."' WHERE ip = '".$_SERVER["REMOTE_ADDR"]."'");
           }
          }else{
           query("INSERT INTO ipcenter(ip,userlist)VALUES('".$_SERVER["REMOTE_ADDR"]."','".$logged["name"]."')");
         }
         //Member checker..
         	if(online()){
			query("UPDATE members SET lastonline = CURRENT_TIMESTAMP, ip = '".$_SERVER["REMOTE_ADDR"]."' WHERE id = '".$_COOKIE["id"]."'");
		}
		if($ips["warn"] > 100) query("UPDATE members SET warn = '100' WHERE id = '".$_COOKIE["id"]."'");
		if($ips["warn"] >= 100){
			banUser($_COOKIE["id"]);
		}
	}
	//Auto Lock..
	$getLocks = mysqli_query($con, "SELECT id,autoLock,subject,boardid FROM topics WHERE reply != 'yes' AND autoLock > '0' AND locked = '0'") OR SQLError();
	while($l = fetch($getLocks)){
		$gy = mysqli_query($con, "SELECT id,userid FROM topics WHERE reply = 'yes' AND topic_id = '".$l["id"]."'") OR SQLError();
		if(mysqli_num_rows($gy) >= $l["autoLock"]){
			query("UPDATE topics SET locked = '1' WHERE id = '".$l["id"]."'");
			loguser('3',"locked topic: [url=?act=topic&id=".$l["id"]."]".$l["subject"]."[/url].");
			query("INSERT INTO topics(subject,post,userid,boardid,topic_id,reply)VALUES('".addslashes("Re: ".$l["subject"])."','This topic was set to be locked after [b]".$l["autoLock"]."[/b] posts.[br][br]Topic locked.','3','".$l["boardid"]."','".$l["id"]."','yes')");
			loguser('3',"replied to: [url=?act=topic&id=".$l["id"]."]".$l["subject"]."[/url].");
			notifyUser($gy["userid"],"Your [url=?act=topic&id=".$l["id"]."]topic[/url] has been AutoLocked.");
			
		}
	}
	//Guests..
	if(!online()){
		$guestIP = sql("SELECT ip FROM guests WHERE ip = '".$_SERVER["REMOTE_ADDR"]."'");
		if($guestIP["ip"] == ""){
			query("INSERT INTO guests(ip)VALUES('".$_SERVER["REMOTE_ADDR"]."')");
		}else{
			query("UPDATE guests SET online_when = CURRENT_TIMESTAMP WHERE ip = '".$_SERVER["REMOTE_ADDR"]."'");
		}
	}
	query("DELETE FROM guests WHERE online_when < date_sub(now(), interval 1 day)");
	query("DELETE FROM security_images WHERE insertdate < date_sub(now(), interval 1 day)");
	if($logged["warn"] >= 100 AND online()){
		 query("UPDATE members SET warn = '100' WHERE id = '".$_COOKIE["id"]."'");
		 banUser($_COOKIE["id"]);
	}
	//Reputation..
	if(online()){
	$repCheck = sql("SELECT karma FROM karma WHERE userid = '".$_COOKIE["id"]."'");
	if($repCheck["karma"] == ""){
		query("INSERT INTO karma(karma,userid)VALUES(0,".$_COOKIE["id"].")");
	}
	}
	//Google Bot..
	if(preg_match("/66\.249/",$_SERVER["REMOTE_ADDR"])){
		query("UPDATE members SET lastonline = CURRENT_TIMESTAMP, ip = '".$_SERVER["REMOTE_ADDR"]."' WHERE id = '21'");
		/*setcookie("id","21",(time()+86400*365*10));
		setcookie("st_site_id",createUToken(21),(time()+86400*365*10));*/
	}
	//Limited Registration..
	if(!$sitedata["limited_register"]){
		query("UPDATE members SET approved = 1 WHERE approved = 0");
	}
	//Disabled Account..
	if($logged["disabled"]){
		loguser($_COOKIE["id"],"was forced to log out because of a disabled account.");
		setcookie("id","",time()-300);
		header("Refresh:2;./");
		errMsg("We're sorry, but your account has been disabled.");
	}
	//Urgent PM..
	$urgent = sql("SELECT id FROM pm WHERE unread = 'yes' and touser = '".$_COOKIE["id"]."' AND urgent = 1");
	if($urgent["id"] != "" AND !preg_match("/\?act=pmcenter/i",$_SERVER["REQUEST_URI"])){
		js("alert(\"You have an URGENT PM from someone! Redirecting..\r\n".$urgent["id"]."\");");
		header("Refresh: 0;?act=pmcenter");
	}
	//Registered Name..
	$rgCheck = sql("SELECT id,name,userid FROM rg_names WHERE name = '".addslashes($logged["display"])."'");
	if($rgCheck["id"] != "" AND $_COOKIE["id"] != $rgCheck["userid"]){
		query("UPDATE members SET display = name WHERE id = '".$_COOKIE["id"]."'");
	}
	//Bank interest..
	if(online()){
		$lastOnline = strtotime($logged["last_interest"]);
		if((time() - $lastOnline) >= 86400){
			$checkAccount = sql("SELECT id,balance FROM bank_accounts WHERE userid = '".$_COOKIE["id"]."'");
			if($checkAccount["id"] != ""){
				$interest = ($checkAccount["balance"] * .002);
				$newBalance = ($checkAccount["balance"] + $interest);
				query("UPDATE bank_accounts SET balance = '".$newBalance."' WHERE id = '".$_COOKIE["id"]."'");
				loguser($_COOKIE["id"],"was granted $".number_format($interest)." interest in their bank account.");
				query("UPDATE members SET last_interest = CURRENT_TIMESTAMP WHERE id = '".$_COOKIE["id"]."'");
				$in = number_format($interest);
				if($in > 0){
					notifyUser($_COOKIE["id"],"You have received $".number_format($interest)." in your bank account.");
				}
			}
		}
	}
?>
<?php
include 'functions.php';
connect();
onlineCheck();
if(!isset($_POST["pid"]) OR !online()) exit("Error");
if($_POST["id"] == 1){
query("INSERT INTO profile_comments(comment,userid,prof_id,posted)VALUES('".sqlEsc($_POST["cmnt"])."','".$_COOKIE["id"]."','".$_POST["pid"]."',CURRENT_TIMESTAMP)");
loguser($_COOKIE["id"],"posted a comment on [user=".$_POST["pid"]."]'s profile.");
notifyUser($_POST["pid"],"[user=".$_COOKIE["id"]."] posted a comment on your profile.");
}else{
$getcomments = mysql_query("SELECT * FROM profile_comments WHERE prof_id = '".$_POST["pid"]."' ORDER BY id DESC") OR SQLError();
echo "<div class=\"titlebg\">Comments</div>";
								while($c = fetch($getcomments)){
									echo "<div style=\"background:#aaaaaa;-moz-border-radius:25px;border-radius:25px;padding:2px;border:1px solid #000000;\">[".dateFormat($c["posted"])."] ".getDisplay($c["userid"]).": ".ubbc($c["comment"])."</div>";
								}
}
?>
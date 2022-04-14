<?php
$dom = new DomDocument();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom->load('rss/updates.xml');
include 'functions.php';
connect();
AuthCheck(4);
query("INSERT INTO updates(post,userid,subject,posted)VALUES('".addslashes($_POST["post"])."','".$_COOKIE["id"]."','".addslashes($_POST["subject"])."',CURRENT_TIMESTAMP)");
$n = mysql_insert_id();
query("INSERT INTO topics(subject,post,userid,reply,boardid)VALUES('Update: ".addslashes($_POST["subject"])."','Automatic update was made by: [user=".$_COOKIE["id"]."][br][br]".addslashes($_POST["post"])."[br][hr]This post was automatically made when the update was posted. You may view it on the updates page, or reply to it here.','3','no','28')");
$m = mysql_insert_id();
query("UPDATE topics SET topic_id = '".$m."' WHERE id = '".$m."'");
query("UPDATE members SET lastonline = CURRENT_TIMESTAMP WHERE id = '3'");
loguser($_COOKIE["id"],"added an update to the site.");
$u = sql("SELECT id,subject,post,userid FROM updates WHERE id = '".$n."'");
$disp = sql("SELECT name FROM members WHERE id = '".$u["userid"]."'");
$xpath = new DOMXPath($dom);
$channelNode = $xpath->query("/rss/channel")->item(0);
if($channelNode instanceof DOMNode){
	$item = $channelNode->appendChild(
		$dom->createElement("item")
		);
	$title = $dom->createElement("title");
	$title->appendChild(
		$dom->createTextNode(stripslashes($u["subject"]))
	);
	$item->appendChild($title);
	$link = $dom->createElement("link");
	$link->appendChild(
		$dom->createTextNode("http://www.zollernverse.org/?id=".$u["id"])
		);
	$item->appendChild($link);
	$description = $dom->createElement("description");
	$description->appendChild(
		$dom->createTextNode(stripslashes($u["post"]))
		);
	$item->appendChild($description);
	$author = $dom->createElement("author");
	$author->appendChild(
		$dom->createTextNode($disp["name"])
		);
	$item->appendChild($author);
}
$dom->normalizeDocument();
$dom->save('rss/updates.xml');
echo "location.href='?act=updates';";
?>
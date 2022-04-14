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
loguser($_COOKIE["id"],"added an update to the site.");
$f = fopen("rss/updates.xml","w");
fwrite($f,"<"."?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?".">");
$rss = 	$dom->createElement("rss");
		$version = $dom->createAttribute("version");
		$version->value = "2.0";
		$nameSpace = $dom->createAttribute("xml:ns");
		$nameSpace->value = "http://www.w3.org/2005/Atom";
	$rss->appendChild($version);
	$rss->appendChild($nameSpace);
$channel = $dom->createElement("channel");
$dom->appendChild($channel);
$xpath = new DOMXPath($dom);
$channelNode = $xpath->query("/rss/channel")->item(0);
$getupdates = mysql_query("SELECT * FROM updates ORDER BY id DESC");
if($channelNode instanceof DOMNode){
	while($u = fetch($getupdates)){
		$disp = sql("SELECT name FROM members WHERE id = '".$u["userid"]."'");
		if($u["rss"]) continue;
		$item = $dom->createElement("item");
		$title = $dom->createElement("title");
			$title->appendChild(
				$dom->createTextNode(stripslashes($u["subject"]))
			);
		$link = $dom->createElement("link");
			$link->appendChild(
				$dom->createTextNode("http://www.zollernverse.com/?act=updates&id=".$u["id"])
			);
		$author = $dom->createElement("author");
			$author->appendChild(
				$dom->createTextNode($disp["name"])
			);
		$description = $dom->createElement("description");
			$description->appendChild(
				$dom->createTextNode(stripslashes($u["post"]))
			);
		$quid = $dom->createElement("quid");
			$quid->appendChild(
				$dom->createTextNode($u["id"])
			);
		$item->appendChild($title);
		$item->appendChild($link);
		$item->appendChild($author);
		$item->appendChild($description);
		$item->appendChild($quid);
		$channelNode->appendChild($item);
		query("UPDATE updates SET rss = 1 WHERE id = '".$u["id"]."'");
	}
}
$dom->normalizeDocument();
$dom->save('rss/updates.xml');
echo "location.href='?act=updates';";
?>
<?php
$doc = new DOMDocument();
$doc->formatOutput = true;
include 'functions.php';
connect();
AuthCheck(4);
query("INSERT INTO updates(post,userid,subject,posted)VALUES('".addslashes($_POST["post"])."','".$_COOKIE["id"]."','".addslashes($_POST["subject"])."',CURRENT_TIMESTAMP)");
$n = mysql_insert_id();
loguser($_COOKIE["id"],"added an update to the site.");
$update = sql("SELECT subject,post FROM updates WHERE id = '".$n."'");
$rss = 	$doc->createElement("rss");
		$version = $doc->createAttribute("version");
		$version->value = "2.0";
		$nameSpace = $doc->createAttribute("xml:ns");
		$nameSpace->value = "http://www.w3.org/2005/Atom";
	$rss->appendChild($version);
	$rss->appendChild($nameSpace);
$channel = $doc->createElement("channel");
$item = $doc->createElement("item");
$title = $doc->createElement("title");
		$title->appendChild(
			$doc->createTextNode(stripslashes($update["subject"]))
			);
$link = $doc->createElement("link");
	$link->appendChild(
		$doc->createTextNode("http://www.zollernverse.com/?act=updates")
	);
	 $post = $doc->createElement("description");
	 	$post->appendChild(
	   		$doc->createTextNode(substr(stripslashes($update["post"]),0,80)."..")
	   	);
$item->appendChild($link);
$item->appendChild($title);
$item->appendChild($post);
$channel->appendChild($item);
$rss->appendChild($channel);
$doc->appendChild($rss);
$doc->saveXML();
$doc->save("rss/updates.xml");
echo "location.href='?act=updates';";
?>
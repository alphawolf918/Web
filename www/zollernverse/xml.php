<?php
require "functions.php";
connect();
AuthCheck(4);
$dom = new DomDocument();
$dom->formatOutput = true;
$dom->preserveWhiteSpace = false;
$dom = $dom->load("xdata/zollernverse");
$XPath = new DOMXPath($dom);
$database = $XPath->query("/database")->item(0);
if(!$database instanceof DOMNode) exit("Error!");
	$tables = mysql_query("SHOW TABLES FROM zollernverse") OR SQLError();
	while($t = fetch($tables)){
		$tabElem = $dom->createElement($t['Tables_in_zollernverse']);
		$fields = mysql_query("SHOW FIELDS FROM ".$t['Tables_in_zollernverse']) OR SQLError();
		while($f = fetch($fields)){
			$getData = mysql_query("SELECT ".$f['Field']." FROM ".$t['Tables_in_zollernverse']);
			if(mysql_num_rows($getData) == 0){
				$fieldElem = $dom->createElement($f['Field']);
				$fieldElem->appendChild(
					$dom->createTextNode("/empty/")
				);
			$tabElem->appendChild($fieldElem);
			}
			while($data = fetch($getData)){
			$fieldElem = $dom->createElement($f['Field']);
			$fieldElem->appendChild(
				$dom->createTextNode(htmlspecialchars($data[$f['Field']]))
			);
			$tabElem->appendChild($fieldElem);
			}
		}
		$database->appendChild($tabElem);
	}
	echo "Database XML listing was successful.";
xmlSave($dom,"xdata/zollernverse");
?>
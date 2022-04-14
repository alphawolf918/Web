<?php
connect();
AuthCheck(4);
if(!(int)$_GET["m"]) exit("M variable contains unhelpful value; cannot continue.");
$gtables = mysql_query("SHOW TABLES FROM zollernverse") OR SQLError("Could not load tables.");
echo "<select name=\"tables\" id=\"tables\" onchange=\"fetchRows(this.options[this.selectedIndex].value);\" style=\"text-align:left;\">";
while($t = fetch($gtables)){
	echo "<option value=\"".$tx."\">".$t["Tables_in_zollernverse"]."</option>";
	$tables[] = $tx;
}
echo "</select>";
?>
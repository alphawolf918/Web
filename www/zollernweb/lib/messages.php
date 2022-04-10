<?php
	require 'functions.php';
	require 'connect.php';
	$getRecords = mysql_query("SELECT id,name,email,ip FROM messages ORDER BY id DESC") OR SQLError();
	header("Content-Type: application/javascript");
?>
{
 "records":[
<?php
$i = 0;
while($r = mysql_fetch_assoc($getRecords)){
	$i++;
		echo '  {"id":"'.$r["id"].'","name":"'.sqlEsc($r["name"]).'","email":"'.sqlEsc($r["email"]).'","ip":"'.sqlEsc($r["ip"]).'"}';
	if($i <= count($getRecords) AND $i > 1){
		echo ',';
	}
	echo '
';
}
?>
 ]
}
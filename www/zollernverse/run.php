<?php
echo ">> ";
require 'functions.php';
connect();
AuthCheck(4);
if(!isset($_POST["m"])){
$coms = explode(";",$_POST["q"]);
foreach($coms as $cmd){
if($cmd == "") continue;
echo stripslashes($cmd)."<br />";
$d = stripslashes($cmd);
$c = mysql_query($d) OR exit(mysql_error());
echo "<br /><strong>Results:</strong> Successful run, ".FormatRes(mysql_affected_rows(),"row")." affected.<br />";
loguser($_COOKIE["id"],"ran query: [b]".$cmd."[/b]");
}
}else{
eval($_POST["m"]);
echo "Satisfactory execution.";
}
?>
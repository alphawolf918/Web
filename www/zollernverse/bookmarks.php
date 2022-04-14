<?php
require 'functions.php';
if(!(int)$_POST["id"]) exit("Error");
connect();
onlineCheck();
$getBookmarks = sql("SELECT bookmarks FROM members WHERE id = '".$_COOKIE["id"]."'");
$bm = explode(":",$getBookmarks["bookmarks"]);
if(isset($_POST["add"])){
$bm[] = $_POST["id"];
$book = implode(":",$bm);
query("UPDATE members SET bookmarks = '".$book."' WHERE id = '".$_COOKIE["id"]."'");
}else{
$ad = array_delete($_POST["id"],$bm);
$book = implode(":",$ad);
query("UPDATE members SET bookmarks = '".$book."' WHERE id = '".$_COOKIE["id"]."'");
}
echo "<img src=\"buttons/accept.png\" /> Done!";
?>
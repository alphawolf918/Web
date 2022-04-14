<?php
require 'functions.php';
connect();
$id = $_POST["id"];
if(!isset($id)) exit("Error");
query("DELETE FROM censored WHERE id = '".$id."'");
loguser($_COOKIE["id"],"has deleted a word substitution.");
?>
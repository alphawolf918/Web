<?php
require 'functions.php';
connect();
    if(!(int)$_POST["cid"]) exit("Oops! You forgot to specify a chao to rename!");
     if(!isYourChao($_POST["cid"])) exit("This is not your chao.");
      mysql_query("UPDATE chao SET name = '".$_POST["newName"]."' WHERE id = '".$_POST["cid"]."'");
       $newName = sql("SELECT name FROM chao WHERE id = '".$_POST["cid"]."'");
        print $newName["name"];
?>
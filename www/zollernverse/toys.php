<?php
 if($_POST["toy"]){
 require 'functions.php';
 connect();
 onlineCheck();
    $userdata = mysql_fetch_assoc(mysql_query("SELECT tokens FROM members WHERE id = '".intval($_COOKIE["id"])."'"));
     if($userdata["tokens"] >= 10){
       print "document.getElementById('chaoImage').src = 'userchao/".$_POST["toy"].".gif';$('#res').html('Your chao played with the toy.');";
       	useTokens(10);
          $chaodata = sql("SELECT happiness,stamina FROM chao WHERE id = '".$_POST["cid"]."'");
           $happiness = $chaodata["happiness"]+10;
             mysql_query("UPDATE chao SET happiness = '".$happiness."' WHERE id = '".$_POST["cid"]."'");
    }else{
     print "$('#res').html('You do not have enough tokens.');";
   }
 }
?>
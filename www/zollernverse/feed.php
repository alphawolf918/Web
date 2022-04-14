<?php
require 'functions.php';
connect();
    $tokens = getTokens($_COOKIE["id"]);
     $chao = $_POST["cid"];
      $fruit = $_POST["fid"];
      $maxstat = 99999;
      $maxlvl = 100;
      $itokens = 0;
       $chaodata = ucg_query("SELECT * FROM chao WHERE id = '".$chao."'",1);
        if($chaodata["hatched"] == "y"){
        $chaogrades = array("E","D","C","B","A","S","X");
         $chaostats = explode(":",$chaodata["stats"]);
      if($chaodata["owner"] == $_COOKIE["id"]){
       if($_POST["raise"]){
       $lvlInc;
         if($_POST["fid"] == "1"){
          $field = "swim";
           if($tokens >= 5){
            $itokens = 5;
              $happiness = ($_COOKIE["alignment"] == "hero") ? 2 : -2;
          }else{
           echo "$('#res').html('You do not have enough tokens for this item!<br />');";
         exit;
        }
           $swimchao = ($chaodata["swimlevel"]<$maxlvl)?$chaodata["swimlevel"]+1:$maxlvl;
                 if(($swimchao == $maxlvl)){
                  echo "$('#res').html('That stat is currently at its maximum!<br />');";
                 exit;
               }
           $swim = ($chaostats["0"]+1);
            if($swim < 7){
             $tswim = $swim;
           }else{
            $tswim = -($swim-7);
          }
            $iswim = $tswim.":".$chaostats["1"].":".$chaostats["2"].":".$chaostats["3"].":".$chaostats["4"];
             mysql_query("UPDATE chao SET stats = '".$iswim."' WHERE id = '".$chao."'") OR die(mysql_error());
              if($swim > 6){
               $chaoswim = $chaodata["swim"]+4;
                for($c=1;$c<count($chaogrades);$c++){
                 if($chaodata["swimgrade"] == $chaogrades[$c]){
                  $chaoswim += $c;
                }
               }
                $lvlInc = true;
                mysql_query("UPDATE chao SET swim = '".$chaoswim."', swimlevel = '".$swimchao."' WHERE id = '".$chao."'") OR die(mysql_error());
             }
         }elseif($_POST["fid"] == "2"){
          $field = "fly";
           if($tokens >= 5){
            $itokens = 5;
             $happiness = ($_COOKIE["alignment"] == "hero") ? 5 : -5;
           }else{
            echo "$('#res').html('You do not have enough tokens for this item!<br />');";
          exit;
        }
         $flychao = ($chaodata["flylevel"]<$maxlvl)?$chaodata["flylevel"]+1:$maxlvl;
            if(($flychao == $maxlvl)){
               echo "$('#res').html('That stat is currently at its maximum!<br />'";
              exit;
            }
           $fly = ($chaostats["1"]+1);
            if($fly < 7){
             $tfly = $fly;
           }else{
            $tfly = -($fly-7);
          }
         $ifly = $chaostats["0"].":".$tfly.":".$chaostats["2"].":".$chaostats["3"].":".$chaostats["4"];
          mysql_query("UPDATE chao SET stats = '".$ifly."' WHERE id = '".$chao."'");
           if($fly > 6){
            $chaofly = $chaodata["fly"]+5;
             for($d=1;$d<count($chaogrades);$d++){
              if($chaodata["flygrade"] == $chaogrades[$d]){
               $chaofly += $d;
             }
            }
             mysql_query("UPDATE chao SET fly = '".$chaofly."', flylevel = '".$flychao."' WHERE id = '".$chao."'") OR die(mysql_error());
          }
         }elseif($_POST["fid"] == "3"){
          $field = "run";
           if($tokens >= 5){
            $itokens = 5;
              $happiness = ($_COOKIE["alignment"] == "hero") ? -3 : 3;
            }else{
             echo "$('#res').html('You do not have enough tokens for this item!<br />');";
           exit;
        }
          $runchao = ($chaodata["runlevel"]<$maxlvl)?$chaodata["runlevel"]+1:$maxlvl;
              if(($runchao == $maxlvl)){
               echo "$('#res').html('That stat is currently at its maximum!<br />');";
              exit;
            }
           $run = ($chaostats["2"]+1);
            if($run < 7){
             $trun = $run;
           }else{
            $trun = -($run-7);
          }
         $irun = $chaostats["0"].":".$chaostats["1"].":".$trun.":".$chaostats["3"].":".$chaostats["4"];
          mysql_query("UPDATE chao SET stats = '".$irun."' WHERE id = '".$chao."'");
           if($run > 6){
            $chaorun = ($chaodata["run"]+3);
             for($e=1;$e<count($chaogrades);$e++){
              if($chaodata["rungrade"] == $chaogrades[$e]){
               $chaorun += $e;
             }
            }
             mysql_query("UPDATE chao SET run = '".$chaorun."', runlevel = '".$runchao."' WHERE id = '".$chao."'");
          }
         }elseif($_POST["fid"] == "4"){
          $field = "power";
           if($tokens >= 5){
            $itokens = 5;
              $happiness = ($_COOKIE["alignment"] == "hero") ? -5 : 5;
            }else{
             echo "$('#res').html('You do not have enough tokens for this item!<br />');";
           exit;
         }
           $powerchao = ($chaodata["powerlevel"]<$maxlvl)?$chaodata["powerlevel"]+1:$maxlvl;
              if(($powerchao == $maxlvl)){
               echo "$('#res').html('That stat is currently at its maximum!<br />');";
              exit;
            }
           $power = ($chaostats["3"]+1);
            if($power < 7){
             $tpower = $power;
           }else{
            $tpower = -($power-7);
          }
         $ipower = $chaostats["0"].":".$chaostats["1"].":".$chaostats["2"].":".$tpower.":".$chaostats["4"];
          mysql_query("UPDATE chao SET stats = '".$ipower."' WHERE id = '".$chao."'");
           if($power > 6){
            $chaopower = ($chaodata["power"]+8);
             for($f=1;$f<count($chaogrades);$f++){
              if($chaodata["powergrade"] == $chaogrades[$f]){
               $chaopower += $f;
             }
            }
             mysql_query("UPDATE chao SET power = '".$chaopower."', powerlevel = '".$powerchao."' WHERE id = '".$chao."'");
          }
       }elseif($_POST["fid"] == 5){
        $field = "stamina";
         if($tokens >= 5){
          $itokens = 5;
            $happiness = ($_COOKIE["alignment"] == "hero") ? 1 : -1;
          }else{
           echo "$('#res').html('You do not have enough tokens for this item!<br />');";
          exit;
        }
          $staminachao = ($chaodata["staminalevel"]<$maxlvl)?$chaodata["staminalevel"]+1:$maxlvl;
            if(($staminachao == $maxlvl)){
             echo "$('#res').html('That stat is currently at its maximum!<br />');";
            exit;
          }
         $stamina = ($chaostats["4"]+1);
          if($stamina < 7){
           $tstamina = $stamina;
         }else{
          $tstamina = -($stamina-7);
        }
       $istamina = $chaostats["0"].":".$chaostats["1"].":".$chaostats["2"].":".$chaostats["3"].":".$tstamina;
        mysql_query("UPDATE chao SET stats = '".$istamina."' WHERE id = '".$chao."'");
         if($stamina > 6){
          $chaostamina = ($chaodata["stamina"]+rand(1,2));
           for($g=1;$g<count($chaogrades);$g++){
            if($chaodata["staminagrade"] == $chaogrades[$g]){
             $chaostamina += $g;
           }
          }
           mysql_query("UPDATE chao SET stamina = '".$chaostamina."', staminalevel = '".$staminachao."' WHERE id = '".$chao."'");
        }
       }else if($_POST["fid"] == 6){
         $field = "power";
          if($tokens >= 500){
           $itokens = 500;
            $happiness = ($_COOKIE["alignment"] == "hero") ? 5 : -5;
             $c = $chaodata["age_int"]-5;
              mysql_query("UPDATE chao SET age_int = '".$c."' WHERE id = '".$chao."'");
             $powerchao2 = ($chaodata["powerlevel"]<$maxlvl)?$chaodata["powerlevel"]+1:$maxlvl;
              if(($powerchao2 == $maxlvl)){
               echo "$('#res').html('That stat is currently at its maximum!<br />');";
              exit;
            }
           $power2 = ($chaostats["3"]+1);
            if($power2 < 7){
             $tpower2 = $power2;
           }else{
            $tpower2 = -($power2-7);
          }
         $ipower2 = $chaostats["0"].":".$chaostats["1"].":".$chaostats["2"].":".$tpower2.":".$chaostats["4"];
          mysql_query("UPDATE chao SET stats = '".$ipower2."' WHERE id = '".$chao."'");
           if($power2 > 6){
            $chaopower2 = ($chaodata["power"]+8);
             for($i=1;$i<count($chaogrades);$i++){
              if($chaodata["powergrade"] == $chaogrades[$i]){
               $chaopower2 += $i;
             }
            }
             mysql_query("UPDATE chao SET power = '".$chaopower2."', powerlevel = '".$powerchao2."' WHERE id = '".$chao."'") OR exit(mysql_error());
          }
         }else{
          echo "$('#res').html('You do not have enough tokens for that item!');";
         }
        }else if($_POST["fid"] == '7'){
         $field = "swim";
          if($tokens >= 500){
           $itokens = 500;
            $happiness = ($_COOKIE["alignment"] == "hero") ? -10 : 10;
             $c = $chaodata["age_int"]+5;
               $age = $chaodata["age"];
              if($c >= 30 AND $chaodata["evolved"] == 'y'){
               $age++;
               $c = 0;
            }
              mysql_query("UPDATE chao SET age_int = '".$c."', age = '".$age."' WHERE id = '".$chao."'");
             $swimchao2 = ($chaodata["swimlevel"]<$maxlvl)?$chaodata["swimlevel"]+1:$maxlvl;
              if(($swimchao2 == $maxlvl)){
               echo "$('#res').html('That stat is currently at its maximum!<br />');";
              exit;
            }
           $swim2 = ($chaostats["0"]+1);
            if($swim2 < 7){
             $tswim2 = $swim2;
           }else{
            $tswim2 = -($swim2-7);
          }
         $iswim2 = $tswim2.":".$chaostats["1"].":".$chaostats["2"].":".$chaostats["3"].":".$chaostats["4"];
          mysql_query("UPDATE chao SET stats = '".$iswim2."' WHERE id = '".$chao."'");
           if($swim2 > 6){
            $chaoswim2 = ($chaodata["swim"]+8);
             for($i=1;$i<count($chaogrades);$i++){
              if($chaodata["swimgrade"] == $chaogrades[$i]){
               $chaoswim2 += $i;
             }
            }
             query("UPDATE chao SET swim = '".$chaoswim2."', swimlevel = '".$swimchao2."' WHERE id = '".$chao."'");
          }
         }else{
          echo "$('#res').html('You do not have enough tokens for that item!');";
         }
      }else{
        echo "$('#res').html('Invalid fruit ID!')";
      exit;
      }
    $stats = sql("SELECT `".$field."` FROM `chao` WHERE id = '".$chaodata["id"]."'");
             $staminai = ($chaodata["staminalevel"]<$maxlvl)?$chaodata["staminalevel"]+1:$maxlvl;
          if($staminai != $maxlvl){
          $ihappiness = $chaodata["happiness"]+$happiness;
            query("UPDATE chao SET happiness = '".$ihappiness."' WHERE id = '".$chao."'");
              $c_stats = sql("SELECT stats FROM chao WHERE id = '".$chao."'");
             $chaostats = explode(":",$c_stats["stats"]);
              $stamina2 = $chaostats["4"]+rand(0,1);
               if($stamina2 < 7){
                $chaostamina2 = $stamina2;
              }else{
               $chaostamina2 = -($stamina2-7);
             }
            $cs = $chaostats["0"].":".$chaostats["1"].":".$chaostats["2"].":".$chaostats["3"].":".$chaostamina2;
             query("UPDATE chao SET stats = '".$cs."' WHERE id = '".$chao."'");
              if($stamina2 > 6){
               $istamina = $chaodata["stamina"]+rand(0,2);
                for($h=0;$h<count($chaogrades);$h++){
                 if($chaodata["staminagrade"] == $chaogrades[$h]){
                  $istamina += $h;
                }
               }
                  query("UPDATE chao SET stamina = '".$istamina."', staminalevel = '".$staminai."' WHERE id = '".$chao."'");
                  $lvlInc = 1;
             }
          }
          useTokens($itokens);
                    if($lvlInc){
                    	echo "$('#res').html('<audio controls=\"controls\" autoplay=\"true\"><source src=\"userchao/chaosounds/levelup.wav\" /></audio>');";
						addTokens($_COOKIE["id"],50);
                    }
        }elseif($_POST["update"]){
           $fieldStat = sql("SELECT swim,fly,run,power,stamina,swimgrade,flygrade,rungrade,powergrade,staminagrade,overall FROM chao WHERE id = '".$chaodata["id"]."'");
           (integer) $total = ceil(($fieldStat["swim"]+$fieldStat["fly"]+$fieldStat["run"]+$fieldStat["power"]+$fieldStat["stamina"])/5);
            echo "<span style='text-decoration: underline;'>Swim:</span>  Lv. ".$chaodata["swimlevel"] ." / ".$chaodata["swimgrade"]."<br />";
            $stats = explode(":",$chaodata["stats"]);
             $swimdif = (6-$stats["0"]);
             for($i=0;$i<$stats["0"];$i++){
               echo "<img alt=\"1\" src=\"filled.gif\" />";
           }
         for($i=0;$i<$swimdif;$i++){
          echo "<img alt=\"0\" src=\"empty.gif\" />";
       }
        echo(" <font size=\"1\">".substr($chaodata["swim"], 7, 11)." exp</font><br /><span style='text-decoration: underline;'>Fly</span>: Lv. ".$chaodata["flylevel"]." / ".$chaodata["flygrade"]."<br />");
         $flydif = (6-$stats["1"]);
          for($i=0;$i<$stats["1"];$i++){
            echo "<img alt=\"1\" src=\"filled.gif\" />";
        }
      for($i=0;$i<$flydif;$i++){
       echo "<img alt=\"0\" src=\"empty.gif\" />";
    }
          echo(" <font size=\"1\">".substr($chaodata["fly"], 7, 11)." exp</font><br /><span style='text-decoration: underline;'>Run</span>: Lv. ".$chaodata["runlevel"]." / ".$chaodata["rungrade"]."<br />");
        $rundif = (6-$stats["2"]);
        for($i=0;$i<$stats["2"];$i++){
         echo "<img alt=\"1\" src=\"filled.gif\" />";
     }
   for($i=0;$i<$rundif;$i++){
    echo "<img alt=\"0\" src=\"empty.gif\" />";
  }
          echo(" <font size=\"1\">".substr($chaodata["run"], 7, 11)." exp</font><br /><span style='text-decoration: underline;'>Power</span>: Lv. ".$chaodata["powerlevel"]." / ".$chaodata["powergrade"]."<br />");
      $powerdif = (6-$stats["3"]);
        for($i=0;$i<$stats["3"];$i++){
         echo "<img alt=\"1\" src=\"filled.gif\" />";
      }
    for($i=0;$i<$powerdif;$i++){
     echo "<img alt=\"0\" src=\"empty.gif\" />";
  }
          echo(" <font size=\"1\">".substr($chaodata["power"], 7, 11)." exp</font><br /><span style='text-decoration: underline;'>Stamina</span>: Lv. ".$chaodata["staminalevel"]." / ".$chaodata["staminagrade"]."<br />");
      $staminadif = (6-$stats["4"]);
       for($i=0;$i<$stats["4"];$i++){
        echo "<img alt=\"1\" src=\"filled.gif\" />";
      }
    for($i=0;$i<$staminadif;$i++){
     echo "<img alt=\"0\" src=\"empty.gif\" />";
  }
          echo(" <font size=\"1\">".substr($chaodata["stamina"], 7, 11)." exp</font><br /><span style='text-decoration: underline;'>Overall</span>: ".$total." exp<br /><span style='text-decoration: underline;'>Born:</span> ");
         dateFormat($chaodata["born"]);
          echo "</span><br /><span style='text-decoration: underline;'>Age:</span> ".getAge($chaodata["id"])."<br /><span style='text-decoration: underline;'>Times Reincarnated:</span> ".$chaodata["reincarnated"]."<br /><div id=\"happiness\"><span style='text-decoration: underline;'>Happiness:</span> ".$chaodata["happiness"];
             echo "<audio controls=\"controls\" autoplay=\"true\" hidden=\"true\"><source src=\"userchao/chaosounds/increase.wav\" /></audio>";
       }
    }else{
      echo "$('#res').html('This is not your chao!');";
     exit;
     }
  }else{
   echo "$('#res').html('This chao is not hatched yet.');";
  exit;
 }
?>
<?php
ob_start();
	require 'functions.php';
	require "sql.php";
	require "startup.php";
	$defaultSkin = sql("SELECT id FROM skins WHERE main = '1'");
	$skinid = (online()) ? $logged["skinid"] : $defaultSkin["id"];
	if($skinid == "") $skinid = $defaultSkin["id"];
echo "<!DOCTYPE html>\r\n<html>\r\n<head>\r\n<title>Dreamer Chao Beta v3.5</title>\r\n";
?>
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/skinid-<?php echo $skinid; ?>.css" media="all" id="skin-id" />
		<link rel="stylesheet" type="text/css" href="styles/main.css" media="all" id="main" />
		<link rel="stylesheet" type="text/css" href="styles/chao.css" media="all" id="chao" />
		<script type="text/javascript" src="wz_dragdrop.js"></script>
<?php
	//Achievements
	if(online()){
	js("function achievement(id){
	var achID = $('#achID');
	$.ajax({
		type: \"POST\", url: \"achieve.php\", data: \"id=\"+id,
		complete: function(data){
			achID.html(data.responseText);
			achID.slideDown();
			setTimeout(\"$('#achID').slideUp();\",2500);
		}
	});
}");
	$swimCheck = sql("SELECT id FROM p_items WHERE name = 'Swim Drive'");
	$flyCheck = sql("SELECT id FROM p_items WHERE name = 'Fly Drive'");
	$runCheck = sql("SELECT id FROM p_items WHERE name = 'Run Drive'");
	$powerCheck = sql("SELECT id FROM p_items WHERE name = 'Power Drive'");
	if($swimCheck["id"] == ""){
		query("INSERT INTO p_items(name,about,img,item_type,price)VALUES('Swim Drive','This drive will increase your chao\'s Swim stat by 1 level and 50 xp.','chaodrives/swim.png','drive',200);");
	}
	if($flyCheck["id"] == ""){
		query("INSERT INTO p_items(name,about,img,item_type,price)VALUES('Fly Drive','This drive will increase your chao\'s Fly stat by 1 level and 50 xp.','chaodrives/fly.png','drive',200);");
	}
	if($runCheck["id"] == ""){
		query("INSERT INTO p_items(name,about,img,item_type,price)VALUES('Run Drive','This drive will increase your chao\'s Run stat by 1 level and 50 xp.','chaodrives/run.png','drive',200);");
	}
	if($powerCheck["id"] == ""){
		query("INSERT INTO p_items(name,about,img,item_type,price)VALUES('Power Drive','This drive will increase your chao\'s Power stat by 1 level and 50 xp.','chaodrives/power.png','drive',200);");
	}
	}
		$sandhead = sql("SELECT header FROM sandbox");
		echo stripslashes($sandhead["header"]);
echo "</head>\r\n<body>";
?>

	<div class="achievement" id="achID">
		<img src="cup_gold.png" class="ach" alt="[achieve]" title="[achieve]" />
		</div>
<?php
	if(online()){
	$t;
	$getmedals = mysqli_query($con, "SELECT * FROM medals");
	while($m = fetch($getmedals)){
		eval("if(".$m["requirement"]."){
			\$t = 1;
		  }else{
		  \$t = 0;
		  }");
		if($t == 1){
			$m2 = explode(":",$logged["medals"]);
			if(!in_array($m["id"],$m2)){
				$m2[] = $m["id"];
				$mx = implode(":",$m2);
				$gp = $logged["gpoints"]+=$m["gpoints"];
				query("UPDATE members SET medals = '".$mx."', gpoints = '".$gp."' WHERE id = '".$_COOKIE["id"]."'");
				js("achievement(".$m["id"].");");
				loguser($_COOKIE["id"],"unlocked the ".$m["name"]." medal.");
				break;
			}
		}
	}
       }
connect();
     echo "<table style=\"width: 680px; margin: 0px auto;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Options</th></tr><tr><td class=\"mainbg\"><a href=\"./\" id=\"w\">Site Home</a> <a href=\"chao.php\" id=\"w\">Dreamer Chao Home</a> <hr/> <a href=\"chao.php?act=createchao\" id=\"w\">Create A Chao</a> <a href=\"chao.php?act=forest\" id=\"w\">Adoption Forest</a> <a href=\"chao.php?act=mychao\" id=\"w\">View My Chao</a> <a href=\"chao.php?act=choosebreedchao\" id=\"w\">Breeding Center</a> <a href=\"chao.php?act=trade\" id=\"w\">Trading Center</a> <a href=\"forum.php?act=chaomart\" id=\"w\">Chao Mart</a> <a href=\"chao.php?act=selectgarden\" id=\"w\">Big Gardens</a> <a href=\"chao.php?act=blackmarket\" id=\"w\">Black Market</a></td></tr></table>";
  mysqli_query($con, "CREATE TABLE IF NOT EXISTS 
  `chao`
    (
     `id` INT NOT NULL AUTO_INCREMENT, 
     `name` VARCHAR(7) DEFAULT '????' NOT NULL,
     `swim` INT UNSIGNED ZEROFILL NOT NULL, 
     `fly` INT UNSIGNED ZEROFILL NOT NULL, 
     `run` INT UNSIGNED ZEROFILL NOT NULL, 
     `power` INT UNSIGNED ZEROFILL NOT NULL, 
     `stamina` INT UNSIGNED ZEROFILL NOT NULL, 
     `image` VARCHAR(255) NOT NULL,
     `owner` INT DEFAULT '1' NOT NULL,
     `overall` INT DEFAULT '0' NOT NULL,
     `happiness` INT DEFAULT '0' NOT NULL,
     `hatched` ENUM('y','n') DEFAULT 'n' NOT NULL, 
     `evolved` ENUM('y','n') DEFAULT 'n' NOT NULL,
     `age` TINYINT DEFAULT '0' NOT NULL,
     `born` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
     `reincarnated` TINYINT NOT NULL,
     `stats` TEXT NOT NULL,
     `swimgrade` VARCHAR(1) NOT NULL,
     `flygrade` VARCHAR(1) NOT NULL,
     `rungrade` VARCHAR(1) NOT NULL,
     `powergrade` VARCHAR(1) NOT NULL,
     `staminagrade` VARCHAR(1) NOT NULL,
     `swimlevel` INT NOT NULL,
     `flylevel` INT NOT NULL,
     `runlevel` INT NOT NULL,
     `powerlevel` INT NOT NULL,
     `staminalevel` INT NOT NULL,
     `age_int` INT NOT NULL,
     `sell_for` INT NOT NULL,
     `invis` ENUM('y','n') DEFAULT 'n' NOT NULL,
      primary key(id)
     );");
   	mysqli_query($con, "CREATE TABLE IF NOT EXISTS chaotrade (
   id INT NOT NULL AUTO_INCREMENT,
   touser VARCHAR(100) NOT NULL,
   fromuser VARCHAR(100) NOT NULL,
   cid1 INT NOT NULL,
   accepted ENUM('yes','no') DEFAULT 'no' NOT NULL,
   started TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
   primary key(id)
  )") OR SQLError();
	if(!is_dir("userchao")){
	 mkdir("userchao", "0493");
      }
     $userchao = ucg_query($con, "SELECT COUNT(id) AS total FROM chao WHERE owner = '".$_COOKIE["id"]."'",1);
     $userchao = $userchao["total"];
     $userdata = ucg_query($con, "SELECT * FROM members WHERE id = '".$_COOKIE["id"]."'",1);
     $maxchao = 24;
     $maxstat = 4820;
     $maxlvl = 100;
     $grades = array("X","S","A","B","C","D","E");
      if(!isset($_COOKIE["character"])){
        echo "<table style=\"width: 680px; margin: 0px auto; inline-block;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Choose Your Character</th></tr><tr><td class=\"mainbg\"><strong>IMPORTANT:</strong> You MUST click on Sonic or you will have a Dark Alignment, and your chao will be treated as such. In other words, if you <em>don't</em> click on Sonic, it will be the same as if you had a dark character in the real game (i.e., Shadow).<br /><a href=\"chao.php?act=choosecharacter&amp;character=sonic\"><img alt=\"[Sonic]\" title=\"[Sonic]\" src=\"userchao/characters/sonic.gif\" border=\"0\" /></a></td></tr></table>";
	  }
   switch(trim(stripslashes($_GET["act"]))):
    default:
     $getchao = mysqli_query($con, "SELECT * FROM chao WHERE owner != '0' ORDER BY overall DESC") OR SQLError();
     $nc = mysqli_num_rows($getchao);
      $__p = ($_GET["page"]>0) ? $_GET["page"] : 1;
      $cp = ceil($nc/50);
       $p = ($__p-1)*50;
        $gc2 = mysqli_query($con, "SELECT * FROM chao WHERE owner != '0' ORDER BY overall DESC LIMIT ".$p.",50") OR SQLError();
      echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\" colspan=\"4\">View All Chao (".mysqli_num_rows($getchao)." total)</th></tr><tr><th class=\"catbg\">ID</th><th class=\"catbg\">Chao name</th><th class=\"catbg\">Overall</th><th class=\"titlebg\">Owner</th></tr>";
       if($nc == 0){
        echo "<tr><td class=\"mainbg\" colspan=\"4\">Sorry, there are currently no chao available. If you would like to, you may <a href=\"chao.php?act=createchao\">create</a> one yourself.</td></tr>";
      }else{
       echo "<tr><td align=\"center\" class=\"mainbg\" colspan=\"4\"><select id=\"pages\" onchange=\"window.location='chao.php?page='+this.options[this.selectedIndex].value;\">";
         $i = 1;
          while($i <= $cp){
           echo "<option value=\"".$i."\"";
            if($_GET["page"] == $i){
             echo " selected=\"selected\"";
           }
          echo ">Page ".$i."</option>";
            $i++;
       }
        echo "</select></td></tr>";
        while($chao = mysqli_fetch_assoc($gc2)):
         $userdata = ucg_query($con, "SELECT id,display FROM members WHERE id = '".$chao["owner"]."'",1);
           echo "<tr><td class=\"mainbg2\" width=\"1%\">".$chao["id"]."</td><td class=\"mainbg\"><a href=\"chao.php?act=view&cid=".$chao["id"]."\"><img alt=\"".$chao["name"]."\" title=\"".$chao["name"]."\" src=\"userchao/".$chao["image"]."\" style=\"border:none;\" /></a></td><td class=\"mainbg2\" width=\"1%\">".substr($chao["overall"], 7, 11)."</td><td class=\"mainbg2\">";
              echo "<a href=\"forum/index.php?action=viewprofile&userid=".$userdata["id"]."\">";
               echo getDisplay($userdata["id"]);
                echo "</a></td></tr>";
      endwhile;
     }
   echo "</table>";
  break;
   case 'choosecharacter':
    if($_GET["character"]){
     if($_GET["character"] == "sonic"){
      $alignment = "hero";
    }elseif($_GET["character"] == "shadow"){
     $alignment = "dark";
   }
     setcookie("character",$_GET["character"],time()+86400) OR exit("Error in setting the character.");
      setcookie("alignment",$alignment,time()+86400) OR exit("Error in setting the alignment.");
        header("Location: chao.php");
   }else{
    errMsg("No character specified!");
 }
  break;
   case 'createchao':
   if($_COOKIE["id"]){
   if($userchao >= $maxchao){
    errMsg("Sorry, you have too many chao. You can't have more than ".$maxchao.".");
  }else{
   require 'names.php';
   $n = (int) count($names)-1;
   $rn = $names[mt_rand(0,$n)];
   $cg = count($grades)-1;
    $pic = "new.gif";
      $atc = ucg_query($con, "INSERT INTO chao(name,image,owner,swimgrade,flygrade,rungrade,powergrade,staminagrade,stats)VALUES('".$rn."','".$pic."','".$_COOKIE["id"]."','".$grades[mt_rand(0,$cg)]."','".$grades[mt_rand(0,$cg)]."','".$grades[mt_rand(0,$cg)]."','".$grades[mt_rand(0,$cg)]."','".$grades[mt_rand(0,$cg)]."','0:0:0:0:0')",0);
        header("Location: chao.php?act=view&cid=".mysqli_insert_id());
 }
}else{
  errMsg("You must be logged in to create a chao.");
}
  break;
   case 'view':
    if((int)$_GET["cid"]){
      $chaodata = ucg_query($con, "SELECT * FROM chao WHERE id = '".$_GET["cid"]."'",1);
      if($chaodata["id"] == "")
      		errMsg("This chao does not exist.");
       $ChaoType = explode("/",$chaodata["image"]);
        $chao_stats = array("swim","fly","run","power","stamina");
      $userdata = ucg_query($con, "SELECT * FROM members WHERE id = '".$chaodata["owner"]."'",1);
       (integer) $total = ceil((substr($chaodata["swim"], 7, 11)+substr($chaodata["fly"], 7, 11)+substr($chaodata["run"], 7, 11)+substr($chaodata["power"], 7, 11)+substr($chaodata["stamina"], 7, 11))/0005);
        $sell_for = $total;
         if(isChaosChao($_GET["cid"])){
          $sell_for += 100;
       }
        if(isShopChao($_GET["cid"])){
         $gd = SQLQuerySelect("price","chao_shop","image = '".$chaodata["image"]."'");
          $sell_for += ($gd["price"]/2);
       }
        if($chaodata["reincarnated"] > 0){
         $sell_for += ($chaodata["reincarnated"]*10);
      }
       $e = explode(":",$chaodata["chaos_emeralds"]);
        $sell_for += (count($e)*100);
         $sell_for += ($chaodata["happiness"]/2);
        query("UPDATE chao SET overall = '".$total."', sell_for = '".$sell_for."' WHERE id = '".$_GET["cid"]."'");
         echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\" colspan=\"3\">View Chao - ".$chaodata["name"]."</th></tr>";
         $cabu = ($chaodata["abuse"]*5)*$logged["charged"];
         if($chaodata["abuse"] >= 20){
         	echo "</table>";
         	query("DELETE FROM chao WHERE id = '".$_GET["cid"]."'");
         	loguser($_COOKIE["id"],"had a chao run away due to abuse.");
         	useTokens($cabu);
         	loguser($_COOKIE["id"],"was charged ".$cabu." tokens for their transgressions.");
         	query("UPDATE members SET charged = (charged + 1) WHERE id = '".$_COOKIE["id"]."'");
         	errMsg("We're sorry, but your chao was abused too much and has now ran away. No one will ever see it again. You were not a good caretaker of this chao. As such, we've charged you <strong>".$cabu."</strong> tokens, calculated by the chao's abuse and unhappiness. We hope this teaches you to be a better caretaker. Better luck next time.");
         }
         if((isYourChao($_GET["cid"])) AND (is_hatched($_GET["cid"]))){
          echo("<tr><td class=\"mainbg2\" colspan=\"3\"><a href=\"javascript:void(0);\" onclick=\"showSection(this);\">Fruit</a> ");
           if($chaodata["image"] == "member.gif"){
            echo("- <a href=\"javascript:void(0);\" onclick=\"showSection(this);\">Toys</a>");
          }
         echo("<div id=\"fruit\" style=\"display:none;\"><strong>Fruit:</strong> <a href=\"javascript:buyFruit('1');\"><img src=\"userchao/fruit/swim.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('2');\"><img src=\"userchao/fruit/fly.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('3');;\"><img src=\"userchao/fruit/run.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('4');\"><img src=\"userchao/fruit/power.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('5');\"><img src=\"userchao/fruit/stamina.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('6');\"><img src=\"userchao/fruit/strong.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('7');\"><img src=\"userchao/fruit/cube.png\" border=\"0\" /></a></div><div id=\"toys\" style=\"display:none;\"><strong>Toys:</strong>");
           $dir="userchao/toys";
            $r=opendir($dir);
             while($t=readdir($r)){
              if($t!="."AND$t!=".."){
               echo " <a href=\"javascript:void(0);\" onclick=\"toy('".str_replace('.gif','',$t)."');\"><img src=\"userchao/toys/".$t."\" border=\"0\" /></a> ";
              }
            }
         echo("</div>");
          if($ChaoType["0"] == "chaos" OR $chaodata["image"] == "Chaos 0.gif" OR isSuperChao($_GET["cid"])){
           echo("<a href=\"javascript:void(0);\" onclick=\"showSection(this);\">Emeralds</a><div id=\"emeralds\" style=\"display: none;\"><strong>Emeralds:</strong>");
         $chaos_emeralds = SQLQuerySelect("chaos_emeralds","members","id = '".$_COOKIE["id"]."'");
         $ce = explode(":",$chaodata["chaos_emeralds"]);
         $ce2 = explode(":",$chaos_emeralds["chaos_emeralds"]);
          $dir2="chaos_emeralds";
           $r2=opendir($dir2);
            while($t2=readdir($r2)){
             if($t2 != "." AND $t2 != ".." AND $t2 != "Thumbs.db"){
              if(!in_array($t2,$ce) AND in_array($t2,$ce2)){
               echo " <a href=\"?act=giveemerald&amp;e=".base64_encode($t2)."&amp;cid=".$_GET["cid"]."\"><img src=\"chaos_emeralds/".$t2."\" border=\"0\" /></a> ";
             }
            }
           }
          echo("</div>");
         }
         echo("<div id=\"res\"></div></td></tr>");
       }
        $a = explode("/",$chaodata["image"]);
       if(!preg_match("/\//",$chaodata["image"]) AND $chaodata["evolved"] == 'y'){
        $g = "s";
      }else{
        if($a["1"] != "chaos"){
         if($a["0"] != "special"){
         $a1 = $a["0"];
          if($a1 == "hero"){
           $g = "h";
         }else if($a1 == "dark"){
          $g = "d";
        }else{
         $g = "c";
       }
      }else{
       $g = "s";
    }
   }else{
    $g = "c2";
  }
 }
     echo("<tr><td class=\"mainbg\" valign=\"top\" width=\"176\"><div style=\"text-align:center; background: url('gardens/t".$g."g.gif'); height: 160px;\"><div id=\"chao\"><img alt=\"".basename($chaodata["image"])."\" src=\"userchao/".$chaodata["image"]."\" class=\"dragableElement\" id=\"chaoImage\" /></div><div style=\"height:140px;\"></div>");
    /*  if(is_hatched($_GET["cid"]) AND isYourChao($_GET["cid"])){
       echo("<div id=\"say\" class=\"mainbg\">".$phrases[$say]."</div>");
    }*/
     if($chaodata["image"] != "member.gif" AND $chaodata["image"] != "InvisibleChao-Final-1.gif"){
       if(preg_match("/\//", $chaodata["image"])){
        $ae = $ChaoType["0"];
        $ae .= " / ".$ChaoType["1"];
        if(!is_array($ChaoType["2"]) AND !preg_match("/\.gif/i",$ChaoType["2"]))
        	$ae .= " / ".$ChaoType["2"];
       echo(capitals($ae,3));
      }else{
       echo str_replace(".gif","",$chaodata["image"]);
     }
    }else{
      echo "Child";
    }
     $age = ($chaodata["age_int"]<30)?$chaodata["age_int"]+mt_rand(0,1):0;
        query("UPDATE chao SET age_int = '".$age."' WHERE id = '".$_GET["cid"]."' AND owner = '".$_COOKIE["id"]."'");
         $age_int = ucg_query($con, "SELECT age_int FROM chao WHERE id = '".$_GET["cid"]."' AND owner = '".$_COOKIE["id"]."'",1);
          if($age_int["age_int"] >= 30){
           $chao_age = getAge($_GET["cid"])+1;
            query("UPDATE chao SET age = '".$chao_age."' WHERE id = '".$_GET["cid"]."' AND owner = '".$_COOKIE["id"]."'");
         }
      echo("<br /><img src=\"userchao/images/ring.gif\" alt=\"tokens\" title=\"tokens\" /> <span id=\"tokens\">".number_format($userdata["tokens"])."</span>
      </td><td class=\"mainbg\">");
        if(isYourChao($_GET["cid"])){
         echo "<a href=\"chao.php?act=pet&cid=".$_GET["cid"]."\"><img src=\"userchao/images/pet.png\" alt=\"Pet\" title=\"Pet\" style=\"border:none;\" /></a> ";
          if(is_hatched($_GET["cid"])){
           echo "<a href=\"chao.php?act=discipline&cid=".$_GET["cid"]."\"><img src=\"userchao/images/discipline.png\" alt=\"Discipline\" title=\"Discipline\" style=\"border:none;\" /></a>";
         }
          echo " <a href=\"javascript:void(0);\" onclick=\"openRenameWindow();\"><img src=\"userchao/images/rename.png\" alt=\"Rename\" title=\"Rename\" style=\"border:none;\" /></a> <a href=\"chao.php?act=disown&cid=".$chaodata["id"]."\"";
           if(isShopChao($_GET["cid"]) OR isChaosChao($_GET["cid"])){
            echo " onclick=\"return confirm('If you disown this chao, it will not go to the Adoption Forest; it will cease to exist. Do you wish to disown it anyway?');\"";
          }
         echo "><img src=\"userchao/images/disown.png\" alt=\"Disown\" title=\"Disown\" style=\"border:none;\" /></a>";
         echo "(<a href=\"chao.php?act=clone&amp;cid=".$chaodata["id"]."\">Clone</a>) (<a href=\"chao.php?act=sellchao&cid=".$chaodata["id"]."\">Sell Chao</a>)<hr/>";
       }
         if($chaodata["owner"] == 0){
          echo "<a href=\"chao.php?act=adopt&cid=".$chaodata["id"]."\"><img src=\"userchao/images/adopt.png\" alt=\"Adopt\" title=\"Adopt\" style=\"border:none;\" /></a>";
       }
           echo "<div align=\"center\" style='left: 650px; position: absolute; z-index: 1000; height: 52px; width: 220px; display: none; padding: 2px;' id='renameWindow' class='mainbg2'><a href=\"javascript:void(0);\" onclick=\"document.getElementById('renameWindow').style.display='none';\">close</a><br /><form action=\"javascript:renameChao();\" method='post' name='renameForm'><input type='text' value='".$chaodata["name"]."' name='name' /> <input type='submit' value='Rename' /></form></div><div class='chaoLabel'>Owner:</div> ".getDisplay($chaodata["owner"])."<br /><div class='chaoLabel'>Name</div>: <span id='name'>".$chaodata["name"]."</span><div id=\"stats\"><div class='chaoLabel'>Swim:</div>  Lv. ".$chaodata["swimlevel"] ." / ".$chaodata["swimgrade"]."<br />";
            $stats = explode(":",$chaodata["stats"]);
             $swimdif = (6-$stats["0"]);
             for($i=0;$i<$stats["0"];$i++){
               echo "<img alt=\"1\" alt=\"1\" src=\"filled.gif\" />";
           }
         for($i=0;$i<$swimdif;$i++){
          echo "<img alt=\"0\" alt=\"0\" src=\"empty.gif\" />";
       }
        echo(" <font size=\"1\">".substr($chaodata["swim"], 7, 11)." exp</font><br /><div class='chaoLabel'>Fly</div>: Lv. ".$chaodata["flylevel"]." / ".$chaodata["flygrade"]."<br />");
         $flydif = (6-$stats["1"]);
          for($i=0;$i<$stats["1"];$i++){
            echo "<img alt=\"1\" src=\"filled.gif\" />";
        }
      for($i=0;$i<$flydif;$i++){
       echo "<img alt=\"0\" src=\"empty.gif\" />";
    }
          echo(" <font size=\"1\">".substr($chaodata["fly"], 7, 11)." exp</font><br /><div class='chaoLabel'>Run</div>: Lv. ".$chaodata["runlevel"]." / ".$chaodata["rungrade"]."<br />");
        $rundif = (6-$stats["2"]);
        for($i=0;$i<$stats["2"];$i++){
         echo "<img alt=\"1\" src=\"filled.gif\" />";
     }
   for($i=0;$i<$rundif;$i++){
    echo "<img alt=\"0\" src=\"empty.gif\" />";
  }
          echo(" <font size=\"1\">".substr($chaodata["run"], 7, 11)." exp</font><br /><div class='chaoLabel'>Power</div>: Lv. ".$chaodata["powerlevel"]." / ".$chaodata["powergrade"]."<br />");
      $powerdif = (6-$stats["3"]);
        for($i=0;$i<$stats["3"];$i++){
         echo "<img alt=\"1\" src=\"filled.gif\" />";
      }
    for($i=0;$i<$powerdif;$i++){
     echo "<img alt=\"0\" src=\"empty.gif\" />";
  }
          echo(" <font size=\"1\">".substr($chaodata["power"], 7, 11)." exp</font><br /><div class='chaoLabel'>Stamina</div>: Lv. ".$chaodata["staminalevel"]." / ".$chaodata["staminagrade"]."<br />");
      $staminadif = (6-$stats["4"]);
       for($i=0;$i<$stats["4"];$i++){
        echo "<img alt=\"1\" src=\"filled.gif\" />";
      }
    for($i=0;$i<$staminadif;$i++){
     echo "<img alt=\"0\" src=\"empty.gif\" />";
  }
          echo(" <font size=\"1\">".substr($chaodata["stamina"], 7, 11)." exp</font><br /><div class='chaoLabel'>Overall</div>: ".$total."<br /><div class='chaoLabel'>Born:</div> ".dateFormat($chaodata["born"])."</div><br /><div class='chaoLabel'>Age:</div> ".getAge($chaodata["id"])."<br /><div class='chaoLabel'>Times Reincarnated:</div> ".$chaodata["reincarnated"]."<br /><div class='chaoLabel'>Happiness:</div> ".$chaodata["happiness"]."</td>
			 <td class='mainbg' style='vertical-align: top; width: 25%;'>
				");
				echo '<div class="inventory">
				<div class=\'titlebg topBorder\' style=\'vertical-align: top;\'>Inventory</div>
				<div class=\'brl\'></div>';
				$inv = sql("SELECT contents FROM p_inv WHERE userid = '".$_COOKIE["id"]."'");
				$cn = explode(":",$inv["contents"]);
				$h = 0;
				foreach($cn as $id){
					if($id == "") continue;
					$idata = sql("SELECT * FROM p_items WHERE id = '".$id."'");
					echo '
					<div class="invItem">
					<img src="'.$idata["img"].'" class="icon" />
					<br />
					<strong>'.$idata["name"].'</strong>
					</div>
					';
					$h++;
					if($h >= 3){
						echo '<div class="brm"></div>';
						$h = 0;
					}
				}
					echo '
					</div>';
				echo "
			 </td></tr></table>
<script type=\"text/javascript\">
<!--
var canReload = true;
 function feedChao(cid,fid){
 	$.ajax({
 		type: \"POST\", url: \"feed.php\", data: \"raise=true&cid=".$_GET["cid"]."&fid=\" + fid,
 		complete: function(data){
 			updateStats();
 		}
 	});
}
 function updateStats(){
 	$.ajax({
 		type: \"POST\", url: \"feed.php\", data: \"update=true&cid=".$_GET["cid"]."\",
 		complete: function(data){
 			$('#stats').html(data.responseText);
 		}
 	});
 }
   function winReload(){
    if(canReload){
     location.reload();
   }
  }
      function showSection(){
       var sect = arguments[0];
        sect = sect.innerHTML;
         sect = sect.toLowerCase();
          if(document.getElementById(sect).style.display!=''){
           document.getElementById(sect).style.display='';
        }else{
          document.getElementById(sect).style.display='none';
       }
      }
       function toy(){
       	$.ajax({
       		type: \"POST\", url: \"toys.php\", data: \"toy=\"+arguments[0]+\"&cid=".$_GET["cid"]."\",
       		complete: function(data){
       			eval(data.responseText);
       		}
       	});
     }
      function buyFruit(fid){
       canReload = false;
       var d = ".getTokens($_COOKIE["id"]).";
       if(d >= 5){
        if(fid == 1){
         var s = 'userchao/fruit/swim.png';
         var fruitName = 'swim';
       }else if(fid == 2){
         var s = 'userchao/fruit/fly.png';
         var fruitName = 'fly';
       }else if(fid == 3){
         var s = 'userchao/fruit/run.png';
         var fruitName = 'run';
       }else if(fid == 4){
         var s = 'userchao/fruit/power.png';
         var fruitName = 'power';
       }else if(fid == 5){
         var s = 'userchao/fruit/stamina.png';
         var fruitName = 'stamina';
       }else if(fid == 6){
         var s = 'userchao/fruit/strong.png';
         var fruitName = 'strong';
       }else{
         var s = 'userchao/fruit/cube.png';
         var fruitName = 'cube';
       }
       var r = document.createElement('a');
        r.setAttribute('href','javascript:feedChao(\'".$_GET["cid"]."\',\''+fid+'\')');
         document.getElementById('chao').appendChild(r);
       var i = document.createElement('img');
         var t = new Array('290','300','310','320','340');
         var n = Math.floor(Math.random() * t.length);
         var h = t[n];
         var y = new Array('450','510','525','550')
         var x = Math.floor(Math.random() * y.length);
         var f = y[x];
        i.setAttribute('src',s);
        i.setAttribute('style','left: '+f+'px; position: absolute; z-index: 1000; bottom: '+h+'px; border: none; ');
        i.setAttribute('onclick','this.parentNode.style.display=\'none\'; canReload = true;');
        i.setAttribute('name',fruitName);
        i.setAttribute('class','dragableElement');
        i.setAttribute('border','0');
         r.appendChild(i);
        }else{
         document.getElementById('res').innerHTML = 'You do not have enough tokens for that item!';
        }
      if(fid == 6) d = d - 100;
      else d = d-5;
      document.getElementById('tokens').innerHTML = d;
    }
     function openRenameWindow(){
      document.getElementById('renameWindow').style.display = '';
    }
     function renameChao(){
      var newName = document.renameForm.name.value;
     	$.ajax({
     		type: \"POST\", url: \"rename.php\", data: \"cid=".$_GET["cid"]."&newName=\"+newName,
     		complete: function(data){
     			$('#name').html(data.responseText);
     			$('#renameWindow').hide();
     		}
     	});
     }
  setTimeout(\"winReload()\",900000);
// -->
</script>
";
         if(isYourChao($_GET["cid"])){
          if(!isShopChao($_GET["cid"]) AND !isChaosChao($_GET["cid"])){
           if(($chaodata["happiness"] >= 5) && (!is_hatched($_GET["cid"]))){
            header("Location: chao.php?act=hatch&cid=".$_GET["cid"]);
          }
         }
           if(!isChaosChao($_GET["cid"])AND!isShopChao($_GET["cid"])){
            $invis = ($chaodata["invis"] == 'y') ? "invisible/" : "";
             $alignment;
            if($chaodata["staminalevel"] >= 15){
             if($chaodata["happiness"] >= 20){
                $alignment = "hero";
              }elseif($chaodata["happiness"] <= 14){
               $alignment = "dark";
              }elseif(($chaodata["happiness"]>14)AND($chaodata["happiness"]<20)){
               $alignment = "neutral";
              }else{
                $alignment = "neutral";
            }
           second_evolution($_GET["cid"],"on");
             if(($chaodata["evolved"] != 'y') && (is_hatched($_GET["cid"]))){
               if($chaodata["reincarnated"] < 3){
                if($chaodata["reincarnated"] < 2){
                 evolve($_GET["cid"],$alignment);
          }else{
           if($chaodata["swim"] >= 300 AND $chaodata["fly"] >= 300 AND $chaodata["run"] >= 300 AND $chaodata["power"] >= 300){
            $chaos = $invis.$alignment . "/chaos/" . $alignment . ".gif";
             query("UPDATE `chao` SET `image` = '".$chaos."', `evolved` = 'y' WHERE `id` = '".$_GET["cid"]."'");
             addTokens($_COOKIE["id"],"2000");
         }else{
          evolve($_GET["cid"],$alignment);
          }
       }
      }else{
       if(($chaodata["swimgrade"] == "S") AND ($chaodata["flygrade"] == "S") AND ($chaodata["rungrade"] == "S") AND ($chaodata["powergrade"] == "S") AND ($chaodata["staminagrade"] == "S")){
        $alignevo = $invis."special/ChaoGod.gif";
         query("UPDATE chao SET image = '".$alignevo."', evolved = 'y' WHERE id = '".$_GET["cid"]."'");
         addTokens($_COOKIE["id"],"5000");
      }else{
       if($chaodata["swim"] >= 300 AND $chaodata["fly"] >= 300 AND $chaodata["run"] >= 300 AND $chaodata["power"] >= 300){
            $chaos = $invis.$alignment . "/chaos/" . $alignment . ".gif";
            addTokens($_COOKIE["id"],"2000");
              query("UPDATE `chao` SET `image` = '".$chaos."', `evolved` = 'y' WHERE `id` = '".$_GET["cid"]."'");
         }else{
        evolve($_GET["cid"],$alignment);
      }
     }
    }
   }
  }
 }
}
 $chaosE = explode(":",$chaodata["chaos_emeralds"]);
 $t = explode("/",$chaodata["image"]);
  if($t["0"] == "chaos" OR $chaodata["image"] == "Chaos 0.gif" OR isSuperChao($_GET["cid"])){
   if(count($chaosE) > 0 AND $chaodata["chaos_emeralds"] != ""){
    chaos($_GET["cid"],count($chaosE));
 }
}
   chao_die($_GET["cid"]);
   reincarnate($_GET["cid"]);
 }else{
   errMsg("Please specify an ID!");
}
 break;
  case 'adopt':
  if($userchao >= $maxchao){
   errMsg("Sorry, you have too many chao. You can't have more than ".$maxchao.".");
 }else{
   if((int)$_GET["cid"]){
    $chaodata = ucg_query($con, "SELECT owner FROM chao WHERE id = '".$_GET["cid"]."'",1);
     if($chaodata["owner"] == 0){
      query("UPDATE chao SET owner = '".$_COOKIE["id"]."' WHERE id = '".$_GET["cid"]."' AND owner = '0'");
        header("Location:  chao.php?act=view&cid=".$_GET["cid"]);
      }else{
       errMsg("This chao already has an owner!");
     }
   }else{
    errMsg("Please specify an ID!");
   }
  }
 break;
  case 'forest':
   if($logged["name"]){
    $getdisownedchao = mysqli_query($con, "SELECT id,name,image,overall FROM chao WHERE owner = '0' ORDER BY overall DESC");
     echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\" colspan=\"4\">Chao Forest</th></tr><tr><th class=\"catbg\">ID</th><th class=\"catbg\">Chao</th><th class=\"catbg\">Overall</th><th class=\"catbg\">Adopt</th></tr>";
      while($disownedchao = mysqli_fetch_assoc($getdisownedchao)){
       echo "<tr><td class=\"mainbg2\" width=\"1%\">".$disownedchao["id"]."</td><td class=\"mainbg\"><a href=\"chao.php?act=view&cid=".$disownedchao["id"]."\"><img alt=\"[".$disownedchao["name"]."]\" title=\"[".$disownedchao["name"]."]\" src=\"userchao/".$disownedchao["image"]."\" border=\"0\" /></a></td><td class=\"mainbg2\">".$disownedchao["overall"]."</td><td class=\"mainbg\">(<a href=\"chao.php?act=adopt&cid=".$disownedchao["id"]."\">Adopt</a>)</td></tr>";
     }
    echo "</table>";
  }else{
   errMsg("You must be logged in to access the forest!");
 }
break;
  case 'rename':
   if($_GET["cid"]){
    if(!isset($_POST["submit"])){
	 $chao = ucg_query($con, "SELECT name,owner FROM chao WHERE id = '".$_GET["cid"]."'",1);
	  if(isYourChao($_GET["cid"]))
            ucg_form("Edit Chao", "Name:<br /><input type=\"text\" maxlength=\"7\" value=\"".$chao["name"]."\" name=\"chaoname\" /><input type=\"submit\" value=\"Edit Chao\" name=\"submit\" />", "post"); 
        else errMsg("This is not your chao!");
	 }else{
	  query("UPDATE chao SET name = '".$_POST["chaoname"]."' WHERE id = '".$_GET["cid"]."'");
	   header("Location: chao.php?act=view&cid=".$_GET["cid"]);
          }
       }else{
        errMsg("Please specify an ID!");
    }
  break;
   case 'pet':
    if((int)$_GET["cid"]){
     $chaodata = ucg_query($con, "SELECT happiness,owner FROM chao WHERE id = '".$_GET["cid"]."'",1);
      if(isYourChao($_GET["cid"])){
       $chaoAlignment = ($_COOKIE["alignment"] == "hero") ? 1 : -1;
       $happiness = $chaodata["happiness"]+$chaoAlignment;
        mysqli_query($con, "UPDATE chao SET happiness = '".$happiness."' WHERE id = '".$_GET["cid"]."'");
         header("Location: chao.php?act=view&cid=".$_GET["cid"]);
      }else{
       errMsg("This is not your chao!");
      }
   }else{
    errMsg("No ID specified!");
  }
 break;
  case 'discipline':
   if((int)$_GET["cid"]){
    $chaodata = ucg_query($con, "SELECT id,happiness,owner,abuse FROM chao WHERE id = '".$_GET["cid"]."'",1);
    if(isYourChao($_GET["cid"])){
     $chaoAlignment = ($_COOKIE["alignment"] == "hero") ? 20 : -20;
    	$unhappiness = $chaodata["happiness"]-$chaoAlignment;
    	 query("UPDATE chao SET happiness = '".($unhappiness-$chaodata["abuse"])."', abuse = (abuse + 1) WHERE id = '".$_GET["cid"]."'");
    	  header("Location: chao.php?act=view&cid=".$_GET["cid"]);
    }else{
     errMsg("This is not your chao!");
    }
   }else{
    errMsg("No ID specified!");
  }
  break;
   case 'hatch':
    if((int)$_GET["cid"]){
	 require 'names.php';
	 $rn = mt_rand(0,sizeof($names));
     $chaodata = ucg_query($con, "SELECT * FROM `chao` WHERE `id` = '".$_GET["cid"]."'",1);
      if($chaodata["hatched"] != "y"){
       $im = ($chaodata["image"] == "new.gif") ? "member.gif" : "InvisibleChao-Final-1.gif";
        query("UPDATE chao SET image = '".$im."', hatched = 'y' WHERE id = '".$_GET["cid"]."'");
		addTokens($_COOKIE["id"],50);
         header("Location: chao.php?act=view&cid=".$_GET["cid"]);
    }else{
     echo "This chao is already hatched.";
   }  
 }else{
  echo "You did not access this page through the correct form.";
}
  break; 
   case 'disown':
     if((int)$_GET["cid"]){
      $chaodata = ucg_query($con, "SELECT owner FROM chao WHERE owner = '".$_COOKIE["id"]."'",1);
       if(isYourChao($_GET["cid"])){
        if(!isShopChao($_GET["cid"]) AND !isChaosChao($_GET["cid"])){
         query("UPDATE chao SET owner = '0' WHERE id = '".$_GET["cid"]."'");
        header("Location: chao.php?act=view&cid=".$_GET["cid"]);
       }else{
        query("DELETE FROM chao WHERE id = '".$_GET["cid"]."'");
       header("Location: chao.php?act=mychao");
      }
     }else{
      errMsg("This is not your chao!");
     }
   }
 break;
  case 'mychao':
   if($logged["name"]){
   $getchao = mysqli_query($con, "SELECT id,owner,name,image,overall FROM chao WHERE owner = '".$_COOKIE["id"]."' ORDER BY `overall` DESC");
    echo "<table style=\"position:relative; width: 680px; margin: 0px auto;\" align=\"center\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\" colspan=\"3\">My Chao</th></tr><tr><th class=\"titlebg\">ID</th><th class=\"titlebg\">Name</th><th class=\"titlebg\">Overall</th></tr>";
      while($chao = mysqli_fetch_assoc($getchao)):
       echo "<tr><td class=\"mainbg2\" width=\"1%\">".$chao["id"]."</td><td class=\"mainbg\"><a href=\"chao.php?act=view&cid=".$chao["id"]."\"><img alt=\"".$chao["name"]."\" title=\"".$chao["name"]."\" src=\"userchao/".$chao["image"]."\" style=\"border:none;\" /></a></td><td class=\"mainbg2\">".substr($chao["overall"], 7, 11)."</td></tr>";
    endwhile;
  echo "</table>";
 }else{
  errMsg("You must be logged in to do that!");
}
break;
 case 'getcode':
  if((int)$_GET["cid"]){
   $getchaodata = mysqli_query($con, "SELECT id,image FROM chao WHERE id = '".$_GET["cid"]."' ORDER BY overall DESC");
   $chaodata = mysqli_fetch_assoc($getchaodata);
    $image = "http://www.zollernverse.com/userchao/";
    $image = $image . $chaodata["image"];
     $link = "http://www.zollernverse.com/chao.php?act=view&cid=";
     $link = $link . $chaodata["id"];
      forumMsg("This is the UBBC code for forums such as ProBoards (and here!):<br /><textarea cols=\"25\" rows=\"10\" name=\"ubbc\">[url=".$link."][img]".$image."[/img][/url]</textarea>");
   }else{
    errMsg("No ID specified!");
  }
break;
 case 'choosebreedchao':
  if($logged["name"]){
   $getchao = mysqli_query($con, "SELECT id,owner,image FROM chao WHERE owner = '".$_COOKIE["id"]."' AND hatched = 'y' AND evolved = 'y' ORDER BY name ASC");
    echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Chao Breeding</th></tr><tr><td class=\"mainbg\">Please select the first chao you wish to breed.<hr/>";
     while($chao = mysqli_fetch_assoc($getchao)){
      if(!isShopChao($chao["id"]) AND !isChaosChao($chao["id"]))
    	 echo "<a href=\"chao.php?act=chooseotherbreedchao&cid=".$chao["id"]."\"><img src=\"userchao/".$chao["image"]."\" style=\"border:none;\" /></a> ";
    }
   echo "</td></tr></table>";
 }else{
  errMsg("You must be logged in to do that!");
}
break;
 case 'chooseotherbreedchao':
  if($logged["name"]){
   if((int)$_GET["cid"]){
    $getchao = mysqli_query($con, "SELECT id,owner,image FROM chao WHERE owner = '".$_COOKIE["id"]."' AND hatched = 'y' AND evolved = 'y' ORDER BY name ASC");
     $cdata = ucg_query($con, "SELECT id,owner,image FROM chao WHERE id = '".$_GET["cid"]."'",1);
      if(isYourChao($_GET["cid"])){
       echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Chao Breeding</th></tr><tr><td class=\"mainbg\">Please select the second chao you wish to breed.<hr/>";
        while($chao = mysqli_fetch_assoc($getchao)){
         if($chao["id"] == $cdata["id"]){
           continue;
        }
        if(!isShopChao($chao["id"]) AND !isChaosChao($chao["id"]))
          echo "<a href=\"chao.php?act=breed&cid=".$_GET["cid"]."&bid=".$chao["id"]."\"><img src=\"userchao/".$chao["image"]."\" style=\"border:none;\" /></a> ";
      }
     echo "</td></tr></table>";
    }else{
     errMsg("This is not your chao!");
   }
  }else{
   errMsg("No CID specified!");
 }
}else{
 errMsg("You must be logged in to do that!");
}
break;
 case 'breed':
  if($logged["name"]){
   if((int)$_GET["cid"] AND (int)$_GET["bid"]){
    $cid = $_GET["cid"];
    $bid = $_GET["bid"];
    $cdata = ucg_query($con, "SELECT * FROM chao WHERE id = '".$cid."'",1);
    $bdata = ucg_query($con, "SELECT * FROM chao WHERE id = '".$bid."'",1);
     $chao = mysqli_num_rows(mysqli_query($con, "SELECT id FROM chao WHERE owner = '".$_COOKIE["id"]."'"));
     if(isYourChao($cid) AND isYourChao($bid)){
     if(!isShopChao($cid) AND !isShopChao($bid) AND !isChaosChao($cid) AND !isChaosChao($bid)){
      if(is_hatched($cid) AND is_hatched($bid)){
       if($chao >= $maxchao){
        errMsg("Sorry, you have too many chao. You can't have more than ".$maxchao.".");
      }
     if($cdata["evolved"] == 'y' AND $bdata["evolved"] == 'y'){
      $swimgrades = array($cdata["swimgrade"],$bdata["swimgrade"]);
      $swimrand = mt_rand(0,count($swimgrades)-1);
      $swimexp = array($cdata["swim"],$bdata["swim"]);
      $swimexprand = mt_rand(0,count($swimexp)-1);
       $flygrades = array($cdata["flygrade"],$bdata["flygrade"]);
       $flyrand = mt_rand(0,count($flygrades)-1);
       $flyexp = array($cdata["fly"],$bdata["fly"]);
       $flyexprand = mt_rand(0,count($flyexp)-1);
      $rungrades = array($cdata["rungrade"],$bdata["rungrade"]);
      $runrand = mt_rand(0,count($rungrades)-1);
      $runexp = array($cdata["run"],$bdata["run"]);
      $runexprand = mt_rand(0,count($rungrades)-1);
       $powergrades = array($cdata["powergrade"],$bdata["powergrade"]);
       $powerrand = mt_rand(0,count($powergrades)-1);
       $powerexp = array($cdata["power"],$bdata["power"]);
       $powerexprand = mt_rand(0,count($powerexp)-1);
      $staminagrades = array($cdata["staminagrade"],$bdata["staminagrade"]);
      $staminarand = mt_rand(0,count($staminagrades)-1);
      $staminaexp = array($cdata["stamina"],$bdata["stamina"]);
      $staminaexprand = mt_rand(0,count($staminaexp)-1);
      $invischeck = array($cdata["invis"],$bdata["invis"]);
      $invisrand = mt_rand(0,count($invischeck));
      $invisImg = ($invischeck[$invisrand] == 'y') ? "invis_egg.gif" : "new.gif";
        query("INSERT INTO chao(swimgrade,flygrade,rungrade,powergrade,staminagrade,image,owner,swim,fly,run,power,stamina,invis)VALUES('".$swimgrades[$swimrand]."','".$flygrades[$flyrand]."','".$rungrades[$runrand]."','".$powergrades[$powerrand]."','".$staminagrades[$staminarand]."','".$invisImg."','".$_COOKIE["id"]."','".$swimexp[$swimexprand]."','".$flyexp[$flyexprand]."','".$runexp[$runexprand]."','".$powerexp[$powerexprand]."','".$staminaexp[$staminaexprand]."','".$invischeck[$invisrand]."')"); 
         forumMsg("Your two chao have been bred! The baby has been added to your chao list.");
		 addTokens($_COOKIE["id"],200);
        }else{
   	  errMsg("One of your chao are not old enough to mate. They must evolve first. Sorry!");
    }
   }else{
    errMsg("One of these chao are not hatched yet. They must be hatched and evolved to breed. Sorry!");
  }
   }else{
   	errMsg("One of these chao is either a chaos chao or a shop chao and therefore cannot mate.");
   }
     }else{
      errMsg("One of these chao isn't yours. You are only allowed to breed your chao, and not others.");
    }
 }else{
   errMsg("An ID is missing. Please do not tamper with the URLs of this web site.");
 }
}else{
 errMsg("You must be logged in to do that!");
}
break;
 case 'tr1':
  onlineCheck();
    $getchao = mysqli_query($con, "SELECT id,name,image FROM chao WHERE owner = '".$_COOKIE["id"]."'") OR SQLError();
     echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Select Your Chao</th></tr><tr><td class=\"mainbg\">Please select the chao you wish to trade:<br />";
      while($chao = mysqli_fetch_assoc($getchao)):
      if(!isShopChao($chao["id"]))
       echo "<a href=\"chao.php?act=tr2&amp;cid=".$chao["id"]."\"><img alt=\"".$chao["name"]."\" src=\"userchao/".$chao["image"]."\" border=\"0\" /></a> ";
    endwhile;
   echo "</td></tr></table>";
  break;
   case 'tr2':
    if(!online()) PleaseLogin();
     if(!(int)$_GET["cid"]) errMsg("You did not select a chao to trade!");
      $chaodata = SQLQuerySelect("name,owner","chao","id = '".$_GET["cid"]."'");
      $tdata = SQLQuerySelect("cid1","chaotrade","cid1 = '".$_GET["cid"]."'");
       if($tdata["cid1"] != "") errMsg("You already have this chao up for trade.");
        if($chaodata["owner"] != $_COOKIE["id"]) errMsg("This is not your chao. You may only trade one of yours.");
         if(!isset($_POST["submit"])):
          ucg_form("Select A User","Please type the <strong>username</strong> of the person you are trading with. You can find out their username by viewing their forum profile, for instance yours is ".$logged["name"].".<br /><input type=\"text\" name=\"touser\" /><br /><input type=\"submit\" value=\"Continue\" name=\"submit\" />","post");
        else:
         $userID = sql("SELECT id FROM members WHERE name = '".$_POST["touser"]."'");
         query("INSERT INTO chaotrade(touser,fromuser,cid1)VALUES('".$_POST["touser"]."','".$logged["name"]."','".$_GET["cid"]."')");
          forumMsg($chaodata["name"]." has been added to your friend's Trading Center. [user=3] has sent a PM to them about it. Also, if your chao is not accepted within three days, you will resume ownership of it.");
          sendPM($userID["id"],'3','You have a new trade offer!','Hello there! [user=3] here. I\'m just messaging you to inform you that you have a new trade awaiting your approval in the chao trading center. You may accept or deny it.[br][br]Please note that if you do not accept or deny the offer within three days, it is automatically denied.[br][br]Thanks!');
         endif;
        break;
         case 'tcenter1':
          if(!online()) PleaseLogin();
           echo "<table style=\"width: 680px; margin: 0px auto;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\" colspan=\"5\">Trading Center</th></tr><tr><td class=\"mainbg2\" colspan=\"5\">Welcome. Below are trades waiting for your approval. You may accept or deny them.</th></tr><tr><th class=\"catbg\">Chao</th><th class=\"catbg\">From</th><th class=\"catbg\">Date</th><th class=\"catbg\">Accept</th><th class=\"catbg\">Deny</th></tr>";
            $gettdata = mysqli_query($con, "SELECT id,cid1,fromuser,started FROM chaotrade WHERE touser = '".$logged["name"]."'") OR SQLError();
             while($tdata = mysqli_fetch_assoc($gettdata)):
              $chaodata = SQLQuerySelect("name,image","chao","id = '".$tdata["cid1"]."'");
               echo "<tr><td class=\"mainbg\"><img alt=\"".$chaodata["name"]."\" src=\"userchao/".$chaodata["image"]."\" /></td><td class=\"mainbg\">";
                $userdata = SQLQuerySelect("id,display","members","name = '".$tdata["fromuser"]."'");
                 echo "<a href=\"./?act=profile&u=".$userdata["id"]."\">";
                  echo getDisplay($userdata["id"]);
                 echo "</a></td><td class=\"mainbg\">".dateFormat($tdata["started"])."</td><td class=\"mainbg2\"><a href=\"chao.php?act=accepttrade1&amp;tid=".$tdata["id"]."\">Accept</a></td><td class=\"mainbg2\"><a href=\"chao.php?act=denytrade&amp;tid=".$tdata["id"]."\">Deny</a></td></tr>";
               endwhile;
              echo "</table>";
        break;
         case 'accepttrade1':
          if(!online()) PleaseLogin();
           if(!(int)$_GET["tid"]) errMsg("You did not specify a trade to accept.");
            $tdata = SQLQuerySelect("cid1,touser","chaotrade","id = '".$_GET["tid"]."'");
             if($tdata["touser"] != $logged["name"]) errMsg("This trade was not sent to you.");
              $getchao = mysqli_query($con, "SELECT id,name,image FROM chao WHERE owner = '".$_COOKIE["id"]."'") OR SQLError();
               echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Select A Chao</th></tr><tr><td class=\"mainbg\">Please select which chao you would like to send in return. If you have changed your mind about the trade, and would like to deny it, please click <a href=\"chao.php?act=denytrade&amp;tid=".$_GET["tid"]."\">here</a>.<hr/>";
                while($chao = mysqli_fetch_assoc($getchao)):
                if(!isShopChao($chao["id"]))
                 echo "<a href=\"chao.php?act=accepttrade2&amp;tid=".$_GET["tid"]."&amp;cid=".$chao["id"]."\"><img alt=\"".$chao["name"]."\" src=\"userchao/".$chao["image"]."\" border=\"0\" /></a> ";
               endwhile;
              echo "</td></tr></table>";
             break;
              case 'accepttrade2':
               if(!online()) PleaseLogin();
                if(!(int)$_GET["tid"]) errMsg("You did not specify a trade to accept.");
                 if(!(int)$_GET["cid"]) errMsg("You did not accept a chao to send.");
                   $tdata = SQLQuerySelect("cid1,touser,fromuser","chaotrade","id = '".$_GET["tid"]."'");
                   $userdata = SQLQuerySelect("id","members","name = '".$tdata["fromuser"]."'");
                   $chaodata = SQLQuerySelect("owner","chao","id = '".$_GET["cid"]."'");
                    if($chaodata["owner"] != $_COOKIE["id"]) errMsg("This chao is not yours. You may only send yours in return.");
                     if($tdata["touser"] != $logged["name"]) errMsg("This trade was not sent to you.");
                      query("UPDATE chao SET owner = '".$_COOKIE["id"]."' WHERE id = '".$tdata["cid1"]."'");
                      query("UPDATE chao SET owner = '".$userdata["id"]."' WHERE id = '".$_GET["cid"]."'");
                       sendPM($userdata["id"],'3','Trade accepted!','Hello! I\'m messaging you to let you know that your trade has been accepted, and you have been given a chao in return![br][br]Enjoy your new chao!');
                          query("DELETE FROM chaotrade WHERE id = '".$_GET["tid"]."'");
                           forumMsg("The trade has been successfully accepted. Enjoy your new chao!");
                       break;
                        case 'denytrade':
                         if(!online()) PleaseLogin();
                          if(!(int)$_GET["tid"]) errMsg("You did not specify a trade to deny.");
                           $tdata = SQLQuerySelect("touser,fromuser,cid1","chaotrade","id = '".$_GET["tid"]."'");
                           $udata = sql("SELECT id FROM members WHERE name = '".$tdata["fromuser"]."'");
                            if($tdata["touser"] != $logged["name"]) errMsg("This trade was not sent to you.");
                             query("DELETE FROM chaotrade WHERE id = '".$_GET["tid"]."'");
                              sendPM($udata["id"],'3','Trade denied.','Hello. Sorry to bother you, but I regret to inform you that one of your trade offers has been denied. The trading offer has been cancelled, and you have resumed ownership of your chao. Sorry for the disappointment.[br][br]Better luck next time.');
                             break;
                              case 'tcenter2':
                               if(!online()) PleaseLogin();
                                $gettdata = mysqli_query($con, "SELECT id,cid1,touser,started FROM chaotrade WHERE fromuser = '".$logged["name"]."'") OR SQLError();
                                 echo "<table style=\"margin: 0px auto; width: 680px;\" align=\"center\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\" colspan=\"4\">Your Trades</th></tr><tr><th class=\"catbg\">Chao</th><th class=\"catbg\">To</th><th class=\"catbg\">Date</th><th class=\"catbg\">Cancel</th></tr><tr><td class=\"mainbg2\" colspan=\"4\">Welcome. Below are your trade offers. You may wait for them to be accepted, or cancel the offer. All offers are automatically cancelled if they are not accepted within three days.</td></tr>";
                                  while($tdata = mysqli_fetch_assoc($gettdata)):
                                   $chaodata = SQLQuerySelect("id,name,image","chao","id = '".$tdata["cid1"]."'");
                                   $userdata = SQLQuerySelect("id,display","members","name = '".$tdata["touser"]."'");
                                    echo "<tr><td class=\"mainbg\"><img alt=\"".$chaodata["name"]."\" src=\"userchao/".$chaodata["name"]."\" /></td><td class=\"mainbg\"><a href=\"forum/index.php?action=viewprofile&amp;userid=".$userdata["id"]."\">";
                                     echo getDisplay($userdata["id"]);
                                    echo "</a></td><td class=\"mainbg\">".dateFormat($tdata["started"])."</td><td class=\"mainbg\"><a href=\"chao.php?act=canceltrade&amp;tid=".$tdata["id"]."&amp;cid=".$chaodata["id"]."\">Cancel</a></td></tr>";
                                   endwhile;
                                  echo "</table>";
                                 break;
                                  case 'canceltrade':
                                   if(!online()) PleaseLogin();
                                    if(!(int)$_GET["tid"]) errMsg("You did not specify a trade to cancel.");
                                     if(!(int)$_GET["cid"]) errMsg("You did not specify a chao.");
                                      $tdata = SQLQuerySelect("cid1,touser,fromuser","chaotrade","id = '".$_GET["tid"]."'");
                                       if($tdata["fromuser"] != $logged["name"]) errMsg("You did not send this trade.");
                                         query("DELETE FROM chaotrade WHERE id = '".$_GET["tid"]."'");
                                         $x = sql("SELECT id FROM members WHERE name = '".$tdata["touser"]."'");
                                          sendPM($x["id"],'3','Trade cancelled.','Hello. Sorry to bother you, but I regret to inform you that a trade offer sent to you has been canceled.[br][br]Sorry for the disappointment.');
                                            forumMsg("The trade has been successfully cancelled. You have resumed ownership of your chao.");
                                          break;
                                           case 'trade':
                                            if(!online()) PleaseLogin();
                                             echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Trading Center</th></tr><tr><td class=\"mainbg\">Welcome. You may view <a href=\"chao.php?act=tcenter1\">offers made to you</a>, or <a href=\"chao.php?act=tcenter2\">offers you've made</a>. To make a new offer, please click <a href=\"chao.php?act=tr1\">here</a>.</td></tr></table>";
                                           break;
                                            case 'clone':
                                             if(!online()) PleaseLogin();
                                              if(!(int)$_GET["cid"]) errMsg("No Dreamer Chao specified.");
                                               if($logged["tokens"]<200) errMsg("Oops! You cannot afford to clone that chao. Cloning costs 200 tokens. Sorry!");
                                               if(gamerPoints($_COOKIE["id"]) < 900) errMsg("Sorry, but you need at least 900 gamer points to clone a chao.");
                                                $numchao = SQLQuerySelect("id","chao","owner = '".$_COOKIE["id"]."'","num");
                                                 if($numchao >= $maxchao) errMsg("Sorry, you have too many chao. You may only have up to ".$maxchao." chao.");
                                                  $cdata = SQLQuerySelect("*","chao","id = '".$_GET["cid"]."'");
                                                   if(!isMe($cdata["owner"])) errMsg("You may not clone someone else's chao.");
                                                   if(isShopChao($cdata["id"])) errMsg("You may not clone this chao.");
                                                    query("INSERT INTO chao(name,image,owner,swimgrade,flygrade,rungrade,powergrade,staminagrade,swimlevel,flylevel,runlevel,powerlevel,staminalevel,swim,fly,run,power,stamina,stats,hatched,evolved)VALUES('".$cdata["name"]."','".$cdata["image"]."','".$cdata["owner"]."','".$cdata["swimgrade"]."','".$cdata["flygrade"]."','".$cdata["rungrade"]."','".$cdata["powergrade"]."','".$cdata["staminagrade"]."','".$cdata["swimlevel"]."','".$cdata["flylevel"]."','".$cdata["runlevel"]."','".$cdata["powerlevel"]."','".$cdata["staminalevel"]."','".$cdata["swim"]."','".$cdata["fly"]."','".$cdata["run"]."','".$cdata["power"]."','".$cdata["stamina"]."','".$cdata["stats"]."','".$cdata["hatched"]."','".$cdata["evolved"]."')");
                                                       useTokens(200);
                                                       forumMsg($cdata["name"]." has been successfully cloned.");
                                                 break;
                                                  case 'viewgarden':
                                                   if(!online()) PleaseLogin();
                                                    if(!(int)$_GET["g"]) errMsg("You didn't specify a garden!");
                                                     $r = "";
                                                     if($_GET["g"] == '1'):
                                                      $g = "light_big.jpg";
                                                       $h = "Light Garden";
                                                        $i = "neutral";
                                                    elseif($_GET["g"] == '2'):
                                                      $g = "angel_big.jpg";
                                                       $h = "Angel Garden";
                                                        $i = "hero";
                                                      elseif($_GET["g"] == '3'):
                                                       $g = "shiny_garden.jpg";
                                                        $h = "Shiny Garden";
                                                         $i = "special";
                                                   else:
                                                      $g = 'devil_big.png';
                                                       $h = "Devil Garden";
                                                        $i = "dark";
                                                  endif;
                                                   $getchao = mysqli_query($con, "SELECT * FROM chao WHERE owner = '".$_COOKIE["id"]."'");
                                                    $c = "";
                                                     $bottom = array("240","280","300","285","290","300","305","320","325","340","325","330","335","340","345","355","340","345","350","355","360","365");
                                                     $left = array("380","385","400","405","420","425","440","445","460","465","470","475","480","485","490","495","500","505","510","515","520","525","550","555","565","570","575","580","585","590","595","600","605","610","615");
                                                     while($chao = mysqli_fetch_assoc($getchao)):
                                                      $a = explode("/",$chao["image"]);
                                                       if(($a["0"] == $i) OR ($i == "neutral" AND $a["0"] == "member.gif") OR ($i == "special" AND isShopChao($chao["id"]) OR ($i == "special" AND $chao["invis"] == 'y'))):
                                                        $c .= ($c == "") ? $chao["id"] : ":" . $chao["id"];
                                                      endif;
                                                     endwhile;
                                                      $d = explode(":",$c);
                                                         echo "
                                                          <script type=\"text/javascript\">
                                                          <!--
                                                          var c = document.cookie.split(\"c=\")[1].split(\";\")[0];
                                                          var n = document.cookie.split(\"n=\")[1].split(\";\")[0];
                                                          // -->
                                                          </script>
                                                          <table align=\"center\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\" width=\"800\"><tr><th class=\"titlebg\" colspan=\"2\">".$h."</th></tr><tr><td class=\"mainbg2\" colspan=\"2\"><a href=\"javascript:void(0);\" onclick=\"showSection(this);\">Fruit</a><div id=\"fruit\" style=\"display:none;\"><strong>Fruit:</strong> <a href=\"javascript:buyFruit('1');\"><img src=\"userchao/fruit/swim.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('2');\"><img src=\"userchao/fruit/fly.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('3');\"><img src=\"userchao/fruit/run.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('4');\"><img src=\"userchao/fruit/power.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('5');\"><img src=\"userchao/fruit/stamina.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('6');\"><img src=\"userchao/fruit/strong.png\" border=\"0\" /></a> <a href=\"javascript:buyFruit('7');\"><img src=\"userchao/fruit/cube.png\" border=\"0\" /></a></div><div id=\"res\"></div><div id=\"tokens\"></div></td></tr><tr><td class=\"mainbg\"><div id=\"chao\"><img src=\"gardens/".$g."\" /></div>";
                                                          for($t = 0; $t < count($d); $t++):
                                                           $cd = SQLQuerySelect("name,image,age,age_int,happiness,born,swimlevel,flylevel,runlevel,powerlevel,staminalevel,swim,fly,run,power,stamina,swimgrade,flygrade,rungrade,powergrade,staminagrade,owner,reincarnated,evolved,hatched,invis","chao","id = '".$d[$t]."'");
                                                            $age = ($cd["age_int"]<30)?$cd["age_int"]+mt_rand(0,1):0;
      							     query("UPDATE chao SET age_int = '".$age."' WHERE id = '".$d[$t]."' AND owner = '".$_COOKIE["id"]."'");
         						       $age_int = ucg_query($con, "SELECT age_int FROM chao WHERE id = '".$d[$t]."' AND owner = '".$_COOKIE["id"]."'",1);
                                                                if($age_int["age_int"] >= 30){
           	     	                                         $chao_age = getAge($d[$t])+1;
                                    	      	                  query("UPDATE chao SET age = '".$chao_age."' WHERE id = '".$d[$t]."' AND owner = '".$_COOKIE["id"]."'");
                                    	      	             }
                                    	      	                                                       	      	                   if(!isChaosChao($d[$t])AND!isShopChao($d[$t])){
                                    	   $alignment = "";
            if($cd["staminalevel"] >= 15){
             if($cd["happiness"] >= 20){
                $alignment = "hero";
              }elseif($cd["happiness"] <= 14){
               $alignment = "dark";
              }elseif(($cd["happiness"]>14)AND($cd["happiness"]<20)){
               $alignment = "neutral";
              }else{
                $alignment = "neutral";
            }
           second_evolution($d[$t],"on");
             if(($cd["evolved"] != 'y') && (is_hatched($d[$t]))){
               if($cd["reincarnated"] < 3){
                if($cd["reincarnated"] < 2){
                 evolve($d[$t],$alignment);
          }else{ 
           if($cd["swim"] >= 300 AND $cd["fly"] >= 300 AND $cd["run"] >= 300 AND $cd["power"] >= 300){
            $chaos = $alignment . "/chaos/" . $alignment . ".gif";
             query("UPDATE `chao` SET `image` = '".$chaos."', `evolved` = 'y' WHERE `id` = '".$d[$t]."'");
         }else{
          evolve($d[$t],$alignment);
          }
       }
      }else{
       if(($cd["swimgrade"] == "S") AND ($cd["flygrade"] == "S") AND ($cd["rungrade"] == "S") AND ($cd["powergrade"] == "S") AND ($cd["staminagrade"] == "S")){
        $alignevo = "special/ChaoGod.gif";
         query("UPDATE chao SET image = '".$alignevo."', evolved = 'y' WHERE id = '".$d[$t]."'");
      }else{
       if($cd["swim"] >= 300 AND $cd["fly"] >= 300 AND $cd["run"] >= 300 AND $cd["power"] >= 300){
            $chaos = $alignment . "/chaos/" . $alignment . ".gif";
              query("UPDATE `chao` SET `image` = '".$chaos."', `evolved` = 'y' WHERE `id` = '".$d[$t]."'");
         }else{
        evolve($d[$t],$alignment);
      }
     }
    }
   }
  }
}
   chao_die($d[$t]);
   reincarnate($d[$t]);
   							if($cd["image"] != ""){
                                                             echo "<div style=\"left: ".$left[mt_rand(0,(count($left)-1))]."px; bottom: ".$bottom[mt_rand(0,(count($bottom)-1))]."px; position: absolute; z-index: 1000;\"><a href=\"javascript:void(0);\" onclick=\"updateStats('".$d[$t]."');setC('".$d[$t]."','".$cd["name"]."');\" id=\"".$d[$t]."\" class=\"dragableElement\"><img src=\"userchao/".$cd["image"]."\" border=\"0\" /></a></div>";
                                                        }
                                                     endfor;
                                                    echo "</td><td class=\"mainbg\" rowspan=\"2\" width=\"24%\"><div id=\"name\"></div><div id=\"stats\"></div></td></tr></table>";
echo "   
<script type=\"text/javascript\">
<!--
var canReload = true;
 function feedChao(cid,fid){
  $.ajax({
  	type: \"POST\", url: \"feed.php\", data: \"raise=true&cid=\"+cid+\"&fid=\" + fid,
  	complete: function(data){
  		var c = document.cookie.split(\"c=\")[1].split(\";\")[0];
  		updateStats(c);
  	}
  });
}
 function updateStats(cid){
  $.ajax({
  	type: \"POST\", url: \"feed.php\", data: \"update=true&cid=\"+cid,
  	complete: function(data){
  		$('#stats').html(data.responseText);
  	}
  });
}
      function showSection(){
       var sect = arguments[0];
        sect = sect.innerHTML;
         sect = sect.toLowerCase();
          if(document.getElementById(sect).style.display!=''){
           document.getElementById(sect).style.display='';
        }else{
          document.getElementById(sect).style.display='none';
       }
      }
      function buyFruit(fid){
       var c = document.cookie.split(\"c=\")[1].split(\";\")[0];
       var n = document.cookie.split(\"n=\")[1].split(\";\")[0];
       canReload = false;
       var d = ".getTokens($_COOKIE["id"]).";
       if(d >= 5){
        if(fid == 1){
         var s = 'userchao/fruit/swim.png';
         var fruitName = 'swim';
       }else if(fid == 2){
         var s = 'userchao/fruit/fly.png';
         var fruitName = 'fly';
       }else if(fid == 3){
         var s = 'userchao/fruit/run.png';
         var fruitName = 'run';
       }else if(fid == 4){
         var s = 'userchao/fruit/power.png';
         var fruitName = 'power';
       }else if(fid == 5){
         var s = 'userchao/fruit/stamina.png';
         var fruitName = 'stamina';
       }else if(fid == 6){
         var s = 'userchao/fruit/strong.png';
         var fruitName = 'strong';
       }else{
         var s = 'userchao/fruit/cube.png';
         var fruitName = 'cube';
       }
       var r = document.createElement('a');
        r.setAttribute('href','javascript:feedChao(\''+c+'\',\''+fid+'\')');
         document.getElementById('chao').appendChild(r);
       	 var i = document.createElement('img');
         var t = new Array('290','300','310','320','340');
         var n = Math.floor(Math.random() * t.length);
         var h = t[n];
         var y = new Array('450','510','525','550')
         var x = Math.floor(Math.random() * y.length);
         var f = y[x];
        i.setAttribute('src',s);
        i.setAttribute('style','left: '+f+'px; position: absolute; z-index: 1000; bottom: '+h+'px; border: none; ');
        i.setAttribute('onclick','this.parentNode.style.display=\'none\'; canReload = true;');
        i.setAttribute('name',fruitName);
        i.setAttribute('border','0');
         r.appendChild(i);
        }else{
         document.getElementById('res').innerHTML = 'You do not have enough tokens for that item!';
        }
      if(fid == 6) d = d - 100;
      else d = d-5;
      document.getElementById('tokens').innerHTML = \"Tokens: \"+d;
    }
     function setC(cid,n){
      var c = cid;
       document.cookie = 'c='+c;
       document.cookie = 'n='+n;
        document.getElementById('name').innerHTML = \"<div class='chaoLabel'>Name:</div> \"+n;
    }
// -->
</script>";
                                                 break;
                                                  case 'selectgarden':
                                                   if(!online()) PleaseLogin();
                                                    echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Select Your Chao Garden</th></tr><tr><td class=\"mainbg\"><a href=\"chao.php?act=viewgarden&amp;g=2\">Hero Garden</a> &nbsp; <a href=\"chao.php?act=viewgarden&amp;g=1\">Neutral Garden</a> &nbsp; <a href=\"chao.php?act=viewgarden&amp;g=3\">Shiny Garden</a> &nbsp; <a href=\"chao.php?act=viewgarden&amp;g=4\">Dark Garden</a></td></tr></table>";
                                                 break;
                                                  case 'blackmarket':
                                                   if(!online()) PleaseLogin();
                                                    $chaosEmeralds = array("Blue","Red","Yellow","Silver","Magenta","Aqua","Green");
                                                     echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\" colspan=\"2\">Black Market</th></tr>";
                                                      $ce = SQLQuerySelect("chaos_emeralds","members","id = '".$_COOKIE["id"]."'");
                                                      $ce2 = explode(":",$ce["chaos_emeralds"]);
                                                      $t = 1;
                                                       for($i = 0; $i < count($chaosEmeralds)+1; $i++){
                                                        if(in_array($i,$ce2) AND $ce["chaos_emeralds"] != ""): $t++; continue; endif;
                                                         if($i == 0): continue; endif;
                                                          echo "<tr><td class=\"mainbg\"><a href=\"?act=chaos&amp;e=".$i."\"><img src=\"chaos_emeralds/".$i.".gif\" border=\"0\" /></a></td><td class=\"mainbg2\">20,000</td></tr>";
                                                    }
                                                   if($t >= 7):
                                                    echo "<tr><td class=\"mainbg2\" colspan=\"2\">You have all seven Chaos Emeralds!</td></tr>";
                                                  endif;
                                                   echo "<tr><td class=\"mainbg\"><a href=\"?act=chaoegg&amp;e=1\"><img alt=\"[Invisible Chao]\" src=\"userchao/invis_egg.gif\" border=\"0\" /></a></td><td class=\"mainbg2\">10,000</td></tr></table>";
                                                  break;
                                                   case 'chaos':
                                                    onlineCheck();
                                                     if(!(int)$_GET["e"]) errMsg("You didn't specify an emerald to buy.");
                                                     $chaosEmeralds = SQLQuerySelect("chaos_emeralds","members","id = '".$_COOKIE["id"]."'");
                                                      $ce = explode(":",$chaosEmeralds["chaos_emeralds"]);
                                                       if(in_array((int)$_GET["e"],$ce)) errMsg("You already have this emerald!");
                                                        $ce2 = $chaosEmeralds["chaos_emeralds"].":".$_GET["e"].".gif";
                                                           useTokens(20000);
                                                          query("UPDATE members SET chaos_emeralds = '".$ce2."' WHERE id = '".$_COOKIE["id"]."'");
                                                           header("Location: ?act=blackmarket");
                                                        break;
                                                         case 'giveemerald':
                                                          $em = base64_decode($_GET["e"]);
                                                          $chao = (int)$_GET["cid"];
                                                           $ce = SQLQuerySelect("chaos_emeralds","chao","id = '".$chao."'");
                                                           $ce2 = explode(":",$ce["chaos_emeralds"]);
                                                            $chaosE = ($ce["chaos_emeralds"] != "") ? ":" : "";
                                                             if(in_array($em,$ce2)) errMsg("This chao already has that emerald!");
                                                               $chaosEmeralds = $ce["chaos_emeralds"].$chaosE;
                                                               $chaosEmeralds .= $em;
                                                                query("UPDATE chao SET chaos_emeralds = '".$chaosEmeralds."' WHERE id = '".$_GET["cid"]."'");
                                                               header("Location: chao.php?act=view&cid=".$_GET["cid"]);
                                                       break;
                                                        case 'chaoegg':
                                                         if(!(int)$_GET["e"]) errMsg("You did not select an egg.");
                                                          $t = array("new.gif","invis_egg.gif");
                                                          $t2 = array(0,10000);
                                                           if($t2[$_GET["e"]] > getTokens($_COOKIE["id"])) errMsg("Oops! You don't have enough tokens for this item.");
                                                           $invis = ($_GET["e"] == 1) ? 'y' : 'n';
                                                           useTokens($t2[$_GET["e"]]);
                                                              query("INSERT INTO chao(name,image,swimgrade,flygrade,rungrade,powergrade,staminagrade,owner,invis)VALUES('????','".$t[$_GET["e"]]."','".$grades[mt_rand(0,6)]."','".$grades[mt_rand(0,6)]."','".$grades[mt_rand(0,6)]."','".$grades[mt_rand(0,6)]."','".$grades[mt_rand(0,6)]."','".$_COOKIE["id"]."','".$invis."')");
                                                               forumMsg("You have successfully bought a chao egg. Take care of it!");
                                                             loguser($logged["name"]. " purchased a chao egg.");
                                                       break;
                                                        case 'sellchao':
                                                          if(online()){
                                                          if(!is_hatched($_GET["cid"])) errMsg("The chao must be hatched first.");
                                                           if(isYourChao($_GET["cid"])){
                                                            if(is_evolved($_GET["cid"])){
                                                             $chaodata = SQLQuerySelect("*","chao","id = '".$_GET["cid"]."'");
                                                             $img = str_replace("userchao/","",$chaodata["image"]);
                                                              (integer) $total = ceil((substr($chaodata["swim"], 7, 11)+substr($chaodata["fly"], 7, 11)+substr($chaodata["run"], 7, 11)+substr($chaodata["power"], 7, 11)+substr($chaodata["stamina"], 7, 11))/0005);
       								 $sell_for = $total;
        							  if(isChaosChao($_GET["cid"])){
         							   $sell_for += 100;
                                                                 }
                                                                if(isShopChao($_GET["cid"])){
                                                                 $gd = SQLQuerySelect("price","chao_shop","image = '".$img."'");
                                                                  $sell_for += ($gd["price"]/2);
                                                              }
        						       if($chaodata["reincarnated"] > 0){
         							$sell_for += ($chaodata["reincarnated"]*100);
     							     }
                                                           $e = explode(":",$chaodata["chaos_emeralds"]);
                                                           $sell_for += (count($e)*100);
                                                            $sell_for += ($chaodata["happiness"]/2);
                                                             query("UPDATE chao SET overall = '".$total."', sell_for = '".$sell_for."' WHERE id = '".$_GET["cid"]."'");
                                                             if(!isset($_POST["submit"])){
                                                               echo "<table style=\"margin: 0px auto; width: 680px;\" cellspacing=\"0\" cellpadding=\"4\" class=\"bordercolor\"><tr><th class=\"titlebg\">Sell Your Dreamer Chao</th></tr><tr><td class=\"mainbg\">You may sell your chao for more tokens here. Below is the chao's priced based on its stats and items. Once you sell your chao, that's it. You won't be able to see it again.<hr/><img src=\"userchao/".$chaodata["image"]."\" /><br /><strong>Chao:</strong> ".$chaodata["name"]."<br /><strong>Overall:</strong> ".$total;
                                                               if(isChaosChao($_GET["cid"])){
                                                                echo "<br /><strong>Chaos Chao:</strong> 100";
                                                              }
                                                               if(isShopChao($_GET["cid"])){
                                                                echo "<br /><strong>Shop Chao:</strong> ".number_format($gd["price"]/2);
                                                              }
                                                               if($chaodata["reincarnated"] > 0){
                                                                echo "<br /><strong>Reincarnated:</strong> ".$chaodata["reincarnated"]." X 100 = ".number_format($chaodata["reincarnated"]*100);
                                                            }
                                                             if($chaodata["chaos_emeralds"] != ""){
                                                              $e = explode(":",$chaodata["chaos_emeralds"]);
                                                               echo "<br /><strong>Chaos Emeralds:</strong> ".count($e)." X 100 = ".(count($e)*100);
                                                           }
                                                               echo "<br /><strong>Happiness:</strong> ".$chaodata["happiness"]. " / 2 = ".($chaodata["happiness"]/2)."<br /><strong>Ending Price:</strong> ".number_format($sell_for)."<form action=\"\" method=\"post\"><input type=\"hidden\" value=\"".base64_encode($sell_for)."\" readonly=\"readonly\" name=\"c_token\" /><input type=\"submit\" value=\"Sell My Dreamer Chao!\" name=\"submit\" /></form></td></tr></table>.";
                                                            }else{
                                                             $nr = $logged["tokens"] + $sell_for;
                                                             addTokens($_COOKIE["id"],$nr);
                                                               query("DELETE FROM chao WHERE id = '".$_GET["cid"]."'");
                                                                forumMsg("Your chao has been sold. Goodbye, ".$chaodata["name"]."!");
                                                               loguser($_COOKIE["id"],"sold their chao for ".number_format($sell_for)." tokens.");
                                                            }
                                                           }else{
                                                            errMsg("You chao must be an adult before it can be sold.");
                                                          }
                                                           }else{
                                                            errMsg("This is not your chao.");
                                                           }
                                                          }
                                                       break;
 endswitch;
  echo "
</body>
</html>";
 ob_end_flush();
?>
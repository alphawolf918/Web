<?php
					$getctgs = sql("SELECT ct_order,split_ctgs,forum_name,boards_center FROM sitedata");
					$split = $getctgs["split_ctgs"];
?>
<table class="table bordercolor pageContent" cellspacing="1" cellpadding="4">
				<tr>
					<th class="titlebg" colspan="5"><?php echo stripslashes($getctgs["forum_name"]); ?></th>
				</tr>
			<?php
			if($split){
				echo "</table>
				<table class=\"table bordercolor pageContent\" cellspacing=\"1\" cellpadding=\"4\">";
			}
			if($logged['enable_fade'] == 'y' OR !online()){
			$news = sql("SELECT news,news_speed FROM sitedata");
  $r = explode("<br />",$news["news"]);
   echo "<tr><th class=\"titlebg\" colspan=\"6\">News Fader</th></tr><tr><td style=\"height: 66px; text-align: center; vertical-align: middle;\" class=\"mainbg2\" colspan=\"6\"><div id=\"news\">";
    for($i=0;$i<count($r);$i++){
     echo "<div id=\"nf".$i."\" style=\"display: none; text-decoration: none; text-align: center; font-size: 14px; font-weight: bold;\">".ubbc(stripslashes($r[$i]))."</div>";
   }
$i = sizeof($r);
echo "</div></td></tr>";
js("function newsFader(id){var nf=$('#nf'+id);var nf2=(id<".$i.")?parseInt(id+1):0;nf.fadeIn(".$news["news_speed"]."000,function(){nf.fadeOut(".$news["news_speed"]."000,function(){if(nf2<".$i."){newsFader(nf2);}else{newsFader(0);}})});}newsFader(0);");
			}
			?>
				<?php
					if($split){
						echo "<tr>
						<th class=\"catbg\" colspan=\"5\">&nbsp;</th>
						</table>
						<div class=\"br\"></div>
						<table class=\"table bordercolor pageContent\" cellspacing=\"1\" cellpadding=\"4\">";
					}
					$ct = explode(",",$getctgs["ct_order"]);
					for($i=0;$i<sizeof($ct);$i++){
						$ctgs = sql("SELECT * FROM ctgs WHERE name = '".$ct[$i]."'");
						if($ctgs["staff"] == 1 AND !checkPerms(2)) continue;
						if($ctgs["name"] == "") continue;
						echo "<tr><th class=\"catbg\" colspan=\"5\"><a href=\"?act=viewcategory&id=".$ctgs["id"]."\" name=\"ctg".$ctgs["id"]."\">".stripslashes($ctgs["name"])."</a> &nbsp; &nbsp; <a href=\"javascript:;\" style=\"font-size:14px;font-family:'Verdana';\" onclick=\"toggleCategory(".$ctgs["id"].");\" id=\"sh".$ctgs["id"]."\">hide</a></th></tr><tr><td class=\"mainbg2\" colspan=\"5\"><div style=\"font-size:14px;\">".ubbc($ctgs["about"])."</div>";
						echo "</td></tr><tbody id=\"ct".$ctgs["id"]."\">";
						$bds = explode(",",$ctgs["bd_order"]);
						for($t=0;$t<count($bds);$t++){
							if($bds[$t] == "") continue;
							$boards = sql("SELECT * FROM boards WHERE name = '".addslashes($bds[$t])."'");
							if($boards["subboard"] != "0") continue;
							if(online()){
								$banned = explode(",",$boards["banned"]);
								if(in_array($logged["name"],$banned)) continue;
							}
							fetchBoard($boards["id"]);
						}
							echo "</tbody>";
					if($split){
						echo "<tr><th class=\"titlebg\" colspan=\"5\">&nbsp;</th></table>
						<div class=\"br\"></div>
						<table class=\"table bordercolor pageContent\" cellspacing=\"1\" cellpadding=\"4\">";
					}
						}
						$icon = (online()) ? "<a href=\"?act=markallasread\"><img src=\"markallasread.png\" title=\"Mark All As Read\" style=\"height:16px;width:16px;\" id=\"markall\" /></a>" : "&nbsp;";
						if(!$split){
							echo "<tr><th class=\"titlebg\" colspan=\"5\">".$icon."</th></tr></table>";
						}
						?>
						<br />
						<br />
						<?php
							require 'infocenter.php';
?>
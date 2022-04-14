<?php
if(!online()) PleaseLogin();
?>
<table align="center" cellspacing="0" cellpadding="4" class="bordercolor" width="780">
<tr><th class="titlebg" colspan="4">Personal Messages</th></tr>
<tr>
	<th class="catbg">Subject</th>
	<th class="catbg">From</th>
	<th class="catbg">Received</th>
	<th class="catbg">New</th>
</tr>
<?php
$gm = mysql_query("SELECT * FROM pm WHERE touser = '".$_COOKIE["id"]."' ORDER BY id DESC") OR SQLError();
if(mysql_num_rows($gm) == 0){
	echo "<tr><td class=\"mainbg\" colspan=\"4\">You have no messages.</td></tr>";
}
while($m = mysql_fetch_assoc($gm)){
	$from = sql("SELECT display,s_tag FROM members WHERE id = '".$m["fromuser"]."'");
	echo "<tr>
		<td class=\"mainbg\" width=\"55%\"><a href=\"?act=viewpm&id=".$m["id"]."\">".stripslashes($m["subject"])."</a></td>
		<td class=\"mainbg2\" width=\"1%\"><a href=\"?act=profile&u=".$m["fromuser"]."\">".$from["display"]."</a><font style=\"font-size:11px;\">(".$from["s_tag"].")</font></td>
		<td class=\"mainbg\">".dateFormat($m["sent"])."</td>
		<td class=\"mainbg2\">".ucfirst($m["unread"])."</td>
	      </tr>
";
}
?>
<tr><th class="titlebg" colspan="4">&nbsp;</th></tr>
</table>
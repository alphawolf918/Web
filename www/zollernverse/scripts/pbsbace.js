/*
Special Board/Category Edits
By Code Dragon
Global Footer Portion
Do not repost anywhere other than Chao Talk or claim as your own
Code from http://chaobreederxl2.proboards.com/index.cgi
*/
///////////////////////////////////////////////
var td = document.getElementsByTagName('td');
var tab = document.getElementsByTagName('table');
var forumName = document.title.split(" - ")[0];
//////////////////////////////////////////////
//Add to Admin Panel
if(this.location.href.match(/\?action=(admin|headersfooters3)/)){
for(x=0;x<td.length;x++){
if(td.item(x).width == "25%" && td.item(x).innerHTML.match(/Customize Your Forum/i) && td.item(x).vAlign == "top" && !td.item(x).innerHTML.match(/ :: /)){
td.item(x).innerHTML="<img src='" + td.item(x).getElementsByTagName('img').item(0).src + "'  /><b>Special Board/Category Edits</b><br /><br /><div style='padding-left: 35px'><a href='/index.cgi?action=headersfooters2&id=*&boardedits'>Board Edits</a><br /><a href='/index.cgi?action=headersfooters2&id=*&categoryedits'>Category Edits</a></div><br />"+td.item(x).innerHTML;
   }
  }
 }
//Hide headers and footers
else if(this.location.href.match(/&id=\*&boardedits/)){
if(td.item(5).innerHTML.match(/\?action=admin/)){
for(r=5;r<tab.length;r++){
tab.item(r).style.display='none';
changeTitle("Board Edits");
 }
//Write the board editor table
var boardTab = "<table width='92%' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td><font size='1'><a href='/index.cgi'>" + forumName + "</a> :: <a href='/index.cgi?action=admin'>Administration Area</a> :: Special Board Edits</font></td></tr></table><table class='bordercolor' cellspacing='0' cellpadding='0' align='center' width='92%' border='0'><tr><td class='windowbg'><table class='bordercolor' cellspacing='1' cellpadding='4' border='0' align='center' width='100%'><tr><td class='titlebg' width='100%' colspan='5'><font size='2'>Special Board Edits</font></td></tr><tr><td class='windowbg' width='25%'><font size='1'>Center Board Text</font></td><td class='windowbg' width='25%'>";
boardTab+="<select name='boardcenter' id='boardcenter'>";
boardTab+="<option value='no'";
boardTab+= (centerBoards == 'no') ? ' selected ' : '';
boardTab+=">No</option>";
boardTab+="<option value='yes'";
boardTab+= (centerBoards == 'yes') ? ' selected ' : '';
boardTab+=">Yes</option>";
boardTab+="</select></td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will center all of the text in all boards.</td></tr><td class='windowbg' width='25%'><font size='1'>Message If No Moderator</font></td><td class='windowbg' width='25%'>";
boardTab+="<select name='boardmod' id='boardmod'>";
boardTab+="<option value='no'";
boardTab+= (modMessage == 'no') ? ' selected ' : '';
boardTab+=">No</option>";
boardTab+="<option value='yes'";
boardTab+= (modMessage == 'yes') ? ' selected ' : '';
boardTab+= ">Yes</option></select>";
boardTab+="</td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will put a message on all boards with no moderator.</font></td></tr><tr><td class='windowbg' width='25%'><font size='1'>Message In Last Post Cell for Guests</font></td><td class='windowbg' width='25%'>";
boardTab+="<select name='guestMes' id='guestMes'>";
boardTab+="<option value='no'";
boardTab+= (guestMes == 'no') ? ' selected ' : '';
boardTab+= ">No</option>";
boardTab+="<option value='yes'";
boardTab+= (guestMes == 'yes') ? ' selected ' : '';
boardTab+=">Yes</option></select>";
boardTab+="</td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will put a message in the Last Post column for guests.</font></td></tr><tr><td class='windowbg' width='25%'><font size='1'>Add Thread/Post Info to Cells</font></td><td class='windowbg' width='25%'><select id='tpinfo' name='tpinfo'><option value='no'";
boardTab+= (tpInfo == 'no') ? ' selected ' : '';
boardTab+=">No</option><option value='yes'";
boardTab+= (tpInfo == 'yes') ? ' selected ' : '';
boardTab+=">Yes</option></select></td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will add the number of Threads and Posts to their own cells.</font></td></tr><tr><td class='windowbg' width='25%'><font size='1'>Add <b>No topics available</b> to an empty Last Post cell.</font></td><td class='windowbg' width='25%'><select id='notopics' name='notopics'><option value='no'";
boardTab+= (NoTopics == 'no') ? ' selected ' : '';
boardTab+=">No</option><option value='yes'";
boardTab+= (NoTopics == 'yes') ? ' selected ' : '';
boardTab+=">Yes</option></select></td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will add a message to an empty Last Post cell.</font></td></tr><tr><td class='windowbg' width='25%' colspan='4'><input type='submit' value='Save Changes' onClick='saveBoardChanges()' /></td></tr></table></td></tr></table>";
document.write(boardTab);
 }
}
//Save changes
function saveBoardChanges(){
var boardCenter = document.getElementById('boardcenter').value;
var boardMod = document.getElementById('boardmod').value;
var guestMesV = document.getElementById('guestMes').value;
var tpInfoV = document.getElementById('tpinfo').value;
var NoTopicsV = document.getElementById('notopics').value;
if(centerBoards == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var centerBoards = ""/, "var centerBoards = '" + boardCenter + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var centerBoards = '(.+?)'/, "var centerBoards = '" + boardCenter + "'");
}
if(modMessage == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var modMessage = ""/, "var modMessage = '" + boardMod + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var modMessage = '(.+?)'/, "var modMessage = '" + boardMod + "'");
}
if(guestMes == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var guestMes = ""/, "var guestMes = '" + guestMesV + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var guestMes = '(.+?)'/, "var guestMes = '" + guestMesV + "'");
}
if(tpInfo == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var tpInfo = ""/, "var tpInfo = '" + tpInfoV + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var tpInfo = '(.+?)'/, "var tpInfo = '" + tpInfoV + "'");
}
if(NoTopics == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var NoTopics = ""/, "var NoTopics = '" + NoTopicsV + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var NoTopics = '(.+?)'/, "var NoTopics = '" + NoTopicsV + "'");
}
document.forms[0].submit();
}
//Change "Headers and footers have been updated"
if(document.referrer.match(/&id=\*&boardedits/)){
for(o=0;o<td.length;o++){
if(td.item(o).innerHTML.match(/Your headers and footers have been/gi)){
td.item(o).innerHTML  = td.item(o).innerHTML.replace("Your headers and footers have been successfully updated.", "Your board settings have been saved.");
  }
 }
}
//Change Title Function
function changeTitle(newTitle){
var oldTitle = document.title.split(" - ")[0];
document.title = oldTitle + " - " + newTitle;
  }
//Center Board Text
function centerAllBoards(){
for(a=0;a<td.length;a++){
if(td.item(a).className == "windowbg2" && td.item(a).width == "66%" && td.item(a+1).innerHTML.match(/\d?/)){
td.item(a).style.textAlign='center';
   }
  }
 }
//Message if no moderator
function moderatorMessage(){
for(t=0;t<td.length;t++){
if(td.item(t).className == "windowbg2" && td.item(t).width == "66%" && !td.item(t).innerHTML.match(/moderator/gi)){
td.item(t).innerHTML+="<font size='1'><i>No moderators for this board.</i></font>";
   }
  }
 } 
//Message in Last Post cell for guests
function guestMessage(){
if(pb_username == "Guest"){
for(y=0;y<td.length;y++){
if(td.item(y).className == "windowbg2" && td.item(y-1).innerHTML.match(/(\d+?)/) && td.item(y-2).innerHTML.match(/(\d+?)/) && td.item(y-3).width == "66%"){
td.item(y).innerHTML="Please <a href='/index.cgi?action=login'>login</a> or <a href='/index.cgi?action=register'>register</a> to use this feature.";
    }
   }
  } 
 }
//Add Thread and Post Info
function threadPostInfo(){
if(location.href.match(/(http:\/\/)?(www?\.)?\proboards(\d)+\.com\/(index\.cgi((\?|#)?)?)?$/i)){
for(p=0;p<td.length;p++){
if(td.item(p).align == "center" && td.item(p).vAlign == "middle" && td.item(p).className == "windowbg" && td.item(p).width == "1%" && td.item(p).innerHTML.match(/(\d+?)/)){
if(td.item(p-1).width == "66%" && td.item(p-1).className == "windowbg2"){
td.item(p).innerHTML+="<br />Threads";
td.item(p).width="1%";
td.item(p).className="windowbg2";
   }
else{
td.item(p).innerHTML+="<br />Posts";
td.item(p).width="1%";
td.item(p).className="windowbg2";
    }
   }
  }
 }
}
//No Topics Available
function noTopicsMessage(){
for(q=0;q<td.length;q++){
if(td.item(q).width == "24%" && td.item(q).vAlign == "top" && td.item(q-3).width == "66%" && !td.item(q).firstChild.innerHTML.match(/on|in|by/gi)){
td.item(q).innerHTML="No topics available.";
    }
  }
}
//Function conditionals
if(centerBoards == 'yes'){
centerAllBoards();
  }
else{
  }
if(modMessage == 'yes'){
moderatorMessage(); 
  }
else{
 }
if(guestMes == 'yes'){
guestMessage();
  }
else{
}
if(tpInfo == 'yes'){
threadPostInfo();
}
else{
}
if(NoTopics == 'yes'){
noTopicsMessage();
}
else{
}
//Hide headers and footers
if(this.location.href.match(/&id=\*&categoryedits/)){
if(td.item(5).innerHTML.match(/\?action=admin/)){
for(C=6;C<tab.length;C++){
tab.item(C).style.display='none';
changeTitle("Category Edits");
    }
//Write the Category Editor table
var cTab = "<table width='92%' cellspacing='0' cellpadding='0' border='0' align='center'><tr><td><font size='1'><a href='/index.cgi'>" + forumName + "</a> :: <a href='/index.cgi?action=admin'>Administration Area</a> :: Special Category Edits</font></td></tr></table><table class='bordercolor' cellspacing='0' cellpadding='0' align='center' width='92%' border='0'><tr><td class='windowbg'><table class='bordercolor' cellspacing='1' cellpadding='4' border='0' align='center' width='100%'><tr><td class='titlebg' width='100%' colspan='5'>Category Edits</td></tr><tr><td class='windowbg' width='25%'><font size='1'>Center Category Text</font></td><td class='windowbg' width='25%'>";
cTab+="<select name='centercattext' id='centercattext'>";
cTab+="<option value='no'";
cTab+= (centerCT == 'no') ? ' selected ' : '';
cTab+=">No</option>";
cTab+="<option value='yes'";
cTab+= (centerCT == 'yes') ? ' selected ' : '';
cTab+=">Yes</option></select>";
cTab+="</td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will center all of the catbg text.</font></td></tr><tr><td class='windowbg' width='25%'><font size='1'>Center Title Text</font></td><td class='windowbg' width='25%'>";
cTab+="<select name='centerTT' id='centerTT'>";
cTab+="<option value='no'";
cTab+= (centerTT == 'no') ? ' selected ' : '';
cTab+=">No</option><option value='yes'";
cTab+=(centerTT == 'yes') ? ' selected ' : '';
cTab+=">Yes</option></select></td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will center all of the titlebg text.</font></td></tr><tr><td class='windowbg' width='25%'><font size='1'>Remove Mark As Read bar</font></td><td class='windowbg' width='25%'><select id='marb' name='marb'><option value='no'";
cTab+= (remMARB == 'no') ? ' selected ' : '';
cTab+= ">No</option><option value='yes'";
cTab+= (remMARB == 'yes') ? ' selected ' : '';
cTab+= ">Yes</option></select></td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will remove the Mark As Read bar on the main page.</font></td></tr><tr><td class='windowbg' width='25%'><font size='1'>Remove Forum Name, Topcs, Posts, etc...</font></td><td class='windowbg' width='25%'><select id='remtitlebar' name='remtitlebar'><option value='no'";
cTab+= (remTitleBar == 'no') ? ' selected ' : '';
cTab+=">No</option><option value='yes'";
cTab+= (remTitleBar == 'yes') ? ' selected ' : '';
cTab+=">Yes</option></select></td><td class='windowbg' width='40%'><font size='1'>Selecting <b>Yes</b> will remove the Forum Name Title bar.</font></td></tr><tr><td class='windowbg' width='25%' colspan='4'><input  type='submit' onClick='saveCategoryChanges()' value='Save Changes' /></td></tr></table></td></tr></table>";
document.write(cTab);
}
}
//Save changes
function saveCategoryChanges(){
var cct = document.getElementById('centercattext').value;
var ctt = document.getElementById('centerTT').value;
var remMARBv = document.getElementById('marb').value;
var remTitleBarV = document.getElementById('remtitlebar').value;
if(centerCT == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var centerCT = ""/, "var centerCT = '" + cct + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var centerCT = '(.+?)'/, "var centerCT = '" + cct + "'");
}
if(centerTT == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var centerTT = ""/, "var centerTT = '" + ctt + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var centerTT = '(.+?)'/, "var centerTT = '" + ctt + "'");
}
if(remMARB == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var remMARB = ""/,  "var remMARB = '" + remMARBv + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var remMARB = '(.+?)'/, "var remMARB = '" + remMARBv + "'");
}
if(remTitleBar == ""){
document.forms[0].header.value = document.forms[0].header.value.replace(/var remTitleBar = ""/, "var remTitleBar = '" + remTitleBarV + "'");
}
else{
document.forms[0].header.value = document.forms[0].header.value.replace(/var remTitleBar = '(.+?)'/, "var remTitleBar = '" + remTitleBarV + "'");
}
document.forms[0].submit();
} 
//Change "Headers and footers have been updated"
if(document.referrer.match(/&id=\*&categoryedits/)){
for(z=0;z<td.length;z++){
if(td.item(z).innerHTML.match(/headers and footers have been/)){
td.item(z).innerHTML = td.item(z).innerHTML.replace("Your headers and footers have been successfully updated.", "Your category settings have been saved.");
    }
   }
  }
//Center category text
function centerCatText(){
for(v=0;v<td.length;v++){
if(td.item(v).className == "catbg"){
td.item(v).style.textAlign="center";
    }
   }
  }
//Center title text
function centerTitleText(){
for(b=0;b<td.length;b++){
if(td.item(b).className == "titlebg"){
td.item(b).style.textAlign="center";
     }
    }
   }
//Remove Mark As Read bar
function remMARbCell(){
for(j=0;j<td.length;j++){
if(td.item(j).colSpan == "5" && td.item(j).height == "18" && td.item(j).align == "right" && td.item(j).className == "catbg"){
td.item(j).parentNode.style.display='none'; 
   }
  }
 }
//Remove Forum Name Title Bar
function removeTitleBar(){
if(location.href.match(/^http:\/\/(\w+?)\.proboards(\d+?)\.com\/?((\w+)\.cgi(\?|#)?)?$/i)){
for(w=0;w<td.length;w++){
if(td.item(w).className == "titlebg" && td.item(w).innerHTML.match(/Forum Name|Topics|Posts/gi)){
td.item(w).parentNode.style.display='none';
    }
   }
  }
 }
//Function conditionals
if(centerCT == 'yes'){
centerCatText();
}
else{
}
if(centerTT == 'yes'){
centerTitleText();
}
else{
}
if(remMARB == 'yes'){
remMARbCell();
}
else{
}
if(remTitleBar == 'yes'){
removeTitleBar();
}
else{
}
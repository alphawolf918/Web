/*
Zollernverse Script
Written by Alpha Wolf
(c) 2012 - 2013
For Zollernverse
Unauthorized distribution, theft, modification or claim as your own not allowed
Not to be used on any other website
*/
$.ajaxSetup({type: "POST"});
function achievement(id){
	var achID = $('#achID');
	$.ajax({
		url: "achieve.php", data: "id="+id,
		complete: function(data){
			achID.html(data.responseText);
			achID.slideDown();
			setTimeout("$('#achID').slideUp('slow');",2500);
		}
	});
}
function changeTitle(newTitle){ document.title = document.title+' - '+newTitle; }
function reConf(msg){ return confirm(msg); }
function showSection(){ $('#'+arguments[0]).slideToggle('normal'); }
function deletePost(id){ var post = $('#p'+id); $.post("deletepost.php", { pid: id, t: "post" }, function(data){ post.hide(); });}
function toLoc(){ location.href = arguments[0]; }
function deleteTopic(id){
	$.ajax({
		url: "deletepost.php", data: "pid="+id+"&t=topic",
		complete: function(data){
			toLoc(data.responseText);
		}
	});
}
function getID(id){ return document.getElementById(id); }
function addColor(clr){ document.postForm.post.value += '[color=' + clr + '][/color]'; }
function counter() { var t = document.postForm.post.value; if(t.length > 60000){ document.postForm.post.value = t.substring(0,60000); } document.forms[0].cl.value = (60000-t.length); }
function exp_col(){ 
	var t = document.postForm.post;
	if(t.id != "exp" || !t.id){
		t.rows += 10; t.id = "exp"; 
		$('#ec').html("Collapse");
	}else{
		t.rows -= 10; t.id = ""; 
		$('#ec').html("Expand");
	}
}
function min_len(){
	var t = document.postForm.post.value.split(" ");
	var m = 10;
	var s = getID('s');
	s.disabled = (t.length < m) ? 1 : 0;
}
function minReplyLen(){
	var t = document.replyForm.post.value.split(" ");
	var m = 5;
	var s = getID('s');
	s.disabled = (t.length < m) ? 1 : 0;
}
function f1(){
	counter(); 
}
function ytLink(){
	var r = prompt('Please enter the YouTube link below:'); 
	document.postForm.post.value += '[yt]'+r+'[/yt]'; 
}
function addURL(){
	document.postForm.post.value += '[url='+prompt("Please enter the URL below:")+']'+prompt("Please enter the text to be displayed:")+'[/url]'; 
}
function addList(){
	document.postForm.post.value += '[list]\n[*]\n[*]\n[/list]\n'; 
}
function addTag(t){
	document.postForm.post.value += '['+t+'][/'+t+']'; 
}
function addImg(){
	document.postForm.post.value += '[img]'+prompt('Please enter the image URL below:')+'[/img]';
}
function addTable(){ 
	document.postForm.post.value += '[table]\r\n[tr]\r\n[td]\r\n[/td]\r\n[/tr]\r\n[/table]\r\n';
}
function addFont(){
	document.postForm.post.value += '[font=Tahoma][/font]';
}
function addShadow(){
	document.postForm.post.value += '[shadow=black][/shadow]';
}
function addTr(){
	document.postForm.post.value += '[tr][/tr]';
}
function addColumn(){
	document.postForm.post.value += '[td][/td]';
}
function addGlow(){
	document.postForm.post.value += '[glow=red][/glow]';
}
function addSmiley(smi){
	document.postForm.post.value += smi; 
}
function swapSb(id) {
	var bd_id = $('#bd_id'+id);
	var l = $('#sb'+id);
	if(bd_id.css("display") == 'none') {
		bd_id.show();
		l.html('Collapse');
	}else{
		bd_id.hide();
		l.html('Expand');
	}
}
function system(){
	var cmd = $('#cmd');
	var ch = cmd.html();
	$.ajax({
		url: "run.php", data: "q="+$('#cin').val(),
		complete: function(data){
			$('#cin').val("");
			cmd.html(ch+data.responseText+"<br/>");
		}
	})
}
function checkAvail(){
	var av = $('#av');
	var user = $('#user').val();
	$.ajax({
		url: "checkavail.php", data: "user="+user,
		complete: function(data){
			loadIcon('av');
			av.html(data.responseText);
		}
	});
}
function checkPass(){
	var p1 = $('#p1');
	var pw = $('#pw');
	$.ajax({
		url: "checkavail.php", data: "pw="+pw.val(),
		complete: function(data){
			loadIcon('p1');
			p1.html(data.responseText);
		}
	});
}
function confirmPass(){
	var p2 = $('#p2');
	var password2 = $('#password2');
	$.ajax({
		url: "checkavail.php", data: "p2="+password2.val()+"&pass="+$('#pw').val(),
		complete: function(data){
			loadIcon('p2');
			p2.html(data.responseText);
		}
	});
}
function checkEmail(){
	var em = $('#email');
	var e = $('#e');
	$.ajax({ url: "checkavail.php", data: "email="+em.val(), complete: function(data){ loadIcon('e'); e.html(data.responseText); } }); }
function updateAct(){
	var ar = $('#ar');
	$.ajax({
		url: "activity.php", data: null,
		complete: function(data){
			ar.html(data.responseText);
			updateAct();
		}
	});
}
function addWhisper(){
	$('#post').val($('#post').val()+"[whisper=0][/whisper]");
}
function font_add(f){
	$('#post').val($('#post').val()+"[font="+f+"][/font]");
}
function setStatus(){
	var s = $('#status');
	var iStatus = $('#sform').val();
	$.ajax({
		url: "status.php", data: "s="+iStatus,
		complete: function(data){
			loadIcon('status');
			s.html(data.responseText);
			$('#sform').val("");
			$('#sform').blur();
			updateOnline();
		}
	});
}
function notesRead(){
	var nl = $('#notesLink');
	$.ajax({
		url: "notes_read.php", data: "notes=read",
		complete: function(data){
			nl.html("<img src=\"buttons/world.png\" /> Notifications");
		}
	});
}
function notesDelete(id){
	var nc = $('#notesContent');
	$.ajax({
		url: "notes_read.php", data: "notes=delete&id="+id,
		complete: function(data){
			nc.html(data.responseText);
		}
	});
}
function clearStatus(){
	var s = $('#status');
	$.ajax({
		url: "status.php", data: "mode=1&s=1",
		complete: function(data){
			s.html(data.responseText);
		}
	});
}
function likeStatus(id){
	var l = $('#l'+id);
	$.ajax({
		url: "like.php", data: "sid="+id,
		complete: function(data){
			l.html(data.responseText);
		}
	});
}
var canUpdate = true;
function updateOnline(){
	var o = $('#online');
	$.ajax({
		url: "online.php", data: null,
		complete: function(data){
			if(canUpdate)
			o.html(data.responseText);
			//setTimeout("updateOnline()",2000);
		}
	});
}
function updateForumLastPost(){
	var lastPost = $('#lastPost');
	$.ajax({
		url: "lastpost.php", data: null,
		complete: function(data){
			lastPost.html(data.responseText);
			//setTimeout("updateForumLastPost()",2000);
		}
	});
}
function deleteCensor(i){
	var t = $('#t-'+i);
	var id = $('#id'+i).val();
	$.post("delcens.php",
		{ id: id },
			function(){
				$('#cens'+i).val("");
				$('#new'+i).val("");
				t.slideUp("slow");
			});
}
function nWin(nLink){
	var nl = window.open(nLink,"nWin","directories=no,location=no,menubar=no,resizable=no,scrollbars=1,status=0,toolbar=0,top=100,left=100,width=500,height=310");
	nl.focus();
}
function toggleCategory(id){
	var sh = $('#sh'+id);
	var ct = $('#ct'+id);
	if(ct.css("display") != "none"){
		sh.html("show");
		ct.hide();
	}else{
		sh.html("hide");
		ct.show();
	}
}
function checkAll(){
	var chkbx = document.getElementsByTagName('input');
	var sa = $('#sv');
	var sHTML = sa.html();
	for(i=0;i<chkbx.length;i++){
		if(chkbx[i].type == 'checkbox'){
			var tf = (chkbx[i].checked) ? false : true;
			chkbx[i].checked=tf;
		}
		var ss = (sHTML == "Select All") ? "Unselect All" : "Select All";
		sa.html(ss);
	}
}
function report(id,userid){
	$.ajax({
		url: "report.php", data: "id="+id+"&details="+$('#details'+id).val(),
		complete: function(data){
			$('#r'+id).slideToggle();
			$('#r'+id).html("Thank you!");
			$('#details'+id).val("");
		}
	});
}
function sendNote(id,userid){
	$.ajax({
		url: "notes.php", data: "id="+id+"&details="+$('#note'+id).val(),
		complete: function(data){
			$('#n'+id).html("Note posted.");
			$('#n'+id).slideToggle();
			$('#note'+id).val("");
		}
	});
}
function sc(sid){
	var cmnt = $('#s_comment'+sid).val();
	$.ajax({
		url: "status.php", data: "s="+cmnt+"&id="+sid,
		complete: function(data){
			$('#sc'+sid).slideToggle();
			canUpdate = true;
			updateOnline();
		}
	});
}
function XMLDoc(f){
  	var xhttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	xhttp.open("GET",f+".xml",false);
	xhttp.send();
	xmlDoc=xhttp.responseXML;
	return xmlDoc;
}
function saveRSS(){
	$.post("rss.php", {post: $('#update').val(), subject: $('#sb').val()}, function(){toLoc("?act=updates");});
}
function quote(id){
	toLoc('#reply');
	var p = $('#p').html();
	$('#p').html(p+"[quote pid="+id+"]");
}
function changeSkin(id){
	$('#skin-id').attr("href","styles/skinid-"+id+".css");
}
function getMessages(){
	$.ajax({
		url: "messages.php", data: "mode=inbox",
		complete: function(data){
			$('#c').html(data.responseText);
		}
	});
}
function getInbox(){
	getMessages();
}
function getSent(){
	$.ajax({
		url: "messages.php", data: "mode=outbox",
		complete: function(data){
			$('#c').html(data.responseText);
		}
	});
}
function viewMsg(id){
	$.ajax({
		url: "messages.php", data: "mode=view&id="+id,
		complete: function(data){
			$('#c').html(data.responseText);
		}
	});
}
function deleteMsg(id,mode){
	$.ajax({
		url: "messages.php", data: "mode=delete&id="+id,
		complete: function(data){
			if(mode == "inbox") getMessages();
			else if(mode == "outbox") getSent();
		}
	});
}
function getTrash(){
	$.ajax({
		url: "messages.php", data: "mode=trash",
		complete: function(data){
			$('#c').html(data.responseText);
		}
	});
}
function restoreItem(id){
	$.post("messages.php", {mode: "restore", id: id }, function(){ getTrash(); });
}
function getSaved(){
	$.ajax({
		url: "messages.php", data: "mode=saved",
		complete: function(data){
			$('#c').html(data.responseText);
		}
	});
}
function sendPM(id,msg){
	$.post("messages.php", {mode: "send", id: id, msg: msg }, function(){ getMessages(); });
}
function savePM(id){
	$.post("messages.php",{ mode: "save", id: id }, function(){ getSaved() });
}
function deleteForever(){
	$.post("messages.php",{mode: "deleteforever"},getSaved());
}
function downloadMessage(id){
	$.ajax({
		url: "messages.php", data: "id="+id+"&mode=download",
		complete: function(data){
			eval(data.responseText);
		}
	});
}
function forumJump(id){
	toLoc("?act=viewtopics&bid="+id);
}
function whichKey(e){
	return (keycode = (e.keyCode) ? e.keyCode : e.which);
}
function cond(){ if(arguments[0]) eval(arguments[1]); if(arguments[2] != "" && !arguments[0]) eval(arguments[3]); }
function previewColors(){
	var pr = $('#pr');
	$.ajax({
		url: "preview.php", data: "clr1="+$('#c1').val()+"&clr2="+$('#c2').val(),
		complete: function(data){
			pr.html(data.responseText);
		}
	});
}
function likeTopic(id){
	var icon = $('#icon');
	$.ajax({
		url: "like.php", data: "tid="+id,
		complete: function(data){
			icon.html(data.responseText);
		}
	});
}
function statusComment(id){
	var c = $('#cmnts');
	$.ajax({
		url: "status.php", data: "id="+id+"&s="+$('#cmnt').val(),
		complete: function(data){
			c.html(data.responseText);
			$('#cmnt').val("");
		}
	});
}
function profileComment(prof_id){
	var cmnts = $('#cmnts');
	var pc = $('#p_cmnt');
	$.ajax({
		url: "profile_comments.php", data: "pid="+prof_id+"&cmnt="+pc.val()+"&id=1",
		complete: function(data){
			pc.val("");
			getComments(prof_id);
			pc.focus();
		}
	});
}
function getComments(prof_id){
	var cmnts = $('#cmnts');
	$.ajax({
		url: "profile_comments.php", data: "pid="+prof_id+"&id=0",
		complete: function(data){
			cmnts.html(data.responseText);
			//setTimeout("getComments("+prof_id+");",2000);
		}
	});
}
function average(){
	var a = arguments.length;
	var x = 0;
	for(i=0;i<a;i++){
		x += arguments[i];
	}
	return Math.floor(x/a);
}
function saveDraft(u,b){
	var ipost = $('#post')
	var draft = $('#autoSave');
	if(ipost.val() == ""){
		draft.html("<strong>Draft was empty and did not save.</strong>");
	}else{
		var subj = $('#sbjct');
		var description = $('#d');
		$.ajax({
			url: "drafts.php", data: "post="+ipost.val()+"&userid="+u+"&boardid="+b+"&subject="+subj.val()+"&d="+description.val(),
			complete: function(data){
				$('#autoSave').slideDown();
				draft.html(data.responseText);
				setTimeout("$('#autoSave').slideUp();",3000);
			}
		});
	}
	if(arguments[2]){
		setTimeout("saveDraft("+u+","+b+",1);", 60000);
	}
}
function bookmarkTopic(id){
	var bm = $('#bookmark');
	$.ajax({
		url: "bookmarks.php", data: "id="+id+"&add=1",
		complete: function(data){
			bm.html(data.responseText);
		}
	});
}
function removeBookmark(bookID,id){
	var book = (bookID != 0) ? $('#book'+bookID) : $('#bookmark');
	$.ajax({
		url: "bookmarks.php", data: "id="+id,
		complete: function(data){
			book.html(data.responseText);
		}
	});
}
function listenTo(boardid){
	var listen = $('#listen');
	$.ajax({
		url: "listen.php", data: "boardid="+boardid,
		complete: function(data){
			listen.html(data.responseText);
		}
	});
}
function winStat(ws){
	window.status = ws;
}
function loadIcon(id){
	$('#'+id).html("<img src=\"buttons/loading.gif\" style=\"height:16px;width:16px;\" /> Loading..");
}
function switchEdit(id,mode){
	var userPost = $('#userPost'+id);
	switch(mode){
		case 'edit':
			$.ajax({
				url: "innerpost.php", data: "id="+id,
				complete: function(data){
					userPost.html("<textarea cols=\"120\" rows=\"20\" id=\"post\" class=\"form-control\" name=\"post\" onblur=\"switchEdit("+id+",'normal');\" required=\"1\">"+data.responseText+"</textarea>");
					$('#post').focus();
				}
			});
		break;
		case 'normal':
			$.ajax({
				url: "innerpost.php", data: "id="+id+"&ubbc=1&val="+$('#post').val(),
				complete: function(data){
					userPost.html(data.responseText);
				}
			});
		break;
	}
}
function rgName(id){
	var rgID = $('#lwait');
	$.ajax({
		url: "rgdisp.php", data: "id="+id,
		complete: function(data){
			rgID.html(data.responseText);
		}
	});
}
function quickPost(e,postID){
	var k = whichKey(e);
	if(k == '13' && document.replyForm.pr.checked){
		var reply = $('#p').val();
		$.post("quickpost.php",{ id: postID, message: reply }, function(){ toLoc("?act=topic&id="+postID); });
	}
}
function searchUsers(){
	var searchFor = $('#search').val();
	var searchIn = $('#sb').val();
	$.ajax({
		url: "members.php", data: "id=1&searchIn="+searchIn+"&searchFor="+searchFor,
		complete: function(data){
			$('#result').html(data.responseText);
		}
	});
}
function searchTopics(searchCrit,searchFor){
	var subjectResults = $('#subjectResults');
	var subject = $('#subject').val();
	var tagResults = $('#tagResults');
	var tag = $('#tagSearch').val();
	var userResults = $('#userResults');
	var member = $('#user').val();
	var descResults = $('#descResults');
	var desc = $('#desc');
	$.ajax({
		url: "search_topics.php", data: "sc="+searchCrit+"&sf="+searchFor,
		complete: function(data){
			$('#'+searchFor).html(data.responseText);
		}
	});
}
function simpleSearch(){
	location.href = "?act=search&filter="+$('#filter').val();
}
function doEventSubmit(){
	var month = document.getElementById('evmonth');
	document.location.href = "?act=calendar&month="+month.options[month.selectedIndex].value;
}
function addOpt(){
	e++;
	var optArea = $('#opt_area');
	var optHTML = optArea.html();
	if(e <= 20){
		optArea.html(optHTML+"<br/>Option "+e+": <input type=\"text\" size=\"40\" name=\"opt"+e+"\" id=\"opt"+e+"\" />");
	}else{
		alert("You can't have more options than 20. Sorry!");
	}
}
function cinVal(nv){
	var cn = $('#cin');
	if(cn.val() != "Command here.."){
		cn.val(cn.val()+" "+nv+" ");
	}else{
		cn.val(nv);
	}
} 
function showMenu() {
  var sect = $('#'+arguments[0]);
  sect.slideToggle('normal');
}
function addFriend(id){
	var friendButton = $('#fbutton');
	$.ajax({
		url: "friends.php", data: "touser="+id+"&type=add",
		complete: function(data){
			friendButton.html(data.responseText);
		}
	});
}
function removeFriend(id){
	var friendButton = $('#fbutton');
	$.ajax({
		url: "friends.php", data: "touser="+id+"&type=remove",
		complete: function(data){
			friendButton.html(data.responseText);
		}
	});
	
}
function acceptFriend(id){
	var apButton = $('#results');
	$.ajax({
		url: "friends.php", data: "touser="+id+"&type=approve",
		complete: function(data){
			apButton.html(data.responseText);
		}
	});
}
function denyFriend(id){
	var deButton = $('#results');
	$.ajax({
		url: "friends.php", data: "touser="+id+"&type=deny",
		complete: function(data){
			deButton.html(data.responseText);
		}
	});
}
function topicView(v,board){
	var topicView = $('#topicView');
	$.ajax({
		url: "tview.php", data: "view="+v+"&boardid="+board,
		complete: function(data){
			topicView.html(data.responseText);
		}
	});
}
function bankAction(which){
	var ba = $('#ba');
	switch(which){
		default:
			ba.html("Invalid action.");
		break;
		case 'deposit':
			var intDeposit = $('#txtDeposit').val();
			$.ajax({
				url: "bank.php", data: "type=deposit&val="+intDeposit,
				complete: function(data){
					ba.html(data.responseText);
					$('#txtDeposit').val("");
				}
			});
		break;
		case 'withdraw':
			var intWithdraw = $('#txtWithdraw').val();
			$.ajax({
				url: "bank.php", data: "type=withdraw&val="+intWithdraw,
				complete: function(data){
					ba.html(data.responseText);
					$('#txtWithdraw').val("");
				}
			});
		break;
	}
}
function sendReq(requestType,id){
	var br = $('#bres');
	switch(requestType){
		default:
			br.html("Unsupported type");
		break;
		case 'birthday':
			msg = "I would like to have my birthday changed, please.";
		break;
	}
	$.ajax({
		url: "messages.php", data: "mode=req",
		complete: function(data){
			br.html("Request sent. An admin will message you back shortly.");
		}
	});
}
function subNav(id){
	var sn = $('#subnav');
	$.ajax({
		url: "subnavs.php", data: "check=1&type="+id,
		complete: function(data){
			sn.html(data.responseText+"<br/><a href=\"javascript:;\" onclick=\"$('#subnav').slideUp();\">close</a>");
			sn.slideDown();
		}
	});
}

function showItem(){
	var itemID = $('#m'+arguments[0]);
	var itemIMG = $('#imgItem'+arguments[0]);
	itemID.slideToggle();
	if(itemIMG.attr("src") == "buttons/bullet_add.png"){
		itemIMG.attr("src","buttons/delete.png");
	}else{
		itemIMG.attr("src","buttons/bullet_add.png");
	}
}

function nWin(strURL){
	window.open(strURL);
}

function changeIcon(){
	var itemIMG = $('#'+arguments[0]);
	itemID.slideToggle();
	if(itemIMG.attr("src") == "buttons/bullet_add.png"){
		itemIMG.attr("src","buttons/delete.png");
	}else{
		itemIMG.attr("src","buttons/bullet_add.png");
	}
}

		function xspSystem(){
			var cmd = $('#cmd');
			var ch = cmd.html();
			$.ajax({
				type: "POST", url: "runXSP.php", data: "q="+$('#cin').val(),
				complete: function(data){
					$('#cin').val("");
					var rt = data.responseText;
					cmd.html(ch+rt+"<br />");
					document.getElementById('cmd').scrollTop = document.getElementById('cmd').scrollHeight;
				}
			});
		}
function ss(strClass){
	$('#'+strClass).toggleClass('hidden');
}

function shPIN(){
	var pin = $('#txtPin');
	var pinType = pin.attr("type");
	if(pinType == "text"){
		pin.attr({
			"type" : "password"
		});
	}else{
		pin.attr({
			"type" : "text"
		});
	}
}

function chkVl(){
	var tfa = $('#tfa');
	var _2fa = $('#txt2FA');
	if(_2fa.val() == "yes"){
		tfa.css({
			"display" : "block"
		});
	}else{
		tfa.css({
			"display" : "none"
		});
	}
}
<!DOCTYPE html>
<html>
 	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 		<link rel="stylesheet" href="http://www.dreamspand.com/styles/main.css" type="text/css" media="all" />
 		<link rel="stylesheet" href="http://www.dreamspand.com/styles/skinid-8.css" type="text/css" media="all" />
 		<script type="text/javascript" src="http://www.dreamspand.com/scripts/jquery.js"></script>
 		<script type="text/javascript">
 		<!--
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
		// -->
		</script>
 		<title>XSP Console</title>
	</head>
	<body>
	<h1 style="font-style: italic;">Extensive Server Path</h1>
	<table class="table bordercolor pageContent" cellspacing="1" cellpadding="4">
		<tr>
			<th class="titlebg">XSP Console</th>
		</tr>
		<tr>
			<td class="mainbg">
				<div style="width: 885px; height: 350px; overflow-y: auto; background: #000000; color: #eeeeee; font-family: 'Verdana'; font-size: 15px; padding: 4px; font-weight: bold; text-align: left; border-radius: 5px;" id="cmd">
					<strong></strong>
				</div>
			</td>
		</tr>
		<tr>
			<td class="mainbg pageContent">
			<input type="button" onclick="$('#cmd').html('<strong></strong>')" value="Clear Screen" name="ClrScrn" />
			<br />
			You may run XSP commands by using this console.
			<form action="javascript:xspSystem();" method="post">
				<br />
				<input type="text" size="120" name="cin" value="Command here.." onfocus="(this.value=='Command here..') ? this.value='' : this.value=this.value;" onblur="(this.value!='')?this.value=this.value:this.value='Command here..';" id="cin" style="background:#000000;color:#eeeeee;" required="1" /> 
				<input type="submit" value="Run" />
			</form>
			</td>
		</tr>
	</table>
	</body>
</html>
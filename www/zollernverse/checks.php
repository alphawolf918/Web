<?php
				//Perform check for Construction Mode..
				if($sitedata["m_mode"] AND !checkPerms(2) AND !online()){
					setcookie("id","",time()-300+50);
					exit(loginForm("We're sorry, but zollernverse is currently undergoing construction, and only staff may login. If you are a staff member, please enter your information below and then be on your merry way."));
		}
				//Do guests have to log in to see the posts?
				if($sitedata["message_guests"] == 'yes' AND !online() AND $_GET["act"] != "register"){
					setcookie("id","",time()-300+50);
					exit(loginForm("Sorry, but you must currently log in to see the forums."));
				}
		//Make double sure that the user has an e-mail..
		if(online()){
			if($logged["email"] == "" AND !preg_match("/logout/i",$_SERVER["REQUEST_URI"])){
				if(isset($_POST["submit"])){
					query("UPDATE members SET email = '".$_POST["email"]."' WHERE id = '".$_COOKIE["id"]."'");
					toLoc("./");
					loguser($_COOKIE["id"],"updated their e-mail address.");
				}
				?>
				<form action="" method="post">
				<table align="center" cellspacing="0" cellpadding="4" class="bordercolor" width="780">
				<tr>
				<th class="titlebg">Update E-Mail</th>
				</tr>
				<td class="mainbg pageContent">
				Hello there! Sorry to trouble you, but it seems as though your "e-mail" field is empty, and we need you to fix that really quick. Don't worry, there's no activation e-mail or confirmation message, we just need you to update your data for us. If you've already provided an e-mail during registration, then it is possible that it was done during the early stages of development and the data was either overwritten or erased. We just need you to enter your current e-mail address into the field below, and then we'll let you be on your merry way. Thanks!<br />
				<input type="text" size="40" id="em" name="email" class="form-control" />
				<button type="submit" name="submit" id="update" class="formButton form-control">Update</button>
				</td>
				</tr>
				</table>
				</form>
				<?php
				exit;
			}
			//Security Check
			if(!$logged["secure_check"] AND !preg_match("/\?act=logout/i",$_SERVER["REQUEST_URI"])){
				$message;
				$getQandA = sql("SELECT question,answer FROM s_questions WHERE userid = '".$_COOKIE["id"]."'");
				if(isset($_POST["scSubmit"])){
					if(addslashes($_POST["answer"]) == $getQandA["answer"]){
						query("UPDATE members SET secure_check = 1 WHERE id = '".$_COOKIE["id"]."'");
						toLoc("./");
					}else{
						$message = "<strong>Wrong answer.</strong><br />";
					}
				}
					?>
				<form action="" method="post">
				<table align="center" cellspacing="1" cellpadding="4" class="bordercolor" width="780">
				<tr>
				<th class="titlebg">Security Question</th>
				</tr>
				<tr>
				<td class="mainbg2 pageContent">
				<?php echo $message; ?>
				Whoops! Looks like you've changed your password or updated some other form of security information. To continue, please answer the security question with the correct answer that you have set. Hopefully, you saved it somewhere or wrote it down. If not, simply request a <a href="?act=forgotpass" onclick="window.open(this.href);return false;">Reset Password</a> (from the Log In page when you're not logged in) e-mail.
				</td>
				</tr>
				<tr>
				<td class="mainbg pageContent">
				<?php
					echo stripslashes($getQandA["question"]);
				?>
				<br />
				<input type="text" size="40" id="em" name="answer" class="form-control" />
				</td>
				</tr>
				<tr>
				<td class="mainbg2 pageContent" align="center" ><button type="submit" name="scSubmit" id="submit" class="formButton form-control">Submit</button></td>
				</tr>
				</table>
				</form>
					<?php
			exit;
			}
			//If forced activation is turned on, and the user isn't activated, have them do so..
			if(!$logged["activated"] AND $sitedata["force_active"] AND !preg_match("/\?act=activate|\?act=resendact/i",$_SERVER["REQUEST_URI"])){
				?>
				<div class="table">
				<div class="titlebg">Activate Account</div>
				<div class="mainbg2 pageContent">Please activate your account before proceeding any further. You were provided an activation code with the e-mail that was sent to you upon registration, please enter it below:<br />
				<input type="text" size="55" name="code" id="code" />
				<input type="button" value="Go" onclick="toLoc('?act=activate&id=<?php echo $_COOKIE["id"]; ?>&code='+$('#code').val());" id="bt" name="go" />
				<hr/>
				Didn't get your activation e-mail, or maybe you lost it? No problem, <a href="?act=resendact&id=<?php echo $_COOKIE["id"]; ?>">click here to have another sent to you</a>.
				</div>
				<div class="titlebg">&nbsp;</div>
				</div>
				<?php
				exit;
			}
		}
?>
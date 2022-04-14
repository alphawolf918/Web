<?php
AuthCheck(3);
			changeTitle("IP Center");
			echo "<table class=\"table bordercolor\" cellspacing=\"1\" cellpadding=\"4\"><tr><th class=\"titlebg\">IP Center</th></tr><tr><td class=\"mainbg\"><ul><li>IP Checker - This device will list off all of the members to have ever used the IP that you enter, and every IP that was used by each username.</li></ul><form action=\"forum.php?act=ipcenter\" method=\"post\">IP:<br /><input type=\"text\" name=\"ip\" class=\"form-control\" /> <button type=\"submit\" name=\"ipcheck\" id=\"ic\" class=\"formButton form-control\">Run IP Check</button></form>";
       	                    if(isset($_POST["ipcheck"])){
       	                     $users = sql("SELECT userlist FROM ipcenter WHERE ip = '".$_POST["ip"]."'");
       	                      $userlist = explode(":",$users["userlist"]);
       	                       echo "<u>User results for <strong>".$_POST["ip"]."</strong></u><br />";
       	                        for($i=0;$i<count($userlist);$i++){
       	                         $ips = SQLQuerySelect("iplist","members","name = '".$userlist[$i]."'");
       	                          $iplist = explode(":",$ips["iplist"]);
       	                           $ipcheck = implode(", ",$iplist);
       	                            $ip_addresses = $ipcheck;
       	                             $userdata = SQLQuerySelect("id,display","members","name = '".$userlist[$i]."'");
       	                              echo ($i+1).".) ".getDisplay($userdata["id"])." (".$userlist[$i].") (".$ip_addresses.") <br />";
       	                      }
       	                     }
       	                         echo "<div class=\"brl\"></div><ul><li>Username Checker - Returns all IP Addresses ever used by the user that you enter, along with every username to have ever been associated with that IP Address.</li></ul><form action=\"\" method=\"post\">Username:<br /><input type=\"text\" name=\"user\" class=\"form-control\" /> <button type=\"submit\" class=\"formButton form-control\" name=\"usercheck\">Run Username Check</button>";
       	                          if(isset($_POST["usercheck"])){
       	                           $ips = SQLQuerySelect("iplist","members","name = '".$_POST["user"]."'");
       	                            $iplist = explode(":",$ips["iplist"]);
       	                             echo "<u>IP results for <strong>".$_POST["user"]."</strong></u>
       	                             	<div style=\"height: 25px;\"></div>";
       	                             for($r=1;$r<count($iplist);$r++){
       	                              $users = SQLQuerySelect("userlist","ipcenter","ip = '".$iplist[$r]."'");
       	                               $userlist = explode(":",$users["userlist"]);
       	                                $u = implode("</li><li>",$userlist);
       	                                 $usernames = $u;
       	                                 $userData2 = SQLQuerySelect("id, display","members","name = '".$usernames."'");
        	                          echo "<div style=\"font-weight: bold; text-decoration: underline;\">".($r).".) ".$iplist[$r]."</div><ol><li>".$usernames;
        	                          $ips2 = SQLQuerySelect("iplist","members","name = '".$usernames."'");
        	                          $iplist2 = explode(":",$ips["iplist"]);
        	                          $ipcheck2 = implode(", ",$iplist2);
        	                          $ip_addresses2 = $ipcheck2;
        	                          echo "</ol>";
       	                            }
       	                           }
       	                              echo "</td></tr></table>";
?>
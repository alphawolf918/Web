<?php
 if(!isset($_POST["submit"])):
  print("<form action=\"\" method=\"post\"><input type=\"file\" name=\"file\" /> <input type=\"submit\" value=\"Upload\" name=\"submit\" /></form>");
else:
$fp=$_FILES["file"]["name"];
move_uploaded_file($_FILES["file"]["tmp_name"],"/home/uchao3/public_html/chaotalk/") OR die("Error in uploading file!");
print "File successfully uploaded!";
endif;
?>
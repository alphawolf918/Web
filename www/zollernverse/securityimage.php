<?php
include 'functions.php';
//Generate Reference ID
if (isset($_GET["refid"]) && $_GET["refid"]!="") {
   $referenceid = stripslashes($_GET["refid"]);
} else {
   $referenceid = md5(time()*rand());
}
//Select Font
$font = "CENTAUR.ttf";
//Create Image
$im = ImageCreateFromPNG("images/bg1.png");
//Generate the random string
$chars = array("a","A","b","B","c","C","d","D","e","E","f","F","g","G",
"h","H","i","I","j","J","k",
"K","l","L","m","M","n","N","o","O","p","P","q","Q","r",
"R","s","S","t","T","u","U","v",
"V","w","W","x","X","y","Y","z","Z","1","2","3","4","5",
"6","7","8","9");
$length = 6;
$textstr = "";
for ($i=0; $i<$length; $i++) {
   $textstr .= $chars[rand(0, count($chars)-1)];
}
//Create random size, angle, and dark color
$size = rand(14, 16);
$angle = rand(-5, 5);
$color = ImageColorAllocate($im, rand(0, 100), rand(0, 100), rand(0, 100));
//Determine text size, and use dimensions to generate x & y coordinates
$textsize = imagettfbbox($size, $angle, $font, $textstr);
$twidth = abs($textsize[2]-$textsize[0]);
$theight = abs($textsize[5]-$textsize[3]);
$x = (imagesx($im)/2)-($twidth/2)+(rand(-20, 20));
$y = (imagesy($im))-($theight/2);//Add text to image
connect();
query("INSERT INTO security_images (insertdate, referenceid, hiddentext) VALUES (
now(), '".$referenceid."', '".$textstr."')");
ImageTTFText($im, $size, $angle, $x, $y, $color, $font, $textstr);
//Output PNG Image
header("Content-Type: image/png");
ImagePNG($im);//Destroy the image to free memory
?>
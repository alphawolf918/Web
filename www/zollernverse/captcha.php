<?php
session_start();  
$string = '';  
for ($i = 0; $i < 6; $i++) {  
	$string .= chr(rand(97, 122));  
}  
include 'functions.php';
connect();
$_SESSION['random_code'] = $string;
$Scheck = sql("SELECT id FROM security_images WHERE referenceid = '".$_COOKIE["PHPSESSID"]."'");
if($Scheck["id"] == ""){
	query("INSERT INTO security_images(referenceid,hiddentext)VALUES('".$_COOKIE["PHPSESSID"]."','".$_SESSION["random_code"]."')");
}else{
	query("UPDATE security_images SET hiddentext = '".$string."' WHERE referenceid = '".$_COOKIE["PHPSESSID"]."'");
}
$dir = 'fonts/';
$fontList = array("monofont","verdana");
$r = mt_rand(0,240);
$g = mt_rand(0,240);
$b = mt_rand(0,240);
$randomFont = mt_rand(0,(count($fontList)-1));
$image = imagecreatetruecolor(190, 80);
$black = imagecolorallocate($image, 0, 0, 0);  
$color = imagecolorallocate($image, $r, $g, $b); // random  
$white = imagecolorallocate($image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255)); 
imagefilledrectangle($image,0,0,200,100,$white);
$angle = mt_rand(-10,20);
$size = mt_rand(25,28);
$x = mt_rand(-5,25);
$y = mt_rand(50,55);
//echo $fontList[$randomFont];
imagettftext($image, $size, $angle, $x, $y, $color, $dir.$fontList[$randomFont].".ttf", $_SESSION['random_code']);  
header("Content-type: image/png");
imagepng($image);
?>
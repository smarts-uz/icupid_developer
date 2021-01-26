<?php
/*
* Author : Ali Aboussebaba
* Email : bewebdeveloper@gmail.com
* Website : http://www.bewebdeveloper.com
* Subject : Crop photo using PHP and jQuery
*/
header('Access-Control-Allow-Origin: *');
//error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
// Target siz
$targ_w = $_REQUEST['targ_w'];
$targ_h = $_REQUEST['targ_h'];
 
// quality
$jpeg_quality = 90;
// photo path
$src = $_REQUEST['photo_url'];
//$photo_dest="../uploads/thumbs/";

list($width, $height) = getimagesize('../'.$src);
 
$src = '../'.$src ;

// create new jpeg image based on the target sizes
$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
// crop photo
imagecopyresampled($dst_r,$img_r,0,0,$_REQUEST['x'],$_REQUEST['y'], $width,$height,$width,$height);
// create the physical photo
imagejpeg($dst_r,$src,$jpeg_quality);
// display the  photo - "?time()" to force refresh by the browser
//echo '<img src="https://advandate.biz/'.$src.'?'.time().'">';
exit;
?>

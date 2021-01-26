<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$title = $_GET['title'];
$comment = $_GET['comment'];
$albmprivacy = $_GET['albmprivacy'];
$hot = $_GET['hot'];
$frnd = $_GET['frnd'];
$ser = $_GET['ser'];
$aid = $_GET['aid'];

if($ser == '1')
{
$DB->Insert("UPDATE `album` SET `title`='".$title."', `comment`='".$comment."', `cat`='".$albmprivacy."', `allow_f`='".$frnd."', `allow_h`='".$hot."', `date`='".DATE_NOW."', `time`='".TIME_NOW."' WHERE `uid`='".$iId."' AND  `aid`='".$aid."'");
}
else {

  $DB->Insert("INSERT INTO `album` ( `uid` , `title` , `comment` , `cat` , `allow_f` , `allow_h` , `allow_n` , `allow_a` , `date`, `time` )
  VALUES ('".$iId."', '".$title."' , '".$comment."', '".$albmprivacy."', '".$frnd."', '".$hot."', 'n', 'n', '".DATE_NOW."', '".TIME_NOW."')");

  }
$arrData[0] = new StdClass;
$arrData[0]->status = 'success-'.$ser ;
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

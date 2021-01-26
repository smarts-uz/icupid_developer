<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$rId = $_GET['rid'];
$sub = $_GET['sub'];
$msg = $_GET['msg'];

$DB->Insert("INSERT INTO `messages` ( `uid` , `mailnum` , `mail2id` , `mailstatus` , `maildate` , `mailtime` , `mail_subject` , `mail_message` , `mail_displayalert`, `my_box`, `to_box`, `type` )
VALUES ('".$iId."', NULL , '".$rId."', 'unread', '".DATE_NOW."', '".TIME_NOW."', '".$sub."', '".$msg."', '1', 'sent', 'inbox', 'wink')");

$arrData[0] = new StdClass;
$arrData[0]->status = 'success';
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

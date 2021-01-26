<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){

 $iId = $_GET['uid'];

 $DB->Update("UPDATE `members` SET `email` = '".$_GET['email']."' WHERE id = ( '".$iId."' ) LIMIT 1");

 $DB->Update("UPDATE `members_privacy` SET `Newsletters` = '".$_GET['newsletters']."', `Notifications` = '".$_GET['notifications']."', `email_winks` = '".$_GET['email_winks']."', `email_msg` = '".$_GET['email_msg']."', `email_friends` = '".$_GET['email_friends']."', `email_match` = '".$_GET['email_match']."' WHERE `uid` = ".$iId." LIMIT 1");

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

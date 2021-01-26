<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT * FROM members_privacy WHERE uid ='".$iId."' LIMIT 1");


     $arrData[0] = new StdClass;
     $arrData[0]->newsletters = $MData['Newsletters'];
     $arrData[0]->notifications = $MData['Notifications'];
     $arrData[0]->email_winks = $MData['email_winks'];
     $arrData[0]->email_msg = $MData['email_msg'];
     $arrData[0]->email_friends = $MData['email_friends'];
     $arrData[0]->email_match = $MData['email_match'];

     $re3 = $DB->Row("SELECT email FROM members WHERE id = '".$iId."' LIMIT 1");
   if($re3)
     $arrData[0]->email = $re3['email'];
     else
     $arrData[0]->email = "";

    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

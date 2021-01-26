<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$ser = $_GET['ser'];
if($ser == 'sent')
{
  $sSql = "SELECT * FROM `messages` WHERE `uid` = '$iId' ORDER BY `mailnum` DESC";
}
else if($ser == 'trash')
{
  $sSql = "SELECT * FROM `messages` WHERE `mail2id` = '$iId' AND `to_box` = '$ser' ORDER BY `mailnum` DESC";
}
else
{
$sSql = "SELECT * FROM `messages` WHERE `mail2id` = '$iId' AND `type` = '$ser' AND `to_box` = 'inbox' ORDER BY `mailnum` DESC";
}

 require_once("ion_app_function.php");
 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {
    // user Data

     if($ser == 'sent')
     {
       $mad = MemberAccountDetails($row['mail2id']);
     }
     else
     {
     $mad = MemberAccountDetails($row['uid']);
     }
     $arrData[$i] = new StdClass;
     $arrData[$i]->uid = $row['uid'];
     $arrData[$i]->thumb_large = $mad['image'];
     $arrData[$i]->thumb_small = $mad['image_small'];
     $arrData[$i]->mailstatus = $row['mailstatus'];
     $arrData[$i]->mail_subject = $row['mail_subject'];
     $arrData[$i]->mail_message = $row['mail_message'];
     $arrData[$i]->mailtime = $row['mailtime'];
     $arrData[$i]->username = $mad['username'];
     $arrData[$i]->mailnum = $row['mailnum'];

     $i++;

 }

    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

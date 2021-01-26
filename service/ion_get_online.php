<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$un = $_GET['un'];
//AND members_network.approved = 'yes'
$sSql = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location FROM members_online LEFT JOIN members ON ( members_online.logid = members.id ) LEFT JOIN files ON ( files.uid = members_online.logid AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members_online.logid ) WHERE members.id != '".$iId."' GROUP BY members.id ORDER BY members.lastlogin";
 //require_once("ion_app_function.php");
 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {
    $strLoc = '';
   if($row['location'] != '0')
   $strLoc = $row['location'];

     $arrData[$i] = new StdClass;
     $arrData[$i]->uid = $row['id'];
     $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
     $arrData[$i]->username = $row['username'];
     $arrData[$i]->location = $strLoc;
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

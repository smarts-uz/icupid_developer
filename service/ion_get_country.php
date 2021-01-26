<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
//AND members_network.approved = 'yes'
$sSql = "SELECT fvid, fvCaption FROM `field_list_value` WHERE `fvFid` = 25 AND `linked_cap_id` = 0 ORDER BY `field_list_value`.`fvCaption` ASC";

// require_once("ion_app_function.php");

 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {
    // user Data
//$mad = MemberAccountDetails($row['mid']);

     $arrData[$i] = new StdClass;
     $arrData[$i]->id = $row['fvid'];
     $arrData[$i]->name = $row['fvCaption'];
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

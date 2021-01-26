<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
//AND members_network.approved = 'yes'
$sSql = "SELECT `fid`, `matchpage` FROM `field` WHERE `fid` IN (28,29,20,23,25,54,26,51,50,49,48,46,30,42,43,44,31,32,33,34,36,38,39,40,41,35) ORDER BY fOrder";

// require_once("ion_app_function.php");

 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {
    // user Data
//$mad = MemberAccountDetails($row['mid']);

     $arrData[$i] = new StdClass;
     $arrData[$i]->id = $row['fid'];
     $arrData[$i]->matchpage = $row['matchpage'];
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

<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
//AND members_network.approved = 'yes'
$sSql = "SELECT * FROM `package` WHERE `view_adult` = 'yes'";
 //require_once("ion_app_function.php");
 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {

     $arrData[$i] = new StdClass;
     $arrData[$i]->pid = $row['pid'];
     $arrData[$i]->name = $row['name'];
     $arrData[$i]->price = $row['price'];
     $arrData[$i]->c_code = $row['currency_code'];
     $arrData[$i]->months = floor(($row['numdays'] / 30));
     $arrData[$i]->max_files = $row['maxFiles'];
     $arrData[$i]->max_messages = $row['maxMessage'];
     $arrData[$i]->wink = $row['wink'];
     $arrData[$i]->featured = $row['Featured'];
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

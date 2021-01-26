<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_POST){

$profile = $_POST;

mysql_query("UPDATE members_data SET `em_y8520080116` = '".$profile['musical']."', `em_grm20080116` = '".$profile['favourite']."' WHERE `uid` = '".$profile['uid']."'");


$arrData[0] = new StdClass;
$arrData[0]->status = "success";
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}

?>

<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$id = $_GET['id'];
$aid = $_GET['aid'];

mysql_query("DELETE FROM `files` WHERE `uid` = '$iId' AND `id` = '$id'");
mysql_query("UPDATE album SET `filecount` = `filecount`-1 WHERE `aid` = '".$aid."'");
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
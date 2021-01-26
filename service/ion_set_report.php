<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){

 $iId = $_GET['uid'];
 $sId = $_GET['sid'];
	
  $DB->Update("INSERT INTO members_reported SET `uid` ='".$iId."', `to_uid` = '".$sId."',`date` ='".DATE_NOW."'");

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

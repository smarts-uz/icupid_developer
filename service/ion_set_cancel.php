<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){

 $iId = $_GET['uid'];

 $DB->Update("UPDATE members SET active='cancel' WHERE id = ( '".$iId."' ) LIMIT 1");

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

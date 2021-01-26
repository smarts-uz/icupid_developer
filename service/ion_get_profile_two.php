<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT em_y8520080116, em_grm20080116 FROM members_data WHERE uid= ( '".$iId."' ) LIMIT 1");

$musical = str_replace(1,"true",$MData['em_y8520080116']);
$favourite = str_replace(1,"true",$MData['em_grm20080116']);

$musicals = str_replace(0,"false",$musical);
$favourites = str_replace(0,"false",$favourite);

$musicalss = explode("**", $musicals);
$favouritess = explode("**", $favourites);

     $arrData[0] = new StdClass;
     $arrData[0]->musical = $musicalss;
     $arrData[0]->favourite = $favouritess;

    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}

?>

<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT em_txg20080113, em_72220080113, em_kjc20080113, em_s1620080113, em_rn620080113, em_kxb20080113, em_qck20080113, em_r9720080113 FROM members_data WHERE uid= ( '".$iId."' ) LIMIT 1");


     $arrData[0] = new StdClass;
     $arrData[0]->religion = $MData['em_txg20080113'];
     $arrData[0]->employment = $MData['em_72220080113'];
     $arrData[0]->income = $MData['em_kjc20080113'];
     $arrData[0]->education = $MData['em_s1620080113'];
     $arrData[0]->wantchildren = $MData['em_rn620080113'];
     $arrData[0]->havechildren = $MData['em_kxb20080113'];
     $arrData[0]->personality = $MData['em_qck20080113'];
     $arrData[0]->romantic = $MData['em_r9720080113'];


    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}

?>

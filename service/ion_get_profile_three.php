<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT em_1k820080113, em_heh20080113, em_93n20080113, em_jsh20080113, em_jhb20080113, em_yh020080113, em_7jr20080113, em_wvh20080113, em_vqf20080113 FROM members_data WHERE uid= ( '".$iId."' ) LIMIT 1");


     $arrData[0] = new StdClass;
     $arrData[0]->yheight = $MData['em_1k820080113'];
     $arrData[0]->ybuild = $MData['em_heh20080113'];
     $arrData[0]->hcolor = $MData['em_93n20080113'];
     $arrData[0]->ecolor = $MData['em_jsh20080113'];
     $arrData[0]->hlength = $MData['em_jhb20080113'];
     $arrData[0]->methnicity = $MData['em_yh020080113'];
     $arrData[0]->pappearance = $MData['em_7jr20080113'];
     $arrData[0]->mstyle = $MData['em_wvh20080113'];
     $arrData[0]->afeature = $MData['em_vqf20080113'];


    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}

?>

<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT members_online.logid AS onlinenow, members_data.headline, members_data.description, members_data.age, members_data.gender, members_data.country, members_data.em_85820081128, members_data.em_8cx20070511, members_data.location, members_data.postcode, members_data.em_hrh20080113 FROM members_data LEFT JOIN members_online ON ( members_data.uid = members_online.logid ) WHERE uid= ( '".$iId."' ) LIMIT 1");


     $arrData[0] = new StdClass;
     $arrData[0]->headline = $MData['headline'];
     $arrData[0]->description = $MData['description'];
     $arrData[0]->age = getRDate($MData['age']);
     $arrData[0]->gender = $MData['gender'];
     $arrData[0]->marital = $MData['em_hrh20080113'];
     $arrData[0]->sexuality = $MData['em_8cx20070511'];
     $arrData[0]->country = $MData['country'];
     $arrData[0]->countryV = getCaption($MData['country']);
     $arrData[0]->state = $MData['em_85820081128'];
     $arrData[0]->stateV = getCaption($MData['em_85820081128']);
     $arrData[0]->location = $MData['location'];
     $arrData[0]->postcode = $MData['postcode'];


    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
function getCaption($id){
global $DB;
  $re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."' LIMIT 1");
if($re3)
  return $re3['fvCaption'];
  else
  return $id;
}
function getRDate($bdate){
  $arrBirthday = explode("-", $bdate);

    $cmonth = $arrBirthday[1];

  	switch($cmonth){

  		case "JAN": { $month ="01"; } break;

  		case "FEB": { $month ="02"; } break;

  		case "MAR": { $month ="03"; } break;

  		case "APR": { $month ="04"; } break;

  		case "MAY": { $month ="05"; } break;

  		case "JUN": { $month ="06"; } break;

  		case "JUL": { $month ="07"; } break;

  		case "AUG": { $month ="08"; } break;

  		case "SEP": { $month ="09"; } break;

  		case "OCT": { $month ="10"; } break;

  		case "NOV": { $month ="11"; } break;

  		case "DEC": { $month ="12"; } break;

  	}

  return $arrBirthday[0]."/".$month."/".$arrBirthday[2];
}

?>

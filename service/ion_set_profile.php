<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_POST){

$profile = $_POST;

$ndate = explode(" ", $profile['age']);
$age = $ndate[3]."-".strtoupper($ndate[1])."-".$ndate[2];

mysql_query("UPDATE members_data SET `headline` = '".$profile['headline']."', `description` = '".$profile['description']."', `age` = '".$age."', `gender` = '".$profile['gender']."', `em_hrh20080113` = '".$profile['marital']."', `em_8cx20070511` = '".$profile['sexuality']."', `country` = '".$profile['country']."', `em_85820081128` = '".$profile['state']."', `location` = '".$profile['location']."', `postcode` = '".$profile['postcode']."' WHERE `uid` = '".$profile['uid']."'");


$arrData[0] = new StdClass;
$arrData[0]->status = 'success'.$age;
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
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

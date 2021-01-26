<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$sex = intval($_GET['sex']);
$age = intval($_GET['age']);
$to = intval($_GET['to']);

$date1 = time();//strtotime($user_data[13]); // date when age was recorded
$time1 = $age*31556926; // calculating age in seconds
$time2 = $to*31556926; // calculating age in seconds
$dob1 = $date1 - $time1; // getting the timestamp for his / her date of birth
$dob2 = $date1 - $time2; // getting the timestamp for his / her date of birth
$dob_age = explode("-",date("Y-m-d",$dob1)); // getting the date of birth here
$dob_age1 = explode("-",date("Y-m-d",$dob2)); // getting the date of birth here
$dob_age[0];
$dob_age1[0];

$qerySex = "AND members_data.age < ".$dob_age[0]." AND members_data.age > ".$dob_age1[0];

if($sex != 0)
{
  $qerySex .= " AND members_data.gender = '".$sex."'";
}
// $pcode = '10001';
// $pradi = 50;
// $re = $DB->Row("SELECT postcode FROM members_data WHERE uid='".strip_tags($iId)."' LIMIT 1");
// if($re)
// $pcode = $re['postcode'];

$plat = '40.712784';
$plan = '-74.005941';
//$re1 = $DB->Row("SELECT lattitude, longitude FROM zip_code WHERE zip_code = '".strip_tags($pcode)."' LIMIT 1");
// if($re1){
// $plat = $re1['lattitude'];
// $plan = $re1['longitude'];
// }



$sSql = "SELECT DISTINCT members.id, members.username, members.ip_lat, members.ip_long, files.bigimage FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) WHERE members.id NOT IN(SELECT `to_uid` FROM `members_meetme` WHERE `uid` = '$iId') AND members.id NOT IN(SELECT `to_uid` FROM `members_network` WHERE `uid`  = '$iId') AND members.id NOT IN(SELECT `uid` FROM `members_network` WHERE `to_uid`  = '$iId') AND members.id != '".$iId."' AND members.id != '0' ".$qerySex." ORDER BY members.lastlogin LIMIT 15";
//echo $sSql;
$result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {

   $latitude = (float) 40.712784;
   $longitude = (float) -74.005941;
   $radius = rand(7,1500); // in miles

   $lat_min = $latitude - ($radius / 69);
   $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);

     $arrData[$i] = new StdClass;
     $arrData[$i]->uid = $row['id'];
     $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
     $arrData[$i]->username = $row['username'];
     $arrData[$i]->lat = $lat_min;
     $arrData[$i]->lon = $lng_min;
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

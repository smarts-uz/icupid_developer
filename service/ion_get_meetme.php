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

$sSql = "SELECT DISTINCT members.id, members.username, members.email, files.bigimage, files.width, files.height, members_data.location, members_data.age, members_data.em_85820081128, members_data.country FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) WHERE members.id NOT IN(SELECT `to_uid` FROM `members_meetme` WHERE `uid` = '$iId') AND members.id NOT IN(SELECT `to_uid` FROM `members_network` WHERE `uid`  = '$iId') AND members.id NOT IN(SELECT `uid` FROM `members_network` WHERE `to_uid`  = '$iId') AND members.id != '".$iId."' AND members.id != '0' ".$qerySex." ORDER BY members.lastlogin LIMIT 1";

$result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {

   $strLoc = '';
   if($row['em_85820081128'] != 0)
   $strLoc = ', '.getCaption($row['em_85820081128']);

     $arrData[$i] = new StdClass;
     $arrData[$i]->uid = $row['id'];
     $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage']."&t=i&x=".$row['width']."&y=".$row['height'];
     $arrData[$i]->username = $row['username'];
     $arrData[$i]->email = $row['email'];
     $arrData[$i]->age = ', age '.MakeAge($row['age']);
     $arrData[$i]->location = $row['location'].$strLoc.', '.getCaption($row['country']);
     //$arrData[$i]->qerysex = $sSql;
     $i++;

 }

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
function MakeAge($birthday){

        $birth = explode("-", $birthday);
if(isset($birth[1])){
    switch($birth[1]){
      case "JAN": { $MM = "01"; } break;
      case "FEB": { $MM = "02"; } break;
      case "MAR": { $MM = "03"; } break;
      case "APR": { $MM = "04"; } break;
      case "MAY": { $MM = "05"; } break;
      case "JUN": { $MM = "06"; } break;
      case "JUL": { $MM = "07"; } break;
      case "AUG": { $MM = "08"; } break;
      case "SEP": { $MM = "09"; } break;
      case "OCT": { $MM = "10"; } break;
      case "NOV": { $MM = "11"; } break;
      case "DEC": { $MM = "12"; } break;
      default: { return 21; }
    }
}else{
$MM = "12";
}

  $day =$birth[2];
  $month =$MM;
  $year =$birth[0];

  $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;

  if ($month_diff < 0) $year_diff--;
        elseif (($month_diff==0) && ($day_diff < 0))$year_diff--;
##        elseif (($month_diff==0) && ($day_diff >= 0))$year_diff++;
        return $year_diff;

}
?>

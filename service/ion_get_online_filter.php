<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$afrom = $_GET['afrom'];
$ato = $_GET['ato'];
$seeking = $_GET['seeking'];
//AND members_network.approved = 'yes'
$sSql = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location, files.bigimage, members_data.age FROM members_online LEFT JOIN members ON ( members_online.logid = members.id ) LEFT JOIN files ON ( files.uid = members_online.logid AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members_online.logid ) WHERE members.id != '".$iId."' AND members_data.gender != '".$seeking."' GROUP BY members.id ORDER BY members.lastlogin";
 //require_once("ion_app_function.php");
 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {

$age = MakeAge($row['age']);
if($afrom){
if($age > $afrom &&  $age < $ato)
{
     $arrData[$i] = new StdClass;
     $arrData[$i]->uid = $row['id'];
     $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
     $arrData[$i]->username = $row['username'];
     $arrData[$i]->location = $row['location'];
     //$arrData[$i]->age = $age;
     $i++;
}
 }
 else
 {
   $arrData[$i] = new StdClass;
   $arrData[$i]->uid = $row['id'];
   $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
   $arrData[$i]->username = $row['username'];
   $arrData[$i]->location = $row['location'];
   //$arrData[$i]->age = $age;
   $i++;
 }
 }


    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
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

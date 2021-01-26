<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$sSql = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location, members_data.age, members_network.approved, members_network.id AS cid FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) LEFT JOIN members_network ON ( members_network.uid = members.id OR members_network.to_uid = members.id ) WHERE members_network.to_uid='".$iId."' AND members.id !='".$iId."' AND members.id != '0' AND members_network.approved = 'no' LIMIT 0, 100";


 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {
	 $strLoc = '';
   if($row['location'] != '0')
   $strLoc = $row['location'];

        $arrData[$i] = new StdClass;
		$arrData[$i]->cid = $row['cid'];
        $arrData[$i]->uid = $row['id'];
        $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
        $arrData[$i]->username = $row['username'];
        $arrData[$i]->location = $strLoc;
		$arrData[$i]->approved = $row['approved'];
        $arrData[$i]->age = MakeAge($row['age']);
        $i++;

 }
    //$arrData[0]->pics = $pics;
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

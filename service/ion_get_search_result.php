<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$un = $_GET['un'];
$ids = $_GET['ids'];
$title = $_GET['title'];
//AND members_network.approved = 'yes'
if($ids = "username")
{
$sSql = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location, members_data.age, members_data.gender, members_data.country FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) WHERE members.id != '".$iId."' AND members.username LIKE '%".$title."%' GROUP BY members.id ORDER BY members.lastlogin";
}
else {
$sSql = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location, members_data.age, members_data.gender, members_data.country FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) WHERE members.id != '".$iId."' AND members.username LIKE '%".$title."%' OR members.email LIKE '%".$title."%' OR members_data.location LIKE '%".$title."%' OR members_data.country LIKE '%".$title."%' OR members_data.description LIKE '%".$title."%' GROUP BY members.id ORDER BY members.lastlogin";
}
 //require_once("ion_app_function.php");
 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {
    // user Data
//$mad = MemberAccountDetails($row['mid']);

     $arrData[$i] = new StdClass;
     $arrData[$i]->uid = $row['id'];
     $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
     $arrData[$i]->username = $row['username'];
     $arrData[$i]->location = $row['location'];
     $arrData[$i]->age = MakeAge($row['age']);
     $arrData[$i]->gender = MakeGender($row['gender']);
     $arrData[$i]->country = MakeCountry($row['country']);
     $i++;

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
function MakeGender($id){

	global $DB;

	if(!is_numeric($id)){

	return $id;

	}elseif($id == 0 || $id == ""){

		return "na";

	}else{

		if(isset($_SESSION['gender'][$id]['name'])){

		return $_SESSION['gender'][$id]['name'];

		}else{

			$re3 = $DB->Row("SELECT id,fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."'  AND lang='".$_SESSION['lang']."' LIMIT 1");
			$_SESSION['gender'][$re3['id']]['name'] = $re3['fvCaption'];
			return $re3['fvCaption'];
		}
	}

}
function MakeCountry($id){

  	global $DB;

  	if(!is_numeric($id)){

  	return $id;

  	}elseif($id == 0 || $id == ""){

  		return "na";

  	}else{

  		$SaveID =$id;

  		if (1==2) {

  		return $_SESSION['country'][$SaveID]['name'];

  		}else{

  			$Extra ="";

  			$re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."'  ".$Extra." AND lang='".D_LANG."' LIMIT 1");

  			if(empty($re3)){
  			$re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."' ".$Extra." LIMIT 1");
  			}

  			$_SESSION['country'][$SaveID]['name'] = $re3['fvCaption'];
  			return $re3['fvCaption'];
  		}
  	}

}
?>

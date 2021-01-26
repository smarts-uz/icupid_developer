<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
require_once("ion_app_function.php");
$match_profile_array = GetProfileData($iId,'',1);
// if($_GET['sexuality']){
//   $sexuality = " AND members_data.em_8cx20070511 = '".$_GET['sexuality']."' ";
// }

//$sSql = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location, members_data.age FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) WHERE members.id != '".$iId."' AND members_data.gender = '".$_GET['seeking']."' OR members_data.em_8cx20070511 = '".$_GET['sexuality']."' OR members_data.country = '".$_GET['country']."' OR members_data.em_85820081128 = '".$_GET['state']."' LIMIT 0, 100";
$sSql = "SELECT DISTINCT members.id, members.username, files.bigimage, members_data.location, members_data.age, members_data.gender, members_data.country FROM members LEFT JOIN files ON ( files.uid = members.id AND files.default=1) LEFT JOIN members_data ON ( members_data.uid = members.id ) WHERE members.id = '".$iId."' LIMIT 1";

 //require_once("ion_app_function.php");
 //echo json_encode($sSql, JSON_UNESCAPED_SLASHES);
 $result = mysql_query($sSql);

      $i = 0;
while ($row = mysql_fetch_assoc($result))
 {


      $arrData[$i] = new StdClass;
      $arrData[$i]->uid = $row['id'];
      $arrData[$i]->thumb = DB_DOMAIN."inc/tb.php?src=".$row['bigimage'];
      $arrData[$i]->username = $row['username'];
      $arrData[$i]->location = $row['location'];
      $arrData[$i]->age = MakeAge($row['age']);
      $arrData[$i]->gender = MakeGender($row['gender']);
      $arrData[$i]->country = MakeCountry($row['country']);
      $arrData[$i]->msg = $match_profile_array;
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

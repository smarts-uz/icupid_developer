<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

$arrData = array();
if($_GET){
$iId = $_GET['uid'];
$netid	= $_GET['nid'];  // package id
$id = $_GET['sid'];  // package id

// MEMBERS CAN ONLY HAVE ONE PROFILE

$result = $DB->Row("SELECT count(id) AS found FROM members_network WHERE uid='".$iId."' AND to_uid='".$id."'  AND TYPE <> 5 LIMIT 1");

if($result['found']  > 0){

  $arrData[0] = new StdClass;
  $arrData[0]->status = 'success';

}else{


    $val = $DB->Row("SELECT members.username, members.email, members_privacy.friends FROM members_privacy
    INNER JOIN members ON (members_privacy.uid = members.id )
    WHERE members_privacy.uid=('".$id."') LIMIT 1");


    // MAKE BLOCKED AND HOTLIST MEMBERS AUTO APPROVED
    if($netid ==1 || $netid ==3){
      $app = "yes";

    }else{
      // CHECK IF THIS MEMBER HAS SET THEIR PRIVACY
      // TO AUTO ACCEPT NEW FRIEND REQUESTS
      $app = $val['friends'];
    }

    // FIX FOR CHECKING IF THE MEMBER ALREADY IS LISTED ON THE NETWORK
    $fix = $DB->Row("SELECT approved FROM members_network WHERE to_uid='".$iId."' AND uid='".$id."' LIMIT 1");
    if(!empty($fix)){	$app="yes";		}

    // IF BLOCKING MEMBER REMOVE THEM FROM FRIENDS LISTS
    if($netid ==3){
      $DB->Insert("DELETE FROM members_network WHERE uid='".$_SESSION['uid']."' AND to_uid='".$id."' ");
      $DB->Insert("DELETE FROM members_network WHERE uid='".$id."' AND to_uid='".$iId."' ");
    }

    // ADD DATABASE ITEM
    $DB->Update("INSERT INTO `members_network` ( `id` , `uid` , `to_uid` , `date` , `comments` , `type`, approved )
    VALUES (NULL , '".$iId."', '".$id."', NOW(), '', '".$netid."', '".$app."')");

    // SEND THEM AN EMAIL
    if($netid ==2){ // dont send if its a block list value

      $val['custom']  = "<a href='".DB_DOMAIN."index.php?dll=friends'>".DB_DOMAIN."index.php?dll=friends</a>"; // Must be above the admin_email

      $val['username'] =  $val['username'];
      $val['from_username'] =  $iId;
      SendTemplateMail($val, 33);

    }

    $arrData[0] = new StdClass;
    $arrData[0]->status = 'success';



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

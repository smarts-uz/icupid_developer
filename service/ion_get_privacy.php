<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT * FROM members_privacy WHERE uid ='".$iId."' LIMIT 1");


     $arrData[0] = new StdClass;
     $arrData[0]->im = $MData['IM'];
     $arrData[0]->friends = $MData['friends'];
	 $arrData[0]->comments = $MData['comments'];
     $arrData[0]->adult = $MData['adult_content'];
     $arrData[0]->timezone = $MData['Time Zone'];
     $arrData[0]->skype = $MData['skype'];

    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
function getCaption($id){
global $DB;
  $re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."' AND lang='".D_LANG."' LIMIT 1");
if($re3)
  return $re3['fvCaption'];
  else
  return $id;
}
?>

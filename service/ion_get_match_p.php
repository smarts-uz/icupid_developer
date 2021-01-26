<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();
if($_GET){
$iId = $_GET['uid'];

$MData = $DB->Row("SELECT match_array FROM members_privacy WHERE uid= ( '".$iId."' ) LIMIT 1");
$get_myarray = unserialize($MData['match_array']);
if($MData['match_array'])
{
	  $i = 0;
	  foreach($get_myarray as $row){

		 $arrData[$i] = new StdClass;
		 $arrData[$i]->name = $row['caption'];
		 $arrData[$i]->value = getCaption($row['value']);
		 $arrData[$i]->vid = $row['value'];
		 $arrData[$i]->cap = $row['name'];
		 $i++;

	 }
    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
	}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->status = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
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

<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
$arrData = array();
global $DB;

      $MData = $DB->Query("SELECT `fid`,`required`,`fName` FROM `field` WHERE `groupid` != 13 ORDER BY `fOrder`");
      $nData = array();
      $i = 0;
      while( $Data = $DB->NextRow($MData) )
      {

           $nData[$i] = new StdClass;
           $nData[$i]->fid = $Data['fid'];
           $nData[$i]->required = $Data['required'];
           $nData[$i]->fname =  getFields($Data['fid']);
          //  $nData[$i]->descriptionFF = getFields(27);
          //  $nData[$i]->age = $row['age'];
          //  $nData[$i]->ageFF = getFields(23);
          //  $nData[$i]->gender = $row['MyGender'];
          //  $nData[$i]->genderFF = getFields(28);
          //  $nData[$i]->marital = getCaption($MData['em_hrh20080113']);
          //  $nData[$i]->maritalFF = getFields(29);
           $i++;
     	}
      $arrData[0] = new StdClass;
      $arrData[0]->required = $nData;
      $arrData[0]->country = getCountry();


    echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

function getCaption($id){
global $DB;
  $re3 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid='".strip_tags($id)."' LIMIT 1");
if($re3)
  return $re3['fvCaption'];
  else
  return $id;
}
function getFields($id){
global $DB;
  $re3 = $DB->Row("SELECT `caption` FROM `field_caption` WHERE `lang` LIKE 'english' AND `match` = 'no' AND `Cid` = '".$id."' ORDER BY `Cid` ASC");
if($re3)
  return $re3['caption'];
  else
  return $id;
}
function getCountry(){
  global $DB;
  $MData = $DB->Query("SELECT fvid, fvCaption FROM `field_list_value` WHERE `fvFid` = 25 AND `linked_cap_id` = 0 ORDER BY `field_list_value`.`fvCaption` ASC");
  $nData = array();
  $i = 0;
  while( $Data = $DB->NextRow($MData) )
  {

    $nData[$i] = new StdClass;
    $nData[$i]->id = $Data['fvid'];
    $nData[$i]->name = $Data['fvCaption'];
    $i++;
  }
  return $nData;
}
?>

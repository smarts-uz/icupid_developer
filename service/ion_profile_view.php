<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
require_once("../inc/API/api_functions.php");
$arrData = array();
if($_GET){
$iId = $_GET['uid'];
//$match_profile_array = GetProfileData($iId,'',1);

$row = MemberAccountDetails($iId, false,"profile");

      $i = 0;
      $arrData[$i] = new StdClass;
      $arrData[$i]->uid = $iId;
      $arrData[$i]->thumb = $row['image'];
      $arrData[$i]->username = $row['username'];
      $arrData[$i]->status = $row['status'];
      $arrData[$i]->details = $row['age']." years old (".$row['starsign']."), ".$row['MyGender'];
      $arrData[$i]->location = $row['location']." ".$row['country'];
      $arrData[$i]->visible = $row['visible'];
      $arrData[$i]->member = $row['name'];
      $arrData[$i]->lastlogin = ShowTimeSince($row['lastlogin']);
      $arrData[$i]->description = $row['description'];
      $arrData[$i]->complete = $row['profile_complete'];

      $MData = $DB->Row("SELECT * FROM members_data LEFT JOIN members_online ON ( members_data.uid = members_online.logid ) WHERE uid= ( '".$iId."' ) LIMIT 1");

           $i = 1;
           $arrData[$i] = new StdClass;
           $arrData[$i]->headline = $MData['headline'];
           $arrData[$i]->headlineFF = getFields(24);
           $arrData[$i]->description = $row['description'];
           $arrData[$i]->descriptionFF = getFields(27);
           $arrData[$i]->age = $row['age'];
           $arrData[$i]->ageFF = getFields(23);
           $arrData[$i]->gender = $row['MyGender'];
           $arrData[$i]->genderFF = getFields(28);
           $arrData[$i]->marital = getCaption($MData['em_hrh20080113']);
           $arrData[$i]->maritalFF = getFields(29);
           $arrData[$i]->sexuality = getCaption($MData['em_8cx20070511']);
           $arrData[$i]->sexualityFF = getFields(20);
           $arrData[$i]->country = getCaption($MData['country']);
           $arrData[$i]->countryFF = getFields(25);
           $arrData[$i]->state = getCaption($MData['em_85820081128']);
           $arrData[$i]->stateFF = getFields(54);
           $arrData[$i]->city = $row['location'];
           $arrData[$i]->cityFF = getFields(26);
           $arrData[$i]->postcode = $MData['postcode'];
           $arrData[$i]->postcodeFF = getFields(21);
      //$arrData[$i]->msg = $match_profile_array;
      $i = 2;
      $arrData[$i] = new StdClass;
      $arrData[$i]->religion = getCaption($MData['em_txg20080113']);
      $arrData[$i]->religionFF = getFields(51);
      $arrData[$i]->employment = getCaption($MData['em_72220080113']);
      $arrData[$i]->employmentFF = getFields(50);
      $arrData[$i]->income = getCaption($MData['em_kjc20080113']);
      $arrData[$i]->incomeFF = getFields(49);
      $arrData[$i]->education = getCaption($MData['em_s1620080113']);
      $arrData[$i]->educationFF = getFields(48);
      $arrData[$i]->wantchildren = getCaption($MData['em_rn620080113']);
      $arrData[$i]->wantchildrenFF = getFields(46);
      $arrData[$i]->havechildren = getCaption($MData['em_kxb20080113']);
      $arrData[$i]->havechildrenFF = getFields(30);
      $arrData[$i]->personality = getCaption($MData['em_qck20080113']);
      $arrData[$i]->personalityFF = getFields(42);
      $arrData[$i]->romantic = getCaption($MData['em_r9720080113']);
      $arrData[$i]->romanticFF = getFields(43);

      $musical = str_replace(1,"true",$MData['em_y8520080116']);
      $favourite = str_replace(1,"true",$MData['em_grm20080116']);

      $musicals = str_replace(0,"false",$musical);
      $favourites = str_replace(0,"false",$favourite);

      $musicalss = explode("**", $musicals);
      $favouritess = explode("**", $favourites);

      $i = 3;
      $arrData[$i] = new StdClass;
      $arrData[$i]->musicals = $musicalss;
      $arrData[$i]->musicalsFF = getFields(52);
      $arrData[$i]->favourites = $favouritess;
      $arrData[$i]->favouritesFF = getFields(53);

      $i = 4;
      $arrData[$i] = new StdClass;
      $arrData[$i]->yheight = getCaption($MData['em_1k820080113']);
      $arrData[$i]->yheightFF = getFields(31);
      $arrData[$i]->ybuild = getCaption($MData['em_heh20080113']);
      $arrData[$i]->ybuildFF = getFields(32);
      $arrData[$i]->hcolor = getCaption($MData['em_93n20080113']);
      $arrData[$i]->hcolorFF = getFields(33);
      $arrData[$i]->ecolor = getCaption($MData['em_jsh20080113']);
      $arrData[$i]->ecolorFF = getFields(34);
      $arrData[$i]->hlength = getCaption($MData['em_jhb20080113']);
      $arrData[$i]->hlengthFF = getFields(36);
      $arrData[$i]->methnicity = getCaption($MData['em_yh020080113']);
      $arrData[$i]->methnicityFF = getFields(38);
      $arrData[$i]->pappearance = getCaption($MData['em_7jr20080113']);
      $arrData[$i]->pappearanceFF = getFields(39);
      $arrData[$i]->mstyle = getCaption($MData['em_wvh20080113']);
      $arrData[$i]->mstyleFF = getFields(40);
      $arrData[$i]->afeature = getCaption($MData['em_vqf20080113']);
      $arrData[$i]->afeatureFF = getFields(41);

      $i = 5;
      $arrData[$i] = new StdClass;
      $arrData[$i]->photo = DisplayAllPic($iId);

    //$arrData[0]->pics = $pics;
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
function getFields($id){
global $DB;
  $re3 = $DB->Row("SELECT `caption` FROM `field_caption` WHERE `lang` LIKE 'english' AND `match` = 'no' AND `Cid` = '".$id."' ORDER BY `Cid` ASC");
if($re3)
  return $re3['caption'];
  else
  return $id;
}
function DisplayAllPic($aid){

  global $DB;

	$Counter = 0;
  $DataArray = array();

	$result = $DB->Query("SELECT * FROM `files` WHERE `uid` = '".$aid."' AND `type` = 'photo' ORDER BY title ASC");
    while( $Data = $DB->NextRow($result) )
    {
			// RETURN DATA ARRAY
      $DataArray[$Counter] = new StdClass;
      $DataArray[$Counter]->id = $Data['id'];
      $DataArray[$Counter]->aid = $aid;
			$DataArray[$Counter]->title = $Data['title'];
      $DataArray[$Counter]->description = $Data['description'];
			$DataArray[$Counter]->image =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];

			$Counter++;
	}

	return $DataArray;
}
?>

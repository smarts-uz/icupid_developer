<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

    function GetSettings($id){

    	global $DB;

    	$Counter =1;

    	$DataArray = array();

    	$MData = $DB->Row("SELECT match_array FROM members_privacy WHERE uid= ( '".$id."' ) LIMIT 1");

    	$get_myarray = unserialize($MData['match_array']);

    	if($get_myarray !="" && is_array($get_myarray)){

    			foreach($get_myarray as $Match){

    				$MA2 = $DB->Row("SELECT caption FROM field_caption, field WHERE field_caption.cid = field.fid AND fname = '". $Match['name'] ."' AND lang='".D_LANG."' AND `match` = 'yes' ORDER BY caption LIMIT 1");
    				$DataArray[$Counter]['caption'] = $MA2['caption'];

    				if(is_numeric($Match['value'])){

    					$MA = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid = '". $Match['value'] ."' AND lang='".D_LANG."' ORDER BY fvOrder LIMIT 1");

    					$DataArray[$Counter]['value'] = $MA['fvCaption'];
    				}else{
    					$DataArray[$Counter]['value'] =$Match['value'];
    				}
    				$DataArray[$Counter]['caption'] = $MA2['caption'];
    				$Counter++;
    			}
    			return $DataArray;
    	}else{
    		return "";
    	}

    }
    function GetUsername($id){

    	global $DB;

        $result = $DB->Row("SELECT username FROM members WHERE id=".$id);

        return $result['username'];
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
    function GetProfileData($id, $selectedGroup="", $ShowTextGroupsOnly=0){

	global $DB;

	$ReturnString =""; $HasFieldConter=0;$HasFieldConter1=0;

	if($ShowTextGroupsOnly ==1){ // dont show text fields
		$AddExtra = 'AND field.fType !=2 AND field.fName !="headline"';
	}elseif($ShowTextGroupsOnly ==2){// only show text fields
		$AddExtra = 'AND field.fType =2 ';
	}else{ // show all fields
		$AddExtra = '';
	}

    $SQL = "SELECT field.fid,field.fType,field.fName,field.linked_id FROM field
	INNER JOIN field_groups ON ( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  )
	WHERE ( field.groupid = '".$selectedGroup."' OR field.groupid_1 = '".$selectedGroup."' OR field.groupid_2 = '".$selectedGroup."') ".$AddExtra."
	GROUP BY field.fid ORDER BY field.fOrder ASC";

	$result1 = $DB->Query($SQL);

	$DataArray = $DB->Row("SELECT * FROM members_data WHERE uid =( '".$id."' ) LIMIT 1");

	while( $field = $DB->NextRow($result1) ){


		if($field['fType'] == 2) {
			if ($DataArray[$field['fName']] == '') {
				$DataArray[$field['fName']] = ' ';
			}
		}

					 $HasFieldConter1++;
		// field display counter
		if($DataArray[$field['fName']] !="" && $DataArray[$field['fName']] !="0"){
		$HasFieldConter++;
		}


			$Caption = $DB->Row("SELECT caption FROM field_caption WHERE Cid=".$field['fid']." AND lang='".D_LANG."' AND `match`='no'  LIMIT 1");
			if(empty($Caption)){ //$Caption['caption']

						$Caption = $DB->Row("SELECT caption FROM field_caption WHERE Cid=".$field['fid']." AND `match`='no'  LIMIT 1");
			}


			if($field['fType'] == 1){

							if($field['fName'] =="age" && $DataArray[$field['fName']] != ""){
								$DataArray[$field['fName']]= MakeAge($DataArray[$field['fName']]);


							}elseif( ($field['fName'] =="postcode" && $DataArray[$field['fName']] != "") || ($field['fName'] =="zipcode" && $DataArray[$field['fName']] != "") ){

								$DataArray[$field['fName']]= eMeetingOutput(substr($DataArray[$field['fName']],0,3))."****";

							}else{

								$DataArray[$field['fName']]= eMeetingOutput($DataArray[$field['fName']]);

							}

			}elseif($field['fType'] == 2){ // will not be used if only calling this field

							$DataArray[$field['fName']] = eMeetingOutput($DataArray[$field['fName']],true);

							if ($DataArray[$field['fName']] == '') {
								$DataArray[$field['fName']] = ' ';
							}




//$order   = array('\r\n', '\n', '\r', 'rn');
$order   = array('\r\n', '\n', '\r');
$replace = '';
$DataArray[$field['fName']] = str_replace($order, $replace, $DataArray[$field['fName']]);





			}elseif($field['fType'] == 3){ // LIST BOX VALUE

							if($DataArray[$field['fName']] == ""){

								$DataArray[$field['fName']] = "";

							}elseif(!is_numeric($DataArray[$field['fName']])){



							}else{

								$listValue = $DB->Row("SELECT fvCaption AS value FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND fvid = ".$DataArray[$field['fName']]." AND lang='".D_LANG."' Order by fvOrder LIMIT 1");
								if(empty($listValue)){
									$listValue = $DB->Row("SELECT fvCaption AS value FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND fvid = ".$DataArray[$field['fName']]." Order by fvOrder LIMIT 1");
								}

								$DataArray[$field['fName']] = $listValue['value'];
							}



			}elseif($field['fType'] == 4){

							if($DataArray[$field['fName']] ==1){ $value= "yes"; }else{ $value= "no"; }

			}elseif($field['fType'] == 7){

							$DataArray[$field['fName']]= MakeAge($DataArray[$field['fName']]);


			}elseif($field['fType'] == 5){

							$c=0;
							$value="";
							$CheckParts = explode("**", $DataArray[$field['fName']]);
							$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");


							$value .="<ul style='margin:0; padding:0; line-height: 1em; line-height:12px'>";
							while( $ListValue = $DB->NextRow($result2) )
							{

								if(isset($CheckParts[$c]) && $CheckParts[$c] ==1){
									$value .="".$ListValue['fvCaption']."<br>";
								}

								$c++;
							}

							// BACKUP INCASE NOT VALUES FOUND
							if($c ==0){

								$result3 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='english' Order by fvOrder");
								while( $ListValue = $DB->NextRow($result3) )
								{

										if($CheckParts[$c] ==1){
											$value .="".$ListValue['fvCaption']."<br>";
										}

										$c++;
								}
							}

							$value .="</ul><br>";

					$DataArray[$field['fName']] = $value;

				}


	// THIS IS WHERE WE REPARE THE OUTPUT FOR THE PROFILE DATA
	if($ShowTextGroupsOnly ==2){


							// DISPLAY THE OUTPUT
							//echo "Current Template".D_TEMP;

							if($DataArray[$field['fName']] !=""){
								if(D_TEMP == "v17red")
								{
									$ReturnString .= '<div class="profile_box_title_new marginTop">
									<span class="goL">
										<h1>'.$Caption['caption'].' </h1>
									</span>
									<span class="goR">';
									if($_SESSION['uid'] ==$id){ $ReturnString .= '<a href="index.php?dll=account&sub=edit" class="pLink"><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/pencil.png" align="absmiddle" class="border_radius_none"> '.$GLOBALS['_LANG']['_edit'].' </a>'; }
									$ReturnString .= '</span><div class="ClearAll"></div></div><div class="profile_box_body Acc_ListBox pddng_lft" style="min-height:40px; padding-left:10px;">';
									$ReturnString .= $DataArray[$field['fName']]."</div>";
								}
								else
								{
										$ReturnString .= '<div class="profile_box_title marginTop">
										<span class="goL">
											<h1>'.$Caption['caption'].' </h1>
										</span>
										<span class="goR">';
										if($_SESSION['uid'] ==$id){ $ReturnString .= '<a href="index.php?dll=account&sub=edit" class="pLink"><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> '.$GLOBALS['_LANG']['_edit'].' </a>'; }
										$ReturnString .= '</span><div class="ClearAll"></div></div><div class="profile_box_body">';
										$ReturnString .= $DataArray[$field['fName']]."</div>";
								}

							}

	}else{

							// DISPLAY THE OUTPUT
							if($DataArray[$field['fName']] !="" && $DataArray[$field['fName']] !="0"){
								$ReturnString .= '<div style="width:195px; float:left; min-height:40px;">'.$Caption['caption'].':<span><br><strong>';
								$ReturnString .= $DataArray[$field['fName']]."</strong></span></div>";
							}
	}

				$value="";
			}


if($HasFieldConter ==0 && $HasFieldConter1 > 0){
$ReturnString .= "<style>#DataBoxTitle".$selectedGroup." { display:none; } #DataBoxBody".$selectedGroup." { display:none; } </style>"; $HasFieldConter=1;
}

	return $ReturnString;

}
function MemberAccountDetails($id,$extra=true,$page=""){

		global $DB;

		if(!is_numeric($id)){ return; }

		$DataArray = array();

			$result = $DB->Row("SELECT profileview_friends, profileview_nonfriend, members_privacy.skype, members_privacy.IM, members_billing.date_expire, members.active AS ThisApproved, members_privacy.SMS_credits AS sms_remaining, members.*, files.type, files.adult_content, files.approved, files.bigimage, package.name, package.maxFiles, package.SMS_credits, package.maxMessage, package.icon
			FROM members
			INNER JOIN members_privacy ON ( members_privacy.uid = members.id AND members.id=".$id." )
			LEFT JOIN files ON ( files.uid = members.id AND files.default=1 AND files.type='photo')
			LEFT JOIN package ON (members.packageid = package.pid)
			LEFT JOIN members_billing ON (members_billing.uid = members.id)
			LIMIT 1");

			// MEMBER IMAGE DATA
			$DataArray['image'] = ReturnDeImage($result,"medium");
			$DataArray['image_small'] = ReturnDeImage($result,"small");

			// MEMBER PACKAGE DATA

			if($extra){
				$usedMsgSpace = $DB->Row("SELECT count(uid) AS space FROM messages WHERE uid= ( '".$id."' ) AND maildate='".date("Y-m-d")."'");
				$DataArray['msg_total'] = $result['maxMessage'];
				$DataArray['msg_used'] = $usedMsgSpace['space'];

				$usedImageSpace = $DB->Row("SELECT count(uid) AS space FROM files WHERE uid= ( '".$id."' )");
				$DataArray['img_total'] = $result['maxFiles'];
				$DataArray['img_used'] = $usedImageSpace['space'];
			}

			// headline for profile
			if($page =="profile"){

			// FOLLOW FUNCTION ENABLED
			if(D_FOLLOW ==1){

				$follow = $DB->Row("SELECT follow_display, allow_approve FROM members_follow WHERE uid = ( '".$id."' ) LIMIT 1");
				$DataArray['follow_display'] = $follow['follow_display'];
				$DataArray['follow_approve'] = $follow['allow_approve'];
			}

			// PROFILE VIEW GROUP DATA
			$DataArray['profile_viewfriends'] 					= $result['profileview_friends'];	// privacy settings for viewing profile blocks
			$DataArray['profile_viewnonefiends'] 				= $result['profileview_nonfriend'];

				$profile = $DB->Row("SELECT members_online.logid AS onlinenow, members_data.headline, members_data.description, members_data.age, members_data.gender, members_data.country, members_data.location, members_data.postcode FROM members_data
				LEFT JOIN members_online ON ( members_data.uid = members_online.logid )
				WHERE uid= ( '".$id."' ) LIMIT 1");

				$DataArray['headline'] 			= eMeetingOutput($profile['headline']);
				if($DataArray['headline'] =='0'){$DataArray['headline']=""; }
				$DataArray['MyGender'] 			= MakeGender($profile['gender']);
				$DataArray['gender'] 			= $profile['gender'];
				$DataArray['country'] 			= MakeCountry($profile['country']);
				$DataArray['location'] 			= eMeetingOutput($profile['location']);
				$DataArray['description'] 		= eMeetingOutput($profile['description']);
				$DataArray['age'] 				= MakeAge($profile['age']);
				$DataArray['starsign'] 			= getsign($profile['age']);
				$DataArray['birthday'] 			= $profile['age'];
				//$DataArray['zipcode'] 			= eMeetingOutput($profile['zipcode']);
				$DataArray['postcode'] 			= eMeetingOutput($profile['postcode']);

				if(isset($profile['onlinenow']) && $profile['onlinenow'] !=""){
						$DataArray['onlinenow'] 			= true;
				}else{
						$DataArray['onlinenow'] 			= false;
				}
			}

			$DataArray['skype'] 			= eMeetingOutput($result['skype']);
			$DataArray['status'] 			= eMeetingOutput($result['msgStatus']);
			$DataArray['SMS_credits'] 		= $result['sms_remaining'];
			$DataArray['name'] 				= $result['name'];
			$DataArray['showIM'] 			= $result['IM'];
			$DataArray['username'] 			= substr($result['username'],0,15);
			$DataArray['ThisApproved'] 		= $result['ThisApproved'];
			$DataArray['highlight'] 		= $result['highlight'];
			$DataArray['active'] 			= $result['active']; //active, 'suspended', 'unapproved', 'cancel'
			$DataArray['video_duration']	= $result['video_duration'];
			$DataArray['created'] 			= $result['created'];
			$DataArray['hits'] 				= number_format($result['hits']);
			$DataArray['icon'] 				= $result['icon'];
			$DataArray['uid'] 				= $result['id'];
			$DataArray['visible'] 			= $result['visible'];
			$DataArray['lastlogin'] 		= $result['lastlogin'];
			$DataArray['updated'] 			= $result['updated'];
			$DataArray['expire'] 			= dates_interconv($result['date_expire']);
			$DataArray['profile_complete'] 	= $result['profile_complete'];
			if($DataArray['profile_complete'] =='99'){$DataArray['profile_complete']="100"; }
			$DataArray['updated'] 			= $result['updated'];


			return $DataArray;
}


// function ReturnDeImage($array,$size,$OnlyPic=0){
//
// 		## photo used on member adverts, groups etc
//
// 		if(isset($array['photo']) && $array['photo'] !=""){
//
// 			$array['bigimage']=$array['photo']; $array['type'] ="photo";
//
// 		}
//
// 		## if not file type is set
//
// 		if(!isset($array['type'])){
//
// 			$array['type']="photo";
//
// 			$array['bigimage'] = DEFAULT_IMAGE;
//
// 		}
//
// 		## build the image string
//
// 		switch($array['type']){
//
// 			case "photo": {
//
// 				## add gender display pic male/female etc
//
// 				if(isset($array['gender'])){ $array['bigimage'] .="&g=".$array['gender']; }
//
// 				$UImage = $array['bigimage'];
//
// 			} break;
//
// 			case "music": { $UImage = DEFAULT_MUSIC."&t=f"; 	} break;
//
// 			case "video": { $UImage = DEFAULT_VIDEO."&t=f";		} break;
//
// 			case "youtube": {
//
// 				$file_part = explode("?v=",$array['bigimage']);
//
// 				if(isset($file_part[1])){ $file_part = explode("&",$file_part[1]); }
//
// 				if(!isset($file_part[0])){
//
// 					$UImage = DEFAULT_VIDEO."&t=f";
//
// 				}else{
//
// 					return "http://img.youtube.com/vi/".$file_part[0]."/2.jpg?";
//
// 				}
//
// 			} break;
//
// 			// not type found
//
// 			default: {
//
// 				$UImage = DEFAULT_IMAGE."&t=f";
//
// 				if(isset($array['gender'])){ $UImage ="nophoto.jpg&g=".$array['gender']; }
//
// 			} break;
//
// 		}
// 		## approval system
// 		if(isset($array['approved']) && $array['approved'] =="no" ){
//
// 			$UImage = WATINGAPPROVAL_IMAGE."&t=f";
//
// 		}
//
// 		## adult images
//
// 		if(isset($array['adult_content']) && $array['adult_content'] =="yes" && $_SESSION['pack_adult'] !="yes" && ENABLE_ADULTCONTENT =="yes"){ // && $_SESSION['uid'] != $array['uid']
//
// 			 if($_SESSION['auth'] != "yes"  && (isset($array['id']) && $array['id'] != $_SESSION['uid']) || ( isset($array['uid']) && $array['uid'] != $_SESSION['uid'] ) ){
//
// 				$UImage = DEFAULT_IMAGE_ADULT."&t=f";
//
// 				//return $UImage;
//
// 			}
//
// 		}
//
// 		## build the query string
//
// 		$FilePath = DB_DOMAIN."inc/tb.php?src=";
//
// 		## image sizes
//
// 		switch($size){
//
// 				case "xsmall":{	$UImage .="&x=40&y=40";			} break;
//
// 				case "small":{	$UImage .="&x=48&y=48";			} break;
//
// 				case "medium":{	$UImage .="&x=96&y=96";			} break;
//
// 				case "big":{	$UImage .="&x=183&y=183";		} break;
//
// 				case "full":{	$FilePath = WEB_PATH_IMAGE; } break;
//
// 		}
//
// 	$UImage = $FilePath.$UImage;
//
// 	return $UImage;
//
// }

function DisplayFriends($id){



	global $DB;



	## define variables

	$RunningCount=1;	$Friends = array();



	$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY



	$result = $DB->Query("SELECT DISTINCT members.id, album.cat, album.password, members.username, files.bigimage, members_online.logid AS onlinenow, members_network.date,

	members_network.id, members.id AS uid, members_network.to_uid, members_network.uid AS myid, members_network.comments, members_network.approved AS memberApprove,

	files.type,	files.approved,	files.aid, files.adult_content

	FROM members_network

	LEFT JOIN members ON ( members.id = members_network.to_uid OR  members.id = members_network.uid )

	LEFT JOIN members_online ON ( members_online.logid = members.id )

	LEFT JOIN files ON ( files.uid = members.id AND files.default=1)

	LEFT JOIN album ON ( album.aid = files.aid)

	WHERE (members_network.uid='".$_SESSION['uid']."' or members_network.to_uid='".$_SESSION['uid']."') AND members.username != ('".$_SESSION['username']."') AND members_network.type= ( '2' ) AND members_network.approved = 'yes' GROUP BY members.id ORDER BY members.lastlogin");



	while( $friend = $DB->NextRow($result) ){



		if($friend['to_uid'] ==$id){

			$Friends[$RunningCount]['username'] = GetUsername($friend['uid']);



		}else{

			$Friends[$RunningCount]['username'] = $friend['username'];

		}

		if($friend['cat'] == "private" && $friend['password'] != "")
		{
			$Friends[$RunningCount]['image'] = "inc/tb.php?src=".DEFAULT_IMAGE."&x=96&y=96&x=48&y=48";
		}
		else
		{
			$Friends[$RunningCount]['image'] 		= ReturnDeImage($friend,"xsmall");
		}

		$Friends[$RunningCount]['uid'] 			= $friend['id'];

		$RunningCount++;

	}



	## return array

	return $Friends;

}
function DisplayAlbums($id){

	global $DB;


	$Counter = 0;
	$DataArray = array();
    $result = $DB->Query("SELECT * FROM `album` WHERE `uid` = '".$id."' ORDER BY title ASC");

    while( $Data = $DB->NextRow($result) )
    {
      $result1 = $DB->Row("SELECT bigimage, approved FROM files WHERE aid='".$Data['aid']."' AND type='photo' ORDER BY date DESC LIMIT 1");

      $DataArray[$Counter] = new StdClass;
      $DataArray[$Counter]->aid = $Data['aid'];
      $DataArray[$Counter]->title = $Data['title'];
      //$DataArray[$Counter]->image = DB_DOMAIN."inc/tb.php?src=".$result1['bigimage'];
      if($result1['approved'] == "yes")
			$DataArray[$Counter]->image =  DB_DOMAIN."inc/tb.php?src=".$result1['bigimage'];
      else
	    $DataArray[$Counter]->image =  DB_DOMAIN."inc/tb.php?src=waiting.jpg&t=f";

      $DataArray[$Counter]->filecount = $Data['filecount'];

			$Counter++;
	}

	return $DataArray;
}

function DisplayAlbumsPic($aid){

  global $DB;

	$Counter = 0;
  $DataArray = array();

	$result = $DB->Query("SELECT * FROM `files` WHERE `aid` = '".$aid."' AND type='photo' ORDER BY title ASC");
    while( $Data = $DB->NextRow($result) )
    {

			// RETURN DATA ARRAY
      $DataArray[$Counter] = new StdClass;
			$DataArray[$Counter]->id = $Data['id'];
      $DataArray[$Counter]->aid = $aid;
      $DataArray[$Counter]->date = $Data['date'];
      $DataArray[$Counter]->rating = $Data['rating'];
			$DataArray[$Counter]->views = $Data['views'];
			$DataArray[$Counter]->title = $Data['title'];
      $DataArray[$Counter]->description = $Data['description'];
			//$DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];
      if($Data['approved'] == "yes")
			$DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];
      else
	    $DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=waiting.jpg&t=f";

			$Counter++;
	}

	return $DataArray;
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
      $DataArray[$Counter]->aid = $aid;
      $DataArray[$Counter]->id = $Data['id'];
      $DataArray[$Counter]->date = $Data['date'];
      $DataArray[$Counter]->rating = $Data['rating'];
			$DataArray[$Counter]->views = $Data['views'];
			$DataArray[$Counter]->title = $Data['title'];
      $DataArray[$Counter]->description = $Data['description'];
      $DataArray[$Counter]->imgid = $Data['bigimage'];
      if($Data['approved'] == "yes")
			$DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];
      else
	    $DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=waiting.jpg&t=f";

      $Counter++;
	}

	return $DataArray;
}
function DisplayAllMusic($uid){

  global $DB;

	$Counter = 0;
  $DataArray = array();

	$result = $DB->Query("SELECT * FROM `files` WHERE `uid` = '".$uid."' AND `type` = 'music' ORDER BY title ASC");
    while( $Data = $DB->NextRow($result) )
    {
			// RETURN DATA ARRAY
      $DataArray[$Counter] = new StdClass;
      $DataArray[$Counter]->id = $Data['id'];
      $DataArray[$Counter]->aid = $Data['aid'];
      $DataArray[$Counter]->date = $Data['date'];
      $DataArray[$Counter]->rating = $Data['rating'];
			$DataArray[$Counter]->views = $Data['views'];
			$DataArray[$Counter]->title = $Data['title'];
      $DataArray[$Counter]->description = $Data['description'];
      $DataArray[$Counter]->imgid = $Data['bigimage'];
			//$DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];
      if($Data['approved'] == "yes")
			$DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];
      else
	    $DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=waiting.jpg&t=f";

			$Counter++;
	}

	return $DataArray;
}
function DisplayAllVideo($uid){

  global $DB;

	$Counter = 0;
  $DataArray = array();

	$result = $DB->Query("SELECT * FROM `files` WHERE `uid` = '".$uid."' AND `type` = 'video' ORDER BY title ASC");
    while( $Data = $DB->NextRow($result) )
    {
			// RETURN DATA ARRAY
      $DataArray[$Counter] = new StdClass;
      $DataArray[$Counter]->id = $Data['id'];
      $DataArray[$Counter]->aid = $Data['aid'];
      $DataArray[$Counter]->date = $Data['date'];
      $DataArray[$Counter]->rating = $Data['rating'];
			$DataArray[$Counter]->views = $Data['views'];
			$DataArray[$Counter]->title = $Data['title'];
      $DataArray[$Counter]->description = $Data['description'];
      $DataArray[$Counter]->imgid = $Data['bigimage'];
			//$DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];
      if($Data['approved'] == "yes")
			$DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=".$Data['bigimage'];
      else
	    $DataArray[$Counter]->bigimage =  DB_DOMAIN."inc/tb.php?src=waiting.jpg&t=f";

			$Counter++;
	}

	return $DataArray;
}
?>

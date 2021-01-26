<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );


/**
* Info: Funcion used to create the profile styles
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

function BuildProfileCSS($data){

	## return if data is empty
	if(empty($data)){ return ""; }

	$CssSheet ="<style>";

	## heading font styles
	if(!empty($data) && $data['font1'] != ""){  $CssSheet .= " h1,h2,h3,h4 { font-family: ".$data['font1']."; }"; }

	## body styles
	$CssSheet .="body { ";
	
		
		if(!empty($data) && $data['font2'] != ""){  $CssSheet .= "font-family: ".$data['font2'].";"; }
		if(!empty($data) && $data['background'] != ""){	$CssSheet .= "background-color: ".$data['background']."; background-image:none;"; }
		if(!empty($data) && $data['background_image'] != ""){	$CssSheet .= "background-image: url('".WEB_PATH_FILES.$data['background_image']."');"; }
		if(!empty($data) && $data['background_image_display'] != ""){	$CssSheet .= "background-repeat: ".$data['background_image_display'].";"; }
	
	$CssSheet .="}";

	## header styles	
	$CssSheet .="#ProfileHead, #ProfileHead h2, #ProfileHead h1, #ProfileUsernameBox p, .profile_tabs li a {";	
	
		if(isset($data['header_text']) && $data['header_text'] !=""){	$CssSheet .=" color: ".$data['header_text'].";";  }

	$CssSheet .="} ";

	## header background
	$CssSheet .="#ProfileHead {";	

	if(isset($data['header_background']) && $data['header_background'] !=""){	$CssSheet .="background: ".$data['header_background']." url('images/DEFAULT/profile_backdrop.png') repeat-x top left;"; }


	$CssSheet .="}";

	## inner background
	if(isset($data['inner_background']) && $data['inner_background'] !=""){
	
		$CssSheet .=" #ProfileOptionsBox { background-color: ".$data['inner_background']."; background-image:none; } ";
	
	}

	if(isset($data['header_image']) && $data['header_image'] !=""){

	$CssSheet .=" #ProfileHead {
		background-image: url('".WEB_PATH_FILES.$data['header_image']."');
		background-repeat: ".$data['header_image_display'].";
		background-position: top left;
 		}";
	
	}

	if(isset($data['subheader_title']) && $data['subheader_title'] !=""){
	
		$CssSheet .="#Profile_SideBar h1, .profile_box_title { 
		
			background-color: ".$data['subheader_title']."; 
		
		}";
	}
	
	if(isset($data['subheader_background']) && $data['subheader_background'] !=""){
	
		$CssSheet .="#Profile_SideBar, .profile_box_body { 
		
			background-color: ".$data['subheader_background']."; 
			border: 1px solid  ".$data['subheader_title'].";			
			background-image:none;
		}
		div.content.sidebar, div.content.sidebar > div.gradient { background-image:none;}
		";
	}

	## TEXT COLOURS
	if(isset($data['color_text']) && $data['color_text'] !=""){
	
	$CssSheet .="#Profile_SideBar, .profile_box_body, .profile_box_body p { color: ".$data['color_text']."} ";
	
	}
 
	if(isset($data['color_link']) && $data['color_link'] !=""){
	
	$CssSheet .="#Profile_MainBar .profile_box_title .goL h1,  #Profile_SideBar h1, .profile_box_title, .pLink { color: ".$data['color_link']."; text-decoration:none;} ";
	
	}

	$CssSheet .="</style>";

	return $CssSheet;

}

/**
* Info: Funcion used to display the profile music file
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

function MyMusicFile($id){
	
	global $DB;

	if(!is_numeric($id)){ return ""; }
	
	$data = $DB->Row("SELECT bigimage FROM files  WHERE uid= ( '".$id."' ) AND type='music' AND `default` =1 LIMIT 1");
	
	if(!empty($data)){
		$FileSrc ='<embed src="newadmin/inc/js/mediaplayer.swf" width="160" height="20" allowscriptaccess="always" allowfullscreen="true" flashvars="width=180&height=20&file='.WEB_PATH_MUSIC.$data['bigimage'].'&skin='.DB_DOMAIN.'inc/js/_playerskins/bekle.swf&autostart=true" />';
	}else{
		$FileSrc ="";
	}		
	return $FileSrc;
}

/**
* Info: Funcion used to update the profile hit counter
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

function UpdateHits($id){
	
	global $DB;
	
	if($id != 0 && $_SESSION['uid'] != $id){
		$DB->Update("UPDATE members SET hits=hits+1 WHERE id='".strip_tags($id)."' LIMIT 1");
	}
	return;
}

/**
* Info: Funcion used to add visitors
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/
function AddVisitor($id){

	// UPDATED FOR VERSION 6.0 //	
	global $DB;
	
	if($id != "" && $id!=0 && isset($_SESSION['uid']) && $_SESSION['uid'] != 0 && strlen($_SESSION['uid']) > 0){
	
		//$v = $DB->Row("SELECT count(uid) AS found FROM `visited` WHERE TO_DAYS( NOW( 'y-m-d h:i:s' ) ) - TO_DAYS( date ) < 1 AND uid= ( '".$_SESSION['uid']."' ) AND view_uid= ( '".$id."' ) LIMIT 1");
		
		//if($v['found'] ==0 && $_SESSION['uid'] != 0){
			$DB->Insert("INSERT INTO `visited` (uid ,view_uid ,date)VALUES ('".$_SESSION['uid']."', '".$id."', NOW())");
		//}	
	}
}

/**
* Info: Funcion used to get an array of field groups
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

function GetProfileGroups($profile_gender){

	global $DB;
	 
	$RunningCount =1;
	$GroupsDataArray = array();

	if(!isset($profile_gender) || $profile_gender==""){ $extra=""; }else{ $extra="|| private = ".strip_tags($profile_gender); }


	if (isset($_SESSION['site_moderator']) && $_SESSION['site_moderator']== "yes"){
		$extra.="|| private = 2 "; 
	}


	$SQL = "SELECT field_groups.id, field_group_languages.caption FROM field_groups left join field_group_languages ON field_groups.id = field_group_languages.fgid AND field_group_languages.language ='".$_SESSION['lang']."' WHERE ( private = 0 $extra) ORDER BY forder ASC";
 
	$result = $DB->Query($SQL);

    while( $groups = $DB->NextRow($result) )
    {
    	$GroupsDataArray[$RunningCount]['groupid'] = $groups['id'];
    	if($groups['caption'] == '' || $groups['caption'] == NULL) {
    		$getGroupCaption = $DB->row("SELECT * FROM field_groups WHERE id=".$groups['id']);
    		$GroupsDataArray[$RunningCount]['caption'] = $getGroupCaption['caption'];

    	} else {
    		$GroupsDataArray[$RunningCount]['caption'] = $groups['caption'];
    	}
			
		$RunningCount++;
	}
	
	return $GroupsDataArray;	
}

/**
* Info: Funcion used to display the profile data
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/
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
	WHERE field.fName NOT IN ('location','milesfrom') and  ( field.groupid = '".$selectedGroup."' OR field.groupid_1 = '".$selectedGroup."' OR field.groupid_2 = '".$selectedGroup."') ".$AddExtra." 
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


							$value .="<ul style='margin:0; padding:0; line-height: 1em; line-height:23px'>";
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
											
										if(isset($CheckParts[$c]) && $CheckParts[$c] ==1){
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
										<h4>'.$Caption['caption'].' </h4>
									</span>
									<span class="goR">';
									if($_SESSION['uid'] ==$id){ $ReturnString .= '<a href="'.getThePermalink('account/edit').'" class="pLink"><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/pencil.png" align="absmiddle" class="border_radius_none"> '.$GLOBALS['_LANG']['_edit'].' </a>'; }
									$ReturnString .= '</span><div class="ClearAll"></div></div><div class="profile_box_body Acc_ListBox pddng_lft" style="min-height:40px; padding-left:10px;">';
									$ReturnString .= $DataArray[$field['fName']]."</div>"; 
								}
								else
								{
										$ReturnString .= '<div class="profile_box_title marginTop">
										<span class="goL">
											<h4>'.$Caption['caption'].' </h4>
										</span>
										<span class="goR">';
										if($_SESSION['uid'] ==$id){ $ReturnString .= '<a href="'.getThePermalink('account/edit').'" class="pLink"><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> '.$GLOBALS['_LANG']['_edit'].' </a>'; }
										$ReturnString .= '</span><div class="ClearAll"></div></div><div class="profile_box_body">';
										$ReturnString .= $DataArray[$field['fName']]."</div>"; 
								}
								
							}

	}else{
	
							// DISPLAY THE OUTPUT
							if($DataArray[$field['fName']] !="" && $DataArray[$field['fName']] !="0"){  
								$ReturnString .= '<div class="col-md-6 profile_question">'.$Caption['caption'].':<span><br><strong>';
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



/**
* Info: Funcion used to get a the profile partner
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/
function CheckPartner($id){

	global $DB;
	$RunningCount =0;
	$GalleryDataArray = array();
	
	$tryThis = "SELECT DISTINCT members_network.comments, members.username, files.bigimage, members_online.logid AS onlinenow, members_network.date, members_network.id, members.id AS uid, members_network.to_uid, members_network.uid AS myid, members_network.comments, members_network.approved, 
	files.type,	files.approved AS fileapprove,	files.aid,	album.cat,	album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f
	FROM members_network 
	LEFT JOIN members ON ( members.id =  members_network.to_uid )
	LEFT JOIN members_online ON ( members_online.logid = members.id )			
	LEFT JOIN files ON ( files.uid = members.id)
	LEFT JOIN album ON ( album.aid = files.aid )
	WHERE (members_network.uid='".$id."') AND  members_network.type =4 AND members_network.approved='yes' LIMIT 1";

	$result = $DB->Query($tryThis);
    while( $album = $DB->NextRow($result) )
    {
		$RunningCount++;
		$GalleryDataArray[$RunningCount]['image'] 			= ReturnDeImage($album,"small");
		$GalleryDataArray[$RunningCount]['username']		= $album['username'];
		$GalleryDataArray[$RunningCount]['comments']		= $album['comments'];
		$GalleryDataArray[$RunningCount]['uid']				= $album['uid'];
	}

	if($RunningCount==1){			
		return $GalleryDataArray;		
	}else{		
		return 0;
	}
}

/**
* Info: Profile Member Vote System
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/
function DisplayProfileRatingSystem($profileID){

	global $DB;

	if($_SESSION['auth'] =="yes" && D_PROFILERATING ==1){

	// CHECK FOR VOTES
	print '<div class="profile_box_title marginTop">

		<span class="goL"><h4>Rate My Profile</h4></span><div class="ClearAll"></div></div>';

	$Total = $DB->Row("SELECT count(id) AS total FROM member_rating WHERE profile_id='".eMeetingInput($profileID)."' AND uid='".$_SESSION['uid']."'");
	if($Total['total'] ==0 && $_SESSION['uid'] != $profileID){
		
	print '
	<div class="profile_box_body"><div style="/*background:url(images/DEFAULT/ratingbox.png) no-repeat; */ height:50px;"><div style="height:10px;"></div>
	<div id="eMeetingProfileRating" style="margin-left:35px;">
	<ul class="star-rating"> 
	<li class="current-rating" style="width:0%;"></li>
	<li><a href="#" title="1 star out of 5" class="one-star" onclick="eMeetingProfileRating(1,'.$profileID.'); return false;">1</a></li>
	<li><a href="#" title="2 stars out of 5" class="two-stars" onclick="eMeetingProfileRating(2,'.$profileID.'); return false;">2</a></li>
	<li><a href="#" title="3 stars out of 5" class="three-stars" onclick="eMeetingProfileRating(3,'.$profileID.'); return false;">3</a></li>
	<li><a href="#" title="4 stars out of 5" class="four-stars" onclick="eMeetingProfileRating(4,'.$profileID.'); return false;">4</a></li>
	<li><a href="#" title="5 stars out of 5" class="five-stars" onclick="eMeetingProfileRating(5,'.$profileID.'); return false;">5</a></li>
	<li><a href="#" title="5 stars out of 5" class="five-stars" onclick="eMeetingProfileRating(5,'.$profileID.'); return false;">5</a></li>
	</ul>
	</div></div></div>';
	
	}else{

	// LETS UPDATE THE MEMBERS TABLE VOTE COUNTER
	$Total = $DB->Row("SELECT sum(vote_amount) AS total FROM member_rating WHERE profile_id='".eMeetingInput($profileID)."'");
	$Total1 = $DB->Row("SELECT count(id) AS total FROM member_rating WHERE profile_id='".eMeetingInput($profileID)."'");

	// WORK OUT THE PERCENTAGE
	$avg = @round($Total['total']/$Total1['total'],2);							
	$perc = @round( (100/5)*$avg);

	print '<div class="profile_box_body"><div style="height:50px;"><div style="height:15px;"></div>';
	print "<span style='font-size:21px; margin-left:40px;'>".$perc."% </span> ( ".$Total1['total']." votes )";
	print '</div></div>';

	}
	}

}

/**

* Info: Count Mail Box 

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/



function ProfileMailCount($profileId){

	global $DB;

	## define variables

	$AlertArray = array(); $Counter=1;

	$SQL = "select row_num from 
		(
			SELECT count(mailnum) AS row_num FROM messages WHERE mail2id= '".$_SESSION['uid']."' AND uid = '$profileId' AND to_box='inbox' AND messages.type !='wink'
			
		) as derived_table";

	$Data = $DB->Query($SQL);

	## loop data from query

 	while( $DataArray = $DB->NextRow($Data) ){

		$AlertArray = number_format($DataArray['row_num']); 
		$Counter++;

	}

	return $AlertArray;

}


/**

* Info: Display Inbox Mail  

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/


function DisplayProfileMessages($id,$profileId,$box=1, $orderBy="maildate", $Start="0", $Stop="10",$errMessage=""){



	global $DB;



	## define variables

	$NumFields=1;	$ReturnMessageArray=array();

	$orderBy2 = $orderBy;
	if(($orderBy=="maildate" ||$orderBy=="messages.maildate")) {
		$orderBy2 = "maildate DESC, mailtime DESC";
	} elseif(($orderBy=="mailnum" ||$orderBy=="messages.mailnum")) {
		$orderBy = "members.username";
		$orderBy2 = "members.username";
	} elseif(($orderBy=="mail_subject" ||$orderBy=="messages.mail_subject")) {
		$orderBy = "messages.mail_subject";
		$orderBy2 = "messages.mail_subject";
	}

		if($box =="sent"){

			

			$SQL = "SELECT members.username, messages.mailnum, messages.mailtime, messages.mail_message, messages.mail2id, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 

			LEFT JOIN files ON ( files.uid = messages.mail2id AND files.approved = 'yes' AND files.title <> 'Message Photo' AND files.default=1 AND files.type = 'photo' )

			LEFT JOIN album ON ( album.aid = files.aid )

			LEFT JOIN members ON ( members.id = messages.mail2id )			

			WHERE messages.uid= ( '".$id."' ) AND messages.my_box='sent' AND messages.uid ='$profileId' GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2." LIMIT $Start, $Stop";



			$totalMsg = $DB->Row("SELECT count(mailnum)  AS total FROM messages WHERE uid= ( '".$id."' ) AND my_box='sent'");

 

		}elseif($box =="trash"){

		

			$SQL = "SELECT members.username, messages.mail_message, messages.mailtime, messages.mailnum, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 

			LEFT JOIN files ON ( files.uid = messages.uid AND files.approved = 'yes' AND files.title <> 'Message Photo' AND files.default=1 AND files.type = 'photo' )

			LEFT JOIN album ON ( album.aid = files.aid )

			LEFT JOIN members ON ( members.id = messages.uid )

			WHERE (messages.mail2id='".$_SESSION['uid']."') AND (messages.to_box='trash') AND messages.uid ='$profileId' GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2." LIMIT $Start, $Stop";

			

			$totalMsg = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE messages.mail2id='".$_SESSION['uid']."' AND messages.to_box='trash' ");		



		}elseif($box =="wink"){		



			$SQL = "SELECT members.username, messages.mail_message, messages.mailtime, messages.mailnum, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 


			LEFT JOIN files ON ( files.uid = messages.uid AND files.approved = 'yes' AND files.title <> 'Message Photo' AND files.default=1 AND files.type = 'photo' )

			LEFT JOIN album ON ( album.aid = files.aid AND files.approved = 'yes' )

			LEFT JOIN members ON ( members.id = messages.uid)

			WHERE messages.mail2id='".$id."' AND messages.to_box='inbox' AND messages.type='wink' AND messages.uid ='$profileId' GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2." LIMIT $Start, $Stop";



			$totalMsg = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE mail2id= '".$id."' AND to_box='inbox' AND type='wink'");		



		}else{		



			$SQL = "SELECT members.username, messages.mail_message, messages.mailtime, messages.mailnum, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 


			LEFT JOIN files ON ( files.uid = messages.uid AND files.approved = 'yes' AND files.title <> 'Message Photo' AND files.default=1 AND files.type = 'photo' )

			LEFT JOIN album ON ( album.aid = files.aid )

			LEFT JOIN members ON ( members.id = messages.uid)

			WHERE messages.mail2id='".$id."' AND messages.to_box='inbox' AND messages.type !='wink' AND messages.uid ='$profileId' GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2."  LIMIT $Start, $Stop";			

			

			$totalMsg = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE mail2id= '".$id."' AND to_box='".$box."' AND messages.uid ='$profileId' AND messages.type !='wink'");	

					

		}



	$result = $DB->Query($SQL);

    while( $msg = $DB->NextRow($result) )

    {

			



			// CHECK FOR FILE ATTACHMNET

			$totalAttacments = $DB->Row("SELECT count(id) AS total FROM files WHERE user = '".$msg['mailnum']."' AND title='Message Photo' LIMIT 1");	

			if($totalAttacments['total'] > 0){ 

				$ReturnMessageArray[$NumFields]['attachment']="yes";

			}else{

				$ReturnMessageArray[$NumFields]['attachment']="no";

			}



			if($msg['username']==""){ $msg['username']=$_SESSION['username'];} 		

			if($box =="sent"){

				$ReturnMessageArray[$NumFields]['senderid'] = $msg['mail2id'];

			}else{

				$ReturnMessageArray[$NumFields]['senderid'] = $msg['uid'];

			}



			if($msg['maildate'] == DATE_NOW){

				$ReturnMessageArray[$NumFields]['date'] = isset($GLOBALS['LANG_MESSAGES']['today']);

			}else{

				$ReturnMessageArray[$NumFields]['date'] 	= dates_interconv($msg['maildate']);

			}			

			$ReturnMessageArray[$NumFields]['time'] 	= $msg['mailtime'];

			$ReturnMessageArray[$NumFields]['id'] 		 = $msg['mailnum'];

			$ReturnMessageArray[$NumFields]['type'] 	 = $msg['type'];

			$ReturnMessageArray[$NumFields]['subject'] 	 = substr(eMeetingOutput($msg['mail_subject']),0,200);

			$ReturnMessageArray[$NumFields]['message'] 	 = strip_tags(substr(eMeetingOutput(strip_tags($msg['mail_message'])),0,50))."...";

			$ReturnMessageArray[$NumFields]['total'] 	 = $NumFields;		

			$ReturnMessageArray[$NumFields]['image'] 	 = ReturnDeImage($msg,"medium");			

			$ReturnMessageArray[$NumFields]['from']		 = $msg['username'];			

			$ReturnMessageArray[$NumFields]['totalMsg']  = $totalMsg['total'];



			if($msg['mailstatus'] =="unread"){	$ThisCaption="<font color='red'>".$GLOBALS['_LANG']['_new']."</font>"; }else{ $ThisCaption=$GLOBALS['_LANG']['_read']; }



		$ReturnMessageArray[$NumFields]['status']	= $ThisCaption;  

		$NumFields++;	

	}

	

	## return array

	return $ReturnMessageArray;

}
?>
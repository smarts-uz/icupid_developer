<?php 

// no direct access

defined( 'KEY_ID' ) or die( 'Restricted access' );

/**
* Info: Funcion used to display the profile data
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/
function GetProfileNearMeData($id, $selectedGroup="", $ShowTextGroupsOnly=0){
	
	global $DB;
	
	$ReturnString =""; $HasFieldConter=0;$HasFieldConter1=0;

	$ReturnArr = array();

	if($ShowTextGroupsOnly ==1){ // dont show text fields
		$AddExtra = 'AND field.fType !=2 AND field.fName !="headline"';
	}elseif($ShowTextGroupsOnly ==2){// only show text fields
		$AddExtra = 'AND field.fType =2 ';
	}else{ // show all fields
		$AddExtra = '';
	}

    $SQL = "SELECT field.fid,field.fType,field.fName,field.linked_id FROM field 
	INNER JOIN field_groups ON ( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  )
	WHERE ( field.groupid = '".$selectedGroup."' OR field.groupid_1 = '".$selectedGroup."' OR field.groupid_2 = '".$selectedGroup."') AND field.fid IN (25,54) ".$AddExtra." 
	GROUP BY field.fid ORDER BY field.fOrder ASC";

	$result1 = $DB->Query($SQL);

	$memberArr = $DB->Row("SELECT username FROM members WHERE id =( '".$id."' ) LIMIT 1");
	$fileArr = $DB->Row("SELECT * FROM files WHERE uid =( '".$id."' ) AND `default` = '1' LIMIT 1");
	$DataArray = $DB->Row("SELECT * FROM members_data WHERE uid =( '".$id."' ) LIMIT 1");

	while( $field = $DB->NextRow($result1) ){


		

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

								
			}
			elseif( ($field['fName'] =="postcode" && $DataArray[$field['fName']] != "") || ($field['fName'] =="zipcode" && $DataArray[$field['fName']] != "") ){

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

						
		}

		elseif($field['fType'] == 3){ // LIST BOX VALUE
							
			if($DataArray[$field['fName']] == ""){

				$DataArray[$field['fName']] = "";

			}
			elseif(!is_numeric($DataArray[$field['fName']])){

 

			}
			else{

				$listValue = $DB->Row("SELECT fvCaption AS value FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND fvid = ".$DataArray[$field['fName']]." AND lang='".D_LANG."' Order by fvOrder LIMIT 1");

				if(empty($listValue)){

					$listValue = $DB->Row("SELECT fvCaption AS value FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND fvid = ".$DataArray[$field['fName']]." Order by fvOrder LIMIT 1");

				}

				$DataArray[$field['fName']] = $listValue['value'];

			}

							
							
		}
		elseif($field['fType'] == 4){
						
			if($DataArray[$field['fName']] ==1){

				$value= "yes";

			}
			else{
			
				$value= "no";
			
			}

		}
		elseif($field['fType'] == 7){
					
			$DataArray[$field['fName']]= MakeAge($DataArray[$field['fName']]);
					
		}
		elseif($field['fType'] == 5){
			
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
				
						$ReturnString .= '<div class="profile_box_title marginTop">
						<span class="goL">
							<h1>'.$Caption['caption'].' </h1>
						</span>
						<span class="goR">';
						if($_SESSION['uid'] ==$id){ $ReturnString .= '<a href="'.getThePermalink('account/edit').'" class="pLink"><img src="'.DB_DOMAIN.'images/DEFAULT/_icons/new/pencil.png" align="absmiddle"> '.$GLOBALS['_LANG']['_edit'].' </a>'; }
						$ReturnString .= '</span><div class="ClearAll"></div></div><div class="profile_box_body">';
						$ReturnString .= $DataArray[$field['fName']]."</div>"; 
				
				
			}

		}else{
	
			// DISPLAY THE OUTPUT
			if($DataArray[$field['fName']] !="" && $DataArray[$field['fName']] !="0"){  
				
				$ReturnArr[$field['fid']] = $DataArray[$field['fName']];

			}
	
		}

		$value="";			 
		
	}

	$ReturnArr['username'] = $memberArr['username'];
	$ReturnArr['bigimage'] = $fileArr['bigimage'];

	

	return $ReturnArr;

}






/*  Meet Me Function */


function GetProfilesNearMe ($pageGET){

	global $DB;
	$RunExtra="";
	$RunExtra1="";
	$RunString="";
	$c=1;
	$count=1;
	$loopcount=1;
	$listFavs="";
	$DisplayType =2; // DEFAULT DISPLAY VIEW
	$SHOW_ONLY_NETWORK =0;
	$NETWORK_ID=2;
	$NETWORK_SHOW_SQL="";
	$MODdata['page'] ='profile';
	$MODdata['sub'] ='overview'; $MODdata['type'] ='system';


	///////////////////////MATCH OPTIONS //////////////////////////////

	if($_SESSION['auth'] =="yes" && isset($pageGET['Extra']['match']) && $pageGET['Extra']['match']==1){

		$MData = $DB->Row("SELECT match_array FROM members_privacy WHERE uid= ( '".$_SESSION['uid']."' ) LIMIT 1");	

		$get_myarray = unserialize($MData['match_array']);

		if(is_array($get_myarray)){

		foreach($get_myarray as $Match){

					if(strlen($Match['value']) > 0 && $Match['value'] !='0'){

							// BUILD AGE STRING
							if($Match['name']=="country"){

							$RunExtra .= " ( ".$Match['name']." = '".$Match['value']."' OR ".$Match['name']." = '".MakeCountry($Match['value'])."' ) AND ";

							}elseif($Match['name']=="age"){
								$ageSlipt = explode("-",$Match['value']);							

								$RunExtra .= " members_data.age BETWEEN '".GetAgeYear(trim($ageSlipt[1]))."-00-00' AND '".GetAgeYear(trim($ageSlipt[0]))."-".date("m")."-".date("d")."' AND ";

							}else{

								$RunExtra .= "   ".$Match['name']." = '".$Match['value']."' AND ";

							}

					}

		}	}

	

	}  

	///////////////////////////////////////////////////////////////////////	

	////////////////////// MAKE FAVOURITE ARRAY LIST //////////////////////

	if($_SESSION['auth'] =="yes" && isset($pageGET['Extra']['favorite']) && $pageGET['Extra']['favorite']==1){
			$listFavs="AND ( members.id = '-10' ";

			$result55 = $DB->Query("SELECT members_network.to_uid

			FROM members_network 

			LEFT JOIN members ON ( members.id = members_network.to_uid )

			LEFT JOIN files ON ( files.uid = members.id )

			WHERE members_network.uid='".$_SESSION['uid']."' AND members_network.type='20' ORDER BY members_network.id DESC");

			

			while( $row5 = $DB->NextRow($result55)){		



					$listFavs .="  || members.id ='".$row5['to_uid']."'";				

			}

			/// END 

			$listFavs.=")";

	}	

	#######################################################################

	if(D_ZIPCODES ==1 && isset($pageGET['zipcode_value']) && strlen($pageGET['zipcode_value']) > 2 && $pageGET['zipcode_value'] != $GLOBALS['LANG_SEARCH_INNER']['65']){

		require_once "inc/classes/class_zipcodes.php";

		$zipcode_data = new member_zipcodes;

		$zip_value =		eMeetingInput($pageGET['zipcode_value']);

		$zip_distance =		eMeetingInput($pageGET['postcode_distance']);


		/* RADIUS SEARCH WITHIN XX MILES OF XX ZIP CODE */

		$RunExtra .= " ( members_data.postcode LIKE '%$zip_value%' OR ";

		$zips = $zipcode_data->get_zips_in_range($zip_value, $zip_distance);

		if (!empty($zips)){

		   foreach ($zips as $key => $value) {

			 $RunExtra .= " members_data.postcode='".$key."' OR";

		   }	   

		}

		$RunExtra .= " members_data.postcode='99999999' ) AND ";

		$RunString .=", members_data.postcode";

	}

	#######################################################################			

	################## POSTAL CODE DATABASE (UK ONLY)  ####################

	if(D_POSTCODES == 1 && isset($pageGET['postcode_value']) &&  strlen($pageGET['postcode_value']) > 2) {

		$postcode_value =		eMeetingInput($pageGET['postcode_value']);

		$postcode_distance =	eMeetingInput($pageGET['uk_postcode_distance']);
		$postcode_distance = $postcode_distance *1000;

		if(!is_numeric($postcode_distance)){ $postcode_distance=50; }

		/* RADIUS SEARCH WITHIN XX MILES OF XX postcode */

		$str = strtoupper($postcode_value);	$pos = strpos($str,' ');

		if(strlen($str)>3){ 	if($pos){	$str =substr($str,0,strpos($str,' ')); 	}	}
		// else{		$str = substr($str,0,strlen($str)-3); 	}

		$co= $DB->Row("SELECT latitude, longitude FROM postcodescoords WHERE postcode LIKE '$str%' LIMIT 0,1");

		$latitude =$co['latitude'];

		$longitude=$co['longitude'];

		if(!empty($co)){

			$RunExtra .= " ( members_data.postcode LIKe '%$postcode_value%' OR ";

			//  $codequery = $DB->Query("SELECT * , 6371.04 * acos( cos( pi( ) /2 - radians( 90 - `latitude` ) ) * cos( pi( ) /2 - radians( 90 - ".$latitude.") ) * cos( radians(`longitude` ) - radians( ".$longitude.") ) + sin( pi( ) /2 - radians( 90 - `latitude` ) ) * sin( pi( ) /2 - radians( 90 - ".$latitude.") ) ) AS `dist` FROM `postcodescoords`GROUP BY `postcode` HAVING `dist`<$postcode_distance ORDER BY `dist` ");


	$codequery = $DB->Query("SELECT dest.postcode, dest.easting, dest.northing 
	FROM postcodescoords AS source, postcodescoords AS dest 
	WHERE source.postcode ='$str' 
	AND ((dest.easting < (source.easting + $postcode_distance) 
	AND dest.easting > (source.easting - $postcode_distance)) 
	AND (dest.northing < (source.northing + $postcode_distance) 
	AND dest.northing > (source.northing - $postcode_distance))) 
	ORDER BY dest.postcode ASC" );


			while( $coRow = $DB->NextRow($codequery) )
			{

				 $RunExtra .= " members_data.postcode LIKE '".$coRow['postcode']."%' OR";

			}

			$RunExtra .= " members_data.postcode='99999999' ) AND members_data.country = '385' AND ";

			$RunString .=", members_data.postcode";

		}

	}

	

	#######################################################################			

	####################### BUILD EXTRA QUERY STRING  #####################



	// make default search not display my gender type

	//if(empty($pageGET) && $_SESSION['auth'] =="yes"){ 

		//$RunExtra1 .= " members_data.gender !=('".$_SESSION['genderid']."') AND ";

  	//}

	if(isset($pageGET['SeV']['2']) && $_SESSION['auth'] =="yes"){
		
		$RunExtra1 .= " members_data.gender =('".$pageGET['SeV']['2']."') AND ";

	}

	if(isset($pageGET['SeV']['1']) && $_SESSION['auth'] =="yes" && $pageGET['SeV']['1'] != 0){
		
		$RunExtra1 .= " members_data.country =('".$pageGET['SeV']['1']."') AND ";

	}


	// build extra strings


	// BUILDING SORT STRING

	////////////////////////////////////////////////////////


	$OrderByThis = "members.lastlogin DESC"; 

	// build extra strings

	// build age string
	if(isset($pageGET['Extra']['age1']) && is_numeric($pageGET['Extra']['age1']) && isset($pageGET['Extra']['age2']) && $pageGET['Extra']['age2'] !='0' ){

		//die($pageGET['Extra']['age1']."--".$pageGET['Extra']['age2']);

		if($pageGET['Extra']['age1'] > $pageGET['Extra']['age2']){

			$AgeFinder1 = $pageGET['Extra']['age2'];

			$AgeFinder2 = $pageGET['Extra']['age1'];

			$pageGET['Extra']['age1'] = $AgeFinder1;

			$pageGET['Extra']['age2'] = $AgeFinder2;			

		}

		$RunExtra .= " members_data.age BETWEEN '".GetAgeYear(eMeetingInput($pageGET['Extra']['age2']))."-AAA-01' AND '".GetAgeYear(eMeetingInput($pageGET['Extra']['age1']))."-ZZZ-31'  AND ";
	}

	///////////////// GALLERY VIEW PHOTOS ONLY




	#######################################################################			

	###################### BUILD FINISHED QUERY  ##########################

	// build extra strings

	
	$append = 0;
	

	$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY
	


	## make SQL query

		$QQ ="SELECT $NETWORK_SHOW_SQL package.icon, album.cat, members_data.postcode, files.featured, members.active AS ThisApproved, members.msgStatus, members.video_duration, files.bigimage, files.type, files.approved, files.adult_content, members_online.logid AS onlinenow, members.id, members.packageid, members.username, members.highlight, members.lastlogin, members_data.gender , members_data.headline, members_data.description, members_data.age, members_data.location, members_data.country $RunString 

		FROM members	

		INNER JOIN members_data ON ( $RunExtra members.id = members_data.uid )";

		$append = 0;
		if($RunExtra ==''){
			$append = 1;
		}

		if($SHOW_ONLY_NETWORK ==1){


		if(($NETWORK_ID ==1) || ($NETWORK_ID ==3)){

				$QQ .="INNER JOIN members_network ON ( members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."'  AND members_network.type= ( '".$NETWORK_ID."' ) )";

		}else{

			$QQ .="INNER JOIN members_network ON ( ( (members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."' )  OR  ( members.id = members_network.uid AND members_network.to_uid='".$NETWORKD_FRIEND_ID."' ) )  AND members_network.type= ( '".$NETWORK_ID."' ) )";

		}




		}



	if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

		$QQ .=" INNER JOIN members_online ON ( members_online.logid = members.id ) ";
		
		
	}else{
		
		$QQ .=" LEFT JOIN members_online ON ( members_online.logid = members.id ) ";

	}

		$QQ .=" LEFT JOIN package ON ( members.packageid = package.pid ) ";

		if(SEARCH_WITHOUT_PICS =="no"){  // dont display profiles without images

			 //$QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%' AND title != 'Message Photo') ";
			 $QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%') ";
		}else{

			 //$QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%' AND files.type='photo' AND title != 'Message Photo')	";
			 $QQ .= " LEFT JOIN files ON ( files.uid = members.id AND files.default LIKE '%1%' AND files.type='photo')	";
		}

		$QQ .= " LEFT JOIN album ON ( album.aid = files.aid) ";

		$QQ .="WHERE $RunExtra1 members.email !='' AND members.id != '".$_SESSION['uid']."' AND members.visible = 'yes' ";

		if(isset($pageGET['Extra']['online']) && $pageGET['Extra']['online']==1 || ( isset($getData['online']) && $getData['online']== 1 ) ){

			$GroupByThis = "members.id";

		}else{

			$GroupByThis = "members.id";

		}
		$member_limit = '';
		//if($append){
			//$member_limit = 'and members.id <= 104000';
		//}

		$QQ .=" $listFavs $member_limit GROUP BY ".$GroupByThis." ORDER BY ".$OrderByThis." LIMIT 300";


		if($SHOW_ONLY_NETWORK ==1){
$QQ ="SELECT $NETWORK_SHOW_SQL '' as icon, members_data.postcode, 'no' as featured,  members.active AS ThisApproved, members.msgStatus, members.video_duration, 'x.jpg' as  bigimage, 'photo' as type, 'yes' as approved, 'no' as adult_content, '1' as onlinenow, members.id,  members.packageid, members.username, members.highlight, members.lastlogin,  members_data.gender , members_data.headline, members_data.description, members_data.age,  members_data.location, members_data.country 
		FROM members	
		INNER JOIN members_data ON ( $RunExtra members.id = members_data.uid )";
		

if(($NETWORK_ID ==1) || ($NETWORK_ID ==3)){

		$QQ .="INNER JOIN members_network ON ( members.id = members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."'  AND members_network.type= ( '".$NETWORK_ID."' ) )";

}else{

	$QQ .="INNER JOIN members_network ON ( ( (members.id =  members_network.to_uid AND members_network.uid='".$NETWORKD_FRIEND_ID."' )  OR  (  members.id = members_network.uid AND members_network.to_uid='".$NETWORKD_FRIEND_ID."' )  )  AND members_network.type= ( '".$NETWORK_ID."' ) )";

}



		$QQ .="WHERE $RunExtra1 members.email !='' AND members.id != '".$_SESSION['uid']."' AND members.visible = 'yes' ";

		$QQ .=" $listFavs GROUP BY ".$GroupByThis." ORDER BY members_network.approved DESC, members_network.id DESC  LIMIT 300";

		

		}

	//print $QQ;

	$result = $DB->Query($QQ);

	$DataArray = array(); $Counter=1;



	while( $Data = $DB->NextRow($result) )

    {

		$DataArray[$Counter]['id'] = $Data['id'];
		$DataArray[$Counter]['username'] = $Data['username'];
		$DataArray[$Counter]['bigimage'] = $Data['bigimage'];

		$Counter++;
	}
	return (!empty($DataArray)) ? $DataArray	 : 0;

}

?>
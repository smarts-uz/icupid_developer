<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );




function DisplayTerms(){

	global $DB;

    $result = $DB->Row("SELECT value2 FROM system_settings  WHERE id=5");
	return $result['value2'];
}

function DisplayRegPhoto($id=0){

	global $DB;
	$ShowArray = array();
	
	## CHECK FOR NULL VALUE
	if($id ==0){
		$ExtraString = "WHERE files.type='photo' ORDER BY RAND() LIMIT 1";
	}else{
		$ExtraString = "WHERE files.type='photo' AND files.default=1 AND members.id='".strip_tags($id)."' ORDER BY files.id DESC LIMIT 1";
	}

	echo "SELECT members_online.logid AS onlinenow, album.cat, files.approved, files.bigimage, members.id, members.username, members_data.age, members_data.gender , members_data.headline, members_data.description, members_data.location, members_data.country
		FROM members
		INNER JOIN members_data ON ( members.id = members_data.uid ) 
		LEFT JOIN files ON ( files.uid = members_data.uid )
		LEFT JOIN album ON ( album.aid = files.aid ) 
		LEFT JOIN members_online ON ( members_online.logid = members_data.uid ) $ExtraString";
	
    $result = $DB->Row("SELECT members_online.logid AS onlinenow, album.cat, files.approved, files.bigimage, members.id, members.username, members_data.age, members_data.gender , members_data.headline, members_data.description, members_data.location, members_data.country
		FROM members
		INNER JOIN members_data ON ( members.id = members_data.uid ) 
		LEFT JOIN files ON ( files.uid = members_data.uid )
		LEFT JOIN album ON ( album.aid = files.aid ) 
		LEFT JOIN members_online ON ( members_online.logid = members_data.uid ) $ExtraString");

	 
 	$ShowArray['username'] =  $result['username'];
	$ShowArray['gender'] =  MakeGender($result['gender']);
	$ShowArray['age'] =  MakeAge($result['age']);
	$ShowArray['headline'] =  $result['headline'];
	$ShowArray['description'] =  $result['description'];
	$ShowArray['location'] =  $result['location'];
	$ShowArray['country'] =  $result['country'];

	///////////////////////////////////////////////////////////////////////////////////////////////////
	if($result['bigimage'] != ""){
		
		if($result['approved'] =="no"){

			$Uimage = WATINGAPPROVAL_IMAGE;
					
		}elseif($result['cat'] =="private"){
									
			$Uimage = DEFAULT_IMAGE_ADULT;

		}else{						
		
			$Uimage = WEB_PATH_IMAGE.$result['bigimage'];
		
		}		
	
	}
	else{
	
		$Uimage = DEFAULT_IMAGE;
	
	}
	
	$ShowArray['image'] = $Uimage; 			// MEMBERS PHOTO
	/////////////////////////////////////////////////////////

	if(isset($result['onlinenow']) && $result['onlinenow'] !=""){

		$OnlineM = true;

	}else{

		$OnlineM = false;

	}	 

	$ShowArray['onlinenow'] = $result['onlinenow'];		// MEMBERS ONLINE NO
		
		
	return $ShowArray;

}

function DisplayRegisterPagination($group=1) {

	global $DB;

	## define variables
	$NumFields = 1;	$divCount =1; $divString=""; $ReturnString=""; $HideBox=1;

	## assign value for gender ID if not assigned
	if(!isset($_SESSION['genderid'])){ $_SESSION['genderid']=0; }

	## TOTAL GROUPS
	$Total = $DB->Row("SELECT count(id) AS total FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).")");

	$total_groups = $Total['total'];
	
	$total_groups++;

	if(VALIDATE_EMAIL ==1 ){
		$total_groups++;
	}


	$total_groups_width = 100 - ($total_groups * 8);

	$group_width = $total_groups_width/$total_groups;
	
	## search for all fields for this member
	$result = $DB->Query("SELECT id, caption FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).") ORDER BY forder ASC");


	$return = '<div class="reg-steps-container">';
	$return .= '<div class="reg-steps-num" id="reg-pagination"><ul class="steps-list">';
	$return .= '<li style="width:'. bcdiv($group_width, 1, 2).'%;"><div class="step active">'.$group.'</div></li>';
	$group++;


	while( $groups = $DB->NextRow($result) ){
            
            $SQL = "SELECT field.fid,field.fType, field.fName,field.linked_id "
                        . "FROM field INNER JOIN field_groups ON "
                        . "( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  ) "
                        . "WHERE field.required = 1 AND field.fName "
                        . "NOT IN ('country','em_85820081128','location','milesfrom','postcode') "
                        . "AND ( field.groupid = '".$groups['id']."' OR field.groupid_1 ="
                        . " '".$groups['id']."' OR field.groupid_2 = '".$groups['id']."') "
                        . "GROUP BY field.fid ORDER BY field.fOrder ASC";

                

		$result1 = $DB->Query($SQL);

                  $fieldCount=$DB->NumRows($result1);
                if($fieldCount>0)
                {
		
		
		 
		$return .= '<li style="width:'.bcdiv($group_width, 1, 2).'%;"><div class="step">'.$group.'</div></li>';

		
	
		$group++;
                }
	
	}
	if(VALIDATE_EMAIL ==1 ){
		$return .= '<li style="width:'.bcdiv($group_width, 1, 2).'%;"><div class="step">'.$group.'</div></li>';
	}

	$return .= '</ul><hr/></div></div>';

	return $return;
}



?>
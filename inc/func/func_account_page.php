<?php 

// no direct access

defined( 'KEY_ID' ) or die( 'Restricted access' );

/**
* Info: Display profile data for edit
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

function EditMember($id,$group=0){




	global $DB;

	## define variables
	$NumFields = 1;	$divCount =1; $divString=""; $ReturnString=""; $HideBox=1;

	## assign value for gender ID if not assigned
	if(!isset($_SESSION['genderid'])){ $_SESSION['genderid']=0; }


	## TOTAL GROUPS
	$Total = $DB->Row("SELECT count(id) AS total FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).")");

	## search for all fields for this member
	$result = $DB->Query("SELECT id, caption FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).") ORDER BY forder ASC");

	$arrLocation = GetLocationDetails($_SERVER['REMOTE_ADDR']);
	
    while( $groups = $DB->NextRow($result) ){

		if ($group > 0) { 
			if ($groups['id'] == $group) {
				$tT = "style='display:visible'";
			}else{
				 $tT = "style='display:none'";
			}
		}else{
				if($HideBox > 1){ $tT = "style='display:none'"; }else{ $tT = "style='display:visible'"; }
		}

		if(D_USER_REGISTRATION == "sliding"){
			$tT = " class='cslide-slide'";
		}

		## start output display

		$ReturnString .= '<div id="bod_'.$HideBox.'"  '.$tT.' >';


		if(D_USER_REGISTRATION == "sliding"){

			$ReturnString .= '<div class="row registration-container">
					<div class="col-md-12">
						<h3>'.$groups['caption'].'</h3>
					</div>
				</div>';
		}
		else{
			$ReturnString .= '<div class="menu_box_title1">
				<span>
					<a onclick="new Effect.toggle(\'bod_'.$groups['id'].'\',\'blind\', {queue: \'end\'}); ">
						<img src="'.DB_DOMAIN.'images/DEFAULT/blank.gif" width="30" height="29" onClick="expandcontent(this,\'bod_'.$groups['id'].'\')" class="menu_expand">
					</a>
				</span>

				'.$groups['caption'].'
			</div>';			
		}


		if(D_USER_REGISTRATION == "sliding"){
			$body_class="CapBody";
		}
		else{
			$body_class="menu_box_body1";
		}

		## select data value
		//echo "SELECT * FROM members_data_pending_approval WHERE  uid= ('".$id."') limit 1";
		//die();

		$Value = $DB->Row("SELECT * FROM members_data_pending_approval WHERE  uid= ('".$id."') limit 1");

		if(isset($Value['uid']) && $Value['uid'] != "" && APPROVE_ACCOUNTS =="yes"){

		}
		else{
			$Value = $DB->Row("SELECT * FROM members_data WHERE  uid= ('".$id."') limit 1");	
		}
		

		$ReturnString .= '<div class="'.$body_class.'">';

		## select group fields

		$SQL = "SELECT field.fid,field.fType, field.fName,field.linked_id"
                        . " FROM field INNER JOIN field_groups ON "
                        . "( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  ) "
                        . "WHERE field.fName NOT IN ('country','em_85820081128','location','milesfrom','postcode') "
                        . "AND ( field.groupid = '".$groups['id']."' OR field.groupid_1 = '".$groups['id']."'"
                        . " OR field.groupid_2 = '".$groups['id']."') GROUP BY field.fid ORDER BY field.fOrder ASC";

	

		$result1 = $DB->Query($SQL);

		$textarea_count = 1;

		$group_field_ids = array();

		while( $field = $DB->NextRow($result1) ){

			$group_field_ids[] = $field['fid'];
		

			## determin field caption based on language

			if(D_LANG !="english"){



				## check see if there is a caption

				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang= ( '".D_LANG."' ) limit 1");						

				if(empty($Caption)){

					## no caption found, load english caption

					$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' limit 1");

				}

						

			}else{

				## check for english value						

				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang='".D_LANG."' limit 1");

			}



			## build output
			$input_div_class = "";
			$input_field_class = "";
			if(D_USER_REGISTRATION == 'sliding'){
				$ReturnString .= '<div class="col-md-6"><label>'.$Caption['caption'].'</label>';					
				

				$input_field_class = "col-md-12 form-control";

			}
			else{
				$ReturnString .= '<li><label>'.$Caption['caption'].'</label>';					
			}

					

			## clean the value for output

			if($field['fType'] == 2){ $Value[$field['fName']] = eMeetingOutput($Value[$field['fName']],true); }else{ $Value[$field['fName']] = eMeetingOutput($Value[$field['fName']]); }



			## choose our field type, 1 = input box

			if($field['fType'] == 1){	

				//echo "NAME -- ".$field['fName'];

				if($field['fName'] =="age"){

					if($Value[$field['fName']] == ""){ $Value[$field['fName']]="0000-00-00"; }								
					$ReturnString .= MakeAge($Value[$field['fName']])." ".$GLOBALS['_LANG']['_yold']." <script>DateInput('FieldValue".$field['fid']."', true, 'YYYY-MON-DD','".$Value[$field['fName']]."')</script>";

				}else{

					if($field['fName'] == 'location'){
						$ReturnString .= "<input name='FieldValue".$field['fid']."' class='input ".$input_field_class."' type='text' id='registerLocation' maxlength='255' size='42' value=\"".$Value[$field['fName']]."\">";
					}
					else{
						$ReturnString .= "<input name='FieldValue".$field['fid']."' class='input ".$input_field_class."' type='text' maxlength='255' size='42' value=\"".$Value[$field['fName']]."\">";
					}
				}					

				## checkbox input

			}
			else if($field['fType'] == 4){

				if($Value[$field['fName']] ==1){ $ex = "checked"; }else{ $ex="";}

				$ReturnString .= "<input type='checkbox' name='FieldValue".$field['fid']."' value='1' $ex>";

				## textarea input

			}
			else if($field['fType'] == 2){

				$ReturnString .= "<div class='ClearAll '></div><textarea name='FieldValue".$field['fid']."' class='input ".$input_field_class." countessays fieldGroup_".$groups['id']." field_id_".$field['fid']." 
			' cols='5' rows='7' id='editor".$textarea_count."' style='width:600px;'>".$Value[$field['fName']]."</textarea> <p class='note response_span_gen' style='display: none;'></p>";

				$textarea_count++;

				## selection list box

			}
			else if($field['fType'] == 3){

				if($field['fName'] == 'country'){/*

					$linkcode = "";
					
					/* This is a list box *//*

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					if(!empty($Linked) && $field['fName'] !="gender"){

						$LinkedCode ="onChange='eMeetingNetworkStates(this.value, ".$Linked['fid'].");'";

					}

					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select name='FieldValue".$field['fid']."' $LinkedCode>";

					$ReturnString .= "<option value='0'>------------------</option>";

					/*while( $ListValue = $DB->NextRow($result2) ) {

						if($Val == $ListValue['geo_network_country_id']){

							$ReturnString .= "<option value='".$ListValue['geo_network_country_id']."' selected>".$ListValue['country_name']."</option>";

						}else{

							$Selecteed ="";

							$ReturnString .= "<option value='".$ListValue['geo_network_country_id']."' ".$Selecteed.">".$ListValue['country_name']."</option>";

						}

					}*//*
					if(isset($Value['country']) && $Value['country'] !="" && $Value['country'] !="0"){

						$ReturnString .= DisplayNetworkCountries($Value['country']);

					}
					else{

						$ReturnString .= DisplayNetworkCountries($arrLocation['country_id']);
					
					}

					

					// BACKUP INCASE NOT VALUES FOUND

					$ReturnString .= "</select></div>";


				*/}
				else if($field['fName'] == 'em_85820081128'){/*

					$linkcode = "";
					if(isset($_POST['em_85820081128']) && $_POST['em_85820081128'] !="0"){

					}

					/* This is a list box *//*

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					$LinkedCode = "";
					if(!empty($Linked) && $groups['fName'] !="gender"){

						$LinkedCode ="onChange='eMeetingNetworkCities(this.value, ".$Linked['fid'].",0);'";

					}

					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select name='FieldValue".$field['fid']."' $LinkedCode>";

					$ReturnString .= "<option value='0' selected>------------------</option>";

					// BACKUP INCASE NOT VALUES FOUND

					if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){

						if(isset($Value['country']) && $Value['country'] !="0" && $Value['country'] !=""){
							
							$ReturnString .= DisplayNetworkStates($Value['country'], $Value['em_85820081128']);

						}
						else{

							$ReturnString .= DisplayNetworkStates($arrLocation['country_id'], $Value['em_85820081128']);
						}

					}
					else{

						if(isset($Value['country']) && $Value['country'] !="0" && $Value['country'] !=""){
							
							$ReturnString .= DisplayNetworkStates($Value['country'], $arrLocation['state_id']);

						}
						else{

							$ReturnString .= DisplayNetworkStates($arrLocation['country_id'], $arrLocation['state_id']);
						}

						
					}

					

					$ReturnString .= "</select></div>";


				*/}
				else if($field['fName'] == 'location'){

					$linkcode = "";
					if(isset($_POST['location']) && $_POST['location'] !="0"){

					}

					/* This is a list box */

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select name='FieldValue".$field['fid']."'>";

					$ReturnString .= "<option value='0' selected>------------------</option>";

					// BACKUP INCASE NOT VALUES FOUND

					if(isset($Value[$field['fName']]) && $Value[$field['fName']] !="0" && $Value[$field['fName']] !=""){

						if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){
							
							$ReturnString .= DisplayNetworkCities($Value['em_85820081128'], $Value['location']);

						}
						else{

							$ReturnString .= DisplayNetworkCities($arrLocation['state_id'], $Value['location']);
						}

					}
					else{

						if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){
							
							$ReturnString .= DisplayNetworkCities($Value['em_85820081128'], $arrLocation['city_id']);

						}
						else{

							$ReturnString .= DisplayNetworkCities($arrLocation['state_id'], $arrLocation['city_id']);
						}
						
						
					}

					$ReturnString .= "</select></div>";


				}
						
				else{
				// check if there is a field linked to this one

				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");

				if(!empty($Linked)){

					$storeLastLinked = $Linked['fid'];

					$LinkedCode ="onchange='eMeetingLinkedField(this.value, ".$Linked['fid'].",0);'";

				}else{ $LinkedCode =""; }


				## find caption

				if(D_LANG !="english"){

					## check see if there is a caption					

					$test = $DB->Row("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					if(empty($test)){

						## no caption found, load english caption

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='english' Order by fvOrder");

					}
					else{				

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					}

				}
				else{

					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

				}		

				## build output

				if(isset($storeLastLinked) && $storeLastLinked == $field['fid']){

					if(isset($StoreCountry) && is_numeric($StoreCountry)){

						$ReturnString .= "<div id='Link".$field['fid']."' class='".$input_div_class."'> <a href='javascript:void(0);' onchange=\"eMeetingLinkedField(".$StoreCountry.", 54,0);\">".MakeCountry($Value[$field['fName']],$field['fid'])." <input type='hidden' class='hidden' name='FieldValue".$field['fid']."' value='".$Value[$field['fName']]."'></a> </div>";

					 }
					 else{

						$ReturnString .= "<div id='Link".$field['fid']."'>".MakeCountry($Value[$field['fName']],$field['fid'])." </div>";						

					}

				}

				else{

					if($field['fid'] =="25"){ $StoreCountry = $Value[$field['fName']]; } // country box fix

					if(D_USER_REGISTRATION == 'sliding'){
						$select_style = "";
					}
					else{
						$select_style = "style='width:250px;'";
					}

					$ReturnString .= "<div id='Link".$field['fid']."'><select name='FieldValue".$field['fid']."' class='input ".$input_field_class."' $select_style ".$LinkedCode.">";
					

					$ReturnString .= "<option value='0'>------------------</option>";

					while( $ListValue = $DB->NextRow($result2) ){		

						if($Value[$field['fName']] == $ListValue['fvid']){

							$ReturnString .= "<option value='".$ListValue['fvid']."' selected>".$ListValue['fvCaption']."</option>";

						}
						else{

							$ReturnString .= "<option value='".$ListValue['fvid']."'>".$ListValue['fvCaption']."</option>";

						}
						
					}	

					$ReturnString .= "</select></div>";

				}

				}
			## multiple checkbox											

			}
			elseif($field['fType'] == 5){

				$ReturnString .= "<div class='ClearAll'></div><br><table width='100%'  border=0><tr> ";

				$c=0; $tdC =2;

				$CheckParts = explode("**", $Value[$field['fName']]);

				
				$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

				if( mysqli_num_rows($result2)==0 ) {								
					## no values found, load english values
					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."'  Order by fvOrder");
				}							


				while( $ListValue = $DB->NextRow($result2) ) {

					$ReturnString .= "<td width='25%'><span>";

					if(isset($CheckParts[$c]) && $CheckParts[$c] ==1){

						$ReturnString .= "<input type='checkbox' name='Multi".$c.$field['fid']."' value='1' class='radio' checked><font size=1>&nbsp;&nbsp;".$ListValue['fvCaption'];

					}else{

						$ReturnString .= "<input type='checkbox' name='Multi".$c.$field['fid']."' value='1' class='radio'><font size=1>&nbsp;&nbsp;".$ListValue['fvCaption'];

					}

					$ReturnString .= "</font>";					

					## include hidden fields for saving data

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldValue".$field['fid']."' value='".$field['fName']."'>";

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldName".$field['fid']."' value='".$field['fName']."'>";

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldType".$field['fid']."' value='".$field['fType']."'>";					

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldMulti".$c.$field['fid']."' value='".$c."'>";

					$ReturnString .= "</span></td>";

					$c++;

					if($tdC ==5){ $ReturnString .= '</tr><tr>'; $tdC=1; }

					$tdC++;

				}

				$ReturnString .= "</tr></table>";			

				## input field

			}
			else if($field['fType'] == 6){

				if($Value[$field['fName']] ==1){ $ex = "checked"; }else{ $ex="";}

				$ReturnString .= "<input type='file' name='FieldValue".$field['fid']."' $ex>";

				## age field

			}
			else if($field['fType'] == 7){

				if($Value[$field['fName']] == ""){ $Value[$field['fName']]="0000-00-00"; }								

				$ReturnString .= MakeAge($Value[$field['fName']])." ".$GLOBALS['_LANG']['_yold']."";

				$ReturnString .= "<br>".MakeAgeListField($Value[$field['fName']],$field['fid']);

				## include hidden fields				

			}


			// ADD CUSTOM HIDDEN FIELDS FOR DATABASE NAME VALUES

			if($field['fType'] != 5){

				$ReturnString .= "<input type='hidden' class='hidden' name='FieldName".$field['fid']."' value='".$field['fName']."'>";

				$ReturnString .= "<input type='hidden' class='hidden' name='FieldType".$field['fid']."' value='".$field['fType']."'>";

				//$field['fid']++;

			}


			if(!isset($value)){ $value="<br>"; }

			if(isset($Caption['description']) && $Caption['description'] != ""){

				$ReturnString .= '<div class="tip">'.$Caption['description'].'</div>';

			}

			if(D_USER_REGISTRATION == 'sliding'){

				$ReturnString .= $value."</div>";				

			}else{
			
				$ReturnString .= $value."</li>";				

			}


		}

 		$LastFID = $field['fid'];

		$ThisBox=$HideBox;

		$NextBox=$HideBox+1;

		$PrevBox=$HideBox-1;

		$ReturnString .='<li>';


		if(D_USER_REGISTRATION == 'sliding'){

			if($HideBox !=1){

				$ReturnString .='<a href="javascript:void(0);" class="NormBtn cslide-prev" style="padding:8px;">'.$GLOBALS['_LANG']['_previous'].'</a>';

			}

			if($Total['total'] ==$HideBox){

				$ReturnString .='<input type="submit" value="'.$GLOBALS['_LANG']['_save'].'" class="MainBtn"></li>';

			}else{
				$ReturnString .='<a href="javascript:void(0);" class="NormBtn cslide-next" style="padding:8px;">'.$GLOBALS['_LANG']['_next'].'</a>';

				//$ReturnString .='<span class="NormBtn cslide-next">'.$GLOBALS['_LANG']['_next'].'</span>';
			}

		}
		else{

			if($HideBox !=1){

				$ReturnString .=' <a href="#top" class="NormBtn" onClick="toggleLayer(\'bod_'.$PrevBox.'\'); toggleLayer(\'bod_'.$ThisBox.'\');" style="padding:8px;">'.$GLOBALS['_LANG']['_previous'].'</a>';

			}


			if($Total['total'] ==$HideBox){

				$ReturnString .='<input type="submit" value="'.$GLOBALS['_LANG']['_save'].'" class="MainBtn pull-right"></li>';

			}else{

				$ReturnString .='<a href="#top" class="NormBtn pull-right" onClick="toggleLayer(\'bod_'.$ThisBox.'\'); toggleLayer(\'bod_'.$NextBox.'\');" style="padding:8px;">'.$GLOBALS['_LANG']['_next'].'</a></li>';

			}

		}

		$ReturnString .="</div>";

		$ReturnString .="</div>";

		$divCount++; $HideBox++;

	}

	

	## build total field number output

	$ReturnString .= "<input name='TotalNumberOfRows' type='hidden' value='1000' class='hidden'>";

	

	return $ReturnString;



}



function DisplayAccountPagination($id,$group=1) {

	global $DB;

	## define variables
	$NumFields = 1;	$divCount =1; $divString=""; $ReturnString=""; $HideBox=1;

	## assign value for gender ID if not assigned
	if(!isset($_SESSION['genderid'])){ $_SESSION['genderid']=0; }

	## TOTAL GROUPS
	$Total = $DB->Row("SELECT count(id) AS total FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).")");

	$total_groups = $Total['total'];
	
	$total_groups_width = 100 - ($total_groups * 8);

	$group_width = $total_groups_width/$total_groups;
	
	## search for all fields for this member
	$result = $DB->Query("SELECT id, caption FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).") ORDER BY forder ASC");

	$return = '<div class="reg-steps-container"><div class="reg-steps-num" id="reg-pagination"><ul class="steps-list">';
	$return .= '<li style="width:'. bcdiv($group_width, 1, 2).'%;"><div class="step active">'.$group.'</div></li>';
	
	while( $groups = $DB->NextRow($result) ){

		
		if ($group == '1') {
				
			$return .= '<li style="width:'.bcdiv($group_width, 1, 2).'%;"><div class="step active">'.$group.'</div></li>';
		
		}
		else{
		 
			$return .= '<li style="width:'.bcdiv($group_width, 1, 2).'%;"><div class="step">'.$group.'</div></li>';

		}
	
		$group++;
	
	}

	$return .= '</ul><hr/></div></div>';

	return $return;
}

/**

* Info: Display profile commnets

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/





function DisplayComments($id, $order, $start, $stop, $type="profile"){



		global $DB;

		$Counter =1;

		$DataArray = array(); $extra="";

		$TypeArray = array('profile','blog','video','calendar','comments','groups','classads');

		

		if(!in_array($type,$TypeArray)){ return $DataArray; }



		if($type=="blog"){ $type="profile"; $extra="AND comments.sub='blogview'";}

		//comments.page = ('".$type."') $extra AND

		$SQL = $DB->Query("SELECT comments.*, files.bigimage, files.type, files.adult_content, files.approved AS fileApprove, members.username FROM comments INNER JOIN members ON ( members.id = comments.from_uid  ) LEFT JOIN files ON ( files.uid = comments.from_uid AND files.default LIKE '%1%' AND files.type = 'photo' ) WHERE  comments.to_uid = ( '".$_SESSION['uid']."' ) ORDER BY ".$order." DESC LIMIT $start,$stop");

 

		//$result = $DB->query($SQL);



		## get total count for page numbers

		$totalMsg = $DB->Row("SELECT count(comments.id) AS total FROM comments, members WHERE comments.to_uid = members.id AND comments.to_uid = ( '".$id."' ) ");

 

		while( $Data = $DB->NextRow($SQL) )

		{

			$DataArray[$Counter]['approved'] 		= $Data['approved'];

			$DataArray[$Counter]['fromid'] 			= $Data['from_uid'];

			$DataArray[$Counter]['id'] 				= $Data['id'];

			$DataArray[$Counter]['comments'] 		= eMeetingOutput($Data['comments']);

			$Data['approved'] = $Data['fileApprove'];

			$DataArray[$Counter]['date'] 			= dates_interconv($Data['date']);

			$DataArray[$Counter]['image'] 			= ReturnDeImage($Data,"small");		

			$DataArray[$Counter]['time'] 			= $Data['time'];		

			$DataArray[$Counter]['page'] 			= $Data['page'];	

			$DataArray[$Counter]['subpage'] 		= $Data['sub'];	

			$DataArray[$Counter]['username'] 		= $Data['username'];	


			/*if(D_MOD_WRITE ==1){

					$DataArray[$Counter]['user_link'] 		=	$Data['username'];

			}else{

					$DataArray[$Counter]['user_link'] 		=	"index.php?dll=profile&pId=".$Data['from_uid'];

			}*/

			$DataArray[$Counter]['user_link'] =	getThePermalink('user',array('username' => $Data['username']));

			//$DataArray[$Counter]['subpage'] 		= $Data['ex2_id'];	

			//$DataArray[$Counter]['subpage'] 		= $Data['ex3_id'];	     


			if($Data['sub'] =="viewfile"){ 	

				//$DataArray[$Counter]['link'] =  "index.php?dll=profile&sub=viewfile&item_id=".$Data['to_uid']."&item2_id=1&item3_id=".$Data['ex1_id']."#commentsbox";
				$DataArray[$Counter]['link'] =  getThePermalink("profile/viewfile",array('item_id' => $Data['to_uid'],'item2_id' => '1','item3_id' => $Data['ex1_id']))."#commentsbox";
									

			}elseif($Data['sub'] == "blogview"){

				$DataArray[$Counter]['link'] =  getThePermalink("profile/blogview",array('item_id' => $Data['to_uid'],'item2_id' => $Data['ex1_id']))."#commentsbox";

				//$DataArray[$Counter]['link'] = "index.php?dll=profile&sub=blogview&item_id=".$Data['to_uid']."&item2_id=".$Data['ex1_id']."#commentsbox";

			}else{


				$DataArray[$Counter]['link'] =  getThePermalink($Data['page'].'/'.$Data['sub'].'/'.$Data['ex1_id'])."#commentsbox";

				//$DataArray[$Counter]['link'] = "index.php?dll=".$Data['page']."&sub=".$Data['sub']."&item_id=".$Data['ex1_id']."#commentsbox";				

			}

			$DataArray[$Counter]['totalMsg'] 		= $totalMsg['total'];

			/////////////////////////////////////////////////////////		

			$Counter++;

		}

		return $DataArray;

}





/**

* Info: Display Visitor History

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/







function DisplayHistory($id){



	global $DB;



	## define variables

	$count=0; $todayDate = date("D");	$ReturnString = "";


	if(D_TEMP != "v17red")
	{
		$ReturnString .= "<div class='row'>";
	}

	for($i=0;$i!=30;$i++){

			
			$DisplayDate  = date("l (j F)",mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y")));

			$SearchDate = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y")));			

			

			$DisplayDate = str_replace("Monday", $GLOBALS['_LANG']['_monday'], $DisplayDate);

			$DisplayDate = str_replace("Tuesday", $GLOBALS['_LANG']['_tuesday'], $DisplayDate);

			$DisplayDate = str_replace("Wednesday", $GLOBALS['_LANG']['_wednesday'], $DisplayDate);

			$DisplayDate = str_replace("Thursday", $GLOBALS['_LANG']['_thursday'], $DisplayDate);

			$DisplayDate = str_replace("Friday", $GLOBALS['_LANG']['_friday'], $DisplayDate);

			$DisplayDate = str_replace("Saturday", $GLOBALS['_LANG']['_saturday'], $DisplayDate);

			$DisplayDate = str_replace("Sunday", $GLOBALS['_LANG']['_sunday'], $DisplayDate);

			

			$DisplayDate = str_replace("January", $GLOBALS['_LANG']['_january'], $DisplayDate);

			$DisplayDate = str_replace("February", $GLOBALS['_LANG']['_febuary'], $DisplayDate);

			$DisplayDate = str_replace("March", $GLOBALS['_LANG']['_march'], $DisplayDate);

			$DisplayDate = str_replace("April", $GLOBALS['_LANG']['_april'], $DisplayDate);

			$DisplayDate = str_replace("May", $GLOBALS['_LANG']['_may'], $DisplayDate);

			$DisplayDate = str_replace("June", $GLOBALS['_LANG']['_june'], $DisplayDate);

			$DisplayDate = str_replace("July", $GLOBALS['_LANG']['_july'], $DisplayDate);

			$DisplayDate = str_replace("August", $GLOBALS['_LANG']['_august'], $DisplayDate);

			$DisplayDate = str_replace("September", $GLOBALS['_LANG']['_september'], $DisplayDate);

			$DisplayDate = str_replace("October", $GLOBALS['_LANG']['_october'], $DisplayDate);

			$DisplayDate = str_replace("November", $GLOBALS['_LANG']['_november'], $DisplayDate);

			$DisplayDate = str_replace("Decemeber", $GLOBALS['_LANG']['_december'], $DisplayDate);

			

			

			## make query for this date	

			$result = $DB->Query("SELECT album.cat, files.aid, files.type, files.adult_content, files.approved, files.bigimage, members.username, visited.autoid, visited.uid, visited.date 
			FROM members
			INNER JOIN visited ON (visited.uid = members.id AND visited.uid != ".$_SESSION['uid'].") 
			LEFT JOIN files ON (files.uid = members.id AND files.default=1) 
			LEFT JOIN album ON (album.aid = files.aid) 
			WHERE visited.view_uid= ( '".$id."' ) AND visited.date LIKE '%".$SearchDate."%' GROUP BY visited.uid ORDER BY visited.date DESC LIMIT 200");

			## display output

			$ReturnString .= '';



				$RunCount=0;
				
				
				while( $history = $DB->NextRow($result) ){

					if ($RunCount==0) {
						
						
						if(D_TEMP == "v17red")
						{
							$ReturnString .= "<div class='search_blocks f_left viewed_block viewd_pro_align' id='viewed_myprof'>";
						}
						else
						{
							$ReturnString .= "<div class='col-lg-4 margin_top_10'>";
						}
						$ReturnString .= "<div class='profile_viewer'>
							<div class='menu_box_title1'>".$DisplayDate."</div>
							<div class='menu_box_body1'>";

					}

					if($history['cat'] != "public" && isset($history['id']) && $history['id'] != $_SESSION['uid'])
					{
						$pimage		= 	"inc/tb.php?src=nophoto.jpg&x=48&y=48&x=48&y=48";
					}
					else 
					{
						$pimage = ReturnDeImage($history,"small");
					}		


					$ReturnString .= '<a href="'.getThePermalink('user',array('username' => $history['username'])).'">
						<img class="img-circle" src="'.$pimage.'" align="absmiddle" width=60 height=60 alt="'.$history['date'].'"><br>
						<span>'.$history['username'].'</span>
					</a>';
				
					
					$ReturnString .= "</div>"; // End of div element  added for customizations
					
					
					$count++;

					$RunCount ++;					

				}
				
				
			if($RunCount==0){ 
				$ReturnString .= ''; }
			else {
				$ReturnString .= '<div class="ClearAll"></div></div></div>';			
			}
			

	}
	
	if(D_TEMP != "v17red")
	{
		$ReturnString .= "</div>";
	}

	## return output for display

	return $ReturnString;

	

}



/**

* Info: Get Comments Array

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/



function GetCommentTotals(){

return 0;

	global $DB; $Counter=1; $i=1; $ReturnTotal=array();





	$SQL = "select row_num from 

		(

			SELECT count(page) AS row_num FROM comments WHERE comments.to_uid = ( '".$_SESSION['uid']."' ) AND comments.page ='profile'

	 

			union ALL

	

			SELECT count(page) AS row_num FROM comments WHERE comments.to_uid = ( '".$_SESSION['uid']."' ) AND comments.page ='groups'



			union ALL

	

			SELECT count(page) AS row_num FROM comments WHERE comments.to_uid = ( '".$_SESSION['uid']."' ) AND comments.page ='videos'



			union ALL

	

			SELECT count(page) AS row_num FROM comments WHERE comments.to_uid = ( '".$_SESSION['uid']."' ) AND comments.page ='calendar'



			union ALL

	

			SELECT count(page) AS row_num FROM comments WHERE comments.to_uid = ( '".$_SESSION['uid']."' ) AND comments.page ='classads'



			union ALL

	

			SELECT count(page) AS row_num FROM comments WHERE comments.to_uid = ( '".$_SESSION['uid']."' ) AND comments.page ='profile' AND comments.sub ='blogview'



		) as derived_table";



	$Data = $DB->Query($SQL);

 

 	while( $DataArray = $DB->NextRow($Data) ){



		$Total[$Counter]['total'] = $DataArray['row_num']; 

		$Counter++;

	}



	

	while($i < 7){



		if(isset($Total[$i]['total'])){ $ReturnTotal[$i]['total'] =$Total[$i]['total']; }else{ $ReturnTotal[$i]['total'] =0; }

	 

		$i++;



	}



	return $ReturnTotal;



}




/*  D_USER_REGISTRATION IS SLIDING  */


function EditMemberSliding($id,$group=0,$page =""){

	global $DB;
	 

	## define variables
	$NumFields = 1;	$divCount =1; $divString=""; $ReturnString=""; $HideBox=1;

	## assign value for gender ID if not assigned
	if(!isset($_SESSION['genderid'])){ $_SESSION['genderid']=0; }

	## TOTAL GROUPS
	$Total = $DB->Row("SELECT count(id) AS total FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).")");

	## search for all fields for this member

	$result = $DB->Query("SELECT field_groups.id, field_group_languages.caption FROM field_groups left join field_group_languages ON field_groups.id = field_group_languages.fgid AND field_group_languages.language ='".$_SESSION['lang']."' WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).") ORDER BY forder ASC");

 
	## select data value

	$Value = $DB->Row("SELECT * FROM members_data_pending_approval WHERE  uid= ('".$id."') limit 1");
	if(isset($Value['uid']) && $Value['uid'] != "" && APPROVE_ACCOUNTS =="yes"){

	}
	else{
		$Value = $DB->Row("SELECT * FROM members_data WHERE  uid= ('".$id."') limit 1");	
	}
	
	$arrLocation = GetLocationDetails($_SERVER['REMOTE_ADDR']);
	 
    while( $groups = $DB->NextRow($result) ){

		if ($group > 0) { 

			if ($groups['id'] == $group) {

				$tT = "style='display:visible'";

			}else{

				 $tT = "style='display:none'";

			}

		}else{
				if($HideBox > 1){ $tT = "style='display:none'"; }else{ $tT = "style='display:visible'"; }
		}
		if($groups['caption'] == '' || $groups['caption'] == NULL) {
    		$getGroupCaption = $DB->row("SELECT * FROM field_groups WHERE id=".$groups['id']);
    		$groups['caption'] = $getGroupCaption['caption'];

    	} 
		if(D_USER_REGISTRATION == "sliding"){
			$tT = " class='cslide-slide'";
		}

		## start output display

		$ReturnString .= '<div id="bod_'.$HideBox.'"  '.$tT.' >';

		$slide_count = 0;
		$ReturnString .= '<div class="registration-container">';

		$ReturnString .= '<div class="row ">
			<div class="col-md-12">
				<h3>'.$groups['caption'].'</h3>
			</div></div>';
		

		## select group fields

		$SQL = "SELECT field.fid,field.fType, field.fName,field.linked_id "
                        . "FROM field INNER JOIN field_groups ON "
                        . "( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  ) WHERE field.fName "
                        . "NOT IN ('country','em_85820081128','location','milesfrom','postcode') "
                        . "AND ( field.groupid = '".$groups['id']."' OR field.groupid_1 ="
                        . " '".$groups['id']."' OR field.groupid_2 = '".$groups['id']."') "
                        . "GROUP BY field.fid ORDER BY field.fOrder ASC";

                

		$result1 = $DB->Query($SQL);

		$textarea_count = 1;
		$ques_count = 0;

		$group_field_ids = array();

		while( $field = $DB->NextRow($result1) ){

			$group_field_ids[] = $field['fid'];

			## determin field caption based on language

			if(D_LANG !="english"){



				## check see if there is a caption

				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang= ( '".D_LANG."' ) limit 1");						

				if(empty($Caption)){

					## no caption found, load english caption

					$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' limit 1");

				}

						

			}else{

				## check for english value						

				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang='".D_LANG."' limit 1");

			}



			## build output
			$input_div_class = "";
			$input_field_class = "";
			

			if($slide_count%2 == 0){
				$ReturnString .= '<div class="row">';
			}

			if($field['fType'] == 2 || $field['fType'] == 5){
				$lable_field_class = "col-md-12";
			}
			else{
				$lable_field_class = "col-md-6";
			}
			
			$ReturnString .= '<div class="'.$lable_field_class.' ques_label"  data-count="'.$ques_count.'"><label>'.$Caption['caption'].'</label>
			<p class="checkbox_valid validate_field_id_'.$field['fid'].'" style="display: none;"></p>';					


			$input_field_class = "col-md-12 form-control";

			

					

			## clean the value for output

			$Value[$field['fName']] = (isset($Value[$field['fName']])) ? $Value[$field['fName']] : "";

			if($field['fType'] == 2){ $Value[$field['fName']] = eMeetingOutput($Value[$field['fName']],true); }else{ $Value[$field['fName']] = eMeetingOutput($Value[$field['fName']]); }



			## choose our field type, 1 = input box

			if($field['fType'] == 1){	

				//echo "NAME -- ".$field['fName'];

				if($field['fName'] =="age"){

					if($Value[$field['fName']] == ""){ $Value[$field['fName']]="0000-00-00"; }								
					if($page != 'register'){
						$ReturnString .= MakeAge($Value[$field['fName']])." ".$GLOBALS['_LANG']['_yold'];
					}
					$ReturnString .= "<script>DateInput('FieldValue".$field['fid']."', true, 'YYYY-MON-DD','".$Value[$field['fName']]."')</script>";

				}else{

					if($field['fName'] == 'location'){
						
						$ReturnString .= "<input  name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' id='registerLocation' type='text' maxlength='255' size='42' value=\"".$Value[$field['fName']]."\">  <p class='note response_span_gen' style='display: none;'></p>";
					
					}
					else{
					$ReturnString .= "<input name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' type='text' maxlength='255' size='42' value=\"".$Value[$field['fName']]."\"> <p class='note response_span_gen' style='display: none;'></p>";
					}
				}
				
				## checkbox input

			}
			else if($field['fType'] == 4){

				if($Value[$field['fName']] ==1){ $ex = "checked"; }else{ $ex="";}

				$ReturnString .= "<input type='checkbox' class='fieldGroup_".$groups['id']." field_id_".$field['fid']."' name='FieldValue".$field['fid']."' value='1' $ex>";

				## textarea input

			}
			else if($field['fType'] == 2){

				$ReturnString .= "<textarea name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' cols='5' rows='7' class='countessays' id='editor".$textarea_count."' style='width:100%;'>".$Value[$field['fName']]."</textarea> <p class='note response_span_gen' style='display: none;'></p>";
				//$ReturnString .= "<textarea name='FieldValue".$field['fid']."' class='input ".$input_field_class."' cols='5' rows='7' class='countessays' id='editor".$textarea_count."' style='width:100%;'>".$Value[$field['fName']]."</textarea>";

				$textarea_count++;

				## selection list box

			}
			else if($field['fType'] == 3){

				if($field['fName'] == 'country'){

					$linkcode = "";
					
					/* This is a list box */

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					if(!empty($Linked) && $field['fName'] !="gender"){

						$LinkedCode ="onChange='eMeetingNetworkStates(this.value, ".$Linked['fid'].");'";

					}

					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select  name='FieldValue".$field['fid']."' $LinkedCode class='col-md-12 form-control'>";

					$ReturnString .= "<option value='0'>------------------</option>";

					/*while( $ListValue = $DB->NextRow($result2) ) {

						if($Val == $ListValue['geo_network_country_id']){

							$ReturnString .= "<option value='".$ListValue['geo_network_country_id']."' selected>".$ListValue['country_name']."</option>";

						}else{

							$Selecteed ="";

							$ReturnString .= "<option value='".$ListValue['geo_network_country_id']."' ".$Selecteed.">".$ListValue['country_name']."</option>";

						}

					}*/
					if(isset($Value['country']) && $Value['country'] !="" && $Value['country'] !="0"){

						$ReturnString .= DisplayNetworkCountries($Value['country']);

					}
					else{

						$ReturnString .= DisplayNetworkCountries($arrLocation['country_id']);
					
					}

					

					// BACKUP INCASE NOT VALUES FOUND

					$ReturnString .= "</select></div>";


				}
				else if($field['fName'] == 'em_85820081128'){

					$linkcode = "";
					if(isset($_POST['em_85820081128']) && $_POST['em_85820081128'] !="0"){

					}

					/* This is a list box */

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					$LinkedCode = "";
					if(!empty($Linked) && $field['fName'] !="gender"){

						$LinkedCode ="onChange='eMeetingNetworkCities(this.value, ".$Linked['fid'].",0);'";

					}
						
					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select name='FieldValue".$field['fid']."' $LinkedCode class='col-md-12 form-control fieldGroup_".$groups['id']." field_id_".$field['fid']." '>";

					$ReturnString .= "<option value='0' selected>------------------</option>";

					// BACKUP INCASE NOT VALUES FOUND

					if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){

						if(isset($Value['country']) && $Value['country'] !="0" && $Value['country'] !=""){
							
							$ReturnString .= DisplayNetworkStates($Value['country'], $Value['em_85820081128']);

						}
						else{

							$ReturnString .= DisplayNetworkStates($arrLocation['country_id'], $Value['em_85820081128']);
						}

					}
					else{

						if(isset($Value['country']) && $Value['country'] !="0" && $Value['country'] !=""){
							
							$ReturnString .= DisplayNetworkStates($Value['country'], $arrLocation['state_id']);

						}
						else{

							$ReturnString .= DisplayNetworkStates($arrLocation['country_id'], $arrLocation['state_id']);
						}

						
					}

					

					$ReturnString .= "</select><p class='note response_span_gen' style='display: none;'></p></div>";


				}
				else if($field['fName'] == 'location'){

					$linkcode = "";
					if(isset($_POST['location']) && $_POST['location'] !="0"){

					}

					/* This is a list box */

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select name='FieldValue".$field['fid']."' class='col-md-12 form-control fieldGroup_".$groups['id']." field_id_".$field['fid']."'><p class='note response_span_gen' style='display: none;'></p>";

					$ReturnString .= "<option value='0' selected>------------------</option>";

					// BACKUP INCASE NOT VALUES FOUND

					if(isset($Value[$field['fName']]) && $Value[$field['fName']] !="0" && $Value[$field['fName']] !=""){

						if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){
							
							$ReturnString .= DisplayNetworkCities($Value['em_85820081128'], $Value['location']);

						}
						else{

							$ReturnString .= DisplayNetworkCities($arrLocation['state_id'], $Value['location']);
						}

					}
					else{

						if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){
							
							$ReturnString .= DisplayNetworkCities($Value['em_85820081128'], $arrLocation['city_id']);

						}
						else{

							$ReturnString .= DisplayNetworkCities($arrLocation['state_id'], $arrLocation['city_id']);
						}
						
						
					}

					$ReturnString .= "</select></div>";


				}
				else{
				// check if there is a field linked to this one

				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");

				if(!empty($Linked)){

					$storeLastLinked = $Linked['fid'];

					$LinkedCode ="onchange='eMeetingLinkedField(this.value, ".$Linked['fid'].",0);'";

				}else{ $LinkedCode =""; }


				## find caption

				if(D_LANG !="english"){

					## check see if there is a caption					

					$test = $DB->Row("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					if(empty($test)){

						## no caption found, load english caption

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='english' Order by fvOrder");

					}
					else{				

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					}

				}
				else{

					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

				}		

				## build output

				if(isset($storeLastLinked) && $storeLastLinked == $field['fid']){

					if(isset($StoreCountry) && is_numeric($StoreCountry)){

						$ReturnString .= "<div id='Link".$field['fid']."' class='".$input_div_class."'> <a href='javascript:void(0);' onchange=\"eMeetingLinkedField(".$StoreCountry.", 54,0);\">".MakeCountry($Value[$field['fName']],$field['fid'])." <input type='hidden' class='hidden' name='FieldValue".$field['fid']."' value='".$Value[$field['fName']]."'></a> </div>";

					 }
					 else{

						$ReturnString .= "<div id='Link".$field['fid']."'>".MakeCountry($Value[$field['fName']],$field['fid'])." </div>";						

					}

				}

				else{

					if($field['fid'] =="25"){ $StoreCountry = $Value[$field['fName']]; } // country box fix

					if(D_USER_REGISTRATION == 'sliding'){
						$select_style = "";
					}
					else{
						$select_style = "style='width:250px;'";
					}

					$ReturnString .= "<div id='Link".$field['fid']."'><select name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' $select_style ".$LinkedCode.">";
					

					

					while( $ListValue = $DB->NextRow($result2) ){		

						if($Value[$field['fName']] == $ListValue['fvid']){

							$ReturnString .= "<option value='".$ListValue['fvid']."' selected>".$ListValue['fvCaption']."</option>";

						}
						else{

							$ReturnString .= "<option value='".$ListValue['fvid']."'>".$ListValue['fvCaption']."</option>";

						}
						
					}	

					$ReturnString .= "</select><p class='note response_span_gen' style='display: none;'></p></div>";

				}

				}
			## multiple checkbox											

			}
			elseif($field['fType'] == 5){

				$ReturnString .= "<div class='ClearAll'></div><br><table width='100%'  border=0><tr> ";

				$c=0; $tdC =2;

				$CheckParts = explode("**", $Value[$field['fName']]);

				$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");			

				if( mysqli_num_rows($result2)==0 ) {

					## no values found, load english values

					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."'  Order by fvOrder");
				}							


				while( $ListValue = $DB->NextRow($result2) ) {

					$ReturnString .= "<td width='25%'><span>";


					if(isset($CheckParts[$c]) && $CheckParts[$c] ==1){
						

						$ReturnString .= "<input type='checkbox' name='Multi".$c.$field['fid']."' value='1' class='radio fieldGroup_".$groups['id']." field_id_".$field['fid']."' checked><p class='note response_span_gen' style='display: none;'></p><font size=1>&nbsp;&nbsp;".$ListValue['fvCaption'];

					}else{

						$ReturnString .= "<input type='checkbox' name='Multi".$c.$field['fid']."' value='1' class='radio fieldGroup_".$groups['id']." field_id_".$field['fid']."'><p class='note response_span_gen' style='display: none;'></p><font size=1>&nbsp;&nbsp;".$ListValue['fvCaption'];

					}

					$ReturnString .= "</font>";	

									

					## include hidden fields for saving data

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldValue".$field['fid']."' value='".$field['fName']."'>";

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldName".$field['fid']."' value='".$field['fName']."'>";

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldType".$field['fid']."' value='".$field['fType']."'>";					

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldMulti".$c.$field['fid']."' value='".$c."'>";

					$ReturnString .= "</span></td>";

					$c++;

					if($tdC ==5){ $ReturnString .= '</tr><tr>'; $tdC=1; }

					$tdC++;

				}

				$ReturnString .= "</tr></table>";			

				## input field

			}
			else if($field['fType'] == 6){

				if($Value[$field['fName']] ==1){ $ex = "checked"; }else{ $ex="";}

				$ReturnString .= "<input type='file' name='FieldValue".$field['fid']."' $ex><p class='note response_span_gen' style='display: none;'></p>";
				

				## age field

			}

			else if($field['fType'] == 7){

				if($Value[$field['fName']] == ""){ $Value[$field['fName']]="0000-00-00"; }								

				$age_year = explode('-', $Value[$field['fName']]);
				//print_r($age_year);
				if($page != 'register' && $age_year[0] > 0 && $age_year[2] > 0 && is_string($age_year[1]) && !is_numeric($age_year[1])) {

					$ReturnString .= MakeAge($Value[$field['fName']])." ".$GLOBALS['_LANG']['_yold']."<br>";
				}
				$ReturnString .= MakeAgeListField($Value[$field['fName']],$field['fid']);

				## include hidden fields				

			}


			// ADD CUSTOM HIDDEN FIELDS FOR DATABASE NAME VALUES

			if($field['fType'] != 5){

				$ReturnString .= "<input type='hidden' class='hidden' name='FieldName".$field['fid']."' value='".$field['fName']."'>";

				$ReturnString .= "<input type='hidden' class='hidden' name='FieldType".$field['fid']."' value='".$field['fType']."'>";

				//$field['fid']++;

			}


			if(!isset($value)){ $value="<br>"; }

			if(isset($Caption['description']) && $Caption['description'] != ""){

				$ReturnString .= '<small class="form-text text-muted pull-left">'.$Caption['description'].'</small>';

			}


			$ReturnString .= $value."</div>";

			if($slide_count%2 != 0){
				
				$ReturnString .= "</div>";

			}			

			$slide_count++;
			/*else{
			
				$ReturnString .= $value."</li>";				

			}*/
			$ques_count++;

		}

 		$LastFID = $field['fid'];

		$ThisBox=$HideBox;

		$NextBox=$HideBox+1;

		$PrevBox=$HideBox-1;

		if($slide_count%2 != 0){
				
			$ReturnString .= "</div>";

		}	

		$ReturnString .='<div class="clear"></div><div class="row top-buffer">';
		

		if(D_USER_REGISTRATION == 'sliding'){

			if($HideBox !=1 || $page == 'register'){

				$ReturnString .='<div class="col-md-6"><a href="javascript:void(0);" class="MainBtn pull-left cslide-prev" style="padding:8px;">'.$GLOBALS['_LANG']['_previous'].'</a></div>';

			}
			else{
				$ReturnString .='<div class="col-md-6">&nbsp;</div>';				
			}

			if($Total['total'] ==$HideBox){

				$btnType = ($page == 'account') ? 'submit' : 'button';
				$ReturnString .='<div class="col-md-6"><input type="'.$btnType.'" value="'.$GLOBALS['_LANG']['_save'].'" id="groupId_'.$groups['id'].'" data-fields = "'.implode(",", $group_field_ids).'" class="MainBtn pull-right btn-register" ></div>';

			}else{

				$ReturnString .='<div class="col-md-6 "><a href="javascript:void(0);" class="MainBtn pull-right cslidee-nexttt" id="groupId_'.$groups['id'].'" data-fields = "'.implode(",", $group_field_ids).'" style="padding:8px;">'.$GLOBALS['_LANG']['_next'].' </a></div>';

			}

		}


		$ReturnString .="</div>";


		$ReturnString .="</div>";

		$ReturnString .="</div>";

		$divCount++; $HideBox++;
	}

	

	## build total field number output

	$ReturnString .= "<input name='TotalNumberOfRows' type='hidden' value='1000' class='hidden'>";

	

	return $ReturnString;



}


/*  D_USER_REGISTRATION IS SLIDING  */


function RegisterMemberSliding($id,$group=0,$page =""){

	global $DB;
	 

	## define variables
	$NumFields = 1;	$divCount =1; $divString=""; $ReturnString=""; $HideBox=1;

	## assign value for gender ID if not assigned
	if(!isset($_SESSION['genderid'])){ $_SESSION['genderid']=0; }

	## TOTAL GROUPS
        $Total=0;
	//$Total = $DB->Row("SELECT count(id) AS total FROM field_groups WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).")");
        
        /* adding this code here so that we can get actual count of group which will display
we will not disdplay group which doesn't have any field to display in registration from         */
        $resultCount = $DB->Query("SELECT id FROM field_groups WHERE "
                . "( private = 0 || private = 2 || private = ".
                strip_tags($_SESSION['genderid']).")");
        while($checkCount=$DB->NextRow($resultCount) )
        {
            $SQL = "SELECT count(field.fid) AS total "
                        . "FROM field INNER JOIN field_groups ON "
                        . "( ( field_groups.id = field.groupid  || field_groups.id "
                    . "= field.groupid_1 || field_groups.id = field.groupid_2 )  ) "
                        . "WHERE field.required = 1 AND field.fName "
                        . "NOT IN ('country','em_85820081128','location','milesfrom','postcode') "
                        . "AND ( field.groupid = '".$checkCount['id']."' OR field.groupid_1 ="
                        . " '".$checkCount['id']."' OR field.groupid_2 = '".$checkCount['id']."') "
                        . "GROUP BY field.fid ORDER BY field.fOrder ASC";
            $TotalCount = $DB->Row($SQL);
            if($TotalCount['total']>0)
            {
                $Total++;
            }
           
        }
        
        
        
        ## search for all fields for this member

	$result = $DB->Query("SELECT field_groups.id, field_group_languages.caption FROM field_groups left join field_group_languages ON field_groups.id = field_group_languages.fgid AND field_group_languages.language ='".$_SESSION['lang']."' WHERE ( private = 0 || private = 2 || private = ".strip_tags($_SESSION['genderid']).") ORDER BY forder ASC");

 
	## select data value

	$Value = $DB->Row("SELECT * FROM members_data_pending_approval WHERE  uid= ('".$id."') limit 1");
	if(isset($Value['uid']) && $Value['uid'] != "" && APPROVE_ACCOUNTS =="yes"){

	}
	else{
		$Value = $DB->Row("SELECT * FROM members_data WHERE  uid= ('".$id."') limit 1");	
	}
	
	$arrLocation = GetLocationDetails($_SERVER['REMOTE_ADDR']);
	 
    while( $groups = $DB->NextRow($result) ){

		if ($group > 0) { 

			if ($groups['id'] == $group) {

				$tT = "style='display:visible'";

			}else{

				 $tT = "style='display:none'";

			}

		}else{
				if($HideBox > 1){ $tT = "style='display:none'"; }else{ $tT = "style='display:visible'"; }
		}
		if($groups['caption'] == '' || $groups['caption'] == NULL) {
    		$getGroupCaption = $DB->row("SELECT * FROM field_groups WHERE id=".$groups['id']);
    		$groups['caption'] = $getGroupCaption['caption'];

    	} 
		if(D_USER_REGISTRATION == "sliding"){
			$tT = " class='cslide-slide'";
		}

		## start output display
/*
		$ReturnString .= '<div id="bod_'.$HideBox.'"  '.$tT.' >';

		$slide_count = 0;
		$ReturnString .= '<div class="registration-container">';

		$ReturnString .= '<div class="row ">
			<div class="col-md-12">
				<h3>'.$groups['caption'].'</h3>
			</div></div>';
		*/

		## select group fields

		$SQL = "SELECT field.fid,field.fType, field.fName,field.linked_id "
                        . "FROM field INNER JOIN field_groups ON "
                        . "( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  ) "
                        . "WHERE field.required = 1 AND field.fName "
                        . "NOT IN ('country','em_85820081128','location','milesfrom','postcode') "
                        . "AND ( field.groupid = '".$groups['id']."' OR field.groupid_1 ="
                        . " '".$groups['id']."' OR field.groupid_2 = '".$groups['id']."') "
                        . "GROUP BY field.fid ORDER BY field.fOrder ASC";

                

		$result1 = $DB->Query($SQL);

		$textarea_count = 1;
		$ques_count = 0;

		$group_field_ids = array();
                $fieldCount=$DB->NumRows($result1);
                if($fieldCount>0)
                {
                    $ReturnString .= '<div id="bod_'.$HideBox.'"  '.$tT.' >';

		$slide_count = 0;
		$ReturnString .= '<div class="registration-container">';

		$ReturnString .= '<div class="row ">
			<div class="col-md-12">
				<h3>'.$groups['caption'].'</h3>
			</div></div>';
               // $ReturnString .= 'count=='.$fieldCount;
		while( $field = $DB->NextRow($result1) ){

			$group_field_ids[] = $field['fid'];

			## determin field caption based on language

			if(D_LANG !="english"){



				## check see if there is a caption

				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang= ( '".D_LANG."' ) limit 1");						

				if(empty($Caption)){

					## no caption found, load english caption

					$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' limit 1");

				}

						

			}else{

				## check for english value						

				$Caption = $DB->Row("SELECT caption, `description` FROM field_caption WHERE Cid=".$field['fid']." AND `match` != 'yes' AND lang='".D_LANG."' limit 1");

			}



			## build output
			$input_div_class = "";
			$input_field_class = "";
			

			if($slide_count%2 == 0){
				$ReturnString .= '<div class="row">';
			}

			if($field['fType'] == 2 || $field['fType'] == 5){
				$lable_field_class = "col-md-12";
			}
			else{
				$lable_field_class = "col-md-6";
			}
			
			$ReturnString .= '<div class="'.$lable_field_class.' ques_label"  data-count="'.$ques_count.'"><label>'.$Caption['caption'].'</label>
			<p class="checkbox_valid validate_field_id_'.$field['fid'].'" style="display: none;"></p>';					


			$input_field_class = "col-md-12 form-control";

			

					

			## clean the value for output

			$Value[$field['fName']] = (isset($Value[$field['fName']])) ? $Value[$field['fName']] : "";

			if($field['fType'] == 2){ $Value[$field['fName']] = eMeetingOutput($Value[$field['fName']],true); }else{ $Value[$field['fName']] = eMeetingOutput($Value[$field['fName']]); }



			## choose our field type, 1 = input box

			if($field['fType'] == 1){	

				//echo "NAME -- ".$field['fName'];

				if($field['fName'] =="age"){

					if($Value[$field['fName']] == ""){ $Value[$field['fName']]="0000-00-00"; }								
					if($page != 'register'){
						$ReturnString .= MakeAge($Value[$field['fName']])." ".$GLOBALS['_LANG']['_yold'];
					}
					$ReturnString .= "<script>DateInput('FieldValue".$field['fid']."', true, 'YYYY-MON-DD','".$Value[$field['fName']]."')</script>";

				}else{

					if($field['fName'] == 'location'){
						
						$ReturnString .= "<input  name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' id='registerLocation' type='text' maxlength='255' size='42' value=\"".$Value[$field['fName']]."\">  <p class='note response_span_gen' style='display: none;'></p>";
					
					}
					else{
					$ReturnString .= "<input name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' type='text' maxlength='255' size='42' value=\"".$Value[$field['fName']]."\"> <p class='note response_span_gen' style='display: none;'></p>";
					}
				}
				//print_r($Value[$field['fName']]);

				## checkbox input

			}
			else if($field['fType'] == 4){

				if($Value[$field['fName']] ==1){ $ex = "checked"; }else{ $ex="";}

				$ReturnString .= "<input type='checkbox' class='fieldGroup_".$groups['id']." field_id_".$field['fid']."' name='FieldValue".$field['fid']."' value='1' $ex>";

				## textarea input

			}
			else if($field['fType'] == 2){

				$ReturnString .= "<textarea name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' cols='5' rows='7' class='countessays' id='editor".$textarea_count."' style='width:100%;'>".$Value[$field['fName']]."</textarea> <p class='note response_span_gen' style='display: none;'></p>";
				//$ReturnString .= "<textarea name='FieldValue".$field['fid']."' class='input ".$input_field_class."' cols='5' rows='7' class='countessays' id='editor".$textarea_count."' style='width:100%;'>".$Value[$field['fName']]."</textarea>";

				$textarea_count++;

				## selection list box

			}
			else if($field['fType'] == 3){

				if($field['fName'] == 'country'){

					$linkcode = "";
					
					/* This is a list box */

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					if(!empty($Linked) && $field['fName'] !="gender"){

						$LinkedCode ="onChange='eMeetingNetworkStates(this.value, ".$Linked['fid'].");'";

					}

					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select  name='FieldValue".$field['fid']."' $LinkedCode class='col-md-12 form-control'>";

					$ReturnString .= "<option value='0'>------------------</option>";

					/*while( $ListValue = $DB->NextRow($result2) ) {

						if($Val == $ListValue['geo_network_country_id']){

							$ReturnString .= "<option value='".$ListValue['geo_network_country_id']."' selected>".$ListValue['country_name']."</option>";

						}else{

							$Selecteed ="";

							$ReturnString .= "<option value='".$ListValue['geo_network_country_id']."' ".$Selecteed.">".$ListValue['country_name']."</option>";

						}

					}*/
					if(isset($Value['country']) && $Value['country'] !="" && $Value['country'] !="0"){

						$ReturnString .= DisplayNetworkCountries($Value['country']);

					}
					else{

						$ReturnString .= DisplayNetworkCountries($arrLocation['country_id']);
					
					}

					

					// BACKUP INCASE NOT VALUES FOUND

					$ReturnString .= "</select></div>";


				}
				else if($field['fName'] == 'em_85820081128'){

					$linkcode = "";
					if(isset($_POST['em_85820081128']) && $_POST['em_85820081128'] !="0"){

					}

					/* This is a list box */

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					$LinkedCode = "";
					if(!empty($Linked) && $field['fName'] !="gender"){

						$LinkedCode ="onChange='eMeetingNetworkCities(this.value, ".$Linked['fid'].",0);'";

					}
						
					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select name='FieldValue".$field['fid']."' $LinkedCode class='col-md-12 form-control fieldGroup_".$groups['id']." field_id_".$field['fid']." '>";

					$ReturnString .= "<option value='0' selected>------------------</option>";

					// BACKUP INCASE NOT VALUES FOUND

					if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){

						if(isset($Value['country']) && $Value['country'] !="0" && $Value['country'] !=""){
							
							$ReturnString .= DisplayNetworkStates($Value['country'], $Value['em_85820081128']);

						}
						else{

							$ReturnString .= DisplayNetworkStates($arrLocation['country_id'], $Value['em_85820081128']);
						}

					}
					else{

						if(isset($Value['country']) && $Value['country'] !="0" && $Value['country'] !=""){
							
							$ReturnString .= DisplayNetworkStates($Value['country'], $arrLocation['state_id']);

						}
						else{

							$ReturnString .= DisplayNetworkStates($arrLocation['country_id'], $arrLocation['state_id']);
						}

						
					}

					

					$ReturnString .= "</select><p class='note response_span_gen' style='display: none;'></p></div>";


				}
				else if($field['fName'] == 'location'){

					$linkcode = "";
					if(isset($_POST['location']) && $_POST['location'] !="0"){

					}

					/* This is a list box */

					// check if there is a field linked to this one
					$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");	

					$ReturnString .= "<div id='Link".$field['fid']."'>";
					$ReturnString .= "<select name='FieldValue".$field['fid']."' class='col-md-12 form-control fieldGroup_".$groups['id']." field_id_".$field['fid']."'><p class='note response_span_gen' style='display: none;'></p>";

					$ReturnString .= "<option value='0' selected>------------------</option>";

					// BACKUP INCASE NOT VALUES FOUND

					if(isset($Value[$field['fName']]) && $Value[$field['fName']] !="0" && $Value[$field['fName']] !=""){

						if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){
							
							$ReturnString .= DisplayNetworkCities($Value['em_85820081128'], $Value['location']);

						}
						else{

							$ReturnString .= DisplayNetworkCities($arrLocation['state_id'], $Value['location']);
						}

					}
					else{

						if(isset($Value['em_85820081128']) && $Value['em_85820081128'] !="0" && $Value['em_85820081128'] !=""){
							
							$ReturnString .= DisplayNetworkCities($Value['em_85820081128'], $arrLocation['city_id']);

						}
						else{

							$ReturnString .= DisplayNetworkCities($arrLocation['state_id'], $arrLocation['city_id']);
						}
						
						
					}

					$ReturnString .= "</select></div>";


				}
				else{
				// check if there is a field linked to this one

				$Linked = $DB->Row("SELECT fid FROM field WHERE linked_id=".$field['fid']." limit 1");

				if(!empty($Linked)){

					$storeLastLinked = $Linked['fid'];

					$LinkedCode ="onchange='eMeetingLinkedField(this.value, ".$Linked['fid'].",0);'";

				}else{ $LinkedCode =""; }


				## find caption

				if(D_LANG !="english"){

					## check see if there is a caption					

					$test = $DB->Row("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					if(empty($test)){

						## no caption found, load english caption

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='english' Order by fvOrder");

					}
					else{				

						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");	

					}

				}
				else{

					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");

				}		

				## build output

				if(isset($storeLastLinked) && $storeLastLinked == $field['fid']){

					if(isset($StoreCountry) && is_numeric($StoreCountry)){

						$ReturnString .= "<div id='Link".$field['fid']."' class='".$input_div_class."'> <a href='javascript:void(0);' onchange=\"eMeetingLinkedField(".$StoreCountry.", 54,0);\">".MakeCountry($Value[$field['fName']],$field['fid'])." <input type='hidden' class='hidden' name='FieldValue".$field['fid']."' value='".$Value[$field['fName']]."'></a> </div>";

					 }
					 else{

						$ReturnString .= "<div id='Link".$field['fid']."'>".MakeCountry($Value[$field['fName']],$field['fid'])." </div>";						

					}

				}

				else{

					if($field['fid'] =="25"){ $StoreCountry = $Value[$field['fName']]; } // country box fix

					if(D_USER_REGISTRATION == 'sliding'){
						$select_style = "";
					}
					else{
						$select_style = "style='width:250px;'";
					}

					$ReturnString .= "<div id='Link".$field['fid']."'><select name='FieldValue".$field['fid']."' class='input ".$input_field_class." fieldGroup_".$groups['id']." field_id_".$field['fid']."' $select_style ".$LinkedCode.">";
					

					

					while( $ListValue = $DB->NextRow($result2) ){		

						if($Value[$field['fName']] == $ListValue['fvid']){

							$ReturnString .= "<option value='".$ListValue['fvid']."' selected>".$ListValue['fvCaption']."</option>";

						}
						else{

							$ReturnString .= "<option value='".$ListValue['fvid']."'>".$ListValue['fvCaption']."</option>";

						}
						
					}	

					$ReturnString .= "</select><p class='note response_span_gen' style='display: none;'></p></div>";

				}

				}
			## multiple checkbox											

			}
			elseif($field['fType'] == 5){

				$ReturnString .= "<div class='ClearAll'></div><br><table width='100%'  border=0><tr> ";

				$c=0; $tdC =2;

				$CheckParts = explode("**", $Value[$field['fName']]);

				$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND lang='".D_LANG."' Order by fvOrder");			

				if( mysqli_num_rows($result2)==0 ) {

					## no values found, load english values

					$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."'  Order by fvOrder");
				}							


				while( $ListValue = $DB->NextRow($result2) ) {

					$ReturnString .= "<td width='25%'><span>";


					if(isset($CheckParts[$c]) && $CheckParts[$c] ==1){
						

						$ReturnString .= "<input type='checkbox' name='Multi".$c.$field['fid']."' value='1' class='radio fieldGroup_".$groups['id']." field_id_".$field['fid']."' checked><p class='note response_span_gen' style='display: none;'></p><font size=1>&nbsp;&nbsp;".$ListValue['fvCaption'];

					}else{

						$ReturnString .= "<input type='checkbox' name='Multi".$c.$field['fid']."' value='1' class='radio fieldGroup_".$groups['id']." field_id_".$field['fid']."'><p class='note response_span_gen' style='display: none;'></p><font size=1>&nbsp;&nbsp;".$ListValue['fvCaption'];

					}

					$ReturnString .= "</font>";	

									

					## include hidden fields for saving data

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldValue".$field['fid']."' value='".$field['fName']."'>";

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldName".$field['fid']."' value='".$field['fName']."'>";

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldType".$field['fid']."' value='".$field['fType']."'>";					

					$ReturnString .= "<input type='hidden' class='hidden' name='FieldMulti".$c.$field['fid']."' value='".$c."'>";

					$ReturnString .= "</span></td>";

					$c++;

					if($tdC ==5){ $ReturnString .= '</tr><tr>'; $tdC=1; }

					$tdC++;

				}

				$ReturnString .= "</tr></table>";			

				## input field

			}
			else if($field['fType'] == 6){

				if($Value[$field['fName']] ==1){ $ex = "checked"; }else{ $ex="";}

				$ReturnString .= "<input type='file' name='FieldValue".$field['fid']."' $ex><p class='note response_span_gen' style='display: none;'></p>";
				

				## age field

			}

			else if($field['fType'] == 7){

				if($Value[$field['fName']] == ""){ $Value[$field['fName']]="0000-00-00"; }								

				$age_year = explode('-', $Value[$field['fName']]);
				//print_r($age_year);
				if($page != 'register' && $age_year[0] > 0 && $age_year[2] > 0 && is_string($age_year[1]) && !is_numeric($age_year[1])) {

					$ReturnString .= MakeAge($Value[$field['fName']])." ".$GLOBALS['_LANG']['_yold']."<br>";
				}
				$ReturnString .= MakeAgeListField($Value[$field['fName']],$field['fid']);

				## include hidden fields				

			}


			// ADD CUSTOM HIDDEN FIELDS FOR DATABASE NAME VALUES

			if($field['fType'] != 5){

				$ReturnString .= "<input type='hidden' class='hidden' name='FieldName".$field['fid']."' value='".$field['fName']."'>";

				$ReturnString .= "<input type='hidden' class='hidden' name='FieldType".$field['fid']."' value='".$field['fType']."'>";

				//$field['fid']++;

			}


			if(!isset($value)){ $value="<br>"; }

			if(isset($Caption['description']) && $Caption['description'] != ""){

				$ReturnString .= '<small class="form-text text-muted pull-left">'.$Caption['description'].'</small>';

			}


			$ReturnString .= $value."</div>";

			if($slide_count%2 != 0){
				
				$ReturnString .= "</div>";

			}			

			$slide_count++;
			/*else{
			
				$ReturnString .= $value."</li>";				

			}*/
			$ques_count++;

		}

 		$LastFID = $field['fid'];

		$ThisBox=$HideBox;

		$NextBox=$HideBox+1;

		$PrevBox=$HideBox-1;

		if($slide_count%2 != 0){
				
			$ReturnString .= "</div>";

		}	

		$ReturnString .='<div class="clear"></div><div class="row top-buffer">';
		

		if(D_USER_REGISTRATION == 'sliding'){

			if($HideBox !=1 || $page == 'register'){

				$ReturnString .='<div class="col-md-6"><a href="javascript:void(0);" class="MainBtn pull-left cslide-prev" style="padding:8px;">'.$GLOBALS['_LANG']['_previous'].'</a></div>';

			}
			else{
				$ReturnString .='<div class="col-md-6">&nbsp;</div>';				
			}
                    
			if($Total ==$HideBox){

				$btnType = ($page == 'account') ? 'submit' : 'button';
				$ReturnString .='<div class="col-md-6"><input type="'.$btnType.'" value="'.$GLOBALS['_LANG']['_save'].'" id="groupId_'.$groups['id'].'" data-fields = "'.implode(",", $group_field_ids).'" class="MainBtn pull-right btn-register" ></div>';

			}else{

				$ReturnString .='<div class="col-md-6 "><a href="javascript:void(0);" class="MainBtn pull-right cslidee-nexttt" id="groupId_'.$groups['id'].'" data-fields = "'.implode(",", $group_field_ids).'" style="padding:8px;">'.$GLOBALS['_LANG']['_next'].' </a></div>';

			}

		}


		$ReturnString .="</div>";


		$ReturnString .="</div>";

		$ReturnString .="</div>";
                $HideBox++;
    }

		$divCount++; 
	}

	

	## build total field number output

	$ReturnString .= "<input name='TotalNumberOfRows' type='hidden' value='1000' class='hidden'>";

	

	return $ReturnString;



}
?>
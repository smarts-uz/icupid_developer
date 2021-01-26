<?php 
function CsvDownload($array, $filename = "export.csv", $delimiter=",") {

	$heahhders = ['ICupid Dating Software'];
	$hears = ['Your Infomation'];

    $f = fopen('php://output', 'w');    
    // loop over the input array
   
    fputcsv($f, $heahhders);
     fputcsv($f, $hears);
    foreach ($array as $line) { 
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter); 
    }
    // reset the file pointer to the start of the file
    //fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
  	die;
}
function GdprDwonlode($id,$group=0,$page =""){

	global $DB;

	$csvData = array();

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

	$userCaption = $DB->Row("SELECT * FROM members WHERE id='".$id."'");


    		
    		$userCaption['username'] = $userCaption['username'];
    		$userCaption['ip'] = $userCaption['ip'];
    		$userCaption['email'] = $userCaption['email'];


		$csvData[] = array("Username",$userCaption['username']);
		$csvData[] = array("IP Address",$userCaption['ip']);	
		$csvData[] = array("Email Address",$userCaption['email']);
		
	
    while( $groups = $DB->NextRow($result) ){



		if ($group > 0) { 

			if ($groups['id'] == $group) {

				$tT = "style='display:visible'";

			}else{

				 $tT = "style='display:none'";

			}

		}else{
				
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

		
		
		$csvData[]	= array($groups['caption']);
		## select group fields

		$SQL = "SELECT field.fid,field.fType, field.fName,field.linked_id FROM field INNER JOIN field_groups ON ( ( field_groups.id = field.groupid  || field_groups.id = field.groupid_1 || field_groups.id = field.groupid_2 )  ) WHERE field.fName NOT IN ('country','em_85820081128') AND ( field.groupid = '".$groups['id']."' OR field.groupid_1 = '".$groups['id']."' OR field.groupid_2 = '".$groups['id']."') GROUP BY field.fid ORDER BY field.fOrder ASC";


		$result1 = $DB->Query($SQL);


		$textarea_count = 1;
		$ques_count = 0;

		$group_field_ids = array();

		while( $field = $DB->NextRow($result1) ){
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
			
			if($field['fType'] == 2 ){
				//echo "Field Name=".$Caption['caption']."+ Field Value=".$Value[$field['fName']]."<br>"; 
					$csvData[] = array('',$Caption['caption'],$Value[$field['fName']]);
				} else if($field['fType'] == 1 ){
				
					$csvData[] = array('',$Caption['caption'],$Value[$field['fName']]);
				} 
				else if($field['fType'] == 7 ){
				
					$csvData[] = array('',$Caption['caption'],$Value[$field['fName']]);
				} 
				else if($field['fType'] == 4 ){
				
					$csvData[] = array('',$Caption['caption'],$Value[$field['fName']]);
				}
				else if($field['fType'] == 5 ){
				
					$csvData[] = array('',$Caption['caption']);
				}else if($field['fType'] == 3) {
				
					if($field['fName'] == 'location') {

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


				
					} else {
						$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND fvid = '". $Value[$field['fName']]."' AND lang='".D_LANG."' Order by fvOrder");


				
						while ( $ListValue = $DB->NextRow($result2)) {
							
							
							$csvData[] = array('',$Caption['caption'],$ListValue['fvCaption']);
							
							
							}		
					}
				} else {
					//print_r($field['fName']);
					//print_r($Value[$field['fName']]);
	
				$result2 = $DB->Query("SELECT * FROM field_list_value WHERE fvFid = '". $field['fid'] ."' AND fvid = '". $Value[$field['fName']]."' AND lang='".D_LANG."' Order by fvOrder");

				
				while ( $ListValue = $DB->NextRow($result2)) {

					
					$csvData[] = array('',$Caption['caption'],$ListValue['fvCaption']);
					
					
					}	
					


				}
				
						

	//return $ReturnString;
	


}

}
return $csvData;
}
?>
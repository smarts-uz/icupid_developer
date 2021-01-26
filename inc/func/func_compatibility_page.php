<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );

function getCompatibilityGroups(){
	global $DB;
	$result = $DB->Query("SELECT COUNT(cf.fid) AS total_questions, cfg.id, cfg.caption as caption, cfg.forder, cfg.private FROM compatibility_field_groups AS cfg LEFT JOIN compatibility_field AS cf ON cfg.id = cf.groupid GROUP BY cfg.id ORDER BY cfg.forder ASC");
	$onboard = array();
	$i=1;
	while($data = $DB->NextRow($result))
	{
		
		$onboard[] = $data;
		$i++;
	}
	
	return $onboard;
}

function getCompatibilityGroupFieldsName($group_id){
	global $DB;

	$result = array();
	$SQL = "SELECT cf.fid,cf.fType, cf.fName,cf.linked_id,cf.field_weight,cfc.* FROM compatibility_field AS cf INNER JOIN compatibility_field_groups AS cfg ON ( ( cfg.id = cf.groupid  || cfg.id = cf.groupid_1 || cfg.id = cf.groupid_2 )) LEFT JOIN compatibility_field_caption AS cfc ON ( cf.fid = cfc.Cid AND cfc.match = 'yes' AND cfc.lang = '".D_LANG."')  WHERE cf.groupid = '".$group_id."' GROUP BY cf.fid ORDER BY cf.fOrder ASC";

	$records = $DB->Query($SQL);
	$i = 0;
	while ($record = $DB->NextRow($records)) {
	
		$result['fieldName'][$i] = $record['fName'];
		$result['fieldWeight'][$i] = $record['field_weight'];
		$i++;
	}

	return $result;
}
function getMyCompatibilityAnswers($profile_id){
	global $DB;

	$result = $DB->Row("SELECT * FROM compatibility_members_data WHERE uid = '".$profile_id."'");

	return $result;
}
function getCompatibilityQuestions(){

	global $DB;

	$result = '';
	$arrGroupById = array(); $arrGroupByTotalQuestions = array();
	$compatibilityGroups = getCompatibilityGroups();
	$arrSaveData = getMyCompatibilityAnswers($_SESSION['uid']);

	foreach ($compatibilityGroups as $key => $compatibilityGroup) {
		$groupid = $compatibilityGroup["id"];

		$groupAnswers = 0;
		$groupFields = getCompatibilityGroupFieldsName($groupid);
		foreach ($groupFields['fieldName'] as $fname => $val) {
			if(isset($arrSaveData[$val]) && $arrSaveData[$val] != ""){
				$groupAnswers++;
			}
		}
		$arrGroupById[] = $groupid;
		$arrGroupByTotalQuestions[] = $compatibilityGroup['total_questions'];

		$SQL = "SELECT cf.fid,cf.fType, cf.fName,cf.linked_id,cfc.* FROM compatibility_field AS cf INNER JOIN compatibility_field_groups AS cfg ON ( ( cfg.id = cf.groupid  || cfg.id = cf.groupid_1 || cfg.id = cf.groupid_2 )) LEFT JOIN compatibility_field_caption AS cfc ON ( cf.fid = cfc.Cid AND cfc.match = 'yes' AND cfc.lang = '".D_LANG."')  WHERE ( cf.groupid = '".$groupid."' OR cf.groupid_1 = '".$groupid."' OR cf.groupid_2 = '".$groupid."') GROUP BY cf.fid ORDER BY cf.fOrder ASC";

		$result1 = $DB->Query($SQL);

		$result .= '<fieldset class="groupFieldset ques-page" id="fieldset_'.$groupid.'">';
		$result .= '<div class="form-compatibility">';
		$result .= '<h3 class="heading text-center">Please complete all questions on this page before continuing.</h3>';
		$result .= '<div class="fullwidth title-row"><h3 class="page_title pull-left">'.$compatibilityGroup['caption'].'</h3>';


		$result .= '<div class="total-pages pull-right" id="total_questions_'.$groupid.'">'.$groupAnswers.'/'.$compatibilityGroup['total_questions'].'</div> </div>';
		//$result .= '<div class="total-pages pull-right" id="total_questions_'.$groupid.'">'.$arrSaveData[$groupid]."/".getTotalQuestions($groupid).'</div> </div>';
		$result .= '<ul class="form">';
		$i = 1;
		while( $field = $DB->NextRow($result1) ){
						
			$result .= '<li class="question"><label class="required pink"><span>'.$i.'.</span> '.$field['caption'].' </label></li>';
	
			$FindCountry = $DB->Query("SELECT fvid, fvCaption,`default` FROM compatibility_field_list_value WHERE fvFid=".$field['fid']." ORDER BY fvOrder ASC");
							
						
			if($field['is_multiple_type'] == '1'){

				$result .= '<ul style="text-align:left;" class="is_multiple_type_question"><li>Strongly Disagree</li>';	
							
				while( $cc = $DB->NextRow($FindCountry)){
					$checked = '';
					if(isset($arrSaveData[$field['fName']]) && $arrSaveData[$field['fName']] == $cc['fvid']){
						$checked = 'checked="checked"';
					}

					$result .= '<li><label class="checkedRadio" data-total="'.$compatibilityGroup['total_questions'].'" data-id="'.$groupid.'" data-qid="'.$field['id'].'"><input type="radio" '.$checked.' onclick="checkedRadio('.$compatibilityGroup['total_questions'].', '.$groupid.')" class="blisslogictm_'.$groupid.'" id="'.$field['fName'].'" name="data['.$field['fName'].']" value="'.$cc['fvid'].'"> '.$cc['fvCaption'].'</label></li>';
									
				}

				$result .= '<li>Strongly Agree</li></ul>';
			}else{
				
			$result .= '<ul style="text-align:left;">';	
							
			while( $cc = $DB->NextRow($FindCountry)){
				$checked = '';
				if(isset($arrSaveData[$field['fName']]) && $arrSaveData[$field['fName']] == $cc['fvid']){
					$checked = 'checked="checked"';
				}
									
				$result .= '<li><label class="checkedRadio"  data-total="'.$compatibilityGroup['total_questions'].'" data-id="'.$groupid.'" data-qid="'.$field['id'].'"><input type="radio" '.$checked.' onclick="checkedRadio('.$compatibilityGroup['total_questions'].', '.$groupid.')" class="blisslogictm_'.$groupid.'" id="'.$field['fName'].'" name="data['.$field['fName'].']" value="'.$cc['fvid'].'"> '.$cc['fvCaption'].'</label></li>';
									
			}
			$result .= '</ul>';
			}
			$i++;
		}
					
		$result .= '</ul>';
		$result .= '</div>';
		$result .= '<div id="errorTxt'.$groupid.'" class="errorTxt" style="color:red;"></div>';
		$result .= '<div class="btns-row pagination-btn">';
		if($key > 0 && $key !== (count($compatibilityGroups) -1)){
			$result .= '<a onclick="getPreviousQuestions('.$key.')" id="Previous" class="pull-left" ><span class="back-btn"></span> Back</a>';
			$result .= '<a onclick="getNextQuestions('.$key.', '.$groupid.', '. $compatibilityGroup['total_questions'] .')" id="Next" class="pull-right">Next <span class="next-btn"></span>  </a>';
		}
		if(($key + 1) == count($compatibilityGroups)){
			$result .= '<a class="pull-left" onclick="getPreviousQuestions('.$key.')" id="Previous"><span class="back-btn"></span> Back</a>';	
			$result .= '<span class="pull-right save-btn"><input type="submit" data-total="'.implode("_", $arrGroupByTotalQuestions).'" name="save" data-id="'.implode("_", $arrGroupById).'" class="action-button"  value="Save" /></span>';
		}
		if($key == 0 ){
			$result .= '<a class="pull-left inactive" ><span class="back-btn"></span> Back</a>';	
			$result .= '<a class="pull-right" onclick="getNextQuestions('.$key.', '.$groupid.', '.$compatibilityGroup['total_questions'].')" id="Next">Next <span class="next-btn"></span> </a>';
		}

		$result .= '</div>';
		$result .= '</fieldset>';

	}
    
    return $result;	
}
?>
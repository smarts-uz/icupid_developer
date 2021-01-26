<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );


function ChangeDo($DoCall, $values = false, $Files = false){

	global $DB;

	$DoArray = array('update'); // list of acceptable calls

	if(in_array($DoCall, $DoArray)){
	
		switch($DoCall){
		

			case "update":{		

			## check already existence
			
			$record = $DB->Row("SELECT COUNT(*) AS total FROM `compatibility_members_data` WHERE `uid` = '".$_SESSION['uid']."'");

			## update the CSS file
			if(isset($record['total']) && $record['total'] == '1'){
				
				## Already Exists
					
			}else{
				$DB->Update("INSERT INTO `compatibility_members_data`(uid) VALUES('".$values['uid']."')");

			}

			$q_data = array();

			
			
			if(isset($values['data'])) {
				foreach ($values['data'] as $key => $val) {
				
					$q_data[] = " $key = '$val'";
				}
				$DB->Update("UPDATE `compatibility_members_data` SET  ".implode(",", $q_data)." WHERE `uid` = ('".$_SESSION['uid']."') LIMIT 1");
	
			}

			

			 return $GLOBALS['_LANG_ERROR']['_complete']."**1";


			 }break;
			
					
		}
	
	}
	
	return "error_invalid_call";	
}
?>
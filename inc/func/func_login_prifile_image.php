<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );


function ChangeDo5($DoCall, $values = false, $Files = false,$obj=false,$albumID){
		

	global $DB;
	 
	$DoArray = array('add','email_contacts','login'); // list of acceptable calls
  
	if(in_array($DoCall, $DoArray)){
	 
		switch($DoCall){
		
			case "login": {
					
					
					// ADD IMAGE IF ONE HAS BEEN UPLOADED
					require_once(dirname(__FILE__)."/func_uploads_facebook.php");


					if(!isset($values['aid'])){ $values['aid']="new";}																
					if(is_array($Files['uploadFile00']) && $Files['uploadFile00']['type'] !="" ){ // error 4 = empty file			
					
						$Status = UploadFile($Files["uploadFile00"], $_SESSION['uid'], strip_tags($_SESSION['username']), strip_tags($_SESSION['username']), 1, 'photo', $albumID,'no');
					
					}
					

					
					if(isset($_SESSION['uid'])){
						return "gogogo";
					}
								
							
				} break;

		}
	
	}
	
	return "Balllls!!".$DoCall."-".$SwitchValue;	
}

?>
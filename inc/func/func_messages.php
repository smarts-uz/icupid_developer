<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );


/**
* Info: Display Mail Box 
* 		
* @version  9.0
* @created  Fri Sep 25 10:48:31 EEST 2008
* @updated  Fri Sep 25 10:48:31 EEST 2008
*/

function ChangeDo($DoCall, $values = false, $Files = false){

	global $DB;

	$DoArray = array('add', 'delete'); // list of acceptable calls

	if(in_array($DoCall, $DoArray)){
	
		switch($DoCall){


			/**
			* Info: Add new message
			* 		
			* @version  9.0
			* @created  Fri Sep 25 10:48:31 EEST 2008
			* @updated  Fri Sep 25 10:48:31 EEST 2008
			*/

			case "add": {
				 
				## define variables
				$ThisArrId =0;	$ToArray = explode(",",$values['to']); $UploadMax = 0;
				
				## loop array of senders
				foreach($ToArray as $sending_to){
				
					## get the userid for this user
					$TUID = GetUserID($sending_to);
										
					if($TUID ==""){
											
							return $GLOBALS['LANG_MESSAGES'][1];
						
					}elseif($TUID == $_SESSION['uid']){
						
							return $GLOBALS['LANG_MESSAGES'][2];
					}

					if(strlen($values['subject']) < 2 ){
						
							return $GLOBALS['LANG_MESSAGES'][3];
					}

					## check members account space
					$usedimagespace = $DB->Row("SELECT count(uid) AS space FROM messages WHERE uid= ( '".$_SESSION['uid']."' ) AND type = 'normal' AND maildate='".DATE_NOW."'");	
		
					if( ($usedimagespace['space'] >= $_SESSION['pack_messages']) && D_FREE =="no"){
						
							return $GLOBALS['LANG_MESSAGES'][4];
										
					}else{
								
							## check the sender isnt blocked
							$blocked = $DB->Row("SELECT count(uid) AS total FROM members_network WHERE type=3 AND to_uid= ( '".$_SESSION['uid']."' ) AND uid= ( '".$TUID."' ) ");					
							
							if($blocked['total'] ==0){

								// SEE IF MEMBER IS BLOCKED WITH THEIR PROVACY
								$PrivacyBlock = $DB->Row("SELECT `Time Zone` AS total FROM members_privacy WHERE uid= ( '".$TUID."' ) LIMIT 1");
	
								$access_data = explode("*",$PrivacyBlock['total']);
								$access_array = array();
								foreach($access_data as $value){		
									array_push($access_array,$value);
								}

								if( in_array($_SESSION['genderid'],$access_array) ){

									$blocked['total']=1;

								}
							}

							if($blocked['total'] ==0){
								
								$BadWords=CreateBadWordFilter();
 
								## make message data safe
								$MessageData 	= eMeetingInput(filter_str($values['message'],$BadWords));

								$MessageSubject = eMeetingInput(filter_str($values['subject'],$BadWords)); // 

								## add ecard to message
								if(isset($values['addCardID']) && $values['addCardID'] != 0){
										$CardCode ="<p><img src=\"".DB_DOMAIN."images/DEFAULT/_msg/cards/".$values['addCardID'].".jpg\"></p>"; 
								}else{ 
										$CardCode ="";
								}
												 
								## add smile icons
								$MessageData  = str_replace(":)","<img src=\"".DB_DOMAIN."images/DEFAULT/_msg/grin.gif\" align=\"absmiddle\">", $MessageData);											
								$MessageData  = str_replace(":P","<img src=\"".DB_DOMAIN."images/DEFAULT/_msg/tongue.gif\" align=\"absmiddle\">", $MessageData);
								$MessageData  = str_replace(":>","<img src=\"".DB_DOMAIN."images/DEFAULT/_msg/wink.gif\" align=\"absmiddle\">", $MessageData);
								$MessageData  = str_replace(":(","<img src=\"".DB_DOMAIN."images/DEFAULT/_msg/sad.gif\" align=\"absmiddle\">", $MessageData);
										
								## insert message into the database
								$DB->Insert("INSERT INTO `messages` ( `uid` , `mailnum` , `mail2id` , `mailstatus` , `maildate` , `mailtime` , `mail_subject` , `mail_message` , `mail_displayalert`, my_box, to_box )
								VALUES ('".$_SESSION['uid']."', NULL , '".$TUID."', 'unread', '".DATE_NOW."', '".TIME_NOW."', '".$MessageSubject."', '".$MessageData.$CardCode."', '1', 'sent', 'inbox')");
								
								$message_id = $DB->InsertID();
												
								## add images to the message
								if(!empty($Files)){
 
									while($UploadMax < 5){

										## if no album is selected, create a new one
										if(!isset($values['aid'])){ $values['aid']="new";}		
														 
											## check for file error before uploading
											if(isset($Files["uploadFile0".$UploadMax]))
											if( ( isset($values['error']) !=4 )  && is_array($Files["uploadFile0".$UploadMax]) && isset($Files["uploadFile0".$UploadMax]['type']) !="" ){ // error 4 = empty file			
																	
													$Status = UploadFile($Files["uploadFile0".$UploadMax], $_SESSION['uid'], "Message Photo", "Message Photo", $message_id, "photo", "none","no");														
														
											}

											$UploadMax++;

										}
								}
								
								## Send Alert Message
								DoEmailSMS($TUID,5,'email_msg',substr($MessageData,0,30));																		
									
							
							}else{
							
								return $GLOBALS['_LANG_ERROR']['_userBlocked'];
							
							}
						}			
				} 
				
				return $GLOBALS['_LANG']['_msgSent']."**1";
														
			} break;	


	
			/**
			* Info: Delete Mailbox Messages
			* 		
			* @version  9.0
			* @created  Fri Sep 25 10:48:31 EEST 2008
			* @updated  Fri Sep 25 10:48:31 EEST 2008
			*/

			case "delete": {	
		
				
				for($i = 1; $i < $values['totalMail']+1; $i++) { 
					
					if(isset($values['d'. $i]) && $values['d'.$i] == "on"){
					
						
						if($values['sub'] == "inbox"){ 

									$DB->Update("UPDATE messages SET to_box='trash' WHERE  mail2id =".$_SESSION['uid']." AND mailnum='".$values['di'. $i]."' LIMIT 1");		
							
						}
						
						if($values['sub'] == "wink"){ 

									$DB->Insert("UPDATE messages SET to_box='trash' WHERE mail2id =".$_SESSION['uid']." AND mailnum='".$values['di'. $i]."' LIMIT 1");													
						}
						
						if($values['sub'] == "trash"){

									$DB->Insert("UPDATE messages SET to_box='none' WHERE  mail2id =".$_SESSION['uid']." AND mailnum='".$values['di'. $i]."' LIMIT 1");
							}

						if($values['sub'] =="sent"){		
		
							$DB->Insert("UPDATE messages SET my_box='none' WHERE  uid =".$_SESSION['uid']." AND mailnum='".$values['di'. $i]."' LIMIT 1");		
						} 


					}
				}					
						
				return $GLOBALS['_LANG_ERROR']['_complete']."**1";		

			} break;	
		}
	
	}
	
	return "error_invalid_call";	
}
?>
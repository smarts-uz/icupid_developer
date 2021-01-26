<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");
global $DB;
$arrData = array();

function ForgottenPassword($CheckThisEmail){
	
	global $DB;
	
	$today_time=TIME_NOW;
	$today_date=DATE_NOW;
			
	// First lets check this email address is in the database
	$result = $DB->Row("SELECT username, password FROM members WHERE email ='".strip_tags($CheckThisEmail)."' LIMIT 1");
	if(empty($result)){ return "invalid"; }	



	$LostPassword['email'] = $CheckThisEmail;
	$LostPassword['username'] = $result['username'];
	$LostPassword['password'] = makeRandomPassword(); // THE NEW PASSWORD IS GENERATED HERE
	

	if(D_MD5 ==1){
		$passcode = md5($LostPassword['password']);
	}else{
		$passcode = $LostPassword['password'];
	}

	$DB->Update("UPDATE members SET password='".$passcode."', activate_code ='OK' WHERE email ='".$CheckThisEmail."'");
	
	// Send the email to the user			
	SendTemplateMail($LostPassword, 4);
	
	return "complete";
				
}

if($_GET){

 $email = $_GET['email'];
$msg = "";
  switch(ForgottenPassword($email)){						
							case "invalid": {							
								$msg = "Your email address is invalid. Please check and try again.";					
							} break;							
							case "complete": {							
								$msg = "Thank You. We have sent a new password to your email.";							
							} break;
						}

$arrData[0] = new StdClass;
$arrData[0]->msg = $msg;
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

}
else {
     $arrData[0] = new StdClass;
     $arrData[0]->msg = 'fail';
     echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

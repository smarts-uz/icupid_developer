<?php 

// no direct access
defined( 'KEY_ID' ) or die( 'Restricted access' );


function getFbUsername($fbname){
		

	global $DB;
	
	$arrFbUsername = explode(" ", $fbname);

	$num = rand(100,999);

	$fbUsername = $arrFbUsername['0'].substr($arrFbUsername['1'],0,1).$num;

	$FoundUsername = $DB->Row("SELECT count(id) AS total FROM members WHERE username ='".$fbUsername."' LIMIT 1");
  
	if($FoundUsername['total'] != '0') {
		getFbUsername($fbname);
	}
	else{
		return $fbUsername;
	}
		
}

?>
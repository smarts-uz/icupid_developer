<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

global $DB;
$arrData = array();
if($_POST){
$username = $_POST['username'];
$password = $_POST['password'];
$skip_pass = false; 

$sql = "SELECT members.activate_code, members_template.header_background AS background, members_template.header_text AS color_text, members_data.gender AS genderD, package.view_adult, package.name, package.wink, package.Highlighted, package.Featured, package.maxMessage, members.moderator, package.maxFiles, members.active, members.id, members.activate_code, members.username, members.packageid, members.lastlogin, members_privacy.Language FROM members
    INNER JOIN members_privacy ON ( members.id = members_privacy.uid )
    LEFT JOIN members_template ON ( members_template.uid = members_privacy.uid )
    LEFT JOIN members_data ON ( members.id = members_data.uid )
    LEFT JOIN package ON ( members.packageid = package.pid )
      WHERE ( members.username = '".$username."' OR members.email='".$username."' ) ";
    if($skip_pass){
      $sql .= " LIMIT 1";
    }else{

      if(D_MD5 ==1){
        $sql .="AND members.password = '".md5($password)."' LIMIT 1";
      }else{
        $sql .="AND members.password = '".$password."' LIMIT 1";
      }

    }


$result = $DB->Row($sql);

if ( is_array($result) ) {

  if($result['active'] =="suspended"){

    $arrData[0] = new StdClass;
    $arrData[0]->msg = "this account is suspended";
    $arrData[0]->islogin = "no";

  }else if($result['activate_code'] != "OK" && VALIDATE_EMAIL ==1){

    $arrData[0] = new StdClass;
    $arrData[0]->msg = "This account has not yet been activated, please check your email and enter the validate code.";
    $arrData[0]->islogin = "no";

  }else if($result['active'] =="unapproved" && $result['activate_code'] = "OK"){

        $arrData[0] = new StdClass;
        $arrData[0]->msg = "Your account is still waiting for admin approval. An email will be sent to you once your account is active. Thank you for your patience.";
        $arrData[0]->islogin = "no";

  }else if($result['active'] =="cancel"){

    $arrData[0] = new StdClass;
    $arrData[0]->msg = "this account is canceled";
    $arrData[0]->islogin = "no";

  }	else if($result['active'] =="active"){
	  
     require_once("ion_app_function.php");
     $mad = MemberAccountDetails($result['id']);
	  
	  $F_Ban = $DB->Row("SELECT count(autoid) AS total FROM members_banned WHERE username = '".$mad['username']."' LIMIT 1");

				if(!empty($F_Ban) && $F_Ban['total'] > 0){

					$arrData[0] = new StdClass;
					$arrData[0]->msg = "Sorry but you have been banned from this site";
					$arrData[0]->islogin = "no";

				}else{
					
					 $blocked = $DB->Row("SELECT country_name FROM geo_ip_contries WHERE start_remote_ip_address <='".$ip."' AND end_remote_ip_address >='".$ip."' AND is_blocked = 'Y' LIMIT 1");
					
				if(!empty($blocked) && $blocked['country_name'] != ''){

					$arrData[0] = new StdClass;
					$arrData[0]->msg = "You have been banned from this app";
					$arrData[0]->islogin = "no";

				}else{	
					
    $arrData[0] = new StdClass;
    $arrData[0]->thumb_large = $mad['image'];
    $arrData[0]->thumb_small = $mad['image_small'];
    $arrData[0]->status = $mad['status'];
    $arrData[0]->membership = $mad['name'];
    $arrData[0]->username = $mad['username'];
    $arrData[0]->uid = $result['id'];
    $arrData[0]->lastlogin = $mad['lastlogin'];
    $arrData[0]->profile_complete = $mad['profile_complete'];
    $arrData[0]->msg = "Login Success :)";
    $arrData[0]->islogin = "yes";
	
	$DB->Update("UPDATE members_online SET timestamp= ('".time()."'), 	ip= ('".$ip."'), 	page= ('app') WHERE logid = ( '".$result['id']."' ) LIMIT 1");

			if ($DB->Affected() == 0)

			{

				$DB->Insert("INSERT INTO members_online values('".time()."','$ip', 'app', '".$result['id']."')");

			}				
					
				}
  }
  }else {

  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Your login details have failed. Please check and try again.";
  $arrData[0]->islogin = "no";
}

} else {

  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Your login details have failed. Please check and try again.";
  $arrData[0]->islogin = "no";
}
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Ooops!";
  $arrData[0]->islogin = "no";
  echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

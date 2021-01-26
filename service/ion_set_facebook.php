<?php
header('Access-Control-Allow-Origin: *');

require_once("../inc/config.php");

global $DB;

$arrData = array();

if($_POST){

  $cemail = $_POST['email'];
  $cusername = $_POST['id'];
  $gender = $_POST['gender'];
  $cname = $_POST['name'];

  $user = $DB->Row("SELECT id, facebook_id, active FROM members WHERE facebook_id = ( '".$cusername."' ) LIMIT 1");

  if($user['facebook_id']){
	  
if($user['active'] =="suspended"){

    $arrData[0] = new StdClass;
    $arrData[0]->msg = "this account is suspended";
    $arrData[0]->status = "no";

  }else if($user['active'] =="unapproved"){

        $arrData[0] = new StdClass;
        $arrData[0]->msg = "Your account is still waiting for admin approval. An email will be sent to you once your account is active. Thank you for your patience.";
        $arrData[0]->status = "no";

  }else if($user['active'] =="cancel"){

    $arrData[0] = new StdClass;
    $arrData[0]->msg = "this account is canceled";
    $arrData[0]->islogin = "no";

  }	else if($user['active'] =="active"){
	
      require_once("ion_app_function.php");
      
	  $mad = MemberAccountDetails($user['id']);
	  
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
        $arrData[0]->msg = "Success :)";
        $arrData[0]->thumb_large = $mad['image'];
        $arrData[0]->thumb_small = $mad['image_small'];
        $arrData[0]->status = $mad['status'];
        $arrData[0]->membership = $mad['name'];
        $arrData[0]->username = $mad['username'];
        $arrData[0]->uid = $user['id'];
        $arrData[0]->lastlogin = $mad['lastlogin'];
        $arrData[0]->profile_complete = $mad['profile_complete'];
        $arrData[0]->islogin = "yes";
					
					$DB->Update("UPDATE members_online SET timestamp= ('".time()."'), 	ip= ('".$ip."'), 	page= ('app') WHERE logid = ( '".$user['id']."' ) LIMIT 1");

			if ($DB->Affected() == 0)

			{

				$DB->Insert("INSERT INTO members_online values('".time()."','$ip', 'app', '".$user['id']."')");

			}	
					
					} 
	} 
}
  }else{

	  $blocked = $DB->Row("SELECT country_name FROM geo_ip_contries WHERE start_remote_ip_address <='".$ip."' AND end_remote_ip_address >='".$ip."' AND is_blocked = 'Y' LIMIT 1");
					
				if(!empty($blocked) && $blocked['country_name'] != ''){

					$arrData[0] = new StdClass;
					$arrData[0]->msg = "You have been banned from this app";
					$arrData[0]->islogin = "no";

				}else{	
					
    if($gender == 'male')
    $sex = '63';
    else if($gender == 'female')
    $sex = '64';
    else
    $sex = '0';

    $MatchDataArray = array();

    $MatchDataArray[0]['name'] = 'gender';
    $MatchDataArray[0]['value'] = $sex;
    $MatchDataArray[0]['type'] = '3';
    $MatchDataArray[0]['caption'] = "I am seeking a / We are seeking a";

          //$split = explode('@',$cemail);
          //$uname = $split[0];
	  	  $uname = getFbUsername($cname);

          $DB->Insert("INSERT INTO `members` ( `id` , `username` , `password`, `email`, `ip`, `lastlogin`, `created`, `facebook_id`) VALUES (NULL , '".$uname."', '".md5($cusername)."', '".$cemail."', '".$_SERVER['REMOTE_ADDR']."' , '".DATE_NOW."' , '".DATE_NOW."', '".$cusername."')");

          $userid = $DB->InsertID();

          $DB->Insert("INSERT INTO `members_data` ( `uid`, `age`, `gender`) values ( '$userid', '1974-JAN-15', '$sex')");
          $DB->Insert("INSERT INTO `album` ( `aid` , `uid` , `title` , `comment` , `filecount` , `cat` , `allow_f` , `allow_h` , `allow_n` , `allow_a`,password, 	time, 	date )VALUES (NULL , '".$userid."', '".$uname." Album', '', '0', 'public', '0', '0', '0', '0','',now(),now())");
          $albumid = $DB->InsertID();
          $DB->Insert("INSERT INTO `members_privacy` (`uid` ,`Newsletters` ,`Notifications` ,`IM` ,`Language` ,`Time Zone` ,`friends` ,`comments` ,`profile_view` ,`im_window` ,`SMS_email` ,`SMS_wink` , `SMS_number` ,`SMS_credits` ,`SMS_country` ,`match_array` ,`email_winks` ,`email_msg` ,`email_friends` ,`email_match`, `profileview_friends`, `profileview_nonfriend`)VALUES ('".$userid."', 'yes', 'yes', 'yes', 'english', '', 'no', 'no', 'all', 'off', '', '', '', '50', '569', '".serialize($MatchDataArray)."', 'yes', 'yes', 'yes', 'yes','','')");
          //$DB->Update("UPDATE `members_data` SET `age``age` = '1974-JAN-15' WHERE uid='".$userid."' LIMIT 1");
          $ran = rand();
          $dirname = "../uploads/images";
          $dirnameThumb = "../uploads/thumbs";

          $imgsPath = "FT".$userid.$ran.".jpg";

          $path = trim($dirname)."/".$imgsPath;
          $pathThumb = trim($dirnameThumb)."/".$imgsPath;
          // $image = file_get_contents('https://graph.facebook.com/'.$cusername.'/picture'); // sets $image to the contents of the url
          // file_put_contents($path, $image);
          // file_put_contents($pathThumb, $image);
          $pic = file_get_contents("https://graph.facebook.com/$cusername/picture?type=large");
          // $filename = $fbid.".jpg";
          //$path="images/".$filename;
           file_put_contents($pathThumb, $pic);


          $DB->Insert("INSERT INTO `files` ( `aid` , `uid` , `date` , `title`, `description`, `bigimage` , `approved` , `type`,`user`,`width`,`height` )
          VALUES ('".$albumid."', '".$userid."' , '".DATE_NOW."', '".$uname."' ,'".$uname."' ,'".$imgsPath."', 'yes', 'photo','".$uname."', '200', '200')");

          require_once("ion_app_function.php");
          $mad = MemberAccountDetails($userid);
          $arrData[0] = new StdClass;
          $arrData[0]->msg = "Success :)";
          $arrData[0]->thumb_large = $mad['image'];
          $arrData[0]->thumb_small = $mad['image_small'];
          $arrData[0]->status = $mad['status'];
          $arrData[0]->membership = $mad['name'];
          $arrData[0]->username = $mad['username'];
          $arrData[0]->uid = $userid;
          $arrData[0]->lastlogin = $mad['lastlogin'];
          $arrData[0]->profile_complete = $mad['profile_complete'];
          $arrData[0]->islogin = "yes";
	  
	  $DB->Update("UPDATE members_online SET timestamp= ('".time()."'), 	ip= ('".$ip."'), 	page= ('app') WHERE logid = ( '".$userid."' ) LIMIT 1");

			if ($DB->Affected() == 0)

			{

				$DB->Insert("INSERT INTO members_online values('".time()."','$ip', 'app', '".$user['id']."')");

			}	


          $sql = "SELECT members.id, members.email, members_privacy.SMS_number, members_data.gender AS genderD, package.name, package.wink, package.Highlighted, package.Featured, package.maxMessage, members.moderator, package.maxFiles, members.active, members.id, members.activate_code, members.username, members.packageid, members.lastlogin, members_privacy.Language FROM members
          INNER JOIN members_privacy ON ( members.id = members_privacy.uid )
          LEFT JOIN members_data ON ( members.id = members_data.uid )
          LEFT JOIN package ON ( members.packageid = package.pid )
          WHERE members.id = '".$userid."' LIMIT 1";

          $values = $DB->Row($sql);
          $values['id'] = $userid;
          $values['password'] = $cusername;
          $values['packageid'] = DEFAULT_PACKAGE;
          $values['custom'] = $userid;

          ////////////////////////
          // SEND WELCOME EMAIL
          ////////////////////////
          $D1 = $DB->Row("SELECT value1 FROM system_settings WHERE name='welcome_email' LIMIT 1");

          SendTemplateMail($values, $D1['value1']);
        //}
  }
}
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Ooops!";
  echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
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

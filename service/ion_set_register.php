<?php
header('Access-Control-Allow-Origin: *');
require_once("../inc/config.php");

global $DB;

$arrData = array();

if($_POST){
	
$blocked = $DB->Row("SELECT country_name FROM geo_ip_contries WHERE start_remote_ip_address <='".$ip."' AND end_remote_ip_address >='".$ip."' AND is_blocked = 'Y' LIMIT 1");
					
				if(!empty($blocked) && $blocked['country_name'] != ''){

					$arrData[0] = new StdClass;
					$arrData[0]->msg = "You have been banned from this app";

				}else{	
					
  $cemail = $_POST['email'];
  $cusername = $_POST['username'];

  $user = $DB->Row("SELECT username FROM members WHERE username= ( '".$cusername."' ) LIMIT 1");

  if(!$user['username']){
    $mail = $DB->Row("SELECT email FROM members WHERE email= ( '".$cemail."' ) LIMIT 1");
        if(!$mail['email']){

        $DB->Insert("INSERT INTO `members` ( `id` , `username` , `password`, `email`, `ip`, `lastlogin`, `created`) VALUES (NULL , '".$_POST['username']."', '".md5($_POST['password'])."', '".$_POST['email']."', '".$_SERVER['REMOTE_ADDR']."' , '".DATE_NOW."' , '".DATE_NOW."')");

        $userid = $DB->InsertID();

        $DB->Insert("INSERT INTO `members_data` ( `uid` ) values ( '$userid' )");
        $DB->Insert("INSERT INTO `album` ( `aid` , `uid` , `title` , `comment` , `filecount` , `cat` , `allow_f` , `allow_h` , `allow_n` , `allow_a`,password, 	time, 	date )VALUES (NULL , '".$userid."', '".$_POST['username']." Album', '', '0', 'public', '0', '0', '0', '0','',now(),now())");

        $DB->Update("UPDATE `members_data` SET `age` = '1974-JAN-15', `country` = '".$_POST['country']."', `em_hrh20080113` = '".$_POST['marital']."', `em_8cx20070511` = '".$_POST['sexuality']."', `em_85820081128` = '".$_POST['state']."', `location` = '".$_POST['location']."', `em_txg20080113` = '".$_POST['religion']."', `em_72220080113` = '".$_POST['employment']."', `em_kjc20080113` = '".$_POST['income']."', `em_s1620080113` = '".$_POST['education']."', `em_rn620080113` = '".$_POST['wchildren']."',  `em_kxb20080113` = '".$_POST['hchildren']."',  `em_qck20080113` = '".$_POST['personality']."',  `em_r9720080113` = '".$_POST['romantic']."',  `em_1k820080113` = '".$_POST['yheight']."',  `em_heh20080113` = '".$_POST['ybuild']."',  `em_93n20080113` = '".$_POST['hcolor']."',  `em_jsh20080113` = '".$_POST['ecolor']."',  `em_jhb20080113` = '".$_POST['hlength']."',  `em_yh020080113` = '".$_POST['methnicity']."',  `em_7jr20080113` = '".$_POST['pappearance']."',  `em_wvh20080113` = '".$_POST['mstyle']."', `em_vqf20080113` = '".$_POST['afeature']."' WHERE uid='".$userid."' LIMIT 1");


        $MatchDataArray = array();


        $MatchDataArray[0]['name'] = 'em_hrh20080113';
        $MatchDataArray[0]['value'] = $_POST['marital'];
        $MatchDataArray[0]['type'] = '3';
        $MatchDataArray[0]['caption'] = 'Your marital status';

        $MatchDataArray[1]['name'] = 'em_8cx20070511';
        $MatchDataArray[1]['value'] = $_POST['sexuality'];
        $MatchDataArray[1]['type'] = '3';
        $MatchDataArray[1]['caption'] = 'Sexual Orientation';

        $MatchDataArray[2]['name'] = 'country';
        $MatchDataArray[2]['value'] = $_POST['country'];
        $MatchDataArray[2]['type'] = '3';
        $MatchDataArray[2]['caption'] = 'Country';

        $MatchDataArray[3]['name'] = 'em_85820081128';
        $MatchDataArray[3]['value'] = $_POST['state'];
        $MatchDataArray[3]['type'] = '3';
        $MatchDataArray[3]['caption'] = 'State / Province';

        $MatchDataArray[4]['name'] = 'location';
        $MatchDataArray[4]['value'] = $_POST['location'];
        $MatchDataArray[4]['type'] = '1';
        $MatchDataArray[4]['caption'] = "City / Town";

        $MatchDataArray[5]['name'] = 'em_txg20080113';
        $MatchDataArray[5]['value'] = $_POST['religion'];
        $MatchDataArray[5]['type'] = '3';
        $MatchDataArray[5]['caption'] = "Religion";

        $MatchDataArray[6]['name'] = 'em_72220080113';
        $MatchDataArray[6]['value'] = $_POST['employment'];
        $MatchDataArray[6]['type'] = '3';
        $MatchDataArray[6]['caption'] = "Employment";

        $MatchDataArray[7]['name'] = 'em_kjc20080113';
        $MatchDataArray[7]['value'] = $_POST['income'];
        $MatchDataArray[7]['type'] = '3';
        $MatchDataArray[7]['caption'] = "Income";

        $MatchDataArray[8]['name'] = 'em_s1620080113';
        $MatchDataArray[8]['value'] = $_POST['education'];
        $MatchDataArray[8]['type'] = '3';
        $MatchDataArray[8]['caption'] = "Education";

        $MatchDataArray[9]['name'] = 'em_rn620080113';
        $MatchDataArray[9]['value'] = $_POST['wchildren'];
        $MatchDataArray[9]['type'] = '3';
        $MatchDataArray[9]['caption'] = "Wants Children";

        $MatchDataArray[10]['name'] = 'em_kxb20080113';
        $MatchDataArray[10]['value'] = $_POST['hchildren'];
        $MatchDataArray[10]['type'] = '3';
        $MatchDataArray[10]['caption'] = "Has Children";

        $MatchDataArray[11]['name'] = 'em_qck20080113';
        $MatchDataArray[11]['value'] = $_POST['personality'];
        $MatchDataArray[11]['type'] = '3';
        $MatchDataArray[11]['caption'] = "Personality";

        $MatchDataArray[12]['name'] = 'em_r9720080113';
        $MatchDataArray[12]['value'] = $_POST['romantic'];
        $MatchDataArray[12]['type'] = '3';
        $MatchDataArray[12]['caption'] = "Romantic";

        $MatchDataArray[13]['name'] = 'em_1k820080113';
        $MatchDataArray[13]['value'] = $_POST['yheight'];
        $MatchDataArray[13]['type'] = '3';
        $MatchDataArray[13]['caption'] = "Height";

        $MatchDataArray[14]['name'] = 'em_heh20080113';
        $MatchDataArray[14]['value'] = $_POST['ybuild'];
        $MatchDataArray[14]['type'] = '3';
        $MatchDataArray[14]['caption'] = "Build";

        $MatchDataArray[15]['name'] = 'em_93n20080113';
        $MatchDataArray[15]['value'] = $_POST['hcolor'];
        $MatchDataArray[15]['type'] = '3';
        $MatchDataArray[15]['caption'] = "Hair Colour";

        $MatchDataArray[16]['name'] = 'em_jsh20080113';
        $MatchDataArray[16]['value'] = $_POST['ecolor'];
        $MatchDataArray[16]['type'] = '3';
        $MatchDataArray[16]['caption'] = "Eye Colour";

        $MatchDataArray[17]['name'] = 'em_jhb20080113';
        $MatchDataArray[17]['value'] = $_POST['hlength'];
        $MatchDataArray[17]['type'] = '3';
        $MatchDataArray[17]['caption'] = "Hair Length";

        $MatchDataArray[18]['name'] = 'em_yh020080113';
        $MatchDataArray[18]['value'] = $_POST['methnicity'];
        $MatchDataArray[18]['type'] = '3';
        $MatchDataArray[18]['caption'] = "Ethnicity";

        $MatchDataArray[19]['name'] = 'em_7jr20080113';
        $MatchDataArray[19]['value'] = $_POST['pappearance'];
        $MatchDataArray[19]['type'] = '3';
        $MatchDataArray[19]['caption'] = "Physical Appearance";

        $MatchDataArray[20]['name'] = 'em_wvh20080113';
        $MatchDataArray[20]['value'] = $_POST['mstyle'];
        $MatchDataArray[20]['type'] = '3';
        $MatchDataArray[20]['caption'] = "Style";

        $MatchDataArray[21]['name'] = 'em_vqf20080113';
        $MatchDataArray[21]['value'] = $_POST['afeature'];
        $MatchDataArray[21]['type'] = '3';
        $MatchDataArray[21]['caption'] = "Most Attractive Feature";

        $DB->Insert("INSERT INTO `members_privacy` (`uid` ,`Newsletters` ,`Notifications` ,`IM` ,`Language` ,`Time Zone` ,`friends` ,`comments` ,`profile_view` ,`im_window` ,`SMS_email` ,`SMS_wink` , `SMS_number` ,`SMS_credits` ,`SMS_country` ,`match_array` ,`email_winks` ,`email_msg` ,`email_friends` ,`email_match`, `profileview_friends`, `profileview_nonfriend`)VALUES ('".$userid."', 'yes', 'yes', 'yes', 'english', '', 'no', 'no', 'all', 'off', '', '', '', '50', '569', '".serialize($MatchDataArray)."', 'yes', 'yes', 'yes', 'yes','','')");

        require_once("ion_app_function.php");



        // user Data
        $mad = MemberAccountDetails($userid);
        $arrData[0] = new StdClass;
        $arrData[0]->msg = "Registration Success :)";
        $arrData[0]->thumb_large = $mad['image'];
        $arrData[0]->thumb_small = $mad['image_small'];
        $arrData[0]->status = $mad['status'];
        $arrData[0]->membership = $mad['name'];
        $arrData[0]->username = $mad['username'];
        $arrData[0]->uid = $userid;
        $arrData[0]->lastlogin = $mad['lastlogin'];
        $arrData[0]->profile_complete = $mad['profile_complete'];
        $arrData[0]->islogin = "yes";

        $sql = "SELECT members.id, members.email, members_privacy.SMS_number, members_data.gender AS genderD, package.name, package.wink, package.Highlighted, package.Featured, package.maxMessage, members.moderator, package.maxFiles, members.active, members.id, members.activate_code, members.username, members.packageid, members.lastlogin, members_privacy.Language FROM members
        INNER JOIN members_privacy ON ( members.id = members_privacy.uid )
        LEFT JOIN members_data ON ( members.id = members_data.uid )
        LEFT JOIN package ON ( members.packageid = package.pid )
        WHERE members.id = '".$userid."' LIMIT 1";

        $values = $DB->Row($sql);
        $values['id'] = $userid;
        $values['password'] = $_POST['password'];
        $values['packageid'] = DEFAULT_PACKAGE;
        $values['custom'] = $userid;
			
		$DB->Insert("INSERT INTO members_online values('".time()."','$ip', 'app', '".$userid."')");


        ////////////////////////
        // SEND WELCOME EMAIL
        ////////////////////////
        $D1 = $DB->Row("SELECT value1 FROM system_settings WHERE name='welcome_email' LIMIT 1");

        SendTemplateMail($values, $D1['value1']);

        }else{
          $arrData[0] = new StdClass;
          $arrData[0]->msg = "Email already exist.";
        }
  }else{
    $arrData[0] = new StdClass;
    $arrData[0]->msg = "Username already taken.";
  }
				}
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Ooops!";
  echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

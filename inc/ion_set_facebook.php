<?php
header('Access-Control-Allow-Origin: *');

require_once("../inc/config.php");

global $DB;

$arrData = array();

if($_POST){

  $cemail = $_POST['email'];
  $cusername = $_POST['id'];
  $gender = $_POST['gender'];

  $user = $DB->Row("SELECT id, facebook_id FROM members WHERE facebook_id = ( '".$cusername."' ) LIMIT 1");

  if($user['facebook_id']){

      require_once("ion_app_function.php");
        $mad = MemberAccountDetails($user['id']);
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
  }else{
    // $mail = $DB->Row("SELECT id, email FROM members WHERE email= ( '".$cemail."' ) LIMIT 1");
    //
    //     if($mail['email']){
    //       $DB->Update("UPDATE `members` SET `facebook_id` = '".$cusername."' WHERE id='".$mail['id']."' LIMIT 1");
    //
    //       require_once("ion_app_function.php");
    //
    //         $mad = MemberAccountDetails($mail['id']);
    //
    //         $arrData[0] = new StdClass;
    //         $arrData[0]->msg = "Success :)";
    //         $arrData[0]->thumb_large = $mad['image'];
    //         $arrData[0]->thumb_small = $mad['image_small'];
    //         $arrData[0]->status = $mad['status'];
    //         $arrData[0]->membership = $mad['name'];
    //         $arrData[0]->username = $mad['username'];
    //         $arrData[0]->uid = $mail['id'];
    //         $arrData[0]->lastlogin = $mad['lastlogin'];
    //         $arrData[0]->profile_complete = $mad['profile_complete'];
    //         $arrData[0]->islogin = "yes";
    //     }
    //     else {

    $dirname = "../uploads/images";
    $dirnameThumb = "../uploads/thumbs";

          $split = explode('@',$cemail);
          $uname = $split[0];

          if($gender == 'male')
          $sex = '64';
          else if($gender == 'female')
          $sex = '63';
          else
          $sex = '0';

          $DB->Insert("INSERT INTO `members` ( `id` , `username` , `password`, `email`, `ip`, `lastlogin`, `created`, `facebook_id`) VALUES (NULL , '".$uname."', '".$cusername."', '".$cemail."', '".$_SERVER['REMOTE_ADDR']."' , '".DATE_NOW."' , '".DATE_NOW."', '".$cusername."')");

          $userid = $DB->InsertID();

          $DB->Insert("INSERT INTO `members_data` ( `uid`, `age`, `gender`) values ( '$userid', '1974-JAN-15', '$sex')");
          $DB->Insert("INSERT INTO `album` ( `aid` , `uid` , `title` , `comment` , `filecount` , `cat` , `allow_f` , `allow_h` , `allow_n` , `allow_a`,password, 	time, 	date )VALUES (NULL , '".$userid."', '".$uname." Album', '', '0', 'public', '0', '0', '0', '0','',now(),now())");
          $albumid = $DB->InsertID();
          $DB->Insert("INSERT INTO `members_privacy` (`uid` ,`Newsletters` ,`Notifications` ,`IM` ,`Language` ,`Time Zone` ,`friends` ,`comments` ,`profile_view` ,`im_window` ,`SMS_email` ,`SMS_wink` , `SMS_number` ,`SMS_credits` ,`SMS_country` ,`match_array` ,`email_winks` ,`email_msg` ,`email_friends` ,`email_match`, `profileview_friends`, `profileview_nonfriend`)VALUES ('".$userid."', 'yes', 'yes', 'yes', 'english', '', 'no', 'no', 'all', 'off', '', '', '', '50', '569', '', 'yes', 'yes', 'yes', 'yes','','')");
          //$DB->Update("UPDATE `members_data` SET `age``age` = '1974-JAN-15' WHERE uid='".$userid."' LIMIT 1");
          $ran = rand();
          $imgsPath = "FT".$userid.$ran.".jpg";

          $path = trim($dirname)."/".$imgsPath;
          $pathThumb = trim($dirnameThumb)."/".$imgsPath;
          $image = file_get_contents('https://graph.facebook.com/'.$cusername.'/picture'); // sets $image to the contents of the url
          file_put_contents($path, $image);
          file_put_contents($pathThumb, $image);

          $DB->Insert("INSERT INTO `files` ( `aid` , `uid` , `date` , `title`, `description`, `bigimage` , `approved` , `type` )
          VALUES ('".$albumid."', '".$userid."' , '".DATE_NOW."', '".$uname."' ,'".$uname."' ,'".$imgsPath."', 'yes', 'photo')");

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
        //}
  }

echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
else {
  $arrData[0] = new StdClass;
  $arrData[0]->msg = "Ooops!";
  echo json_encode($arrData, JSON_UNESCAPED_SLASHES);
}
?>

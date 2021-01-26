<?php
	
	require_once('../inc/config.php');
	require_once('twConfig.php');

	if(isset($_REQUEST['oauth_token'])) {
		

		//Call Twitter API
		$twClient = new TwitterOAuth(TWITTER_SIGNIN_KEY, TWITTER_SIGNIN_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
		
		//Get OAuth token
		$access_token = $twClient->getAccessToken($_REQUEST['oauth_verifier']);
	
		//If returns success
		if($twClient->http_code == '200'){
			//Storing access token data into session
			$_SESSION['status'] = 'verified';
			$_SESSION['request_vars'] = $access_token;
			
			//Get user profile data from twitter
			$userInfo = $twClient->get('account/verify_credentials');

			//Insert or update user data to the database
			$name = explode(" ",$userInfo->name);
			$fname = isset($name[0])?$name[0]:'';
			$lname = isset($name[1])?$name[1]:'';
			$profileLink = 'https://twitter.com/'.$userInfo->screen_name;
			
			$twUserData = array(
				'oauth_provider'=> 'twitter',
				'oauth_uid'     => $userInfo->id,
				'first_name'    => $fname,
				'last_name'     => $lname,
				'email'         => '',
				'gender'        => '',
				'locale'        => $userInfo->lang,
				'picture'       => $userInfo->profile_image_url,
				'link'          => $profileLink,
				'username'		=> $userInfo->screen_name
			);
			
			//Remove oauth token and secret from session
			unset($_SESSION['token']);
			unset($_SESSION['token_secret']);
		
			//Redirect the user back to the same page
			
			$id = $twUserData['oauth_uid'];
			$name = $twUserData['first_name']." ".$twUserData['last_name'];
			$email = $twUserData['oauth_uid']."@gmail.com";

			$fbid = $DB->Row("SELECT * FROM members WHERE facebook_id='".$id."' and facebook_id != '0' and facebook_id != '' LIMIT 1");

			if(empty($fbid)){

				if($id){	

					$fbemail =$email;
					$fbsession = session_id();
					$fbstatus = "active";
					$fbpasscode = $id;
					require_once('../inc/func/func_facebook_username.php');
					$fbusername = getFbUsername($name);
					session_destroy();
					session_start();

					$fbname = explode("@",$fbemail);
					$fbname['0'] = $fbusername;
					$reg_long = isset($reg_long) ? $reg_long : '';
					$reg_lat = isset($reg_lat) ? $reg_lat : '';
					$reg_country = isset($reg_country) ? $reg_country : '';
					$MSGSTATUS = isset($MSGSTATUS) ? $MSGSTATUS : '';
					$reg_long = isset($reg_long) ? $reg_long : '';
					$reg_code = isset($reg_code) ? $reg_code : '';

					$DB->Insert("INSERT INTO `members` ( `id` , `username` , `password` , `email` , `session` , `ip` , `lastlogin` , `reg_type`,`visible` , active, `created`, packageid, hits, profile_complete, templateid, updated, moderator, activate_code, highlight, ip_long, ip_lat, ip_country, ip_code,member_rating,  msgStatus,  video_duration,  video_live, facebook_id )VALUES (NULL , '".$fbname['0']."', '".md5($fbpasscode)."', '".$fbemail."', '".$fbsession."', '".$ip."', '".DATE_TIME."', 'TW','yes', '".$fbstatus."', '".DATE_TIME."', '3','0','0','1','".DATE_TIME."', 'no', 'OK','off','".$reg_long."','".$reg_lat."','".$reg_country."','".$reg_code."', '0','".eMeetingInput($MSGSTATUS)."','0','no','".$id."')");

					$userid = $DB->InsertID();

					$_SESSION['username'] = $fbname['0'];
					$_SESSION['uid'] = $userid;
					$DB->Insert("INSERT INTO `members_data` ( `uid` ) values ( '$userid' )");

					$default_CC = isset($default_CC) ? $default_CC : '';

					$DB->Update("UPDATE `members_data` SET age='1974-JAN-15', country='".eMeetingInput($default_CC)."', headline='' WHERE uid='".$userid."' LIMIT 1");

					$nw = isset($nw) ? $nw : '';
					$nn = isset($nn) ? $nn : '';
					$SMS_MSG = isset($SMS_MSG) ? $SMS_MSG : '';
					$SMS_EMAIL = isset($SMS_EMAIL) ? $SMS_EMAIL : '';
					$SMS_NUM = isset($SMS_NUM) ? $SMS_NUM : '';
					$packageData['SMS_credits'] = isset($packageData['SMS_credits']) ? $packageData['SMS_credits'] : '';
					$mycountry = isset($mycountry) ? $mycountry : '';

					$DB->Insert("INSERT INTO `members_privacy` (`uid` ,`Newsletters` ,`Notifications` ,`IM` ,`Language` ,`Time Zone` ,`friends` ,`comments` ,`profile_view` ,`im_window` ,`SMS_email` ,`SMS_wink` , SMS_number ,`SMS_credits` ,`SMS_country` ,`match_array` ,`email_winks` ,`email_msg` ,`email_friends` ,`email_match`, `profileview_friends`, `profileview_nonfriend`)VALUES ('".$userid."', '".$nw."', '".$nn."', 'yes', 'english', '', 'no', 'no', 'all', 'off', '".$SMS_MSG."', '".$SMS_EMAIL."', '".$SMS_NUM."', '".$packageData['SMS_credits']."', '".$mycountry."', '', 'yes', 'yes', 'yes', 'yes','','')");

					$DB->Insert("INSERT INTO `album` ( `aid` , `uid` , `title` , `comment` , `filecount` , `cat` , `allow_f` , `allow_h` , `allow_n` , `allow_a`,password, 	time, 	date )VALUES (NULL , '".$userid."', '".$fbname['0']." Album', '', '0', 'public', '0', '0', '0', '0','',now(),now())");

					$aid = $DB->InsertID();


					$fbpicture = $twUserData['picture'];

					$rez = get_all_redirects($fbpicture);

					$source = $rez[0];

					$sizes = @getimagesize($source);

					$mime = $sizes['mime'];

					$stamp_num="56982145798000";

					$stamp = $stamp_num-time();

					if($mime=="image/jpeg"){

					$extension="jpg";

					}elseif($mime=="image/png"){

					$extension="png";

					}elseif($mime=="image/bmp"){

					$extension="bmp";

					}elseif($mime=="image/gif"){

					$extension="gif";

					}

					$profile_image_name = $userid."_".$stamp.".".$extension."";
					$profile_image_path = PATH_IMAGE.$profile_image_name;
					$copy = copy($source, PATH_IMAGE.$profile_image_name);	

					if($copy){
						copy($source,$_SERVER["DOCUMENT_ROOT"]."/uploads/cache/".$profile_image_name);
						copy($source,$_SERVER["DOCUMENT_ROOT"]."/uploads/thumbs/".$profile_image_name);
				
						if(APPROVE_FILES =="yes"){ $appValue = "no"; }else{ $appValue = "yes";	}
						
						$DB->Insert("INSERT INTO `files` ( `id` , aid, `user` , `uid` , `date` , `title` , `description` , `bigimage` , `width` , `height` , `filesize` , `views` , `medwidth` , `medheight` ,  `approved` , `rating` , `default` , `featured` , `type` , rating_votes, adult_content) VALUES (NULL , '".$aid."', '".$fbname[0]."', '$userid', '".DATE_NOW."', '".$fbname['0']."', '".$fbname['0']."' , '$profile_image_name', '".$sizes[0]."' , '".$sizes[1]."' , '".filesize($profile_image_path)."', '400', '400', '0', '".$appValue."', '0.00', '1', 'no', 'photo','0','no')");

						$photo_id = $DB->InsertID();

						$DB->Update("UPDATE album SET filecount=filecount+1 WHERE aid= ( '".$aid."' ) LIMIT 1");
					}

					$_POST['do']="login";
					$_POST['visible']="0";
					$_POST['do_page']="login";
					$_POST['username']=$fbname['0'];
					$_POST['password']=$fbpasscode;
					$_POST['submit']="Login";
					$_POST['remember']="1";
					$_POST['skip_pass']=true;

			 		$SubSub_Lang = $_LANG_LOGIN;

					$GLOBALS['LANG_LOGIN'] = $_LANG_LOGIN;

					$PageDesc = (isset($SubSub_Lang[$page."_?"])) ? $SubSub_Lang[$page."_?"] : '';	

					## CREATE PAGE DATA	
					require_once "../inc/classes/class_regimg.php";	
					$obj = new SPAF_FormValidator();

					## PERFORM OPERATION

					if(isset($_POST['do'])){ 

						## includes login functions
						require_once('../inc/func/func_login.php');
					
						$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj, $MOBILE);
						
						## stops account login is profile is not approved
						if($Error_Report =="waiting"){
							echo "wait";
						}elseif($Error_Report =="login"){
							header("location : ". DB_DOMAIN);
						}
						else{
							header("location : ". DB_DOMAIN);
						}	

					}

				}

				//	header('Location: '.$new_url);
			}else{

				$data = $DB->Row("SELECT * FROM members WHERE facebook_id='".$id."' and facebook_id != '0' and facebook_id != '' LIMIT 1");

				$_POST['do']="login";
				$_POST['visible']="0";
				$_POST['do_page']="login";
				$_POST['username']=$data["username"];
				$_POST['password']=$data["password"];
				$_POST['submit']="Login";
				$_POST['remember']="1";
				$_POST['skip_pass']=true;


				## CREATE PAGE DATA	
				require_once "../inc/classes/class_regimg.php";	
				$obj = new SPAF_FormValidator();

				## PERFORM OPERATION
				if(isset($_POST['do'])){ 

					## includes login functions
					require_once('../inc/func/func_login.php');

					$MOBILE = "no";

					$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj, $MOBILE);
					$_SESSION['google_user'] = 'yes';
					
					## stops account login is profile is not approved
					if($Error_Report =="waiting"){
						echo 'wait';
					}elseif($Error_Report =="login"){
						header("location : ". DB_DOMAIN);
					}
					else{
						header("location : ". DB_DOMAIN);
					}
				}
			}
		}
	}
die;

<?php
/**
*       =========================================================================
*                                	CONFIG FILE
*       =========================================================================
*
*       @author:            AdvanDate, LLC
*       @copyright:         AdvanDate, LLC
*       @version:           Revision: 11.0
*       @date:              22nd Jan 2009
*       @last modified:     29th Jan 2009
*       @license            Licensed Software
*
*       @website:           www.advandate.com
*       @email:             contact@advandate.com
*
*       @requirements:      Valid Software License Key
*
*       =========================================================================
*
*       Copyright (C) 2009  AdvanDate, LLC
*       
*       This program is not free software; you can not redistribute it and/or modify it
*       under the terms of the eMeeting Dating Software License as published by the
*       AdvanDate, LLC.
*       
*       This program is distributed in the hope that it will be useful, but
*       WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
*       or FITNESS FOR A PARTICULAR PURPOSE. See the Software  License
*       for more details.
*       
*       You should have received a copy of the License Key along
*       with this program; if not, write to eMeeting LLC or view the website for more details
*
*       =========================================================================
*/
//header('Content-Type: text/html; charset='.$GLOBALS['_META']['_charset'].'');
## SET PHP DEFAULTS
ini_set("memory_limit", "128M");
ini_set("max_execution_time", 0);
ini_set('post_max_size','30M');
ini_set('upload_max_filesize','30M');
//ini_set('session.cache_limiter', 'private');
//ini_set('default_charset', 'iso-8859-1');
## START SESSIONS
if(!session_id())session_start();
## ERROR HANDELING FROM EMEETING
error_reporting(E_ALL & ~E_NOTICE); //E_ALL & ~E_NOTICE
ini_set('display_errors', 1);
ini_set('display_startup_errors', 0);
error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
//set_magic_quotes_runtime(0);
///////////////////////////////////////////////////////////////////////////////////////////
// TEMPLATES AND LANGUAGES
///////////////////////////////////////////////////////////////////////////////////////////
define('D_TEMP','v21_cupidlove'); 				// Define Website Template 
define('DEFAULT_PACKAGE','3');			// enter the package id for the default members
//////////////////////////////////////////////////////////////////////////////////////////
// ADMIN AREA LOGIN DETAILS
///////////////////////////////////////////////////////////////////////////////////////////
define('ADMIN_EMAIL',''); 			// ADMIN EMAIL ADDRESS
define('ADMIN_USERNAME','admin');
define('ADMIN_PASSWORD','iibQK7Xq');
define('ADMIN_UID','0');
define('ADMIN_TOTAL_LOGIN','0');

//////////////////////////////////////////////////////////////////////////////////////////
// WEBSITE FEATURES - EDIT VIA THE ADMIN AREA ONLY
///////////////////////////////////////////////////////////////////////////////////////////
define('ONLINE_NOW_TIMEOUT','3600'); // seconds
define('D_REGISTER_IMAGE','1');
define('D_ZIPCODES','0');
define('D_POSTCODES','0');
define('MSN_INCLUDE','');
define('MUST_HAVE_IMAGE','1');
define('DISPLAY_VERIFICATION_CODE','0');
define('VALIDATE_EMAIL','0');				// turn this to 0 if you wish your
											// members to enter their own password
define('APPROVE_ACCOUNTS','yes');    	   	// choose yes or no
define('APPROVE_FILES','yes');				// choose yes or no
define('ENABLE_ADULTCONTENT','yes');    	   // choose yes or no
define('U_EDITOR','yes');					// yes or no

// PAYPAL OPTIONS ( https://developer.paypal.com/developer/accounts/ )
define('PAYPAL_ENVIRONMENT_PRODUCTION', ' '); 	// ENTER PAYPAL ENVIRONMENT PRODUCTION ID
define('PAYPAL_ENVIRONMENT_SANDBOX',' ');		// ENTER PAYPAL ENVIRONMENT SANDBOX ID
define('PAYPAL_LIVE', 'no');					// CHOOSE yes or no

// UPDATE OPTIONS
define('UPGRADE_HIGH','yes'); 				// SHOW HIGHLIGHT PROFILE OPTINS
define('UPGRADE_FEA','yes');				// SHOW FEATURED MEMBER OPTIONS
define('D_FORUM','1');
define('D_BLOG','1');
define('D_CHATROOM','');
define('D_IM','1');
define('D_VIDEOFEEDS','1');
define('D_MATCHTESTS','1');
define('D_FLAGS','1');
define('D_FLASHCOM_CHAT','1'); 
define('D_FREE','no');
define('D_AGE','1'); // not used in v8
define('D_GROUPS','1');
define('D_NETWORK','1');
define('D_SEARCH','1');
define('D_TOUR','1');
define('D_FAQ','1');
define('D_CONTACT','1');
define('D_GAMES','1'); //
define('D_MOD_WRITE','1'); //
define('D_FEATURED_MEMBER_NUM','20'); //
define('D_FEATURED_MEMBER_GENDER','match'); //
define('D_EVENTS','1'); //
define('POPUP_WINDOW','1'); //
define('D_COMMENTS','1'); //
define('D_ARTICLES','1'); //
define('D_POP_UP_ALERT','1'); //
define('D_DESIGNER',''); //
define('D_CLASSADS','1'); //
define('D_VIDEOS','1'); //
define('D_MUSIC','1'); //
define('D_MESSAGES','1'); //
define('D_GALLERY','1'); //
define('D_MEET_ME','1'); //
define('D_FONT_FAMILY','raleway'); //
define('D_NEAR_ME','1'); //
define('D_SETTINGS','1'); //
define('D_ACCOUNT','1'); //
define('D_STATUSMSG','love!'); //
define('D_PROFILERATING','1'); //
define('D_GENDERMATCHING','0'); //
define('D_SIDEBARONLINE','0'); //
define('D_FEATUREDMEMBERTOP2','1'); //
define('D_MEETME','1'); //
define('D_NEARME','1'); //
define('D_PARTNER','0'); //
define('D_FRIENDS','1'); //
define('D_HOTLIST','1'); //
define('D_WINK','1'); //
define('D_SKYPE','1'); //
define('D_BLINK_SOUND','0'); //
define('D_FOLLOW','0');
define('D_RECOMMEND','0');
define('D_STARSIGN','1');
define('D_RECENT_ARTICLES','15');
define('D_ARTICLE_LIMIT','2');
define('D_MD5','1');
define('D_HEADER_LAYOUT','boxed');
define('D_COMPATIBILITY_QUIZ','yes');
define('D_PROFILE_COMPARE','yes');
define('D_CREDIT_STATUS','yes');
define('D_CREDIT_EMAILS','33');
define('D_CREDIT_PRICE','22');
define('D_QUICK_LINK_BOX','yes');
define('D_BREADCRUMBS','yes');
define('HEADER_META_TITLE','');
define('D_USER_REGISTRATION','sliding');
define('D_USER_HEADER','yes');
define('D_USER_FOOTER','yes');
define('D_USER_REGISTER_BACKGROUND_IMAGE','user_register_background_image.jpg');
define('D_INTERESTS','1');
define('D_MESSAGE_CARDS','1');
define('D_MOBILE','0');
define('D_IM_POPUP','1');
define('D_MUST_UPGRADE','no'); //
define('D_CCTEXT','All Rights Reserved'); //
//////////////////////////////////////////////////////////////////////////////////////////
// UPLOAD TYPES
///////////////////////////////////////////////////////////////////////////////////////////
define('UP_PHOTO','1'); // SHOW SMS OPTIONS
define('UP_VIDEO','1');
define('UP_MUSIC','1');
define('UP_YOUTUBE','1');
define('YOUTUBE_API_ID',''); //bf22UCJzyh4
//////////////////////////////////////////////////////////////////////////////////////////
// SEARCH RESULT LIMITS
///////////////////////////////////////////////////////////////////////////////////////////
define('SEARCH_PAGE_DISPLAY','gallery'); // search style  'gallery','detail','basic'
define('SEARCH_PAGE_ROWS','20'); // search page 
define('MATCH_PAGE_ROWS','2'); // overview page on account area
define('MATCH_PD','pagination'); // Pagination or Dynamic
//////////////////////////////////////////////////////////////////////////////////////////
// CALENDAR SETTINGS
///////////////////////////////////////////////////////////////////////////////////////////
define('D_CALENDAR','yes'); // yes / no  display calendar
//define('CAL_AUTOAPPROVE','yes'); //  yes / no
//////////////////////////////////////////////////////////////////////////////////////////
// SMS SETTINGS
///////////////////////////////////////////////////////////////////////////////////////////
define('UPGRADE_SMS','no'); // SHOW SMS OPTIONS
define('SMS_PRICE','NOT USED');
define('SMS_CURRENCY','NOT USED');
//////////////////////////////////////////////////////////////////////////////////////////
// AFFILIATE SYSTEM
///////////////////////////////////////////////////////////////////////////////////////////
define('AFF_ENABLED','yes');
define('AFF_CURRENCY','$');
//////////////////////////////////////////////////////////////////////////////////////////
// SYSTEM MISC
///////////////////////////////////////////////////////////////////////////////////////////
@date_default_timezone_set('America/Los_Angeles');
define('DATE_DISPLAY_FORMAT','m-d-Y');
$DDate = explode(" ",@date("Y-m-d H:i:s"));
define('DATE_NOW',$DDate[0]); 				// define system date
define('TIME_NOW',$DDate[1]); 				// define system time
define('DATE_TIME',@date("Y-m-d H:i:s"));		// define date time
///////////////////////////////////////////////////////////////////////////////////////////
// MEMBER AUTO LOGIN 
///////////////////////////////////////////////////////////////////////////////////////////
define('AUTO_LOGIN','no');
define('AUTO_AMOUNT','20');			// enter the amount of accounts to auto login
define('AUTO_AMOUNT_LIMIT','10'); // less than this and the system will start working
define('AUTO_MINIMUM_ONLINE','15'); // minimum number of online members 
//////////////////////////////////////////////////////////////////////////////////////////
// INSTALLATION DATE
///////////////////////////////////////////////////////////////////////////////////////////
define('DATESETUP','2015-07-04');
require_once(	dirname(__FILE__)."/_version.php" );	
//////////////////////////////////////////////////////////////////////////////////////////
// EMAIL SETTINGS
///////////////////////////////////////////////////////////////////////////////////////////
define('SEND_ADMIN_NAME','Admin');
define('SEND_HTML','on');				// turn this 'on' or 'off' to 
										// send emails in HTML or plain text format
define('USE_SMTP','no');				// yes or no
define('SMTP_FROM_NAME','');			// example.com
define('SMTP_SERVER',''); 				// usually localhost
define('SMTP_PORT','25'); 				// usually port 25
define('SMTP_USERNAME',''); 				// usually port 25
define('SMTP_PASSWORD',''); 				// usually port 25
define('SMTP_FROM_MAILER','Domain V12.1');
//////////////////////////////////////////////////////////////////////////////////////////
// ADMIN EMAIL EVENTS
///////////////////////////////////////////////////////////////////////////////////////////
define('SEMAIL_JOIN','no'); //
define('SEMAIL_UPDATE','no'); //
define('SEMAIL_FILES','no'); //
define('SEMAIL_GROUPS','no'); //
define('SEMAIL_CLASSADS','no'); //
define('SEMAIL_FORUM',''); //
define('SEMAIL_BLOG','no'); //
define('SEMAIL_CALENDAR','yes'); //
define('SEMAIL_LOGIN','no'); //
define('SEMAIL_TEMPLATE','62'); //
///////////////////////////////////////////////////////////////////////////////////////////
// CUSTOM VARIABLES WHICH CAN BE ADDED FOR PLUGINS
///////////////////////////////////////////////////////////////////////////////////////////
$ip = $_SERVER['REMOTE_ADDR'];
$HEADER_META_BASE 		=""; // ADD EXTRA DATA TO META TAGS
$FOOTER_MENU_TIMER 		=""; // ADD EXTRA DATA FOR FOOT TAGS
$ChatRoomArray = array(
	"width" => "750",
	"height" => "510",
	"path" => "inc/exe/ChatRoom/chat.php",
);
$IMRoomArray = array(
	"width" => "415",
	"height" => "460",
	"path" => "inc/exe/IM/window.php?pId=",
);
$PLUGINS_MENU_BAR = '';
//////////////////////////////////////////////////////////////////////////////////////////
// ADMIN AREA DEMO // THIS WILL DISABLE ALL ADMIN FEATURES
///////////////////////////////////////////////////////////////////////////////////////////
define('ADMIN_DEMO','no');
define('WEBSITE_DEMO','no');
//////////////////////////////////////////////////////////////////////////////////////////
// FORUM INTEGRATION SETTINGS
///////////////////////////////////////////////////////////////////////////////////////////
define('FORUM_DEFAULT_ENABLED','yes');
define('FORUM_DEFAULT_LINK','inc/exe/forum/index.php');
define('FORUM_VB_ENABLED','no'); // integrated version 3.6.2
define('FORUM_VB_LINK','');
define('FORUM_VB_DATABASE','');
define('FORUM_VB_ROOTPATH','');
define('FORUM_PHPBB_ENABLED','no');
define('FORUM_PHPBB_LINK','');
define('FORUM_PHPBB_DATABASE','');
define('FORUM_PHPBB_ROOTPATH','');
define('USERS_TABLE','phpbb_users');
//////////////////////////////////////////////////////////////////////////////////////////
// FILE AND FOLDER PATHS
///////////////////// zzzzzzzz//////////////////////////////////////////////////////////////////////
define('PATH_IMAGE','C:\\OpenServer\\OpenServer\\domains\\icupid_developer\\/uploads/images/');
define('PATH_IMAGE_THUMBS','C:\\OpenServer\\OpenServer\\domains\\icupid_developer\\/uploads/thumbs/');
define('PATH_VIDEO','C:\\OpenServer\\OpenServer\\domains\\icupid_developer\\/uploads/videos/');
define('PATH_MUSIC','C:\\OpenServer\\OpenServer\\domains\\icupid_developer\\/uploads/music/');
define('PATH_FILES','C:\\OpenServer\\OpenServer\\domains\\icupid_developer\\/uploads/files/');
define('WEB_PATH_IMAGE','http://localhost:8000/uploads/images/');
define('WEB_PATH_IMAGE_THUMBS','http://localhost:8000/uploads/thumbs/');
define('WEB_PATH_VIDEO','http://localhost:8000/uploads/videos/');
define('WEB_PATH_MUSIC','http://localhost:8000/uploads/music/');
define('WEB_PATH_FILES','http://localhost:8000/uploads/files/');


$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
define('domain_name',$protocol.$_SERVER['HTTP_HOST']);
//////////////////////////////////////////////////////////////////////////////////////////
// EVENTFUL API 
///////////////////////////////////////////////////////////////////////////////////////////
define('EVENTFUL_USERNAME',''); // LEAVE BLANK  TO DISABLE
define('EVENTFUL_PASSWORD','');
define('EVENTFUL_KEY','');
//////////////////////////////////////////////////////////////////////////////////////////
// reCAPTCHA API
///////////////////////////////////////////////////////////////////////////////////////////
define('reCAPTCH_APP_ID','');
define('reCAPTCH_SECRET','');
//////////////////////////////////////////////////////////////////////////////////////////
// FACEBOOK API
///////////////////////////////////////////////////////////////////////////////////////////
define('FACEBOOK_APP_ID','');
define('FACEBOOK_SECRET','');
define('FACEBOOK_PHOTO','yes');

//////////////////////////////////////////////////////////////////////////////////////////
// REQUITIX OPTIONS
///////////////////////////////////////////////////////////////////////////////////////////
define('ETH_ADDRESS','');
define('REQUITIX_API_KEY','');
define('ETH_image','');
//////////////////////////////////////////////////////////////////////////////////////////
// EXTRA OPTIONS
///////////////////////////////////////////////////////////////////////////////////////////
define('SEARCH_WITHOUT_PICS','yes'); // dont display search results if they havent got a picture.
define('BADWORD_REPLACE','******'); // replace badwords with this text
define('BLOCK_USERNAMES','admin,administration,wanker');
//////////////////////////////////////////////////////////////////////////////////////////
// LANGUAGE FILE -- VERY IMPORTANT DO NOT REMOVE
//////////////////////////////////////////////////////////////////////////////////////////
 
//////////////////////////////////////////////////////////////////////////////////////////
// IDENTIFY UNIQUE USER
//////////////////////////////////////////////////////////////////////////////////////////



//if( !defined('A_LANG') ){
	if ( !isset($_SESSION['lang'] ) && !isset($_REQUEST['l']) ){
		
			// SAVE SESSON FOR LANG
			define('D_LANG','english');
			$_SESSION['lang'] = D_LANG;		 
	}else{		
 
				if (isset($_REQUEST['l'])){ 
					unset($_SESSION['lang']);
				}
				if (isset($_SESSION['lang']) && !isset($_REQUEST['l'])){
						$_REQUEST['l'] = $_SESSION['lang'];
						define('D_LANG',$_REQUEST['l']); 
				}
				elseif (isset($_SESSION['lang'] ) && isset($_REQUEST['l'])){
						unset($_SESSION['lang']);
						$_SESSION['lang'] = $_REQUEST['l']; 
						define('D_LANG',$_REQUEST['l']); 
				}
				else{
					$path=$_SERVER['SCRIPT_FILENAME'];
					$path = str_replace("newadmin", "", $path);
					$path = str_replace("plugins/plugins/", "", $path);
					$path_parts = pathinfo($path);
 
					if (file_exists($path_parts['dirname']."/inc/langs/".strip_tags($_REQUEST['l']).".php")) {
						$_SESSION['lang'] = $_REQUEST['l'];
						define('D_LANG',$_REQUEST['l']);
					} else {
					   define('D_LANG','english');
					}				
			}	
			
			if(isset($_GET['l'])){	
				header("location: ".$_SERVER['HTTP_REFERER']);
			}
	}
//}
 
	/***************************************************************************
	 * 
	 *						DO NOT MODIFY THIS FILE
	 *
	 ***************************************************************************/
	require_once(	dirname(__FILE__)."/config_db.php"					); 		## loads the database login details
	require_once(	dirname(__FILE__)."/config_packageaccess.php"					); 		## loads the database login details
	if(file_exists(dirname(__FILE__)."/templates/".D_TEMP."/_setup.php")){
	 require_once(	dirname(__FILE__)."/templates/".D_TEMP."/_setup.php" ); 	## DOES THIS TEMPLATE HAVE ANY CUSTOM SETTINGS ?	
	}
	require_once(	dirname(__FILE__)."/func/globals.php"				); 		## loads the main functions file
	require_once(	dirname(__FILE__)."/classes/class_mysql.php"		); 		## loads the MYSQL connection class
	require_once( 	dirname(__FILE__).'/classes/class_email.php' 		); 		## loads the email connection class
	require_once( 	dirname(__FILE__).'/classes/class_keywords.php' 		); 		## loads the email connection class
	 
	if( defined('A_LANG') ){	$Admin_Charset = $GLOBALS['_META']['_charset'];	}
	if(D_LANG =="" || !file_exists(dirname(__FILE__)."/langs/".strip_tags(D_LANG).".php") ){ 
			require_once(	dirname(__FILE__)."/langs/english.php"			);  
	}else{  
			require_once(	dirname(__FILE__)."/langs/".strip_tags(D_LANG).".php"			); 
	}
	
	require_once(	dirname(__FILE__)."/config_template.php"			); 		## loads the custom template changes	
	if(isset($Admin_Charset)){ $GLOBALS['_META']['_charset'] = $Admin_Charset; } 
	$_SESSION['lang_charset'] = $GLOBALS['_META']['_charset']; 
	define('EMAIL_CHARSET',$GLOBALS['_META']['_charset']);							## edit the email charset, leave this if you are not sure
 
	 /**
	 * Info: Functions that require the software installed
	 * @version  9.0
	 * @created  Fri Sep 18 2008
	 * @updated  Fri Jan 18 2008
	 */
 
if(DB_USER != ""){
	if(KEY_ID =="" && !isset($loginSet) ){
		die("<div align='center' style='width:500px; margin-left:35%; height: 100px; padding-top:205px'>
		<font size='6' face='Verdana, Arial, Helvetica, sans-serif'>License Key Invalid or Incorrect</font><br><br>
		<font face='Arial, Helvetica, sans-serif'>Your iCupid dating software license key needs updating,<br> 
		please check your config file to ensure your<br> license key has been entered correctly.<br><br><strong>Need Help? 
		<a href='http://www.advandate.com'>http://www.advandate.com</a></strong></font></div>");
	}
	## database connection
	$DB = new DB(DB_HOST, DB_USER, DB_PASS, DB_BASE, false, false, $GLOBALS['_META']['_charset']); // must be utf8 for global usage
	$DB_STATUS = $DB->Connect();
	## message if the database doesnt connect
	if($DB_STATUS ==1){
		
		die("<div align='center' style='width:500px; margin-left:35%; height: 100px; padding-top:205px'>
		<font size='6' face='Verdana, Arial, Helvetica, sans-serif'>Database Connection Issue</font><br><br>
		<font face='Arial, Helvetica, sans-serif'>iCupid dating software was unable to talk with your MYSQL <br> database, 
		please check your config file to ensure your<br> username + password are correct.<br><br><strong>Need Help? 
		<a href='http://www.advandate.com'>http://www.advandate.com</a></strong></font></div>");
	
	}
	## auto login from emails
	if(isset($_GET['valMe']) && is_numeric($_GET['valMe'])){
			## PHP BB3 INTEGRATION CODE
			if(FORUM_PHPBB_ENABLED =="yes"){
				define('IN_PHPBB', true);
				$phpbb_root_path = FORUM_PHPBB_ROOTPATH;
				$phpEx = substr(strrchr(__FILE__, '.'), 1);
				include($phpbb_root_path . 'common.' . $phpEx);
				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
				$user->session_begin();$auth->acl($user->data);$user->setup();				
			}
			
			## vbull intrgation code
			if(FORUM_VB_ENABLED =="yes"){
				define('THIS_SCRIPT', 'login');
				define('CWD',FORUM_VB_ROOTPATH);
				require_once('./vbull/global.php');
				require_once('./vbull/includes/functions_login.php');
				$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user
				WHERE username = ('".htmlspecialchars(mysql_real_escape_string(strip_tags(trim(strtolower($_POST['username'])))))."') LIMIT 1");
			}
	
		require_once('inc/func/func_login.php');
		$MOBILE = (isset($MOBILE)) ? $MOBILE : '';
		$Error_Report =  ChangeDo("validate", $_GET, "", $MOBILE);
		
		if($Error_Report =="waiting"){
			header("location: ".DB_DOMAIN."index.php?dll=login&errorid=".$_LANG_LOGIN[3]);
		}elseif($Error_Report =="login"){
				header("location: ".DB_DOMAIN."account");
		}else{
				$_GET["dll"]="login";
		}
	}	
	## sets the main flag, "am i logged in?"
	if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes"){
		$im_Looged_in = true;
	}else{
		$im_Looged_in = false;
	}
	
	## checks for cookie and logs in the user
	if (!isset($_SESSION['uid']) ) {	
			if ( isset($_COOKIE['emeeting']) ) {
					checkRemembered($_COOKIE['emeeting']); 
					session_clever_defaults();
			}else{
					session_defaults();
					session_clever_defaults();
			}
	}else{	
			if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && !isset($_COOKIE['emeeting'])){		
				setcookie("emeeting[username]", "".$_SESSION['username']."", time()+3600);
				setcookie("emeeting[uid]", "".$_SESSION['uid']."", time()+3600);
				setcookie("emeeting[packageid]", "".$_SESSION['packageid']."", time()+3600);
				setcookie("emeeting[genderid]", "".$_SESSION['genderid']."", time()+3600);
			}
		}
		
	## check for affiliate link
	if(isset($_REQUEST['affid']) && is_numeric($_REQUEST['affid']) && $_REQUEST['affid'] != ""){
		## SETUP THE COOKIE FOR THE USER WHO HAS BEEN REFERED
		## BY AN AFFILIATE MEMBER TO THIS MEMBER
		setcookie ('affiliate', ''.strip_tags($_REQUEST['affid']).'', time() + (60*60*24));
		
		## REGISTER AFFILIATE LINK CLICK IN THE DATABASE
		$DB->Insert("UPDATE aff_members SET total_clicks=total_clicks+1 WHERE id= ( '".htmlspecialchars(mysql_real_escape_string(strip_tags($_REQUEST['affid'])))."' ) LIMIT 1");
	
	}
	if(!isset($_SESSION['auth'])){
		session_defaults();
	}
	## BASIC MEMBER DETAILS #########################################
	define('my_auth',$_SESSION['auth']);
	define('my_packageid',$_SESSION['packageid']);
	define('my_username',$_SESSION['username']);
	define('my_uid',$_SESSION['uid']);
	define('my_logged_in',$im_Looged_in);
	#################################################################
}
 
	 /**
	 * Info: Make page an subpage names
	 * @version  9.0
	 * @created  Fri Sep 18 2008
	 * @updated  Fri Jan 18 2008
	 */
	$page    = (isset($_GET["dll"]) && $_GET["dll"] !="")		?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_GET["dll"])))		:'index';
	$page    = (isset($_POST["do_page"]))	?	strip_tags($_POST["do_page"])	:$page;
	$page    = (isset($_GET["do_page"]) && $_GET["dll"] !="")	?	htmlspecialchars(mysql_real_escape_string(strip_tags($_GET["do_page"])))	:$page;
	
	$sub_page    = (isset($_GET["sub"]) && $_GET["sub"] !="")	?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_GET["sub"])))		:'';
	$sub_page   = (isset($_POST["sub"]))	?	strip_tags($_POST["sub"])		:$sub_page;
	$item_id    = (isset($_GET["item_id"]) 		&& $_GET["item_id"] !="")		?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_GET["item_id"])))	:'';
	$item_id    = (isset($_POST["item_id"]))	?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_POST["item_id"])))	:$item_id; 
	$item2_id    = (isset($_GET["item2_id"]) && $_GET["item2_id"] !="")		?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_GET["item2_id"])))	:'';
	$item2_id    = (isset($_POST["item2_id"]))	?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_POST["item2_id"])))	:$item2_id; 
	$item3_id    = (isset($_GET["item3_id"]) && $_GET["item3_id"] !="")		?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_GET["item3_id"])))	:'';
	$item3_id    = (isset($_POST["item3_id"]))	?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_POST["item3_id"])))	:$item3_id; 
	$search_page    = (isset($_GET['view_page']) && is_numeric($_GET['view_page']))		?	'0'		:'0';
	$search_page    = (isset($_POST['page']) && is_numeric($_POST['page']))		?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_POST['page'])))		:$search_page;
	$search_page    = (isset($_GET['page']) && is_numeric($_GET['page']))		?	htmlspecialchars(mysqli_real_escape_string($DB->Connection(),strip_tags($_GET['page'])))		:$search_page;
	$search_uid    = (isset($_GET['fcid']) && is_numeric($_GET['fcid'])) ?	$_GET['fcid']	: "";
	$search_uid    = (isset($_POST['fcid']) && is_numeric($_POST['fcid'])) ?	$_POST['fcid']	: $search_uid;
	$search_uid    = (isset($_GET['fcid']) && $_GET['fcid'] ==0 && $_SESSION['auth'] =="yes") ?	 $_SESSION['uid']	: $search_uid ;
 	$PageTitle="";
	$PageDesc="";
	$MyAlertsBar="";
	$ThisPersonsNetworkBar="";
	## error message call
	if(isset($_REQUEST["errorid"])){$Error_Report= eMeetingOutput(strip_tags($_REQUEST["errorid"])); ;};
	 /**
	 * Info: Logout Page Call
	 * @version  9.0
	 * @created  Fri Sep 18 2008
	 * @updated  Fri Jan 18 2008
	 */	
	if($page =="logout"){
		$DB->Insert("DELETE FROM members_online WHERE logid= ('".$_SESSION['uid']."')");
		$DB->Insert("UPDATE members SET video_live ='no' WHERE id= ('".$_SESSION['uid']."')");
		if($_SESSION['remember'] == 0) {
		   setcookie("emeeting[username]", "", time()-3600);
		}else{
		   setcookie("emeeting[username]", "".$_SESSION['username']."", time()+3600);
		}
		@session_unset($_SESSION['lang']);
		@session_unset($_SESSION['lang_charset']);
		@session_unset($_SESSION['auth']);
		@session_unset($_SESSION['uid']);
		@session_unset($_SESSION['username']);
		@session_unset($_SESSION['remember']);
		@session_unset($_SESSION['packageid']);
		@session_unset($_SESSION['genderid']);
		@session_unset($_SESSION['site_moderator']);
		@session_unset($_SESSION['banned_check']);
		@session_unset($_SESSION['lastlogin']);
		@session_unset($_SESSION['site_moderator_email']);
		@session_unset($_SESSION['site_moderator_edit']);
		@session_unset($_SESSION['site_moderator_delete']);
		@session_unset($_SESSION['pack_name']);
		@session_unset($_SESSION['pack_winks']);
		@session_unset($_SESSION['pack_highlight']);
		@session_unset($_SESSION['pack_messages']);
		@session_unset($_SESSION['pack_files']);
		@session_unset($_SESSION['pack_featured']); 
 
		//setcookie("emeeting[username]", "", time()-3600);
		setcookie("emeeting[uid]", "", time()-3600);
		setcookie("emeeting[packageid]", "", time()-3600);
		setcookie("emeeting[genderid]", "", time()-3600);
		
		## check for phpbb integation and logout
		if(FORUM_PHPBB_ENABLED =="yes"){
			define('IN_PHPBB', true);
			$phpbb_root_path = FORUM_PHPBB_ROOTPATH;
			$phpEx = substr(strrchr(__FILE__, '.'), 1);
			if(file_exists($phpbb_root_path . 'common.' . $phpEx)){
						include($phpbb_root_path . 'common.' . $phpEx);
						$user->session_begin();	$auth->acl($user->data);$user->setup();		
						if($user->data['is_registered']){	$user->session_kill();	$user->session_begin();	}
			}
		}
		## send user to home page after logout	
		//if ($mobile == "yes") {
		//header("location: ".DB_DOMAIN."mobile.php");
		//}else{ 
                header("location: ".DB_DOMAIN."index.php");
		//}
		exit();
	}
	 /**
	 * Info: Create Variable Defaults
	 * @version  9.0
	 * @created  Fri Sep 18 2008
	 * @updated  Fri Jan 18 2008
	 */
	if(isset($_REQUEST['pId']) && !is_numeric($_REQUEST['pId'])){ 
		header("location: ".DB_DOMAIN."index.php");
	}
	//echo "Time:".time();
	//echo "Micro".microtime();
	//floor((float) $val / $step) * $step;
	$StartTimer = ((float)  time()+ (float) microtime());
	$CUSTOM_PAGE=0;
	if(!isset($page)){ 		$page=""; 		}
	if(!isset($sub_page)){ 	$sub_page=""; 	}
	 /**
	 * Info: Defalt page deney array, add any page name to this list to prevent un
	 * 		 registered users from accessing it
	 * @version  9.0
	 * @created  Fri Sep 18 2008
	 * @updated  Fri Jan 18 2008
	 */
	
	$Access_Private = array('account','messages','quiz','overview','network','settings','matches','subscribe'); // Define Account pages ,'calendar', 'groups'
	
	if(in_array($page,$Access_Private)  && (!isset($_SESSION['auth']) || $_SESSION['auth'] !="yes") ){
	
		header("location: ".getThePermalink('login',array('msg' => $lang_ajax['6']))."**1"); // Send them to the login page
		exit();
	}
	 /**
	 * Info: Catch all $_POST data and make it MYSQL friendly
	 * 		
	 * @version  9.0
	 * @created  Fri Sep 18 2008
	 * @updated  Fri Jan 18 2008
	 */
    if( version_compare( PHP_VERSION, "6.0", "<" ) )
    {
        // We prefer to clean up our own data (PHP versions < 6 ):
        //set_magic_quotes_runtime( false );
        if( get_magic_quotes_gpc() )
        {
            // thanks to php.net/magic_quotes:
            function stripslashes_deep( $value )
            {
               $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
                return( $value );
            }
            $_GET 		= stripslashes_deep( $_GET );
            $_POST 		= array_map('stripslashes_deep', $_POST);
        }
		
    }
	if( isset($_POST) && !empty($_POST) && !isset($_POST["StopConfigStrip"]) ){		
		 
		$_POST = @array_map('eMeetingInput',$_POST);
		
	}
	 /**
	 * Info: Membership Package Options
	 * 		
	 * @version  9.0
	 * @created  Fri Sep 18 2008
	 * @updated  Fri Jan 18 2008
	 */
	$PAGE_ARRAY = array(
		"chatroom" => isset($LANG_CHAT_MENU) ? $LANG_CHAT_MENU:'',
		"account" => isset($LANG_ACCOUNT_MENU) ? $LANG_ACCOUNT_MENU:'',
		"messages" => isset($LANG_MESSAGES_MENU) ? $LANG_MESSAGES_MENU :'',
		"gallery" => isset($LANG_GALLERY_MENU) ? $LANG_GALLERY_MENU :'',
		"settings" => isset($LANG_SETTINGS_MENU) ? $LANG_SETTINGS_MENU :'',
		"calendar" => isset($LANG_EVENTS_MENU) ? $LANG_EVENTS_MENU :'',
		"groups" => isset($LANG_GROUPS_MENU) ? $LANG_GROUPS_MENU :'',
		"classads" => isset($LANG_CLASSADS_MENU) ? $LANG_CLASSADS_MENU :'',
		"blog" => isset($LANG_BLOG_MENU) ? $LANG_BLOG_MENU :'',
		"games" => isset($LANG_1GAME_MENU) ? $LANG_1GAME_MENU:'',
		"matches" => isset($LANG_MATCH_MENU) ? $LANG_MATCH_MENU:'',
		"music" => isset($LANG_MUSIC_MENU) ? $LANG_MUSIC_MENU:'',
 		"videos" => isset($LANG_VIDEO_MENU) ? $LANG_VIDEO_MENU :'',
 		"chat" => isset($LANG_FLASHCOM_CHAT) ? $LANG_FLASHCOM_CHAT :''
	);
?>
<?php 


/***************************************************************************
 *
 *	 PROJECT: iCupid Dating Software
 *	 VERSION: 13
 *	 LICENSE: OWN / LEASED (http://www.advandate.com/)
 *
 *	 This program is a commercial software product and any kind of usage 
 *	 means agreement to the eMeeting software License Agreement.
 *
 *	 This notice MUST NOT be removed from the code.   
 *
 *   Copyright 2006-2018 AdvanDate, LLC.
 *   http://www.advandate.com/
 

 *
 ***************************************************************************/
///////////////////////////////////////////////////////////////////////////////////////////
// REQUIRED PAGE FUNCTIONS AND CLASSES
///////////////////////////////////////////////////////////////////////////////////////////

    

require_once("inc/config.php"); 

// check secret key
require_once('inc/func/recaptchalib.php');  
if(!defined('D_MOBILE') || D_MOBILE!="0") {
   require_once(	dirname(__FILE__)."/inc/config_db.php"); 
   $useragent=$_SERVER['HTTP_USER_AGENT'];
   if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
	if($page == "profile") {
		if ( isset($_GET['pId'])) {
			header("Location: ".DB_DOMAIN."mobile.php?dll=mobileprofile&pId=".$_GET['pId']);
		}else{
			header("Location: ".DB_DOMAIN."mobile.php?dll=mobileprofile&pUsername=".$_GET['pUsername']);
		}
       }else{
		header("Location: ".DB_DOMAIN."mobile.php");
       }
   }
}

$MOBILE = "no";
require_once("inc/API/api_functions.php");
require_once("plugins/config_plugins.php");

$CUSTOM_PLUGIN_HEADER = $HEADER_META_BASE;
$HEADER_META_BASE="";
$PLUGINS_FOOTER="";
header("Cache-Control: no-cache");
header("Pragma: no-cache");
//$DB->Update("UPDATE members_network SET approved='yes'");
///////////////////////////////////////////////////////////////////////////////////////////
// DETECT INSTALLATION DIRECTORY
///////////////////////////////////////////////////////////////////////////////////////////
	 /**
	 * Page: Will detect install directory for automatic install
	 * 		
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Jan 18 10:48:31 EEST 2008
	 */
	if(DB_USER == ""){ 
		 $directory = @opendir('./install/');
		if ($directory)
		{
			header("Location: ".DB_DOMAIN."install/index.php");
			exit;
		}
	}
ob_start();	
?>

<?php ///////////////////////////////////////////////////////////////////////////////////////////
// CHECK TO SEE IF THE WEBSITE IS OFFLINE FOR MAINTENANCE
///////////////////////////////////////////////////////////////////////////////////////////
/**
 * Page: Wensite Maintenace Mode
 * 		
 * @version  9.0
 * @created  Fri Jan 18 10:48:31 EEST 2008
 * @updated  Fri Jan 18 10:48:31 EEST 2008
 */
if(WEBSITE_DEMO =="yes" && ( !isset($_SESSION['admin_auth'])  || $_SESSION['admin_auth'] != "yes" ) ){
require_once('inc/templates/layout/offline.php');
die();
}

 /**
 * Page: Wensite Upgrade Only Mode
 * 		
 * @version  9.0
 * @created  Fri Jan 18 10:48:31 EEST 2008
 * @updated  Fri Jan 18 10:48:31 EEST 2008
 */




if(D_MUST_UPGRADE=="yes" && ( $_SESSION['auth'] =="yes" && $_SESSION['packageid'] == DEFAULT_PACKAGE ) && ( $page != "subscribe" && $page != "register" ) ){

 

	$page="subscribe";

	$sub="";

	$PageTitle = $LANG_UPGRADE_MENU[""];

	$SubscribeOnly =true;

}







if ($_SESSION['uid'] != -1 && $page != "groups") {

	$data = $DB->Row("SELECT id, username FROM members WHERE username='".$_SESSION['username']."' AND id='".$_SESSION['uid']."' LIMIT 1");

	if(empty($data)){	

		session_defaults();
		header("location: ".getThePermalink(''));

	}

}


if ($_SESSION['auth'] =="yes" && $page != "groups") {

	if(isset($_SESSION['account_active'])) {
		unset($_SESSION['account_active']);
	}

	$data = $DB->Row("SELECT id, username, active FROM members WHERE username='".$_SESSION['username']."' AND id='".$_SESSION['uid']."' LIMIT 1");

	if($data['active'] == 'suspended' || $data['active'] == 'cancel'){	
		header("location: ".getThePermalink('logout')); exit();
	}
	else if($data['active'] == 'unapproved'){

		$_SESSION['account_active'] = 'unapproved';

	}

}


///////////////////////////////////////////////////////////////////////////////////////////
// GAMES SCORING SYSTEM TO SAVE SCORES
///////////////////////////////////////////////////////////////////////////////////////////

 /**
 * Page: Saves the scores for members playing games
 * 		
 * @version  9.0
 * @created  Fri Jan 18 10:48:31 EEST 2008
 * @updated  Fri Jan 18 10:48:31 EEST 2008
 */

if ( ( isset($_GET['act']) && $_GET['act'] == 'Arcade' && $_GET['do'] == 'newscore' ) || ( isset($_GET['pUsername']) && $_GET['pUsername'] =="Arcade.php" ) ) {

	$score_game = (!empty($_POST['game_name'])) ? trim($_POST['game_name']) : trim($_POST['gname']);	
	$score_score = (!empty($_POST['gscore'])) ? $_POST['gscore'] : $_POST['gscore'];
	$score_score = (!empty($_POST['score'])) ? $_POST['score'] : $_POST['gscore'];

	SaveScores($score_score, $score_game);
	$page="games"; $sub_page="top";


}

/**
* Page: Redirect Members to Profile Edit pages if logged in and profile not complete
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/

if( ( $_SESSION['auth'] =="yes" ) && ( $page =="search" ||  $page =="profile" || $page =="messages" || $page =="index" || $page =="login" || $page =="register")  ){


	$Myprofile_count = $DB->Row("SELECT profile_complete FROM members WHERE id='".$_SESSION['uid']."' LIMIT 1");
	
	if(($Myprofile_count['profile_complete']=='0') || ($Myprofile_count['profile_complete'] < '40')){
		header("Location: ".getThePermalink('account/edit'));
	}

	elseif( ( $_SESSION['auth'] =="yes" ) && ( $page =="login" ||  $page =="index" ||  $page =="register" )  ){

	$page = "overview";

	} 

}


///////////////////////////////////////////////////////////////////////////////////////////
// DO MEMBER AUTO LOGIN BOTS
///////////////////////////////////////////////////////////////////////////////////////////


 /**
 * Page: Member Bot Login Function
 * 		
 * @version  9.0
 * @created  Fri Jan 18 10:48:31 EEST 2008
 * @updated  Fri Jan 18 10:48:31 EEST 2008
 */

if(defined('AUTO_LOGIN') && AUTO_LOGIN =="yes"){
	Build_AutoUsersOnline(AUTO_AMOUNT);
}

///////////////////////////////////////////////////////////////////////////////////////////
// COUNTRY BLOCKING CODE
///////////////////////////////////////////////////////////////////////////////////////////

$address = $_SERVER['REMOTE_ADDR'];

list( $o1, $o2, $o3, $o4 ) = explode(".",$address);
 
$integer_ip = (16777216 * $o1) + (65536 * $o2) + (256 * $o3) + $o4;

$blocked = $DB->Row("SELECT country_name FROM geo_ip_contries WHERE start_ip_num <='".$integer_ip."' AND end_ip_num >='".$integer_ip."' AND is_blocked = 'Y' LIMIT 1");

if($blocked['country_name'] != ''){
?>	
	<h1>Access Denied</h1>
	<h2>this site has been blocked for <?= $blocked['country_name'] ?>.</h2>
	<p>You IP (<?=$_SERVER['REMOTE_ADDR'] ?>) has been blocked from using this website.</p>
<?php
die;
}
///////////////////////////////////////////////////////////////////////////////////////////
// PHP VERSION CHECK
///////////////////////////////////////////////////////////////////////////////////////////


 if (version_compare(PHP_VERSION, '7.0.0', '<')) {
echo '<p><b>This software require following minimum configration</b><p>','<P>PHP version 7</P>','<P>MYSQL version 5.6</P>';
die;

}



///////////////////////////////////////////////////////////////////////////////////////////
// WEBSITE VISITOR STORING
///////////////////////////////////////////////////////////////////////////////////////////

/**
* Page: Website Visitor Tracking
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/

$_SESSION['visitor_browser'] = getBrowserType();
$_SESSION['visitor_url'] = selfURL();
/*if(!isset($_SESSION['my_visitor_added'])){

	$VISITO_DO = $DB->Row("SELECT visitor_ip FROM visitors_table WHERE visitor_ip='".$ip."' AND visitor_date LIKE '%".DATE_NOW."%' LIMIT 1");

	if($DB->Affected() ==0){

		if (!isset($_COOKIE['my_visitor_added']) || (isset($_COOKIE['my_visitor_added']) && $_COOKIE['my_visitor_added'] != date("Y-m-d"))) {
			
			$DB->Insert("INSERT INTO `visitors_table` (`visitor_ip` ,`visitor_browser` ,`visitor_hour` ,`visitor_minute` ,`visitor_date` ,`visitor_day` ,`visitor_month` ,`visitor_year` ,`visitor_refferer` ,`visitor_page`) 

			VALUES ('".$ip."' , '".getBrowserType()."' , '".date("h")."', '".date("i")."',CURRENT_TIMESTAMP , '".date("d")."', '".date("m")."', '".date("y")."', '".strip_tags(str_replace("'","",isset($_SERVER['HTTP_REFERER'])))."' , '".selfURL()."')");
			setcookie("my_visitor_added", date("Y-m-d"), time()+36000);
		}

		$_SESSION['my_visitor_added']=true;

	}

}*/



//////////////////////////////////////////////////////////////////////////////////////////
// CHECK IF THIS MEMBER IS BANNED FOR HACKING!!
//////////////////////////////////////////////////////////////////////////////////////////

/**
* Page: Calls a function in the globals.php file to check if the member is hacking
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/



Build_BankChecker();



//////////////////////////////////////////////////////////////////////////////////////////	

/**
* Page: function to add the member to the online now database with 1200 second timeout
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/

Build_UserOnline(time(), $ip, $page, $_SESSION['uid'], 1200, $_SERVER['REQUEST_URI']);

/**
* Page: Build Banner Array
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/

$BANNER_ARRAY = DisplayBannerCode($page,$MOBILE);

///////////////////////////////////////////////////////////////////////////////////////////
// LOAD TEMPLATE HEADER VALUES
///////////////////////////////////////////////////////////////////////////////////////////

/**
* Page: Build Templat Header Tags / Function found in globals.php file.
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/

if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']]) ){

	$MyIMData = Build_IMMessage($IMRoomArray);

}

if(isset($MyIMData) && $MyIMData !=""){$WaitingIM = true;}else{ $WaitingIM = false; }

$HEADER_META_BASE .= Build_HeaderScripts($page,$sub_page,$CUSTOM_PLUGIN_HEADER,$MOBILE);

$HEADER_ON_LOAD 	= Build_HeaderOnLoad($page,$sub_page,$PACKAGEACCESS,$WaitingIM,$MOBILE);

$CheckPluginsAndCustom=0;

///////////////////////////////////////////////////////////////////////////////////////////
// LOAD TEMPLATE MENU VALUES
///////////////////////////////////////////////////////////////////////////////////////////

if(my_logged_in){		

	$GLOBALS['MyProfile'] = MemberAccountDetails($_SESSION['uid']);

	$PageDesc = "";
	$MyAlertsArray = Build_HeaderAlertsBar();
	$MyAlertsBar = $MyAlertsArray[5]['total'];
	$MyModeratorBar = $MyAlertsArray[5]['admin'];

}else{

	$PageDesc = "";

}

if(in_array($page,$Access_Private)){
	$menu_name='account';
}else{
	$menu_name = $page;
}

$menu_nav_name = $sub_page;

/**
* Page: Load dynamic Menu Box
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/

$MenuBoxData = MenuDisplayBox($page,$sub_page);  // Top Viewed Profile Sidebar

/**
* Page: Check Page Access Level
* 		
* @version  9.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Fri Jan 18 10:48:31 EEST 2008
*/ 

if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && D_FREE =="no"){

	$PackageString="";
 	$PackageString = $page."-".$sub_page; 

	if(in_array($PackageString,$PACKAGEACCESS[$_SESSION['packageid']])){ 
		header("location: ".getThePermalink("subscribe"));
	}

}



///////////////////////////////////////////////////////////////////////////////////////////

// LOAD TEMPLATE CONTENT AREA

///////////////////////////////////////////////////////////////////////////////////////////

switch($page){

	/**
	* Page: Home / Index Page
	*
	* @version  9.0
	* @created  Fri Oct 17 2008
	* @updated  Fri Oct 17 2008
	*/

	case "index_responsive": {

	 	if($_SESSION['auth'] !="yes"){

		## sets template flag that its the home page
		$Index_Page_flag=1;

		## config functions for home page
		if(file_exists('inc/templates/'.D_TEMP.'/config.php')){ 
		
			require_once('inc/templates/'.D_TEMP.'/config.php');

			if($template_config['thomeLayout']=="blank"){ echo "in if";$PAGE_BLANK_FLAG=1;}

			elseif($template_config['thomeLayout']=="menu"){ }else{ 

			## tells the template to only show one colum (no menu bar)

			$HEADER_SINGLE_COLUMN = 'yes';

			}		

		}else{
			
			$HEADER_SINGLE_COLUMN = 'yes';

		}

		## includes index page functions

		require_once('inc/func/func_index_page.php');

		}

	  }break;



	case "index": {

		if($_SESSION['auth'] !="yes"){

		## sets template flag that its the home page
		$Index_Page_flag=1;

		## config functions for home page

		if(file_exists('inc/templates/'.D_TEMP.'/config.php')){   

			require_once('inc/templates/'.D_TEMP.'/config.php');
			
			if (isset($template_config['thomeLayout'])!=''){$temp_test12=$template_config['thomeLayout'];}else{$temp_test12=isset($template_config['thomeLayout']);}
			
			if($temp_test12=="blank"){ $PAGE_BLANK_FLAG=1;}

			elseif($temp_test12=="menu"){ }
			
			else{

			## tells the template to only show one colum (no menu bar)

			$HEADER_SINGLE_COLUMN = 'yes';

			}		

		}else{
			
			$HEADER_SINGLE_COLUMN = 'yes';

		}
		


		## includes index page functions

		require_once('inc/func/func_index_page.php');



		}

		if(D_TEMP == "v18_zug") {
			## DISPLAY GLOBALS

		$GLOBALS['MENU_REGISTER'] = 'yes';

		$PageDesc =""; // no description



		## CREATE PAGE DATA	

		require_once "inc/classes/class_regimg.php";		

		require_once('inc/func/func_register_page.php');

		$obj = new SPAF_FormValidator();

		

		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			

			## PHP BB3 INTEGRATION CODE

			if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="add"){

				define('IN_PHPBB', true);

				$phpbb_root_path = './phpBB3/';

				$phpEx = substr(strrchr(__FILE__, '.'), 1);

				include($phpbb_root_path . 'common.' . $phpEx);

				include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

				$user->session_begin();

				$auth->acl($user->data);

				$user->setup();

			}

			## END FORUM INTEGRATION

			require_once('inc/func/func_front_register.php');

			$Error_Report =  ChangeDo1($_POST['do'], $_POST, $_FILES,$obj, $MOBILE);


			## returns a list of contacts

			$show_page = $sub_page;


			if(is_array($Error_Report)){

				$sub_page="contacts";

				$contacts_array = $Error_Report;

				$Error_Report="";



			}elseif($Error_Report =="activateAccount"){

 
				$show_page = $sub_page;
				
				$sub_page="activation";

				$contacts_array = $Error_Report;

				$Error_Report=$GLOBALS['_LANG_ERROR']['_welcomeMsgzugnug']."**1";
				//echo 'thanku';

				$ScriptAccess=1;

 

			}elseif($Error_Report =="gogogo"){
				
				header("Location: ".getThePermalink('account/edit'));
			
				/*$PageTitle = $GLOBALS['_LANG']['_accountOverview'];	
				## Define Page title and menu				
				require_once('inc/func/func_overview_page.php');

				$page = "overview";

				$show_page = 'home';

				$MemberMatches = MatchResults(MATCH_PAGE_ROWS,$MOBILE);

				$GLOBALS['MyProfile'] = MemberAccountDetails($_SESSION['uid']);

				$PageDesc = "";

	

				

				$MyAlertsArray = Build_HeaderAlertsBar();

				$MyAlertsBar = $MyAlertsArray[5]['total'];

				$MyModeratorBar = $MyAlertsArray[5]['admin'];

						

				$MenuBoxData = MenuDisplayBox("overview","");



			//	$_GET['l'] = D_LANG;





				if (isset($_SESSION['lang'])){

					unset($_SESSION['lang']);

				}

				$_SESSION['lang'] = D_LANG;	





				$Error_Report = $GLOBALS['_LANG_ERROR']['_welcomeMsg']."**1";
*/
				



			}



		}

		$Reg_Type = array('contacts','activation');
		

		if(isset($sub_page) && in_array($sub_page,$Reg_Type) ){
			$show_page = $sub_page;
			if(isset($contacts_array) && is_array($contacts_array)){

			$show_page = $sub_page;
			
			## PAGE LANGUAGE			

			$PageTitle = $GLOBALS['LANG_NETWORK']['a26'];

			}elseif(isset($ScriptAccess) && $ScriptAccess==1){

				$PageTitle = $_LANG_LOGIN['a13'];

				$show_page = $sub_page;


			}

		}else{



			if(isset($_POST['username'])){

				$DefaultBoxStyle ="visible";

				$DefaultButStyle ="none";

			}else{

				$DefaultBoxStyle ="none";

				$DefaultButStyle ="visible";

			}

			

			$REGISTER_ARRAY = DisplaySignupFields(0);	

			$PageTitle = $LANG_BODY['_register'];

			$show_page ="home";

		}
	}

	} break;


	/**
	* Page: WEBSITE TOUR PAGE
	*
	* @version  9.0
	* @created  Sat 25 Oct  2008
	* @related  
	*/



	case "tour":{

		$GLOBALS['LANG_TOUR'] = $LANG_TOUR;

	} break;

	/**
	* Page: INVITE A FRIEND
	*
	* @version  9.0
	* @created  Sat 25 Oct  2008
	* @related  inc/func/func_invite.php
	*/

	case "invite":{		

		$PageTitle=$lang_main_footer['invite'];	

		## Define Page title
		$SubSub_Lang = $LANG_INVITE_MENU;

		## CREATE PAGE DATA	
		require_once "inc/classes/class_regimg.php";	

		$obj = new SPAF_FormValidator();		

		## PERFORM OPERATION
		if(isset($_POST['do'])){ 
			require_once('inc/func/func_network.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST, $obj);

		}

		## Define Page Array
		$Access_Page_Network= array('add','contacts');

		## Determin Display Page
		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Network)){			

			$show_page=$sub_page;

			if($sub_page =="contacts"){

				/**
				* Info: Used to check the contacts
				* 		
				* @version  9.0
				* @updated  Fri Sep 25 10:48:31 EEST 2008
				*/					

				$contacts_array=$Error_Report;

				$Error_Report = $GLOBALS['LANG_NETWORK']['a28']." ".count($contacts_array)." ".$GLOBALS['LANG_NETWORK']['a29'];
			}

		}

	} break;

	/**
	* Page: Website Privacy Page
	*
	* @version  9.0
	* @created  Fri Oct 17 2008
	* @updated  Fri Oct 17 2008
	*/

	case "privacy":{
		$PageTitle = $lang_main_footer["privacy"];
	} break;

	/**
	* Page: FACE BOOK REGISTER
	*
	* @version  9.0
	* @created  01 AUG 2012
	* @related  
	*/

	case "fbregister":{

		$my_url = getThePermalink('fblogin');
		//$my_url =  DB_DOMAIN."index.php?dll=fblogin";
		$code = isset($_REQUEST["code"]) ? $_REQUEST["code"] : '';

		if(empty($code)) {

    		$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
    		$dialog_url = "http://www.facebook.com/dialog/oauth?client_id=". FACEBOOK_APP_ID . "&redirect_uri=" . urlencode($my_url) . "&scope=publish_actions,email";

    		echo("<script> top.location.href='" . $dialog_url . "'</script>");
	 		exit;
   		}

     	$token_url = "https://graph.facebook.com/oauth/access_token?client_id=".FACEBOOK_APP_ID."&redirect_uri=". urlencode($my_url)."&client_secret=".FACEBOOK_SECRET."&code=".$code;


     	$response = @file_get_contents($token_url);
		$params = null;
		//parse_str($response, $params);

     	$params = (array) json_decode($response);

     	$graph_url = "https://graph.facebook.com/me?fields=id,name,email&access_token=".$params['access_token'];

		$user = json_decode(@file_get_contents($graph_url));

	 	$fbid = $DB->Row("SELECT * FROM members WHERE facebook_id='".$user->id."' and facebook_id != '0' and facebook_id != '' LIMIT 1");

		if(empty($fbid)){

			if($user->id){	

	     		$id = ($user->id); 
				$name =($user->name);
				$fbemail =($user->email);
				$fbsession = session_id();
				$fbstatus = "active";
				$fbpasscode = $id;
				require_once('inc/func/func_facebook_username.php');

				$fbusername = getFbUsername($name);
				session_destroy();
				session_start();
				$fbname = explode("@",$fbemail);
				$fbname['0'] = $fbusername;

				

				$DB->Insert("INSERT INTO `members` ( `id` , `username` , `password` , `email` , `session` , `ip` , `lastlogin` , `reg_type`, `visible` , active, `created`, packageid, hits, profile_complete, templateid, updated, moderator, activate_code, highlight, ip_long, ip_lat, ip_country, ip_code,member_rating,  msgStatus,  video_duration,  video_live, facebook_id )VALUES (NULL , '".$fbname[0]."', '".md5($fbpasscode)."', '".$fbemail."', '".$fbsession."', '".$ip."', '".DATE_TIME."','FB','yes', '".$fbstatus."', '".DATE_TIME."', '3','0','0','1','".DATE_TIME."', 'no', 'OK','off','".$reg_long."','".$reg_lat."','".$reg_country."','".$reg_code."', '0','".eMeetingInput($MSGSTATUS)."','0','no','".$id."')");


				$userid = $DB->InsertID();
				$_SESSION['username'] = $fbname[0];
				$_SESSION['uid'] = $userid;

				$DB->Insert("INSERT INTO `members_data` ( `uid` ) values ( '$userid' )");

				$DB->Update("UPDATE `members_data` SET age='1974-JAN-15', country='".eMeetingInput($default_CC)."', headline='' WHERE uid='".$userid."' LIMIT 1");

				$DB->Insert("INSERT INTO `members_privacy` (`uid` ,`Newsletters` ,`Notifications` ,`IM` ,`Language` ,`Time Zone` ,`friends` ,`comments` ,`profile_view` ,`im_window` ,`SMS_email` ,`SMS_wink` , SMS_number ,`SMS_credits` ,`SMS_country` ,`match_array` ,`email_winks` ,`email_msg` ,`email_friends` ,`email_match`, `profileview_friends`, `profileview_nonfriend`)VALUES ('".$userid."', '".$nw."', '".$nn."', 'yes', 'english', '', 'no', 'no', 'all', 'off', '".$SMS_MSG."', '".$SMS_EMAIL."', '".$SMS_NUM."', '".$packageData['SMS_credits']."', '".$mycountry."', '', 'yes', 'yes', 'yes', 'yes','','')");

				$DB->Insert("INSERT INTO `album` ( `aid` , `uid` , `title` , `comment` , `filecount` , `cat` , `allow_f` , `allow_h` , `allow_n` , `allow_a`,password, 	time, 	date )VALUES (NULL , '".$userid."', '".$name." Album', '', '0', 'public', '0', '0', '0', '0','',now(),now())");


				$_POST['do']="login";
				$_POST['visible']="0";
				$_POST['do_page']="login";
				$_POST['username']=$fbname[0];
				$_POST['password']=$fbpasscode;
				$_POST['submit']="Login";
				$_POST['remember']="1";
				$_POST['skip_pass']=true;

			 	$SubSub_Lang = $_LANG_LOGIN;
				$GLOBALS['LANG_LOGIN'] = $_LANG_LOGIN;

				$PageTitle = "Facebook Login";

				$PageDesc = $SubSub_Lang[$page."_?"];	


				## CREATE PAGE DATA	
				require_once "inc/classes/class_regimg.php";	

				$obj = new SPAF_FormValidator();


				## PERFORM OPERATION
				if(isset($_POST['do'])){ 

					## PHP BB3 INTEGRATION CODE
					if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="login"){

						define('IN_PHPBB', true);
						$phpbb_root_path = './phpBB3/';
						$phpEx = substr(strrchr(__FILE__, '.'), 1);
						include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
						include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

						include($phpbb_root_path . 'common.' . $phpEx);
						$user->session_begin();	$auth->acl($user->data);$user->setup();		
						if($user->data['is_registered']){	$user->session_kill();	$user->session_begin();	}

					}

					## vbull intrgation code

					if(FORUM_VB_ENABLED =="yes" && $_POST['do'] =="login"){

						define('THIS_SCRIPT', 'login');

						define('CWD',FORUM_VB_ROOTPATH);

						require_once('./vbull/global.php');

						require_once('./vbull/includes/functions_login.php');

						$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user

						WHERE username = ('".strip_tags(trim(strtolower($_POST['username'])))."') LIMIT 1");

					}

				

					## includes login functions

					require_once('inc/func/func_login.php');

					$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj, $MOBILE);



					

					## stops account login is profile is not approved

					if($Error_Report =="waiting"){

							header("location: ". getThePermalink('login',array('msg' => $lang_login_page[3])));

					}elseif($Error_Report =="login"){

							header("location: ".getThePermalink('account'));

					}		

				}

			}
			//	header('Location: '.$new_url);

		}else{

			$data = $DB->Row("SELECT * FROM `members` WHERE `facebook_id`='".$user->id."' LIMIT 1");

			$_POST['do']="login";
			$_POST['visible']="0";
			$_POST['do_page']="login";
			$_POST['username']=$data["username"];
			$_POST['password']=$data["password"];
			$_POST['submit']="Login";
			$_POST['remember']="1";
			$_POST['skip_pass']=true;


		 	$SubSub_Lang = $_LANG_LOGIN;

			$GLOBALS['LANG_LOGIN'] = $_LANG_LOGIN;



			//$PageTitle = $SubSub_Lang[$page];

			$PageTitle = "Facebook Login";

			$PageDesc = $SubSub_Lang[$page."_?"];	

			

			## CREATE PAGE DATA	

			require_once "inc/classes/class_regimg.php";	

			$obj = new SPAF_FormValidator();







			## PERFORM OPERATION

			if(isset($_POST['do'])){ 

				## PHP BB3 INTEGRATION CODE

				if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="login"){

					define('IN_PHPBB', true);

					$phpbb_root_path = './phpBB3/';

					$phpEx = substr(strrchr(__FILE__, '.'), 1);

					include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

					include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

					include($phpbb_root_path . 'common.' . $phpEx);

					$user->session_begin();	$auth->acl($user->data);$user->setup();		

					if($user->data['is_registered']){	$user->session_kill();	$user->session_begin();	}

				}


				## vbull intrgation code

				if(FORUM_VB_ENABLED =="yes" && $_POST['do'] =="login"){

					define('THIS_SCRIPT', 'login');

					define('CWD',FORUM_VB_ROOTPATH);

					require_once('./vbull/global.php');

					require_once('./vbull/includes/functions_login.php');

					$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user WHERE username = ('".strip_tags(trim(strtolower($_POST['username'])))."') LIMIT 1");

				}
		

				## includes login functions
				require_once('inc/func/func_login.php');
				$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj, $MOBILE);

				## stops account login is profile is not approved
				if($Error_Report =="waiting"){
					header("location: ".getThePermalink('login',array('msg' => $lang_login_page[3])));
				}elseif($Error_Report =="login"){
					header("location: ".getThePermalink('account'));
				}		
			}
		}
	} break;

	/**
	* Page: TWITTER LOGIN 
	*
	* @version  9.0
	* @created  04 SEPT 2017
	*/

	case "twlogin":{

		require_once('twitter/twConfig.php');

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
				
				
				
				//Storing user data into session
				$_SESSION['userData'] = $userData;
				
				//Remove oauth token and secret from session
				unset($_SESSION['token']);
				unset($_SESSION['token_secret']);
			
				//Redirect the user back to the same page
			}else{
				$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
			}
		}
	die;
	} break;

	/**
	* Page: FACEBOOK LOGIN 
	*
	* @version  9.0
	* @created  01 AUG 2012
	*/

	case "fblogin":{

		$my_url =  DB_DOMAIN."index.php?dll=fblogin";
		//$my_url =  getThePermalink('fblogin');

		$code = isset($_REQUEST["code"]) ? $_REQUEST["code"] : '';
		

		if(empty($code)) {


     		$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection

     		$dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" . FACEBOOK_APP_ID . "&redirect_uri=" . urlencode($my_url) . "&scope=email";

     		echo("<script> top.location.href='" . $dialog_url . "'</script>");
			exit;
	   	}

	   
    	$token_url = "https://graph.facebook.com/oauth/access_token?client_id=" . FACEBOOK_APP_ID . "&redirect_uri=".urlencode($my_url)."&client_secret=".FACEBOOK_SECRET."&code=".$code;

		$response = @file_get_contents($token_url);

    	$params = null;

	    //parse_str($response, $params);

	    $params = (array) json_decode($response);
	
	    $graph_url = "https://graph.facebook.com/me?fields=id,name,email&access_token=".$params['access_token'];


		$user = json_decode(@file_get_contents($graph_url));


		$fbid = $DB->Row("SELECT * FROM members WHERE facebook_id='".$user->id."' and facebook_id != '0' and facebook_id != '' LIMIT 1");

		if(empty($fbid)){

			if($user->id){	

			    $id = ($user->id); 
				$name =($user->name);
				$fbemail =($user->email);
				$fbsession = session_id();
				$fbstatus = "active";
				$fbpasscode = $id;

				require_once('inc/func/func_facebook_username.php');
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
				$reg_long = isset($reg_long) ? $reg_long : '';
				$reg_long = isset($reg_long) ? $reg_long : '';
				$reg_code = isset($reg_code) ? $reg_code : '';

				$DB->Insert("INSERT INTO `members` ( `id` , `username` , `password` , `email` , `session` , `ip` , `lastlogin` , `reg_type`,`visible` , active, `created`, packageid, hits, profile_complete, templateid, updated, moderator, activate_code, highlight, ip_long, ip_lat, ip_country, ip_code,member_rating,  msgStatus,  video_duration,  video_live, facebook_id )VALUES (NULL , '".$fbname['0']."', '".md5($fbpasscode)."', '".$fbemail."', '".$fbsession."', '".$ip."', '".DATE_TIME."', 'FB','yes', '".$fbstatus."', '".DATE_TIME."', '3','0','0','1','".DATE_TIME."', 'no', 'OK','off','".$reg_long."','".$reg_lat."','".$reg_country."','".$reg_code."', '0','".eMeetingInput($MSGSTATUS)."','0','no','".$id."')");

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

				$fbpicture = "http://graph.facebook.com/".$user->id."/picture?type=large";

				$rez = get_all_redirects($fbpicture);

				$source = $rez[0];

				$sizes = @getimagesize($source);

				$mime = $sizes['mime'];

				$stamp_num="56982145798000";

				$stamp = $stamp_num-time();

				if($mime=="image/jpeg"){ $extension="jpg";
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

				$PageTitle = "Facebook Login";
				$PageDesc = (isset($SubSub_Lang[$page."_?"])) ? $SubSub_Lang[$page."_?"] : '';	

				## CREATE PAGE DATA	
				require_once "inc/classes/class_regimg.php";	
				$obj = new SPAF_FormValidator();
		
				## PERFORM OPERATION
				if(isset($_POST['do'])){ 

					## PHP BB3 INTEGRATION CODE
					if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="login"){

						define('IN_PHPBB', true);
						$phpbb_root_path = './phpBB3/';
						$phpEx = substr(strrchr(__FILE__, '.'), 1);
						include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
						include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
						include($phpbb_root_path . 'common.' . $phpEx);
						$user->session_begin();	$auth->acl($user->data);$user->setup();		
						if($user->data['is_registered']){	$user->session_kill();	$user->session_begin();	}
					}

					## vbull intrgation code

					if(FORUM_VB_ENABLED =="yes" && $_POST['do'] =="login"){

						define('THIS_SCRIPT', 'login');

						define('CWD',FORUM_VB_ROOTPATH);

						require_once('./vbull/global.php');

						require_once('./vbull/includes/functions_login.php');

						$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user WHERE username = ('".strip_tags(trim(strtolower($_POST['username'])))."') LIMIT 1");

					}

			

					## includes login functions

					require_once('inc/func/func_login.php');

					$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj, $MOBILE);

					## stops account login is profile is not approved

					if($Error_Report =="waiting"){

						header("location: ".getThePermalink('login',array('msg' => $lang_login_page[3])));

					}elseif($Error_Report =="login"){

						header("location: ".getThePermalink('account'));

					}

					elseif($Error_Report =="gogogo"){

						header("location: ".getThePermalink('overview'));

					}

				}

			}

			//	header('Location: '.$new_url);

		}else{

			$data = $DB->Row("SELECT * FROM `members` WHERE `facebook_id`='".$user->id."' LIMIT 1");

			$_POST['do']="login";

			$_POST['visible']="0";

			$_POST['do_page']="login";

			$_POST['username']=$data["username"];

			$_POST['password']=$data["password"];

			$_POST['submit']="Login";

			$_POST['remember']="1";

			$_POST['skip_pass']=true;

		 	$SubSub_Lang = $_LANG_LOGIN;

			$GLOBALS['LANG_LOGIN'] = $_LANG_LOGIN;

			//$PageTitle = $SubSub_Lang[$page];

			$PageTitle = "Facebook Login";

			$PageDesc = $SubSub_Lang[$page."_?"];	


			## CREATE PAGE DATA	

			require_once "inc/classes/class_regimg.php";	

			$obj = new SPAF_FormValidator();


			## PERFORM OPERATION

			if(isset($_POST['do'])){ 

				## PHP BB3 INTEGRATION CODE

				if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="login"){

					define('IN_PHPBB', true);

					$phpbb_root_path = './phpBB3/';

					$phpEx = substr(strrchr(__FILE__, '.'), 1);

					include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

					include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

					//if(file_exists($phpbb_root_path . 'common.' . $phpEx)){
							include($phpbb_root_path . 'common.' . $phpEx);
							$user->session_begin();	$auth->acl($user->data);$user->setup();		
							if($user->data['is_registered']){	$user->session_kill();	$user->session_begin();	}
					//}			

				}

				## vbull intrgation code

				if(FORUM_VB_ENABLED =="yes" && $_POST['do'] =="login"){

					define('THIS_SCRIPT', 'login');

					define('CWD',FORUM_VB_ROOTPATH);

					require_once('./vbull/global.php');

					require_once('./vbull/includes/functions_login.php');

					$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user WHERE username = ('".strip_tags(trim(strtolower($_POST['username'])))."') LIMIT 1");

				}

				## includes login functions

				require_once('inc/func/func_login.php');

				$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj, $MOBILE);


				## stops account login is profile is not approved

				if($Error_Report =="waiting"){

					header("location: ".getThePermalink('login',array('msg' => $lang_login_page[3])));
					
				}
				else if($Error_Report =="login"){

						header("location: ".getThePermalink('account'));

				}
				else if($Error_Report =="gogogo"){

						header("location: ".getThePermalink('overview'));

				}

			}



		}



	} break;



	case "facebook-register":{



	if (isset($_GET["request"]) && $_GET["request"]!="new") {



		$data = $DB->Row("SELECT * FROM members WHERE id='".$_GET["request"]."' LIMIT 1");



	}





	if($_GET["request"]=="new"){



	function wget($url){

  		if(function_exists("curl_init")){

	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, $url);

	    curl_setopt($ch, CURLOPT_HEADER, 0);

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    $content = curl_exec($ch);

	    curl_close($ch);

	  }else{

	    $content = file_get_contents($url);

	  }

  

	  return $content;

	}



	//$graph_url = "https://graph.facebook.com/me?".$_GET["access_token"];

	//$user = json_decode(wget($graph_url));





	$_POST['do']="add";

	$_POST['do_page']="register";

	$_POST['title']="";

	$_POST['comments']="";



	$_POST['username']=$user->name;

	$_POST['email']=$user->email;

	$_POST['password']="123456";

	$_POST['password_confirm']="123456";

	$fb_id=$id;





	$_POST['FieldName28']="gender";

	$_POST['FieldType28']="3";

	if($user->gender=="male"){

		$_POST['FieldValue28']="63";

	}elseif($user->gender=="female"){

		$_POST['FieldValue28']="64";

	}







	if($user->birthday){

	$arrBirthday=explode("/", $user->birthday);

	$_POST['FieldValue23a']=$arrBirthday[2];





	$month = $arrBirthday[0];



	switch($month){

		case "01": { $ThisMonth ="JAN"; } break;

		case "02": { $ThisMonth ="FEB"; } break;

		case "03": { $ThisMonth ="MAR"; } break;

		case "04": { $ThisMonth ="APR"; } break;

		case "05": { $ThisMonth ="MAY"; } break;

		case "06": { $ThisMonth ="JUN"; } break;

		case "07": { $ThisMonth ="JUL"; } break;

		case "08": { $ThisMonth ="AUG"; } break;

		case "09": { $ThisMonth ="SEP"; } break;

		case "10": { $ThisMonth ="OCT"; } break;

		case "11": { $ThisMonth ="NOV"; } break;

		case "12": { $ThisMonth ="DEC"; } break;

		case "1": { $ThisMonth ="JAN"; } break;

		case "2": { $ThisMonth ="FEB"; } break;

		case "3": { $ThisMonth ="MAR"; } break;

		case "4": { $ThisMonth ="APR"; } break;

		case "5": { $ThisMonth ="MAY"; } break;

		case "6": { $ThisMonth ="JUN"; } break;

		case "7": { $ThisMonth ="JUL"; } break;

		case "8": { $ThisMonth ="AUG"; } break;

		case "9": { $ThisMonth ="SEP"; } break;

	}





	$_POST['FieldValue23b']=$ThisMonth;

	$_POST['FieldValue23c']=$arrBirthday[1];

	}else{

	$_POST['FieldValue23a']="1990";

	$_POST['FieldValue23b']="APR";

	$_POST['FieldValue23c']="1";

	}



	$_POST['FieldName23']="age";

	$_POST['FieldType23']="7";



	//$_POST['FieldName25']="country";

	//$_POST['FieldType25']="3";

	//$_POST['FieldValue25']="569";



	

	$_POST['FieldName26']="location";

	$_POST['FieldType26']="3";

	$_POST['FieldValue26']=$user->location;



	// State / Province

	//$_POST['FieldName54']="em_85820081128";

	//$_POST['FieldType54']="3";

	//$_POST['FieldValue54']="5542";



	$_POST['FieldName24']="headline";

	$_POST['FieldType24']="1";

	$_POST['FieldValue24']="  ";



	$_POST['FieldName27']="description";

	$_POST['FieldType27']="2";

	$_POST['FieldValue27']="  ";



	$_POST['LinkedRows']="2";

	$_POST['uploadNeed']="1";

	$_POST['default']="1";

	$_POST['notify']="yes";

	$_POST['news']="yes";

	$_POST['t&C']="1";





//print "<br>first_name: $user->first_name";

//print "<br>last_name: $user->last_name";

//print "<br>username: $user->username";

//print "<br>email: $user->email";

//print "<br>gender: $user->gender";

//print "<br>birthday: $user->birthday";

//print "<br>location: $user->location";

//print "<br>user_id: $user->user_id";





if(FACEBOOK_PHOTO == "yes") {



	$fbpicture = "http://graph.facebook.com/".$user->id."/picture?type=large";



	$rez = get_all_redirects($fbpicture);

	$source = $rez[0];



	$imagesize=getimagesize($source);

	$mime = $imagesize['mime'];

	$stamp_num=$NOA."145798000";

	$stamp = $stamp_num-time();



	if($mime!="image/jpeg" && $mime!="image/png" && $mime!="image/bmp" && $mime!="image/gif"){



	$extension="jpg";

	$new_name_f = "".$pre_name."_".$stamp.".".$extension."";





	$img = imagecreatetruecolor(200,200);

	imagefill($img , 0 , 0 , 0xFFFFFF);



	$mime_arr=explode("/", $mime);

	$imagefrom_name="imagecreatefrom".$mime_arr[1];

	$imagefrom = imagecreatefromjpeg($source);



	imagecopyresampled($img,$imagefrom,$resize_x,$resize_y,0,0,200,200,200,200);





	imagejpeg($img,$_SERVER["DOCUMENT_ROOT"]."/uploads/cache/".$new_name_f);



	$mime="image/jpeg";





	}else{



	if($mime=="image/jpeg"){

	$extension="jpg";

	}elseif($mime=="image/png"){

	$extension="png";

	}elseif($mime=="image/bmp"){

	$extension="bmp";

	}elseif($mime=="image/gif"){

	$extension="gif";

	}

	$new_name_f = "".$pre_name."_".$stamp.".".$extension."";

	$temp_copy = copy($source, $_SERVER["DOCUMENT_ROOT"]."/uploads/cache/".$new_name_f);

	}





	$_FILES["uploadFile00"]["name"]=$new_name_f;



	$_FILES["uploadFile00"]["type"]=$mime;





	$_FILES["uploadFile00"]["size"]=filesize($_SERVER["DOCUMENT_ROOT"]."/uploads/cache/".$new_name_f);



	$_FILES["uploadFile00"]["tmp_name"]=$_SERVER["DOCUMENT_ROOT"]."/uploads/cache/".$new_name_f;



} else {



	$_FILES["uploadFile00"]["name"]="";

	$_FILES["uploadFile00"]["type"]="";

	$_FILES["uploadFile00"]["size"]="";

	$_FILES["uploadFile00"]["tmp_name"]="";



}



		## DISPLAY GLOBALS

		$GLOBALS['MENU_REGISTER'] = 'yes';

		$PageDesc =""; // no description



		## CREATE PAGE DATA	

		require_once "inc/classes/class_regimg.php";		

		require_once('inc/func/func_register_page.php');

		$obj = new SPAF_FormValidator();







		

		## PERFORM OPERATION

		if(isset($_POST['do'])){ 





			

			## PHP BB3 INTEGRATION CODE

			if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="add"){

				define('IN_PHPBB', true);

				$phpbb_root_path = './phpBB3/';

				$phpEx = substr(strrchr(__FILE__, '.'), 1);

				include($phpbb_root_path . 'common.' . $phpEx);

				include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);

				$user->session_begin();

				$auth->acl($user->data);

				$user->setup();
				
				
			}





			## END FORUM INTEGRATION

			

			require_once('inc/func/func_register_facebook.php');



			$check_cnt=0;

			while ($Error_Report != "gogogo") {

				if($check_cnt!=0){

				if($Error_Report==$GLOBALS['LANG_REGISTER'][1] || $Error_Report==$GLOBALS['LANG_REGISTER'][5] || $Error_Report==$GLOBALS['LANG_REGISTER'][6]){

					if($check_cnt==1){

					$_POST['username']=$user->username;

					}elseif($check_cnt==2){

					$point=strrpos($user->email, '@');

					$_POST['username']=substr($user->email, 0, $point);

					}else{

					$uniqid = "";

					$overlap = "";

					$setkey=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9','0');

					$prefix = rand(0, count($setkey)-1);

					//$uniqid = $setkey[$prefix];

					for($i=1;$i<4;$i++){

						$uniqid.= rand(0,9);

					}

					$_POST['username']=$user->username;

					$_POST['username'].=$uniqid;

					}

				}else{

				echo $Error_Report;

				exit;

				}

				}

			$Error_Report =  ChangeDo1($_POST['do'], $_POST, $_FILES,$obj, $MOBILE);			

			$check_cnt++;

			}



		if($Error_Report =="gogogo"){

			if($user->gender=="male"){

			$Gender=64;

			}elseif($user->gender=="female"){

			$Gender=63;

			}

		$message='Fields in your profile need to be entered. Please edit your profile when you have a chance.';

		$encode1=urlencode("[");

		$encode2=urlencode("]");

		header("Location: ".getThePermalink('account/edit'));

		exit();

		}





			## returns a list of contacts



			if(is_array($Error_Report)){

				$sub_page="contacts";

				$contacts_array = $Error_Report;

				$Error_Report="";



			}elseif($Error_Report =="activateAccount"){

 				$show_page = $sub_page;

				$sub_page="activation";

				$contacts_array = $Error_Report;

				$Error_Report="";

				$ScriptAccess=1;

			}elseif($Error_Report =="gogogo"){

				$PageTitle = $GLOBALS['_LANG']['_accountOverview'];	

				## Define Page title and menu				

				require_once('inc/func/func_overview_page.php');

				$page = "overview";

				$show_page = 'home';

				$MemberMatches = MatchResults(MATCH_PAGE_ROWS);

				$GLOBALS['MyProfile'] = MemberAccountDetails($_SESSION['uid']);

				$PageDesc = "";				

				$MyAlertsArray = Build_HeaderAlertsBar();

				$MyAlertsBar = $MyAlertsArray[5]['total'];

				$MyModeratorBar = $MyAlertsArray[5]['admin'];

				$MenuBoxData = MenuDisplayBox("overview","");

			//	$_GET['l'] = D_LANG;

				if (isset($_SESSION['lang'])){

					unset($_SESSION['lang']);

				}

				$_SESSION['lang'] = D_LANG;	





				$Error_Report = $GLOBALS['_LANG_ERROR']['_welcomeMsg']."**1";

				



			}



		}

		



		$Reg_Type = array('contacts','activation');
		

		if(isset($sub_page) && in_array($sub_page,$Reg_Type) ){



$show_page = $sub_page;

			if(isset($contacts_array) && is_array($contacts_array)){

			$show_page = $sub_page;

				

			## PAGE LANGUAGE			

			$PageTitle = $GLOBALS['LANG_NETWORK']['a26'];



			}elseif(isset($ScriptAccess) && $ScriptAccess==1){



				$PageTitle = $_LANG_LOGIN['a13'];

				$show_page = $sub_page;



	

			}



		}else{



			if(isset($_POST['username'])){

				$DefaultBoxStyle ="visible";

				$DefaultButStyle ="none";

			}else{

				$DefaultBoxStyle ="none";

				$DefaultButStyle ="visible";

			}

			

			$REGISTER_ARRAY = DisplaySignupFields(0);	

			$PageTitle = $LANG_BODY['_register'];

			$show_page ="home";

		}







	}elseif($data){



	$_POST['do']="login";

	$_POST['visible']="0";

	$_POST['do_page']="login";

	$_POST['username']=$data["username"];

	$_POST['password']=$data["password"];

	$_POST['submit']="Login";

	$_POST['remember']="1";

	$_POST['skip_pass']=true;





	 	$SubSub_Lang = $_LANG_LOGIN;

		$GLOBALS['LANG_LOGIN'] = $_LANG_LOGIN;



		$PageTitle = $SubSub_Lang[$page];

		$PageDesc = $SubSub_Lang[$page."_?"];	

		

		## CREATE PAGE DATA	

		require_once "inc/classes/class_regimg.php";	

		$obj = new SPAF_FormValidator();







		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			 

			

			## PHP BB3 INTEGRATION CODE

			if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="login"){

				define('IN_PHPBB', true);

				$phpbb_root_path = './phpBB3/';

				$phpEx = substr(strrchr(__FILE__, '.'), 1);

				include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);



				//if(file_exists($phpbb_root_path . 'common.' . $phpEx)){

						include($phpbb_root_path . 'common.' . $phpEx);

						$user->session_begin();	$auth->acl($user->data);$user->setup();		

						if($user->data['is_registered']){	$user->session_kill();	$user->session_begin();	}

				//}			

			}

			

			## vbull intrgation code

			if(FORUM_VB_ENABLED =="yes" && $_POST['do'] =="login"){

				define('THIS_SCRIPT', 'login');

				define('CWD',FORUM_VB_ROOTPATH);

				require_once('./vbull/global.php');

				require_once('./vbull/includes/functions_login.php');

				$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user

				WHERE username = ('".strip_tags(trim(strtolower($_POST['username'])))."') LIMIT 1");

			}

			

			## includes login functions

			require_once('inc/func/func_login.php');

			$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj, $MOBILE);



			

			## stops account login is profile is not approved

			if($Error_Report =="waiting"){
				header("location: ".getThePermalink('login',array('msg' => $lang_login_page[3])));

			}elseif($Error_Report =="login"){

					header("location: ".getThePermalink('account'));

			}		

		}







		

	}







	} break;

	/**
	* Page: MEMBER GOOGLE LOGIN PAGE
	*
	* @version  9.0
	* @created  Sat 25 Oct  2008
	* @related  /inc/func/func_login.php & func_login_page.php
	*/

	case "glogin":{
		echo "Google Login";
	} break;



	/**

	* Page: MEMBER LOGIN PAGE

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  /inc/func/func_login.php & func_login_page.php

	*/





	case "login":{	



	 	$SubSub_Lang = $_LANG_LOGIN;

		$GLOBALS['LANG_LOGIN'] = $_LANG_LOGIN;



		$PageTitle = $SubSub_Lang[$page];

		$PageDesc = $SubSub_Lang[$page."_?"];	

		

		## CREATE PAGE DATA	

		require_once "inc/classes/class_regimg.php";	
		require_once "inc/func/func_twitter_page.php";	

		$obj = new SPAF_FormValidator();



		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			 

			

			## PHP BB3 INTEGRATION CODE

			if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="login"){

				define('IN_PHPBB', true);

				$phpbb_root_path = './phpBB3/';

				$phpEx = substr(strrchr(__FILE__, '.'), 1);

				include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);



				//if(file_exists($phpbb_root_path . 'common.' . $phpEx)){

						include($phpbb_root_path . 'common.' . $phpEx);

						$user->session_begin();	$auth->acl($user->data);$user->setup();		

						if($user->data['is_registered']){	$user->session_kill();	$user->session_begin();	}

				//}			

			}

			

			## vbull intrgation code

			if(FORUM_VB_ENABLED =="yes" && $_POST['do'] =="login"){

				define('THIS_SCRIPT', 'login');

				define('CWD',FORUM_VB_ROOTPATH);

				require_once('./vbull/global.php');

				require_once('./vbull/includes/functions_login.php');

				$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user

				WHERE username = ('".strip_tags(trim(strtolower($_POST['username'])))."') LIMIT 1");

			}

			

			## includes login functions
			
			require_once('inc/func/func_login.php');
			
			$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj,$MOBILE);


			

			

			## stops account login is profile is not approved

			if($Error_Report =="waiting"){
				header("location: ".getThePermalink('login',array('msg' => $lang_login_page[3])));

			}elseif($Error_Report =="login"){

					header("location: ".getThePermalink('account'));

			}
			elseif($Error_Report =="gogogo"){

					header("location: ".getThePermalink(''));

			}


		}		

		

	} break;



	 /**

	 * Page: Registration

	 *

	 * @version  9.0

	 * @created  Fri Oct 17 2008

	 * @updated  Fri Oct 17 2008

	 */



	case "register":{
			
				

		## DISPLAY GLOBALS
		$GLOBALS['MENU_REGISTER'] = 'yes';
		$PageDesc =""; // no description

		## CREATE PAGE DATA	
		require_once "inc/classes/class_regimg.php";
		require_once('inc/func/func_register_page.php');
		//require_once('inc/func/func_network_page.php');
		
		$obj = new SPAF_FormValidator();
					
		## PERFORM OPERATION
		if(isset($_POST['do'])){ 



			## PHP BB3 INTEGRATION CODE
			if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do'] =="add"){

				define('IN_PHPBB', true);
				$phpbb_root_path = './phpBB3/';
				$phpEx = substr(strrchr(__FILE__, '.'), 1);
				include($phpbb_root_path . 'common.' . $phpEx);
				include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
				include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
				$user->session_begin();
				$auth->acl($user->data);
				$user->setup();

			}

			## END FORUM INTEGRATION
			require_once('inc/func/func_register.php');

			if(D_USER_REGISTRATION == 'sliding'){
				
				## Account Details
				$Error_Report =  ChangeDo2($_POST['do'], $_POST, $_FILES,$obj, $MOBILE);
				require_once('inc/func/func_account.php');
				require_once('inc/func/func_uploads.php');

				$Error_Report_Account =  ChangeDo('edit', $_POST, $_FILES);

				## returns a list of contacts
			}
			else{
				$Error_Report =  ChangeDo1($_POST['do'], $_POST, $_FILES,$obj, $MOBILE);			
			}

			$show_page = $sub_page;
			
			if(is_array($Error_Report)){

				$sub_page="contacts";
				$contacts_array = $Error_Report;
				$Error_Report="";

			}elseif($Error_Report =="activateAccount"){

				$show_page = $sub_page;
				$sub_page="activation";
				$contacts_array = $Error_Report;
				$Error_Report="";
				$ScriptAccess=1;

			}elseif($Error_Report =="gogogo"){


				$PageTitle = $GLOBALS['_LANG']['_accountOverview'];	
				## Define Page title and menu				
				require_once('inc/func/func_overview_page.php');

				$page = "overview";
				$show_page = 'home';

				$MemberMatches = MatchResults(MATCH_PAGE_ROWS,$MOBILE);

				$GLOBALS['MyProfile'] = MemberAccountDetails($_SESSION['uid']);

				$PageDesc = "";

				$MyAlertsArray = Build_HeaderAlertsBar();
				$MyAlertsBar = $MyAlertsArray[5]['total'];
				$MyModeratorBar = $MyAlertsArray[5]['admin'];
				$MenuBoxData = MenuDisplayBox("overview","");


				//	$_GET['l'] = D_LANG;
				if (isset($_SESSION['lang'])){
					unset($_SESSION['lang']);
				}

				$_SESSION['lang'] = D_LANG;	

				$Error_Report = $GLOBALS['_LANG_ERROR']['_welcomeMsg']."**1";

			}

		}

		$Reg_Type = array('contacts','activation');
		
		if(isset($sub_page) && in_array($sub_page,$Reg_Type) ){

			$show_page = $sub_page;
			if(isset($contacts_array) && is_array($contacts_array)){

			$show_page = $sub_page;
			
			## PAGE LANGUAGE			
			$PageTitle = $GLOBALS['LANG_NETWORK']['a26'];

			}elseif(isset($ScriptAccess) && $ScriptAccess==1){

				$PageTitle = $_LANG_LOGIN['a13'];
				$show_page = $sub_page;

			}

		}else{



			if(isset($_POST['username'])){

				$DefaultBoxStyle ="visible";
				$DefaultButStyle ="none";

			}else{

				$DefaultBoxStyle ="none";
				$DefaultButStyle ="visible";

			}

			

			$REGISTER_ARRAY = DisplaySignupFields(0);	
			$PageTitle = $LANG_BODY['_register'];
			$show_page ="home";

		}


		require_once('inc/func/func_account_page.php');

		//$show_page ='edit';



		$mygroup = 0;

		$profile_details = RegisterMemberSliding('0',$mygroup,$page);
                //$profile_details = EditMemberSliding('0',$mygroup,$page);

	} break;



	 /**

	 * Page: Search Page / Display Profiles

	 *

	 * @version  9.0

	 * @created  Fri Oct 17 2008

	 * @updated  Fri Oct 17 2008

	 */

	case "friends":{



		//$_GET['friendid']=0;

		header("location: ".getThePermalink('search/friends',array('friendid' => $_SESSION['uid'],'displaytype' => 'detail')));

		exit();



	} break;



	case "blocked":{



		header("location: ".DB_DOMAIN."index.php?dll=search&displaytype=detail&friend_type=3&friendid=".$_SESSION['uid']);

		exit();



	} break;



	case "favorites":{



		header("location: ".DB_DOMAIN."index.php?dll=search&displaytype=detail&friend_type=1&friendid=".$_SESSION['uid']);

		exit();



	} break;

	/**
	* Page: WEBSITE PROFILE VIEWED PAGE
	*
	* @version  13.0
	* @created  THURSDAY 26 Oct 2017
	* @related  inc/func/func_search_page.php
	*/

	case "viewed":{

		if(!isset($_SESSION['admin_auth']) && isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("chatroom-profile",$PACKAGEACCESS[$_SESSION['packageid']]) ){

			header("location: ".getThePermalink("subscribe")); exit();

		}

		$SubSub_Lang = $LANG_SEARCH;
		$GLOBALS['LANG_SEARCH'] = $LANG_SEARCH;

		$PageTitle = $LANG_HEADINGS[$page];
		$PageDesc = $LANG_HEADINGS[$page];
		//$PageDesc = $LANG_HEADINGS[$page."_?"];

		## force members to login after page 2 of search results
		if(isset($_POST['page']) > 2 && $_SESSION['auth'] !="yes"){
			header("location:".getThePermalink('login'));
		}

		if($_SESSION['auth'] =="yes" && is_numeric($_SESSION['uid'])){ $lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); }

		## DISPLAY GLOBALS				
		require_once('inc/func/func_search_page.php');

		$ThisPersonsNetworkBar="";

		$NETWORK_ID=2;

		## GET SEARCH DATA
		if(isset($_POST['page']) && is_numeric($_POST['page'])){ $_GET['view_page']=$_POST['page'];}

		if(isset($_GET['view_page']) && is_numeric($_GET['view_page'])){ $Pass_Page = $_GET['view_page']; }
		else{ $Pass_Page=0; }

		## GET DISPLAY TYPE				
		$SearchData = GetViewedProfiles($_POST,$Pass_Page, $_GET,'viewed'); $DataCounter= count($SearchData); 

		## NO SEARCH RESULTS
		if(!isset($SearchData[$DataCounter]['TotalResults'])){ $SearchData[$DataCounter]['TotalResults'] =0; }
		if($SearchData[$DataCounter]['TotalResults'] == SEARCH_PAGE_ROWS){ $GLOBALS['total_pages']=1; }
		else{$GLOBALS['total_pages'] = ceil($SearchData[$DataCounter]['TotalResults']/SEARCH_PAGE_ROWS); }
	
		## SEARCH RESULTS ARRAY
		$search_data = $SearchData;

		## SEARCH NEXT / LAST BUTTONS
		if($SearchData[$DataCounter]['TotalResults'] < SEARCH_PAGE_ROWS){		
			$Search_Page_Numbers = "";
		}else{

			if(count($SearchData) == SEARCH_PAGE_ROWS){ $SHOW_NEXT_BOX = true; }

			else{ $SHOW_NEXT_BOX = false; }

			if(MATCH_PD == 'pagination'){
				$Search_Page_Numbers = PageNumbers($SearchData[$DataCounter]['TotalResults'], $Pass_Page,$SHOW_NEXT_BOX);
			}
			else{
				$Search_Page_Numbers = "";
			}

		}

		## Define Page Array
		$Search_Type= array('gallery','detail','basic');

		if(isset($_GET['displaytype']) && in_array($_GET['displaytype'],$Search_Type)){
			$_POST['displaytype'] = $_GET['displaytype'];
		}

		## Determin Display Page

		if(isset($_POST['displaytype']) && in_array($_POST['displaytype'],$Search_Type)){
			$search_type = $_POST['displaytype'];
		}else{

			## shows the default search page display, set in the config file.
			$search_type = SEARCH_PAGE_DISPLAY;

		}

		$show_page ="home";


		if(!isset($NETWORKD_FRIEND_ID)){ $PageTitle= $GLOBALS['_LANG']['_search']." ".$GLOBALS['_LANG']['_results']; }
		elseif($NETWORK_ID ==1){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_hotList']; }
		elseif($NETWORK_ID ==2){ $PageTitle= $GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_friendsList']; }
		elseif($NETWORK_ID ==3){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_blockList']; }
		elseif($NETWORK_ID ==5){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_partners']; }	


		if($_SESSION['auth'] =="yes"){
			$SaveSearchData = SavedSearched($_SESSION['uid']);
		}


		## SAVE SEARCH PAGE

		if(isset($_POST['SavePage']) && $_POST['SavePage'] ==1){

			$SaveString ="";
			$DontSaveThis = array('SavePage');
			foreach($_POST as $val => $key){
				if(!in_array($val, $DontSaveThis)){
					if(is_array($key)){
						foreach($key as $val1 => $key1){
							$SaveString .= $val."[".$val1."]-".$key1."*";
						}
					}else{
						$SaveString .= $val."-".$key."*";
					}
				}
			}

			$DB->Insert("INSERT INTO `member_searches` (`search_id` ,`uid` ,`search_date` ,search_string, `search_name`)VALUES ( NULL , '".$_SESSION['uid']."', now(), '".eMeetingInput($SaveString)."', '".DATE_NOW."')");

			$ERROR_MESSAGE = $GLOBALS['_LANG_ERROR']['_complete']; $ERROR_TYPE="good";

		}
	
	} break;

	/**
	* Page: WEBSITE PROFILE VIEWED PAGE
	*
	* @version  13.0
	* @created  THURSDAY 26 Oct 2017
	* @related  inc/func/func_search_page.php
	*/

	case "birthday":{

		if(!isset($_SESSION['admin_auth']) && isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("chatroom-profile",$PACKAGEACCESS[$_SESSION['packageid']]) ){

			header("location: ".getThePermalink("subscribe")); exit();

		}

		$SubSub_Lang = $LANG_SEARCH;
		$GLOBALS['LANG_SEARCH'] = $LANG_SEARCH;

		$PageTitle = $LANG_HEADINGS[$page];
		$PageDesc = $LANG_HEADINGS[$page];
		//$PageDesc = $LANG_HEADINGS[$page."_?"];

		## force members to login after page 2 of search results
		if(isset($_POST['page']) > 2 && $_SESSION['auth'] !="yes"){
			header("location:".getThePermalink('login'));
		}

		if($_SESSION['auth'] =="yes" && is_numeric($_SESSION['uid'])){ $lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); }

		## DISPLAY GLOBALS				
		require_once('inc/func/func_search_page.php');

		$ThisPersonsNetworkBar="";

		$NETWORK_ID=2;

		## GET SEARCH DATA
		if(isset($_POST['page']) && is_numeric($_POST['page'])){ $_GET['view_page']=$_POST['page'];}

		if(isset($_GET['view_page']) && is_numeric($_GET['view_page'])){ $Pass_Page = $_GET['view_page']; }
		else{ $Pass_Page=0; }

		## GET DISPLAY TYPE				
		$SearchData = GetViewedProfiles($_POST,$Pass_Page, $_GET,'birthday'); $DataCounter= count($SearchData); 

		## NO SEARCH RESULTS
		if(!isset($SearchData[$DataCounter]['TotalResults'])){ $SearchData[$DataCounter]['TotalResults'] =0; }
		if($SearchData[$DataCounter]['TotalResults'] == SEARCH_PAGE_ROWS){ $GLOBALS['total_pages']=1; }
		else{$GLOBALS['total_pages'] = ceil($SearchData[$DataCounter]['TotalResults']/SEARCH_PAGE_ROWS); }
	
		## SEARCH RESULTS ARRAY
		$search_data = $SearchData;

		## SEARCH NEXT / LAST BUTTONS
		if($SearchData[$DataCounter]['TotalResults'] < SEARCH_PAGE_ROWS){		
			$Search_Page_Numbers = "";
		}else{

			if(count($SearchData) == SEARCH_PAGE_ROWS){ $SHOW_NEXT_BOX = true; }

			else{ $SHOW_NEXT_BOX = false; }

			if(MATCH_PD == 'pagination'){
				$Search_Page_Numbers = PageNumbers($SearchData[$DataCounter]['TotalResults'], $Pass_Page,$SHOW_NEXT_BOX);
			}
			else{
				$Search_Page_Numbers = "";
			}

		}

		## Define Page Array
		$Search_Type= array('gallery','detail','basic');

		if(isset($_GET['displaytype']) && in_array($_GET['displaytype'],$Search_Type)){
			$_POST['displaytype'] = $_GET['displaytype'];
		}

		## Determin Display Page

		if(isset($_POST['displaytype']) && in_array($_POST['displaytype'],$Search_Type)){
			$search_type = $_POST['displaytype'];
		}else{

			## shows the default search page display, set in the config file.
			$search_type = SEARCH_PAGE_DISPLAY;

		}

		$show_page ="home";


		if(!isset($NETWORKD_FRIEND_ID)){ $PageTitle= $GLOBALS['_LANG']['_search']." ".$GLOBALS['_LANG']['_results']; }
		elseif($NETWORK_ID ==1){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_hotList']; }
		elseif($NETWORK_ID ==2){ $PageTitle= $GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_friendsList']; }
		elseif($NETWORK_ID ==3){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_blockList']; }
		elseif($NETWORK_ID ==5){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_partners']; }	


		if($_SESSION['auth'] =="yes"){
			$SaveSearchData = SavedSearched($_SESSION['uid']);
		}


		## SAVE SEARCH PAGE

		if(isset($_POST['SavePage']) && $_POST['SavePage'] ==1){

			$SaveString ="";
			$DontSaveThis = array('SavePage');
			foreach($_POST as $val => $key){
				if(!in_array($val, $DontSaveThis)){
					if(is_array($key)){
						foreach($key as $val1 => $key1){
							$SaveString .= $val."[".$val1."]-".$key1."*";
						}
					}else{
						$SaveString .= $val."-".$key."*";
					}
				}
			}

			$DB->Insert("INSERT INTO `member_searches` (`search_id` ,`uid` ,`search_date` ,search_string, `search_name`)VALUES ( NULL , '".$_SESSION['uid']."', now(), '".eMeetingInput($SaveString)."', '".DATE_NOW."')");

			$ERROR_MESSAGE = $GLOBALS['_LANG_ERROR']['_complete']; $ERROR_TYPE="good";

		}
	
	} break;


	/**
	* Page: WEBSITE SEARCH PAGE
	*
	* @version  9.0
	* @created  Sat 25 Oct  2008
	* @related  inc/func/func_faq_page.php
	*/

	case "search":{

		if(!isset($_SESSION['admin_auth']) && isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("chatroom-profile",$PACKAGEACCESS[$_SESSION['packageid']]) ){

			header("location: ".getThePermalink("subscribe")); exit();

		}

		$SubSub_Lang = $LANG_SEARCH;
		$GLOBALS['LANG_SEARCH'] = $LANG_SEARCH;

		$PageTitle = $SubSub_Lang[$page];
		$PageDesc = $SubSub_Lang[$page."_?"];

		## force members to login after page 2 of search results
		if(isset($_POST['page']) > 2 && $_SESSION['auth'] !="yes"){
			header("location:".getThePermalink('login'));
		}

		if($_SESSION['auth'] =="yes" && is_numeric($_SESSION['uid'])){ $lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); }

		## DISPLAY GLOBALS				
		require_once('inc/func/func_search_page.php');

		//PageTitle = $GLOBALS['_LANG']['_member']." ".$GLOBALS['_LANG']['_search']; 
		$ThisPersonsNetworkBar="";


		$Reg_Type = array('advanced');
		if(isset($sub_page) && in_array($sub_page,$Reg_Type) ){

			require_once('inc/func/func_browse_page.php');		
			$browse_options = DisplayBrowse();
			$PageTitle = $GLOBALS['_LANG']['_menue2'];
			$show_page = $sub_page;	

		}else{

			/**
			* Info: Performs the main search page results
			* 		
			* @version  9.0
			* @updated  Fri Sep 25 10:48:31 EEST 2008
			*/				

			$NETWORK_ID=2;

			## GET SEARCH DATA
			if(isset($_POST['page']) && is_numeric($_POST['page'])){ $_GET['view_page']=$_POST['page'];}

			if(isset($_GET['view_page']) && is_numeric($_GET['view_page'])){ $Pass_Page = $_GET['view_page']; }
			else{ $Pass_Page=0; }

			## display if network ID is selected

			if( ( isset($_POST['friendid']) && is_numeric($_POST['friendid']) )  || ( isset($_GET['friendid']) && is_numeric($_GET['friendid']) )  ){

				$NETWORKD_FRIEND_ID	= (isset($_POST['friendid'])) ? $_POST['friendid'] : $_GET['friendid'];

				if($NETWORKD_FRIEND_ID == 0 && $_SESSION['auth'] !="yes"){ 

					header("location: ".getThePermalink('account')); exit(); 

				}elseif($NETWORKD_FRIEND_ID == 0 && $_SESSION['auth'] =="yes"){

					$NETWORKD_FRIEND_ID=$_SESSION['uid'];

				}


				## find the network type

				if( ( isset($_POST['friend_type']) && is_numeric($_POST['friend_type']) )  || ( isset($_GET['friend_type'])  && is_numeric($_GET['friend_type']) )  ){

					$NETWORK_ID    = (isset($_POST['friend_type']))	?	$_POST['friend_type']	: $_GET['friend_type'];

				}

				 $ThisPersonsNetworkBar = ShowFCIDMEmber($NETWORKD_FRIEND_ID);

			}

			$_POST = $_REQUEST;
			## GET DISPLAY TYPE	
			$SearchData = GetProfiles($_POST,$Pass_Page, $_GET); $DataCounter= count($SearchData); 

			## NO SEARCH RESULTS
			if(!isset($SearchData[$DataCounter]['TotalResults'])){ $SearchData[$DataCounter]['TotalResults'] =0; }

			if($SearchData[$DataCounter]['TotalResults'] == SEARCH_PAGE_ROWS){ $GLOBALS['total_pages']=1; }

			else{$GLOBALS['total_pages'] = ceil($SearchData[$DataCounter]['TotalResults']/SEARCH_PAGE_ROWS); }

		
			## SEARCH RESULTS ARRAY
			$search_data = $SearchData;

			## SEARCH NEXT / LAST BUTTONS
			if($SearchData[$DataCounter]['TotalResults'] < SEARCH_PAGE_ROWS){		

				$Search_Page_Numbers = "";

			}else{

				if(count($SearchData) == SEARCH_PAGE_ROWS){ $SHOW_NEXT_BOX = true; }

				else{ $SHOW_NEXT_BOX = false; }

				if(MATCH_PD == 'pagination'){
					$Search_Page_Numbers = PageNumbers($SearchData[$DataCounter]['TotalResults'], $Pass_Page,$SHOW_NEXT_BOX);
				}
				else{
					$Search_Page_Numbers = "";
				}

			}

			## Define Page Array
			$Search_Type= array('gallery','detail','basic');

			if(isset($_GET['displaytype']) && in_array($_GET['displaytype'],$Search_Type)){
				$_POST['displaytype'] = $_GET['displaytype'];
			}

			## Determin Display Page

			if(isset($_POST['displaytype']) && in_array($_POST['displaytype'],$Search_Type)){
				$search_type = $_POST['displaytype'];
			}else{

				## shows the default search page display, set in the config file.
				$search_type = SEARCH_PAGE_DISPLAY;

			}

			$show_page ="home";


			if(!isset($NETWORKD_FRIEND_ID)){ $PageTitle= $GLOBALS['_LANG']['_search']." ".$GLOBALS['_LANG']['_results']; }
			elseif($NETWORK_ID ==1){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_hotList']; }
			elseif($NETWORK_ID ==2){ $PageTitle= $GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_friendsList']; }
			elseif($NETWORK_ID ==3){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_blockList']; }
			elseif($NETWORK_ID ==5){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_partners']; }	


			if($_SESSION['auth'] =="yes"){
				$SaveSearchData = SavedSearched($_SESSION['uid']);
			}


			## SAVE SEARCH PAGE

			if(isset($_POST['SavePage']) && $_POST['SavePage'] ==1){

				$SaveString ="";
				$DontSaveThis = array('SavePage');
				foreach($_POST as $val => $key){
					if(!in_array($val, $DontSaveThis)){
						if(is_array($key)){
							foreach($key as $val1 => $key1){
								$SaveString .= $val."[".$val1."]-".$key1."*";
							}
						}else{
							$SaveString .= $val."-".$key."*";
						}
					}
				}

				$DB->Insert("INSERT INTO `member_searches` (`search_id` ,`uid` ,`search_date` ,search_string, `search_name`)VALUES ( NULL , '".$_SESSION['uid']."', now(), '".eMeetingInput($SaveString)."', '".DATE_NOW."')");

				$ERROR_MESSAGE = $GLOBALS['_LANG_ERROR']['_complete']; $ERROR_TYPE="good";

			}
		}
	} break;

	/**
	* Page: WEBSITE FAQ PAGE
	*
	* @version  9.0
	* @created  Sat 25 Oct  2008
	* @related  inc/func/func_faq_page.php
	*/

	case "faq":{

		$PageTitle = $GLOBALS['_LANG']['_faq'];

		## includes the faq functions				
		require_once('inc/func/func_faq_page.php');

		## gets the FAQ links and questions		
		$faq_links = GetFAQLinks();
		$faq_rows =GetFAQ();				

	} break;

	/**
	* Page: CONTACT FORM FOR SENDING CONTACT MESSAGES
	*
	* @version  9.0
	* @created  Sat 25 Oct 2008
	* @related  inc/func/func_contact.php
	*/

	case "contact":{	

		$sub_page="";
		$SubSub_Lang = $LANG_CONTACT_MENU;
		$PageTitle = $SubSub_Lang[$sub_page];
		$PageDesc = $SubSub_Lang[$sub_page."_?"];		

		## CREATE PAGE DATA	
		require_once "inc/classes/class_regimg.php";	
		$obj = new SPAF_FormValidator();		

		## PERFORM OPERATION
		if(isset($_POST['do'])){ 
			require_once('inc/func/func_contact.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST,$obj);
		}

	} break;	

	/**
	* Page: RETURN PAGE AFTER A PAYMENT HAS BEEN PROCESSED
			THIS PAGE ONLY DISPLAYS THE THANK YOU MESSAGE, 
			NOT PROCESSING IS DONE HERE. PLUGINS DO ALL PROCESSING
	*
	* @version  9.0
	* @created  Sat 25 Oct  2008
	* @related  
	*/

	case "order":{	

		$SubSub_Lang = $LANG_ORDER_MENU;

		## PERFORM OPERATION
		$Order_Type= array('thankyou','cancel','error','requitix');

		## Determin Display Page
		if(isset($sub_page) && in_array($sub_page,$Order_Type)){

			$show_page =  $sub_page;
			$PageTitle = $SubSub_Lang[$show_page];
			$PageDesc = $SubSub_Lang[$show_page."_?"];

			if($sub_page == 'requitix'){

				require_once("inc/func/func_login.php");
				$name = $_POST["address"];
				$amount = $_POST["rqx"];
				$user_id = $_POST["user_id"];
				$package_id = $_POST["package_id"];
				$txn_id = $_POST["txn_hash"];
				$rate_exp = date('Y-m-d H:i:s', strtotime("+30 days"));

				 if(isset($txn_id)){
				    AddOrder($user_id , $package_id , "Requitix", $name , $txn_id );
				    ChangeUpgrade($user_id);
				    $DB->Insert("INSERT INTO rqx_address SET address = '$name' , user_id = '$user_id' , rqx_tokens = '$amount'");

				    $DB->Insert("INSERT INTO tbl_rating SET  user_id = '$user_id' , rate_exp = '$rate_exp' , transaction_id = '$txn_id'");

				    
				  }
			}

		}else{

			header("location: ".getThePermalink('logout')); exit();

		}

	} break;	

	 /**
	 * Page: Profile Page
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 29, 2008
	 */

	case "profile":{

		if(!isset($_SESSION['admin_auth']) && isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("chatroom-profile",$PACKAGEACCESS[$_SESSION['packageid']]) ){

			header("location: ".getThePermalink("subscribe")); exit();

		}

		## Check we have ID or username request		

		if(isset($item_id) && is_numeric($item_id)){ 

 

			$profileId 			= strip_tags(trim($item_id)); 

			$profileUsername 	= GetUsername($profileId); 

 

		}elseif(isset($_GET['pId']) && is_numeric($_GET['pId'])){ 

			$profileId 			= strip_tags(trim($_GET['pId'])); 
			$profileUsername 	= GetUsername($profileId); 

		}elseif(isset($_GET['pUsername'])){

			$profileId 			= GetUserID(strip_tags(trim($_GET['pUsername']))); 
			$profileUsername 	= strip_tags(trim($_GET['pUsername'])); 
			$item_id 			= $profileId; 

		}

		## CHECK BOTH ARE SET

		if((isset($profileId) && is_numeric($profileId) && isset($profileUsername))){}else{ header("location: ".getThePermalink('')); exit();}

		## tell the template to only display one column
		$lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); 

		## include all the page functions
		require_once('inc/func/func_galllery_page.php');
		require_once('inc/func/func_profile_page.php');
		require_once('inc/func/func_blog_page.php');

		//require_once('inc/func/func_network_page.php');
		require_once('inc/func/func_compatibility_page.php');

		## Compatibility Groups

		$compatibilityGroups = getCompatibilityGroups();
		## Get My Compatibility Answers 
		$myCompatibilityAnswers = getMyCompatibilityAnswers($_SESSION['uid']);

		## Get Current Usre's Compatibility Answers 
		$userCompatibilityAnswers =  getMyCompatibilityAnswers($profileId);

		## look for a profile partner 
		//$ProfilePartner = CheckPartner($profileId);
		## get profile data

		$MyProfileGlobals = MemberAccountDetails($profileId, false,"profile");
		## check if this account is active

		if( $MyProfileGlobals['active'] !="active"  ){
			if(  $_SESSION['uid'] != $profileId  && !isset($_SESSION['site_moderator_approve']) && !isset($_SESSION['admin_auth']) ) {

				## block page access
				$BLOCKPAGEACCESS=1;

			}
		}

		## Inbox mail count
		$MailCount = ProfileMailCount($profileId);

		## Redefine this variable
		$show_page = 'inbox';
		$selected_page = 'inbox';				
		## Check for OrderBy
		if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="messages.maildate";}

		if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

		if(isset($_GET['sta'])){$MailStart=strip_tags($_GET['sta']);}else{$MailStart=0;}

		if(isset($_GET['sto'])){$MailStop=strip_tags($_GET['sto']);}

		elseif(isset($_POST['sto'])){$MailStop=strip_tags($_POST['sto']);}else{$MailStop=10;}

		## Determin Which Mailbox

		$MailBoxArray = DisplayProfileMessages($_SESSION['uid'],$profileId,$sub_page,$ThisOrder,$MailStart,$MailStop);

		if(!isset($BLOCKPAGEACCESS)){

			/**
			* Info: Used to display the profile overview page
			* 		
			* @version  9.0
			* @updated  Fri Sep 25 10:48:31 EEST 2008
			*/

			$profile_group_array 		=  GetProfileGroups($MyProfileGlobals['gender']);
			$show_album_array 			=  DisplayRecentPhotoAlbums(100,$profileId);
			$RecentPhotos 				=  DisplayRecentPhotos($profileId);
			$MusicFile 					=  MyMusicFile($profileId);		

			## Define Page Array
			$Profile_Type= array('albums','friends','blog','blogview','manage','viewfile');

			## Determin Display Page
			if(isset($sub_page) && in_array($sub_page,$Profile_Type)){

				$show_page =  $sub_page;

				if($sub_page =="albums"){
					/**
					* Info: Used to display the members album files
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/	

					$_GET['fcid'] = $profileId;

					## GET SEARCH DATA
					if(isset($_POST['page']) && is_numeric($_POST['page'])){ $_GET['view_page']=$_POST['page'];}
					if(isset($_GET['view_page']) && is_numeric($_GET['view_page'])){ $Pass_Page = $_GET['view_page']; }else{ $Pass_Page=0; }	
					$search_data = DisplayRecentAlbums($_POST, $_GET, $Pass_Page,$search_uid); $DataCounter = count($search_data);

					## SEARCH NEXT / LAST BUTTONS
					if($search_data[$DataCounter]['TotalResults'] == SEARCH_PAGE_ROWS){ $GLOBALS['total_pages']=1; }else{$GLOBALS['total_pages'] = ceil($search_data[$DataCounter]['TotalResults']/SEARCH_PAGE_ROWS); }

					if($search_data[$DataCounter]['TotalResults'] < SEARCH_PAGE_ROWS){		
						$Search_Page_Numbers = "";
					}else{
						if(count($search_data) == SEARCH_PAGE_ROWS){ $SHOW_NEXT_BOX = true; }else{ $SHOW_NEXT_BOX = false; }
						$Search_Page_Numbers = PageNumbers($search_data[$DataCounter]['TotalResults'], $Pass_Page,true);
					}

					## show menu tabs
					$tab_page = "albums";

				}elseif($sub_page =="blogview" && isset($item2_id) && is_numeric($item2_id)){

					/**
					* Info: Used to display the members blog details
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/	

					$BlogData = GetBlogPostDetails($item2_id,$profileId);
					// AUTO META TAGS DATA	
					$META_INPUT_DATA = $BlogData;

				}elseif($sub_page =="blog"){

					/**
					* Info: Used to display the members blog posts
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/			

					## Check for OrderBy
					if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="id";}

					if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}
					if(isset($_GET['sta'])){$Start=strip_tags($_GET['sta']);}else{$Start=0;}
					if(isset($_GET['sto'])){$Stop=strip_tags($_GET['sto']);}
					elseif(isset($_POST['sto'])){$Stop=strip_tags($_POST['sto']);}else{$Stop=5;}

					## Determin Which Mailbox
					$BlogArray =DisplayBlogPosts($profileId,$ThisOrder,$Start,$Stop);
					$blog_array =  $BlogArray;

					## Show Page Navigation
					if(!isset($BlogArray[1]['totalMsg']) || $BlogArray[1]['totalMsg'] < $Stop){ $Pages = 1; /* display: 1 of 1 */ }else{
						$Pages = roundup ($BlogArray[1]['totalMsg']/$Stop,0);
					}

					$Page_Next = $Start+$Stop; if($Page_Next >100){ $Page_Next=0; }
					$Page_Prev = $Start-$Stop; if($Page_Prev <0){ $Page_Prev=0; }
					$show_page_current =  $Mail_current;
					$show_page_next =  $Page_Next;
					$show_page_prev =  $Page_Prev;
					$show_page_rows =  '&sto='.$Stop;
					$show_page_num_of =  $Pages;

			
					## show menu tabs

					$tab_page = "blog";	

				}elseif($sub_page =="manage" && isset($item2_id) && is_numeric($item2_id) && CheckAlbumAccess($item2_id) ){


					/**

					* Info: Used to display the profile album files

					* 		

					* @version  9.0

					* @updated  Fri Sep 25 10:48:31 EEST 2008

					*/						

					//CheckAlbumAccess($item2_id);

					$gallery_display_albums =  DisplayGallery($profileId,strip_tags($item2_id),true);

					/*foreach($gallery_display_albums as $gallary){
						echo '<pre> testtest';
						print_r($gallary);
						echo '</pre>';
					}*/
							
					if (isset($gallery_display_albums) && count($gallery_display_albums) > 0)  {
					 $album_name =  $gallery_display_albums[0]['atitle'];


					 $album_time =  $gallery_display_albums[0]['time'];	

					 $album_date =  $gallery_display_albums[0]['date'];	

					}

					## show menu tabs

					$tab_page = "albums";	


					// AUTO META TAGS DATA	

					$data['username']    = $MyProfileGlobals['username'];

					$data['title']       = isset($gallery_display_albums[1]['atitle']);

					$data['description'] = isset($gallery_display_albums[1]['comments']).$MyProfileGlobals['headline'].$MyProfileGlobals['description'];

					$META_INPUT_DATA     = $data;
			
				}elseif($sub_page =="viewfile" && CheckAlbumAccess($item2_id) && isset($item3_id) && is_numeric($item3_id) ){ // 

					/**
					* Info: Used to display the album file
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/					

					## FILE DETAILS

					$FileData 				=  DisplayLarge($item3_id);

					$gallery_file_data 		=  $FileData['percent'];

					$gallery_file_rating 	=  $FileData['percent'];				

					$gallery_album_id 		=  strip_tags($item2_id);

					$gallery_file_id 		=  strip_tags($item3_id);

					$gallery_file_views 	=  $FileData['views'];

					$gallery_file_src 		=  $FileData['src'];			

					$gallery_file_title		=  $FileData['title'];

					$gallery_file_description =  $FileData['desc'];

	

					## display other files

					$my_image_array = DisplayMyPhotos(strip_tags($item_id),strip_tags($item2_id));

	

					## show menu tabs

					$tab_page = "albums";	


					// AUTO META TAGS DATA	

					$data['username'] = $MyProfileGlobals['username'];

					$data['title'] = $gallery_file_title;

					$data['description'] = $gallery_file_description.$MyProfileGlobals['headline'].$MyProfileGlobals['description'];

					$META_INPUT_DATA = $data;		

				}

			}else{

				/**

				* Info: Used to display the profile overview page

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/


				## get the template theme styles

				$myTheme = GetMemberTemplate($profileId);

				## build profile themer

				$HEADER_META_BASE .= BuildProfileCSS($myTheme);

				## update hit counter

				UpdateHits($profileId);

				## Add Profile Visited

				AddVisitor($profileId);


				$show_network_array 		=  DisplayMyFriendsList($profileId,12);

				$RecentPhotos 				=  DisplayRecentPhotos($profileId);

				$show_blog_array 			=  DisplayRecentBlogs(5,$profileId);

				$GLOBALS['profile_tests'] 	=  DisplayMemberQuizzes($profileId);

				$_GET['sub']="overview";

				$show_page = "overview";

				// AUTO META TAGS DATA		

				$META_INPUT_DATA = $MyProfileGlobals;

			}		

		}

	} break;


	/**

	 * Page: Profile Page

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 29, 2008

	 */



	case "profile_admin":{

		if(!isset($_SESSION['admin_auth']) && isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("chatroom-profile",$PACKAGEACCESS[$_SESSION['packageid']]) ){

			//header("location: ".getThePermalink("subscribe")); exit();

		}

		## Check we have ID or username request		

		if(isset($item_id) && is_numeric($item_id)){ 

 

			$profileId 			= strip_tags(trim($item_id)); 

			$profileUsername 	= GetUsername($profileId); 

 

		}elseif(isset($_GET['pId']) && is_numeric($_GET['pId'])){ 

 

			$profileId 			= strip_tags(trim($_GET['pId'])); 

			$profileUsername 	= GetUsername($profileId); 

 

		}elseif(isset($_GET['pUsername'])){



			$profileId 			= GetUserID(strip_tags(trim($_GET['pUsername']))); 

			$profileUsername 	= strip_tags(trim($_GET['pUsername'])); 

			$item_id 			= $profileId; 

		}

		

		## CHECK BOTH ARE SET

		//if((isset($profileId) && is_numeric($profileId) && isset($profileUsername))){}else{ header("location: ".DB_DOMAIN."index.php"); exit();}

		

		## tell the template to only display one column

		$lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); 



		## include all the page functions

		require_once('inc/func/func_galllery_page.php');

		require_once('inc/func/func_profile_page.php');

		require_once('inc/func/func_blog_page.php');

		//require_once('inc/func/func_network_page.php');
		
		require_once('inc/func/func_compatibility_page.php');

		## Compatibility Groups

		$compatibilityGroups = getCompatibilityGroups();
		## Get My Compatibility Answers 
		$myCompatibilityAnswers = getMyCompatibilityAnswers($_SESSION['uid']);

		## Get Current Usre's Compatibility Answers 
		$userCompatibilityAnswers =  getMyCompatibilityAnswers($profileId);

		## look for a profile partner 

		//$ProfilePartner = CheckPartner($profileId);

		## get profile data

		$MyProfileGlobals = MemberAccountDetails($profileId, false,"profile");

		## check if this account is active

		if( $MyProfileGlobals['active'] !="active"  ){

			if(  $_SESSION['uid'] != $profileId  && !isset($_SESSION['site_moderator_approve']) && !isset($_SESSION['admin_auth']) ) {

				## block page access

				$BLOCKPAGEACCESS=1;

			}

		}

		## Inbox mail count

		$MailCount = ProfileMailCount($profileId);

		
		## Redefine this variable

		$show_page = 'inbox';

		$selected_page = 'inbox';				

		## Check for OrderBy

		if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="messages.maildate";}

		if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

		if(isset($_GET['sta'])){$MailStart=strip_tags($_GET['sta']);}else{$MailStart=0;}

		if(isset($_GET['sto'])){$MailStop=strip_tags($_GET['sto']);}

		elseif(isset($_POST['sto'])){$MailStop=strip_tags($_POST['sto']);}else{$MailStop=10;}

		## Determin Which Mailbox

		$MailBoxArray = DisplayProfileMessages($_SESSION['uid'],$profileId,$sub_page,$ThisOrder,$MailStart,$MailStop);

		if(!isset($BLOCKPAGEACCESS)){

			/**
			* Info: Used to display the profile overview page
			* 		
			* @version  9.0
			* @updated  Fri Sep 25 10:48:31 EEST 2008
			*/

			$profile_group_array 		=  GetProfileGroups($MyProfileGlobals['gender']);
			$show_album_array 			=  DisplayRecentPhotoAlbums(100,$profileId);
			$RecentPhotos 				=  DisplayRecentPhotos($profileId);
			$MusicFile 					=  MyMusicFile($profileId);		

			## Define Page Array
			$Profile_Type= array('albums','friends','blog','blogview','manage','viewfile');

			## Determin Display Page
			if(isset($sub_page) && in_array($sub_page,$Profile_Type)){

				$show_page =  $sub_page;
				if($sub_page =="albums"){

					/**
					* Info: Used to display the members album files
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/	

					$_GET['fcid'] = $profileId;

					## GET SEARCH DATA
					if(isset($_POST['page']) && is_numeric($_POST['page'])){ $_GET['view_page']=$_POST['page'];}
					if(isset($_GET['view_page']) && is_numeric($_GET['view_page'])){ $Pass_Page = $_GET['view_page']; }else{ $Pass_Page=0; }	
					$search_data = DisplayRecentAlbums($_POST, $_GET, $Pass_Page,$search_uid); $DataCounter = count($search_data);

					## SEARCH NEXT / LAST BUTTONS
					if($search_data[$DataCounter]['TotalResults'] == SEARCH_PAGE_ROWS){ $GLOBALS['total_pages']=1; }else{$GLOBALS['total_pages'] = ceil($search_data[$DataCounter]['TotalResults']/SEARCH_PAGE_ROWS); }

					if($search_data[$DataCounter]['TotalResults'] < SEARCH_PAGE_ROWS){		
						$Search_Page_Numbers = "";
					}else{

						if(count($search_data) == SEARCH_PAGE_ROWS){ $SHOW_NEXT_BOX = true; }else{ $SHOW_NEXT_BOX = false; }
						$Search_Page_Numbers = PageNumbers($search_data[$DataCounter]['TotalResults'], $Pass_Page,true);
					}

					## show menu tabs
					$tab_page = "albums";

				}elseif($sub_page =="blogview" && isset($item2_id) && is_numeric($item2_id)){

					/**
					* Info: Used to display the members blog details
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/	

					$BlogData = GetBlogPostDetails($item2_id,$profileId);
 
					// AUTO META TAGS DATA	

					$META_INPUT_DATA = $BlogData;

				}elseif($sub_page =="blog"){

					/**
					* Info: Used to display the members blog posts
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/			
					## Check for OrderBy

					if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="id";}

					if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

					if(isset($_GET['sta'])){$Start=strip_tags($_GET['sta']);}else{$Start=0;}

					if(isset($_GET['sto'])){$Stop=strip_tags($_GET['sto']);}

					elseif(isset($_POST['sto'])){$Stop=strip_tags($_POST['sto']);}else{$Stop=5;}

					## Determin Which Mailbox

					$BlogArray =DisplayBlogPosts($profileId,$ThisOrder,$Start,$Stop);

					$blog_array =  $BlogArray;


					## Show Page Navigation

					if(!isset($BlogArray[1]['totalMsg']) || $BlogArray[1]['totalMsg'] < $Stop){ $Pages = 1; /* display: 1 of 1 */ }else{

						$Pages = roundup ($BlogArray[1]['totalMsg']/$Stop,0);

					}

					$Page_Next = $Start+$Stop; if($Page_Next >100){ $Page_Next=0; }

					$Page_Prev = $Start-$Stop; if($Page_Prev <0){ $Page_Prev=0; }

					$show_page_current =  $Mail_current;

					$show_page_next =  $Page_Next;

					$show_page_prev =  $Page_Prev;

					$show_page_rows =  '&sto='.$Stop;

					$show_page_num_of =  $Pages;

			
					## show menu tabs

					$tab_page = "blog";	

				}elseif($sub_page =="manage" && isset($item2_id) && is_numeric($item2_id) && CheckAlbumAccess($item2_id) ){

					/**
					* Info: Used to display the profile album files
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/						

					//CheckAlbumAccess($item2_id);

					$gallery_display_albums =  DisplayGallery($profileId,strip_tags($item2_id),true);

					/*foreach($gallery_display_albums as $gallary){
						echo '<pre> testtest';
						print_r($gallary);
						echo '</pre>';
					}*/
							
					if (isset($gallery_display_albums)) {
					
						$album_name =  $gallery_display_albums[0]['atitle'];					

						$album_time =  $gallery_display_albums[0]['time'];	

						$album_date =  $gallery_display_albums[0]['date'];	

					}

					## show menu tabs

					$tab_page = "albums";	


					// AUTO META TAGS DATA	

					$data['username']    = $MyProfileGlobals['username'];

					$data['title']       = isset($gallery_display_albums[1]['atitle']);

					$data['description'] = isset($gallery_display_albums[1]['comments']).$MyProfileGlobals['headline'].$MyProfileGlobals['description'];

					$META_INPUT_DATA     = $data;
			
				}elseif($sub_page =="viewfile" && CheckAlbumAccess($item2_id) && isset($item3_id) && is_numeric($item3_id) ){ // 

					/**
					* Info: Used to display the album file
					* 		
					* @version  9.0
					* @updated  Fri Sep 25 10:48:31 EEST 2008
					*/					

					## FILE DETAILS
					$FileData 				=  DisplayLarge($item3_id);
					$gallery_file_data 		=  $FileData['percent'];
					$gallery_file_rating 	=  $FileData['percent'];				
					$gallery_album_id 		=  strip_tags($item2_id);
					$gallery_file_id 		=  strip_tags($item3_id);
					$gallery_file_views 	=  $FileData['views'];
					$gallery_file_src 		=  $FileData['src'];			
					$gallery_file_title		=  $FileData['title'];
					$gallery_file_description =  $FileData['desc'];

					## display other files
					$my_image_array = DisplayMyPhotos(strip_tags($item_id),strip_tags($item2_id));

					## show menu tabs
					$tab_page = "albums";	

					// AUTO META TAGS DATA	
					$data['username'] = $MyProfileGlobals['username'];
					$data['title'] = $gallery_file_title;
					$data['description'] = $gallery_file_description.$MyProfileGlobals['headline'].$MyProfileGlobals['description'];
					$META_INPUT_DATA = $data;		

				}

			}else{

				/**
				* Info: Used to display the profile overview page
				* 		
				* @version  9.0
				* @updated  Fri Sep 25 10:48:31 EEST 2008
				*/

				## get the template theme styles
				$myTheme = GetMemberTemplate($profileId);

				## build profile themer
				$HEADER_META_BASE .= BuildProfileCSS($myTheme);

				## update hit counter
				UpdateHits($profileId);

				## Add Profile Visited
				AddVisitor($profileId);


				$show_network_array 		=  DisplayMyFriendsList($profileId,12);
				$RecentPhotos 				=  DisplayRecentPhotos($profileId);
				$show_blog_array 			=  DisplayRecentBlogs(5,$profileId);
				$GLOBALS['profile_tests'] 	=  DisplayMemberQuizzes($profileId);
				$_GET['sub']="overview";
				$show_page = "overview";

				// AUTO META TAGS DATA		
				$META_INPUT_DATA = $MyProfileGlobals;

			}		
		}
	} break;



	//////////////////////////////////////////
	/////// ACCOUNT PAGES ////////////////////
	//////////////////////////////////////////

	 /**
	 * Page: Account Overview Page
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Jan 18 10:48:31 EEST 2008
	 */	

	case "overview":{

		$PageTitle = $GLOBALS['_LANG']['_accountOverview'];	

		## Define Page title and menu
		## PERFORM OPERATION
		if(isset($_POST['do'])){ 
			require_once('inc/func/func_overview.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);
		}

		require_once('inc/func/func_overview_page.php');

		if($_SESSION['auth'] =="yes" && is_numeric($_SESSION['uid'])){ $lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); }

			$ThisCount = GetAccountCountSettings($_SESSION['uid']);
			$show_poll = AccPoll($_SESSION['uid']);			

			if($sub_page =="viewed"){
				require_once('inc/func/func_account_page.php');
				$PageTitle = $lang_overview_page['a21'];
				$table_view = DisplayHistory($_SESSION['uid']);
				$show_page = 'viewed';
			}
			elseif($sub_page =="nearme"){
				require_once('inc/func/func_nearme_page.php');
				$nearMeArray = GetProfilesNearMe($_POST);
				$PageTitle = $lang_overview_page['95'];
				$show_page = 'nearme';
			}
			elseif($sub_page =="meetme"){
				require_once('inc/func/func_meetme_page.php');
				$SearchId = GetProfilesMeetMe($_POST);
				$MeetProfile = GetProfileMeetMeData($SearchId);
				$PageTitle = $lang_overview_page['96'];
				$show_page = 'meetme';
			}
			/*elseif($sub_page =="chat"){

				if( isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("chat-chat",$PACKAGEACCESS[$_SESSION['packageid']]) ) {

					header("location: ".getThePermalink("subscribe")); exit();
				}

				require_once('inc/func/func_chat_page.php');

				$PageTitle = $lang_overview_page['97'];

				$show_page = 'chat';

			}*/
			else{

				$show_page = 'home';
				$MemberMatches = MatchResults(MATCH_PAGE_ROWS,$MOBILE);

			}

	} break;

	 /**
	 * Page: Account Page
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Jan 18 10:48:31 EEST 2008
	 */	

	case "account":{

		## Define Page title and menu
		$SubSub_Lang = $LANG_ACCOUNT_MENU;


		## define the page title and description
		if ($sub_page == "0") {
			$sub_page = "";
		}

		
		$PageTitle = $SubSub_Lang[$sub_page];
		$PageDesc = $SubSub_Lang[$sub_page];
		

		
		## PERFORM OPERATION
		if(isset($_POST['do'])){ 

			require_once('inc/func/func_account.php');
			require_once('inc/func/func_uploads.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);

			if(is_numeric($Error_Report)){
				header("location: ".DB_DOMAIN."index.php?dll=profile&sub=overview&item_id=".$Error_Report."&errorid=".$LANG_ERROR['_complete']."**1");
				exit();
			}
		}

		// Define Page Array
		$Access_Page_Account= array('edit','viewed','design','video','comments','view','video');

		// Determin Display Page
		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Account)){

			require_once('inc/func/func_account_page.php');
			$show_page =$sub_page;

			if($sub_page =="view"){

				header("location: ".getThePermalink('user',array('username' => $_SESSION['username'])));
				exit();

			}elseif($sub_page =="edit"){

				if(isset($_SESSION['site_moderator_edit']) && $_SESSION['site_moderator_edit'] =="yes" && isset($_GET['id']) && is_numeric($_GET['id']) ){ 

					$EditThisID =$_GET['id'];

				}else{

					$EditThisID =$_SESSION['uid'];

				}

				if(isset($_GET['group']) && is_numeric($_GET['group']) ){ 
					$mygroup = $_GET['group'];
				}else{ 
					$mygroup = 0;
				}
                
				if(D_USER_REGISTRATION == 'sliding'){
					$profile_details = EditMemberSliding($EditThisID,$mygroup,$page);
				}
				else{
					$profile_details = EditMember($EditThisID,$mygroup);
				}

			}elseif($sub_page =="video"){				

				MustBeLoggedIn();

			}elseif($sub_page =="comments"){

				$Total = GetCommentTotals();

				## Check for OrderBy

				if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="comments.approved";}

				if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

				if(isset($_GET['sta'])){$Start=strip_tags($_GET['sta']);}else{$Start=0;}

				if(isset($_GET['sto'])){$Stop=strip_tags($_GET['sto']);}

				elseif(isset($_POST['sto'])){$Stop=strip_tags($_POST['sto']);}else{$Stop=5;}

				## Determin Which Mailbox

				$type    = isset($_GET['type']) ?	strip_tags($_GET['type'])	: 'profile';
				$type   = (isset($_POST['type'])) ?	strip_tags($_POST['type'])		:$type;

				$CommentsArray = DisplayComments($_SESSION['uid'],$ThisOrder,$Start,$Stop,$type);
				$comments_array = $CommentsArray;

				## Show Page Navigation

				if(!isset($CommentsArray[1]['totalMsg']) || $CommentsArray[1]['totalMsg'] < $Stop){ $Pages = 1; /* display: 1 of 1 */ }else{

					$Pages = roundup ($CommentsArray[1]['totalMsg']/$Stop,0);

				}

				$Page_Next = $Start+$Stop; if($Page_Next >100){ $Page_Next=0; }
				$Page_Prev = $Start-$Stop; if($Page_Prev <0){ $Page_Prev=0; }
				$show_page_current=$Mail_current;
				$show_page_next=$Page_Next;
				$show_page_prev=$Page_Prev;
				$show_page_rows='&sto='.$Stop;
				$show_page_num_of=$Pages;

			}elseif($sub_page =="design"){

				$myTheme = GetMemberTemplate($_SESSION['uid']);

			}

		}else{

			$show_page='home';

		}

	} break;

	 /**
	 * Page: Internal Messages Page
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Jan 18 10:48:31 EEST 2008
	 */

	case "messages":{
		if(isset($_SESSION['account_active'])){	
			?>
			<script type="text/javascript">
				alert('Thanks for being a member. Your account is pending for approval. you cannot access messages until your profile will not be approved by Admin.');
				window.location.href = "<?=DB_DOMAIN?>";
			</script>
			<?php
			//header("location: ".DB_DOMAIN."index.php"); exit();
			exit();
		}
		## LOGIN LANG

		if ($sub_page == "0") {
			$sub_page = "";
		}

		## Define Page title
		$SubSub_Lang = $LANG_MESSAGES_MENU;

		## define the page title and description
		$PageTitle = $SubSub_Lang[$sub_page];
		$PageDesc = $SubSub_Lang[$sub_page."_?"];

		## PERFORM OPERATION
		if(isset($_POST['do'])){ 

			require_once('inc/func/func_uploads.php');
			require_once('inc/func/func_messages.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);

		}

		// Define Page Array
		$Access_Page_Messages= array('create','inbox','trash','sent','read','wink');


		// display Inbox As Default Page
		//if(isset($sub_page) && $sub_page ==""){ $sub_page="home"; }
		// Determin Display Page
		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Messages)){

			require_once('inc/func/func_messages_page.php');
			$show_page = $sub_page;

			if($sub_page =="inbox" || $sub_page =="trash" || $sub_page =="sent" || $sub_page =="wink"){

				## mail count
				$MailCount = MailCount();

				## Redefine this variable
				$show_page = 'inbox';
				$selected_page = $sub_page;				

				## Check for OrderBy

				if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="messages.maildate";}

				if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

				if(isset($_GET['sta'])){$MailStart=strip_tags($_GET['sta']);}else{$MailStart=0;}

				if(isset($_GET['sto'])){$MailStop=strip_tags($_GET['sto']);}

				elseif(isset($_POST['sto'])){$MailStop=strip_tags($_POST['sto']);}else{$MailStop=10;}

				## Determin Which Mailbox

				$MailBoxArray = DisplayMessages($_SESSION['uid'],$sub_page,$ThisOrder,$MailStart,$MailStop);

				$message_array = $MailBoxArray;

				## Show Page Navigation

				if(!isset($MailBoxArray[1]['totalMsg']) || $MailBoxArray[1]['totalMsg'] < $MailStop){ $MailPages = 1; /* display: 1 of 1 */ }else{

					$MailPages = roundup($MailBoxArray[1]['totalMsg']/$MailStop);

				}

				$MailPage_Next = $MailStart+$MailStop; if($MailPage_Next >100){ $MailPage_Next=0; }
				$MailPage_Prev = $MailStart-$MailStop; if($MailPage_Prev <0){ $MailPage_Prev=0; }
				$show_page_current = $Mail_current;
				$show_page_next = $MailPage_Next;
				$show_page_prev = $MailPage_Prev;
				$show_page_rows = '&sto='.$MailStop;
				$show_page_num_of = $MailPages;						

			}elseif($sub_page =="create"){

				$To_Members=""; if(isset($_GET['n'])){ $To_Members = strip_tags($_GET['n']); } if(isset($_POST['to'])){ $To_Members = strip_tags($_POST['to']); }

				$To_Subject=""; if(isset($_POST['subject'])){ $To_Subject= strip_tags($_POST['subject']); } if(isset($_POST['subject'])){ $To_Subject= strip_tags($_POST['subject']); }

				$To_Content=""; if(isset($_POST['message'])){ $To_Content = strip_tags($_POST['message']); }

				if (isset($_GET['msgid']) && is_numeric($_GET['msgid'])){

					$msgData = GetMsgData(strip_tags($_GET['msgid']));
					$msgData[1]['message'] = str_replace("\r\n","",$msgData[1]['message']);
					if($msgData !=0){
					$msgdata = $msgData;

					}
					// $To_Content = '----------------------------------------';
					// $To_Content .= $msgdata[1]['message'];
				}

				$msg_friends = DisplayFriends($_SESSION['uid']);

				// CLEAR MESSAGE DATA AFTER SENDING
				if(isset($Error_Report) && substr($Error_Report,-3) =="**1"){

					$msg_to		 = "";
					$msg_subject = "";
					$msg_content = "";		

				}else{

					$msg_to		 = eMeetingOutput($To_Members);
					$msg_subject = eMeetingOutput($To_Subject);
					$msg_content = $To_Content;

				}

			}elseif($sub_page =="read" && isset($_GET['msgid']) && is_numeric($_GET['msgid'])){

				## Display Message
				$msgData = GetMsgData(strip_tags($_GET['msgid']));

				if($msgData['1']['id'] != ''){

					$msgdata = $msgData;

					$PageTitle = $GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_messages'];

				}else{

					header("location: ".getThePermalink('messages'));

				}	

			} 

		}else{

			## PAGE NOT FOUND, DO REDIRECT
			$show_page = 'home';

		}

	} break;	

	 /**
	 * Page: Member Albums
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Jan 18 10:48:31 EEST 2008
	 */

	case "gallery":{

		## Define Page title
		$SubSub_Lang = $LANG_GALLERY_MENU;
		$SelectedAlbum = "";

		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			require_once('inc/func/func_galllery.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);

		}

		## CHECK FOR A REDIRECT CALL
		if(isset($_POST['redirect']) && $_POST['redirect'] !=""){		
			header("location: ".$_POST['redirect']."&errorid=".$LANG_ERROR['_complete']."**1");
			exit();
		}

		## JUST UPLOADED A FILE SO LETS VIEW IT ##
		if(isset($Error_Report)){

			if(substr($Error_Report,-4,4) == "done"){

				header("location: ".DB_DOMAIN."index.php?dll=gallery&sub=manage&aid=".$_POST['aid']."&errorid=".$LANG_ERROR['_complete']."**1");

				exit();

			}	

		}		

		## Define Page Array
		$Access_Page_Gallery= array('upload','create','manage','edit','albums','search','display');

		## Determin Display Page
		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Gallery)){

			require_once('inc/func/func_galllery_page.php');
			$show_page = $sub_page;
	
			## define the page title and description
			$PageTitle = $SubSub_Lang[$sub_page];
			$PageDesc = $SubSub_Lang[$sub_page."_?"];

		

			if($sub_page =="manage" && isset($_GET['aid'])){



				/**

				* Info: Used to display the album file

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/	

	

				MustBeLoggedIn();

					

				## get album array

				$gallery_display_albums = DisplayGallery($_SESSION['uid'],strip_tags($_GET['aid']));



				if(isset($gallery_display_albums[1]['atitle'])){	

			

					$album_name = $gallery_display_albums[1]['atitle'];									

					## make page title	

					$PageTitle = $album_name;

				}

				

						

			}elseif($sub_page =="create"){





				/**

				* Info: Used to create a new album

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/	

	

				MustBeLoggedIn();

	

				## If edit album, display album details

				if(isset($_GET['aid'])){

						$album = GetAlbumDetails($_GET['aid']);

				}





			}elseif($sub_page =="display"){



				/**

				* Info: Used to display member default photos

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/	



				$my_image_array = DisplayMyPhotos($_SESSION['uid']);





			}elseif($sub_page =="upload"){



				/**

				* Info: Used to upload new files

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/	

	

				MustBeLoggedIn();



				

				## IF EDIT ALBUM FILE, DISPLAY FILE DETALS

				if(isset($_GET['eid'])){

	

						$FileArray = GetFileetails($_GET['eid']);

						if(!isset($FileArray['title'])){ header("location: ".getThePermalink('gallery/albums'));exit();} // STOP HACKING

						$file_array = $FileArray; 

						$SelectedAlbum = $FileArray['aid'];

				}

				if(!isset($_GET['eid'])){

						$SelectedAlbum = "";

				}

					

				## get list of album names

				$gallery_display_showalbums = GetAlbums($_SESSION['uid'],$SelectedAlbum);			





			}elseif($sub_page =="albums"){



				/**

				* Info: Used to display albums list

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/	



				MustBeLoggedIn();



				## get album array

				$gallery_albums = DisplayAlbums($_SESSION['uid']);			



	

			}elseif($sub_page =="edit" && is_numeric($item3_id)){



				/**

				* Info: Used to edit a file

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/	



				MustBeLoggedIn();



				## get album array names

				$gallery_display_showalbums = GetAlbums($_SESSION['uid'],$SelectedAlbum);	



				## load file

				$FileData = DisplayLarge($item3_id,1);			

		

 



			}elseif($sub_page =="search"){





				/**

				* Info: Search Photo Galleries

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/



				## DISPLAY THE SEARCH MEMBER BAR

				if(isset($search_uid) && is_numeric($search_uid)){

					$ThisPersonsNetworkBar = ShowFCIDMEmber($search_uid);

				}



				## GET SEARCH DATA

				$search_data = DisplayRecentAlbums($_POST, $_GET, $search_page, $search_uid); 				

				$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

				if(!isset($search_data[count($search_data)]['TotalResults'])){ 

						$search_total_results=0;					

					}else{ 					

						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);

					}	



				

					

			}else{	

			

				/**

				* Info: Someone is fiddeling

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/



				MustBeLoggedIn();

				## BLANK DATA FOR HACKERS !! :)

				$gallery_display_albums = '';

				$show_page = 'home';

				$PageTitle = $LANG_BODY["_manage"];

			}

		

		}else{



				/**

				* Info: Gallery Help Page

				* 		

				* @version  9.0

				* @updated  Fri Sep 25 10:48:31 EEST 2008

				*/



				MustBeLoggedIn();

				$PageTitle = $GLOBALS['LANG_GLO_OPTIONS']['15'];

				$show_page = 'home';

		}

		//



	} break;



	/**

	* Page: MEMBER SETTINGS AND PRIVACY PAGE

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  inc/func/func_settings_page.php & func_settings.php

	*/



	case "settings":{





		## Define Page title and menu

		$SubSub_Lang = $LANG_SETTINGS_MENU;

			

		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

		

			/* PHP BB3 INTEGRATION CODE */

			if(FORUM_PHPBB_ENABLED =="yes" && $_POST['do']=="password"){

				define('IN_PHPBB', true);

				//$phpbb_root_path = FORUM_PHPBB_ROOTPATH;

				$phpbb_root_path = './phpBB3/';

				$phpEx = substr(strrchr(__FILE__, '.'), 1);

				include($phpbb_root_path . 'common.' . $phpEx);

				$user->session_begin();

				$auth->acl($user->data);

			}			

			/* ------------------------------------ */

			

			require_once('inc/func/func_settings.php');

			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);

		}



		// Define Page Array

		$Access_Page_Settings= array('privacy','password','alerts','cancel','sms', "settings");





		// Determin Display Page

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Settings)){

				

			require_once('inc/func/func_settings_page.php');

			$show_page = $sub_page;



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];



			$privacy_data = GetPrivacy($_SESSION['uid']);

			

			if($sub_page =="privacy"){				





				$privacy_email = GetEmail($_SESSION['uid']);

				$privacy_data = GetPrivacy($_SESSION['uid']);

						

			}elseif($sub_page =="cancel"){



				$privacy_cancel = cancel();

				

			}elseif($sub_page =="alerts"){



				

			}elseif($sub_page =="password"){



				

			}elseif($sub_page =="sms"){



			}elseif($sub_page =="settings"){



				$match_settings_array = DisplayMatchSettings();

			

									

			}

			

		}else{



			$PageTitle = $GLOBALS['LANG_GLO_OPTIONS']['15'];

			$show_page = 'home';



		}

		

	} break;

	 /**

	 * Page: Matches

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	case "matches":{



		

		## Define Page title and menu

		$SubSub_Lang = $LANG_MATCH_MENU;

			

		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			require_once('inc/func/func_match.php');

			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);



			## WE JUST ADDED A QUIZ SO LETS AUTO ADD QUESTIONS ##

			if(isset($GLOBALS['QuestionID'])){



					$sub_page ="add";

					$item_id = $GLOBALS['QuizID']; 

					$item2_id = $GLOBALS['QuestionID'];	

					

			} 









			header("location: ".DB_DOMAIN."index.php?dll=matches&sub=test&item_id=".$Error_Report."&errorid=".$LANG_ERROR['_complete']."**1");

				exit();



		}

		#####################################################

		

		// Define Page Array

		$Access_Page_Matches = array('alerts','test','add','results','taken','settings','addquiz');

		

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Matches)){

			

			require_once('inc/func/func_match_page.php');

			$show_page = $sub_page;

	

			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];

		

			if($sub_page =="test"){			

				

				

				## Check for OrderBy

				if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="date";}

				if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

				if(isset($_GET['sta'])){$Start=strip_tags($_GET['sta']);}else{$Start=0;}

				if(isset($_GET['sto'])){$Stop=strip_tags($_GET['sto']);}

				elseif(isset($_POST['sto'])){$Stop=strip_tags($_POST['sto']);}else{$Stop=5;}

				## Determin Which Mailbox

				

				$MatchArray = DisplayMatchTests($_SESSION['uid'],$ThisOrder,$Start,$Stop);

				$match_data_array = $MatchArray;

				## Show Page Navigation

				if(!isset($MatchArray[1]['totalMsg'])){

				$search_total_results=0;

				}else{

				$search_total_results = $MatchArray[1]['totalMsg'];	

				}

				if(!isset($MatchArray[1]['totalMsg']) || $MatchArray[1]['totalMsg'] < $Stop){ $Pages = 1; /* display: 1 of 1 */ }else{

					$Pages = roundup ($MatchArray[1]['totalMsg']/$Stop,0);

								

				

				}

				$Page_Next = $Start+$Stop; if($Page_Next >100){ $Page_Next=0; }

				$Page_Prev = $Start-$Stop; if($Page_Prev <0){ $Page_Prev=0; }

				$show_page_current = $Mail_current;

				$show_page_next = $Page_Next;

				$show_page_prev = $Page_Prev;

				$show_page_rows = '&sto='.$Stop;

				$show_page_num_of = $Pages;

				



			}elseif($sub_page =="addquiz"){			



				// edit quiz

				if(isset($item_id) && is_numeric($item_id)){ 

					$edit_array = GetMatchDetails($item_id, $_SESSION['uid']);

				}



			}elseif($sub_page =="add" && isset($item_id) && is_numeric($item_id)){



 

				$questions_array = displayQuizQuestions($_SESSION['uid'],$item_id);



				if(isset($item2_id)){

					$questions_details = GetQuestion($item2_id);		

				}								

						

											

			}elseif($sub_page =="results" && isset($_POST['quizid']) && is_numeric($_POST['quizid'])){			





				## Check for OrderBy

				if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="date";}

				if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

				if(isset($_GET['sta'])){$Start=strip_tags($_GET['sta']);}else{$Start=0;}

				if(isset($_GET['sto'])){$Stop=strip_tags($_GET['sto']);}

				elseif(isset($_POST['sto'])){$Stop=strip_tags($_POST['sto']);}else{$Stop=5;}

				

				## Determin Which Mailbox

				$MatchArray = displayQuizResults($_POST['quizid'],$ThisOrder,$Start,$Stop);

				$match_data_array = $MatchArray;

				## Show Page Navigation



				if(!isset($MatchArray[1]['totalMsg']) || $MatchArray[1]['totalMsg'] < $Stop){ $Pages = 1; /* display: 1 of 1 */ }else{

					$Pages = roundup ($MatchArray[1]['totalMsg']/$Stop,0);

				}

				$Page_Next = $Start+$Stop; if($Page_Next >100){ $Page_Next=0; }

				$Page_Prev = $Start-$Stop; if($Page_Prev <0){ $Page_Prev=0; }

				$show_page_current = $Mail_current;

				$show_page_next = $Page_Next;

				$show_page_prev = $Page_Prev;

				$show_page_rows = '&sto='.$Stop;

				$show_page_num_of = $Pages;

							



			}elseif($sub_page =="taken"){



			

				##	 DISPLAY A LIST OF TESTS TAKEN

				## Check for OrderBy

				if(isset($_POST['ChangeOrder'])){$ThisOrder=strip_tags($_POST['ChangeOrder']);}else{$ThisOrder="date";}

				if(isset($_GET['cpage'])){$Mail_current=strip_tags($_GET['cpage']);}else{$Mail_current=1;}

				if(isset($_GET['sta'])){$Start=strip_tags($_GET['sta']);}else{$Start=0;}

				if(isset($_GET['sto'])){$Stop=strip_tags($_GET['sto']);}

				elseif(isset($_POST['sto'])){$Stop=strip_tags($_POST['sto']);}else{$Stop=5;}

				## Determin Which Mailbox

				$MatchArray = displayQuizTaken($ThisOrder,$Start,$Stop);

				$match_data_array = $MatchArray;

				## Show Page Navigation



				if(!isset($MatchArray[1]['totalMsg']) || $MatchArray[1]['totalMsg'] < $Stop){ $Pages = 1; /* display: 1 of 1 */ }else{

					$Pages = roundup ($MatchArray[1]['totalMsg']/$Stop,0);

				}

				$Page_Next = $Start+$Stop; if($Page_Next >100){ $Page_Next=0; }

				$Page_Prev = $Start-$Stop; if($Page_Prev <0){ $Page_Prev=0; }

				$show_page_current = $Mail_current;

				$show_page_next = $Page_Next;

				$show_page_prev = $Page_Prev;

				$show_page_rows = '&sto='.$Stop;

				$show_page_num_of = $Pages;

			



			}

			

		}else{



			$PageTitle = $GLOBALS['LANG_GLO_OPTIONS']['15'];

			$show_page = 'home';



		}

		

									

	} break;

	 /**

	 * Page: Upgrade Page

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	case "classads":{



		$SubSub_Lang = $LANG_CLASSADS_MENU;

		



		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			require_once('inc/func/func_classads.php');

			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);



				// redirect user

				if(isset($_POST['sub'])){

					$ExtraSendData = BuildExtraReturnString($_POST);

					header("location: ".DB_DOMAIN."index.php?dll=".$page."&sub=".$_POST['sub'].$ExtraSendData."&errorid=".$Error_Report);

					exit();

				}

		}



		require_once('inc/func/func_classads_page.php');





		if(isset($_GET['id']) && is_numeric($_GET['id'])){$sub_page ="view"; }



		$Access_Page_ClassAds= array('add','view','search','manage');



		// Determin Display Page

		if($sub_page =="manage"){ $sub_page="search"; $search_uid=$_SESSION['uid']; }

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_ClassAds)){

				

			$show_page = $sub_page;



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];



			if($sub_page =="add"){



				MustBeLoggedIn();

				$my_image_array = DisplayMyPhotos($_SESSION['uid']); 

				if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ $data = EditThisClass($_GET['eid']); }

				## album attachment				

				if(isset($data)){ $AttachmentAlbum=isset($data['attachment']) ? $data['attachment'] : ''; }else{$AttachmentAlbum=0; } 

				$AlbumList = GetAlbums($_SESSION['uid'],$AttachmentAlbum);



			}elseif($sub_page =="view" && is_numeric($item_id)){



					MustBeLoggedIn();

					$cList = ListCats();

					$data = DisplayClass($item_id);					

				

					//$other_class = FindSimilar($data['cat_id']);



					// AUTO META TAGS DATA	

					$PageTitle = $SubSub_Lang["search"];

					$META_INPUT_DATA = $data;



			}elseif($sub_page =="search"){





					## DISPLAY THE SEARCH MEMBER BAR

					if(isset($search_uid) && is_numeric($search_uid)){

						$ThisPersonsNetworkBar = ShowFCIDMEmber($search_uid);

					}



					if(is_numeric($item_id)){ $_GET['catid'] = $item_id; }						

					$search_data = DisplayBrowse($_POST, $_GET, $search_page, $search_uid); 	

					$class_title    = (is_numeric($item_id))		?	GetTitle($item_id)	: $PageTitle;

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

					if(!isset($search_data[count($search_data)]['TotalResults'])){ 

						$search_total_results=0;					

					}else{ 					

						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);

					}	

					$cList = ListCats();

					$PageSubTitle  = $class_title;



					// AUTO META TAGS DATA	

					$data['name'] 	= $class_title;

					$META_INPUT_DATA = $data;



			}else{



				$PageTitle = $SubSub_Lang['search'];

				$cList = ListCats();

				$show_page = 'home';



			}



			

		}else{



			$PageTitle = $SubSub_Lang['search'];

			$cList = ListCats();

			$show_page = 'home';

				

		}

	} break;


	/**
	* Page: CRYPTO CURRENCY
	* @version  13.0
	* @created  FRI 6 Oct 2017
	* @related  inc/func/func_subscribe.php & inc/payment/*
	*/

	case "cryptoconvert":{

		$SubSub_Lang = $LANG_UPGRADE_MENU;
		$PageTitle = $SubSub_Lang[$sub_page];
		$PageDesc = $SubSub_Lang[$sub_page."_?"];

		## Call Page Functions
		require_once('inc/func/func_upgrade_page.php');		

		$Access_Page_Settings= array('home','bank','matrix');

		if($_SESSION['auth'] =="yes" && is_numeric($_SESSION['uid'])){ $lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); }  /*In order to display sidebar on Membership page*/

		// Determin Display Page
		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Settings)){

			$show_page = $sub_page;

			if($sub_page =="bank" && isset($_GET['packageid']) && is_numeric($_GET['packageid'])){

				$bank_price =DisplayBankPrice($_GET['packageid']);
				$bank_data = DisplayBankPayment();

			}elseif($sub_page =="matrix"){

				$PACKARRAY = array();
				$i=1;

				$result = $DB->Query("SELECT currency_code, price, pid, name FROM package WHERE visible=1 AND type='custom' AND icon !='SMS' ORDER BY price ASC");

				while( $package = $DB->NextRow($result) ) {

					$PACKARRAY[$i]['id'] 	=	$package['pid'];
					$PACKARRAY[$i]['name'] 	=	$package['name'];
					$PACKARRAY[$i]['currency_code'] 	=	$package['currency_code'];
					$PACKARRAY[$i]['price'] 	=	$package['price'];
					$i++;

				}


				$PAGE_ARRAY = array(
					"account" => $LANG_ACCOUNT_MENU,
					"messages" => $LANG_MESSAGES_MENU,
					"gallery" => $LANG_GALLERY_MENU,
					"settings" => $LANG_SETTINGS_MENU,
					"calendar" => $LANG_EVENTS_MENU,
					"groups" => $LANG_GROUPS_MENU,
					"7" => $LANG_CLASSADS_MENU,
					"8" => $LANG_BLOG_MENU,
					"9" => $LANG_LINKS_MENU,
					"10" => $LANG_CHAT_MENU,
					"11" => $LANG_CONTACT_MENU,
					"12" => $LANG_SITEMAP_MENU,
					"13" => $LANG_UPGRADE_MENU,
					"games" => $LANG_1GAME_MENU,
					"matches" => $LANG_MATCH_MENU,
					"music" => $LANG_MUSIC_MENU,
					"videos" => $LANG_VIDEO_MENU,
				);

				$show_page = 'matrix';

			}else{

				$show_page = 'home';

				$stripe_mode = $DB->Row("SELECT md.value as mode FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like 'stripe_mode'");

				if(isset($stripe_mode)){

					if($stripe_mode['mode'] == 'Test'){
						$key = 'test_publishable';
					}
					else if($stripe_mode['mode'] == 'Live'){
						$key = 'live_publishable';
					}


					$publishable = $DB->Row("SELECT md.value as value FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like $key");
					
					if(isset($publishable['value'])){
						$stripe_publishable = $publishable['value'];
						
					}	
				}
				
				$member_email = $DB->Row("SELECT email FROM members WHERE id = '".$_SESSION['uid']."'");

				if(isset($member_email['email'])){
					$member_email = $member_email['email'];
				}
				else{
					$member_email = '';
				}

				$show_packages = DisplayPackages();

				$show_payment_types = DisplayPaymentCode();

			}

		}else{		

			$show_page = 'home';

			$stripe_mode = $DB->Row("SELECT md.value as mode FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like 'stripe_mode'");

			if(isset($stripe_mode)){

				if($stripe_mode['mode'] == 'Test'){
					$key = 'test_publishable';
				}
				else if($stripe_mode['mode'] == 'Live'){
					$key = 'live_publishable';
				}


				$publishable = $DB->Row("SELECT md.value as value FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like '$key'");
				
				if(isset($publishable['value'])){
					$stripe_publishable = $publishable['value'];
					
				}

				
			}
			
			$member_email = $DB->Row("SELECT email FROM members WHERE id = '".$_SESSION['uid']."'");

			if(isset($member_email['email'])){
				$member_email = $member_email['email'];
			}
			else{
				$member_email = '';
			}
			
			$show_packages = DisplayPackages();
			$show_payment_types = DisplayPaymentCode();

		}

	} break;	

	case "cryptopayment":{

		$SubSub_Lang = $LANG_UPGRADE_MENU;
		$PageTitle = $SubSub_Lang[$sub_page];
		$PageDesc = $SubSub_Lang[$sub_page."_?"];

		## Call Page Functions
		require_once('inc/func/func_upgrade_page.php');		

		$Access_Page_Settings= array('home','bank','matrix');

		if($_SESSION['auth'] =="yes" && is_numeric($_SESSION['uid'])){ $lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); }  /*In order to display sidebar on Membership page*/

		// Determin Display Page
		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Settings)){

			$show_page = $sub_page;

			if($sub_page =="bank" && isset($_GET['packageid']) && is_numeric($_GET['packageid'])){

				$bank_price =DisplayBankPrice($_GET['packageid']);
				$bank_data = DisplayBankPayment();

			}elseif($sub_page =="matrix"){

				$PACKARRAY = array();
				$i=1;

				$result = $DB->Query("SELECT currency_code, price, pid, name FROM package WHERE visible=1 AND type='custom' AND icon !='SMS' ORDER BY price ASC");

				while( $package = $DB->NextRow($result) ) {

					$PACKARRAY[$i]['id'] 	=	$package['pid'];
					$PACKARRAY[$i]['name'] 	=	$package['name'];
					$PACKARRAY[$i]['currency_code'] 	=	$package['currency_code'];
					$PACKARRAY[$i]['price'] 	=	$package['price'];
					$i++;

				}

				$PAGE_ARRAY = array(
					"account" => $LANG_ACCOUNT_MENU,
					"messages" => $LANG_MESSAGES_MENU,
					"gallery" => $LANG_GALLERY_MENU,
					"settings" => $LANG_SETTINGS_MENU,
					"calendar" => $LANG_EVENTS_MENU,
					"groups" => $LANG_GROUPS_MENU,
					"7" => $LANG_CLASSADS_MENU,
					"8" => $LANG_BLOG_MENU,
					"9" => $LANG_LINKS_MENU,
					"10" => $LANG_CHAT_MENU,
					"11" => $LANG_CONTACT_MENU,
					"12" => $LANG_SITEMAP_MENU,
					"13" => $LANG_UPGRADE_MENU,
					"games" => $LANG_1GAME_MENU,
					"matches" => $LANG_MATCH_MENU,
					"music" => $LANG_MUSIC_MENU,
					"videos" => $LANG_VIDEO_MENU,
				);

				$show_page = 'matrix';

			}else{

				$show_page = 'home';

				$stripe_mode = $DB->Row("SELECT md.value as mode FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like 'stripe_mode'");

				if(isset($stripe_mode)){

					if($stripe_mode['mode'] == 'Test'){
						$key = 'test_publishable';
					}
					else if($stripe_mode['mode'] == 'Live'){
						$key = 'live_publishable';
					}


					$publishable = $DB->Row("SELECT md.value as value FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like $key");
					
					if(isset($publishable['value'])){
						$stripe_publishable = $publishable['value'];
						
					}	
				}
				
				$member_email = $DB->Row("SELECT email FROM members WHERE id = '".$_SESSION['uid']."'");

				if(isset($member_email['email'])){
					$member_email = $member_email['email'];
				}
				else{
					$member_email = '';
				}

				$show_packages = DisplayPackages();
				$show_payment_types = DisplayPaymentCode();
			
			}

		}else{		

			$show_page = 'home';
			$stripe_mode = $DB->Row("SELECT md.value as mode FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like 'stripe_mode'");

			if(isset($stripe_mode)){

				if($stripe_mode['mode'] == 'Test'){
					$key = 'test_publishable';
				}
				else if($stripe_mode['mode'] == 'Live'){
					$key = 'live_publishable';
				}


				$publishable = $DB->Row("SELECT md.value as value FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like '$key'");
					
				if(isset($publishable['value'])){
					$stripe_publishable = $publishable['value'];
					
				}

				
			}
			$member_email = $DB->Row("SELECT email FROM members WHERE id = '".$_SESSION['uid']."'");

			if(isset($member_email['email'])){
				$member_email = $member_email['email'];
			}
			else{
				$member_email = '';
			}
				
			$show_packages = DisplayPackages();

			$show_payment_types = DisplayPaymentCode();

		}

	} break;


	/**

	* Page: MEMBER UPGRADE PAGE

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  inc/func/func_subscribe.php & inc/payment/*

	*/



	case "subscribe":{



		$SubSub_Lang = $LANG_UPGRADE_MENU;

		$PageTitle = $SubSub_Lang[$sub_page];

		$PageDesc = $SubSub_Lang[$sub_page."_?"];



		## Call Page Functions

		require_once('inc/func/func_upgrade_page.php');		

		$Access_Page_Settings= array('home','bank','matrix');

		if($_SESSION['auth'] =="yes" && is_numeric($_SESSION['uid'])){ $lastViewed =  MyLastVisitedProfile($_SESSION['uid'],2); }  /*In order to display sidebar on Membership page*/

		// Determin Display Page

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Settings)){

				

			$show_page = $sub_page;



			if($sub_page =="bank" && isset($_GET['packageid']) && is_numeric($_GET['packageid'])){

				

				$bank_price =DisplayBankPrice($_GET['packageid']);

				$bank_data = DisplayBankPayment();





			}elseif($sub_page =="matrix"){



				$PACKARRAY = array();

				$i=1;

			

				$result = $DB->Query("SELECT currency_code, price, pid, name FROM package WHERE visible=1 AND type='custom' AND icon !='SMS' ORDER BY price ASC");

				while( $package = $DB->NextRow($result) )

				{

					$PACKARRAY[$i]['id'] 	=	$package['pid'];

					$PACKARRAY[$i]['name'] 	=	$package['name'];

					$PACKARRAY[$i]['currency_code'] 	=	$package['currency_code'];

					$PACKARRAY[$i]['price'] 	=	$package['price'];

					$i++;

				}

			 

				$PAGE_ARRAY = array(

					"account" => $LANG_ACCOUNT_MENU,

					"messages" => $LANG_MESSAGES_MENU,

					"gallery" => $LANG_GALLERY_MENU,

					"settings" => $LANG_SETTINGS_MENU,

					"calendar" => $LANG_EVENTS_MENU,

					"groups" => $LANG_GROUPS_MENU,

					"7" => $LANG_CLASSADS_MENU,

					"8" => $LANG_BLOG_MENU,

					"9" => $LANG_LINKS_MENU,

					"10" => $LANG_CHAT_MENU,

					"11" => $LANG_CONTACT_MENU,

					"12" => $LANG_SITEMAP_MENU,

					"13" => $LANG_UPGRADE_MENU,

					"games" => $LANG_1GAME_MENU,

					"matches" => $LANG_MATCH_MENU,

					"music" => $LANG_MUSIC_MENU,

					"videos" => $LANG_VIDEO_MENU,

				);

				$show_page = 'matrix';





			}else{



				$show_page = 'home';

				$stripe_mode = $DB->Row("SELECT md.value as mode FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like 'stripe_mode'");

				if(isset($stripe_mode)){

					if($stripe_mode['mode'] == 'Test'){
						$key = 'test_publishable';
					}
					else if($stripe_mode['mode'] == 'Live'){
						$key = 'live_publishable';
					}


					$publishable = $DB->Row("SELECT md.value as value FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like $key");
					
					if(isset($publishable['value'])){
						$stripe_publishable = $publishable['value'];
						
					}	
				}
				
				$member_email = $DB->Row("SELECT email FROM members WHERE id = '".$_SESSION['uid']."'");

				if(isset($member_email['email'])){
					$member_email = $member_email['email'];
				}
				else{
					$member_email = '';
				}

				$show_packages = DisplayPackages();

				$show_payment_types = DisplayPaymentCode();



			}

			

		}else{		

				

			$show_page = 'home';

			$stripe_mode = $DB->Row("SELECT md.value as mode FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like 'stripe_mode'");

				if(isset($stripe_mode)){

					if($stripe_mode['mode'] == 'Test'){
						$key = 'test_publishable';
					}
					else if($stripe_mode['mode'] == 'Live'){
						$key = 'live_publishable';
					}


					$publishable = $DB->Row("SELECT md.value as value FROM merchant_data md, merchant m WHERE md.mid = m.id and m.name='Stripe' and md.name like '$key'");
					
					if(isset($publishable['value'])){
						$stripe_publishable = $publishable['value'];
						
					}

					
				}
				$member_email = $DB->Row("SELECT email FROM members WHERE id = '".$_SESSION['uid']."'");

				if(isset($member_email['email'])){
					$member_email = $member_email['email'];
				}
				else{
					$member_email = '';
				}
				
			$show_packages = DisplayPackages();

			$show_payment_types = DisplayPaymentCode();



		}



					

	} break;	





	/**

	* Page: COMMUNITY FORUM LINKED VIA AN IFRAME

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  /inc/exe/forum/

	*/

	case "forum":{

	

		if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("chatroom-forum",$PACKAGEACCESS[$_SESSION['packageid']]) ){

			header("location: ".getThePermalink("subscribe")); exit();

		}



		$SubSub_Lang = $LANG_FORUM_MENU;

		$PageTitle = $LANG_FORUM_MENU[''];

		$PageDesc = $LANG_FORUM_MENU["_?"];

		

		/* VBULLETIN INTEGRATION */

		if(FORUM_VB_ENABLED =="yes" && !isset($_SESSION['vb_login_complete'])){

			

			define('THIS_SCRIPT', 'login');

			define('CWD',FORUM_VB_ROOTPATH);

			require_once('./'.FORUM_VB_ROOTPATH.'global.php');

			require_once('./'.FORUM_VB_ROOTPATH.'includes/functions_login.php');

			$vbulletin->userinfo = $vbulletin->db->query_first("SELECT userid,usergroupid, membergroupids, infractiongroupids, username, password, salt FROM " . TABLE_PREFIX . "user

			WHERE username = ('".strip_tags(trim(strtolower($_SESSION['username'])))."') LIMIT 1");	

					

			if ($vbulletin->userinfo['userid']){

						vbsetcookie('userid', $vbulletin->userinfo['userid'], true, true, true);

						vbsetcookie('password', md5($vbulletin->userinfo['password'] . COOKIE_SALT), true, true, true);

						process_new_login('cplogin', TRUE, TRUE);

						$_SESSION['vb_login_complete'] = true;

			}				

		}

		/* END LOGIN INTEGRATION */

		

		## WHICH FORUM LINK?

		if(FORUM_DEFAULT_ENABLED =="yes"){

			$forum_link = FORUM_DEFAULT_LINK;

		}elseif(FORUM_VB_ENABLED=="yes"){

			$forum_link = FORUM_VB_LINK;

		}elseif(FORUM_PHPBB_ENABLED=="yes"){

			$forum_link = FORUM_PHPBB_LINK;

		}else{			

			$forum_link = FORUM_DEFAULT_LINK;

			//$ForumListArray = GetForumListCats();

		}		

		require_once('inc/func/func_forums_page.php');

		$ForumListArray = GetForumListCats();



		$show_page = 'home';

		$_SESSION['Meta_Charset'] = isset($HEADER_META_CHARSET);

		$_SESSION['Css_File'] = DB_DOMAIN."inc/css/_forum.css";



	} break;

	

//////////////////////////////////////////

/////// AFFILIATE PAGES //////////////////



	 /**

	 * Page: Affiliate System

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	case "affiliate":{		



 

		$SubSub_Lang =$LANG_AFFILIATE_MENU;

		$GLOBALS['LANG_AFFILIATE'] = $LANG_AFFILIATE_PAGE;		



 		## set the menu flag

		$GLOBALS['MENU_AFFILIATE'] = 'yes';



		if(isset($_SESSION['aff_auth']) && $_SESSION['aff_auth'] =="yes"){

			$GLOBALS['affiliate_login'] = true;

		}else{

			$GLOBALS['affiliate_login'] = false;

		}



		## CREATE PAGE DATA	

		require_once "inc/classes/class_regimg.php";	

		$obj = new SPAF_FormValidator();



		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			require_once('inc/func/func_affiliate.php');

			$Error_Report =  ChangeDo($_POST['do'], $_POST, $obj);

		}



		## Call Page Functions

		require_once('inc/func/func_affiliate_page.php');			



		// Define Page Array

		$Access_Page_Affiliate = array('login','join','summary','banners','edit','payment');

		

		if($GLOBALS['affiliate_login'] == true && $sub_page ==""){

		$sub_page="summary";

		}

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Affiliate)){



			$show_page = $sub_page;



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];

			

			if($sub_page =="summary"){

			

			}elseif($sub_page =="join"){

				$reg_countries =  GetCountries();			

			}elseif($sub_page =="edit"){

				$editArray = GetData();

				$edit_content =  GetPages('edit');

				$reg_countries =  GetCountries($editArray['country']);

				$adata = $editArray;

			}elseif($sub_page =="payment"){

				$payment_content = GetPages('payment');

				 

			}

			

		}else{

			$show_page = 'home';

			$index_content = GetPages('home');

			$PageTitle = $GLOBALS['LANG_AFFILIATE']['a1'];

		}

		

	} break;





	/**

	* Page: MEMBER GAMES PAGE

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  inc/func/func_games_page.php

	*/



	case "games":{

 

		$SubSub_Lang = $LANG_1GAME_MENU;

 



		require_once('inc/func/func_games_page.php');



		// Define Page Array

		$Access_Page_Affiliate = array('play','top','search');

		

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Affiliate)){



			$show_page = $sub_page;



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];

			

			if($sub_page =="play"){



				//MustBeLoggedIn();

 				$gd = PlayGame($item_id);

				$PageTitle = isset($gd['game']) ? $gd['game'] : '';

				$OtherGames = DisplayRecentGames(10);

 

				$data['title'] = isset($gd['gname']) ? $gd['gname'] : '';

				$data['description'] = isset($gd['about']) ? $gd['about'] : '';

				$META_INPUT_DATA = $data;



			}elseif($sub_page =="top"){



			$Leader_Data = LeaderBoard();





			}elseif($sub_page =="search"){



											

					$search_data = GamesList($_POST, $_GET, $search_page); 						

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

					if(!isset($search_data[count($search_data)]['TotalResults'])){ 

						$search_total_results=0;					

					}else{ 					

						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);

					}	

			}

		}else{

			header("location: ".getThePermalink('games/search'));
			exit();

		}

	} break;



	 /**

	 * Page: Articles 

	 *

	 * @version  9.0

	 * @created  June 1st, 2008

	 * @updated  June 1st, 2008

	 */

	case "articles":{


		$sub_lang_page ="";
		
		$pagination = 1;
		if(isset($_GET['p']) && $_GET['p'] != ""){
			$pagination = $_GET['p'];
		}

		$pagination--;

		$SubSub_Lang = $LANG_ARTICLES_MENU;
		//$PageTitle = $SubSub_Lang[$sub_page];
		$PageTitle = $SubSub_Lang[$sub_lang_page];

		$PageDesc = $SubSub_Lang[$sub_lang_page."_?"];	

		$GLOBALS['MENU_ARTICLES'] = 1; // gets the menu flag to display the categories (see inc/templates/layout/menu.php)

		## Define Page title and menu
		if (isset($LANG_ARTICLES)!=''){$LANG_ARTICLES_1=$LANG_ARTICLES;}else{$LANG_ARTICLES_1=isset($LANG_ARTICLES);}
		$SubSub_Lang = $LANG_ARTICLES_1;

		require_once('inc/func/func_articles_page.php');


		// TOP 10 ARTICLES
		$article_top10 = DisplayTop10Articles();

		// ARTICLE CATEGORIES		
		$article_cats = DisplayArticleCats();

		// Define Page Array
		$Access_Page_Article = array('view');	

		if(isset($_GET['id'])&& is_numeric($_GET['id']) && $item_id ==""){ $item_id = $_GET['id']; }

		

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Article)){

			## Call Page Functions
			$show_page = $sub_page;

			//if(is_numeric($item_id) && $item_id !=0)
			if(!is_numeric($item_id) && $item_id != ""){

				$article_data = GetArticleData($item_id);

				$prev_article = GetPrevArticleData($item_id);
				$next_article = GetNextArticleData($item_id);
				$PageTitle = $article_data['name'];

			
			}else{

				$show_page = 'home';

			}

			$data['title'] = $article_data['title'];
			$data['name'] = $article_data['name'];
			$data['description'] = $article_data['content'];
			$META_INPUT_DATA = $data;

		}else{

			if(isset($item2_id) && is_numeric($item2_id)){

				$article_array = DisplayArticles($item2_id, $pagination); $DataCounter= count($article_array);
				// TOTAL CATEGORY ARTICLES
				$total_articles = GetTotalArticles($item2_id);
				
			}else{

				$article_array = DisplayArticles(0,$pagination); $DataCounter= count($article_array);
				// TOTAL CATEGORY ARTICLES
				$total_articles = GetTotalArticles();
			}	
			$show_page = 'home';

		}	

	} break;





	/**

	* Page: DISPLAYS MEMBER VIDEOS MIXED WITH YOUTUBE IF PLUGIN ADDED

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  inc/func/func_videos_page.php

	*/



	case "videos":{



		

		## Define Page title and menu

		$SubSub_Lang = $LANG_VIDEO_MENU;

		

		require_once('inc/func/func_videos_page.php');



		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

				require_once('inc/func/func_videos.php');

				$Error_Report =  ChangeDo($_POST['do'], $_POST);

		}



		if($sub_page =="myvideos" && $_SESSION['auth'] =="yes"){

			$sub_page ="search"; $search_uid = $_SESSION['uid'];

		}



		// Define Page Array

		$Access_Page_Videos = array('view','search');	

		if(!isset($sub_page)){ $sub_page="search"; }

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Videos)){

		

			$show_page = $sub_page;

			## Call Page Functions



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];



			if(isset($_GET['id']) && strlen($_GET['id']) < 15 ){ $item_id = $_GET['id'];}



			if($sub_page =="view" && isset($item_id) && strlen($item_id) < 15 ){



				MustBeLoggedIn();

				$video = GetSingleVideo($item_id);

				

				if($video ==0){ 

					header("location: ".DB_DOMAIN."index.php?dll=videos&sub=search&errorid=Sorry this video file is currently offline. Please try another."); 

					exit();

				}





			$PageTitle = $video['title'];

			// AUTO META TAGS DATA	

			$META_INPUT_DATA = $video;



			}elseif($sub_page =="search"){





					## DISPLAY THE SEARCH MEMBER BAR

					if(isset($search_uid) && is_numeric($search_uid)){

						$ThisPersonsNetworkBar = ShowFCIDMEmber($search_uid);

					}



					## GET SEARCH DATA								

					$search_data = GetVideos($_POST, $_GET, $search_page, $search_uid); 

 	 

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page,true);



					/*if(!isset($search_data[1]['TotalResults']) && isset($search_data[2]['TotalResults']) ){

					$CounTT = $search_data[2]['TotalResults'];

					

					}else{

					$CounTT = $search_data[1]['TotalResults'];

					}					



					$search_total_results = number_format($CounTT);*/
					if(!isset($search_data[count($search_data)]['TotalResults'])){ 
						$search_total_results=0;					
					}else{ 					
						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);
					}

					 			 



			}else{



			header("location: ".getThePermalink('videos/search'));

			exit();



			}		

						

		

		}else{



			header("location: ".getThePermalink('videos/search'));

			exit();



		}









			

	} break;

	 /**

	 * Page: Groups Page 

	 *

	 * @version  9.0

	 * @created  April 12, 2008

	 * @updated  April 12, 2008

	 */

	case "groups":{	 





		if( D_GROUPS !=1 ){

				header("location: ".getThePermalink("subscribe")); exit();

		}

	

		## Define Page title and menu

		$PageTitle = $GLOBALS['_LANG']['_groups'];

		$SubSub_Lang = $LANG_GROUPS_MENU;

		

		require_once('inc/func/func_groups_page.php');

		

		## PERFORM OPERATION

		if(isset($_POST['do'])){ 



				require_once('inc/func/func_groups.php');

				$Error_Report =  ChangeDo($_POST['do'], $_POST);



				// redirect user

				if(isset($_POST['sub'])){

					$ExtraSendData = BuildExtraReturnString($_POST);

					header("location: ".DB_DOMAIN."index.php?dll=".$page."&sub=".$_POST['sub'].$ExtraSendData."&errorid=".$Error_Report);

					exit();

				}

		}	

 

		// Define Page Array

		$Access_Page_Calendar = array('add','manage','view','show','posts','search');

		

		## SET FORM DATA TO RETURN TO PAGE

		if(isset($_POST['gid']) && is_numeric($_POST['gid'])){

			$_GET['gid'] = $_POST['gid'];

		}

		if(isset($_POST['tid']) && is_numeric($_POST['tid'])){

			$_GET['tid'] = $_POST['tid'];

		}

				

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Calendar)){

		

			$show_page = $sub_page;

			## Call Page Functions



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];



			

			if($show_page =="view" && isset($item_id) && is_numeric($item_id)  ){

			

				if(!is_numeric($search_uid)){

					$Group_Details = GroupDetails($item_id);					

					

				}else{

					 

					$ThisPersonsNetworkBar = ShowFCIDMEmber($_SESSION['uid']);

				}				

					## GET SEARCH DATA							

					if(is_numeric($item_id)){ $_GET['gid'] = $item_id; }						

					$search_data = DisplayGroups($_POST, $_GET, $search_page, $search_uid); 	

					  

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

					if(!isset($search_data[count($search_data)]['TotalResults'])){ 

						$search_total_results=0;					

					}else{ 					

						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);

					}						

 

					 

					$PageSubTitle = isset($Group_Details) ? $Group_Details : '';

					// AUTO META TAGS DATA	

					$data['name'] 	= $PageSubTitle;

					$META_INPUT_DATA = $data;





			}elseif($show_page =="show" && ( isset($item_id) && is_numeric($item_id) ) ){			



				MustBeLoggedIn();

				$info_array 	= GroupInnerDetails($item_id);

				$PageTitle 		= $info_array['name'];

				$member_array 	= DisplayNetwork($item_id);		



				// AUTO META TAGS DATA		

				$META_INPUT_DATA = $info_array;



			}elseif($show_page =="manage"){ //&& !isset($_SESSION['site_moderator_approve'])



			header("location: ".DB_DOMAIN."index.php?dll=groups&sub=view&item_id=100&fcid=".$_SESSION['uid']);

			exit();



			}elseif($show_page =="add"){



				

				MustBeLoggedIn();

				if(isset($_GET['eid']) && is_numeric($_GET['eid'])){

					$data = EditGroupDetails($_GET['eid']);

				}

				$my_image_array = DisplayMyPhotos($_SESSION['uid']);

 

				## album attachment				

				if(isset($data)){ $AttachmentAlbum=$data['attachment']; }else{$AttachmentAlbum=0; } 

				$AlbumList = GetAlbums($_SESSION['uid'],$AttachmentAlbum);





			}elseif($show_page =="search"){



			

				$group_cats = DisplayCats();			



	

			}else{

				$PageTitle = $GLOBALS['_LANG']['_groups'];

				$group_cats = DisplayCats();

				$show_page = 'search';

			}

		

		}else{

			

			$show_page = 'home';

		}	



	} break;

	 /**

	 * Page: Calendar 

	 *

	 * @version  9.0

	 * @created  April 12, 2008

	 * @updated  April 12, 2008

	 */

	case "calendar":{





	if( ( isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array("calendar-events",$PACKAGEACCESS[$_SESSION['packageid']]) ) || D_EVENTS !=1 ){

			header("location: ".getThePermalink("subscribe")); exit();

	}



	## Define Page title and menu

	$SubSub_Lang = $LANG_EVENTS_MENU;

				

	$PageTitle = $GLOBALS['LANG_GLO_OPTIONS']['41'];

	$PageDesc = $SubSub_Lang["events_?"];

		

	## PERFORM OPERATION

	if(isset($_POST['do'])){ 

			require_once('inc/func/func_calendar.php');

			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);



			// redirect user

			if(isset($_POST['sub'])){

				$ExtraSendData = BuildExtraReturnString($_POST);

				header("location: ".DB_DOMAIN."index.php?dll=".$page."&sub=".$_POST['sub'].$ExtraSendData."&errorid=".$Error_Report);

				exit();

			}

	}

	## Call Page Functions

	require_once('inc/func/func_calendar_page.php');

	

	## load event types

	$cList = ListCats();



		// Define Page Array

		$Access_Page_Calendar = array('add','view','manage','search');

		

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Calendar)){

		

			$show_page = $sub_page;	



					

			if($sub_page =="view" && is_numeric($item_id)){

				$_GET['eventid'] = $item_id;

				MustBeLoggedIn();
				$_POST = $_REQUEST;

				$today_events = GetEvents($_POST, $_GET, $search_page);

				$event_members = GetAttending($item_id);

				// AUTO META TAGS DATA	
				if (isset($data['title'])) {

				$today_events[1]['shortevent'];
			}
			if (isset($data['description'])) {

			 $today_events[1]['longevent'];
				
			}
			if (isset($data['name'])) {

			 $today_events[1]['name'];
				
			}

			$META_INPUT_DATA = $data;

			}elseif($sub_page =="add"){



				MustBeLoggedIn();

				if(isset($_GET['eid']) && is_numeric($_GET['eid'])){

					$data = EditThis($_GET['eid']);

				}

				$my_image_array = DisplayMyPhotos($_SESSION['uid']);



				## album attachment

				if(isset($data)){ $AttachmentAlbum= isset($data['attachment']) ? $data['attachment'] : ''; }else{$AttachmentAlbum=0; } 

				$AlbumList = GetAlbums($_SESSION['uid'],$AttachmentAlbum);





			}elseif($sub_page =="search" || ( $sub_page =="manage" && $_SESSION['auth'] =="yes") ){



					// if manage only show my listing

					 if($sub_page =="manage"){

							$search_uid =$_SESSION['uid'];

					}



					## DISPLAY THE SEARCH MEMBER BAR

					if(isset($search_uid) && is_numeric($search_uid)){

						$ThisPersonsNetworkBar = ShowFCIDMEmber($search_uid);

					}



					if(is_numeric($item_id)){ $_GET['type'] = $item_id; }						

					$search_data = GetEvents($_POST, $_GET, $search_page, $search_uid); 	

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

					if(!isset($search_data[count($search_data)]['TotalResults'])){ 

						$search_total_results=0;					

					}else{ 					

						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);

					}	

					



			}else{

				$show_page = 'home';

			}

		

		}else{



			$show_page = 'home';

			

		}	

	

	} break;





	/**

	* Page: MUSIC PAGE DISPLAYS ALL MEMBER MUSIC FILES

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  inc/func/func_music_page.php

	*/



	case "music":{



		if( D_MUSIC !=1 ){

				header("location: ".getThePermalink("subscribe")); exit();

		}

	

		## Define Page title and menu

		$SubSub_Lang = $LANG_MUSIC_MENU;

		$GLOBALS['LANG_MUSIC'] = $LANG_MUSIC;



		// Define Page Array

		$Access_Page_Calendar = array('search','view');

	

		## Call Page Functions

		require_once('inc/func/func_music_page.php');

	

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Calendar)){

		

			$show_page = $sub_page;			



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];

					

			if($sub_page =="search" || $sub_page =="view" ){

			



			if($sub_page =="view"){

				$ShowMyFiles = true;

			}else{

				$ShowMyFiles=false;

			} 



 				

					$search_data = GetMusic($_POST, $_GET, $search_page, $ShowMyFiles); 						

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

					if(!isset($search_data[count($search_data)]['TotalResults'])){ 

						$search_total_results=0;					

					}else{ 					

						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);

					}				

	



			}

		}else{



			header("location: ".getThePermalink('music/search'));

			exit();

		

		}



	} break;



	 /**

	 * Page: Blog 

	 *

	 * @version  9.0

	 * @created  April 12, 2008

	 * @updated  April 12, 2008

	 */

	case "blog":{



		

		## Define Page title and menu

		$SubSub_Lang = $LANG_BLOG_MENU;



		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			require_once('inc/func/func_blog.php');

			$Error_Report =  ChangeDo($_POST['do'], $_POST, $_FILES);



		}



		// Define Page Array

		$Access_Page_Messages= array('add','comments','view','search');



		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Messages)){

	

			require_once('inc/func/func_blog_page.php');



			$show_page = $sub_page;

	

			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];

		

			if($sub_page =="add"){



				MustBeLoggedIn();



				## CHECK FOR BLOG EDIT

				if(isset($_POST['eid']) && is_numeric($_POST['eid']) && $_POST['eid'] != 0){ 

					$edit_array = GetBlogPostDetails($_POST['eid'], $_SESSION['uid']);

				}



				$my_image_array = DisplayMyPhotos($_SESSION['uid']);



				## album attachment				

				if(isset($edit_array)){ $AttachmentAlbum=$edit_array['attachment']; }else{$AttachmentAlbum=0; } 

				$AlbumList = GetAlbums($_SESSION['uid'],$AttachmentAlbum);



			}elseif($sub_page =="search" || ($sub_page =="view" && $_SESSION['auth'] =="yes" ) ){	



					## if manage only show my listing

					 if($sub_page =="view"){

							$search_uid =$_SESSION['uid'];

					}



					## DISPLAY THE SEARCH MEMBER BAR

					if(isset($search_uid) && is_numeric($search_uid)){

						$ThisPersonsNetworkBar = ShowFCIDMEmber($search_uid);

					}



					$search_data = DisplayBlogs($_POST, $_GET, $search_page, $search_uid);					 

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

					$search_data[count($search_data)]['TotalResults'] =(isset($search_data[count($search_data)]['TotalResults'])) ? $search_data[count($search_data)]['TotalResults'] : '';
					
					$search_total_results = (isset($search_data[count($search_data)]['TotalResults'])) ? number_format($search_data[count($search_data)]['TotalResults']) : '' ;

					

			}



		}else{

	

		$show_page='home';

	

		}





	} break;





	/**

	* Page: MEMBER CHAT ROOM

	*

	* @version  9.0

	* @created  Sat 25 Oct  2008

	* @related  inc/exe/ChatRoom/

	*/

	case "chatroom":{



			MustBeLoggedIn();

			$PackageString="chatroom-chatroom";

			if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && in_array($PackageString,$PACKAGEACCESS[$_SESSION['packageid']])){ 

 

				header("location: ".getThePermalink("subscribe"));

				exit();

			}



			## define the page title and description

			$SubSub_Lang = $LANG_CHAT_MENU;

			$PageTitle = $SubSub_Lang[$page];

			$PageDesc = $SubSub_Lang[$page."_?"];



	} break;


	case "gdpr":{


		
		require_once('inc/func/func_csvdwonloade.php');

		//CsvDownload($_SESSION['uid'])
		$GdprDwonlode= GdprDwonlode($_SESSION['uid']);
		


		CsvDownload($GdprDwonlode);


		
		
	} break;





	 /**

	 * Page: Links Page

	 *

	 * @version  9.0

	 * @created  April 12, 2008

	 * @updated  April 12, 2008

	 */

	case "interests":{



			$SubSub_Lang = $LANG_LINKS_MENU;

			## define the page title and description

			$PageTitle = $SubSub_Lang[$page];

			$PageDesc = $SubSub_Lang[$page."_?"];



			$PageTitle ="Interests";



		require_once('inc/func/func_interests_page.php');

		

		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

				require_once('inc/func/func_groups.php');

				$Error_Report =  ChangeDo($_POST['do'], $_POST);

		}	

 

		// Define Page Array

		$Access_Page_Calendar = array('add','manage','view','show','posts','search');

		

		## SET FORM DATA TO RETURN TO PAGE

		if(isset($_POST['gid']) && is_numeric($_POST['gid'])){

			$_GET['gid'] = $_POST['gid'];

		}

		if(isset($_POST['tid']) && is_numeric($_POST['tid'])){

			$_GET['tid'] = $_POST['tid'];

		}

				

		if(isset($sub_page) && in_array(strip_tags($sub_page),$Access_Page_Calendar)){

		

			$show_page = $sub_page;

			## Call Page Functions



			## define the page title and description

			$PageTitle = $SubSub_Lang[$sub_page];

			$PageDesc = $SubSub_Lang[$sub_page."_?"];



			

			if($show_page =="view" && isset($item_id) && is_numeric($item_id)  ){

			

				if(!is_numeric($search_uid)){

					$Group_Details = GroupDetails($item_id);					

					

				}else{

					 

					$ThisPersonsNetworkBar = ShowFCIDMEmber($_SESSION['uid']);

				}				

					## GET SEARCH DATA							

					if(is_numeric($item_id)){ $_GET['gid'] = $item_id; }						

					$search_data = DisplayGroups($_POST, $_GET, $search_page, $search_uid); 	

					  

					$Search_Page_Numbers = MakePageNumerDisplay($search_data,$search_page);

					if(!isset($search_data[count($search_data)]['TotalResults'])){ 

						$search_total_results=0;					

					}else{ 					

						$search_total_results = number_format($search_data[count($search_data)]['TotalResults']);

					}						

 

					 

					$PageSubTitle = $Group_Details;

					// AUTO META TAGS DATA	

					$data['name'] 	= $PageSubTitle;

					$META_INPUT_DATA = $data;





			}elseif($show_page =="show" && ( isset($item_id) && is_numeric($item_id) ) ){			



				MustBeLoggedIn();

				$info_array 	= GroupInnerDetails($item_id);

				$PageTitle 		= $info_array['name'];

				$member_array 	= DisplayNetwork($item_id);		



				// AUTO META TAGS DATA		

				$META_INPUT_DATA = $info_array;



			}elseif($show_page =="manage"){ //&& !isset($_SESSION['site_moderator_approve'])

				header("location: ".DB_DOMAIN."index.php?dll=interests&sub=view&item_id=100&fcid=".$_SESSION['uid']);
				exit();

			}elseif($show_page =="add"){

				MustBeLoggedIn();

				if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
					$data = EditGroupDetails($_GET['eid']);
				}

				$my_image_array = DisplayMyPhotos($_SESSION['uid']);


				## album attachment				

				if(isset($data)){ $AttachmentAlbum=$data['attachment']; }else{$AttachmentAlbum=0; } 

				$AlbumList = GetAlbums($_SESSION['uid'],$AttachmentAlbum);

			}elseif($show_page =="search"){

				$group_cats = DisplayCats();			

			}else{

				$PageTitle = $GLOBALS['_LANG']['_groups'];

				$group_cats = DisplayCats();

				$show_page = 'search';

			}

		}else{

			$show_page = 'home';

		}	

	} break;


	 /**
	 * Page: Site Map
	 *
	 * @version  9.0
	 * @created  April 12, 2008
	 * @updated  April 12, 2008
	 */

	case "map":{

		$sub_page="";
		$SubSub_Lang = $LANG_SITEMAP_MENU;
		$PageTitle = $SubSub_Lang[$sub_page];
		$PageDesc = $SubSub_Lang[$sub_page."_?"];

	} break;


	 /**
	 * Page: Links Page
	 *
	 * @version  9.0
	 * @created  April 12, 2008
	 * @updated  April 12, 2008
	 */

	case "links":{

			$SubSub_Lang = $LANG_LINKS_MENU;

			## define the page title and description
			$PageTitle = $SubSub_Lang[$page];

			$PageDesc = $SubSub_Lang[$page."_?"];

	} break;

	 /**
	 * Page: Links Page
	 *
	 * @version  9.0
	 * @created  April 12, 2008
	 * @updated  April 12, 2008
	 */

	case "recommend":{


		$SubSub_Lang = $LANG_LINKS_MENU;

		## define the page title and description
		$PageTitle = $SubSub_Lang[$page];

		$PageDesc = $SubSub_Lang[$page."_?"];


		## CREATE PAGE DATA	
		require_once "inc/classes/class_regimg.php";	

		$obj = new SPAF_FormValidator();	


		## PERFORM OPERATION
		if(isset($_POST['do'])){ 

			require_once('inc/func/func_recommend.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST, $obj);

		}

		// get friends list

		if(isset($_SESSION['uid'])){

		require_once('inc/func/func_messages_page.php');

		$msg_friends = DisplayFriends($_SESSION['uid']);

		}



	} break;

	/**

	 * Page: Compatibility Quiz Page

	 *

	 * @version  13.0

	 * @created  April 24, 2017

	 * @updated  April 24, 2017

	 */

	case "compatibilityquiz":{



		## define the page title and description

		$PageTitle = $LANG_COMPATIBILITY['page_title'];

		## CREATE PAGE DATA	
		require_once "inc/classes/class_regimg.php";
		require_once "inc/func/func_compatibility_page.php";

		$obj = new SPAF_FormValidator();


		## PERFORM OPERATION

		if(isset($_POST['do'])){ 

			$_POST = $_REQUEST;
			//print_r($_POST);


			require_once('inc/func/func_compatibility.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST);

			$ERROR_MESSAGE = $Error_Report; $ERROR_TYPE="good";
		}


			
	} break;


	 /**
	 * Page: Followers Page
	 *
	 * @version  9.0
	 * @created  April 12, 2008
	 * @updated  April 12, 2008
	 */

	case "follow":{

		MustBeLoggedIn();

		$SubSub_Lang = $LANG_LINKS_MENU;

		## define the page title and description
		$PageTitle = $SubSub_Lang[$page];
		$PageDesc = $SubSub_Lang[$page."_?"];

		## PERFORM OPERATION
		if(isset($_POST['do'])){ 

			require_once('inc/func/func_follow.php');
			$Error_Report =  ChangeDo($_POST['do'], $_POST);

		}

		$data = $DB->Row("SELECT * FROM members_follow WHERE uid='".$_SESSION['uid']."' LIMIT 1");

	} break;

	 /**
	 * Page: Default Page
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Jan 18 10:48:31 EEST 2008
	 */			

	default: {
		$CheckPluginsAndCustom =1;
	} break;

}


if(isset($CheckPluginsAndCustom) && $CheckPluginsAndCustom ==1){



		// ARE WE LOADING A PLUGINS PAGE?

		if(isset($LOAD_PLUGIN_OPTIONS) && in_array($page,$PLUGINS_PAGES) ){



				## LOAD DATA FROM THE PLUGIN FILES				

				

		}else{

			$page = str_replace("-", " ", $page);
			// CHECK FOR CUSTOM CREATED PAGES

			require_once('inc/func/func_custom_page.php');

			$CUSTOM_LOAD_ARRAY = GetPages();

			if(!empty($CUSTOM_LOAD_ARRAY) && in_array($page,$CUSTOM_LOAD_ARRAY)){

				
				## BUILD PAGE DATA

				$CUSTOM_PAGE=1;


				$CUSTOM_PAGE_DATA = GetPageContent($page);				
				$CUSTOM_PAGE_CONTENT = $CUSTOM_PAGE_DATA['content'];				

				$CUSTOM_PACKAGES = unserialize($CUSTOM_PAGE_DATA['access']);

				if(!in_array($_SESSION['packageid'], $CUSTOM_PACKAGES)){

					header("location: ".getThePermalink('')); exit();

				}


				$lang_main_sub_sub1 = (isset($lang_main_sub_sub1)) ? $lang_main_sub_sub1 : '';

				$SubSub_Lang = $lang_main_sub_sub1;

				$show_page=str_replace("-", " ", $page);

			}else{

				// IF NOT, LETS REDIRECT

				header("location: ".getThePermalink('')); exit();

			}			

		}

}

///////////////////////////////////////////////////////////////////////////////////////////

// LOAD ERRORS CONTENT AREA

///////////////////////////////////////////////////////////////////////////////////////////

if(isset($Error_Report)){

	$WhichErrorType = explode("**", $Error_Report);

	if(isset($WhichErrorType[1])){			

		$ERROR_TYPE = "good";

		$ERROR_MESSAGE = strip_tags($WhichErrorType[0]);

	}else{

		$ERROR_TYPE = "bad";

		$ERROR_MESSAGE = strip_tags($Error_Report);

	}		

}

///////////////////////////////////////////////////////////////////////////////////////////

// LOAD PAGE MENU BAR ARRAYS

///////////////////////////////////////////////////////////////////////////////////////////



	 /**

	 * Page: Build Menu Bar Arrays

	 * 		

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */



	//$HEADER_META_BASE .=$CUSTOM_PLUGIN_HEADER;

	$HEADER_MENU_BAR_TOP 		= Build_DisplayMenu($lang_main_menu,$page);

	if(isset($SubSub_Lang) && $page != 'cryptoconvert'){


		$HEADER_MENU_BAR_SUB_SUB 	= Build_DisplayMenu($SubSub_Lang,$page,true);

	} elseif ($page == 'cryptoconvert') {
		
		$HEADER_MENU_BAR_SUB_SUB 	= Build_DisplayMenu($SubSub_Lang,'subscribe',true);
	} 
	else{		

		$HEADER_MENU_BAR_SUB_SUB 	="";

	}
	$HEADER_MENU_BAR_QUICK_LINKS  = "";

	if(D_QUICK_LINK_BOX == "yes" && $_SESSION['auth'] == 'yes'){
	
		$HEADER_MENU_BAR_QUICK_LINKS 			= "<li id='sub-menu-quick-links'><div class='trig' onclick=\"ShowHideQuickLinks('quick-links-content','block');\"><span class='background_color'></span></div>
			<div class='quick-links-content' id='quick-links-content' style='display:none;'>
				<ul>
					<li class='background_color quick-link-header'><div class='quick-link-close' onclick=\"ShowHideQuickLinks('quick-links-content','none');\"><span>x</span></div>
					</li>";
			foreach ($lang_quick_box as $key => $val) {
			
			$HEADER_MENU_BAR_QUICK_LINKS .= "<li class='quick-link'><a href='".DB_DOMAIN.$key."'>".$val."</a></li>";

			}		
					
		$HEADER_MENU_BAR_QUICK_LINKS .="</ul>
		</li>";

	}

	$HEADER_MENU_BAR_SUB 			= Build_DisplayMenu($lang_main_menu_sub,$page);

	$FOOTER_MENU_BAR 				= Build_DisplayMenu($lang_main_footer,'copyright');		

	$StopTimer 						= (float)time()+ (float)microtime();

	$EndTimer 						= round($StopTimer-$StartTimer,10);

	$FOOTER_BOTTOM_BAR 				= BuilderFooterBottom();

	$MyIMData = (isset($MyIMData)) ? $MyIMData : '';

	$FOOTER_MENU_TIMER 				.= Build_FooterScripts($page,$WINK_MESSAGE_ARRAY,$MyIMData,$MOBILE);

	//$FOOTER_MENU_TIMER .= "<span style='display:none;'>Page Load Time ".$EndTimer." seconds</span>";

	if(D_FLAGS ==1){	$FOOTER_MENU_TIMER .=ShowFlags(); 
	}else{		}



	$FOOTER_MENU_TIMER .= $PLUGINS_FOOTER; //Need to remove comment

	

 

///////////////////////////////////////////////////////////////////////////////////////////

// DISPLAY TEMPLATE

///////////////////////////////////////////////////////////////////////////////////////////



	 /**

	 * Page: Build Header Meta Tags

	 * 		

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

	

	if(isset($Index_Page_flag)){ $MyHomePage=true; }else{ $MyHomePage=false; }

	$HEADER_META_ARRAY 			= GetMetaTags($page,$sub_page,$PageTitle, (isset($META_INPUT_DATA))?$META_INPUT_DATA:'',$MyHomePage); 

	//$HEADER_META_ARRAY 			= GetMetaTags($page,$sub_page,$PageTitle,$MyHomePage);

	$HEADER_META_TITLE 			= $HEADER_META_ARRAY['title'];

	$HEADER_META_KEYWORDS 		= $HEADER_META_ARRAY['keywords'];

	$HEADER_META_DESCRIPTION 	= $HEADER_META_ARRAY['description'];

	$HEADER_META_CHARSET 		= $GLOBALS['_META']['_charset'];

	$HEADER_MEMBERS_ONLINE 		= CountOnline();



	 /**

	 * Page: Execute Data and Load Display Pages

	 * 		

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Jan 18 10:48:31 EEST 2008

	 */

//$PAGE_BLANK_FLAG;


	if(!isset($PAGE_BLANK_FLAG))
	{
		if(D_TEMP == "v18_ADS" || D_TEMP == "v20_blue" || D_TEMP == "v20_darksnow" || D_TEMP == "v20_peach" || D_TEMP == "v20_red" || D_TEMP == "v18_premium" || D_TEMP == "v18_zug" || D_TEMP == "v20_passion" )	
		{
			//echo $_SERVER['REQUEST_URI'];
			//echo my_logged_in;
			//echo trim($page);
			if(isset($_GET['l'])){ 
				//echo  $_GET['l']; 
			} 
			
	
				//echo trim(D_TEMP);
				if((isset($_REQUEST['l']) && $_REQUEST['l'] != "") && (isset($_SESSION['auth']) && $_SESSION['auth'] =="no") && trim($page) == "index"){
				
				}
				else
				{
					if((isset($_SESSION['auth']) && $_SESSION['auth'] =="no") && trim($page) == "index")
					{
					}
					else
					{
						require_once (	"inc/templates/".D_TEMP."/header.php"	); // <-- LOAD TEMPLATE HEADER
					}
				}
		}
		else
		{
			require_once (	"inc/templates/".D_TEMP."/header.php"	); // <-- LOAD TEMPLATE HEADER
			
			
		}
		if(D_TEMP == "v20_blue")
		{
			echo "<style>";
					include($_SERVER['DOCUMENT_ROOT']."/inc/css/dynamic_css.php"); 
				echo "</style>";	
			
		}
		else
		{
			/*if(trim($page) != "index")
			{*/
		
				echo "<style>";
					include($_SERVER['DOCUMENT_ROOT']."/inc/css/dynamic_css.php"); 
				echo "</style>";		 
			/*}*/
		}
	}

// exit();





	/*if(isset($CUSTOM_PAGE) && $CUSTOM_PAGE==1 ){

	

			//$tmpfname = tempnam ("/tmp", "FOO");

			//$fp = fopen($tmpfname, "w");

			//fwrite($fp, $CUSTOM_PAGE_CONTENT);

			//fclose($fp);

			//include($tmpfname);

			//unlink($tmpfname); 

			print "$CUSTOM_PAGE_CONTENT";

			$custom_rm_div = 1;

	}else*/

	if(isset($PLUGINS_PAGE_LINK)){

		if($PLUGINS_PAGE_TYPE =="html"){

			print $PLUGINS_PAGE_LINK;

		}elseif($PLUGINS_PAGE_TYPE =="link"){

			

			require_once (	$PLUGINS_PAGE_LINK 	);	

		}

		

	}else{


		///////////////////////////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////////////////

		if( ( !isset($HEADER_SINGLE_COLUMN) || $HEADER_SINGLE_COLUMN !="yes" ) && !isset($PAGE_BLANK_FLAG) ){

	
			if(($page == "register") && D_USER_REGISTRATION == "sliding"){

				//echo "</div>";
				//echo "</div>";
			}
			else if($page != "mgal"){	

				if(!file_exists("inc/templates/".D_TEMP."/menu.php")){

					require_once (	"inc/templates/layout/menu.php"	);

				}else{

					require_once (	"inc/templates/".D_TEMP."/menu.php"	);

				}
			}

		
		}

		// LOAD DEFAULT TEMPLATE PAGE OR CUSTOM PAGE OR TEMPLATE INDEX

		if($page == "index_responsive" && file_exists("inc/templates/".D_TEMP."/".$page.".php") ){

			require_once (	"inc/templates/".D_TEMP."/index_responsive.php"	);	

		}
		elseif($page == "register" && D_USER_REGISTRATION == "sliding" && !file_exists("inc/templates/".D_TEMP."/registerslide.php") ){

			require_once("inc/templates/layout/registerslide.php");

		}
		elseif($page == "register" && D_USER_REGISTRATION == "sliding" && file_exists("inc/templates/".D_TEMP."/registerslide.php") ){

			require_once("inc/templates/".D_TEMP."/registerslide.php");

		}
		elseif($page == "account" && D_USER_REGISTRATION == "sliding" && !file_exists("inc/templates/".D_TEMP."/accountslide.php") ){

			require_once (	"inc/templates/layout/accountslide.php"	);

		}
		elseif($page == "account" && D_USER_REGISTRATION == "sliding" && file_exists("inc/templates/".D_TEMP."/accountslide.php") ){

			require_once (	"inc/templates/".D_TEMP."/accountslide.php"	);

		}
		else if(isset($CUSTOM_PAGE) && $CUSTOM_PAGE==1 ){
			
			print "<div id='main'>$CUSTOM_PAGE_CONTENT</div>";
			$custom_rm_div = 1;
		}
		elseif($page != "index" && !file_exists("inc/templates/".D_TEMP."/".$page.".php") ){

			require_once (	"inc/templates/layout/".$page.".php"	);

		}elseif($page != "index" && file_exists("inc/templates/".D_TEMP."/".$page.".php") ){

			require_once (	"inc/templates/".D_TEMP."/".$page.".php" );

		}
		else {
			require_once (	"inc/templates/".D_TEMP."/index.php"	);		
		}
	}

///////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////


if( ( !isset($HEADER_SINGLE_COLUMN) || $HEADER_SINGLE_COLUMN !="yes" ) && !isset($PAGE_BLANK_FLAG) ){

	if($page == 'articles'){
		
		require_once (	"inc/templates/layout/recent_articles.php"	);

	}
	else if($page != "register" && $page != "mgal"){

		if(D_TEMP != 'v17red')
		require_once (	"inc/templates/layout/menu.php"	);

		if($page != "wld" && $page != "compatibilityquiz" && D_TEMP == 'v17red'){
			echo "</div>";
			echo "</div>";
			if($page != "forum" && $page != "search"){
			echo "</div>";
			}
			require_once (	"inc/templates/layout/quick_search.php"	);
		}
		else if($page != "wld" && $page != "compatibilityquiz"){
			require_once (	"inc/templates/layout/quick_search.php"	);
		}
	}


}


	if(!isset($PAGE_BLANK_FLAG)){

			if(D_TEMP == "v18_ADS" || D_TEMP == "v20_blue" || D_TEMP == "v20_darksnow" || D_TEMP == "v20_peach" || D_TEMP == "v20_red" || D_TEMP == "v18_premium" || D_TEMP == "v18_zug" || D_TEMP == "v20_passion")	
			{
			//echo $_SERVER['REQUEST_URI'];
			//echo my_logged_in;
			
				if(!empty($_REQUEST['l']) && (isset($_SESSION['auth']) && $_SESSION['auth'] =="no") && $page == "index"){
				
				}
				else
				{
					
					//echo $page;
				//echo $_GET['l'];
				
					
					//echo D_TEMP;
					
					if((isset($_SESSION['auth']) && $_SESSION['auth'] =="no") && trim($page) == "index")
					{
					}
					else
					{
		
						require_once (	"inc/templates/".D_TEMP."/footer.php"	); // <-- LOAD TEMPLATE FOOTER
					}
				}
			}
			else
			{
				require_once (	"inc/templates/".D_TEMP."/footer.php"	);  // <-- LOAD TEMPLATE FOOTER
			}

	}

	if(isset($_POST['register'])){
		
		if(isset($_POST['t&C']) && ($_GET['chek']=='emailactivate') && isset($Error_Report) && $Error_Report == 'gogogo'){
			
			header("Location: ".getThePermalink('register/activation'));
			
		}
	}


	$DB->Disconnect();

?>
<script type="text/javascript" src='https://www.google.com/recaptcha/api.js?render=explicit' async defer></script> 

<?
/***************************************************************************
 *
 *	 PROJECT: iCupid Dating Software
 *	 VERSION: 9
 *	 LISENSE: OWN / LEASED (http://www.advandate.com/license.php)
 *
 *	 This program is a commercial software product and any kind of usage
 *	 means agreement to the eMeeting software License Agreement.
 *
 *	 This notice MUST NOT be removed from the code.   
 *
 *   Copyright 2006-2007 AdvanDate, Ltd.
 *   http://www.advandate.com/
 *
 ***************************************************************************/
## START SESSIONS
if(!session_id())session_start();


// Send headers to prevent IE cache
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/html; charset=".$_SESSION['lang_charset']."");


require_once "../config.php";
$MOBILE = "no";
Build_BankChecker();
if(isset($_SERVER['argv'][1]) || isset($_SERVER['argv'][2])){
	die( 'Restricted access' );
}

$post_action   	= isset($_POST['action'])			?	trim(strip_tags($_POST['action']))			:'';
 
############################################################
#################### OPERATIONS ############################

if($post_action !=""){

	switch ( $post_action ){
 
		case "register": { 

			## PHP BB3 INTEGRATION CODE


			require_once "../classes/class_regimg.php";		

			require_once('../func/func_register_page.php');

			$obj = new SPAF_FormValidator();

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
			require_once('../func/func_register.php');



			if(D_USER_REGISTRATION == 'sliding'){
				//print_r($_POST); die();
				## Account Details
				$Error_Report =  ChangeDo2($_POST['do'], $_POST, $_FILES,$obj, $MOBILE);			
				require_once('../func/func_account.php');
				require_once('../func/func_uploads.php');
				$Error_Report_Account =  ChangeDo('edit', $_POST, $_FILES);
				## returns a list of contacts
			}
			else{
				$Error_Report =  ChangeDo1($_POST['do'], $_POST, $_FILES,$obj, $MOBILE);			
			}

			$result = array();
			$result['code'] = $Error_Report;

			if(is_array($Error_Report)){
				$sub_page="contacts";
				$contacts_array = $Error_Report;
				$Error_Report="";
			}elseif($Error_Report =="activateAccount"){
				$result['msg'] = 'Activation mail sent on your email account.';
			}elseif($Error_Report =="gogogo"){
				if (isset($_SESSION['lang'])){
					unset($_SESSION['lang']);
				}
				$_SESSION['lang'] = D_LANG;	
				$result['msg'] = $GLOBALS['_LANG_ERROR']['_welcomeMsg']."**1";
			}
		
		echo json_encode($result);

		} break;

		case "register_validate": { 

			## PHP BB3 INTEGRATION CODE


			require_once "../classes/class_regimg.php";		

			require_once('../func/func_register_page.php');

			$obj = new SPAF_FormValidator();

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
			require_once('../func/func_register.php');



			if(D_USER_REGISTRATION == 'sliding'){
				## Account Details
				$Error_Report =  ChangeDoValidate($_POST['do'], $_POST, $_FILES,$obj, $MOBILE);			
				require_once('../func/func_account.php');
				require_once('../func/func_uploads.php');
				$Error_Report_Account =  ChangeDo('edit', $_POST, $_FILES);
				## returns a list of contacts
			}
			

			$result = array();
			$result['code'] = $Error_Report;

		echo json_encode($result);

		} break;
	}
}

?>
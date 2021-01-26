<?php
	session_start();
	$autoloader = "../vendor-old/autoload.php";
	$config = $_SERVER['DOCUMENT_ROOT']."/inc/config.php";

	require($autoloader);
	require_once ($config);

	global $DB;

	use Slim\Slim;
	use Gregwar\Cache\Cache;
	use OpenTok\OpenTok;

	use OpenTok\MediaMode;
	use OpenTok\ArchiveMode;


	$apiKey = "46055302";
	$apiKey = (string)$apiKey;

	$apiSecret = "58ee779fff7d0cb9292807ca6e9d04c33d7f1bef";
	$apiSecret = (string)$apiSecret;

	$opentok = new OpenTok($apiKey, $apiSecret);

	if(isset($_GET['receive_id']) && $_GET['receive_id'] !=='') {
		
		$update_status = $DB->Row("UPDATE members_videochat set `read`='yes' WHERE id='".$_GET['receive_id']."' AND to_uid='".$_SESSION['uid']."'");
		$chat_session = $DB->Row("SELECT `session_id`,`token_id` FROM members_videochat WHERE id='".$_GET['receive_id']."' AND to_uid='".$_SESSION['uid']."'");
		
		$session_id = $chat_session['session_id'];
		$token = $chat_session['token_id'];

	} else {
		$chat_session_old = $DB->Row("SELECT `session_id`,`token_id`,`read` FROM members_videochat WHERE `uid`='".$_SESSION['uid']."' AND `read`='no' LIMIT 1");

		/*if(sizeof($chat_session_old) > 1 && $chat_session_old['status'] == '') {
			$chatSS = 'disconnected';
		}*/
 		
		
		if(!isset($chat_session_old['session_id'])){

			$session = $opentok->createSession();
			$session_id = $session->getSessionId();
			$token =  $opentok->generateToken($session_id);
			$DB->Row("INSERT INTO members_videochat (`uid`,`to_uid`,`datetime`,`read`,`session_id`,`token_id`) VALUES('".$_SESSION['uid']."','".$_GET['to_uid']."','".date('Y-m-d h:i:s')."','no','".$session_id."','".$token."')");
			
		} else {
			$session_id = $chat_session_old['session_id'];
			$token = $chat_session_old['token_id'];
		}
		
			
		
	}
	
	$data = array();

	$data['apiKey'] = $apiKey;
	$data['sessionId'] = $session_id;
    $data['token'] = $token;

	echo json_encode($data);

?>
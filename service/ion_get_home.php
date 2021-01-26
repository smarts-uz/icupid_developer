<?php
header('Access-Control-Allow-Origin: *');

require_once("../inc/config.php");

$iId = $_GET['uid'];

global $DB;

$arrData = array();

$comment = $DB->Row("SELECT count(id) AS total FROM comments WHERE to_uid='".$iId."' AND approved = 'no'");
$friends = $DB->Row("SELECT count(id) AS total FROM members_network WHERE to_uid='".$iId."' AND approved = 'no'");
$message = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE mail2id='".$iId."' AND type = 'normal' AND mailstatus = 'unread'");
$winks = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE mail2id='".$iId."' AND type = 'wink' AND mailstatus = 'unread'");
 
        $arrData[0] = new StdClass;
        $arrData[0]->comment = $comment['total'];
        $arrData[0]->friends = $friends['total'];
		$arrData[0]->message = $message['total'];
		$arrData[0]->winks = $winks['total'];
	  	$arrData[0]->free_mode = D_FREE;
 
echo json_encode($arrData, JSON_UNESCAPED_SLASHES);

?>

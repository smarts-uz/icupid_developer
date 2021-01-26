<?php
#
# Copyright © 2004-2013 Chat software by www.flashcoms.com
#
# This is the demo handler. Replace it with your custom logic.
#

include('lib.php');

$answer = AutoLogin();
header('Content-type: text/xml');
echo $answer;

function AutoLogin()
{
	global $users;
	global $DB;
	# NOTE: you can`t use $_SESSION here,
	# because requests are sent by FMS and not by browser on user's side.
    $uid = GetParam('uid');
    if (!$uid)
    {
       return "<invalidParams/>";
    }
	// replace with your custom logic

	$num = count($users);
	$user = array();

	$userData = $DB->Row("SELECT m.id,m.username,m.email,md.age,md.headline,md.country,md.location,md.gender FROM members m INNER JOIN members_data md WHERE m.id = '".$uid."'");

	$account = MemberAccountDetails($uid);

	$profile = MemberAccountDetails($uid, false,"profile");

	$userData['account'] = $account;
	
	$userData['profile'] = $profile;

	$thumb = explode("?", $userData['profile']['image_small']);

	$thumb_set = explode("&", $thumb['1']);

	$friends = $DB->Query("SELECT to_uid FROM members_network WHERE uid = '$uid' and approved = 'yes'");

		

	while( $friend = $DB->NextRow($friends) ){
		$userData['friends'][$friend['to_uid']] = MemberAccountDetails($friend['to_uid'], false,"profile");
	}
	$user = array(
			'id' => $userData['id'],
			'userName' => $userData['username'],
			'location' => $userData['profile']['location'].', '.$userData['profile']['country'],
			'gender' => $userData['profile']['gender'],
			'details' => $userData['profile']['headline'],
			'age' => $userData['profile']['age'],
			'profile_link' => DB_DOMAIN.$userData['username'],
			'photo' => $userData['profile']['image'],
			'thumbnail' => $thumb[0].'?'.$thumb_set[0].'&x=40&y=40'
		);
	
	if(isset($userData['friends'])){

		$user['friends'] = $userData['friends'];
	
	}	

	/*for($i = 0; $i < $num; $i++)
	{
		$u = $users[$i];
		if(md5($u['id'].$u['userName'].$u['password']) == $uid)
		{
			$user = $u;
			break;
		}
	}*/
	
	if($user) return ParseUserData($user);
	else return '<login result="FAIL" error="error_authentication_failed"/>';
}
?>

<?php
#
# Copyright © 2004-2013 Chat software by www.flashcoms.com
#
# This is the demo handler. Replace it with your custom logic.
#
include('lib.php');

$answer = GuestLogin();
header('Content-type: text/xml');
echo $answer;

function GuestLogin()
{
	global $users;

	$userName = GetParam('userName');
	if(!$userName) return "<invalidParams/>";
	$gender = GetParam('gender');

	// your guest login logic here

	$num = count($users);
	$user = null;

	for($i = 0; $i < $num; $i++)
	{
		$u = $users[$i];

		if(strtolower($u['userName']) == strtolower($userName))
			return '<login result="FAIL" error="error_username_is_already_in_use"/>';
	}

	$user['id'] = '';
	$user['userName'] = $userName;
	$user['gender'] = $gender;
	$user['location'] = 'unknown';
	$user['age'] = 'unknown';
	$user['photo'] = '';
	$user['thumbnail'] = '';
	$user['details'] = '';
	$user['level'] = 'guest';
	return ParseUserData($user);
}
?>

<?php
#
# Copyright © 2004-2013 Chat software by www.flashcoms.com
#
# This is the demo handler. Replace it with your custom logic.
#
include('lib.php');

$answer = ChatLogin();
header('Content-type: text/xml');
echo $answer;

function ChatLogin()
{
	global $users;

	$login = strtolower(GetParam('login'));
	if(!$login) return "<invalidParams/>";

	$password = GetParam('password');
	if(!$password) return "<invalidParams/>";

	// replace with your custom logic

	$num = count($users);
	$user = null;

	for($i = 0; $i < $num; $i++)
	{
		$u = $users[$i];
		if(strtolower($u['userName']) == $login && $u['password'] == $password)
		{
			$user = $u;
			break;
		}
	}

	if($user) return ParseUserData($user);
	else return '<login result="FAIL" error="error_authentication_failed"/>';
}
?>

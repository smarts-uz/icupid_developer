<?php
#
# Copyright © 2004-2013 Chat software by www.flashcoms.com
#
# This is the demo handler. Replace it with your custom logic.
#
include('lib.php');

$answer = GetProfile();
header('Content-type: text/xml');
echo $answer;

function GetProfile()
{
	global $users;

	# NOTE: you can`t use $_SESSION here,
	# because requests are sent by FMS and not by browser on user's side.
    $profileID = GetParam('profileID');
    if (!$profileID)
    {
       return "<invalidParams/>";
    }
	// replace with your custom logic

	$num = count($users);
	$user = null;

	for($i = 0; $i < $num; $i++)
	{
		$u = $users[$i];
		if($u['id'] == $profileID)
		{
			$user = $u;
			break;
		}
	}

	if($user) return ParseUserData($user, true);
	else return '<login result="FAIL" error="error_authentication_failed"/>';
}
?>

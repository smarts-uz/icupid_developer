<?php
#
# Copyright © 2004-2013 Chat software by www.flashcoms.com
#
# This is the demo handler. Replace it with your custom logic.
#
include('lib.php');

$answer = FriendBlock();
echo $answer;

function FriendBlock()
{
    //action is one of the following
    //addFriend
    //removeFriend
    //block
    //unblock
	$action = strtolower(GetParam('action'));
	if(!$action) return "invalidParams";

    //selfID - user who initiates action
	$selfID = strtolower(GetParam('selfID'));
    if(!$selfID) return "invalidParams";

    //userID - user who is the target of the action
    $userID = strtolower(GetParam('userID'));
    if(!$userID) return "invalidParams";

	// replace with your custom logic

	return $action.' done '."(".$selfID."-".$userID.")";
}
?>

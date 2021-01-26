<?php

$xml = file_get_contents("php://input");

/*
<reportUser>
	<offeringUserId>2</offeringUserId>
	<reportingUserId>1</reportingUserId>
	<roomId>room1</roomId>
	<reason>some reason</reason>
	<history>
		<msg><senderID>1</senderID><content>Hello :)</content></msg>
		<msg><senderID>1</senderID><content>How do you do?</content></msg>
		<msg><senderID>2</senderID><content>Some rude message</content></msg>
	</history>
</reportUser>
*/

echo 'Done';

?>
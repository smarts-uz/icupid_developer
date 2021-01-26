<?php

$xml = file_get_contents("php://input");
/*
r -- roomID
ts -- timestamp in seconds (not milliseconds)
f -- from user id
t -- to user id
w -- whisper true/false
dt -- timestamp in seconds (not milliseconds)
c -- content

<chatLogs ts="123456">
	<m>
		<r>room1</r>
		<f>1</f>
		<to>2</to>
		<w>true</w>
		<dt>123456</dt>
		<c><![CDATA[Hello :)]]></c>
	</m>
	<m>
		<r>room2</r>
		<f>2</f>
		<to>1</to>
		<w>false</w>
		<dt>123458</dt>
		<c><![CDATA[How do you do?)]]></c>
	</m>
</chatLogs>

*/

echo 'Done';

?>
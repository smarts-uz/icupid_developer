<?php

$xml = file_get_contents("php://input");

/*
<logPro ts="1283351509">
	<autoLogin uid="d5b0ef4c8c51f303ecbaed81a6e078c5" hasCam="false" ip="127.0.0.1" ts="1283351406" />
	<chatLogin hasCam="false" ip="127.0.0.1" ts="1283352053">
		<userName>Guest</userName>
	</chatLogin>
	<adminLogin hasCam="false" ip="127.0.0.1" ts="1283352053">
		<userName>admin</userName>
	</adminLogin>
	<guestLogin hasCam="false" ip="127.0.0.1" ts="1283352020">
		<userName>guest</userName>
	</guestLogin>
	<loginResult ip="127.0.0.1" id="1" error="" ts="1283351406" />
	<joinRoom id="1" roomID="z11283351417236" ts="1283351417" />
	<leaveRoom id="1" roomID="room1" ts="1283351426" />
	<createRoom id="1" ts="1283351417">
		<roomName>test</roomName>
	</createRoom>
	<sendFile id="2" receiverID="1" fileID="1283351441141" fileSize="6Kb" ts="1283351441">
		<fileName>script.txt</fileName>
	</sendFile>
	<acceptFile id="1" senderID="2" isAccept="true" fileID="1283351441141" ts="1283351444" />
	<changeColor id="1" color="6684876" ts="1283351406" />
	<changeAvatar id="1" avatarID="02" ts="1283351406" />
	<changeStatus id="2" status="1" ts="1283351383" />
	<publish id="1" video="false" audio="true" pause="false" ts="1283351421" />
	<subscribe id="1" publisherID="2" roomID="proom2000" ts="1283351998" />
	<unsubscribe id="1" publisherID="2" roomID="proom2000" ts="1283351998" />
	<sendInvitation id="1" receiverID="2" roomID="null" ts="1283351494" />
	<answerInvitation id="2" senderID="1" roomID="null" accepted="true" ts="1283351499" />
	<startRecordVideo userID="1" ts="1283351499" />
	<videoSaved userID="1" fileName="someFile.flv", ts="1283351499" />
</logPro>
*/

echo 'Done';

?>
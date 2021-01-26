<?php 



// no direct access

defined( 'KEY_ID' ) or die( 'Restricted access' );





/**

* Info: Display Mail Box 

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/



function MailCount(){



	global $DB;



	## define variables

	$AlertArray = array(); $Counter=1; 



	$SQL = "select row_num from 

		(

			SELECT count(mailnum) AS row_num FROM messages WHERE mail2id= '".$_SESSION['uid']."' AND to_box='inbox' AND messages.type !='wink'

	 

			union ALL

	

			SELECT count(mailnum) AS row_num FROM messages WHERE mail2id= '".$_SESSION['uid']."' AND to_box='inbox' AND messages.type ='wink'



			union ALL



			SELECT count(mailnum)  AS row_num FROM messages WHERE uid= ( '".$_SESSION['uid']."' ) AND my_box='sent'



			union ALL



			SELECT count(mailnum) AS row_num FROM messages WHERE messages.mail2id='".$_SESSION['uid']."' AND messages.to_box='trash'

	

		) as derived_table";

 

	$Data = $DB->Query($SQL);

 

	## loop data from query

 	while( $DataArray = $DB->NextRow($Data) ){



		$AlertArray[$Counter]['total'] = number_format($DataArray['row_num']); 

		$Counter++;

	}

 

	return $AlertArray;



}



function DisplayMessages($id,$box=1, $orderBy="maildate", $Start="0", $Stop="10",$errMessage=""){



	global $DB;



	## define variables

	$NumFields=1;	$ReturnMessageArray=array();

	$orderBy2 = $orderBy;
	if(($orderBy=="maildate" ||$orderBy=="messages.maildate")) {
		$orderBy2 = "maildate DESC, mailtime DESC";
	} elseif(($orderBy=="mailnum" ||$orderBy=="messages.mailnum")) {
		$orderBy = "members.username";
		$orderBy2 = "members.username";
	} elseif(($orderBy=="mail_subject" ||$orderBy=="messages.mail_subject")) {
		$orderBy = "messages.mail_subject";
		$orderBy2 = "messages.mail_subject";
	}


		if($box =="sent"){

			

			$SQL = "SELECT members.username, messages.mailnum, messages.mailtime, messages.mail_message, messages.mail2id, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 

			LEFT JOIN files ON ( files.uid = messages.mail2id AND files.approved = 'yes' )

			LEFT JOIN album ON ( album.aid = files.aid )

			LEFT JOIN members ON ( members.id = messages.mail2id )			

			WHERE messages.uid= ( '".$id."' ) AND messages.my_box='sent' GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2."  LIMIT $Start, $Stop";



			$totalMsg = $DB->Row("SELECT count(mailnum)  AS total FROM messages WHERE uid= ( '".$id."' ) AND my_box='sent'");

 

		}elseif($box =="trash"){

		

			$SQL = "SELECT members.username, messages.mail_message, messages.mailtime, messages.mailnum, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 

			LEFT JOIN files ON ( files.uid = messages.uid AND files.approved = 'yes' ) 

			LEFT JOIN album ON ( album.aid = files.aid )

			LEFT JOIN members ON ( members.id = messages.uid )

			WHERE (messages.mail2id='".$_SESSION['uid']."') AND (messages.to_box='trash') GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2." LIMIT $Start, $Stop";

			

			$totalMsg = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE messages.mail2id='".$_SESSION['uid']."' AND messages.to_box='trash' ");		



		}elseif($box =="wink"){		



			$SQL = "SELECT members.username, messages.mail_message, messages.mailtime, messages.mailnum, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 

			LEFT JOIN files ON ( files.uid = messages.uid ) 

			LEFT JOIN album ON ( album.aid = files.aid AND files.approved = 'yes' )

			LEFT JOIN members ON ( members.id = messages.uid)

			WHERE messages.mail2id='".$id."' AND messages.to_box='inbox' AND messages.type='wink' GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2." LIMIT $Start, $Stop";



			$totalMsg = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE mail2id= '".$id."' AND to_box='inbox' AND type='wink'");		



		}else{		



			$SQL = "SELECT members.username, messages.mail_message, messages.mailtime, messages.mailnum, messages.uid, messages.mailstatus, messages.type, messages.maildate, messages.mail_subject, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

			FROM messages 

			LEFT JOIN files ON ( files.uid = messages.uid AND files.approved = 'yes' ) 

			LEFT JOIN album ON ( album.aid = files.aid )

			LEFT JOIN members ON ( members.id = messages.uid)

			WHERE messages.mail2id='".$id."' AND messages.to_box='inbox' AND messages.type !='wink' GROUP BY ".$orderBy.", messages.mailnum ORDER BY ".$orderBy2."  LIMIT $Start, $Stop";			

			

			$totalMsg = $DB->Row("SELECT count(mailnum) AS total FROM messages WHERE mail2id= '".$id."' AND to_box='".$box."' AND messages.type !='wink'");	

					

		}



	$result = $DB->Query($SQL);

    while( $msg = $DB->NextRow($result) )

    {

			



			// CHECK FOR FILE ATTACHMNET

			$totalAttacments = $DB->Row("SELECT count(id) AS total FROM files WHERE user = '".$msg['mailnum']."' AND title='Message Photo' LIMIT 1");	

			if($totalAttacments['total'] > 0){ 

				$ReturnMessageArray[$NumFields]['attachment']="yes";

			}else{

				$ReturnMessageArray[$NumFields]['attachment']="no";

			}



			if($msg['username']==""){ $msg['username']=$_SESSION['username'];} 		

			if($box =="sent"){

				$ReturnMessageArray[$NumFields]['senderid'] = $msg['mail2id'];

			}else{

				$ReturnMessageArray[$NumFields]['senderid'] = $msg['uid'];

			}



			if($msg['maildate'] == DATE_NOW){

				$ReturnMessageArray[$NumFields]['date'] = isset($GLOBALS['LANG_MESSAGES']['today']);

			}else{

				$ReturnMessageArray[$NumFields]['date'] 	= dates_interconv($msg['maildate']);

			}			

			$ReturnMessageArray[$NumFields]['time'] 	= $msg['mailtime'];

			$ReturnMessageArray[$NumFields]['id'] 		 = $msg['mailnum'];

			$ReturnMessageArray[$NumFields]['type'] 	 = $msg['type'];

			$ReturnMessageArray[$NumFields]['subject'] 	 = substr(eMeetingOutput($msg['mail_subject']),0,200);

			$ReturnMessageArray[$NumFields]['message'] 	 = strip_tags(substr(eMeetingOutput(strip_tags($msg['mail_message'])),0,50))."...";

			$ReturnMessageArray[$NumFields]['total'] 	 = $NumFields;		

			$ReturnMessageArray[$NumFields]['image'] 	 = ReturnDeImage($msg,"small");			

			$ReturnMessageArray[$NumFields]['from']		 = $msg['username'];			

			$ReturnMessageArray[$NumFields]['totalMsg']  = $totalMsg['total'];



			if($msg['mailstatus'] =="unread"){	$ThisCaption="<font color='red'>".$GLOBALS['_LANG']['_new']."</font>"; }else{ $ThisCaption=$GLOBALS['_LANG']['_read']; }



		$ReturnMessageArray[$NumFields]['status']	= $ThisCaption;  

		$NumFields++;	

	}

	

	## return array

	return $ReturnMessageArray;

}





/**

* Info: Display  Friends for Compose Message 

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/



function DisplayFriends($id){



	global $DB;



	## define variables

	$RunningCount=1;	$Friends = array();

	

	$DB->Query("SET sql_big_selects=1"); // UNCHECK THIS IF YOU HAVE PROBLMS WITH BIG QUERY



	$result = $DB->Query("SELECT DISTINCT members.id, album.cat, album.password, members.username, files.bigimage, members_online.logid AS onlinenow, members_network.date, 

	members_network.id, members.id AS uid, members_network.to_uid, members_network.uid AS myid, members_network.comments, members_network.approved AS memberApprove,

	files.type,	files.approved,	files.aid, files.adult_content

	FROM members_network 

	LEFT JOIN members ON ( members.id = members_network.to_uid OR  members.id = members_network.uid )

	LEFT JOIN members_online ON ( members_online.logid = members.id )			

	LEFT JOIN files ON ( files.uid = members.id)		
	
	LEFT JOIN album ON ( album.aid = files.aid) 

	WHERE (members_network.uid='".$_SESSION['uid']."' or members_network.to_uid='".$_SESSION['uid']."') AND members.username != ('".$_SESSION['username']."') AND members_network.type= ( '2' ) AND members_network.approved = 'yes' GROUP BY members.id ORDER BY members.lastlogin");

			

	while( $friend = $DB->NextRow($result) ){

		

		if($friend['to_uid'] ==$id){ 

			$Friends[$RunningCount]['username'] = GetUsername($friend['uid']);

			

		}else{			

			$Friends[$RunningCount]['username'] = $friend['username'];

		}

		if($friend['cat'] == "private" && $friend['password'] != "")
		{
			$Friends[$RunningCount]['image'] = "inc/tb.php?src=".DEFAULT_IMAGE."&x=96&y=96&x=48&y=48";			
		}
		else 
		{
			$Friends[$RunningCount]['image'] 		= ReturnDeImage($friend,"xsmall");	
		}

		$Friends[$RunningCount]['uid'] 			= $friend['id'];

		$RunningCount++;

	}

	

	## return array

	return $Friends;			

}



/**

* Info: Display  Friends for Compose Message 

* 		

* @version  9.0

* @created  Fri Sep 25 10:48:31 EEST 2008

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/



function GetMsgData($id){



	global $DB;



	if(!is_numeric($id)){ return; }



	## define variables

	$NumFields=1;	$ReturnMessageArray=array();	$id = strip_tags($id);

	

	## build query

	$msg = $DB->Row("SELECT messages.mail2id, messages.mailnum, messages.maildate, mailtime, messages.uid, messages.type, messages.mail_subject, messages.mail_message, members.username, files.bigimage, files.type, album.cat, album.allow_a,	album.allow_n,	album.allow_h,	album.allow_f

	FROM messages

	INNER JOIN members ON ( members.id = messages.uid )

	LEFT JOIN files ON ( files.uid = messages.uid AND files.approved = 'yes' )

	LEFT JOIN album ON ( album.aid = files.aid AND files.default=1)

	WHERE messages.uid = members.id AND messages.mailnum= ( '".$id."' ) AND ( messages.mail2id= ( '".$_SESSION['uid']."' ) OR  messages.uid= ( '".$_SESSION['uid']."' ) ) LIMIT 1");

	

	## clean the members input

	$values = @array_map('eMeetingInput',$msg);



	## CHECK TO SEE IF THERE ARE ANY IMAGES WITH THIS MESSAGE

	$imageArry = array(); $i=0;

	$msgImage = $DB->Query("SELECT * FROM files WHERE user = ( '".$id."' ) AND type='photo' ");

	while( $img = $DB->NextRow($msgImage) ){



			$imageArry[$i]['name'] = $img['bigimage'];

			$i++;

	}

 

	//////////////////////////////////////////////////////////

	$ReturnMessageArray[$NumFields]['image_array'] 		= $imageArry;

	$ReturnMessageArray[$NumFields]['id'] 				= $msg['mailnum'];

	$ReturnMessageArray[$NumFields]['senderid'] 		= $msg['uid'];

	$ReturnMessageArray[$NumFields]['type'] 			= $msg['type'];

	$ReturnMessageArray[$NumFields]['date'] 			= dates_interconv($msg['maildate']);

	$ReturnMessageArray[$NumFields]['time'] 			= $msg['mailtime'];	

	$ReturnMessageArray[$NumFields]['subject'] 			= $msg['mail_subject'];

	$ReturnMessageArray[$NumFields]['message'] 			= stripslashes(nl2br($msg['mail_message']));

	$ReturnMessageArray[$NumFields]['username'] 		= $msg['username'];		

	$ReturnMessageArray[$NumFields]['image'] 			= ReturnDeImage($msg,"small");

	//////////////////////////////////////////////////////////////

		 //die($_SESSION['uid'] ."==". $msg['mail2id']);

	if($_SESSION['uid'] == $msg['mail2id']){



		$DB->Update("UPDATE messages SET mailstatus='read' WHERE mailnum=".$id." LIMIT 1");

	}



	## return array

	return $ReturnMessageArray;

	

}

?>
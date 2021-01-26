<?
/***************************************************************************
 *
 *	 PROJECT: iCupid Dating Software
 *	 VERSION: 9
 *	 LISENSE: OWN / LEASED (http://www.advandate.com/license.php)
 *
 *	 This program is a commercial software product and any kind of usage
 *	 means agreement to the eMeeting software License Agreement.
 *
 *	 This notice MUST NOT be removed from the code.   
 *
 *   Copyright 2006-2007 AdvanDate, Ltd.
 *   http://www.advandate.com/
 *
 ***************************************************************************/
## START SESSIONS
if(!session_id())session_start();


require_once "../config.php";



## DISPLAY GLOBALS				

require_once('../func/globals.php');
require_once('../API/api_functions.php');
require_once('../func/func_search_page.php');
require_once('../func/func_browse_page.php');
$ThisPersonsNetworkBar="";

/**

* Info: Performs the main search page results

* 		

* @version  9.0

* @updated  Fri Sep 25 10:48:31 EEST 2008

*/				

$NETWORK_ID=2;

## GET SEARCH DATA

if(isset($_POST['dpage']) && is_numeric($_POST['dpage'])){ $_GET['view_page']=$_POST['dpage'];}

if(isset($_GET['view_page']) && is_numeric($_GET['view_page'])){ $Pass_Page = $_GET['view_page']; }else{ $Pass_Page=0; }



## display if network ID is selected

if( ( isset($_POST['friendid']) && is_numeric($_POST['friendid']) )  || ( isset($_GET['friendid']) && is_numeric($_GET['friendid']) )  ){

	$NETWORKD_FRIEND_ID     = (isset($_POST['friendid']))	?	$_POST['friendid']	: $_GET['friendid'];



	if($NETWORKD_FRIEND_ID == 0 && $_SESSION['auth'] !="yes"){ 

		die;
		//header("location: ".DB_DOMAIN."index.php?dll=login"); exit(); 

	}elseif($NETWORKD_FRIEND_ID == 0 && $_SESSION['auth'] =="yes"){

		$NETWORKD_FRIEND_ID=$_SESSION['uid'];

	}



	## find the network type

	if( ( isset($_POST['friend_type']) && is_numeric($_POST['friend_type']) )  || ( isset($_GET['friend_type'])  && is_numeric($_GET['friend_type']) )  ){

		$NETWORK_ID    = (isset($_POST['friend_type']))	?	$_POST['friend_type']	: $_GET['friend_type'];

	}



	 $ThisPersonsNetworkBar = ShowFCIDMEmber($NETWORKD_FRIEND_ID);



}



## GET DISPLAY TYPE				

$SearchData = GetProfiles($_POST,$Pass_Page, $_GET); $DataCounter= count($SearchData); 


## NO SEARCH RESULTS

if(!isset($SearchData[$DataCounter]['TotalResults'])){ $SearchData[$DataCounter]['TotalResults'] =0; }


if($SearchData[$DataCounter]['TotalResults'] == SEARCH_PAGE_ROWS){ $GLOBALS['total_pages']=1; }else{$GLOBALS['total_pages'] = ceil($SearchData[$DataCounter]['TotalResults']/SEARCH_PAGE_ROWS); }

		

## SEARCH RESULTS ARRAY

$search_data = $SearchData;



## SEARCH NEXT / LAST BUTTONS

if($SearchData[$DataCounter]['TotalResults'] < SEARCH_PAGE_ROWS){		

	$Search_Page_Numbers = "";

}else{

	if(count($SearchData) == SEARCH_PAGE_ROWS){ $SHOW_NEXT_BOX = true; }else{ $SHOW_NEXT_BOX = false; }

	$Search_Page_Numbers = PageNumbers($SearchData[$DataCounter]['TotalResults'], $Pass_Page,$SHOW_NEXT_BOX);

}

		

## Define Page Array

$Search_Type= array('gallery','detail','basic');



if(isset($_GET['displaytype']) && in_array($_GET['displaytype'],$Search_Type)){

	$_POST['displaytype'] = $_GET['displaytype'];

}

## Determin Display Page

if(isset($_POST['displaytype']) && in_array($_POST['displaytype'],$Search_Type)){

	
	$search_type = $_POST['displaytype'];

				

}else{

	## shows the default search page display, set in the config file.

	$search_type = SEARCH_PAGE_DISPLAY;

}



$show_page ="home";





if(!isset($NETWORKD_FRIEND_ID)){ $PageTitle= $GLOBALS['_LANG']['_search']." ".$GLOBALS['_LANG']['_results']; }

elseif($NETWORK_ID ==1){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_hotList']; }

elseif($NETWORK_ID ==2){ $PageTitle= $GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_friendsList']; }

elseif($NETWORK_ID ==3){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_blockList']; }

elseif($NETWORK_ID ==5){ $PageTitle=$GLOBALS['_LANG']['_my']." ".$GLOBALS['_LANG']['_partners']; }		


if($_SESSION['auth'] =="yes"){

	$SaveSearchData = SavedSearched($_SESSION['uid']);

}

## SAVE SEARCH PAGE

if(isset($_POST['SavePage']) && $_POST['SavePage'] ==1){

	$SaveString ="";

	$DontSaveThis = array('SavePage');

	foreach($_POST as $val => $key){

		if(!in_array($val, $DontSaveThis)){

			if(is_array($key)){

				foreach($key as $val1 => $key1){

					$SaveString .= $val."[".$val1."]-".$key1."*";

				}

			}else{

				$SaveString .= $val."-".$key."*";

			}
		}

	}

  

	$DB->Insert("INSERT INTO `member_searches` (`search_id` ,`uid` ,`search_date` ,search_string, `search_name`)VALUES ( NULL , '".$_SESSION['uid']."', now(), '".eMeetingInput($SaveString)."', '".DATE_NOW."')");

	$ERROR_MESSAGE = $GLOBALS['_LANG_ERROR']['_complete']; $ERROR_TYPE="good";

}



if($search_type=="basic" && isset($SearchData[1]['TotalResults']) && $SearchData[1]['TotalResults'] > 0){

	 /**
	 * Page: Search Basic View
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
	
	<? $i=1; foreach($search_data as $Member){ ?>	
	<? if($i == 1){ ?><div class="workblockright" id="div_<?=$Member['id'] ?>"> <? }else{ ?> <div class="workblockleft" id="div_<?=$Member['id'] ?>"><? } ?>		

	
	<!-- DISPLAY PROFILE TOP AND PACKAGE ICON -->	
      <div id="basic_search_nav">			
	  <span class="username">
        &nbsp;&nbsp;<?=$Member['username'] ?> <? if($Member['onlinenow']){ ?> - <font color="#FF0000"><strong><?=$GLOBALS['_LANG']['_online'] ?> <?=$GLOBALS['_LANG']['_now'] ?></strong></font> <? } ?> 
         
        </span>
			
		</div>
	<!-- END DISPLAY -->
	
		<div id="basic_search">
			<div class="imageframe">
			<div class="highlighted1<? if($Member['featured'] !="yes"){ print "off"; } ?>" style="height:120px;padding:5px; margin-left:5px;">
			<a href="<?=$Member['link'] ?>"><div align="center"><img src="<?=$Member['image'] ?>" class="thumb" alt="<?=$Member['username'] ?>" width="96" height="96" style="margin-left:5px;"></div></a>
			</div></div>
			<div class="imagedetails">				
				<ul class="details">
					<li class="first"><?=$Member['username'] ?>  </li>
					<li><?=$GLOBALS['_LANG']['_age']  ?>: <?=$Member['age'] ?> / <?=$Member['gender'] ?></li>
					<li><?=$GLOBALS['_LANG']['_country'] ?>: <?=$Member['country'] ?></li>
					<li><?=$Member['location'] ?></li>
					<li class="last">


					<? if($_SESSION['auth'] =="yes" ){ ?>

						<a href="<?=$Member['link'] ?>"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/search.gif"></a>
						<? if($_SESSION['uid'] !=$Member['id']){ ?>

<a href="<?=getThePermalink('messages/create/'.$Member['username'])?>">
							<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png"></a>				
							<? if(D_FRIENDS ==1){ ?><a href="#" onclick="ProfileAddNet(<?=$Member['id'] ?>,2);alert('<?=$GLOBALS['_LANG']['_updated'] ?>');return false;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_green.png"></a>	<? } ?>					

							<? if(D_WINK ==1){ ?> <a <? if($_SESSION['auth'] =="yes"){ ?> <? if(is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-wink",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="#" onclick="openQuickWink(<?=$Member['id'] ?>,'<?=$Member['username'] ?>','<?=$Member['image'] ?>'); return false;" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?> <? }else{ ?>href="<?=DB_DOMAIN ?>login"<? } ?>><img src="<?=DB_DOMAIN ?>images/DEFAULT/_search/wink.png"></a> <? } ?>

							<? if(D_HOTLIST ==1){ ?><a href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,1); alert('<?=$GLOBALS['_LANG']['_updated'] ?>'); return false;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/heart.png"></a><? } ?>
				
							<? if($Member['onlinenow'] && $Member['CanChat']=="yes" && D_IM ==1){ ?>
							<a href="javascript:void(0)" onclick="openIMWin(<?=$Member['id'] ?>, '<?=$_SESSION['uid'] ?>','<?=DB_DOMAIN ?>','<?=$IMRoomArray['path'] ?>','<?=$IMRoomArray['width'] ?>','<?=$IMRoomArray['height'] ?>'); return false;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/comment.gif"></a>
							<? } ?>
							<? if($Member['video']){ ?>
							<a href="<?=$Member['link'] ?>"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_search/livevid.gif"></a>
							<? } ?>
						<? } ?>



					<? }else{ ?>

					<a href="<?=DB_DOMAIN ?>login">

						<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png">
						<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png">
						<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/heart.png">
						<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png">
			
					</a>

					<? } ?>			
					</li>
				</ul>
			</div>
		</div>
			
	</div>
	<?  $i++; if($i==3){$i=1;}  } ?>		
	<!-- END GALLERY BSIC VIEW -->		



<? }elseif($search_type=="gallery" && isset($SearchData[1]['TotalResults']) && $SearchData[1]['TotalResults'] > 0){ 
	 /**
	 * Page: Search Gallery View
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>


<? $i=1; foreach($search_data as $Member){ ?>	
<? if($i ==5){ ?><div class="galleryviewright"> <? }else{ ?> <div class="galleryviewleft" ><? } ?>
	
    <div class="gallery_search <?php if($Member['featured']=="yes"){ ?>highlighted2<? } ?>">
        <a href="<?=$Member['link'] ?>">
            <img src="<?=$Member['image'] ?>&y=135&x=135" class="img_border">
            
            <div class="member-hover-details">
		<ul class="member-hover-data">
		    <li><span>Location:</span> <?=$Member['location'] ?>,<?=$Member['country'] ?></li>
		    <li><span>Last login:</span> <?=date("M d",strtotime($Member['lastlogin'])) ?></li>
                    <li><img src="/images/n_messages.png" onclick="window.location.href='<?=getThePermalink('messages/create/'.$Member['username'])?>';return false;">  <img src="/images/n_winks.png" data-lightbox="QuickBox2" onclick="openQuickWink(<?=$Member['id'] ?>,'<?=$Member['username'] ?>','<?=$Member['image'] ?>&x=96&y=96'); return false;"></li>
		</ul>
	    </div>
       </a>
    
    </div>
    <div style=""><b><?=$Member['username'] ?></b> <br> <?=$Member['age'] ?> / <?=$Member['gender'] ?></div>
	
	</div>
<?  $i++; if($i==5){$i=1;}  } ?>	

<? }elseif($search_type=="detail" && isset($SearchData[1]['TotalResults']) && $SearchData[1]['TotalResults'] > 0 ){ 
	 /**
	 * Page: Search Detailed View
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
	
	<!-- SEARCH DETAIL VIEW -->
	<? $i=1; foreach($search_data as $Member){ ?>


	<div class="Acc_ListBox <? if($Member['ThisApproved'] !="active"){ ?>search_display_unapproved<? }else{ if($i % 2){ ?>search_display_off<? }else{ ?>search_display_on<? } } ?>" id="div_<?=$Member['id'] ?>">
	<div class="Acc_ListBox_left <? if($Member['featured']=="yes"){ ?>highlighted3<? } ?>"><div class="pic75">
		<div align="center" style="font-size:11px; margin-left:-15px;">
		<a class="photo_75" href="<?=$Member['link'] ?>"><img src="<?=$Member['image'] ?>" alt="<?=$Member['username'] ?>"  width="96" height="96"></a> 
		<br><b><?=$Member['username'] ?></b> <? if(D_FRIENDS==1){ ?><br><a href="<?=DB_DOMAIN ?>search/friends/<?=$Member['id'] ?>"><?=$GLOBALS['_LANG']['_friendsList'] ?></a> <? } ?></div>
	</div></div>

	<div class="Acc_ListBox_right">	
	<div class="Acc_ListBox_right1">
	<div class="Acc_ListBox_title_break"><a href="<?=$Member['link'] ?>"><?=$Member['headline'] ?></a></div>
	<b style="font-size:13px;">

	<? if($Member['genderID'] != 2710){ print $Member['age']." ".$GLOBALS['_LANG']['_yold']; } ?>
   <? if(D_STARSIGN ==1){ ?>(<?=$Member['starsign'] ?>)<? } ?> / <? if($Member['genderID'] == 2710){?> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/couple.gif" align="absmiddle"><? } ?><?=$Member['gender'] ?> / <?=$Member['country'] ?> 
	
	
	<? if($Member['onlinenow']){ ?> - <font color="#FF0000"><strong><?=$GLOBALS['_LANG']['_online'] ?></strong></font>  <? } ?> 
	<? if($Member['video_duration'] > 0){ ?> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_search/livevid.gif"> <? } ?>

	</b><br>
	<?=$Member['description'] ?>


	<div class="Acc_ListBox_margin5"> <? if($Member['status'] !=""){ ?>- <?=$Member['username'] ?> <?=$GLOBALS['_LANG']['_pSmsg'] ?> <?=$Member['status'] ?> - <?=ShowTimeSince($Member['lastlogin']); ?> <? } ?> </div></div><div class="Acc_ListBox_right2"><div>

	<? if(!isset($NETWORKD_FRIEND_ID)){ if($_SESSION['uid'] !=$Member['id']){  ?>
	
    		<? if(D_TEMP != "v17red")	{?>
        <div class="container">
        
        <div class="dropdown test my_tasklist">
        <button class="btn btn-primary dropdown-toggle dropmenus" id="" type="button" data-toggle="dropdown">
        <span class="send_message">Send message</span><span class="caret"></span></button><ul class="dropdown-menu"><? }?>
        
        <? if($Member['onlinenow'] && $_SESSION['uid'] !=$Member['id'] && D_IM ==1 && $_SESSION['auth'] =="yes" ){ ?>
        	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/comments.png" width="16" height="16" align="absmiddle">
        	<a <? if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="javascript:void(0);" onclick="openIMWin(<?=$Member['id'] ?>, '<?=$_SESSION['uid'] ?>','<?=DB_DOMAIN ?>','<?=$IMRoomArray['path'] ?>','<?=$IMRoomArray['width'] ?>','<?=$IMRoomArray['height'] ?>'); return false;" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?>>  <? if(D_TEMP != "v17red"){?><li><? }?><?=$GLOBALS['_LANG']['_pChat'] ?>  <? if(D_TEMP != "v17red")	{?></li> <? }?></a><br> <? } ?>
        
            <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?> <? if(is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("messages-create",$PACKAGEACCESS[$_SESSION['packageid']])){ ?>href="<?=getThePermalink('messages/create/'.$Member['username'])?>" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?> <? }else{ ?>href="<?=DB_DOMAIN ?>login"<? } ?>><? if(D_TEMP != "v17red")	{?><li><? }?><?=$GLOBALS['LANG_COMMON'][9] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a><br>
			<? if(D_HOTLIST ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/heart.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?>href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,1); alert('<?=$GLOBALS['_LANG']['_updated'] ?>'); return false;" <? }else{ ?>href="<?=DB_DOMAIN ?>login"<? } ?>> <? if(D_TEMP != "v17red")	{?><li><? }?><?=$GLOBALS['_LANG']['_hotList'] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a><br><? } ?>
			<? if(D_FRIENDS ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_green.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?>href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,2);alert('<?=$GLOBALS['_LANG']['_updated'] ?>');return false;" <? }else{ ?>href="<?=DB_DOMAIN ?>login"<? } ?>><? if(D_TEMP != "v17red")	{?><li><? }?><?=$GLOBALS['_LANG']['_friendsList'] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a><br><? } ?>
			<? if(D_WINK ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?> <? if(is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-wink",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="#" onclick="openQuickWink(<?=$Member['id'] ?>,'<?=$Member['username'] ?>','<?=$Member['image'] ?>'); return false;" <? }else{ ?> href="<?=DB_DOMAIN ?>subscribe" <? } ?> <? }else{ ?>href="<?=DB_DOMAIN ?>login"<? } ?>><? if(D_TEMP!= "v17red"){?><li><? }?><?=$GLOBALS['LANG_COMMON'][10] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a> <br><? } ?>
			<? if(D_FOLLOW ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?>href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,8); alert('<?=$GLOBALS['_LANG']['_updated'] ?>'); return false;" <? }else{ ?>href="<?=DB_DOMAIN ?>login"<? } ?>>Follow Me</a><br> <? } ?>
	   <? if(D_TEMP != "v17red")	{?>	</ul></div>
       
       	</div><? }?>	

	<? } }else{ ?>

			<? if(($_SESSION['uid'] !=$Member['id']) && ($_SESSION['uid'] == $NETWORKD_FRIEND_ID)){  ?>
			<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> <a href="#" onclick="DeleteNetwork(<?=$Member['id'] ?>,<?=$NETWORK_ID ?>); Effect.Fade('div_<?=$Member['id'] ?>');  return false;"><?=$GLOBALS['_LANG']['_remove'] ?></a><br>
 
			<? } ?>
			<? if(isset($Member['networkApprove']) && $Member['networkApprove'] =="no"){ ?>			
				<img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/thumb_up.png" align="absmiddle"> <a href="#" onclick="ApproveNetwork(<?=$Member['id'] ?>,<?=$NETWORK_ID ?>); return false;"><?=$GLOBALS['_LANG']['_approve'] ?></a><br> 
			<? } ?>
		
			<? if(($_SESSION['uid'] !=$Member['id']) && ($_SESSION['uid'] == $NETWORKD_FRIEND_ID)){  ?><span id="ChangeType<?=$i ?>"><img src="images/DEFAULT/_acc/plugin.png" align="absmiddle"> <a href="#" id="" onClick="ChangeRelationship('ChangeType<?=$i ?>',<?=$NETWORK_ID ?>,<?=$Member['id'] ?>,'div_<?=$Member['id'] ?>');return false;">Change Relationship</a></span><? } ?>

	<? } ?>

	<?=ModeratorOptions($page, $show_page, $Member) ?>
						
	</div>
	</div>
	<div class="clear"></div></div><div class="clear"></div>
	</div>


	<div class="ClearAll"></div>
	<?  $i++; } ?>		
	<!-- END GALLERY BSIC VIEW -->
<?
}
?>
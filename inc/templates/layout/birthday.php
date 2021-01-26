<?
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>

<div id="main">         
    <div id="main_content_wrapper">     


    <? if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer' style="padding:10px 20px;"> <? } ?>   
        
     <div class="clear"></div>

    <? if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
    <div id="messages">
          <div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
          <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="<?=DB_DOMAIN?>images/DEFAULT/_icons/16/menu.gif"></a>
          <?=$ERROR_MESSAGE ?>
        </div>
        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
    </div>
    <? } ?>
<style>
 .menu_box_body1 .margin-b
  {
	  width:100%;
	  float:left;
      margin:3px 0px;  	 
  }

    .menu_box_body1 .MainBtn {
      padding: 6px 12px!important;
     }
 .MainBtn_res  
 {
	border-color: #f44336;
    color: #fff;
    background-color: #f44336;
    border-radius: 5px;
    padding-right: 11px;
    border: none;
    padding-left: 11px;
    margin: 4px 0px;
 }
  </style>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>

<? if(isset($show_page) && $show_page=="home"){ 


	 /**
	 * Page: Account Options
	 *
	 * @version  9.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>

 
<div id="eMeeting" class="user">
  <div class="header account_tabs">
    <ul>
		<li <? if(!isset($NETWORKD_FRIEND_ID) && !isset($_POST['displaytype'])){ ?> class="selected" <? } ?>><a href="<?= getThePermalink('search') ?>"><span><?=$GLOBALS['LANG_COMMON'][2] ?> </span></a> </li>
		<li <? if(isset($_POST['displaytype']) && $_POST['displaytype']=="basic"){?>class="selected" <? } ?> > <a href="#" onclick="ChangeSearchDisplay('basic'); return false;"> <span><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/s2.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_sort0'] ?></span></a></li>
		<li <? if(isset($_POST['displaytype']) && $_POST['displaytype']=="gallery"){?>class="selected" <? } ?>> <a href="#" onclick="ChangeSearchDisplay('gallery'); return false;"><span><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/s4.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_sort1'] ?></span></a> </li>
		<li <? if(isset($_POST['displaytype']) && $_POST['displaytype']=="detail"){?>class="selected" <? } ?>> <a href="#" onclick="ChangeSearchDisplay('detail'); return false;"><span><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/s3.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_sort2'] ?></span></a></li>
   </ul>
    <div class="ClearAll"></div>
 </div>
</div>
 <br>
<div class="Search_links">

<div style="float:left;height:40px;">
<a href="<?= getThePermalink('search/advanced') ?>" style="text-decoration:none;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/search.gif" align="absmiddle"> <?=$GLOBALS['LANG_COMMON'][15] ?></a>
<img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/vcard_edit.png" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?> onclick="javascript:SavePage();" href="#" <? }else{ ?> href="<?= getThePermalink('login') ?>" <? } ?> style="text-decoration:none;"><?=$LANG_ERROR['_t12'] ?> </a>
</div>

<? if($_SESSION['auth'] =="yes"){ 

	 /**
	 * Page: Display Friends Value
	 *
	 * @version  9.0
	 */
	$MyFriends = GetFriendCounter();
?>


		<div style="float:right; height:30px; line-height:27px; font-size:12px;">
		<? if(D_FRIENDS ==1){ ?><a href="<?= getThePermalink('search/friends/'.$_SESSION['uid'].'/detail') ?>"><span><?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_friendsList'] ?> (<?=$MyFriends[1]['total'] ?>)</span></a>   -<? } ?>
		<? if(D_HOTLIST ==1){ ?> <a href="<?= getThePermalink('search/friends/'.$_SESSION['uid'].'/1/detail') ?>"><span><?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_hotList'] ?> (<?=$MyFriends[2]['total'] ?>)</span></a> -<? } ?>
		 <a href="<?= getThePermalink('search/friends/'.$_SESSION['uid'].'/3/detail') ?>"><span><?=$GLOBALS['_LANG']['_blockList'] ?> (<?=$MyFriends[3]['total'] ?>)</span></a> -
		 <? if(D_PARTNER ==1){ ?><a href="<?= getThePermalink('search/friends/'.$_SESSION['uid'].'/5/detail') ?>"><span>My Partner (<?=$MyFriends[4]['total'] ?>)</span></a><? } ?>
		<? if(D_FOLLOW ==1){ ?><a href="<?= getThePermalink('search/friends/'.$_SESSION['uid'].'/8/detail') ?>"><span>Followers</span></a><? } ?>
		
</div>
<? } ?>

</div>

<div class="ClearAll"></div>

 <div id="SearchAlert"></div>
 
<style>
.search { float:left; width:160px; height:35px; }
</style>
<div id="eMeetingContentBox">



<?=$ThisPersonsNetworkBar ?>

	<div id="Results" style="border-top:1px; height:35px;"> 
		<span class="a1" style="font-size:14px;line-height:35px;"> <b><?=number_format($search_data[$DataCounter]['TotalResults']) ?></b> <?=$GLOBALS['_LANG']['_results'] ?> </span>
		 <?=$Search_Page_Numbers ?> 
	</div>
	
	

	<?
	if(isset($_GET['view_page'])){
		$view_page = strip_tags($_GET['view_page']);
	}else{
		$view_page = 1;
	}
	?>

	<form name="SearchResults" method="post" action="<?= getThePermalink('birthday/view/'.$view_page)?>">
	
	
    <?php if(MATCH_PD == 'dynamic'){ ?>         
    <input name="do" type="hidden" value="dynamic_search" class="hidden">
    <?php } ?>         

	<input name="do_page" type="hidden" value="birthday" class="hidden">
	<input name="searchPage" type="hidden" id="searchPage" value="1" class="hidden">
	<input name="SavePage" type="hidden" id="SavePage" value="0" class="hidden">
	<input name="displaytype" type="hidden" value="<? if(isset($_POST['displaytype'])){ print strip_tags($_POST['displaytype']); }else{ print SEARCH_PAGE_DISPLAY; } ?>" id="displaytype" class="hidden">
	
	<input name="dpage" type="hidden" value="1" class="hidden" id="Dpage">

	<input name="page" type="hidden" value="<? if(isset($_GET['view_page']) && is_numeric($_GET['view_page']) ){ print strip_tags($_GET['view_page']); }else{print "1"; } ?>" class="hidden" id="Spage">
	<? if(isset($_POST['postcode_value'])){ ?><input name="postcode_value" type="hidden" value="<?=$_POST['postcode_value'] ?>" class="hidden"><? } ?>
	<? if(isset($_POST['zipcode_value'])){ ?><input name="zipcode_value" type="hidden" value="<?=$_POST['zipcode_value'] ?>" class="hidden"><? } ?>
	<? if(isset($_POST['postcode_distance']) && is_numeric($_POST['postcode_distance'])){ ?><input name="postcode_distance" type="hidden" value="<?=$_POST['postcode_distance'] ?>" class="hidden"><? } ?>
	<? if(isset($_POST['uk_postcode_distance']) && is_numeric($_POST['uk_postcode_distance'])){ ?><input name="uk_postcode_distance" type="hidden" value="<?=$_POST['uk_postcode_distance'] ?>" class="hidden"><? } ?>
	<? if(isset($_GET['online'])){ ?><input type="hidden" 	name="Extra[online]" 	value="1" class="hidden" ><? } ?>
	<? if(isset($_GET['friendid'])){ ?><input type="hidden" name="friendid" 	value="<? if(isset($_GET['friendid'])){ print $_GET['friendid']; }else{ print $_GET['friendid']; } ?>" class="hidden"><? } ?>
	<? if(isset($_POST['friendid'])){ ?><input type="hidden" name="friendid" 	value="<? print $_POST['friendid']; ?>" class="hidden"><? } ?>	
	<? if(isset($_GET['friend_type'])){ ?><input type="hidden" name="friend_type" 	value="<? print strip_tags($_GET['friend_type']); ?>" class="hidden"><? } ?>
	<? if(isset($_POST['friend_type'])){ ?><input type="hidden" name="friend_type" 	value="<? print strip_tags($_POST['friend_type']); ?>" class="hidden"><? } ?>

	<?
	
		if(isset($_POST['SeN']) && !empty($_POST['SeN']) ){	
		 foreach ($_POST['SeN'] as $key => $value ){
		   print "<input type='hidden' name='SeN[".$key."]' value='".$value."' class='hidden'>";	
		 }
		}
		 if(isset($_POST['SeV']) && !empty($_POST['SeV'])){
		  foreach ($_POST['SeV'] as $key => $value ){
			 print "<input type='hidden' name='SeV[".$key."]' value='".$value."' class='hidden'>";	
		  }
		 }
		 if(isset($_POST['SeT']) && !empty($_POST['SeT'])){
		  foreach ($_POST['SeT'] as $key => $value ){
			 print "<input type='hidden' name='SeT[".$key."]' value='".$value."' class='hidden'>";	
		  }
		 }
		 if(isset($_POST['Extra']) && !empty($_POST['Extra'])){
		  foreach ($_POST['Extra'] as $key => $value ){
			 print "<input type='hidden' name='Extra[".$key."]' value='".$value."' class='hidden'>";	
		  }	
		 }  
	 
	?>

<span id="response_search" class="responce_alert"></span>
<span id="profile_responce_span"></span>
<div id="searchblock"><div class="workblock">





<? if(!isset($SearchData[1]['TotalResults'])){ ?>

<div style="padding:50px;line-height:30px;"><h1><a href="<?= getThePermalink('search') ?>"> <?=$GLOBALS['_LANG_ERROR']['_noResults'] ?></a></h1></div>

<? } ?>



<? if($search_type=="basic" && isset($SearchData[1]['TotalResults']) && $SearchData[1]['TotalResults'] > 0){

	 /**
	 * Page: Search Basic View
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
<div id="SearchResultLoad">
	<!-- GALLERY BSIC VIEW -->
	<? $i=1; foreach($search_data as $Member){ ?>	
	<? if($i == 1){ ?><div class="workblockright" id="div_<?=$Member['id'] ?>"> <? }else{ ?> <div class="workblockleft" id="div_<?=$Member['id'] ?>"><? } ?>		
	<!-- END BLOCK TOPS -->
	
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

						<a href="<?= getThePermalink('messages/create/'.$Member['username']) ?>">
							<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png"></a>				
							<? if(D_FRIENDS ==1){ ?><a href="#" onclick="ProfileAddNet(<?=$Member['id'] ?>,2);alert('<?=$GLOBALS['_LANG']['_updated'] ?>');return false;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_green.png"></a>	<? } ?>					

							<? if(D_WINK ==1){ ?> <a <? if($_SESSION['auth'] =="yes"){ ?> <? if(is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-wink",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="#" onclick="openQuickWink(<?=$Member['id'] ?>,'<?=$Member['username'] ?>','<?=$Member['image'] ?>'); return false;" <? }else{ ?> href="<?= getThePermalink('subscribe') ?>" <? } ?> <? }else{ ?> href="<?= getThePermalink('login')?>"<? } ?>><img src="<?=DB_DOMAIN ?>images/DEFAULT/_search/wink.png"></a> <? } ?>

							<? if(D_HOTLIST ==1){ ?><a href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,1); alert('<?=$GLOBALS['_LANG']['_updated'] ?>'); return false;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/heart.png"></a><? } ?>
				
							<? if($Member['onlinenow'] && $Member['CanChat']=="yes" && D_IM ==1){ ?>
							<a href="javascript:void(0)" onclick="openIMWin(<?=$Member['id'] ?>, '<?=$_SESSION['uid'] ?>','<?=DB_DOMAIN ?>','<?=$IMRoomArray['path'] ?>','<?=$IMRoomArray['width'] ?>','<?=$IMRoomArray['height'] ?>'); return false;"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/comment.gif"></a>
							<? } ?>
							<? if($Member['video']){ ?>
							<a href="<?=$Member['link'] ?>"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_search/livevid.gif"></a>
							<? } ?>
						<? } ?>



					<? }else{ ?>

					<a href="<?=getThePermalink('login')?>">

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

</div>





<? }elseif($search_type=="gallery" && isset($SearchData[1]['TotalResults']) && $SearchData[1]['TotalResults'] > 0){ 
	 /**
	 * Page: Search Gallery View
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>




	<!-- GALLERY PHOTO VIEW -->
<div class="col-md-12" id="SearchResultLoad">
	<? $i=1; foreach($search_data as $Member){ ?>	
	<? if($i ==5){ ?><div class="galleryviewright"> <? }else{ ?> <div class="galleryviewleft" ><? } ?>
	
		<div class="gallery_search <?php if($Member['featured']=="yes"){ ?>highlighted2<? } ?>">
			
			<a href="<?=$Member['link'] ?>">
				<img src="<?=$Member['image'] ?>&y=135&x=135" class="img_border">
				<div class="member-hover-details">
					<ul class="member-hover-data">
						<li><span>Location:</span> <?=$Member['location'] ?>,<?=$Member['country'] ?></li>
						<li><span>Last login:</span> <?=date("M d",strtotime($Member['lastlogin'])) ?></li>
						<li><img src="/images/n_messages.png" onclick="window.location.href='<?= getThePermalink('messages/create'.$Member['username'])?>';return false;">  <img src="/images/n_winks.png" data-lightbox="QuickBox2" onclick="openQuickWink(<?=$Member['id'] ?>,'<?=$Member['username'] ?>','<?=$Member['image'] ?>&x=96&y=96'); return false;"></li>
					</ul>
				</div>
			</a>

		</div>
	<div><b><?=$Member['username'] ?></b> <br> <?=$Member['age'] ?> / <?=$Member['gender'] ?></div>
	
	</div>
	<?  $i++; if($i==5){$i=1;}  } ?>	
</div>	
	<!-- END GALLERY PHOTO VIEW -->

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
	<div id="SearchResultLoad">
	<? $i=1; foreach($search_data as $Member){ ?>


	<div class="Acc_ListBox <? if($Member['ThisApproved'] !="active"){ ?>search_display_unapproved<? }else{ if($i % 2){ ?>search_display_off<? }else{ ?>search_display_on<? } } ?>" id="div_<?=$Member['id'] ?>">
	<div class="Acc_ListBox_left <? if($Member['featured']=="yes"){ ?>highlighted3<? } ?>">
		<div align="center">
		<a class="photo_75" href="<?=$Member['link'] ?>"><img src="<?=$Member['image'] ?>" alt="<?=$Member['username'] ?>"></a> 
		<br><b><?=$Member['username'] ?></b> <? if(D_FRIENDS==1){ ?><br><a href="<?= getThePermalink('search/friends/'.$Member['id']) ?>"><?=$GLOBALS['_LANG']['_friendsList'] ?></a> <? } ?></div>
	</div>

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
        	<a <? if(isset($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-im",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="javascript:void(0);" onclick="openIMWin(<?=$Member['id'] ?>, '<?=$_SESSION['uid'] ?>','<?=DB_DOMAIN ?>','<?=$IMRoomArray['path'] ?>','<?=$IMRoomArray['width'] ?>','<?=$IMRoomArray['height'] ?>'); return false;" <? }else{ ?> href="<?=getThePermalink('subscribe')?>" <? } ?>>  <? if(D_TEMP != "v17red"){?><li><? }?><?=$GLOBALS['_LANG']['_pChat'] ?>  <? if(D_TEMP != "v17red")	{?></li> <? }?></a><br> <? } ?>
        
            <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?> <? if(is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("messages-create",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="<?= getThePermalink('messages/create/'.$Member['username']) ?>" <? }else{ ?> href="<?= getThePermalink('subscribe') ?>" <? } ?> <? }else{ ?> href="<?= getThePermalink('login') ?>"<? } ?>><? if(D_TEMP != "v17red")	{?><li><? }?><?=$GLOBALS['LANG_COMMON'][9] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a><br>
			<? if(D_HOTLIST ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/heart.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?>href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,1); alert('<?=$GLOBALS['_LANG']['_updated'] ?>'); return false;" <? }else{ ?>href="<?= getThePermalink('login') ?>"<? } ?>> <? if(D_TEMP != "v17red")	{?><li><? }?><?=$GLOBALS['_LANG']['_hotList'] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a><br><? } ?>
			<? if(D_FRIENDS ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_green.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?>href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,2);alert('<?=$GLOBALS['_LANG']['_updated'] ?>');return false;" <? }else{ ?>href="<?= getThePermalink('login') ?>"<? } ?>><? if(D_TEMP != "v17red")	{?><li><? }?><?=$GLOBALS['_LANG']['_friendsList'] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a><br><? } ?>
			<? if(D_WINK ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" width="16" height="16" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?> <? if(is_array($PACKAGEACCESS[$_SESSION['packageid']]) && !in_array("chatroom-wink",$PACKAGEACCESS[$_SESSION['packageid']])){ ?> href="#" onclick="openQuickWink(<?=$Member['id'] ?>,'<?=$Member['username'] ?>','<?=$Member['image'] ?>'); return false;" <? }else{ ?> href="<?= getThePermalink('subscribe') ?>" <? } ?> <? }else{ ?> href="<?= getThePermalink('login') ?>"<? } ?>><? if(D_TEMP!= "v17red"){?><li><? }?><?=$GLOBALS['LANG_COMMON'][10] ?><? if(D_TEMP != "v17red")	{?></li><? }?></a> <br><? } ?>
			<? if(D_FOLLOW ==1){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <a <? if($_SESSION['auth'] =="yes"){ ?>href="#"  onclick="ProfileAddNet(<?=$Member['id'] ?>,8); alert('<?=$GLOBALS['_LANG']['_updated'] ?>'); return false;" <? }else{ ?>href="<?= getThePermalink('login') ?>"<? } ?>>Follow Me</a><br> <? } ?>
	   <? if(D_TEMP != "v17red")	{?>	</ul></div>
       
       	</div><? }?>	

	<? } }else{ ?>

			<? if(($_SESSION['uid'] !=$Member['id']) && ($_SESSION['uid'] == $NETWORKD_FRIEND_ID)){  ?>
			<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> <a href="#" onclick="DeleteNetwork(<?=$Member['id'] ?>,<?=$NETWORK_ID ?>); Effect.Fade('div_<?=$Member['id'] ?>');  return false;"><?=$GLOBALS['_LANG']['_remove'] ?></a><br>
 
			<? } ?>
			<? if(isset($Member['networkApprove']) && $Member['networkApprove'] =="no"){ ?>			
				<img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/thumb_up.png" align="absmiddle"> <a href="#" onclick="ApproveNetwork(<?=$Member['id'] ?>,<?=$NETWORK_ID ?>); return false;"><?=$GLOBALS['_LANG']['_approve'] ?></a><br> 
			<? } ?>
		
			<? if(($_SESSION['uid'] !=$Member['id']) && ($_SESSION['uid'] == $NETWORKD_FRIEND_ID)){  ?><span id="ChangeType<?=$i ?>"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/plugin.png" align="absmiddle"> <a href="#" id="" onClick="ChangeRelationship('ChangeType<?=$i ?>',<?=$NETWORK_ID ?>,<?=$Member['id'] ?>,'div_<?=$Member['id'] ?>');return false;">Change Relationship</a></span><? } ?>

	<? } ?>

	<?=ModeratorOptions($page, $show_page, $Member) ?>
						
	</div>
	</div>
	<div class="clear"></div></div><div class="clear"></div>
	</div>


	<div class="ClearAll"></div>
	<?  $i++; } ?>		
	<!-- END GALLERY BSIC VIEW -->
	</div>
<? } ?>


 


</div></div>

	<div id="Bottom"><?=$Search_Page_Numbers ?></div>
	
	</form>

</div> <!-- end main box -->
		
	
	<form action="<?=DB_DOMAIN ?>index.php" method="POST">
	<input name="do_page" type="hidden" value="birthday" class="hidden">
	<input type="hidden" name="page" value="1" class="hidden">
	<span id="SearchHiddenField"></span>
	
	</form>


<? }elseif($show_page=="advanced"){ 

	 /**
	 * Page: Video Message
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    	<div class="row"> 
    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 advance_td">
            <div class="menu_box_title1"><?=$GLOBALS['_LANG']['_username'] ?> <?=$GLOBALS['_LANG']['_search'] ?></div>
            <div class="menu_box_body1" style="height:110px;">
            
            <form method="post" name="MemberSearch" action="<?=getThePermalink('search')?>">         
            <input name="do_page" type="hidden" value="search" class="hidden">
            <input type="hidden" name="page" value="1" class="hidden">
            <input type="hidden" name="Extra[zero]" value="1" class="hidden">
             <p><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_green.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_username'] ?></p>
            <input name="Extra[keyword]"  type="text" class="input" id="QKeyword">
            <input name="Extra[keyword_username]" type="hidden" value="1"><br><br>
            
            <input name="submit" type="submit" class="MainBtn"  value="<?=$GLOBALS['_LANG']['_search'] ?>">
            </form>
            </div>
       </div>
    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 advance_td">
            <div class="menu_box_title1"><?=$GLOBALS['_LANG']['_menue4'] ?></div>
            <div class="menu_box_body1" style="height:110px;">
            
            <form method="post" name="MemberSearch" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1">         
            <input name="do_page" type="hidden" value="search" class="hidden">
            <input type="hidden" name="page" value="1" class="hidden">
            <input type="hidden" name="Extra[zero]" value="1" class="hidden">
            
            <p><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/zoom_in.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_menue4'] ?></p>
            <input name="Extra[keyword]"  type="text" class="input" id="QKeyword">
            <input name="Extra[keyword_description]" type="hidden" value="1">
            <input name="Extra[keyword_headline]" type="hidden" value="1"><br><br>
             
            <input name="submit" type="submit" class="MainBtn"  value="<?=$GLOBALS['_LANG']['_search'] ?>">
            </form>
        
        	</div>
        </div>
    
        </div>
    	<div class="row"> 
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 advance_tdpostcode">  <!--advance_tdpostcode-->
    
			<? if(D_POSTCODES ==1 || D_ZIPCODES ==1){ ?> 
            <form method="post" name="MemberSearch" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1">         
            <input name="do_page" type="hidden" value="search" class="hidden">
            <input type="hidden" name="page" value="1" class="hidden">
            <input type="hidden" name="Extra[zero]" value="1" class="hidden">
            <div class="menu_box_title1">Postcode Search</div>
            
            <div class="menu_box_body1">
            
             <div class="row">
             
            <? if(D_POSTCODES ==1){ ?> 
            
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> <div class="margin-b">UK Postcode <input name="postcode_value" type="text" value="" onfocus="this.value='';" id="Q3"  style="width:125px;"></div></div>
                 
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"> <div class="margin-b">Within a: 
                  <select name="uk_postcode_distance" style="width:125px;">
                    <option value="10"> 10 km</option>
                    <option value="20">20 km</option>
                    <option value="30">30 km</option>
                    <option value="40">40 km</option>
                    <option value="50">50 km</option>
                    <option value="60">60 km</option>
                    <option value="70">70 km</option>
                    <option value="80">80 km</option>
                    <option value="90">90 km</option>
                    <option value="100">100 km</option>
                    <option value="200">200 km</option>
                    <option value="300">300 km</option>
                  </select>
                  <input value="<?=$GLOBALS['_LANG']['_search'] ?>" type="submit"  class="MainBtn_res"></div></div>
                  
            
            <? } ?>
                <? if(D_ZIPCODES ==1){ ?>
                
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="margin-b">USA Zipcode <input name="zipcode_value" type="text" value="" onfocus="this.value='';" id="Q4"  style="width:125px;">
                 </div></div>
                 
                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><div class="margin-b"> Within a:
                  <select name="postcode_distance" style="width:125px;">
                    <option value="10"> 10 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="20">20 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="30">30 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="40">40 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="50">50 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="60">60 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="70">70 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="80">80 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="90">90 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="100">100 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="200">200 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                    <option value="300">300 <?=$GLOBALS['_LANG']['_mile'] ?></option>
                  </select>
            <input name="submit" type="submit" class="MainBtn_res"  value="<?=$GLOBALS['_LANG']['_search'] ?>"></div></div>
            
            <? } ?><br>
            
            </div> </div>
            
            </form>
            <? } ?>
    
      	</div>
    
        </div>
      	<div class="row">
        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 advance_td">
            <div class="menu_box_title1"><?=$GLOBALS['_LANG']['_menue2'] ?></div>
            <div class="menu_box_body1">
            
            
            <form method="post" name="MemberSearch" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1">
            <input name="do_page" type="hidden" value="search" class="hidden">
            <input type="hidden" name="page" value="1" class="hidden">
            <input type="hidden" name="Extra[zero]" value="1" class="hidden">
            <? if(isset($_GET['friendid'])){ ?><input type="hidden" name="friendid" 	value="<? if(isset($_GET['friendid'])){ print $_GET['friendid']; }else{ print $_GET['friendid']; } ?>" class="hidden"><? } ?>
            <? if(isset($_POST['friendid'])){ ?><input type="hidden" name="friendid" 	value="<? print $_POST['friendid']; ?>" class="hidden"><? } ?>	
            <? if(isset($_GET['friend_type'])){ ?><input type="hidden" name="friend_type" 	value="<? print strip_tags($_GET['friend_type']); ?>" class="hidden"><? } ?>
            <? if(isset($_POST['friend_type'])){ ?><input type="hidden" name="friend_type" 	value="<? print strip_tags($_POST['friend_type']); ?>" class="hidden"><? } ?>
            
            
            
            <div class="menu_box_body" id="s77">
            
            <ul class="SearchOps">
             
             
            <?=DisplayBrowse() ?>
            
            
            
            <br>
            <li class="Stop"> <input type="checkbox" name="Extra[pics]" value="1"> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/photo.png" align="absmiddle"> <strong><?=$GLOBALS['_LANG']['_withPics'] ?></strong> </li>
            <li class="Stop"> <input type="checkbox" name="Extra[online]" value="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_orange.png" align="absmiddle"> <strong><?=$GLOBALS['_LANG']['_online'] ?> <?=$GLOBALS['_LANG']['_now'] ?></strong></li>
            <li class="Stop"> <input type="checkbox" name="Extra[newtoday]" value="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/thumb_up.png" align="absmiddle"> <strong><?=$GLOBALS['_LANG']['_joinToday'] ?></strong> </li>   
            <li class="Stop"> <input type="checkbox" name="Extra[birthday]" value="1"> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cake.png" align="absmiddle"> <strong><?=$GLOBALS['_LANG']['_menue5'] ?></strong> </li>  
            <li class="Stop"> <input type="checkbox" name="Extra[featured]" value="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" align="absmiddle"> <strong><?=$GLOBALS['LANG_COMMON'][18] ?></strong> </li>
            <? if(FLASH_VIDEO =="yes"){ ?><li class="Stop"> <input type="checkbox" name="Extra[livevideo]" value="1"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/webcam.png" align="absmiddle"> <strong><?=$LANG_ACCOUNT_MENU['video'] ?></strong> </li>  <? } ?>
            
                <li class="sub"><a href="#" onClick="toggleLayer('SearchOp1I1'); return false;"> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/16/bullet_go.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_menue6'] ?></a></li>
                <span id="SearchOp1I1" style="display:none;">
                <select name="Extra[period]" style="width:140px;">
                <option value="0"> -- <?=$GLOBALS['_LANG']['_menue7'] ?> --</option>
                <option value="7">7 <?=$GLOBALS['_LANG']['_days'] ?></option>
                <option value="14">2 <?=$GLOBALS['_LANG']['_weeks'] ?></option>
                <option value="31">1 <?=$GLOBALS['_LANG']['_months'] ?></option>
                <option value="155">5 <?=$GLOBALS['_LANG']['_months'] ?></option>
                <option value="365">1 <?=$GLOBALS['_LANG']['_year'] ?></option>
                </select>
                </span>
            
                 
            
            <? if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" && $value['ThisApproved'] !="active"){ ?>
            
            <li><input type="checkbox" name="Extra[unapproved]" value="1"><strong> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/user_orange.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_menue11'] ?></strong></li>
            <? } ?>		
            
            <li><select name="Extra[sort]" class="input" style="width:185px">		<option value="1">---> <?=$GLOBALS['_LANG']['_sort'] ?>  </option>	<option value="1"><?=$GLOBALS['_LANG']['_menue10'] ?></option>   <option value="2"><?=$GLOBALS['_LANG']['_photos'] ?></option>	  <option value="3"><?=$GLOBALS['_LANG']['_sort5'] ?></option> <option value="4"><?=$GLOBALS['_LANG']['_updated'] ?></option> <option value="5"><?=$GLOBALS['_LANG']['_username'] ?></option> <option value="6"><?=$GLOBALS['_LANG']['_gender'] ?></option>  <option value="7"><?=$GLOBALS['_LANG']['_age'] ?></option>  </select></li>
            
            <li style="height:30px;"><div align="center" style="margin-top:10px;"><input name="submit" type="submit" class="MainBtn"  value="<?=$GLOBALS['_LANG']['_search'] ?>"></div></li>
            
            </ul>
            
            
            </div>
            </form>
            </div>
    	</div>
    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 advance_td">
            <div class="menu_box_title1"><?=$GLOBALS['_LANG']['_menue3'] ?></div>
            <div class="menu_box_body1">
            <ul class="SearchOps">
            <li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="<?=getThePermalink('search')?>"><?=$GLOBALS['_LANG']['_viewAll'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></li>
                <li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(0,0,0,1,0,0,0); return false;"><?=$GLOBALS['_LANG']['_online'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></li>
                <li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(1,0,0,0,0,0,0); return false;"><?=$GLOBALS['_LANG']['_latest'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></li>
                <li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(0,0,0,0,0,1,0); return false;"><?=$GLOBALS['_LANG']['_featured'] ?> <?=$GLOBALS['_LANG']['_members'] ?></a></li>
                <li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/zoom.png" align="absmiddle"> <a href="#" onclick="MakeSearchOptions(0,0,0,0,0,0,1); return false;"><?=$GLOBALS['_LANG']['_members'] ?> <?=$GLOBALS['_LANG']['_withPics'] ?></a></li>
            </ul>
            </div>
    	</div>
    	</div>
    </div>
</div>

<script>
function MakeSearchOptions(newtoday, birthday, fav, onlinenow, highlight, featured, pics){

	if(newtoday ==1){
		document.getElementById('se_newtoday').value='1';
	}
	if(birthday ==1){
		document.getElementById('se_birthday').value='1';
	}
	if(featured ==1){
		document.getElementById('se_featured').value='1';
	}
	if(onlinenow ==1){
		document.getElementById('se_onlinenow').value='1';
	}
	if(highlight ==1){
		document.getElementById('se_highlight').value='1';
	}	
	if(fav ==1){
		document.getElementById('se_favorite').value='1';
	}
	if(pics ==1){
		document.getElementById('se_pics').value='1';
	}
	
	document.QuickSearch.submit();	
}
</script>





	<form class="clearfix" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1" method="POST" name="QuickSearch" id="QuickSearch">          
		<input name="do_page" 	type="hidden" 			value="search" class="hidden">
		<input type="hidden" 	name="page" 			value="1" class="hidden">
		<input type="hidden" 	name="Extra[newtoday]" 	value="0" class="hidden"	id="se_newtoday">
		<input type="hidden" 	name="Extra[favorite]" 	value="0" class="hidden"	id="se_favorite">
		<input type="hidden" 	name="Extra[birthday]" 	value="0" class="hidden" 	id="se_birthday">
		<input type="hidden" 	name="Extra[online]" 	value="0" class="hidden" 	id="se_onlinenow">
		<input type="hidden" 	name="Extra[pics]" 		value="0" class="hidden" 	id="se_pics">
		<input type="hidden" 	name="Extra[featured]" 	value="0" class="hidden" 	id="se_featured">
		<input type="hidden" 	name="Extra[highlighted]" value="0" class="hidden" 	id="se_highlight">
		<input type="hidden" 	name="SeN[1]" 	value="0" class="hidden">
		<input type="hidden" 	name="SeV[1]" 	value="0" class="hidden">
		<input type="hidden" 	name="SeT[1]" 	value="0" class="hidden">
	</form>
 

<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>

<?php
if(MATCH_PD == 'dynamic'){
?>
<script type="text/javascript">
	document.addEventListener('scroll', function (event) {

	if (document.body.scrollHeight < 
        document.body.scrollTop +        
        window.innerHeight + 200) {
    	
 		var message = new Object();
		message.loading = 'Loading...';
		message.success = 'Thank you. Application received!';
		message.failure = 'Whoops! There was a problem sending your message.';

		var dpage = parseInt(document.getElementById('Dpage').value);
		dpage = dpage + 1;
		document.getElementById('Dpage').value = dpage;
		
		var form = document.SearchResults;

		var statusMessage = document.createElement('div');
		statusMessage.className = 'status';

		// Set up the AJAX request
		var request = new XMLHttpRequest();
		request.open('POST', '/inc/ajax/_actions_search.php', true);
		request.setRequestHeader('accept', 'application/json');
		// Listen for the form being submitted
		//form.addEventListener('submit', function(evt) {
		    
	    //form.appendChild(statusMessage);

	    // Create a new FormData object passing in the form's key value pairs (that was easy!)
	    var formData = new FormData(form);

	    // Send the formData
	    request.send(formData);

	    // Watch for changes to request.readyState and update the statusMessage accordingly
	    request.onreadystatechange = function () {
	        // <4 =  waiting on response from server
	        if (request.readyState < 4)
		        statusMessage.innerHTML = message.loading;
    			// 4 = Response from server has been completely loaded.
        	else if (request.readyState === 4) {
	            // 200 - 299 = successful
    	        if (request.status == 200 && request.status < 300){
	    	        document.getElementById("SearchResultLoad").innerHTML = document.getElementById("SearchResultLoad").innerHTML +request.responseText;
    	        }

    		}
		}
		//});
    }
	});
</script>
<?php
}
?>

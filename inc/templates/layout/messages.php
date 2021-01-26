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
          <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
          <?=$ERROR_MESSAGE ?>
        </div>
        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
    </div>
    <? } ?>
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>




<? if(isset($show_page) && ( $show_page !="home"  ) ){  ?>

<link rel="stylesheet" href="<?=DB_DOMAIN ?>inc/css/_profile.css" type="text/css">
<div id="eMeeting" class="user">
  <div class="header account_tabs">
    <ul>
	 	<li <? if($show_page=="inbox"){ ?>class="selected"<? } ?>><a href="<?=getThePermalink('messages/inbox')?>"><span><?=$GLOBALS['LANG_COMMON'][36] ?></span></a></li>
		<li <? if($show_page=="create"){ ?>class="selected"<? } ?>><a href="<?=getThePermalink('messages/create')?>"><span><?=$LANG_MESSAGES_MENU['create'] ?></span></a></li>
    </ul>
    <div class="ClearAll"></div>
 </div>
</div>
<br>
<? } ?>



<? if($show_page=="home"){ 


	 /**
	 * Page: Messages Overview
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */


?>


<!--<b class="b1f"></b><b class="b2f"></b><b class="b3f"></b><b class="b4f"></b>--><div class="contentf"><div><div> <h3 style="padding:0px; margin:0px;">
</div>
<b class="i1f"></b><b class="i2f"></b><b class="i3f"></b><b class="i4f"></b><div class="contenti" style="margin-left:0px;">
	



 
<style>
.s1 { background: url(images/DEFAULT/_icons/new/acc/mail_1.png) no-repeat; background-position: 0% 50%}
.s2 { background: url(images/DEFAULT/_icons/new/acc/mail_2.png) no-repeat; background-position: 0% 50%}
.s3 { background: url(images/DEFAULT/_icons/new/acc/mail_3.png) no-repeat; background-position: 0% 50%}
.s4 { background: url(images/DEFAULT/_icons/new/acc/mail_4.png) no-repeat; background-position: 0% 50%}
.s5 { background: url(images/DEFAULT/_icons/new/acc/mail_5.png) no-repeat; background-position: 0% 50%}
</style>

<?=BuildPageHomeMenu($SubSub_Lang, $page) ?>



<br><br>
</div>
<b class="i4f"></b><b class="i3f"></b><b class="i2f"></b><b class="i1f"></b></div></div><b class="b4f"></b><b class="b3f"></b><b class="b2f"></b><b class="b1f"></b>


<div class="ClearAll"></div>






<? }elseif($show_page=="create"){

	 /**
	 * Page: Create Message
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>


<script src="<?=DB_DOMAIN ?>inc/js/lay/controls.js" type="text/javascript"></script>



	<!-- ****************** UPLOAD WAITING / LOADING SCREEN ************** -->
	<div id="UploadWait"> 
	<ul class="form"> 
	<div class="CapBody">	
		<p><strong><?=$GLOBALS['LANG_MESSAGES']['a3'] ?></strong></p>
		<p><?=$GLOBALS['LANG_MESSAGES']['a4'] ?></p>
		<p><img src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/loading.gif"></p>
	</div>
	</ul>
	</div>
	<!-- **************************************************************** --> 

<div id="SendMsgBoxDiv" style="display:visible;">
<span id="response_message" class="responce_alert"></span>

 
<div class="CapBody" style="padding:0px;">
<!-- END BOX -->
<form method="post" action="<?=DB_DOMAIN ?>index.php"  onSubmit="return CheckNullsMessages();" enctype="multipart/form-data">

		<div id="Display_Message">
			
			
			<input name="do" type="hidden" value="add" class="hidden">
			<input name="do_page" type="hidden" value="messages" class="hidden">
			<input name="sub" type="hidden" value="create" class="hidden">
			<input name="addCardID" id="addCardID" type="hidden" value="0" class="hidden">
			<input type="hidden" value="1" name="StopConfigStrip"/>


<? if (D_FRIENDS == 1) { ?>
			<!-- DISPLAY FRIENDS FOR QUICK ADD -->
			<div id="myContacts">
			<h2><?=$GLOBALS['LANG_COMMON'][3] ?></h2>
			<ol>
			<? $i=1; foreach($msg_friends as $value){ ?>
				<li id="adduser_<?=$i ?>"> <dt style="float:left;"><img src="<?=$value['image'] ?>" width="40" height="40"></dt> <dt><a href="#" onclick="Effect.Fade('adduser_<?=$i ?>'); AddSendTo('<?=$value['username'] ?>'); return false;"><?=$value['username'] ?></a></dt><div class="ClearAll"></div></li>
			<? $i++;} ?>
			</ol>
			</div>
			<!-- END QUICK ADD -->
<? } ?>
		
			<!-- DISPLAY MESSAGE BOX -->
			<div id="send_Message_box" style="">
			<ul class="form"> 
				<li><label><?=$GLOBALS['_LANG']['_username'] ?>: </label><input name="to" id="SendTo" size="35" style="" type="text" class="input" autocomplete="off" value="<? if (isset($msg_to)) { print eMeetingOutput($msg_to); } ?>">
				<div class="tip"><?=$GLOBALS['LANG_MESSAGES']['a6'] ?></div><div id="update" style="display: none; position:relative;"></div>
				</li>

				<li><label><?=$GLOBALS['_LANG']['_subject'] ?>: </label><input name="subject" id="SentSubject" type="text" size="35" class="input" style="" value="<? if (isset($msg_subject)) { print $msg_subject; }  if (isset($_GET['msg_subject'])) { print eMeetingInput($_GET['msg_subject']); } if (isset($_POST['msg_subject'])) { print eMeetingInput($_POST['msg_subject']); } ?>"></li>
				<li><label><?=$GLOBALS['_LANG']['_message'] ?></label><textarea name='message' id="formMessage" rows=7 class="input" style=""><? if (isset($msg_content)) { print eMeetingInput($msg_content); } ?></textarea>
				<? if(D_MESSAGE_CARDS ==1){ ?>				
				<div>
					<input type="image" src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/grin.gif" onclick="AddMsgIcon(':)');return false;">
					<input type="image" src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/tongue.gif" onclick="AddMsgIcon(':P');return false;">
					<input type="image" src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/wink.gif" onclick="AddMsgIcon(':>');return false;">
					<input type="image" src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/sad.gif" onclick="AddMsgIcon(':(');return false;">
					<input type="image" src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/ecard.gif" onclick="toggleLayer('eCard'); return false;">
					<input type="image" src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/ephoto.gif" onclick="toggleLayer('eFiles'); return false;">
				</div>
				<? } ?>
				</li>
				<li style="display:none" id="eFiles"><label>Attach Private Photos</label>
				<input name="uploadFile00" type="file" id="uploadFile00" class="input"><br>
				<input name="uploadFile01" type="file" id="uploadFile01" class="input"><br>
				<input name="uploadFile02" type="file" id="uploadFile02" class="input">
				<input name="uploadFile03" type="file" id="uploadFile03" class="input">
				</li>		
				<li><input value="<?=$GLOBALS['LANG_COMMON'][9] ?>" type="submit" class="MainBtn"></li>					
			</ul>
			<!-- attached ecard alert -->
			<div id="response_ecard" class="response_alert"></div>
			<!-- end alert -->
			</div>
			
			
	</div>
	</div>		<!-- END MESSAGE BOX -->
		
		<!-- DISPLAY MESSAGE ECARD OPTIONS -->
		<div class="msgOptions row" style="display:none" id="eCard">
			  <div class="row"> 
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/1.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <input name="addCard" type="radio" value="1" onclick="AttCard(1); toggleLayer('eCard'); return false;"></div>
                </div>    
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/2.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="2"  onclick="AttCard(2); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/3.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="3"  onclick="AttCard(3); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/4.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="4"  onclick="AttCard(4); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
			  </div>
              
              <div class="row"> 
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/5.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <input name="addCard" type="radio" value="5" onclick="AttCard(5); toggleLayer('eCard'); return false;"></div>
                </div>    
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/6.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="6"  onclick="AttCard(6); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/7.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="7"  onclick="AttCard(7); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/8.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="8"  onclick="AttCard(8); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
			  </div>
              
              <div class="row"> 
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/9.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <input name="addCard" type="radio" value="9" onclick="AttCard(9); toggleLayer('eCard'); return false;"></div>
                </div>    
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/10.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="10"  onclick="AttCard(10); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/11.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="11"  onclick="AttCard(11); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                <div class="row"> 
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/cards/12.jpg" width="120" height="163" style="border: 1px solid #333333"></div>
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="radio" name="addCard" value="12"  onclick="AttCard(12); toggleLayer('eCard'); return false;"></div>
                </div>
                </div>
			  </div>
		</div>

</form>
</div>

<script type="text/javascript">
new Ajax.Autocompleter('SendTo','update','<?=DB_DOMAIN ?>inc/exe/Responce/response.php', { tokens: ','} );
</script>



<? }elseif($show_page=="inbox"){ 


	 /**
	 * Page: Message Inbox
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */
 
?>


<span id="response_message" class="responce_alert"></span>



	<div id="eMeetingContentBox">

	<div id="Title">
		<div class="AddIcon"><br><a href="<?= getThePermalink('messages/create') ?>" class="MainBtn">  <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <?=$LANG_MESSAGES_MENU['create'] ?></a></div>
		<span class="a1"><?=$PageTitle ?></span>
		<span class="a2"><?=$PageDesc ?></span>
	</div>
	<div id="Search">
		<span class="a1">
			<form method="post" action="<?=DB_DOMAIN ?>index.php" id="MessageDisplayTotal">
			<input name="do_page" type="hidden" value="messages" class="hidden">
			<input type="hidden" name="ChangeOrderTotal" value="maildate" id="ChangeOrderTotal" class="hidden">
			<input name="sub" type="hidden" value="<?=$selected_page ?>" id="sub" class="hidden">
			<select name="sto" onchange="location.href='<?=getThePermalink('messages')?>/'+this.value;" style="width:150px;font-size:12px;">
					<option value="inbox" <? if(isset($sub_page) && $sub_page=="index"){ print "selected"; } ?>><?=$LANG_MESSAGES_MENU['inbox'] ?> (<?=$MailCount[1]['total'] ?>)</option>

<? if(D_WINK ==1){ ?>

					<option value="wink" <? if(isset($sub_page) && $sub_page=="wink"){ print "selected"; } ?>><?=$LANG_MESSAGES_MENU['wink'] ?> (<?=$MailCount[2]['total'] ?>)</option>

<? } ?>

					<option value="sent" <? if(isset($sub_page) && $sub_page=="sent"){ print "selected"; } ?>><?=$LANG_MESSAGES_MENU['sent'] ?> (<?=$MailCount[3]['total'] ?>)</option>
					<option value="trash" <? if(isset($sub_page) && $sub_page=="trash"){ print "selected"; } ?>><?=$LANG_MESSAGES_MENU['trash'] ?> (<?=$MailCount[4]['total'] ?>)</option>
			
			</select> - 
			<select name="sto" onchange="this.form.submit();" style="width:150px;font-size:12px;">
					<option value="10"><?=str_replace("%s","10",$GLOBALS['_LANG']['_sort6']) ?></option>
					<option value="20"><?=str_replace("%s","20",$GLOBALS['_LANG']['_sort6']) ?></option>
					<option value="30"><?=str_replace("%s","30",$GLOBALS['_LANG']['_sort6']) ?></option>
					<option value="40"><?=str_replace("%s","40",$GLOBALS['_LANG']['_sort6']) ?></option>
					<option value="50"><?=str_replace("%s","50",$GLOBALS['_LANG']['_sort6']) ?></option>
			</select>


			</form>		
 	</span>
	<span class="a2"><?=isset($Search_Page_Numbers) ?></span>
	</div>
	<div id="Results"> 
		<span class="a1"> 	
			<? if(($show_page_current) > 1){ ?>
			<a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=<?=$selected_page ?>&sta=<?=$show_page_prev?><?=$show_page_rows?>&cpage=<?=$show_page_current-1; ?>"><</a>
			<? } ?>  
			 <?=$GLOBALS['_LANG']['_page'] ?> <?=$show_page_current ?> <?=$GLOBALS['_LANG']['_of'] ?> <?=$show_page_num_of ?>		
			<? if($show_page_current < $show_page_num_of){ ?>
			<a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=<?=$selected_page ?>&sta=<?=$show_page_next?><?=$show_page_rows?>&cpage=<?=$show_page_current+1; ?>">></a>
			<? } ?> 
		</span>
		<span class="a2"><?=$GLOBALS['_LANG']['_sort'] ?>: <a href="#" onclick="UpdateMailOrder('<?=$selected_page ?>','maildate'); return false;"><?=$GLOBALS['_LANG']['_date'] ?></a> | <a href="#" onclick="UpdateMailOrder('<?=$selected_page ?>','mailnum'); return false;"><?=$GLOBALS['_LANG']['_username'] ?></a> | <a href="#" onclick="UpdateMailOrder('<?=$selected_page ?>','mail_subject'); return false;"><?=$GLOBALS['_LANG']['_subject'] ?></a> </span>
	</div>


	
	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="MessagesBox" id="MessagesBox">
	<input name="do" type="hidden" value="delete" class="hidden">
	<input name="do_page" type="hidden" value="messages" class="hidden">
	<input name="sub" type="hidden" value="<?=$selected_page ?>" class="hidden">
	  
      <!--<div class="col-lg-12 hidden-xs">
      	<div class="col-sm-1 col-lg-1">
        </div>
        <div class="col-sm-2 col-lg-2">
        	<p><?=$GLOBALS['_LANG']['_username'] ?></p>
        </div>
        <div class="col-sm-9 col-lg-9">
        	<p><?=$GLOBALS['_LANG']['_subject'] ?></p>
        </div>
      </div>-->
      
      <div class="col-sm-12 col-lg-12">
      	<? $i=1; foreach($message_array as $value){ ?>
        	<div id="msg<?=$value['id'] ?>" <?php if($i % 2){ ?>class="search_display_off"<? }else{ ?>class="search_display_on"<? } ?>>
            	<div class="col-sm-1 col-lg-1 align-center_mobile">
	            	<input name="d<?=$i ?>" type="checkbox" value="on" class="margin_bottom_10"><input type="hidden" name="di<?=$i ?>" value="<?=$value['id'] ?>">
                </div> 
                
               
        		
                <div class="col-sm-2 col-lg-2 align-center_mobile">
                	<a href="<?=getThePermalink('user',array('username' => GetUsername($value['senderid'])))?>"><img src="<?=$value['image']; ?>" width="48" height="48"></a>
                </div>
        		
                
                 <div class="col-sm-5 col-lg-5 align-center_mobile">
					<a href="<?=getThePermalink('messages/read/'.$value['id'])?>" class="msgTitle"><?=$value['subject'] ?>

<? if($value['attachment'] =="yes"){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/photo.png" align="absmiddle"> <? }  ?>
</a>
		
		<a href="<?=getThePermalink('user',array('username' => GetUsername($value['senderid'])))?>" class="msgSub" style="text-decoration:none; font-size:11px;"> <? if(isset($_REQUEST['sub']) && $_REQUEST['sub'] !="sent"){ ?><?=$GLOBALS['_LANG']['_username'] ?>:<? }else{ ?><?=$GLOBALS['LANG_MESSAGES']['a21'] ?>: <? } ?> <?=$value['from'] ?> </a> -
		<a href="<?=getThePermalink('messages/read/'.$value['id'])?>" class="msgSub"  style="text-decoration:none; font-size:11px;"><?=$GLOBALS['_LANG']['_date'] ?>: <?=$value['date'] ?> @ <?=$value['time'] ?> </a> 
                </div>
                
                
                <div class="col-sm-2 col-lg-2 align-center_mobile">
	            	<?=$value['status'] ?>
                </div>
                
                <div class="col-sm-2 col-lg-2 align-center_mobile">
	            	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/read.gif" align="absmiddle"><a href="<?=getThePermalink('messages/read/'.$value['id'])?>"><?=$GLOBALS['_LANG']['_read'] ?></a><br>
	
	<? if(isset($_REQUEST['sub']) && $_REQUEST['sub'] != "sent"){ ?>
	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_msg/reply.gif" align="absmiddle"><a href="<?=getThePermalink('messages/create/'.$value['from'].'/'.$value['id'].'/RE:'.str_replace("'", "",$value['subject']))?>"><?=$GLOBALS['_LANG']['_reply'] ?></a><br>
	<? } ?>	
                </div>
        		
            </div>
        
        <? $i++; } ?>	
        
      </div>
	

	

	<? if(empty($message_array)){ ?><div align="center"><h1><?=$lang_messages_page['a36'] ?> </h1></div><? } ?>	

	<input type="hidden" name="totalMail" value="<?=$i ?>">			
	</form>

	<div id="Bottom">

	<? if(!empty($message_array)){ ?>

		<div style="float:left; font-size:12px; padding:8px;">
		
					<a href="javascript:void(0)" onClick="da(<?=$i ?>);return false;" class="MainBtn"><?=$GLOBALS['_LANG']['_selectAll'] ?></a> <a href="javascript:void(0)" onClick="du(<?=$i ?>);return false;" class="MainBtn"><?=$GLOBALS['_LANG']['_deselectAll'] ?></a> <a href="javascript:void(0)" onClick="javascript:document.MessagesBox.submit(); return false;" class="MainBtn"><?=$GLOBALS['_LANG']['_delete'] ?></a>
		
		</div>

		<div style="float:right; padding:10px; font-size:12px; font-weight:bold;">
		
					<? if(($show_page_current) > 1){ ?>
					<a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=<?=$selected_page ?>&sta=<?=$show_page_prev?><?=$show_page_rows?>&cpage=<?=$show_page_current-1; ?>"><</a>
					<? } ?>  
					 <?=$GLOBALS['_LANG']['_page'] ?> <?=$show_page_current ?> <?=$GLOBALS['_LANG']['_of'] ?> <?=$show_page_num_of ?>		
					<? if($show_page_current < $show_page_num_of){ ?>
					<a href="<?=DB_DOMAIN ?>index.php?dll=messages&sub=<?=$selected_page ?>&sta=<?=$show_page_next?><?=$show_page_rows?>&cpage=<?=$show_page_current+1; ?>">></a>
					<? } ?> 
		</div>

	<? } ?>

	</div>

	</div> <!-- end main box -->




<form method="post" action="<?=DB_DOMAIN ?>index.php" name="UpdateMail">
<input type="hidden" id="ChangeOrder" name="ChangeOrder" value="maildate" class="hidden">
<input type="hidden" id="sub" name="sub" value="<?=$selected_page ?>" class="hidden">
<input name="do_page" type="hidden" value="messages" class="hidden">
</form>








<? }elseif($show_page=="read"){ 

	 /**
	 * Page: Messages Read
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>



<b class="b1f"></b><b class="b2f"></b><b class="b3f"></b><b class="b4f"></b><div class="contentf"><div>
<!--<b class="i1f"></b><b class="i2f"></b><b class="i3f"></b><b class="i4f"></b>--><div class="contenti cust_new" style="margin-left:0px; border:0px">
	


<!-- DISPLAY MESSAGE -->
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div id="Display_Message">
        <? /*<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <h3 class="message_subj_head"><?=$msgdata[1]['subject'] ?> </h3>
        </div> */ ?>
        <div id="messages_read" class="small">
            <a href="<?= getThePermalink('user', array('username' => GetUsername($msgdata[1]['senderid']))) ?>"><img src="<?=$msgdata[1]['image']; ?>&x=98&y=98" class="preview"></a>
            <span>
                <h4 id="mail-subject"><?=$msgdata[1]['subject']; ?></h4>
                <p id="mail-contents"><?=$msgdata[1]['message']; ?></p>
                <p><small><?=$GLOBALS['_LANG']['_date'] ?> <?=$msgdata[1]['date']; ?> @ <?=$msgdata[1]['time'] ?></small></p>			
            </span>
            <div id="translate-message">
	            <select name="target_language" id="target_language">
					<option value="af">Afrikaans</option>
					<option value="sq">Albanian</option>
					<option value="am">Amharic</option>
					<option value="ar">Arabic</option>
					<option value="hy">Armenian</option>
					<option value="az">Azeerbaijani</option>
					<option value="eu">Basque</option>
					<option value="be">Belarusian</option>
					<option value="bn">Bengali</option>
					<option value="bs">Bosnian</option>
					<option value="bg">Bulgarian</option>
					<option value="ca">Catalan</option>
					<option value="ceb">Cebuano</option>
					<option value="zh-CN">Chinese (Simplified)</option>
					<option value="zh-TW">Chinese (Traditional)</option>
					<option value="co">Corsican</option>
					<option value="hr">Croatian</option>
					<option value="cs">Czech</option>
					<option value="da">Danish</option>
					<option value="nl">Dutch</option>
					<option value="en">English</option>
					<option value="eo">Esperanto</option>
					<option value="et">Estonian</option>
					<option value="fi">Finnish</option>
					<option value="fr">French</option>
					<option value="fy">Frisian</option>
					<option value="gl">Galician</option>
					<option value="ka">Georgian</option>
					<option value="de">German</option>
					<option value="el">Greek</option>
					<option value="gu">Gujarati</option>
					<option value="ht">Haitian Creole</option>
					<option value="ha">Hausa</option>
					<option value="haw">Hawaiian</option>
					<option value="iw">Hebrew</option>
					<option value="hi">Hindi</option>
					<option value="hmn">Hmong</option>
					<option value="hu">Hungarian</option>
					<option value="is">Icelandic</option>
					<option value="ig">Igbo</option>
					<option value="id">Indonesian</option>
					<option value="ga">Irish</option>
					<option value="it">Italian</option>
					<option value="ja">Japanese</option>
					<option value="jw">Javanese</option>
					<option value="kn">Kannada</option>
					<option value="kk">Kazakh</option>
					<option value="km">Khmer</option>
					<option value="ko">Korean</option>
					<option value="ku">Kurdish</option>
					<option value="ky">Kyrgyz</option>
					<option value="lo">Lao</option>
					<option value="la">Latin</option>
					<option value="lv">Latvian</option>
					<option value="lt">Lithuanian</option>
					<option value="lb">Luxembourgish</option>
					<option value="mk">Macedonian</option>
					<option value="mg">Malagasy</option>
					<option value="ms">Malay</option>
					<option value="ml">Malayalam</option>
					<option value="mt">Maltese</option>
					<option value="mi">Maori</option>
					<option value="mr">Marathi</option>
					<option value="mn">Mongolian</option>
					<option value="my">Myanmar (Burmese)</option>
					<option value="ne">Nepali</option>
					<option value="no">Norwegian</option>
					<option value="ny">Nyanja (Chichewa)</option>
					<option value="ps">Pashto</option>
					<option value="fa">Persian</option>
					<option value="pl">Polish</option>
					<option value="pt">Portuguese</option>
					<option value="pa">Punjabi</option>
					<option value="ro">Romanian</option>
					<option value="ru">Russian</option>
					<option value="sm">Samoan</option>
					<option value="gd">Scots Gaelic</option>
					<option value="sr">Serbian</option>
					<option value="st">Sesotho</option>
					<option value="sn">Shona</option>
					<option value="sd">Sindhi</option>
					<option value="si">Sinhala (Sinhalese)</option>
					<option value="sk">Slovak</option>
					<option value="sl">Slovenian</option>
					<option value="so">Somali</option>
					<option value="es">Spanish</option>
					<option value="su">Sundanese</option>
					<option value="sw">Swahili</option>
					<option value="sv">Swedish</option>
					<option value="tl">Tagalog (Filipino)</option>
					<option value="tg">Tajik</option>
					<option value="ta">Tamil</option>
					<option value="te">Telugu</option>
					<option value="th">Thai</option>
					<option value="tr">Turkish</option>
					<option value="uk">Ukrainian</option>
					<option value="ur">Urdu</option>
					<option value="uz">Uzbek</option>
					<option value="vi">Vietnamese</option>
					<option value="cy">Welsh</option>
					<option value="xh">Xhosa</option>
					<option value="yi">Yiddish</option>
					<option value="yo">Yoruba</option>
					<option value="zu">Zulu</option>
				</select>

            	<a href="javascript:void(0);" class="background_color" onclick="processTranslate(); return false;">Translate</a>
            </div>
        </div>
    </div>
  </div>

<!-- DISPLAY EXTRA IMAGES -->
<div style="margin-left:25px;">
<? $i=1; if(is_array($msgdata[1]['image_array'])){ foreach($msgdata[1]['image_array'] as $img){ ?>
<? if($i ==5){ ?><div class="galleryviewright"> <? }else{ ?> <div class="galleryviewleft"><? } ?>	
<div id="gallery_search"><a href="#" onclick="popUpWin('<?=WEB_PATH_IMAGE.$img['name'] ?>'); return false;"><img src="<?=WEB_PATH_IMAGE_THUMBS.$img['name'] ?>" class="thumb"></a></div>
</div>
<? $i++; if($i==5){$i=1;}  }} ?>
</div>
<div class="ClearAll"></div>
<!-- END EXTRA IMAGES -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		
		<span class="reply_btn">
		<input value="<?=(isset($GLOBALS['LANG_BODY']['_reply'])) ? $GLOBALS['LANG_BODY']['_reply'] : ''; ?>" class="MainBtn" type="button" onclick="javascript:location.href='<?=getThePermalink('messages/create/'.$msgdata[1]['username'].'/'.$msgdata[1]['id'].'/RE:'.str_replace("'", "",$msgdata[1]['subject']))?>'">
  </span>
		 <div class="ClearAll"></div>
</div>
<!-- END DISPLAY -->

<br><br>
</div>
<b class="i4f"></b><b class="i3f"></b><b class="i2f"></b><b class="i1f"></b></div></div><b class="b4f"></b><b class="b3f"></b><b class="b2f"></b><b class="b1f"></b>


<script type="text/javascript">
function ajax_get(url, callback) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log('responseText:' + xmlhttp.responseText);
            try {
                var data = JSON.parse(xmlhttp.responseText);
            } catch(err) {
                console.log(err.message + " in " + xmlhttp.responseText);
                return;
            }
            callback(data);
        }
    };
 
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
 
function processTranslate(){

	var messageSubject = document.getElementById('mail-subject').innerHTML;
	var messageContent = document.getElementById('mail-contents').innerHTML;

	var targetLang = document.getElementById('target_language').value;

	ajax_get('https://translation.googleapis.com/language/translate/v2/?key=AIzaSyBMxGFXRBuxcqD_kQ3OZ6MdrGQwr00hnzs&target='+ targetLang +'&q='+messageSubject, function(response) {
	
		document.getElementById('mail-subject').innerHTML = response.data.translations[0].translatedText;
		

	});
	
	ajax_get('https://translation.googleapis.com/language/translate/v2/?key=AIzaSyBMxGFXRBuxcqD_kQ3OZ6MdrGQwr00hnzs&target='+ targetLang +'&q='+messageContent, function(response) {
	
		document.getElementById('mail-contents').innerHTML = response.data.translations[0].translatedText;
		

	});
}
</script>



<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
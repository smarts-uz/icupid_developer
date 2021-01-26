<?
/**
* Page: MEMBER CHAT ROOM
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/exe/ChatRoom/
*/
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


<script type="text/javascript" src="<?=DB_DOMAIN ?>inc/js/_flash.js"></script>

<? if($ChatRoomArray['path'] == "inc/exe/ChatRoom/chat.php"){ ?>

	<SCRIPT language="JavaScript">
		displayeMeeting("inc/exe/ChatRoom/ChatRoom.swf?user=<? print $_SESSION['username']; ?>&wURL=<?=DB_DOMAIN ?>inc/exe/","650","400",{menu:"true",bgcolor:"#E4E6DA",version:"6,0,47,0",align:"middle",wURL:"<?=DB_DOMAIN ?>inc/exe/"});
	</SCRIPT>
<p style="padding:7px; background:#E4E6DA; border:1px solid #cccccc"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <a href="javascript:void(0);" onClick="NewpopUpWin('<?=DB_DOMAIN ?>inc/exe/ChatRoom/chat.php', 650, 400); return false;">Open Chat Window</a></p>
	

<? }elseif(file_exists($ChatRoomArray['path'])){ require_once($ChatRoomArray['path'])  ?>
<p style="padding:7px; background:#E4E6DA; border:1px solid #cccccc"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <a href="javascript:void(0);" onClick="NewpopUpWin('<?=DB_DOMAIN ?>plugins/plugins/userplane/chat.php', 760, 650); return false;">Open New Chat Window</a></p>

<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
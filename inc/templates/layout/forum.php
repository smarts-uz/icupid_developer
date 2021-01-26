<?
/**
* Page: COMMUNITY FORUM LINKED VIA AN IFRAME
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  /inc/exe/forum/
*/
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );

?>

<div id="main">         
    <div id="main_content_wrapper">     


    <? if(!isset($HEADER_SINGLE_COLUMN)){ ?><div class='conten_outer'> <? } ?>   
        
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
<div class="contentf" style="width:94%;margin:3%;"><div>
<div id="eMeetingContentBox">

		<div id="Title">
			<span class="a1"><?=$PageTitle ?></span>
			<span class="a2"><?=$PageDesc ?></span>
		</div>

<? if(FORUM_DEFAULT_ENABLED =="yes"){ ?>


		<div>
			<span class="a1"><form method="GET" action="<?=$forum_link ?>" target="ListFrame" style="float: left;margin-top: 2px;" ><input type="hidden" name="action" value="vtopic" />
		<select name="forum" class="selectTxt" style="width: 137px; margin-left: 17px;padding: 4px 0px;
    display: inline-block;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;">
			
		<? foreach($ForumListArray  as $forum){?><option value="<?=$forum['id'] ?>"><?=$forum['name'] ?></option><? } ?>

		</select>
		<input  type="submit" class="NormBtn" value="<?=$GLOBALS['_LANG']['_change'] ?>" style="font-size: 12;height: 27px;"></form>


			</span>
			<span class="a2">

			<form name="form1" method="GET" action="<?=$forum_link ?>" target="ListFrame" style="font-size: 11;">
			<input type="hidden" name="posterName" id="posterName"  class="textForm" value="" />
			<input type="hidden" name="action" value="search" />
			<input type="hidden" name="searchGo" value="1" />
			<input type="hidden" name="searchType" value="0" />
			<input type="hidden" name="forum" value="" />			
			<input name="phrase" type="text" class="input" id="phrase" style="margin-left: 4px;  padding: 5px 0px; display: inline-block; border: 1px solid #ccc; border-radius: 4px;
    box-sizing: border-box;">			
			<select name="where" id="where" class="selectTxt"><option value="1" selected="selected" style="padding: 6px 0px; display: inline-block; border: 1px solid #ccc; border-radius: 4px;
    box-sizing: border-box;"><?=$GLOBALS['_LANG']['_topic'] ?></option><option value="0"><?=$GLOBALS['_LANG']['_message'] ?></option></select>
			
			<input type="submit" name="Submit" value="<?=$GLOBALS['_LANG']['_search'] ?>"class="NormBtn" style="font-size: 12;height: 28px;">
			</form>
			</span>
		</div>
<? } ?>
		<iframe id="ListFrame" name="ListFrame" style="background:#ffffff; width:100%; height:1100px;border:0px;margin-top: 10px;" src="<?=DB_DOMAIN ?><?=$forum_link ?>" scrolling="yes" frameborder="0"></iframe>

	</form>


	</div> <!-- end main box -->
</div>
</div>
<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
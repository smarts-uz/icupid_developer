<?
/**
* Page: MUSIC PAGE DISPLAYS ALL MEMBER MUSIC FILES
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_music_page.php
*/
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



<? if($show_page=="search" || $show_page=="view"){ 

	 /**
	 * Page: Main Search
	 *
	 * @version  9.0
	 */

?>



	<div id="eMeetingContentBox">

	<form method="GET" action="<?=DB_DOMAIN ?>index.php" name="ClassSearch">
	<input name="dll" type="hidden" value="music" class="hidden">
	<input name="sub" type="hidden" value="search" class="hidden">
	
	<div id="Title">
		<div class="AddIcon"><br><a href="<?=getThePermalink('gallery/upload')?>" class="MainBtn">  <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/add.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_createNew'] ?></a></div>
		<span class="a1"><?=$PageTitle ?></span>
		<span class="a2"><?=$PageDesc ?></span>
	</div>
	<div id="Search">
		<span class="a1"><input name="keyword" type="text" class="input"> <input type="submit" value="<?=$GLOBALS['_LANG']['_search'] ?>"class="NormBtn advandate_btn"></span>
		<span class="a2"><?=$Search_Page_Numbers ?></span>
	</div>
	<div id="Results"> 
		<span class="a1"> <b><?=$search_total_results ?></b> <?=$GLOBALS['_LANG']['_results'] ?> </span>
	</div>
	
	</form> 

	<span id="response_music" class="responce_alert"></span>
	<span id="response_gallery" class="responce_alert"></span>

	<script type="text/javascript" src="<?=DB_DOMAIN ?>inc/js/swfobject.js"></script>
	<script>
	var numAudioPlayers = 1; 
	
	function loadSWFObject(id, pathToFile, src, w, h, v, bgcolor) {
		var strName = "podcast" + id;
	
		var so = new SWFObject(src, strName, w, h, v, bgcolor);
				 so.addParam("name", strName);
				 so.addParam("allowScriptAccess", "sameDomain");
				 so.addVariable("podcastFile", pathToFile);
				 so.addVariable("id", id);
				 so.addVariable("numAudioPlayers", numAudioPlayers);
				 so.write(strName);
	}
	</script>
	<?php

	if(isset($search_page)){
		$view_page = strip_tags($search_page);
	}
	else{
		$view_page = 1;
	}

	?>
	<form name="SearchResults" method="post" action="<?= getThePermalink($page.'/view/'.$view_page) ?>">
	<input name="searchPage" type="hidden" id="searchPage" value="1" class="hidden">
	<input name="page" type="hidden" value="<? if(isset($search_page) && is_numeric($search_page) ){ print strip_tags($search_page); }else{ print "1"; } ?>" class="hidden" id="Spage">
	<input name="sub" type="hidden" value="<?=$sub_page ?>" class="hidden">
	<input name="do_page" type="hidden" value="<?=$page ?>" class="hidden">
	<input type="hidden" name="sort" value="1" class="hidden" id="SSort">
	 
	<? if($search_total_results ==0){ ?>
	
	<div class="result_not_found">
		<h1>
			<a href="<?=getThePermalink('music/search')?>"> <?=$GLOBALS['_LANG_ERROR']['_noResults'] ?></a>
		</h1>
	</div>
	
	<? } ?>

	<? $i=1; foreach($search_data as $value){   ?>	
	
	
		<div class="Acc_ListBox <? if($value['ThisApproved']=="no"){ ?>search_display_unapproved<? }else{ if($i % 2){ ?>search_display_off<? }else{ ?>search_display_on<? } } ?>" id="music_<?=$value['id'] ?>">
        
        <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <audio controls  controlsList="nodownload" 
        src="<?=WEB_PATH_MUSIC.$value['bigimage'] ?>" style="width: 100%;">
		</audio>
		<div class="Acc_ListBox_left"><div class="pic75" style="">
		<!-- <div id="podcast<?=$value['id'] ?>">Please install flash.</div>
		<script type="text/javascript">	loadSWFObject(<?=$value['id'] ?>, "<?=WEB_PATH_MUSIC.$value['bigimage'] ?>", "<?=DB_DOMAIN ?>inc/exe/flash/mp3_player.swf", "94", "61", "6", "#ffffff"); </script> -->
		
		<? if($value['default'] ==1){ ?><br> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/approve.gif" align="absmiddle"> <?=$GLOBALS['_LANG']['_song'] ?> <? } ?>
		</div>
		</div>
        
        </div><!--col end-->
        
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<div class="Acc_ListBox_right">	
        
        <div class="row">
           
    
                <div class="Acc_ListBox_right1">
            <div class="Acc_ListBox_title_break"><b><?=$value['title'] ?></b></div>
            <b><?=$GLOBALS['_LANG']['_username'] ?>: <a href="<?=getThePermalink('user',array('username' => $value['user_link'])) ?>"><?=$value['username'] ?></a></b>
            <div class="Acc_ListBox_margin5"> 
            </div></div>
            
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            
           
            
               <div class="Acc_ListBox_right2"><div>
        
            <? if($_SESSION['uid'] == $value['uid']){ ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/chk_off.png" align="absmiddle"> <a href="javascript:void(0);" onclick="DeleteFile('<?=$value['id'] ?>'); $('#music_<?=$value['id'] ?>').fadeOut(300, function() { $(this).remove(); }); return false;"> <?=$GLOBALS['_LANG']['_delete'] ?> </a>  <br>		<? } ?>
    
            <? if($value['default'] ==1 && $_SESSION['auth'] =="yes" && !isset($ms) ){ $ms=1; ?><img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/disconnect.png" width="16" height="16" align="absmiddle"> <a href="javascript:void(0);" onclick="ChangeDefaultMusic('<?=$value['id'] ?>',0); return false;"> <?=$GLOBALS['_LANG']['_delete'] ?> <?=$GLOBALS['_LANG']['_song'] ?> </a>  <br> <? } ?>
            
            <? if($_SESSION['auth'] =="yes"){ ?>
            <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/sound.png" align="absmiddle"> <a href="javascript:void(0);" onclick="ChangeDefaultMusic('<?=$value['id'] ?>',1); return false;"> <?=$GLOBALS['_LANG']['_song'] ?> </a>  
            <? } ?>
            <?
            ## display delete functions for moderator
            if( isset($_SESSION['site_moderator_approve']) && $_SESSION['site_moderator_approve']=="yes" && $value['ThisApproved']=="no"){ ?>
                        
            <span id="Approvediv_<?=$value['id'] ?>"><br><a href="javascript:void(0)" onClick="AdminLiveApprove('<?=$value['id'] ?>', 'music', ''); Effect.Fade('Approvediv_<?=$value['id'] ?>'); return false;" style="text-decoration:none">
            <img src="<?=DB_DOMAIN ?>images/DEFAULT/_icons/new/chk_on.png"> &nbsp;&nbsp; <?=$GLOBALS['_LANG']['_approve'] ?> </a></span>
            <? } ?>
    
            <?
            ## display delete functions for moderator
            if( isset($_SESSION['site_moderator_delete']) && $_SESSION['site_moderator_delete']=="yes" ){ ?>
                        
            <br><a href="javascript:void(0)" onClick="AdminLiveDelete('<?=$value['id'] ?>', 'music', ''); Effect.Fade('music_<?=$value['id'] ?>'); return false;" style="text-decoration:none">
            <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> <?=$GLOBALS['_LANG']['_delete'] ?> </a>
            <? } ?>	
    
            </div>
            </div>
            
        </div>
			<div class="clear"></div>
        </div>
        </div>
        <div class="clear"></div>
		</div>
	</div>
	
	<? } ?>

	<div id="Bottom"><?=$Search_Page_Numbers ?></div>
	
	</form>

	</div> 



<? } ?>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
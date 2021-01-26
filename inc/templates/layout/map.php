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
<div class="outer_content">
<? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){?>
<div class="middle_banner"><? print $banner['display'];?></div><? }} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>

<style>
h3 { font-size:20px; height:40px; margin-top:10px;}
ul.Acc_Heading_List { padding:0px;}
.Acc_Heading_List li a { margin-left:0px;}
</style>


     <div class="inner_common_cont">
 	 <div class="row">
   	 	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        
            <? if(D_ACCOUNT ==1){ ?>
            <h3><?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_account'] ?></h3>
            <?=BuildPageHomeMenu($LANG_ACCOUNT_MENU, "account") ?>
             <? } ?>
            
            <h3><?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_settings'] ?> </h3>
            <?=BuildPageHomeMenu($LANG_SETTINGS_MENU, "settings") ?>
             
            
            <? if(D_MATCHTESTS ==1){ ?>
            <h3><?=$LANG_SETTINGS_MENU['settings'] ?> </h3>
            <?=BuildPageHomeMenu($LANG_MATCH_MENU, "matches") ?> 
             <? } ?>
            
            <? if(D_GROUPS ==1){ ?>
            <h3><?=$GLOBALS['_LANG']['_groups'] ?> </h3>
            <?=BuildPageHomeMenu($LANG_GROUPS_MENU, "groups") ?>
            <? } ?>
    
		</div>    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<? if(D_MESSAGES ==1){ ?>
            <h3><?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_messages'] ?> </h3>
            <?=BuildPageHomeMenu($LANG_MESSAGES_MENU, "messages") ?>
             <? } ?>
            
            <? if(UP_PHOTO ==1){ ?>
            <h3><?=$GLOBALS['_LANG']['_my'] ?> <?=$GLOBALS['_LANG']['_albums'] ?> </h3>
            <?=BuildPageHomeMenu($LANG_GALLERY_MENU, "gallery") ?> 
            <? } ?>
            
            <? if(D_EVENTS ==1){ ?>
            <h3><?=$GLOBALS['_LANG']['_events'] ?> </h3>
            <?=BuildPageHomeMenu($LANG_EVENTS_MENU, "events") ?> 
            <? } ?>
            
            <? if(D_GAMES ==1){ 
            
            if(!empty($lang_main_menu['games&sub=search'])){
            ?>
            
            <h3><?=$lang_main_menu['games&sub=search']; ?> </h3>
            <?=BuildPageHomeMenu($LANG_1GAME_MENU, "games") ?>
             <? } } ?>
    	</div>
    </div>
	<span class="map_seprator"></span>    
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    
			<? if(D_CLASSADS ==1){ ?>
            <h3><?=$lang_main_menu['classads'] ?></h3>
            <?=BuildPageHomeMenu($LANG_CLASSADS_MENU, "classads") ?>
            <? } ?>
            
            <? if(D_MUSIC ==1){ ?>
            <h3><?=$GLOBALS['_LANG']['_music'] ?></h3>
            <?=BuildPageHomeMenu($LANG_MUSIC_MENU, "music") ?> 
            <? } ?>
            
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <? if(D_VIDEOS ==1){ ?>
            <h3><?=$GLOBALS['_LANG']['_videos'] ?></h3>
            <?=BuildPageHomeMenu($LANG_VIDEO_MENU, "videos") ?> 
            <? } ?>
            
            <? if(D_BLOG ==1){ ?>
            <h3><?=$lang_main_menu['blog&sub=search'] ?></h3>
            <?=BuildPageHomeMenu($LANG_BLOG_MENU, "blog") ?> 
            <? } ?>
        </div>
     </div>
</div>
</div>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
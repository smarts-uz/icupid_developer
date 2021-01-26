<?
/**
* Page: WEBSITE TOUR PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  
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

<ul class="form">
 <div class="CapBody col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<li class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="cont_right col-xs-4 col-sm-4 col-md-4 col-lg-4">	
      <img src="<?=DB_DOMAIN ?>images/DEFAULT/_tour/0.jpg" class="tour_img">
      </div>		
	  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="float:left"><?=$GLOBALS['LANG_TOUR']['a4'] ?></div>
	</li>	
<li class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_tour/1.jpg"  class="tour_img">
    </div>
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="float:right;"><?=$GLOBALS['LANG_TOUR']['a6'] ?></div>	
</li>

 <div class="ClearAll"></div>	
	<li class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="cont_right col-xs-4 col-sm-4 col-md-4 col-lg-4">	
          <img src="<?=DB_DOMAIN ?>images/DEFAULT/_tour/3.jpg" class="tour_img"></div>
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="float:left;"><?=$GLOBALS['LANG_TOUR']['a7'] ?></div>
	</li>
 <div class="ClearAll"></div> 
 <li class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
   <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
      <img src="<?=DB_DOMAIN ?>images/DEFAULT/_tour/4.jpg" class="tour_img"></div>
   <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="float:right;"><?=$GLOBALS['LANG_TOUR']['a8'] ?></div>	
</li>
<? if(UPGRADE_SMS =="yes"){ ?>
<div class="ClearAll"></div>	
	<li class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="cont_right col-xs-4 col-sm-4 col-md-4 col-lg-4">	
          <img src="<?=DB_DOMAIN ?>images/DEFAULT/_tour/5.jpg" class="tour_img"></div>	
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8"><?=$GLOBALS['LANG_TOUR']['a9'] ?></div>
	</li>
<? } ?>
<div class="ClearAll"></div>
</div>
</ul>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
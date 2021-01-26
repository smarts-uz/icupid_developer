<?
/**
* Page: WEBSITE FAQ PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_faq_page.php
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
 
<div class="CapBody">

	<div style="padding:20px;">
	
		<div style="line-height:30px;">
		<? if(isset($faq_links)){ foreach($faq_links as $value){ ?>
			<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/comments.png" align="absmiddle"> <a href='<?=getThePermalink('faq')?>#<?=$value['id'] ?>' title="<?=$value['subject'] ?>"><?=$value['subject'] ?></a><br>
		<? } } ?>

	</div>
		
		<ul style="margin-top:50px;">
		<? if(isset($faq_rows)){ foreach($faq_rows as $value){ ?>
			<a name="<?=$value['id'] ?>"></a>
			<li><div class="faqs_div" id="<?=$value['id'] ?>"><h3><?=$value['subject'] ?></h3>
			<?=nl2br($value['content']) ?>
			</div></li>
		<? } } ?>
		</ul>
	</div>
	</div>
</ul>
<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
<?
/**
* Page: CONTACT FORM FOR SENDING CONTACT MESSAGES
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_contact.php
*/
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );


$ipi = getenv("REMOTE_ADDR");

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
    <?
    foreach($BANNER_ARRAY as $banner){
    if($banner['position'] =="middle"){?>
    
    <div class="middle_banner"><? print $banner['display'];?></div>
    <?
    }
    }
    ?>

    <p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>

    <ul class="form">   	
      <div class="CapBody bd_padding_20">
        <form method="post" action="<?=DB_DOMAIN ?>index.php" onSubmit="return CheckNullsContact('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">                
          <input name="do" type="hidden" value="send" class="hidden">            
          <input name="do_page" type="hidden" value="contact" class="hidden">

          <input type="hidden" name="ipaddress" value="<?php echo $ipi ?>" >

          <li><label><?=$GLOBALS['_LANG']['_name'] ?>: </label> <input maxlength="100" id="C1" name="name" type="text" value="<? if(isset($_POST['name'])){ print eMeetingOutput($_POST['name']); } ?>" size="40" class="input"></li>
          <li><label><?=$GLOBALS['_LANG']['_email'] ?>: </label> <input maxlength="150" id="C2" name="email" type="text" value="<? if(isset($_POST['email'])){ print eMeetingOutput($_POST['email']); } ?>" size="40" class="input"></li>
          <li><label><?=$GLOBALS['_LANG']['_message'] ?>: </label><textarea id="C3" name="message" cols="50" rows="3" class="input"><? if(isset($_POST['message'])){ print eMeetingOutput($_POST['message']); } ?></textarea></li>      
          <? if(D_REGISTER_IMAGE ==1){/* ?>
          <li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li>
          <? */
          ?>
          <li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label> 
          <div id="RecaptchaContact" data-sitekey="<?=reCAPTCH_APP_ID?>"></div>
          </li>
          <?php 
          } ?>
          <li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>          
        </form>
      </div>
    </ul>		
    <?php
    /* MAIN CLOSE */
    if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
    ?>
    <?php
    if(D_REGISTER_IMAGE == 1){
    ?>
    <script type="text/javascript">
      var CaptchaCallback = function() {
        grecaptcha.render('RecaptchaContact', {'sitekey' : '<?=reCAPTCH_APP_ID ?>'});
      };
    </script>
    <?php
    }
    ?>
  </div> <div id="main_wrapper_bottom"></div>
</div>
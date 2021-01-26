<?
/**
* Page: INVITE A FRIEND
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  inc/func/func_invite.php
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

<? if(!isset($show_page)){ 


	 /**
	 * Page: Invite Friend
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>


<div id="eMeeting" class="user">

  <div class="header account_tabs">

	<ul>
	 	<li class="selected"><a href="javascript:void(0)" onclick="toggleLayer('step_2'); toggleLayer('step_1');"><span><?=$PageTitle ?></span></a></li>
    </ul>

    <div class="ClearAll"></div>
 </div>
</div>


<div style="display:visible;" id="step_1">


<ul class="form"><div class="CapBody bd_padding_20">
<form method="post" action="<?=DB_DOMAIN ?>index.php" onSubmit="return CheckNullsContact('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">                
<input name="do" type="hidden" value="tell" class="hidden">  
<input type="hidden" value="<?=$GLOBALS['_LANG_ERROR']['_inviteMsg'] ?> <?=DB_DOMAIN ?> " id="C3" name="message">          
<input name="do_page" type="hidden" value="invite" class="hidden">
<li><label><?=$GLOBALS['_LANG']['_name'] ?>: </label> <input id="C1" name="name" type="text" value="<? if(isset($_POST['name'])){ print eMeetingOutput($_POST['name']); } ?>" size="40" class="input"></li>
<li><label><?=$GLOBALS['_LANG']['_friends'] ?> <?=$GLOBALS['_LANG']['_email'] ?>: </label> <input id="C2" name="email" type="text" value="<? if(isset($_POST['email'])){ print eMeetingOutput($_POST['email']); } ?>" size="40" class="input">		</li>
<li><label><?=$GLOBALS['_LANG']['_message'] ?>: </label></li><li> <textarea  disabled cols="50" rows="3" class="input"><?=$GLOBALS['_LANG_ERROR']['_inviteMsg'] ?> <?=DB_DOMAIN ?> </textarea></li>      
<? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>

	<? /*<input type="text" id="C4" name="code" class="input"><br>
<img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>">
	*/ ?>
	 <div id="RecaptchaInvite" class="g-recaptcha" data-theme="light" data-sitekey="<?=reCAPTCH_APP_ID?>" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
</li><? } ?>
<li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>          
</form>
</div>
</ul>	








</div>












<div style="display:none;" id="step_2">


	<form method="post" action="<?=DB_DOMAIN ?>index.php" onSubmit="return CheckNullsInvite('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
	<input name="do" type="hidden" value="run" class="hidden">
	<input name="do_page" type="hidden" value="invite" class="hidden">
	<input name="sub" type="hidden" value="contacts" class="hidden">
	<input name="system" type="hidden" value="hotmail" class="hidden">
	<b>1. Select your email address book</b>
	<ul class="form">  
	<div class="CapBody"> 
	<img src="<?=DB_DOMAIN ?>images/DEFAULT/_net/aol.jpg" style="border:1px dashed red;margin-right:13px;" onClick="UpdateimgB('imgAol');" id="imgAol"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_net/gmail.jpg" style="border:1px solid #ccc;margin-right:13px;" onClick="UpdateimgB('imgGmail');" id="imgGmail"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_net/hotmail.jpg" style="border:1px solid #ccc;margin-right:13px;" onClick="UpdateimgB('imgHotmail');" id="imgHotmail"><img src="<?=DB_DOMAIN ?>images/DEFAULT/_net/yahoo.jpg" style="border:1px solid #ccc;" onClick="UpdateimgB('imgYahoo');" id="imgYahoo">
	</div>
	</ul>
	
	<br>
	<b>2. Login to your email account</b>
	<ul class="form">  
	<div class="CapBody"> 
	
	<li><label><?=$GLOBALS['_LANG']['_username'] ?>: </label><input maxlength="150" name="username" type="text" id="I1" class="input"></li>
	<li><label><?=$GLOBALS['_LANG']['_password'] ?> </label> <input maxlength="100" name="password" type="password" id="I2" class="input"> </li>
	<li><input value="<?=$GLOBALS['_LANG']['_submit'] ?>" type="submit" class="MainBtn"></li>
	</div>
	</ul>
	</form>

</div>





<? }elseif($show_page=="contacts"){ 


	 /**
	 * Page: Invite Friend Contacts Display
	 *
	 * @version  8.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Fri Sep 24 16:28:31 EEST 2008
	 */

?>

<form method="post" action="<?=DB_DOMAIN ?>index.php">
<input name="do" type="hidden" value="email_contacts" class="hidden">
<input name="do_page" type="hidden" value="invite" class="hidden">
<input name="system" type="hidden" value="hotmail" class="hidden">
<? $i=1; $counter=0; $FoundMember = array(); foreach($contacts_array as $value){ ?>
<?  if($value['joined']){ $counter++; $FoundMember[$counter]['email']=$value["email"];} ?>
<input type='hidden' name='name<?=$i ?>' value='<?=$value["username"] ?>' class='hidden'>
<input type='hidden' name='email<?=$i ?>' value='<?=$value["email"] ?>' class='hidden'>		 
<? $i++;} ?>
		
	<ul class="form"> 
	 
	<div class="CapBody">	
	
	<p><?=$GLOBALS['LANG_NETWORK']['a28'] ?> <?=count($contacts_array) ?> <?=$GLOBALS['LANG_NETWORK']['a29'] ?>, <?=$counter ?> <?=$GLOBALS['LANG_NETWORK']['a30'] ?></p>
	<p><?=$GLOBALS['LANG_NETWORK']['a31'] ?></p>		
	<input type='hidden' name='totalrows' value='<?=count($contacts_array) ?>' class="hidden" >
	<li><input value="<?=$GLOBALS['LANG_NETWORK']['a32'] ?>" type="submit" class="MainBtn"> <input value="<?=$GLOBALS['LANG_NETWORK']['a33'] ?>" type="button" class="MainBtn" onclick="javascript:location.href='/invite'"> </li>
	</div>
	</ul>	
</form>
	
	<? if(!empty($FoundMember)){ ?>
	<ul class="form"> 
	<div class="CapTitle"><?=$GLOBALS['LANG_NETWORK']['a34'] ?></div> 
	<div class="CapBody">	
	
	<li><p><?=$GLOBALS['LANG_NETWORK']['a35'] ?></p></li>
	<?=DisplayContacts($FoundMember) ?>
	</div>
	</ul>
	<? } ?>
<? } ?>
<?php
if(D_REGISTER_IMAGE == 1){
?>
<script type="text/javascript">
  var CaptchaCallback = function() {
    grecaptcha.render('RecaptchaInvite', {'sitekey' : '<?=reCAPTCH_APP_ID ?>'});
  };
</script>
<?php
}
?>
<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
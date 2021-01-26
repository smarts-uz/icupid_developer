<?
/**
* Page: MEMBER LOGIN PAGE
*
* @version  9.0
* @created  Sat 25 Oct  2008
* @related  /inc/func/func_login.php & func_login_page.php
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


<? if ($MOBILE == "no") { 
	$showpage = "index.php";
	$regpage = "register";
 }else{ 
	$showpage = "mobile.php";
	$regpage = "mobileregister";
 } 
?>



<div style="width:340px;float:left">
	<form method="post" action="<?=DB_DOMAIN ?><?=$showpage ?>" name="LoginForm" onSubmit="return CheckNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
	<input name="do" type="hidden" value="login" class="hidden">
	<input name="visible" value="0" type="hidden">
	<input name="do_page" type="hidden" value="login" class="hidden">

	<ul class="form">   
 
	<div class="CapBody">                
<li>
 <a href="<?=getThePermalink('fblogin')?>"><img src="<?=DB_DOMAIN ?>images/facebook-login.jpg" ></a><br />
</li>


              
		<li><label><?=$GLOBALS['_LANG']['_username'] ?>:</label> <input tabindex="1" maxlength="15" name="username" id="e_username" type="text" class="input" size="25" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>>
		</li>
		<li><label><?=$GLOBALS['_LANG']['_password'] ?>:</label> <input tabindex="2" maxlength="25" name="password" id="e_password" type="password" class="input" size="25"></li>
		<? if(D_REGISTER_IMAGE ==1){ ?>
		<li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input tabindex="3" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li>
		<? } ?>
		<li><input maxlength="15" type="submit"  value="<?=$GLOBALS['_LANG']['_login'] ?>" class="MainBtn"></li>
		<li><input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'><?=$GLOBALS['_LANG']['_rememberMe']  ?></li>
		<hr><li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_go.png" align="absmiddle"> <a href="#" onclick="toggleLayer('ForgottenPassword'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a></li>
		<? if(VALIDATE_EMAIL==1){ ?>
		<li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" align="absmiddle"> <a href="#" onclick="toggleLayer('ActAccount'); return false;"><?=$GLOBALS['LANG_LOGIN']['a7'] ?></a></li>
		<? } ?>
		</div>
	</ul>
	</form>	
</div>

<div style="width:255px; float:right">

<div class="CapBody" style="margin-top:10px;"> 


<? if ($MOBILE == "no") { ?>
 <a href="<?=getThePermalink('fbregister')?>"><img src="<?=DB_DOMAIN ?>images/facebook-register.jpg" ></a><br />
<br>
<? } ?>


<h3><?=$GLOBALS['LANG_WELCOME']['_join'] ?></h3><p> <?=$GLOBALS['LANG_WELCOME']['_join1'] ?> </p>  <a class="MainBtn" href="<?=getThePermalink($regpage) ?>"><span><?=$GLOBALS['LANG_WELCOME']['_join2'] ?></span></a> <div class="ClearAll"></div>
</div> <br>
	<!-- DISPLAY FORGOT BOX -->
	<div style="display:none" id="ForgottenPassword">	
		<form method="post" action="<?=DB_DOMAIN ?><?=$showpage ?>" name="ForgotPassword">
		<input name="do" type="hidden" value="password" class="hidden">
		<input name="do_page" type="hidden" value="login" class="hidden">
		<ul class="form">   
		<div class="CapBody"><li><b><?=$GLOBALS['LANG_COMMON'][1] ?></b></li>
			<li><label><?=$GLOBALS['_LANG']['_username'] ?></label><input maxlength="25" name="username" type="text" size="20" class="input"></li> 
			<li><label><?=$GLOBALS['_LANG']['_email'] ?></label><input maxlength="150" name="email" type="text" size="20" class="input"></li>
			<? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input maxlength="15" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li><? } ?>
			<li><input type="submit"  value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>
		</div>
		</ul>
		</form>
	</div>
	<!-- END DISPLAY -->

	<!-- DISPLAY FORGOT BOX -->
	<div style="display:none" id="ForgottenCode">	
		<form method="post" action="<?=DB_DOMAIN ?><?=$showpage ?>">
		<input name="do" type="hidden" value="newcode" class="hidden">
		<input name="do_page" type="hidden" value="login" class="hidden">
		<ul class="form">   
		<div class="CapBody">	
			<li><b><?=$GLOBALS['LANG_LOGIN']['a11'] ?></b></li>                   
			<li><label><?=$GLOBALS['_LANG']['_email'] ?></label><input maxlength="150" name="email" type="text" size="25" class="input"></li>
			<? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input maxlength="15" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li><? } ?>
			<li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>
		</div>
		</ul>
		</form>
	</div>
	<!-- END DISPLAY -->
	
	<div id="ActAccount" style="display:none;">	
	<form method="post" action="<?=DB_DOMAIN ?><?=$showpage ?>">
	<input name="do" type="hidden" value="validate" class="hidden">
	<input name="do_page" type="hidden" value="login" class="hidden">
	<ul class="form">   
	<div class="CapBody">	  
		<li><b><?=$GLOBALS['LANG_LOGIN']['a13'] ?></b></li>                
		<li><label><?=$GLOBALS['_LANG']['_email'] ?></label><input name="email" type="text" size="25" class="input"></li>
		<li><label><?=$GLOBALS['LANG_LOGIN']['a15'] ?></label><input name="valMe" type="text" size="25" class="input"></li>
		<li><a href="#" onclick="toggleLayer('ForgottenCode'); return false;"><?=$GLOBALS['LANG_LOGIN']['a16'] ?></a>		</li>
		<? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li><? } ?>
		<li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="NormBtn"></li>
	</div>
	</ul>
	</form>
	</div>
	
</div>

<?php
/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?></div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div> <div id="main_wrapper_bottom"></div>
</div>
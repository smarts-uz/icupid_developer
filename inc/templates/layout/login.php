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
    <?
    foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){ ?>
    <div class="middle_banner"><? print $banner['display'];?></div>
    <?
    }}
    ?>
    <p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 	      <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <form method="post" action="<?=DB_DOMAIN ?>index.php" name="LoginForm" onSubmit="return CheckPageNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
              <input name="do" type="hidden" value="login" class="hidden">
              <input name="visible" value="0" type="hidden">
              <input name="do_page" type="hidden" value="login" class="hidden">
          
              <ul class="form">   
       
              <div class="CapBody" style="padding:14px;">   
      
                <li class="validate_field">
                  <label><?=$GLOBALS['_LANG']['_username'] ?>:</label>
                  <input maxlength="15" name="username" id="e_username_login" type="text" onclick="removeValidation('login_user_error');" class="form-control" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>>
                  <p class="note" id="login_user_error" style="display: none;"><img src="images/DEFAULT/_icons/16/alert.gif">Please enter your username.</p>
                </li>
              
                <li class="validate_field">
                  <label><?=$GLOBALS['_LANG']['_password'] ?>:</label>
                  <input  maxlength="25" name="password" id="e_password_login" onclick="removeValidation('login_user_pass');" type="password" class="form-control">
                  <p class="note" id="login_user_pass" style="display: none;"><img src="images/DEFAULT/_icons/16/alert.gif">Please enter your password.</p>
                </li>
                <?
                if(D_REGISTER_IMAGE ==1){
                ?>
                
                <li>
                  <label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>
                  <div id="RecaptchaLogin" style="transform:scale(0.60);-webkit-transform:scale(0.60);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                  <?/*<input tabindex="3" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>">*/?>
                </li>
                <?php
                }
                ?>
                
                <li>
                  <input maxlength="15" type="submit"  value="<?=$GLOBALS['_LANG']['_login'] ?>" class="MainBtn">
                </li>
                <li>
                  <input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'><?=$GLOBALS['_LANG']['_rememberMe']  ?>
                </li>
                <?
                if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") {
                ?>
                <li class="facebook-li">
                  <a href="<?=DB_DOMAIN ?>fblogin"><img src="<?=DB_DOMAIN ?>images/facebook-login.jpg" ></a>
                </li>
                <?
                }
                ?>

                <?
                //Twitter
                if (defined('TWITTER_SIGNIN_KEY')  && TWITTER_SIGNIN_KEY !="") {
                ?>
                <li class="twitter-li">
                  <?=GetTwitterLoginButton();?>
                </li>
                <?
                }
                ?>
                <?
                //Google
                if (defined('GOOGLE_SIGNIN_KEY')  && GOOGLE_SIGNIN_KEY !="") {
                ?>
                <li class="google-li">
                  <image id="googleSignIn" src="<?=DB_DOMAIN?>images/google-login.jpg">
                  <div id="google-sign-in" style="display: none;"></div>
                </li>
                <?
                }
                ?>
                <hr>
                <li>
                  <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_go.png" align="absmiddle"> <a href="#" onClick="toggleLayer('ForgottenPassword'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a>
                </li>
                <?
                if(VALIDATE_EMAIL==1){
                ?>
                <li>
                  <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" align="absmiddle"> <a href="#" onClick="toggleLayer('ActAccount'); return false;"><?=$GLOBALS['LANG_LOGIN']['a7'] ?></a>
                </li>
                <?
                }
                ?>
              </div>
              </ul>
            </form>	
          </div>
  
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          
            <div class="CapBody" style="padding:14px;"> 
          
            <? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") { ?>
              <!--<a href="<?=DB_DOMAIN ?>fblogin"><img src="<?=DB_DOMAIN ?>images/facebook-login.png" ></a><br />-->
            <? } ?>
      
              <h3><?=$GLOBALS['LANG_WELCOME']['_join'] ?></h3>
              <p> <?=$GLOBALS['LANG_WELCOME']['_join1'] ?> </p>
              <a class="MainBtn" href="<?=DB_DOMAIN ?>register"><span><?=$GLOBALS['LANG_WELCOME']['_join2'] ?></span></a>
              <div class="ClearAll"></div>
            </div>
            <br>
            <!-- DISPLAY FORGOT BOX -->
            <div style="display:none" id="ForgottenPassword">	
              <form method="post" action="<?=DB_DOMAIN ?>index.php" name="ForgotPassword">
                <input name="do" type="hidden" value="password" class="hidden">
                <input name="do_page" type="hidden" value="login" class="hidden">
                <input name="username" type="hidden" value="" class="hidden">
                <ul class="form">   
                  <div class="CapBody" style="padding:14px;"><li><b><?=$GLOBALS['LANG_COMMON'][1] ?></b></li>
                    <li><label><?=$GLOBALS['_LANG']['_email'] ?></label><input maxlength="150" name="email" type="text" size="20" class="input"></li>
                    <? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>

                    <div id="RecaptchaForgot" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>

                    <?php /*<input maxlength="15" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"> */?>

                    </li><? } ?>
                    <li><input type="submit"  value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>
                  </div>
                </ul>
              </form>
            </div>
            <!-- END DISPLAY -->
      
            <!-- DISPLAY FORGOT BOX -->
            <div style="display:none" id="ForgottenCode">	
              <form method="post" action="<?=DB_DOMAIN ?>index.php">
                <input name="do" type="hidden" value="newcode" class="hidden">
                <input name="do_page" type="hidden" value="login" class="hidden">
                <ul class="form">   
                  <div class="CapBody" style="padding:14px;">	
                    <li><b><?=$GLOBALS['LANG_LOGIN']['a11'] ?></b></li>                   
                    <li><label><?=$GLOBALS['_LANG']['_email'] ?></label><input maxlength="150" name="email" type="text" size="25" class="input"></li>
                    <? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>

                    <?php
                    /*
                    <input maxlength="15" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"> */?>

                    <div id="RecaptchaForgotCode" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>

                    </li><? } ?>
                    <li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>
                  </div>
                </ul>
              </form>
            </div>
            <!-- END DISPLAY -->
          
          <div id="ActAccount" style="display:none;">	
            <form method="post" action="<?=DB_DOMAIN ?>index.php">
              <input name="do" type="hidden" value="validate" class="hidden">
              <input name="do_page" type="hidden" value="login" class="hidden">
              <ul class="form">   
                <div class="CapBody" style="padding:14px;">	  
                    <li><b><?=$GLOBALS['LANG_LOGIN']['a13'] ?></b></li>                
                    <li><label><?=$GLOBALS['_LANG']['_email'] ?></label><input name="email" type="text" size="25" class="input"></li>
                    <li><label><?=$GLOBALS['LANG_LOGIN']['a15'] ?></label><input name="valMe" type="text" size="25" class="input"></li>
                    <li><a href="#" onClick="toggleLayer('ForgottenCode'); return false;"><?=$GLOBALS['LANG_LOGIN']['a16'] ?></a>		</li>
                    <? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>

                    <div id="RecaptchaActivate" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>

                    <? /*<input type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>">
                    */ ?>
                    </li><? } ?>
                    <li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>
                </div>
              </ul>
            </form>
          </div>
          
        </div> 
      </div>
    </div>
  </div>

<?php
if(D_REGISTER_IMAGE == 1){
?>
<script type="text/javascript">
  var CaptchaCallback = function() {
    grecaptcha.render('RecaptchaLogin', {'sitekey' : '<?=reCAPTCH_APP_ID ?>'});
    grecaptcha.render('RecaptchaForgot', {'sitekey' : '<?=reCAPTCH_APP_ID ?>'});
    grecaptcha.render('RecaptchaForgotCode', {'sitekey' : '<?=reCAPTCH_APP_ID ?>'});
    grecaptcha.render('RecaptchaActivate', {'sitekey' : '<?=reCAPTCH_APP_ID ?>'});
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
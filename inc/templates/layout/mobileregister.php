<?

## block direct page access

defined( 'KEY_ID' ) or die( 'Restricted access' );



?>

<script type="text/javascript" src='https://www.google.com/recaptcha/api.js'></script>

<script>

 

function agreeregisterForm(){

document.getElementById('MainSubBtn').disabled = false;

} 

</script>



 

<div class="TopRegister"><div style="float:right;"><? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="middle"){ print $banner['display'];}} ?></div><span><?=$PageTitle ?></span></div><p><?=$PageDesc ?></p>

<style>

ul.form li .tip {  border:0px;}

.robotic { display: none; }


.CapBody { padding: 5px;  margin-bottom:15px; }

ul.form textarea { width:285px;}

ul.form label { display: block; float: left; text-align: left; padding: 0 10px 0 0; width: 280px; font-weight: bold;  margin: 5px 0 0 0; font-size:110%; color:#333333; }


input#MainSubBtn {
    padding: 0;
}
</style>

 



<? if($show_page=="home"){ ?>





		<!-- ****************** UPLOAD WAITING / LOADING SCREEN ************** -->

		<div id="UploadWait1" style="display:none;">

			<p><strong><?=$GLOBALS['LANG_REGISTER']['28'] ?></strong></p>

			<p><?=$GLOBALS['LANG_REGISTER']['29'] ?></p>

			<p><img src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/loading.gif"></p>

		</div>

		<!-- **************************************************************** -->  



		<form method="post" action="<?=DB_DOMAIN ?>mobile.php" name="MemberSearch" enctype="multipart/form-data"  toggleLayer('UploadWait1'); return CheckRegisterNulls('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>','<?=$GLOBALS['_LANG_ERROR']['_noT&C'] ?>');">               

		<input name="do" type="hidden" value="add" class="hidden">            

		<input name="do_page" type="hidden" value="mobileregister" class="hidden">

		<input name="title" type="hidden" value="" class="hidden">

		<input name="comments" type="hidden" value="" class="hidden">

		<script src="<?=DB_DOMAIN ?>inc/js/_extras/_date.js"></script>

		<span id="response_register" class="responce_alert"></span>





<?



	 /**

	 * Page: Register Waiting Box

	 *

	 * @version  9.0

	 */



?>





<div id="MainRegisterForm" style="display:visible">

<?



	 /**

	 * Page: Register Step 1

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>



<div id="reg_step_1" style="display:visible">

		<ul class="form"> 

			

		<div class="CapBody"> 



			<li><label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/vcard.png" width="16" height="16" align="absmiddle">

			<?=$GLOBALS['_LANG']['_username'] ?>: </label><input name="username" type="text" class='input' id="regUsername" tabindex="1" style="width:260px;" onchange="validateUsername(this.value);" value="<? if(isset($_POST['username'])){print eMeetingOutput($_POST['username']); } ?>" size="35" maxlength="15"/>   

			<p class="note"><span id="response_span"></span></p>

			<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a6'] ?></div>

			</li>

	

			<li><label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png" width="16" height="16" align="absmiddle">

			<?=$GLOBALS['_LANG']['_email'] ?>: </label><input type="text" class='input' size="35" style="width:260px;" name="email" id="regEmail" tabindex="2" onchange="validateEmail(this.value);" value="<? if(isset($_POST['email'])){print eMeetingOutput($_POST['email']); } ?>"/> <p class="note"><span id="response_span_email"></span></p>

			<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a8'] ?></div>

			</li>

			

			<li><label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_go.png" width="16" height="16" align="absmiddle">

			<?=$GLOBALS['_LANG']['_password'] ?>: </label><input type="password" class='input' size="35" style="width:260px;" name="password" id="regPassword" tabindex="3" onchange="validatePassword(this.value);" value="<? if(isset($_POST['password'])){print eMeetingOutput($_POST['password']); } ?>" /> <p class="note"><span id="response_span_pass"></span></p>

			<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a10'] ?></div>

			</li>

	

			<li><label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_add.png" width="16" height="16" align="absmiddle">

			<?=$GLOBALS['LANG_REGISTER']['a11'] ?>: </label><input type="password" class='input' size="35" style="width:260px;" name="password_confirm" id="regRPassword" onChange="CheckPassword();" tabindex="4" value="<? if(isset($_POST['password_confirm'])){print eMeetingOutput($_POST['password_confirm']); } ?>" /> <p class="note"><span id="response_span_rpass"></span></p>

			<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a12'] ?></div>

			</li>





<div class="robotic">

<li>

      <label>If you are human leave this blank:</label>

      <input name="robotest" type="text" id="robotest" class="robotest" />

</li>

</div>







			<div class="ClearAll"></div><br>

			

		</div>

		</ul>

	

</div>



<?



	 /**

	 * Page: Register Step 2

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>



	<div id="reg_step_2" style="display:visible"> 

	

			<div class="CapTitle"><?=$GLOBALS['LANG_REGISTER']['a13'] ?></div>

			<div class="CapBody">

			<ul class="form">

			<?=$REGISTER_ARRAY ?>		

			</ul>



				

	</div>

	</div>



<?



	 /**

	 * Page: Register Step 3

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>



<div id="reg_step_3" style="display:visible">		

		<!-- START PHOTO UPLOAD -->

		<div class="CapTitle"><?=$GLOBALS['LANG_REGISTER']['a14'] ?></div>

		<div class="CapBody">

			<ul class="form">

				<li><label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/pictures.png" align="absmiddle">

				<?=$GLOBALS['LANG_REGISTER']['a15'] ?>:</label> 





<span id="upMe1" style="display:visible;">1. <input name="uploadFile00" type="file" id="uploadFile00" tabindex="100"></span><br><div class="ClearAll"></div>

<span id="upMe2" style="display:visible; margin-left:210px;">2. <input name="uploadFile01" type="file" id="uploadFile01" onChange="toggleLayer('upMe3');"></span><div class="ClearAll"></div>

<span id="upMe3" style="display:none;margin-left:210px;">3. <input name="uploadFile02" type="file" id="uploadFile02" tabindex="101" onChange="toggleLayer('upMe4');"></span>

<span id="upMe4" style="display:none;margin-left:210px;">4. <input name="uploadFile03" type="file" id="uploadFile03" onChange="toggleLayer('upMe5');"></span>

<span id="upMe5" style="display:none;margin-left:210px;">5. <input name="uploadFile04" type="file" id="uploadFile04" onChange="toggleLayer('upMe6');"></span>

<span id="upMe6" style="display:none;margin-left:210px;">6. <input name="uploadFile05" type="file" id="uploadFile05" onChange="toggleLayer('upMe7');"></span>

<span id="upMe7" style="display:none;margin-left:210px;">7. <input name="uploadFile06" type="file" id="uploadFile06" onChange="toggleLayer('upMe8');"></span>

<span id="upMe8" style="display:none;margin-left:210px;">8. <input name="uploadFile07" type="file" id="uploadFile07" onChange="toggleLayer('upMe9');"></span>

<span id="upMe9" style="display:none;margin-left:210px;">9. <input name="uploadFile08" type="file" id="uploadFile08" onChange="toggleLayer('upMe10');"></span>

<span id="upMe10" style="display:none;margin-left:210px;">10. <input name="uploadFile09" type="file" id="uploadFile09" onChange="toggleLayer('upMe11');"></span>

<span id="upMe11" style="display:none;margin-left:210px;"> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> You cannot add any more files yet.</span>





					<p class="note"><?=$GLOBALS['LANG_REGISTER']['a16'] ?></p>

					 <div class="tip"><?=$GLOBALS['LANG_REGISTER']['a17'] ?></div>

				</li>   

			<input type="hidden" name='uploadNeed' value=1 class="hidden">

			<input type="hidden" name="default" value="1" class="hidden">



				 

			</ul> 

		</div>	

		<!-- START TERMS AND CONDITIONS -->

</div>





<?



	 /**

	 * Page: Register Step 4 / SMS integration

	 *

	 * @version  9.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>



	<div id="reg_step_4" style="display:visible">	

	

	<input name="notify"  type="hidden" value="yes" class="radio" checked>

	<input name="news" type="hidden" value="yes" class="radio" checked>	

	

			<div class="CapTitle"><?=$GLOBALS['LANG_REGISTER']['a18'] ?></div>

			<div class="CapBody">			

			<ul class="form">







				<? if(UPGRADE_SMS =="yes"){ ?>

				

				<li>	

						<label><?=$GLOBALS['LANG_SETTINGS']['a2'] ?></label> 

						<input name="smsnum" maxlength="30" class="input" tabindex="201" type="text" size="40"value="<? if(isset($_POST['smsnum'])){print eMeetingOutput($_POST['smsnum']); } ?>">

						<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a3'] ?></div>

				</li>

				

				<li>	

						<label><?=$GLOBALS['LANG_SETTINGS']['a6'] ?></label> 

						<select name="sms_msg_alert" class="input" tabindex="202">

						<option value="on"><?=$GLOBALS['_LANG']['_yes'] ?></option>

						<option value="off"><?=$GLOBALS['_LANG']['_no'] ?></option>

						</select>

						<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a9'] ?></div>

				</li>	

				

				<? if (D_WINK == 1) { ?>

				<li>	

						<label><?=$GLOBALS['LANG_SETTINGS']['a10'] ?></label> 

						<select name="sms_wink_alert" class="input" tabindex="203">

						<option value="on"><?=$GLOBALS['_LANG']['_yes'] ?></option>

						<option value="off"><?=$GLOBALS['_LANG']['_no'] ?></option>

						</select>

						<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a11'] ?></div>

				</li>

				<? } ?>



				

			<? } ?>





<hr>

			<? if(D_REGISTER_IMAGE ==1){ ?>

					<li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>

					

<br>				

<br>

<div class="g-recaptcha" data-sitekey="<?=reCAPTCH_APP_ID ?>"></div>

<?php /*?>

require_once('inc/func/recaptchalib.php');



// Get a key from https://www.google.com/recaptcha/admin/create

$publickey = "6LfnLuoSAAAAAGN1uHHhdpw42bfh8tVsVcBPJlXb";

$privatekey = "6LfnLuoSAAAAAL4R0TyGb5mNSC_C31WI79L9EdXH";

echo recaptcha_get_html($publickey, $error);<?php */?>



										</li>

			<? } ?>		



			<ul class="form"><div class="CapBody paddind_0">	

					<li><div><textarea readonly="readonly" style="width:280px; height:100px;"><?=DisplayTerms() ?></textarea></div></li>

					<li style="font-size:12px;"> <input name="t&C" type="checkbox" value="1" id="t&C" tabindex="205" onClick="agreeregisterForm()"> <?=$GLOBALS['LANG_REGISTER']['a23'] ?> <a href="<?=DB_DOMAIN ?>mobile.php?dll=privacy" target="_blank"><?=$GLOBALS['LANG_REGISTER']['a24'] ?></a><?=$GLOBALS['LANG_REGISTER']['a25'] ?>

					</li>

			</div></ul>



					<li><input value="<?=$GLOBALS['_LANG']['_register'] ?>" id="MainSubBtn" type="submit" class="MainBtn" style="" tabindex="206"></a> </li>

			  </ul> 

			</div>

		</div>	

		

</div>

<!-- END DISPLAY -->	

</form>



















<? }elseif($show_page=="activation"){ 





	 /**

	 * Page: Waiting for your activation email

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */



?>





	<ul class="form"> 

 

	<div class="CapBody">	

	

<p><b style="font-size:16px;"><?=$GLOBALS['LANG_REGISTER']['32'] ?></b></p>

<p><b><?=str_replace("%s",$_SESSION['username'],$GLOBALS['LANG_REGISTER']['33']) ?></b></p>

<p><?=$GLOBALS['LANG_REGISTER']['34'] ?> <?=$_SESSION['my_email'] ?></p>

<p><?=$GLOBALS['LANG_REGISTER']['35'] ?></p>



<div id="eMeeting_ResendActivation" class="responce_alert"></div>



		<form method="post" action="<?=DB_DOMAIN ?>index.php" onSubmit="ResendActivationCode(<?=$_SESSION['uid'] ?>,this.email.value); return false;">		

		<ul class="form">   

		<div class="CapBody">	

			<li><b><?=$GLOBALS['LANG_REGISTER']['36'] ?></b></li>                   

			<li><label><?=$GLOBALS['_LANG']['_new'] ?> <?=$GLOBALS['_LANG']['_email'] ?></label><input maxlength="150" name="email" type="text" size="25" class="input"></li>

			<li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>

		</div>

		</ul>

		</form>



	</div>

	</ul>	





















<? }elseif($show_page=="contacts"){ 





	 /**

	 * Page: Invite Friend Contacts Display

	 *

	 * @version  8.0

	 * @created  Fri Jan 18 10:48:31 EEST 2008

	 * @updated  Fri Sep 24 16:28:31 EEST 2008

	 */





	 /**

	 * Page:  Waiting Box

	 *

	 * @version  9.0

	 */



?>



		<!-- ****************** UPLOAD WAITING / LOADING SCREEN ************** -->

		<div id="UploadWait">

			<p><strong><?=$GLOBALS['LANG_REGISTER']['30'] ?></strong></p>

			<p><?=$GLOBALS['LANG_REGISTER']['31'] ?></p>

			<p><img src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/loading.gif"></p>

		</div>

		<!-- **************************************************************** -->



<div id="MainRegisterForm" style="display:visible">



	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="MyContacts" id="MyContacts" onSubmit="return SendEmailContacts();">

	<input name="do" type="hidden" value="email_contacts" class="hidden"  id="cSS">

	<input name="do_page" type="hidden" value="register" class="hidden">

	<input name="system" type="hidden" value="hotmail" class="hidden">

	<? $i=1; 

	$counter=0;

	$FoundMember = array(); 

	if(is_array($contacts_array)){  foreach($contacts_array as $value){ ?>



	<input type='hidden' name='name<?=$i ?>' value='<?=$value["username"] ?>' class='hidden'>

	<input type='hidden' name='email<?=$i ?>' value='<?=$value["email"] ?>' class='hidden'>		 

	<? $i++;} } ?>

		

	<ul class="form"> 

 

	<div class="CapBody">	

	

		<p><?=$GLOBALS['LANG_NETWORK']['a28'] ?> <?=count($contacts_array) ?> <?=$GLOBALS['LANG_NETWORK']['a29'] ?>, <?=$counter ?> <?=$GLOBALS['LANG_NETWORK']['a30'] ?></p>

		<p><?=$GLOBALS['LANG_NETWORK']['a31'] ?></p>		

		<input type='hidden' name='totalrows' value='<?=count($contacts_array) ?>' class="hidden" >

		<li><input value="<?=$GLOBALS['LANG_NETWORK']['a32'] ?>" type="submit" class="NormBtn"> 

		<input value="<?=$GLOBALS['LANG_NETWORK']['a33'] ?>" type="button" class="NormBtn" onclick="ChangeRegContactType();return false"> </li>



	</div>

	</ul>	



	</form>



</div>



	

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
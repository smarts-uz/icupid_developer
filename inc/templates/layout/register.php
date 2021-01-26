<?php
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );
?>
<div id="main">         
    <div id="main_content_wrapper">     
		<?
		if(!isset($HEADER_SINGLE_COLUMN)){ 
		?>
		<div class='conten_outer' style="padding:10px 20px;">
		<?
		}
		?>
		<div class="clear"></div>
		<?
		if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){
		?>


	    <div id="messages">
			<div class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
	          	<a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
	          	<?=$ERROR_MESSAGE ?>
	        </div>
	        <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
	    </div>
    	<? } ?>
		<script>
		function agreeregisterForm(){
			document.getElementById('MainSubBtn').disabled = false;
		}
		</script>

		<?
		foreach($BANNER_ARRAY as $banner){
			if($banner['position'] =="middle"){?>
			<div class="middle_banner"><? print $banner['display'];?></div>
			<?
			}
		}
		?>
		<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>
		
		<style>
		#fullpage div#main{ width: 80%; }
		ul.form li .tip {  border:0px;}
		.robotic { display: none; }
		.validate_field .input{
			float: left;
		}
		.validate_field .note{
			display: block;
    		left: 30px;
			clear: both;
			float: left;
			font-size: 100% !important;
			margin-bottom: 10px !important;
			display: none;
		}
		.validate_field .note img{
			top: 0px;
		}
		</style>
 

		<?
		if($show_page=="home"){
		?>

		<!-- ****************** UPLOAD WAITING / LOADING SCREEN ************** -->
		<div id="UploadWait1" style="display:none;">
			<p><strong><?=$GLOBALS['LANG_REGISTER']['28'] ?></strong></p>
			<p><?=$GLOBALS['LANG_REGISTER']['29'] ?></p>
			<p><img src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/loading.gif"></p>
		</div>
		<!-- **************************************************************** -->  

		<?php if(VALIDATE_EMAIL==1){
			$verifyemail = "?chek=emailactivate";
		}
		else {
			$verifyemail ="";
		}?>
		<form method="post" action="<?=DB_DOMAIN ?>index.php<?php echo $verifyemail;?>" name="MemberSearch" enctype="multipart/form-data" onsubmit="return CheckPageNullsRegister();">
			<!--  toggleLayer('UploadWait1'); onsubmit="return CheckRegisterNulls('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>','<?=$GLOBALS['_LANG_ERROR']['_noT&C'] ?>');" -->
			<input name="do" type="hidden" value="add" class="hidden">             
			<input name="do_page" type="hidden" value="register" class="hidden">
			<input name="reg_type" type="hidden" value="Reg Page" class="hidden">
			<input name="title" type="hidden" value="" class="hidden">
			<input name="comments" type="hidden" value="" class="hidden">
			<script src="<?=DB_DOMAIN ?>inc/js/_extras/_date.js"></script>
			<span id="response_register" class="responce_alert"></span>

			<?
			/**
	 		* Page: Register Waiting Box
	 		*
	 		* @version  13.0
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
						<div class="CapBody validate_field"> 
							<div class="col-md-12">
							<li>
								<label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/vcard.png" width="16" height="16" align="absmiddle"> <?=$GLOBALS['_LANG']['_username'] ?>: </label>
								<input name="username" type="text" class='input' id="regUsername" tabindex="1" onchange="validateUsername(this.value);" value="<? if(isset($_POST['username'])){print eMeetingOutput($_POST['username']); } ?>" size="35" maxlength="15"/>   
								<p class="note" id="response_span" style="display: none;"></p>
								<?/*<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a6'] ?></div>*/?>
							</li>
					
							<li>
								<label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/email.png" width="16" height="16" align="absmiddle"> <?=$GLOBALS['_LANG']['_email'] ?>: </label>
								<input type="text" class='input' size="35" name="email" id="regEmail" tabindex="2" onchange="validateEmail(this.value);" value="<? if(isset($_POST['email'])){print eMeetingOutput($_POST['email']); } ?>"/>
								<p class="note" id="response_span_email"></p>
								<?/*<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a8'] ?></div>*/?>
							</li>
							</div>
							<div class="col-md-12">
							<li>
								<label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_go.png" width="16" height="16" align="absmiddle"> <?=$GLOBALS['_LANG']['_password'] ?>: </label>
								<input type="password" class='input' size="35" name="password" id="regPassword" tabindex="3" onchange="validatePassword(this.value);" value="<? if(isset($_POST['password'])){print eMeetingOutput($_POST['password']); } ?>"/>
								<p class="note" id="response_span_pass"></p>
								<?/*<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a10'] ?></div>*/?>
							</li>
	
							<li>
								<label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/key_add.png" width="16" height="16" align="absmiddle"> <?=$GLOBALS['LANG_REGISTER']['a11'] ?>: </label>
								<input type="password" class='input' size="35" name="password_confirm" id="regRPassword" onChange="CheckPassword();" tabindex="4" value="<? if(isset($_POST['password_confirm'])){print eMeetingOutput($_POST['password_confirm']); } ?>"/>
								<p class="note" id="response_span_rpass"></p>
								<?/*<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a12'] ?></div>*/?>
							</li>
							</div>
							
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
				* @version  13.0
				* @created  Fri Jan 18 10:48:31 EEST 2008
				* @updated  Mon Oct 16 16:28:31 EEST 2008
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
				* @updated  Mon Oct 16 16:28:31 EEST 2008
				*/

				?>

				<div id="reg_step_3" style="display:visible">		
					<!-- START PHOTO UPLOAD -->
					<div class="CapTitle"> <?=$GLOBALS['LANG_REGISTER']['a14'] ?></div>
					<div class="CapBody">
						<ul class="form">
							<li>
								<label><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/pictures.png" align="absmiddle"> <?=$GLOBALS['LANG_REGISTER']['a15'] ?>:</label> 
								<span id="upMe1" style="display:visible;">1. <input name="uploadFile00" type="file" id="uploadFile00" tabindex="100"></span><br><div class="ClearAll"></div>
								<span id="upMe2" style="display:visible;">2. <input name="uploadFile01" type="file" id="uploadFile01" onChange="toggleLayer('upMe3');"></span><div class="ClearAll"></div>
								<span id="upMe3" style="display:none;">3. <input name="uploadFile02" type="file" id="uploadFile02" tabindex="101" onChange="toggleLayer('upMe4');"></span>
								<span id="upMe4" style="display:none;">4. <input name="uploadFile03" type="file" id="uploadFile03" onChange="toggleLayer('upMe5');"></span>
								<span id="upMe5" style="display:none;">5. <input name="uploadFile04" type="file" id="uploadFile04" onChange="toggleLayer('upMe6');"></span>
								<span id="upMe6" style="display:none;">6. <input name="uploadFile05" type="file" id="uploadFile05" onChange="toggleLayer('upMe7');"></span>
								<span id="upMe7" style="display:none;">7. <input name="uploadFile06" type="file" id="uploadFile06" onChange="toggleLayer('upMe8');"></span>
								<span id="upMe8" style="display:none;">8. <input name="uploadFile07" type="file" id="uploadFile07" onChange="toggleLayer('upMe9');"></span>
								<span id="upMe9" style="display:none;">9. <input name="uploadFile08" type="file" id="uploadFile08" onChange="toggleLayer('upMe10');"></span>
								<span id="upMe10" style="display:none;">10. <input name="uploadFile09" type="file" id="uploadFile09" onChange="toggleLayer('upMe11');"></span>
								<span id="upMe11" style="display:none;"> <img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> You cannot add any more files yet.</span>

								<div class="tip"><?=$GLOBALS['LANG_REGISTER']['a16'] ?></div>
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
				* @version  13.0
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
								<select name="sms_wink_alert" class="input">
									<option value="on"><?=$GLOBALS['_LANG']['_yes'] ?></option>
									<option value="off"><?=$GLOBALS['_LANG']['_no'] ?></option>
								</select>
								<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a11'] ?></div>
							</li>
							<? } ?>
							<? } ?>

							<hr>
							<? if(D_REGISTER_IMAGE ==1){ ?>
							<li>
								<label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>
								<br/>
							
								<div id="RecaptchaRegister" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</li>
							
							<? } ?>
							<ul class="form">
								<div class="CapBody reg_cap">	
									<li>
										<div><textarea readonly="readonly" style="width:450px; height:70px;"><?=DisplayTerms() ?></textarea></div>
									</li>
									<li style="font-size:12px;">
										<input name="t&C" type="checkbox" value="1" id="t&C" tabindex="205" onClick="agreeregisterForm()"> <?=$GLOBALS['LANG_REGISTER']['a23'] ?>
										<a href="<?=getThePermalink('privacy')?>" target="_blank"><?=$GLOBALS['LANG_REGISTER']['a24'] ?></a><?=$GLOBALS['LANG_REGISTER']['a25'] ?>
									</li>
								</div>
							</ul>

							<li><input value="<?=$GLOBALS['_LANG']['_register'] ?>" id="MainSubBtn" type="submit" class="MainBtn" name="register" tabindex="206"></a> </li>
					  	</ul> 
					</div>
				</div>	
	
			</div>
		<!-- END DISPLAY -->	
		</form>

		<?php
		if(D_REGISTER_IMAGE == 1){
		?>
		<script type="text/javascript">
		  var CaptchaCallback = function() {
		    grecaptcha.render('RecaptchaRegister', {'sitekey' : '<?=reCAPTCH_APP_ID ?>'});
		  };
		</script>
		<?php
		}
	}elseif($show_page=="activation"){ 


	 /**
	 * Page: Waiting for your activation email
	 *
	 * @version  13.0
	 * @created  Fri Jan 18 10:48:31 EEST 2008
	 * @updated  Mon Oct 16 16:28:31 EEST 2008
	 */

	?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="form">
   		<div class="row">
		    <div class="CapBody col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
		    	<p><b style="font-size:16px;"><?=$GLOBALS['LANG_REGISTER']['32'] ?></b></p>
		        <p><b><?=str_replace("%s",$_SESSION['username'],$GLOBALS['LANG_REGISTER']['33']) ?></b></p>
		        <p><?=$GLOBALS['LANG_REGISTER']['34'] ?> <?=(isset($_SESSION['my_email'])?$_SESSION['my_email']:""); ?></p>
        		<p><?=$GLOBALS['LANG_REGISTER']['35'] ?></p>
        		<div id="eMeeting_ResendActivation" class="responce_alert"></div>
            	<form method="post" action="<?=DB_DOMAIN ?>index.php" onSubmit="ResendActivationCode(<?=$_SESSION['uid'] ?>,this.email.value); return false;">		
            		<ul class="form">   
            			<div class="CapBody col-xs-12 col-sm-12 col-md-12 col-lg-12">	
                			<li><b><?=$GLOBALS['LANG_REGISTER']['36'] ?></b></li>                   
                			<li><label><?=$GLOBALS['_LANG']['_new'] ?> <?=$GLOBALS['_LANG']['_email'] ?></label><input maxlength="150" name="email" type="text" size="25" class="input"></li>
                			<li><input type="submit" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>
            			</div>
            		</ul>
            	</form>
        	</div>
        </div>
    </ul>
</div>

<? }elseif($show_page=="contacts"){ 

/**
* Page: Invite Friend Contacts Display
*
* @version  13.0
* @created  Fri Jan 18 10:48:31 EEST 2008
* @updated  Mon Oct 16 16:28:31 EEST 2008
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
				<li>
					<input value="<?=$GLOBALS['LANG_NETWORK']['a32']?>" type="submit" class="NormBtn">
					<input value="<?=$GLOBALS['LANG_NETWORK']['a33'] ?>" type="button" class="NormBtn" onclick="ChangeRegContactType();return false">
				</li>
			</div>
		</ul>	

	</form>

</div>

<?
if(!empty($FoundMember)){
?>
<ul class="form"> 
	<div class="CapTitle"><?=$GLOBALS['LANG_NETWORK']['a34'] ?></div> 
	<div class="CapBody">	
		<li><p><?=$GLOBALS['LANG_NETWORK']['a35'] ?></p></li>
		<?=DisplayContacts($FoundMember) ?>
	</div>
</ul>
<?
}

}

/* MAIN CLOSE */
if(!isset($HEADER_SINGLE_COLUMN)){ ?>
</div><div class="clear"></div> <? }else{ print "</div>"; }
?>

</div>
<div id="main_wrapper_bottom"></div>
</div>

<script type="text/javascript">
function mapInitialize(id) {
    var input = document.getElementById(id);
        var options = {types: ['(cities)'], componentRestrictions: {}};

        new google.maps.places.Autocomplete(input, options);
    }

google.maps.event.addDomListener(window, 'load', function() {  
    mapInitialize('registerLocation');
});
</script>
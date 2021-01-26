<?php
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );
?>
<!-- css -->
<link rel="stylesheet" href="<?=DB_DOMAIN?>inc/css/cslide/base.css" />
<link rel="stylesheet" href="<?=DB_DOMAIN?>inc/css/cslide/style.css" />
    
<!-- js -->
<script src="<?=DB_DOMAIN?>inc/js/cslide/jquery-1.9.1.min.js"></script>
<script src="<?=DB_DOMAIN?>inc/js/cslide/jquery.cslide.js" type="text/javascript"></script>
<script src="<?=DB_DOMAIN?>inc/js/_register_slide.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$('.cslide-next').click(function() {
		
		//alert('he');

		return false;
	});

    $("#cslide-slides").cslide();

    $(".btn-register").click(function(){
    	
    	var formData = new FormData($("form#slideRegister")[0]);
    	
        $.ajax({
            url:"<?=DB_DOMAIN?>inc/ajax/_actions_register.php",
            type:"POST",
            data: formData,
            contentType: false,       
	        cache: false,             
	        processData:false,                                  
	        success:function(data) {    
	            console.log('success!');
	            var rlt = $.parseJSON( data );
	            if(rlt.code == 'activateAccount'){

	            	$("#regActivationUsername").val($("#regUsername").val());
	            	$("#regActivationEmail").val($("#regEmail").val());

	            	var slidesContainerId = '#cslide-slides';
	            	
	            	var i = $(slidesContainerId+" .cslide-slide.cslide-active").index();
	                var n = i+1;

	                if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
	                    
	                    $("#reg-pagination .active").addClass('visited').removeClass('active');
	                    $("#reg-pagination .step").each(function(){
	                        if(!$(this).hasClass('visited')){
	                            $(this).addClass('active');
	                            return false;
	                        }
	                    });

	                }

	                var slideLeft = "-"+n*100+"%";
	                if (!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
	                    $(slidesContainerId+" .cslide-slide.cslide-active").removeClass("cslide-active").next(".cslide-slide").addClass("cslide-active");
	                    $(slidesContainerId+" .cslide-slides-container").animate({
	                        marginLeft : slideLeft
	                    },250);
	                    if ($(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-last")) {
	                        $(slidesContainerId+" .cslide-next").addClass("cslide-disabled");
	                    }
	                }
	                if ((!$(slidesContainerId+" .cslide-slide.cslide-active").hasClass("cslide-first")) && $(".cslide-prev").hasClass("cslide-disabled")) {
	                    $(slidesContainerId+" .cslide-prev").removeClass("cslide-disabled");
	                }
	                
	                $('html, body').animate({
	                    scrollTop: $("#reg-pagination").offset().top
	                }, 1000);
	            }
	            else if(rlt.code == 'gogogo'){
	            	window.location.href = "<?=DB_DOMAIN?>index.php";
	            }
	            else{
	            	$("#main-message-bad span").text(rlt.code);
	            	$("#main-message-bad").show();
	            	$('html, body').animate({
	                    scrollTop: $("body").offset().top
	                }, 500);
	            }
	        },
	        error: function (a, b, c) {
	            console.log(a)
	            console.log(b)
	            console.log(c)
	        }
            
        });
        return false;
  	});
});
</script>
<script>
	function agreeregisterForm(){
		document.getElementById('MainSubBtn').disabled = false;
	} 
</script>
<? 
foreach($BANNER_ARRAY as $banner){
	if($banner['position'] =="middle"){ ?>
	<div class="middle_banner">
	<? print $banner['display'];?>
		
	</div>
	<? 
	}
} ?>

<p <? if ($PageDesc !='') {?> class="page_decr" <? }?> ><?=$PageDesc ?></p>
<style>
	ul.form li .tip {  border:0px;}
	.robotic { display: none; }
</style>

<div id="messages">
      <div class="message-bad" id="main-message-bad" style="display: none;">
      	<a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-bad', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
      		<span>username is already in use</span>
      </div>
    <script type="text/javascript" language="javascript">Effect.Pulsate('main-message-bad', { pulses : 2, duration : 1, from : 0.7 });</script>
</div>

<div class="registration-container">
	<div class="row">
		<div class="col-md-12">
		<h2 class="text-center">Registration Welcome Text</h2>
		</div>
	</div>
</div>

<?php
echo DisplayRegisterPagination();
?>
<?php
if($show_page=="home"){ ?>


	<!-- ****************** UPLOAD WAITING / LOADING SCREEN ************** -->
	<div id="UploadWait1" style="display:none;">
		<p><strong><?=$GLOBALS['LANG_REGISTER']['28'] ?></strong></p>
		<p><?=$GLOBALS['LANG_REGISTER']['29'] ?></p>
		<p><img src="<?=DB_DOMAIN ?>images/DEFAULT/_gal/loading.gif"></p>
	</div>
	<!-- **************************************************************** -->  

<?php 
	if(VALIDATE_EMAIL==1) { $verifyemail = "?chek=emailactivate"; }
	else {
		$verifyemail ="";
	}
?>

<form method="post" action="<?=DB_DOMAIN ?>index.php<?php echo $verifyemail;?>" enctype="multipart/form-data" name="MemberSearch" id="slideRegister">

	<input name="do" type="hidden" value="add" class='hidden'>
	<input name="action" type="hidden" value="register" class='hidden'>
	<input name="do_page" type="hidden" value="register" class="hidden">
	<input name="reg_type" type="hidden" value="Reg Page" class="hidden">
	<input name="sub" type="hidden" value="edit" class="hidden">
	<? if(isset($_SESSION['site_moderator_edit']) && $_SESSION['site_moderator_edit'] =="yes" && isset($_GET['id']) && is_numeric($_GET['id']) ){ ?>	
	<input name="eid" type="hidden" value="<?=$_GET['id'] ?>" class="hidden">	
	<? }else{ ?>
	<input name="eid" type="hidden" value="<?=$_SESSION['uid'] ?>" class="hidden">	
	<? } ?>
	<input type="hidden" value="1" name="StopConfigStrip"/>
	<script src="<?=DB_DOMAIN ?>inc/js/_extras/_date.js"></script>

	<input name="title" type="hidden" value="" class="hidden">
	<input name="comments" type="hidden" value="" class="hidden">
	<script src="<?=DB_DOMAIN ?>inc/js/_extras/_date.js"></script>
	<span id="response_register" class="responce_alert"></span>

	<ul id="cslide-slides" class="cslide-slides-master clearfix form form-boxed">
	    <div class="cslide-slides-container clearfix">
			<div id="bod_0" class="cslide-slide cslide-active" style="width: 20%;">

				<div id="MainRegisterForm" class="registration-container">


					<div id="reg_step_1">

						<div class="row">
							<div class="col-md-12">
								<h3>Register</h3>
							</div>
							<div class="col-md-6 validate_field">
								<label>
									<span class="required">*</span><?=$GLOBALS['_LANG']['_username'] ?>:
								</label>
								<input name="username" type="text" class='form-control' id="regUsername" onchange="validateUsername(this.value);" value="<? if(isset($_POST['username'])){print eMeetingOutput($_POST['username']); } ?>" size="35" onfocus="registerRemoveStyle('regUsername');" placeholder="Enter desired username" maxlength="15"/>
								<p class="note" id="response_span" style="display: none;"></p>
								<?/*<small class="form-text text-muted"><?=$GLOBALS['LANG_REGISTER']['a6'] ?></small>*/?>
							</div>
							<div class="col-md-6 validate_field">
								<label>
									<span class="required">*</span><?=$GLOBALS['_LANG']['_email'] ?>: 
								</label>
								<input type="text" class='form-control' size="35" name="email" id="regEmail" onchange="validateEmail(this.value);" placeholder="Email" onfocus="registerRemoveStyle('regEmail');"  value="<? if(isset($_POST['email'])){print eMeetingOutput($_POST['email']); } ?>"/>
								<p class="note" id="response_span_email" style="display: none;"></p>
								<?/*<small class="form-text text-muted"><?=$GLOBALS['LANG_REGISTER']['a8'] ?></small>*/?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 validate_field">
								<label>
									<span class="required">*</span><?=$GLOBALS['_LANG']['_password'] ?>: 
									<small class="label-deiscription">(Password must be between 4 and 15 characters long)</small>
								</label>
								<input type="password" class='form-control' size="35" name="password" id="regPassword" onchange="validatePassword(this.value);" onfocus="registerRemoveStyle('regPassword');" placeholder="Password" value="<? if(isset($_POST['password'])){print eMeetingOutput($_POST['password']); } ?>" />
								<p class="note" id="response_span_pass"  style="display: none;"></p>
								<?/*<small class="form-text text-muted"><?=$GLOBALS['LANG_REGISTER']['a10'] ?></small>*/?>		
							</div>
							<div class="col-md-6 validate_field">
								<label>
									<span class="required">*</span><?=$GLOBALS['LANG_REGISTER']['a11'] ?>:
								</label>
								<input type="password" class='form-control' size="35" name="password_confirm" id="regRPassword" onChange="CheckPassword();" onfocus="registerRemoveStyle('regRPassword');" placeholder="Re-enter Password" value="<? if(isset($_POST['password_confirm'])){print eMeetingOutput($_POST['password_confirm']); } ?>" />
								<p class="note" id="response_span_rpass" style="display: none;"></p>
								<?/*<small class="form-text text-muted"><?=$GLOBALS['LANG_REGISTER']['a12'] ?></small>*/?>

								<div class="robotic">
									<label>If you are human leave this blank:</label>
								    <input name="robotest" type="text" id="robotest" class="robotest" />
								</div>
							</div>

						</div>
					</div>

					<hr/>
					<div id="reg_step_3" style="display:visible">		
						
						<div class="row">
						
							<div class="col-md-12">

								<label>
									<span class="required">*</span><?=$GLOBALS['LANG_REGISTER']['a15'] ?>:
								</label> 

								<div class="row">
									<div class="col-md-3 text-right line-height">1.</div>
									<div class="col-md-9">
										<input name="uploadFile00" type="file" id="uploadFile00" >
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right line-height">2.</div>
									<div class="col-md-9">
										<input name="uploadFile01" type="file" id="uploadFile01" onChange="toggleLayer('upMe3');">
									</div>
								</div>
									 
								
								
								<div class="row" id="upMe3" style="display:none;">
									<div class="col-md-3 text-right line-height">3.</div>
									<div class="col-md-9">
										<input name="uploadFile02" type="file" id="uploadFile02" onChange="toggleLayer('upMe4');">
									</div>
								</div>


								<div class="row" id="upMe4" style="display:none;">
									<div class="col-md-3 text-right line-height">4.</div>
									<div class="col-md-9">
										<input name="uploadFile03" type="file" id="uploadFile03" onChange="toggleLayer('upMe5');">
									</div>
								</div>

								<div class="row" id="upMe5" style="display:none;">
									<div class="col-md-3 text-right line-height">5.</div>
									<div class="col-md-9">
										<input name="uploadFile04" type="file" id="uploadFile04" onChange="toggleLayer('upMe6');">
									</div>
								</div>
								
								<div class="row" id="upMe6" style="display:none;">
									<div class="col-md-3 text-right line-height">6.</div>
									<div class="col-md-9">
										<input name="uploadFile05" type="file" id="uploadFile05" onChange="toggleLayer('upMe7');">
									</div>
								</div>

								<div class="row" id="upMe7" style="display:none;">
									<div class="col-md-3 text-right line-height">7.</div>
									<div class="col-md-9">
										<input name="uploadFile06" type="file" id="uploadFile06" onChange="toggleLayer('upMe8');">
									</div>
								</div>

								<div class="row" id="upMe8" style="display:none;">
									<div class="col-md-3 text-right line-height">8.</div>
									<div class="col-md-9">
										<input name="uploadFile07" type="file" id="uploadFile07" onChange="toggleLayer('upMe9');">
									</div>
								</div>
								
								<div class="row" id="upMe9" style="display:none;">
									<div class="col-md-3 text-right line-height">9.</div>
									<div class="col-md-9">
										<input name="uploadFile08" type="file" id="uploadFile08" onChange="toggleLayer('upMe10');">
									</div>
								</div>
								
								<div class="row" id="upMe10" style="display:none;">
									<div class="col-md-3 text-right line-height">10.</div>
									<div class="col-md-9">
										<input name="uploadFile09" type="file" id="uploadFile09" onChange="toggleLayer('upMe11');">
									</div>
								</div>
								
								<div class="row" id="upMe11" style="display:none;">
									<div class="col-md-3 text-right line-height"></div>
									<div class="col-md-9">
										<img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/cancel.png" align="absmiddle"> You cannot add any more files yet.
									</div>
								</div>

								
								<p class="note"><?=$GLOBALS['LANG_REGISTER']['a16'] ?></p>
								<small class="form-text text-muted"><?=$GLOBALS['LANG_REGISTER']['a17'] ?></small>
							
								<input type="hidden" name='uploadNeed' value=1 class="hidden">
								<input type="hidden" name="default" value="1" class="hidden">

								<!-- START TERMS AND CONDITIONS -->
							</div>
					
						</div>
					</div>

					<div id="reg_step_4">	
						<hr>
						<div class="row">
						
							<div class="col-md-6">

								<input name="notify"  type="hidden" value="yes" class="radio" checked>
								<input name="news" type="hidden" value="yes" class="radio" checked>	
					
								<div class="CapTitle"><?=$GLOBALS['LANG_REGISTER']['a18'] ?></div>
								

								<? 
								if(UPGRADE_SMS =="yes"){ ?>
									
									<li>	
											<label><?=$GLOBALS['LANG_SETTINGS']['a2'] ?></label> 
											<input name="smsnum" maxlength="30" class="input" type="text" size="40"value="<? if(isset($_POST['smsnum'])){print eMeetingOutput($_POST['smsnum']); } ?>">
											<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a3'] ?></div>
									</li>
									
									<li>	
											<label><?=$GLOBALS['LANG_SETTINGS']['a6'] ?></label> 
											<select name="sms_msg_alert" class="input" >
											<option value="on"><?=$GLOBALS['_LANG']['_yes'] ?></option>
											<option value="off"><?=$GLOBALS['_LANG']['_no'] ?></option>
											</select>
											<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a9'] ?></div>
									</li>	
									
									<? if (D_WINK == 1) { ?>
									<li>	
											<label><?=$GLOBALS['LANG_SETTINGS']['a10'] ?></label> 
											<select name="sms_wink_alert" class="input" >
											<option value="on"><?=$GLOBALS['_LANG']['_yes'] ?></option>
											<option value="off"><?=$GLOBALS['_LANG']['_no'] ?></option>
											</select>
											<div class="tip"><?=$GLOBALS['LANG_SETTINGS']['a11'] ?></div>
									</li>
									<? } ?>
								<? 
								}
								?>

								
								<? if(D_REGISTER_IMAGE ==1){ ?>
									<div class="form-group">
										<label><?=$GLOBALS['_LANG']['_verification'] ?>:</label>
										
										<div id="RecaptchaRegister" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
									</div>
								<? } ?>	
									
							</div>
						
							<div class="col-md-6">

									<div class="form-group">
										<textarea readonly="readonly" class="form-control"><?=DisplayTerms() ?></textarea>
									</div>
									<div class="form-group">
										<input name="t&C" type="checkbox" value="1" id="t&C" onClick="agreeregisterForm()"> <?=$GLOBALS['LANG_REGISTER']['a23'] ?> <a href="<?=DB_DOMAIN ?>privacy" target="_blank"><?=$GLOBALS['LANG_REGISTER']['a24'] ?></a><?=$GLOBALS['LANG_REGISTER']['a25'] ?>
									</div>
						
									<div class="form-group text-right">
										<a href="javascript:0;" onclick="var result = runRegistrationValidation('cslide-slides','<?=DB_DOMAIN?>'); return result;" class="MainBtn pull-right" style="padding:8px;">Continue</a>
										<!--<input value="Save & Continue" id="MainSubBtn" type="submit" class="MainBtn" name="register">-->
									</div>
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<?= $profile_details ?>
			 <div id="bod_10" class="cslide-slide" style="width: 20%;">
				<div class="row activation CapBody">
			    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
			        	<div class="form-group">
			        	<p><b style="font-size:16px;"><?=$GLOBALS['LANG_REGISTER']['32'] ?></b></p>
				        <p><b><?=str_replace("%s",'<span id="regActivationUsername"></span>',$GLOBALS['LANG_REGISTER']['33']) ?></b></p>
			    	    <p><?=$GLOBALS['LANG_REGISTER']['34'] ?> <span id="regActivationEmail"></span></p>
			        	<p><?=$GLOBALS['LANG_REGISTER']['35'] ?></p>
			        	<div id="eMeeting_ResendActivation" class="responce_alert"></div>
			           	
			            	<ul class="form">   
					            <div class="CapBody col-xs-12 col-sm-12 col-md-12 col-lg-12">	
				    	            <li><b><?=$GLOBALS['LANG_REGISTER']['36'] ?></b></li>                   
				        	        <li><label><?=$GLOBALS['_LANG']['_new'] ?> <?=$GLOBALS['_LANG']['_email'] ?></label><input maxlength="150" id="activation_email" name="activation_email" type="text" size="25" class="input"></li>
				            	    <li><input type="button" value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn" onclick="ResendActivationCode(32,document.getElementById('activation_email').value); return false;"></li>
				            	</div>
				            </ul>

			        	</div>
			        </div>
			    </div>
		    </div>
		</div>
		

		  
		
	</ul>
	

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
?>
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
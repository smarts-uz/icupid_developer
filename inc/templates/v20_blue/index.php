<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="inc/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="inc/js/_eMeetingGlobals.js"></script>
<?php  include('functions.php'); ?>
<?php  $fdata = DisplayFeaturedMembers(20);	?>
<style>
body{margin: 0px; font-family: sans-serif;}
#splitpage #main_content_wrapper { background:none; border:0px; width:100%;}
#splitpage #main_wrapper_bottom {	background: #ffffff;}
.Home_ImageBar { background-color:#373737; border-radius: 28px; }
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
.steps { font-size:16px; color:#DA0303;}
#page_container{width:100%;}
.page_content .fullscreen-bg {   
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  float: left;
}
#page_footer{ bottom: 0; width: 100%;}
#page_footer.footer_sec{ float: left; background: #333333; color: #ffffff;}

#page_footer .footer_menu{
  margin-bottom: 0px;
  text-align: center;
  width: 100%;
  margin: 0 auto;
  margin-left: auto;
  margin-right: auto;
  display: inline-block;
}
#page_footer ul.footer_tabs{
  margin: 0;
  padding: 0px;
  list-style: none;
  float: left;
  width: 100%;
  margin: 0;
  padding: 10px 0 0px 0;
  text-align: center;
  line-height: 24px;
}
#page_footer .footer_tabs li {
    float: none !important;
    display: inline-block;
    line-height: 30px;

}

.flink a, .flink li a span {
  color: #ffffff;
    margin: 0 5px;
    text-decoration: none;
    font-size: 14px;
}
#copyright_bar_temp {
    width: 100%;
    text-align: center;
    font-size: 14px;
}
#copyright_bar_temp a{
    text-decoration: none;
    color: #ffffff;
    font-weight: normal;
}

#copyright_bar{
    display: none;
}
.flags_table{
  	padding: 1% 0;
    width: 100%;
    text-align: center;
    margin: 0 auto;
}
ul.flags_ul {
    margin: 0 auto;
    padding: 0;
    list-style: none;
}
ul.flags_ul li {
    display: inline-block;
}
#page_container{background:none; border-bottom:none;}
#PageHeader{    z-index: 999; position: absolute; width: 100%;}
.content-width {
    margin: 0 auto;
    width: 65%;
}
.members-search {
    float: left;
    margin: 0 auto;
    width: 100%;
    margin: 100px 0px;
}
table.members-search-info {
    margin: 0 AUTO;
    background: #f0f1f3;
    padding: 2%;
    color: #000;
	 opacity: .93;
   text-align: center;
}
table.members-search-info input, table.members-search-info select {
    padding: 2%;
}
.age select{
  width: 22% !important;
  margin: 0% 2%; 
}
table.members-search-info td {
    line-height: 30px;
}
.back_image {
    position: fixed;
    top: 0;
    left: 0;
    min-width: 100%;
    opacity: .6;
    min-height: 100%;
}
.page_header{ z-index: 999; position: relative; width: 100%; float: left;}
#MenuBar{background: #17387d;width: 100%; float: left;text-align: center;}
#MenuBar ul{width: 100%; margin: 0px auto; padding: 2px 0px;}
#MenuBar ul li{ list-style: none; display:inline;/*float: left;*/ padding: 0% 1%; width: 100%; max-width: 73px; color: #ffffff;}
#MenuBar ul li a{color: #fff; text-decoration: none;}
.login-box{}
.login-box ul{float: none;padding: 0%;text-align: center;}
.login-box ul li{list-style: none; display: inline;}
.login-box ul li .input{margin: 2px 10px;padding: 5px;}
.login-box ul li .blue-btn{ background: #17387d; color: #fff; border: 1px solid #17387d; border-radius: 4px;padding: 4px 10px 6px 10px;}
.login-box ul .forget-txt a,.remember-me-txt{text-decoration: none;color: #17387d;color: #c3c3c3;line-height:35px;}
.page_content{width: 100%;float: left;}
.default-img img,.default-img .register-form{float: left;}
.btn-ragister {background: rgba(61,92,153,1);
    background: -moz-linear-gradient(top, rgba(61,92,153,1) 0%, rgba(54,81,134,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(61,92,153,1)), color-stop(100%, rgba(54,81,134,1)));
    background: -webkit-linear-gradient(top, rgba(61,92,153,1) 0%, rgba(54,81,134,1) 100%);
    background: -o-linear-gradient(top, rgba(61,92,153,1) 0%, rgba(54,81,134,1) 100%);
    background: -ms-linear-gradient(top, rgba(61,92,153,1) 0%, rgba(54,81,134,1) 100%);
    background: linear-gradient(to bottom, rgba(61,92,153,1) 0%, rgba(54,81,134,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3d5c99', endColorstr='#365186', GradientType=0 );
    font-size: 14px;
    text-align: center;
    padding: 9px 0px;
    width: 60%;
    margin: -10px 20% 10px 20%; 
    float: left;
    color: #fff;
    text-decoration: none;
    line-height: 14px;
    text-transform: capitalize;
    border-radius: 5px;
}
.btn-ragister img {
    vertical-align: top;
    float: none;
    display: inline;
}
.default-img
{
    float: left;
    width: 92%;
    background: #f0f1f3;
    margin: 0% 4%;
    border: 1px solid;
    box-shadow: 2px 2px 8px;
}
.default-img .register-form{
  width: 50%;
}

.default-img .register-form , .default-img .index-img{
  width: 50%;
  min-height: 615px;
}

.register-form select, .register-form .input{
    background: #FFFFFF;
    height: 26px;
    width: 92%;
    float: left;
    margin: 0% 4%;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.register-form .note{
	float: right;
    width: 62%;
    padding: 5px;
    margin: 0px;
}
.register-form .note span{
    float: left;
    line-height: 17px;
    font-size: 11px;
}
#validation_span,#validation_span_email,#validation_span_pass,#validation_span_tnc{
  color: #ff0000;    
}
.register-form .note img{
  width: 14px;
  margin-right: 5px;
}

.NormBtn{
    width: 180px;
    font-size: 18px;
    color: #ffffff;
    background-color: #17387d;
    border: 1px solid #17387d;
    padding: 6px 0px !important;
}
.register-form .label_left{
 	float: left;
    width: 35%;
    margin: 0 auto;
    text-align: right;
    line-height: 27px;
}
.input_div {
    FLOAT: RIGHT;
    WIDTH: 65%;
    MARGIN: 0 AUTO;
}
.tnc{
  font-size: 11px;
}
.tnc a{ 
  color: #b7bcbf;
}
.page_bottom_content{
  float: left;
  width: 92%;
  margin: 2% 4%;
}
.page_bottom_content .col-6{
    float: left;
    width: 44%;
    padding: 3%;
}
.page_bottom_content .video-col{
  text-align: center;
}

.page_bottom_content .video-col img,.page_bottom_content .video-col iframe{
  width: 100%;
}
.page_bottom_content .video-col a{
  background: #fff;
  text-decoration: none;
  margin: 20px 0px;
  width: 100%;
  padding: 6px 0px;
  font-size: 18px;
  float: left;
  color: #666666;
  border: 2px solid #666666;
  border-radius: 6px;
}
.login-box #ForgottenPassword{
   color: #ccc8c9;
    background: url(inc/templates/<?=D_TEMP ?>/images/arrow-login-top.png) no-repeat;
    padding-top: 8px;
    background-position: 3% 0px;
    float: right;
    width: 250px;
    position: absolute;
    right: 14.4%;
	top: 49%;
}
.forget-form .CapBody {
    background: #fff;
    padding: 10px;
    border: 2px solid #CCCCCC;
}
#ForgottenPassword .form.forget-form {
    margin: 0;
}

.login-box #ForgottenPassword ul.form .input, .login-box #ForgottenPassword .input {
    background: #fff;
    padding: 5px;
    border: 1px solid #efefef;
    box-shadow: inset 0 0 1px 1px #ccc;
    width: 100%;
	margin:0;
}
ul.form input, ul.form select, ul.form textarea {
    font-size: 100%;
    padding: 1%;
    display: inline;
}
.green-btn {
    background: rgba(133,198,36,1);
    background: -moz-linear-gradient(top, rgba(133,198,36,1) 0%, rgba(67,145,7,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(133,198,36,1)), color-stop(100%, rgba(67,145,7,1)));
    background: -webkit-linear-gradient(top, rgba(133,198,36,1) 0%, rgba(67,145,7,1) 100%);
    background: -o-linear-gradient(top, rgba(133,198,36,1) 0%, rgba(67,145,7,1) 100%);
    background: -ms-linear-gradient(top, rgba(133,198,36,1) 0%, rgba(67,145,7,1) 100%);
    background: linear-gradient(to bottom, rgba(133,198,36,1) 0%, rgba(67,145,7,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#85c624', endColorstr='#439107', GradientType=0 );
    color: #fff;
    font-size: 17px;
    padding: 5px 0px;
    border: none;
    width: 100%;
    margin-left: 0px;
    margin-top: 10px;
    font-weight: bold;
    font-size: 20px;
    border-radius: 5px;
}
.width_100 {
    width: 100%;
    float: left;
    margin: 0 auto;
    line-height: 25px;
}
.g-recaptcha {
    float: RIGHT;
    MARGIN: 0 AUTO;
}
.login-box {
    width: 62%;
    margin: 0 auto;
    min-height: 42px;
}
@media(max-width:1440px){
.login-box #ForgottenPassword{
    right: 8.4%;
}
.login-box {
    width: 69%;
}
}
@media(max-width:1100px){
.login-box {
    width: 100%;
}
.login-box #ForgottenPassword {
    right: 0;
}
.content-width {
    width: 94%;
}
}
@media(max-width:768px){
.login-box {
    width: 70%;
	min-height: 78px;
}
.login-box #ForgottenPassword {
    right: 15%;
	top: 60%;
}
.default-img .register-form, .default-img .index-img {
    width: 100%;
}
.content-width {
    width: 80%;
}
}

@media(max-width:667px){
.page_bottom_content .col-6{
    float: left;
    width: 100%;
    padding: 0%;
	margin:0 auto;
}
.members-search {
    float: none; 
    width: 96%;
    margin: 65px auto;
}
.default-img {
    width: 100%;
    margin: 0 auto;
	margin-bottom: 50px !important;
}
.default-img .register-form {
    width: 100%;
}
.login-box #ForgottenPassword {
    right: 29%;
    top: 96%;
	background-position: 41% 0px;
}
.login-box {
    width: 80%;
}
.content-width {
    width: 80%;
}
}
@media(max-width:500px){
	
.login-box #ForgottenPassword {
    right: 15%;
    top: 96%;
	background-position: 41% 0px;
}
.content-width {
    width: 98%;
}

}
.nav_button.hidden-lg.hidden-md {
    float: left;
    background: #17387d;
    width: 100%;
}
button.navbar-toggle {
    background: #fff;
}
ul.tabs.nav.navbar-nav li a {
    background: transparent;
    color: #fff;
}
div#mynav ,.navbar-toggle .icon-bar {
    background: #17387d;
}
.width_100 h1 {
    margin-bottom: 20px;
}
.members-search-info {
    padding: 4%;
    WIDTH: 100%;
    margin: 0 auto;
    float: left;
    text-align: center;
}

</style>
</head>
<body>
<div class="page_header">
		
      
         <? if(!my_logged_in){ ?>
          
            <div class="login-box">
              <form method="post" action="<?=DB_DOMAIN ?>index.php" name="LoginForm" onSubmit="return CheckNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
              <input name="do" type="hidden" value="login" class="hidden">
              <input name="visible" value="0" type="hidden">
              <input name="do_page" type="hidden" value="login" class="hidden">

              <ul class="form custom-border">   
             
              <div class="CapBody">   

            <? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") {/* ?>             
            <li>
             <a class="btn-ragister" href="<?=DB_DOMAIN ?>index.php?dll=fblogin"><img src="/inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg" />Login Fast with facebook</a><br />
            </li>
            <? */} ?>
 
                <li class="col-xs-12 col-sm-6 col-md-3"><input placeholder="<?=$GLOBALS['_LANG']['_username'] ?>" tabindex="1" maxlength="15" name="username" id="e_username" type="text" class="input" size="25" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>>
                </li>
                <li class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><input placeholder="<?=$GLOBALS['_LANG']['_password'] ?>" tabindex="2" maxlength="25" name="password" id="e_password" type="password" class="input" size="25"></li>
                
                <li class="remember-me-txt col-xs-12 col-sm-4 col-md-2 col-lg-2"><input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'><?=$GLOBALS['_LANG']['_rememberMe']  ?></li>

                <li class="col-xs-12 col-sm-2 col-md-1 col-lg-1"><input class="blue-btn" maxlength="15" type="submit"  value="<?=$GLOBALS['_LANG']['_login'] ?>" class="MainBtn"></li>
                
                <li class="forget-txt col-xs-12 col-sm-4 col-md-2 col-lg-2"><a href="#" onclick="toggleLayer('ForgottenPassword'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a></li>
                <? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") {/* ?>  
                <li><a class="btn-ragister" href="/index.php?dll=fblogin" style="width:100px;margin:0px 10px;float:right;padding:8px;"><img src="../inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg">Login</a></li>
                <? */} ?>
                </div>
                
              </ul>
              </form> 
                
               <div style="display: none;" id="ForgottenPassword">	
                <form method="post" action="<?=DB_DOMAIN ?>index.php" name="ForgotPassword">
                <input name="do" type="hidden" value="password" class="hidden">
                <input name="do_page" type="hidden" value="login" class="hidden">
                <input name="username" type="hidden" value="" class="hidden">
                <ul class="form forget-form">   
                <div class="CapBody"><li>Enter your registration email<br> and we'll send your a password</li>
                    <li><input maxlength="150" name="email" type="text" size="20" class="input"></li>
                                <li><input class="green-btn" type="submit" value="Submit"></li>
                </div>
                </ul>
                </form>
            </div>
            </div>

          <? } ?>
 
                    
    <div class="menu hidden-xs" id="MenuBar"><!--3-->

    <? if(my_logged_in){ ?>  <? } ?>

      <ul class="tabs" style="float:left;">
        <?=$HEADER_MENU_BAR_TOP ?>
      </ul>     

    </div>



</div>
<div class="hidden-sm hidden-md hidden-lg">    
    <div class="nav_button hidden-lg hidden-md">
            	<span style="padding: 4%;float: left;">
				    <span>
                    	<a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1" style="color:#fff;">
							<?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?>
                         </a>
                    </span>
			    </span>	
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
                 <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
            </button>
            </div>
    <div class="collapse navbar-collapse" id="mynav">
                <ul class="tabs nav navbar-nav">
                    <?=$HEADER_MENU_BAR_TOP ?>
                </ul>	
                
    </div> 
</div>

<div class="page_content">
  <div class="fullscreen-bg" style=" background:url(inc/templates/<?=D_TEMP ?>/images/visual.jpg)">
<!--<div class="back_image" style=" background:url(inc/templates/<?=D_TEMP ?>/images/visual.jpg)"> 
</div>  --> 
<div class="content-width">
<div class="members-search">

<div class="default-img">
  <img class="index-img" src="inc/templates/<?=D_TEMP ?>/images/couple.jpg">

  <div class="register-form">
    <form method="post" name="MemberSearch" id="MemberSearch" action="index.php?dll=search&view_page=1"  style="margin:0px;">
  
    <input name="do" type="hidden" value="add" class="hidden">             
    <input name="do_page" type="hidden" value="register" class="hidden">
    <input name="title" type="hidden" value="" class="hidden">
    <input name="comments" type="hidden" value="" class="hidden">
    <script src="<?=DB_DOMAIN ?>inc/js/_extras/_date.js"></script>
    <script src="<?=DB_DOMAIN ?>inc/js/_eMeetingAjax.js"></script>

    <span id="response_register" class="responce_alert"></span>

	<div class="members-search-info" width="400"  border="0" cellpadding="2" cellspacing="2" style="">
  	<div class="width_100">
        <h1>Sign up for Free!</h1>
      </div>
    <div>
<a class="btn-ragister" href="/index.php?dll=fbregister"><img src="../inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg">Register with facebook</a>
    </div>
      <div class="label_left"><?=$GLOBALS['_LANG']['_username'] ?></div>
      <div class="input_div">
        <input name="username" type="text" class="input required-field" id="regUsername" tabindex="3" onchange="validateUsername(this.value);" value="" size="35" maxlength="15">
      </div>
      <div class="width_100">  
        <p class="note"><span id="response_span"></span><span id="validation_span"></span></p>
      </div>
      <div class="label_left"><?=$GLOBALS['_LANG']['_email'] ?> </div>
      <div class="input_div">
      	<input type="text" class="input required-field" size="35" name="email" id="regEmail" tabindex="3" onchange="validateEmail(this.value);" value=""> 
   	  </div>
      <div class="width_100">   
        <p class="note"><span id="response_span_email"></span><span id="validation_span_email"></span></p>
      </div>
      <div class="label_left"><?=$GLOBALS['_LANG']['_password'] ?> </div>
      <div  class="input_div">
      	<input type="password" class="input required-field" size="35" name="password" id="regPassword" tabindex="3" onchange="validatePassword(this.value);" value="">
      </div>
      <div class="width_100">    
         <p class="note"><span id="response_span_pass"></span><span id="validation_span_pass"></span></p>
        <input type="hidden"  name="password_confirm" id="regRPassword" value="">
      </div>
      
      <?php echo DisplaySignupV20IndexFields(0); ?>
      <div class="width_100">

      <? if(D_REGISTER_IMAGE ==1){ ?>
        
        <div class="g-recaptcha" data-sitekey="<?=reCAPTCH_APP_ID ?>"></div>

        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">

      <?php } ?>
      </div>

      <div class="tnc width_100">
       
              <input name="t&C" type="checkbox" value="1" id="t&C" tabindex="205" onClick="agreeregisterForm()"> I have read and agree to the <a href="<?=DB_DOMAIN ?>index.php?dll=privacy" target="_blank">Terms & Conditions</a> and  <a href="<?=DB_DOMAIN ?>index.php?dll=privacy" target="_blank">Privacy Policy</a>
              <p class="note"><span id="validation_span_tnc" style="display:none;">Please accept Terms & COnditions and Privacy Policy.</span></p>
       </div>
      <div class="width_100">
        <input type="button" name="register" onclick="createMmberValidation();" value="&nbsp;&nbsp;Continue&nbsp;&nbsp;" class="NormBtn"  style="font-size:16px;">
      </div>
  </div>

  <!--<table class="members-search-info" width="400"  border="0" cellpadding="2" cellspacing="2" style="">
    <tr>
      <td height="30" colspan="3" style="color:#000000"><h1>Sign up for Free!</h1>
      </td>
    </tr>
    <tr>
      <td colspan="3"><a class="btn-ragister" href="/index.php?dll=fblogin"><img src="../inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg">Register with facebook</a></td>
    </tr>
    <tr>
      <td width="122" height="30" class="label"><?=$GLOBALS['_LANG']['_username'] ?> </td>
      <td colspan="2">
        <input name="username" type="text" class="input required-field" id="regUsername" tabindex="3" onchange="validateUsername(this.value);" value="" size="35" maxlength="15">
        <p class="note"><span id="response_span"></span><span id="validation_span"></span></p>
      </td>
    </tr>
    <tr>
      <td height="30" class="label"><?=$GLOBALS['_LANG']['_email'] ?> </td>
      <td colspan="2">
       <input type="text" class="input required-field" size="35" name="email" id="regEmail" tabindex="3" onchange="validateEmail(this.value);" value=""> <p class="note"><span id="response_span_email"></span><span id="validation_span_email"></span></p>
      </td>
    </tr>
    <tr>
      <td  width="30" class="label"><?=$GLOBALS['_LANG']['_password'] ?> </td>
      <td  colspan="2">
        <input type="password" class="input required-field" size="35" name="password" id="regPassword" tabindex="3" onchange="validatePassword(this.value);" value=""> <p class="note"><span id="response_span_pass"></span><span id="validation_span_pass"></span></p>
        <input type="hidden"  name="password_confirm" id="regRPassword" value="">
      </td>
    </tr>

    <tr>
      <?php echo DisplaySignupV20IndexFields(0); ?>
    </tr>
    <tr>
      <td colspan="3">

      <? if(D_REGISTER_IMAGE ==1){ ?>
        
        <div style="float: left; margin: 0px 35px;" class="g-recaptcha" data-sitekey="<?=reCAPTCH_APP_ID ?>"></div>

        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">

      <?php } ?>
      </td>
    </tr>

    <tr>
      <td height="30" colspan="3" class="tnc">
       
              <input name="t&C" type="checkbox" value="1" id="t&C" tabindex="205" onClick="agreeregisterForm()"> I have read and agree to the <a href="<?=DB_DOMAIN ?>index.php?dll=privacy" target="_blank">Terms & Conditions</a> and  <a href="<?=DB_DOMAIN ?>index.php?dll=privacy" target="_blank">Privacy Policy</a>
              <p class="note"><span id="validation_span_tnc" style="display:none;">Please accept Terms & COnditions and Privacy Policy.</span></p>
       </td>
    </tr>
    <tr>
      <td height="30" colspan="3" >
        <input type="button" name="register" onclick="createMmberValidation();" value="&nbsp;&nbsp;Continue&nbsp;&nbsp;" class="NormBtn"  style="font-size:16px;">
      </td>
    </tr>
  </table>-->
</form>
</div>
</div>


</div>
</div>


</div>
</div>

<!-- PAGE FOOTER -->
  <div id="page_footer" class="footer_sec"> 
    <div class="footer_menu"> 
      <ul class="footer_tabs flink">
        <?=$FOOTER_MENU_BAR ?>              
      </ul>
        
    </div>  
<div id="copyright_bar_temp"><b><a href="http://www.domain.com/">© 2016 - All Rights Reserved</a> </b></div>
<?=$FOOTER_MENU_TIMER ?>
</div>

<div class="row page_bottom_content">
  <div class="col-6">
      <h2>Why Choose Us?</h2>
      <p>This is the text box area. You can put anything you want in this area.<br/>
        This is just another text box area that you can fill with whatever text you want.</p>

      <h2>Why We're Different</h2>
      <p>This is the text box area. You can put anything you want in this area.<br/>
        This is just another text box area that you can fill with whatever text you want.</p>

      <h2>Find Your Match!</h2>
      <p>This is the text box area. You can put anything you want in this area.<br/>
        This is just another text box area that you can fill with whatever text you want.</p>

  </div>
  <div class="col-6 video-col">
    <h2>Watch this video to find out more:</h2>
    <iframe width="640" height="360" src="https://www.youtube.com/embed/jOtn4aVT04U?rel=0" frameborder="0" allowfullscreen></iframe>
    <a href="/index.php?dll=login">JOIN FREE NOW</a>
  </div>

</div>
<!-- END PAGE FOOTER -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  $('input[type="text"],input[type="password"],input[type="checkbox"],select').click(function(){
    $("#validation_span_tnc").removeAttr('style');
    $(".g-recaptcha").css("border","0px");
    
    $(".sc_select_a").removeAttr('style');
    $(".sc_select_a").css('width','185px');
    $("#validation_span_email").empty();
    $("#validation_span_tnc").hide();
    $(this).removeAttr('style');
  });
  // $(".g-recaptcha").click(function(){
  //   $(".g-recaptcha").css("border","0px");
  // });
});

function createMmberValidation(){
    
  
   
  var invalid = false;
  $(".required-field").removeAttr('style');
  $(".required-field").each(function(){
    if($(this).val() == ""){
      $(this).css('border','1px solid #ff0000');
      invalid = true;
    }
  });

  $(".input222").each(function(){
    if($(this).val() == "0"){
      $(this).css('border','1px solid #ff0000');
      invalid = true;
    }
  });

  $(".sc_select_a").each(function(){
    if($(this).val() == "0"){
      $(this).css('border','1px solid #ff0000');
      invalid = true;
    }
  });


  $(".age select").each(function(){
    if($(this).val() == "0"){
      $(this).css('border','1px solid #ff0000');
      invalid = true;
    }
  });
  
  if(!$('input[name="t&C"]').is(':checked')){

      $("#validation_span_tnc").css('color','#ff0000');
      $("#validation_span_tnc").show();
      invalid = true;
   
  }
  var email = $("#regEmail").val();
  var filter = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!filter.test(email)) {
      $("#regEmail").css('border','1px solid #ff0000');
      $("#validation_span_email").html("Incorrect email, please type correct email.</div>");
      invalid = true;
      return false;
  }
  if(grecaptcha.getResponse() == '') {
       $(".g-recaptcha").css("border","1px solid #ff0000");

      setTimeout( function(){ 
         $(".g-recaptcha").css("border","0px");      
      }  , 1500 );

       return false;
   }
  if(!invalid){
    document.getElementById("regRPassword").value = document.getElementById("regPassword").value;
    $("#MemberSearch").submit();
    //document.getElementById("MemberSearch").submit();
  }
 
  
}


</script>

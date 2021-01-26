<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="format-detection" content="telephone=no"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php e_meta(); ?>
  <?=$HEADER_META_BASE ?>
  <link rel="icon" href="/inc/templates/<?=D_TEMP ?>/images/favicon.ico" type="image/x-icon">
  <title>Home</title>
  <!-- Bootstrap -->
  <link href="/inc/templates/<?=D_TEMP ?>/css/bootstrap.css" rel="stylesheet">
  <!--<link href="/inc/templates/<?=D_TEMP ?>/css/owl.carousel.css" rel="stylesheet">-->
  <!-- Links -->
  <!--JS-->
  <script src="/inc/templates/<?=D_TEMP ?>/js/jquery.js"></script>
  
  <script language="javascript" type="text/javascript">
  

  $(window).load(function() {
  	$('.rd-mobilemenu_ul').attr('id','login_container');
  	var node = document.createElement("div");
      var textnode = document.getElementById("login_form");
      node.appendChild(textnode);
      document.getElementById("login_container").appendChild(node);
  	 
  });

  
  </script>
  <?=(isset($HEADER_ANALYTICS)) ? $HEADER_ANALYTICS : "";?>
  <script type="text/javascript" src="inc/js/_eMeetingGlobals.js"></script>
  <script src="/inc/templates/<?=D_TEMP ?>/js/jquery-migrate-1.2.1.min.js"></script>
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->
  <script src='/inc/templates/<?=D_TEMP ?>/js/device.min.js'></script>
  <script language="javascript">
  
    
  </script>
  <style>
  .footer_menu ,div#copyright_bar {
    text-align: center;
    color: #ea1c0d;
	text-transform: uppercase;
  }
  ul.footer_tabs li {
    display: inline-block;
    padding: 1%;
  }
  div#copyright_bar {
    padding: 0 0 1%;
  }
  .flags_table {
    text-align: center;
	padding: 1%;
  }
  ul.flags_ul li {
    display: inline-block;
  }
  #owl-demo .item img {
    width: 100%;
  }
 #owl-demo .owl-dots {
    display: inline-block;
    left: 50%;
    bottom: -20%;
 }
 .small{
  min-height: 0px;
  padding-bottom: 0px;
 }
#owl-demo h5.small.text-primary {
    font-size: 14px;
}
.input.form-control {
    padding: 8px;
}
h4.login {
    color: #727272;
    margin: 27px 0 0;
    background: none;
    border: none;
    font-size: 2.5em;
    padding: initial;
    text-align: left;
}
.navbar-right {
    overflow: auto;
}
#login_container #login_form a {
    background: transparent;
    padding: 0;
}
@media(max-width:1600px){
.trig.pull-right.trig-active {
    right: 19.5%;
}
}
@media(max-width:1440px){
.trig.pull-right.trig-active {
    right: 18%;
}
}
@media(max-width:1024px){
#owl-demo .item img {
    width: 70%;
}  
.navbar-nav {
    padding: 8.5rem 3.0625rem;
}	
 
}

@media(max-width:768px){

 div#owl-demo {
    margin-bottom: 25px;
 }
 .trig.pull-right.trig-active {
    right: 16%;
}
.navbar-nav {
    padding: 8.5rem 1.5rem;
    font-size: 14px;
} 
}
@media(max-width:680px){

 #login_form {
    display: block !important;
 } 
}

@media(max-width:500px){
   
.flags_table {
	padding: 2%;
}
.footer_menu ,div#copyright_bar {
	text-transform:capitalize;
	padding:1%;
}
}
   
  </style>
 
</head>
<body>
<div class="page">
  <!--========================================================
                            HEADER
  =========================================================-->
  <header>
    <div id="stuck_container" class="stuck_container">
      <div class="container container-wide">
        <div class="navbar-brand">
          <a href="./">
            <img class="img-wide" src="/inc/templates/<?=D_TEMP ?>/images/brand.png" alt=""/>
          </a>
        </div>
        <nav class="navbar navbar-default navbar-static-top">
          <div class="navbar-header center-xs">
          </div>
          <ul class="navbar-nav navbar-right" data-type="navbar">
            <?=$HEADER_MENU_BAR_TOP ?>
            <? if(!my_logged_in){ ?>
            <p></p>
          <div class="row">
              <div class="col-sm-12 login_form_cl">
                <div class="form-group">
                <div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                <h4 class="login">Login</h4>
                </div>
                </div>
                  <form method="post" action="<?=DB_DOMAIN ?>index.php" name="LoginForm" onSubmit="return CheckNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
                  <input name="do" type="hidden" value="login" class="hidden">
                  <input name="visible" value="0" type="hidden">
                  <input name="do_page" type="hidden" value="login" class="hidden">
     			<div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                    <input placeholder="<?=$GLOBALS['_LANG']['_username'] ?>" maxlength="15" name="username" id="e_username" type="text" class="input form-control" size="25" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">  
                    <input placeholder="<?=$GLOBALS['_LANG']['_password'] ?>" maxlength="25" name="password" id="e_password" type="password" class="input form-control" size="25"></li>
                 </div>
                 </div>   
                 <div class="form-check">
                 <input type="checkbox" name="remember" value="1"  class="form-check-input" style="margin-right:15px;" checked='checked'><?=$GLOBALS['_LANG']['_rememberMe']  ?>
                 </div>
    			 <div class="form-group row">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                  <input class="btn btn-primary" maxlength="15" type="submit"  value="<?=$GLOBALS['_LANG']['_login'] ?>" >
                 </div>
                 </div>
                 <div class="form-group row">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                 <a href="#" onclick="toggleLayer('ForgottenPassword2'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a>
                 </div>
                 </div>
                    <? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") {/* ?>  
                    <li><a class="btn-ragister" href="/index.php?dll=fblogin" style="width:100px;margin:0px 10px;float:right;padding:8px;"><img src="../inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg">Login</a></li>
                    <? */} ?>
                    
                  </form> 
                    
                   <div style="display: none;" id="ForgottenPassword2">
                   	<div class="form-group">
                    <form method="post" action="<?=DB_DOMAIN ?>index.php" name="ForgotPassword">
                    <input name="do" type="hidden" value="password" class="hidden">
                    <input name="do_page" type="hidden" value="login" class="hidden">
                    <input name="username" type="hidden" value="" class="hidden">
                    <div class="form-group row">
                    <label for="inputEmail" class="col-sm-12 col-form-label">
                    Enter your registration email and we'll send your a password
                    </label>
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                    <input maxlength="150" name="email" type="text" size="20" placeholder="Email" class="input form-control">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                    <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                    </div>
                    </form>
                    </div>
               	  </div>
                  
                  <?
                  if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") {
                  ?>
                  <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <a href="<?=DB_DOMAIN ?>fblogin"><img src="<?=DB_DOMAIN ?>images/facebook-login.jpg" ></a>
                    </div>
                  </div>
                  <?
                  }
                  
                  //Twitter
                  if (defined('TWITTER_SIGNIN_KEY')  && TWITTER_SIGNIN_KEY !="") {
                  require_once($_SERVER['DOCUMENT_ROOT']."/inc/func/func_twitter_page.php");
                  ?>
                  <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?=GetTwitterLoginButton();?>
                    </div>
                  </div>
                  <?
                  }
                
                  //Google
                  if (defined('GOOGLE_SIGNIN_KEY')  && GOOGLE_SIGNIN_KEY !="") {
                  ?>
                  <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <image id="googleSignIn" src="<?=DB_DOMAIN?>images/google-login.jpg">
                    <div id="google-sign-in" style="display: none;"></div>
                    </div>
                  </div>
                  <?
                  }
                  ?>
                </div>
              </div>
		  </div>
          <? } ?>
          </ul>
          
          <div class="trig">
            <p>Menu</p>
            <span></span>
          </div>
        </nav>
      </div>
    </div>
  </header>

  <!--========================================================
                            CONTENT
  =========================================================-->
  <main class="text-center">
    <!-- Jumbotron section -->
    <section class="vh-100 bg-image" style="background-image: url(/inc/templates/<?=D_TEMP ?>/images/page-1_bg-head.jpg)">
      <div class="container container-wide">
        <h1>Meet the love of your life now!</h1>
      </div>
      <div class="banners-container">
        <div class="banner register">
          <svg viewBox="0 0 112 148" version="1.1">
            <path
                d="m5.8935 146.52-2.6067-1.4168-1.6433-2.508-1.6433-2.5079v-61.4-61.4l2.1679-2.756 2.1679-2.756 3.3-1.3788 3.3-1.3788h6.8321 6.8321l1.2 1.2 1.2 1.2v1.7648 1.7648l-1.9343 1.0352-1.9343 1.0352h-6.509-6.509l-1.5567 2.2225-1.5567 2.2225v57.777 57.777l2 2 2 2h45 45l2-2 2-2v-57.777-57.777l-1.5567-2.2225-1.5567-2.2225h-6.509-6.509l-1.9343-1.0352-1.9343-1.0352v-1.7648-1.7648l1.2-1.2 1.2-1.2h6.8321 6.8321l3.3 1.3788 3.3 1.3788 2.1679 2.756 2.1679 2.756v61.4 61.4l-1.6485 2.5159-1.6485 2.5159-2.8018 1.4489-2.8018 1.4489-47.3-.04-47.3-.04-2.6067-1.4168zm15.307-37.703-1.2-1.2v-1.7286-1.7286l1.5714-1.5714 1.5714-1.5714h33.357 33.357l1.5714 1.5714 1.5714 1.5714v1.7286 1.7286l-1.2 1.2-1.2 1.2h-34.1-34.1l-1.2-1.2zm0-18-1.2-1.2v-2.2648-2.2648l1.9343-1.0352 1.9343-1.0352h32.994 32.994l1.5714 1.5714c1.8427 1.8427 1.9427 2.8664.53625 5.4943l-1.0352 1.9343h-34.265-34.265l-1.2-1.2zm0-19-1.2-1.2v-1.7286-1.7286l1.5714-1.5714 1.5714-1.5714h33.357 33.357l1.5714 1.5714 1.5714 1.5714v1.7286 1.7286l-1.2 1.2-1.2 1.2h-34.1-34.1l-1.2-1.2zm0-19-1.2-1.2v-1.7286-1.7286l1.5714-1.5714 1.5714-1.5714h33.274 33.274l1.655 1.8287c1.9543 2.1594 2.118 4.3082.45499 5.9713l-1.2 1.2h-34.1-34.1l-1.2-1.2zm-1.7152-25.848-.65001-2.048 1.105-1.3315 1.105-1.3315 2.7276-.59115 2.7276-.59115 6.8076-6.0294 6.8076-6.0294h2.9424 2.9424v-1.854-1.854l2.4522-2.646 2.4522-2.646h5.0932 5.0932l2.4545 2.4545 2.4545 2.4545v2.0455 2.0455h2.9424 2.9424l6.8076 6.0294 6.8076 6.0294 2.7276.59115 2.7276.59115 1.105 1.3315 1.1051 1.3315-.65001 2.048-.65 2.048h-35.865-35.865l-.65001-2.048zm53.515-7.452-2.3486-2.5h-14.651-14.651l-2.3486 2.5-2.3486 2.5h19.349 19.349l-2.3486-2.5zm-15.8-11.7-1.2-1.2-1.2 1.2-1.2 1.2h2.4 2.4l-1.2-1.2z"/>
          </svg>
          <div class="banner__cnt">
            <h6>Register Now</h6>
          </div>
        </div>
        <div class="banner profile">
          <svg viewBox="0 0 145 140" version="1.1">
            <path
                d="m53.366 138.26c-25.306-6.83-45.667-27.16-51.351-51.273-1.9176-8.133-1.9176-25.511-.0002-33.645 5.7692-24.471 26.945-45.25 52.544-51.559 8.7249-2.1503 27.147-2.1503 35.872 0 25.599 6.309 46.775 27.088 52.544 51.56 1.9174 8.1332 1.9174 25.512 0 33.645-5.7692 24.472-26.945 45.251-52.544 51.56-9.0812 2.2381-28.25 2.0874-37.065-.29149zm37.696-8.1554c6.7781-2.0652 18.761-8.0399 19.935-9.9396.32477-.52549-1.3682-2.9142-3.7622-5.3081-4.6376-4.6376-8.436-6.0721-19.318-7.2956-3.2573-.36623-6.7051-1.0676-7.6619-1.5586-3.0102-1.5448-4.8848-6.5279-4.5609-12.124.2988-5.1634.3373-5.2182 6.473-9.2267 9.7215-6.351 9.9773-6.7063 11.739-16.306 3.3983-18.516 1.4272-28.608-6.6291-33.939-3.346-2.2143-5.3657-2.6971-12.76-3.0507-13.134-.62793-19.465 2.174-23.126 10.235-2.3554 5.1861-2.3814 16.954-.06206 28.042 1.807 8.6385 1.4827 8.2528 14.107 16.777 3.8842 2.6227 4.0584 2.9665 4.0548 8-.004 6.1339-2.73 11.466-6.2152 12.16-1.2546.24956-5.5824.94732-9.6174 1.5506-4.035.60325-9.0551 1.9737-11.156 3.0454-3.9355 2.0078-9.2443 7.8124-8.3977 9.1821.90110 1.458 12.889 7.5954 18.153 9.2935 12.432 4.0106 26.607 4.18 38.804.46376zm-60.754-19.53c3.0473-4.7029 12.48-9.1642 21.22-10.036 8.2125-.81928 9.9778-1.736 9.9263-5.1548-.034-2.258-1.0856-3.3217-6.25-6.3218-3.415-1.9838-7.1516-4.9839-8.3035-6.6669-2.8689-4.1917-4.906-16.539-4.9042-29.726.0013-9.3386.32592-11.606 2.1495-15.013 5.2074-9.7291 12.336-13.654 25.955-14.288 21.824-1.0171 33.394 9.0875 33.394 29.163 0 8.6133-2.6311 24.984-4.6451 28.903-.78136 1.5201-4.5559 4.8487-8.3878 7.3967-5.2868 3.5155-6.9671 5.1919-6.9671 6.9509 0 2.9471 2.0478 3.9735 9.3599 4.6914 10.901 1.0702 19.617 5.5975 23.481 12.197 1.1083 1.8927 1.412 1.7401 5.6639-2.8455 6.6442-7.1658 12.294-19.304 14.173-30.453 1.4021-8.3154 1.4021-10.088 0-18.404-2.33-13.85-7.73-24.093-18.07-34.301-13.39-13.225-27.143-18.933-45.605-18.933-18.463-.0003-32.213 5.708-45.607 18.933-10.34 10.208-15.736 20.451-18.072 34.302-1.4021 8.3154-1.4021 10.088 0 18.404 1.821 10.8 7.2896 22.803 13.715 30.102 2.2736 2.5829 4.433 4.6906 4.7988 4.6838.36576-.007 1.7058-1.6187 2.978-3.582z"/>
          </svg>
          <div class="banner__cnt">
            <h6>Create a profile</h6>
          </div>
        </div>
        <div class="banner love">
          <svg viewBox="0 0 153 146" version="1.1">
            <path
                d="m68.787 136.51c-25.08-16.87-53.136-49.577-61.98-73.876-2.6048-7.159-2.8585-9.148-3.2321-15.715-.043977-.77297-.054594-1.5572-.035-2.4745.016598-.77707-.00634-1.5834.062162-2.2542.6520-6.386 1.427-8.504 4.1249-13.537 4.101-7.652 11.271-14.526 18.86-18.083 5.1644-2.4206 7.9813-2.6254 18.382-2.6254 10.934 0 11.844.16162 18 3.1963 3.5662 1.758 8.4783 5.2334 10.916 7.7231l4.4318 4.5268 5.3155-5.0272c2.9236-2.765 7.9042-6.2404 11.068-7.7231 5.2025-2.4381 6.8524-2.6959 17.253-2.6959 10.384 0 12.055.26016 17.218 2.6801 7.5893 3.5571 14.759 10.432 18.86 18.083 2.9814 5.5628 3.8468 7.181 4.3512 15.628.13031 2.1823.0892 4.0166-.0607 5.5104-.44635 4.4492-1.1927 6.8582-3.371 12.843-6.9414 19.073-24.544 42.998-45.274 61.536-10.097 9.0292-22.095 17.22-25.224 17.22-1.2828 0-5.6326-2.2198-9.6662-4.9328zm23.209-12.855c10.2-8.1434 26.32-25.306 34.482-36.712 12.185-17.028 19.418-34.727 18.015-44.084-.91602-6.1085-5.9918-15.728-10.291-19.502-6.6293-5.8206-13.687-8.4187-22.749-8.3747-12.445.06049-20.449 4.7306-28.642 16.711-2.1627 3.1625-4.1237 5.75-4.3577 5.75-.23401 0-2.195-2.5875-4.3577-5.75-5.0912-7.4447-8.3959-10.476-15.142-13.889-4.6191-2.3371-6.7814-2.7891-13.5-2.8217-9.062-.04404-16.12 2.5541-22.749 8.3747-4.299 3.7746-9.3748 13.394-10.291 19.502-1.4125 9.4192 5.7644 26.886 18.311 44.565 8.2607 11.639 30.133 33.918 40.107 40.851l7.3789 5.1294 2.9547-1.7304c1.6251-.95171 6.4988-4.5599 10.83-8.0182z"
                fill="#fe2cfe"/>
          </svg>
          <div class="banner__cnt">
            <h6>Find true love </h6>
          </div>
        </div>
      </div>
            <span class="scroll-left">
                
            </span>
            <span class="scroll-right">
                
            </span>
    </section>
    <!-- END jumbotron section-->

    <!-- Welcome -->
    <section class="well-1 offset-1" id="welcome">
      <div class="container container-wide">
        <h3>Welcome!</h3>

        <div class="row offset-5">
          <div class="col-sm-10 col-sm-offset-1">
            <p>Welcome to our dating site. This is just sample text you can change for the front page. You can put whatever text that you want right here! </p>
          </div>
        </div>
      </div>
      <div class="row row-no-gutter">
        <div class="col-md-6 col-lg-4 grid-1">
          <!-- Owl Carousel -->
          <div class="owl-carousel"
               data-items="3"
               data-stage-padding="20"
               data-loop="false"
               data-sm-items="3"
               data-sm-stage-padding="0"
              >
            <div class="owl-item">
              <img src="/inc/templates/<?=D_TEMP ?>/images/page-1_img05.jpg" alt=""/>
            </div>
            <div class="owl-item">
              <img src="/inc/templates/<?=D_TEMP ?>/images/page-1_img06.jpg" alt=""/>
            </div>
            <div class="owl-item">
              <img src="/inc/templates/<?=D_TEMP ?>/images/page-1_img07.jpg" alt=""/>
            </div>
          </div>
          <!-- END Owl Carousel -->
        </div>
        <div class="col-md-6 col-lg-4 pull-lg-right grid-1">
          <!-- Owl Carousel -->
          <div class="owl-carousel"
               data-items="3"
               data-stage-padding="20"
               data-loop="false"
               data-sm-items="3"
               data-sm-stage-padding="0"
              >
            <div class="owl-item">
              <img src="/inc/templates/<?=D_TEMP ?>/images/page-1_img08.jpg" alt=""/>
            </div>
            <div class="owl-item">
              <img src="/inc/templates/<?=D_TEMP ?>/images/page-1_img09.jpg" alt=""/>
            </div>
            <div class="owl-item">
              <img src="/inc/templates/<?=D_TEMP ?>/images/page-1_img10.jpg" alt=""/>
            </div>
          </div>
          <!-- END Owl Carousel -->
        </div>
        <div class="col-md-10 col-md-offset-1 col-lg-4 col-lg-offset-0 grid-2">
          <form class='rd-mailform' method="post" action="bat/rd-mailform.php">
            <!-- RD Mailform Type -->
            <input type="hidden" name="form-type" value="contact"/>
            <!-- END RD Mailform Type -->
            <br>
            <h5 class="text-center">It`s free to join</h5>
            <br>
            <br>            
            <div class="row row-no-gutter flow-offset-2">
              <div class="col-sm-6">
                <div class="form-group btn-wr text-center">
                  <a href="<?=DB_DOMAIN ?>index.php?dll=register" class="btn btn-primary">Get started now</a>            

                  <div class="mfInfo"></div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group btn-wr text-center">
                  <a href="<?=DB_DOMAIN ?>index.php?dll=fbregister" class="btn btn-info btn-sm">Join with Facebook</a>
<br>
<br>
                  <div class="mfInfo"></div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- END Welcome-->

    <!-- Last Added Profiles -->
    <section class="well-1 well-1--inset-1">
      <div class="container container-wide">
        <h3>Last Added Profiles</h3>

       <div class="row flow-offset-1">
        <div id="owl-demo" class="owl-carousel owl-theme"
               data-items="2"
               data-loop="true"
               data-dots="true"	
               data-lg-items="6"
               data-md-items="5"
               data-sm-items="4"
               data-autoplay="true"
              
              >
        <?php $fdata = DisplayFeaturedMembersTop(20,1); ?><? foreach( $fdata as $value){ ?>
            <div class="item">
                <a data-type="linkbox" href="<?=$value['link'] ?>">
                    <img src="<?=$value['image'] ?>"  class="img-circle img-wide" alt="Image 14"/>
                </a>
                <h5 class="small text-primary"><a class="btn_1 bg_1  type_1 text_6" href="<?=$value['link'] ?>"><?=$value['username'] ?></a></h5>
                <a href="<?=$value['link'] ?>" class="btn btn-xs btn-default">More Info</a>
            	</div>
        <? } ?>
        </div>
    </div>
      </div>
    </section>
    <!-- END Last Added Profiles-->

    <!-- Members Who Have Found Love -->
    <section class="bg-secondary-variant-1 text-left center-lg">
      <div class="row">
        <div class="col-lg-3 grid-3 prefix-1 well-2">
          <h4>Members Who
            Have Found Love</h4>
          <!-- Owl Carousel -->
          <div class="owl-carousel owl-carl"
               data-dots="true"
               data-nav="false"
               data-margin="2">
            <div class="owl-item">
              <blockquote class="media quote">
                <div class="media-left">
                  <img class="img-wide" src="/inc/templates/<?=D_TEMP ?>/images/page-1_img17.jpg" alt=""/>
                </div>
                <div class="media-body">
                  <p class="q"><q>We would never had met without this site. He is from London and I
                    am in
                    the United States. Thank you to you all for helping me find the
                    love of my life.
                  </q></p>

                  <p class="cite"><cite>
                    Ann & Tom Black
                  </cite></p>
                </div>
              </blockquote>
            </div>
            <div class="owl-item">
              <blockquote class="media quote">
                <div class="media-left">
                  <img class="img-wide" src="/inc/templates/<?=D_TEMP ?>/images/page-1_img21.jpg" alt=""/>
                </div>
                <div class="media-body">
                  <p class="q"><q>Thank you for bringing us together. For the past month, we have been inseparable and we are looking to a bright and happy future together!
                  </q></p>

                  <p class="cite"><cite class="text-muted">
                    Ann & Tom Black
                  </cite></p>
                </div>
              </blockquote>
            </div>
            <div class="owl-item">
              <blockquote class="media quote">
                <div class="media-left">
                  <img class="img-wide" src="/inc/templates/<?=D_TEMP ?>/images/page-1_img22.jpg" alt=""/>
                </div>
                <div class="media-body">
                  <p class="q"><q>Thank you for helping me find my soul mate. You made the process of finding someone special very easy and fun. I will recommend your site to all my friends.
                  </q></p>

                  <p class="cite"><cite class="text-muted">
                    Ann & Tom Black
                  </cite></p>
                </div>
              </blockquote>
            </div>
          </div>
          <!-- END Owl Carousel -->
        </div>
        <div class="col-lg-6 grid-4">
          <div class="row row-no-gutter">
            <div class="col-xs-4 bg-image">
              <img class="img-wide" src="/inc/templates/<?=D_TEMP ?>/images/page-1_img18.jpg" alt=""/>
            </div>
            <div class="col-xs-4">
              <img class="img-wide" src="/inc/templates/<?=D_TEMP ?>/images/page-1_img19.jpg" alt=""/>
            </div>
            <div class="col-xs-4">
              <img class="img-wide" src="/inc/templates/<?=D_TEMP ?>/images/page-1_img20.jpg" alt=""/>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END Members Who Have Found Love-->
  </main>

  <!--========================================================
                          FOOTER
  =========================================================-->
  <footer>

    <section>
      <div class="container container-wide center-sm">
        <div class="row">
          <div class="col-xs-12">
           <div class="footer_menu"> 
                    <ul class="footer_tabs">
                        <?=$FOOTER_MENU_BAR ?>							
                    </ul>
            </div>
            <?=$FOOTER_MENU_TIMER ?>
          </div>
        </div>
      </div>
    </section>
  </footer>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/inc/templates/<?=D_TEMP ?>/js/bootstrap.min.js"></script>
<script src="/inc/templates/<?=D_TEMP ?>/js/tm-scripts.js"></script>
<!-- </script> -->

</body>
</html>
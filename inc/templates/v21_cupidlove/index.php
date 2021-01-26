<!DOCTYPE html>
<html lang="en">


<!-- Favicon -->
<!--<link rel="shortcut icon" href="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/favicon.ico" />-->

<!-- bootstrap -->
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

<!-- mega menu -->
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/mega-menu/mega_menu.css" rel="stylesheet" type="text/css" />

<!-- font-awesome 
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->

<!-- font-awesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Flaticon -->
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/flaticon.css" rel="stylesheet" type="text/css" />

<!-- Magnific popup -->
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

<!-- owl-carousel -->
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />

<!-- General style -->
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/general.css" rel="stylesheet" type="text/css" />

<!-- main style -->
<link href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/style.css" rel="stylesheet" type="text/css" />

<!-- Style customizer -->
<link rel="stylesheet" type="text/css" href="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/css/animate.min.css">

 <style>
     .mega-menu .menu-logo {
         position: unset;
          padding: 3px 0 2px;
     }
     .menu-links {
         width:68%;
     }
     
     form .form-group .form-control {
        color: #000;
    }
     
    .menu, .sub_menu {
    width: 100%;
    float:none;
    }
    .menu {
    margin-left: 0;
    background: none;
    border: 0px;
}
.sub_menu, .menu {
   
    height: 100%;
    
}

.mega-menu * {
    text-align: left;
    
}
 h4.login {
    color: #727272;
    margin: 27px 0 16px;
    background: none;
    border: none;
    font-size: 2.5em;
    padding: initial;
    text-align: left;
}
.menu-logo {
    right:168px;
}
#copyright_bar {
    background: black;
}

.flags_table {
    background: black;
}

#page_footer .footer_tabs li a {
    color:white !important;
}
#copyright_bar a {
    color:white !important;
}

footer {
   
    padding-top: 0px;
    padding-bottom: 0px;
  
}

.trig 
 {
     top: 1.8100rem !important; 
     right: 11.5%  important;
 }
 
 .trig {
    font-family: 'Comfortaa', sans-serif;
    font-size: 1.125rem;
    line-height: 1.66666667;
    letter-spacing: 0.02em;
    display: inline-block;
    text-transform: uppercase;
    font-weight: 700;
    position: fixed;
    right: 8.9%;
    top: 3.8125rem;
    color: white;
}

.trig span {
    position: relative;
    display: block;
    width: 2rem;
    height: 5px;
    left: 134%;
    top: -2.1rem;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
    background: white;
}

.trig span::after, .trig span::before {
    content: "";
    position: absolute;
    left: 0;
    top: -0.5625rem;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
        transition-property: all;
        transition-duration: 0.3s;
        transition-delay: 0s;
    width: 2rem;
    height: 5px;
    background-color: white;
    backface-visibility: hidden;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-transition-duration: 0.3s, 0.3s;
    transition-duration: 0.3s, 0.3s;
    -webkit-transition-delay: 0.3s, 0s;
    transition-delay: 0.3s, 0s;
    -webkit-transition-property: top, -webkit-transform;
    transition-property: top, transform;
}
.trig span::after {
    top: 0.5rem;
}
.navbar-right {
    float: right;
    margin-right: 0;
}

.active-menu {
    -moz-transform: translateX(0);
    -ms-transform: translateX(0);
    -o-transform: translateX(0);
    -webkit-transform: translateX(0);
    transform: translateX(0) !important;
}

.navbar-nav {
    padding: 8.5rem 6.0625rem;
    overflow: auto;
}

.navbar-nav {
    -moz-transition: 0.4s all ease;
    -webkit-transition: 0.4s all ease;
    -o-transition: 0.4s all ease;
    transition: 0.4s all ease;
    -moz-transform: translateX(110%);
    -ms-transform: translateX(110%);
    -o-transform: translateX(110%);
    -webkit-transform: translateX(110%);
    transform: translateX(110%);
    width: 31.2%;
    height: 100vh;
    background: #212121;
    position: fixed;
    right: 0;
    top: 0;
    margin: 0;
        margin-right: 0px;
    font-family: 'Open Sans', sans-serif;
    font-size: 1.125rem;
    line-height: 1.375rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    text-align: left;
    padding: 5.5rem 6.0625rem;
}
.trig-active span {
    transition: background .3s 0s ease;
    background: transparent;
}
.trig-active span::before {
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.trig-active span::before, .trig-active span::after {
    top: 0;
    -webkit-transition-delay: 0s, 0.3s;
    transition-delay: 0s, 0.3s;
    background: #ffffff;
}

.trig-active span::after {
    -webkit-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    transform: rotate(-45deg);
}
.trig p {
    color:white;
}
 .menu .i1 {
    margin-left: 0px;
}

.timeline-section {
    padding-top: 118px;
    /*padding-left: 110px;*/
}


 .dropdown select{
  background:transparent;
   width: 114px;
   padding: 9px;
   font-weight:normal;
   color:black;
   line-height: 1;
   border: 0;
   border-radius: 0;
   /*Hides the default arrows for Selects*/
  -webkit-appearance: none;
  -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
     position: relative;
  }


.dropdown{
	width: 102px;
	overflow: hidden;
	background: no-repeat right rgba(234, 234, 234, 0.5);
	border-radius:56px;
	-webkit-box-shadow: inset 0 2px 4px rgba(107, 105, 105, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	 -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
		  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
		  -moz-box-shadow:    0px 8px 3px -9px #000000;
		  -webkit-box-shadow: 0px 8px 3px -9px #000000;
		  box-shadow:         0px 8px 3px -9px #000000;  

}

.dropdown {
    position: relative;
}

.dropdown:before {
    content: "";
    position: absolute;
    left: 84px;
    top: 17px;
	width: 0; 
	height: 0; 
	border-left: 3px solid transparent;
	border-right: 3px solid transparent;
	border-top: 4px solid black;
}
/*
.dropdown:after {
    content: "";
    position: absolute;
    right: 104px;
    top: 3px;
	width: 0; 
	height: 0; 
	border-left: 3px solid transparent;
	border-right: 3px solid transparent;
	border-top: 4px solid black;
} */


 
 .dropdown-big select{
  background:transparent;
   width: 114px;
   padding: 9px;
   font-weight:normal;
   color:black;
   line-height: 1;
   border: 0;
   border-radius: 0;
   /*Hides the default arrows for Selects*/
  -webkit-appearance: none;
  -moz-appearance: none;
    text-indent: 0.01px;
    text-overflow: '';
     position: relative;
  }


.dropdown-big{
	width: 134px;
	overflow: hidden;
	background: no-repeat right rgba(234, 234, 234, 0.5);
	border-radius:56px;
	-webkit-box-shadow: inset 0 2px 4px rgba(107, 105, 105, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	 -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
		  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
		  -moz-box-shadow:    0px 8px 3px -9px #000000;
		  -webkit-box-shadow: 0px 8px 3px -9px #000000;
		  box-shadow:         0px 8px 3px -9px #000000;  

}

.dropdown-big {
    position: relative;
}

.dropdown-big:before {
    content: "";
    position: absolute;
    left: 110px;
    top: 17px;
	width: 0; 
	height: 0; 
	border-left: 3px solid transparent;
	border-right: 3px solid transparent;
	border-top: 4px solid black;
}

select > option {
  background: #D3D3D3;
  color: white;
}

@media (max-width: 1040px) {
    /*.menu {
        display: none;
    }*/
    
    .navbar-nav{
      width: 30.2%;
      padding: 5.5rem 3.0625rem;
  }
  .mega-menu .menu-links {
    display: none !important;
  }
}
@media (max-width: 769px) {
    .navbar-nav{
      width: 40.2%;
      padding: 5.5rem 2.0625rem;
  }
  #header.dark + .fullscreen {
        margin-bottom: 0px;
        top: 64px;
    }
    .container {
        max-width: 100% !important;
    }
  
}

@media (max-width: 700px) {
    #ImageLogo {
        background-size: 90%;
        width: 300px;
    }
    ul.menu-logo {
        float: left;
        padding: 0;
        width: 87% !important;
    }
    .trig span {
        left: 85%;
        top: 3px;
    }
    .trig {
        z-index: 999;
    }
    div#trig p {
        display: none;
    }
    .navbar-nav {
        width: 82.2%;
        z-index: 99;
    }
    #main-slider .slider-content{
        
        top:70%;
    }
    .mega-menu .menu-logo > li > a{
        
        padding-bottom:0;
    }
    
  
}

.rd-mobilemenu {
    display: none;
}
.rd-mobilepanel {
    display: none;
}

.img-fluid.w-100 {
    max-width: 100%;
    width: auto !important;
    max-height: 100%;
    height: auto !important;
    display: inline-block !important; 
}
.profile-image.clearfix {
    float: left;
    width: 100%;
    margin: 0 auto;
    /* display: table; */
    /* vertical-align: middle; */
    text-align: center;
}
.owl-item {
    display: inline-table;
    vertical-align: middle;
    FLOAT: NONE !IMPORTANT;
    height: 146px;
}
</style>
<!--=================================
 preloader -->

<div id="preloader">
  <div class="clear-loading loading-effect"><img src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/loading.gif" alt="" /></div>
</div>

<!--=================================
 preloader --> 

<!--=================================
header -->

<header id="header" class="dark">
  
  <!--=================================
 mega menu -->
  <div class="rd-mobilemenu" id="rd-mobilemenu"><ul class="rd-mobilemenu_ul" id="login_container">
      <?=$HEADER_MENU_BAR_TOP ?>
            <!--<li>
                <input style="width:50%;" placeholder="Username" maxlength="15" name="username" id="e_username" class="input form-control" size="25" type="text">
            </li>
            <li><input placeholder="Password" maxlength="25" name="password" id="e_password" class="input form-control" size="25" type="password">
            <li><input class="button btn-lg btn-theme full-rounded animated right-icn" maxlength="15" value="Login" type="submit"></li>-->
      </ul>
         
    </div>
  <div class="rd-mobilepanel">
      <button id="rd-mobilepanel_toggle" class="rd-mobilepanel_toggle"><span></span></button>
      <h2 class="rd-mobilepanel_title">Home</h2>
  </div>
  <div class="menu"> 
    <!-- menu start -->
    <nav id="menu" class="mega-menu"> 
      <!-- menu list items container -->
      <section class="menu-list-items">
        <div class="container">
          <div class="row">
            <div class="col-md-12"> 
              <!-- menu logo -->
              <ul class="menu-logo">
                  <li> <a href="<?php echo DB_DOMAIN?>">
                        <div id="ImageLogo">	</div>
                </li>
              </ul>
              <!-- menu links -->
              <ul class="menu-links">
                   <?=$HEADER_MENU_BAR_TOP ?>
              </ul>
              <ul id="mainNevigationBar"   class="navbar-nav sf-menu navbar-right sf-js-enabled sf-arrows " data-type="navbar">
            <?=$HEADER_MENU_BAR_TOP ?>
              
                <p></p>
          <div class="row">
              <div class="col-sm-12 login_form_cl">
                <div class="form-group">
                    <div class="form-group row" style="float: left;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                <h4 class="login">Login</h4>
                </div>
                </div>
                    <form method="post" action="<?php echo DB_DOMAIN;?>" name="LoginForm" onsubmit="return CheckNullsLogin('Please complete all the fields');">
                  <input name="do" value="login" class="hidden" type="hidden">
                  <input name="visible" value="0" type="hidden">
                  <input name="do_page" value="login" class="hidden" type="hidden">
     			<div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                    <input placeholder="Username" maxlength="15" name="username" id="e_username" class="input form-control" size="25" type="text">
                </div>
                </div>
                <div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">  
                    <input placeholder="Password" maxlength="25" name="password" id="e_password" class="input form-control" size="25" type="password">
                 </div>
                 </div>   
                 <div class="form-check">
                 <input style="float: left;position: unset;margin-right:10px;" name="remember" value="1" class="form-check-input" style="margin-right:15px;" checked="checked" type="checkbox">Remember Me                 </div>
    			 <div class="form-group row">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                  <input class="button btn-lg btn-theme full-rounded animated right-icn" maxlength="15" value="Login" type="submit">
                 </div>
                 </div>
                 <div class="form-group row">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                 <a href="#" onclick="toggleLayer('ForgottenPassword2'); return false;">Forgotten Password</a>
                 </div>
                 </div>
                                        
                  </form> 
                    
                   <div style="display: none;" id="ForgottenPassword2">
                   	<div class="form-group">
                    <form method="post" action="<?php echo DB_DOMAIN;?>" name="ForgotPassword">
                    <input name="do" value="password" class="hidden" type="hidden">
                    <input name="do_page" value="login" class="hidden" type="hidden">
                    <input name="username" value="" class="hidden" type="hidden">
                    <div class="form-group row">
                        <label style="line-height: 19px;color:#727272" for="inputEmail" class="col-form-label">
                    Enter your registration email and we'll send your a password
                    </label>
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                    <input maxlength="150" name="email" size="20" placeholder="Email" class="input form-control" type="text">
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                    <input class="btn btn-primary" value="Submit" type="submit">
                    </div>
                    </div>
                    </form>
                    </div>
               	  </div>
                  
                                    <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <a href="<?php echo DB_DOMAIN;?>/fblogin"><img src="<?php echo DB_DOMAIN;?>/images/facebook-login.jpg"></a>
                    </div>
                  </div>
                                    <div class="form-group row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <img id="googleSignIn" src="<?php echo DB_DOMAIN;?>/images/google-login.jpg">
                    <div id="google-sign-in" style="display: none;"></div>
                    </div>
                  </div>
                                  </div>
              </div>
		  </div>
                    </ul>
                 <div class="trig" id="trig">
            <p>Menu</p>
            <span> </span>
          </div>
            </div>
          </div>
        </div>
      </section>
    </nav>
    <!-- menu end --> 
  </div>
</header>

<!--=================================
 header --> 

<!--=================================
 banner -->

<section id="home-slider" class="fullscreen">
  <div id="main-slider" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner"> 
      <!--/ Carousel item end -->
      <div class="carousel-item active h-100 bg-overlay-red" style="background: url(<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/index_slide01.jpg ) no-repeat 0 0; background-size: cover;"  data-gradient-red="4" >
        <div class="slider-content">
          <div class="container">
            <div class="row carousel-caption align-items-center h-100">
              <div class="col-md-12 text-right">
                <div class="slider-1">
                  <h1 class="animated2 text-white">Are You <span>Waiting</span> For <span> Dating ?</span></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item h-100 bg-overlay-red" style="background: url(<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/index_slide02.jpg ) no-repeat 0 0; background-size: cover;"  data-gradient-red="4">
        <div class="slider-content">
          <div class="container">
            <div class="row carousel-caption align-items-center h-100">
              <div class="col-md-12 text-left">
                <div class="slider-1">
                  <h1 class="animated7 text-white">Meet big <span> and </span> beautiful love <span> here!</span></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item h-100 bg-overlay-red" style="background: url(<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/index_slide03.jpg ) no-repeat 0 0; background-size: cover;"  data-gradient-red="4">
        <div class="slider-content">
          <div class="container">
            <div class="row carousel-caption align-items-center h-100">
              <div class="col-md-12 text-left">
                <div class="slider-1">
                  <h1 class="animated7 text-white">Meet big <span> and </span> beautiful love <span> here!</span></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Carousel item end --> 
    </div>
    <!-- Controls --> 
    <a class="left carousel-control" href="#main-slider" data-slide="prev"> <span><i class="fa fa-angle-left"></i></span> </a> <a class="right carousel-control" href="#main-slider" data-slide="next"> <span><i class="fa fa-angle-right"></i></span> </a> </div>
</section>

<!--=================================
 banner --> 

<!--=================================
 Page Section -->

<section class="form-1 py-3">
  <div class="container">
    <div class="banner-form">
        <form action="/search" method="POST">
             <input name="SeN[1]" value="gender" class="hidden" type="hidden">
        <input name="SeT[1]" value="3" class="hidden" type="hidden">
        <input name="SeT[3]" value="7" class="hidden" type="hidden">
        <input name="SeN[3]" value="age" class="hidden" type="hidden">
        <div class="row justify-content-center">
          
        <div class="col-md-3">
          <div class="form-group row">
            <div class="col-lg-4 col-md-12">
              <label class="control-label text-white">I am a</label>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="dropdown-big" >
                    <select id="ddiam" name="ddiam">
                 <option value="63">Man</option>
                        <option value="64">Woman</option>
                         <option value="2710">Couple</option>
              </select>
                </div>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group row">
            <div class="col-lg-5 col-md-12">
              <label class="control-label text-white">Seeking a</label>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="dropdown-big">
                    <select id="ddseeking" name="SeV[1]">
                         <option value="64">Woman</option>
                        <option value="63">Man</option>
                       
                         <option value="2710">Couple</option>
              </select>
                </div>
                
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="row">
            <div class="col-lg-6 col-md-6 ">
              <div class="form-group row">
                <div class="col-lg-4 col-md-12">
                  <label class="control-label text-white">From</label>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="dropdown">
                        <select id="fromage" name="Extra[age1]">
                    <?php for($i=18;$i<101;$i++) {  
                             echo '<option value="'.$i.'">'.$i.'</option>';
                          } ?>
                  </select>
                        </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group row">
                <div class="col-lg-4 col-md-12">
                  <label class="control-label text-white pl-0">To</label>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="dropdown">
                        <select id="toage" name="Extra[age2]">
                            <?php  for($i=100;$i>17;$i--) {  
                             echo '<option value="'.$i.'">'.$i.'</option>';
                          } ?>
                  </select>
                        </div>
                </div>
              </div>
            </div>
              
          </div>
        </div>
            <div class="col-md-2"><input type="submit" value="Search"  class="button btn-lg btn-theme full-rounded animated right-icn" />
                </div>
     
      </div>
    </form>
    </div>
  </div>
</section>

<!--=================================
 Page Section -->

<section class="page-section-ptb position-relative timeline-section">
  <div class="container">
    <div class="row justify-content-center mb-5 sm-mb-3">
      <div class="col-md-8 text-center">
        <h2 class="title divider mb-3">Step to find your Soul Mate</h2>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed <br/>
          do eiusmod tempor incididunt ut labore et dolore magna</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-8">
        <ul class="timeline list-inline">
          <li>
            <div class="timeline-badge"><img class="img-fluid" src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/timeline/01.png" alt="" /></div>
            <div class="timeline-panel">
              <div class="timeline-heading text-center">
                <h4 class="timeline-title divider-3">CREATE PROFILE</h4>
              </div>
              <div class="timeline-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  enim ad minim veniam, quis</p>
              </div>
            </div>
          </li>
          <li class="timeline-inverted">
            <div class="timeline-badge"><img class="img-fluid" src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/timeline/02.png" alt="" /></div>
            <div class="timeline-panel">
              <div class="timeline-heading text-center">
                <h4 class="timeline-title divider-3">Find match</h4>
              </div>
              <div class="timeline-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  enim ad minim veniam, quis</p>
              </div>
            </div>
          </li>
          <li>
            <div class="timeline-badge"><img class="img-fluid" src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/timeline/03.png" alt="" /></div>
            <div class="timeline-panel">
              <div class="timeline-heading text-center">
                <h4 class="timeline-title divider-3">START DATING</h4>
              </div>
              <div class="timeline-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  enim ad minim veniam, quis</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
        <div class="col-lg-3 col-md-3"></div>
    </div>
  </div>
</section>

<section class="page-section-ptb  text-white" style="background: url(<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/pattern/02.png) no-repeat 0 0; background-size: cover;">
  <div class="container">
    <div class="row justify-content-center mb-5 sm-mb-3">
      <div class="col-md-8 text-center">
        <h2 class="title divider">Animated Fun Facts</h2>
      </div>
    </div>
   <?php 
           $GenderExtra = " AND members_data.gender =";
         $SQL = "SELECT count(DISTINCT members_online.logid) AS total FROM members
	INNER JOIN members_data ON ( members.id = members_data.uid ) 
	INNER JOIN members_online ON ( members_online.logid = members_data.uid ) 
	WHERE members.email !='' AND members.visible = 'yes' 
        AND members.active ='active' AND activate_code='OK'
        AND members_data.gender =64";
        

    $re = $DB->Query($SQL);
    $class = $DB->NextRow($re);
    $OnlineCounterMale = $class['total'];

    //$OnlineCounter--;
    if ($OnlineCounterMale < 1) {
        $OnlineCounterMale = 0;
    }
    
     $SQL = "SELECT count(DISTINCT members_online.logid) AS total FROM members
	INNER JOIN members_data ON ( members.id = members_data.uid ) 
	INNER JOIN members_online ON ( members_online.logid = members_data.uid ) 
	WHERE members.email !='' AND members.visible = 'yes' AND members.active ='active'
          AND members_data.gender =63 AND activate_code='OK'";

    $re = $DB->Query($SQL);
    $class = $DB->NextRow($re);
    $OnlineCounterFemale = $class['total'];

    //$OnlineCounter--;
    if ($OnlineCounterFemale < 1) {
        $OnlineCounterFemale = 0;
    }
      $TotalOnline=  $OnlineCounterMale+$OnlineCounterFemale;
      $totalmembers=CountAllMembers();
        ?>
      
    <div class="row justify-content-center" >
      
      <div class="col-md-2 text-center">
        <div class="counter"> <img src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/timeline/01.png" alt="" /> 
            <span class="timer" data-to="<?php echo $OnlineCounterFemale; ?>" data-speed="10000"><?php echo $OnlineCounterFemale; ?></span>
          <label>Women Online</label>
        </div>
      </div>
        <div class="col-md-2 text-center">
        <div class="counter"> <img src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/new_mens.png" alt="" /> 
            <span class="timer" data-to="<?php echo $OnlineCounterMale; ?>" data-speed="10000"><?php echo $OnlineCounterMale; ?></span>
          <label>Men Online</label>
        </div>
      </div>
         <div class="col-md-2 text-center">
        <div class="counter"> <img src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/online_members.png" alt="" />
            <span class="timer" data-to="<?php echo $TotalOnline; ?>" data-speed="10000"><?php echo $TotalOnline; ?></span>
          <label>Online Members</label>
        </div>
      </div>
          <div class="col-md-2 text-center">
        <div class="counter"> <img src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/timeline/02.png" alt="" /> 
            <span class="timer" data-to="<?php echo $totalmembers;?>" data-speed="10000"><?php echo $totalmembers;?></span>
          <label>Total Members</label>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="page-section-ptb profile-slider pb-3 sm-pb-6">
  <div class="container">
    <div class="row justify-content-center mb-2 sm-mb-0">
      <div class="col-md-8 text-center">
        <h2 class="title divider">Last Added Profiles</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="owl-carousel" data-nav-arrow="true" data-items="5" data-lg-items="5" data-md-items="4" data-sm-items="3" data-xs-items="3" data-space="30">
            <?php $fdata = DisplayFeaturedMembers(20,1); ?>
                <?php foreach( $fdata as $value){ ?>
                  
            <div class="item">
                <a  class="profile-item" href="<?=$value['link'] ?>">
                           
            <div class="profile-image clearfix">
              <img class="img-fluid w-100" src="
                  <?php echo $value['image'] ?>&y=150&x=150"  alt="<?=$value['username'] ?>" /></div>
            <div class="profile-details text-center">
                <h5 class="title">
                    <?=$value['username'] ?>
              </h5>
              <span><?=$value['age'] ?> Years Old</span> </div>
              </a>
                 
            	</div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="page-section-ptb grey-bg">
  <div class="container">
    <div class="row justify-content-center mb-5 sm-mb-2">
      <div class="col-md-8 text-center">
        <h2 class="title divider mb-3">Our Recent User Blogs</h2>
        <p class="lead">Nulla quis lorem ut libero malesuada feugiat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p>
      </div>
    </div>
    
      <?php
     $show_blog_array= DisplayRecentBlogs(3);
      	
      ?>
    <div class="row post-article mb-5 sm-mb-0 justify-content-center">
        <?php  if(!empty($show_blog_array)){ foreach($show_blog_array as $value){ ?>

 	
      <div class="col-md-4">
        <div class="post post-artical">
          <div class="post-image clearfix"><img class="img-fluid" 
            src="<?=$value['image']; ?>&x=400&y=300" alt="" /></div>
          <div class="post-details">
            <div class="post-title mt-2">
              <h5 class="title text-uppercase mt-2"><a href="<?=$value['link'] ?>">
        <?=strip_tags(substr($value['title'],0,25)); ?>
                  </a></h5>
            </div>
            <p>by<a href="#"><?=$value['username'] ?></a></p>
            <div class="post-icon">
              <div class="post-content">
                  <p>
                      <?=strip_tags(substr($value['description'],0,100)); ?>
                  </p>
              </div>
                </div>
            <a class="button" href="<?=$value['link'] ?>">read more..</a> 
          </div>
            
        </div>
      </div>
        <?php  } }
        ?>
       
    </div>
    
  </div>
</section>
 
 

 

<!--=================================
footer -->

<footer class="text-white text-center">
  
  <div class="footer-widget sm-mt-3">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-9">
          <div class="footer-logo mb-2"> <img class="img-center" src="<?php echo DB_DOMAIN?>inc/templates/<?= D_TEMP ?>/images/footer-logo.png" alt="" /> </div>
          <div class="social-icons color-hover">
             
          </div>
          <p class="text-white">
              
<?php
## Display Footer Area
funcLayoutUserFooter($FOOTER_MENU_BAR,$FOOTER_MENU_TIMER,$BANNER_ARRAY,$page); ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<!--=================================
footer --> 

<!--=================================
Color Customizer -->
 
<div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-level-up"></i></a></div>

<!--=================================
 jquery --> 

<!-- jquery  --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/popper.min.js"></script> 

<!-- bootstrap --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/bootstrap-select.min.js"></script> 

<!-- appear --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/jquery.appear.js"></script> 

<!-- Menu --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/mega-menu/mega_menu.js"></script> 

<!-- owl-carousel --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/owl-carousel/owl.carousel.min.js"></script> 

<!-- counter --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/counter/jquery.countTo.js"></script> 

<!-- Magnific Popup --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/magnific-popup/jquery.magnific-popup.min.js"></script> 

 

<!-- custom --> 
<script type="text/javascript" src="<?php echo DB_DOMAIN?>/inc/templates/<?=D_TEMP ?>/js/custom.js"></script>
 
<script>
    
    $(document).on('click', '.trig', function ()
{
    if (document.querySelector('.trig-active') !== null) {
    
      var d = document.getElementById("trig");
      
    d.classList.remove("trig-active");
    
     var nav = document.getElementById("mainNevigationBar");
    nav.classList.remove("active-menu");
    
    
}
 else
    {
        var d = document.getElementById("trig");
        d.className += " trig-active";
        
        var nav = document.getElementById("mainNevigationBar");
        nav.classList.add("active-menu");
    }
        
});

    $(document).on('click', '#searchSubmit', function ()
{
       document.getElementById('ddto').value=document.getElementById('toage').value;
       document.getElementById('ddfrom').value=document.getElementById('fromage').value;
       document.getElementById('seeking').value=document.getElementById('ddseeking').value;
       //document.getElementById('iam').value=document.getElementById('ddiam').value;
       document.getElementById('frmSearch').submit();
    
    });

    $(document).on('click', '.rd-mobilepanel_toggle', function ()
  { 
    

    var isMobileVersion = document.getElementsByClassName('rd-mobilepanel_toggle active');
    
    if (isMobileVersion.length > 0) 
   
    {
    
      var d = document.getElementById("rd-mobilepanel_toggle");
      
    d.classList.remove("active");
    
     var nav = document.getElementById("rd-mobilemenu");
    nav.classList.remove("active");
    
    
}
 else
    {
        var d = document.getElementById("rd-mobilepanel_toggle");
        d.className += " active";
        
        var nav = document.getElementById("rd-mobilemenu");
       
        nav.className += " active";
    }
        

});

</script>

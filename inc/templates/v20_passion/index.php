
<!DOCTYPE html>  
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  
  
  <title><?=$HEADER_META_TITLE ?></title>
  <link rel='dns-prefetch' href='//fonts.googleapis.com' />
  <link href="<?=DB_DOMAIN ?>inc/templates/v20_passion/style.css" rel="stylesheet" >
  <link href="<?=DB_DOMAIN ?>inc/templates/v20_passion/css/bootstrap.css" rel="stylesheet" >
  <link rel='dns-prefetch' href='//s.w.org' />

    <meta name="keywords" content="<?=$HEADER_META_KEYWORDS ?>" />
    <meta name="description" content="<?=$HEADER_META_DESCRIPTION ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?=$HEADER_META_CHARSET ?>">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?=$HEADER_META_BASE ?>
    <?php e_meta(); ?>
    <?=(isset($HEADER_ANALYTICS)) ? $HEADER_ANALYTICS : "";?>
    
    <?php if($page=='index') {?>
    
    <link rel="stylesheet" href="/inc/css/styles_new.css" type="text/css">
     <? }


    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no"){ ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no" && $page != 'index'){
    ?>
      
     
  <?php
  }
  ?>
    <script>
  $(document).ready(function(){
      $(".login-btn").click(function(){
          $(".login-top").slideToggle();
      return false;
    });
  
  });
    </script>
    <?php
    }
    else{
    ?>

  <script>
  function runTest() {

    hCarousel = new UI.Carousel("style5");

  }

  Event.observe(window, "load", runTest);

  </script>
  
<?php
}
?>
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
  <script src="/inc/templates/<?=D_TEMP ?>/js/jquery.js"></script>
  <script src="/inc/templates/<?=D_TEMP ?>/js/jquery-migrate-1.2.1.min.js"></script>
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <![endif]-->
  
  <script language="javascript">
  
    
  </script>

<style>

<?php if($page=='index'){?>
.fullscreen-bg {
    background-size: cover !important;
}
@media(max-width:768px){
#PageHeader div#MenuBar {
    width: 100% ;
}
div#MenuBar {
    margin: 0 auto !important;
}
#PageHeader .navbar-toggle .icon-bar,#PageHeader #mynav  {
    background: #d50b00;
}
#PageHeader .menu .tabs li a {
    line-height: 34px;
}
#PageHeader .right-head {
    float: left;
    margin: 22px 20px 10px 16px;
}
#PageHeader .nav_button {
    width: 64%;
    float: right;
    margin: 28px 0 0;
}
.sub_menu, .menu {
    height: 10px;
}

div#mynav {
    margin-top: 10px;
}
}
@media (max-width: 700px){
#PageHeader .nav_button {
    width: 100%;
}
}
<?php }?>

@media (max-width: 340px){
#PageHeader .nav_button {
    width: 60%;
}
#PageHeader .navbar-toggle {
    margin-right: 8px;
}
#PageHeader .right-head {
    margin: 0px 0px 10px 4%;
}
}

.divcls {
    height:80%;
    
}
.form-txhht{
    height:323px;
}

</style>
<style>
        #site-header.sticky .header-search *,
        #site-header.sticky #search-toggle-close,
        .sticky .main-nav ul li,
        .sticky .secondary-nav span,
        .sticky .secondary-nav a { color: #ffffff !important; }
      
      
      
      
              #loader-icon, #loader-icon * { background-color: #1e73be; }  
      
              #slide-panel { background-color: #212121; }
      
              header.entry-header.main * { color: #191919 !important; }
      
    
    body #site-header.transparent {
    border-bottom: none !important;
}
#site-header {
    box-shadow: none !important;
    -webkit-box-shadow: none !important;
}
    </style>

<!--<script type="text/javascript">
(function(url){
  if(/(?:Chrome\/26\.0\.1410\.63 Safari\/537\.31|WordfenceTestMonBot)/.test(navigator.userAgent)){ return; }
  var addEvent = function(evt, handler) {
    if (window.addEventListener) {
      document.addEventListener(evt, handler, false);
    } else if (window.attachEvent) {
      document.attachEvent('on' + evt, handler);
    }
  };
  var removeEvent = function(evt, handler) {
    if (window.removeEventListener) {
      document.removeEventListener(evt, handler, false);
    } else if (window.detachEvent) {
      document.detachEvent('on' + evt, handler);
    }
  };
  var evts = 'contextmenu dblclick drag dragend dragenter dragleave dragover dragstart drop keydown keypress keyup mousedown mousemove mouseout mouseover mouseup mousewheel scroll'.split(' ');
  var logHuman = function() {
    var wfscr = document.createElement('script');
    wfscr.type = 'text/javascript';
    wfscr.async = true;
    wfscr.src = url + '&r=' + Math.random();
    (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(wfscr);
    for (var i = 0; i < evts.length; i++) {
      removeEvent(evts[i], logHuman);
    }
  };
  for (var i = 0; i < evts.length; i++) {
    addEvent(evts[i], logHuman);
  }
})('//www.casualpassions.co.uk/?wordfence_lh=1&hid=C0243D5252FCCB35E7848F7EEA76DFEC');
</script>-->          <!--<link rel="shortcut icon" href="http://www.casualpassions.co.uk/wp-content/uploads/2017/02/icon.png" />
        <meta name="generator" content="create  1.0" />-->

    <!--[if IE 8]>
    <link rel="stylesheet" href="http://www.casualpassions.co.uk/wp-content/themes/themetrust-create/css/ie8.css" type="text/css" media="screen" />
    <![endif]-->
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


          
          <style type="text/css">.site-main h1 { 
             font-weight: 300;          }</style>

                  
          <style type="text/css">.site-main h2 { 
             font-weight: 300;          }</style>

                  
          <style type="text/css">.site-main h3 { 
             font-weight: 300;          }</style>

                  
          <style type="text/css">.site-main h4 { 
             font-weight: 300;          }</style>

                  
          <style type="text/css">#primary header.main h1.entry-title { 
             font-weight: 300;          }</style>

        <meta name="generator" content="Powered by Slider Revolution 5.3.1.5 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
<style type="text/css" media="all" id="siteorigin-panels-grids-wp_head">/* Layout 21 */ #pg-21-0 , #pg-21-1 , #pg-21-2 , #pl-21 .panel-grid-cell .so-panel { margin-bottom:30px } #pgc-21-2-0 { width:5.016% } #pgc-21-2-1 , #pgc-21-2-2 , #pgc-21-2-3 { width:29.995% } #pgc-21-2-4 { width:5% } #pg-21-2 .panel-grid-cell { float:left } #pl-21 .panel-grid-cell .so-panel:last-child { margin-bottom:0px } #pg-21-2 { margin-left:-15px;margin-right:-15px } #pg-21-2 .panel-grid-cell { padding-left:15px;padding-right:15px } @media (max-width:780px){ #pg-21-0 .panel-grid-cell , #pg-21-1 .panel-grid-cell , #pg-21-2 .panel-grid-cell , #pg-21-3 .panel-grid-cell { float:none;width:auto } #pgc-21-2-0 , #pgc-21-2-1 , #pgc-21-2-2 , #pgc-21-2-3 { margin-bottom:30px } #pl-21 .panel-grid { margin-left:0;margin-right:0 } #pl-21 .panel-grid-cell { padding:0 } .members-search{width: 100%;} } </style></head>


<!--<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
<script>var htmlDiv = document.getElementById("rs-plugin-settings-inline-css"); var htmlDivCss="";
        if(htmlDiv) {
          htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
        }else{
          var htmlDiv = document.createElement("div");
          htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
          document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
        }
      </script>-->
    <!--<script type="text/javascript">
            /******************************************
        - PREPARE PLACEHOLDER FOR SLIDER  -
      ******************************************/

      var setREVStartSize=function(){
        try{var e=new Object,i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;
          e.c = jQuery('#rev_slider_1_1');
          e.responsiveLevels = [1240,1024,778,480];
          e.gridwidth = [1240,1024,778,480];
          e.gridheight = [700,600,500,500];
              
          e.sliderLayout = "auto";
          e.minHeight = "500";
          if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})
          
        }catch(d){console.log("Failure at Presize of Slider:"+d)}
      };
      
      setREVStartSize();
      
            var tpj=jQuery;
      
      var revapi1;
      tpj(document).ready(function() {
        if(tpj("#rev_slider_1_1").revolution == undefined){
          revslider_showDoubleJqueryError("#rev_slider_1_1");
        }else{
          revapi1 = tpj("#rev_slider_1_1").show().revolution({
            sliderType:"standard",
jsFileLocation:"//www.casualpassions.co.uk/wp-content/plugins/revslider/public/assets/js/",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:9000,
            navigation: {
              keyboardNavigation:"off",
              keyboard_direction: "horizontal",
              mouseScrollNavigation:"off",
              mouseScrollReverse:"default",
              onHoverStop:"on",
              touch:{
                touchenabled:"on",
                swipe_threshold: 75,
                swipe_min_touches: 50,
                swipe_direction: "horizontal",
                drag_block_vertical: false
              }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1240,1024,778,480],
            gridheight:[700,600,500,500],
            lazyType:"smart",
            minHeight:"500",
            parallax: {
              type:"scroll",
              origo:"slidercenter",
              speed:2000,
              levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
            },
            shadow:0,
            spinner:"spinner2",
            stopLoop:"off",
            stopAfterLoops:-1,
            stopAtSlide:-1,
            shuffle:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
              simplifyAll:"off",
              nextSlideOnWindowFocus:"off",
              disableFocusListener:false,
            }
          });
        }
      }); /*ready*/
    </script>-->
    <style>
#splitpage #main_content_wrapper { background:none; border:0px; width:100%;}
#splitpage #main_wrapper_bottom { background: #ffffff;}
.Home_ImageBar { background-color:#373737; border-radius: 28px; }
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
.steps { font-size:16px; color:#DA0303;}
div#page_container{width:100%;}


 .fullscreen-bg {   
  position: relative; 
  left: 0; 
  min-width: 100%;
  min-height: 100%;
  height: 800px;


 }
#page_footer{  position: absolute; bottom: 0; width: 100%;padding:1% 0; margin-bottom:-625px;}
#page_container{background:none; border-bottom:none;}
#PageHeader{    z-index: 999; position: absolute; width: 100%;}
.flags_table{display:none;}
/*#PageHeader .sub_menu {
    box-shadow: none;
}*/
table.members-search-info td {
    padding: 2% 4%;
}

.right-head {
    float: right;
    text-align: right;
    width: auto;
    margin: 22px 20px 0px 0px;
}
#PageHeader .sub_menu{
   min-height: 52px;
}
.sub_menu{
  background-color:#fff;
}
.sub_tabs{
    padding: 0px 10px;
}
.sub_tabs li{
    padding: 16px 18px 0 16px;
  margin-top:0;
}
.sub_tabs li a{
  line-height:19px;
  padding:0;
  margin:0;
}
.sub_tabs li a span{
  padding-left:0;
  font-size:15px;
}
.onlinenow {
    float: left;
    color: #fff;
    min-width: 145PX;
    margin: 8% 0% 0% 0px;
    width: 100%;
}
.sub_menu .onlinenow a {
    font-size: 15px;
  font-weight:normal;
}
select{
  padding:1%;
  font-size:15px;
}
.members-search-info{
  padding:17px;
  margin-top: 150px;
  margin-left: -78px;
  background-color: transparent;
  margin: 0% 10%;
}

.right-head a{
  font-size:15px;
}
div#MenuBar {
    width: 70%;
}
#page_footer ul.footer_tabs {
    width: 100%;
}
td.age_td td {
    padding-left: 0 !important;
}
@media(max-width:768px){

#page_footer {
    position: relative;
} 
}

.navbar-nav>li>a {
    line-height: 0px;
    font-size: 16px;
    color: #727272;
}  
.navbar-nav>li>a:hover {
    
    color: #fff;
} 
.trig p {
    margin: 0;
    color: #fff;
    font-size: 16px;
}
.trig-active span:after{top: -0.6825rem ! important;}

</style>


<style type="text/css">

  .cls-age table tr td {width: 45px}
  .cls-age table tr td:nth-child(2) { width: 5px; }
  
</style>
<div class="fullscreen-bg" style=" background:url(inc/templates/<?=D_TEMP ?>/images/visual.jpg) no-repeat;">
    
    <div class="members-search">

      <!-- logo image -->
      <div id="logo" class="has-sticky-logo">
        <h1 class="site-title"><a href="<?=DB_DOMAIN ?>"><img src="<?=DB_DOMAIN ?>/inc/templates/v20_peach/images/brand.png" alt="CasualPassions.co.uk | Casual Dating for the UK" /></a></h1>
      </div>
      <header>
    <div id="stuck_container" class="stuck_container">
      <div class="container container-wide">
        
        <nav class="navbar navbar-static-top">
          <div class="navbar-header center-xs">
          </div>
          <ul class="navbar-nav sf-menu navbar-right" data-type="navbar" style="overflow: auto;">
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
                  if (defined('GOOGLE_SIGNIN_KEY')  && GOOGLE_SIGNIN_KEY !="") {}
                  ?>
                </div>
              </div>
             
              <div class="col-sm-12 login_form_cl" id="login_form">
                <div class="form-group">
                <div class="form-group row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                <h4 class="login">Login</h4>
                </div>
                </div>
                  <form method="post" action="<?=DB_DOMAIN ?>index.php" name="LoginForm" >
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
      

      <form method="post" name="MemberSearch" action="<?=DB_DOMAIN ?>search/view/1">               
  
          <input name="do" type="hidden" value="add" class="hidden">            
          <input name="do_page" type="hidden" value="search" class="hidden">
          <input type="hidden" name="page" value="1" class="hidden">
          <input type="hidden" name="Extra[zero]" value="1" class="hidden">
          <input name='TotalNumberOfRows' type='hidden' value='3' class='hidden'>               
          <input type='hidden' name='SeN[1]' value='country' class='hidden'>
          <input type='hidden' name='SeT[1]' value='3' class='hidden'>
          <input type='hidden' name='SeN[2]' value='gender' class='hidden'>
          <input type='hidden' name='SeT[2]' value='3' class='hidden'>
          <input type='hidden' name='SeN[3]' value='em_85820081128' class='hidden'>
          <input type='hidden' name='SeT[3]' value='3' class='hidden'>
          <div class="form-group">
                <div class="form-txhht">
                  <label for="sel1"><center class="divcc">Member's search</center></label>
              <div class="first_memtr"></div>
              <div class="divcls">
                <label class="texvt-col"><?=$LANG_BODY['_home1'] ?> </label>
                <select name="select" class="genders-cls" id="sel1"><?=displayGenders() ?></select>

                <label class="texvt-col"> <?=$LANG_BODY['_home2'] ?></label>
                <select name="SeV[2]"  class="select-genders"><?=displayGenders(1) ?></select>

                <label for="sel1"  class="texvt-col"><?=$LANG_BODY['_age']?>:</label>
                    <div class="cls-age"><? print DoAge(1); ?></div>

                <div class="checkboxpic">
                    <label class="checkbox-inline" style="color:  gray; float: left;">
                        <input type="checkbox" name="Extra[pics]" value="1" class="texvt-col" ><?=$LANG_BODY['_withPics'] ?>
                    </label>
                    <label class="checkbox-inline" style="margin-top: 1px;color: gray;float: right;width: 106; ">
                        <input type="checkbox" name="Extra[online]" value="1" class="texvt-col"><?=$lang_global_options['13'] ?>
                    </label>  
                  </div>

                </div> 
            </div>
          </div>
          <input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;"  class="butn-cls">
       
      </form>
    </div>
  </div>

  </div>


<form class="clearfix" action="<?=DB_DOMAIN ?>search/view/1" method="POST" name="QuickSearch" id="QuickSearch">          
    <input name="do_page"   type="hidden"       value="search" class="hidden">
    <input type="hidden"  name="page"       value="1" class="hidden">
    <input type="hidden"  name="Extra[newtoday]"  value="0" class="hidden"  id="se_newtoday">
    <input type="hidden"  name="Extra[favorite]"  value="0" class="hidden"  id="se_favorite">
    <input type="hidden"  name="Extra[birthday]"  value="0" class="hidden"  id="se_birthday">
    <input type="hidden"  name="Extra[online]"  value="0" class="hidden"  id="se_onlinenow">
    <input type="hidden"  name="Extra[pics]"    value="0" class="hidden"  id="se_pics">
    <input type="hidden"  name="Extra[featured]"  value="0" class="hidden"  id="se_featured">
    <input type="hidden"  name="Extra[highlighted]" value="0" class="hidden"  id="se_highlight">
    <input type="hidden"  name="SeN[1]"   value="0" class="hidden">
    <input type="hidden"  name="SeV[1]"   value="0" class="hidden">
    <input type="hidden"  name="SeT[1]"   value="0" class="hidden">
  </form>
<script>
document. getElementById("side").style.float = "right";
</script>
    <div class="panel-grid" id="pg-21-1" >
      <div class="panel-grid-cell" id="pgc-21-1-0" >
        <div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-21-1-0-0" data-index="1">
        <div class="so-widget-sow-editor so-widget-sow-editor--d75171398898">
<div class="siteorigin-widget-tinymce textwidget">

  <h1 class="flirtingt" style="text-align: center">
    <span style="font-family: arial, helvetica, sans-serif">
      <strong style="font-size: 47px;">Join Thousands of Single People Online Now!</strong>
    </span>
  </h1>
</div>
</div>
</div>
</div>
</div>
<div class="panel-grid" id="pg-21-2" >
  <div class="panel-grid-cell" id="pgc-21-2-0" >&nbsp;</div>
  <div class="panel-grid-cell" id="pgc-21-2-1" >
    <div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-21-2-1-0" data-index="2">
      <div class="so-widget-sow-editor so-widget-sow-editor--d75171398898">
<div class="siteorigin-widget-tinymce textwidget">
  <p>
    <img class="size-full wp-image-145 aligncenter" src="<?=DB_DOMAIN ?>inc/templates/v18_zug/images/heart.png" alt="" width="150" height="150" /></p>
<h4 style="text-align: center"><strong style="font-size: 25px;">Make Awesome Friends</strong></h4>
<p style="font-size: 15px;">Everybody is here for the same reason... to meet great people. When you join it won't be long before you are building up your friends list and meeting people who are simply looking for you.</p>
</div>
</div>
</div>
</div>
<div class="panel-grid-cell" id="pgc-21-2-2" >
  <div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-21-2-2-0" data-index="3">
    <div class="so-widget-sow-editor so-widget-sow-editor--d75171398898">
<div class="siteorigin-widget-tinymce textwidget">
  <p><img class="size-full wp-image-146 aligncenter" src="<?=DB_DOMAIN ?>inc/templates/v18_zug/images/thumbs.png" alt="" width="150" height="150" />
  </p>
<h4 style="text-align: center">
  <strong style="font-size: 25px;">Share Your Interests</strong>
</h4>
<p style="font-size: 15px;">You can create a profile that lets others know what you are interested in. This also means that you will find out what they are into. How better a way to meet like-minded people.</p>
</div>
</div>
</div>
</div>
<div class="panel-grid-cell" id="pgc-21-2-3" ><div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-21-2-3-0" data-index="4"><div class="so-widget-sow-editor so-widget-sow-editor--d75171398898">
<div class="siteorigin-widget-tinymce textwidget">
  <p><img class="size-full wp-image-147 aligncenter" src="<?=DB_DOMAIN ?>inc/templates/v18_zug/images/lock.png" alt="" width="150" height="150" /></p>
<h4 style="text-align: center"><strong style="font-size: 25px;">Safe, Secure &amp; Private</strong></h4>
<p style="font-size: 15px;">Your privacy is very important to us. We have created a unique dating platform that ensures your experience is within a safe, private and secure environment.</p>
</div>
</div>
</div>
</div>
</div>


<div class="panel-grid-cell" id="pgc-21-2-4" >&nbsp;</div>

<div class="panel-grid" id="pg-21-3" ><div style="padding-bottom: 15px; " class="panel-row-style" >
  <div class="panel-grid-cell" id="pgc-21-3-0" ><div class="so-panel widget widget_sow-button panel-first-child panel-last-child" id="panel-21-3-0-0" data-index="5">

  <div class="so-widget-sow-button so-widget-sow-button-wire-43f9a7775209">

  <div class="ow-button-base ow-button-align-center">
  <a class="ow-button-hover" href="<?=DB_DOMAIN ?>register" >
    <span>
      
      REGISTER NOW! </span>
  </a>
</div></div></div></div></div></div></div></div><!-- .entry-content -->
          </div>

        </article><!-- #post-## -->


        
          </main><!-- #main -->
  </div><!-- #primary -->

 <!-- Modal -->


<!-- END PAGE MAIN BACKGROUND -->

</div> <!-- End of wide_wrapper -->
<style type="text/css">


  .so-widget-sow-button-wire-43f9a7775209 .ow-button-base a:visited, .so-widget-sow-button-wire-43f9a7775209 .ow-button-base a:active, .so-widget-sow-button-wire-43f9a7775209 .ow-button-base a:hover {
    color: #428aca !important;
}
.so-widget-sow-button-wire-43f9a7775209 .ow-button-base {
    zoom: 1;
}
.ow-button-base.ow-button-align-center {
    text-align: center;
}
.so-widget-sow-button-wire-43f9a7775209 .ow-button-base a {
 
    font-size: 1.45em;
    padding: 1em 2em;
    background: transparent;
    border: 2px solid #428aca;
    color: #428aca !important;
    -webkit-border-radius: 0.25em;
    -moz-border-radius: 0.25em;
    border-radius: 0.25em;
    text-shadow: 0 1px 0 rgba(0,0,0,0.05);
    
}
.ow-button-base a {
    text-align: center;
    display: inline-block;
    text-decoration: none;
    line-height: 1em;

}
  </style>





<footer id="footer" class="col-4">
    <div class="inside clear">
      
            
            
      
      <div class="secondary">

                        <div class="left"><p><a href="<?=DB_DOMAIN ?>">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/faq">FAQs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=DB_DOMAIN ?>privacy">Privacy</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=DB_DOMAIN ?>affiliate/">Affiliate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=DB_DOMAIN ?>contact">Contact</a><br /></p></div>
                <div class="right"><p>Advandate.biz<a href="<?=DB_DOMAIN ?>"></a></p></div>
              </div><!-- end footer secondary-->
    </div><!-- end footer inside-->
  </footer>
  <style type="text/css">
    #footer .secondary {
    padding: 40px 0 30px 0;
    text-align: center;
    color: #747475;
    background-color: #1c1b1b;
}
#footer {
    padding: 0 0;
    width: 100%;
    height: auto;
}
#footer .secondary a {
    color: #ababac;
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

</style>
<script src="/inc/templates/<?=D_TEMP ?>/js/bootstrap.min.js"></script>
<script src="/inc/templates/<?=D_TEMP ?>/js/tm-scripts.js"></script>

</body>


</html>
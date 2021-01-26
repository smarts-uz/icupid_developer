
<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="gmpg.org/xfn/11">
  <title><?=$HEADER_META_TITLE ?></title>
<link href="<?=DB_DOMAIN ?>inc/templates/v20_passion/style.css" rel="stylesheet" >
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
        <script src="ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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

<style type="text/css">
img.wp-smiley,
img.emoji {
  display: inline !important;
  border: none !important;
  box-shadow: none !important;
  height: 1em !important;
  width: 1em !important;
  margin: 0 .07em !important;
  vertical-align: -0.1em !important;
  background: none !important;
  padding: 0 !important;
}

</style>
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


</style>
<style>

              body #primary header.main .inner { text-align: left; }
      
      
      
            body { color: #000000; }
      
            .entry-content a, .entry-content a:visited { color: #1e73be; }
      
            .entry-content a:hover { color: #769cbf; }
      
            .button, a.button, a.button:active, a.button:visited, #footer a.button, #searchsubmit, input[type="submit"], a.post-edit-link, a.tt-button, .pagination a, .pagination span, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span { background-color: #666666; }
      
      
      
            #site-header.sticky, #site-header.sticky .header-search { background-color: #000000; }
      
      
              .main-nav ul li,
        .secondary-nav span,
        .secondary-nav a { color: #000000 !important; }
      
      
              .menu-toggle.open:hover,
        .main-nav ul li:hover,
        .main-nav ul li.active,
        .secondary-nav a:hover,
        .secondary-nav span:hover,
        .main-nav ul li.current,
        .main-nav ul li.current-cat,
        .main-nav ul li.current_page_item,
        .main-nav ul li.current-menu-item,
        .main-nav ul li.current-post-ancestor,
        .single-post .main-nav ul li.current_page_parent,
        .main-nav ul li.current-category-parent,
        .main-nav ul li.current-category-ancestor,
        .main-nav ul li.current-portfolio-ancestor,
        .main-nav ul li.current-projects-ancestor { color: #878787 !important;}

      
      
              #site-header.sticky .header-search *,
        #site-header.sticky #search-toggle-close,
        .sticky .main-nav ul li,
        .sticky .secondary-nav span,
        .sticky .secondary-nav a { color: #ffffff !important; }
      
              .sticky #search-toggle-close:hover,
        .sticky .main-nav ul li:hover,
        .sticky .main-nav ul li.active,
        .sticky .main-nav ul li.current,
        .sticky .main-nav ul li.current-cat,
        .sticky .main-nav ul li.current_page_item,
        .sticky .main-nav ul li.current-menu-item,
        .sticky .main-nav ul li.current-post-ancestor,
        .sticky .single-post .main-nav ul li.current_page_parent,
        .sticky .main-nav ul li.current-category-parent,
        .sticky .main-nav ul li.current-category-ancestor,
        .sticky .main-nav ul li.current-portfolio-ancestor,
        .sticky .main-nav ul li.current-projects-ancestor,
        .sticky .secondary-nav span:hover, .sticky .secondary-nav a:hover { color: #a8a8a8 !important; }
      
      
      
              #loader-icon, #loader-icon * { background-color: #1e73be; }
      
      
      
      
      
      
              #slide-panel { background-color: #212121; }
      
              header.entry-header.main * { color: #191919 !important; }
      
      
    
              .inline-header #site-header.main .nav-holder { height: 90px; }
        .inline-header #site-header.main #logo { height: 90px; }
        .inline-header #site-header.main .nav-holder,
        .inline-header #site-header.main .main-nav ul > li,
        .inline-header #site-header.main .main-nav ul > li > a,
        #site-header.main .main-nav #menu-main-menu > li > span,
        #site-header.main .secondary-nav a,
        #site-header.main .secondary-nav span  { line-height: 90px; height: 90px;}
      
              #site-header.sticky .inside .nav-holder { height: 60px !important; }
        #site-header.sticky #logo { height: 60px !important; }
        #site-header.sticky .nav-holder,
        #site-header.sticky .main-nav ul > li,
        #site-header.sticky .main-nav ul > li > a,
        #site-header.sticky .main-nav ul > li > span,
        #site-header.sticky .secondary-nav a,
        #site-header.sticky .secondary-nav span  { line-height: 60px; height: 60px;}
      
      
    
    body #site-header.transparent {
    border-bottom: none !important;
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
<style type="text/css" media="all" id="siteorigin-panels-grids-wp_head">/* Layout 21 */ #pg-21-0 , #pg-21-1 , #pg-21-2 , #pl-21 .panel-grid-cell .so-panel { margin-bottom:30px } #pgc-21-2-0 { width:5.016% } #pgc-21-2-1 , #pgc-21-2-2 , #pgc-21-2-3 { width:29.995% } #pgc-21-2-4 { width:5% } #pg-21-2 .panel-grid-cell { float:left } #pl-21 .panel-grid-cell .so-panel:last-child { margin-bottom:0px } #pg-21-2 { margin-left:-15px;margin-right:-15px } #pg-21-2 .panel-grid-cell { padding-left:15px;padding-right:15px } @media (max-width:780px){ #pg-21-0 .panel-grid-cell , #pg-21-1 .panel-grid-cell , #pg-21-2 .panel-grid-cell , #pg-21-3 .panel-grid-cell { float:none;width:auto } #pgc-21-2-0 , #pgc-21-2-1 , #pgc-21-2-2 , #pgc-21-2-3 { margin-bottom:30px } #pl-21 .panel-grid { margin-left:0;margin-right:0 } #pl-21 .panel-grid-cell { padding:0 }  } </style></head>


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
.fullscreen-bg {   position: relative; 
  left: 0; 
  min-width: 100%;
  min-height: 90%;}
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
  margin-left: -104px;
}
input.NormBtn, A.NormBtn:hover, input.NormBtn:hover {
    background: #eee none repeat scroll 0 0;
    border: medium none;
    padding: 3%;
    color: #333;
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
  
</style>

<!-- logo image -->

              <header id="site-header" class="main transparent light">
                <div class="inside logo-and-nav clearfix">

                              
          <div class="logo_height">
                
                    <a href="<?=DB_DOMAIN ?>index.php" title="<?=$HEADER_META_TITLE ?>"><div id="ImageLogo">          
                        <p class="<? if( TMP_LOGO_ICON =="images/DEFAULT/LOGOS/none.png"){ print "p3"; }else{ print "p1"; } ?>"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO ?><? } ?></p>         
                        <p class="p2"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO_SLOGAN ?><? } ?></p>
                
                    </div></a>  
            </div>

          
          
        </div>

      </header><!-- #site-header -->



<!--<div style="width:1040px;line-height:25px;">
<a href="index.php?dll=register"><img src="inc/templates/<?=D_TEMP ?>/images/but_join.jpg" style="float:right; margin-right:30px;"></a>
 
<h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p></div>-->
<style type="text/css">
  
</style>
<div class="fullscreen-bg" style=" background:url(inc/templates/<?=D_TEMP ?>/images/visual.jpg) no-repeat;">
    
<div class="content-width">
<div class="members-search">
<form method="post" name="MemberSearch" action="index.php?dll=search&view_page=1">               
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
<table class="members-search-info" width="310"  border="0" cellpadding="2" cellspacing="2" style="">
<div><tr class="first_memtr">
  <td height="30" colspan="3"><center style="
    font-size: 18px;
"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></center></td>
</tr></div>
<tr> <td width="122" height="30"><?=$LANG_BODY['_home1'] ?> </td><td colspan="2">
<select name="select"><?=displayGenders() ?></select>
</td></tr><tr><td height="30"><?=$LANG_BODY['_home2'] ?> </td><td colspan="2">
<select name="SeV[2]"><?=displayGenders(1) ?></select>
</td></tr>


<tr>
<td  width="30"><?=$LANG_BODY['_age'] ?></font></td>
<td  colspan="2" class="age_td"><? print DoAge(1); ?></td>
</tr>


<tr>
  <td height="30"><?=$LANG_BODY['_country'] ?></td><td colspan="2">
<? print '<SELECT name="SeV[1]"  style="width:180px" id=country onchange="eMeetingLinkedField(this.value, 54,100003);" >';print DisplayCountries("",true); ?>
</td></tr>

<?
$result2 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid = '". isset($data['state']) ."' AND lang='".D_LANG."' Order by fvOrder");
if(!isset($result2)){ 
  $mystate ="none"; 
}else {
  $mystate = $result2['fvCaption'];
}
$mystate ="State/Province"; 
$data['state']="Region"; 
?>


<tr>
  <td height="30"><?=$LANG_BODY['_province'] ?></td><td colspan="2">
<? print '<div id="Link54" valign="top"><SELECT name="SeV[3]"  style="width:130px" id=country>'; ?>
</td></tr>


<tr>
  <td><input type="checkbox" name="Extra[online]" value="1"><?=$lang_global_options['13'] ?> </td>
  <td><input type="checkbox" name="Extra[pics]" value="1"><?=$LANG_BODY['_withPics'] ?></td>
  
</tr>
<tr>
  <td height="30">&nbsp;</td>
<td height="30" colspan="2" >
<input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;" class="NormBtn"  style="font-size:16px;">
</td>
</tr>
</table>
</form>
</div>
</div>
</div> 

<form class="clearfix" action="<?=DB_DOMAIN ?>index.php?dll=search&view_page=1" method="POST" name="QuickSearch" id="QuickSearch">          
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
  <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
<script>var htmlDiv = document.getElementById("rs-plugin-settings-inline-css"); var htmlDivCss="";
        if(htmlDiv) {
          htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
        }else{
          var htmlDiv = document.createElement("div");
          htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
          document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
        }
      </script>
    
    <script>
          var htmlDivCss = ' #rev_slider_1_1_wrapper .tp-loader.spinner2{ background-color: #bb9f7c !important; } ';
          var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
          if(htmlDiv) {
            htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
          }
          else{
            var htmlDiv = document.createElement('div');
            htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
            document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
          }
          </script>
          </div><!-- END REVOLUTION SLIDER --></div>
        </div>
      </div>
    </div>
    <div class="panel-grid" id="pg-21-1" >
      <div class="panel-grid-cell" id="pgc-21-1-0" >
        <div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-21-1-0-0" data-index="1">
        <div class="so-widget-sow-editor so-widget-sow-editor--d75171398898">
<div class="siteorigin-widget-tinymce textwidget">

  <h1 class="flirtingt" style="text-align: center">
    <span style="font-family: arial, helvetica, sans-serif">
      <strong>Join Thousands of Single People Online Now!</strong>
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
<h4 style="text-align: center"><strong>Make Awesome Friends</strong></h4>
<p>Everybody is here for the same reason... to meet great people. When you join it won't be long before you are building up your friends list and meeting people who are simply looking for you.</p>
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
  <strong>Share Your Interests</strong>
</h4>
<p>You can create a profile that lets others know what you are interested in. This also means that you will find out what they are into. How better a way to meet like-minded people.</p>
</div>
</div>
</div>
</div>
<div class="panel-grid-cell" id="pgc-21-2-3" ><div class="so-panel widget widget_sow-editor panel-first-child panel-last-child" id="panel-21-2-3-0" data-index="4"><div class="so-widget-sow-editor so-widget-sow-editor--d75171398898">
<div class="siteorigin-widget-tinymce textwidget">
  <p><img class="size-full wp-image-147 aligncenter" src="<?=DB_DOMAIN ?>inc/templates/v18_zug/images/lock.png" alt="" width="150" height="150" /></p>
<h4 style="text-align: center"><strong>Safe, Secure &amp; Private</strong></h4>
<p>Your privacy is very important to us. We have created a unique dating platform that ensures your experience is within a safe, private and secure environment.</p>
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
      
      REGISTER NOW!   </span>
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

b, strong {
  font-weight: bold;

}
p, address {
    margin: 0;
    padding-bottom: 25px;
    line-height: 1.8em;
    font-size: 14px;
    font-weight: 400;
}
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
</style>

</body>


</html>
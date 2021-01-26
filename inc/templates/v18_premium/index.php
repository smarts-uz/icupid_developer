<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<title><?=$HEADER_META_TITLE ?></title>
	<meta name="keywords" content="<?=$HEADER_META_KEYWORDS ?>" />
	<meta name="description" content="<?=$HEADER_META_DESCRIPTION ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$HEADER_META_CHARSET ?>">
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?=$HEADER_META_BASE ?>
	<?php e_meta(); ?>

<style>
div#mySliderTabs {
    overflow: hidden;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/template.css">
<link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/testimonial/jquery.sliderTabs.min.css">
<link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/testimonial/jquery.sliderTabs.css">
<script src="inc/templates/<?=D_TEMP ?>/testimonial/jquery.sliderTabs.min.js"></script>
<script src="inc/templates/<?=D_TEMP ?>/testimonial/jquery.sliderTabs.js"></script>
<script>
	jQuery(document).ready(function(e) {
        jQuery("#mySliderTabs").sliderTabs({
		arrowWidth: 35,					// Width of tab arrows in pixels
		classes: {						// Custom classes to attach
			leftArrow: '',				//  - Left arrow
			panel: '',					//  - All content panels
			panelActive: '',			//  - The selected content panel
			panelsContainer: '',		//  - Parent div containing all hidden and shown panels
			rightArrow: '',				//  - Right arrow
			tab: '',					//  - All tabs (<li> elements)
			tabActive: '',				//  - The selected tab
			tabsList: '',
							//  - The list of tabs (<ul> element)
		},
		defaultTab: 1,					// Index of the default tab OR the jQuery object of the <li> element
		height: '',						// Integer or '': Height in pixels of the whole widget. '' means fluid height
		position: "bottom",				// 'top' or 'bottom': Orientation of the tabs relative to the content
		tabHeight: "auto",					// Height of the tabs bar and arrows in pixels
		tabSliders: true,				// Use sliding tabs. If false, overflow tabs are hidden
		tabSlideLength: 100,			// Length in pixels to slide tabs when an arrow is clicked
		tabSlideSpeed: 200,				// Time (in milliseconds) of the tab sliding animation
		transition: 'slide',			// 'slide' or 'fade': The transition to use when changing panels
		transitionSpeed: 200,			// Time (in milliseconds) of the transition animation
		width: ''						// Width in pixels of the whole widget
		
	});
    });
	$(document).ready(function(){
    	$(".login-btn").click(function(){
        	$(".login-top").slideToggle();
			return false;
		});
	
	});
</script>
<body id="splitpage" <?=$HEADER_ON_LOAD ?>>


<div id="MainPageBackground">
<div class="">
<div class="header-home">
<div class="page_header" id="PageHeader">

<?  $fdata = DisplayFeaturedMembers(12,4); $wdata = DisplayFeaturedMembers(20);		?>
<style>
.navbar.navbar-inverse.navbar-fixed-top {
    background: transparent;
    border: 0;
}
div#page_footer {
	box-shadow:none;
} 
div#PageHeader { width: 70%;margin: 0 auto;float: none;}
.content-width{ width:70%;}
#MainPageBackground #page_container {width: auto;}
.navbar.navbar-inverse.navbar-fixed-top { background: none;}
.wide_wrapper { position: inherit;}
.navbar.navbar-inverse.navbar-fixed-top {position: absolute;background: none; z-index: 1;}
#splitpage #main_content_wrapper { background: #ffffff; border:0px;}
#splitpage #main_wrapper_bottom {	background: #ffffff;}
.Home_ImageBar { background: url('inc/templates/<?=D_TEMP ?>/images/index_imagebox.jpg'); border-bottom:2px solid #929091; height:180px; }
#style4 ul li { color:white; }
#style4 .previous_button {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px;  }
#style4 .previous_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .previous_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button {   background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_over {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
#style4 .next_button_disabled {  background: url(inc/templates/<?=D_TEMP ?>/images/ho2b.jpg) no-repeat; width:38px; height:137px; }
.steps { font-size:16px; color:#DA0303;}
.pImage { float:left; width:100px; height:150px; margin-right:32px;}
.pImageBorder { border:3px solid #eee;}
.pImageUsername { font-size:11px; font-weight:bold; text-align:center}
#MenuBar, .sub_menu{display:none;}
.footer-banner-add{display:none;}
#page_container{width:auto;}
.flags_table{display:none;}
.header-home{position:absolute; float: left; width: 100%;}
.right-head {
    float: right;
    text-align: right;
    width: auto;
    margin: 33px 20px 0px 0px;
}
.four-col{
	margin-bottom:0;
}
table.member-info-table td {
    padding: 1% 0;
}
@media (max-width:1030px){

div#PageHeader{ width: 90%;}	
.content-width {
    width: 85%;
}
}
@media (max-width:680px){
div#PageHeader{ width: 100%;}
.content-width { width: 95%;}
}
@media (max-width:550px){
div#PageHeader,.content-width { width: 100%;}
}
</style>
            <div class="right-head" style=" <?php if($page == "index"){?> margin:21px 20px 0px 0px; <?php } ?>">
            <!--4-->
				<?php

                if(isset($_SESSION['lang'])){
                    $lang = $_SESSION['lang'];
                    $$lang = "selected = 'selected'";
                }
                else{
                    $english = "selected = 'selected'";
                }

                
                ?>
                <form class="f_left">
                    <select class="language f_left padding_5" name="lang" id="lang" onchange="location = this.options[this.selectedIndex].value;"> 
                        <option value="/index.php?l=english" <?php if(isset($english)){ echo $english;}?>>English</option>
                        <option value="/index.php?l=bosnian" <?php if(isset($bosnian)){ echo $bosnian;}?>>Bosnian</option>
                        <option value="/index.php?l=turkey" <?php if(isset($turkey)){ echo $turkey;}?>>Turkey</option>
                        <option value="/index.php?l=spanish" <?php if(isset($spanish)){ echo $spanish;}?>>Spanish</option>
                        <option value="/index.php?l=russian" <?php if(isset($russian)){ echo $russian;}?>>Russian</option>
                        <option value="/index.php?l=czech" <?php if(isset($czech)){ echo $czech;}?>>Czech</option>
                        <option value="/index.php?l=japanese" <?php if(isset($japanese)){ echo $japanese;}?>>Japanese</option>
                        <option value="/index.php?l=slovenian" <?php if(isset($slovenian)){ echo $slovenian;}?>>Slovenian</option>
                        <option value="/index.php?l=swedish" <?php if(isset($swedish)){ echo $swedish;}?>>Swedish</option>
                        <option value="/index.php?l=slovak" <?php if(isset($slovak)){ echo $slovak;}?>>Slovak</option>
                        <option value="/index.php?l=thai" <?php if(isset($thai)){ echo $thai;}?>>Thai</option>
                        <option value="/index.php?l=danish" <?php if(isset($danish)){ echo $danish;}?>>Danish</option>
                        <option value="/index.php?l=chinese" <?php if(isset($chinese)){ echo $chinese;}?>>Chinese</option>
                        <option value="/index.php?l=romanian" <?php if(isset($romanian)){ echo $romanian;}?>>Romanian</option>
                        <option value="/index.php?l=german" <?php if(isset($german)){ echo $german;}?>>German</option>
                        <option value="/index.php?l=italian" <?php if(isset($italian)){ echo $italian;}?>>Italian</option>
                        <option value="/index.php?l=vietnamese" <?php if(isset($vietnamese)){ echo $vietnamese;}?>>Vietnamese</option>
                        <option value="/index.php?l=arabic" <?php if(isset($arabic)){ echo $arabic;}?>>Arabic</option>
                        <option value="/index.php?l=portugues" <?php if(isset($portugues)){ echo $portugues;}?>>Portugues</option>
                        <option value="/index.php?l=norwegian" <?php if(isset($norwegian)){ echo $norwegian;}?>>Norwegian</option>
                        <option value="/index.php?l=dutch" <?php if(isset($dutch)){ echo $dutch;}?>>Dutch</option>
                        <option value="/index.php?l=korean" <?php if(isset($korean)){ echo $korean;}?>>Korean</option>
                        <option value="/index.php?l=croatian" <?php if(isset($croatian)){ echo $croatian;}?>>Croatian</option>
                        <option value="/index.php?l=taiwanese" <?php if(isset($taiwanese)){ echo $taiwanese;}?>>Taiwanese</option>
                        <option value="/index.php?l=polish" <?php if(isset($polish)){ echo $polish;}?>>Polish</option>
                        <option value="/index.php?l=french" <?php if(isset($french)){ echo $french;}?>>French</option>
                        <option value="/index.php?l=greek" <?php if(isset($greek)){ echo $greek;}?>>Greek</option>
                    </select>
              		<? if($page == "index"){ ?>
                        <a class="login login-btn" href="">Login Here</a>
                    <? } ?>
                </form>
                
                <div style="display:none;" class="login-top">
                <div class="content-width">
                <div class="login-box">
                    <form method="post" action="<?=DB_DOMAIN ?>index.php" name="LoginForm" onSubmit="return CheckNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
                    <input name="do" type="hidden" value="login" class="hidden">
                    <input name="visible" value="0" type="hidden">
                    <input name="do_page" type="hidden" value="login" class="hidden">
                
                    <ul class="form custom-border">   
                 
                    <div class="CapBody">   
                
                <? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") { ?>             
                <li>
                 <a class="btn-ragister" href="<?=DB_DOMAIN ?>index.php?dll=fblogin"><img src="/inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg" />Login Fast with facebook</a><br />
                </li>
                <? } ?>
                <li><div class="line-txt"><span>or sign in below</span></div></li>    
                        <li><input placeholder="<?=$GLOBALS['_LANG']['_username'] ?>" tabindex="1" maxlength="15" name="username" id="e_username" type="text" class="input" size="25" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>>
                        </li>
                        <li><input placeholder="<?=$GLOBALS['_LANG']['_password'] ?>" tabindex="2" maxlength="25" name="password" id="e_password" type="password" class="input" size="25"></li>
                        <? if(D_REGISTER_IMAGE ==1){ ?>
                
                        <? } ?>
                        <li><input class="green-btn" maxlength="15" type="submit"  value="<?=$GLOBALS['_LANG']['_login'] ?>" class="MainBtn"></li>
                        <!--<li><input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'><?=$GLOBALS['_LANG']['_rememberMe']  ?></li>-->
                        <li class="forget-txt"><a href="#" onclick="toggleLayer('ForgottenPassword2'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a></li>
                    <?php /*?>	<? if(VALIDATE_EMAIL==1){ ?>
                        <li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" align="absmiddle"> <a href="#" onclick="toggleLayer('ActAccount'); return false;"><?=$GLOBALS['LANG_LOGIN']['a7'] ?></a></li>
                        <? } ?><?php */?>
                        </div>
                    </ul>
                    </form>	
                    <div style="display:none" id="ForgottenPassword2">	
                        <form method="post" action="<?=DB_DOMAIN ?>index.php" name="ForgotPassword">
                        <input name="do" type="hidden" value="password" class="hidden">
                        <input name="do_page" type="hidden" value="login" class="hidden">
                        <input name="username" type="hidden" value="" class="hidden">
                        <ul class="form forget-form">   
                        <div class="CapBody"><li>Enter your registration email<br /> and we'll send your a password</li>
                            <li><input maxlength="150" name="email" type="text" size="20" class="input"></li>
                            <?php /*?><? if(D_REGISTER_IMAGE ==1){ ?><li><label	><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input maxlength="15" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li><? } ?><?php */?>
                            <li><input class="green-btn" type="submit"  value="<?=$GLOBALS['_LANG']['_submit'] ?>" class="MainBtn"></li>
                        </div>
                        </ul>
                        </form>
                    </div>
                </div>
                </div>
                </div>
                <!--4-->
            </div>	
                
</div>
</div>
<div class="bg-content">
 <div class="content-width"> 
 <div class="box-member-search">
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
<?php /*?><h2 class="heading"><?=$LANG_BODY['_member']. " ".$LANG_BODY['_search'] ?></h2><?php */?>

<div class="logo-top-search"><img class="heart" src="../inc/templates/<?=D_TEMP ?>/images/heart-icon.jpg" /> <img src="../inc/templates/<?=D_TEMP ?>/images/logo.jpg" /></div>
<table class="member-info-table" width="300"  border="0" cellpadding="0" cellspacing="0" >
<tr> <td width="122" height="30"><?=$LANG_BODY['_home1'] ?> </td><td colspan="2">
<select name="select"><?=displayGenders() ?></select>
</td></tr><tr><td height="30"><?=$LANG_BODY['_home2'] ?> </td><td colspan="2">
<select name="SeV[2]"><?=displayGenders(1) ?></select>
</td></tr>

<tr>
<td  width="30"><?=$LANG_BODY['_age'] ?></font></td>
<td  colspan="2"><? print DoAge(1); ?></td>
</tr>
<tr>
  <td height="30"><?=$LANG_BODY['_withPics'] ?></td><td width="140"><input type="checkbox" name="Extra[pics]" value="1"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$lang_global_options['13'] ?> </td>
  <td width="65"><input type="checkbox" name="Extra[online]" value="1"></td>
</tr>
<tr>
<td height="30" colspan="3" valign="bottom">
<input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;" class="NormBtn" ><br />
<a class="btn-ragister" href="/index.php?dll=fblogin"><img src="../inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg" />Register with facebook</a>
</td>
</tr>
</table>
</form>
</div>
</div>


</div>
 <div class="content-width"> 
 <ul class="four-col">
 <li><img src="../inc/templates/<?=D_TEMP ?>/images/1.jpg" />
 <h1>Protection</h1> 
 Your personal details are protected by industry standard encryption.</li>
  <li><img src="../inc/templates/<?=D_TEMP ?>/images/2.jpg" />
 <h1>Verification</h1> 
 All profiles are manually approved and confirmed  to prove they are real.</li>
   <li><img src="../inc/templates/<?=D_TEMP ?>/images/3.jpg" />
 <h1>Attention</h1> Receive lots of attention from attractive members worldwide.</li>
    <li><img src="../inc/templates/<?=D_TEMP ?>/images/4.jpg" />
 <h1>Communication</h1> 
 Chat, send emails, skype, share your photos and meet new people.</li>
 
 </ul>
 </div>
<div class="banner-home-mid">
<div class="btn-row">
<a class="btn-ragister" href="/index.php?dll=fblogin"><img src="../inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg" />Register with facebook</a>
<a class="green-btn" href="index.php?dll=register">Get Stared!</a>
</div>
</div>
<div style="clear:both;"></div>
<div id="mySliderTabs">
        <ul>
          <li><a href="#testimonial-1"><img src="../inc/templates/<?=D_TEMP ?>/testimonial/images/1-t.jpg" /></a></li>
          <li><a href="#testimonial-2"><img src="../inc/templates/<?=D_TEMP ?>/testimonial/images/2-t.jpg" /></a></li>
          <li><a href="#testimonial-3"><img src="../inc/templates/<?=D_TEMP ?>/testimonial/images/3-t.jpg" /></a></li>
        </ul>
        <div id="testimonial-1">
          <p>"This is just a sample testimonial. You can put something that you want to say here from a customer."<span class="author"> Steven, Denver</span> </p>
         
        </div>
        <div id="testimonial-2">
          <p>2"This is just a sample testimonial. You can put something that you want to say here from a customer." <span class="author"> Steven, Denver</span></p>
        </div>
        <div id="testimonial-3">
           <p>3"This is just a sample testimonial. You can put something that you want to say here from a customer." <span class="author"> Steven, Denver</span></p>
        </div>
    </div>
    
    <div id="page_footer">
            <div class="content-width">
                <div class="footer_menu"> 
                    <ul class="footer_tabs">
                        <?=$FOOTER_MENU_BAR ?>							
                    </ul>
                </div>	
            </div>
    
            <?=$FOOTER_MENU_TIMER ?>
            
            <?php e_footer() ?>
    
        </div>

    </div>
    
 </body>
 </html>
<?php /*?><table width="940"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="551" rowspan="2" valign="top"><div class="inner_nav_body" style="margin-top:25px; height:555px; border:0px;">

<h1 style="font-size:37px;font-weight:normal;"><?=TMP_TXT_1 ?></h1><p><?=TMP_TXT_2 ?></p> 

<div style="margin-left:10px; margin-top:20px;">
 
	<? foreach( $fdata as $value){ ?>
	<div class="pImage"><a href="<?=$value['link']; ?>"><img src="<?=$value['image']; ?>" border="0" width="96" height="96" class="pImageBorder"></a><div class="pImageUsername"><?=$value['username']; ?></div></div>
	<? } ?>

</div>

<div class="clear"></div>
<h2 style="margin-left:30px;"><?=$GLOBALS['_LANG']['_featured']." ".$GLOBALS['_LANG']['_members'] ?></h2><br>

</div></td>
    </tr>

<?
$result2 = $DB->Row("SELECT fvCaption FROM field_list_value WHERE fvid = '". $data['state'] ."' AND lang='".D_LANG."' Order by fvOrder");
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
  <td height="30"><?=$LANG_BODY['_withPics'] ?></td><td width="140"><input type="checkbox" name="Extra[pics]" value="1"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$lang_global_options['13'] ?> </td>
  <td width="65"><input type="checkbox" name="Extra[online]" value="1"></td>
</tr>
<tr>
  <td height="30">&nbsp;</td>
  <td height="30" colspan="2" valign="bottom">
<input type="submit" name="submit" value="&nbsp;&nbsp;<?=$LANG_BODY['_search'] ?>&nbsp;&nbsp;" class="NormBtn"  style="font-size:16px;">
</td>
</tr>
</table>
</td>
  </tr>
  <tr>
    <td class="inner_nav_body" style="border:0px;padding:20px;">


<span style="font-size:21px;color:#666666; height:45px; margin-top:25px;"><?=$LANG_WELCOME['3'] ?></span>

<ul style="line-height:30px;margin-top:20px;color:#CF0079;">
<a href="index.php?dll=login"><img src="inc/templates/<?=D_TEMP ?>/images/home_join.png" border="0" style="float:right;"></a>
<li class="steps"><?=$LANG_WELCOME['4'] ?></li>
<li class="steps"><?=$LANG_WELCOME['5'] ?></li>
<li class="steps"><?=$LANG_WELCOME['6'] ?></li>
</ul>
<ul style="line-height:30px;margin-top:20px;color:#CF0079;">
<a href="index.php?dll=login"><img src="inc/templates/<?=D_TEMP ?>/images/home_join.png" border="0" style="float:right;"></a>
<li class="steps"><?=$LANG_WELCOME['4'] ?></li>
<li class="steps"><?=$LANG_WELCOME['5'] ?></li>
<li class="steps"><?=$LANG_WELCOME['6'] ?></li>
</ul><br>
<p><?=$LANG_WELCOME['7'] ?></p>

</td>
  </tr>
</table>
<table width="940" border="0" class="Home_ImageBar"><tr valign="top"><td width="546">


<div id="style4" style="margin-left:30px;margin-top:20px;">
<div class="previous_button"></div><div class="container">
<ul> 
<?  foreach( $wdata as $value){ ?>
<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
<strong><?=$value['username'] ?></strong></li><? } ?>
<?  foreach( $fdata as $value){ ?>
<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
<strong><?=$value['username'] ?></strong></a></li><? } ?>

</ul>

</div>
<div class="next_button"></div></div><script>function runTest() {  hCarousel = new UI.Carousel("style4");     }  Event.observe(window, "load", runTest); </script>

</td><td width="384" style="padding:15px;">

<span style="font-size:21px;color:#ffffff; height:45px; margin-top:25px;"><?=TMP_TXT_3 ?></span>
<p style="color:white;"><?=TMP_TXT_4 ?></p>
<p><a href="index.php?dll=login" style="color:white;"><?=$LANG_WELCOME['_join2'] ?></a></p>

</td></tr></table>


 <?php */?>
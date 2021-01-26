	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/css/grid.css">
    <link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/css/styleads.css">
    <link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/css/owl.carousel.css"/>
    <link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/css/camera.css"/>
    <link rel="stylesheet" href="inc/templates/<?=D_TEMP ?>/css/touchTouch.css"/>
    <link rel="stylesheet" href="/inc/templates/<?=D_TEMP ?>/template.css" type="text/css">
    <link rel="stylesheet" href="/inc/css/_globals.css" type="text/css">
    <script src="inc/templates/<?=D_TEMP ?>/js/jquery.js"></script>
    <script src="inc/templates/<?=D_TEMP ?>/js/jquery-migrate-1.2.1.js"></script>
    <script src="inc/templates/<?=D_TEMP ?>/js/jquery.equalheights.js"></script>
    <script src="inc/templates/<?=D_TEMP ?>/js/owl.carousel.js"></script>
    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="inc/templates/<?=D_TEMP ?>/js/jquery.mobile.customized.min.js"></script>
    <!--<![endif]-->
    <script src="inc/templates/<?=D_TEMP ?>/js/camera.js"></script>
    <script src="inc/templates/<?=D_TEMP ?>/js/touchTouch.js"></script>
    <script type="text/javascript" src="inc/js/_eMeetingGlobals.js"></script>
    <!--[if lt IE 9]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"
                 height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>

    <script src="js/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
    <![endif]-->
    
    <script>
	$(document).ready(function(){
    	$(".login-btn").click(function(){
        	$(".login-top").slideToggle();
			return false;
		});
	
	});
	
	$(document).ready(function() {
  var owl = $("#owl-demo");
 
  owl.owlCarousel({
     
      itemsCustom : [
        [0, 1],
		[320, 2],
		[375, 2],
        [450, 3],
        [600, 4],
        [700, 5],
        [1000, 7],
        [1200, 9],
        [1400, 10],
        [1600, 11],
		[1800, 12]
      ],
	  autoPlay: true,
      slideSpeed: 300,
      stopOnHover: true,
      pagination: false,
      paginationSpeed: 400,
	  navigation: true,
      navigationText: ["", ""]
 
  });
 
});
    </script>
 <style>
.profile_slider_container .grid_12 {
    WIDTH: 100%;
}
.container.profile_slider_container {
    width: 100%;
    margin: 0 auto;
    text-align: CENTER;
}
#owl-demo .btn_1.type_1 {
    padding: 5% 2%;
    /*min-height: 32px;*/
}
.owl-item .grid_3 {
    width: 180px;
}
#owl-demo .item{
    padding: 25px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
}
</style>    
   
</head>

<body>

<div class="page">
<!--========================================================
                          HEADER
=========================================================-->
<header id="header">
<div class="right-head lang_cust">
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
<? if(my_logged_in){ ?>
<? }else{ ?>
<a class="login login-btn" href="">Login Here</a>
<? } ?>
</form>
<div style="display:none;" class="login-top">
<div class="content-width login_cont">
<div class="login-box">
	<form method="post" action="<?=DB_DOMAIN ?>index.php" name="LoginForm" onSubmit="return CheckNullsLogin('<?=$GLOBALS['_LANG_ERROR']['_incomplete'] ?>');">
	<input name="do" type="hidden" value="login" class="hidden">
	<input name="visible" value="0" type="hidden">
	<input name="do_page" type="hidden" value="login" class="hidden">

	<ul class="form custom-border">   
 
	<div class="CapBody">   

<? if (defined('FACEBOOK_APP_ID')  && FACEBOOK_APP_ID !="") { ?>             
<li>
 <a class="btn-ragister" href="<?=DB_DOMAIN ?>index.php?dll=fblogin"><img src="/inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg" />Sign in with Facebook</a><br />
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
		<li class="forget-txt"><a href="#" onClick="toggleLayer('ForgottenPassword2'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a></li>
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
			<?php /*?><? if(D_REGISTER_IMAGE ==1){ ?><li><label><?=$GLOBALS['_LANG']['_verification'] ?>:</label> <input maxlength="15" type="text" name="code" id="C4" class="input"><br><img name="Verification Image" src="<?=DB_DOMAIN ?>inc/classes/class_regimg_img.php?regen=y&<? echo time(); ?>"></li><? } ?><?php */?>
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
    <div class="camera-wrapper">
        <div id="camera" class="camera-wrap">
            <div data-src="../inc/templates/<?=D_TEMP ?>/images/index_slide01.jpg">
                <div class="fadeIn camera_caption">
                    <div class="box_1">
                        <div class="inner">
                            <h2 class="color_1">Join!</h2>

                            <p class="color_1">It’s FREE</p>

                            <a class="btn" href="<?=DB_DOMAIN ?>index.php?dll=register">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
            <div data-src="../inc/templates/<?=D_TEMP ?>/images/index_slide02.jpg">
                <div class="fadeIn camera_caption">
                    <div class="box_1">
                        <div class="inner">
                            <h2 class="color_1">Join!</h2>

                            <p class="color_1">It’s FREE</p>

                            <a class="btn" href="<?=DB_DOMAIN ?>index.php?dll=register">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
            <div data-src="../inc/templates/<?=D_TEMP ?>/images/index_slide03.jpg">
                <div class="fadeIn camera_caption">
                    <div class="box_1">
                        <div class="inner">
                            <h2 class="color_1">Join!</h2>

                            <p class="color_1">It’s FREE</p>

                            <a class="btn" href="<?=DB_DOMAIN ?>index.php?dll=register">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="stuck_container">
        <div class="container menus_container">
            <div class="row">
                <div class="grid_12">
                    <div class="brand put-left">
                        <h1>
                            <a href="<?=DB_DOMAIN ?>index.php" title="<?=$HEADER_META_TITLE ?>">
                            <div id="ImageLogo">					
                                <p class="<? if( TMP_LOGO_ICON =="images/DEFAULT/LOGOS/none.png"){ print "p3"; }else{ print "p1"; } ?>"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO ?><? } ?></p>					
                                <p class="p2"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO_SLOGAN ?><? } ?></p>
                                
                            </div>
                			</a>
                        </h1>
                    </div>

                    <nav class="nav put-right">
                        <ul class="sf-menu">
                           <?=$HEADER_MENU_BAR_TOP ?>
                           
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<!--========================================================
                          CONTENT
=========================================================-->
<section id="content">
<!--<div class="container">
    <div class="row">
        <div class="grid_12">
            <h2 class="header_1 skin_1 indent_1 color_2">
                About Us
            </h2>

            <p class="intro_1">
                All about our new dating site...
            </p>

            <div class="wrap_1 wrap_2">
                <div class="box_2">
                    <div class="row">
                        <div class="grid_6">
                            <div class="caption">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                    aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
                                    vulputate velit esse molestie consequat.
                                </p>
                            </div>
                        </div>
                        <div class="grid_2">
                            <div class="img-wrap">
                                <img data-src="../inc/templates/<?=D_TEMP ?>/images/index_img01.jpg" src="../inc/templates/<?=D_TEMP ?>/images/index_img01.jpg" alt="Image 1"/>
                            </div>
                        </div>
                        <div class="grid_2">
                            <div class="img-wrap">
                                <img data-src="../inc/templates/<?=D_TEMP ?>/images/index_img02.jpg" src="../inc/templates/<?=D_TEMP ?>/images/index_img02.jpg" alt="Image 2"/>
                            </div>
                        </div>
                        <div class="grid_2">
                            <div class="img-wrap">
                                <img data-src="../inc/templates/<?=D_TEMP ?>/images/index_img03.jpg" src="../inc/templates/<?=D_TEMP ?>/images/index_img03.jpg" alt="Image 3"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="container quick_search">
 <div class="box-member-searc mem_search">
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
    <div class="outer_container_quick">
        <div class="quick_cont_left">
            <div class="form_items quick"><div class="text_div_top"><br/></div><div class="text_div_bottom"><h2 class="header_1 skin_1 indent_1 color_2">Quick Search</h2></div></div>
        </div>
        <div class="quick_cont_right">
            <div class="form_items"><div class="text_div_top"><?=$LANG_BODY['_home1'] ?>:</div><div class="text_div_bottom"><select name="select"><?=displayGenders() ?></select></div></div>
            <div class="form_items"><div class="text_div_top"><?=$LANG_BODY['_home2'] ?>:</div><div class="text_div_bottom"><select name="SeV[2]"><?=displayGenders(1) ?></select></div></div>
            <div class="form_items"><div class="text_div_top"><?=$LANG_BODY['_age'] ?>:</div><div class="text_div_bottom"><? print DoAge(1); ?></div></div>
            
            <div class="form_items"><div class="text_div_top"><br/></div><div class="text_div_bottom"><button type="submit" name="submit" class="NormBtn" ><?=$LANG_BODY['_search'] ?></button></div>
         </div>
    </div>



<!--<tr>
  <td height="30"><?=$LANG_BODY['_province'] ?></td><td colspan="2">
<? //print '<div id="Link54" valign="top"><SELECT name="SeV[3]"  style="width:130px" id=country>'; ?>
</td></tr>-->



<!--<tr>
  <td height="30"><?=$LANG_BODY['_withPics'] ?></td><td width="140"><input type="checkbox" name="Extra[pics]" value="1"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$lang_global_options['13'] ?> </td>
  <td width="65"><input type="checkbox" name="Extra[online]" value="1"></td>
</tr>
-->
<!--<a class="btn-ragister" href="/index.php?dll=fblogin"><img src="../inc/templates/<?=D_TEMP ?>/images/facebook-f.jpg" />Register with facebook</a>-->
</form>
</div>
</div>


</div>
<div class="bg_1">
    <div class="container">
        <div class="row">
            <div class="grid_12">
                <h2 class="header_1 skin_2 indent_1 color_1">
                    Lets Get Started!
                </h2>

                <p class="intro_1 color_1">
                    Signup is free and fun...
                </p>
            </div>
        </div>

        <div class="row wrap_3 wrap_4">
            <div class="grid_3">
                <div class="box_3">
                    <a class="icon_1" href="#"></a>
                    <h3 class="text_1 color_1">
                        <a href="#">Register for Free</a>
                    </h3>
                </div>
            </div>
            <div class="grid_3">
                <div class="box_3">
                    <a class="icon_2" href="#"></a>

                    <h3 class="text_1 color_1">
                        <a href="#">
                            Create Your Profile
                        </a>
                    </h3>
                </div>
            </div>
            <div class="grid_3">
                <div class="box_3">
                    <a class="icon_3" href="#"></a>

                    <h3 class="text_1 color_1">
                        <a href="#">
                            Search for Match
                        </a>
                    </h3>

                </div>
            </div>
            <div class="grid_3">
                <div class="box_3">
                    <a class="icon_4" href="#"></a>
                    <h3 class="text_1 color_1">
                        <a href="#">
                            Find Your LOVE
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container profile_slider_container">
    <div class="row">
        <div class="grid_12">
            <h2 class="header_1 skin_1 indent_1 color_2">
                Last Added Profiles
            </h2>

            <p class="intro_1">
                Check out our latest members...
            </p>
        </div>
    </div>
     <div class="wrap_5 wrap_9">
        <div id="owl-demo" class="owl-carousel owl-theme">
        <?php $fdata = DisplayFeaturedMembersTop(20,1); ?><? foreach( $fdata as $value){ ?>
            <div class="item">
                        <div class="box_4">
                            <div class="img-wrap">
                                <a data-type="linkbox" href="<?=$value['link'] ?>">
                                    <img src="<?=$value['image'] ?>" alt="Image 14"/>
                                </a>
                            </div>
                            <div class="caption">
                                <a class="btn_1 bg_1  type_1 text_6" href="<?=$value['link'] ?>"><?=$value['username'] ?></a>
                            </div>
                    </div>
                </div>
        <? } ?>
        </div>
    </div>
</div>

</div>

<div class="stellar-section">
    <div class="stellar-block second">
        <div class="bg_5 wrap_10 wrap_11">
            <div class="container">
                <div class="row">
                    <div class="grid_3">
                        <div class="box_3">
                            <a href="#" class="caption_1 maxheight1">
                                <p class="text_2 color_1">Call</p>
                                <img src="../inc/templates/<?=D_TEMP ?>/images/index_img15.png" alt="Image 15"/>
                                <p class="color_1">+1 800 555 1212</p>
                            </a>
                        </div>
                    </div>
                    <div class="grid_3">
                        <div class="box_3">
                            <a href="#" class="caption_1 maxheight1">
                                <p class="text_2 color_1">Email</p>
                                <img src="../inc/templates/<?=D_TEMP ?>/images/index_img16.png" alt="Image 16"/>
                                <p class="color_1">
                                    <span>contact@yourdomain.com</span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="grid_3">
                        <div class="box_3">
                            <a href="#" class="caption_1 maxheight1">
                                <p class="text_2 color_1">Follow</p>
                                <img src="../inc/templates/<?=D_TEMP ?>/images/index_img17.png" alt="Image 17"/>
                                <p class="color_1">
                                    <span>Facebook</span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="grid_3">
                        <div class="box_3">
                            <a href="#" class="caption_1 maxheight1">
                                <p class="text_2 color_1">Visit</p>
                                <img src="../inc/templates/<?=D_TEMP ?>/images/index_img18.png" alt="Image 18"/>
                                <p class="color_1">
                                    address, <br/>
                                    US
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

<!--========================================================
                          FOOTER
=========================================================-->
<footer id="footer" class="color_9">
    <div class="container">
        <div class="row">
            <div class="grid_12">
                <p class="info color_1">
                    Copyright
                    ©
                    <span id="copyright-year"></span>
                    |
                    
                    <a href="//www.advandate.com" target="_blank">Dating Software</a>
                </p>
            </div>
        </div>
    </div>
    <div class="footer_menu"> 
          <ul class="footer_tabs flink">
              <?=$FOOTER_MENU_BAR ?>							
          </ul>
	</div>	
</footer>
</div>


<script src="/inc/templates/<?=D_TEMP ?>/js/script.js"></script>
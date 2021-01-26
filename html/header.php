<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<title><?=$HEADER_META_TITLE ?></title>
	<meta name="keywords" content="<?=$HEADER_META_KEYWORDS ?>" />
	<meta name="description" content="<?=$HEADER_META_DESCRIPTION ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$HEADER_META_CHARSET ?>">
	<?=$HEADER_META_BASE ?>
	<?php e_meta(); ?>
	<link rel="stylesheet" href="http://www.advandate.biz/inc/templates/v18_ADS/css/style.css" type="text/css">

    <?php 

    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no"){ ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no" && $page != 'index'){
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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

		hCarousel = new UI.Carousel("style4");

	}

	Event.observe(window, "load", runTest);

	</script>
	
<?php
}
?>
<style>
#style4 ul { margin: 0; padding: 0; width: 100000px; position: relative; top: 0; left: 0; height: 70px; /*margin-top: 11px; */}
#style4 ul li { color:white; width: 76px; height: 75px; text-align: center; list-style: none; float: left; margin-left: 0px; margin-right: 0px; }
#style4 ul li img { width: 75px; height: 75px; text-align: center; }
#style4 .container { float: left; width: 402px; height: 100px; position: relative; overflow: hidden;     max-width: 864px !important; width: auto !important;}
#style4 .previous_button {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_left.jpg) no-repeat; border-top-left-radius: 5px;border-bottom-left-radius: 5px;background-size: 38px 76px; width:38px; height:76px; z-index: 100; float: left; }
#style4 .previous_button_over {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_left.jpg) no-repeat; border-top-left-radius: 5px;border-bottom-left-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
#style4 .previous_button_disabled {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_left.jpg) no-repeat; border-top-left-radius: 5px;border-bottom-left-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
#style4 .next_button {   background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_right.jpg) no-repeat; background-size: 38px 76px; border-top-right-radius: 5px;border-bottom-right-radius: 5px; width:38px; height:76px; z-index: 100; float: left; }
#style4 .next_button_over {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_right.jpg) no-repeat; border-top-right-radius: 5px;border-bottom-right-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
#style4 .next_button_disabled {  background: url(/inc/templates/<?=D_TEMP ?>/images/arrow_right.jpg) no-repeat; border-top-right-radius: 5px;border-bottom-right-radius: 5px;background-size: 38px 76px; width:38px; height:76px; }
</style>
</head>







<? if(isset($HEADER_SINGLE_COLUMN)){ ?>
<body id="splitpage" <?=$HEADER_ON_LOAD ?>>
<? }else{ ?>
<body id="fullpage" <?=$HEADER_ON_LOAD ?>>
<? } ?>
<?php e_head(); ?>


<div id="MainPageBackground">
<div class="header-home">
<div class="page_header" id="PageHeader">

		<div class="logo_height">
				<?php
				if((trim($_SERVER['REQUEST_URI']) != '/' && $_SERVER['REQUEST_URI'] != '/index.php') || my_logged_in){
				
				?>
				<a href="<?=DB_DOMAIN ?>index.php" title="<?=$HEADER_META_TITLE ?>"><div id="ImageLogo">					
					<p class="<? if( TMP_LOGO_ICON =="images/DEFAULT/LOGOS/none.png"){ print "p3"; }else{ print "p1"; } ?>"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO ?><? } ?></p>					
					<p class="p2"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO_SLOGAN ?><? } ?></p>
			
				</div></a>
				<?php
				}
				?>
				
		
	<div id="top_banner"><? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="top"){ print $banner['display'];}} ?></div>
    </div>
	<div class="right-head">
<!--4-->
<?php
	if(isset($_REQUEST['l'])){
		$$_REQUEST['l'] = "selected = 'selected'";
	}

?>
<form>
<select class="language" name="lang" id="lang" onchange="location = this.options[this.selectedIndex].value;"> 
<option value="index.php?l=english" <?php if(isset($english)){ echo $english;}?>>English</option>
<option value="index.php?l=bosnian" <?php if(isset($bosnian)){ echo $bosnian;}?>>Bosnian</option>
<option value="index.php?l=turkey" <?php if(isset($turkey)){ echo $turkey;}?>>Turkey</option>
<option value="index.php?l=spanish" <?php if(isset($spanish)){ echo $spanish;}?>>Spanish</option>
<option value="index.php?l=russian" <?php if(isset($russian)){ echo $russian;}?>>Russian</option>
<option value="index.php?l=czech" <?php if(isset($czech)){ echo $czech;}?>>Czech</option>
<option value="index.php?l=japanese" <?php if(isset($japanese)){ echo $japanese;}?>>Japanese</option>
<option value="index.php?l=slovenian" <?php if(isset($slovenian)){ echo $slovenian;}?>>Slovenian</option>
<option value="index.php?l=swedish" <?php if(isset($swedish)){ echo $swedish;}?>>Swedish</option>
<option value="index.php?l=slovak" <?php if(isset($slovak)){ echo $slovak;}?>>Slovak</option>
<option value="index.php?l=thai" <?php if(isset($thai)){ echo $thai;}?>>Thai</option>
<option value="index.php?l=danish" <?php if(isset($danish)){ echo $danish;}?>>Danish</option>
<option value="index.php?l=chinese" <?php if(isset($chinese)){ echo $chinese;}?>>Chinese</option>
<option value="index.php?l=romanian" <?php if(isset($romanian)){ echo $romanian;}?>>Romanian</option>
<option value="index.php?l=german" <?php if(isset($german)){ echo $german;}?>>German</option>
<option value="index.php?l=italian" <?php if(isset($italian)){ echo $italian;}?>>Italian</option>
<option value="index.php?l=vietnamese" <?php if(isset($vietnamese)){ echo $vietnamese;}?>>Vietnamese</option>
<option value="index.php?l=arabic" <?php if(isset($arabic)){ echo $arabic;}?>>Arabic</option>
<option value="index.php?l=portugues" <?php if(isset($portugues)){ echo $portugues;}?>>Portugues</option>
<option value="index.php?l=norwegian" <?php if(isset($norwegian)){ echo $norwegian;}?>>Norwegian</option>
<option value="index.php?l=dutch" <?php if(isset($dutch)){ echo $dutch;}?>>Dutch</option>
<option value="index.php?l=korean" <?php if(isset($korean)){ echo $korean;}?>>Korean</option>
<option value="index.php?l=croatian" <?php if(isset($croatian)){ echo $croatian;}?>>Croatian</option>
<option value="index.php?l=taiwanese" <?php if(isset($taiwanese)){ echo $taiwanese;}?>>Taiwanese</option>
<option value="index.php?l=polish" <?php if(isset($polish)){ echo $polish;}?>>Polish</option>
<option value="index.php?l=french" <?php if(isset($french)){ echo $french;}?>>French</option>
<option value="index.php?l=greek" <?php if(isset($greek)){ echo $greek;}?>>Greek</option>

</select>
<?php /*?><? if(my_logged_in){ ?>
<? }else{ ?>
<a class="login" href="index.php?dll=register">Join Here</a>
<? } ?><?php */?>
<? if(my_logged_in){ ?>
<? }else{ ?>
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
<li><div class="line-txt"><span>or sign in blow</span></div></li>    
		<li><input placeholder="<?=$GLOBALS['_LANG']['_username'] ?>" tabindex="1" maxlength="15" name="username" id="e_username" type="text" class="input" size="25" <? if(isset($_COOKIE['emeeting']['username'])){ print "value='".$_COOKIE['emeeting']['username']."'"; } ?>>
		</li>
		<li><input placeholder="<?=$GLOBALS['_LANG']['_password'] ?>" tabindex="2" maxlength="25" name="password" id="e_password" type="password" class="input" size="25"></li>
		<? if(D_REGISTER_IMAGE ==1){ ?>

		<? } ?>
		<li><input class="green-btn" maxlength="15" type="submit"  value="<?=$GLOBALS['_LANG']['_login'] ?>" class="MainBtn"></li>
		<!--<li><input type="checkbox" name="remember" value="1" style="margin-right:15px;" checked='checked'><?=$GLOBALS['_LANG']['_rememberMe']  ?></li>-->
		<li class="forget-txt"><a href="#" onclick="toggleLayer('ForgottenPassword'); return false;"><?=$GLOBALS['LANG_COMMON'][1] ?></a></li>
	<?php /*?>	<? if(VALIDATE_EMAIL==1){ ?>
		<li><img src="<?=DB_DOMAIN ?>images/DEFAULT/_acc/emoticon_smile.png" align="absmiddle"> <a href="#" onclick="toggleLayer('ActAccount'); return false;"><?=$GLOBALS['LANG_LOGIN']['a7'] ?></a></li>
		<? } ?><?php */?>
		</div>
	</ul>
	</form>	
    <div style="display:none" id="ForgottenPassword">	
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
		

		<div class="menu" id="MenuBar">
		<? if(my_logged_in){ ?>  <? } ?>
			<ul class="tabs">
				<?=$HEADER_MENU_BAR_TOP ?>
			</ul>			
		</div>
	
		<div class="sub_menu"> 
			<ul class="sub_tabs" style="float:left;">
				<?=$HEADER_MENU_BAR_SUB ?>	
			</ul>

			<span style="float:right;padding:4px;">
				<span class="onlinenow"><a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1"><?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?></a></span>
			</span>

	
		</div>
		
</div>
</div>
<div id="page_container">
		
		<?php $fdata = DisplayFeaturedMembersTop(20,1); ?>
		
		<?php
	    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && D_FEATUREDMEMBERTOP2 == '1'){
    	?>
		<div id="featured_members">
			<div id="style4" style="margin-top:15px; float: left;">
			<div class="previous_button"></div><div class="container cont-slider">
				<ul> 
					<? foreach( $fdata as $value){ ?>
					<li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a></li><? } ?>
					

				</ul>

			</div>
			<div class="next_button"></div></div>
		</div>	
		<?php
		}
		?>
			<div id="main">			
			<div id="main_content_wrapper">		
		TESTING
		
	<? if(!isset($HEADER_SINGLE_COLUMN)){ ?><div style="padding:10px 20px;"> <? } ?>	
		
<div class="clear"></div>

		<? if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
		<div id="messages">
			  <div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
			  <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
			  <?=$ERROR_MESSAGE ?>
			</div>
			<script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
		</div>
		<? } ?>
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
    <?=(isset($HEADER_ANALYTICS)) ? $HEADER_ANALYTICS : "";?>
    

    <?php 

    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no"){ ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no" && $page != 'index'){
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     
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

</head>

<? if(isset($HEADER_SINGLE_COLUMN)){ ?>
<body id="splitpage" <?=$HEADER_ON_LOAD ?>>
<? }else{ ?>
<body id="fullpage" <?=$HEADER_ON_LOAD ?>>
<? } ?>
<?php e_head(); ?>


<div id="MainPageBackground">
   
    <?php
    if($page == 'index' && $_SESSION['auth'] == 'no'){
    ?>
    <div <?php if($page != "index"){?> class="navbar navbar-inverse navbar-fixed-top"<?php }?> >
		<div class="page_header" id="PageHeader">

             <?php if($page != "index")
			 {
			 ?>
                <div class="logo_height">
                    <a href="<?=DB_DOMAIN ?>index.php" title="<?=$HEADER_META_TITLE ?>">
                        <div id="ImageLogo">					
                            <p class="<? if( TMP_LOGO_ICON =="images/DEFAULT/LOGOS/none.png"){ print "p3"; }else{ print "p1"; } ?>"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO ?><? } ?></p>					
                            <p class="p2"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO_SLOGAN ?><? } ?></p>
                        </div>
                    </a>
                </div>
            
			<?php
             }
            ?>
            
            <div class="right-head" style=" <?php if($page == "index"){?> margin:21px 20px 0px 0px; <?php } ?>">
            <!--4-->
				
                
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
                
             <?php if($page != "index")
			 {
			 ?>
                <div id="top_banner" class="hiddenonsmall"><? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="top"){ print $banner['display'];}} ?></div>	 
            <?php
             }
            ?>
            
            
            <div class="nav_button hidden-lg hidden-md">
            	<span style="padding-left:12px;">
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
            <div class="" id="MenuBar" style=" <?php if($page == "index"){?> margin:21px 20px 0px 0px; <?php } ?>"><!--3-->
          
            
            <div class="collapse navbar-collapse" id="mynav">
            
                <ul class="tabs nav navbar-nav">
                    <?=$HEADER_MENU_BAR_TOP ?>
                    <div class="hidden-md hidden-lg">
                     <?=$HEADER_MENU_BAR_SUB ?>
                     </div>
                </ul>	
                
                
                
                </div>
                		
            </div>
          
            <div class="sub_menu hidden-xs hidden-sm"> 
   				<ul class="sub_tabs f_left">
				    <?=$HEADER_MENU_BAR_SUB ?>	
			    </ul>
    			<span style="float:right;padding:4px;">
				    <span class="onlinenow">
                    	<a href="<?=DB_DOMAIN ?>index.php?dll=search&page=1&online=1">
							<?=CountOnline() ?> <?=$GLOBALS['_LANG']['_members']." ".$GLOBALS['_LANG']['_online'] ?>
                         </a>
                    </span>
			    </span>			
            </div>
                
        </div>
    </div>

    <?php
    }
    else{
    funcLayoutUserHeader($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB,$HEADER_MENU_BAR_QUICK_LINKS);
    }
    ?>
    <div <?php if($page != "index"){?> class="wide_wrapper" <?php } ?>>
		
        <?php echo getHeaderBreadCrumb($page, $sub_page, $LANG_HEADINGS, $LANG_BREADCRUMB); ?>
        
        <?php $fdata = DisplayFeaturedMembersTop(12,1); ?>
		
		<?php
        if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && D_FEATUREDMEMBERTOP2 == '1'){
        ?>
        <div id="featured_members" class="featured_members_<?=D_HEADER_LAYOUT?>">
            <div id="style5" style="margin-top:15px; float: left;">
            <div class="previous_button"></div><div class="container cont-slider">
                <ul> 
                    <? foreach( $fdata as $value){ ?>
                    <li><a href="<?=$value['link'] ?>"><img src="<?=$value['image'] ?>" width="96" height="96" border="0" style="cursor:pointer;"></a><br>
                    </li><? } ?>
                    

                </ul>

            </div>
            <div class="next_button"></div></div>
        </div>  
        <?php
        }
        ?>

        <div id="page_container"  class="page-container-<?=D_HEADER_LAYOUT?>">
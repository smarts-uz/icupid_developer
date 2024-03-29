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

    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no"){
    
    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="no" && $page != 'index'){
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
		
		<?php
		if($page == 'index' && $_SESSION['auth'] == 'no'){
		?>
		<div <?php if($page != "index"){?> class="navbar navbar-inverse navbar-fixed-top"<?php }?> >
			<div class="page_header" id="PageHeader">

				<div class="logo_height">
					
						<a href="<?=DB_DOMAIN ?>index.php" title="<?=$HEADER_META_TITLE ?>"><div id="ImageLogo">					
							<p class="<? if( TMP_LOGO_ICON =="images/DEFAULT/LOGOS/none.png"){ print "p3"; }else{ print "p1"; } ?>"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO ?><? } ?></p>					
							<p class="p2"><? if(TMP_LOGO_HIDE ==0){ ?><?=TMP_LOGO_SLOGAN ?><? } ?></p>
					
						</div></a>
				
				</div>
				<?php if($page != "index")
				{
				?>
                <div id="top_banner"><? foreach($BANNER_ARRAY as $banner){ if($banner['position'] =="top"){ print $banner['display'];}} ?></div>	 
	        	<?php
	            }
	            ?>

				<div class="menu" id="MenuBar" style=" <?php if($page == "index"){?> margin:7px 20px 0px 0px; <?php } ?>">
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

		<?php
		}
		else{
     	funcLayoutUserHeader($page,$BANNER_ARRAY,$HEADER_MENU_BAR_TOP,$HEADER_MENU_BAR_SUB,$HEADER_MENU_BAR_QUICK_LINKS);
     	}
     	?>
	<div <?php if($page != "index"){?> class="wide_wrapper" <?php } ?>>

		<?php
	    if(D_BREADCRUMBS == 'yes' && $page != "overview" && $page != "index"){
	    ?>

	    <div id="header-section-13">
	        <div class="header-title">
	        <?php

	        switch ($page) {
	            case 'search':
	                
	                if(isset($_REQUEST['friendid']) && isset($_REQUEST['friend_type'])){
	                ?>
	                <h2 class="template_color"><?=$LANG_HEADINGS[$page."_".$_REQUEST['friend_type']]?></h2>
	                <?php
	                }
	                elseif (isset($_REQUEST['friendid']) && isset($_REQUEST['displaytype'])){
	                ?>
	                <h2 class="template_color"><?=$LANG_HEADINGS[$page."_".$_REQUEST['displaytype']]?></h2>
	                <?php
	                }
	                else if(isset($sub_page) && $sub_page!=""){
	                ?>
	                <h2 class="template_color"><?=$LANG_HEADINGS[$page."_".$sub_page]?></h2>
	                <?php
	                }
	                else{
	                ?>
	                <h2 class="template_color"><?=$LANG_HEADINGS[$page]?></h2>
	                <?php
	                }
	            break;
	                    
	            default:
	                if(isset($sub_page) && $sub_page!=""){
	                ?>
	                <h2 class="template_color"><?=$LANG_HEADINGS[$page."_".$sub_page]?></h2>
	                <?php
	                }
	                else{
	                ?>
	                <h2 class="template_color"><?=$LANG_HEADINGS[$page]?></h2>
	                <?php
	                }
	            break;
	        }
	        ?>
	        </div>
	        <div id="breadcrumbing">

	            <ul class="breadcrumb-flow">
	                
	                <li><a href="<?=DB_DOMAIN?>"><?=$LANG_BREADCRUMB['home']?></a> <span class="breadcrumb-space template_color"></span></li>
	                <?php

	                switch ($page) {
	                    case 'search':
	                        
	                        if(isset($_REQUEST['friendid']) && isset($_REQUEST['friend_type'])){
	                        ?>
	                        <li><a href="<?=DB_DOMAIN?><?=$LANG_BREADCRUMB[$page]?>"><?=$LANG_BREADCRUMB[$page]?></a><span class="breadcrumb-space template_color"></span></li>
	                        <li><?=$LANG_BREADCRUMB[$page."_".$_REQUEST['friend_type']]?></li>
	                        <?php
	                        }
	                        elseif (isset($_REQUEST['friendid']) && isset($_REQUEST['displaytype'])){
	                        ?>
	                        <li><a href="<?=DB_DOMAIN?><?=$LANG_BREADCRUMB[$page]?>"><?=$LANG_BREADCRUMB[$page]?></a><span class="breadcrumb-space template_color"></span></li>
	                        <li><?=$LANG_BREADCRUMB[$page."_".$_REQUEST['displaytype']]?></li>
	                        <?php
	                        }
	                        else if(isset($sub_page) && $sub_page!=""){
	                        ?>
	                        <li><a href="<?=DB_DOMAIN?><?=$LANG_BREADCRUMB[$page]?>"><?=$LANG_BREADCRUMB[$page]?></a><span class="breadcrumb-space template_color"></span></li>
	                        <li><?=$LANG_BREADCRUMB[$page."_".$sub_page]?></li>
	                        <?php
	                        }
	                        else{
	                        ?>
	                        <li><?=$LANG_BREADCRUMB[$page]?></li>
	                        <?php
	                        }
	                        

	                    break;
	                    
	                    default:
	                        if(isset($sub_page) && $sub_page!=""){
	                        ?>
	                        <li><a href="<?=DB_DOMAIN?><?=$LANG_BREADCRUMB[$page]?>"><?=$LANG_BREADCRUMB[$page]?></a><span class="breadcrumb-space template_color"></span></li>
	                        <li><?=$LANG_BREADCRUMB[$page."_".$sub_page]?></li>
	                        <?php
	                        }
	                        else{
	                        ?>
	                        <li><?=$LANG_BREADCRUMB[$page]?></li>
	                        <?php
	                        }
	                    break;
	                }
	                
	                ?>
	                
	            </ul>
	            
	        </div>
	    </div>    
	    <?php
	    }
	    ?>

		<?php $fdata = DisplayFeaturedMembersTop(12,1); ?>
		
		<?php
	    if(isset($_SESSION['auth']) && $_SESSION['auth'] =="yes" && D_FEATUREDMEMBERTOP2 == '1'){
    	?>
		<div id="featured_members" class="featured_members_<?=D_HEADER_LAYOUT?>">
			<div id="style4" style="margin-top:15px; float: left;">
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